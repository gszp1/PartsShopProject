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
            <div id="inputFormsBoxLP">
                <form class="formLP">
                    <label for="userEmail">E-mail:</label><br>
                    <input class="formInputLP" type="text" id="userEmail" name=email><br>
                </form>
                <form class="formLP">
                    <label for="userPassword">Password:</label><br>
                    <input class="formInputLP" type="text" id="userPassword" name=password><br>
                </form>
            </div>
            <div id="buttonsBoxLP">
                <button id="loginButtonLP">Login</button>
                <button onclick="goToPage('createAccountPage.php')" id="registerButtonLP">Register</button>
            </div>
        </div>
    </body>
</html>