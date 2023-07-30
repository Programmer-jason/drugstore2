<?php
session_start();
include '../connect.php';

$decId = $_GET['decrementId'];

$sql = "SELECT * FROM product WHERE productId = $decId";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($result);

$decQty = $rows["productQty"] - 1;

$sqlUpdate = "UPDATE `product` SET `productQty` =  $decQty Where productId = $decId";
mysqli_query($conn, $sqlUpdate);
