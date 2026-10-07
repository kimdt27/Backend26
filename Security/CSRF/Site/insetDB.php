<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "sec");

$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if (!$connection)
{
    die ("Failed to connect to MySQL: " . mysqli_connect_error());
}
$db_select = mysqli_select_db($connection, DB_NAME);
if (!$db_select){
    die("Database error: " . mysqli_error($connection));
}
$txt = $_GET['txt'];
$query = "INSERT INTO `sec` (`text`) VALUES ('$txt')";
$result = mysqli_query($connection, $query);
header("location: index.php");