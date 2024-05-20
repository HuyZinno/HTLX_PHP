<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        body{
            font-size: large;
            font-family: "Exo", sans-serif;
        }
        nav {
            background-color: #444;
            padding: 1em;
            text-align: center;
            font-weight: bold;
            font-size: x-large;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex; /* Hiển thị các phần tử của menu dưới dạng hàng ngang */
            justify-content: center; /* Căn giữa các phần tử trong menu */
        }

        nav li {
            margin: 0 1em;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 1em;
        }
    </style>
</head>
<body>

    <nav>
        <ul>
            <li><a href="homeAdmin.php">Trang Chủ</a></li>
            <li><a href="listFilm.php">Danh sách phim</a></li>
            <li><a href="phanHoi.php">Phản hồi khách hàng</a></li>
        </ul>
    </nav>

</body>
</html>
