<div class="row">
    <div class="col col-lg-6 col-md-8 m-auto">

        <main>
            <h1 class="text-center">Se connecter</h1>
            <form action="/users/login" method="POST">
                <div class="mb-3">
                    <label class="form-label" for="email">E-Mail</label>
                    <input class="form-control" type="text" id="email" name="email">
                    <span class="form-text text-danger"><?php echo $data['emailError']; ?></span>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Mot de passe</label>
                    <input class="form-control" type="password" id="password" name="password">
                    <span class="form-text text-danger"><?php echo $data['passwordError']; ?></span>
                </div>

                <button class="btn btn-primary" type="submit">Connexion</button>
            </form>
            <p class="mt-5">
                Toujours pas incrit ? <a href="/users/signup">Créer un compte</a>.
            </p>
        </main>
    </div>
</div>