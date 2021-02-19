<?php

require("vendor/autoload.php");

use \Firebase\JWT\JWT;

$payload = array(
    "iss" => "localhost.cz",
    "aud" => "localhost.cz",
    "iat" => openssl_encrypt("2356999524", "AES-128-ECB", "test123"),
    "nbf" => openssl_encrypt("1357000001", "AES-128-ECB", "test123")
);

$jwt = JWT::encode($payload, 'test123', 'HS256');
echo "Encode:\n" . print_r($jwt, true) . "\n";

echo "<p>". openssl_encrypt( $jwt, "AES-128-ECB", "test123")."</p>";

/** invalid */
$jwt = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QuY3oiLCJhdWQiOiJsb2NhbGhvc3QuY3oxMjMiLCJpYXQiOiI3M1c0bis1Mm5IN1phem9sZVdFQytnPT0iLCJuYmYiOiJ4LzhqWXN5SE96aVlPT1ZzWUtZbzJnPT0ifQ.TnD8-k8anmEHRdZX8MN-sbwXojOyTWVaBhoyIT4cOw8';

/** valid */
$jwt = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QuY3oiLCJhdWQiOiJsb2NhbGhvc3QuY3oiLCJpYXQiOiI3M1c0bis1Mm5IN1phem9sZVdFQytnPT0iLCJuYmYiOiJ4XC84allzeUhPemlZT09Wc1lLWW8yZz09In0.PrvCDiug8R9TlonZsHbi6wA0I0tkXGx3jgC3zfwPheE';

try {
    //code...
    $decoded = JWT::decode($jwt, 'test123', array('HS256'));

    $decoded_array = (array) $decoded;
    echo "Decode:\n" . print_r($decoded_array, true) . "\n";

    echo "\nDECODE: " . openssl_decrypt("73W4n+52nH7ZazoleWEC+g==", "AES-128-ECB", "test123");

} catch(Exception $e) {

    echo 'Caught exception: ',  $e->getMessage(), "\n";
}