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
$services = [];
$roles = ['CLIENT', 'ADMIN'];

for ( $i = 1; $i <= 4; $i++)
{
    $pdo->exec("INSERT INTO service VALUES(NULL, '$faker->word', '$faker->date $faker->time')");
    $services[] = $pdo->lastInsertId();
}

foreach ($roles as $role)
{
    $pdo->exec("INSERT INTO role VALUES (NULL, '$role')");
}

$password = password_hash('123456789', PASSWORD_BCRYPT);

for ( $i = 1; $i <= 10; $i++)
{
    $role = rand(1, count($roles));
    $service = rand(1, count($services));
    $pdo->exec("INSERT INTO user (name, role_id, service_id, surname, tel, email, password, terms, created_at) VALUES('$faker->name', '$role', '$service', '$faker->name', '$faker->phoneNumber', '$faker->email', '$password', true, '$faker->date $faker->time')");
    $users[] = $pdo->lastInsertId();
}
