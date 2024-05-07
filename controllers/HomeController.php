<?php

require_once 'functions.php';

class HomeController {
    public function index() {
        session_start();
        require 'header.php';

        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);

        // Call the deleteMember and addMember functions if necessary
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['delete_index'])) {
                deleteMember();
            } elseif (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['city'])) {
                addMember();
            }
        }

        require 'views/home.php';

        require 'footer.php';
    }
}

?>