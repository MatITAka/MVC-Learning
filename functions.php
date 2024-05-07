<?php

session_start();

function redirectTo($page) {
    header('Location: /views/' . $page . '.php');
    exit();
}

function redirectToController($controller, $method) {
    header('Location: /controllers/' . $controller . '.php?action=' . $method);
    exit();
}
function getImages() {
    try {
        $dbPath = __DIR__ . '/data/data2.db';
        $db = new PDO('sqlite:' . $dbPath);

        // Get all images
        $images = $db->query("SELECT * FROM images")->fetchAll(PDO::FETCH_ASSOC);

        // For each image, get the likes and comments
        foreach ($images as $key => $image) {
            $image_id = $image['id'];



            // Get likes
            $likes = $db->prepare("SELECT COUNT(*) as count FROM likes WHERE image_id = ?");
            $likes->execute([$image_id]);
            $images[$key]['likes'] = $likes->fetch(PDO::FETCH_ASSOC)['count'];

            // Get comments
            $comments = $db->prepare("SELECT * FROM comments WHERE image_id = ?");
            $comments->execute([$image_id]);
            $images[$key]['comments'] = $comments->fetchAll(PDO::FETCH_ASSOC);
        }

        return $images;
    } catch (PDOException $e) {
        echo "PDO Exception: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
    }
}

function uploadImage($file_name, $file_content) {

    if (!isset($_SESSION['user'])) {
        echo "Vous devez être connecté pour ajouter une image.";
        return;
    }

    try {
        $dbPath = __DIR__ . '/data/data2.db';
        $db = new PDO('sqlite:' . $dbPath);
        $stmt = $db->prepare("INSERT INTO images (name, content) VALUES (:name, :content)");
        $stmt->bindParam(':name', $file_name);
        $stmt->bindParam(':content', $file_content, PDO::PARAM_LOB);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "PDO Exception: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
    }
}


function displayMembers() {
    if (isset($_SESSION['name']) && isset($_SESSION['age']) && isset($_SESSION['city'])) {
        for ($i = 0; $i < count($_SESSION['name']); $i++) {
            echo "<tr>";
            echo "<td>" . $_SESSION['name'][$i] . "</td>";
            echo "<td>" . $_SESSION['age'][$i] . "</td>";
            echo "<td>" . $_SESSION['city'][$i] . "</td>";
            echo "<td>";
            if (isset($_SESSION['user'])) {
                echo "<div class='d-flex justify-content-center'>";
                echo "<form action='data/data.php' method='post' class='mr-2'>";
                echo "<input type='hidden' name='delete_index' value='$i'>";
                echo "<button type='submit' class='btn btn-danger btn-sm'>Supprimer</button>";
                echo "</form>";
                echo "<a href='views/edit.php?id=$i' class='btn btn-primary btn-sm'>Modifier</a>";
                echo "</div>";
            }
            echo "</td>";
            echo "</tr>";
        }
    }
}

function deleteImage($id) {
    try {
        $dbPath = __DIR__ . '/data/data2.db';
        $db = new PDO('sqlite:' . $dbPath);
        $stmt = $db->prepare("DELETE FROM images WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
    }
}

function getMember($id) {
    if (isset($_SESSION['name'][$id]) && isset($_SESSION['age'][$id]) && isset($_SESSION['city'][$id])) {
        return array(
            'name' => $_SESSION['name'][$id],
            'age' => $_SESSION['age'][$id],
            'city' => $_SESSION['city'][$id]
        );
    }
    return null;
}

function updateMember($id, $newName, $newAge, $newCity) {
    if (isset($_SESSION['name'][$id]) && isset($_SESSION['age'][$id]) && isset($_SESSION['city'][$id])) {
        $_SESSION['name'][$id] = $newName;
        $_SESSION['age'][$id] = $newAge;
        $_SESSION['city'][$id] = $newCity;
    }
}

function deleteMember()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_index'])) {
        if (!isset($_SESSION['user'])) {
            redirectTo('login');
        }

        $index = $_POST['delete_index'];

        if (isset($_SESSION['name'][$index]) && isset($_SESSION['age'][$index]) && isset($_SESSION['city'][$index])) {
            array_splice($_SESSION['name'], $index, 1);
            array_splice($_SESSION['age'], $index, 1);
            array_splice($_SESSION['city'], $index, 1);

            $_SESSION['message'] = "Le membre a été supprimé avec succès";
        }

        redirectToController('HomeController', 'index');
    }
}

function addMember()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['age']) && isset($_POST['city'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $city = $_POST['city'];

        if (!is_array($_SESSION['name'])) {
            $_SESSION['name'] = array();
        }
        if (!is_array($_SESSION['age'])) {
            $_SESSION['age'] = array();
        }
        if (!is_array($_SESSION['city'])) {
            $_SESSION['city'] = array();
        }

        array_push($_SESSION['name'], $name);
        array_push($_SESSION['age'], $age);
        array_push($_SESSION['city'], $city);

        $_SESSION['message'] = "Merci de vous être inscrit";

        redirectToController('HomeController', 'index');
    }
}

function login() {
    $reference_email = 'guinet@derriaz.com';
    $reference_password_hash = password_hash('password', PASSWORD_DEFAULT);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email == $reference_email && password_verify($password, $reference_password_hash)) {
            $_SESSION['user'] = array(
                'email' => $email,
                'password' => $reference_password_hash
            );

            redirectTo('index');
        } else {
            $_SESSION['login_error'] = 'Invalid email or password';
            redirectToController('login', 'login');
        }
    }
}

function logout() {
    session_destroy();
    redirectToController('HomeController', 'index');
}



?>