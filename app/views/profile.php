<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['Phone'])) {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Kết nối đến CSDL
include('../config/Database.php');
$db = new Database();
$conn = $db->getConnection();

// Lấy thông tin người dùng từ CSDL
$Phone = $_SESSION['Phone'];

$sql = "SELECT * FROM users WHERE Phone = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $Phone);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $FullName = $row['FullName'];
    $Email = $row['Email'];
    $City = $row['City'];
} else {
    // Xử lý khi không tìm thấy thông tin người dùng
    $FullName = '';
    $Email = '';
    $City = '';
}

// URL của ảnh đại diện có thể được lấy từ CSDL hoặc từ thông tin người dùng
$profilePictureURL = 'https://static-00.iconduck.com/assets.00/user-icon-2048x2048-ihoxz4vq.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang cá nhân</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            
            font-family: "Exo", sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../asset/images/background.jpg');
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 30px 0;
        }

        .profile-header h1 {
            margin: 10px 0;
        }

        .profile-img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            margin: 0 auto;
            overflow: hidden;
        }

        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            font-size: large;
            text-align: center;
            padding: 20px;
        }

        .profile-info p {
            margin: 5px 0;
        }

        .profile-info .fa {
            margin-right: 5px;
        }

        .profile-links {
            text-align: center;
            padding: 20px;
        }

        .profile-links a {
            color: #007bff;
            text-decoration: none;
            margin: 0 10px;
        }

        .profile-links a:hover {
            text-decoration: underline;
        }
        .change-password-btn {
            font-family: "Exo", sans-serif;
            font-size: large;
            font-weight: bold;
            background-color: aqua;
            text-align: center;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            color: #000;
            display: inline-block;
        }

        .change-password-btn:hover {
            background-color: #00bcd4;
        }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>
<div class="container">
    <div class="profile-header">
        <div class="profile-img">
            <img src="<?php echo $profilePictureURL; ?>" alt="Profile Picture">
        </div>
        <h1>Thông tin tài khoản</h1>
    </div>

    <div class="profile-info">
        <p><i class="fas fa-user"></i>  <?php echo $FullName; ?></p>
        <p><i class="fas fa-envelope"></i> <?php echo $Email; ?></p>
        <p><i class="fas fa-phone"></i>  <?php echo $Phone; ?></p>
        <p><i class="fas fa-city"></i>  <?php echo $City; ?></p>

    </div>
    <div class="profile-links">
        <a href="changePass.php"><button class="change-password-btn">Đổi mật khẩu</button></a>
        <a href="home.php"><button class="change-password-btn">Trở lại</button></a>
    </div>
</div>
<br/><br/><br/>
<?php include 'footer.php'; ?>
</body>
</html>
