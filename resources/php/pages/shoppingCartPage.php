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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script type="text/javascript" src="./../../js/script.js"></script>
    </head>
    <body>
        <nav class="navbarNew">
            <a id="shopLogoNavbarI" href="./../../../index.php">Part Shop</a>
            <div id="searchbarNavbarWrapperI">
                <form id="searchBarI">
                    <input id="searchBarInputI" type="text" id="productName" name=productName><br>
                </form>
                <button id="searchButtonI">Search</button>
            </div>
            <button onclick="goToPage('userAccountPage.php')" id="loginButtonI">Your account</button>
            <button onclick="goToPage('shoppingCartPage.php')" id="shoppingCartI">Shopping cart</button>
        </nav>
        <div class="pageContents">
            <div id="productListSCP"></div>
            <div id="statusBarSCP"></div>
        </div>
        <?php
            $uID = $_SESSION['userID'];
            echo '<script>';
            echo "var userID = '$uID';";
            echo 'loadProducts(userID);';
            echo '</script>';
        ?>
    </body>
</html>