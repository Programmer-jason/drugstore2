<?php include './admin_header_php.php'; ?> 

<?php
   //PAGINATION
   $record_number_perpage = 10;
   $offset = ($page_no - 1) * $record_number_perpage;

   $number_of_newstock = "SELECT COUNT(*) FROM product WHERE stockType = 'o'";
   $newstock_result = mysqli_query($conn, $number_of_newstock);
   $total_rows = mysqli_fetch_array($newstock_result)[0];
   $total_page = ceil($total_rows / $record_number_perpage);

   $sql_payment_search = "SELECT * FROM product WHERE stockType = 'o' ORDER BY productId DESC LIMIT $offset, $record_number_perpage";
   $result_payment_search = mysqli_query($conn, $sql_payment_search);

   //SEARCH PAYMENT
   if(isset($_GET['searching'])){
      if ($_GET['searching'] != '') {
         $searchOnchange = $_GET['searching'];
         $sql_payment_search = "SELECT * FROM `product` WHERE stockType = 'o' AND productName LIKE '%$searchOnchange%' LIMIT $offset, $record_number_perpage";
         $result_payment_search = mysqli_query($conn, $sql_payment_search);
      } else {
         // $searchOnchange = $_GET['searching'];
         $sql_payment_search = "SELECT * FROM `product` WHERE stockType = 'o' LIMIT $offset, $record_number_perpage";
         $result_payment_search = mysqli_query($conn, $sql_payment_search);
      }
   }
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

<?php include './admin_header_html.php'; ?>
   <div class="head-title">Inventory / Stock</div>
<?php include './admin_header_html2.php'; ?>

   <div class="inventory-content">

      <div class="add-product-content">
         <div class="btn-success cancel">x</div>
         <div class="insert-form">
         </div>
      </div>

      
      <div class="table-container">
         <section class="payment-details-head">
            <div class="search-container">
               <input type="search" name="search" id="search-payment" placeholder="item name">
               <span class="submit" onclick="itemSearch()">search</span>
            </div>
            
            <div class="stock-links">
               <a href="./newStock.php">Stock</a>
               <a href="./damagedStock.php">Damaged Stock</a>
               <a href="./expiredStock.php">Expired Stock</a>
            </div>
         </section>
         
         <section class="instore-purchase">
            <div class="btn-success cancel">x</div>
            <div class="instore-purchase2">
            </div>
         </section>

         <table>
            <tr>
               <th>Item Image</th>
               <th>Item Name</th>
               <th>Price</th>
               <th>Quantity</th>
               <th>Location</th>
               <th colspan="3">Action</th>
            </tr>
            <?php if (mysqli_num_rows($result_payment_search) > 0) : ?>
               <?php while ($rows = mysqli_fetch_assoc($result_payment_search)) : ?>
                  <?php 
                     // if($rows['productQty'] <= 0){
                     //    $productN = $rows['productName'];
                     //    $deleteQ =  "DELETE FROM product WHERE productName = '$productN'";
                     //    mysqli_query($conn, $deleteQ);
                     //    unlink('../../uploads/'.$rows['productImg']);
                     // }
                  ?>
                     <tr>
                        <td>
                           <img src="../../uploads/<?php echo $rows['productImg'];?>" alt="" width="30px" height="27px">
                        </td>

                        <td>
                           <?php echo $rows['productName']; ?>
                        </td>

                        <td>
                           <?php echo '₱' . number_format($rows['productPrice']); ?>
                        </td>

                        <td>
                           <?php echo $rows['productQty']; ?>
                        </td>

                        <td>
                           <?php echo $rows['shelve']; ?>
                        </td>

                        <td>
                           <span onclick="inStorePurchase(<?php echo $rows['productId'] ?>)" class="btn-instore btn-primary">Purchase</span>

                           <?php if ($row6['role'] == 'admin') { ?>
                              <span onclick="addStockAndDamage(<?php echo $rows['productId'] ?>)" class="btn-add-stock">Add Stock</span>
                              <span onclick="addDamage(<?php echo $rows['productId'] ?>, 'd')" class="btn-damage">Add Damage</span>
                     
                              <a href="./delete_medicine.php?deleteId=<?php echo $rows['productId']; ?>" class="btn-danger">Delete</a>
                              <!-- <a href="../validation/updateInventory.php?updateId=<?php echo $rows['productId']; ?>" class="btn btn-primary">Edit</a> -->
                           <?php } ?>
                        </td>
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
   
   <script>
      function itemSearch() {
			let search = document.getElementById("search-payment").value
			window.location="./newStock.php?searching=" + search
      }
   </script>
<?php include __DIR__.'\admin_footer.php'; 
