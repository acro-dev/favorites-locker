<div class="login">

    <h1>S'inscrire</h1>

    <form action="/users/signup" method="POST">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="username" name="username" value="<?= $data['username'] ?>">
        <span><?php echo $data['usernameError']; ?></span>

        <label for="email">E-Mail</label>
        <input type="text" id="email" name="email" value="<?= $data['email'] ?>">
        <span><?php echo $data['emailError']; ?></span>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">
        <span><?php echo $data['passwordError']; ?></span>

        <label for="confirmPassword">Confirmer votre mot de passe</label>
        <input type="password" id="confirmPassword" name="confirmPassword">

        <button type="submit">Incription</button>
    </form>
</div>