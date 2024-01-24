<?php

    include("functions.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dbConnection = connect_with_database();
        if ($dbConnection == null) {
            exit("Failed to connect with database.");
        }

        $query = "DELETE * FROM shoppincart WHERE ProductID=?, CustomerID=?";
        $userID = mysqli_real_escape_string($dbConnection, $_POST['userID']);
        $productID = mysqli_real_escape_string($dbConnection, $_POST['$productID']);

    }