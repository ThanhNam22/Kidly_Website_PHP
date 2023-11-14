<?php

   include 'config.php';

   session_start();

   $user_id = $_SESSION['user_id']; //tạo session người dùng thường

   if(!isset($user_id)){// session không tồn tại => quay lại trang đăng nhập
      header('location:login.php');
   }

   if(isset($_POST['send'])){//lưu tin nhắn từ form submit name='send'

      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $number = $_POST['number'];
      $msg = mysqli_real_escape_string($conn, $_POST['message']);

      $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

      if(mysqli_num_rows($select_message) > 0){
         $message[] = 'Tin nhắn đã được gửi trước đó!';
      }else{
         mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
         $message[] = 'Tin nhắn đã được gửi thành công!';
      }

   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Liên hệ</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Liên hệ</h3>
   <p> <a href="home.php">Trang chủ</a> / Liên hệ </p>
</div>
<div>
   <h1 style="font-size: 30px; margin: 10px; color: black;" >Cửa hàng gần nhất</h1>
   <iframe style="width: 100%;" height = "600px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.473788451511!2d105.73253187512992!3d21.05373098060183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31345457e292d5bf%3A0x20ac91c94d74439a!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2hp4buHcCBIw6AgTuG7mWk!5e0!3m2!1svi!2s!4v1687061097456!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<section class="contact">

   <form action="" method="post">
      <h3>Điều bạn muốn chia sẻ</h3>
      <input type="text" name="name" required placeholder="Nhập Họ tên" class="box">
      <input type="email" name="email" required placeholder="Nhập Email" class="box">
      <input type="number" name="number" required placeholder="Nhập số điện thoại" class="box">
      <textarea name="message" class="box" placeholder="Tin nhắn" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Gửi" name="send" class="btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>