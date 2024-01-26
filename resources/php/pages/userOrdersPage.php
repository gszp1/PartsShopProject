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
        <title>Order details</title>
        <link rel="stylesheet" href="./../../css/styles.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
            <div id="orderIdSelectionBoxUOP">
                <label class="labelUOP" for="orderDropdown">Select order</label>
                <select name="orderDropdown" id="orderDropdown" onchange=""></select>
            </div>

            <div id="orderDetailsUOP">
            </div>
        </div>
    <?php
        $uID = $_SESSION['userID'];
        echo '<script>';
        echo "var userID = '$uID';";
        echo 'loadOrderDropdown(userID)';
        echo '</script>';
    ?>
    </body>
</html>