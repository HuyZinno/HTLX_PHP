<?php
include_once '../models/UpdateModel.php';
include_once '../config/Database.php';

class UpdateController {
    private $updateModel;

    public function __construct() {
        $database = new Database();
        $conn = $database->getConnection();
        $this->updateModel = new UpdateModel($conn);
    }

    public function updateTime($maPhim, $gioChieuArray) {
        // Kiểm tra nếu yêu cầu là POST và có maPhim trong query string
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($maPhim)) {
            // Xử lý thời gian chiếu
            $success = $this->updateModel->updateTime($maPhim, $gioChieuArray);
            if ($success) {
                echo "<script>alert('Cập nhật giờ chiếu thành công!'); window.location.href = 'listFilm.php';</script>"; 
            } else {
                echo "<script>alert('Có lỗi xảy ra khi cập nhật giờ chiếu!');</script>"; 
            }
        }
    }
}

$updateController = new UpdateController();

// Lấy dữ liệu từ form và gọi phương thức updateTime
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['maPhim']) && isset($_POST['txtGioChieu'])) {
    $maPhim = $_POST['maPhim'];
    $gioChieuArray = $_POST['txtGioChieu'];
    $updateController->updateTime($maPhim, $gioChieuArray);
}
?>
