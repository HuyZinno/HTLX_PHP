<?php
// Bao gồm các file và khởi tạo các đối tượng cần thiết (ví dụ: Database, UserModel, UserController)
include_once '../config/Database.php';
include_once '../models/UserModel.php';
include_once '../controllers/UserController.php';

// Khởi động phiên làm việc
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa, nếu chưa thì chuyển hướng về trang đăng nhập
if (!isset($_SESSION['Phone'])) {
    header("Location: login.php");
    exit();
}

// Khởi tạo đối tượng Database
$database = new Database();
$db = $database->getConnection();
// Khởi tạo đối tượng UserController
$userController = new UserController($db);

// Xử lý khi form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["changePass"])) {
    // Lấy thông tin từ form
    $newPassword = $_POST["newpass"];
    $reenteredPassword = $_POST["repassword"];

    // Kiểm tra xác nhận mật khẩu
    if ($newPassword != $reenteredPassword) {
        echo "<script>alert('Mật khẩu không khớp. Vui lòng thử lại.');</script>";
    } else {
        // Thực hiện thay đổi mật khẩu
        $phone = $_SESSION['Phone'];
        $userController->updatePassword($phone, $newPassword);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Exo:ital,wght@0,100..900;1,100..900");
        body {
            font-family: "Exo", sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .changePass-container {
            background: lavender;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        
        .changePass-container h2 {
            margin-top: 0;
            margin-bottom: 30px;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            color:black;
            font-size: 18px;
        }
        
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
        }
        
        .form-group input[type="text"]:focus,
        .form-group input[type="password"]:focus {
            outline: none;
            border-color: #007bff;
        }
        
        button {
            font-weight: bold;
            width: 40%;
            padding: 10px;
            margin: 15px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: "Exo", sans-serif;
        }
                
        .error-message {
            color: red;
            margin-top: 10px;
        }
        .logo-img {
        border-radius: 50%;
        width: 150px;
        height: 150px;
        margin: 0 auto;
        overflow: hidden;
    }

    .logo-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }    
    .toggle-password {
            cursor: pointer;
            position: relative;
            top: -3px;
        }
        .password-toggle-icon {
            position: relative;
            top: 2px;
        }s
    </style>
</head>
<body>

<div class="changePass-container">
        <div class="logo-img">
            <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/11/Logo-Dai-hoc-Quy-Nhon-1.png" alt="Profile Picture">
        </div></br>
        <h2 style="font-size: x-large">Đổi mật khẩu</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="newpass">Nhập mật khẩu mới:</label>
                <input type="password" id="newpass" name="newpass" required>
                <label class="toggle-password">
                    <input type="checkbox" onclick="togglePassword('newpass')">
                    <span class="password-toggle-icon">Hiển thị mật khẩu</span>
                </label>
            </div>
            <div class="form-group">
                <label for="repassword">Nhập lại mật khẩu mới:</label>
                <input type="password" id="repassword" name="repassword" required>
                <label class="toggle-password">
                    <input type="checkbox" onclick="togglePassword('repassword')">
                    <span class="password-toggle-icon">Hiển thị mật khẩu</span>
                </label>
            </div>
            <button type="submit" name="changePass" class="button">Đổi mật khẩu</button>
            <a href="profile.php"><button type="button" style="background-color: red;">Trở lại</button></a>
        </form>
    </div>

    <script>
        function togglePassword(fieldId) {
            var field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        }
    </script>
</body>
</html>
