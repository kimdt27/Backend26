<?php
require ('constants.php');
try {
    $db = new PDO(DSN, DB_USER, DB_PASS);
}catch(PDOException $e){
    echo "You done f..ed up! BOI!!!".$e->getMessage();
}