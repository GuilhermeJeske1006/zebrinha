<?php

// QRCO_5FFBB21D-46A3-494D-9F1D-5DAE72A10DD9

$curl = curl_init();

$qrCode = 'QRCO_EEBAEE8C-C40E-493E-88E4-E41CBB4DE34F';

curl_setopt_array($curl, [
  CURLOPT_URL => "https://sandbox.api.pagseguro.com/pix/pay/{$qrCode}",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYPEER => true,
  CURLOPT_CAINFO => "cacert.pem",
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => [
    "Authorization: 3EADF66FE76B407894FC414D33893228",
    "accept: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  dd($response);
}