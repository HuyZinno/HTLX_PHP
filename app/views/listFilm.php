<?php
include_once '../controllers/MovieController.php';
include_once '../config/Database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách phim</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            background-image: url('../asset/images/nen2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            color: #fff;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 90%;
            max-width: 100%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        img {
            width: 250px;
            height: 150px;
            
        }

        /* Các nút */
        .custom-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 85px; /* Độ rộng của mỗi nút (chiếm 1/3 phần tử cha) và trừ đi khoảng cách giữa chúng */
            margin-right: 10px; /* Khoảng cách giữa các nút */
            padding: 10px; /* Khoảng cách nội dung từ viền của nút */
            margin-top: 10px; /* Khoảng cách phía trên giữa các nút */
            margin-bottom: 10px;
        }


        .custom-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'menuAd.php'; ?>
<h1>Danh sách phim</h1>
<table border="1">
    <tr>
        <th>Mã Phim</th>
        <th>Tên Phim</th>
        <th>Thể Loại</th>
        <th>Đạo Diễn</th>
        <th>Diễn Viên</th>
        <th>Thời Lượng</th>
        <!-- <th>Mô Tả</th> -->
        <th>Hình Ảnh</th>
        <th>Hành động</th>
    </tr>
    <?php
    foreach ($movies as $movie) {
        echo "<tr>";
        echo "<td>" . $movie['maPhim'] . "</td>";
        echo "<td>" . $movie['tenPhim'] . "</td>";
        echo "<td>" . $movie['theLoai'] . "</td>";
        echo "<td>" . $movie['daoDien'] . "</td>";
        echo "<td>" . $movie['dienVien'] . "</td>";
        echo "<td>" . $movie['thoiLuong'] . "</td>";
        echo "<td><img src='../asset/images/" . $movie['hinhAnh'] . "' width='250' height='150'></td>";
        echo "<td>";
        echo "<form method='post' action='XoaPhim.php'>";
        echo "<input type='hidden' name='maPhim' value='" . $movie['maPhim'] . "'>";
        echo "<button type='submit' class='custom-button' style='background-color: red;' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")'>Xóa</button>";
        echo "</form>";
        // Thêm nút "Đổi giờ"
        echo "<form method='get' action='DoiGioChieu.php'>";
        echo "<input type='hidden' name='maPhim' value='" . $movie['maPhim'] . "'>";
        echo "<button type='submit' class='custom-button' style='background-color: #009973;'>Đổi giờ</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    
    ?>
</table>
<br><br><br>
</body>

</html>
