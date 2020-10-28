<?php

namespace App\Model;
use PDO;
use App\App;

class User {    
    /**
     * id
     *
     * @var mixed
     */
    private $id;    
    /**
     * role_id
     *
     * @var mixed
     */
    private $role_id;
    /**
     * name
     *
     * @var mixed
     */
    private $name;    
    /**
     * surname
     *
     * @var mixed
     */
    private $surname;    
    /**
     * tel
     *
     * @var mixed
     */
    private $tel;    
    /**
     * email
     *
     * @var mixed
     */
    private $email;    
    /**
     * balance
     *
     * @var mixed
     */    
    /**
     * balance
     *
     * @var mixed
     */
    private $balance; 
    /**
     * password
     *
     * @var mixed
     */
    private $password;
    /**
     * profession
     *
     * @var mixed
     */
    private $profession;
    /**
     * country
     *
     * @var mixed
     */
    private $country;
    /**
     * city
     *
     * @var mixed
     */
    private $city;
    /**
     * sex
     *
     * @var mixed
     */
    private $sex;
    /**
     * salary
     *
     * @var mixed
     */
    private $salary;

    const FROM_ADMIN = "FROM_ADMIN";

    public static $services = ["PRET" =>"PRET", "INVEST" => "INVESTISSEMENT"];

    public function getId():int
    {
        return $this->id;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getProfession()
    {
        return $this->profession;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function getRole_id():int
    {
        return $this->role_id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getSurname():string
    {
        return $this->surname;
    }

    public function getTel():string
    {
        return $this->tel;
    }


    public function getEmail():string
    {
        return $this->email;
    }

    public function getBalance(): string
    {
        return $this->balance." USD";
    }

    /*public function setPerfectId(string $perfect_id): bool
    {
        $pdo = App::getPDO();
        $query = $pdo->prepare("UPDATE user SET perfect_id = :perfect_id WHERE id =:user_id");
        return $query->execute([
            "perfect_id" => $perfect_id,
            "user_id" => $this->id
        ]);
    }*/

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setTel(string $tel)
    {
        $this->tel = $tel;
    }

    public function setRole_id(int $role)
    {
        $this->role_id = $role;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function setBalance(int $balance):bool
    {
        $pdo = App::getPDO();
        $query = $pdo->prepare("UPDATE user set balance = :balance WHERE id = :user_id");
        $change = $query->execute([
            "balance" => $balance,
            "user_id" => $this->id
        ]);
        
        if ($change)
        {
            $this->balance = $balance;
        }

        return $change;
    }

    public function getPassword():string
    {
        return $this->password;
    }

    public function setPassword(string $role)
    {
        $this->password = $role;
    }

    public function suscribedServices(): ?array
    {
        $pdo = App::getPDO();
        $all = null;
        $services = null;

        $query =  $pdo->prepare("SELECT DISTINCT service.name AS name FROM service INNER JOIN operation ON service.id = operation.service_id WHERE operation.user_id = :user_id");
        $query->execute([
            "user_id" => $this->id
        ]);

        $all = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($all as $service)
        {
            $services []= $service["name"];
        }

        return $services;
    }

    public static function getUser(int $id): ?self{
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT * FROM user WHERE id = :id");
        $query->execute([
            "id" => $id
        ]);
        return $query->fetchObject(self::class) ?: null;
    }

    public static function getAdmins(User $user):array{
        $pdo = App::getPDO();
        $role_id = (int) self::getAdminNameId()['id'];
    
        $query = $pdo->prepare("SELECT * FROM user WHERE role_id = :role_id");
        $query->execute([
            "role_id" => $role_id
        ]);
        $datas = $query->fetchAll(PDO::FETCH_CLASS, self::class) ?: [];
        
        unset($datas[array_search($user, $datas)]);
        
        return $datas;
    }

    public static function getAdminNameId()
    {
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT id FROM role WHERE name = 'ADMIN'");
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function isAdmin(): bool
    {
        if ( $this->role_id == 1)
        {
            return false;
        }

        return true;
    }

    public function totalInvest():int
    {
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT SUM(amount) as total FROM operation WHERE service_id = :service_id AND user_id = :user_id");
        $query->execute([
            "service_id" => INVEST::getServiceId(INVEST::INVEST),
            "user_id" =>$this->id
        ]);

        $sum = $query->fetch(PDO::FETCH_ASSOC);
        
        return $sum["total"];
    }

    public function files(string $path): ?array
    {
        $pret = Pret::pret($this->id, App::getPDO());

        if ( !is_object($pret) )
        {
            return null;
        }

        $root = $path.App::FILE_PATH.Pret::FILE_PRET.$pret->getId().DIRECTORY_SEPARATOR.self::FROM_ADMIN;
        if (is_dir($root))
        {
            return glob($root."/*.*");
        }

        return null;
    }

    public function getInvest()
    {
        $pdo = App::getPDO();
        $service_id = Invest::getServiceId(Invest::INVEST);
        $query = $pdo->prepare("SELECT * FROM operation WHERE user_id = :user_id AND service_id = :service_id");
        $query->execute([
            "user_id"=> $this->id,
            "service_id" => $service_id
        ]);
        $datas = $query->fetchAll(PDO::FETCH_CLASS, Invest::class);

        return $datas;
    }

    public function update(array $datas, PDO $pdo):bool
    {
        $query = $pdo->prepare("UPDATE user SET profession=:profession, city=:city, country=:country, salary=:salary WHERE id=:id");
        return $query->execute([
            "id" =>$this->id,
            "profession" => htmlentities($datas['profession']),
            "city" => htmlentities($datas['city']),
            "country" => htmlentities($datas['country']),
            "salary" =>htmlentities($datas['salary'])
        ]);
    }

    public function adminUpdate(array $datas, PDO $pdo)
    {
        
        $query = $pdo->prepare("UPDATE user SET name=:name, tel=:tel, email=:email, surname=:surname, sex=:sex, password=:password WHERE id=:id");
        return $query->execute([
            "id" =>$this->id,
            "email" =>htmlentities($datas['email']),
            "tel" => htmlentities($datas['tel']),
            "name" => htmlentities($datas['name']),
            "surname" => htmlentities($datas['surname']),
            "sex" => htmlentities($datas['sex']),
            "password" =>password_hash($datas['password'], PASSWORD_BCRYPT, ['cost' => 12])
        ]);
    }

    public function delete( PDO $pdo)
    {
        $query = $pdo->prepare('DELETE FROM user WHERE id=:id');
        
        return $query->execute([
            "id" => $this->id
        ]);
    }

    public static function storeFile(array $file, string $path, string $pret_id)
    {
        $root = $path.App::FILE_PATH.PRET::FILE_PRET.$pret_id.DIRECTORY_SEPARATOR.self::FROM_ADMIN;
        $ext_autorized = ['jpg', 'jpeg', 'gif','png', 'pdf', 'doc', 'docx'];
        
        if ($file['size'] <= 5000000)
        {
            $infofile = pathinfo($file['name']);
            $ext_file = $infofile['extension'] ?? null;

            if ( in_array($ext_file, $ext_autorized) )
            {   
                if (is_dir($root))
                {
                    move_uploaded_file($file['tmp_name'], $root.DIRECTORY_SEPARATOR.basename($file['name']));
                }else if ( mkdir($root, 0777) )
                {
                    move_uploaded_file($file['tmp_name'], $root.DIRECTORY_SEPARATOR.basename($file['name']));
                }else
                {
                    return "Creation impossible";
                }
            }else
            {
                return "Extension du fichier non supportées";
            }
        }else
        {
            return "Fichier volumineux";
        }
        

        return false;
    }
}

?>