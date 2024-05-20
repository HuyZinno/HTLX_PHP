<?php
include_once '../models/ContactModel.php';
include_once '../config/Database.php';

class ContactController {
    private $contactModel;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->contactModel = new ContactModel($db);
    }

    public function handleFeedback() {
        // Kiểm tra xem session đã được khởi tạo chưa
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['Phone'])) {
            // Nếu chưa, chuyển hướng về trang đăng nhập
            header("Location: login.php");
            exit(); // Dừng việc thực hiện mã PHP tiếp theo
        }

        // Kiểm tra xem form đã được gửi chưa
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $phone = $_SESSION['Phone'];
            $vanDe = $_POST['txtVanDe'];
            $noiDung = $_POST['txtNoiDung'];
            $danhGia = $_POST['selectedRating'];

            // Gọi phương thức addFeedback từ ContactModel
            $success = $this->contactModel->addFeedback($phone, $vanDe, $noiDung, $danhGia);
            
            // Kiểm tra kết quả và thông báo cho người dùng
            if ($success) {
                echo "<script>alert('Gửi phản hồi thành công!'); window.location.href = 'home.php';</script>";
            } else {
                // Nếu thất bại, xuất hộp thoại alert thông báo lỗi và không chuyển hướng
                echo "<script>alert('Có lỗi xảy ra. Vui lòng thử lại sau!');</script>";
            }
        }
    }
    public function getAllFeedBack()
    {
        return $this->contactModel->getAllFeedBack();
    }
}

// Khởi tạo controller và xử lý phản hồi
$database = new Database();
$conn = $database->getConnection();
$controller = new ContactController($conn);
$controller->handleFeedback();
?>
