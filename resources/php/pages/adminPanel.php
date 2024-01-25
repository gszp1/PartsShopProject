<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
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
            <div id="ordersTableWrapper">
            <label class="adminPanelLabel">Order Status</label>
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
            </div>
            <label class="adminPanelLabel" for="productDropdown">Select a Product</label>
            <select name="productDropdown" id="productDropdown" onchange="loadProductInfo()"></select>
            <form method="post", id="UpdateProductForm">
                <table id="productTable"></table>
                <button type="submit", id="addProductButton">Update Product</button>
            </form>
            <label class="adminPanelLabel">Add Product</label>
            <form method="post", id="createProductForm">
                <table id="createProductTable">
                    <tr><td>CategoryID</td><td><input class="adminPanelInput" type='text' name='addCategoryID' value='0'></td></tr>
                    <tr><td>SupplierID</td><td><input class="adminPanelInput" type='text' name='addSupplierID' value='0'></td></tr>
                    <tr><td>ManufacturerID</td><td><input class="adminPanelInput" type='text' name='addManufacturerID' value='0'></td></tr>
                    <tr><td>ProductName</td><td><input class="adminPanelInput" type='text' name='addProductName' value=''></td></tr>
                    <tr><td>Price</td><td><input class="adminPanelInput" type='text' name='addPrice' value='0'></td></tr>
                    <tr><td>UnitsInStock</td><td><input class="adminPanelInput" type='text' name='addUnitsInStock' value='0'></td></tr>
                    <tr><td>OrderedUnits</td><td><input class="adminPanelInput" type='text' name='addOrderedUnits' value='0'></td></tr>
                    <tr><td>Picture</td><td><input class="adminPanelInput" type='text' name='addPicture' value=''></td></tr>
                    <tr><td>Discontinued</td><td><input class="adminPanelInput" type='text' name='addDiscontinued' value='0'></td></tr>
                </table>
                <button type="submit", id="addProductButton">Add product</button>
            </form>
            <label class="adminPanelLabel">Add Image</label>
            <form id="uploadImageForm" enctype="multipart/form-data">
                <label class="adminPanelLabel" for="imageFile">Select an image:</label>
                <input type="file" id="imageFile" name="imageFile" accept="image/*" required>
                <br>
                <button id="uploadImageButton" type="submit">Upload Image</button>
            </form>

        </div>
        <script>
            $(document).ready(function() {
                loadOrdersTable();
                handleOrderStatusClick();
                loadProductDropdownOptions();
                loadProductInfo();
                productUpdateButtonInit();
                addProductButtonInit();
                uploadImageFormInit();
            });
        </script>
    </body>
</html>