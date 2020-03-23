<?php require_once 'report/connection.php';
$date =   date("Y-m-d") . "<br>";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Inventory</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg" style="background-color: maroon;">
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"><i class="fa fa-bars" style="color: white;"></i></span>
  		</button>
  		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    		<div class="navbar-nav">
      			<a class="nav-item nav-color nav-link nav-right" href="setup.php"><i class="i_left fa fa-cog"></i>Setup</a>
      			<a class="nav-item nav-color nav-link nav-right" href="purchase.php"><i class="i_left fa fa-receipt"></i>Purchase</a>
      			<a class="nav-item nav-color nav-link nav-right" href="sales.php"><i class="i_left fa fa-swatchbook"></i>Sales</a>
      			<a class="nav-item nav-color nav-link nav-right" href="account.php"><i class="i_left fa fa-calculator"></i>Account</a>
      			<a class="nav-item nav-color nav-link nav-right" href="inventory.php"><i class="i_left fa fa-plus-square"></i>Inventory</a>
      			<a class="nav-item nav-color nav-link nav-right" href="report.php"><i class="i_left fa fa-file-invoice"></i>Report</a>
      			<a class="nav-item nav-color nav-link nav-right nav_active" href="notification.php"><i class="i_left fa fa-bell"></i>Notification</a>
      			<a class="nav-item nav-color nav-link nav-right" href="index.php"><i class="i_left fa fa-sign-out-alt"></i>Logout</a>
    		</div>
  		</div>
	</nav>
    <div class="tab_card" style="margin-top: 5%; width: 80%; margin-left: 10%;">
      <div class="tab_container">
                <table class="table table-striped table-sm" style="margin-top: 2rem; color: white;">
                    <thead>
                      <tr>
                        <th scope="col">Invoice No</th>
                        <th scope="col">Receiver</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Delivery Date</th>
                        <th scope="col">Grand Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $sql = "SELECT * FROM salesbill WHERE deliverydate = '$date'";
                      $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                          while ($data = mysqli_fetch_array($result)) {?>
                            <tr>
                              <th><?php echo $data['invoiceno'];?></th>
                              <th><?php echo $data['toname'];?></th>
                              <th><?php echo $data['orderdate'];?></th>
                              <th><?php echo $data['deliverydate'];?></th>
                              <th><?php echo $data['grandtotal'];?></th>
                            </tr>
                          <?php }}?>
                    </tbody>
                  </table>
      </div>
    </div>

 
	<script type="text/javascript" src="js/bootstrap.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</body>
</html>