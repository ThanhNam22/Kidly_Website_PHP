<?php

   include 'config.php';

   session_start();

   $user_id = $_SESSION['user_id']; //tạo session người dùng thường

   if(!isset($user_id)){// session không tồn tại => quay lại trang đăng nhập
      header('location:login.php');
   }

   if(isset($_POST['order_btn'])){//nhập thông tin đơn hàng từ form submit name='order_btn'

      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $number = $_POST['number'];
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $method = mysqli_real_escape_string($conn, $_POST['method']);
      $address = mysqli_real_escape_string($conn,$_POST['street'].', '. $_POST['city'].', '. $_POST['country']);
      $note = mysqli_real_escape_string($conn, $_POST['note']);
      $placed_on = date('d-m-Y');
      $status = "Chờ xác nhận";//trạng thái mặc định khi mới đặt hàng

      $cart_total = 0;

      $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($cart_query) > 0){//tính tổng tiền và số lượng đồ chơi
         while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name']. '-' .$cart_item['quantity'];//ghép đồ chơi với số lượng tương ứng
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;//tổng tiền
         }
         $total_products = implode(', ',$cart_products);//đồ chơi và số lượng

         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND note= '$note' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){//đơn hàng trùng thông tin thông báo đã tồn tại
            $message[] = 'Đơn hàng đã tồn tại!'; 
         }else{//đặt hàng và trù số lượng đồ chơi
            mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, note, total_products, total_price, placed_on, payment_status) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$note', '$total_products', '$cart_total', '$placed_on', '$status')") or die('query failed');
            $message[] = 'Đặt hàng thành công.!';
            $cart_quantity= mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            while($fetch_quantity= mysqli_fetch_assoc($cart_quantity)){//lấy số lượng đồ chơi đã đặt
               $name_product= $fetch_quantity['name'];
               $product_quantity= mysqli_query($conn, "SELECT * FROM `products` WHERE name='$name_product'");
               $fetch_product_quantity= mysqli_fetch_assoc($product_quantity);
               $nums= $fetch_product_quantity['quantity']-$fetch_quantity['quantity'];//số lượng đồ chơi còn lại
               mysqli_query($conn, "UPDATE `products` SET quantity='$nums' WHERE name='$name_product'");//cập nhật số lượng đồ chơi
            }
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');//xóa đồ chơi trong giỏ sau khi đặt thành công
         }
      }else{
         $message[] = 'Giỏ hàng của bạn trống, không thể đặt hàng!';
      }
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Thanh toán</h3>
   <p> <a href="home.php">Trang chủ</a> / Thanh toán </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
            $grand_total += $total_price;
   ?>
               <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo $fetch_cart['price'].' VND'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
         }
      }else{
         echo '<p class="empty">Giỏ hàng của bạn trống!</p>';
      }
   ?>
   <div class="grand-total"> Tổng số tiền : <span><?php echo $grand_total; ?> VND</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Nhập thông tin đơn hàng</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Họ tên:</span>
            <input type="text" name="name" required placeholder="Nguyễn Văn A">
         </div>
         <div class="inputBox">
            <span>Số điện thoại :</span>
            <input type="number" name="number" required placeholder="0123456789">
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="email" required placeholder="abc@gmail.com">
         </div>
         <div class="inputBox">
            <span>Phương thức thanh toán :</span>
            <select name="method">
               <option value="Tiền mặt khi nhận hàng">Tiền mặt khi nhận hàng</option>
               <option value="Thẻ ngân hàng">Thẻ ngân hàng</option>
               <option value="Paypal">Paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Địa chỉ :</span>
            <input type="text" name="street" required placeholder="Số nhà, số đường, phường/xã, huyện/thị xã">
         </div>
         <div class="inputBox">
            <span>Thành phố:</span>
            <input type="text" name="city" required placeholder="Hà Nội">
         </div>
         <div class="inputBox">
            <span>Nước :</span>
            <input type="text" name="country" required placeholder="Việt Nam">
         </div>
         <div class="inputBox">
            <span>Ghi chú:</span>
            <input type="text" name="note" required placeholder="Lời nhắn">
         </div>
      </div>
      <input type="submit" value="Đặt hàng" class="btn" name="order_btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>