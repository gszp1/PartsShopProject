$(document).ready(function () {
    // Function to load products from the server and display them
    function loadProducts() {
        $.ajax({
            url: 'get_products.php',
            type: 'GET',
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
        var cartContainer = $('#cart-container');
        cartContainer.empty();

        products.forEach(function (product) {
            var productBox = $('<div class="product-box">');
            productBox.append('<img src="product_image.jpg" alt="Product Image">');
            productBox.append('<span>' + product.name + '</span>');
            productBox.append('<span>Quantity: ' + product.quantity + '</span>');
            productBox.append('<span>Unit Price: $' + product.price.toFixed(2) + '</span>');
            productBox.append('<span>Total Price: $' + (product.quantity * product.price).toFixed(2) + '</span>');
            
            // Add a button to remove the product
            var removeButton = $('<button>');
            removeButton.text('Remove');
            removeButton.click(function () {
                removeProduct(product.id);
            });

            productBox.append(removeButton);
            cartContainer.append(productBox);
        });
    }

    // Function to remove a product from the server and update the display
    function removeProduct(productId) {
        $.ajax({
            url: 'remove_product.php', // You need to create this file
            type: 'POST',
            data: { id: productId },
            success: function () {
                loadProducts(); // Reload products after removal
            },
            error: function () {
                console.error('Error removing product');
            }
        });
    }

    // Initial load of products
    loadProducts();
});
