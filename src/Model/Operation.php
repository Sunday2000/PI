<?php
namespace App\Model;

use PDO;
use App\App;
use DateTime;
use DateInterval;

abstract class Operation{

    const PERFECT = "Perfect Money";
    
    /**
     * id
     *
     * @var mixed
     */
    protected $id;
    /**
     * user_id
     *
     * @var mixed
     */
    protected $user_id;  
    /**
     * amount
     *
     * @var mixed
     */
    protected $amount;    
    /**
     * created_at
     *
     * @var mixed
     */
    protected $created_at;    
    /**
     * date
     *
     * @var mixed
     */
    protected $date;    
    /**
     * bank
     *
     * @var mixed
     */
    protected $bank;
    /**
     * validate
     *
     * @var mixed
     */
    protected $validate; 
    /**
     * bank_number
     *
     * @var mixed
     */
    protected $bank_number;    
    /**
     * withdrawal_way
     *
     * @var mixed
     */
    protected $withdrawal_way;

    protected $pdo;

    protected $receiver;

    public function getId():int
    {
        return $this->id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getDate(): DateTime
    {
        return new DateTime($this->date);
    }
    
    public function getWithdrawal_way():string
    {
        return $this->withdrawal_way;
    }

    public function getBank():string
    {
        return $this->bank;
    }

    public function getBankNumber():string
    {
        return $this->bank_number; 
    }

    public function getUser_id():int
    {
        return $this->user_id; 
    }

    public function getCreated_at():DateTime
    {
        return new DateTime($this->created_at); 
    }

    public function getValidate()
    {
        return $this->validate;
    }

    public function getReceiver()
    {
        return $this->receiver;
    }

    public static function setReceiver(int $id, string $receiver): bool
    {
        $pdo = App::getPDO();
        $query = $pdo->prepare("UPDATE operation SET receiver = :receiver WHERE id =:id");
        return $query->execute([
            "receiver" => $receiver,
            "id" => $id
        ]);
    }

    public function checkPayement():string
    {
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT service.name AS name FROM service INNER JOIN transaction ON service.id = transaction.service_id WHERE transaction.user_id = :user_id");
        $query->execute([
            "user_id" =>$this->user_id
        ]);
        $name = $query->fetchAll(PDO::FETCH_ASSOC);
            
        foreach($name as $data)
        {
            return $data["name"] == Pret::PRET ? "oui": "non";
        }

        return "non";
    }

    public function setValidate(string $operation):bool
    {
        $query = $this->pdo->prepare("UPDATE operation set validate = true WHERE id = :id AND service_id = :service_pret_id");
        return $query->execute([
            "id"=>$this->id,
            "service_pret_id" =>self::getServiceId($operation)
        ]);
    }

    public function delete():bool
    {
        $query = $this->pdo->prepare("DELETE FROM operation WHERE id=:op_id");
        return $query->execute([
            "op_id"=>$this->id
        ]);
    }

    public function getUser(): ?User{
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT * FROM user WHERE id = :id");
        $query->execute([
            "id" => $this->user_id
        ]);
        return $query->fetchObject(User::class) ?: null;
    }

    public static function getServiceId(string $service)
    {
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT id FROM service WHERE name=:name");
        $query->execute([
            "name"=>$service
        ]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        return (int)$result["id"];
    }

    public static function getOperation(int $id, PDO $pdo)
    {
        $query = $pdo->prepare("SELECT * FROM operation WHERE id = :id ");
        $query->execute([
            "id"=>$id,
        ]);
        
        return $query;
    }

    public static function createOperation(array $datas, int $id, PDO $pdo, int $service_id, string $time ="M", float $rate = 1): bool
    {   
        $today = new DateTime('now');
        $datas["amount"] += $datas["amount"] * $rate;
        $duration = "P".$datas['date'].$time;
        $query = $pdo->prepare("INSERT INTO operation(user_id, service_id, validate, amount, bank, bank_number, date, withdrawal_way, hash_code, receiver, created_at) VALUES (:user_id, :service_id, :validate, :amount, :bank, :bank_number, :date, :withdrawal_way, :hash_code, :receiver, :created_at)");
        return $query->execute([
            "user_id" => $id,
            "service_id" =>$service_id,
            "validate" => null,
            "amount" => htmlentities($datas["amount"]),
            "bank" => htmlentities($datas["bank"] ?? null ),
            "bank_number" => htmlentities($datas["bank_number"] ?? null),
            "created_at" => $today->format("Y-m-d H:i:s"),
            "withdrawal_way" => $datas["withdrawal_way"] ?? null,
            "hash_code" => $datas["hash_code"] ?? null,
            "receiver"  => $datas["receiver"] ?? null,
            "date" => $today->add(new DateInterval($duration))->format("Y-m-d H:i:s")
        ]);
    }
}
?>