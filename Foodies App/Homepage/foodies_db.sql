-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 14, 2026 at 11:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodies_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `category` enum('Malay','Thai','Western') NOT NULL,
  `item_type` enum('food','drink') NOT NULL DEFAULT 'food'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `restaurant_id`, `name`, `description`, `price`, `image_url`, `category`, `item_type`) VALUES
(10, 1, 'Nasi Lemak Special', 'Fragrant coconut rice with sambal, egg and anchovies', 8.50, 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=400', 'Malay', 'food'),
(11, 1, 'Rendang Daging', 'Slow-cooked beef rendang with rich spiced gravy', 14.00, 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=400', 'Malay', 'food'),
(12, 1, 'Sayur Lodeh', 'Vegetables in a light coconut milk broth', 7.00, 'https://images.unsplash.com/photo-1547592180-85f173990554?w=400', 'Malay', 'food'),
(13, 1, 'Teh Tarik', 'Classic Malaysian pulled milk tea', 3.50, 'https://images.unsplash.com/photo-1571934811356-5cc061b6821f?w=400', 'Malay', 'drink'),
(14, 1, 'Air Bandung', 'Rose-flavoured milk drink', 3.00, 'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=400', 'Malay', 'drink'),
(15, 2, 'Ayam Goreng Berempah', 'Crispy spiced fried chicken, Malaysian style', 10.00, 'https://images.unsplash.com/photo-1598103442097-8b74394b95c2?w=400', 'Malay', 'food'),
(16, 2, 'Nasi Goreng Kampung', 'Village-style fried rice with anchovies and egg', 9.00, 'https://images.unsplash.com/photo-1603360946369-dc9bb6258143?w=400', 'Malay', 'food'),
(17, 2, 'Ikan Bakar', 'Grilled fish marinated in aromatic spices', 16.00, 'https://images.unsplash.com/photo-1559847844-5315695dadae?w=400', 'Malay', 'food'),
(18, 2, 'Sirap Limau', 'Rose syrup with fresh lime', 3.00, 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=400', 'Malay', 'drink'),
(19, 2, 'Milo Ais', 'Iced Milo chocolate malt drink', 3.50, 'https://images.unsplash.com/photo-1541167760496-1628856ab752?w=400', 'Malay', 'drink'),
(20, 3, 'Pad Thai', 'Classic stir-fried rice noodles with prawns and peanuts', 13.50, 'https://images.unsplash.com/photo-1559314809-0d155014e29e?w=400', 'Thai', 'food'),
(21, 3, 'Tom Yum Soup', 'Spicy and sour soup with mushrooms and lemongrass', 11.00, 'https://images.unsplash.com/photo-1562565652-a0d8f0c59eb4?w=400', 'Thai', 'food'),
(22, 3, 'Mango Sticky Rice', 'Sweet sticky rice with fresh mango slices', 8.00, 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400', 'Thai', 'food'),
(23, 3, 'Thai Iced Tea', 'Sweet orange Thai milk tea over ice', 5.00, 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400', 'Thai', 'drink'),
(24, 3, 'Coconut Water', 'Fresh young coconut water', 4.50, 'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=400', 'Thai', 'drink'),
(25, 4, 'Green Curry Chicken', 'Creamy Thai green curry with jasmine rice', 13.00, 'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=400', 'Thai', 'food'),
(26, 4, 'Som Tum Salad', 'Spicy green papaya salad with peanuts and dried shrimp', 10.00, 'https://images.unsplash.com/photo-1562565652-a0d8f0c59eb4?w=400', 'Thai', 'food'),
(27, 4, 'Basil Fried Rice', 'Thai basil fried rice with egg and chili', 12.00, 'https://images.unsplash.com/photo-1603360946369-dc9bb6258143?w=400', 'Thai', 'food'),
(28, 4, 'Lemongrass Juice', 'Fresh lemongrass with honey and lime', 4.00, 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=400', 'Thai', 'drink'),
(29, 4, 'Pandan Juice', 'Refreshing chilled pandan leaf drink', 3.50, 'https://images.unsplash.com/photo-1571934811356-5cc061b6821f?w=400', 'Thai', 'drink'),
(30, 5, 'Classic Beef Burger', 'Angus beef patty with cheddar, lettuce and secret sauce', 18.00, 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=400', 'Western', 'food'),
(31, 5, 'BBQ Chicken Steak', 'Grilled chicken with BBQ glaze and fries', 22.00, 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400', 'Western', 'food'),
(32, 5, 'Mushroom Swiss Burger', 'Beef patty with sauteed mushrooms and Swiss cheese', 20.00, 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=400', 'Western', 'food'),
(33, 5, 'Vanilla Milkshake', 'Thick and creamy vanilla milkshake', 7.00, 'https://images.unsplash.com/photo-1541167760496-1628856ab752?w=400', 'Western', 'drink'),
(34, 5, 'Fresh Lemonade', 'Homemade lemonade with mint', 5.50, 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=400', 'Western', 'drink'),
(35, 6, 'Spaghetti Carbonara', 'Creamy carbonara with beef rashers and mushrooms', 16.00, 'https://images.unsplash.com/photo-1551183053-bf91a1d81141?w=400', 'Western', 'food'),
(36, 6, 'Grilled Salmon Pasta', 'Penne with grilled salmon in white cream sauce', 19.00, 'https://images.unsplash.com/photo-1473093295043-cdd812d0e601?w=400', 'Western', 'food'),
(37, 6, 'Chicken Lasagna', 'Layered pasta with chicken bolognese and bechamel', 17.00, 'https://images.unsplash.com/photo-1548943487-a2e4e43b4853?w=400', 'Western', 'food'),
(38, 6, 'Sparkling Water', 'Chilled sparkling mineral water', 4.00, 'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=400', 'Western', 'drink'),
(39, 6, 'Iced Americano', 'Double shot espresso over ice', 6.50, 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400', 'Western', 'drink');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `total_price` decimal(8,2) DEFAULT NULL,
  `status` enum('Pending','Preparing','On the Way','Delivered') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` enum('Malay','Thai','Western') NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT 4.5,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `category`, `image_url`, `rating`, `description`) VALUES
(1, 'Nasi Lemak Antarabangsa', 'Malay', 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=400', 4.8, 'Authentic Malaysian comfort food'),
(2, 'Warung Pak Ali', 'Malay', 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=400', 4.5, 'Traditional Malay home-cooked meals'),
(3, 'Thai Orchid Kitchen', 'Thai', 'https://images.unsplash.com/photo-1559314809-0d155014e29e?w=400', 4.7, 'Authentic Thai street food experience'),
(4, 'Bangkok Bites', 'Thai', 'https://images.unsplash.com/photo-1562565652-a0d8f0c59eb4?w=400', 4.6, 'Bold Thai flavours in every bite'),
(5, 'The Grill House', 'Western', 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=400', 4.9, 'Premium burgers, steaks and more'),
(6, 'Pasta & Co.', 'Western', 'https://images.unsplash.com/photo-1551183053-bf91a1d81141?w=400', 4.4, 'Italian-Western fusion done right');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
