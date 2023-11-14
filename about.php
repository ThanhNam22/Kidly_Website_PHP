<?php
   include 'config.php';

   session_start();

   $user_id = $_SESSION['user_id']; //tạo session người dùng thường

   if(!isset($user_id)){// session không tồn tại => quay lại trang đăng nhập
      header('location:login.php');
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thông tin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Về Kidly.</h3>
   <p> <a href="home.php">Trang chủ</a> / Thông tin </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about.jpg" alt="">
      </div>

      <div class="content">
         <h3>Tại sao lại có Kidly.</h3>
         <p>Có rất nhiều loại đồ chơi phù hợp cho trẻ em ở các độ tuổi khác nhau. Đồ chơi không chỉ giúp trẻ em giải trí và phát triển kỹ năng vận động, mà còn có thể giúp trẻ em phát triển trí thông minh, tư duy logic và sáng tạo.</p>
         <p>Qua một thời gian phát triển, Kidly mong muốn mang đến những món đồ chơi an toàn, chất lượng và hấp dẫn đến tay các bạn nhỏ.</p>
         <a href="contact.php" class="btn">Liên hệ</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">Phản hồi</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>Cảm ơn Kidly. đã giúp mình tìm mua món đồ chơi em mình ở nhà rất thích.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Dương Thanh Nam</h3>
      </div>

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>Cảm ơn Kidly. đã giúp mình tìm mua món đồ chơi yêu thích của mình.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Cao xuân Minh</h3>
      </div>

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>Cảm ơn Kidly. đã giúp mình tìm mua món đồ chơi yêu thích của mình.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Dương Nam</h3>
      </div>

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>Cảm ơn Kidly. đã giúp mình tìm mua món đồ chơi yêu thích của mình.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Xuân Minh</h3>
      </div>

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>Cảm ơn Kidly. đã giúp mình tìm mua món đồ chơi yêu thích của mình.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Nguyễn Văn A</h3>
      </div>

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>CCảm ơn Kidly. đã giúp mình tìm mua món đồ chơi yêu thích của mình.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Bùi Văn B</h3>
      </div>

   </div>

</section>

<!-- <section class="authors">

   <h1 class="title">Thành viên của Kidly.</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/dtn.jpg" alt="">
         <div class="share">
            <a href="https://www.facebook.com/nam.duongthanh.9235/" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Dương Thanh Nam</h3>
      </div>

      <div class="box">
         <img src="images/cxm.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Cao Xuân Minh</h3>
      </div>

      <div class="box">
         <img src="images/lhn.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Nguyễn Văn Tuân</h3>
      </div>

      <div class="box">
         <img src="images/author-2.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Lê Hoàng Nguyên</h3>
      </div>

   </div>

</section> -->

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>