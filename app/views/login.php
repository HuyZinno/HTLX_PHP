<?php
session_start();
include_once '../config/Database.php';
include_once '../controllers/LoginController.php';

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
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            height: 520px;
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
    <div class="login-container" style="background-image: url('../asset/images/nen2.jpg'); background-repeat: no-repeat">
        <form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" runat="server" style="font-family: 'SVN-Agency FB'; font-weight: bold; font-size: medium; height: 555px;">
        <h2 style="font-family: 'SVN-New Athletic M54'; font-weight: normal;">
            <label for="password">
            <a href="home.php">
                <img src="../asset/images/HTLX logo.jpg" alt="" height="85px" width="134px" />
            </a>

            </label>
            ĐĂNG NHẬP VÀO HỆ THỐNG</h2>
            <label for="sdt" style="font-family: 'SVN-New Athletic M54'; font-weight: lighter">Số điện thoại:<input type="text" id="txtPhone" name="txtPhone" class="center-textbox"></label>
            &nbsp; 
            <label for="password" style="font-family: 'SVN-New Athletic M54'; font-weight: lighter">Mật khẩu:<input type="password" id="txtPassword" name="txtPassword" class="center-textbox"></label>
            &nbsp;         

            <div class="login-button">
                <input type="submit" id="btnLogin" name="btnLogin" value="Đăng nhập" class="login-button" />
            </div>
           <br />
                <br />
                <a href="#">Quên mật khẩu</a> hoặc <a href="Registration.php">Đăng ký</a>
                <br /><br />
        </form>
    </div>
    
</body>
</html>
