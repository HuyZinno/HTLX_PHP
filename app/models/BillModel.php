<?php
class BillModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createBill($Phone, $maPhim, $magiochieu, $tongtien) {
        $insert_bill_query = "INSERT INTO bill (Phone, maPhim, magiochieu, tongtien, thoiGianXacNhan) 
        VALUES ('$Phone', '$maPhim', '$magiochieu', '$tongtien', NOW())";

        return mysqli_query($this->conn, $insert_bill_query);
    }

    public function createSeats($selectedSeats, $maBill) {
        foreach ($selectedSeats as $seat) {
            $insert_ghe_query = "INSERT INTO ghe (tenGhe, trangThai, maBill) VALUES ('$seat', 'Đã đặt', '$maBill')";
            if (!mysqli_query($this->conn, $insert_ghe_query)) {
                return false;
            }
        }
        return true;
    }
}
?>
