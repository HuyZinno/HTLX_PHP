<?php
// Khởi tạo phiên làm việc
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['Phone'])) {
    // Nếu chưa, chuyển hướng về trang đăng nhập
    header("Location: login.php");
    exit(); // Dừng việc thực hiện mã PHP tiếp theo
}

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'htlx');
if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Kiểm tra xem các tham số được truyền từ URL hay không
if (isset($_GET['maPhim']) && isset($_GET['gioChieu']) && isset($_GET['selectedSeats'])) {
    $maPhim = $_GET['maPhim'];
    $gioChieu = $_GET['gioChieu'];
    $selectedSeats = explode(',', $_GET['selectedSeats']);

    // Truy vấn để lấy thông tin giờ chiếu từ bảng thoigian
    $query = "SELECT magiochieu FROM thoigian WHERE maPhim = '$maPhim' AND gioChieu = '$gioChieu'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Kiểm tra xem thông tin giờ chiếu có tồn tại hay không
    if ($row) {
        $magiochieu = $row['magiochieu'];

        // Lấy số điện thoại từ session
        $Phone = $_SESSION['Phone'];

        // Tạo hóa đơn cho mỗi ghế đã chọn
        foreach ($selectedSeats as $seat) {
            // Tính tổng tiền cho mỗi ghế (giả sử giá vé là 50.000 đồng)
            $tongtien = 50000;

            // Insert dữ liệu vào bảng bill
            $insert_query = "INSERT INTO bill (Phone, maphim, tenghe, magiochieu, tongtien) 
                            VALUES ('$Phone', '$maPhim', '$seat', '$magiochieu', '$tongtien')";
            if (mysqli_query($conn, $insert_query)) {
                echo "Hóa đơn cho ghế $seat đã được lưu thành công!<br>";
            } else {
                echo "Lỗi khi lưu hóa đơn cho ghế $seat: " . mysqli_error($conn) . "<br>";
            }
        }
    } else {
        echo "Lỗi: Không tìm thấy thông tin giờ chiếu. Vui lòng kiểm tra lại hoặc liên hệ hỗ trợ.";
    }
} else {
    echo "Lỗi: Thông tin không hợp lệ. Vui lòng kiểm tra lại hoặc liên hệ hỗ trợ.";
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>
