<?php
    include("functions.php");
    session_start();
    $username = "";
    $email = "";
    $errors = array();
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
        } else {
            if (validate_email($email) == false) {
                array_push($errors, "Email format is incorrect");
            }
            if ($password != $passwordConfirmation) {
                array_push($errors,"Provided passwords don't match.");
            }
        }

        $getUserFromDBQuery = "SELECT * FROM customers WHERE Username='$username' OR Email='$email' LIMIT 1";
        $queryResult = mysqli_query($dbConnection, $getUserFromDBQuery);
        $user = mysqli_fetch_assoc($queryResult);

        if($user) {
            if($user['Username'] === $username) {
                array_push($errors, "Username already taken.");
            }
            if($user['Email'] === $email) {
                array_push($errors, "Email already used.");
            }
        }
            // register user
        if (count($errors) == 0) {
            $passwordHash = md5($password);
            $preparedStatement = $dbConnection->prepare("INSERT INTO customers(Email, Username, Password) VALUES (?, ?, ?)");
            $preparedStatement->bind_param("sss", $email, $username, $passwordHash);
            $preparedStatement->execute();
            header('location: loginPage.php');
            exit();
        }
    }

    if(isset($_POST['loginUser'])) {
        $email = mysqli_real_escape_string($dbConnection, $_POST['email']);
        $password = mysqli_real_escape_string($dbConnection, $_POST['password']);

        if (empty($email) || empty($password)) {
            array_push($errors, "All fields have to be filled.");
        } elseif(validate_email($email) == false) {
            array_push($errors, "Email format is incorrect");
        }

        if (count($errors) == 0) {
            $passwordHash = md5($password);
            $query = "SELECT * FROM customers WHERE Email='$email' AND Password='$passwordHash'";
            $results = mysqli_query($dbConnection, $query);

            if (mysqli_num_rows($results) == 1) {
                $_SESSION['userID'] = mysqli_fetch_assoc($results)['CustomerID'];
                $gotoPage = '/../index.php';
                if (isset($_SESSION['previousPage']) == true) {
                    $gotoPage = $_SESSION['previousPage'];
                }
                header("Location: ". $gotoPage);
                exit();
            } else {
                $query = "SELECT * FROM admin WHERE email='$email' AND password='$passwordHash'";
                $results = mysqli_query($dbConnection, $query);
                if (mysqli_num_rows($results) == 1) {
                    header("Location: adminPanel.php");
                    exit();
                } else {
                    array_push($errors,"Provided credentials are incorrect.");
                }
            }
        }
    }
?>