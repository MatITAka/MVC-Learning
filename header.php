<?php
session_start();

function getActiveClass($currentPage) {
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == $currentPage ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mon Site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<div class="navbar navbar-expand-md navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= getActiveClass('/') ?>">
                <a class="nav-link" href="/">Accueil</a>
            </li>
            <li class="nav-item <?= getActiveClass('/about') ?>">
                <a class="nav-link" href="/about">A propos</a>
            </li>
            <li class="nav-item <?= getActiveClass('/contact') ?>">
                <a class="nav-link" href="/contact">Inscription</a>
            </li>
            <li class="nav-item <?= getActiveClass('/galerie') ?>">
                <a class="nav-link" href="/galerie">Galerie</a>
            </li>

            <li class="nav-item <?= getActiveClass('/login') ?>">
                <?php if (isset($_SESSION['user'])): ?>
                    <a class="nav-link" href="/logout">Logout</a>
                <?php else: ?>
                    <a class="nav-link" href="/login">Login</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</div>