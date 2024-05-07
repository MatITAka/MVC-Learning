<?php
require_once '../functions.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Check if post ID is set
if (!isset($_POST['id'])) {
    echo "No post ID provided";
    exit();
}

// Delete the image
deleteImage($_POST['id']);

header('Location: ../views/galerie.php');
?>