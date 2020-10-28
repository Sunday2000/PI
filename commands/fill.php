<?php 

require dirname(__DIR__).'/vendor/autoload.php';

use App\App;
use Faker\Factory;

$pdo = App::getPDO();
$faker = Factory::create('fr_FR');

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('TRUNCATE TABLE role');
$pdo->exec('TRUNCATE TABLE service');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');

$users = [];
$services = ["PRET","INVESTISSEMENT"];
$roles = ['CLIENT', 'ADMIN'];
$today = new DateTime("now");

foreach ( $services as $service)
{
    $pdo->exec("INSERT INTO service VALUES(NULL, '$service', '$faker->date $faker->time')");
    $services_id[] = $pdo->lastInsertId();
}

foreach ($roles as $role)
{
    $pdo->exec("INSERT INTO role VALUES (NULL, '$role')");
}

$password = password_hash('123456789', PASSWORD_BCRYPT);

for ( $i = 1; $i <= 10; $i++)
{
    $role = rand(1, count($roles));
    $pdo->exec("INSERT INTO user (name, role_id, surname, profession, country, city, salary, sex, tel, email, balance, password, terms, created_at) VALUES('$faker->lastName', '$role', '$faker->firstName', '$faker->jobTitle', '$faker->country', '$faker->city', 123500, '$faker->title', '$faker->phoneNumber', '$faker->email', 023, '$password', true, '$faker->date $faker->time')");
    $users[] = $pdo->lastInsertId();
}

for ( $i = 1; $i <= 11; $i++)
{
    $pdo->exec("INSERT INTO operation (user_id, service_id, amount, bank, bank_number, date, validate, withdrawal_way, created_at) VALUES('$i', 2, '4000', NULL, NULL, '{$today->format("Y-m-d H:i:s")}', 0, 'Perfect Money', '$faker->date $faker->time')");
}