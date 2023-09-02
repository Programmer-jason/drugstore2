<?php session_start();
include '../pages/connect.php';

if(isset($_SESSION["user"])){
$productId = $_GET['productId'];
$checkoutId = $_SESSION['checkoutId'];
$checkoutPrice = $_SESSION['checkoutPrice'];

//GET PRODUCT
$getproduct = "SELECT * FROM product WHERE productId = $productId";
$getProductResult = mysqli_query($conn, $getproduct);
$fetchProduct = mysqli_fetch_assoc($getProductResult);
$fetchQty = $fetchProduct['productQty'];

//GET USER
$user = $_SESSION['user'];
$getUser = "SELECT * FROM signup WHERE email = '$user'";
$getUserResult = mysqli_query($conn, $getUser);
$fetchUser = mysqli_fetch_assoc($getUserResult);
$fetchUserId = $fetchUser['userId'];
$fetchfirstname = $fetchUser['firstName'];
$fetchLastname = $fetchUser['lastName'];
$fetchEmail = $fetchUser['email'];
$fetchContact = $fetchUser['contact'];
$username = "$fetchfirstname $fetchLastname";

// RETRIVE CHECKOUT
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.paymongo.com/v1/checkout_sessions/$checkoutId",
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
  echo $response;
}

$getresponse = json_decode($response);
$getId = $getresponse->data->attributes->reference_number;
$getCheckoutName = $getresponse->data->attributes->billing->name;
$getCheckoutAddress = $getresponse->data->attributes->billing->address->line1;
$getCheckoutBrgy = $getresponse->data->attributes->billing->address->line2;
$getCheckoutAmount = $getresponse->data->attributes->line_items[0]->amount;
$getCheckoutProductName = $getresponse->data->attributes->line_items[0]->name;
$getCheckoutQuantity = $getresponse->data->attributes->line_items[0]->quantity;
$getCheckoutStatus = $getresponse->data->attributes->payments[0]->attributes->status;
$getCheckoutDate = $getresponse->data->attributes->created_at;
$chechoutDate = date("d-m-Y");
$getCheckoutPaymentMethod = $getresponse->data->attributes->payment_method_used;

$sqlIn = "INSERT INTO `paymentdetails`(`paymentId`, `userId`, `refId`,`checkoutId`,`name`,`productName`,`amount`,`paymentStatus`,`createdAt`,`paymentType`,`address`,`brgy`) VALUES (null,'$fetchUserId','$getId','$checkoutId','$getCheckoutName','$getCheckoutProductName','$checkoutPrice','$getCheckoutStatus','$chechoutDate','$getCheckoutPaymentMethod','$getCheckoutAddress','$getCheckoutBrgy')";
mysqli_query($conn, $sqlIn);

    $sqlUpdate = "UPDATE `product` SET `productQty`=($fetchQty - $getCheckoutQuantity) WHERE productId = $productId";
    if($fetchQty != 0){
      mysqli_query($conn, $sqlUpdate);
    }else {
      return '';
    }

header("location: ../pages/medicine.php?message=success");
// ==========================================================
}