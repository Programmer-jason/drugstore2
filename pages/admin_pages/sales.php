<?php include './admin_header_php.php'; ?> 
<?php
   //SALES
   if(!isset($_GET['salesId'])){
      $sqlSales = "SELECT * FROM sales ORDER BY salesId Desc";
   } else {
      $salesIdd =$_GET['salesId'];
      $sqlSales = "SELECT * FROM sales WHERE salesId=$salesIdd";
   }
      $resultSales = mysqli_query($conn, $sqlSales);
      $salesRow = mysqli_fetch_assoc($resultSales);
      $updatedDate = date('Y-m-d');
   
   // if(mysqli_num_rows($resultSales) > 0){
      $salesId = $salesRow['salesId'];
      $startDate = $salesRow['startingDate'];
      $endDate = $salesRow['endDate'];
      $targetSales = $salesRow['targetSales'];
      $salesStatus = $salesRow["salesStatus"];
      $readableStartDate = date('M d Y', strtotime($startDate));
      $readableEndDate = date('M d Y', strtotime($endDate));
      
      $selectPayment = "SELECT SUM(price) AS total, dateRecieved FROM paymentdetails WHERE dateRecieved BETWEEN '$startDate' AND '$endDate'";
      $selectPaymentResult = mysqli_query($conn, $selectPayment);
      $selectPaymentRow = mysqli_fetch_assoc($selectPaymentResult);
      $totalSales = $selectPaymentRow['total'];
      // $dateRecieve = $selectPaymentRow['dateRecieved'];
      
      if(mysqli_num_rows($selectPaymentResult) > 0){
         if($endDate == $updatedDate){
            $updateSales = "UPDATE sales SET totalSales = '$totalSales', salesStatus = 'f' WHERE startingDate='$startDate' AND endDate='$updatedDate' AND salesStatus = 'nf'";
            mysqli_query($conn, $updateSales);
         } else {
            $updateSales = "UPDATE sales SET totalSales = '$totalSales' WHERE startingDate='$startDate' AND endDate='$endDate' AND salesStatus = 'nf'";
         mysqli_query($conn, $updateSales);
         }
      }
   // }
   $selectPayments = "SELECT DISTINCT dateRecieved FROM paymentdetails WHERE dateRecieved BETWEEN '$startDate' AND '$endDate'";
   $selectPaymentResults = mysqli_query($conn, $selectPayments);

   $sqlSaless = "SELECT * FROM sales ORDER BY salesId Desc";
   $resultSaless = mysqli_query($conn, $sqlSaless);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sales</title>
   <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
   <link rel="stylesheet" href="../../style/navbar.css" />
   <link rel="stylesheet" href="../../style/sidenav.css">
   <link rel="stylesheet" href="../../style/sales.css" />
</head>

<?php include './admin_header_html.php'; ?>
   <div class="head-title">Sales</div>
<?php include './admin_header_html2.php'; ?>

   <div class="manage-account-content2">
      <div class="modal-addsales">
         <div class="btn-success btn-addsales-close">X</div>
         <form action="../validation/sales_add.php" method="post">
            <div>Starting Date</div>
            <input type="date" name="from" placeholder="01/1/1970" id="from" required>
            <br><br>
            <div>End Date</div>
            <input type="date" name="to" id="to" title="mm/dd/yy" required>
            <br><br>
            <div>Target Sales</div>
            <input type="number" name="targetSales" id="targetSales" required>
            <br><br>
            <input type="submit" value="Add" name="submit" id="Add" class="btn-success btn-addsales">
         </form>
      </div>

      

      <section class="top-sales-link">
         <div class="startDate saless">
            <div>Starting Date</div>
            <?php echo (!isset($readableEndDate)) ? 'N/A' : $readableStartDate ?>
         </div>

         <div class="endDate saless">
            <div>End Date</div>
            <?php echo (!isset($readableEndDate)) ? 'N/A' : $readableEndDate ?>
         </div>

         <div class="totalSales saless">
            <div>Total Sales</div>
            <?php echo (!isset($totalSales)) ? '₱' . ' ' .'0' : '₱' . ' ' .number_format($totalSales) ?>
         </div>

         <div class="targetSales saless">
            <div>Target Sales</div>
            <?php echo (!isset($targetSales)) ? '₱' . ' ' .'0' : '₱' . ' ' . number_format($targetSales) ?>
         </div>

         <div class="salesStatus saless">
            <div>Status</div>
            <?php echo(!isset($salesStatus)) ? 'N/A' : (($salesStatus == 'f') ? 'Finish' : 'Not Finish'); ?>
         </div>
      </section>

      <div class="table-container">
         <section class="payment-details-head">
            <div class="search-container">
                  <?php if (mysqli_num_rows($resultSaless) > 0) : ?>
                     <?php while ($rows = mysqli_fetch_assoc($resultSaless)) : ?>
                        <a href="<?php echo "./sales.php?salesId=".$rows['salesId'] ?>" class="click-sales">
                           <?php echo date('M d Y', strtotime($rows['startingDate'])).' - '.date('M d Y', strtotime($rows['endDate'])) ?>
                        </a>
                        <br>
                     <?php endwhile; ?>
                  <?php endif; ?>
               </select>
            </div>
         </section>

         <table>
            <tr>
               <th>Date</th>
               <th>Total</th>
            </tr>
            <?php if (mysqli_num_rows($selectPaymentResults) > 0) : ?>
               <?php while ($rows = mysqli_fetch_assoc($selectPaymentResults)) : ?>
                  <?php 
                     //PAYMENT
                     $dateRecieves = $rows['dateRecieved'];
                     $selectPaymentss = "SELECT SUM(price) AS total FROM paymentdetails WHERE dateRecieved='$dateRecieves'";
   					   $selectPaymentResultss = mysqli_query($conn, $selectPaymentss);
                     $selectPaymentRowss = mysqli_fetch_assoc($selectPaymentResultss);
                     $totalSalesss = $selectPaymentRowss['total'];
                  ?>
                  <tr>
                     <td>
                        <?php echo date('M d Y', strtotime($rows['dateRecieved'])) ?>
                     </td>

                     <td>
                        <?php echo ($totalSalesss == 0) ? '₱' . ' ' .'0' : '₱' . ' ' .number_format($totalSalesss) ?>
                     </td>
                  </tr>
               <?php endwhile; ?>
            <?php endif; ?>
         </table>
      </div>

     <!-- SALES BUTTON -->
     <div class="btn-success btn-addsales2">New Sales</div>
     <a href="./delete_sales.php?deleteId=<?php echo $salesId ?>" class="btn btn-danger btn-delete-sales">Delete Sales</a>
     <div class="btn-success btn-selectSales">Select Sales</div>
   </div>
   
<script>
      document.querySelector('.click-sales').addEventListener('click', function(){
         document.querySelector('.search-container').style.display = 'none'
      })
</script>
<?php include __DIR__.'\admin_footer.php'; 
