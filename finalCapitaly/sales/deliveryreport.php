

<?php 
require_once'connection.php';
if(isset($_POST["create_invoice"]))
  {
    $statement = $connect->prepare("INSERT INTO delivery_report
      (invoice,product,code,delivery_qty,qty_to_deliver,remaining_qty,customer_name,order_date,
      date_to_delivery,address)
      VALUES (:cusid, :product, :code, :delivery_qty, :qty_deliver, :qty_receiver, :receiver, :orderdate, :deliverydate, :address)
      ");
    $statement->execute(array(
      'cusid' => trim($_POST["cusid"]),
      'product' => trim($_POST["product"]),
      'code' => trim($_POST["code"]),
      'delivery_qty' => trim($_POST["delivery_qty"]),
      'qty_deliver' => trim($_POST["qty_deliver"]),
      'qty_receiver' => trim($_POST["qty_receiver"]),
      'receiver' => trim($_POST["receiver"]),
      'orderdate' => trim($_POST["orderdate"]),
      'deliverydate' => trim($_POST["deliverydate"]),
      'address' => trim($_POST["address"])
    ));
    $statement = $connect->query("SELECT LAST_INSERT_ID()");
      $salesbill_id = $statement->fetchColumn();

      for($count=0; $count<$_POST["total_item"]; $count++)
      {
        $order_before_discount = $order_before_discount + floatval(trim($_POST["order_item_actual_amount"][$count]));

        $order_total_discount = $order_total_discount + floatval(trim($_POST["order_item_discount"][$count]));

        $order_total_after_discount = $order_total_after_discount + floatval(trim($_POST["order_item_final_amount"][$count]));

        $statement = $connect->prepare("
          INSERT INTO product_item 
          (pcode, salesbill_id, item_name, item_quantity, item_unit, item_rate, item_actual_amount, item_discount, order_item_final_amount)
          VALUES (:pcode, :salesbill_id, :item_name, :order_item_quantity, :item_unit, :order_item_rate, :order_item_actual_amount, :order_item_discount, :order_item_final_amount)
        ");
        $statement->execute(
          array(
            ':salesbill_id'               =>  $salesbill_id,
            ':pcode'              =>  trim($_POST["item_code"][$count]),
            ':item_name'              =>  trim($_POST["item_name"][$count]),
            ':order_item_quantity'          =>  trim($_POST["order_item_quantity"][$count]),
            ':item_unit'  => trim($_POST["order_item_unit"][$count]),
            ':order_item_rate'           =>  trim($_POST["order_item_rate"][$count]),
            ':order_item_actual_amount'       =>  trim($_POST["order_item_actual_amount"][$count]),
            ':order_item_discount'         =>  trim($_POST["order_item_discount"][$count]),
            ':order_item_final_amount'        =>  trim($_POST["order_item_final_amount"][$count])
          )
        );
        $statements = $connect->prepare("UPDATE existingraw SET
          remain = :remain_qty WHERE
          code = :p_code;
          ");
        $statements->execute(
        array(
          ':remain_qty'     =>  trim($_POST["order_item_remain"][$count]),
          ':p_code'             =>  trim($_POST["item_code"][$count])
        )
      );
    }

      $statement = $connect->prepare("
        UPDATE salesbill SET
        before_discount = :order_before_discount,
        total_discount = :order_total_discount,
        grandtotal = :order_total_after_discount,
        remain_total = :remain_total
        WHERE id = :salesbill_id
        ");
      $statement->execute(
        array(
          ':order_before_discount'     =>  $order_before_discount,
          ':order_total_discount'         =>  $order_total_discount,
          ':order_total_after_discount'      =>  $order_total_after_discount,
          ':remain_total' => $order_total_after_discount,
          ':salesbill_id'             =>  $salesbill_id
        )
      );
      header("location:deliveryreport.php");
  }
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
      <a class="nav-item nav-link nav-color" href="showbill.php"><i class="i_left fa fa-money-bill"></i>Show Bill</a>
      <a class="nav-item nav-link nav-color tab_active" href="deliveryreport.php"><i class="i_left fa fa-file-invoice"></i>Delivery Report</a>
    </div>
    <div class="tab_card">
      <div class="tab_container">
        <form method="post" id="invoice_form">
        <div class="mid_card">

           <div class="form-row">
             <label for="cusid" style="color: white;" class="col-sm-2">Invoice No:</label>
                <div class="col">
                    <select id = "cusid" name="cusid" class="form-control form-control-sm" required>
                <?php 
                      $statement = $connect->prepare("SELECT * FROM salesbill");
                      $statement->execute();
                      $all_result = $statement->fetchAll();
                      $total_rows = $statement->rowCount();
                      if($total_rows > 0){
                        foreach($all_result as $row)
                          {?>
                            <option value="<?php echo $row['cusid'].','.$row['receiver'].','.$row['orderdate'].','.$row['deliverydate'].','.$row['address'];?>"><?php echo $row['invoiceno'];?></option>
                  <?php }}?>
                </select>
                
              </div>
            <label for="receiver" class="col-sm-2" style="color: white;">Customer Name:</label>
              <div class="col">
                <input type="text" id="receiver" name= "receiver" class="form-control form-control-sm" autocomplete="off" required>
               </div>
          </div>
          <div class="form-row"style="margin-top: 0.5rem;">
            <label for="orderdate" style="color: white;" class="col-sm-2">Order Date</label>
              <div class="col">
                 <input type="order date" id="orderdate" name = "orderdate" class="form-control form-control-sm" autocomplete="off" required>
                </div>

            <label for="datetodeliver" class="col-sm-2" style="color: white;"> Date to Deliver:</label>
              <div class="col">
               <input type="date" id="datetodeliver" name = "datetodeliver" class="form-control form-control-sm" autocomplete="off" required>
              </div>
          </div>
          <div class="form-row" style="margin-top: 0.5rem;">
            <label for="Address" style="color: white;" class="col-sm-2">Address:</label>
              <div class="col">
                  <input type="text" id="address"name=address class="form-control form-control-sm" autocomplete="off" required>
                
              </div>
            <label for="deliverydate" class="col-sm-2" style="color: white;">Date of Deliver:</label>
              <div class="col">
               <input type="date" id="deliverydate" name="deliverydate" class="form-control form-control-sm" autocomplete="off" required>
              </div>
          </div>
          <div class="form-row" style="margin-top: 0.5rem;">
            <label for="Product" style="color: white;" class="col-sm-2">Product/Raw</label>
              <div class="col">
                   <select id = "product" name="product" class="form-control form-control-sm" required>
                    <option value="0">Select Raw..</option>
                <?php 
                      $statement = $connect->prepare("SELECT * FROM product");
                      $statement->execute();
                      $all_result = $statement->fetchAll();
                      $total_rows = $statement->rowCount();
                      if($total_rows > 0){
                        foreach($all_result as $row)
                          {?>
                            <option value="<?php echo $row['id'].','.$row['product'];?>"><?php echo $row['product'];?></option>
                  <?php }}?>
                </select>
                </div>
           </div>
          <div class="form-row" style="margin-top: 0.5rem;">
            <label for="code" style="color: white;" class="col-sm-2">Code:</label>
              <div class="col">
                  <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required>
                
              </div>
            <label for="Delivery qty" class="col-sm-2" style="color: white;">Delivery qty</label>
              <div class="col">
               <input type="text" id="delivery_qty" name="delivery_qty" class="form-control form-control-sm" autocomplete="off" required>
              </div>
          </div>
          <div class="form-row" style="margin-top: 0.5rem;">
            <label for="Qty to Deliver" style="color: white;" class="col-sm-2">Total Qty </label>
              <div class="col">
                  <input type="text" id="qty_deliver" name="qty_deliver" class="form-control form-control-sm" autocomplete="off" required>
                
              </div>
              
             <label for="Remaining Qty" style="color: white;" class="col-sm-2">Remaining Qty</label>

            <div class="col">
             <input type="text" id="qty_receiver" name="qty_receiver" class="form-control form-control-sm" autocomplete="off" required ></div>




             <div class="col">
          <button type="button" id="add_row" class="save-button" name="add_row">+</button>
        </div> 
            </div>
         
        </div>
      

<!-- TABLE START -->
            <table id="invoice-item-table" class="table table-striped table-sm table-responsive" style="margin-top: 2rem; color: white;">
                    <thead>
                      <tr>
                      <th width="3%">#</th>
                      <th width="8%">Code</th>
                      <th width="8%">Date to </th>
                      <th width="8%">Product</th>
                      <th width="8%">Date of</th>
                      <th width="8%">Qty To</th>
                      <th width="8%">Delivery Qty</th>
                      <th width="8%">Remaining Qty</th>
                      <th width="3%"></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>




<!-- TABLE END -->
                  <div class="form-row" style="margin-top: 2.5rem;">
                    <button type="submit" class="save-button col-sm-2" onclick="windows.print()">Print</button>&nbsp&nbsp
                     <input type="submit" style="width: 9rem;" name="create_invoice" id="create_invoice" class="save-button" value="Save" />

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
        
        jQuery('#cusid').change(function(){
          var selectValue = $('#cusid').val();
          var selectText = $("#cusid option:selected").text();
          if(selectValue != 0)
          {
            var selectValueSplit = selectValue.split(",");
            var code = selectValueSplit[0];
            var Name = selectValueSplit[1];
            var Address = selectValueSplit[2];
            var Contact = selectValueSplit[3];
            var check = selectValueSplit[4];

            $('#cusid').val(selectValue);
            $('#cus_code').val(code);
            $('#receiver').val(Name);
            $('#orderdate').val(Address);
            $('#datetodeliver').val(Contact);
            $('#address').val(check);
            $('#receiver').val(Name);
            
              }
        });
       }); 
      </script>
      <!-- Code for the JS-->
            <script>
              $(document).ready(function(){
        var final_total_amt = $('#final_total_amt').text();
        var count = 0;

        $(document).on('click', '#add_row', function(){
          var selectValue = $('#product').val();
          var selectText = $("#product option:selected").text();
          var tcode = $("#code").val();
          var datetodeliver = $("#datetodeliver").val();
          var deliveryDate = $("#deliverydate").val();
          var deliverQuantity = $("#qty_deliver").val();
          var deliveryQuantity = $("#delivery_qty").val();
          var remainingQuantity = $("#qty_receiver").val();







          console.log('hr')
          if(selectValue != 0)
          {
            var selectValueSplit = selectValue.split(",");
            var selectItemId = selectValueSplit[0];
            var selectdatetodeliver = selectValueSplit[1];
            var product = selectValueSplit[2];
            var deliverydate = selectValueSplit[3];
            var qty_deliver = selectValueSplit[4];
            var remaining_qty = selectValueSplit[5];
          count++;
          $('#total_item').val(count);
          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';
          html_code += '<td><span id="sr_no">'+count+'</span></td>';

           html_code += '<td><input type="text" name="item_name[]" id="item_name'+count+'" value="'+tcode+'" class="form-control input-sm" readonly/></td>';

           html_code += '<td><input type="text" name="deliverydate[]" id="deliverydate'+count+'"value="'+datetodeliver+'" class="form-control input-sm deliverydate" readonly /></td>';          

          html_code += '<td><input type="text" name="product[]" id="product'+count+'" data-srno="'+count+'"value='+selectText+' class="form-control input-sm product" readonly /></td>';

          html_code += '<td><input type="text" name="datetodeliver[]" id="datetodeliver'+count+'" value="'+deliveryDate+'" class="form-control input-sm datetodeliver" readonly /></td>';

          html_code += '<td><input type="text" name="qty_deliver[]" id="qty_deliver'+count+'" value="'+deliverQuantity+'" class="form-control input-sm datetodeliver" readonly /></td>';

          html_code += '<td><input type="text" name="delivery_qty[]" id="delivery_qty'+count+'" value="'+deliveryQuantity+'" class="form-control input-sm datetodeliver" readonly /></td>';

          html_code += '<td><input type="text" name="qty_receiver[]" id="qty_receiver'+count+'" value="'+remainingQuantity+'" class="form-control input-sm datetodeliver" readonly /></td>';
                    
          html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
          html_code += '</tr>';
          
          $('#invoice-item-table').append(html_code);
        }
        else{
          alert('select raw!');
        }
        });
      });

        $(document).on('click', '.remove_row', function(){
          var row_id = $(this).attr("id");
          var total_item_amount = $('#order_item_final_amount'+row_id).val();
          var final_amount = $('#final_total_amt').text();
          var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
          $('#final_total_amt').text(result_amount);
          $('#row_id_'+row_id).remove();
          count--;
          $('#total_item').val(count);
        });

        $('#qty_receiver').click (function () {
          var deliverQuantity = $("#qty_deliver").val();
          var deliveryQuantity = $("#delivery_qty").val();
          var remainingQuantity = deliverQuantity - deliveryQuantity;
          $('#qty_receiver').val(remainingQuantity)
        })
        
      
      </script>

       

</body>
</html>