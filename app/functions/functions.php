<?php

function getPDO()
{
    $dsn = 'mysql:dbname=favorites_locker;host=localhost';
    $user = 'root';
    $password = '';

    return new PDO($dsn, $user, $password);
}

function test_input($data)
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
