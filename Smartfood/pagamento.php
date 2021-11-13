<?php
  $curl = curl_init();
  $json = '';

  $headers = [
    'Authorization: Basic sk_test_tra6ezsW3BtPPXQa: base64',
    'Content-Type: application/json'
  ];

  curl_setopt_array($curl, [
    CURLOPT_URL             => "https://api.pagar.me/core/v5/orders",
    CURLOPT_RETURNTRANSFER  => true,
    CURLOPT_CUSTOMREQUEST   => "POST",
    CURLOPT_HTTPHEADER      => $headers,
    CURLOPT_POSTFIELDS      => $json
  ]);
