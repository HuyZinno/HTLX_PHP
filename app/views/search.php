<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm cho <?php echo isset($_POST['search_text']) ? $_POST['search_text'] : ''; ?></title>
    <link rel="stylesheet" href="content/site.css">
    <style>
        body {
            font-family: "Exo", sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-image: url('../asset/images/background.jpg'); /* Đường dẫn tới hình ảnh nền */
            background-size: auto;
            background-position: center;
            background-repeat: no-repeat;
        }

        h2 {
            margin-bottom: 20px;
            color: white; /* Thiết lập màu chữ trắng */
            text-align: center; /* Căn giữa nội dung */
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
        }

        .movie-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            display: flex;
            overflow: hidden;
        }

        .movie-container {
            width: 80%;
            margin: 20px auto;
        }

        img {
            border-radius: 5px;
            max-width: 400px; /* Đảm bảo rằng chiều rộng của hình ảnh không vượt quá kích thước của phần tử chứa */
            max-height: 400px; /* Đảm bảo rằng chiều cao của hình ảnh không vượt quá kích thước của phần tử chứa */
            width: auto;
            height: auto;
            margin-right: 20px;
        }

        .movie-info {
            flex-grow: 1;
            padding: 20px;
        }

        h3 {
            margin-top: 10px;
        }

        p {
            margin: 5px 0;
        }


        .custom-button {
            /* CSS tùy chỉnh cho nút */
            background-color: #007bff;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 1cm; /* Hạ thấp nút xuống 1cm */
        }

        .custom-button:hover {
            /* Hiệu ứng khi di chuột vào */
            background-color: #0056b3;
        }
    </style>
</head>
<?php include 'menu.php'; ?>
<body>
    <h2><center>Kết quả tìm kiếm cho <?php echo isset($_POST['search_text']) ? $_POST['search_text'] : 'Không có từ khóa'; ?></center></h2>
    <div class="movie-container">
        <?php
            $conn = new mysqli('localhost', 'root', '', 'htlx');
            
            if ($conn->connect_error) {
                die("Kết nối đến CSDL thất bại: " . $conn->connect_error);
            }
            
            // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
            if(isset($_POST['search_text']) && !empty($_POST['search_text'])) {
                $search_text = $_POST['search_text'];
                // Sử dụng tham số truy vấn để tránh lỗi SQL injection
                $sql = "SELECT maPhim, tenPhim, daoDien, dienVien, thoiLuong, hinhAnh, theLoai FROM movie WHERE tenPhim LIKE '%$search_text%'";
            } else {
                $sql = "SELECT maPhim, tenPhim, daoDien, dienVien, thoiLuong, hinhAnh, theLoai FROM movie";
            }
            
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='movie-item'>";
                    echo "<img src='../asset/images/" . $row["hinhAnh"] . "' />";
                    echo "<div class='movie-info'>";
                    echo "<h3>" . $row["tenPhim"] . "</h3>";
                    echo "<p><strong>Đạo diễn:</strong> " . $row["daoDien"] . "</p>";
                    echo "<p><strong>Diễn viên:</strong> " . $row["dienVien"] . "</p>";
                    echo "<p><strong>Thể loại:</strong> " . $row["theLoai"] . "</p>";
                    echo "<p><strong>Thời lượng:</strong> " . $row["thoiLuong"] . " phút</p>";
                    echo "<div style='text-align: right; margin-top: 20px;'>";
                    echo "<input type='button' value='Chi tiết' class='custom-button' onclick='BookFilm(" . $row["maPhim"] . ")' />";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<script>alert('Không tìm thấy phim!'); window.location.href = 'home.php';</script>";
            }
            $conn->close();
        ?>
    </div>

    <script type="text/javascript">
        function BookFilm(maPhim) {
            window.location.href = "chiTietPhim.php?maPhim=" + maPhim;
        }
    </script>
</body>
</html>
