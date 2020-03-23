<?php require_once'connection.php';

if(isset($_POST["create_invoice"]))
  { 
    $order_before_discount = 0;
    $order_total_discount = 0;
    $order_total_after_discount = 0;
    $remain_total = 0;
    
    $statement = $connect->prepare("INSERT INTO salesbill
      (cusid, invoiceno, toname, receiver, orderlpo, address, mobile, store, orderdate, deliverydate, before_discount, total_discount, grandtotal, remain_total)
      VALUES (:cusid, :invoiceno, :toname, :receiver, :orderlpo, :address, :mobile, :store, :orderdate, :deliverydate, :before_discount, :total_discount, :grandtotal, :remain_total)
      ");
    $statement->execute(array(
      'cusid' => trim($_POST["cus_code"]),
      'invoiceno' => trim($_POST["invoiceno"]),
      'toname' => trim($_POST["toname"]),
      'receiver' => trim($_POST["receiver"]),
      'orderlpo' => trim($_POST["orderlpo"]),
      'address' => trim($_POST["address"]),
      'mobile' => trim($_POST["mobile"]),
      'store' => trim($_POST["store"]),
      'orderdate' => trim($_POST["date"]),
      'deliverydate' => trim($_POST["deliverydate"]),
      'before_discount' => $order_before_discount,
      'total_discount' => $order_total_discount,
      'grandtotal' => $order_total_after_discount,
      'remain_total' => $remain_total
    ));
    $statement = $connect->query("SELECT LAST_INSERT_ID()");
      $salesbill_id = $statement->fetchColumn();

      for($count=0; $count<$_POST["total_item"]; $count++)
      {
        $order_before_discount = $order_before_discount + floatval(($_POST["order_item_actual_amount"][$count]));

        $order_total_discount = $order_total_discount + floatval(($_POST["order_item_discount"][$count]));

        $order_total_after_discount = $order_total_after_discount + floatval(($_POST["order_item_final_amount"][$count]));

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
        $statements = $connect->prepare("UPDATE existingpro SET
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
      header("location:salesbill.php");
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">

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
      <a class="nav-item nav-link nav-color tab_active" href="salesbill.php"><i class="i_left fa fa-chart-line"></i>Product Bill</a>
      <a class="nav-item nav-link nav-color" href="rawbill.php"><i class="i_left fa fa-chart-line"></i>Raw-Material Bill</a>
      <a class="nav-item nav-link nav-color" href="showbill.php"><i class="i_left fa fa-money-bill"></i>Show Bill</a>
      <a class="nav-item nav-link nav-color" href="deliveryreport.php"><i class="i_left fa fa-file-invoice"></i>Delivery Report</a>
    </div>
    <div class="tab_card">
      <div class="tab_container">
        <form method="post" id="invoice_form">
        <div class="form-row" style = "background-color: maroon;padding-top:0.2rem;">
            <label for="invoice" style="color: white;"  class="col-sm-2">Invoice No:</label>
              <div class="col">
                 <input type="text" id="invoice" name="invoiceno" class="form-control form-control-sm" required>
              </div>
              <label for="cusid" style="color: white;" class="col-sm-2">Customer:</label>
              <div class="col">
                <select id = "cusid" name="cusid" class="form-control form-control-sm" required>
                  <option value="0">Select Customer</option>
                  <?php 
                    $statement = $connect->prepare("SELECT * FROM customer");
                    $statement->execute();
                    $all_result = $statement->fetchAll();
                    $total_rows = $statement->rowCount();
                    if($total_rows > 0){
                      foreach($all_result as $row)
                        {?>
                          <option value="<?php echo $row['cusid'].','.$row['cusname'].','.$row['Address'].','.$row['Phone'];?>"><?php echo $row['cusid'];?></option>
                <?php }}?>
                </select>
                <input type = "hidden" id="cus_code" name="cus_code" class="form-control form-control-sm" autocomplete="off" required>
              </div>
            
          </div>
          <div class="form-row" style="margin-top: 0.5rem;">
            <label for="toname" style="color: white;" class="col-sm-2">To:</label>
              <div class="col">
                  <input type="text" id="toname" name="toname" class="form-control form-control-sm" autocomplete="on" required readonly>
                
              </div>
                <label for="date" class="col-sm-2" style="color: white;">Date:</label>
              <div class="col">
               <input type="date" id="date" name="date" class="form-control form-control-sm" autocomplete="off" required>
              </div>
            
          </div>
          <div class="form-row" style="margin-top: 0.5rem;">
            
              <label for="mobile" class="col-sm-2" style="color: white;">Mob:</label>
              <div class="col">
               <input type="text" id="mobile" name="mobile" class="form-control form-control-sm" autocomplete="off" required readonly>
              </div>
            <label for="deliverydate" class="col-sm-2" style="color: white;">Delivery:</label>
              <div class="col">
               <input type="date" id="deliverydate" name="deliverydate" class="form-control form-control-sm" autocomplete="off" required>
              </div>
          </div>
          <div class="form-row" style="margin-top: 0.5rem;">
            <label for="address" style="color: white;" class="col-sm-2">Address:</label>
              <div class="col">
                  <input type="text" id="address" name="address" class="form-control form-control-sm" autocomplete="off" required readonly>
                
              </div>
            <label for="orderlpo" style="color: white;" class="col-sm-2">Oder/LPO:</label>
              <div class="col">
                  <input type="text" id="orderlpo" name="orderlpo" class="form-control form-control-sm" autocomplete="off" required>
              </div>
          </div>
          <div class="form-row" style="margin-top: 0.5rem;">
            <label for="receiver" class="col-sm-2" style="color: white;">Receiver:</label>
              <div class="col">
               <input type="text" id="receiver" name="receiver" class="form-control form-control-sm" autocomplete="off" required readonly>
              </div>
            <label for="store" class="col-sm-2" style="color: white;">Store:</label>
              <div class="col">
               <select id="store" name="store" class="form-control form-control-sm">
                <option value="0">Select Store..</option>
                <?php 
                $statement = $connect->prepare("SELECT * FROM store");
                $statement->execute();
                $all_result = $statement->fetchAll();
                $total_rows = $statement->rowCount();
                if($total_rows > 0){
                foreach($all_result as $row)
                        {?>
                          <option value="<?php echo $row['Store'];?>"><?php echo $row['Store'];?></option>
                <?php }}?>
               </select>
              </div>
          </div>
          <div style="margin-top: 1rem;" align="right">
          
          </div> 
          <div class="form-row">
            <label for="select" class="col-sm-2" style="color: white;">Add Product: </label>
            <div class="col">
            <select id="select" name="select" class="form-control form-control-sm" data-live-search = "true"><option value="0">Select Product..</option>
            <?php 
                $statement = $connect->prepare("SELECT * FROM existingpro");
                $statement->execute();
                $all_result = $statement->fetchAll();
                $total_rows = $statement->rowCount();
                if($total_rows > 0){
                foreach($all_result as $row){?>
                <option value="<?php echo $row['id'].','.$row['rate'].','.$row['unit'].','.$row['quantity'].','.$row['code'];?>"><?php echo $row['name'];?></option>
          <?php }}?>
            </select>
          </div>
          <div class="col">
          <button type="button" id="add_row" class="save-button" name="add_row">+</button>
        </div>
        <table id="invoice-item-table" class="table table-striped table-sm table-responsive" style="margin-top: 2rem; color: white;">
                    <thead>
                      <tr>
                      <th width="1%">#</th>
                      <th width="13%">Name</th>
                      <th width="7%">Rate</th>
                      <th width="7%">Quantity</th>
                      <th width="7%">Unit</th>
                      <th width="9%">Total</th>
                      <th width="10%">Discount</th>
                      <th width="10%">Item Total</th>
                      <th width="3%"></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                  <tr>
                <td align="right"><b style="color: white;" >Grand Total:KWD </td>
                <td align="right"><b><span id="final_total_amt"></span></b></td>
              </tr>
              <div style="margin-top: 1rem;">
                <tr>
                <td colspan="2" align="center">
                  <input type="hidden" name="total_item" id="total_item" value="1" />
                  <input type="submit" style="width: 9rem;" name="create_invoice" id="create_invoice" class="save-button" value="Save" />
                  <a type="button" href="../account/paybycustomer.php" style="width: 13rem; text-align: center; text-decoration: none;" class="save-button" >Pay By Customer</a>

                </td>
              </tr>
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

            $('#cusid').val(selectValue);
            $('#cus_code').val(code);
            $('#toname').val(Name);
            $('#address').val(Address);
            $('#mobile').val(Contact);
            $('#receiver').val(Name);
              }
        });
       }); 
      console.log(code,Name)
      </script>
  <script>
      $(document).ready(function(){
        var final_total_amt = $('#final_total_amt').text();
        var count = 0;
        
        $(document).on('click', '#add_row', function(){
          var selectValue = $('#select').val();
          var selectText = $("#select option:selected").text();
          if(selectValue != 0)
          {
            var selectValueSplit = selectValue.split(",");
            var selectItemId = selectValueSplit[0];
            var selectItemRate = selectValueSplit[1];
            var selectItemUnit = selectValueSplit[2];
            var AvailableQty = selectValueSplit[3];
            var pcode = selectValueSplit[4];

          count++;
          $('#total_item').val(count);
          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';
          html_code += '<td><span id="sr_no">'+count+'</span></td>';
          
          html_code += '<td><input type="text" name="item_name[]" id="item_name'+count+'" value = "'+selectText+'"  class="form-control input-sm" readonly/></td>';

          html_code += '<td hidden="true"><input type="text" name="item_code[]" id="item_code'+count+'" value="'+pcode+'" class="form-control input-sm" readonly/></td>';

          html_code += '<td><input type="text" name="order_item_rate[]" id="order_item_rate'+count+'" data-srno="'+count+'"value='+selectItemRate+' class="form-control input-sm order_item_rate" readonly /></td>';

          html_code += '<td hidden="true"><input type="text" name="order_item_available[]" id="order_item_available'+count+'" data-srno="'+count+'"value='+AvailableQty+' class="form-control input-sm order_item_available" readonly /></td>';
          
          html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity"/></td>';

          html_code += '<td hidden="true"><input type="text" name="order_item_remain[]" id="order_item_remain'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_remain"/></td>';
          
          html_code += '<td><input type="text" name="order_item_unit[]" id="order_item_unit'+count+'" data-srno="'+count+'" value='+selectItemUnit+' class="form-control input-sm number_only order_item_unit" readonly/></td>';          
          
          html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_actual_amount" readonly /></td>';
          html_code += '<td><input type="text" name="order_item_discount[]" id="order_item_discount'+count+'" value="0" data-srno="'+count+'" class="form-control input-sm order_item_discount" /></td>';

          html_code += '<td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_final_amount" /></td>';
          
          html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
          html_code += '</tr>';
          
          $('#invoice-item-table').append(html_code);
        }
        else{
          alert('select product!');
        }
        });
        
        $(document).on('click', '.remove_row', function(){
          var row_id = $(this).attr("id");
          var total_item_amount = $('#order_item_final_amount'+row_id).val();
          var final_amount = $('#final_total_amt').text();
          var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
        $('#final_total_amt').text(function(result_amount)
      {
        return "result_amount";
      }); 

          $('#row_id_'+row_id).remove();
          count--;
          $('#total_item').val(count);
        });
        function cal_final_total(count)
        {
          var final_item_total = 0;
          for(j=1; j<=count; j++)
          {
            var stockqty = 0;
            var quantity = 0;
            var price = 0;
            var actual_amount = 0;
            //var tax1_rate = 0;
            var discount = 0;
            var remainqty = 0;
            //var tax2_rate = 0;
            //var tax2_amount = 0;
            //var tax3_rate = 0;
            //var tax3_amount = 0;
            var item_total = 0;
            stockqty = $('#order_item_available'+j).val();
            price = $('#order_item_rate'+j).val();
            if(price > 0)
            {
              quantity = $('#order_item_quantity'+j).val();
              if(quantity > 0)
              {
                actual_amount = parseFloat(quantity) * parseFloat(price);
                remainqty = parseFloat(stockqty) - parseFloat(quantity);
                $('#order_item_remain'+j).val(remainqty);
                $('#order_item_actual_amount'+j).val(actual_amount);
                discount = $('#order_item_discount'+j).val();
                if(discount > 0)
                {                  
                 item_total = parseFloat(actual_amount) - parseFloat(discount); 
                }else{
                item_total = parseFloat(actual_amount);}
                final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                $('#order_item_final_amount'+j).val(item_total);
              }
            }
          }
          $('#final_total_amt').text(final_item_total +".00");
        }

        $(document).on('blur', '.order_item_rate', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.order_item_quantity', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.order_item_discount', function(){
          cal_final_total(count);
        });

        $('#create_invoice').click(function(){
          $('#invoice_form').submit();
        });

       }); 
      </script>
</body>
</html>
