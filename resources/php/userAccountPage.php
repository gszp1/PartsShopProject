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
                    <button id="ordersButtonUAP">Orders</button>
                    <button id="returnsButtonUAP">Returns</button>
                </div>
            </div>
        </div>
    </body>
</html>