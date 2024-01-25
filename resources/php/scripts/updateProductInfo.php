<?php

include("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // connect with database.
    $dbConnection = connect_with_database();
    if ($dbConnection === null) {
        exit("Database connection failure.");
    }
    
}