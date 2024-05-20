<?php
// Kết nối đến cơ sở dữ liệu
$host = 'localhost';
$dbname = 'htlx';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Thiết lập chế độ lỗi để báo cáo lỗi từ cơ sở dữ liệu
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Xử lý lỗi nếu không thể kết nối đến cơ sở dữ liệu
    die("Không thể kết nối đến cơ sở dữ liệu: " . $e->getMessage());
}

// Kiểm tra nếu 'maPhim' được gửi từ biểu mẫu
if(isset($_POST['maPhim'])) {
    // Lấy mã phim từ biểu mẫu
    $maPhim = $_POST['maPhim'];
    
    try {
        // Bắt đầu giao dịch
        $pdo->beginTransaction();
        
        // Xóa các thông tin thời gian của phim từ bảng thoigian
        $sql_delete_thoigian = "DELETE FROM thoigian WHERE maPhim = :maPhim";
        $stmt_delete_thoigian = $pdo->prepare($sql_delete_thoigian);
        $stmt_delete_thoigian->bindParam(':maPhim', $maPhim, PDO::PARAM_INT);
        
        // Thực thi câu lệnh xóa thông tin thời gian của phim
        $stmt_delete_thoigian->execute();
        
        // Xóa phim từ bảng movie
        $sql_delete_movie = "DELETE FROM movie WHERE maPhim = :maPhim";
        $stmt_delete_movie = $pdo->prepare($sql_delete_movie);
        $stmt_delete_movie->bindParam(':maPhim', $maPhim, PDO::PARAM_INT);
        
        // Thực thi câu lệnh xóa phim từ bảng movie
        $stmt_delete_movie->execute();
        
        // Commit giao dịch
        $pdo->commit();
        
        // Chuyển hướng lại trang danh sách phim
        header("Location: listFilm.php");
        exit();
    } catch (PDOException $e) {
        // Nếu có lỗi xảy ra, rollback các thay đổi và hiển thị thông báo lỗi
        $pdo->rollBack();
        echo "Đã xảy ra lỗi khi xóa phim: " . $e->getMessage();
    }
} else {
    // Nếu 'maPhim' không được gửi từ biểu mẫu, chuyển hướng người dùng trở lại trang danh sách phim
    header("Location: listFilm.php");
    exit();
}
?>
