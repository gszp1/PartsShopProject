<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadPath = '';

    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $imageFile = $_FILES['imageFile']['name'];
    $imageTmpName = $_FILES['imageFile']['tmp_name'];

    $destination = $uploadPath . $imageFile;

    // Move the uploaded image to the specified folder
    if (move_uploaded_file($imageTmpName, $destination)) {
        echo 'Image uploaded successfully.';
    } else {
        echo 'Error uploading image.';
    }
}