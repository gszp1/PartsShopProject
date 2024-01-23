function goToPage(pageName) {
    var url = pageName;
    window.location.href=url;
}

function addToCart(productID, customerID, quantity, price) {
    // Send AJAX request to add product to the shopping cart
    $.ajax({
        type: 'POST',
        url: '/resources/php/scripts/add_to_cart.php',
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

function fetchProductsFromShoppingCart() {
    $.ajax({
        url: 'products.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            displayProducts(data);
        },
        error: function () {
            console.error('Error fetching product data');
        }
    });
}