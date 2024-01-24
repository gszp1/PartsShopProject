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

        $preparedStatement->close();
        $dbConnection->close();
    }