<?php

    include("functions.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dbConnection = connect_with_database();
        if ($dbConnection === null) {
            exit("Failed to connect with database.");
        }

        $userID = mysqli_real_escape_string($dbConnection, $_POST['userID']);
        $query = "SELECT p.ProductID, p.Picture, p.ProductName, s.Quantity, s.Price " .
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

        $preparedStatement->bind_result($productID, $picture, $productName, $quantity, $price);

        $products = array();
        while ($preparedStatement->fetch()) {
            $products[] = array(
                'productID' => $productID,
                'userID' => $userID,
                'picture' => $picture,
                'productName' => $productName,
                'quantity' => $quantity,
                'price' => $price
            );
        }

        $preparedStatement->close();

        $dbConnection->close();

        echo json_encode($products);
    }