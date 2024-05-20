<?php
require_once '../models/BillModel.php';

class BillController {
    private $model;
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->model = new BillModel($conn);
    }

    public function processBooking($maPhim, $gioChieu, $selectedSeats, $Phone) {
        $Phone = $_SESSION['Phone'];
        $magiochieu = $this->getMagiochieu($maPhim, $gioChieu);
        if ($magiochieu) {
            $tongtien = count($selectedSeats) * 50000; // Giả sử giá vé là 50,000 VND
            $result = $this->model->createBill($Phone, $maPhim, $magiochieu, $tongtien);
            if ($result) {
                $maBill = mysqli_insert_id($this->conn);
                $success = $this->model->createSeats($selectedSeats, $maBill);
                if ($success) {
                    return "Đặt vé thành công!";
                } else {
                    return "Lỗi khi đặt ghế!";
                }
            } else {
                return "Lỗi khi tạo hóa đơn!";
            }
        } else {
            return "Lỗi: Không tìm thấy thông tin giờ chiếu. Vui lòng kiểm tra lại hoặc liên hệ hỗ trợ.";
        }
    }

    private function getMagiochieu($maPhim, $gioChieu) {
        $query = "SELECT magiochieu FROM thoigian WHERE maPhim = '$maPhim' AND gioChieu = '$gioChieu'";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            return $row['magiochieu'];
        } else {
            return false;
        }
    }
}
?>
