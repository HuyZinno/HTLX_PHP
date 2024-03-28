<?php
// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'htlx');
if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Lấy số ghế từ yêu cầu GET
if (isset($_GET['seat'])) {
    $seat = $_GET['seat'];

    // Truy vấn để kiểm tra trạng thái của ghế
    $query = "SELECT trangThai FROM ghe WHERE tenghe = '$seat'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $seatStatus = $row['trangThai'];

        // Trả về trạng thái của ghế
        echo $seatStatus;
    } else {
        // Nếu không tìm thấy ghế, trả về trạng thái mặc định là "Trống"
        echo "Trống";
    }
} else {
    // Nếu không có dữ liệu được gửi, trả về trạng thái mặc định là "Trống"
    echo "Trống";
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>
