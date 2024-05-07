<?php
session_start();
require_once '../functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image'])) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_parts = explode('.', $_FILES['image']['name']);
        $file_ext = strtolower(end($file_parts));
        $extensions = array("jpeg", "jpg", "png");

        if (empty($file_tmp) || !file_exists($file_tmp)) {
            $errors[] = 'File not found';
        } else {
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size must be less than or equal to 2 MB';
            }
        }
        if (empty($errors) == true) {
            $file_content = file_get_contents($file_tmp);

            uploadImage($file_name, $file_content);

            unset($_SESSION['upload_errors']);

            echo "Success";
            header('Location:galerie.php');
            exit;
        } else {
            $_SESSION['upload_errors'] = $errors;
            header('Location: galerie.php');
            exit;
        }
    }
}