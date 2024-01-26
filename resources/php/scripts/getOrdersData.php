<?php
    include("functions.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $dbConnection = connect_with_database();
        if ($dbConnection === null) {
            echo "Database connection failure.";
        }

        $query = "SELECT o.OrderID, o.Status, c.CustomerID, c.Email " .
                 "FROM orders AS o INNER JOIN " .
                 "Customers AS c " .
                 "ON o.CustomerID = c.CustomerID";
        $records = mysqli_query($dbConnection, $query);

        while ($row = mysqli_fetch_assoc($records)) {
            echo "<tr>";
            echo "<td data-type='orderId'>" . $row['OrderID'] . "</td>";
            echo "<td>" . $row['CustomerID'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "<td data-type='orderStatus'>" . $row['Status'] . "</td>";
            echo "</tr>";
        }

        mysqli_close($dbConnection);
    }
