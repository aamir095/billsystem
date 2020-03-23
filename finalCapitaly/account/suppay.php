<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$a = $_POST['supplier'];
	$b = $_POST['scode'];
	$c = $_POST['website'];
	$d = $_POST['address'];
	$e = $_POST['contact'];
	$f = $_POST['email'];
	$g = $_POST['entrydate'];
	$h = $_POST['paydate'];
	$i = $_POST['paythrough'];
	$j = $_POST['chequeno'];
	$k = $_POST['amount'];
	$l = $_POST['amount'];

	$sql = "INSERT INTO supplierpay(supcode,supname,address,website,email,contact,entrydate,paymentdate,paythrough,chequeno,total_amount,remain)VALUES('$b','$a','$d','$c','$f','$e','$g','$h','$i','$j','$k','$l')";
	if ($conn->query($sql) == TRUE) {
        echo"<script>window.location='supplierpayment.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='supplierpayment.php'</script>";
    }
}?>
