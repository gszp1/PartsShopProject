function goToPage(pageName) {
    var url = pageName;
    window.location.href=url;
}

function addToCart(productID, customerID, quantity, price) {
    // Send AJAX request to add product to the shopping cart
    $.ajax({
        type: 'POST',
        url: './../resources/php/scripts/addToCart.php',
        data: { productID: productID,
                customerID: customerID,
                quantity: quantity,
                price: price
            },
        success: function(response) {
            // Handle the response from the server if needed
            alert(response);
        },
        error: function(error) {
            // Handle the error if needed
            alert(error);
        }
    });
}

function loadProducts(userId) {
    console.log("load:");
    console.log(userId);
    $.ajax({
        type: 'POST',
        url: './../scripts/getShoppingCartProducts.php',
        data: { userID: userId },
        success: function (data) {
            displayProducts(data);
        },
        error: function () {
            console.error('Error loading products');
        }
    });
}

// Function to display products in the HTML
function displayProducts(products) {
    console.log(products);
    var data;
    try {
        data = JSON.parse(products);
    } catch (error) {
        console.error("Error parsing JSON:", error);
        return;
    }

    var totalCost = 0;

    var cartContainer = $('#productListSCP');
    var statusBar = $('#statusBarSCP');

    cartContainer.empty();
    statusBar.empty();

    var userID = 0;
    var flag = 0;

    data.forEach(function (product) {
        var productBox = $('<div class="productBoxSCP">');
        var picturePath = "./../../.." + product.picture;
        var quantity = parseFloat(product.quantity);
        var price = parseFloat(product.price);

        totalCost += price * quantity;
        var imageContainer = $('<div class="imageContainerSCP">');
        var productImage = $('<img>');
        productImage.attr('src', picturePath);
        productImage.attr('alt', 'Product Image');
        imageContainer.append(productImage);

        productBox.append(imageContainer);
        productBox.append('<span>' + product.productName + '</span>');
        productBox.append('<span>Quantity: ' + quantity + '</span>');
        productBox.append('<span>Unit Price: $' + price.toFixed(2) + '</span>');
        productBox.append('<span>Total Price: $' + (quantity * price).toFixed(2) + '</span>');

        if (flag == 0) {
            userID = parseInt(product.userID);
            flag = 1;
        }

        // Add a button to remove the product
        var removeButton = $('<button class="RemoveButtonSCP">');
        removeButton.text('Remove');
        removeButton.click(function () {
            var pID = parseInt(product.productID);
            var uID = parseInt(product.userID);
            removeProduct(pID, uID);
        });

        productBox.append(removeButton);
        cartContainer.append(productBox);
    });

    var totalCostBar = $('<div id="totalCostBar">');
    totalCostBar.text('Total Cost: $' + totalCost.toFixed(2));
    var createOrderButton = $('<button id="createOrderButton">');
    createOrderButton.text('Create Order');
    createOrderButton.click(function () {
        // Call a function to handle order creation
        console.log('Placing order.');
        console.log(userID);
        addOrder(userID);
    });

    var clearCartButton = $('<button id="clearCartButton">');
    clearCartButton.text('Clear Cart');
    clearCartButton.click(function () {
        // Call a function to handle order creation
        clearCart(userID);
    });
    statusBar.append(totalCostBar);
    statusBar.append(createOrderButton);
    statusBar.append(clearCartButton);
}

// Function to remove a product from the server and update the display
function removeProduct(productId, userId) {
    $.ajax({
        type: 'POST',
        url: './../scripts/removeProductFromShoppingCart.php',
        data: { productID: productId,
                userID: userId
                },
        success: function () {
            console.log(userId);
            loadProducts(userId);
        },
        error: function () {
            console.error('Error removing product');
        }
    });
}

// Function to add order using products from shopping cart
function addOrder(userId) {
    $.ajax({
        type: 'POST',
        url: './../scripts/createOrder.php',
        data: {
            userID: userId
        },
        success: function() {
            clearCart(userId);
        },
        error: function() {
            console.error('Error placing order.');
        }
    });
}

function clearCart(userId) {
    $.ajax({
        type: 'POST',
        url: './../scripts/clearShoppingCart.php',
        data: {
            userID: userId
        },
        success: function() {
            loadProducts(userId);
        },
        error: function() {
            console.error('Error clearing cart.');
        }
    });
}

function loadOrdersTable() {
    $.ajax({
        url: './../scripts/getOrdersData.php',
        type: 'POST',
        success: function(response) {
            $('#OrdersTableBody').html(response);
            $('#OrdersTableBody td[data-type="orderStatus"]:not(.editing)').each(function() {
                initializeDropdown($(this));
            });
        }
    });
}

function updateOrderStatus(orderId, newStatus) {
    $.ajax({
        url: './../scripts/updateOrderStatus.php',
        type: 'POST',
        data: {
            orderID : orderId,
            status : newStatus
        },
        success: function(response) {
            loadOrdersTable();
        }
    });
}

