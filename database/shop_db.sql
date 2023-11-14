-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 18, 2023 lúc 05:19 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(109, 9, 'Xe tăng điều khiển từ xa HENGDE 338', 656100, 1, 'sp11.png'),
(110, 9, 'Xe Ô Tô Điều Khiển Từ Xa Biến Hình Robot', 134900, 1, 'sp10.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categorys`
--

CREATE TABLE `categorys` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `describes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categorys`
--

INSERT INTO `categorys` (`id`, `name`, `describes`) VALUES
(6, 'Đồ chơi xếp hình', 'Xếp hình bằng gỗ'),
(7, 'Ô tô đồ chơi', 'Xe đẩy'),
(8, 'Đồ chơi điều kiển', 'Điểu kiển từ xa'),
(9, 'Đồ chơi siêu nhân', 'Đồ chơi siêu nhân nhập vai vào siêu anh hùng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(10, 1, 'yuki', 'yuki@gmail.com', '00000000000', 'zxcvbnm,'),
(11, 9, 'Dương Thanh Nam', 'thanhnamd67@gmail.com', '04444', 'Những đồ chơi rất chất lượng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `note` varchar(100) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `note`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(25, 9, 'Dương Thanh Nam', '1', 'thanhnamd67@gmail.com', 'Tiền mặt khi nhận hàng', 'bac giang, gf, Việt Nam', 'gf', 'Đồ chơi trẻ em giá rẻ bảng xếp hình cho bé-1', 2081818, '05-06-2023', 'Đang xử lý'),
(26, 9, 'Dương Thanh Nam', '1', 'thanhnamd67@gmail.com', 'Tiền mặt khi nhận hàng', 'bac giang, gf, Việt Nam', 'd', 'Đồ chơi trẻ em giá rẻ bảng gỗ xếp hình cho bé-1', 180000, '05-06-2023', 'Hoàn thành'),
(27, 9, 'Nguyễn Văn B', '1', 'am@gmail.com', 'Thẻ ngân hàng', 'bac giang, gf, Việt Nam', 'Không', 'Đồ chơi trẻ em giá rẻ bảng xếp hình cho bé-3', 6245454, '06-06-2023', 'Chờ xác nhận'),
(28, 9, 'Dương Thanh Nam', '033333333', 'thanhnamd67@gmail.com', 'Tiền mặt khi nhận hàng', 'bac giang, gf, Việt Nam', 'ok', 'Bộ đồ chơi xếp hình lắp ráp siêu nhân-2', 678300, '09-06-2023', 'Chờ xác nhận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `discount` int(100) NOT NULL,
  `newprice` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `describes` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `author`, `category`, `price`, `discount`, `newprice`, `quantity`, `describes`, `image`) VALUES
(30, 'Đồ chơi trẻ em giá rẻ bảng xếp hình cho bé', 'Kidly', 'Đồ chơi xếp hình', 2313131, 10, 2081818, 16, 'Thích hợp sử dụng cho những trẻ từ 2 tuổi trở lên', 'screenshot_1664645784.png'),
(32, 'Bộ xếp hình nam châm Magna Tiles PEOPLE ', 'People toy company', 'Đồ chơi xếp hình', 2000000, 0, 2000000, 20, 'Miễn phí giao hàng toàn quốc, Đổi trả trong vòng 14 ngày', 'sp01.png'),
(33, 'Bộ đồ chơi xếp hình lắp ráp siêu nhân', 'People toy company', 'Đồ chơi xếp hình', 399000, 15, 339150, 111, 'Có thiết kế nhỏ gọn dễ thương nhưng rất mạnh mẽ  ', 'sp05.png'),
(34, 'Đồ chơi lắp ráp, xếp hình - Trực thăng chiến đấu', 'KN Toys shop', 'Đồ chơi xếp hình', 269000, 30, 188300, 193, 'Thương hiệu: QMAN Xuất xứ: Trung Quốc ', 'sp06.png'),
(35, 'Hộp 8 bộ đồ chơi lắp ráp Biệt đội cứu hỏa vòi rồng', 'Aesop Store', 'Đồ chơi xếp hình', 256000, 22, 199680, 92, 'Thương hiệu: QMAN Xuất xứ	Trung Quốc', 'sp07.png'),
(36, 'Đồ chơi lắp ráp Mô hình xe phóng tên lửa Qman 3215', 'QMAN', 'Đồ chơi xếp hình', 540000, 32, 367200, 57, 'cho trẻ 6 tuổi trở lên  Xe phóng tên lửa tạo thành ', 'sp08.png'),
(37, 'Đồ chơi xếp hình, lắp ráp - Siêu Robot khủng long Sura', 'QMAN', 'Đồ chơi xếp hình', 359000, 30, 251300, 22, 'Siêu Robot khủng long Sura (553 mảnh ghép) ', 'sp09.png'),
(38, 'Xe Ô Tô Điều Khiển Từ Xa Biến Hình Robot', 'OEM', 'Đồ chơi điều kiển', 190000, 29, 134900, 231, 'Ô tô điều khiển từ xa tích hợp âm thanh, ánh sáng', 'sp10.jpg'),
(39, 'Xe tăng điều khiển từ xa HENGDE 338', 'HENGDE', 'Đồ chơi điều kiển', 729000, 10, 656100, 65, 'Rộng 19cm Dài 25cm Cao 15cm', 'sp11.png'),
(40, 'Máy bay flycam 4 cánh Mini RH807 (Đồ chơi điều khiển)', 'No Brand', 'Đồ chơi điều kiển', 320000, 5, 304000, 342, 'Màu cam, xanh dương, đỏ, bạc', 'sp12.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(8, 'Dương Thanh Nam', 'thanhnamd67@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin'),
(9, 'bot', 'nam@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT cho bảng `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
