<?php
namespace App\Model;

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

    public function getId():int
    {
        return $this->id;
    }

    public function getRole_id():int
    {
        return $this->role_id;
    }

    public function setRole_id(int $role)
    {
        $this->role_id = $role;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getSurname():string
    {
        return $this->surname;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function getTel():string
    {
        return $this->tel;
    }

    public function setTel(string $tel)
    {
        $this->tel = $tel;
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getBalance():int
    {
        return $this->balance;
    }

    public function setBalance(int $balance)
    {
        $this->balance = $balance;
    }

    public function getPassword():string
    {
        return $this->password;
    }

    public function setPassword(string $role)
    {
        $this->password = $role;
    }
}

?>