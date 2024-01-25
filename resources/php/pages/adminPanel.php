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
            <form method="post", id="UpdateProductForm">
                <table id="productTable"></table>
                <button type="submit">Update Product</button>
            </form>
            <hr style="background-color: black; height: 2px; width: 100%; border: none;">
            <form method="post", id="createProductForm">
                <table id="createProductTable">
                    <tr><td>CategoryID</td><td><input type='text' name='AddCategoryID' value='0'></td></tr>
                    <tr><td>SupplierID</td><td><input type='text' name='AddSupplierID' value='0'></td></tr>
                    <tr><td>ManufacturerID</td><td><input type='text' name='AddManufacturerID' value='0'></td></tr>
                    <tr><td>ProductName</td><td><input type='text' name='AddProductName' value=''></td></tr>
                    <tr><td>Price</td><td><input type='text' name='AddPrice' value='0'></td></tr>
                    <tr><td>UnitsInStock</td><td><input type='text' name='AddUnitsInStock' value='0'></td></tr>
                    <tr><td>OrderedUnits</td><td><input type='text' name='AddOrderedUnits' value='0'></td></tr>
                    <tr><td>Picture</td><td><input type='text' name='AddPicture' value=''></td></tr>
                    <tr><td>Discontinued</td><td><input type='text' name='AddDiscontinued' value='0'></td></tr>
                </table>
            </form>
        </div>
        <script>
            $(document).ready(function() {
                loadOrdersTable();
                handleOrderStatusClick();
                loadProductDropdownOptions();
                loadProductInfo();
                productUpdateButtonInit();
            });
        </script>
    </body>
</html>