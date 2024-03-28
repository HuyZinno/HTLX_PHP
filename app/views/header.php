<?php // Đăng xuất
if (isset($_GET['logout'])) {
    // Xóa tất cả các biến session
    $_SESSION = array();

    // Hủy bỏ session
    session_destroy();

    // Chuyển hướng người dùng đến trang đăng nhập
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Bán Vé Phim</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <header>
        <div style="position: absolute; top: 28px; right: 200px; color: white; font-size:large">
            <?php
            if(isset($_SESSION["Phone"])) { ?>
                <a href="#Profile.php">
                    <span style="float: left; color: #FFFFFF;">Xin chào, <?php echo $_SESSION["Phone"]; ?></span>
                </a>
            <?php } ?>
        </div>
        <form id="form1" method="post" action="search.php" class="auto-style2">
            <input type="text" id="txtSearch" name="search_text" placeholder="Nhập tên phim...">
            <input type="submit" id="btnSearch" value="Tìm kiếm" class="button">
            <?php   
                      
            if(isset($_SESSION["Phone"]) != 0) { 
            ?>
                <a href="?logout.php" class="button">Đăng Xuất</a>
            <?php 
            } else { 
            ?>
                <a href="login.php" class="button">Đăng nhập</a>
                <a href="registration.php" class="button">Đăng ký</a>
            <?php 
            } 
            ?>
        </form>
    </header>
</body>
</html>
