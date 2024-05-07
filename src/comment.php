<?php

session_start();

try {
    $dbPath = __DIR__ . '/../data/data2.db';
    $pdo = new PDO('sqlite:' . $dbPath);

    $session_id = session_id(); // Get the session ID
    $image_id = $_POST['id']; // Get the image ID from the POST data
    $comment = $_POST['comment']; // Get the comment from the POST data

    // Insert a new comment into the database
    $query = $pdo->prepare("INSERT INTO comments (session_id, image_id, comment) VALUES (?, ?, ?)");
    $query->execute([$session_id, $image_id, $comment]);
} catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
}

header('Location: galerie.php');
exit; // Ensure no further output is sent

?>