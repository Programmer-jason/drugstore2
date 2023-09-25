<?php session_start();
include '../pages/connect.php';

$checkout_id = $_SESSION['checkoutId'];
$total_amount = $_SESSION['totalAmount'];

// RETRIVE CHECKOUT
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.paymongo.com/v1/checkout_sessions/$checkout_id",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Basic c2tfdGVzdF9WVk13a1FjVTl4M25ZRTN0WUJkQzRnSmg6"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;

  $getresponse = json_decode($response);
  
  foreach($_SESSION['shoppingCart'] as $keys => $values) {
      $item_id = $values['itemId'];
    
      $sql_select = "SELECT * FROM product WHERE productId = $item_id";
      $sql_select_result = mysqli_query($conn, $sql_select);
      $get_row = mysqli_fetch_assoc($sql_select_result);
      $get_quantity = $get_row['productQty'];
    
      $get_checkout_quantity = $getresponse->data->attributes->line_items[$keys]->quantity;
    
      $sql_update = "UPDATE `product` SET `productQty`=($get_quantity - $get_checkout_quantity) WHERE productId = $item_id";
      
      if ($get_quantity != 0) {
        mysqli_query($conn, $sql_update);
      } else {
        return '';
      }
  }
    $get_reference = uniqid(true);
    $get_checkout_name = $getresponse->data->attributes->billing->name;
    $get_checkout_price = $getresponse->data->attributes->payment_intent->attributes->amount;
    $get_checkout_status = $getresponse->data->attributes->payments[0]->attributes->status;
    $get_paymentMethod = $getresponse->data->attributes->payment_method_used;

    $sql_updating_payment = "UPDATE `paymentdetails` SET `refId`='$get_reference',`paymentStatus`='$get_checkout_status',`paymentType`='$get_paymentMethod',`paymentAction`='not_recieve' WHERE checkoutId = '$checkout_id'";
    mysqli_query($conn, $sql_updating_payment);

    // session_destroy();
    $_SESSION['reference_id'] = $get_reference;
    $_SESSION['customer_name'] = $get_checkout_name;
    
    header("location: ../pages/payment_successful.php?message=success");

}