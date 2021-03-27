<?php
session_start();

require_once '../templates/header.php';
?>
<div class="login">

    <h1>Se connecter</h1>

    <form class="inscription-form" action="">
        <label for="email">E-Mail</label>
        <input type="text" id="email" name="email">

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">

        <label for="confirm-password">Confirmez votre mot de passe</label>
        <input type="password" id="confirm-password" name="confirm-password">

        <button>S'inscrire</button>
    </form>
</div>

<?php
require_once '../templates/header.php';
?>