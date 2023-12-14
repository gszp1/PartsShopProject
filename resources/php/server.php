<?php
session_start();
$username = "";
$email = "";
$errors = array();

// establish database connection
$dbConnection = mysqli_connect('localhost', 'dbclient', 'ar0220', 'partshopdb');

if ($dbConnection == false) {
    die('Failed to connect to database'. mysqli_connect_error());
}


// register user
if (count($errors) == 0) {
    $password = md5($password_escp);
    $prepared_statement = $dbConnection->prepare("INSERT INTO customers(Email, Username, Password) VALUES (?, ?, ?)");
    $prepared_statement->bind_param("sss", $username, $email, $password);
    $prepared_statement->execute();
}
?>