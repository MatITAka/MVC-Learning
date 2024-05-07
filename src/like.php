<?php

session_start();

try {
    $dbPath = __DIR__ . '/../data/data2.db';
    $pdo = new PDO('sqlite:' . $dbPath);

    $session_id = session_id(); // Get the session ID
    $image_id = $_POST['id']; // Get the image ID from the POST data

    // Insert a new like into the database
    $query = $pdo->prepare("INSERT INTO likes (session_id, image_id) VALUES (?, ?)");
    $query->execute([$session_id, $image_id]);
} catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
}

header('Location: ../views/galerie.php');
exit; // Ensure no further output is sent

?>