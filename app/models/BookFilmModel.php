<?php
class BookFilmModel {
    public function getFilmDetails($maPhim) {
        $conn = new mysqli('localhost', 'root', '', 'htlx');
        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        $sql = "SELECT hinhAnh FROM movie WHERE maPhim = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $maPhim);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }
}
?>
