<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$i = $_POST['edit_id'];
	$a = $_POST['name'];

	$sql = "UPDATE unit SET Unit = '$a' WHERE id = '$i'";
	if ($conn->query($sql) == TRUE) {
        echo"<script>window.location='unit.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='unit.php'</script>";
    }
}
?>