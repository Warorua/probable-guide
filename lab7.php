<?php
//echo  json_encode($_SERVER);
$proxy = '123.123.123.123:8080'; // Replace with your proxy server's IP and port.
$url = 'https://sbnke.com/verif/lab7.php'; // Replace with the URL you're sending the request to.

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_PROXY, $proxy);

// If your proxy requires authentication, use this:
// curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'username:password');

$response = curl_exec($ch);
curl_close($ch);

echo $response;

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://sbnke.com/verif/lab7.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => true, // Include headers in the output
));

$response = curl_exec($curl);
$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
$headers = substr($response, 0, $header_size);
$body = substr($response, $header_size);

curl_close($curl);

echo "Headers:\n$headers\n";
echo "Body:\n$body\n";
