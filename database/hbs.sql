-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2025 at 02:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`id`, `admin_username`, `admin_pass`) VALUES
(1, 'admin', '1122');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `room_no` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `booking_id`, `room_name`, `price`, `total`, `room_no`, `user_name`, `contact`, `address`) VALUES
(32, 37, 'Supreme Deluxe ', 12000, 12000, NULL, 'Daniyal Hassan', '998989', 'Chatri chowk, KRL road, Khanna pull'),
(33, 38, 'Supreme Deluxe ', 12000, 24000, NULL, 'Daniyal Hassan', '998989', 'Chatri chowk, KRL road, Khanna pull'),
(34, 39, 'Deluxe Room ', 5000, 10000, NULL, 'Daniyal Hassan', '998989', 'Chatri chowk, KRL road, Khanna pull'),
(35, 40, 'Deluxe Room ', 5000, 10000, NULL, 'Muhammad Ayub ', '998989', '7901 4TH ST N STE 15023 ST PETERSBURG, FL 33702-4305\r\n62-8019301092-5'),
(36, 41, 'New Room ', 899, 899, NULL, 'Muhammad Ayub ', '998989', '7901 4TH ST N STE 15023 ST PETERSBURG, FL 33702-4305\r\n62-8019301092-5'),
(37, 42, 'Supreme Deluxe ', 12000, 24000, '222', 'Daniyal ', '998989', 'Chatri chowk, KRL road, Khanna pull, rwp'),
(38, 43, 'Deluxe Room ', 5000, 5000, '22334rrtr', 'Daniyal ', '998989', 'Chatri chowk, KRL road, Khanna pull, rwp'),
(39, 44, 'New Room ', 899, 1798, '222', 'DK Times', '998989', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore magni tenetur quae eius at molestiae cum aspernatur qui, sunt incidunt, maxime, voluptas vel minus recusandae harum dolores. Distinctio, ut fuga.'),
(40, 45, 'Deluxe Room ', 5000, 85000, NULL, 'DK Times', '998989', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore magni tenetur quae eius at molestiae cum aspernatur qui, sunt incidunt, maxime, voluptas vel minus recusandae harum dolores. Distinctio, ut fuga.'),
(41, 46, 'Deluxe Room ', 5000, 5000, 'GA121', 'Muhammad Sufiyan', '998989', '-'),
(42, 47, 'Supreme Deluxe ', 12000, 60000, NULL, 'Daniyal ', '998989', 'Chatri chowk, KRL road, Khanna pull, rwp'),
(43, 48, 'Deluxe Room ', 5000, 10000, NULL, 'Daniyal ', '998989', 'Chatri chowk, KRL road, Khanna pull, rwp'),
(44, 49, 'New Room ', 899, 8091, NULL, 'Zain ul abideen', '998989', 'islamabad');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(255) NOT NULL DEFAULT 'pending',
  `order_id` varchar(255) NOT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `trans_amount` int(11) NOT NULL,
  `trans_status` varchar(255) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` int(11) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `rate_review` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `trans_id`, `trans_amount`, `trans_status`, `trans_resp_msg`, `date_time`, `rate_review`) VALUES
(37, 25, 69, '2025-02-26', '2025-02-27', 0, 1, 'cancelled', 'ORD-3212', 'TRNS-918', 12000, 'done', 0, '2024-02-05 22:38:09', NULL),
(38, 25, 69, '2025-02-26', '2025-02-28', 1, NULL, 'active', 'ORD-8592', 'TRNS-314', 24000, 'done', 0, '2025-02-10 22:38:20', '2'),
(39, 25, 66, '2025-02-26', '2025-02-28', 0, 1, 'cancelled', 'ORD-6495', 'TRNS-157', 10000, 'done', 0, '2025-02-26 22:38:31', '1'),
(40, 26, 66, '2025-02-26', '2025-02-28', 1, NULL, 'active', 'ORD-5075', 'TRNS-221', 10000, 'done', 0, '2025-02-12 00:00:00', '1'),
(41, 26, 70, '2025-02-26', '2025-02-27', 0, NULL, 'cancelled', 'ORD-9525', 'TRNS-935', 899, 'done', 0, '1900-01-02 00:00:00', '1'),
(42, 25, 69, '2025-02-27', '2025-03-01', 0, 0, 'cancelled', 'ORD-2753', 'TRNS-268', 24000, 'done', 0, '2025-02-27 16:29:05', '2'),
(43, 25, 66, '2025-02-27', '2025-02-28', 1, NULL, 'active', 'ORD-9951', 'TRNS-814', 5000, 'done', 0, '2025-02-05 00:51:26', '2'),
(44, 27, 70, '2025-03-02', '2025-03-04', 1, NULL, 'active', 'ORD-2992', 'TRNS-371', 1798, 'done', 0, '2025-03-02 08:45:40', '1'),
(45, 27, 66, '2025-03-02', '2025-03-19', 0, NULL, 'active', 'ORD-2727', 'TRNS-120', 85000, 'done', 0, '2025-03-02 08:46:08', NULL),
(46, 28, 66, '2025-03-04', '2025-03-05', 1, NULL, 'active', 'ORD-1923', 'TRNS-210', 5000, 'done', 0, '2025-03-04 10:25:36', '2'),
(47, 25, 69, '2025-03-03', '2025-03-08', 0, 0, 'cancelled', 'ORD-2117', 'TRNS-951', 60000, 'done', 0, '2025-03-08 16:52:30', NULL),
(48, 25, 66, '2025-03-19', '2025-03-21', 0, NULL, 'active', 'ORD-2098', 'TRNS-672', 10000, 'done', 0, '2025-03-19 16:29:58', NULL),
(49, 29, 70, '2025-05-22', '2025-05-31', 0, NULL, 'active', 'ORD-3476', 'TRNS-405', 8091, 'done', 0, '2025-05-22 16:43:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `image`) VALUES
(31, 'img-1740888116.png'),
(32, 'img-1740888120.png'),
(35, 'img-1740892387.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pn1` varchar(255) NOT NULL,
  `pn2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tw` varchar(255) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `insta` varchar(255) NOT NULL,
  `tiktok` varchar(255) NOT NULL,
  `iframe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `address`, `pn1`, `pn2`, `email`, `tw`, `fb`, `insta`, `tiktok`, `iframe`) VALUES
(1, 'islamabad', '223341', '737373', 'wewqeq@gmail.com', '#', 'fjhsdk', 'dsdsd', 'jfshdkj', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3319.384039017896!2d73.06227717479744!3d33.69901023630111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfbf0030d552ed%3A0xdcaeb37156ebcb1e!2sHotel%20The%20Oriel%20Islamabad!5e0!3m2!1sen!2s!4v1729786316255!5m2!1sen!2s                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `descp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `image`, `descp`) VALUES
(11, 'Wifi', 'wifi.svg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit Est nemo aut corrupti odio possimus voluptas assumenda'),
(12, 'Massage', 'img-1739961686.svg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.Est nemo aut corrupti odio possimus voluptas assumenda'),
(13, 'TV', 'img-1739961698.svg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.Est nemo aut corrupti odio possimus voluptas assumenda'),
(14, 'Gyser', 'img-1739961721.svg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.Est nemo aut corrupti odio possimus voluptas assumenda'),
(15, 'Air Cooler', 'img-1739961735.svg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.Est nemo aut corrupti odio possimus voluptas assumenda'),
(16, 'AC', 'img-1739961746.svg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.Est nemo aut corrupti odio possimus voluptas assumenda');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(33, 'Bathroom'),
(34, 'Balcony'),
(35, 'Sofa'),
(36, 'kitchen');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `booking_id`, `room_id`, `user_id`, `rating`, `review`, `seen`, `date_time`) VALUES
(10, 40, 66, 26, 5, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore magni tenetur quae eius at molestiae cum aspernatur qui, sunt incidunt, maxime, voluptas vel minus recusandae harum dolores. Distinctio, ut fuga.', 0, '2025-03-01 06:49:23'),
(11, 42, 69, 25, 3, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore magni tenetur quae eius at molestiae cum aspernatur qui, sunt incidunt, maxime, voluptas vel minus recusandae harum dolores. Distinctio, ut fuga.', 0, '2025-03-01 06:50:34'),
(12, 38, 69, 25, 1, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore magni tenetur quae eius at molestiae cum aspernatur qui, sunt incidunt, maxime, voluptas vel minus recusandae harum dolores. Distinctio, ut fuga.', 0, '2025-03-01 06:51:55'),
(13, 43, 66, 25, 4, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore magni tenetur quae eius at molestiae cum aspernatur qui, sunt incidunt, maxime, voluptas vel minus recusandae harum dolores. Distinctio, ut fuga.', 0, '2025-03-01 06:53:31'),
(14, 46, 66, 28, 2, 'KEEP IT UP\r\n', 0, '2025-03-04 05:41:42'),
(15, 43, 66, 25, 4, 'dhsdghs', 0, '2025-05-22 11:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `descp` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `descp`, `status`) VALUES
(66, 'Deluxe Room ', 400, 5000, 3, 3, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi aliquid ipsa cum harum accusantium, reprehenderit neque blanditiis in quae iure doloremque vel, sequi veritatis unde a quod distinctio dolores corrupti?', 1),
(69, 'Supreme Deluxe ', 1200, 12000, 9, 7, 1, 'SELECT name FROM facilities \r\n                            INNER JOIN room_facilities\r\n                            ON facilities.id = room_facilities.room_id \r\n                            WHERE room_facilities.room_id = 67;', 1),
(70, 'New Room ', 400, 899, 4, 2, 1, 'lorem upsuim lorem upsuim lorem upsuim lorem upsuim lorem upsuim lorem upsuim lorem upsuim lorem upsuim lorem upsuim lorem upsuim lorem upsuim lorem upsuim ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_facilities` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`id`, `room_id`, `room_facilities`) VALUES
(235, 69, 14),
(236, 69, 14),
(251, 66, 11),
(252, 66, 13),
(253, 66, 11),
(254, 66, 13),
(255, 70, 13),
(256, 70, 14),
(257, 70, 13),
(258, 70, 14);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_features` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`id`, `room_id`, `room_features`) VALUES
(162, 69, 33),
(163, 69, 35),
(171, 66, 33),
(172, 66, 35),
(173, 70, 35),
(174, 70, 36);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`id`, `room_id`, `image`, `thumb`) VALUES
(69, 70, 'img-1740896633.jpg', 0),
(70, 70, 'img-1740896637.png', 0),
(71, 70, 'img-1740896641.png', 1),
(72, 69, 'img-1740896655.png', 0),
(73, 69, 'img-1740896658.png', 0),
(74, 69, 'img-1740896661.png', 1),
(75, 66, 'img-1740896673.jpg', 0),
(76, 66, 'img-1740896678.png', 1),
(77, 66, 'img-1740896684.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_about` varchar(255) NOT NULL,
  `shutdown` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_about`, `shutdown`) VALUES
(1, 'HOtel ', 'sufiyan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(26, 'John', 'img-1740833201.jpg'),
(27, 'David', 'img-1740833229.jpg'),
(29, 'Shabana', 'img-1740833291.jpeg'),
(30, 'JOHNY', 'img-1740888370.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(20) DEFAULT NULL,
  `token_expire` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `password`, `image`, `address`, `contact`, `pincode`, `dob`, `is_verified`, `token`, `token_expire`, `status`, `date_time`) VALUES
(25, 'Daniyal ', 'daniyalhassan1986@gmail.com', '$2y$10$4lUr0tPJHqM2N66r3uGpiOL1KtIT9kzR9rs8akmdPMIChmqTD9JY6', 'img-1740405559.jpg', 'Chatri chowk, KRL road, Khanna pull, rwp', '2222', 44000, '2025-02-11', 1, '16debf11726d8d6b', NULL, 1, '2025-02-24 18:59:24'),
(26, 'Muhammad Ayub ', 'ayub13228@gmail.com', '$2y$10$DAJcSImleRaMwxC7U8SuuOQFfXD075XliNh4IpjsPPF6mQ2EIPKZC', 'img-1740464713.jpg', '7901 4TH ST N STE 15023 ST PETERSBURG, FL 33702-4305\r\n62-8019301092-5', '112112211', 1122, '2005-05-15', 1, 'e311996a60462806', NULL, 1, '2025-02-25 11:25:18'),
(27, 'DK Times', 'dktimes1976@gmail.com', '$2y$10$91hnjYjjtu.H9EPYITjQ2ejVC9vAvtmTqbK8NYUO110rYe0FFYKGS', 'img-1740887053.jpg', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore magni tenetur quae eius at molestiae cum aspernatur qui, sunt incidunt, maxime, voluptas vel minus recusandae harum dolores. Distinctio, ut fuga.', '81928182', 99991, '2018-05-19', 1, 'd4a5366516baa456', NULL, 1, '2025-03-02 08:44:17'),
(28, 'Muhammad Sufiyan', 'muhammadsufiyan225@gmail.com', '$2y$10$MBI/xUUHJA84nlHysO.RvuCOG2jiZ1HIwH.Y3338.2v293ltTdWyK', 'img-1741065189.jpg', '-', '03121731374', 46000, '2003-09-06', 0, '7ab2a23df17f4caf', NULL, 0, '2025-03-04 10:13:14'),
(29, 'Zain ul abideen', 'zainulabideen1165@gmail.com', '$2y$10$EFirNIKZDDawKxIOZ57N.euTl8ZN/a4SSql7AldeRNYoMnKpzVGhK', 'img-1747914019.jpg', 'islamabad', '03115707837', 4600, '2025-05-20', 1, '13afe067de562dbd', NULL, 1, '2025-05-22 16:40:27'),
(30, 'Zain ul abideen', 'zainulabideen1165@gmail.com', '$2y$10$WeyKWpMVAgxge3j2jN2ND.8Y1akvxWVCvdqHcc/0bhZs/1eosqyjS', 'img-1747914027.jpg', 'islamabad', '03115707837', 4600, '2025-05-20', 0, 'cdacbc7c72873be2', NULL, 1, '2025-05-22 16:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`id`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(82, 'Daniyal Hassan', 'daniyalhassan1986@gmail.com', 'jhhjh', 'gjgjhgjh\r\n', '2025-02-26 16:07:13', 0),
(83, 'MUHAMMAD JAHANZEB AKRAM', 'sales@pjaabestore.com', 'Query ', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore magni tenetur quae eius at molestiae cum aspernatur qui, sunt incidunt, maxime, voluptas vel minus recusandae harum dolores. Distinctio, ut fuga.', '2025-03-02 03:42:14', 0),
(84, 'MUHAMMAD JAHANZEB AKRAM', 'sales@pjaabestore.com', 'ssssss', 'sakjdhaskd\r\n', '2025-03-02 05:47:54', 0),
(85, 'MUHAMMAD JAHANZEB AKRAM', 'sales@pjaabestore.com', 'gjgj', 'ghjgjg', '2025-03-02 05:52:59', 0),
(86, 'MUHAMMAD JAHANZEB AKRAM', 'sales@pjaabestore.com', 'guyg', 'gjgjh', '2025-03-02 05:53:11', 0),
(87, 'MUHAMMAD JAHANZEB AKRAM', 'sales@pjaabestore.com', 'hfkjhfekw', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore magni tenetur quae eius at molestiae cum aspernatur qui, sunt incidunt, maxime, voluptas vel minus recusandae harum dolores. Distinctio, ut fuga.', '2025-03-02 05:54:47', 0),
(88, 'MUHAMMAD JAHANZEB AKRAM', 'sales@pjaabestore.com', 'dkjsahk', 'hskjahda', '2025-03-02 05:55:28', 0),
(89, 'Daniyal Hassan', 'daniyalhassan1986@gmail.com', 'dsd', 'jdashkd', '2025-03-02 05:57:18', 0),
(90, 'MUHAMMAD JAHANZEB AKRAM', 'sales@pjaabestore.com', 'jadshk', 'sdasjd', '2025-03-02 05:58:36', 0),
(91, 'Daniyal Hassan', 'demo@gmail.com', 'subject', ', dolor sit amet consectetur adipisicing elit. Labore magni tenetur quae eius at molestiae cum aspernatur qui, sunt incidunt, maxime, voluptas vel minus recusandae harum dolores. Distinctio, ut fug', '2025-03-02 05:59:35', 0),
(92, 'MUHAMMAD JAHANZEB AKRAM', 'sales@pjaabestore.com', 'sdhkash', 'hkjsahdkaj', '2025-03-02 06:01:43', 0),
(93, 'MUHAMMAD JAHANZEB AKRAM', 'sales@pjaabestore.com', 'dsadh', 'hkshakj', '2025-03-02 06:02:12', 0),
(94, 'dasjh', 'jh@dfskdhk.com', 'hfsdkj', 'hkjsfhksd', '2025-03-02 06:02:43', 0),
(95, 'MUHAMMAD JAHANZEB AKRAM', 'sales@pjaabestore.com', 'adaks', 'jskjdansk', '2025-03-02 06:03:26', 0),
(96, 'MUHAMMAD JAHANZEB AKRAM', 'sales@pjaabestore.com', 'jkl', 'jlkj', '2025-03-02 06:04:33', 0),
(97, 'MUHAMMAD JAHANZEB AKRAM', 'sales@pjaabestore.com', 'ds', 'ds', '2025-03-02 06:06:18', 0),
(98, 'Daniyal Hassan', 'daniyalhassan1986@gmail.com', 'fhdsg', 'gdhsgfjs', '2025-03-04 04:36:25', 0),
(99, 'Daniyal Hassan', 'daniyalhassan1986@gmail.com', 'hgsdhgasjd', 'dshgjdgsj', '2025-05-22 11:33:22', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooom_id` (`room_id`),
  ADD KEY `room_facilities` (`room_facilities`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `room_features` (`room_features`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `room_facilities` FOREIGN KEY (`room_facilities`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rooom_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `room_features` FOREIGN KEY (`room_features`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
