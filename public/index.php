<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: /dashboard.php');
    exit;
}

?>



<?php require '../templates/header.php'; ?>
<main>
    <h1>Bienvenue sur Favorites Locker</h1>

    <p>
        Si vous avez besoin d'un gestionnaire de favoris en ligne,
        vous êtes au bon endroit !
    </p>
    <p>
        Favorites-locker va vous permettre d'enregister et de classer les liens
        vers vos sites favoris.
    </p>
    <p>
        Ainsi vous y aurait accès à partir de n'importe quel navigateur web :)
    </p>
<main>
<section>
    <p>
        Si vous avez déjà un compte, <a href="#">connectez-vous</a>.
    </p>
    <p>
        Sinon c'est par ici pour vous enregister => <a href="#">créer un compte</a> !
    </p>


<?php require '../templates/footer.php'; ?>