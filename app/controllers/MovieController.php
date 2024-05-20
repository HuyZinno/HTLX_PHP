<?php
include_once '../models/MovieModel.php';
include_once '../config/Database.php';

class MovieController {
    private $movieModel;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->movieModel = new MovieModel($db);
    }

    public function getAllMovies() {
        return $this->movieModel->getAllMovies();
    }

    public function addMovie() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {            
            $maPhim = $_POST['txtmaPhim'];
            $tenPhim = $_POST['txtTenPhim'];
            $theLoai = $_POST['txtTheLoai'];
            $daoDien = $_POST['txtDaoDien'];
            $dienVien = $_POST['txtDienVien'];
            $thoiLuong = $_POST['txtThoiLuong'];
            $moTa = $_POST['txtMoTa'];
            $hinhAnh = $_POST['hinhAnh'];
            $gioChieuArray = $_POST['txtGioChieu'];

            $gioChieu = array();
            foreach ($gioChieuArray as $item) {
                $gioChieu[] = ($item == ":") ? NULL : $item;
            }

            $success = $this->movieModel->addMovie($maPhim, $tenPhim, $theLoai, $daoDien, $dienVien, $thoiLuong, $moTa, $hinhAnh, $gioChieu);

            if ($success) {
                echo "<script>alert('Thêm phim thành công!');</script>";
            } else {
                echo "<script>alert('Có lỗi xảy ra. Vui lòng thử lại sau!');</script>";
            }
        }
    }
    public function deleteMovie($maPhim) {
        // Xóa phim từ cơ sở dữ liệu
        $success = $this->movieModel->deleteMovie($maPhim);
        
        // Trả về kết quả xóa (có thể được sử dụng cho việc hiển thị thông báo)
        if ($success) {
            return "Xóa phim thành công!";
        } else {
            return "Không thể xóa phim. Vui lòng thử lại sau!";
        }
    }
}

$database = new Database();
$conn = $database->getConnection();
$controller = new MovieController($conn);
$controller->addMovie();
$movies = $controller->getAllMovies();
?>
