<?php
require_once("includes/connection.php");

$id = $_GET['id'];

try {
    $query = "SELECT filename FROM imgs WHERE ID = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $file = "img/" . $row['filename'];

        $deleteQuery = "DELETE FROM imgs WHERE ID = :id";
        $deleteStmt = $connection->prepare($deleteQuery);
        $deleteStmt->bindParam(':id', $id);
        $deleteStmt->execute();

        if (file_exists($file)) {
            unlink($file);
        }

        header("Location: delete.php");
        exit();
    } else {
        die("No file found with the given ID.");
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Close the PDO connection
$connection = null;

