<?php
session_start();
require_once '../app/functions/functions.php';


if (isset($_POST['url']) && $_POST['url'] != "") {
    $url = trim($_POST['url']);
    $url = htmlspecialchars($url);

    $name = trim($_POST['fav-name']);
    $name = htmlspecialchars($name);

    $pdo = getPDO();
    $sql = 'INSERT INTO favorites (name,url,user_id) VALUES (?,?,?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $url, $_SESSION['user_id']]);
}

header('Location: /');
exit;
