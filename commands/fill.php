<?php 

require dirname(__DIR__).'/vendor/autoload.php';

use App\App;
use Faker\Factory;

$pdo = App::getPDO();
$faker = Factory::create('fr_FR');

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE user_service');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('TRUNCATE TABLE service');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');

$users = [];
$services = [];

for ( $i = 1; $i <= 4; $i++)
{
    $pdo->exec("INSERT INTO service VALUES(NULL, '$faker->word', '$faker->date $faker->time')");
    $services[] = $pdo->lastInsertId();
}

$password = password_hash('123456789', PASSWORD_BCRYPT);

for ( $i = 1; $i <= 10; $i++)
{
    $pdo->exec("INSERT INTO user (name, surname,tel ,email, password, terms, created_at) VALUES('$faker->name', '$faker->name', '$faker->phoneNumber', '$faker->email', '$password', true, '$faker->date $faker->time')");
    $users[] = $pdo->lastInsertId();
}

foreach($users as $user)
{
    $servs = $faker->randomElements($services, rand(0, count($services)));

    foreach($servs as $serv )
    {
        $pdo->exec("INSERT INTO user_service VALUES('$user', '$serv')");
    }
}