<?php
include_once '../controllers/FilmController.php';
include_once '../config/Database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phim Đang Chiếu</title>
    <link rel="stylesheet" href="content/site.css">
    <style>
        /* Paste your CSS styles here */
        body {
            font-family: "Exo", sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-image: url('../asset/images/background.jpg'); /* Đường dẫn tới hình ảnh nền */
            background-size: auto;
            background-position: center;
            background-repeat: no-repeat;
        }

        h2 {
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
        }

        .movie-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            display: flex;
            overflow: hidden;
        }

        .movie-container {
            width: 80%;
            margin: 20px auto;
        }

        img {
            border-radius: 5px;
            max-width: 500px; /* Đảm bảo rằng chiều rộng của hình ảnh không vượt quá kích thước của phần tử chứa */
            max-height: 300px; /* Đảm bảo rằng chiều cao của hình ảnh không vượt quá kích thước của phần tử chứa */
            width: auto;
            height: auto;
            margin-right: 20px;
            margin-top: 10px;
            object-fit: cover; /* Đảm bảo hình ảnh không bị vỡ hoặc bị kéo ra */
        }

        .movie-info {
            flex-grow: 1;
            padding: 20px;
        }

        h3 {
            margin-top: 10px;
        }

        p {
            margin: 5px 0;
        }


        .custom-button {
            /* CSS tùy chỉnh cho nút */
            background-color: #007bff;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 1cm; /* Hạ thấp nút xuống 1cm */
        }

        .custom-button:hover {
            /* Hiệu ứng khi di chuột vào */
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'menu.php'; ?>
<div class="movie-container">
    <?php if (!empty($movies)): ?>
        <?php foreach ($movies as $movie): ?>
            <div class='movie-item'>
                <img src='../asset/images/<?php echo $movie["hinhAnh"]; ?>' />
                <div class='movie-info'>
                    <h3><?php echo $movie["tenPhim"]; ?></h3>
                    <p><strong>Đạo diễn:</strong> <?php echo $movie["daoDien"]; ?></p>
                    <p><strong>Diễn viên:</strong> <?php echo $movie["dienVien"]; ?></p>
                    <p><strong>Thể loại:</strong> <?php echo $movie["theLoai"]; ?></p>
                    <p><strong>Thời lượng:</strong> <?php echo $movie["thoiLuong"]; ?> phút</p>
                    <div style='text-align: right; margin-top: 20px;'>
                        <input type='button' value='Chi tiết' class='custom-button' onclick='BookFilm(<?php echo $movie["maPhim"]; ?>)' />
                    </div>
                </div>
            </div>
        <?php endforeach; ?>   
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>

    <script type="text/javascript">
        function BookFilm(maPhim) 
        {
            window.location.href = "chiTietPhim.php?maPhim=" + maPhim;
        }
    </script>
</body>
</html>