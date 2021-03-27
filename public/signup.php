<?php
session_start();
require_once '../app/functions/functions.php';

if (isset($_POST) && !empty($_POST)) {

    // Collect $_POST data :
    $username = strtolower(test_input($_POST['username']));
    $email = strtolower(test_input($_POST['email']));
    $password = test_input($_POST['password']);
    $confirmPassword = test_input($_POST['confirmPassword']);
    $errors = [];

    // Username must be set and whithout special char.
    if ($username == "") {
        $errors['username'] = "Le champ [NOM D'UTILISATEUR] doit être rempli.";
    } else if (!preg_match('/^[A-Za-z0-9_-]*$/', $username)) {
        $errors['username'] = "Le champ [NOM D'UTILISATEUR] ne peux contenir que des lettres, des chiffres, \"-\" ou \"_\"";
    }
    // Email must be valid.
    if ($email == "") {
        $errors['email'] = "Le champ [ADRESSE EMAIL] doit être rempli.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "La champ [ADRESSE EMAIL] n'est pas au format adresse email.";
    }
    // Password must be 8 caractere long and must coincide whith confirmPassword.
    if (strlen($password) < 8) {
        $errors['password'] = "Le champ [MOT DE PASSE] doit contenir au moins 8 caractères.";
    } else if ($password != $confirmPassword) {
        $errors['password'] = "Les champs [MOT DE PASSE] et [CONFIRMATION] doivent être identiques.";
    } else {
        // Hash the password !
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    // If all is fine, we check with user with this credentials allready existe.
    if (empty($errors)) {
        // Connexion to db
        $pdo = getPDO();
        $sql = 'SELECT email FROM users WHERE email="' . $email . '"';

        $req = $pdo->query($sql);
        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            $errors['email'] = 'Un utilisateur avec cette adresse mail existe déjà.';
        }
    }

    if (empty($errors)) {
        $sql = 'INSERT INTO users (username,email,password) VALUES (?,?,?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $password]);

        $_SESSION['username'] = ucfirst($username);
        header('Location: /');
        exit;
    }
}
?>

<!-- AFFICHAGE -->

<?php require '../templates/header.php'; ?>

<h1>S'enregistrer sur Favorites Locker !</h1>

<form method="POST" id="signupForm">

    <label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username" placeholder="Nom d'utilisateur">

    <label for="email">E-Mail</label>
    <input type="text" name="email" id="email" placeholder="Votre email">

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Mot de passe">

    <label for="confirmPassword">Confirmation du mot de passe</label>
    <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirmation du mot de passe">

    <button type="submit">S'enregistrer</button>
</form>

<?php require '../templates/footer.php'; ?>