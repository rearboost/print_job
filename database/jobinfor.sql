-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2021 at 02:20 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobinfor`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Basic Package'),
(2, 'Starter Package'),
(3, 'Business Package'),
(4, 'Single side'),
(5, 'Double side'),
(6, 'Half fold'),
(7, 'Tri fold'),
(8, 'Z fold'),
(9, 'Gate fold'),
(10, 'Booklet'),
(11, 'Desk calender'),
(12, 'Wall calender'),
(13, 'Pocket calender');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `contact`, `address`) VALUES
(1, 'Amali senadheera', '071 7894578', 'No:01, kalutara north, kalutara');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `file`) VALUES
(0, 'Screen Shot 2018-04-25 at 1.30.39 AM.png'),
(0, '15632787411524804823dude24.png'),
(0, '16562265241524804862dude24.png');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_no` varchar(100) NOT NULL,
  `customer` varchar(400) NOT NULL,
  `channel` varchar(100) NOT NULL,
  `job_type` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `material` varchar(64) NOT NULL,
  `size` varchar(50) NOT NULL,
  `bind` varchar(50) NOT NULL,
  `colour` varchar(20) NOT NULL,
  `user_description` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `budget` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `discounted` decimal(10,2) NOT NULL,
  `ad_pay_amount` decimal(10,2) NOT NULL,
  `rest` decimal(10,2) NOT NULL,
  `admin_description` varchar(250) NOT NULL,
  `state` enum('request','design','production','reject','QA','complete','dispatch') NOT NULL,
  `accepted_by` varchar(100) NOT NULL,
  `checked_by` varchar(100) NOT NULL,
  `failed_reason` varchar(255) NOT NULL,
  `cash` decimal(10,2) NOT NULL,
  `change_amt` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `dispatch_day` varchar(100) NOT NULL,
  `dispatch_year` varchar(10) NOT NULL,
  `dispatch_month` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_no`, `customer`, `channel`, `job_type`, `product`, `category`, `material`, `size`, `bind`, `colour`, `user_description`, `date`, `quantity`, `budget`, `discount`, `discounted`, `ad_pay_amount`, `rest`, `admin_description`, `state`, `accepted_by`, `checked_by`, `failed_reason`, `cash`, `change_amt`, `payment`, `dispatch_day`, `dispatch_year`, `dispatch_month`) VALUES
(5, '', '234', '', '', '', '', 'sdfs', '', '', '#e93f33', 'fdgdg', '2018-04-23', '3423.00', '696.45', '18.00', '0.00', '10.00', '0.00', 'tert', 'complete', '', '', '', '0.00', '0.00', '650.00', '2018-05-03', '2018', '05'),
(6, '', '34', '', '', '', '', 'das', '', '', '234', 'dfs', '2018-04-19', '3242.00', '24.00', '242.00', '0.00', '42.00', '0.00', 'dsf', 'dispatch', '', 'admin@gmail.com', '', '0.00', '0.00', '0.00', '', '', ''),
(7, '', '435', '', '', '', '', 'dfs', '', '', 'sf', 'dfsf', '2018-04-03', '432.00', '324.00', '324.00', '0.00', '234.00', '0.00', 'fsdf', 'complete', '', '', '', '33000.00', '568.00', '32432.00', '2021-02-17', '2021', '02'),
(8, '', '435', '', '', '', '', 'dfsd', '', '', '#000000', 'fdgfd', '2018-04-10', '5.00', '5000.00', '0.00', '5000.00', '2000.00', '3000.00', 'dsfsf', 'QA', '', '', '', '3000.00', '0.00', '3000.00', '2021-02-24', '2021', '02'),
(9, '', '453', '', '', '', '', 'fds', '', '', 'hg', 'ghfg', '2018-04-24', '66.00', '4324.00', '42.00', '0.00', '423.00', '0.00', 'fsdds', 'complete', '', '', '', '0.00', '0.00', '0.00', '', '', ''),
(10, '', '564', '', '', '', '', 'dsfsd', '', '', '23', 'dasd', '2018-04-23', '1.00', '1250.00', '0.00', '1250.00', '250.00', '1000.00', '34234', 'dispatch', '', '', '', '1000.00', '0.00', '1000.00', '2021-02-24', '2021', '02'),
(11, '', '546', '', '', '', '', 'gfdg', '', '', '#000000', 'rtert', '2018-04-24', '5.00', '7500.00', '2.00', '7350.00', '0.00', '7350.00', 'dfg', 'dispatch', '', '', '', '0.00', '0.00', '0.00', '', '', ''),
(12, '', '234', '', '', '', '', 'sdfs', '', '', '#2048f6', 'fdgdg', '2018-04-23', '3423.00', '11.96', '12.00', '0.00', '10.00', '0.00', 'tert', 'complete', '', '', '', '0.00', '0.00', '34.00', '', '', ''),
(13, '', '0', '', '', '', '', 'Stainless Steel', '', '', '#000000', 'This notice by production', '2018-04-26', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'production', '', '', '', '0.00', '0.00', '0.00', '', '', ''),
(14, '', '0', '', '', '', '', '', '', '', '#e00b0b', 'This notice by designer.', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'design', '', '', '', '0.00', '0.00', '0.00', '', '', ''),
(15, '', '0', '', '', '', '', 'Aluminium', '', '', '#000000', '', '2018-04-26', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'Immediate', 'production', '', '', '', '0.00', '0.00', '0.00', '', '', ''),
(16, '20210203124503', 'Senanayaka', 'EXP', 'Design', 'xxx', 'xxx', 'Stainless Steels', 'xxx', 'Perfect', '#000000', '', '2018-04-30', '2.00', '5000.00', '5.00', '4750.00', '2500.00', '2250.00', 'Immediate', 'design', 'cashier', '', '', '0.00', '0.00', '0.00', '', '', ''),
(17, '', '0', '', '', '', '', 'Stainless Steel', '', '', '#000000', '', '2018-04-26', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'reject', '', '', '', '0.00', '0.00', '0.00', '', '', ''),
(18, '', '0', '', '', '', '', '', '', '', '#000000', '', '2018-04-26', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'request', '', '', '', '0.00', '0.00', '0.00', '', '', ''),
(19, '', 'Amal perera', '', '', '', '', 'Stainless Steel', '', '', '#000000', 'zdasd', '2018-04-26', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'request', '', '', '', '0.00', '0.00', '0.00', '', '', ''),
(20, '', 'amal peiris', '', '', '', '', 'Stainless Steel', '', '', '#000000', 'zdasd\\nThis notice by QA', '2018-04-26', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'QA', '', '', 'Not Quality.', '0.00', '0.00', '0.00', '', '', ''),
(21, '', '0', '', '', '', '', 'Stainless Steel', '', '', '#000000', 'zdasd', '2018-04-26', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'request', '', '', '', '0.00', '0.00', '0.00', '', '', ''),
(22, '', 'Hasitha', '', '', '', '', 'Stainless Steel', '', '', '#000000', '232', '2018-04-26', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'request', '', '', '', '0.00', '0.00', '0.00', '', '', ''),
(23, '', 'Hasitha', '', '', '', '', 'Plastic', '', '', '#000000', 'asda', '2018-04-26', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'request', '', '', '', '0.00', '0.00', '0.00', '', '', ''),
(24, '20210226020334am24', 'Rashini Amanda', 'EXP', 'Digital printing', 'Business card', 'Business package', 'mat card', 'small', 'None', 'red', '', '2021-02-25', '100.00', '10000.00', '2.00', '9800.00', '5000.00', '4800.00', 'Printed card with design.', 'request', 'admin@gmail.com', '', '', '0.00', '0.00', '0.00', '', '', ''),
(25, '20210226021306am25', 'Kavishka prabath', 'DIR', 'Design', 'Logo design', 'Simple Package', '', 'Medium', 'None', 'red', '', '2021-02-25', '1.00', '2500.00', '0.00', '2500.00', '1000.00', '1500.00', 'Design with source file.', 'request', 'designer@gmail.com', '', '', '0.00', '0.00', '0.00', '', '', ''),
(26, '20210226021633am26', 'Amali senadheera', 'EXP', 'Design', 'Business card', 'Business package', 'shine card', 'small', 'None', 'red', '', '2021-02-25', '150.00', '15000.00', '1.50', '14775.00', '6000.00', '8775.00', 'With design', 'request', 'designer@gmail.com', '', '', '0.00', '0.00', '0.00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_type`
--

