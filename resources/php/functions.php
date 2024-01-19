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
        $query = "SELECT products.*, manufacturers.ManufacturerName FROM products JOIN manufacturers ON
                    products.ManufacturerID = manufacturers.ManufacturerID;";
        $products = $dbConnection->query($query);
        if ($products->num_rows > 0) {
            while($row = $products->fetch_assoc()) {
                $pic = $row["Picture"];
                echo "<li class='listItemI'>".
                    "<div class='imageContainerI'>".
                    "<img src=\"$pic\" alt=''></div>".
                    "<div class='dataContainerI'>".
                    "<ul><li>"."Name:  ". $row["ProductName"]."</li>".
                    "<li>"."Manufacturer:  ". $row["ManufacturerName"]."</li>".
                    "<li>"."Price:  ". $row["Price"]." PLN"."</li></ul></div>".
                    "<div class='buttonContainerI'>".
                    "<button class='shoppingCartButtonItemI'>add to shopping cart</button></div></li>";
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
        $total_cost = 0;
        $dbConnection = connect_with_database();
        if ($dbConnection == null) {
            return $total_cost;
        }
        //todo: Check database for redundant tables and implement displaying products from shopping list.
    }
?>