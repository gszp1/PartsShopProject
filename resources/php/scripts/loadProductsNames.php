<?php

    include("functions.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dbConnection = connect_with_database();
        if ($dbConnection === null) {
            exit("Failed to connect with database.");
        }

        $query = "SELECT ProductID, ProductName FROM products";
        $productNames = mysqli_query($dbConnection, $query);

        if ($productNames->num_rows > 0) {
            while ($row = $productNames->fetch_assoc()) {
                echo '<option value="' . $row['ProductID'] . '">' . $row['ProductName'] . '</option>';
            }
        }
        mysqli_close($dbConnection);
    }