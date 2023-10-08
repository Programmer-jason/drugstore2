<?php include __DIR__.'\admin_header_php.php'; ?>
<?php
   //PAGINATION
   $record_number_perpage = 7;
   $offset = ($page_no - 1) * $record_number_perpage;

   $number_of_newstock = "SELECT COUNT(*) FROM product WHERE stockType = 'o'";
   $newstock_result = mysqli_query($conn, $number_of_newstock);
   $total_rows = mysqli_fetch_array($newstock_result)[0];
   $total_page = ceil($total_rows / $record_number_perpage);

   $sql = "SELECT * FROM product WHERE stockType = 'o' ORDER BY productId DESC LIMIT $offset, $record_number_perpage";
   $result = mysqli_query($conn, $sql);

   $deleteQ =  "DELETE FROM product WHERE productQty <= 0";
   mysqli_query($conn, $deleteQ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inventory</title>
   <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
   <link rel="stylesheet" href="../../style/navbar.css" />
   <link rel="stylesheet" href="../../style/sidenav.css" />
   <link rel="stylesheet" href="../../style/inventory.css" />

</head>

<?php include __DIR__.'\admin_header_html.php'; ?>
   <div class="head-title">Inventory / Stock</div>
<?php include __DIR__.'\admin_header_html2.php';?>

   <div class="inventory-content">

      <div class="add-product-content">
         <div class="insert-form">
         </div>
         <div class="btn-success cancel">Cancel</div>
      </div>


      <div class="table-container">
         <section class="payment-details-head">
            <div class="search-container">
               <input type="search" onchange="paymentSearch()" name="search" id="search-payment" placeholder="item name">
               <span class="submit" onclick="paymentSearch()">search</span>
            </div>

            <div class="stock-links">
               <a href="./newStock.php">Stock</a>
               <a href="./damagedStock.php">Damaged Stock</a>
               <a href="./expiredStock.php">Expired Stock</a>
            </div>
         </section>
         
         <table>
            <tr>
               <th>Item Image</th>
               <th>Item Name</th>
               <th>Price</th>
               <th>Quantity</th>
               <th>Location</th>
               <!-- <th>Expired Date</th> -->
               <?php if ($row6['role'] == 'admin') { ?>
                  <th colspan="3">Action</th>
               <?php } ?>
            </tr>
            <?php if (mysqli_num_rows($result) > 0) : ?>
               <?php while ($rows = mysqli_fetch_assoc($result)) : ?>
                     <tr>
                        <td>
                           <img src="../../uploads/<?php echo $rows['productImg'];?>" alt="" width="50px">
                        </td>
                        <td>
                           <?php echo $rows['productName']; ?>
                        </td>

                        <td>
                           <?php echo '₱' . $rows['productPrice']; ?>
                        </td>

                        <td>
                           <?php echo $rows['productQty']; ?>
                        </td>

                        <td>
                           <?php echo $rows['shelve']; ?>
                        </td>

                        <!-- <td>
                           <?php echo $rows['productExpired']; ?>
                        </td> -->

                        <?php if ($row6['role'] == 'admin') { ?>
                           <td>
                              <span onclick="addStockAndDamage(<?php echo $rows['productId'] ?>)" class="btn-add-stock">Add Stock</span>
                              <span onclick="addDamage(<?php echo $rows['productId'] ?>, 'd')" class="btn-damage">Add Damage</span>
                              <a href="./delete_medicine.php?deleteId=<?php echo $rows['productId']; ?>" class="btn-danger">Delete</a>
                              <!-- <a href="../validation/updateInventory.php?updateId=<?php echo $rows['productId']; ?>" class="btn btn-primary">Edit</a> -->
                           </td>
                        <?php } ?>
                     </tr>
               <?php endwhile; ?>
            <?php endif; ?>
         </table>
      </div>

      <section>
         <div class="pagination">
            <a href="<?php echo ($page_no <= 1) ? '#' : './newStock.php?page_no=' . ($page_no - 1) ?>" class="next-prev">Prev</a>
            <?php
            for ($i = 1; $i <= $total_page; $i++) {
               echo ($i == $page_no) ? "<a href='./newStock.php?page_no=$i' class='next-prev'>$i</a>" :
                  "<a href='./newStock.php?page_no=$i' class='total-page'>$i</a>";
            }
            ?>
            <a href="<?php echo ($page_no >= $total_page) ?  '#' : './newStock.php?page_no=' . ($page_no + 1) ?>" class="next-prev">Next</a>
         </div>
      </section>
   </div>
   
<?php include __DIR__.'\admin_footer.php'; 
