<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
		if (logged_in()) {
		redirect_to("frontpage.php");
	}
 ?>
 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>

<?php
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$username = trim($_POST['user']);
		$password = trim($_POST['pass']);
		
		try {
			// Prepare the SQL query using PDO
			$query = "SELECT id, user, pass FROM users WHERE user = :username LIMIT 1";
			$stmt = $connection->prepare($query);
			
			// Bind the username parameter
			$stmt->bindParam(':username', $username);
			$stmt->execute();
			
			// Fetch the result
			$found_user = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if ($found_user) {
				// Check if the password is correct
				if (password_verify($password, $found_user['pass'])) {
					// Username/password authenticated
					$_SESSION['user_id'] = $found_user['id'];
					$_SESSION['user'] = $found_user['user'];
					redirect_to("frontpage.php");
				} else {
					// Password is incorrect
					$message = "Username/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
				}
			} else {
				// No user found
				$message = "Username/password combination incorrect.<br />
				Please make sure your caps lock key is off and try again.";
			}
		} catch (PDOException $e) {
			die("Database query failed: " . $e->getMessage());
		}
	} else { // Form has not been submitted.
		if (isset($_GET['logout']) && $_GET['logout'] == 1) {
			$message = "You are now logged out.";
		} 
	}

	// Display the message if set
	if (!empty($message)) {
		echo "<p>" . $message . "</p>";
	}
?>

<h2>Please login</h2>
<form action="" method="post">
Username:
<input type="text" name="user" maxlength="30" value="" />
Password:
<input type="password" name="pass" maxlength="30" value="" />
<input type="submit" name="submit" value="Login" />
</form>


</body>
</html>
<?php
if (isset($connection)){$connection = null;}
?>