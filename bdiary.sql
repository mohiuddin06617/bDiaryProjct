-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2017 at 04:56 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdiary`
--

-- --------------------------------------------------------

--
-- Table structure for table `additionaluserinfo`
--

CREATE TABLE `additionaluserinfo` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `gender` int(11) NOT NULL,
  `address` varchar(40) NOT NULL,
  `country` int(11) NOT NULL,
  `web` varchar(40) NOT NULL,
  `position` varchar(30) NOT NULL,
  `bio` varchar(150) NOT NULL,
  `tagline` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foodmenu`
--

CREATE TABLE `foodmenu` (
  `foodMenuId` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `inserted_date` varchar(40) NOT NULL,
  `inserted_time` varchar(40) NOT NULL,
  `item_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foodmenu`
--

INSERT INTO `foodmenu` (`foodMenuId`, `manager_id`, `group_id`, `inserted_date`, `inserted_time`, `item_name`) VALUES
(39, 1, 6, '30/05/2017', 'Breakfast', 'chal dal'),
(40, 1, 6, '16/03/2017', 'Breakfast', 'fsdf'),
(41, 1, 6, '30/05/2017', 'Dinner', 'dasfsd'),
(42, 1, 6, '15/03/2017', 'Breakfast', 'fsdfgsd'),
(43, 1, 6, '12/03/2017', 'Breakfast', 'dasdasds'),
(44, 1, 6, '11/03/2017', 'Breakfast', 'asfsdgdfg'),
(45, 1, 6, '30/05/2017', 'Lunch', 'ruti'),
(46, 1, 6, '16/03/2017', 'Dinner', 'sdfgdgd'),
(47, 1, 6, '15/03/2017', 'Lunch', 'afsdfsd'),
(48, 1, 6, '15/03/2017', 'Dinner', 'dsfsdf'),
(49, 1, 6, '14/03/2017', 'Dinner', 'kicu na'),
(50, 1, 6, '14/03/2017', 'Lunch', 'ssdfsd'),
(51, 5, 12, '15/03/2017', 'Breakfast', 'pitha'),
(52, 5, 12, '15/03/2017', 'Breakfast', 'dal'),
(53, 5, 12, '15/03/2017', 'Lunch', 'kicu na '),
(54, 5, 12, '15/03/2017', 'Lunch', 'nai'),
(55, 5, 12, '03/13/2017', 'Lunch', 'dasdasd'),
(56, 5, 12, '09/03/2017', 'Breakfast', 'ruti 09'),
(57, 5, 12, '11/03/2017', 'Dinner', 'bhvdfvbxdfjvbdfjvb zdndfv'),
(58, 5, 12, '11/03/2017', 'Dinner', 'menu 2'),
(59, 1, 6, '12/04/2017', 'Lunch', 'dal'),
(60, 1, 6, '12/04/2017', 'Lunch', 'vaat'),
(61, 1, 6, '12/04/2017', 'Lunch', 'chicken'),
(62, 1, 6, '01/04/2017', 'Lunch', 'dal'),
(63, 1, 6, '01/04/2017', 'Dinner', 'vaat'),
(65, 1, 6, '26/07/2017', 'Breakfast', 'asada'),
(66, 1, 6, '26/07/2017', 'Breakfast', 'asada'),
(67, 1, 6, '27/07/2017', 'Lunch', 'asada'),
(68, 1, 6, '27/07/2017', 'Lunch', 'kdasknda'),
(69, 1, 6, '27/07/2017', 'Breakfast', 'dim'),
(70, 1, 6, '27/07/2017', 'Breakfast', 'alu vorta'),
(71, 1, 6, '27/07/2017', 'Dinner', 'dim'),
(72, 1, 6, '27/07/2017', 'Dinner', 'alu vorta'),
(73, 1, 6, '27/07/2017', 'Dinner', 'dal'),
(74, 1, 6, '27/07/2017', 'Lunch', 'Mangsho'),
(75, 1, 6, '27/07/2017', 'Lunch', 'Rui Mach'),
(76, 1, 6, '27/07/2017', 'Lunch', 'vaat'),
(77, 1, 6, '27/07/2017', 'Lunch', 'Dal'),
(78, 1, 6, '28/07/2017', 'Lunch', 'Mangsho'),
(79, 1, 6, '28/07/2017', 'Lunch', 'Rui Mach'),
(80, 1, 6, '28/07/2017', 'Lunch', 'vaat'),
(81, 1, 6, '28/07/2017', 'Lunch', 'Dal'),
(82, 1, 6, '04/07/2017', 'Breakfast', 'msdaosdao'),
(83, 1, 6, '30/06/2017', 'Lunch', 'vaat'),
(84, 1, 6, '30/06/2017', 'Lunch', 'rui'),
(85, 1, 6, '30/06/2017', 'Lunch', 'chingri vorta'),
(86, 1, 6, '07/07/2017', 'Breakfast', 'muri'),
(87, 1, 6, '07/07/2017', 'Breakfast', 'piyazu'),
(88, 1, 6, '03/07/2017', 'Lunch', 'vaat'),
(89, 1, 6, '03/07/2017', 'Lunch', 'chini'),
(90, 1, 6, '08/07/2017', 'Dinner', 'porotha'),
(91, 1, 6, '08/07/2017', 'Dinner', 'vaji');

-- --------------------------------------------------------

--
-- Table structure for table `groupdetails`
--

CREATE TABLE `groupdetails` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(40) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `total_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupdetails`
--

INSERT INTO `groupdetails` (`group_id`, `group_name`, `manager_id`, `total_member`) VALUES
(6, 'BLIFE', 1, 3),
(7, 'PEOPLES WORLD', 9, 0),
(8, 'AUVAGA BACHELOR', 4, 0),
(12, 'BACHELOR HOUSE', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groupotherdetails`
--

CREATE TABLE `groupotherdetails` (
  `table_id` int(11) NOT NULL,
  `house_address` varchar(255) NOT NULL,
  `maid_name` varchar(150) NOT NULL,
  `maid_phone` varchar(40) NOT NULL,
  `maid_address` varchar(255) NOT NULL,
  `group_description` text NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupotherdetails`
--

INSERT INTO `groupotherdetails` (`table_id`, `house_address`, `maid_name`, `maid_phone`, `maid_address`, `group_description`, `group_id`) VALUES
(1, 'House No-103,Bashiruddin Road kalabagan,Dhaka-1205', 'Unknown', '12424', 'kalabagan', 'sacssdvsdvcxvcxvxvxv', 6),
(2, '90 Kalabagan,2nd Lane,Dhaka-1205', 'UnKnown', '7546', 'Dhaka,Bangladesh', 'asnsdkjfnsdkjfbdsjkbvdjvjdbv jcxbvjdvbjsdbvdsj', 12);

-- --------------------------------------------------------

--
-- Table structure for table `mealstatus`
--

CREATE TABLE `mealstatus` (
  `user_id` int(11) NOT NULL,
  `answer` varchar(4) NOT NULL,
  `mealtime` varchar(10) NOT NULL,
  `mealentrytime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mealstatus`
--

INSERT INTO `mealstatus` (`user_id`, `answer`, `mealtime`, `mealentrytime`) VALUES
(8, 'yes', 'Dinner', '2017-01-12 14:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingpersonselection`
--

CREATE TABLE `shoppingpersonselection` (
  `id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `selected_person_id` int(11) NOT NULL,
  `selected_date` varchar(10) NOT NULL,
  `bazar_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoppingpersonselection`
--

INSERT INTO `shoppingpersonselection` (`id`, `manager_id`, `selected_person_id`, `selected_date`, `bazar_status`) VALUES
(1, 1, 2, '05/31/2017', 1),
(2, 1, 2, '05/30/2017', 1),
(7, 1, 8, '05/31/2017', 1),
(8, 1, 6, '2017-01-20', 0),
(9, 1, 8, '2017-01-27', 1),
(10, 1, 1, '2017-01-28', 1),
(11, 1, 8, '2017-01-31', 1),
(12, 1, 8, '2017-01-26', 0),
(13, 5, 3, '2017-01-13', 0),
(14, 1, 8, '2017-03-31', 1),
(15, 1, 7, '2017-03-30', 0),
(16, 1, 7, '2017-04-05', 0),
(17, 1, 8, '2017-04-06', 1),
(18, 1, 8, '2017-04-28', 1),
(19, 1, 8, '2017-04-29', 1),
(20, 1, 1, '2017-05-31', 0),
(21, 1, 8, '2017-05-30', 0),
(22, 1, 8, '2017-06-30', 0),
(23, 1, 7, '2017-06-28', 0),
(24, 1, 8, '2017-06-29', 0),
(25, 1, 1, '2017-06-01', 0),
(26, 1, 8, '2017-06-26', 0),
(27, 1, 8, '2017-06-27', 0),
(28, 1, 8, '2017-07-05', 0),
(29, 1, 8, '2017-07-04', 0),
(30, 1, 7, '2017-07-25', 0),
(31, 1, 1, '2017-06-22', 0),
(32, 1, 7, '2017-06-14', 0),
(33, 1, 7, '2017-06-20', 0),
(34, 1, 1, '2017-06-19', 0),
(35, 1, 1, '2017-06-18', 0),
(36, 1, 7, '2017-06-15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userdailycost`
--

CREATE TABLE `userdailycost` (
  `dailyCostTableId` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `entry_time_date` varchar(10) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `item_price` double NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `manager_response` int(11) NOT NULL DEFAULT '0',
  `auto_entry_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdailycost`
--

INSERT INTO `userdailycost` (`dailyCostTableId`, `user_id`, `group_id`, `manager_id`, `entry_time_date`, `item_name`, `item_price`, `quantity`, `manager_response`, `auto_entry_time`) VALUES
(1, 2, 6, 1, '01/07/2017', 'dal', 80, '2 kg', 0, '2017-07-01 12:19:34'),
(2, 2, 6, 1, '01/07/2017', 'chal', 150, '5kg', 0, '2017-07-01 12:19:34'),
(3, 2, 6, 1, '01/12/2017', 'new Item', 4, '0 Kg', 0, '2017-12-01 12:19:34'),
(4, 8, 6, 1, '01/04/2017', 'item1', 50, '1', 0, '2017-04-01 12:19:34'),
(5, 8, 6, 1, '01/12/2017', 'ht', 0, 'two', 0, '2017-12-01 12:19:34'),
(6, 8, 6, 1, '01/17/2017', 'item1', 50, '1', 0, '2017-01-17 12:19:34'),
(7, 8, 6, 1, '01/15/2017', 'm', 50, '2', 0, '2017-01-15 12:19:34'),
(8, 2, 12, 5, '01/23/2017', 'item1', 15, '1', 0, '2017-01-23 12:19:34'),
(9, 2, 12, 5, '01/24/2017', 'item2', 500, '5', 0, '2017-01-24 12:19:34'),
(10, 8, 6, 1, '04/28/2017', 'test on 25 april', 2500, '12', 0, '2017-04-28 12:19:34'),
(11, 8, 6, 1, '29/06/2017', 'chal', 50, '1 kg', 0, '2017-06-29 12:19:34'),
(12, 8, 6, 1, '29/06/2017', 'dal', 120, '2 kg', 0, '2017-06-29 12:19:34'),
(13, 8, 6, 1, '29/06/2017', 'morich', 120, '250 g', 0, '2017-06-29 12:19:34'),
(14, 0, 0, 0, '29/06/2017', 'm1', 4, '1 kg', 0, '2017-06-29 12:19:34'),
(15, 0, 0, 0, '29/06/2017', 'm2', 4, 'q2', 0, '2017-06-29 12:19:34'),
(16, 0, 0, 0, '29/06/2017', 'm3', 50, '2 g', 0, '2017-06-29 12:19:34'),
(17, 0, 0, 0, '29/06/2017', 'm4', 56, '200 ton', 0, '2017-06-29 12:19:34'),
(18, 0, 0, 0, '14/06/2017', 'sdcfsdf', 2, 'adfasf', 1, '2017-06-14 12:19:34'),
(24, 8, 6, 1, '30/06/2017', 'ice-cream', 400, '2 kg', 0, '2017-06-30 12:19:34'),
(25, 8, 6, 1, '19/06/2017', 'chanchur', 4, 'gd', 0, '2017-06-19 12:19:34'),
(26, 8, 6, 1, '21/06/2017', 'pitha', 25, '25 kg', 0, '2017-06-21 12:19:34'),
(27, 8, 6, 1, '28/06/2017', 'item 1', 250, '1 kg', 1, '2017-06-28 12:19:34'),
(28, 8, 6, 1, '11/07/2017', 'rice', 80, '2kg', 0, '2017-07-11 12:19:34'),
(29, 8, 6, 1, '11/07/2017', 'dal', 90, '5 kg', 0, '2017-07-11 12:19:34'),
(30, 8, 6, 1, '12/07/2017', 'oil', 150, '2 litre', 1, '2017-07-12 12:19:34'),
(31, 8, 6, 1, '12/07/2017', 'dim', 64, '2 hali', 1, '2017-07-12 12:19:34'),
(32, 8, 6, 1, '01/07/2017', 'chal', 50, '2 kg', 0, '2017-07-01 12:19:34'),
(33, 8, 6, 1, '01/07/2017', 'alu', 50, '5 kg', 0, '2017-07-01 12:19:34'),
(34, 8, 6, 1, '01/07/2017', 'choclate', 200, '5 piece', 0, '2017-07-01 12:19:34'),
(35, 8, 6, 1, '02/07/2017', 'abc', 80, '2 kd', 0, '2017-07-02 12:19:34'),
(36, 8, 6, 1, '02/07/2017', 'def', 345, '4 gd', 0, '2017-07-02 12:19:34'),
(37, 8, 6, 1, '02/07/2017', 'ghi', 56, '4 ksd', 0, '2017-07-02 12:19:34'),
(38, 8, 6, 1, '02/07/2017', 'mno', 463, '4 kj', 0, '2017-07-02 12:19:34'),
(39, 8, 6, 1, '02/07/2017', 'nj', 98, '3ok', 0, '2017-07-02 12:19:34'),
(40, 8, 6, 1, '13/07/2017', 'alu', 200, '4 kg', 0, '2017-07-04 18:55:31'),
(41, 8, 6, 1, '13/07/2017', 'chini', 100, '1 kg', 0, '2017-07-04 18:55:31'),
(42, 8, 6, 1, '13/07/2017', 'jira', 250, '5 kg', 0, '2017-07-04 18:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phoneNumber` int(30) NOT NULL,
  `accountCreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userGroupStatus` int(11) NOT NULL DEFAULT '0',
  `userStatus` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `firstName`, `lastName`, `email`, `password`, `phoneNumber`, `accountCreationDate`, `userGroupStatus`, `userStatus`, `group_id`) VALUES
(1, 'mohiuddin', 'ahmed', 'mohiuddin@gmail.com', '7e5563346fd028966775dcd2fa032b8e', 1679506617, '2016-12-26 07:12:22', 1, 1, 6),
(2, 'admin', 'panel', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 1940784485, '2016-12-26 07:12:22', 1, 0, 12),
(3, 'Pronay', 'Mazumdar', 'p9@gmail.com', '3818f7b0fd3ea20967b0d0246ccbac85', 1111111111, '2016-12-27 02:45:08', 1, 0, 12),
(4, 'Tarikul', 'Islam', 'tarikul@gmail.com', '6545bdd7cfc04cf2a4fa1762ea5411e2', 1111111111, '2016-12-27 02:45:08', 1, 1, 8),
(5, 'talha', 'khan', 'talha@gmail.com', 'af0ec2f0e3b0e4ba9635570fad7393b4', 194042019, '2016-12-27 19:01:32', 1, 1, 12),
(6, 'Mohiuddin', 'Ahmed3', 'mohiuddin3@gmail.com', '7e5563346fd028966775dcd2fa032b8e', 1679506617, '2016-12-28 02:30:42', 0, 0, 0),
(7, 'Mohiuddin', 'Ahmed4', 'mohiuddin4@gmail.com', '7e5563346fd028966775dcd2fa032b8e', 1679506617, '2016-12-28 02:33:35', 1, 0, 6),
(8, 'Sovan', 'Tuku', 'tuku@gmail.com', 'ce83b95e18d901e16fb55c3e34f9052d', 1552555045, '2017-01-06 09:27:47', 1, 0, 6),
(9, 'Rian', 'Ahmed', 'rian@gmail.com', '26ed30f28908645239254ff4f88c1b75', 2147483647, '2017-01-07 12:56:01', 0, 0, 0),
(10, 'sajib', 'pandey', 'sajib@gmail.com', '1622d00ad661038a57592db7959a1da8', 2147483647, '2017-01-12 07:36:44', 0, 0, 0),
(11, 'Mohiuddin', 'Ahmed', 'mohiuddin@yahoo.com', '7e5563346fd028966775dcd2fa032b8e', 0, '2017-04-07 10:30:02', 0, 0, 0),
(12, 'Tuku', 'Biswas', 'tuku@yahoo.com', 'ce83b95e18d901e16fb55c3e34f9052d', 1679506617, '2017-04-07 10:31:39', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usersociallinktable`
--

CREATE TABLE `usersociallinktable` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Facebook` varchar(100) NOT NULL,
  `Instagram` varchar(100) NOT NULL,
  `Linkedin` varchar(100) NOT NULL,
  `GooglePlus` varchar(100) NOT NULL,
  `Pinterest` varchar(100) NOT NULL,
  `snapchat` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additionaluserinfo`
--
ALTER TABLE `additionaluserinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foodmenu`
--
ALTER TABLE `foodmenu`
  ADD PRIMARY KEY (`foodMenuId`);

--
-- Indexes for table `groupdetails`
--
ALTER TABLE `groupdetails`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `groupotherdetails`
--
ALTER TABLE `groupotherdetails`
  ADD PRIMARY KEY (`table_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `shoppingpersonselection`
--
ALTER TABLE `shoppingpersonselection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdailycost`
--
ALTER TABLE `userdailycost`
  ADD PRIMARY KEY (`dailyCostTableId`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `usersociallinktable`
--
ALTER TABLE `usersociallinktable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additionaluserinfo`
--
ALTER TABLE `additionaluserinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foodmenu`
--
ALTER TABLE `foodmenu`
  MODIFY `foodMenuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `groupdetails`
--
ALTER TABLE `groupdetails`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `groupotherdetails`
--
ALTER TABLE `groupotherdetails`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shoppingpersonselection`
--
ALTER TABLE `shoppingpersonselection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `userdailycost`
--
ALTER TABLE `userdailycost`
  MODIFY `dailyCostTableId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usersociallinktable`
--
ALTER TABLE `usersociallinktable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
