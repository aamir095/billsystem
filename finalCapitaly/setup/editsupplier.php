<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$i = $_POST['edit_id'];
	$a = $_POST['date'];
	$d = $_POST['address'];
	$e = $_POST['contact'];
	$f = $_POST['email'];
	$g = $_POST['website'];

	$sql = "UPDATE supplier SET Address = '$d', Contact = '$e', Email = '$f', Website = '$g', Date='$a' WHERE id = '$i'";
	if ($conn->query($sql) == TRUE) {
        echo"<script>window.location='supplier.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='supplier.php'</script>";
    }
}
?>