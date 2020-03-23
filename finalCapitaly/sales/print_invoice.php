<?php
//print_invoice.php
if(isset($_GET["pdf"]) && isset($_GET["id"]))
{
 require_once 'pdf.php';
 include('connection.php');
 $output = '';
 $statement = $connect->prepare("
  SELECT * FROM salesbill 
  WHERE id = :order_id
  LIMIT 1
 ");
 $statement->execute(
  array(
   'order_id'       =>  $_GET["id"]
  )
 );
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '
   <table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
     <td colspan="2" align="center" style="font-size:18px"><b>Invoice</b></td>
    </tr>
    <tr>
     <td colspan="2">
      <table width="100%" cellpadding="5">
       <tr>
        <td width="65%">
         To,<br />
         <b>RECEIVER</b><br />
         Name : '.$row["receiver"].'<br /> 
         Billing Address : '.$row["address"].'<br />
         Contact : '.$row["mobile"].'<br />

        </td>
        <td width="35%">
         <br />
         Invoice No. : '.$row["invoiceno"].'<br />
         Invoice Date : '.$row["orderdate"].'<br />
        </td>
       </tr>
      </table>
      <br />
      <table width="100%" border="1" cellpadding="5" cellspacing="0">
       <tr>
        <th>Sr No.</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Unit</th>
        <th>Price</th>
        <th>Actual Amt.</th>
        <th>Discount</th>
        <th>Total</th>
       </tr>';
  $statement = $connect->prepare(
   "SELECT * FROM product_item 
   WHERE salesbill_id = :order_id"
  );
  $statement->execute(
   array(
    'order_id'       =>  $_GET["id"]
   )
  );
  $item_result = $statement->fetchAll();
  $count = 0;
  foreach($item_result as $sub_row)
  {
   $count++;
   $id=.00;
   $output .= '
   <tr>
    <td>'.$count.'</td>
    <td>'.$sub_row["item_name"].'</td>
    <td>'.$sub_row["item_quantity"].'</td>
    <td>'.$sub_row["item_unit"].'</td>
    <td>'.$sub_row["item_rate"].'</td>
    <td>'.$sub_row["item_actual_amount"].'</td>
    <td>'.$sub_row["item_discount"].'</td>
    <td>'.$sub_row["order_item_final_amount"].'</td>
   </tr>
   ';
  }
  $output .= '
  <tr>
   <td align="right" colspan="7"><b>Total</b></td>
   <td align="right"><b>'.number_format((float)$row['grandtotal'], 2, '.', '').'</b></td>
  </tr>
  <tr>
   <td colspan="7"><b>Total Amt. Before Discount :</b></td>
   <td align="right">'.number_format((float)$row['before_discount'], 2, '.', '').'</td>
  </tr>
  <tr>
   <td colspan="7"><b>Total Discount.  :</b></td>
   <td align="right">'.number_format((float)$row['total_discount'], 2, '.', '').'</td>
  </tr>
  <tr>
   <td colspan="7"><b>Grand Total :</b></td>
   <td align="right">'.number_format((float)$row['grandtotal'], 2, '.', '').'</td>
  </tr>
  
  ';
  $output .= '
      </table>
     </td>
    </tr>
   </table>
  ';
 }
 $pdf = new Pdf();
 $file_name = 'Invoice-'.$row["invoiceno"].'.pdf';
 $pdf->loadHtml($output);
 $pdf->render();
 $pdf->stream($file_name, array("Attachment" => false));
}
?>