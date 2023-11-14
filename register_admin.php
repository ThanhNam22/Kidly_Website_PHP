<?php
    //đăng ký tài khoản admin
    include 'config.php';

    if(isset($_POST['submit'])){//lấy thông tin từ form submit name='submit'

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
        $user_type = 'admin';

        $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

        if(mysqli_num_rows($select_users) > 0){//kiểm tra email tồn tại chưa
            $message[] = 'Tài khoản đã tồn tại!';
        }else{//chưa thì kiểm tra mật khẩu xác nhận và tạo tài khoản
            if($pass != $cpass){
                $message[] = 'Mật khẩu không khớp!';
            }else{
                mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
                $message[] = 'Đăng ký thành công!';
                header('location:login.php');
            }
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng ký Admin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container" style="background: url(../btl13/images/home-bg.jpg) no-repeat;">

   <form action="" method="post">
      <h3>Đăng ký Admin</h3>
      <input type="text" name="name" placeholder="Nhập họ tên" required class="box">
      <input type="email" name="email" placeholder="Nhập email" required class="box">
      <input type="password" name="password" placeholder="Nhập mật khẩu" required class="box">
      <input type="password" name="cpassword" placeholder="Nhập lại mật khẩu" required class="box">
      <input type="submit" name="submit" value="Đăng ký ngay" class="btn">
      <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
   </form>

</div>

</body>
</html>