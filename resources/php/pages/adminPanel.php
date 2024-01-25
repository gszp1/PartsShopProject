<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Account</title>
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
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Client ID</th>
                        <th>Client Email</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody id="OrdersTableBody"></tbody>
            </table>
            <hr style="background-color: black; height: 2px; width: 100%; border: none;">
            <label for="productDropdown">Select a Product:</label>
            <select name="productDropdown" id="productDropdown" onchange="loadProductInfo()"></select>
            <table id="productTable"></table>
        </div>
        <script>
            $(document).ready(function() {
                loadOrdersTable();
                handleOrderStatusClick();
                loadProductDropdownOptions()
            });
        </script>
    </body>
</html>