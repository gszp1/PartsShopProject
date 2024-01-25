<?php
    session_start();
    if (isset($_SESSION["userID"]) == false) {
        $_SESSION["previousPage"] = $_SERVER["REQUEST_URI"];
        header("location: loginPage.php");
        exit();
    }
    include("./../scripts/functions.php");

    $userID = $_SESSION["userID"];
    $userData = get_full_user_data($userID);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['Username'];
        $surname = $_POST['Surname'];
        $name = $_POST['Name'];
        $phoneNumber = $_POST['PhoneNumber'];
        if (validatePhoneNumber($phoneNumber)) {
            if (updateUserData($userID, $username, $surname, $name, $phoneNumber) === true) {
                header("location: userAccountPage.php");
                exit();
            } else {
                echo "Failed to update credentials.";
            }
        } else {
            echo "Invalid phone number. Please enter a valid 9-digit phone number.";
        }
    }
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update User Data</title>
        <link rel="stylesheet" href="./../../css/styles.css">
        <script type="text/javascript" src="./../../js/script.js"></script>
    </head>
    <body>
        <nav class="navbarNew">
            <a id="shopLogoNavbarI" href="./../../../index.php">Part Shop</a>
            <div id="searchbarNavbarWrapperI"></div>
            <button onclick="goToPage('userAccountPage.php')" id="loginButtonI">Your account</button>
            <button onclick="goToPage('shoppingCartPage.php')" id="shoppingCartI">Shopping cart</button>
        </nav>
        <div class="pageContents">
            <div id="mainBodyUDP">
                <div id="greetingUDP">
                    Update User Data
                </div>
                <form id="formUDP" method="post">
                    <label class="labelUDP">Username:</label><br>
                    <input class="formInputUDP" type="text" id="Username" name="Username" value="<?php echo isset($userData['Username']) ? htmlspecialchars($userData['Username']) : ''; ?>"><br>
                    <label class="labelUDP">Surname:</label><br>
                    <input class="formInputUDP" type="text" id="Surname" name="Surname" value="<?php echo isset($userData['Surname']) ? htmlspecialchars($userData['Surname']) : ''; ?>"><br>
                    <label class="labelUDP">Name:</label><br>
                    <input class="formInputUDP" type="text" id="Name" name="Name" value="<?php echo isset($userData['Name']) ? htmlspecialchars($userData['Name']) : ''; ?>"><br>
                    <label class="labelUDP">PhoneNumber:</label><br>
                    <input class="formInputUDP" type="text" id="PhoneNumber" name="PhoneNumber" value="<?php echo isset($userData['PhoneNumber']) ? htmlspecialchars($userData['PhoneNumber']) : ''; ?>"><br>
                    <button id="updateUserButtonUDP" type="submit">Update</button>
                </form>
            </div>
        </div>
    </body>
</html>