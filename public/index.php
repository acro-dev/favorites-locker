<?php
session_start();
$_SESSION['username'] = 'Julien';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description="Site de gestion de favoris">
    <!-- Stylesheet link -->
    <link rel="stylesheet" href="dist/css/style.min.css">
    <title>Favorites Locker</title>
</head>

<body>
    <header>
        <nav>
            <div class="brand">Favorites-Locker</div>
            <ul>
                <?php
                if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
                    echo '<li><a href="#">Dashboard</a></li>';
                    echo '<li><a href="#">Se déconnecter</a></li>';
                    echo '<li><a href="#">' . $_SESSION['username'] . '</a></li>';
                } else {
                    echo '<li><a href="#">Accueil</a></li>';
                    echo '<li><a href="#">Se connecter</a></li>';
                    echo '<li><a href="#">S\'inscire</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Favorites Locker</h1>
    </div>
    <!-- Script js -->
    <script src="dist/js/app.js"></script>
</body>

</html>