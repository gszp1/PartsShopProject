<?php
    $connection = mysqli_connect('localhost',
        'dbclient',
        'ar0220',
        'partshopdb'
    );
    if (!$connection) {
        echo 'Connection error: ' . mysqli_connect_error();
    }
?>