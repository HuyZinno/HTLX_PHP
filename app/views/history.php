<?php
include_once '../config/Database.php';
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
    <title>Lịch sử đặt vé</title>
    <link rel="stylesheet" href="content/site.css">
    <style>
        body {
            text-align: center;
            font-family: "Exo", sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            /* background-image: url('../asset/images/background.jpg');  */
            background-size: auto;
            background-position: center;
            background-repeat: no-repeat;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            text-align: center;
            font-weight: bold;
            font-size: large;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            text-align: center;
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .custom-button {
            /* CSS tùy chỉnh cho nút */
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .custom-button:hover {
            /* Hiệu ứng khi di chuột vào */
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'menu.php'; ?>

<div class="container">
    <h1>Lịch sử đặt vé</h1>
    <table>
        <thead>
            <tr>
                <th>Mã hóa đơn</th>
                <th>Tên phim</th>
                <th>Ghế đã chọn</th>
                <th>Giờ chiếu</th>
                <th>Tổng tiền</th>
                <th>Thời gian xác nhận</th>
                <th>Chi tiết vé</th>
                <th>Xuất vé</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Kết nối đến cơ sở dữ liệu
            $database = new Database();
            $conn = $database->getConnection();

            // Truy vấn SQL
            // Truy vấn SQL
            $query = "SELECT b.maBill, m.tenPhim, t.gioChieu, b.tongtien, b.thoiGianXacNhan, GROUP_CONCAT(g.tenGhe SEPARATOR ', ') AS tenGhe
            FROM bill b
            INNER JOIN movie m ON b.maPhim = m.maPhim
            INNER JOIN thoigian t ON b.magiochieu = t.maGioChieu
            INNER JOIN ghe g ON b.maBill = g.maBill
            WHERE b.Phone = '{$_SESSION['Phone']}' 
            GROUP BY b.maBill";
            $result = mysqli_query($conn, $query);

            // Kiểm tra và hiển thị kết quả
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['maBill'] . "</td>";
                    echo "<td>" . $row['tenPhim'] . "</td>";
                    echo "<td>" . $row['tenGhe'] . "</td>";
                    echo "<td>" . $row['gioChieu'] . "</td>";
                    echo "<td>" . $row['tongtien'] . "</td>";
                    echo "<td>" . $row['thoiGianXacNhan'] . "</td>";
                    echo "<td><button class='custom-button' onclick='showDetail(" . $row['maBill'] . ")'>Chi tiết</button></td>";
                    echo "<td><button class='custom-button' onclick='printInvoice(" . $row['maBill'] . ")'>In</button></td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

<script>
    function showDetail(maBill) {
        // Hàm xử lý khi người dùng nhấn vào nút "Chi tiết"
        window.location.href = "chiTietHoaDon.php?maBill=" + maBill;
    }

    function printInvoice(maBill) {
        // Hàm xử lý khi người dùng nhấn vào nút "In"
        alert("In hóa đơn với mã hóa đơn: " + maBill);
    }
</script>

</body>
</html>
