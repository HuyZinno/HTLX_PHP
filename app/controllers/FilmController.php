<?php
include_once '../models/FilmModel.php';

class FilmController {
    public function showMovies() {
        $filmModel = new FilmModel();
        $movies = $filmModel->getMovies();
        if ($movies) {
            include 'phimDangChieu.php'; // Load view
        } else {
            echo "Không có dữ liệu phim."; // Hoặc xử lý thông báo lỗi khác
        }
    }

    public function searchMovies($search_text) {
        $filmModel = new FilmModel();
        $movies = $filmModel->searchMovies($search_text);
        include 'search.php'; // Load view for search results
    }

    public function showMovieDetails($maPhim) {
        $filmModel = new FilmModel();
        $movie = $filmModel->getMovieById($maPhim);
        if ($movie) {
            include '../views/chiTietPhim.php'; // Load view for movie details
        } else {
            echo "Không tìm thấy thông tin phim."; // Xử lý thông báo lỗi khi không tìm thấy phim
        }
    }
}

$filmController = new FilmController();

// Xử lý yêu cầu tìm kiếm phim
if (isset($_POST['search_text']) && !empty($_POST['search_text'])) {
    $filmController->searchMovies($_POST['search_text']);
} 
// Xử lý yêu cầu hiển thị danh sách phim hoặc chi tiết phim
else {
    // Kiểm tra nếu có tham số maPhim được truyền trong URL
    if (isset($_GET['maPhim'])) {
        // Lấy mã phim từ URL và hiển thị chi tiết phim
        $filmController->showMovieDetails($_GET['maPhim']);
    } else {
        // Nếu không có tham số maPhim, hiển thị danh sách phim
        $filmController->showMovies();
    }
}
?>
