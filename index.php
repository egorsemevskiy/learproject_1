<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'vendor/autoload.php';

use Sem\Classes\ShopProduct;
use Sem\Classes\ShopProductWriter;
use Sem\Classes\TextProductWriter;
use Sem\Classes\CdProduct;
use Sem\Classes\BookProduct;
use Sem\Classes\UtilityService;


$product1 = new BookProduct("Собачье сердце",  "Michail",  "Bulgacov", 5.99, 120);

$product2 = new CdProduct('Classic Music', "Antionio", "Vivaldi", "10.99", 60.33);

echo "Artist: " . $product2->getProducer() . "<br/>";
echo "\nAutor: {$product1->getProducer()} <br />\n";

$dsn = "sqlite:" . __DIR__ . "/products.db";
$pdo = new \PDO(
    $dsn, null, null
);
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

$obj = ShopProduct::getInstance(1, $pdo);

//echo $product1->getSummaryLine();
//echo $product2->getSummaryLine();

$textProduct = new TextProductWriter();
$textProduct->write();

$u = new UtilityService();
echo $u->calculateTax(100) . "<br/>\n";

$p  = new ShopProduct('Classic Music', "Antionio", "Vivaldi", "10.99");
echo $p->calculateTax(100) . "<br/>\n";
echo $p->generateId() . "<br/>\n";