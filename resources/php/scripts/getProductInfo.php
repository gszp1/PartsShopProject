<?php

include("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbConnection = connect_with_database();
    if ($dbConnection === null) {
        exit("Failed to connect with database.");
    }

    $query = "SELECT * FROM products WHERE ProductID = ?";
    $preparedStatement = $dbConnection->prepare($query);
    $pID = $_POST['productId'];
    $preparedStatement->bind_param("i", $pID);
    // Execute the prepared statement
    $preparedStatement->execute();
    // Fetch the results
    $result = $preparedStatement->get_result();
    if ($result->num_rows > 0) {
        // Fetch the data from the result set
        $row = $result->fetch_assoc();
        $CategoryID = $row['CategoryID'];
        $SupplierID = $row['SupplierID'];
        $ManufacturerID = $row['ManufacturerID'];
        $ProductName = $row['ProductName'];
        $Price = $row['Price'];
        $UnitsInStock = $row['UnitsInStock'];
        $OrderedUnits = $row['OrderedUnits'];
        $Picture = $row['Picture'];
        $Discontinued = $row['Discontinued'];

        $productInfo =  "<tr><td>CategoryID</td><td>$CategoryID</td></tr>";
        $productInfo .= "<tr><td>SupplierID</td><td>$SupplierID</td></tr>";
        $productInfo .= "<tr><td>ManufacturerID</td><td>$ManufacturerID</td></tr>";
        $productInfo .= "<tr><td>ProductName</td><td>$ProductName</td></tr>";
        $productInfo .= "<tr><td>Price</td><td>$Price</td></tr>";
        $productInfo .= "<tr><td>UnitsInStock</td><td>$UnitsInStock</td></tr>";
        $productInfo .= "<tr><td>OrderedUnits</td><td>$OrderedUnits</td></tr>";
        $productInfo .= "<tr><td>Picture</td><td>$Picture</td></tr>";
        $productInfo .= "<tr><td>Discontinued</td><td>$Discontinued</td></tr>";
        echo $productInfo;
    }
    $preparedStatement->close();
    $dbConnection->close();
}