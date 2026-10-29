
<?php
require("func.php");

if (isset($_POST['Submit'])) {
    $id = $_POST['id'];

    $query = "SELECT * FROM sec WHERE ID = $id";

    $result = mysqli_query($connection, $query);

    echo "<h3>Executed SQL:</h3>";
    echo "<pre>" . htmlspecialchars($query) . "</pre>";

} else {
    $id = "";
    $result = false;
}
?>

<form name="sec" method="post" action="">
    <h2>Search for a message!</h2>

    <b>Message ID:</b>
    <input type="text" name="id"
           value="<?php echo htmlspecialchars($id); ?>">

    <input name="Submit" type="submit" value="Submit">
</form>

<h1>DB output:</h1>

<?php
if ($result) {

    while ($row = mysqli_fetch_array($result)) {
        echo "<b>Id :</b>";
        echo htmlspecialchars($row['ID']) . "<br>";

        echo "<b>text:</b>";
        echo htmlspecialchars($row['text']);

        echo "<br><hr>";
    }

} elseif (isset($_POST['Submit'])) {
    echo "<p>SQL error: " .
        htmlspecialchars(mysqli_error($connection)) .
        "</p>";
}
?>
