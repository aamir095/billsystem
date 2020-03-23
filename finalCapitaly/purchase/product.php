<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$a = $_POST['date'];
	$b = $_POST['code'];
	$c = $_POST['name'];
	$d = $_POST['qty'];
	$e = $_POST['unit'];
	$f = $_POST['store'];
	$g = $_POST['rate'];
	$i = $_POST['reference'];
	$j = $_POST['qty'];

	$sql = "INSERT INTO existingpro(code,date,name,quantity,rate,unit,store,reference,remain)VALUES('$b','$a','$c','$d','$g','$e','$f','$i','$j')";
	if ($conn->query($sql) == TRUE) {
        echo"<script>window.location='existingproduct.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='existingproduct.php'</script>";
    }
}?>
