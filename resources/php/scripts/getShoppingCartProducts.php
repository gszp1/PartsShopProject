<?php

    include("functions.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dbConnection = connect_with_database();
        if ($dbConnection == null) {
            exit("Failed to connect with database.");
        }

        $userID = mysqli_real_escape_string($dbConnection, $_POST['userID']);
        $query = "SELECT p.Picture, p.ProductName, s.Quantity, s.Price " .
                 "FROM products as p " .
                 "INNER JOIN shoppingcart as s ON p.ProductID = s.ProductID " .
                 "WHERE s.CustomerID = ?";
        $preparedStatement = $dbConnection->prepare($query);
        if ($preparedStatement === false) {
            exit("Failed to prepare statement.");
        }
        $preparedStatement->bind_param("i", $userID);
        if (!$preparedStatement->execute()) {
            exit("Execution failed: " . $preparedStatement->error);
        }


        // Bind the result variables
        $preparedStatement->bind_result($picture, $productName, $quantity, $price);

        // Fetch the data into an array
        $products = array();
        while ($preparedStatement->fetch()) {
            $products[] = array(
                'userID' => $userID,
                'Picture' => $picture,
                'ProductName' => $productName,
                'Quantity' => $quantity,
                'Price' => $price
            );
        }

        // Close the statement
        $preparedStatement->close();

        // Close the database connection
        $dbConnection->close();

        // Encode the array into JSON and echo it
        echo json_encode($products);
    }