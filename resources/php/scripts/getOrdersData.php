<?php
    include("functions.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // connect with database.
        $dbConnection = connect_with_database();
        if ($dbConnection === null) {
            echo "Database connection failure.";
        }

        // get data about all orders.
        $query = "SELECT o.OrderID, o.Status, c.CustomerID, c.Email" .
                 "FROM orders AS o INNER JOIN " .
                 "Customers AS c " .
                 "ON o.CustomerID = c.CustomerID";
        $records = mysqli_query($dbConnection, $query);

        // generate table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td data-type='orderId'>" . $row['OrderID'] . "</td>";
            echo "<td>" . $row['CustomerID'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "<td data-type='orderStatus'>" . $row['Status'] . "</td>";
            echo "</tr>";
        }

        // close connection with database.
        mysqli_close($dbConnection);
    }
