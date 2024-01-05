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

    // Function for retrieving data of user with given ID.
    function get_full_user_data($userID) {
        // Open connection with database.
        $dbConnection = mysqli_connect('localhost', 'dbclient', 'ar0220', 'partshopdb');
        // Handle connection opening failure.
        if ($dbConnection == false) {
            return null;
        }
        // Get email, username, surname, name, phonenumber from database.
        $query = "SELECT Email, Username, Surname, Name, PhoneNumber From customers WHERE userID='$userID'";
        $result = mysqli_query($dbConnection, $query);
        return mysqli_fetch_assoc($result);
    }
?>