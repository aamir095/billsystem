<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$a = $_POST['date'];
	$b = $_POST['code'];
	$c = $_POST['name'];
	$d = $_POST['address'];
	$e = $_POST['contact'];
	$f = $_POST['email'];
	$g = $_POST['website'];

	$sql = "INSERT INTO supplier(supid,supname,Address,Contact,Email,Website,Date)VALUES('$b','$c','$d','$e','$f','$g','$a')";
	if ($conn->query($sql) == TRUE) {
        echo"<script>window.location='supplier.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='supplier.php'</script>";
    }
}?>
