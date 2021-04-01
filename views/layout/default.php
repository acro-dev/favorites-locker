<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description="Site de gestion de favoris">
    <!-- Stylesheet link -->
    <link rel="stylesheet" href="/dist/css/style.min.css">
    <title>Favorites Locker</title>
</head>

<body>
    <header>
        <div class="brand">Favorites-Locker</div>
        <nav>
            <ul>
                <?php
                if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
                    echo '<li><a href="/dashboard">Dashboard</a></li>';
                    echo '<li><a href="/users/logout">Se déconnecter</a></li>';
                    echo '<li><a href="/dashboard/profile/' . $_SESSION['userID'] . '">' . $_SESSION['username'] . '</a></li>';
                } else {
                    echo '<li><a href="/">Accueil</a></li>';
                    echo '<li><a href="/users/login">Se connecter</a></li>';
                    echo '<li><a href="/users/signup">S\'inscire</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    <div class="container">
        <?= $content ?>
    </div>
    <!-- Script js -->
    <script src="dist/js/app.js"></script>
</body>

</html>