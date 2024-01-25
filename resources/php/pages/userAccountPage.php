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
        <title>User account</title>
        <link rel="stylesheet" href="./../../css/styles.css">
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
            <div id="accountBoxUAP">
                <div id="greetingUAP">
                    Your account
                </div>
                <div id="accountBodyBoxUAP">
                    <div id="userDataBoxWrapperUAP">
                        <div id="userDataUAP">
                            <div id="userDataHeaderUAP">
                                Contact data
                            </div>
                            <?php
                                create_user_data_list($_SESSION["userID"]);
                            ?>
                        </div>
                    </div>
                    <div id="buttonsWrapperUAP">
                        <button class="buttonUAP" id="updateDataUAP" style="background-color: #4094F5">Update data</button>
                        <button class="buttonUAP" id="ordersButtonUAP" style="background-color: #4094F5">Orders</button>
                        <button onclick="goToPage('./../misc/sessionDestructor.php')" class="buttonUAP" id="logoutButtonUAP" style="background-color: #F07014">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>