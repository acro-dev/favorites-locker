<div class="row">
    <div class="col col-lg-6 col-md-8 m-auto">

        <h1 class="text-center">S'inscrire</h1>

        <form action=" /users/signup" method="POST">
            <div class="mb-3">
                <label class="form-label" for="username">Nom d'utilisateur</label>
                <input class="form-control" type="text" id="username" name="username" value="<?= $data['username'] ?>">
                <span class="form-text text-danger"><?php echo $data['usernameError']; ?></span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="email">E-Mail</label>
                <input class="form-control" type="text" id="email" name="email" value="<?= $data['email'] ?>">
                <span class="form-text text-danger"><?php echo $data['emailError']; ?></span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="password">Mot de passe</label>
                <input class="form-control" type="password" id="password" name="password">
                <span class="form-text text-danger"><?php echo $data['passwordError']; ?></span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="confirmPassword">Confirmer votre mot de passe</label>
                <input class="form-control" type="password" id="confirmPassword" name="confirmPassword">
            </div>

            <button class="btn btn-primary" type="submit">Incription</button>
        </form>
    </div>
</div>