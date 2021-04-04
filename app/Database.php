<?php

namespace App;

use PDO;
use PDOException;

class Database
{
    private static $host = "localhost";
    private static $dbname = "favlocker";
    private static $username = "favlocker";
    private static $password = "";

    private static $PDO = null;

    public static function getPDO()
    {
        if (self::$PDO === null) {
            try {
                self::$PDO = new PDO(
                    'mysql:host=' . static::$host . '; dbname=' . static::$dbname,
                    static::$username,
                    static::$password
                );
                self::$PDO > exec('set names utf8');
            } catch (PDOException $exception) {
                echo 'Erreur :' . $exception->getMessage();
            }
        }

        return self::$PDO;
    }
}
