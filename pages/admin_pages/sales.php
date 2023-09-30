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
      <div class="table-container">
         <section class="payment-details-head">
            <div class="search-container">
               <input type="search" onchange="paymentSearch()" name="search" id="search-payment" placeholder="year">
               <span class="submit" onclick="paymentSearch()">search</span>
            </div>
         </section>

         <table>
            <tr>
               <th>From Year</th>
               <th>To Year</th>
               <th>Total Sales</th>
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
                        <a href="./update.php?id=<?php echo $rows['salesId']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="./delete_sales.php?deleteId=<?php echo $rows['salesId']; ?>" class="btn btn-danger btn-sm">Delete</a>
                     </td>
                  </tr>
               <?php endwhile; ?>
            <?php endif; ?>
         </table>
      </div>

      <div class="add-sales">
         <button class="btn-success"><a href="./add_sales.php">Add Sales</a></button>
      </div>
   </div>

<?php include __DIR__.'\admin_footer.php'; 
