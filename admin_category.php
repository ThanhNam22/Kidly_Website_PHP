<?php

   include 'config.php';

   session_start();

   $admin_id = $_SESSION['admin_id']; //tạo session admin

   if(!isset($admin_id)){// session không tồn tại => quay lại trang đăng nhập
      header('location:login.php');
   }

   if(isset($_POST['add_category'])){//Thêm loại đồ chơi vào danh mục từ submit có name='add_category'

      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $describes= mysqli_real_escape_string($conn, $_POST['describes']);

      $select_category_name = mysqli_query($conn, "SELECT name FROM `categorys` WHERE name = '$name'") or die('query failed');//truy vấn để kiểm tra loại đồ chơi đã tồn tại chưa

      if(mysqli_num_rows($select_category_name) > 0){// tồn tại rồi thì thông báo
         $message[] = 'Loại sản phẩm đã tồn tại.';
      }else{//chưa tồn tại thì thêm mới
         $add_category_query = mysqli_query($conn, "INSERT INTO `categorys`(name, describes) VALUES('$name', '$describes')") or die('query failed');

         if($add_category_query){
         $message[] = 'Thêm thể loại thành công!';
         }else{
            $message[] = 'Không thể thêm thể loại này!';
         }
      }
   }

   if(isset($_GET['delete'])){//Xóa loại đồ chơi từ onclick <a></a> có href='delete'
      $delete_id = $_GET['delete'];
      mysqli_query($conn, "DELETE FROM `categorys` WHERE id = '$delete_id'") or die('query failed');
      header('location:admin_category.php');
   }

   if(isset($_POST['update_category'])){//Cập nhật loại đồ chơi vào danh mục từ submit có name='update_category'

      $update_p_id = $_POST['update_p_id'];
      $update_name = $_POST['update_name'];
      $update_describes = $_POST['update_describes'];

      mysqli_query($conn, "UPDATE `categorys` SET name = '$update_name', describes = '$update_describes' WHERE id = '$update_p_id'") or die('query failed');

      header('location:admin_category.php');

   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Loại đồ chơi</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php';?>

<section class="add-products">

   <h1 class="title">Thể loại đồ chơi</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Thêm thể loại</h3>
      <input type="text" name="name" class="box" placeholder="Thể loại" required>
      <input type="text" name="describes" class="box" placeholder="Mô tả" required>
      <input type="submit" value="Thêm đồ chơi" name="add_category" class="btn">
   </form>

</section>

<section class="show-products">

   <div class="box-container">

      <?php
         $select_categorys = mysqli_query($conn, "SELECT * FROM `categorys`") or die('query failed');
         if(mysqli_num_rows($select_categorys) > 0){
            while($fetch_categorys = mysqli_fetch_assoc($select_categorys)){
      ?>
      <div class="box">
         <div class="name"><?php echo $fetch_categorys['name']; ?></div>
         <div class="sub-name">Mô tả: <?php echo $fetch_categorys['describes']; ?></div>
         <a href="admin_category.php?update=<?php echo $fetch_categorys['id']; ?>" class="option-btn">Cập nhật</a>
         <a href="admin_category.php?delete=<?php echo $fetch_categorys['id']; ?>" class="delete-btn" onclick="return confirm('Xóa thể loại đồ chơi này?');">Xóa</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">Không có thể loại đồ chơi nào được thêm!</p>';  
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){//Hiện form cập nhật thông tin loại đồ chơi từ <a></a> có href='update'
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `categorys` WHERE id = '$update_id'") or die('query failed');//lấy ra thông tin loại đồ chơi cần cập nhật
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
               <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                  <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Tên">
                  <input type="text" name="update_describes" value="<?php echo $fetch_update['describes']; ?>" class="box" required placeholder="Mô tả">
                  <input type="submit" value="Cập nhật" name="update_category" class="btn"> <!-- submit form cập nhật -->
                  <input type="reset" value="Hủy"  onclick="window.location.href ='admin_category.php'" class="option-btn">
               </form>
   <?php
            }
         }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>