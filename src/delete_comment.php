
<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: galerie.php');
    exit; // Ensure no further output is sent
}

try {
    $dbPath = __DIR__ . '/../data/data2.db';
    $pdo = new PDO('sqlite:' . $dbPath);

    $comment_id = $_POST['comment_id']; // Get the comment ID from the POST data

    // Delete the comment from the database
    $query = $pdo->prepare("DELETE FROM comments WHERE id = ?");
    $query->execute([$comment_id]);
} catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
}

header('Location: galerie.php');
exit; // Ensure no further output is sent

?>