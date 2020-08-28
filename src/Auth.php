<?php

namespace App;

use App\Model\User;
use Exception;
use PDO;

class Auth
{
    private $pdo;
    private $loginPath;
    public function __construct(PDO $pdo, string $loginPath)
    {
        $this->pdo = $pdo;
        $this->loginPath = $loginPath;
    }

    public function user(): ?User
    {
        if ( session_status() === PHP_SESSION_NONE )
        {
            session_start();
        }

        $id = $_SESSION['auth'];
        $query = $this->pdo->prepare("SELECT * FROM user WHERE id = :id");
        $query->execute([
            'email' => $id
        ]);
        $user = $query->fetchObject(User::class);

        return $user ?: null;
    }

    public function login(string $email, string $password, string $service): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE email = :email AND service_id = :service");
        $query->execute([
            'email' => $email,
            'service'=> $service
        ]);

        $query->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $query->fetch();

        if ( $user === false )
        {
            return null;
        }

        if ( password_verify($password, $user->getPassword()) )
        {
            if ( session_status() === PHP_SESSION_NONE)
            {
                session_start();
            }
            $_SESSION['auth'] = $user->getId();

            return $user;
        }
        
        return null;
    }

    public function register(array $data, $role = 1)
    {
        try
        {
            $date = date('Y-m-d H:i:s');
            $query = $this->pdo->prepare("INSERT INTO user(role_id, service_id, name, surname, tel, email, password, terms, created_at) VALUES(:role, :service, :name, :surname, :tel, :email, :password, :terms, :date)");
            $query->execute([
                'role' => $role,
                'service'=> $data['service'],
                'name' => htmlentities($data['name']),
                'surname' => htmlentities($data['surname']),
                'tel' => htmlentities($data['tel']),
                'email' =>htmlentities($data['email']),
                'password' =>password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]),
                'terms' => 1,
                'date' => $date
            ]);
                
            return true;

        }catch (Exception $e)
        {
            dump($e);
        }
        
    }

    public function requireRole(string ...$roles): void
    {
        $user = $this->user();
        if ( $user === null )
        {
            $forbid = $this->loginPath;
            header("Location: $forbid");
            exit();
        }else
        {
            $pdo = App::getPDO();
            $query = $pdo->prepare("SELECT role.name AS role_user FROM role INNER JOIN user ON user.role_id = role.id WHERE id = :role_id");
            $query->execute([
                'role_id' => $user->role_id
            ]);
            $role = $query->fetch(PDO::FETCH_ASSOC);

            if (  ! in_array($role['role_user'], $roles))
            {
                $forbid = $this->loginPath;
                header("Location: $forbid");
                exit();
            }
    }   }
}
?>