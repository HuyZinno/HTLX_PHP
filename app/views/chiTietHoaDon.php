<?php
// Khởi tạo phiên làm việc
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['Phone'])) {
    // Nếu chưa, chuyển hướng về trang đăng nhập
    header("Location: login.php");
    exit(); // Dừng việc thực hiện mã PHP tiếp theo
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết vé phim</title>
    <style>
        /* CSS cho định dạng hóa đơn */
        body {
            font-family: "Exo", sans-serif;
            font-weight: bold;    
            margin: 0;
            padding: 0;
            background-image: url('../asset/images/avt.jpg');
            background-size: cover; /* Đảm bảo hình ảnh nền bao phủ toàn bộ kích thước của body */
            background-repeat: no-repeat; /* Ngăn lặp lại hình ảnh nền */
        }

        .container {
            color: white;
            background-image: url('../asset/images/nen2.jpg');
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .movie-info {
            color: white;
            display: flex;
            flex-direction: column; /* Xếp theo chiều dọc */
            align-items: center;
            margin-bottom: 20px;
        }

        #imgPhim {
            width: 500px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .movie-details {
            margin-top: 20px; /* Khoảng cách giữa hình ảnh và thông tin phim */
        }

        .movie-title {
            color: white;
            margin: 0;
            font-size: 30px;
            text-align: center;
        }

        .showtime {
            margin: 5px 0;
            font-size: 30px;
            color: white;
            text-align: center;
        }

        .selected-seats {
            text-align: center;
        }

        .selected-seats-title {
            color: white;
            margin: 0;
            font-size: 30px;
            text-align: center;
        }

        .seat-list {
            list-style-type: none;
            padding: 0;
        }

        .seat {
            display: inline-block;
            margin: 5px;
            padding: 5px 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            color: #333;
            font-size: 16px;
        }

        .total-price {
            margin-top: 20px;
            font-size: 24px;
            color: white;
            text-align: center;
        }

        .btn-payment {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px; /* Khoảng cách từ nút button đến phần trên */
        }

        .btn-back {
            margin-left: 10px;
            background-color: #dc3545; /* Màu nền */
            color: white; /* Màu chữ */
            border: none; /* Bỏ viền */
            padding: 10px 20px; /* Đặt padding */
            border-radius: 5px; /* Đặt góc bo tròn */
            font-size: 16px; /* Đặt kích thước chữ */
            cursor: pointer; /* Đổi con trỏ chuột */
            margin-top: 10px; /* Khoảng cách từ nút button đến phần trên */
        }

        .btn-payment:hover, .btn-back:hover {
            opacity: 0.8; /* Đặt độ mờ khi di chuột vào */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>CHI TIẾT VÉ PHIM</h1>
        </div>
        <div class="content">
            <?php
            // Kết nối đến cơ sở dữ liệu
            $conn = mysqli_connect('localhost', 'root', '', 'htlx');
            if (!$conn) {
                die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
            }

            // Lấy mã hóa đơn từ URL
            $maBill = $_GET['maBill'];

            // Truy vấn để lấy thông tin từ bảng bill và movie
            $query = "SELECT m.hinhAnh, m.tenPhim, t.gioChieu, GROUP_CONCAT(g.tenGhe SEPARATOR ', ') AS tenGhe
                      FROM bill b
                      INNER JOIN movie m ON b.maPhim = m.maPhim
                      INNER JOIN thoigian t ON b.magiochieu = t.maGioChieu
                      INNER JOIN ghe g ON b.maBill = g.maBill
                      WHERE b.maBill = '$maBill'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $hinhAnh = $row['hinhAnh'];
                $tenPhim = $row['tenPhim'];
                $gioChieu = $row['gioChieu'];
                $tenGhe = $row['tenGhe'];

                // Hiển thị thông tin hóa đơn
                echo "<div class='movie-info'>";
                echo "<img id='imgPhim' src='../asset/images/$hinhAnh' />";
                echo "<div class='movie-details'>";
                echo "<h2 class='movie-title'>$tenPhim</h2>";
                echo "<p class='showtime'>Giờ Chiếu: $gioChieu</p>";
                echo "</div></div>";
                echo "<div class='selected-seats'>";
                echo "<h3 class='selected-seats-title'>Ghế Đã Chọn:</h3>";
                echo "<ul class='seat-list'>";
                echo "<li class='seat'>$tenGhe</li>";
                echo "</ul></div>";

                // Hiển thị nút quay lại
                echo "<div style='text-align: center;'>";
                echo "<button class='btn-back' onclick='goBack()'>Quay lại</button>";
                echo "</div>";
            } else {
                echo "Lỗi: Không tìm thấy thông tin hóa đơn. Vui lòng kiểm tra lại hoặc liên hệ hỗ trợ.";
            }

            // Đóng kết nối cơ sở dữ liệu
            mysqli_close($conn);
            ?>

            <script>
                // Hàm quay lại trang trước đó
                function goBack() {
                    window.history.back();
                }
            </script>
        </div>
    </div>
</body>
</html>
