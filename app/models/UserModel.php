<?php
include_once '../config/Database.php';
class UserModel {
    private $conn;
    

    public function __construct($db) {
        $this->conn = $db;
        
    }
    // Phương thức kiểm tra người dùng có tồn tại không
    public function getUserByUsername($username) {
        $stmt = $this->conn->prepare("SELECT Phone, Pass, isCheck FROM users WHERE Phone=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function DangKy($phone, $password, $fullname, $email, $city) {
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare("INSERT INTO users (Phone, Pass, FullName, Email, City) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $phone, $password, $fullname, $email, $city);
    
        // Thực thi truy vấn
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function checkExistingPhone($phone) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE Phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true; // Số điện thoại đã tồn tại
        } else {
            return false; // Số điện thoại chưa tồn tại
        }
    }
    

    public function updatePassword($Phone, $newPassword) {
        // Chuẩn bị câu lệnh SQL để cập nhật mật khẩu
        $stmt = $this->conn->prepare("UPDATE users SET pass = ? WHERE Phone = ?");
        $stmt->bind_param("ss", $newPassword, $Phone);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
