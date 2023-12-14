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

    if (isset($_POST['registerUser'])) {
        $username = mysqli_real_escape_string($dbConnection, $_POST['username']);
        $email = mysqli_real_escape_string($dbConnection, $_POST['userEmail']);
        $password = mysqli_real_escape_string($dbConnection, $_POST["password"]);
        $passwordConfirmation = mysqli_real_escape_string($dbConnection, $_POST["passwordConfirmation"]);
        
        if (empty($username) || empty($email) || empty($password) || empty($passwordConfirmation)) {
            array_push($errors,"All field have to be filled.");
        }

        if ($password != $passwordConfirmation) {
            array_push($errors,"Provided passwords don't match.");
        }

        $getUserFromDBQuery = "SELECT * FROM customers WHERE username='$username' OR email='$email' LIMIT 1";
        $queryResult = mysqli_query($dbConnection, $getUserFromDBQuery);
        $user = mysqli_fetch_assoc($queryResult);

        if($user) {
            if($user['Username'] === $username) {
                array_push($errors, "Username already taken.");
            }
            if($user['Email'] === $email) {
                array_push($errors,"Email already used.");
            }
        }
            // register user
        if (count($errors) == 0) {
            $password_escp = md5($password);
            $prepared_statement = $dbConnection->prepare("INSERT INTO customers(Email, Username, Password) VALUES (?, ?, ?)");
            $prepared_statement->bind_param("sss", $username, $email, $password_escp);
            $prepared_statement->execute();
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: /../index.php');
        }
    }
?>