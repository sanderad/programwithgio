<?php

declare(strict_types=1);

use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Enums\InvoiceStatus;
use App\Exceptions\FailedParamsException;
use App\VarianceExample\Cat;
use Doctrine\DBAL\ArrayParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Setup;
use Dotenv\Dotenv;
use Symfony\Component\Mailer\Event\FailedMessageEvent;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*conection with the db */
$params = [
    'host' => $_ENV['DB_HOST'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'dbname' => $_ENV['DB_DATABASE'],
    'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql'
];

/*creating the entityManeger which will mainly set the conection with the database and we are also acessing our entities so that we can create more organized and binded queries with multiple tables */
/*$entityManager = new EntityManager(
    DriverManager::getConnection($params), ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/Entity'])
);
try {
$entityManager->beginTransaction();*/

$queryBuilder = $entityManager->createQueryBuilder();

// WHERE amount > :amount AND (status = :status OR created_at >= :date)
// WHERE i.amount > :amount AND (i.status = :status OR i.createdAt >= :date)
// SELECT i, it FROM App\Entity\Invoice i INNER JOIN i.items it WHERE i.amount > :amount AND (i.status = :status OR i.createdAt <= :date) ORDER BY i.createdAt desc
$query = $queryBuilder
              ->select('i' /*, 'it'*/)
              ->from(Invoice::class, 'i')
              //->join('i.items', 'it')
              ->where(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->gt('i.amount', ':amount'),
                    $queryBuilder->expr()->orX(
                        $queryBuilder->expr()->eq('i.status', ':status'),
                        $queryBuilder->expr()->gte('i.createdAt', ':date')
                    )
                )
              )
              ->setParameter('amount', 999)
              ->setParameter('status', InvoiceStatus::Paid->value)
              ->setParameter('date', new DateTime('2023-10-22 22:14:03'))
              ->orderBy('i.createdAt', 'desc')  
              ->getQuery();

              try {
                $invoices = $query->getResult();
            } catch (\Exception $e) {
                echo "Query failed: " . $e->getMessage();
            }

/** @var Invoice $invoice */
foreach($invoices as $invoice) {
    /*if(null === $invoice->getItems()) {
        throw new FailedParamsException('no match was found between the two tables');
      }*/
    echo $invoice->getCreatedAt()->format('m/d/Y g:ia')
      . ', ' . $invoice->getAmount()
      . ', ' . $invoice->getStatus()->toString() . PHP_EOL;
      is_null($invoice->getItems()->getValues());
      echo 1111111;
      /** @var InvoiceItem $item */
      foreach($invoice->getItems() as $item) {
        is_null($item->getQuantity());
        echo ' - ' . $item->getDescription()
           . ', ' . $item->getQuantity()
           . ', ' . $item->getUnitPrice() . PHP_EOL;
      }
}

/*
$entityManager->commit();
} catch (FailedParamsException $e) {
    $entityManager->rollback();
    echo $e->getMessage();
}
*/