<?php

    include("functions.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dbConnection = connect_with_database();
        if ($dbConnection === null) {
            echo "Database connection failure.";
        }

        $query = "SELECT OrderID FROM orders WHERE CustomerID=?";
        $preparedStatement = $dbConnection->prepare($query);

        $userID = mysqli_real_escape_string($dbConnection, $_POST['userID']);
        $preparedStatement->bind_param("i", $userID);
        $preparedStatement->execute();
        $result = $preparedStatement->get_result();

        if ($result === false) {
            echo "Error executing query: " . $preparedStatement->error;
        } else {
            $options = "<option value=''></option>";
            while ($row = $result->fetch_assoc()) {
                $orderID = $row['OrderID'];
                $options .= "<option value='$orderID'>$orderID</option>";
            }
            echo $options;
        }

        $preparedStatement->close();
        $dbConnection->close();
    }