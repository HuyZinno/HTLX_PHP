<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desi.vn</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="Header_Footer.css">
	<style> 
	/* -----------------------------------------------phần Trân------------------------------------------------------- */
        
body {
    background-color: #323131;
}

.head {
    align-items: center;
    display: flex;
    background: #323131;
    padding: 10px;
    justify-content: space-between;
    position: relative;
    z-index: 20;
}
.container {
    width: 1200px; /* Điều chỉnh giá trị này tùy theo thiết kế của bạn */
    margin: 0 auto; /* Căn giữa container */
}
.imageChange {
    height: 80px;
    width: 160px;
    margin-left: 36px;
    padding-right: 50px;
    padding-bottom: 13px;
}

.head input#search {
    flex-grow: 1;
    /* Sử dụng flex-grow để tự động mở rộng */
    width: 0;
    /* Chiều rộng tự động */
    height: 50px;
    background: white;
    font-size: 16px;
    padding-left: 25px;
    border-radius: 5px;
}

.head .icon {
    position: absolute;
    top: 25%;
    right: 24%;
    color: #4f5b66;
}
.icon{
    margin-top: 1.5%;
}
.button li {
    display: inline-block;
    /* Để có thể sử dụng padding */
    padding: 0 8px;
    /* Khoảng cách giữa các mục menu */
}
.button li a {
    border-radius: 4px;
    color: #a2a2a2;
    text-decoration: none;
    font-family: sans-serif;
    font-size: 18px;
}

.button i {
    color: #a2a2a2;
}

.button li#dk {
    padding-left: 8px;
    padding-right: 8px;
}

.button li a:hover {
    color: white;
}

.button li#dn {
    border-left: 1px solid #a2a2a2;
    padding-left: 8px;
}

.content {
    background: linear-gradient(#6b0202f3, #fd3134);
    padding-bottom: 1px;
    position: relative;
    z-index:1;
}
.content li {
    display: inline;
}

.content li.title2 {
    padding-left: 150px;
    padding-right: 20px;
    position: relative;
}

.content li a.title1 {
    color: white;
    text-decoration: none;
    font-size: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: bold;
}

.content li a.title1:hover {
    color: rgba(249, 249, 101, 0.829);
}

.content li.title2 ul.dropdown {
    border-color: #1e1e1e;
    border-style: outset;
    background-color: #323131;
    display: none;
    position: absolute;
    left: 0;
    width: auto;
    top: 105%;
    /* Hiển thị menu con dưới dòng cha */
    transform: translateX(100px);
    /* Di chuyển menu con sang phải*/
    transition: transform 1s ease;
    /* Thêm hiệu ứng chuyển động */
}

.content li.title2 ul.dropdown li.dd a {
    color: white;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-right: 50px;
    text-decoration: none;
    font-size: 16px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: block;
}

.content div.menu li {
    position: relative;
}

.content div.menu ul.title li:hover .dropdown {
    display: block;
}

.content div.menu ul.title li.title2 ul.dropdown li.dd a:hover {
    color: rgb(245, 112, 134);
}
/* -------------------------------------------phần khánh---------------------------------------------------- */
        
.content-2 {
    font-family: sans-serif;
}

footer {
    padding:2px;
    width: auto;
    background-color: #080808;
    position: fixed;
    bottom: 0;
    z-index: 1; /* Đảm bảo footer hiển thị dưới cùng */
}

.footer-container {
    padding: 10px;
    padding-left: 50px;
    padding-right: 100px;
    display: flex;
    justify-content: space-between;
}

.footer-column {
    flex: 1;
    text-align: center;
}

.footer-column h3 {
    color: red;
    font-size: 20 px;
    margin-bottom: 5px;
    text-align: left;
    padding-left: 13px;
    padding-right:10px;
}

.footer-column ul {
    list-style-type: none;
    padding:0;
}

.footer-column ul li {
    margin-bottom: 5px;
    text-align: left;
    padding-left: 12px;
}

.footer-column ul li a {
    text-decoration: none;
    color: #f8f3f3;
    transition: color 0.3s;
}

.footer-column.customer-care ul li {
    color: #fff;
}

.footer-column ul li a:hover {
    color: red;
}

.social-links {
    padding-right: 50px;
}

.social-links {
    display: inline;
    margin: 0.5px;
    text-align: center;
}

.social-links img {
    height: 70px;
    width: 88px;
}
.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #313131;
    color: #fff;
    position: relative;
}

.logo {
    margin-left: 20px;
}

.logo img {
    height: 120px;
    width: 160px;
    margin-left: 36px;
    
}

.bank-links img {
    height: 70px;
    width: 70px;
    margin-left: 15px;
    border-radius: 80px;
}

