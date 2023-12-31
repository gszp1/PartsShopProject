<?php
    function validate_email($userInputEmail) {
        $sanitizedEmail = filter_var($userInputEmail, FILTER_SANITIZE_EMAIL);
        if (filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    function get_user_data($userID) {
        $dbConnection = mysqli_connect('localhost', 'dbclient', 'ar0220', 'partshopdb');
        if ($dbConnection == false) {
            return null;
        }
        $query = "SELECT Email, Username, Surname, Name, PhoneNumber FROM customers WHERE userID='$userID'";
        $result = mysqli_query($dbConnection, $query);
        return mysqli_fetch_assoc($result);
    }

    function load_products_from_database() {
        $connection = mysqli_connect('localhost','dbclient', 'ar0220','partshopdb');
        if (!$connection) {
            echo 'Connection error: ' . mysqli_connect_error();
        }
        $query = "SELECT products.*, manufacturers.ManufacturerName FROM products JOIN manufacturers ON
                    products.ManufacturerID = manufacturers.ManufacturerID;";
        $products = $connection->query($query);
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
        // Open connection with database.
        $dbConnection = mysqli_connect('localhost', 'dbclient', 'ar0220', 'partshopdb');
        // Handle connection opening failure.
        if ($dbConnection == false) {
            return null;
        }
        // Get email, username, surname, name, phonenumber from database.
        $query = "SELECT Email, Username, Surname, Name, PhoneNumber From customers WHERE customerID='$userID'";
        $result = mysqli_query($dbConnection, $query);
        return mysqli_fetch_assoc($result);
    }

    function create_user_data_list( $userID ) {
        $user_data = get_full_user_data($userID);
        if ($user_data == null) {
            return;
        }
        $fieldOrder = ['Email', 'Username', 'Surname', 'Name', 'PhoneNumber'];

        echo '<ul>';
        foreach ($fieldOrder as $field) {
            echo '<li>';
            echo '<strong>' . $field . '</strong><br>'; // Label on one line
            echo '<span>'; // Use a <span> for styling purposes if needed
    
            if (isset($user_data[$field])) {
                echo htmlspecialchars($user_data[$field]);
            } else {
                echo '&nbsp;'; // Display empty space if the field is not present
            }
    
            echo '</span>';
            echo '</li>';
        }
        echo '</ul>';
    }

?>