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
    <input type='number' min='0' value='1'/>
    <br>
    <br>
    <a href='./validation/paymongoApi.php' class='btn-success'>Buy</a>
    <a href='./medicine.php' class='btn-danger'>Cancel</a>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js' integrity='sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==' crossorigin='anonymous' referrerpolicy='no-referrer'></script>
    <script src='../../js/jsAnimation.js'></script>

    ";
}
}
else {
    header("location: ../signIn.php?message=You need to signin");
}
?>
