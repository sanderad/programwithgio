<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = new PhpFile('migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*conection with the db */
$params = [
    'host' => $_ENV['DB_HOST'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'dbname' => $_ENV['DB_DATABASE'],
    'driver' => 'pdo_mysql'
];

/*creating the entityManeger which will mainly set the conection with the database and we are also acessing our entities so that we can create more organized and binded queries with multiple tables */
$entityManager = new EntityManager(
    DriverManager::getConnection($params), ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/app/Entity'])
);
/*
$connection = DriverManager::getConnection($params);
$entityManager = new EntityManager(
    $connection,
    ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/app/Entity'])
);*/

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));