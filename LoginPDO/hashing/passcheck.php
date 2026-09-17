<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "123456");
define("DB_NAME", "hash");

try {
    // Connect to MySQL using PDO
    $dsn = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME;
    $connection = new PDO($dsn, DB_USER, DB_PASS);

    // Set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Failed to connect to MySQL: " . $e->getMessage());
}

// Get user inputs
$UserInputPass = $_GET['userPass'];
$checkID = $_GET['id'];

echo "Is " . htmlspecialchars($UserInputPass) . " salted and hashed in the DB as ID " . htmlspecialchars($checkID) . "?<br>";

try {
    // Prepare the SQL statement using PDO to prevent SQL injection
    $select_query = "SELECT pass FROM hash WHERE ID = :id";
    $stmt = $connection->prepare($select_query);

    // Bind the ID parameter
    $stmt->bindParam(':id', $checkID);
    $stmt->execute();

    // Fetch the result
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Check if the password matches the hashed password in the database
        $isPasswordValid = password_verify($UserInputPass, $row['pass']);
        var_dump($isPasswordValid);
    } else {
        echo "No record found for the given ID.";
    }
} catch (PDOException $e) {
    die("Error executing query: " . $e->getMessage());
}

// Close the PDO connection
$connection = null;
?>
