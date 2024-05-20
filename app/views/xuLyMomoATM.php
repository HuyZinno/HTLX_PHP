<?php
session_start();
// Kiểm tra đăng nhập
if (!isset($_SESSION['Phone'])) {
    header("Location: login.php");
    exit();
}
else
{
    $Phone = $_SESSION['Phone'];
}
header('Content-type: text/html; charset=utf-8');

function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    // execute post
    $result = curl_exec($ch);
    // close connection
    curl_close($ch);
    return $result;
}

$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán qua MoMo ATM";
$tongTien = $_POST['tongTien']; // Đảm bảo rằng giá trị này được truyền dưới dạng POST
$orderId = time() . "";
$Phone = $_GET['Phone'];
$maPhim = $_POST['maPhim'];
$gioChieu = $_POST['gioChieu'];
$selectedSeats = $_POST['selectedSeats'];

$redirectUrl = "http://localhost/HTLX/app/views/bill.php?maPhim=$maPhim&gioChieu=$gioChieu&selectedSeats=$selectedSeats&Phone=$Phone";

$ipnUrl = $redirectUrl;
$extraData = "";

$requestId = time() . "";
$requestType = "payWithATM";
$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
// before sign HMAC SHA256 signature
$rawHash = "accessKey=" . $accessKey . "&amount=" . $tongTien . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);
$data = array('partnerCode' => $partnerCode,
    'partnerName' => "Test",
    "storeId" => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $tongTien,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature);
$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);  // decode json

// Just an example, please check more in there

header('Location: ' . $jsonResult['payUrl']);
?>
