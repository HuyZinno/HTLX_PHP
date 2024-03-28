<?php
session_start();
// Đăng xuất
if (isset($_GET['logout'])) {
    // Xóa tất cả các biến session
    $_SESSION = array();

    // Hủy bỏ session
    session_destroy();

    // Chuyển hướng người dùng đến trang đăng nhập
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Bán Vé Phim</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../asset/images/background.jpg'); /* Đường dẫn tới hình ảnh nền */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
        }

        nav {
            background-color: #444;
            padding: 1em;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 1em;
            margin: 0 1em;
        }

        nav form {
             display: block; /* Thay đổi từ inline-block thành block */
             position: absolute;
             bottom: 0;
             left: 0;
             margin-right: 1em;
        }


        nav input[type="text"] {
            padding: 0.5em;
            width: 150px;
            left: 0;
        }

        nav button {
            padding: 0.5em;
            background-color: #555;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        section {
            padding: 2em;
            text-align: center;
        }

        section h2 {
            text-align: center;
        }

        section img {
            max-width: 120%;
            max-height: 450px;
            margin-top: 1em;
            transition: opacity 1s ease-in-out;
        }

        /* Thêm CSS cho nút điều hướng */
        #prevBtn,
        #nextBtn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            background-color: transparent;
            border: none;
            color: white;
            cursor: pointer;
            outline: none;
        }

        #prevBtn {
            left: 10px;
        }

        #nextBtn {
            right: 10px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            left: 0px;
            height: 2px;
        }
        #nextBtn {
            right: 10px;
        }
        .auto-style1 {
            left: -20px;
            bottom: 1px;
            height: 34px;
        }
        input#txtSearch {
            float: left;
            padding: 8px; /* Đệm bên trong ô nhập liệu */
            font-size: 16px; /* Kích thước chữ */
            border: 1px solid #ccc; /* Viền */
            border-radius: 4px; /* Đường cong viền */
            width: 200px; /* Chiều rộng của ô nhập liệu */
            box-sizing: border-box; 

        }

        input#btnSearch {
            padding: 10px 20px; /* Kích thước đệm cho nút */
            font-size: 16px; /* Kích thước chữ */
            background-color: #3498db; /* Màu nền */
            color: #fff; /* Màu chữ */
            border: none; /* Bỏ viền */
            border-radius: 5px; /* Đường cong viền */
            cursor: pointer; /* Con trỏ chuột khi di chuột qua */
            text-align: center; /* Căn giữa nội dung */
            text-decoration: none; /* Bỏ gạch chân */
            display: inline-block; /* Hiển thị như block nhưng không chiếm toàn bộ chiều ngang */
            float: left; /* Đẩy nút tìm kiếm về phía trái */
        }
        .button {
            height: 36px;
            margin-right: 10px; /* Khoảng cách giữa các nút */
            padding: 10px 20px; /* Kích thước đệm cho nút */
            font-size: 16px; /* Kích thước chữ */
            background-color: #3498db; /* Màu nền */
            color: #fff; /* Màu chữ */
            border: none; /* Bỏ viền */
            border-radius: 5px; /* Đường cong viền */
            cursor: pointer; /* Con trỏ chuột khi di chuột qua */
            text-align: center; /* Căn giữa nội dung */
            text-decoration: none; /* Bỏ gạch chân */
            display: inline-block; /* Hiển thị như block nhưng không chiếm toàn bộ chiều ngang */
            float: right;
        }
        img {
            width: 850px; /* Đặt chiều rộng mong muốn */
            height: auto; /* Chiều cao tự động điều chỉnh để duy trì tỷ lệ khung hình */
            display: block; /* Hiển thị phần tử img như một khối để điều chỉnh khoảng cách xung quanh */
            margin: 0 auto; /* Căn giữa hình ảnh theo chiều ngang */
        }

