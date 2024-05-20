<?php

include_once '../models/UserModel.php';
include_once '../config/Database.php';

class LoginController {
    private $userModel;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->userModel = new UserModel($db);
    }

    public function loginUser($username, $password) {
        $user = $this->userModel->getUserByUsername($username);
    
        if ($user) {
            if ($password == $user['Pass']) {
                if ($user['isCheck'] == 1) {
                    // Nếu người dùng đã được kiểm tra, điều hướng đến trang admin
                    header("Location: HomeAdmin.php");
                } else {
                    // Nếu người dùng chưa được kiểm tra, điều hướng đến trang home
                    header("Location: home.php");
                }
                session_start();
                $_SESSION['Phone'] = $username;
                exit();
            } else {
                echo "<script>alert('Mật khẩu không đúng!'); window.location.href = 'login.php';</script>";
                return;
            }
        } else {
            echo "<script>alert('Tài khoản không tồn tại!'); window.location.href = 'login.php';</script>";
            return;
        }
    }
    
}

// Xử lý đăng nhập khi nhấn nút Đăng nhập
if (isset($_POST['btnLogin'])) {
    $username = $_POST['txtPhone'];
    $password = $_POST['txtPassword'];

    $database = new Database();
    $conn = $database->getConnection();
    $controller = new LoginController($conn);
    $controller->loginUser($username, $password);
}
?>
