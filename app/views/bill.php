<?php
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['Phone'])) {
    header("Location: login.php");
    exit();
}

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'htlx');
if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Kiểm tra các tham số từ URL
if (isset($_GET['maPhim']) && isset($_GET['gioChieu']) && isset($_GET['selectedSeats'])) {
    $maPhim = $_GET['maPhim'];
    $gioChieu = $_GET['gioChieu'];
    $selectedSeats = explode(',', $_GET['selectedSeats']);

    // Truy vấn để lấy thông tin giờ chiếu từ bảng thoigian
    $query = "SELECT magiochieu FROM thoigian WHERE maPhim = '$maPhim' AND gioChieu = '$gioChieu'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $magiochieu = $row['magiochieu'];
        $Phone = $_SESSION['Phone'];

        // Tính tổng tiền
        $tongtien = count($selectedSeats) * 50000; // Giả sử giá vé là 50,000 VND

        // Tạo hóa đơn
        $insert_bill_query = "INSERT INTO bill (Phone, maPhim, magiochieu, tongtien) VALUES ('$Phone', '$maPhim', '$magiochieu', '$tongtien')";
        if (mysqli_query($conn, $insert_bill_query)) {
            $maBill = mysqli_insert_id($conn);

            // Thêm dữ liệu ghế vào bảng ghe với maBill
            foreach ($selectedSeats as $seat) {
                $insert_ghe_query = "INSERT INTO ghe (tenGhe, trangThai, maBill) VALUES ('$seat', 'Đã đặt', '$maBill')";
                if (mysqli_query($conn, $insert_ghe_query)) {
                    echo "Ghế $seat đã được đặt thành công!<br>";
                } else {
                    echo "Lỗi khi đặt ghế $seat: " . mysqli_error($conn) . "<br>";
                }
            }
        } else {
            echo "Lỗi khi tạo hóa đơn: " . mysqli_error($conn);
        }
    } else {
        echo "Lỗi: Không tìm thấy thông tin giờ chiếu. Vui lòng kiểm tra lại hoặc liên hệ hỗ trợ.";
    }
} else {
    echo "Lỗi: Thông tin không hợp lệ. Vui lòng kiểm tra lại hoặc liên hệ hỗ trợ.";
}

mysqli_close($conn);
?>