/* Hover effect */
.button:hover {
    background-color: purple; /* Màu nền khi di chuột qua */
}


        .auto-style2 {
            height: 55px;
        }
        nav a {
            text-decoration: none; /* Bỏ gạch chân cho liên kết */
            transition: transform 0.3s ease; /* Hiệu ứng chuyển đổi khi hover */
            display: inline-block; /* Cho phép chúng ta xử lý phần nội dung bên trong */
        }

        nav a span {
            display: inline-block; /* Để phần nội dung (chữ) thành phần inline-block */
            padding: 8px 12px; /* Tạo đệm xung quanh phần nội dung */
        }

        nav a:hover span {
            transform: scale(1.1); /* Hiệu ứng phóng to khi di chuột qua */
        }

        nav a:active span {
            transform: scale(0.9); /* Hiệu ứng thu nhỏ khi liên kết được chọn */
        }

        .image-container {
            position: relative;
            overflow: hidden;
        }

        .image-container img {
            max-width: 100%;
            transition: transform 0.5s ease-in-out;
        }

        #prevBtn,
        #nextBtn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 80px;
            background-color: transparent;
            border: none;
            color: white;
            cursor: pointer;
            outline: none;
        }

        #prevBtn {
            left: 300px;
        }

        #nextBtn {
            right: 300px;
        }


        .auto-style3 {
            height: 31px;
        }


    </style>
</head>

<body>
<header>
        <div style="position: absolute; top: 28px; right: 200px; color: white; font-size:large">
            <?php

            if(isset($_SESSION["Phone"])) { ?>
                <a href="profile.php">
                    <span style="float: left; color: #FFFFFF;">Xin chào, <?php echo $_SESSION["Phone"]; ?></span>
                </a>
            <?php } ?>
        </div>
        <form id="form1" method="post" action="search.php" class="auto-style2">
            <input type="text" id="txtSearch" name="search_text" placeholder="Nhập tên phim...">
            <input type="submit" id="btnSearch" value="Tìm kiếm" class="button">
            <?php   
            // Kiểm tra session Phone đã tồn tại hay không
            if(isset($_SESSION["Phone"])) { 
            ?>
                <a href="?logout" class="button" style="height: 22px;">Đăng Xuất</a>
            <?php 
            } else { 
            ?>
                <a href="login.php" class="button" style="height: 22px;">Đăng nhập</a>
                <a href="registration.php" class="button" style="height: 22px;">Đăng ký</a>
            <?php 
            } 
            ?>
        </form>
    </header>
    <?php include 'menu.php'; ?>
    <section id="slideshow">
        <div class="image-container">
        <img id="slideImg" src="HTLX/app/asset/images/nbn.jpg" alt="Default Image">
            <button id="prevBtn" onclick="changeImage(-1)">❮</button>
            <button id="nextBtn" onclick="changeImage(1)">❯</button>
        </div>
    </section>
    <br /><br /><br />
    <?php include 'footer.php'; ?>
    <script>
    // JavaScript code here
    var images = [
        <?php
            // Kết nối đến CSDL
            $conn = new mysqli('localhost', 'root', '', 'htlx');
            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối đến CSDL thất bại: " . $conn->connect_error);
            }
            // Truy vấn SQL để lấy các hình ảnh từ bảng movie
            $sql = "SELECT hinhAnh FROM movie";
            $result = $conn->query($sql);
            // Kiểm tra và hiển thị kết quả
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "'../asset/images/" . $row["hinhAnh"] . "',";
                }
            } else {
                echo "'../asset/images/default.jpg'"; // Nếu không có hình ảnh, hiển thị hình ảnh mặc định
            }
            $conn->close();
        ?>
    ]; // List of image filenames
    var currentImageIndex = 0;
    var slideImg = document.getElementById("slideImg");

    function changeImage(direction) {
        currentImageIndex = (currentImageIndex + direction + images.length) % images.length;
        slideImg.src = images[currentImageIndex];
    }
    function autoChangeImage() {
        changeImage(1);
        setTimeout(autoChangeImage, 2000);
    }
    autoChangeImage();
</script>
   
</body>
</html>
</html>
