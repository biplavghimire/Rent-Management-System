-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2022 at 03:22 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flatrent_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--
create database flatrent_db;
use flatrent_db;

CREATE TABLE `admins` (
  `a_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `ur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`a_id`, `email`, `username`, `password`, `ur_id`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bid` int(11) NOT NULL,
  `c_uid` int(11) DEFAULT NULL,
  `c_fullname` varchar(50) NOT NULL,
  `c_phone` varchar(10) NOT NULL,
  `h_id` int(11) DEFAULT NULL,
  `w_id` int(11) NOT NULL,
  `h_location` varchar(30) NOT NULL,
  `h_phone` varchar(10) NOT NULL,
  `h_book` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bid`, `c_uid`, `c_fullname`, `c_phone`, `h_id`, `w_id`, `h_location`, `h_phone`, `h_book`) VALUES
(69, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(70, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(71, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(72, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(73, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(74, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(75, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(76, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(77, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(78, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(79, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(80, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(81, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(82, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(83, 19, 'John Doe', '4545454554', 27, 3, 'Laborum Voluptatem ', '2222222222', 0),
(84, 19, 'John Doe', '4545454554', 28, 19, 'Nesciunt qui sit es', '1212121212', 0),
(85, 19, 'John Doe', '4545454554', 28, 19, 'Nesciunt qui sit es', '1212121212', 0),
(86, 23, 'Raja', '9812345670', 30, 19, 'Nesciunt qui sit es', '1212121212', 0),
(87, 23, 'Raja', '9812345670', 30, 19, 'Nesciunt qui sit es', '1212121212', 0),
(88, 23, 'Raja', '9812345670', 33, 24, 'Est quam consequatur', '9898989898', 1),
(89, 23, 'Raja', '9812345670', 33, 24, 'Est quam consequatur', '9898989898', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`firstname`, `lastname`, `email`, `phone`, `message`) VALUES
('raja', 'ram', 'raja@gmail.com', '9876543210', 'not working properly.'),
('Jillian', 'Hood', 'nugy@mailinator.com', '+1 (691) 8', 'Nulla incididunt exe');

-- --------------------------------------------------------

--
-- Table structure for table `houseinfo`
--

CREATE TABLE `houseinfo` (
  `h_id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `location` varchar(50) NOT NULL,
  `room_type` varchar(11) NOT NULL,
  `facility` varchar(40) NOT NULL,
  `price` varchar(11) NOT NULL,
  `description` varchar(110) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `date_submission` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `image` varchar(110) NOT NULL,
  `status` int(11) NOT NULL,
  `book` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `houseinfo`
--

INSERT INTO `houseinfo` (`h_id`, `uid`, `location`, `room_type`, `facility`, `price`, `description`, `phone`, `date_submission`, `image`, `status`, `book`) VALUES
(2, 14, 'Modi nisi earum quas', 'Flat', 'Water,Electicity,', '241', 'Quam facilis laboris', '1234567890', '2021-04-19 12:53:01.297433', '', 1, 1),
(3, 3, 'Itaque sed irure qui', 'Room', 'Water,Electicity,', '744', 'Exercitationem eveni', '9898989898', '2021-04-19 12:54:33.132323', '', 1, 1),
(4, 3, 'Impedit quasi ipsam', 'Room', 'Wifi,Parking,Water,Electicity,', '720', 'Atque qui ex perfere', '9865225221', '2021-07-10 06:50:15.670518', '', 1, 1),
(5, 3, 'Qui cupidatat nostru', 'House', 'Electicity,', '309', 'Ea expedita quia tot', '9865225221', '2021-04-19 12:56:36.661012', '', 1, 1),
(6, 3, 'Commodo officia ad n', 'Room', 'Parking,', '923', 'Corrupti aut consec', '9865225221', '2021-04-18 08:13:21.234300', '', 1, 1),
(7, 3, 'Debitis ipsam quaera', 'House', 'Parking,Water,Electicity,', '17', 'Officia eveniet del', '9865225221', '2021-04-18 07:32:16.769735', '', 1, 1),
(9, NULL, 'Fugiat sunt qui mol', 'Flat', 'Parking,Water,', '534', 'Illo quibusdam ea ad', '2323232323', '2021-08-31 07:24:27.728743', '11aside.jpg', 1, 1),
(10, 18, 'Voluptas in dignissi', 'House', 'Water,', '188', 'Consequatur voluptas', '1212121212', '2021-04-18 09:57:56.116563', '11aside.jpg', 1, 1),
(12, 18, 'Ex perferendis conse', 'House', 'Parking,Water,', '441', 'Cupidatat quia inven', '9999999999', '2021-04-19 12:50:14.738000', '', 1, 1),
(13, 21, 'Sequi velit fuga Q', 'Flat', 'Parking,Water,Electicity,', '932', 'Cumque est amet neq', '6666666666', '2021-04-19 16:21:43.582053', '', 1, 1),
(14, 21, 'Aut pariatur Volupt', 'House', 'Parking,Electicity,', '953', 'Non enim et velit of', '8888888888', '2021-04-19 16:48:30.588865', '', 1, 1),
(15, 22, 'Dolor harum cupidata', 'Flat', 'Water,', '444', 'Libero aute error en', '2222222222', '2021-04-19 17:11:12.630933', '', 1, 1),
(16, 21, 'Quos labore perspici', 'Room', 'Parking,', '595', 'Quisquam excepteur u', '5555555555', '2021-04-21 11:03:37.029201', '1200px-Hong_Kong_Harbour_Night_2019-06-11.jpg', 1, 1),
(17, 3, 'Et vel magnam eius i', 'House', 'Water,', '200', 'Nisi harum soluta mi', '1111111111', '2021-09-11 10:25:14.561650', 'photo-1588880331179-bc9b93a8cb5e.jpg', 1, 1),
(18, 21, 'Alias sequi laborum ', 'Flat', 'Wifi,Water,', '117', 'Eveniet voluptatum ', '2222222222', '2021-09-11 10:58:50.018737', '1200px-Hong_Kong_Harbour_Night_2019-06-11.jpg', 1, 1),
(19, 3, 'Baneshwor', 'Flat', 'Parking,Water,Electicity,', '25000', 'Consequat Eum exerc  is a free online platform for buying and selling Houses, Lands and everything Real Estate', '9865225221', '2021-09-11 14:15:55.317130', 'output-onlinepngtools.png', 1, 1),
(20, 21, 'old baneshwor', 'House', 'Wifi,Electicity,', '100000', ' is a free online platform for buying and selling Houses, Lands and everything Real Estate. We at dalaydai.com', '9855031900', '2021-09-11 14:15:28.529079', '—Pngtree—house quote lettering typography home_5317521.png', 1, 1),
(21, 21, 'bhaktapur', 'Room', 'Wifi,Parking,Water,Electicity,', '4000', 'Dolore aut ipsum do', '9867452312', '2021-09-11 14:58:55.846516', '1200px-Hong_Kong_Harbour_Night_2019-06-11.jpg', 1, 1),
(22, 21, 'Error asperiores rep', 'House', 'Water,Electicity,', '739', 'Ipsa ipsum omnis qu', '1212121212', '2021-09-11 14:29:48.812068', '11aside.jpg', 1, 1),
(23, 21, 'Dolore vitae aperiam', 'Room', 'Wifi,Water,', '839', 'Dolorum esse cumque', '2323232323', '2021-09-11 15:30:45.325312', 'valley.jpg', 1, 1),
(24, 21, 'Repellendus Ex moll', 'Room', 'Electicity,', '669', 'Consequatur eos ali', '5555555555', '2021-09-11 15:21:30.677807', 'd1651a17ce00ef495e0fa38d6271c724.jpg', 1, 1),
(25, 21, 'Tempor culpa dolor ', 'Flat', 'Wifi,Parking,Water,Electicity,', '825', 'Harum ea labore sunt', '3333333333', '2021-09-11 15:24:41.430977', '1200px-Hong_Kong_Harbour_Night_2019-06-11.jpg', 1, 1),
(27, 3, 'Voluptate aute commo', 'Flat', 'Parking,Electicity,', '279', 'Commodo sint provide', '1111111111', '2021-09-11 15:37:51.324796', 'bg-01.jpg', 1, 1),
(28, 3, 'Laborum Voluptatem ', 'Flat', 'Wifi,Water,Electicity,', '247', 'Delectus reprehende', '2222222222', '2021-09-21 10:49:33.632034', '1200px-Hong_Kong_Harbour_Night_2019-06-11.jpg', 1, 1),
(29, 19, 'Corporis sed et temp', 'Flat', 'Wifi,Parking,', '385', 'Excepturi unde in ve', '5555555555', '2021-09-11 15:58:19.886553', '1200px-Hong_Kong_Harbour_Night_2019-06-11.jpg', 1, 0),
(30, 19, 'Ut minus eligendi te', 'Flat', 'Wifi,Parking,Electicity,', '782', 'Est proident offici', '7777777777', '2021-09-22 03:11:10.221254', 'room1.jpg', 1, 1),
(31, 19, 'Qui eos autem labori', 'Flat', 'Parking,Electicity,', '167', 'Sint labore lorem t', '9999999999', '2021-09-11 15:58:26.056387', 'registration.jpg', 1, 0),
(32, 19, 'Nesciunt qui sit es', 'Room', 'Parking,', '557', 'Porro quia ullam lor', '1212121212', '2021-09-11 15:58:28.677012', 'photo-1588880331179-bc9b93a8cb5e.jpg', 1, 0),
(33, 24, 'Est quam consequatur', 'Flat', 'Wifi,Parking,Water,', '67', 'Eveniet debitis ani', '9898989898', '2021-09-22 03:17:12.888356', 'd1651a17ce00ef495e0fa38d6271c724.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(45) NOT NULL,
  `ur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `usertype`, `fullname`, `gender`, `phone`, `email`, `username`, `password`, `ur_id`) VALUES
(2, 'Customer', 'Rajaram Lamichhane', 'male', '9862354120', 'raja@gmail.com', 'raja', 'laude', 3),
(3, 'Owner', 'owner', 'male', '9856124514', 'owner@gmail.com', 'owner', 'owner', 2),
(14, 'Owner', 'sandip chudali', 'male', '9834971666', 'chudali@gmail.com', 'sandip', 'sandip', 2),
(16, 'Customer', 'Biplav Dahal', 'male', '2345234567', 'biplav@gmail.com', 'biplav', 'biplav', 3),
(17, 'Customer', 'rajesh lamichhane', 'male', '9869222101', 'rajesh@gmail.com', 'rajesh', 'rajesh', 3),
(18, 'Owner', 'dinesh', 'male', '7878342312', 'dinesh@gmail.com', 'dinesh', 'dinesh', 2),
(19, 'Customer', 'John Doe', 'male', '4545454554', 'customer@gmail.com', 'customer', 'customer', 3),
(21, 'Owner', 'Garrison Ware', 'female', '6666666666', 'liruw@mailinator.com', 'raja', 'raja', 2),
(22, 'Owner', 'Lewis Cunningham', 'male', '2222222222', 'meposajo@mailinator.com', 'bikash', 'bikash', 2),
(23, 'Customer', 'Raja', 'male', '9812345670', 'raja@gmail.com', 'raja', 'raja', 3),
(24, 'Owner', 'Declan Howard', 'female', '9876321234', 'xowe@mailinator.com', 'manish', 'manish', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `ur_id` int(11) NOT NULL,
  `role_name` varchar(25) NOT NULL,
  `role_desc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`ur_id`, `role_name`, `role_desc`) VALUES
(1, 'admin', 'All authority'),
(2, 'owner', 'Limited authority'),
(3, 'customer', 'Limited authority');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `ur_id` (`ur_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `uid` (`c_uid`),
  ADD KEY `h_id` (`h_id`);

--
-- Indexes for table `houseinfo`
--
ALTER TABLE `houseinfo`
  ADD PRIMARY KEY (`h_id`),
  ADD KEY `houseinfo_ibfk_1` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `ur_id` (`ur_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`ur_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `houseinfo`
--
ALTER TABLE `houseinfo`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `ur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`ur_id`) REFERENCES `user_roles` (`ur_id`);

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`c_uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`h_id`) REFERENCES `houseinfo` (`h_id`);

--
-- Constraints for table `houseinfo`
--
ALTER TABLE `houseinfo`
  ADD CONSTRAINT `houseinfo_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ur_id`) REFERENCES `user_roles` (`ur_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
