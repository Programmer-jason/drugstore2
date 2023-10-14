<?php session_start();

include("../connect.php");

$payment_id = $_GET['payment_id'];

$get_payment_action = "SELECT * FROM `paymentDetails` WHERE `paymentId` = $payment_id";
$payment_action_result = mysqli_query($conn, $get_payment_action);
$payment_action_row = mysqli_fetch_assoc($payment_action_result);
$ref_id = $payment_action_row['refId'];
$dateNow = date('Y-m-d');

if($payment_action_row['paymentAction'] == 'recieve'){
    $sql_updating_payment = "UPDATE `paymentdetails` SET `paymentAction`='not_recieve' WHERE paymentId = $payment_id";
    mysqli_query($conn, $sql_updating_payment);
    header("location: ../admin_pages/paymentDetails.php");
}

else {
    $sql_updating_payment = "UPDATE `paymentdetails` SET `paymentAction`='recieve',`dateRecieved`='$dateNow' WHERE paymentId = $payment_id";
    mysqli_query($conn, $sql_updating_payment);


    $select_checkout = "SELECT * FROM `checkout_item` WHERE `ref_id`='$ref_id'";
    $checkout_result = mysqli_query($conn, $select_checkout);

    if(mysqli_num_rows($checkout_result) > 0){
        while($rows = mysqli_fetch_assoc($checkout_result)){
            $item_id = $rows['item_id'];
            $item_name = $rows['item_name'];
            $item_qty = $rows['item_qty'];

            $product_select = "SELECT * FROM `product` WHERE productId =$item_id";
            $product_result = mysqli_query($conn, $product_select);
            $product_row = mysqli_fetch_assoc($product_result);
            $product_id = $product_row['productId'];
            $product_qty = $product_row['productQty'];
            $minus_product = ($product_qty-$item_qty);

            if($item_id == $product_id){
                $product_update = "UPDATE `product` SET `productQty`='$minus_product' WHERE productId =$item_id";
                mysqli_query($conn, $product_update);
            }
        }
    }else {
        echo 'dqqd';
    }
    header("location: ../admin_pages/paymentDetails.php");


}