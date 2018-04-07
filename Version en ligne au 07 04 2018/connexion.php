<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ob_start();
session_start();
define('PROJECT_NAME', 'Facturation');
define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'db729402836.db.1and1.com');
define('DB_SERVER_USERNAME', 'dbo729402836');
define('DB_SERVER_PASSWORD', 'facturationgenerale2576@x!');
define('DB_DATABASE', 'db729402836');

$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try {
  $base = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}
?>
