<form method="post" action="" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit">
</form>

<?php
if (isset($_POST['submit'])) {
    // Check if the file type is valid and the size is within the limit
    if (($_FILES['file']['type'] == "image/gif" ||
            $_FILES['file']['type'] == "image/jpeg" ||
            $_FILES['file']['type'] == "image/png" ||
            $_FILES['file']['type'] == "image/pjpeg") &&
        $_FILES['file']['size'] < 10000000) {

        // Check for any file upload errors
        if ($_FILES['file']['error'] > 0) {
            echo "Error code: " . $_FILES['file']['error'];
        } else {
            // Display file details
            echo "Uploaded: " . $_FILES['file']['name'] . "<br>";
            echo "Type: " . $_FILES['file']['type'] . "<br>";
            echo "Size: " . ($_FILES['file']['size'] / 1024) . " KB<br>";
            echo "Temp file: " . $_FILES['file']['tmp_name'] . "<br>";

            // Check if the file already exists
            if (file_exists("img/" . $_FILES['file']['name'])) {
                echo "No dude, you already have that file!";
            } else {
                // Move the uploaded file to the "img" directory
                move_uploaded_file($_FILES['file']['tmp_name'], "img/" . $_FILES['file']['name']);

                try {
                    $dsn = "mysql:host=localhost;dbname=img";
                    $username = "kim";
                    $password = "123456";
                    $conn = new PDO($dsn, $username, $password);

                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "INSERT INTO imgs (filename) VALUES (:filename)";
                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':filename', $_FILES['file']['name']);

                    if ($stmt->execute()) {
                        echo "File information successfully stored in the database.";
                    } else {
                        echo "Failed to store file information in the database.";
                    }
                } catch (PDOException $e) {
                    echo "Database error: " . $e->getMessage();
                }

                // Close the PDO connection
                $conn = null;
            }
        }
    } else {
        echo "Invalid file!";
    }
}
?>
