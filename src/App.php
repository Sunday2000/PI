<?php

namespace App;

use PDO;
use App\Router;

class App{

    public static $pdo;
    public static $auth;
    public static $router;
    public static $bddRoute;
    const SEND = "Envoyé";
    const RECEIVE = "Recue";
    const FILE_PATH = "/public/user/files/";

    public static function getRouter():Router
    {
        if ( !self::$router )
        {
            self::$router = new Router();
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

    public static function getQuery(string $query, array $prepare = null)
    {
        $pdo = self::getPDO();
        $query = $pdo->prepare("$query");
        
        $query->execute($prepare);
        
        $datas = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($datas as $key => $data)
        {
            $datas[$key] = $data;
        }

        return $datas;
    }

    public static function transaction(int $user_id, string $type,int $amount, int $service_id, string $trans_way = "Perfect Money"): bool
    {
        $pdo = self::getPDO();
        $query = $pdo->prepare("INSERT INTO transaction (user_id, type, service_id, trans_way, amount, created_at) VALUES(:user_id, :type, :service_id, :trans_way, :amount, :created_at)");
        return $query->execute([
            "user_id" =>$user_id,
            "type" =>$type,
            "service_id"=>$service_id,
            "trans_way" => $trans_way,
            "amount" => $amount,
            "created_at" => date('Y-m-d H:i:s')
        ]);
    }
}