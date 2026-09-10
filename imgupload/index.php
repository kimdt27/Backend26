<html>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="imgfile">
    <input type="submit" name="submit">
</form>
</body>
</html>
<?php
if (isset($_POST['submit'])){
    if(($_FILES['imgfile']['type']=="image/jpeg" ||
        $_FILES['imgfile']['type']=="image/pjpeg" ||
        $_FILES['imgfile']['type']=="image/gif" ||
        $_FILES['imgfile']['type']=="image/jpg")&& (
         $_FILES['imgfile']['size']< 3000000
        )){
        if ($_FILES['imgfile']['error']>0){
            echo "Error: ". $_FILES['imgfile']['error'];
        }else{
            echo "Name: ".$_FILES['imgfile']['name']."<br>";
            echo "Type: ".$_FILES['imgfile']['type']."<br>";
            echo "Size: ".($_FILES['imgfile']['size']/1024)."<br>";
            echo "Tmp_name: ".$_FILES['imgfile']['tmp_name']."<br>";

            if (file_exists("upload/".$_FILES['imgfile']['name'])){
                echo "can't upload: ". $_FILES['imgfile']['name']. " Exists";
            } else {
                // Move uploaded file to the "upload" directory
                move_uploaded_file($_FILES['imgfile']['tmp_name'], "upload/" . $_FILES['imgfile']['name']);
                echo "Stored in: upload/" . $_FILES['imgfile']['name'] . "<br>";

                try {
                    $dsn = "mysql:host=localhost;dbname=imgup";
                    $username = "kim";
                    $password = "123456";
                    $conn = new PDO($dsn, $username, $password);

                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "INSERT INTO img (filename) VALUES (:filename)";
                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':filename', $_FILES['imgfile']['name']);

                    if ($stmt->execute()) {
                        echo "File information successfully stored in the database.";
                    } else {
                        echo "Failed to store file information in the database.";
                    }
                } catch (PDOException $e) {
                    echo "Database error: " . $e->getMessage();
                }

                // Close the connection
                $conn = null;
            }
        }
    } else {
        echo "Invalid file type or size too large.";
    }
}