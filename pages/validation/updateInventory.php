<?php include '../admin_pages/admin_header_php.php' ?>
<?php 
   $updateId = $_GET["updateId"];
   $sql = "SELECT * FROM product WHERE productId = $updateId";
   $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($result);

   if (isset($_POST['submit'])) {
      $productName = $_POST['productName'];
      $expiredDate = $_POST['expiredDate'];
      $stock = $_POST['stock'];
      $productPrice = $_POST['productPrice'];

      $sqlUpdate = "UPDATE `product` SET `productName`='$productName',`productExpired`='$expiredDate',`productQty`='$stock',`productPrice`='$productPrice' WHERE `productId` = '$updateId'";

      $updateSql = mysqli_query($conn, $sqlUpdate);

      if ($updateSql) {
         header("location:../admin_pages/inventory.php?message=updated successful");
      } else {
         echo mysqli_error($conn);
      }
      mysqli_close($conn);
   } else {
      echo mysqli_error($conn);
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

<?php include '../admin_pages/admin_header_html.php'; ?>
   <div class="head-title">Edit Stock</div>
<?php include '../admin_pages/admin_header_html2.php'; ?>
         
   <div class="inventory-content">
      <div class="modal">
         <form action="" method="post">
            <div>Product Name</div>
            <input type="text" name="productName" id="productName" value="<?php echo $row["productName"]; ?>" required>

            <div>Expired Date</div>
            <input type="date" name="expiredDate" id="expiredDate" value="<?php echo $row["productExpired"]; ?>" required>

            <div>Stock</div>
            <input type="number" name="stock" id="stock" value="<?php echo $row["productQty"]; ?>" required>

            <div>Price</div>
            <input type="number" name="productPrice" id="productPrice" value="<?php echo $row["productPrice"]; ?>" required><br />

            <input type="submit" value="Update" name="submit" id="add" class="btn-success">
         </form>
      </div>
   </div>

<?php include '../admin_pages/admin_footer.php'; 
