<?php
    include("server.php");
?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login page</title>
        <link rel="stylesheet" href="../css/styles.css">
        <script src="../js/script.js"></script>
    </head>
    <body style="justify-content: center;">
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
        <?php
            include("errors.php");
        ?>
    </body>
</html>