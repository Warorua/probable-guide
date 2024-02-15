<?php
include './includes/conn.php';
include './includes/core2.php';

function formatPhoneNumber($number)
{
    // Remove any non-numeric characters that might be present
    $number = preg_replace('/\D/', '', $number);

    // Check the first one or two characters to determine the formatting rule
    if (strpos($number, '0') === 0) {
        // If the number starts with '0', remove the '0'
        $number = substr($number, 1);
    } elseif (strpos($number, '01') === 0) {
        // If the number starts with '01', remove the '01'
        $number = substr($number, 2);
        // Ensure the number starts with '1' after removing '01'
        $number = '1' . $number;
    }

    if (strlen($number) != 12) {
        // Prepend '254' to the number
        $formattedNumber = '254' . $number;
    } elseif (strlen($number) >= 12) {
        $formattedNumber =  $number;
    } else {
        $formattedNumber = '254' . $number;
    }



    return $formattedNumber;
}

function urlShortener($url)
{

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://url-shortener42.p.rapidapi.com/shorten/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'url' => $url,
            'validity_duration' => 1
        ]),
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: url-shortener42.p.rapidapi.com",
            "X-RapidAPI-Key: 6c54f8cbdbmsh026aa3e5aecec5dp1a306fjsn99e3c76d8d56",
            "content-type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        //return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}

if (isset($_POST['phone_number'])) {
    if ($_POST['phone_number'] != "") {
        $phone = formatPhoneNumber($_POST['phone_number']);
        $queryId = generateRandomString(12);

        $stmt = $conn->prepare("INSERT INTO phoneVerif (request_id) VALUES (:request_id)");
        $stmt->execute(['request_id' => $queryId]);

        $guard = 'https://sbnke.com/verif/msisdnVerif?queryId=' . $queryId . '&msisdn=' . $phone;
        //echo $guard . '<br/>';
        $shortUrl = json_decode(urlShortener($guard), true);
        if (isset($shortUrl['url'])) {
            $guardUrl = $shortUrl['url'];
        } else {
            $guardUrl = 'ERR';
        }

        $message = urlencode('Please open this link to verify: ' . $guardUrl);

        $url = 'https://sms.movesms.co.ke/api/compose?username=Warorua&api_key=xuRR0BocoCM5Egxxqbxf2mrLUPbW7YicL4NXJExFNcBdtZHSkn&sender=SMARTLINK&to=' . $phone . '&message=' . $message . '&msgtype=5&dlr=1';
        //echo ($url);
        $sms = httpGet($url, []);
        //echo $url;
        //echo $sms;


        $output = [];
        $output['queryId'] = $queryId;
        $output['msisdn'] = $phone;
        $output['smsRes'] = $sms;
        $output['guardUrl'] = $guard;

        echo json_encode($output);
    }
}
