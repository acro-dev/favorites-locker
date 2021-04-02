<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description="Site de gestion de favoris">
    <!-- Stylesheet link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="/dist/css/style.min.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Favorites Locker</title>
</head>

<body>
    <header class="mb-5">
        <nav class="navbar-expand-lg navbar navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Favorites-Locker</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php
                        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
                            echo '<li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="/users/logout">Se déconnecter</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="/dashboard/profile/' . $_SESSION['userID'] . '">' . $_SESSION['username'] . '</a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="/users/login">Se connecter</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="/users/signup">S\'inscire</a></li>';
                        }
                        ?>
                    </ul>
                </div>
        </nav>
    </header>
    <div class="container">
        <?= $content ?>
    </div>
    <!-- Script js -->
    <script src="dist/js/app.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


</body>

</html>