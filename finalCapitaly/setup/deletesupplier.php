 <?php require_once 'connection.php';
$PId = $_GET['del'];
if(!is_numeric($PId))
{
	echo"invalid request";
	die();
}
else
{
	$u=$_GET['del'];
}
$sql = "DELETE from supplier where id='$u'";
if($conn->query($sql)==TRUE)
{
    echo "<script>window.location='supplier.php'</script>";
}
?>
