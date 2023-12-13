<!DOCTYPE html>
<html lang="en">
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PartShop</title>
        <link rel="stylesheet" href="./resources/css/styles.css">
    </head>
    <body>
        <nav class="navbar" id="navbar">
            <div id="shopLogoNavbarI">Part Shop</div>
            <div id="searchbarNavbarWrapperI">
                <form id="searchBarI">
                    <input id="searchBarInputI" type="text" id="productName" name=productName><br>
                </form>
                <button id="searchButtonI">Search</button>
            </div>
            <button onclick="goToPage('./resources/php/loginPage.php')" id="loginButtonI">Your account</button>
            <button onclick="goToPage('./resources/php/shoppingCartPage.php')" id="shoppingCartI">Shopping cart</button>
        </nav>

        <div id="contentI">
            <ul id="productsListI">
                <?php
                    $connection = mysqli_connect('localhost','dbclient', 'ar0220','partshopdb');
                    if (!$connection) {
                        echo 'Connection error: ' . mysqli_connect_error();
                    }
                    $query = "SELECT products.*, manufacturers.ManufacturerName FROM products JOIN manufacturers ON
                              products.ManufacturerID = manufacturers.ManufacturerID;";
                    $products = $connection->query($query);
                    if ($products->num_rows > 0) {
                        while($row = $products->fetch_assoc()) {
                            $pic = $row["Picture"];
                            echo "<li class='listItemI'>".
                                "<div class='imageContainerI'>".
                                "<img src=\"$pic\" alt=''></div>".
                                "<div class='dataContainerI'>".
                                "<ul><li>"."Name:  ". $row["ProductName"]."</li>".
                                "<li>"."Manufacturer:  ". $row["ManufacturerName"]."</li>".
                                "<li>"."Price:  ". $row["Price"]." PLN"."</li></ul></div>".
                                "<div class='buttonContainerI'>".
                                "<button class='shoppingCartButtonItemI'>add to shopping cart</button></div></li>";
                        }
                    } else {
                        echo "0 results";
                    }
                ?>
            </ul>
        </div>
        <script src="./resources/js/script.js"></script>
    </body>
</html>