<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Account</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>
        <nav class="navbarNew">
            <a id="shopLogoNavbarI" href="/../index.php">Part Shop</a>
            <div id="searchbarNavbarWrapperI">
                <form id="searchBarI">
                    <input id="searchBarInputI" type="text" id="productName" name=productName><br>
                </form>
                <button id="searchButtonI">Search</button>
            </div>
            <button onclick="goToPage('./resources/php/userAccountPage.php')" id="loginButtonI">Your account</button>
            <button onclick="goToPage('./resources/php/shoppingCartPage.php')" id="shoppingCartI">Shopping cart</button>
        </nav>
        <div class="pageContents">
            
        </div>
    </body>
</html>