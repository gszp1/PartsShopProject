<?php
    include("./resources/php/functions.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PartShop</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="./resources/js/script.js"></script>
        <link rel="stylesheet" href="./resources/css/styles.css">
    </head>
    <body>
        <nav class="navbarNew">
            <a id="shopLogoNavbarI" href="index.php">Part Shop</a>
            <div id="searchbarNavbarWrapperI">
                <form id="searchBarI">
                    <input id="searchBarInputI" type="text" name=productName><br>
                </form>
                <button id="searchButtonI">Search</button>
            </div>
            <button onclick="goToPage('./resources/php/userAccountPage.php')" id="loginButtonI">Your account</button>
            <button onclick="goToPage('./resources/php/shoppingCartPage.php')" id="shoppingCartI">Shopping cart</button>
        </nav>
        <div class="pageContents">
            <ul id="productsListI">
                <?php
                    load_products_from_database();
                ?>
            </ul>
        </div>
    </body>
</html>