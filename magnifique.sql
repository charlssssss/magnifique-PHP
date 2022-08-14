-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2022 at 01:52 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magnifique`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `select_prod` varchar(10) NOT NULL,
  `product_img_path` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `product_id`, `quantity`, `select_prod`, `product_img_path`) VALUES
(88, 30, 'llp4', 1, 'selected', 'img/magnifique-items/lingerie-lounge/'),
(89, 11, 'llb1', 3, 'removed', 'img/magnifique-items/lingerie-lounge/');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `passwrd` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `firstname`, `lastname`, `address`, `phone`, `email`, `passwrd`) VALUES
(11, 'Juan', 'Dela Cruz', 'Cebu City', '09123121346', 'juandelacruz@gmail.com', '$2y$10$9kPEeWDsb5qKMCpSwBE98uNkxbvMUuu2cBzRTDVsnWIDy8TrJHSVS'),
(12, 'Sample', 'User', 'Sample City', '09123445671', 'sampleuser@gmail.com', '$2y$10$tfi8YV.Z/cGubHkfWVdrZOrK7tOrNudc5rjidQkFSsQyty61xes1O'),
(17, 'Ken Rave', 'Agtoto', 'Taga Mingla ', '09293102311', 'kenrave@tae.com', '$2y$10$KE5awVlaJVkzeUdAHjgYYuHuxSIAeZ88MiPk48YEIasW.3yMaDsBG'),
(30, 'Dalisay', 'Estio', 'Marawi City', '09069360170', 'cardod@gmail.com', '$2y$10$VaKwiJ.ij9/.vzwZH9c2RuGiDDkXkXW.GNRJERkDW/D4Q1KRi8p2W'),
(31, 'Charles', 'John', 'Bravo City', '09123444444', 'charles@gmail.com', '$2y$10$NDZoRwjYTQd5OtrPWBZfBew8dsh1q9lKAKDFUeRvLpg6NnKE7PU1e');

-- --------------------------------------------------------

--
-- Table structure for table `myorder`
--

CREATE TABLE `myorder` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address1` varchar(30) NOT NULL,
  `address2` varchar(30) NOT NULL,
  `address3` varchar(30) NOT NULL,
  `address4` varchar(30) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `item_qty` int(10) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myorder`
--

INSERT INTO `myorder` (`order_id`, `customer_id`, `firstname`, `lastname`, `phone`, `address1`, `address2`, `address3`, `address4`, `payment_method`, `item_qty`, `total`, `date`) VALUES
(72034084, 31, 'Charles', 'John', '09123444444', '123', 'Abra', 'Bucay', 'Tabunok', 'cod', 5, '4585.00', '2022-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `myorderdetail`
--

CREATE TABLE `myorderdetail` (
  `order_detail_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `product_img_path` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myorderdetail`
--

INSERT INTO `myorderdetail` (`order_detail_id`, `order_id`, `product_id`, `product_price`, `quantity`, `product_img_path`) VALUES
(10072, 72034084, 'acu1', '917.00', 5, 'img/magnifique-items/accessories/u1.webp');

--
-- Triggers `myorderdetail`
--
DELIMITER $$
CREATE TRIGGER `deleteMyOrder` AFTER DELETE ON `myorderdetail` FOR EACH ROW begin
   Delete from myorder where item_qty = 0;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateMyOrder` AFTER DELETE ON `myorderdetail` FOR EACH ROW begin
update myorder
set item_qty = item_qty - old.quantity
where order_id = old.order_id;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` varchar(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image_1` varchar(20) NOT NULL,
  `product_image_2` varchar(20) NOT NULL,
  `product_image_3` varchar(20) NOT NULL,
  `product_image_4` varchar(20) NOT NULL,
  `product_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_image_1`, `product_image_2`, `product_image_3`, `product_image_4`, `product_type`) VALUES
