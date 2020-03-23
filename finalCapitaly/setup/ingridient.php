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
      			<a class="nav-item nav-color nav-link nav_active nav-right" href="../setup.php"><i class="i_left fa fa-cog"></i>Setup</a>
      			<a class="nav-item nav-color nav-link nav-right" href="../purchase.php"><i class="i_left fa fa-receipt"></i>Purchase</a>
      			<a class="nav-item nav-color nav-link nav-right" href="../sales.php"><i class="i_left fa fa-swatchbook"></i>Sales</a>
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
      <a class="nav-item nav-link nav-color" href="customer.php"><i class="i_left fa fa-user-plus"></i>Customer</a>
      <a class="nav-item nav-link nav-color" href="supplier.php"><i class="i_left fa fa-truck-loading"></i>Supplier</a>
      <a class="nav-item nav-link nav-color" href="unit.php"><i class="i_left fa fa-weight-hanging"></i>Unit</a>
      <a class="nav-item nav-link nav-color" href="store.php"><i class="i_left fa fa-store"></i>Store</a>
      <a class="nav-item nav-link nav-color" href="newmaterial.php"><i class="i_left fa fa-luggage-cart"></i>Material</a>
      <a class="nav-item nav-link nav-color" href="newproduct.php"><i class="i_left fa fa-calendar-alt"></i>Product</a>
      <a class="nav-item nav-link nav-color tab_active" href="ingridient.php"><i class="i_left fa fa-atom"></i>Ingridient</a>
    </div>
    <div class="tab_card">
      <div class="tab_container">
        <button type="buttion" class="button" data-toggle="modal" data-target="#addcustomer">
          <i class="fa fa-plus"></i>
          Enter Ingridient
        </button>
          <div class="modal fade" id="addcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content" style="background-color: #004f1e;">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Ingridient use to make Product</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" action="addingridient.php">
                    <div class="modal-body">
                      <div class="form-row">
                            <label for="code" class="col-sm-3" style="color: white;">Code:</label>
                            <div class="col">
                              <input type="text" id="code" name="pcode" class="form-control form-control-sm" required style="width: 50%;">
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="name" class="col-sm-3" style="color: white;">Product Name:</label>
                            <div class="col">
                              <input type="text" id="name" name="pname" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                            <label for="quantity" style="color: white;" class="col-sm-3">Quantity:</label>
                            <div class="col">
                              <input type="text" name="pqty" id="quantity" class="form-control form-control-sm " autocomplete="off" required>
                            </div>
                            <label for="unit" class="" style="color: white;">Unit:</label>
                            <div class="col">
                              <select id="unit" name="punit" class="form-control form-control-sm" required>
                                <option value="0">Select Unit</option>
                                <?php $sql = "SELECT * FROM unit";
                                $result = $conn->query($sql);
                                  if ($result->num_rows > 0) {
                                    while($data = mysqli_fetch_array($result)){?>
                                <option value="<?php echo $data['Unit']?>"><?php echo $data['Unit'];?></option>
                              <?php }}?>
                              </select>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="store" class="col-sm-3" style="color: white;">Store:</label>
                            <div class="col">
                              <select id="store" name="pstore" class="form-control form-control-sm" required>
                                <option value="0">Select Store</option>
                                <?php $sql = "SELECT * FROM store";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                  while ($data = mysqli_fetch_array($result)) {?>
                                    <option value="<?php echo $data['Store']?>"><?php echo $data['Store'];?></option>
                                  <?php }}?>                                
                              </select>
                            </div>
                      </div>
                     <hr class="line">
                     <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="name" class="col-sm-3" style="color: white;">Raw Material:</label>
                            <div class="col">
                              <input type="text" id="name" name="rawname" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                            <label for="quantity" style="color: white;" class="col-sm-3">Quantity:</label>
                            <div class="col">
                              <input type="text" id="quantity" name="rawqty" class="form-control form-control-sm " autocomplete="off" required>
                            </div>
                            <label for="unit" class="" style="color: white;">Unit:</label>
                            <div class="col">
                              <select id="unit" name="rawunit" class="form-control form-control-sm" required>
                                <option value="0">Select Unit</option>
                                <?php $sql = "SELECT * FROM unit";
                                $result = $conn->query($sql);
                                  if ($result->num_rows > 0) {
                                    while($data = mysqli_fetch_array($result)){?>
                                <option value="<?php echo $data['Unit']?>"><?php echo $data['Unit'];?></option>
                              <?php }}?>
                              </select>
                            </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" name="submit" class="save-button">Enter</button>
                    </div>
                </form>
            </div>
            </div>
          </div>
          <table class="table table-striped table-sm" style="margin-top: 2rem; color: white;">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Store</th>
                        <th scope="col">Raw Name</th>
                        <th scope="col">Raw Qty</th>
                        <th scope="col">Raw Unit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sql = "SELECT * FROM ingridient";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while ($data = mysqli_fetch_array($result)) {?>
                          <tr>
                            <td><?php echo $data['id'];?></td>
                            <td><?php echo $data['pcode'];?></td>
                            <td><?php echo $data['pname'];?></td>
                            <td><?php echo $data['quantity'];?></td>
                            <td><?php echo $data['punit'];?></td>
                            <td><?php echo $data['pstore'];?></td>
                            <td><?php echo $data['rawname'];?></td>
                            <td><?php echo $data['rawqty'];?></td>
                            <td><?php echo $data['rawunit'];?></td>
                            </tr>
                          <?php }}?>
                          </tbody>
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