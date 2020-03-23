<?php require_once 'connection.php';
if (isset($_POST['submit'])) {
	$i = $_POST['edit_id'];
	$a = $_POST['date'];
	$b = $_POST['qty'];
	$c = $_POST['rate'];
	$d = $_POST['reference'];

	$ss = "SELECT * FROM existingpro WHERE id = '$i'";
    $result = $conn->query($ss);
    $data = mysqli_fetch_array($result);
    $q = $data['quantity'];
    $d = $b;

    $sss = "UPDATE `existingpro` SET `quantity` = '$d' WHERE id = '$i'";

	if (($data == TRUE) && ($conn->query($sss) == TRUE)) {
        echo"<script>window.location='existingproduct.php'</script>";
    }
    else {
        echo"<script>alert('Something went wrong! Couldn't Added');</script>";
        echo"<script>window.location='existingproduct.php'</script>";
    }
}
?>