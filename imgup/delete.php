<?php
require_once("includes/connection.php");

try {
    $stmt = $connection->prepare("SELECT * FROM imgs");
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        echo "<b>id:</b> " . htmlspecialchars($row['ID']) . "<br>";
        echo "<b>filename:</b> " . htmlspecialchars($row['filename']) . "<br>";
        echo "<b>IMG:</b> <img src='img/" . htmlspecialchars($row['filename']) . "' width='150'><br>";
        echo "<a href='delete_pro.php?id=" . htmlspecialchars($row['ID']) . "' onclick=\"return confirm('Are you sure?');\">Delete!</a>";
        echo "<hr>";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the PDO connection
$connection = null;

