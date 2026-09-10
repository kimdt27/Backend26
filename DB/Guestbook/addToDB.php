<?php
require ("includes/connection.php");
if(isset($_POST['submit'])) {

    function err ($error)
    {
        echo "there is erroror!!!";
        echo $error;
        die();
    }

    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        err("no input to validate!");
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $err_msg = "";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_msg .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp,$name)) {
        $err_msg .= 'The Name you entered does not appear to be valid.<br />';
    }

    if(strlen($message) < 2) {
        $err_msg .= 'The Message you entered does not appear to be valid.<br />';
    }

    if($err_msg != "") {
        err($err_msg);
    }

    $query = $db->prepare("INSERT INTO `guestbook` (`ID`, `name`, `email`, `message`) 
                            VALUES (NULL, :name, :email, :message);");

    if(!$query->execute([':name' => $name, ':email' => $email, ':message' => $message]))
    {
        $errorInfo = $query->errorInfo();
        die("you really f....ed up! ".$errorInfo[2]);
    }

?>

    Thank you for your message <?php echo $name; ?>.

<?php
}
?>
