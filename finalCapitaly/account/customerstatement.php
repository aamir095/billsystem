<?php require_once 'connection.php';
$total_amount = null; ?>
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
            <a class="nav-item nav-color nav-link nav-right" href="../sales.php"><i class="i_left fa fa-swatchbook"></i>Sales</a>
            <a class="nav-item nav-color nav-link nav-right nav_active" href="../account.php"><i class="i_left fa fa-calculator"></i>Account</a>
            <a class="nav-item nav-color nav-link nav-right" href="../inventory.php"><i class="i_left fa fa-plus-square"></i>Inventory</a>
            <a class="nav-item nav-color nav-link nav-right" href="../report.php"><i class="i_left fa fa-file-invoice"></i>Report</a>
            <a class="nav-item nav-color nav-link nav-right" href="../notification.php"><i class="i_left fa fa-bell"></i>Notification</a>
            <a class="nav-item nav-color nav-link nav-right" href="../index.php"><i class="i_left fa fa-sign-out-alt"></i>Logout</a>
        </div>
      </div>
  </nav>

  <nav style="padding: 4.5rem; padding-top: 3rem;">
    <div class="nav nav-tabs" role="tablist">
      <a class="nav-item nav-link nav-color" href="supplierpayment.php"><i class="i_left fa fa-credit-card"></i>Supplier Payment</a>
      <a class="nav-item nav-link nav-color" href="supplierbill.php"><i class="i_left fa fa-money-bill"></i>Supplier Bill</a>
      <a class="nav-item nav-link nav-color" href="paybycustomer.php"><i class="i_left fa fa-credit-card"></i>Pay By Customer</a>
      <a class="nav-item nav-link nav-color" href="supplierstatement.php"><i class="i_left fa fa-money-bill"></i>Supplier Statement</a>
      <a class="nav-item nav-link nav-color tab_active" href="customerstatement.php"><i class="i_left fa fa-money-bill"></i>Customer Statement</a>
      <a class="nav-item nav-link nav-color" href="customerpayment.php"><i class="i_left fa fa-credit-card"></i>Customer Payment</a>
    </div>
    <div class="tab_card">
      <div class="tab_container">
        <div class="form-row" style="color: white;">
            <div class="form-group col-md-3">
              <label for="customer">Customer</label>
              <input type="text" id="customer" class="form-control form-control-sm">
            </div>
            <div class="form-group col-md-3">
              <label for="mobile">Mobile</label>
              <input type="text" class="form-control form-control-sm" id="mobile">
            </div>  
        </div>
        <div class="form-row">
                  <table class="table table-striped table-sm" style="margin-top: 1rem; color: white;">
                    <thead>
                      <tr>
                        <th scope="col">Order Date</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Delivery Date</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Total</th>
                        <th scope="col">After Discount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $sql = "SELECT * FROM salesbill JOIN product_item on salesbill.id = product_item.salesbill_id";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while ($data = mysqli_fetch_array($result)) {?>
                          <tr>
                            <td><?php echo $data['orderdate'];?></td>
                            <td><?php echo $data['invoiceno'];?></td>
                            <td><?php echo $data['toname'];?></td>
                            <td><?php echo $data['mobile'];?></td>
                            <td><?php echo $data['deliverydate'];?></td>
                            <td><?php echo $data['item_unit'];?></td>
                            <td><?php echo $data['item_quantity'];?></td>
                            <td><?php echo $data['item_rate'];?></td>
                            <td><?php echo $data['before_discount'];?>
                            <td><?php echo $data['grandtotal'];?></td>
                            <?php $total_amount = $total_amount + $data['grandtotal']; ?>
                          </tr>
                      <?php }}?>
                    </tbody>
                  </table>
                  <span style="color: white;">TOTAL: <?php echo $total_amount; ?></span>
          </div>
      </div>
    </div>
  </nav>

  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>