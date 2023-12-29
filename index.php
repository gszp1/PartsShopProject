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
        <link rel="stylesheet" href="./resources/css/styles.css">
    </head>
    <body>
        <nav class="navbar" id="navbar">
            <div id="shopLogoNavbarI">Part Shop</div>
            <div id="searchbarNavbarWrapperI">
                <form id="searchBarI">
                    <input id="searchBarInputI" type="text" id="productName" name=productName><br>
                </form>
                <button id="searchButtonI">Search</button>
            </div>
            <button onclick="goToPage('./resources/php/userAccountPage.php')" id="loginButtonI">Your account</button>
            <button onclick="goToPage('./resources/php/shoppingCartPage.php')" id="shoppingCartI">Shopping cart</button>
        </nav>

        <div id="contentI">
            <ul id="productsListI">
                <?php
                    load_products_from_database();
                ?>
            </ul>
        </div>
        <script src="./resources/js/script.js"></script>
    </body>
</html>