function initializeDropdown(cell) {
    let currentStatus = cell.text();
    let dropdown = '<select class="statusDropdown">';
    dropdown += '<option value="0">Not Accepted</option>';
    dropdown += '<option value="1">Accepted</option>';
    dropdown += '<option value="2">Archived</option>';
    dropdown += '</select>';

    // Set the current status as selected in the dropdown
    dropdown = dropdown.replace('value="' + currentStatus + '"', 'value="' + currentStatus + '" selected');

    // Update the content of the cell
    cell.html(dropdown).addClass('editing');
}

function handleOrderStatusClick() {
    // Handle click events on OrderStatus cells
    $('#OrdersTableBody').on('change', '.statusDropdown', function() {
        let orderId = $(this).closest('tr').find('td[data-type="orderId"]').text();
        let newStatus = $(this).val();

        // Update the database with the new OrderStatus
        updateOrderStatus(orderId, newStatus);

        // Reload the data after successful update
        loadOrdersTable();
    });
}

function loadProductDropdownOptions() {
    $.ajax({
        url: './../scripts/loadProductsNames.php',
        type: 'POST',
        success: function(response) {
            $('#productDropdown').html(response);
        }
    });
}

function loadProductInfo() {
    var productId = $("#productDropdown").val();
    $.ajax({
        url: './../scripts/getProductInfo.php',
        type: 'POST',
        data: { productId : productId },
        success: function(response) {
            $('#productTable').html(response);
        }
    });
}

function updateProductInformation() {
    var productId = $("#productDropdown").val();
    var categoryId = $("input[name='CategoryID']").val();
    var supplierId = $("input[name='SupplierID']").val();
    var manufacturerId = $("input[name='ManufacturerID']").val();
    var pName = $("input[name='ProductName']").val();
    var price = $("input[name='Price']").val();
    var unitsInStock = $("input[name='UnitsInStock']").val();
    var orderedUnits = $("input[name='OrderedUnits']").val();
    var picture = $("input[name='Picture']").val();
    var discontinued = $("input[name='Discontinued']").val();

    $.ajax({
        url: './../scripts/updateProductInfo.php',
        type: 'POST',
        data: {
            productID: productId,
            categoryID: categoryId,
            supplierID: supplierId,
            manufacturerID: manufacturerId,
            productName: pName,
            productPrice: price,
            unitsInStock: unitsInStock,
            orderedUnits: orderedUnits,
            picture: picture,
            discontinued: discontinued
        },
        success: function() {
            loadProductDropdownOptions();
        }
    });
}

function productUpdateButtonInit() {
    $('#UpdateProductForm').submit(function(event) {
        event.preventDefault();
        updateProductInformation();
    });
}

function addProduct() {
    var categoryId = $("input[name='addCategoryID']").val();
    var supplierId = $("input[name='addSupplierID']").val();
    var manufacturerId = $("input[name='addManufacturerID']").val();
    var pName = $("input[name='addProductName']").val();
    var price = $("input[name='addPrice']").val();
    var unitsInStock = $("input[name='addUnitsInStock']").val();
    var orderedUnits = $("input[name='addOrderedUnits']").val();
    var picture = $("input[name='addPicture']").val();
    var discontinued = $("input[name='addDiscontinued']").val();

    $.ajax({
        url: './../scripts/addProduct.php',
        type: 'POST',
        data: {
            categoryID: categoryId,
            supplierID: supplierId,
            manufacturerID: manufacturerId,
            productName: pName,
            productPrice: price,
            unitsInStock: unitsInStock,
            orderedUnits: orderedUnits,
            picture: picture,
            discontinued: discontinued
        },
        success: function() {
            loadProductDropdownOptions();
            addProductFieldsClean()
        },
        error: function() {
            addProductFieldsClean();
        }
    });
}

function addProductButtonInit() {
    $('#createProductForm').submit(function(event) {
        event.preventDefault();
        addProduct();
    });
}

function addProductFieldsClean() {
    $("input[name='addCategoryID']").val('0');
    $("input[name='addSupplierID']").val('0');
    $("input[name='addManufacturerID']").val('0');
    $("input[name='addProductName']").val('');
    $("input[name='addPrice']").val('0');
    $("input[name='addUnitsInStock']").val('0');
    $("input[name='addOrderedUnits']").val('0');
    $("input[name='addPicture']").val('');
    $("input[name='addDiscontinued']").val('0');
}

function uploadImage() {
    var formData = new FormData($('#uploadImageForm')[0]);
    $.ajax({
        url: 'uploadImage.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log('Image uploaded successfully:', response);
            $('#uploadImageForm')[0].reset();
        },
        error: function(error) {
            console.error('Error uploading image:', error);
        }
    });
}