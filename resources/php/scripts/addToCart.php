<?php

    include("functions.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dbConnection = connect_with_database();
        if ($dbConnection === null) {
            exit("Failed to connect with database.");
        }
        //sanitize data.
        $productID = mysqli_real_escape_string($dbConnection, $_POST['productID']);
        $customerID = mysqli_real_escape_string($dbConnection, $_POST['customerID']);
        $quantity = mysqli_real_escape_string($dbConnection, $_POST['quantity']);
        $price = mysqli_real_escape_string($dbConnection, $_POST['price']);
        if (empty($productID) || empty($customerID) || empty($quantity) || empty($price)) {
            $dbConnection->close();
            exit("Failed to prepare data for insertion.");
        }

        //check if insertion can be performed
        // check if product exists
        $preparedStatement = $dbConnection->prepare("SELECT * FROM products WHERE ProductID = ?");
        if ($preparedStatement === false) {
            $dbConnection->close();
            exit("Error in preparing the statement.");
        }
        $preparedStatement->bind_param("i", $productID);
        $preparedStatement->execute();
        $result = $preparedStatement->get_result();
        if ($result === false || $result->num_rows === 0) {
            $preparedStatement->close();
            $dbConnection->close();
            exit("No such product exists.");
        }
        // check for product availability.
        $productsRow = $result->fetch_assoc();
        $availableQuantity = $productsRow['UnitsInStock'];
        if ($quantity > $availableQuantity) {
            $preparedStatement->close();
            $dbConnection->close();
            exit("Not enough products available.");
        }
        // check if user exists.
        $preparedStatement = $dbConnection->prepare("SELECT * FROM customers WHERE CustomerID = ?");
        if ($preparedStatement === false) {
            $dbConnection->close();
            exit("You have to login first.");
        }
        $preparedStatement->bind_param("i", $customerID);
        $preparedStatement->execute();
        $result = $preparedStatement->get_result();
        if ($result === false || $result->num_rows === 0) {
            $preparedStatement->close();
            $dbConnection->close();
            exit("No such customer exists.");
        }
        //Check if product is already on list, if so add another one, instead of adding new record
        $preparedStatement = $dbConnection->prepare("SELECT * FROM shoppingcart WHERE CustomerID=? AND ProductID=?");
        if ($preparedStatement === false) {
            $dbConnection->close();
            exit("Error in preparing the statement.");
        }
        $preparedStatement->bind_param("ii", $customerID, $productID);
        $preparedStatement->execute();
        $result = $preparedStatement->get_result();
        if ($result->num_rows !== 0) {
            $preparedStatement = $dbConnection->prepare("UPDATE shoppingcart SET Quantity = Quantity + 1 WHERE ProductID = ? AND CustomerID = ?");
            if ($preparedStatement === false) {
                exit("Error in preparing the statement.");
            }
            $preparedStatement->bind_param("ii", $productID, $customerID);
            $preparedStatement->execute();
            if ($result === false) {
                $preparedStatement->close();
                $dbConnection->close();
                exit("Failed to add product to shopping list.");
            }
            $preparedStatement->close();
            $dbConnection->close();
            return "Product added to shopping cart.";
        }


        // prepare statement.
        $preparedStatement = $dbConnection->prepare("INSERT INTO shoppingcart(ProductID, CustomerID, Quantity, Price) VALUES (?, ?, ?, ?)");
        if ($preparedStatement === false) {
            exit("Error in preparing the statement.");
        }
        $preparedStatement->bind_param("iiid", $productID, $customerID, $quantity, $price);
        // execute statement.
        $result = $preparedStatement->execute();
        if ($result === false) {
            exit("Error in executing the statement.");
        }
        // close the statement.
        $preparedStatement->close();
        // close the database connection.
        $dbConnection->close();
        return "Product added to shopping cart.";
    }