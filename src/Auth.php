<?php

namespace App;

use Exception;
use PDO;

class Auth
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function register(array $data)
    {
        try
        {
            $date = date('Y-m-d H:i:s');
            $query = $this->pdo->prepare("INSERT INTO user(name, surname, tel, email, password, terms, created_at) VALUES(:name, :surname, :tel, :email, :password, :terms, :date)");
            $query->execute([
                'name' => htmlentities($data['name']),
                'surname' => htmlentities($data['surname']),
                'tel' => htmlentities($data['tel']),
                'email' =>htmlentities($data['email']),
                'password' =>password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]),
                'terms' => 1,
                'date' => $date
            ]);

            $user_id = $this->pdo->lastInsertId();

            $query = $this->pdo->prepare("INSERT INTO user_service VALUES(:user_id, :service_id)");
            $query->execute([
                'user_id' => $user_id,
                'service_id' => $data['service']
            ]);
                
            return true;

        }catch (Exception $e)
        {
            dump($e);
        }
        
    }
}
?>