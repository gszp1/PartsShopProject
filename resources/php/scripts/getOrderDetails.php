<?php

include("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbConnection = connect_with_database();
    if ($dbConnection === null) {
        exit("Failed to connect with database.");
    }

    $query = "SELECT Status FROM orders WHERE OrderID=?";
    $preparedStatement = $dbConnection->prepare($query);
    if ($preparedStatement === false) {
        exit("Prepare statement error: " . $dbConnection->error);
    }
    $orderID = mysqli_real_escape_string($dbConnection, $_POST['userID']);
    $preparedStatement->bind_param("i", $orderID);
    $preparedStatement->execute();
    if ($preparedStatement->error) {
        exit("Execution error: " . $preparedStatement->error);
    }

    $preparedStatement->bind_result($status);
    $preparedStatement->fetch();

    $query = "SELECT o.Price, o.Quantity, p.ProductName " .
            "FROM orderdetails AS o " .
            "INNER JOIN products as p " .
            "ON o.ProductsID = p.ProductID " .
            "WHERE o.OrderID=?";
    $preparedStatement = $dbConnection->prepare($query);
    if ($preparedStatement === false) {
        exit("Prepare statement error: " . $dbConnection->error);
    }
    $preparedStatement->bind_param("i", $orderID);
    $preparedStatement->execute();
    if ($preparedStatement->error) {
        exit("Execution error: " . $preparedStatement->error);
    }

    $totalCost = 0;
    echo "<ul>";
    while ($detailsStatement->fetch()) {
        $totalCost += floatval($price) * intval($quantity);
        echo "<li>- $productName, Price: $price, Quantity: $quantity</li>";
    }
    echo "</ul>";
    echo "<p>Total Cost: $totalCost</p>";
    echo "<p>Order Status: $status</p>";
    $preparedStatement->close();
    $dbConnection->close();
}