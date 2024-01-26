<?php
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dbConnection = connect_with_database();
    if ($dbConnection === null) {
        exit("Database connection failure.");
    }

    $query = "INSERT INTO products(CategoryID, SupplierID, ManufacturerID, ProductName, " .
             "Price, UnitsInStock, OrderedUnits, Picture, Discontinued) " .
             "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $preparedStatement = $dbConnection->prepare($query);
    if (!$preparedStatement) {
        exit("Prepare statement error: " . $dbConnection->error);
    }
    $categoryID = mysqli_real_escape_string($dbConnection, $_POST['categoryID']);
    $supplierID = mysqli_real_escape_string($dbConnection, $_POST['supplierID']);
    $manufacturerID = mysqli_real_escape_string($dbConnection, $_POST['manufacturerID']);
    $productName = $_POST['productName'];
    $productPrice = mysqli_real_escape_string($dbConnection, $_POST['productPrice']);
    $unitInStock = mysqli_real_escape_string($dbConnection, $_POST['unitsInStock']);
    $orderedUnits = mysqli_real_escape_string($dbConnection, $_POST['orderedUnits']);
    $picture = $_POST['picture'];
    $discontinued = mysqli_real_escape_string($dbConnection, $_POST['discontinued']);
    $preparedStatement->bind_param("iiisdiisi", $categoryID, $supplierID, $manufacturerID, $productName, $productPrice,
                                    $unitInStock, $orderedUnits, $picture, $discontinued);
    $preparedStatement->execute();
    if ($preparedStatement->error) {
        exit("Execution error: " . $preparedStatement->error);
    }
    $preparedStatement->close();
    $dbConnection->close();
}