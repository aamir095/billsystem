<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$a = $_POST['date'];
	$b = $_POST['code'];
	$c = $_POST['name'];
	$d = $_POST['qty'];
	$e = $_POST['unit'];
	$f = $_POST['store'];
	$g = $_POST['rate'];
	$h = $_POST['supplier'];
	$i = $_POST['reference'];
	$j = $_POST['qty'];

	$sql = "INSERT INTO existingraw(code,date,name,quantity,rate,unit,supplier,store,reference,remain)VALUES('$b','$a','$c','$d','$g','$e','$h','$f','$i','$j')";
	if ($conn->query($sql) == TRUE) {
        echo"<script>window.location='existingmaterial.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='existingmaterial.php'</script>";
    }
}?>
