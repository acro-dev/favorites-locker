<?php

function getPDO()
{
    $dsn = 'mysql:dbname=favlocker;host=localhost';
    $user = 'favlocker';
    $password = '';

    return new PDO($dsn, $user, $password);
}

function test_input($data)
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
