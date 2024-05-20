<?php
class MovieModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllMovies() {
        $query = "SELECT * FROM movie";
        $result = $this->conn->query($query);
        $movies = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $movies[] = $row;
            }
        }
        return $movies;
    }

    public function deleteMovie($maPhim) {
        $query = "DELETE FROM movie WHERE maPhim = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $maPhim);
        return $stmt->execute();
    }

    public function checkMaPhim($maPhim) {
        $stmt = $this->conn->prepare("SELECT * FROM movie WHERE maPhim = ?");
        $stmt->bind_param("s", $maPhim);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true; // Số điện thoại đã tồn tại
        } else {
            return false; // Số điện thoại chưa tồn tại
        }
    }

    public function addMovie($maPhim, $tenPhim, $theLoai, $daoDien, $dienVien, $thoiLuong, $moTa, $hinhAnh, $gioChieu) {
        $stmt = $this->conn->prepare("INSERT INTO movie (MaPhim, TenPhim, TheLoai, DaoDien, DienVien, ThoiLuong, MoTa, hinhAnh) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $maPhim, $tenPhim, $theLoai, $daoDien, $dienVien, $thoiLuong, $moTa, $hinhAnh);

        if ($stmt->execute()) {
            // Thêm giờ chiếu vào bảng thoiGian
            foreach ($gioChieu as $time) {
                $this->addShowTime($maPhim, $time);
            }
            return true;
        } else {
            return false;
        }
    }

    private function addShowTime($maPhim, $gioChieu) {
        if (!is_null($gioChieu)) {
            $stmt = $this->conn->prepare("INSERT INTO thoiGian (maPhim, gioChieu) VALUES (?, ?)");
            $stmt->bind_param("ss", $maPhim, $gioChieu);
            return $stmt->execute();
        }
        return false;
    }    
}
?>
