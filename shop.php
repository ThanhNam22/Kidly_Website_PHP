<?php

   include 'config.php';

   session_start();

   $user_id = $_SESSION['user_id']; //lấy id người dùng từ session

   if(!isset($user_id)){// session không tồn tại => quay lại trang đăng nhập
      header('location:login.php');
   }

   if(isset($_POST['add_to_cart'])){//thêm Đồ chơi vào giỏi hàng từ form submit name='add_to_cart'

      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];//lấy new_price
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];//số lượng từ box

      if($product_quantity==0){//kiểm tra số lượng Đồ chơi, nếu hết thông báo hết
         $message[] = 'Đồ chơi đã hết hàng!';
      }
      else{
         $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

         if(mysqli_num_rows($check_cart_numbers) > 0){//kiểm tra Đồ chơi có trong giỏ hàng chưa và tăng số lượng
            $result=mysqli_fetch_assoc($check_cart_numbers);
            $num=$result['quantity']+$product_quantity;//số lượng đang có trong giỏ + số lượng muốn thêm
            $select_quantity = mysqli_query($conn, "SELECT * FROM `products` WHERE name='$product_name'");
            $fetch_quantity = mysqli_fetch_assoc($select_quantity);
            if($num>$fetch_quantity['quantity']){//nếu lớn hơn tổng số lượng Đồ chơi đó thì set = tối đa
               $num=$fetch_quantity['quantity'];
            }
            mysqli_query($conn, "UPDATE `cart` SET quantity = '$num', price = '$product_price' WHERE name = '$product_name' AND user_id = '$user_id'");
            $message[] = 'Đồ chơi đã có trong giỏ hàng và được thêm số lượng!';
         }else{//thêm Đồ chơi mới vào giỏ
            mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
            $message[] = 'Đồ chơi đã được thêm vào giỏ hàng!';
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
   <title>Cửa hàng</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Cửa hàng</h3>
   <p> <a href="home.php">Trang chủ</a> / Cửa hàng </p>
</div>

<section class="products">

   <h1 class="title">Tất cả Đồ chơi</h1>

   <select class="sort-box" onchange="window.location = this.options[this.selectedIndex].value">
      <option>Sắp xếp</option>
      <option value="?field=id& sort=DESC">Đồ chơi mới nhất</option>
      <option value="?field=id& sort=ASC">Đồ chơi cũ nhất</option>
      <option value="?field=category, name& sort=ASC">Tăng dần theo thể loại</option>
      <option value="?field=category, name& sort=DESC">Giảm dần theo thể loại</option>
      <option value="?field=newprice& sort=ASC">Giá tăng dần</option>
      <option value="?field=newprice& sort=DESC">Giá giảm dần</option>
   </select>

   <div style="clear:both"></div>

   <div class="box-container">

      <?php  
         $select_num= mysqli_query($conn, "SELECT id FROM `products`");
         if(mysqli_num_rows($select_num) > 0){
            if(isset($_GET['field'])&&isset($_GET['sort'])){
               $field = $_GET['field'];
               $sort = $_GET['sort'];
               $oder = "ORDER BY ".$field." ".$sort;
            }else{
               $oder = "ORDER BY `id` DESC";
            }
            $select_products = mysqli_query($conn, "SELECT * FROM `products` ".$oder) or die('query failed');
            while($fetch_products = mysqli_fetch_assoc($select_products)){
                  ?>
                     <form action="" method="post" class="box">
                        <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="sub-name">Tác giả: <?php echo $fetch_products['author']; ?></div>
                           <div class="sub-name">Thể loại: <?php echo $fetch_products['category']; ?></div>
                           <div class="sub-name">Mô tả: <?php echo $fetch_products['describes']; ?></div>
                        <div class="price"><?php echo $fetch_products['newprice']; ?>/<span style="text-decoration-line:line-through; text-decoration-thickness: 2px; text-decoration-color: grey"><?php echo $fetch_products['price']; ?></span> VND (<?php echo $fetch_products['discount']; ?>% SL: <?php echo $fetch_products['quantity']; ?>)</div>
                        <input type="number" min="<?=($fetch_products['quantity']>0) ? 1:0 ?>" max="<?php echo $fetch_products['quantity']; ?>" name="product_quantity" value="<?=($fetch_products['quantity']>0) ? 1:0 ?>" class="qty">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_category" value="<?php echo $fetch_products['category']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['newprice']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
                     </form>
                  <?php
               }
         }else{
            echo '<p class="empty">Chưa có Đồ chơi được bán!</p>';
         }
      ?>
   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>