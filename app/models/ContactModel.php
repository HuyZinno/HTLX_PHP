<?php
class ContactModel {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }    

    public function addFeedback($phone, $vanDe, $noiDung, $danhGia) {
        // Chuẩn bị câu truy vấn SQL
        $stmt = $this->conn->prepare("INSERT INTO lienHe (Phone, VanDe, NoiDung, DanhGia) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $phone, $vanDe, $noiDung, $danhGia);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllFeedBack()
    {
        // Câu truy vấn SQL để lấy tất cả phản hồi
        $sql = "SELECT * FROM lienHe";
        
        // Thực hiện truy vấn
        $result = $this->conn->query($sql);

        // Kiểm tra nếu truy vấn không thành công
        if (!$result) {
            // Xuất thông báo lỗi và kết thúc hàm
            echo "Error: " . $this->conn->error;
            return [];
        }

        // Truy vấn thành công, tiếp tục lấy dữ liệu
        $feedBacks = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $feedBacks[] = $row;
            }
        }
        return $feedBacks;
    }
}
?>
