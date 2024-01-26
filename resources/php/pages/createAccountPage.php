<?php
    include("./../scripts/server.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Account</title>
        <link rel="stylesheet" href="./../../css/styles.css">
    </head>
    <body>
        <nav class="navbarNew">
            <a id="shopLogoNavbarI" href="./../../../index.php">Part Shop</a>
            <div id="searchbarNavbarWrapperI"></div>
            <button onclick="goToPage('userAccountPage.php')" id="loginButtonI">Your account</button>
            <button onclick="goToPage('shoppingCartPage.php')" id="shoppingCartI">Shopping cart</button>
        </nav>
        <div class="pageContents">
            <div id="accountCreationBoxCAP">
                <div id="greetingCAP">
                    Create account
                </div>
                <form class="formCAP" action="createAccountPage.php" method="post">
                    <label>Username:</label><br>
                    <input class="formInputCAP" type="text" id="uname" name="username"><br>
                    <label>E-mail:</label><br>
                    <input class="formInputCAP" type="text" id="email" name="userEmail"><br>
                    <label>Password:</label><br>
                    <input class="formInputCAP" type="password" id="password" name="password"><br>
                    <label>Confirm password:</label><br>
                    <input class="formInputCAP" type="password" id="passwordConfirm" name="passwordConfirmation"><br>
                    <button type="submit" id="createAccountButtonCAP" name="registerUser">Create account</button>
                </form>
            </div>
        </div>
        <?php
            include('./../misc/errors.php');
        ?>
    </body>
</html>
