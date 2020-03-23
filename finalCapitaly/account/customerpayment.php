<?php require_once 'connection.php';
$invoiceno = null;
$cusname = null;
if (isset($_POST['get'])) {
  $invoiceno = $_POST['hidden_code'];
  $cusname = $_POST['hidden_name'];
}?> 
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
      <a class="nav-item nav-link nav-color" href="customerstatement.php"><i class="i_left fa fa-money-bill"></i>Customer Statement</a>
      <a class="nav-item nav-link nav-color tab_active" href="customerpayment.php"><i class="i_left fa fa-credit-card"></i>Customer Payment</a>
    </div>
    <div class="tab_card"style="height: 20rem;" >
      <div class="tab_container">
        <div class="side_card" style="margin-right:2rem;">
          <div class="form-row" style="margin-top: 0.5rem;">
                <div class="col">
                  <input type="text" id="name" class="form-control form-control-sm" autocomplete="off" required>
                </div>
          </div>
                  <table class="table table-striped table-sm" style="margin-top: 1rem; color: white;">
                    <thead>
                      <tr>
                        <th scope="col">Invoice</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $sql = "SELECT * FROM salesbill ORDER BY id ASC";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while ($data = mysqli_fetch_array($result)) {?>
                          <form method="post" action="customerpayment.php?id=<?php echo $data["id"]; ?>">
                          <tr>
                            <td><?php echo $data['invoiceno'];?></td>
                            <td><?php echo $data['toname'];?></td>
                            <input type="hidden" name="hidden_code" value="<?php echo $data["invoiceno"];?>" />
                            <input type="hidden" name="hidden_name" value="<?php echo $data["toname"]; ?>" />
                            <td><input type="submit" name="get" class="save-button" value=">>" /></td>
                          </tr>
                          </form>
                          <?php }}?>
                    </tbody>
                  </table>
          </div>

          <div class="form-row">
            <label for="supplier" style="color: white;">Customer Name:</label>
                <div class="col">
                  <input type="text" id="supplier" class="form-control form-control-sm" style="width: 50%;" autocomplete="off" required value="<?php echo $cusname;?>" readonly>
                </div>
                  <table class="table table-striped table-sm" style="margin-top: 1rem; color: white;">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Invoice No</th>
                        <th scope="col">Amount to Pay</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $sql = "SELECT * FROM customerpay WHERE invoice = '$invoiceno'";
                          $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                              while ($data = mysqli_fetch_array($result)) {?>
                        <tr>
                        <td><?php echo $data['date'];?></td>
                        <td><?php echo $invoiceno;?></td>
                        <td><?php echo $data['amounttopay'];?></td>
                        </tr>
                        <?php }}?>
                    </tbody>
                  </table>
          </div>

          <hr class="line" style="margin-left: 18rem;">
          <div class="form-row" style="margin-left: 18rem;">
                  <table class="table table-striped table-sm" style="margin-top: 1rem; color: white;">
                    <thead>
                      
                      <tr>
                        <th scope="col">Payment Date</th>
                        <th scope="col">Payment Through</th>
                        <th scope="col">Receipt No</th>
                        <th scope="col">Cheque No</th>
                        <th scope="col">Paid Amount</th>
                      </tr>
                    </thead>
                    <?php 
                        $sql = "SELECT * FROM customerpay JOIN salesbill ON customerpay.invoice = salesbill.invoiceno WHERE customerpay.invoice = '$invoiceno'";
                          $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                              while ($data = mysqli_fetch_array($result)) {?>
                    <tbody>
                      <tr>
                        <td><?php echo $data['date'];?></td>
                        <td><?php echo $data['paythrough'];?></td>
                        <td><?php echo $data['receiptno'];?></td>
                        <td><?php echo $data['chequeno'];?></td>
                        <td><?php echo $data['amount'];?></td>
                      </tr>
                      
                    </tbody>
                <?php }}?>
                  </table>
                    
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