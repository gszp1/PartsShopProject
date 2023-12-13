<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Account</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>
        <div id="accountCreationBoxCAP">
            <div id="greetingCAP">
                Create account
            </div>
            <form class="formCAP" action="createAccountPage.php" method="post">
                <label for="name">Username:</label><br>
                <input class="formInputCAP" type="text" id="uname" name="userName"><br>
                <label for="userEmail">E-mail:</label><br>
                <input class="formInputCAP" type="text" id="email" name="userEmail"><br>
                <label for="password">Password:</label><br>
                <input class="formInputCAP" type="text" id="password" name="userPassword"><br>
            </form>
            <div id="buttonsContainerCAP">
                <button id="createAccountButtonCAP">Create account</button>
            </div>
        </div>
    </body>
</html>
