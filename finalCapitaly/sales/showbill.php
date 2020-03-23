<?php require_once'connection.php';
$statement = $connect->prepare("
    SELECT * FROM salesbill 
    ORDER BY id DESC
  ");
  $statement->execute();
  $all_result = $statement->fetchAll();
  $total_rows = $statement->rowCount();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inventory</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg" style="background-color: maroon;">
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"><i class="fa fa-bars" style="color: white;"></i></span>
  		</button>
  		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    		<div class="navbar-nav">
      			<a class="nav-item nav-color nav-link nav-right" href="../setup.php"><i class="i_left fa fa-cog"></i>Setup</a>
      			<a class="nav-item nav-color nav-link nav-right" href="../purchase.php"><i class="i_left fa fa-receipt"></i>Purchase</a>
      			<a class="nav-item nav-color nav-link nav-right nav_active" href="../sales.php"><i class="i_left fa fa-swatchbook"></i>Sales</a>
      			<a class="nav-item nav-color nav-link nav-right" href="../account.php"><i class="i_left fa fa-calculator"></i>Account</a>
      			<a class="nav-item nav-color nav-link nav-right" href="../inventory.php"><i class="i_left fa fa-plus-square"></i>Inventory</a>
      			<a class="nav-item nav-color nav-link nav-right" href="../report.php"><i class="i_left fa fa-file-invoice"></i>Report</a>
      			<a class="nav-item nav-color nav-link nav-right" href="../notification.php"><i class="i_left fa fa-bell"></i>Notification</a>
      			<a class="nav-item nav-color nav-link nav-right" href="../index.php"><i class="i_left fa fa-sign-out-alt"></i>Logout</a>
    		</div>
  		</div>
	</nav>

  <nav style="padding: 8rem; padding-top: 3rem;">
    <div class="nav nav-tabs" role="tablist">
      <a class="nav-item nav-link nav-color" href="salesbill.php"><i class="i_left fa fa-chart-line"></i>Product Bill</a>
      <a class="nav-item nav-link nav-color" href="rawbill.php"><i class="i_left fa fa-chart-line"></i>Raw-Material Bill</a>
      <a class="nav-item nav-link nav-color tab_active" href="showbill.php"><i class="i_left fa fa-money-bill"></i>Show Bill</a>
      <a class="nav-item nav-link nav-color" href="deliveryreport.php"><i class="i_left fa fa-file-invoice"></i>Delivery Report</a>
    </div>
    <div class="tab_card">
      <div class="tab_container">
        <table id="data-table" class="table table-striped" style="margin-top: 2rem; color: white;">
        <thead>
          <tr>
            <th>#</th>
            <th>Invoice No.</th>
            <th>Invoice Date</th>
            <th>Delivery Date</th>
            <th>Receiver</th>
            <th>Address</th>
            <th>Invoice Total</th>
            <th>PDF</th>
          </tr>
        </thead>
        <?php
        $id=1;
        if($total_rows > 0)
        {
          foreach($all_result as $row)
          {
            echo '
              <tr>
                <td>'.$id++.'</td>
                <td>'.$row["invoiceno"].'</td>
                <td>'.$row["orderdate"].'</td>
                <td>'.$row["deliverydate"].'</td>
                <td>'.$row["receiver"].'</td>
                <td>'.$row["address"].'</td>
                <td>'.$row["grandtotal"].'</td>
                <td><a href="print_invoice.php?pdf=1&id='.$row["id"].'"><i class = "fa fa-file-pdf" style="color:white;"></i></a></td>
              </tr>
            ';
          }
        }
        ?>
      </table>
      </div>
    </div>
  </nav>

	<script type="text/javascript" src="../js/bootstrap.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</body>
</html>