<?php

namespace App;

use App\Model\User;
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
        
        $query = null; 
        $user = null;
        $id = $_SESSION['auth'] ?? null;
        
        if ( !empty($id) )
        {
            $query = $this->pdo->prepare("SELECT * FROM user WHERE id = :id");
            $query->execute([
                'id' => $id
            ]);
            $user = $query->fetchObject(User::class);
        }
        
        return $user ?: null;
    }

    public static function connected(Router $router)
    {
        if ( session_status() === PHP_SESSION_NONE )
        {
            session_start();
        }

        if ( isset($_SESSION["auth"]) )
        {
            return $_SESSION["auth"];
        }

        header("Location: {$router->url("login")}");
        exit();
        
    }

    public function login(string $email, string $password): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $query->execute([
            'email' => $email
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

    /*public function admin_register(array $data, $role = 2)
    {
        $date = date('Y-m-d H:i:s');
        $query = $this->pdo->prepare("INSERT INTO user(role_id, name, surname, profession, country, city, salary, sex, tel, email, password, terms, created_at) VALUES(:role, :name, :surname, :profession, :country, :city, :salary, :sex, :tel, :email, :password, :terms, :date)");
        return $query->execute([
            'role' => $role,
            'name' => htmlentities($data['name']),
            'surname' => htmlentities($data['surname']),
            'profession' => htmlentities($data['profession']),
            'country' => htmlentities($data['country']),
            'city' => htmlentities($data['city']),
            'salary' => htmlentities($data['salary']),
            'sex' => htmlentities($data['sex']),
            'tel' => htmlentities($data['tel']),
            'email' =>htmlentities($data['email']),
            'password' =>password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]),
            'terms' => 1,
            'date' => $date
        ]);
        
    }*/

    public function register(array $data, $role = 1)
    {
        $date = date('Y-m-d H:i:s');
        $query = $this->pdo->prepare("INSERT INTO user(role_id, name, surname, /*profession, country, city, salary,*/ sex, tel, email, password, terms, created_at) VALUES(:role, :name, :surname, /*:profession, :country, :city, :salary,*/ :sex, :tel, :email, :password, :terms, :date)");
        /*$create_user = */ return $query->execute([
            'role' => $role,
            'name' => htmlentities($data['name']),
            'surname' => htmlentities($data['surname']),
            //'profession' => htmlentities($data['profession']),
            //'country' => htmlentities($data['country']),
            //'city' => htmlentities($data['city']),
            //'salary' => htmlentities($data['salary']),
            'sex' => htmlentities($data['sex']),
            'tel' => htmlentities($data['tel']),
            'email' =>htmlentities($data['email']),
            'password' =>password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]),
            'terms' => 1,
            'date' => $date
        ]);
        
    }

    public function requireRole(string ...$roles): bool
    {
        $user = $this->user();
        if ( $user === null )
        {
            return false;
        }else
        {
            $pdo = App::getPDO();
            $query = $pdo->prepare("SELECT role.name AS role_user FROM role INNER JOIN user ON user.role_id = role.id WHERE role.id = :role_id");
            $query->execute([
                'role_id' => $user->getRole_id()
            ]);
            $role = $query->fetch(PDO::FETCH_ASSOC);

            if (  ! in_array($role['role_user'], $roles))
            { 
                return false;
            }
            return true;
        }
   }
}
?>