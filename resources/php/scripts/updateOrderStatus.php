<?php

include("functions.php");

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

    $orderID = $_POST['orderID'];
    $status = $_POST['status'];

    // Assuming that OrderID and Status are integers in the database, you don't need to escape them
    $preparedStatement->bind_param("ii", $status, $orderID);
    $preparedStatement->execute();

    if ($preparedStatement->error) {
        exit("Execution error: " . $preparedStatement->error);
    }

    $preparedStatement->close();
    $dbConnection->close();
    }
