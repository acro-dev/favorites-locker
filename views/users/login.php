<div class="login">

    <h1>Se connecter</h1>

    <form action="/users/login" method="POST">
        <label for="email">E-Mail</label>
        <input type="text" id="email" name="email">
        <span><?php echo $data['emailError']; ?></span>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">
        <span><?php echo $data['passwordError']; ?></span>

        <button type="submit">Connexion</button>
        <p>Toujours pas incrit ?</p>
    </form>
</div>