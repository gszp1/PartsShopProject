<?php
    include("./../scripts/server.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login page</title>
        <link rel="stylesheet" href="/resources/css/styles.css">
        <script src="./../../js/script.js"></script>
    </head>
    <body>
        <nav class="navbarNew">
            <a id="shopLogoNavbarI" href="./../../../index.php">Part Shop</a>
            <div id="searchbarNavbarWrapperI"></div>
            <button onclick="goToPage('userAccountPage.php')" id="loginButtonI">Your account</button>
            <button onclick="goToPage('shoppingCartPage.php')" id="shoppingCartI">Shopping cart</button>
        </nav>
        <div class="pageContents">
            <div id="loginBoxLP">
                <div id="greetingLP">
                    Login
                </div>
                <form method="post" class="formLP" action="loginPage.php">
                    <label for="userEmail">E-mail:</label><br>
                    <input class="formInputLP" type="text" id="userEmail" name=email><br>
                    <label for="userPassword">Password:</label><br>
                    <input class="formInputLP" type="password" id="userPassword" name=password><br>
                    <div id="buttonsBoxLP">
                        <button type="submit" id="loginButtonLP" name="loginUser">Login</button>
                        <button type="button" onclick="goToPage('createAccountPage.php')" id="registerButtonLP">Register</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
            include("./../misc/errors.php");
        ?>
    </body>
</html>