<?php session_start();
include './connect.php';
  $search_term = $_POST['search'];
  $sql = "SELECT * FROM product WHERE productName LIKE '%$search_term%' AND stockType = 'o' AND productQty > 0 ORDER BY productName desc";
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
        <li class='lastchild'><i class="fa-solid fa-cart-shopping" style="color: #fff;"></i> <span class="checkout-number"><?php echo (isset($_SESSION['shoppingCart'])) ? count($_SESSION['shoppingCart']) : '0'; ?></span></li>
      </ul>
    </nav>

    <form action="./search.php" method="post">
      <input type="search" name="search" id="search" placeholder="search">
      <input type="submit" value="search" id="submit">
    </form>

    <div class="mp-list">
      <?php
			// $sql = "SELECT * FROM product WHERE stockType = 'o' AND productQty > 0 ORDER BY productName DESC";
			// $result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				while ($rows = mysqli_fetch_assoc($result)) {
		?>

			<div class="mp-card">
				<img src="<?php echo '../uploads/' . $rows['productImg']; ?>" alt='product-image' class="img-list">
				<div class="details">
					<div class="product-name">
						<?php echo $rows['productName']; ?>
					</div>
					<h2>
						<?php echo '₱' . $rows['productPrice']; ?>
					</h2>
				</div>
				<div class="cart-btn">
					<?php $productID = $rows['productId']; ?>
					<a href='./validation/buyValidation.php?cartId=<?php echo $productID; ?>' class="buy-btn">Add to cart</a>
				</div>
			</div>
			
		<?php } }?>


      <div class="checkout">
        <h1 style='font-size: 2vh; background-color: #007430; padding: 10px; color: #fff; margin-bottom: 20px;'><i class="fa-solid fa-cart-shopping" style="color: #fff;"></i> Cart</h1>
        <div class="add-to-cart">

          <?php
          if (!empty($_SESSION['shoppingCart'])) {
            $total = 0;
            foreach ($_SESSION['shoppingCart'] as $keys => $values) {
          ?>
              <div class='transparent-bg'>

                <div class='name-and-image'>
                  <div style='text-align: center;'><?php echo $values['itemName']; ?></div>
                  <img src='../uploads/<?php echo $values['itemImage']; ?>' alt='product-image'>
                </div>

                <div>₱ <?php echo $values['itemPrice']; ?></div>

                <div class="input-quanty">
                  <div class="minus" onclick='minus(<?php echo $keys ?>, <?php echo $values["itemStock"]; ?>)'>-</div>
                  <div class="quantity-value<?php echo $keys ?> quantity"><?php echo $values["itemQuantity"]; ?></div>
                  <div class="add" onclick='add(<?php echo $keys ?>, <?php echo $values["itemStock"]; ?>)'>+</div>
                </div>

                <div><i class="fa-solid fa-trash" style="color: #007430;" onclick="deleteItem(<?php echo $keys ?>)"></i></div>

              </div>

              <br>

            <?php $total = $total + ($values['itemPrice'] * $values['itemQuantity']);
            } ?>
          <?php } else {
            echo "<div style='text-align: center;'>No item</div>";
          } ?>

          <hr>

          <h2 class="total">total : ₱<?php echo (!empty($_SESSION['shoppingCart'])) ? $total : '0' ?></h2>

        </div>

        <div class="checkout-buttons">

          <a href="./customerInformation.php" class="btn-success">Checkout</a>
          <div class="btn-danger" id="btn-close">Close</div>

        </div>
      </div>

      <?php if (mysqli_num_rows($result) == 0) {
        echo "<h2>Not Found</h2>";
      } ?>


    </div>
		<!-- <div class="copyright">Copyright © 2023 Medicure Drug.</div> -->

  </div>


  <script>
    function minus(cartId, quantity) {

      if (quantity > 0) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.querySelector('.add-to-cart').innerHTML = this.responseText

          }
        }

        xhttp.open("GET", "./validation/changeQuantity.php?cartId=" + cartId + "&op=minus", true);
        xhttp.send();
      }

    }

    function add(cartId, maxStock, quantity) {

      if (quantity < maxStock) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.querySelector('.add-to-cart').innerHTML = this.responseText

          }
        };

        xhttp.open("GET", "./validation/changeQuantity.php?cartId=" + cartId + "&op=plus", true);
        xhttp.send();
      }

    }


    function deleteItem(deleteId) {
      // window.location = './validation/deleteCartItem.php?deleteId=' + deleteId;
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.querySelector('.add-to-cart').innerHTML = this.responseText

        }
      };

      xhttp.open("GET", './validation/deleteCartItem.php?deleteId=' + deleteId, true);
      xhttp.send();

    }
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="../js/jsAnimation.js"></script>
</body>

</html>