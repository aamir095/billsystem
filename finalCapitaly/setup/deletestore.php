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
$sql = "DELETE from store where id='$u'";
if($conn->query($sql)==TRUE)
{
    echo "<script>window.location='store.php'</script>";
}
?>
