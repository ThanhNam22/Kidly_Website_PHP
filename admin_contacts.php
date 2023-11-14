<?php

   include 'config.php';

   session_start();

   $admin_id = $_SESSION['admin_id']; //tạo session admin

   if(!isset($admin_id)){// session không tồn tại => quay lại trang đăng nhập
      header('location:login.php');
   }

   if(isset($_GET['delete'])){//xóa tin nhắn từ onclick <a></a> href='delete'
      $delete_id = $_GET['delete'];
      mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
      header('location:admin_contacts.php');
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tin nhắn</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title"> Tin nhắn </h1>

   <div class="box-container">
   <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
      
   ?>
   <div class="box">
      <p> Id người dùng : <span><?php echo $fetch_message['user_id']; ?></span> </p>
      <p> Tên : <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> Số điện thoại : <span><?php echo $fetch_message['number']; ?></span> </p>
      <p> Email : <span><?php echo $fetch_message['email']; ?></span> </p>
      <p> Tin nhắn : <span><?php echo $fetch_message['message']; ?></span> </p>
      <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">Xóa tin nhắn</a>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">Bạn không có tin nhắn nào!</p>';
   }
   ?>
   </div>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>