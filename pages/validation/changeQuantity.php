<?php session_start();
$keys = $_GET['cartId'];
$itemQuan = $_GET['quan'];

unset($_SESSION['shoppingCart']["$keys"]['itemQuantity']);
$_SESSION['shoppingCart'][$keys]['itemQuantity'] = $itemQuan;
