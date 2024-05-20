<?php
include_once '../controllers/MovieController.php';
include_once '../config/Database.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Thêm phim</title>
    <style>
        body {
            font-family: "Exo", sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../asset/images/background.jpg'); /* Đường dẫn tới hình ảnh nền */
            background-position: center;
            background-repeat: no-repeat;
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

        section img {
            max-width: 120%;
            max-height: 450px;
            margin-top: 1em;
            transition: opacity 1s ease-in-out;
        }
           
        .button {     
            margin-right: 10px; /* Khoảng cách giữa các nút */
            padding: 15px 20px; /* Kích thước đệm cho nút */
            font-size: 16px; /* Kích thước chữ */
            background-color: #3498db; /* Màu nền */
            color: #fff; /* Màu chữ */
            border: none; /* Bỏ viền */
            border-radius: 5px; /* Đường cong viền */
            cursor: pointer; /* Con trỏ chuột khi di chuột qua */
            text-align: center; /* Căn giữa nội dung */
            text-decoration: none; /* Bỏ gạch chân */
            display: inline-block; /* Hiển thị như block nhưng không chiếm toàn bộ chiều ngang */
           margin-top: 2.1cm;
        }

        /* Hover effect */
        .button:hover {
            background-color: purple; /* Màu nền khi di chuột qua */
        }
        .auto-style2 {
            height: 55px;
        }
        .image-container {
            position: relative;
            overflow: hidden;
        }
        .image-container img {
            max-width: 100%;
            transition: transform 0.5s ease-in-out;
        }
        /* Thiết lập kiểu cho khung */
        .container {
            text-align:center;
            font-size: larger;
            width: 50%; /* Đặt chiều rộng của khung */
            margin: auto; /* Căn giữa khung */
            border: 1px solid #ccc; /* Đường viền của khung */
            padding: 20px; /* Khoảng cách bên trong khung */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng cho khung */
        }
        /* Thiết lập kiểu cho các hàng */
        .row {
            display: flex; /* Sử dụng Flexbox để căn chỉnh các cột */
            flex-direction: column; /* Xếp cột theo chiều dọc */
            margin-bottom: 15px;
                height: 85px;
            }
        /* Thiết lập kiểu cho các nhãn */
        label {
            font-size:larger;
            margin-bottom: 5px; /* Khoảng cách giữa các nhãn và input */
        }
        /* Thiết lập kiểu cho các input và textarea */
        input, textarea {
            margin-right: 50px;
            font-weight: bold;
            font-family: "Exo", sans-serif;
            font-size: large;
            text-align:center;
            width: 100%; /* Đặt chiều rộng của input và textarea là 100% */
            padding: 8px; /* Khoảng cách bên trong input và textarea */
            margin-bottom: 10px; /* Khoảng cách giữa các input và textarea */
        }
        .center-wrapper {
        text-align: center;
        }
        .contact-button {
        float: right; /* Đưa div về phải */
        margin-right: 10px; /* Khoảng cách từ phải cùng của thanh menu */
        display: flex; /* Sử dụng Flexbox để căn chỉnh các phần tử bên trong div */
        align-items: center; /* Căn giữa theo chiều dọc */
    }
    .contact-button a {
        text-decoration: none;
        transition: transform 0.3s ease;
        display: inline-block;
        margin-right: 10px;
    }
    .contact-button a span {
        display: inline-block;
        padding: 8px 12px;
    }
    .contact-button a:hover span {
        transform: scale(1.1);
    }
    .contact-button a:active span {
        transform: scale(0.9);
    }
    .button:hover {
            background-color: purple;
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
    </style>
</head>
<body>
    <?php include 'menuAd.php'; ?>
    <div class="container" style="background-image: url('../asset/images/nen2.jpg'); background-repeat: no-repeat">
    <form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" runat="server" style="font-family: 'SVN-Agency FB'; font-weight: bold; font-size: large; " class="auto-style1">
    <h2 style="font-family: 'SVN-New Athletic M54'; font-weight: normal;">Thêm Phim Mới</h2>
    <label for="maphim">Mã Phim:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="txtmaPhim" name="txtmaPhim" class="center-textbox" style="width: 380px; padding: 5px; border-radius: 5px;"></label><br/>
    <label for="tenphim">Tên Phim:&nbsp;&nbsp;<input type="text" id="txtTenPhim" name="txtTenPhim" class="center-textbox" style="width: 380px; padding: 5px; border-radius: 5px;"></label><br/>
    <label for="theLoai">Thể loại:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="txtTheLoai" name="txtTheLoai" class="center-textbox" style="width: 380px; padding: 5px; border-radius: 5px;"></label><br/>
    <label for="daodien">Đạo Diễn:&nbsp;&nbsp;&nbsp;<input type="text" id="txtDaoDien" name="txtDaoDien" class="center-textbox" style="width: 380px; padding: 5px; border-radius: 5px;"></label><br/>
    <label for="dienvien">Diễn Viên:&nbsp;&nbsp;<input type="text" id="txtDienVien" name="txtDienVien" class="center-textbox" style="width: 380px; padding: 5px; border-radius: 5px;"></label><br/>
    <label for="thoiluong">Thời lượng:<input type="text" id="txtThoiLuong" name="txtThoiLuong" class="center-textbox" style="width: 380px; padding: 5px; border-radius: 5px;"></label><br/>
    <label for="mota">Tóm tắt nội dung phim:<textarea id="txtMoTa" name="txtMoTa" class="center-textbox"></textarea></label>
    <div class="center-wrapper"><label for="hinhAnh">Hình ảnh</label><input type="file" id="hinhAnh" name="hinhAnh" class="center-textbox"></div>
    <label for="hinhAnh">Giờ chiếu:</label> 
    <input type="text" id="txtGioChieu1" name="txtGioChieu[]" value=":" onkeydown="formatTime(event)" style="width: 80px; padding: 5px; border-radius: 5px; font-weight:bolder">
    <input type="text" id="txtGioChieu2" name="txtGioChieu[]" value=":" onkeydown="formatTime(event)" style="width: 80px; padding: 5px; border-radius: 5px; font-weight:bolder">
    <input type="text" id="txtGioChieu3" name="txtGioChieu[]" value=":" onkeydown="formatTime(event)" style="width: 80px; padding: 5px; border-radius: 5px; font-weight:bolder">
    <input type="text" id="txtGioChieu4" name="txtGioChieu[]" value=":" onkeydown="formatTime(event)" style="width: 80px; padding: 5px; border-radius: 5px; font-weight:bolder">
    <input type="text" id="txtGioChieu5" name="txtGioChieu[]" value=":" onkeydown="formatTime(event)" style="width: 80px; padding: 5px; border-radius: 5px; font-weight:bolder">

    <div class="login-button">
        <input type="submit" id="bntSave" name="bntSave" value="Thêm phim" style="background-color: #3366FF; font-weight: bold; font-size: medium;width: 130px; padding: 5px; " />
    </div>
    <br />
</form>

    </div>
</body>
</html>
