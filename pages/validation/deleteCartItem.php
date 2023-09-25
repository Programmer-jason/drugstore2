<?php session_start();
// echo json_encode($_SESSION['shoppingCart']);
$deleteItem = $_GET['deleteId'];
unset($_SESSION['shoppingCart'][$deleteItem]);
header("location: ../medicine.php");
