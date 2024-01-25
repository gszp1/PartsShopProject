<?php

include("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbConnection = connect_with_database();
    if ($dbConnection === null) {
        exit("Failed to connect with database.");
    }

    $query = "SELECT * FROM products WHERE ProductID = ?";
    $preparedStatement = $dbConnection->prepare($query);
    $pID = $_POST['productID'];
    $preparedStatement->bind_param("i", $pID);
    
}