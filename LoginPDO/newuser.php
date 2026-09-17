<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php //confirm_logged_in(); ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>

<?php
// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.

	// Perform validations on the form data
	$username = trim($_POST['user']);
	$password = trim($_POST['pass']);
	
    // Hash the password with bcrypt and cost factor
    $iterations = ['cost' => 15];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

    try {
        // Prepare the SQL query to insert user
        $query = "INSERT INTO users (user, pass) VALUES (:username, :hashed_password)";
        $stmt = $connection->prepare($query);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':hashed_password', $hashed_password);

        // Execute the query
        $result = $stmt->execute();

        if ($result) {
            $message = "User Created.";
        } else {
            $message = "User could not be created.";
        }
    } catch (PDOException $e) {
        $message = "User could not be created. Error: " . $e->getMessage();
    }
}

if (!empty($message)) {
    echo "<p>" . $message . "</p>";
}
?>
<h2>Create New User</h2>

<form action="" method="post">
Username:
<input type="text" name="user" maxlength="30" value="" />
Password:
<input type="password" name="pass" maxlength="30" value="" />
<input type="submit" name="submit" value="Create" />
</form>

</body>
</html>
<?php
if (isset($connection)){$connection = null;}
?>
