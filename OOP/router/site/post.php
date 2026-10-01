<!DOCTYPE html>
<html>
<head>
	<title>Welcome to the Post Page</title>
</head>
<body>

	<h1>Welcome to the Post Page</h1>
	<p>Look up id number <?php print_r($args); ?> in the database</p>
<?php if (isset($_GET['id'])){echo $_GET['id'];}

if (isset($_GET['newsID'])) {
    echo $_GET['newsID'];
}

?>


</body>
</html>