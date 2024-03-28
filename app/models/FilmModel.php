<?php
class FilmModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'htlx');
        if ($this->conn->connect_error) {
            die("Kết nối đến CSDL thất bại: " . $this->conn->connect_error);
        }
    }

    public function getMovies() {
        $sql = "SELECT maPhim, tenPhim, daoDien, dienVien, thoiLuong, hinhAnh, theLoai FROM movie";
        $result = $this->conn->query($sql);
        $movies = array();
        if ($result && $result->num_rows > 0) { // Kiểm tra xem truy vấn thành công và có dữ liệu trả về không
            while ($row = $result->fetch_assoc()) {
                $movies[] = $row;
            }
        }
        return $movies;
    }

    public function searchMovies($search_text) {
        $search_text = $this->sanitizeInput($search_text);

        $sql = "SELECT maPhim, tenPhim, daoDien, dienVien, thoiLuong, hinhAnh, theLoai FROM movie WHERE tenPhim LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $search_text = "%" . $search_text . "%"; // Add wildcard characters to search text
        $stmt->bind_param("s", $search_text);
        $stmt->execute();
        $result = $stmt->get_result();

        $movies = array();
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
        return $movies;
    }

    public function getMovieById($maPhim) {
        $sql = "SELECT * FROM movie WHERE maPhim = ?";
        $stmt = $this->conn->prepare($sql);
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

    private function sanitizeInput($input) {
        return htmlspecialchars(strip_tags($input));
    }
}
?>