('acb1', 'Reversible Wood Buckle Belt', '1476.00', 'b1.webp', 'b1-2.webp', 'b1-3.webp', 'b1-4.webp', 'Belts'),
('acb2', 'Steve Madden Women Multi D-Ring Keeper Belt', '1457.00', 'b2.webp', 'b2-2.webp', 'b2-3.webp', 'b2-4.webp', 'Belts'),
('acb3', 'Giani Bernini Embossed Logo Belt', '1381.00', 'b3.webp', 'b3-2.webp', 'b3-3.webp', 'b3-4.webp', 'Belts'),
('acb4', 'Calvin Klein Women Oval Center Bar Buckle Dress Belt', '1841.00', 'b4.webp', 'b4-2.webp', 'b4-3.webp', 'b4-4.webp', 'Belts'),
('acb5', 'Rebecca Minkoff 20mm Laced Chain Leather Belt', '2136.00', 'b5.webp', 'b5-2.webp', 'b5-3.webp', 'b5-4.webp', 'Belts'),
('achc1', 'INC International Concepts Striped-Brim Floppy Hat', '1860.00', 'hc1.webp', 'hc1-2.webp', 'hc1-3.webp', 'hc1-4.webp', 'Hats & Caps'),
('achc2', 'Nine West Crochet Insert Short Brim Floppy Hat', '1611.00', 'hc2.webp', 'hc2-2.webp', 'hc2-3.webp', 'hc2-4.webp', 'Hats & Caps'),
('achc3', 'RAHI Women Multi-Color Printed Cotton Sun Hat', '2629.00', 'hc3.webp', 'hc3-2.webp', 'hc3-3.webp', 'hc3-4.webp', 'Hats & Caps'),
('achc4', 'Jenni Washed Baseball Hat', '1150.00', 'hc4.webp', 'hc4-2.webp', 'hc4-3.webp', 'hc4-4.webp', 'Hats & Caps'),
('achc5', 'Sunday Afternoons Latitude Hat', '2416.00', 'hc5.webp', 'hc5-2.webp', 'hc5-3.webp', 'hc5-4.webp', 'Hats & Caps'),
('acs1', 'INC International Concepts Leopard-Print Square Scarf', '1068.00', 's1.webp', 's1-2.webp', 's1-3.webp', 's1-4.webp', 'Scarves'),
('acs2', 'Crinkle Wrap Scarf', '1265.00', 's2.webp', 's2-2.webp', 's2-3.webp', 's2-4.webp', 'Scarves'),
('acs3', 'Jenni On Repeat Jersey Wrap Scarf', '985.00', 's3.webp', 's3-2.webp', 's3-3.webp', 's3-4.webp', 'Scarves'),
('acs4', 'Tissue Print Wool & Cashmere Wrap Scarf', '2777.00', 's4.webp', 's4-2.webp', 's4-3.webp', 's4-4.webp', 'Scarves'),
('acs5', 'Tissue Weight Wool & Cashmere Scarf', '5556.00', 's5.webp', 's5-2.webp', 's5-3.webp', 's5-4.webp', 'Scarves'),
('acst1', 'Patterned Cotton Sports Socks', '5899.00', 'st1.webp', 'st1-2.webp', 'st1-3.webp', 'st1-4.webp', 'Socks & Tights'),
('acst2', 'Patterned Cotton Shoe Liners', '4899.00', 'st2.webp', 'st2-2.webp', 'st2-3.webp', 'st2-4.webp', 'Socks & Tights'),
('acst3', 'Age Defiance Control Top Pantyhose', '484.00', 'st3.webp', 'st3-2.webp', 'st3-3.webp', 'st3-4.webp', 'Socks & Tights'),
('acst4', 'French Lace Control Top Pantyhose', '484.00', 'st4.webp', 'st4-2.webp', 'st4-3.webp', 'st4-4.webp', 'Socks & Tights'),
('acst5', 'High Waist Tights with Control Top', '765.00', 'st5.webp', 'st5-2.webp', 'st5-3.webp', 'st5-4.webp', 'Socks & Tights'),
('acu1', 'Fashion Mates Mini Umbrella', '917.00', 'u1.webp', 'u1-2.webp', 'u1-3.webp', 'u1-4.webp', 'Umbrellas'),
('acu2', 'Watercolor Prints Mini Fashion Umbrella', '1099.00', 'u2.webp', 'u2-2.webp', 'u2-3.webp', 'u2-4.webp', 'Umbrellas'),
('acu3', 'Sun Storm Reverse Auto Open Umbrella', '1529.00', 'u3.webp', 'u3-2.webp', 'u3-3.webp', 'u3-4.webp', 'Umbrellas'),
('acu4', 'Storm Clouds Canopy Folding Umbrella', '968.00', 'u4.webp', 'u4-2.webp', 'u4-3.webp', 'u4-4.webp', 'Umbrellas'),
('acu5', 'Classic Tweed Auto Open Folding Umbrella', '968.00', 'u5.webp', 'u5-2.webp', 'u5-3.webp', 'u5-4.webp', 'Umbrellas'),
('llb1', 'Brown Fellucia Bra', '2500.00', 'b1.webp', 'b1-2.webp', 'b1-3.webp', 'b1-4.webp', 'Bras'),
('llb2', 'Ernest Leota Bra', '15500.00', 'b2.webp', 'b2-2.webp', 'b2-3.webp', 'b2-4.webp', 'Bras'),
('llb3', 'Khaite Bra', '5500.00', 'b3.webp', 'b3-2.webp', 'b3-3.webp', 'b3-4.webp', 'Bras'),
('llb4', 'Le Ore Bra', '10000.00', 'b4.webp', 'b4-2.webp', 'b4-3.webp', 'b4-4.webp', 'Bras'),
('llb5', 'Marysia Bra', '4500.00', 'b5.webp', 'b5-2.webp', 'b5-3.webp', 'b5-4.webp', 'Bras'),
('llls1', 'Cotton Jersey Lingerie Set', '12500.00', 'ls1.webp', 'ls1-2.webp', 'ls1-3.webp', 'ls1-4.webp', 'Lingerie Sets'),
('llls2', 'Olivia Von Halle Lingerie Set', '18000.00', 'ls2.webp', 'ls2-2.webp', 'ls2-3.webp', 'ls2-4.webp', 'Lingerie Sets'),
('llls3', 'Pima Cotton Lingerie Set', '5500.00', 'ls3.webp', 'ls3-2.webp', 'ls3-3.webp', 'ls3-4.webp', 'Lingerie Sets'),
('llls4', 'Silk Satin Lingerie Set', '15000.00', 'ls4.webp', 'ls4-2.webp', 'ls4-3.webp', 'ls4-4.webp', 'Lingerie Sets'),
('llls5', 'Sleeper Lingerie Set', '17500.00', 'ls5.webp', 'ls5-2.webp', 'ls5-3.webp', 'ls5-4.webp', 'Lingerie Sets'),
('llp1', 'Agent Provocateur Panty', '12500.00', 'p1.webp', 'p1-2.webp', 'p1-3.webp', 'p1-4.webp', 'Panties'),
('llp2', 'Coco De Mer Panty', '12000.00', 'p2.webp', 'p2-2.webp', 'p2-3.webp', 'p2-4.webp', 'Panties'),
('llp3', 'Isa Boulder Panty', '5500.00', 'p3.webp', 'p3-2.webp', 'p3-3.webp', 'p3-4.webp', 'Panties'),
('llp4', 'Matteu Panty', '10000.00', 'p4.webp', 'p4-2.webp', 'p4-3.webp', 'p4-4.webp', 'Panties'),
('llp5', 'Patbo Panty', '7500.00', 'p5.webp', 'p5-2.webp', 'p5-3.webp', 'p5-4.webp', 'Panties'),
('llsl1', 'Demure Chemise Sexy Lingerie', '15000.00', 'sl1.webp', 'sl1-2.webp', 'sl1-3.webp', 'sl1-4.webp', 'Sexy Lingerie'),
('llsl2', 'Dena Harness Sexy Lingerie', '18000.00', 'sl2.webp', 'sl2-2.webp', 'sl2-3.webp', 'sl2-4.webp', 'Sexy Lingerie'),
('llsl3', 'Lace Romper Sexy Lingerie', '15500.00', 'sl3.webp', 'sl3-2.webp', 'sl3-3.webp', 'sl3-4.webp', 'Sexy Lingerie'),
('llsl4', 'Oh La La Cheri Sexy Lingerie', '25000.00', 'sl4.webp', 'sl4-2.webp', 'sl4-3.webp', 'sl4-4.webp', 'Sexy Lingerie'),
('llsl5', 'Strappy Lace Sexy Lingerie', '15500.00', 'sl5.webp', 'sl5-2.webp', 'sl5-3.webp', 'sl5-4.webp', 'Sexy Lingerie'),
('llslw1', 'Desmond Dempsey Sleep & Loungewear', '15000.00', 'slw1.webp', 'slw1-2.webp', 'slw1-3.webp', 'slw1-4.webp', 'Sleep & Loungewear'),
('llslw2', 'Eberjey Sleep & Loungewear', '18000.00', 'slw2.webp', 'slw2-2.webp', 'slw2-3.webp', 'slw2-4.webp', 'Sleep & Loungewear'),
('llslw3', 'Jacques Sleep & Loungewear', '15500.00', 'slw3.webp', 'slw3-2.webp', 'slw3-3.webp', 'slw3-4.webp', 'Sleep & Loungewear'),
('llslw4', 'La Perla Sleep & Loungewear', '25000.00', 'slw4.webp', 'slw4-2.webp', 'slw4-3.webp', 'slw4-4.webp', 'Sleep & Loungewear'),
('llslw5', 'Rails Sleep & Loungewear', '15500.00', 'slw5.webp', 'slw5-2.webp', 'slw5-3.webp', 'slw5-4.webp', 'Sleep & Loungewear'),
('wbb1', 'Charles Backpack Model 1', '2500.00', 'b1.PNG', 'b1-2.PNG', 'b1-3.PNG', 'b1-4.PNG', 'Backpacks'),
('wbb2', 'Charles Backpack Model 2', '3000.00', 'b2.PNG', 'b2-2.PNG', 'b2-3.PNG', 'b2-4.PNG', 'Backpacks'),
('wbb3', 'Charles Backpack Model 3', '3500.00', 'b3.PNG', 'b3-2.PNG', 'b3-3.PNG', 'b3-4.PNG', 'Backpacks'),
('wbb4', 'Charles Backpack Model 4', '1500.00', 'b4.PNG', 'b4-2.PNG', 'b4-3.PNG', 'b4-4.PNG', 'Backpacks'),
('wbb5', 'Charles Backpack Model 5', '1000.00', 'b5.PNG', 'b5-2.PNG', 'b5-3.PNG', 'b5-4.PNG', 'Backpacks'),
('wbc1', 'Charles Clutches Model 1', '1500.00', 'c1.PNG', 'c1-2.PNG', 'c1-3.PNG', 'c1-4.PNG', 'Clutches'),
('wbc2', 'Charles Clutches Model 2', '4400.00', 'c2.PNG', 'c2-2.PNG', 'c2-3.PNG', 'c2-4.PNG', 'Clutches'),
('wbc3', 'Charles Clutches Model 3', '6000.00', 'c3.PNG', 'c3-2.PNG', 'c3-3.PNG', 'c3-4.PNG', 'Clutches'),
('wbc4', 'Charles Clutches Model 4', '1000.00', 'c4.PNG', 'c4-2.PNG', 'c4-3.PNG', 'c4-4.PNG', 'Clutches'),
('wbc5', 'Charles Clutches Model 5', '4500.00', 'c5.PNG', 'c5-2.PNG', 'c5-3.PNG', 'c5-4.PNG', 'Clutches'),
('wbtb1', 'Charles Tote Bag Model 1', '1400.00', 'tb1.PNG', 'tb1-2.PNG', 'tb1-3.PNG', 'tb1-4.PNG', 'Tote Bags'),
('wbtb2', 'Charles Tote Bag Model 2', '1400.00', 'tb2.PNG', 'tb2-2.PNG', 'tb2-3.PNG', 'tb2-4.PNG', 'Tote Bags'),
('wbtb3', 'Charles Tote Bag Model 3', '4400.00', 'tb3.PNG', 'tb3-2.PNG', 'tb3-3.PNG', 'tb3-4.PNG', 'Tote Bags'),
('wbtb4', 'Charles Tote Bag Model 4', '3400.00', 'tb4.PNG', 'tb4-2.PNG', 'tb4-3.PNG', 'tb4-4.PNG', 'Tote Bags'),
('wbtb5', 'Charles Tote Bag Model 5', '5000.00', 'tb5.PNG', 'tb5-2.PNG', 'tb5-3.PNG', 'tb5-4.PNG', 'Tote Bags'),
('wbthb1', 'Charles Top-Handle Model 1', '1500.00', 'thb1.PNG', 'thb1-2.PNG', 'thb1-3.PNG', 'thb1-4.PNG', 'Top-Handle Bags'),
('wbthb2', 'Charles Top-Handle Model 2', '4400.00', 'thb2.PNG', 'thb2-2.PNG', 'thb2-3.PNG', 'thb2-4.PNG', 'Top-Handle Bags'),
('wbthb3', 'Charles Top-Handle Model 3', '6000.00', 'thb3.PNG', 'thb3-2.PNG', 'thb3-3.PNG', 'thb3-4.PNG', 'Top-Handle Bags'),
('wbthb4', 'Charles Top-Handle Model 4', '1000.00', 'thb4.PNG', 'thb4-2.PNG', 'thb4-3.PNG', 'thb4-4.PNG', 'Top-Handle Bags'),
('wbthb5', 'Charles Top-Handle Model 5', '4500.00', 'thb5.PNG', 'thb5-2.PNG', 'thb5-3.PNG', 'thb5-4.PNG', 'Top-Handle Bags'),
('wbw1', 'Charles Wristlet Model 1', '1500.00', 'w1.PNG', 'w1-2.PNG', 'w1-3.PNG', 'w1-4.PNG', 'Wristlets'),
('wbw2', 'Charles Wristlet Model 2', '4400.00', 'w2.PNG', 'w2-2.PNG', 'w2-3.PNG', 'w2-4.PNG', 'Wristlets'),
('wbw3', 'Charles Wristlet Model 3', '6000.00', 'w3.PNG', 'w3-2.PNG', 'w3-3.PNG', 'w3-4.PNG', 'Wristlets'),
('wbw4', 'Charles Wristlet Model 4', '1000.00', 'w4.PNG', 'w4-2.PNG', 'w4-3.PNG', 'w4-4.PNG', 'Wristlets'),
('wbw5', 'Charles Wristlet Model 5', '4500.00', 'w5.PNG', 'w5-2.PNG', 'w5-3.PNG', 'w5-4.PNG', 'Wristlets'),
('wcd1', 'James Dress Model 1', '15000.00', 'd1.PNG', 'd1-2.PNG', 'd1-3.PNG', 'd1-4.PNG', 'Dress'),
('wcd2', 'James Dress Model 2', '18000.00', 'd2.PNG', 'd2-2.PNG', 'd2-3.PNG', 'd2-4.PNG', 'Dress'),
('wcd3', 'James Dress Model 3', '15500.00', 'd3.PNG', 'd3-2.PNG', 'd3-3.PNG', 'd3-4.PNG', 'Dress'),
('wcd4', 'James Dress Model 4', '25000.00', 'd4.PNG', 'd4-2.PNG', 'd4-3.PNG', 'd4-4.PNG', 'Dress'),
('wcd5', 'James Dress Model 5', '15500.00', 'd5.PNG', 'd5-2.PNG', 'd5-3.PNG', 'd5-4.PNG', 'Dress'),
('wchs1', 'James Hoodie Model 1', '15000.00', 'hs1.PNG', 'hs1-2.PNG', 'hs1-3.PNG', 'hs1-4.PNG', 'Hoodies & Sweatshirts'),
('wchs2', 'James Hoodie Model 2', '18000.00', 'hs2.PNG', 'hs2-2.PNG', 'hs2-3.PNG', 'hs2-4.PNG', 'Hoodies & Sweatshirts'),
('wchs3', 'James Hoodie Model 3', '15500.00', 'hs3.PNG', 'hs3-2.PNG', 'hs3-3.PNG', 'hs3-4.PNG', 'Hoodies & Sweatshirts'),
('wchs4', 'James Hoodie Model 4', '25000.00', 'hs4.PNG', 'hs4-2.PNG', 'hs4-3.PNG', 'hs4-4.PNG', 'Hoodies & Sweatshirts'),
('wchs5', 'James Hoodie Model 5', '15500.00', 'hs5.PNG', 'hs5-2.PNG', 'hs5-3.PNG', 'hs5-4.PNG', 'Hoodies & Sweatshirts'),
('wcj1', 'Kaiser Jeans Model 1', '15000.00', 'j1.PNG', 'j1-2.PNG', 'j1-3.PNG', 'j1-4.PNG', 'Jeans'),
('wcj2', 'Kaiser Jeans Model 2', '18000.00', 'j2.PNG', 'j2-2.PNG', 'j2-3.PNG', 'j2-4.PNG', 'Jeans'),
('wcj3', 'Kaiser Jeans Model 3', '15500.00', 'j3.PNG', 'j3-2.PNG', 'j3-3.PNG', 'j3-4.PNG', 'Jeans'),
('wcj4', 'Kaiser Jeans Model 4', '25000.00', 'j4.PNG', 'j4-2.PNG', 'j4-3.PNG', 'j4-4.PNG', 'Jeans'),
('wcj5', 'Kaiser Jeans Model 5', '15500.00', 'j5.PNG', 'j5-2.PNG', 'j5-3.PNG', 'j5-4.PNG', 'Jeans'),
('wcjc1', 'Kaiser Jacket Model 1', '15000.00', 'jc1.PNG', 'jc1-2.PNG', 'jc1-3.PNG', 'jc1-4.PNG', 'Jackets & Coats'),
('wcjc2', 'Kaiser Jacket Model 2', '18000.00', 'jc2.PNG', 'jc2-2.PNG', 'jc2-3.PNG', 'jc2-4.PNG', 'Jackets & Coats'),
('wcjc3', 'Kaiser Jacket Model 3', '15500.00', 'jc3.PNG', 'jc3-2.PNG', 'jc3-3.PNG', 'jc3-4.PNG', 'Jackets & Coats'),
('wcjc4', 'Kaiser Jacket Model 4', '25000.00', 'jc4.PNG', 'jc4-2.PNG', 'jc4-3.PNG', 'jc4-4.PNG', 'Jackets & Coats'),
('wcjc5', 'Kaiser Jacket Model 5', '15500.00', 'jc5.PNG', 'jc5-2.PNG', 'jc5-3.PNG', 'jc5-4.PNG', 'Jackets & Coats'),
('wct1', 'Kaiser Top Model 1', '15000.00', 't1.PNG', 't1-2.PNG', 't1-3.PNG', 't1-4.PNG', 'Tops'),
('wct2', 'Kaiser Top Model 2', '18000.00', 't2.PNG', 't2-2.PNG', 't2-3.PNG', 't2-4.PNG', 'Tops'),
('wct3', 'Kaiser Top Model 3', '15500.00', 't3.PNG', 't3-2.PNG', 't3-3.PNG', 't3-4.PNG', 'Tops'),
('wct4', 'Kaiser Top Model 4', '25000.00', 't4.PNG', 't4-2.PNG', 't4-3.PNG', 't4-4.PNG', 'Tops'),
('wct5', 'Kaiser Top Model 5', '15500.00', 't5.PNG', 't5-2.PNG', 't5-3.PNG', 't5-4.PNG', 'Tops'),
('wsff1', 'Hush Puppies Flip Flops', '1500.00', 'sff1.PNG', 'sff1-2.PNG', 'sff1-3.PNG', 'sff1-4.PNG', 'Slides & Flip Flops'),
('wsff2', 'London Rag Slides', '1800.00', 'sff2.PNG', 'sff2-2.PNG', 'sff2-3.PNG', 'sff2-4.PNG', 'Slides & Flip Flops'),
('wsff3', 'Otto Slides', '1500.00', 'sff3.PNG', 'sff3-2.PNG', 'sff3-3.PNG', 'sff3-4.PNG', 'Slides & Flip Flops'),
('wsff4', 'Penshoppe Flip Flops', '2500.00', 'sff4.PNG', 'sff4-2.PNG', 'sff4-3.PNG', 'sff4-4.PNG', 'Slides & Flip Flops'),
('wsff5', 'Supurga Flip Flops', '5800.00', 'sff5.PNG', 'sff5-2.PNG', 'sff5-3.PNG', 'sff5-4.PNG', 'Slides & Flip Flops'),
('wsfs1', 'About a Girl Flat Shoes', '2000.00', 'fs1.PNG', 'fs1-2.PNG', 'fs1-3.PNG', 'fs1-4.PNG', 'Flat Shoes'),
('wsfs2', 'Aerosoles Sandals', '2800.00', 'fs2.PNG', 'fs2-2.PNG', 'fs2-3.PNG', 'fs2-4.PNG', 'Flat Shoes'),
('wsfs3', 'ALDO Sandals', '15500.00', 'fs3.PNG', 'fs3-2.PNG', 'fs3-3.PNG', 'fs3-4.PNG', 'Flat Shoes'),
('wsfs4', 'Janylin Sandals', '2570.00', 'fs4.PNG', 'fs4-2.PNG', 'fs4-3.PNG', 'fs4-4.PNG', 'Flat Shoes'),
('wsfs5', 'Zanea Flat Shoes', '7500.00', 'fs5.PNG', 'fs5-2.PNG', 'fs5-3.PNG', 'fs5-4.PNG', 'Flat Shoes'),
('wsh1', 'Carmelletes Heels', '1500.00', 'h1.PNG', 'h1-2.PNG', 'h1-3.PNG', 'h1-4.PNG', 'Heels'),
('wsh2', 'Kimmijim Heels', '2800.00', 'h2.PNG', 'h2-2.PNG', 'h2-3.PNG', 'h2-4.PNG', 'Heels'),
('wsh3', 'London Rag Heels', '1550.00', 'h3.PNG', 'h3-2.PNG', 'h3-3.PNG', 'h3-4.PNG', 'Heels'),
('wsh4', 'Mango Heels', '2500.00', 'h4.PNG', 'h4-2.PNG', 'h4-3.PNG', 'h4-4.PNG', 'Heels'),
('wsh5', 'Trendyol Heels', '1500.00', 'h5.PNG', 'h5-2.PNG', 'h5-3.PNG', 'h5-4.PNG', 'Heels'),
('wssa1', 'Alberto Sandals', '6500.00', 'sa1.PNG', 'sa1-2.PNG', 'sa1-3.PNG', 'sa1-4.PNG', 'Sandals'),
('wssa2', 'ALDO Sandals', '6800.00', 'sa2.PNG', 'sa2-2.PNG', 'sa2-3.PNG', 'sa2-4.PNG', 'Sandals'),
('wssa3', 'H _ H Sandals', '1550.00', 'sa3.PNG', 'sa3-2.PNG', 'sa3-3.PNG', 'sa3-4.PNG', 'Sandals'),
('wssa4', 'Penshoppe Sandals', '5000.00', 'sa4.PNG', 'sa4-2.PNG', 'sa4-3.PNG', 'sa4-4.PNG', 'Sandals'),
('wssa5', 'Salt Water Sandals', '1500.00', 'sa5.PNG', 'sa5-2.PNG', 'sa5-3.PNG', 'sa5-4.PNG', 'Sandals'),
('wssn1', 'Houndstooth Emboos Old Skool Sneakers', '15000.00', 'sn1.PNG', 'sn1-2.PNG', 'sn1-3.PNG', 'sn1-4.PNG', 'Sneakers'),
('wssn2', 'Hummel St Power Play Mid Sneakers', '18000.00', 'sn2.PNG', 'sn2-2.PNG', 'sn2-3.PNG', 'sn2-4.PNG', 'Sneakers'),
('wssn3', 'Pop OTW Era Sneakers', '15500.00', 'sn3.PNG', 'sn3-2.PNG', 'sn3-3.PNG', 'sn3-4.PNG', 'Sneakers'),
('wssn4', 'Retro Sport Era Sneakers', '25000.00', 'sn4.PNG', 'sn4-2.PNG', 'sn4-3.PNG', 'sn4-4.PNG', 'Sneakers'),
('wssn5', 'Veja V-10 Flannel Sneakers', '15500.00', 'sn5.PNG', 'sn5-2.PNG', 'sn5-3.PNG', 'sn5-4.PNG', 'Sneakers');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `review` varchar(500) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `customer_id`, `product_id`, `review`, `rating`, `date`) VALUES
(21, 11, 'wbb1', 'I change my mind. Its 5 out of 5 baby!', 4, '2022-05-11'),
(22, 11, 'wbw1', 'sample edit comment lesgoogogo', 3, '2022-06-05'),
(23, 11, 'wbtb2', 'Sample comment wow nice bag by the way hello', 2, '2022-05-16'),
(24, 11, 'wbthb1', 'Nice top-handle bag! I like kit', 4, '2022-05-11'),
(25, 11, 'wbw2', 'Hello world hehehehehe hehe', 1, '2022-05-11'),
(28, 11, 'wbthb3', 'Sample comment on this item. Naysu', 3, '2022-05-12'),
(29, 11, 'wbtb3', '', 3, '2022-05-12'),
(30, 11, 'wsfs1', 'Hello sample flat shoes comment!', 4, '2022-05-12'),
(31, 11, 'wsff1', '', 5, '2022-05-12'),
(33, 11, 'wcj2', 'sample kaiser jeans model 2\r\n', 2, '2022-05-12'),
(35, 11, 'acs1', 'sample hello scarf', 4, '2022-05-12'),
(39, 11, 'llsl2', 'I love the model more than my life\r\n', 5, '2022-05-27'),
(50, 11, 'acst1', 'sample cotton sports socks comment! edited\r\n', 4, '2022-06-06'),
(57, 30, 'llp3', 'It\'s beautiful! It\'s very comfy! It fits very well!', 5, '2022-06-07'),
(58, 31, 'acu1', '', 4, '2022-08-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `myorder`
--
ALTER TABLE `myorder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `myorderdetail`
--
ALTER TABLE `myorderdetail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `myorderdetail`
--
ALTER TABLE `myorderdetail`
  MODIFY `order_detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10073;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `myorder`
--
ALTER TABLE `myorder`
  ADD CONSTRAINT `myorder_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `myorderdetail`
--
ALTER TABLE `myorderdetail`
  ADD CONSTRAINT `myorderdetail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `myorder` (`order_id`),
  ADD CONSTRAINT `myorderdetail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
