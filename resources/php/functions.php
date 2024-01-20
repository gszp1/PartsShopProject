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

    function get_user_data($userID) {
        $dbConnection = connect_with_database();
        if ($dbConnection == null) {
            return;
        }
        $query = "SELECT Email, Username, Surname, Name, PhoneNumber FROM customers WHERE userID='$userID'";
        $result = mysqli_query($dbConnection, $query);
        return mysqli_fetch_assoc($result);
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
                $pic = $row["Picture"];
                $productID = $row["ProductID"];
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
                    "<button class='shoppingCartButtonItemI' onclick='../js/addToCart($productID, $userID, 1, $price)'>add to shopping cart</button>".
                    "</div>".
                    "</li>";
            }
        } else {
            echo "0 results";
        }
    }

    // Function for retrieving data of user with given ID.
    function get_full_user_data($userID) {
        $dbConnection = connect_with_database();
        if ($dbConnection == null) {
            return;
        }
        // Get email, username, surname, name, phonenumber from database.
        $query = "SELECT Email, Username, Surname, Name, PhoneNumber From customers WHERE customerID='$userID'";
        $result = mysqli_query($dbConnection, $query);
        return mysqli_fetch_assoc($result);
    }

    function create_user_data_list( $userID ) {
        $userData = get_full_user_data($userID);
        if ($userData == null) {
            return;
        }
        $fieldOrder = ['Email', 'Username', 'Surname', 'Name', 'PhoneNumber'];

        echo '<ul>';
        foreach ($fieldOrder as $field) {
            echo '<li>';
            echo '<strong>' . $field . '</strong><br>'; // Label on one line
            echo '<span>'; // Use a <span> for styling purposes if needed

            if (isset($userData[$field])) {
                echo htmlspecialchars($userData[$field]);
            } else {
                echo '&nbsp;'; // Display empty space if the field is not present
            }

            echo '</span>';
            echo '</li>';
        }
        echo '</ul>';
    }

    function show_user_shoppingCart($userID) {
        $totalCost = 0;
        $dbConnection = connect_with_database();
        if ($dbConnection == null) {
            return $totalCost;
        }
        //get all products from user's shopping cart.
        $query = "SELECT p.Picture, p.ProductName, sc.Quantity, sc.Price " .
                 "FROM products AS p " .
                 "INNER JOIN shoppingcart AS sc ON p.ProductID = sc.ProductID " .
                 "INNER JOIN customers AS c ON sc.CustomerID = c.CustomerID " .
                 "WHERE c.CustomerID = '$userID';";
        $result = mysqli_query($dbConnection, $query);
        if ($result) {
            // Start HTML list
            echo '<ul>';
            // Loop through the result set
            while ($row = mysqli_fetch_assoc($result)) {
                // Calculate total price (quantity * price)
                $totalPrice = $row['Quantity'] * $row['Price'];
                // Display each entry in an HTML list item
                echo '<li>';
                echo '<img src="' . $row['Picture'] . '" alt="' . $row['ProductName'] . '">';
                echo '<p>Product: ' . $row['ProductName'] . '</p>';
                echo '<p>Quantity: ' . $row['Quantity'] . '</p>';
                echo '<p>Price: $' . $row['Price'] . '</p>';
                echo '<p>Total: $' . $totalPrice . '</p>';
                echo '</li>';
                $totalCost = $totalCost + $totalPrice;
            }
            // End HTML list
            echo '</ul>';
        } else {
            // Handle the case where the query was not successful
            echo 'Error executing query: ' . mysqli_error($dbConnection);
        }
        return $totalCost;
    }