<?php

namespace App;

use PDO;
use App\Router;

class App{

    public static $pdo;
    public static $auth;
    public static $router;

    public static function getRouter():Router
    {
        if ( !self::$router )
        {
            self::$router = new Router(dirname(__DIR__)."/views");
        }

        return self::$router;
    }

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
            self::$auth = new Auth(self::getPDO(), self::getRouter()->url('login-refused').'1');
        }

        return self::$auth;
    }
}