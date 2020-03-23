<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$a = $_POST['cusname'];
	$b = $_POST['invoiceno'];
	$c = $_POST['amounttopay'];
	$d = $_POST['paythrough'];
	$e = $_POST['chequeno'];
	$f = $_POST['receiptno'];
	$g = $_POST['amount'];
	$h = $_POST['remain'];
	$i = $_POST['date'];

	$sql = "INSERT INTO customerpay(date,invoice,cusname,amount,total,amounttopay,paythrough,receiptno,chequeno)VALUES('$i','$b','$a','$g','$c','$h','$d','$f','$e')";

	$s = "UPDATE salesbill SET remain_total = '$h' WHERE invoiceno = '$b'";

	if (($conn->query($sql) && $conn->query($s)) == TRUE) {
        echo"<script>window.location='paybycustomer.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='paybycustomer.php'</script>";
    }
}?>
