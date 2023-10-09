<?php include __DIR__.'\admin_header_php.php' ?>
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

<?php include __DIR__.'\admin_header_html.php'; ?>
   <div class="head-title">Sales</div>
<?php include __DIR__.'\admin_header_html2.php'; ?>

   <div class="manage-account-content2">

      <div class="modal-addsales">
         <form action="../validation/sales_add.php" method="post">
            <div>Starting Date</div>
            <input type="date" name="from" id="from" placeholder="start" required>
            <br><br>
            <div>End Date</div>
            <input type="date" name="to" id="to" placeholder="end" required>
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
               <th>Total Sales</th>
               <th>Target Sales</th>
               <th>Action</th>

            </tr>
            <?php if (mysqli_num_rows($resultSales) > 0) : ?>
               <?php while ($rows = mysqli_fetch_assoc($resultSales)) : ?>
                  <tr>
                     <td>
                        <?php echo $rows["mula"]; ?>
                     </td>

                     <td>
                        <?php echo $rows["hanggang"]; ?>
                     </td>

                     <td>
                        <?php echo '₱' . ' ' . $rows["totalSales"]; ?>
                     </td>

                     <td>
                        <?php echo '₱' . ' ' . $rows["targetSales"]; ?>
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

      <div class="btn-success btn-addsales2">Add Sales</div>
   </div>

<?php include __DIR__.'\admin_footer.php'; 
