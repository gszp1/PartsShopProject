<?php

    include('server.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dbConnection = connect_with_database();
        if ($dbConnection == null) {
            exit("Failed to connect with database.");
        }

        //sanitize data.
        $productID = mysqli_real_escape_string($dbConnection, $_POST['productID']);
        $customerID = mysqli_real_escape_string($dbConnection, $_POST['customerID']);
        $quantity = mysqli_real_escape_string($dbConnection, $_POST['quantity']);
        $price = mysqli_real_escape_string($dbConnection, $_POST['price']);
        if (empty($productID) || empty($customerID) || empty($quantity) || empty($price)) {
            exit("Failed to prepare data for insertion.");
        }

        //check if insertion can be performed
        // check if product exists
        $preparedStatement = $dbConnection->prepare("SELECT * FROM products WHERE ProductID = ?");
        $preparedStatement->bind_param("i", $productID);
        $preparedStatement->execute();
        $result = $preparedStatement->get_result();
        if ($result === false || $result->num_rows === 0) {
            exit("No such product exists.");
        }
        // check for product availability.
        $productsRow = $result->fetch_assoc();
        $availableQuantity = $productsRow['quantity'];
        if ($quantity > $availableQuantity) {
            exit("Not enough products available");
        }
        // check if user exists.
        $preparedStatement = $dbConnection->prepare("SELECT * FROM customers WHERE CustomerID = ?");
        $preparedStatement->bind_param("i", $customerID);
        $preparedStatement->execute();
        $result = $preparedStatement->get_result();
        if ($result === false || $result->num_rows === 0) {
            exit("No such customer exists.");
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
            die("Error in executing the statement.");
        }
        // close the statement.
        $preparedStatement->close();
        // close the database connection.
        $dbConnection->close();
    }