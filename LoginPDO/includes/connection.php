<?php
require("constants.php");

try {
    // Connect to MySQL using PDO
    $dsn = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME;
    $connection = new PDO($dsn, DB_USER, DB_PASS);

    // Set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Catch any connection errors and display the message
    die("Failed to connect to MySQL: " . $e->getMessage());
}