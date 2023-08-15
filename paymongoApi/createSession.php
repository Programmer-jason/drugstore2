<?php
session_start();
include '../pages/connect.php';

$productId = $_GET['productId'];
$user = $_SESSION['user'];

//GET USER
$getUser = "SELECT * FROM signup WHERE email = '$user'";
$getUserResult = mysqli_query($conn, $getUser);
$fetchUser = mysqli_fetch_assoc($getUserResult);
$fetchfirstname = $fetchUser['firstName'];
$fetchLastname = $fetchUser['lastName'];
$fetchEmail = $fetchUser['email'];
$fetchContact = $fetchUser['contact'];
$username = "$fetchfirstname $fetchLastname";

//GET PRODUCT
$getproduct = "SELECT * FROM product WHERE productId = $productId";
$getProductResult = mysqli_query($conn, $getproduct);
$fetchProduct = mysqli_fetch_assoc($getProductResult);
$fetchImg = $fetchProduct['productImg'];
$fetchName = $fetchProduct['productName'];
$fetchQuanty = $fetchProduct['productQty'];
$fetchPrice = $fetchProduct['productPrice'];

$imgUrl = "http://localhost/drugstore-management-system/uploads/$fetchImg";
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.paymongo.com/v1/checkout_sessions",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'data' => [
        'attributes' => [
                'billing' => [
                    'address' => [
                        'line1' => '742',
                        'line2' => '',
                        'city' => 'Manila',
                        'state' => 'none',
                        'postal_code' => '1013',
                        'country' => 'PH'
                    ],
                    'name' => $username,
                    'email' => $fetchEmail,
                    'phone' => $fetchContact
                ],
                'send_email_receipt' => false,
                'show_description' => true,
                'show_line_items' => true,
                'cancel_url' => 'http://localhost/drugstore-management-system/pages/medicine.php',
                'description' => 'medicure drug product',
                'line_items' => [
                    [
                        'amount' => $price,
                        'currency' => 'PHP',
                        'description' => 'medicure drug product',
                        'images' => [
                        $imgUrl,
                        ],
                        'name' => $fetchName,
                        'quantity' => 4,
                    ]
                ],
                'payment_method_types' => [
                                'gcash',
                                'paymaya',
                                'grab_pay',
                                'card',
                                'billease' 
                ],
                'reference_number' => '1843434545545334',
                'success_url' => 'http://localhost/drugstore-management-system/pages/medicine.php',
                'statement_descriptor' => 'medicure drugs product'
        ]
    ]
  ]),
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "accept: application/json",
    "authorization: Basic c2tfdGVzdF9WVk13a1FjVTl4M25ZRTN0WUJkQzRnSmg6"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

$getresponse = json_decode($response);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $geUrl = $getresponse->data->attributes->checkout_url;
    header("location: $geUrl");
}