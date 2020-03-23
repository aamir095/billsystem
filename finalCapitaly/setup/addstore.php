<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$a = $_POST['name'];

	$sql = "INSERT INTO store(Store)VALUES('$a')";
	if ($conn->query($sql) == TRUE) {
        echo"<script>window.location='store.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='store.php'</script>";
    }
}?>
