<?php
    include('functions.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dbConnection = connect_with_database();
        if ($dbConnection === null) {
            exit("Failed to connect with the database.");
        }

        $query = "SELECT ProductID, Quantity, Price FROM shoppingcart WHERE CustomerID = ?";
        $preparedStatement = $dbConnection->prepare($query);
        if ($preparedStatement === false) {
            exit("Failed to prepare statement.");
        }
        $userID = $_POST['userID'];
        $preparedStatement->bind_param("i", $userID);
        if (!$preparedStatement->execute()) {
            exit("Execution failed: " . $preparedStatement->error);
        }
        $cartProducts = $preparedStatement->get_result();
        if ($cartProducts->num_rows <= 0) {
            exit("No records to add.");
        }

        $query = "INSERT INTO orders(CustomerID, Status) VALUES (?, 0)";
        $preparedStatement = $dbConnection->prepare($query);
        if ($preparedStatement === false) {
            exit("Failed to prepare statement.");
        }
        $preparedStatement->bind_param("i", $userID);
        if (!$preparedStatement->execute()) {
            exit("Execution failed: " . $preparedStatement->error);
        }

        $query = "SELECT MAX(OrderID) AS newOrderID FROM orders WHERE CustomerID = ?";
        $preparedStatement = $dbConnection->prepare($query);
        if ($preparedStatement === false) {
            exit("Failed to prepare statement.");
        }
        $preparedStatement->bind_param("i", $userID);
        if (!$preparedStatement->execute()) {
            exit("Execution failed: " . $preparedStatement->error);
        }
        $result = $preparedStatement->get_result();
        if ($result === false) {
            exit("Error fetching result: " . $preparedStatement->error);
        }
        $row = $result->fetch_assoc();
        if ($row === null) {
            exit("Order was not created.");
        }
        $orderID = $row['newOrderID'];

        $query = "INSERT INTO orderdetails (OrderID, ProductsID, Price, Quantity) VALUES (?, ?, ?, ?)";
        $preparedStatement = $dbConnection->prepare($query);
        if ($preparedStatement === false) {
            exit("Failed to prepare statement for insertion.");
        }
        while ($row = $cartProducts->fetch_assoc()) {
            $productID = $row['ProductID'];
            $quantity = $row['Quantity'];
            $price = $row['Price'];
            $preparedStatement->bind_param("iiii", $orderID, $productID, $price, $quantity);
            if (!$preparedStatement->execute()) {
                exit("Insertion failed: " . $preparedStatement->error);
            }
        }

        if ($preparedStatement->affected_rows <= 0) {
            exit("No records were inserted into orderdetails.");
        }

        $preparedStatement->close();
        $dbConnection->close();
    }