<?php session_start();
$keys = $_GET['cartId'];
$itemQuan = $_GET['quan'];
$total = 0;

unset($_SESSION['shoppingCart']["$keys"]['itemQuantity']);
$_SESSION['shoppingCart'][$keys]['itemQuantity'] = $itemQuan;

foreach($_SESSION['shoppingCart'] as $keys => $values){
    $total = $total + ($values['itemPrice'] * $values['itemQuantity']);
}

echo 'total : ₱'.' '.$total;