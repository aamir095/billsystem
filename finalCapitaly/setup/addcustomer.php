<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$a = $_POST['date'];
	$b = $_POST['code'];
	$c = $_POST['name'];
	$d = $_POST['address'];
	$e = $_POST['contact'];
	$f = $_POST['email'];

	$sql = "INSERT INTO customer(cusid,cusname,Address,Phone,Email,Date)VALUES('$b','$c','$d','$e','$f','$a')";
	if ($conn->query($sql) == TRUE) {
        echo"<script>window.location='customer.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='customer.php'</script>";
    }
}?>
