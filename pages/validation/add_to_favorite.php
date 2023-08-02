<?php
session_start();
include '../connect.php';

if(isset($_SESSION["user"])){

$getProductId = $_GET['favId'];
$getUserEmail = $_SESSION['user'];

$getUser = "SELECT * FROM signUp WHERE email = '$getUserEmail'";
$getUserResult = mysqli_query($conn, $getUser);
$fetchUser = mysqli_fetch_assoc($getUserResult);

$getUserId = $fetchUser['userId'];

$getFavorite = "SELECT * FROM `user_favorite` WHERE user_id = $getUserId AND product_id = $getProductId";
$getFavoriteResult = mysqli_query($conn, $getFavorite);
$fetchFavorite = mysqli_fetch_assoc($getFavoriteResult);

    if(mysqli_num_rows($getFavoriteResult) == 0){
        $getFavorites = "INSERT INTO `user_favorite`(`user_id`, `product_id`, `is_favorite`) VALUES ($getUserId, $getProductId, 't')";
        mysqli_query($conn, $getFavorites);
        header("location: ../medicine.php?message=added to favorite");
    }else {
        header("location: ../medicine.php?message=added Already");
    
    }
}
else {
    header("location: ../signIn.php?message=You need to signin");
}

