<?php
    session_start();
    // if user is not logged in redirect to loginPage.php
    if (isset($_SESSION["userID"]) == false) {
        header("location: loginPage.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User account</title>
        <link rel="stylesheet" href="../css/styles.css">

    </head>
    <body style="align-items:center; justify-content: center;">
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
                        <div id="dataUAP"></div>
                    </div>
                </div>
                <div id="buttonsWrapperUAP">
                    <button class="buttonUAP" id="updateDataUAP" style="background-color: #4094F5">Update data</button>
                    <button class="buttonUAP" id="ordersButtonUAP" style="background-color: #4094F5">Orders</button>
                    <button class="buttonUAP" id="returnsButtonUAP" style="background-color: #4094F5">Returns</button>
                    <button onclick="goToPage('sessionDestructor.php')" class="buttonUAP" id="logoutButtonUAP" style="background-color: #F07014">Logout</button>
                </div>
            </div>
        </div>
        <script src="../js/script.js"></script>
    </body>
</html>