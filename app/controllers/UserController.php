<?php

include_once '../models/UserModel.php';

class UserController {
    private $userModel;
    private $db;
    

    public function __construct($db) {
        $this->db = $db;
        $this->userModel = new UserModel($db);
    }
    

    public function DangKy($phone, $password, $fullname, $email, $city ) {
        if ($this->userModel->checkExistingPhone($phone)) {
            // Số điện thoại đã tồn tại, hiển thị thông báo lỗi
            echo "<script>alert('Số điện thoại đã được sử dụng!');</script>";
        } else {
            // Số điện thoại chưa tồn tại, tiến hành đăng ký
            if ($this->userModel->DangKy($phone, $password, $fullname, $email, $city)) {
                // Thêm người dùng thành công, chuyển hướng đến trang home.php
                echo "<script>alert('Đăng ký tài khoản thành công!'); window.location.href = 'login.php';</script>";
                exit();
            } else {
                // Xử lý lỗi khi thêm người dùng
                // Có thể chuyển hướng đến trang lỗi hoặc hiển thị thông báo lỗi
                echo "<script>alert('Lỗi khi đăng ký tài khoản!');</script>";
            }
        }
    }

    public function updatePassword($Phone, $newPassword) {
        if ($this->userModel->updatePassword($Phone, $newPassword)) {
            // Cập nhật mật khẩu thành công
            echo "<script>alert('Đã đổi mật khẩu!'); window.location.href = 'profile.php';</script>";
        } else {
            // Xử lý lỗi khi cập nhật mật khẩu
            // Có thể chuyển hướng đến trang lỗi hoặc hiển thị thông báo lỗi
            echo "<script>alert('Không thành công!');</script>";
        }
    }
    
}
?>
