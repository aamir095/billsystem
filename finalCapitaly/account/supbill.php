<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$a = $_POST['supplier'];
	$b = $_POST['scode'];
	$c = $_POST['date'];
	$d = $_POST['billno'];
	$e = $_POST['amount'];
	$f = $_POST['remain'];

	$sql = "INSERT INTO supplierbill(supcode,date,supname,billno,amount)VALUES('$b','$c','$a','$d','$e')";

	$s = "UPDATE supplierpay SET remain = '$f' WHERE supcode = '$b'";

	if (($conn->query($sql) && $conn->query($s)) == TRUE) {
        echo"<script>window.location='supplierbill.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='supplierbill.php'</script>";
    }
}?>
