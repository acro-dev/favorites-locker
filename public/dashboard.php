<?php
session_start();

require_once '../app/functions/functions.php';


if (!isset($_SESSION['username'])) {
    echo "Vous n'étes pas connecter, redirection....";
    header('Location: /');
}

require '../templates/header.php';
?>
<h1>Dashboard <?= ucfirst($_SESSION['username']); ?></h1>
<form action="add_fav.php" method="post">
    <label for="fav-name">Nom</label>
    <input type="text" name="fav-name" id="fav-name">
    <label for="url">Url</label>
    <input type="text" name="url" id="url">
    <button type="submit">➕</button>
</form>


<?php
// Fetch all favorite from current user.
$pdo = getPDO();
$sql = 'SELECT * FROM favorites WHERE user_id="' . $_SESSION['user_id'] . '"';

$req = $pdo->query($sql);
$data = $req->fetchAll(PDO::FETCH_ASSOC);
?>
<ul>
    <?php

    foreach ($data as $favorite) {
        echo "<li><a href=\"" . $favorite['url'] . "\">";
        echo $favorite['url'];
        echo '<a href ="delete_fav.php/?id=' . $favorite['id'] . '">❌</a>';
        echo "</a></li>";
    }
    ?>
</ul>

<?php require '../templates/footer.php'; ?>