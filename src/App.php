<?php

namespace App;

use PDO;

class App{

    public static $pdo;
    public static $auth;

    public static function getPDO(): PDO
    {
        if ( !self::$pdo)
        {
            self::$pdo = new PDO('mysql:dbname=help_pi;host=127.0.0.1', 'root', null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        
        return self::$pdo;
    }

    public static function getAuth():Auth
    {
        if (!self::$auth)
        {
            self::$auth = new Auth(self::getPDO());
        }

        return self::$auth;
    }
}