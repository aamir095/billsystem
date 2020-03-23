<?php require_once 'connection.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>Inventory</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
      <a class="nav-item nav-link nav-color tab_active" href="supplierpayment.php"><i class="i_left fa fa-credit-card"></i>Supplier Payment</a>
      <a class="nav-item nav-link nav-color" href="supplierbill.php"><i class="i_left fa fa-money-bill"></i>Supplier Bill</a>
      <a class="nav-item nav-link nav-color" href="paybycustomer.php"><i class="i_left fa fa-credit-card"></i>Pay By Customer</a>
      <a class="nav-item nav-link nav-color" href="supplierstatement.php"><i class="i_left fa fa-money-bill"></i>Supplier Statement</a>
      <a class="nav-item nav-link nav-color" href="customerstatement.php"><i class="i_left fa fa-money-bill"></i>Customer Statement</a>
      <a class="nav-item nav-link nav-color" href="customerpayment.php"><i class="i_left fa fa-credit-card"></i>Customer Payment</a>
    </div>
    <div class="tab_card">
      <div class="tab_container">
        <div class="mid_card">
          <form method="post" action="suppay.php">
          <div class="form-row">
            <label for="code" style="color: white;" class="col-sm-2">Code:</label>
              <div class="col">
                 <select id="code" name="code" class="form-control form-control-sm" required>
                  <option value="0">Select Code</option>
                  <?php 
                    $sql = "SELECT * FROM supplier";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      while ($data = mysqli_fetch_array($result)) {?>
                      <option value="<?php echo $data['supid'].','.$data['supname'].','.$data['Address'].','.$data['Contact'].','.$data['Email'].','.$data['Website'];?>"><?php echo $data['supid'];?></option>
                    <?php }}?>
                </select>
                <input type="hidden" id="scode" name="scode" class="form-control form-control-sm" autocomplete="off" required>
              </div>
            <label for="supplier" class="col-sm-2" style="color: white;">Supplier:</label>
              <div class="col">
               <input type="text" id="supplier" name="supplier" class="form-control form-control-sm" autocomplete="off" required readonly>
              </div>
          </div>
          <div class="form-row" style="margin-top: 0.5rem;">
            <label for="website" style="color: white;" class="col-sm-2">Website:</label>
              <div class="col">
                  <input type="text" id="website" name="website" class="form-control form-control-sm" autocomplete="off" required readonly>
                
              </div>
            <label for="address" class="col-sm-2" style="color: white;">Address:</label>
              <div class="col">
               <input type="text" id="address" name="address" class="form-control form-control-sm" autocomplete="off" required readonly>
              </div>
          </div>
          <div class="form-row" style="margin-top: 0.5rem;">
            <label for="contact" style="color: white;" class="col-sm-2">Contact:</label>
              <div class="col">
                  <input type="text" id="contact" name="contact" class="form-control form-control-sm" autocomplete="off" required readonly>
                
              </div>
            <label for="email" class="col-sm-2" style="color: white;">Email:</label>
              <div class="col">
               <input type="email" id="email" name="email" class="form-control form-control-sm" autocomplete="off" required readonly>
              </div>
          </div>
          <hr class="line">
          <div class="form-row" style="margin-top: 0.5rem;">
            <label for="entrydate" style="color: white;" class="col-sm-2">Entry Date:</label>
              <div class="col">
                  <input type="date" id="entrydate" name="entrydate" class="form-control form-control-sm" autocomplete="off" required>
                
              </div>
            <label for="paydate" class="col-sm-2" style="color: white;">Pay Date:</label>
              <div class="col">
               <input type="date" id="paydate" name="paydate" class="form-control form-control-sm" autocomplete="off" required>
              </div>
          </div>
          <hr class="line">
          <div class="form-row" style="margin-top: 0.5rem;">
            <label for="paythrough" style="color: white;" class="col-sm-2">Pay Through:</label>
              <div class="col">
                  <select id="paythrough" name="paythrough" class="form-control form-control-sm" required>
                    <option value="0">select method</option>
                    <option value="cash">Cash</option>
                    <option value="cheque">Cheque</option>
                  </select>
              </div>
            <label for="chequeno" class="col-sm-2" style="color: white;">Cheque No:</label>
              <div class="col">
               <input type="text" id="chequeno" name="chequeno" class="form-control form-control-sm" autocomplete="off">
              </div>
          </div>
                  <div class="form-row" style="margin-top: 0.5rem;">
                    <label for="amount" class="col-sm-2" style="color: white;">Amount(QAR):</label>
                    <div class="col">
                     <input type="text" id="amount" name="amount" class="form-control form-control-sm" autocomplete="off" required>
                    </div>
                    <button type="submit" id="submit" name="submit" class="save-button col-sm-2">Save</button>
                  </div>
                </form>
        </div>
      </div>
    </div>
  </nav>

	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>
      $(document).ready(function(){
        
        jQuery('#code').change(function(){
          var selectValue = $('#code').val();
          var selectText = $("#code option:selected").text();
          if(selectValue != 0)
          {
            var selectValueSplit = selectValue.split(",");
            var code = selectValueSplit[0];
            var Name = selectValueSplit[1];
            var Address = selectValueSplit[2];
            var Contact = selectValueSplit[3];
            var Email = selectValueSplit[4];
            var Website = selectValueSplit[5];

            $('#code').val(selectValue);
            $('#scode').val(code);
            $('#supplier').val(Name);
            $('#address').val(Address);
            $('#contact').val(Contact);
            $('#email').val(Email);
            $('#website').val(Website);
              }
        });
       }); 
      </script>
</body>
</html>