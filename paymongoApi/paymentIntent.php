<?php

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.paymongo.com/v1/payment_intents",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'data' => [
        'attributes' => [
                'amount' => 232323,
                'payment_method_allowed' => [
                                'atome',
                                'card',
                                'dob',
                                'paymaya',
                                'billease',
                                'gcash',
                                'grab_pay'
                ],
                'payment_method_options' => [
                                'card' => [
                                                                'request_three_d_secure' => 'any'
                                ]
                ],
                'currency' => 'PHP',
                'capture_type' => 'automatic',
                'description' => 'efeeff',
                'statement_descriptor' => 'jason'
        ]
    ]
  ]),
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Basic c2tfdGVzdF9WVk13a1FjVTl4M25ZRTN0WUJkQzRnSmg6",
    "content-type: application/json"
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