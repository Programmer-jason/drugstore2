<?php session_start();
include './connect.php';

$search_term = $_POST['search'];
$sql = "SELECT * FROM product WHERE productName LIKE '%$search_term%' AND stockType BETWEEN 'n' AND 'o' ORDER BY productId desc";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="../style/medicine.css">
   <link rel="stylesheet" href="../style/navbar.css">
  <link rel="stylesheet" href="../style/button.css" />
</head>

<body>
  <div class="medicine-container">
   <nav>
      <div class="brand">
         <img src="../images/sample logo.png" alt="no image" />
         <a href="../index.php">Medicure Drug</a>
      </div>

      <i class="fa fa-bars" aria-hidden="true"></i>
      <ul>
         <li><a href="../index.php">Home</a></li>
         <li><a href="./medicine.php">Product</a></li>
         <li><a href="./about.php">About</a></li>
         <li><a href="./contact.php">Contact</a></li>
         <li class='lastchild'><i class="fa-solid fa-cart-shopping" style="color: #fff;"></i> <span class="checkout-number">0</span></li>
      </ul>
   </nav>

   <form action="./search.php" method="post">
       <input type="search" name="search" id="search">
       <input type="submit" value="Search" id="submit">
   </form>
   
   <div class="mp-list">
    <?php
      $sqls = "SELECT * FROM product WHERE stockType BETWEEN 'n' AND 'o' ORDER BY productId desc";
      $results = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
          $prodId2 = $rows['productId'];

           //DELETE QUERY
           $sqlDelete = "DELETE FROM `product` WHERE `productId` = $prodId2";
           if($rows['productQty'] <= 0){
               mysqli_query($conn, $sqlDelete);
           }

      ?>
        <div class="mp-card">
            <img src="<?php echo '../uploads/' . $rows['productImg']; ?>" alt='image' class="img-list">

            <div class="details">
                <div class="product-name">
                <?php echo $rows['productName'] ?>
                </div>
                
                <div>
                <?php echo '₱'.$rows['productPrice'] ?>
                </div>
            </div>

            <div class="cart-btn">
                <div class="buy-btn" onclick="checkout(<?php echo $rows['productId']; ?>)">Add to cart</div>
            </div>
          </div>
        <?php } ?>
      <?php } ?>

      
      <div class="checkout">
        <h1 style='font-size: 2vh; border-bottom: #007430 2px solid; padding: 10px; color: #007430;'>My Cart</h1>
        <div class="add-to-cart">
        </div>
        <div class="checkout-buttons">
            <a href="#" class="btn-success">Checkout</a>
            <a href="#" class="btn-danger">Close</a>
        </div>
      </div>

    <?php if (mysqli_num_rows($result) == 0) {
    echo "<h2>Not Found</h2>";
    } ?>


   </div>
  </div>
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/jsAnimation.js"></script>
    <script>
     function checkout ( getProductId ) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function (getProductId) {
        if (this.readyState == 4 && this.status == 200) {
          document.querySelector(".add-to-cart").innerHTML += this.responseText ;

        }
      };
      xhttp.open("GET", `./validation/buyValidation.php?buyId=${getProductId}`, true);
      xhttp.send();
      
      // getQuantity(getProductId)
    }
    </script>
</body>
</html>