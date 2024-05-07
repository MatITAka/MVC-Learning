<?php
require '../header.php';
require_once '../functions.php';
session_start();

$id = $_GET['id'];
$member = getMember($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['name'];
    $newAge = $_POST['age'];
    $newCity = $_POST['city'];
    updateMember($id, $newName, $newAge, $newCity);

    // Redirect back to index.php
    redirectToController('HomeController', 'index');
    exit();
}

function includeEditView($member) {
    require '../views/edit.php';

}

includeEditView($member);

require '../footer.php';
?>