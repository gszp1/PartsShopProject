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
    $.ajax({
        type: 'POST',
        url: './../../php/scripts/getShoppingCartProducts.php',
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
    var data;
    try {
        data = JSON.parse(products);
    } catch (error) {
        console.error("Error parsing JSON:", error);
        return;
    }
    var cartContainer = $('#productListSCP');
    cartContainer.empty();

    data.forEach(function (product) {
        var productBox = $('<div class="productBoxSCP">');
        var picturePath = "./../../.." + product.picture;
        var quantity = parseFloat(product.quantity);
        var price = parseFloat(product.price);
        productBox.append('<img src=' + picturePath + ' alt="Product Image">');
        productBox.append('<span>' + product.name + '</span>');
        productBox.append('<span>Quantity: ' + quantity + '</span>');
        productBox.append('<span>Unit Price: $' + price.toFixed(2) + '</span>');
        productBox.append('<span>Total Price: $' + (quantity * price).toFixed(2) + '</span>');

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