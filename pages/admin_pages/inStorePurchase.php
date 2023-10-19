<?php 
 include '../connect.php';

 $getProductId = $_GET['prodId'];
 $getProduct = "SELECT * FROM `product` WHERE productId = $getProductId";
 $getProductResult = mysqli_query($conn, $getProduct);
 $fetchProduct = mysqli_fetch_assoc($getProductResult);
 $getproductName = $fetchProduct['productName'];
 $getproductPrice = $fetchProduct['productPrice'];
 $getproductImg = $fetchProduct['productImg'];

?>

<form action="../validation/storePurchase.php?prodId=<?php echo $getProductId; ?>" method="post" class="buy-form">
    <div><?php echo $getproductName?></div>
    <img src="../../uploads/<?php echo $getproductImg;?>" alt="" width="120px" style="background-color: #f8f8f8; height: 120px; border: 1px solid #c3c3c3">
    <br>
    <br>
    <div>Quantity</div>
    <input type="number" name="quantity" id="quantity" required>
    <input type="submit" value="Purchase" name="submit" id="add" class="btn-success">
</form>