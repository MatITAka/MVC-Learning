<?php
require_once 'header.php';
require_once 'functions.php';
session_start();

$images = getImages();

if (is_string($images)) {
    // If $images is a string, it contains an error message
    echo $images;
} else {
    // If $images is not a string, it contains the results of the SQL query
    includeGalerieView($images);
}

function includeGalerieView($images) {
    require __DIR__ . '/../views/galerie.php';
}

require_once 'footer.php';
?>