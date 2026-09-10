<?php
require ("constants.php");
try {
    $db = new PDO(DSN, DB_USER, DB_PASS);
}catch (PDOException $e){
    echo "you done f...ed up". $e->getMessage();
}