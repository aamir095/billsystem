

<?php require_once'connection.php';?>
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
            <a class="nav-item nav-color nav-link nav-right" href="../account.php"><i class="i_left fa fa-calculator"></i>Account</a>
            <a class="nav-item nav-color nav-link nav-right nav_active" href="../inventory.php"><i class="i_left fa fa-plus-square"></i>Inventory</a>
            <a class="nav-item nav-color nav-link nav-right" href="../report.php"><i class="i_left fa fa-file-invoice"></i>Report</a>
            <a class="nav-item nav-color nav-link nav-right" href="../notification.php"><i class="i_left fa fa-bell"></i>Notification</a>
            <a class="nav-item nav-color nav-link nav-right" href="../index.php"><i class="i_left fa fa-sign-out-alt"></i>Logout</a>
        </div>
      </div>
  </nav>

  <nav style="padding: 8rem; padding-top: 3rem;">
    <div class="nav nav-tabs" role="tablist">
      <a class="nav-item nav-link nav-color" href="product.php"><i class="i_left fa fa-calendar-alt"></i>Product</a>
      <a class="nav-item nav-link nav-color tab_active" href="rawmaterial.php"><i class="i_left fa fa-luggage-cart"></i>Raw Material</a>
    </div>
    <div class="tab_card">
      <div class="tab_container">
        <div class="form-row" style="color: white;">
            <div class="form-group col-md-3">
              <label for="raw">Raw Name</label>
              <input type="text" id="raw" onkeyup="rawmaterial()" class="form-control form-control-sm">
            </div>
            <div class="form-group col-md-3">
              <label for="store">Store</label>
              <input type="text" class="form-control form-control-sm" id="store">
            </div>
           <!--  <div class="form-group col-md-2">
              <label for="fromdate">From Date</label>
              <input type="date" id="fromdate" class="form-control form-control-sm">
            </div>
            <div class="form-group col-md-2">
              <label for="todate">To Date</label>
              <input type="date" id="todate" class="form-control form-control-sm">
            </div>  --> 
            <div class="form-group col-md-2" style="margin-top: 1.8rem;">
              <button type="submit" id="save-button" class="save-button">Show</button>
        </div>
      </div>
        <div class="form-row">
                  <table class="table table-striped table-sm" id="tabledata" style="margin-top: 1rem; color: white;">
                    <thead>
                      <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Available</th>
                        <th scope="col">Sales Qty</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Store</th>
                        <th scope="col">Purchase Date</th>
                      </tr>
                    </thead>
                    <tbody id="tbodydata">
                      <?php $sql = "SELECT * FROM existingraw";
                      $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                          while ($data = mysqli_fetch_array($result)) {?>
                            <tr>
                              <td><?php echo $data['code'];?></td>
                              <td><?php echo $data['name'];?></td>
                              <td><?php echo $data['quantity'];?></td>
                              <td><?php echo $data['remain'];?></td>
                              <?php $salesqty = $data['quantity'] - $data['remain'];?>
                              <td><?php echo $salesqty;?></td>
                              <td><?php echo $data['rate'];?></td>
                              <td><?php echo $data['store'];?></td>
                              <td><?php echo $data['date'];?></td>
                            </tr>
                          <?php }}?>
                    </tbody>
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

<script type="text/javascript">
  
 var $rows = $('#tbodydata tr');
$('#save-button').on('click', function() {
    var val1 = $.trim($('#raw').val()).replace(/ +/g, ' ').toLowerCase();
    var val2 = $.trim($('#store').val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text1 = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
        var text2 = $(this).find('td:nth-child(7)').text().replace(/\s+/g, ' ').toLowerCase();
        return !~text1.indexOf(val1) || !~text2.indexOf(val2);
    }).hide();
});

</script>
</html>