<?php
    session_start();
    if (isset($_SESSION["userID"]) == false) {
        $_SESSION["previousPage"] = $_SERVER["REQUEST_URI"];
        header("location: loginPage.php");
        exit();
    }
    include("./../scripts/functions.php");
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Account</title>
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
        </div>
    </body>
</html>