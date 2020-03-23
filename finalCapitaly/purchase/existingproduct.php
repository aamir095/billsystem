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
</head>
<body>
	<nav class="navbar navbar-expand-lg" style="background-color: maroon;">
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"><i class="fa fa-bars" style="color: white;"></i></span>
  		</button>
  		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    		<div class="navbar-nav">
      			<a class="nav-item nav-color nav-link nav-right" href="../setup.php"><i class="i_left fa fa-cog"></i>Setup</a>
      			<a class="nav-item nav-color nav-link nav-right nav_active" href="../purchase.php"><i class="i_left fa fa-receipt"></i>Purchase</a>
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
      <a class="nav-item nav-link nav-color" href="existingmaterial.php"><i class="i_left fa fa-luggage-cart"></i>Existing Material</a>
      <a class="nav-item nav-link nav-color tab_active" href="existingproduct.php"><i class="i_left fa fa-calendar-alt"></i>Existing Product</a>
    </div>
    <div class="tab_card">
      <div class="tab_container">
        <button type="buttion" class="button" data-toggle="modal" data-target="#addcustomer">
          <i class="fa fa-plus"></i>
          New Product
        </button>
          <div class="modal fade" id="addcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content" style="background-color: #004f1e;">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">New Product</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" action="product.php">
                    <div class="modal-body">
                      <div class="form-row">
                            <label for="date" style="color: white;" class="col-sm-2">Date:</label>
                            <div class="col">
                              <input type="date" id="date" name="date" class="form-control form-control-sm " autocomplete="off" required>
                            </div>
                            <label for="scode" class="" style="color: white;">Code:</label>
                            <div class="col">
                              <select id="scode" name="scode" class="form-control form-control-sm" autocomplete="off" required>
                                <option value="0">Select Product</option>
                                <?php 
                                $sql = "SELECT * FROM product";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                   while ($data = mysqli_fetch_array($result)) {?>
                                <option value="<?php echo $data['code'].','.$data['product'];?>"><?php echo $data['code'];?></option>
                                <?php }}?>
                              </select>
                              <input type="hidden" name="code" id="code">
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="name" class="col-sm-2" style="color: white;">Name:</label>
                            <div class="col">
                             <input type="text" id="name" name="name" class="form-control form-control-sm" autocomplete="off" required readonly>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                            <label for="quantity" style="color: white;" class="col-sm-2">Quantity:</label>
                            <div class="col">
                              <input type="text" id="quantity" name="qty" class="form-control form-control-sm " autocomplete="off" required>
                            </div>
                            <label for="unit" class="" style="color: white;">Unit:</label>
                            <div class="col">
                              <select id="unit" name="unit" class="form-control form-control-sm" required>
                                <option disabled>units</option>
                                <?php 
                                $sql = "SELECT * FROM unit";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                   while ($data = mysqli_fetch_array($result)) {?>
                                <option value="<?php echo $data['Unit'];?>"><?php echo $data['Unit'];?></option>
                                <?php }}?>
                              </select>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                            <label for="store" style="color: white;" class="col-sm-2">Store:</label>
                            <div class="col">
                              <select id="store" name="store" class="form-control form-control-sm " required>
                                <option disabled>store</option>
                                <?php 
                                $sql = "SELECT * FROM store";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                   while ($data = mysqli_fetch_array($result)) {?>
                                <option value="<?php echo $data['Store'];?>"><?php echo $data['Store'];?></option>
                                <?php }}?>
                              </select>
                            </div>
                            <label for="rate" class="" style="color: white;">Rate:</label>
                            <div class="col">
                              <input type="text" id="rate" name="rate" class="form-control form-control-sm" required autofocus="off">
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="reference" class="col-sm-2" style="color: white;">Reference:</label>
                            <div class="col">
                              <input type="text" id="reference" name="reference" class="form-control form-control-sm" autocomplete="off" required>
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
                          <th scope="col">Code</th>

                          <th scope="col">Raw Name</th>
                          <th scope="col">Date</th>
                                                     
                               </tr>
                               </thead> 
                               <tbody>
                      <?php 
                      $sql = "SELECT * FROM existingpro GROUP BY code";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while ($data = mysqli_fetch_array($result)) {?>
                         <tr class="clickme">
                            <td><?php echo $data['code'];?></td>
                            <td><?php echo $data['name'];?></td>

                            <td><?php echo $data['date'];?></td>
                            </tr>
                            <tr style="display: none;">
                              <td style="border: none;" colspan="3">
                                <table style="width: 100%;">
                                   <thead>
                                  <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Store</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Action</th>
                      </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                      
                      $sql1 = "SELECT * FROM existingpro WHERE code = '".$data['code']."'";
                      $result1 = $conn->query($sql1);
                      if ($result1->num_rows > 0) {
                        $id=0;
                        while ($data1 = mysqli_fetch_array($result1)) {
                           
                          ?>
                           <tr>
                            <td><?php echo ++$id; ?></td>                            
                            <td><?php echo $data1['code'];?></td>
                            <td><?php echo $data1['name'];?></td>
                            <td><?php echo $data1['date'];?></td>
                            <td><?php echo $data1['quantity'];?></td>
                            <td><?php echo $data1['unit'];?></td>
                            <td><?php echo $data1['rate'];?></td>
                            <td><?php echo $data1['store'];?></td>
                            <td><?php echo $data1['reference'];?></td>
                            <td><a style="color: white;" href="#editproduct<?php echo $data1['id'];?>" data-toggle="modal"><i class="fa fa-pen-square"></i></a>
                              <a style="color: maroon;" onclick="return confirm('Are you sure you want to delete this?')" href="deleteproduct.php?del=<?php echo $data1['id'];?>"><i class="fa fa-trash"></i></a></td>
                            </tr>
                          <div class="modal fade" id="editproduct<?php echo $data1['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content" style="background-color: #004f1e;">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Update Raw-Material</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" action="editproduct.php">
                    <div class="modal-body">
                      <input type="hidden" name="edit_id" value="<?php echo $data1['id']; ?>">
                      <div class="form-row">
                            <label for="date" style="color: white;" class="col-sm-2">Date:</label>
                            <div class="col">
                              <input type="date" id="date" name="date" class="form-control form-control-sm " autocomplete="off" required value="<?php echo $data1['date']; ?>">
                            </div>
                            <label for="code" class="" style="color: white;">Code:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $data1['code']; ?>" readonly>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="name" class="col-sm-2" style="color: white;">Name:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $data1['name']; ?>" readonly>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                            <label for="quantity" style="color: white;" class="col-sm-2">Quantity:</label>
                            <div class="col">
                              <input type="text" id="quantity" name="qty" class="form-control form-control-sm " autocomplete="off" required>
                            </div>
                            <label for="unit" class="" style="color: white;">Unit:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $data1['unit']; ?>" readonly>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                            <label for="store" style="color: white;" class="col-sm-2">Store:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $data1['store']; ?>" readonly>
                            </div>
                            <label for="rate" class="" style="color: white;">Rate:</label>
                            <div class="col">
                              <input type="text" id="rate" name="rate" class="form-control form-control-sm" required autofocus="off" value="<?php echo $data1['rate']; ?>">
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="reference" class="col-sm-2" style="color: white;">Reference:</label>
                            <div class="col">
                              <input type="text" name="reference" id="reference" class="form-control form-control-sm" autocomplete="off" required autocomplete="off" value="<?php echo $data1['reference']; ?>">
                            </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                    <button type="submit" name="submit" class="save-button">Update</button>
                    </div>
                  
                </form>
            </div>
       

                            <?php }}?>
                                  
                                </tbody>
                                  
                                </table>
                              </td>
                            </tr>
                            <?php }}?>
                               </tbody>




                  <!-- <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Store</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sql = "SELECT * FROM existingpro GROUP BY code";

                      // $sql = "SELECT * FROM existingpro";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while ($data = mysqli_fetch_array($result)) {?>
                          <tr>
                            <td><?php echo $data['id'];?></td>
                            <td><?php echo $data['code'];?></td>
                            <td><?php echo $data['name'];?></td>
                            <td><?php echo $data['quantity'];?></td>
                            <td><?php echo $data['unit'];?></td>
                            <td><?php echo $data['rate'];?></td>
                            <td><?php echo $data['store'];?></td>
                            <td><?php echo $data['reference'];?></td>
                            <td><a style="color: white;" href="#editproduct<?php echo $data['id'];?>" data-toggle="modal"><i class="fa fa-pen-square"></i></a>
                              <a style="color: maroon;" onclick="return confirm('Are you sure you want to delete this?')" href="deleteproduct.php?del=<?php echo $data['id'];?>"><i class="fa fa-trash"></i></a></td>
                            </tr>
          <div class="modal fade" id="editproduct<?php echo $data['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content" style="background-color: #004f1e;">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Update Raw-Material</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" action="editproduct.php">
                    <div class="modal-body">
                      <input type="hidden" name="edit_id" value="<?php echo $data['id']; ?>">
                      <div class="form-row">
                            <label for="date" style="color: white;" class="col-sm-2">Date:</label>
                            <div class="col">
                              <input type="date" id="date" name="date" class="form-control form-control-sm " autocomplete="off" required value="<?php echo $data['date']; ?>">
                            </div>
                            <label for="code" class="" style="color: white;">Code:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $data['code']; ?>" readonly>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="name" class="col-sm-2" style="color: white;">Name:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $data['name']; ?>" readonly>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                            <label for="quantity" style="color: white;" class="col-sm-2">Quantity:</label>
                            <div class="col">
                              <input type="text" id="quantity" name="qty" class="form-control form-control-sm " autocomplete="off" required>
                            </div>
                            <label for="unit" class="" style="color: white;">Unit:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $data['unit']; ?>" readonly>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                            <label for="store" style="color: white;" class="col-sm-2">Store:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $data['store']; ?>" readonly>
                            </div>
                            <label for="rate" class="" style="color: white;">Rate:</label>
                            <div class="col">
                              <input type="text" id="rate" name="rate" class="form-control form-control-sm" required autofocus="off" value="<?php echo $data['rate']; ?>">
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="reference" class="col-sm-2" style="color: white;">Reference:</label>
                            <div class="col">
                              <input type="text" name="reference" id="reference" class="form-control form-control-sm" autocomplete="off" required autocomplete="off" value="<?php echo $data['reference']; ?>">
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
           <?php }}?>
                    </tbody> -->


                  </table>

      </div>
    </div>
  </nav>

	<script type="text/javascript" src="../js/bootstrap.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
        
        jQuery('#scode').change(function(){
          var selectValue = $('#scode').val();
          var selectText = $("#scode option:selected").text();
          if(selectValue != 0)
          {
            var selectValueSplit = selectValue.split(",");
            var scode = selectValueSplit[0];
            var Name = selectValueSplit[1];

            $('#scode').val(selectValue);
            $('#code').val(scode);
            $('#name').val(Name);
          }
          });
        });

  var showhide = document.getElementsByClassName("clickme");
var i;

for (i = 0; i < showhide.length; i++) {
  showhide[i].addEventListener("click", function() {
  var showhidecontent = this.nextElementSibling;
  if (showhidecontent.style.display === "") {
  showhidecontent.style.display = "none";
  } else {
  showhidecontent.style.display = "";
  }
  });
}
      </script>

</body>
</body>
</html>