<?php
require_once("constants.php");

try {
    $dsn = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME;
    $connection = new PDO($dsn, DB_USER, DB_PASS);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {
    die("Failed to connect to MySQL: " . $e->getMessage());
}
