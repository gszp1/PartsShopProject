// Function to load products from the server and display them
function loadProducts(userID) {
    $.ajax({
        type: 'POST',
        url: './../php/scripts/getShoppingCartProducts.php',
        data: {userID: userID},
        dataType: 'json',
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
    var cartContainer = $('#productListSCP');
    cartContainer.empty();

    products.forEach(function (product) {
        var productBox = $('<div class="productBoxSCP">');
        productBox.append('<img src=' + product.picture + 'alt="Product Image">');
        productBox.append('<span>' + product.name + '</span>');
        productBox.append('<span>Quantity: ' + product.quantity + '</span>');
        productBox.append('<span>Unit Price: $' + product.price.toFixed(2) + '</span>');
        productBox.append('<span>Total Price: $' + (product.quantity * product.price).toFixed(2) + '</span>');

        // Add a button to remove the product
        var removeButton = $('<button>');
        removeButton.text('Remove');
        removeButton.click(function () {
            removeProduct(product.id, product.userID);
        });

        productBox.append(removeButton);
        cartContainer.append(productBox);
    });
}

// Function to remove a product from the server and update the display
function removeProduct(productId, userId) {
    $.ajax({
        url: './../php/scripts/removeProductFromShoppingCart.php', // You need to create this file
        type: 'POST',
        data: { productID: productId,
                userID: userId
                },
        success: function () {
            loadProducts(userId); // Reload products after removal
        },
        error: function () {
            console.error('Error removing product');
        }
    });
}

