<?php
  session_start();
  include '../pages/connect.php';

  //CUSTOMER INFORMATION
  $fullname = htmlspecialchars($_POST['fullname']);
  $email = htmlspecialchars($_POST['email']);
  // $contact = htmlspecialchars($_POST['contact']);
  $_SESSION['totalAmount'] = 0;

  $lineItem = array();
  foreach($_SESSION['shoppingCart'] as $keys => $values) {
    $img = $values['itemImage'];
    $name = $values['itemName'];
    $price = $values['itemPrice'];
    $priceOrig = str_replace('.', '', $price);
    $quantity = $values['itemQuantity'];

    $lineItem[$keys] = array(
        'amount' => (int)$priceOrig,
        'currency' => 'PHP',
        'description' => 'medicure drug product',
        'images' => [
          "http://localhost/drugstore-management-system/uploads/$img"
        ],
        'name' => $name,
        'quantity' => (int)$quantity,
    );

    $_SESSION['totalAmount'] = $_SESSION['totalAmount'] + ($price * $quantity);
  }	

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
            'name' => "$fullname",
            'email' => "$email",
            'phone' => "09123456789"
          ],
          'send_email_receipt' => false,
          'show_description' => true,
          'show_line_items' => true,
          'cancel_url' => 'http://localhost/drugstore-management-system/paymongoApi/checkoutResource.php',
          'description' => 'medicure drug product',
          'line_items' => [...$lineItem],
          'payment_method_types' => [
            'gcash',
            'paymaya',
          ],
          // 'reference_number' => uniqid(),
          'success_url' => 'http://localhost/drugstore-management-system/paymongoApi/checkoutResource.php',
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
    // echo $response;
    
    $checkout_id = $getresponse->data->id;
    $_SESSION['checkoutId'] = $checkout_id;
    $total_amount = $_SESSION['totalAmount'];
    $get_checkout_name = $getresponse->data->attributes->billing->name;
    $get_checkout_status = $getresponse->data->attributes->payment_intent->attributes->payments[0]->attributes->status;
    $get_paymentMethod = $getresponse->data->attributes->payment_method_used;
    $_SESSION['payment_method'] = $get_paymentMethod;

    // $sql_insert = "INSERT INTO `paymentdetails`(`paymentId`,`checkoutId`,`name`,`price`,`paymentStatus`) 
    //                VALUES (null, '$checkout_id', '$get_checkout_name', '$total_amount', 'pending')";
    // mysqli_query($conn, $sql_insert);

    $geUrl = $getresponse->data->attributes->checkout_url;
    header("location: $geUrl");

  }

?>

