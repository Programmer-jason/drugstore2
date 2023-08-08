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

if(mysqli_num_rows($getUserResult) > 0 && mysqli_num_rows($getProductResult) > 0 ){
    echo "
    <img src='../uploads/$getproductImage' alt='product-image'>
    <br>
    <div>Quantity</div>
    <input type='number' min='0'/>
    <br>
    <br>
    <a href='#' class='btn-success'>Buy</a>
    ";
}

}
else {
    header("location: ../signIn.php?message=You need to signin");
}
?>

