<?php
session_start();
require_once '../app/functions/functions.php';

$pdo = getPDO();
$sql = 'DELETE FROM favorites WHERE id="' . $_GET['id'] . '"';
$pdo->exec($sql);

header('Location: /');
exit;
