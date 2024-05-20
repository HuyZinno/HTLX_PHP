<?php
include_once '../controllers/ContactController.php';
include_once '../config/Database.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Đánh Giá</title>
    <style>
        body {
            margin: 0;
            background-image: url('../asset/images/avt.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #000; /* Set text color to black */
        }

        #form1 {
            max-width: 800px;
            margin: 0 auto;
        }

        .contact-container {
            border: 1px solid #ccc;
            background-color: #f9f9f9; /* Light gray background */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh; /* Use minimum height for full viewport */
            padding: 30px;
            box-sizing: border-box;
            margin-top: 70px;
        }

        .contact-form {
            width: 100%;
            padding: 20px;
            border: 5px solid #ccc;
            border-radius: 20px; /* Slightly rounded corners */
            box-sizing: border-box;
            background-color: #fff; /* White background */
        }

        h1 {
            text-align: center;
            color: #000;
            background-color: #f0f0f0; /* Light gray background for heading */
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px; /* Reduced margin */
            text-align: left; /* Align text to the left */
        }

        h2 {
            font-size: 24px;
            margin: 0;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            margin-bottom: 10px; /* Increased margin bottom */
        }

        .button-group {
            margin-top: 20px; /* Reduced margin top */
            text-align: center;
        }

        .btn {
            padding: 15px 30px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        /* Styles for the star-rating */
        .star-rating {
            display: flex;
            justify-content: center;
            font-size: 40px;
            margin-bottom: 20px;
        }

        .rating-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 10px;
        }

        .star {
            cursor: pointer;
            color: #fff;
            transition: color 0.3s;
            margin-bottom: 5px;
        }

        .star:hover,
        .star.active {
            color: #ffd800;
        }

        .rating-text {
            font-size: 16px;
            margin-top: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            color: #000;
        }

        #successMessage {
            text-align: center;
            color: green;
            font-size: 18px;
            margin-top: 20px;
        }

        /* Styles for the reviews container */
        #reviewsContainer {
            margin-top: 30px;
            text-align: center;
        }

        .review-grid {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .review-grid th, .review-grid td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .review-grid th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php include 'menu.php' ?>
    <form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <div class="contact-container">

            <div class="contact-form">
                <h1>Đánh Giá</h1>
                
                <div class="form-group">
                    <label for="txtVanDe">Vấn đề cần phản ánh:</label>
                    <input type="text" id="txtVanDe" name="txtVanDe" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="txtNoiDung">Nội dung:</label>
                    <textarea id="txtNoiDung" name="txtNoiDung" rows="4" class="form-control"></textarea>
                </div>
                <input type="hidden" id="selectedRating" name="selectedRating" value="" />

                <h2>Bạn cảm thấy như thế nào khi sử dụng trang web của chúng tôi?</h2>
            

            <div class="star-rating">
                <div class="rating-option">
                    <span id="star1" class="star" onclick="setRating(1)">&#9733;</span>
                    <div class="rating-text">Rất tệ</div>
                </div>
                <div class="rating-option">
                    <span id="star2" class="star" onclick="setRating(2)">&#9733;</span>
                    <div class="rating-text">Tệ</div>
                </div>
                <div class="rating-option">
                    <span id="star3" class="star" onclick="setRating(3)">&#9733;</span>
                    <div class="rating-text">Trung bình</div>
                </div>
                <div class="rating-option">

            <span id="star4" class="star" onclick="setRating(4)">&#9733;</span>
                    <div class="rating-text">Tốt</div>
                </div>
                <div class="rating-option">
                    <span id="star5" class="star" onclick="setRating(5)">&#9733;</span>
                    <div class="rating-text">Rất tốt</div>
                </div>
            </div>
            </div>
            <div class="button-group">
                 <input type="submit" id="btnDanhGia" name="btnDanhGia" value="Gửi phản hồi" class="btn" />
            </div>

        </div>

       <div id="successMessage" runat="server"></div>

        <!-- Add a div to display reviews -->
        <div id="reviewsContainer" runat="server"></div>

        <script>
            function setRating(rating) {
                // Highlight the selected stars
                for (var i = 1; i <= 5; i++) {
                    var star = document.getElementById('star' + i);
                    if (i <= rating) {
                        star.classList.add('active');
                    } else {
                        star.classList.remove('active');
                    }
                }

                // Update the hidden input field with the selected rating
                var selectedRatingField = document.getElementById('selectedRating');
                if (selectedRatingField !== null) {
                    selectedRatingField.value = rating;
                } else {
                    console.error('selectedRating is null or undefined.');
                }
            }            
        </script>

    </form>
    <br/><br/>
    <?php include 'footer.php' ?>
</body>
</html>
