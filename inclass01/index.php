<?php
require "includes/connection.php";
$sql ="SELECT * FROM `users`";
$result = $db->query($sql);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
    echo "Name: ".$row['name']."<br>";
    echo "Age: ".$row['age']."<br>";
}