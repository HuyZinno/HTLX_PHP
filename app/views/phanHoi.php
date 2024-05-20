<?php
include_once '../controllers/ContactController.php';
include_once '../config/Database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách phim</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            background-image: url('../asset/images/nen2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            color: #fff;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 90%;
            max-width: 100%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        img {
            width: 250px;
            height: 150px;
            
        }

        /* Các nút */
        .custom-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 85px; /* Độ rộng của mỗi nút (chiếm 1/3 phần tử cha) và trừ đi khoảng cách giữa chúng */
            margin-right: 10px; /* Khoảng cách giữa các nút */
            padding: 10px; /* Khoảng cách nội dung từ viền của nút */
            margin-top: 10px; /* Khoảng cách phía trên giữa các nút */
            margin-bottom: 10px;
        }


        .custom-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<?php include 'menuAd.php'; ?>
<body>
<h1>Danh sách phản hồi</h1>
<table border="1">
    <tr>
        <th>Mã phản hồi</th>
        <th>Số điện thoại</th>
        <th>Vấn đề</th>
        <th>Nội dung</th>
        <th>Mức đánh giá</th>
    </tr>
    <?php
    // Gọi phương thức để lấy tất cả các phản hồi từ ContactModel
    $feedbacks = $controller->getAllFeedBack();

    // Kiểm tra xem có dữ liệu phản hồi không
    if (!empty($feedbacks)) {
        // Duyệt qua mỗi phản hồi và hiển thị trong bảng
        foreach ($feedbacks as $feedBack) {
            echo "<tr>";
            echo "<td>" . $feedBack['maLH'] . "</td>";
            echo "<td>" . $feedBack['Phone'] . "</td>";
            echo "<td>" . $feedBack['VanDe'] . "</td>";
            echo "<td>" . $feedBack['NoiDung'] . "</td>";
            echo "<td>" . $feedBack['DanhGia'] . "</td>";
            echo "</tr>";
        }
    } else {
        // Nếu không có phản hồi nào, hiển thị thông báo
        echo "<tr><td colspan='5'>Không có phản hồi nào.</td></tr>";
    }
    ?>
</table>
</body>


</html>
