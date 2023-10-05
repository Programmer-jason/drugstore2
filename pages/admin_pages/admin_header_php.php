<?php
session_start();
include '../connect.php';

$sql2 = "SELECT * FROM `signUp`;";
$result2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result2);

$userProf = $_SESSION['user'];
$sql6 = "SELECT * FROM signup WHERE email = '$userProf'";
$result6 = mysqli_query($conn, $sql6);
$userProfile = mysqli_num_rows($result6);
$row6 = mysqli_fetch_assoc($result6);

if (isset($_SESSION["user"])) {
    $user = $_SESSION['user'];

    $sql4 = "SELECT * FROM signUp WHERE email = '$user'";
    $result4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_assoc($result4);

    $userProfile = $row4['userProfile'];
}
//NOTIFICATION
$sqlNotifys = "SELECT * FROM product WHERE notificationType = 'nr'";
$resultNotifys = mysqli_query($conn, $sqlNotifys);

 //PAGINATION
 if (isset($_GET['page_no'])) {
    $page_no = $_GET['page_no'];
 } else {
    $page_no = 1;
 }
 
 //ERROR MESSAGE
if (isset($_GET['message'])) {
    $getMessage = $_GET['message'];
    echo "<script>alert('$getMessage')</script>";
 }
 
//  $sql = "SELECT * FROM `signUp` WHERE `role` = 'customer'";
//  $result = mysqli_query($conn, $sql);