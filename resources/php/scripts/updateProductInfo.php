<?php

include("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // connect with database.
    $dbConnection = connect_with_database();
    if ($dbConnection === null) {
        exit("Database connection failure.");
    }

    $query = "UPDATE products SET CategoryID=?, SupplierID=?, ManufacturerID=?, ProductName=?, " .
             "Price=?, UnitsInStock=?, OrderedUnits=?, Picture=?, Discontinued=? WHERE ProductID=?";
    $preparedStatement = $dbConnection->prepare($query);
    if (!$preparedStatement) {
        exit("Prepare statement error: " . $dbConnection->error);
    }
    $productID = mysqli_real_escape_string($dbConnection, $_POST['productID']);
    $categoryID = mysqli_real_escape_string($dbConnection, $_POST['categoryID']);
    $supplierID = mysqli_real_escape_string($dbConnection, $_POST['supplierID']);
    $manufacturerID = mysqli_real_escape_string($dbConnection, $_POST['manufacturerID']);
    $productName = mysqli_real_escape_string($dbConnection, $_POST['productName']);
    $productPrice = mysqli_real_escape_string($dbConnection, $_POST['productPrice']);
    $unitInStock = mysqli_real_escape_string($dbConnection, $_POST['unitsInStock']);
    $orderedUnits = mysqli_real_escape_string($dbConnection, $_POST['orderedUnits']);
    $picture = mysqli_real_escape_string($dbConnection, $_POST['picture']);
    $discontinued = mysqli_real_escape_string($dbConnection, $_POST['discontinued']);
    $preparedStatement->bind_param("iiiisdiisi", $categoryID, $supplierID, $manufacturerID, $productName, $productPrice,
                                    $unitInStock, $orderedUnits, $picture, $discontinued, $productID);
    $preparedStatement->execute();
    if ($preparedStatement->error) {
        exit("Execution error: " . $preparedStatement->error);
    }
    $preparedStatement->close();
    $dbConnection->close();
}