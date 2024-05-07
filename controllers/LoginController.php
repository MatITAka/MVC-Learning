<?php
require 'functions.php';
require 'header.php';
session_start();

class LoginController {
    public function __construct() {

        if (isset($_GET['logout'])) {
            $this->logout();
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $login_error = login($email, $password);

            if ($login_error === null) {
                header('Location: /');
                exit;
            }
        }

        require 'views/login.php';
    }


    public function logout() {
        logout();
    }
}

require 'footer.php';

?>