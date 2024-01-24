<?php

    include('functions.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dbConnection = connect_with_database();
        if ($dbConnection === null) {
            exit("Failed to connect with database.");
        }

        // query for adding order.
        $query = "INSERT INTO orders(CustomerID, Status) VALUES (?, 0)";
        $preparedStatement = $dbConnection->prepare($query);
        if ($preparedStatement === false) {
            exit("Failed to prepare statement.");
        }
        $userID = mysqli_real_escape_string($dbConnection, $_POST['customerID']);
        $preparedStatement->bind_param("i", $userID);
        if (!$preparedStatement->execute()) {
            exit("Execution failed: " . $preparedStatement->error);
        }

        // Retrieve new order's ID
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
        $row = $result->fetch_assoc();
        $OrderID = $row['newOrderID'];
        



        $preparedStatement->close();
        $dbConnection->close();
    }