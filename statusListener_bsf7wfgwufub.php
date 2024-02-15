<?php
include './includes/conn.php';
include './includes/core2.php';
$output = [];
if (isset($_POST['queryId'])) {
    $queryId = $_POST['queryId'];
    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM phoneVerif WHERE request_id=:request_id");
    $stmt->execute(['request_id' => $queryId]);
    $stts = $stmt->fetch();
    if ($stts['numrows'] < 1) {
        $output['error'] = "Invalid Query ID";
        $output['status'] = 'error';
    } else {
        $stmt = $conn->prepare("SELECT * FROM phoneVerif WHERE request_id=:request_id");
        $stmt->execute(['request_id' => $queryId]);
        $stwa = $stmt->fetch();
        if ($stwa['part1'] != '') {
            $output['part1'] = base64_decode($stwa['part1']);
            $output['part2'] = base64_decode($stwa['part2']);
            $output['status'] = 'success';
        } else {
            $output['status'] = 'waiting';
        }
    }
}else{
    $output['error'] = "Request Error";
    $output['status'] = 'error';
}

echo json_encode($output);