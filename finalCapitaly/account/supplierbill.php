<?php require_once('connection.php');?>
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
      <a class="nav-item nav-link nav-color tab_active" href="supplierbill.php"><i class="i_left fa fa-money-bill"></i>Supplier Bill</a>
      <a class="nav-item nav-link nav-color" href="paybycustomer.php"><i class="i_left fa fa-credit-card"></i>Pay By Customer</a>
      <a class="nav-item nav-link nav-color" href="supplierstatement.php"><i class="i_left fa fa-money-bill"></i>Supplier Statement</a>
      <a class="nav-item nav-link nav-color" href="customerstatement.php"><i class="i_left fa fa-money-bill"></i>Customer Statement</a>
      <a class="nav-item nav-link nav-color" href="customerpayment.php"><i class="i_left fa fa-credit-card"></i>Customer Payment</a>
    </div>
    <div class="tab_card">
      <div class="tab_container">
        <form method="post" action="supbill.php">
        <div class="form-row" style="color: white;">
            <div class="form-group col-md-2">
              <label for="date">Date</label>
              <input type="date" name="date" class="form-control form-control-sm" id="date">
            </div>
            <div class="form-group col-md-3">
              <label for="code">Code</label>
              <select id="code" name="code" class="form-control form-control-sm">
                <option value="0">supplier code</option>
                <?php
                $sql = "SELECT * FROM supplierpay";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      while ($data = mysqli_fetch_array($result)) {?>
                      <option value="<?php echo $data['supcode'].','.$data['supname'].','.$data['remain'];?>"><?php echo $data['supcode'];?></option>
                    <?php }}?>
              </select>
              <input type="hidden" name="scode" class="form-control form-control-sm" id="scode">
            </div>
            <div class="form-group col-md-2">
              <label for="supplier">Supplier</label>
              <input type="text" name="supplier" class="form-control form-control-sm" id="supplier" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="amounttopay">Amount To Pay</label>
              <input type="text" name="amounttopay" class="form-control form-control-sm" id="amounttopay" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="billno">Bill No</label>
              <input type="text" name="billno" class="form-control form-control-sm" id="billno">
            </div>
            <div class="form-group col-md-2">
              <label for="amount">Amount</label>
              <input type="text" name="amount" class="form-control form-control-sm" id="amount" autocomplete="off">
            </div>
            <div class="form-group col-md-2">
              <label for="remain">Remain Total</label>
              <input type="text" name="remain" class="form-control form-control-sm remain_amount" id="remain" readonly>
            </div>
            <div class="form-group" style="margin-top: 1.8rem;">
             <button type="submit" id="submit" name="submit" class="save-button">Save</button>
           </div>            
        </div>
      </form>
      </div>
    </div>
  </nav>

	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
        
        jQuery('#code').change(function(){
          var selectValue = $('#code').val();
          var selectText = $("#code option:selected").text();
          if(selectValue != 0)
          {
            var selectValueSplit = selectValue.split(",");
            var code = selectValueSplit[0];
            var Name = selectValueSplit[1];
            var Amounttopay = selectValueSplit[2];

            $('#code').val(selectValue);
            $('#scode').val(code);
            $('#supplier').val(Name);
            $('#amounttopay').val(Amounttopay);
          }
          });
        function cal_remain(){
          var total = 0;
          var payamount = 0;
          var remain = 0;
          total = $('#amounttopay').val();
          payamount = $('#amount').val();
          if (payamount > 0) {
          remain = parseFloat(total) - parseFloat(payamount);
          $('#remain').val(remain);
          }
        }
        $(document).on('click', '.remain_amount', function(){
          cal_remain();
        });
        });
      </script>
</body>
</html>