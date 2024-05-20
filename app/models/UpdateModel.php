<?php
class UpdateModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function updateTime($maPhim, $gioChieuArray) {
        // Xóa các giờ chiếu cũ của phim
        $deleteQuery = "DELETE FROM thoiGian WHERE maPhim = ?";
        $stmtDelete = $this->conn->prepare($deleteQuery);
        $stmtDelete->bind_param("s", $maPhim);
        $stmtDelete->execute();

        // Thêm giờ chiếu mới
        foreach ($gioChieuArray as $time) {
            if ($time != ":") {
                // Kiểm tra giờ chiếu không rỗng
                if (!empty($time)) {
                    $insertQuery = "INSERT INTO thoiGian (maPhim, gioChieu) VALUES (?, ?)";
                    $stmtInsert = $this->conn->prepare($insertQuery);
                    $stmtInsert->bind_param("ss", $maPhim, $time);
                    $stmtInsert->execute();
                }
            }
        }
        return true;
    }
}
?>
