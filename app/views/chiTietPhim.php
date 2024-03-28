<?php
session_start();
include_once '../models/FilmModel.php';

// Kiểm tra xem tham số maPhim có tồn tại trong URL không
if(isset($_GET['maPhim'])) {
    $maPhim = $_GET['maPhim'];
    $filmModel = new FilmModel();
    $movie = $filmModel->getMovieById($maPhim);
    if (!$movie) {
        echo "Không tìm thấy thông tin phim.";
        exit();
    }
} else {
    echo "Không có thông tin phim được cung cấp.";
    exit();
}

// Kết nối CSDL
$connection = new mysqli('localhost', 'root', '', 'htlx');
if ($connection->connect_error) {
    die("Kết nối CSDL thất bại: " . $connection->connect_error);
}

// Truy vấn CSDL để lấy giờ chiếu dựa trên mã phim
$query = "SELECT gioChieu FROM thoigian WHERE maPhim = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $maPhim);
$stmt->execute();
$result = $stmt->get_result();

// Lưu các giờ chiếu vào một mảng
$gioChieuArray = [];
while ($row = $result->fetch_assoc()) {
    $gioChieuArray[] = $row['gioChieu'];
}

// Đóng kết nối CSDL
$stmt->close();
$connection->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Phim: <?php echo $movie['tenPhim']; ?></title>
    <style>
        /* CSS styles */
        body {
            font-family: "Exo", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background-image: url('../asset/images/background.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: auto;
        }

        #container {
            max-width: 800px;
            margin: 0 auto; /* Canh giữa container */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: auto; /* Cho phép cuộn trang khi nội dung dài hơn */
            overflow-y: scroll;
        }


        h1 {
            text-align: center;
        }
        h2{
            margin-top: auto;
            overflow: auto;
        }

        #movie-details {
            text-align: left;
            margin-bottom: 20px;
        }

        #movie-details img {
            height: 200px;
        }

        #buttons {
            text-align: center;
        }

        .custom-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 15px 0; /* Sửa đổi chỉ cần cố định padding trên dưới, không cần padding trái phải */
            width: 100px; /* Chiều rộng của nút */
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 1cm;
            align-self: center;
            box-sizing: border-box; /* Đảm bảo padding không làm thay đổi chiều rộng của nút */
            margin-right: 10px;
        }

        .custom-button:hover {
            background-color: #0056b3;
        }
        .custom-button.grayed-out {
        /* CSS cho nút khi đã qua giờ */    
        color: black;    
        background-color: #ccc; /* Màu xám */
        cursor: not-allowed; /* Không cho phép nhấp chuột */
    }
    </style>
</head>
<body>
    <div id="container">
        <h2><center>Chi Tiết Phim</center></h2>
        <div id="movie-details">
            <img src="../asset/images/<?php echo $movie['hinhAnh']; ?>" alt="<?php echo $movie['tenPhim']; ?>">
            <h2><?php echo $movie['tenPhim']; ?></h2>
            <p><strong>Đạo diễn:</strong> <?php echo $movie['daoDien']; ?></p>
            <p><strong>Diễn viên:</strong> <?php echo $movie['dienVien']; ?></p>
            <p><strong>Thể loại:</strong> <?php echo $movie['theLoai']; ?></p>
            <p><strong>Thời lượng:</strong> <?php echo $movie['thoiLuong']; ?> phút</p>
            <p><strong>Mô tả:</strong> <?php echo $movie['moTa']; ?></p>
            
        </div>
        <div id="buttons">
        <?php
        // Tạo nút cho mỗi giờ chiếu
        foreach ($gioChieuArray as $gioChieu) {
            // Lấy giờ hiện tại từ máy tính của người dùng
            echo "<script>";
            echo "var currentTime = new Date();";
            echo "var currentHour = currentTime.getHours();";
            echo "var currentMinute = currentTime.getMinutes();";
            echo "</script>";
            
            // Chuyển đổi sang định dạng 12 giờ nếu cần
            echo "<script>";
            echo "var formattedHour = currentHour % 12 || 12;"; // Chuyển đổi sang định dạng 12 giờ
            echo "var ampm = currentHour >= 12 ? 'PM' : 'AM';"; // Xác định AM hoặc PM
            echo "</script>";
            
            // Kiểm tra xem giờ chiếu đã vượt qua thời gian hiện tại chưa
            echo "<script>";
            echo "var showtimeHour = parseInt('" . substr($gioChieu, 0, 2) . "');"; // Lấy giờ từ giờ chiếu
            echo "var showtimeMinute = parseInt('" . substr($gioChieu, 3, 2) . "');"; // Lấy phút từ giờ chiếu
            echo "if (showtimeHour < currentHour || (showtimeHour === currentHour && showtimeMinute < currentMinute)) {";
            echo "document.write(\"<input type='button' value='" . $gioChieu . "' class='custom-button grayed-out' disabled />\");";
            echo "} else {";
            echo "document.write(\"<input type='button' value='" . $gioChieu . "' class='custom-button' onclick='saveSession(\\\"". $gioChieu . "\\\")' />\");";
            echo "}";
            echo "</script>";

            
        }
    ?>
    <input id="btnQuayLai" type="button" value="Quay lại" class="custom-button" style="background-color: red;" onclick="window.location.href='phimDangChieu.php'" />
</div>


    <script type="text/javascript">
        function checkSession() {
            var username = '<?php echo isset($_SESSION["Phone"]) ? $_SESSION["Phone"] : "" ?>';
            if (username === undefined || username === null || username === '') {
                alert('Bạn cần đăng nhập để đặt vé!');
                window.location.href = "login.php";
                return false; // Ngăn chặn sự kiện click
            }
            // Sự kiện click sẽ được thực hiện nếu session "username" tồn tại
            return true;
        }
        function saveSession(gioChieu) {
            // Lưu thông tin giờ chiếu vào session gioChieu
            <?php $_SESSION['gioChieu'] = "' + gioChieu + '"; ?>
            // Chuyển hướng đến trang datVe.php với tham số maPhim và gioChieu
            window.location.href = "datVe.php?maPhim=<?php echo $maPhim; ?>&gioChieu=" + gioChieu;
        }
    </script>
</body>
</html>
