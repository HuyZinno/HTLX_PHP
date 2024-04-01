<?php
include_once '../controllers/BookFilmController.php';
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['Phone'])) {
    // Nếu chưa, chuyển hướng về trang đăng nhập
    header("Location: login.php");
    exit(); // Dừng việc thực hiện mã PHP tiếp theo
}

$bookFilmController = new BookFilmController();

// Lấy mã phim từ URL
$gioChieu = $_GET['gioChieu'];
if(isset($_GET['maPhim'])) {
    $maPhim = $_GET['maPhim'];

    // Lấy thông tin phim từ controller
    $filmDetails = $bookFilmController->getFilmDetails($maPhim);

    // Kiểm tra nếu thông tin phim tồn tại
    if ($filmDetails) {
        $hinhAnh = $filmDetails['hinhAnh'];
    } else {
        echo "Không tìm thấy thông tin phim.";
        exit(); // Kết thúc kịch bản nếu không tìm thấy thông tin phim
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Vé - Bán Vé Phim</title>
    <!-- CSS styles -->
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../asset/images/background.jpg');
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
        }

        section {
            color: white;
            padding: 3em;
            text-align: center;
        }

        .seat {
            width: 70px;
            height: 50px;
            margin: 5px;
            background-color: white;
            border: 1px solid #aaa;
            cursor: pointer;
            color: black;
        }

        #seatingArea {
            background-color: black;
            font-weight: bold;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 900px;
            margin: 0 auto;
        }

        #selectedSeats {
            margin-top: 1em;
        }

        #totalPrice {
            margin-top: 1em;
            font-weight: bold;
        }

        /* CSS cho nút button */
        .custom-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px; /* Khoảng cách từ nút button đến phần trên */
        }

        .custom-button:hover {
            background-color: #0056b3; /* Màu nền khi di chuột vào */
        }
        .seat {
            width: 50px;
            height: 50px;
            margin: 5px;
            background-color: #ccc;
            border: 1px solid #888;
            cursor: pointer;
            text-align: center;
            line-height: 50px;
            font-size: 16px;
            color: #333;
        }

        .seat.selected {
            background-color: #28a745; /* Màu ghế đã chọn */
            color: #fff; /* Màu chữ */
        }
    </style>
</head>
<body>
<header>
        <h2>Chọn ghế ngồi</h2>
    </header>

    <!-- Nội dung chính của trang -->
    <section>
        <!-- Hiển thị hình ảnh của phim -->
        <img id="imgPhim" src="../asset/images/<?php echo $hinhAnh; ?>" style="padding: 50px; width: 550px; height: 350px;" />
        <h1>MÀN HÌNH</h1>
        <!-- Khu vực chứa các ghế ngồi -->
        <div id="seatingArea">
            <!-- Các ghế ngồi sẽ được tạo ra bằng JavaScript -->
        </div>

        <!-- Hiển thị các ghế đã chọn -->
        <div id="selectedSeats">
            <?php
            if (!empty($selectedSeats)) {
                echo "Các ghế đã chọn: " . implode(", ", $selectedSeats);
            }
            ?>
        </div>

        <!-- Nút thanh toán -->
        <div style="margin-top: 20px; text-align: center;">
            <input type="button" value="Thanh toán" class="custom-button" onclick="BillFilm();" />
        </div>
    </section>

    <?php include 'footer.php'; ?>
            <br/><br/><br/><br/>
    <!-- JavaScript -->
    <script>
    // Khai báo biến JavaScript
    var selectedSeats = [];

    // Hàm tạo ghế ngồi
    function createSeatingArea() {
        var seatingArea = document.getElementById("seatingArea");

        // Số hàng và số ghế mỗi hàng
        var rows = 10;
        var seatsPerRow = 5;

        for (var row = 1; row <= rows; row++) {
            var rowElement = document.createElement("div");
            rowElement.className = "row";

            for (var seatNum = 1; seatNum <= seatsPerRow; seatNum++) {
                var seat = document.createElement("div");
                seat.className = "seat";
                seat.textContent = String.fromCharCode(64 + row) + seatNum; // Mã ghế: A1, A2, ..., B1, B2, ...
                seat.setAttribute("data-seat", String.fromCharCode(64 + row) + seatNum); // Đặt thuộc tính data cho ghế
                seat.onclick = function () {
                    toggleSeatSelection(this);
                };

                rowElement.appendChild(seat);
            }

            seatingArea.appendChild(rowElement);
        }
    }

    // Hàm chuyển đổi trạng thái chọn ghế
    function toggleSeatSelection(seat) {
        var seatNumber = seat.getAttribute("data-seat");

        if (selectedSeats.includes(seatNumber)) {
            // Nếu ghế đã chọn, hủy chọn
            selectedSeats = selectedSeats.filter(function (item) {
                return item !== seatNumber;
            });
            seat.classList.remove("selected");
        } else {
            // Nếu ghế chưa chọn, chọn ghế
            selectedSeats.push(seatNumber);
            seat.classList.add("selected");
        }
    }

    // Hàm chuyển hướng đến trang chi tiết phim
    function BillFilm(maPhim, gioChieu) {
    // Kiểm tra nếu có ghế được chọn thì chuyển hướng
    if (selectedSeats.length > 0) {
        // Chuyển hướng đến trang chi tiết phim với mã phim, giờ chiếu và danh sách ghế đã chọn
        var selectedSeatsString = selectedSeats.join(",");
        window.location.href = "hoaDon.php?maPhim=<?php echo $maPhim; ?>&gioChieu=<?php echo $gioChieu; ?>&selectedSeats=" + selectedSeatsString;
    } else {
        alert("Vui lòng chọn ghế trước khi tiếp tục.");
    }
}
    // Gọi hàm tạo ghế ngồi khi trang được tải
    window.onload = function() {
        createSeatingArea();
    };
</script>

</body>
</html>
