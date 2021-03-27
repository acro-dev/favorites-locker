<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "Vous n'étes pas connecter, redirection....";
    header('Location: /');
}

require '../templates/header.php';

echo "Bienvenue " . $_SESSION['username'];

require '../templates/footer.php';
