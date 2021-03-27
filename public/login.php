<?php
session_start();
require_once '../app/functions/functions.php';

if (isset($_POST) && !empty($_POST)) {
    // Hash the password !
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Connexion to db
    $pdo = getPDO();
    $sql = 'SELECT * FROM users WHERE email="' . $_POST['email'] . '"';

    $req = $pdo->query($sql);
    $data = $req->fetch(PDO::FETCH_ASSOC);

    echo "data !";
    var_dump($data);
    if (!empty($data)) {
        if (password_verify($_POST['password'], $data['password'])) {
            $_SESSION['username'] = $data['username'];
            header('Location: /');
            exit;
        } else {
            echo 'mauvais mot de passe';
        }
    } else {
        echo "utilisateur non trouvé";
    }
}

require_once '../templates/header.php';
?>
<div class="login">

    <h1>Se connecter</h1>

    <form action="login.php" method="POST">
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