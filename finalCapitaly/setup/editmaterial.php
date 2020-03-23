<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$i = $_POST['edit_id'];
	$a = $_POST['date'];
    $b = $_POST['name'];
    $c = $_POST['code'];

	$sql = "UPDATE rawmaterial SET date = '$a', code = '$c', rawname = '$b' WHERE id = '$i'";
	if ($conn->query($sql) == TRUE) {
        echo"<script>window.location='newmaterial.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='newmaterial.php'</script>";
    }
}
?>