<?php
session_start();

require_once '../templates/header.php';
?>
<div class="login">

    <h1>Se connecter</h1>

    <form action="">
        <label for="email">E-Mail</label>
        <input type="text" id="email" name="email">

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">

        <button>Connexion</button>
    </form>
</div>

<?php
require_once '../templates/footer.php';
?>