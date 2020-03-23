<?php
session_start();
include('config.php');
if(isset($_POST['login']))
{
	$uname=$_POST['username'];
	$password=$_POST['password'];
	$sql = "SELECT Username,Password FROM staff WHERE Username=:uname and Password=:password";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
	$query-> bindParam(':password', $password, PDO::PARAM_STR);
	$query-> execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0){
		$_SESSION['staff_login']=$_POST['username'];
		echo "<script type='text/javascript'> document.location = 'home.php'; </script>";
	} else{
  		echo "<script>alert('Invalid Details');</script>";}
	}?>

<!DOCTYPE html>
<html>
<head>
	<title>Inventory</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<div class="card text-white bg-success mb-3" style="max-width: 18rem;margin-top: 10%;margin-left: 35%;">
  		<div class="card-header">Staff Login</div>
  			<div class="card-body">
  				<form method="post" name="login">
	  				<input class="form-control form-control-sm" type="text" name="username" placeholder="username" autocomplete="off" required style="width: 13rem;">
	  				<input class="form-control form-control-sm" type="password" name="password" placeholder="password" autocomplete="off" required style="margin-top: 1rem; width: 13rem;">
	  				<button type="submit" name="login" class="btn btn-success" style="margin-top: 1rem;">Login</button>
  				</form>
  		</div>
	</div>

	<script type="text/javascript" src="js/bootstrap.bundle.js"></script>
	<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>