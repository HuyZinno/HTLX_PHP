<?php
include_once '../config/Database.php';
include_once '../models/UpdateModel.php';
include_once '../controllers/UpdateController.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['maPhim'])) {
//     $maPhim = $_GET['maPhim'];
//     $gioChieuArray = $_POST['txtGioChieu'];
// }
// // Khởi tạo một đối tượng Database để tạo kết nối CSDL
// $database = new Database();
// $conn = $database->getConnection();

// // Khởi tạo một đối tượng UserController và truyền kết nối CSDL vào constructor
// $updateController = new UpdateController($conn);

// // Gọi phương thức addUser từ UserController để thêm người dùng mới
// $updateController->updateTime($maPhim, $gioChieu);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thời gian chiếu</title>
    <style>
        body {
            font-family: "Exo", sans-serif;
            font-size: x-large;
            background-image: url('../asset/images/4927.jpg_wh860.jpg');
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* CSS cho input text */
        input[type="text"] {
            text-align: center;
            width: 80px;
            padding: 5px;
            border-radius: 5px; /* Bo góc */
            font-weight: bolder;
            margin-bottom: 10px;
        }

        /* CSS cho button */
        button {
            font-family: "Exo", sans-serif;
            margin-left: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px; /* Bo góc */
            background-color: #007bff;
            color: white;
            font-size: large;
            cursor: pointer;
        }

        /* CSS cho nội dung form */
        .form-container {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px; /* Bo góc */
            background-color: #f9f9f9;
            max-width: 300px;
            display: flex;
            flex-direction: column; /* Hiển thị các phần tử theo chiều dọc */
            align-items: center; /* Căn giữa các phần tử theo chiều ngang */
            width: 500px;
        }

        /* CSS cho tiêu đề */
        h1 {
            text-align: center;
            margin-top: 0;
        }

        /* CSS cho các phần tử được bọc trong form-container */
        .form-container > * {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Đổi giờ chiếu</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <?php
            if(isset($_GET['maPhim'])) {
                $maPhim = $_GET['maPhim'];
                echo "<input type='hidden' name='maPhim' value='$maPhim'>";
            }
            ?>
            <!-- Input text để nhập thời gian chiếu -->
            <a>Suất chiếu 1&nbsp;&nbsp;&nbsp; </a><input type="text" id="txtGioChieu1" name="txtGioChieu[]" value=":" onkeydown="formatTime(event)">
            <br>
            <a>Suất chiếu 2&nbsp; &nbsp;</a><input type="text" id="txtGioChieu2" name="txtGioChieu[]" value=":" onkeydown="formatTime(event)">
            <br>
            <a>Suất chiếu 3&nbsp; &nbsp;</a><input type="text" id="txtGioChieu3" name="txtGioChieu[]" value=":" onkeydown="formatTime(event)">
            <br>
            <a>Suất chiếu 4&nbsp; &nbsp;</a><input type="text" id="txtGioChieu4" name="txtGioChieu[]" value=":" onkeydown="formatTime(event)">
            <br>
            <a>Suất chiếu 5&nbsp; &nbsp;</a><input type="text" id="txtGioChieu5" name="txtGioChieu[]" value=":" onkeydown="formatTime(event)">
            <br>
            <button type="submit">Cập nhật</button>
            <button type="button" onclick="window.location.href='listFilm.php'" style="background-color: red;">Quay lại</button>

        </form>
    </div>
</body>
</html>
