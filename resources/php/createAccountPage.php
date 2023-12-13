<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Account</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>
    <?php
        require('dbConnection.php');
        if (isset($_REQUEST['userName'])) {
            $username = stripslashes($_REQUEST['userName']);
            //escapes special characters in a string
            $username = mysqli_real_escape_string($connection, $username);
            $email    = stripslashes($_REQUEST['Email']);
            $email    = mysqli_real_escape_string($connection, $email);
            $password = stripslashes($_REQUEST['Password']);
            $password = mysqli_real_escape_string($connection, $password);
            $query    = "INSERT into `customers` (username, password, email)
                                         VALUES ('$username', '" . md5($password) . "', '$email'";
            $result   = mysqli_query($connection, $query);
            if ($result) {
                echo "<div>
                      <h3>You are registered successfully.</h3><br/>
                      <p class='link'>Click here to <a href='loginPage.php'>Login</a></p>
                      </div>";
            } else {
                echo "<div>
                      <h3>You are registered successfully.</h3><br/>
                      <p class='link'>Click here to <a href='createAccountPage.php'>Register</a></p>
                      </div>";
            }
        } else {
        ?>
            <div id="accountCreationBoxCAP">
                <div id="greetingCAP">
                    Create account
                </div>
                <form class="formCAP" action="" method="post">
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
        <?php
        }
        ?>
    </body>
</html>