.copyright {
    /* Style your copyright text here */
    font-size: 15px;
}

.move-right {
    margin-left: 115px;
    /* Di chuyển phần tử sang bên phải 50px */
}

.nhkt {
    margin-left: 50px;
}
.footer-column-social-bank h3{
    color: red;
}

</style>
</head>

<body>
    <div class="container">
    <table>
        <!--------------------------------------- phần trân -------------------------------------------------->
        <tr>
            <th>
                <section class="content">
                    <div class="head">
                        <li>
                            <a href="http://127.0.0.1:5500/header2.html"><img class="imageChange" src="https://up-anh.vi-vn.vn/img/1711779786_502e8a8f07c75d0ab51d97ea5a4b1663.png" alt="Logo"></a>
                        </li>
                        <a href="#" class="icon"><i class="fa fa-search"></i></a>
                        <input type="search" id="search" placeholder="Tìm tên phim, diễn viên, đạo diễn...">
                        <ul class="button">
                            <i class="fa fa-user"></i>
                            <li id="dk"><a href="">Đăng ký</a></li>
                            <li id="dn"><a href="">Đăng nhập</a></li>
                        </ul>
                    </div>

                    <div class="menu">
                        <ul class="title">
                            <li id="only"><a class="title1" href="">LỊCH CHIẾU</a></li>
                            <li class="title2"><a class="title1" href="">PHIM</a>
                                <ul class="dropdown">
                                    <li class="dd"><a href="">Phim sắp chiếu</a></li>
                                    <li class="dd"><a href="">Phim đang chiếu</a></li>
                                </ul>
                            </li>
                            <li class="title2"><a class="title1" href="">CỤM RẠP</a>
                                <ul class="dropdown">
                                    <li class="dd"><a href="">DESI Quy Nhơn</a></li>
                                    <li class="dd"><a href="">DESI Sóc Trăng</a></li>
                                    <li class="dd"><a href="">DESI Bến Thành</a></li>
                                </ul>
                            </li>
                            <li class="title2"><a class="title1" href="">ƯU ĐÃI</a></li>
                            <li class="title2"><a class="title1" href="">THÀNH VIÊN</a></li>
                        </ul>
                    </div>
                </section>
            </th>

        </tr>
        <!------------------------------------------- phần khánh ---------------------------------------------------->
    <footer>
        <section class="content-2">
            <div class="footer-container">
                <div class="footer-column">
                    <h3>VỀ DESI</h3>
                    <ul>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Các câu hỏi thường gặp</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>ĐIỀU KHOẢN SỬ DỤNG</h3>
                    <ul>
                        <li><a href="#">Điều khoản chung</a></li>
                        <li><a href="#">Chính sách thanh toán</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                    </ul>
                </div>
                <div class="footer-column customer-care">
                    <h3> CHĂM SÓC KHÁCH HÀNG</h3>
                    <ul>
                        <li><span>Hotline Quy Nhơn:</span> 1900 1234 </li>

                        <li><span>Hotline An Nhơn:</span> 1900 5678 </li>

                        <li><span>Giờ làm việc:</span> 8:00 - 22:00 </li>

                        <li><span>Email hỗ trợ:</span> info@desi.vn </li>
                    </ul>
                </div>

                <div class="footer-column social-bank">
                    <h3 class="move-right">KẾT NỐI VỚI CHÚNG TÔI</h3>
                    <ul class="social-links">
                        <a href="https://www.facebook.com/fanreviewphim2"><img src="https://cdn0.iconfinder.com/data/icons/yooicons_set01_socialbookmarks/512/social_facebook_button_blue.png" alt="Facebook"></a>
                        <a href="https://www.youtube.com/@desibanks4real"><img src=https://clipart.info/images/ccovers/1590430652red-youtube-logo-png-xl.png alt="youtube"></a>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="logo">
                    <a href=""><img src="https://img.upanh.tv/2024/03/30/logo795e31a4a48ae872.png" alt="logo"></a>
                </div>
                <div class="bank-links">
                    <h3 class="nhkt">NGÂN HÀNG KẾT NỐI</h3>
                    <ul class="bank-links">
                        <a href="https://momo.vn"><img src="https://www.russinvecchi.com.vn/wp-content/uploads/2020/09/931b119cf710fb54746d5be0e258ac89-logo-momo-1024x1024.png" alt="momo"></a>
                        <a href="https://www.mbbank.com.vn"><img src="http://static.ybox.vn/2022/4/5/1650623741740-logo%20700x400%20(53).png" alt="mbbank"></a>
                    </ul>
                </div>
                <div class="copyright">
                    <p>&copy; Bản quyền thuộc về DESI</p>
                </div>
            </div>
        </section>
    </footer></div>
</body>

</html>