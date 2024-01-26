<?php


include("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbConnection = connect_with_database();
    if ($dbConnection === null) {
        exit("Failed to connect with database.");
    }

    $query = "DELETE FROM shoppingcart WHERE ProductID=? AND CustomerID=?";
    $userID = $_POST['userID'];
    $productID =  $_POST['productID'];
    $preparedStatement = $dbConnection->prepare($query);
    if ($preparedStatement === false) {
        exit("Failed to prepare statement.");
    }
    $preparedStatement->bind_param("ii", $productID, $userID);
    if (!$preparedStatement->execute()) {
        exit("Execution failed: " . $preparedStatement->error);
    }
    $preparedStatement->close();

    $dbConnection->close();
    echo "Success.";
}