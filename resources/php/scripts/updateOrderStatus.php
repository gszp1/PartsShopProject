<?php

    include("function.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // connect with database.
        $dbConnection = connect_with_database();
        if ($dbConnection === null) {
            exit("Database connection failure.");
        }

        // Prepare statement.
        $query = "UPDATE orders SET Status = ? WHERE OrderID = ?";
        $preparedStatement = $dbConnection->prepare($query);
        if (!$preparedStatement) {
            exit("Prepare statement error: " . $dbConnection->error);
        }

        $orderID = mysqli_real_escape_string($dbConnection, $_POST['orderID']);
        $status = mysqli_real_escape_string($dbConnection, $_POST['status']);
        $preparedStatement->bind_param("ss", $status, $orderID);
        $preparedStatement->execute();
        if ($preparedStatement->error) {
            exit("Execution error: " . $preparedStatement->error);
        }

        $preparedStatement->close();
        $dbConnection->close();
        exit("Update successful.");
    }
