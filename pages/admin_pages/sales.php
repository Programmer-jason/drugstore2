<?php include './admin_header_php.php'; ?> 

<?php
   //SALES
   $sqlSales = "SELECT * FROM sales";
   $resultSales = mysqli_query($conn, $sqlSales);
   
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
            <div class="btn-success btn-addsales-close">Close</div>
         </form>
      </div>

      <div class="table-container">
         <section class="payment-details-head">
            <div class="search-container">
               <input type="search" onchange="paymentSearch()" name="search" id="search-payment" placeholder="starting date">
               <span class="submit" onclick="paymentSearch()">search</span>
            </div>
         </section>

         <table>
            <tr>
               <th>Starting Date</th>
               <th>End Date</th>
               <th>Total</th>
               <th>Target </th>
               <th>Status</th>
               <th>Action</th>

            </tr>
            <?php if (mysqli_num_rows($resultSales) > 0) : ?>
               <?php while ($rows = mysqli_fetch_assoc($resultSales)) : ?>
                  <?php 
                     //PAYMENT
   					   $updatedDate = date('Y-m-d');

                     $startDate = $rows['startingDate'];
                     $endDate = $rows['endDate'];
                     $targetSales = $rows['targetSales'];
   					   $readableStartDate = date('M d Y', strtotime($startDate));
   					   $readableEndDate = date('M d Y', strtotime($endDate));

                     $selectPayment = "SELECT SUM(price) AS total, dateRecieved FROM paymentdetails WHERE dateRecieved BETWEEN '$startDate' AND '$endDate'";
                     $selectPaymentResult = mysqli_query($conn, $selectPayment);
                     $selectPaymentRow = mysqli_fetch_assoc($selectPaymentResult);
                     $totalSales = $selectPaymentRow['total'];
                     $dateRecieve = $selectPaymentRow['dateRecieved'];

                     if(mysqli_num_rows($selectPaymentResult) > 0){
                        if($endDate == $updatedDate){
                           $updateSales = "UPDATE sales SET totalSales = '$totalSales', salesStatus = 'f' WHERE startingDate='$startDate' AND endDate='$updatedDate' AND salesStatus = 'nf'";
                           mysqli_query($conn, $updateSales);
                        } else {
                           $updateSales = "UPDATE sales SET totalSales = '$totalSales' WHERE startingDate='$startDate' AND endDate='$endDate' AND salesStatus = 'nf'";
                           mysqli_query($conn, $updateSales);
                        }
                     }
                  ?>
                  <tr>
                     <td>
                        <?php echo $readableStartDate; ?>
                     </td>

                     <td>
                        <?php echo $readableEndDate; ?>
                     </td>

                     <td>
                        <?php echo ($totalSales == 0) ? '₱' . ' ' .'0' : '₱' . ' ' .number_format($totalSales); ?>
                     </td>

                     <td>
                        <?php echo '₱' . ' ' . number_format($rows["targetSales"]); ?>
                     </td>

                     <td>
                        <?php echo( $rows["salesStatus"] == 'f') ? 'Finish' : 'Not Finish'; ?>
                     </td>

                     <td>
                        <!-- <a href="./update.php?id=<?php echo $rows['salesId']; ?>" class="btn btn-primary btn-sm">Edit</a> -->
                        <a href="./delete_sales.php?deleteId=<?php echo $rows['salesId']; ?>" class="btn btn-danger btn-sm">Delete</a>
                     </td>
                  </tr>
               <?php endwhile; ?>
            <?php endif; ?>
         </table>
      </div>

      <div class="btn-success btn-addsales2">New Sales</div>
   </div>

<?php include __DIR__.'\admin_footer.php'; 
