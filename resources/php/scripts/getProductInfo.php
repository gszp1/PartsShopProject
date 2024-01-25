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

        $productInfo = "<tr><th>Product Name</th><th>Price</th><th>Units In Stock</th></tr>";
        $productInfo .= "<tr><td>$ProductName</td><td>$Price</td><td>$UnitsInStock</td></tr>";
        echo $productInfo;
    }
    $preparedStatement->close();
    $dbConnection->close();
}