<?php

   include 'config.php';

   session_start();

   $user_id = $_SESSION['user_id']; //tạo session người dùng thường

   if(!isset($user_id)){// session không tồn tại => quay lại trang đăng nhập
      header('location:login.php');
   }

   if(isset($_POST['update_cart'])){//cập nhật giỏ hàng từ form submit name='update_cart'
      $cart_id = $_POST['cart_id'];
      $cart_quantity = $_POST['cart_quantity'];
      mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
      $message[] = 'Giỏ hàng đã được cập nhật!';
   }

   if(isset($_GET['delete'])){//xóa Đồ chơi khỏi giỏ hàng từ onclick href='delete'
      $delete_id = $_GET['delete'];
      mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
      header('location:cart.php');
   }

   if(isset($_GET['delete_all'])){//xóa tất cả Đồ chơi khỏi giỏ hàng của người dùng từ onclick href='delete_all'
      mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      header('location:cart.php');
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Giỏ hàng</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Giỏ hàng</h3>
   <p> <a href="home.php">Trang chủ</a> / Giỏ hàng </p>
</div>

<section class="shopping-cart">

   <h1 class="title">Đồ chơi đã được thêm</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');//lấy ra giỏ hàng tương ứng với id người dùng
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){ 
               $name_product = $fetch_cart['name'];
               $select_quantity = mysqli_query($conn, "SELECT * FROM `products` WHERE name='$name_product'");
               $fetch_quantity = mysqli_fetch_assoc($select_quantity); 
      ?>
               <div class="box">
                  <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Xóa khỏi giỏ hàng?');"></a>
                  <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
                  <div class="name"><?php echo $fetch_cart['name']; ?></div>
                  <div class="price"><?php echo $fetch_cart['price']; ?> VND (SL: <?php echo $fetch_quantity['quantity']; ?>)</div>
                  <form action="" method="post">
                     <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                     <input type="number" min="1" max="<?=$fetch_quantity['quantity']?>" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                     <input type="submit" name="update_cart" value="Cập nhật" class="option-btn">
                  </form>
                  <div class="sub-total"> Số tiền : <span><?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_quantity['newprice']); ?> VND</span> </div>
               </div>
      <?php
               $grand_total += $sub_total;
            }
         }else{
            echo '<p class="empty">Giỏ hàng của bạn trống!</p>';
         }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn" onclick="return confirm('Xóa tất cả giỏ hàng?');">Xóa tất cả</a>
   </div>

   <div class="cart-total">
      <p>Tổng tiền : <span><?php echo $grand_total; ?> VND</span></p>
      <div class="flex">
         <a href="shop.php" class="option-btn">Tiếp tục mua hàng</a>
         <a href="checkout.php" class="btn">Tiến hành thanh toán</a>
      </div>
   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>