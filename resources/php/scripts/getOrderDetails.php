<?php

include("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbConnection = connect_with_database();
    if ($dbConnection === null) {
        exit("Failed to connect with the database.");
    }

    $orderID = mysqli_real_escape_string($dbConnection, $_POST['orderID']);

    // Query to retrieve order status
    $statusQuery = "SELECT Status FROM orders WHERE OrderID=?";
    $statusStatement = $dbConnection->prepare($statusQuery);

    if ($statusStatement === false) {
        exit("Prepare statement error: " . $dbConnection->error);
    }

    $statusStatement->bind_param("i", $orderID);
    $statusStatement->execute();

    if ($statusStatement->error) {
        exit("Execution error: " . $statusStatement->error);
    }

    $statusStatement->bind_result($status);
    $statusStatement->fetch();

    // Close the status statement
    $statusStatement->close();

    // Query to retrieve order details
    $detailsQuery = "SELECT o.Price, o.Quantity, p.ProductName " .
                    "FROM orderdetails AS o " .
                    "INNER JOIN products as p " .
                    "ON o.ProductsID = p.ProductID " .
                    "WHERE o.OrderID=?";

    $detailsStatement = $dbConnection->prepare($detailsQuery);

    if ($detailsStatement === false) {
        exit("Prepare statement error: " . $dbConnection->error);
    }

    $detailsStatement->bind_param("i", $orderID);
    $detailsStatement->execute();

    if ($detailsStatement->error) {
        exit("Execution error: " . $detailsStatement->error);
    }

    $detailsStatement->bind_result($price, $quantity, $productName);

    $totalCost = 0;

    echo "<ul>";
    while ($detailsStatement->fetch()) {
        $cost  = floatval($price) * intval($quantity);
        echo "<li>$productName, Price: $$price, Quantity: $quantity, Cost: $$cost</li>";

        $totalCost += $cost;
    }
    echo "</ul>";

    // Display Total Cost and Order Status
    echo "<p>- Total Cost: $$totalCost</p>";
    if ($status == 1) {
        echo "<p>- Order Status: Accepted</p>";
    } elseif ($status == 0) {
        echo "<p>- Order Status: Not Accepted</p>";
    } elseif ($status == 2) {
        echo "<p>- Order Status: Archived</p>";
    } else {
        echo "<p>- Unknown Order Status</p>";
    }

    // Close the details statement and database connection
    $detailsStatement->close();
    $dbConnection->close();
}