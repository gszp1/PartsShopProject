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

        $getUserFromDBQuery = "SELECT * FROM customers WHERE Username='$username' OR Email='$email' LIMIT 1";
        $queryResult = mysqli_query($dbConnection, $getUserFromDBQuery);
        $user = mysqli_fetch_assoc($queryResult);

        if($user) {
            echo"$user";
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
            $prepared_statement->bind_param("sss", $email, $username, $password_escp);
            $prepared_statement->execute();
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: /../index.php');
        }
    }

    if(isset($_POST['loginUser'])) {
        $email = mysqli_real_escape_string($dbConnection, $_POST['email']);
        $password = mysqli_real_escape_string($dbConnection, $_POST['password']);
        
        if (empty($email) || empty($password)) {
            array_push($errors, "All field have to be filled.");
        }

        if (count($errors) == 0) {
            $password_escp = md5($password);
            $query = "SELECT * FROM customers WHERE Email='$email' AND Password='$password'";
            $results = mysqli_query($dbConnection, $query);
            
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['email'] = $email;
                $_SESSION['username'] = mysqli_fetch_assoc($results)['Username'];
                $_SESSION['success'] = "You are now logged in";
                header("location: /../index.php");
            } else {
                array_push($errors,"Provided credentials are incorrect.");
            }
        }
    }
?>