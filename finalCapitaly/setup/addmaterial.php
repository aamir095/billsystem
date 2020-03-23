<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$a = $_POST['date'];
    $b = $_POST['code'];
    $c = $_POST['name'];

	$sql = "INSERT INTO rawmaterial(code,date,rawname)VALUES('$b','$a','$c')";
	if ($conn->query($sql) == TRUE) {
        echo"<script>window.location='newmaterial.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='newmaterial.php'</script>";
    }
}?>
