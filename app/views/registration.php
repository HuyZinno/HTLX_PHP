<?php
include_once '../controllers/UserController.php';
include_once '../config/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $phone = $_POST['txtPhone'];
    $username = $_POST['txtPhone'];
    $password = $_POST['txtPassword'];
    $fullname = $_POST['txtfullname'];
    $email = $_POST['txtEmail'];
    $city = $_POST['txtCity'];

    // Khởi tạo một đối tượng Database để tạo kết nối CSDL
    $database = new Database();
    $conn = $database->getConnection();

    // Khởi tạo một đối tượng UserController và truyền kết nối CSDL vào constructor
    $userController = new UserController($conn);

    // Gọi phương thức addUser từ UserController để thêm người dùng mới
    $userController->DangKy($phone, $password, $fullname, $email, $city);

}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('../asset/images/4927.jpg_wh860.jpg'); /* Đường dẫn tới hình ảnh nền */
            background-size: cover;
            background-repeat: no-repeat;
        }
        .login-container {
            background-image: url('../asset/images/nen2.jpg'); 
            background-repeat: no-repeat;
            /* background-color: #f0f0f0; */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            height: 620px;
        }
        .login-container h2 {
            text-align: center;
        }
        .login-container form {
            text-align: center;
        }
        .login-container label, .login-container input {
            display: block;
            margin-bottom: 10px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 5px;
        }
        .login-container input[type="submit"] {
            border-style: none;
            border-color: inherit;
            border-width: medium;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            cursor: pointer;
            height: 65px;
            text-align: left;
        }
        .login-container .login-button button {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .login-button {
            text-align: center;
        }

        .login-button button,
        .login-button input[type="button"],
        .login-button input[type="submit"],
        .login-button input[type="reset"],
        .login-button a {
            display: block;
            margin: 0 auto;
            font-family:'SVN-New Athletic M54';
        }

        .center-textbox {
            text-align: center;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" runat="server" style="font-family: 'SVN-Agency FB'; font-weight: bold; font-size: medium; height: 555px;">
        <h2 style="font-family: 'SVN-New Athletic M54'; font-weight: normal;">
            <label for="password">
            <a href="home.php">
                <img src="../asset/images/HTLX logo.jpg" alt="" height="85px" width="134px" />
            </a>

            </label>
            ĐĂNG KÝ TÀI KHOẢN</h2>
            <label for="phone" style="font-family: 'SVN-New Athletic M54'; font-weight: lighter">Số điện thoại:<input type="text" id="txtPhone" name="txtPhone" class="center-textbox"></label>
         
            <label for="password" style="font-family: 'SVN-New Athletic M54'; font-weight: lighter">Mật khẩu:<input type="password" id="txtPassword" name="txtPassword" class="center-textbox"></label>
         
            <label for="fullname" style="font-family: 'SVN-New Athletic M54'; font-weight: lighter">Họ và tên:<input type="text" id="txtfullname" name="txtfullname" class="center-textbox"></label>

            <label for="email" style="font-family: 'SVN-New Athletic M54'; font-weight: lighter">Email:<input type="text" id="txtEmail" name="txtEmail" class="center-textbox"></label>

            <label for="city" style="font-family: 'SVN-New Athletic M54'; font-weight: lighter">Nơi ở:<input type="text" id="txtCity" name="txtCity" class="center-textbox"></label>

            <div class="login-button">
                <input type="submit" id="btnDK" name="btnLogin" value="Đăng ký" class="login-button" />
            </div>
           <br />
                <br />
                <a href="login.php">Quay lại đăng nhập?</a>
                <br /><br />
        </form>
    </div>
    
</body>
</html>
