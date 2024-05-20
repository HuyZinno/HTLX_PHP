<?php
session_start();
require_once '../controllers/BillController.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['Phone'])) {
    header("Location: login.php");
    exit();
}

// Lấy số điện thoại từ session
$Phone = $_SESSION['Phone'];

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'htlx');
if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Xử lý đặt vé
if (isset($_GET['maPhim']) && isset($_GET['gioChieu']) && isset($_GET['selectedSeats'])) {
    $maPhim = $_GET['maPhim'];
    $gioChieu = $_GET['gioChieu'];
    $selectedSeats = explode(',', $_GET['selectedSeats']);

    $controller = new BillController($conn);
    $result = $controller->processBooking($maPhim, $gioChieu, $selectedSeats, $Phone);
    echo $result;
} else {
    echo "Lỗi: Thông tin không hợp lệ. Vui lòng kiểm tra lại hoặc liên hệ hỗ trợ.";
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Hiện Tại</title>
    <style>
        .change-password-btn {
            font-family: "Exo", sans-serif;
            font-size: large;
            font-weight: bold;
            background-color: aqua;
            text-align: center;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            color: #000;
            display: inline-block;
        }

        .change-password-btn:hover {
            background-color: #00bcd4;
        }
    </style>
</head>
<body>
     <br>
     <div>
        <h2>Thanh toán thành công!</h2>
        <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p>
        <!-- Hiển thị thông tin vé đã đặt -->
        <p>Thông tin vé:</p>
        <ul>
            <li>Mã phim: <?php echo $_GET['maPhim']; ?></li>
            <li>Giờ chiếu: <?php echo $_GET['gioChieu']; ?></li>
            <li>Ghế đã chọn: <?php echo $_GET['selectedSeats']; ?></li>
        </ul>
        <!-- Cung cấp nút hoặc liên kết để quay lại trang chính -->
        <button onclick="goBackToPhimDangChieu()">Quay lại</button>
    </div>

    <script>
        // Hàm quay lại trang phim đang chiếu
        function goBackToPhimDangChieu() {
            window.location.href = "home.php";
        }
    </script>

</body>
</html>
