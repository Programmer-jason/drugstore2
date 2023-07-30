<?php
session_start();
include '../connect.php';

$getProductId = $_GET['favId'];
$getUserEmail = $_SESSION['user'];

$getUser = "SELECT * FROM signUp WHERE email = '$getUserEmail'";
$getUserResult = mysqli_query($conn, $getUser);
$fetchUser = mysqli_fetch_assoc($getUserResult);

$getUserId = $fetchUser['userId'];

$getFavorite = "SELECT * FROM `user_favorite` WHERE product_id = $getProductId";
$getFavoriteResult = mysqli_query($conn, $getFavorite);
$fetchFavorite = mysqli_fetch_assoc($getFavoriteResult);

if($getProductId != $fetchFavorite['product_id']){
    $getFavorite = "INSERT INTO `user_favorite`(`user_id`, `product_id`, `is_favorite`) VALUES ($getUserId, $getProductId, 't')";
    mysqli_query($conn, $getFavorite);
    header("location: ../medicine.php?message=added to favorite");
}else {
    header("location: ../medicine.php?message=added Already");

}


// if(mysqli_num_rows($getFavoriteResult) > 0){
//    while($row = mysqli_fetch_assoc($getFavoriteResult)){
//     if($getProductId == $row['product_id']){
//        echo "<script>
//         document.getElementById('heart').style.color = 'pink'
//        </script>"; 
//        header("location: ../medicine.php?message=added to favorite");
//        exit();
//     }
//     else {
//        echo "<i class='fa-solid fa-heart' style='color: red;'></i>"; 
//        header("location: ../medicine.php?message=your not an admin");
//        exit();

//     }
//    }
// }
?>