CREATE TABLE `jobs_type` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_type`
--

INSERT INTO `jobs_type` (`id`, `type`) VALUES
(1, 'Design'),
(2, 'Digital printing'),
(3, 'Laser Printing'),
(4, 'Offset Printing'),
(5, 'Sublimation Printing'),
(6, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `noteinfor`
--

CREATE TABLE `noteinfor` (
  `id` int(11) NOT NULL,
  `jobid` int(11) NOT NULL,
  `pval` int(11) NOT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `noteinfor`
--

INSERT INTO `noteinfor` (`id`, `jobid`, `pval`, `note`) VALUES
(1, 9, 73, 'TEE'),
(2, 0, 39, 'HJHJ'),
(3, 0, 58, 'RTRT'),
(4, 9, 54, 'RTR'),
(5, 9, 47, 'TYTY'),
(6, 9, 38, 'UU'),
(7, 7, 63, 'Test'),
(8, 8, 28, 'Test'),
(9, 8, 19, 'Test1'),
(10, 8, 50, 'Test'),
(11, 8, 0, 'TYTYTY'),
(12, 8, 0, 'YUYUUU'),
(13, 8, 0, 'YIYUUU'),
(14, 8, 40, 'GHGG'),
(15, 8, 57, 'UIUI'),
(16, 8, 0, 'YUUUUUUU)))'),
(17, 12, 0, 'HJHJ'),
(18, 12, 71, 'Test 71'),
(19, 11, 60, 'TTTTUU'),
(20, 12, 63, 'TTT'),
(21, 5, 0, 'kk'),
(22, 5, 32, 'jjj'),
(23, 5, 11, 'oo');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`) VALUES
(1, 'Logo Design'),
(2, 'Business Card'),
(3, 'Flyer'),
(4, 'Broucher\r\n'),
(5, 'Ticket\r\n'),
(6, 'Poster\r\n'),
(7, 'Bookmark\r\n'),
(8, 'Greeting Card\r\n'),
(9, 'Menu Card\r\n'),
(10, 'Letter head\r\n'),
(11, 'Envelope\r\n'),
(12, 'ID Card\r\n'),
(13, 'Key Tag\r\n'),
(14, 'Magazine'),
(15, 'Invoice\r\n'),
(16, 'Notebook\r\n'),
(17, 'Calendar\r\n'),
(18, 'Company Profile\r\n'),
(19, 'Annual Report\r\n'),
(20, 'Wallpaper\r\n'),
(21, 'Backdrop\r\n'),
(22, 'Packaging\r\n'),
(23, 'Label\r\n'),
(24, 'Facebook post\r\n'),
(25, 'Youtube thumbnail\r\n'),
(26, 'E-Flyer\r\n'),
(27, 'Recipet\r\n'),
(28, 'Bill book\r\n'),
(29, 'Facebook Maintain\r\n'),
(30, 'A - Stand\r\n'),
(31, 'Banner\r\n'),
(32, 'Billboard\r\n'),
(33, 'Board sign\r\n'),
(34, 'Canvas Print\r\n'),
(35, 'Light board\r\n'),
(36, 'Magnet\r\n'),
(37, 'Name board\r\n'),
(38, 'Product Lable\r\n'),
(39, 'Pull - Up Banner\r\n'),
(40, 'Safety Sign\r\n'),
(41, 'Sticker\r\n'),
(42, 'Vehicle Branding\r\n'),
(43, 'X - Banner\r\n'),
(44, 'CD Covers\r\n\r\n'),
(45, 'Tags\r\n'),
(46, 'Mug\r\n'),
(47, 'Bottle\r\n'),
(48, 'T - Shirt\r\n'),
(49, 'Glass\r\n'),
(50, 'Souvenier\r\n'),
(51, 'Pen\r\n'),
(52, 'Pencil\r\n'),
(53, 'Wooden Item\r\n'),
(54, 'Magic Pillow\r\n'),
(55, 'Lanyard\r\n'),
(56, 'Sticker Cutting\r\n'),
(57, 'Acrylic Work\r\n'),
(58, 'Laser Engraving\r\n'),
(59, 'UV Printing\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 2, 5),
(6, 3, 4),
(7, 3, 5),
(8, 4, 6),
(9, 4, 7),
(10, 4, 8),
(11, 4, 9),
(12, 7, 4),
(13, 7, 5),
(14, 9, 6),
(15, 9, 7),
(16, 9, 8),
(17, 9, 9),
(18, 9, 10),
(19, 17, 11),
(20, 17, 12),
(21, 17, 13),
(22, 29, 1),
(23, 29, 2),
(24, 29, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `product_id`, `type_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 3),
(4, 2, 4),
(5, 3, 1),
(6, 3, 3),
(7, 3, 4),
(8, 4, 1),
(9, 4, 3),
(10, 4, 4),
(11, 5, 1),
(12, 5, 3),
(13, 5, 4),
(14, 6, 1),
(15, 6, 3),
(16, 6, 4),
(17, 7, 1),
(18, 7, 3),
(19, 7, 4),
(20, 8, 1),
(21, 8, 3),
(22, 8, 4),
(23, 9, 1),
(24, 9, 3),
(25, 9, 4),
(26, 10, 1),
(27, 10, 3),
(28, 10, 4),
(29, 11, 1),
(30, 11, 3),
(31, 11, 4),
(32, 12, 1),
(33, 13, 1),
(34, 14, 1),
(35, 14, 3),
(36, 14, 4),
(37, 15, 1),
(38, 16, 1),
(39, 16, 3),
(40, 16, 4),
(41, 17, 1),
(42, 17, 3),
(43, 17, 4),
(44, 18, 1),
(45, 18, 3),
(46, 18, 4),
(47, 19, 1),
(48, 19, 3),
(49, 19, 4),
(50, 20, 1),
(51, 20, 2),
(52, 21, 1),
(53, 21, 2),
(54, 22, 1),
(55, 22, 3),
(56, 22, 4),
(57, 23, 1),
(58, 23, 3),
(59, 23, 4),
(60, 24, 1),
(61, 25, 1),
(62, 26, 1),
(63, 27, 1),
(64, 27, 3),
(65, 27, 4),
(66, 28, 1),
(67, 28, 3),
(68, 28, 4),
(69, 29, 1),
(70, 30, 2),
(71, 31, 2),
(72, 32, 2),
(73, 33, 2),
(74, 34, 2),
(75, 35, 2),
(76, 36, 2),
(77, 37, 2),
(78, 38, 2),
(79, 39, 2),
(80, 40, 2),
(81, 41, 2),
(82, 42, 2),
(83, 43, 2),
(84, 44, 3),
(85, 45, 3),
(86, 45, 4),
(87, 46, 5),
(88, 47, 5),
(89, 48, 5),
(90, 49, 5),
(91, 50, 5),
(92, 51, 5),
(93, 52, 5),
(94, 53, 5),
(95, 54, 5),
(96, 55, 5),
(97, 56, 6),
(98, 57, 6),
(99, 58, 6),
(100, 59, 6);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `email`, `password`, `level`) VALUES
(1, 'admin@gmail.com', '698d51a19d8a121ce581499d7b701668', 1),
(2, 'user', '202cb962ac59075b964b07152d234b70', 3),
(3, 'cashier', '250cf8b51c773f3f8dc8b4be867a9a02', 2),
(4, 'designer@gmail.com', '83dffbf894f849e7975a69a2c24aca8b', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `description`, `url`) VALUES
(1, 'Admin', ''),
(2, 'Cashier', ''),
(3, 'Design', ''),
(4, 'Production', ''),
(5, 'QA', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_type`
--
ALTER TABLE `jobs_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noteinfor`
--
ALTER TABLE `noteinfor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `jobs_type`
--
ALTER TABLE `jobs_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `noteinfor`
--
ALTER TABLE `noteinfor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
