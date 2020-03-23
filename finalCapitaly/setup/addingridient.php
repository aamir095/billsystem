<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$a = $_POST['pcode'];
	$b = $_POST['pname'];
	$c = $_POST['pqty'];
	$d = $_POST['pstore'];
	$e = $_POST['punit'];
	$f = $_POST['rawname'];
	$g = $_POST['rawqty'];
	$h = $_POST['rawunit'];

	$sql = "INSERT INTO ingridient(pcode,pname,quantity,punit,pstore,rawname,rawqty,rawunit)VALUES('$a','$b','$c','$e','$d','$f','$g','$h')";
	if ($conn->query($sql) == TRUE) {
        echo"<script>window.location='ingridient.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='ingridient.php'</script>";
    }
}?>
