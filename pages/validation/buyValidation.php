<?php
session_start();
include '../connect.php';

if(isset($_SESSION["user"])){

$getProductId = $_GET['buyId'];
$getUserEmail = $_SESSION['user'];

$getUser = "SELECT * FROM signUp WHERE email = '$getUserEmail'";
$getUserResult = mysqli_query($conn, $getUser);
$fetchUser = mysqli_fetch_assoc($getUserResult);

$getUserId = $fetchUser['userId'];

$getProduct = "SELECT * FROM `product` WHERE productId = $getProductId";
$getProductResult = mysqli_query($conn, $getProduct);
$fetchProduct = mysqli_fetch_assoc($getProductResult);
$getproductImage = $fetchProduct['productImg'];
$getproductName = $fetchProduct['productName'];
$getproductPrice = $fetchProduct['productPrice'];

if(mysqli_num_rows($getUserResult) > 0 && mysqli_num_rows($getProductResult) > 0 ){
    echo "
    <div>$getproductName</div>
    <img src='../uploads/$getproductImage' alt='product-image'>
    <br>
    <div>Quantity</div>
    <input type='number' min='0' value='1' id='quanty'/>
    <div>₱$getproductPrice</div>
      <br>
      <a href='#' class='btn-success' onclick='getQuantity($getProductId)'>Proceed</a>
      <a href='./medicine.php' class='btn-danger'>Cancel</a>

    ";
}
}

?>
