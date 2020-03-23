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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
      <a class="nav-item nav-link nav-color tab_active" href="customer.php"><i class="i_left fa fa-user-plus"></i>Customer</a>
      <a class="nav-item nav-link nav-color" href="supplier.php"><i class="i_left fa fa-truck-loading"></i>Supplier</a>
      <a class="nav-item nav-link nav-color" href="unit.php"><i class="i_left fa fa-weight-hanging"></i>Unit</a>
      <a class="nav-item nav-link nav-color" href="store.php"><i class="i_left fa fa-store"></i>Store</a>
      <a class="nav-item nav-link nav-color" href="newmaterial.php"><i class="i_left fa fa-luggage-cart"></i>Material</a>
      <a class="nav-item nav-link nav-color" href="newproduct.php"><i class="i_left fa fa-calendar-alt"></i>Product</a>
      <a class="nav-item nav-link nav-color" href="ingridient.php"><i class="i_left fa fa-atom"></i>Ingridient</a>
    </div>
    <div class="tab_card">
      <div class="tab_container">
        <button type="buttion" class="button" data-toggle="modal" data-target="#addcustomer">
          <i class="fa fa-plus"></i>
          Add Customer
        </button>
          <div class="modal fade" id="addcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content" style="background-color: #004f1e;">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">New Customer</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" action="addcustomer.php">
                    <div class="modal-body">
                      <div class="form-row">
                            <label for="date" style="color: white;" class="col-sm-2">Date:</label>
                            <div class="col">
                              <input type="date" id="date" name="date" class="form-control form-control-sm " autocomplete="off" required>
                            </div>
                            <label for="code" class="" style="color: white;">Code:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="name" class="col-sm-2" style="color: white;">Name:</label>
                            <div class="col">
                              <input type="text" id="name" name="name" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="address" class="col-sm-2" style="color: white;">Address:</label>
                            <div class="col">
                              <input type="text" id="address" name="address" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="contact" class="col-sm-2" style="color: white;">Contact:</label>
                            <div class="col">
                              <input type="tel" id="contact" name="contact" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="email" class="col-sm-2" style="color: white;">Email:</label>
                            <div class="col">
                              <input type="email" id="email" name="email" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" name="submit" class="save-button">Save</button>
                    </div>
                </form>
            </div>
            </div>
          </div> 

                <table class="table table-striped table-sm" style="margin-top: 2rem; color: white;">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Email</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $id=1;
                      $sql = "SELECT * FROM customer";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while ($data = mysqli_fetch_array($result)) {?>
                          <tr>
                            <td><?php echo $id++; ?></td>
                            <td><?php echo $data['cusid'];?></td>
                            <td><?php echo $data['cusname'];?></td>
                            <td><?php echo $data['Address'];?></td>
                            <td><?php echo $data['Phone'];?></td>
                            <td><?php echo $data['Email'];?></td>
                            <td><?php echo $data['Date'];?></td>
                            <td><a style="color: maroon;" href="#editcustomer<?php echo $data['id'];?>" data-toggle="modal"><i class="fa fa-edit"></i></a>
                              <a style="color: maroon;" onclick="return confirm('Are you sure you want to delete this?')" href="deletecustomer.php?del=<?php echo $data['id'];?>"><i class="fa fa-trash"></i></a></td>

          <div class="modal fade" id="editcustomer<?php echo $data['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content" style="background-color: #004f1e;">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Customer Edit</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" action="editcustomer.php">
                    <div class="modal-body">
                      <input type="hidden" name="edit_id" value="<?php echo $data['id']; ?>">
                      <div class="form-row">
                            <label for="date" style="color: white;" class="col-sm-2">Date:</label>
                            <div class="col">
                              <input type="date" id="date" name="date" value="<?php echo $data['Date'];?>" class="form-control form-control-sm " autocomplete="off" required>
                            </div>
                            <label for="code" class="" style="color: white;">Code:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" value="<?php echo $data['cusid'];?>" class="form-control form-control-sm" autocomplete="off" required readonly>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="name" class="col-sm-2" style="color: white;">Name:</label>
                            <div class="col">
                              <input type="text" id="name" name="name" value="<?php echo $data['cusname'];?>" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="address" class="col-sm-2" style="color: white;">Address:</label>
                            <div class="col">
                              <input type="text" id="address" name="address" value="<?php echo $data['Address'];?>" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="contact" class="col-sm-2" style="color: white;">Contact:</label>
                            <div class="col">
                              <input type="text" id="contact" name="contact" value="<?php echo $data['Phone'];?>" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="email" class="col-sm-2" style="color: white;">Email:</label>
                            <div class="col">
                              <input type="email" id="email" name="email" class="form-control form-control-sm" autocomplete="off" value="<?php echo $data['Email'];?>" required>
                            </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" name="submit" class="save-button">Update</button>
                    </div>
                </form>
            </div>
            </div>
          </div>

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
</body>
</html>