<?php

    function connect_with_database() {
        $dbConnection = mysqli_connect('localhost', 'dbclient', 'ar0220', 'partshopdb');
        if ($dbConnection == false) {
            return null;
        }
        return $dbConnection;
    }

    function validate_email($userInputEmail) {
        $sanitizedEmail = filter_var($userInputEmail, FILTER_SANITIZE_EMAIL);
        if (filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    function load_products_from_database() {
        $dbConnection = connect_with_database();
        if ($dbConnection == null) {
            return;
        }
        $query = "SELECT products.*, manufacturers.ManufacturerName FROM products " .
                 "JOIN manufacturers ON products.ManufacturerID = manufacturers.ManufacturerID;";
        $products = $dbConnection->query($query);
        if ($products->num_rows > 0) {
            while($row = $products->fetch_assoc()) {
                $productName = $row["ProductName"];
                $manufacturerName = $row["ManufacturerName"];
                $price = $row["Price"];
                $pic = '.' . $row["Picture"];
                $productID = $row["ProductID"];
                $quantity = 1;
                $userID = -1;
                if (isset($_SESSION['userID']) == true) {
                    $userID = $_SESSION['userID'];
                }
                echo "<li class='listItemI'>".
                    "<div class='imageContainerI'>".
                    "<img src=\"$pic\" alt=''></div>".
                    "<div class='dataContainerI'>".
                    "<ul>".
                    "<li>" . "Name: " . $productName . "</li>".
                    "<li>" . "Manufacturer: " . $manufacturerName . "</li>".
                    "<li>" . "Price: " . $price . " PLN" . "</li>".
                    "</ul>".
                    "</div>".
                    "<div class='buttonContainerI'>".
                    "<button class='shoppingCartButtonItemI' onclick='addToCart($productID, $userID, $quantity, $price)'>add to shopping cart</button>".
                    "</div>".
                    "</li>";
            }
        } else {
            echo "0 results";
        }
    }

    function get_full_user_data($userID) {
        $dbConnection = connect_with_database();
        if ($dbConnection == null) {
            return;
        }
        $preparedStatement = $dbConnection->prepare("SELECT Email, Username, Surname, Name, PhoneNumber FROM customers WHERE CustomerID=?");
        if ($preparedStatement === false) {
            return null;
        }
        $preparedStatement->bind_param("i", $userID);
        $preparedStatement->execute();
        $result = $preparedStatement->get_result();
        if ($result === false || $result->num_rows === 0) {
            return null;
        }
        return mysqli_fetch_assoc($result);
    }

    function create_user_data_list( $userID ) {
        $userData = get_full_user_data($userID);
        if ($userData == null) {
            return;
        }
        $fieldOrder = ['Email', 'Username', 'Surname', 'Name', 'PhoneNumber'];
        echo '<table class="tableUAP" border="0">';
        echo '<tr class="trUAP"><td class="tdHeaderUAP" colspan="2"><strong>Contact Data</strong></td></tr>';
        foreach ($fieldOrder as $field) {
            echo '<tr class="trUAP">';
            echo '<td class="tdUAP"><strong>' . $field . ':</strong></td>';
            echo '<td class="tdUAP">';
            if (isset($userData[$field])) {
                echo htmlspecialchars($userData[$field]);
            } else {
                echo '&nbsp;';
            }
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    function show_user_shoppingCart($userID) {
        $totalCost = 0;
        $dbConnection = connect_with_database();
        if ($dbConnection == null) {
            return $totalCost;
        }
        $query = "SELECT p.Picture, p.ProductName, sc.Quantity, sc.Price " .
                 "FROM products AS p " .
                 "INNER JOIN shoppingcart AS sc ON p.ProductID = sc.ProductID " .
                 "INNER JOIN customers AS c ON sc.CustomerID = c.CustomerID " .
                 "WHERE c.CustomerID='$userID';";
        $result = mysqli_query($dbConnection, $query);
        if ($result) {
            echo '<ul>';
            while ($row = mysqli_fetch_assoc($result)) {
                $totalPrice = $row['Quantity'] * $row['Price'];
                echo '<li>';
                echo '<img src="' . $row['Picture'] . '" alt="' . $row['ProductName'] . '">';
                echo '<p>Product: ' . $row['ProductName'] . '</p>';
                echo '<p>Quantity: ' . $row['Quantity'] . '</p>';
                echo '<p>Price: $' . $row['Price'] . '</p>';
                echo '<p>Total: $' . $totalPrice . '</p>';
                echo '</li>';
                $totalCost = $totalCost + $totalPrice;
            }
            echo '</ul>';
        } else {
            echo 'Error executing query: ' . mysqli_error($dbConnection);
        }
        return $totalCost;
    }

    function validatePhoneNumber($phoneNumber) {
        $phoneNumber = preg_replace("/[^0-9]/", "", $phoneNumber);
        return (strlen($phoneNumber) === 9 && is_numeric($phoneNumber));
    }

    function updateUserData($userID, $username, $surname, $name, $phoneNumber) {
        $dbConnection = connect_with_database();
        if ($dbConnection === null) {
            return false;
        }
        $query = "UPDATE customers SET Username=?, Surname=?, Name=?, PhoneNumber=? WHERE CustomerID=?";
        $preparedStatement = $dbConnection->prepare($query);
        if ($preparedStatement === false) {
            return false;
        }
        $preparedStatement->bind_param("ssssi", $username, $surname, $name, $phoneNumber, $userID);
        $success = $preparedStatement->execute();
        $preparedStatement->close();
        $dbConnection->close();
        return $success;
    }