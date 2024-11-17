<?php

require 'vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Color\Color;

// Define the load URL, report URL, and parse key
$loadUrl = "https://kever.io/1sfxmrptepzcngxjgmb.php";
$reportUrl = "https://kever.io/1sfxmrptepzcngxjgmb.php";
$parseKey = "12345abcde";

// Step 1: Create the string in the specified format
//$dataString = $loadUrl . "," . $reportUrl . "," . $parseKey;
$dataString = $loadUrl . "," . $reportUrl . "," . $parseKey;

// Step 2: Encode the string to Base64
$base64EncodedString = base64_encode($dataString);

// Step 3: Generate the QR code from the Base64 encoded string
$result = Builder::create()
    ->writer(new PngWriter())
    ->data($base64EncodedString)
    ->encoding(new Encoding('UTF-8'))
    ->size(300)  // Set QR code size (in pixels)
    ->margin(10) // Set QR code margin (in pixels)
    ->backgroundColor(new Color(255, 255, 255))
    ->foregroundColor(new Color(0, 0, 0))
    ->build();

// Step 4: Convert QR code image to Base64
$qrCodeDataUri = $result->getDataUri();

?>
          
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Display</title>
</head>
<body>
    <h1>Your QR Code</h1>
    <img src="<?php echo $qrCodeDataUri; ?>" alt="QR Code">
</body>
</html>
