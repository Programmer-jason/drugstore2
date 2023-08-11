<?php

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
                        'line1' => '565',
                        'line2' => '565',
                        'city' => 'manila',
                        'state' => 'none',
                        'postal_code' => '1013',
                        'country' => 'PH'
                    ],
                    'name' => 'jason',
                    'email' => 'dwghrh4d@gmail.com',
                    'phone' => '+639232313232'
                ],
                'send_email_receipt' => false,
                'show_description' => true,
                'show_line_items' => true,
                'cancel_url' => 'https://www.paymongo.com/',
                'description' => 'kahit ano',
                'line_items' => [
                                [
                                    'amount' => 343,
                                    'currency' => 'PHP',
                                    'description' => 'kahit ano din',
                                    'images' => [
                                        'https://www.dreamhost.com/blog/wp-content/uploads/2019/06/afa314e6-1ae4-46c5-949e-c0a77f042e4f_DreamHost-howto-prod-descrips-full.jpeg'
                                    ],
                                    'name' => 'bionemic',
                                    'quantity' => 34
                                ]
                ],
                'payment_method_types' => [
                                'gcash',
                                'paymaya',
                                'grab_pay',
                                'card',
                                'billease' 
                ],
                'reference_number' => '34343fefwfw',
                'success_url' => 'http://localhost/drugstore-management-system/pages/medicine.php',
                'statement_descriptor' => 'rgrg34'
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

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  
  echo $response;
}