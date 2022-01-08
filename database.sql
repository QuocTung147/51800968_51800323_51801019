-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2022 at 02:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chplay`
--
CREATE DATABASE IF NOT EXISTS `chplay` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `chplay`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `ID` char(6) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Firstname` varchar(50) DEFAULT NULL,
  `Lastname` varchar(50) DEFAULT NULL,
  `Avatar` varchar(255) DEFAULT 'default_avatar.jpg',
  `SDT` varchar(10) DEFAULT NULL,
  `DiaChi` varchar(100) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `SoDu` int(10) NOT NULL DEFAULT 0,
  `Activated` bit(1) NOT NULL DEFAULT b'0',
  `ActivateToken` varchar(50) DEFAULT NULL,
  `Email` varchar(60) NOT NULL,
  `Role` bit(1) NOT NULL DEFAULT b'0' COMMENT '1:dev, 0:user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ID`, `Username`, `Password`, `Firstname`, `Lastname`, `Avatar`, `SDT`, `DiaChi`, `Birthday`, `SoDu`, `Activated`, `ActivateToken`, `Email`, `Role`) VALUES
('#u002', 'user1', 'e10adc3949ba59abbe56e057f20f883e', 'Tôi là', 'User 01', NULL, '9999999', 'ggfhgfhfghfghfg', '2022-01-06', 0, b'1', '', 'user01@gmail.com', b'1'),
('#u003', 'user2', 'e10adc3949ba59abbe56e057f20f883e', 'User 2', 'Tôi Là', '', '', '', '0000-00-00', 0, b'1', '', 'user2@gmail.com', b'1'),
('#u004', 'user3', 'e10adc3949ba59abbe56e057f20f883e', 'User 3', 'Tôi Là', '', '', '', '0000-00-00', 0, b'1', '', 'user3@gmail.com', b'1'),
('#u005', 'user4', 'e10adc3949ba59abbe56e057f20f883e', 'User 4', 'Tôi Là', '', '', '', '0000-00-00', 0, b'1', '', 'user4@gmail.com', b'1'),
('#u006', 'user5', 'e10adc3949ba59abbe56e057f20f883e', 'User 5', 'Tôi Là', '', '', '', '0000-00-00', 0, b'1', '', 'user5@gmail.com', b'1'),
('#u007', 'user6', 'e10adc3949ba59abbe56e057f20f883e', 'User 6', 'Tôi Là', '', '', '', '0000-00-00', 0, b'1', '', 'user6@gmail.com', b'1'),
('#u008', 'user7', 'e10adc3949ba59abbe56e057f20f883e', 'User 7', 'Tôi Là', '', '', '', '0000-00-00', 0, b'1', '', 'user7@gmail.com', b'1'),
('#u071', 'nguyentranlc', '2f6b11eb72762c6079b5728b2d5aab7b', 'Nguyễn Trần', 'Lan Chi', NULL, '0394978612', '123 abc Phường 1 Quận 1', '2012-01-17', 5000000, b'1', '', 'chi.rua.399@gmail.com', b'0'),
('#u1006', 'vanquangduc2000', 'e10adc3949ba59abbe56e057f20f883e', 'Đức', 'Văn Quang', 'chihiro002.jpg', '0852230022', '94/12 Lê Ngã', '2021-05-15', 0, b'1', '', 'vanquangduc2242000@gmail.com', b'0'),
('#u4856', 'vanquangduc', 'e10adc3949ba59abbe56e057f20f883e', 'Văn', 'Đức', 'avt.jpg', '+848522300', '175/8 Pham Ngu Lao street, Pham Ngu Lao ward, District 1, Ho Chi Minh city', '2021-05-09', 0, b'1', '', 'harryvan224@gmail.com', b'1'),
('#u5000', 'vanquangduc23', 'e10adc3949ba59abbe56e057f20f883e', 'Văn', 'Đức', 'avt.jpg', '0852230022', ', Phú Trung, Tân Phú District, Hồ Chí Minh city, Việt Nam', '2021-05-09', 1050000, b'1', NULL, 'harryvan@gmail.com', b'1'),
('#u6096', 'duckvan', 'e10adc3949ba59abbe56e057f20f883e', 'Đức', 'Quang', 'avt.jpg', '0852230022', 'Hồ Chí Minh city, Việt Nam', '2021-05-09', 30000, b'1', NULL, 'vanquangduc224@gmail.com', b'1'),
('#u7026', 'taikhoantest', 'e10adc3949ba59abbe56e057f20f883e', 'Test', '01', 'avt.jpg', '0102030405', 'địa chỉ tài khoản test', '2022-01-06', 650000, b'1', NULL, 'test01@gmail.com', b'0'),
('#u8941', 'giangvien', 'e10adc3949ba59abbe56e057f20f883e', 'giangvien', '01', 'avt.jpg', '0130231231', 'địa chỉ giảng viên', '2022-01-01', 0, b'1', NULL, 'giangvien01@gmail.com', b'1'),
('#u9928', 'duckpham', 'e10adc3949ba59abbe56e057f20f883e', 'Duc', 'Pham', 'avt.jpg', '0965427503', 'ggfhgfhfghfghfg', '2021-05-15', 49445000, b'1', '84124dc432064fb0463c81c8e68a472e', 'lwtnobita@gmail.com', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Activated` bit(1) NOT NULL DEFAULT b'1',
  `ActivateToken` varchar(50) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Username`, `Password`, `Email`, `Activated`, `ActivateToken`, `Firstname`, `Lastname`) VALUES
('admin', '123456', 'admin@gmail.com', b'1', '123456', 'Admin', 'Tôi Là'),
('admin', '123456', 'admin@gmail.com', b'1', '123456', 'Admin', 'Tôi Là');

-- --------------------------------------------------------

--
-- Table structure for table `binhluan&danhgia`
--

CREATE TABLE `binhluan&danhgia` (
  `MaBL&DG` char(5) NOT NULL,
  `IDUngDung` char(5) NOT NULL,
  `ID` char(5) NOT NULL,
  `BinhLuan` text DEFAULT NULL,
  `DanhGia` float DEFAULT 0,
  `ThoiGian` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` char(8) NOT NULL,
  `IDUngDung` char(6) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `sender` varchar(255) NOT NULL DEFAULT 'Anonymous',
  `sender_id` char(6) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE `developer` (
  `ID` char(5) NOT NULL,
  `CMND` varchar(255) DEFAULT NULL,
  `GioiThieu` text DEFAULT NULL,
  `SoLuongUngDungUpload` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`ID`, `CMND`, `GioiThieu`, `SoLuongUngDungUpload`) VALUES
('#u001', '12345678910', 'Đây là dev 1', 1),
('#u609', NULL, 'tre', 0),
('Array', NULL, 'tre', 0);

-- --------------------------------------------------------

--
-- Table structure for table `diem`
--

CREATE TABLE `diem` (
  `STT` int(11) NOT NULL,
  `ID` char(6) NOT NULL,
  `IDUngDung` char(6) NOT NULL,
  `diem1` char(5) NOT NULL,
  `diem2` char(5) NOT NULL,
  `giuaky` char(5) NOT NULL,
  `cuoiky` char(5) NOT NULL,
  `diemtongket` char(5) NOT NULL,
  `ghichu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diem`
--

INSERT INTO `diem` (`STT`, `ID`, `IDUngDung`, `diem1`, `diem2`, `giuaky`, `cuoiky`, `diemtongket`, `ghichu`) VALUES
(3, '#u9928', 'ud6123', '8', '8', '8', '8', '8', ' '),
(29, '#u7026', 'ud4294', '10', '10', '10', '10', '10', ' '),
(45, '#u7026', 'ud0790', '4', '5', '6', '7', '6.1', ' '),
(48, '#u9928', 'ud0058', '1', '1', '1', '1', '1', ' '),
(64, '#u9928', 'ud0197', '9', '9', '9', '9', '9', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `hoadonnapthe`
--

CREATE TABLE `hoadonnapthe` (
  `IDHoaDon` int(5) NOT NULL,
  `SoSeri` varchar(255) NOT NULL,
  `ID` char(6) NOT NULL,
  `GiaTien` int(10) NOT NULL DEFAULT 0 COMMENT 'ứng với 1 thẻ',
  `NgayNap` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hoadonnapthe`
--

INSERT INTO `hoadonnapthe` (`IDHoaDon`, `SoSeri`, `ID`, `GiaTien`, `NgayNap`) VALUES
(3, '4GX0D-OKRA0-KE', '#u6096', 10000, '2021-05-14 09:03:05'),
(4, 'DE2GO-EKJCX-M5', '#u6096', 10000, '2021-05-14 09:32:38'),
(5, 'T0VAZ-YMXDH-LM', '#u6096', 10000, '2021-05-14 09:34:40'),
(6, 'Q3T2Z-U8J0W-ND', '#u6096', 100000, '2021-05-14 10:17:26'),
(7, 'EVJO1-DLBSR-SH', '#u6096', 50000, '2021-05-14 10:52:44'),
(8, 'NW6SV-J5ZUC-2R', '#u5000', 10000, '2021-05-14 02:49:50'),
(9, 'N525Z-RCH85-TD', '#u5000', 100000, '2021-05-14 03:08:42'),
(10, '4940L-A5DMD-H2', '#u6096', 10000, '2021-05-15 06:49:19'),
(11, 'RD3ZV-LI5QT-SV', '#u9928', 10000, '2022-01-04 01:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `khoungdung`
--

CREATE TABLE `khoungdung` (
  `IDUngDung` char(6) NOT NULL,
  `ID` char(6) NOT NULL,
  `TenUngDung` varchar(255) NOT NULL,
  `TenFile` varchar(255) NOT NULL,
  `Icon` varchar(255) DEFAULT NULL,
  `Brief` text DEFAULT NULL,
  `Detail` text DEFAULT NULL,
  `TheLoai` varchar(50) DEFAULT NULL,
  `Pictures` varchar(1000) DEFAULT NULL,
  `DungLuong` int(10) DEFAULT NULL,
  `GiaTien` int(10) NOT NULL DEFAULT 0,
  `TrangThai` int(1) NOT NULL DEFAULT 2 COMMENT '0:Từ chối, 1:Duyệt, 2:Nháp, 3:Chờ duyệt, 4:Gỡ',
  `ThoiGianUpLoad` date NOT NULL DEFAULT current_timestamp(),
  `LyDo` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL COMMENT 'trochoi\r\ngiaitri\r\nungdung\r\n',
  `Luottai` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khoungdung`
--

INSERT INTO `khoungdung` (`IDUngDung`, `ID`, `TenUngDung`, `TenFile`, `Icon`, `Brief`, `Detail`, `TheLoai`, `Pictures`, `DungLuong`, `GiaTien`, `TrangThai`, `ThoiGianUpLoad`, `LyDo`, `Type`, `Luottai`) VALUES
('ud0058', '#u9928', 'Java Training in Chandigarh', 'Upload/FILE/Java Training in Chandigarh/Java Training in Chandigarh.zip', 'Upload/IMG/Java Training in Chandigarh/Java Training in Chandigarh.png', NULL, ' Java Training in Chandigarh ', 'Java', NULL, 22, 60000, 1, '2022-01-03', 'OK', 'laptrinh', 1),
('ud0155', '#u9928', 'Đào tạo tiếng Anh giao tiếp tại Ms Hoa', 'Upload/FILE/Đào tạo tiếng Anh giao tiếp tại Ms Hoa/Đào tạo tiếng Anh giao tiếp tại Ms Hoa.zip', 'Upload/IMG/Đào tạo tiếng Anh giao tiếp tại Ms Hoa/Đào tạo tiếng Anh giao tiếp tại Ms Hoa.jpg', NULL, ' Đào tạo tiếng Anh giao tiếp tại Ms Hoa', 'Giao tiếp', NULL, 22, 120000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud0197', '#u9928', 'Học HTML CSS Từ cơ bản đến nâng cao', 'Upload/FILE/Học HTML CSS Từ cơ bản đến nâng cao/Học HTML CSS Từ cơ bản đến nâng cao.zip', 'Upload/IMG/Học HTML CSS Từ cơ bản đến nâng cao/Học HTML CSS Từ cơ bản đến nâng cao.jpg', NULL, NULL, NULL, NULL, 22, 0, 1, '2022-01-03', 'OK', '', 1),
('ud0275', '#u9928', 'Cambridge IELTS 13 Academic Student\'s Book with Answers', 'Upload/FILE/Cambridge IELTS 13 Academic Student\'s Book with Answers/Cambridge IELTS 13 Academic Student\'s Book with Answers.zip', 'Upload/IMG/Cambridge IELTS 13 Academic Student\'s Book with Answers/Cambridge IELTS 13 Academic Student\'s Book with Answers.jpg', NULL, ' Cambridge IELTS 13 Academic Student\'s Book with Answers', 'Sách', NULL, 22, 30000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud0327', '#u9928', 'Python Programming with Real-Time Applications', 'Upload/FILE/Python Programming with Real-Time Applications/Python Programming with Real-Time Applications.zip', 'Upload/IMG/Python Programming with Real-Time Applications/Python Programming with Real-Time Applications.png', NULL, 'Python Programming with Real-Time Applications', 'Python', NULL, 22, 80000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud0440', '#u9928', 'PasstheTOEICTest-Inter', 'Upload/FILE/PasstheTOEICTest-Inter/PasstheTOEICTest-Inter.zip', 'Upload/IMG/PasstheTOEICTest-Inter/PasstheTOEICTest-Inter.jpg', NULL, ' PasstheTOEICTest-Inter', 'Toeic', NULL, 22, 35000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud0570', '#u9928', 'IELTS Preparation Course', 'Upload/FILE/IELTS Preparation Course/IELTS Preparation Course.zip', 'Upload/IMG/IELTS Preparation Course/IELTS Preparation Course.png', NULL, ' IELTS Preparation Course', 'Ielts', NULL, 22, 50000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud0785', '#u9928', 'Pages-from-Pages-from-Longman-Preparation-Series-for-The-New-Toeic-Test-Advanced-4E', 'Upload/FILE/Pages-from-Pages-from-Longman-Preparation-Series-for-The-New-Toeic-Test-Advanced-4E/Pages-from-Pages-from-Longman-Preparation-Series-for-The-New-Toeic-Test-Advanced-4E.zip', 'Upload/IMG/Pages-from-Pages-from-Longman-Preparation-Series-for-The-New-Toeic-Test-Advanced-4E/Pages-from-Pages-from-Longman-Preparation-Series-for-The-New-Toeic-Test-Advanced-4E.jpg', NULL, ' Pages-from-Pages-from-Longman-Preparation-Series-for-The-New-Toeic-Test-Advanced-4E', 'Sách', NULL, 22, 120000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud0790', '#u9928', '9 Best Online Java Courses to Learn Programming in 2021', 'Upload/FILE/9 Best Online Java Courses to Learn Programming in 2021/9 Best Online Java Courses to Learn Programming in 2021.zip', 'Upload/IMG/9 Best Online Java Courses to Learn Programming in 2021/9 Best Online Java Courses to Learn Programming in 2021.jpg', NULL, ' 9 Best Online Java Courses to Learn Programming in 2021', 'Java', NULL, 22, 100000, 1, '2022-01-03', 'OK', 'laptrinh', 2),
('ud0981', '#u6579', 'test', 'Upload/FILE/9 Best Online Java Courses to Learn Programming in 2021/9 Best Online Java Courses to Learn Programming in 2021.zip', 'Upload/IMG/images/images.png', NULL, 'ádấda', 'Java', NULL, 22, 0, 5, '2022-01-05', '', 'laptrinh', 0),
('ud1040', '#u9928', 'IELTS book 15 - Listening test 1', 'Upload/FILE/IELTS book 15 - Listening test 1/IELTS book 15 - Listening test 1.zip', 'Upload/IMG/IELTS book 15 - Listening test 1/IELTS book 15 - Listening test 1.jpg', NULL, ' IELTS book 15 - Listening test 1', 'Sách', NULL, 22, 100000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud1207', '#u9928', 'The Official guide to the TOEFT Test', 'Upload/FILE/The Official guide to the TOEFT Test/The Official guide to the TOEFT Test.zip', 'Upload/IMG/The Official guide to the TOEFT Test_/The Official guide to the TOEFT Test_.jpg', NULL, ' The Official guide to the TOEFT Test', 'Toeft', NULL, 22, 50000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud1219', '#u9928', 'Khóa học Tiếng Anh giao tiếp cơ bản cho người mới bắt đầu', 'Upload/FILE/Khóa học Tiếng Anh giao tiếp cơ bản cho người mới bắt đầu/Khóa học Tiếng Anh giao tiếp cơ bản cho người mới bắt đầu.zip', 'Upload/IMG/Khóa học Tiếng Anh giao tiếp cơ bản cho người mới bắt đầu/Khóa học Tiếng Anh giao tiếp cơ bản cho người mới bắt đầu.jpg', NULL, ' Khóa học Tiếng Anh giao tiếp cơ bản cho người mới bắt đầu', 'Giao tiếp', NULL, 22, 199000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud1406', '#u9928', 'IELTS online course and preparation', 'Upload/FILE/IELTS online course and preparation/IELTS online course and preparation.zip', 'Upload/IMG/IELTS online course and preparation/IELTS online course and preparation.jpg', NULL, ' IELTS online course and preparation', 'Ielts', NULL, 22, 130000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud1407', '#u9928', 'HTMS_TOEFLiBT_ActualTests_Reading1', 'Upload/FILE/HTMS_TOEFLiBT_ActualTests_Reading1/HTMS_TOEFLiBT_ActualTests_Reading1.zip', 'Upload/IMG/HTMS_TOEFLiBT_ActualTests_Reading1/HTMS_TOEFLiBT_ActualTests_Reading1.jpg', NULL, ' HTMS_TOEFLiBT_ActualTests_Reading1', 'Sách', NULL, 22, 50000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud1522', '#u9928', 'Free online Preparation Course', 'Upload/FILE/Free online Preparation Course/Free online Preparation Course.zip', 'Upload/IMG/Free online Preparation Course/Free online Preparation Course.jpg', NULL, ' Free online Preparation Course', 'Toeic', NULL, 22, 0, 1, '2022-01-04', 'OK', 'tienganh', 1),
('ud1758', '#u9928', 'C# Turtorial - Full Course for Beginners', 'Upload/FILE/C# Turtorial - Full Course for Beginners/C# Turtorial - Full Course for Beginners.zip', 'Upload/IMG/C# Turtorial - Full Course for Beginners/C# Turtorial - Full Course for Beginners.jpg', NULL, ' C# Turtorial - Full Course for Beginners', 'C#', NULL, 22, 0, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud2518', '#u9928', 'C Language Course', 'Upload/FILE/C Language Course/C Language Course.zip', 'Upload/IMG/C Language Course/C Language Course.png', NULL, ' C Language Course', 'C/C++', NULL, 22, 20000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud2605', '#u9928', 'Learn Special English - IELTS Course', 'Upload/FILE/Learn Special English - IELTS Course/Learn Special English - IELTS Course.zip', 'Upload/IMG/Learn Special English - IELTS Course/Learn Special English - IELTS Course.jpg', NULL, ' Learn Special English - IELTS Course', 'Ielts', NULL, 22, 40000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud2846', '#u9928', 'Java Tutorial For Beginners to Expert', 'Upload/FILE/Java Tutorial For Beginners to Expert/Java Tutorial For Beginners to Expert.zip', 'Upload/IMG/Java Tutorial For Beginners to Expert/Java Tutorial For Beginners to Expert.jpg', NULL, ' Java Tutorial For Beginners to Expert', 'Java', NULL, 22, 0, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud2901', '#u9928', 'Pages-from-Complete-IELTS-Bands-5-6.5-with-answer', 'Upload/FILE/Pages-from-Complete-IELTS-Bands-5-6/Pages-from-Complete-IELTS-Bands-5-6.5-with-answer.zip', 'Upload/IMG/Pages-from-Complete-IELTS-Bands-5-6/Pages-from-Complete-IELTS-Bands-5-6.5-with-answer.jpg', NULL, ' Pages-from-Complete-IELTS-Bands-5-6.5-with-answer', 'Ielts', NULL, 22, 0, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud2904', '#u9928', 'Java Training Courses, Java Training Services', 'Upload/FILE/Java Training Courses, Java Training Services/Java Training Courses, Java Training Services.zip', 'Upload/IMG/Java Training Courses, Java Training Services/Java Training Courses, Java Training Services.jpg', NULL, ' Java Training Courses, Java Training Services', 'Java', NULL, 22, 70000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud3023', '#u9928', 'IELTS Writing online', 'Upload/FILE/IELTS Writing online/IELTS Writing online.zip', 'Upload/IMG/IELTS Writing online/IELTS Writing online.png', NULL, ' IELTS Writing online', 'Ielts', NULL, 22, 99000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud3179', '#u9928', 'Online Java Training Course', 'Upload/FILE/Online Java Training Course/Online Java Training Course.zip', 'Upload/IMG/Online Java Training Course/Online Java Training Course.png', NULL, ' Online Java Training Course', 'Java', NULL, 22, 45000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud3253', '#u9928', 'C Programming Course', 'Upload/FILE/C Programming Course/C Programming Course.zip', 'Upload/IMG/C Programming Course/C Programming Course.jpg', NULL, ' C Programming Course', 'C/C++', NULL, 22, 40000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud3258', '#u9928', 'Siêu trí nhớ từ vựng Tiếng Anh', 'Upload/FILE/Siêu trí nhớ từ vựng Tiếng Anh/Siêu trí nhớ từ vựng Tiếng Anh.zip', 'Upload/IMG/Siêu trí nhớ từ vựng Tiếng Anh/Siêu trí nhớ từ vựng Tiếng Anh.jpg', NULL, ' Siêu trí nhớ từ vựng Tiếng Anh', 'Sách', NULL, 22, 169000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud3349', '#u9928', 'TNT-Toeic-Basic-Course', 'Upload/FILE/TNT-Toeic-Basic-Course/TNT-Toeic-Basic-Course.1596796666.zip', 'Upload/IMG/TNT-Toeic-Basic-Course/TNT-Toeic-Basic-Course.1596796666.jpg', NULL, ' TNT-Toeic-Basic-Course.1596796666', 'Toeic', NULL, 22, 40000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud3447', '#u9928', 'Python Full Course', 'Upload/FILE/Python Full Course/Python Full Course.zip', 'Upload/IMG/Python Full Course/Python Full Course.jpg', NULL, 'Python Full Course', 'Python', NULL, 22, 190000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud3468', '#u9928', '10 Best C++ Courses, Tutorials Online 2021', 'Upload/FILE/10 Best C++ Courses, Tutorials Online 2021/10 Best C++ Courses, Tutorials Online 2021.zip', 'Upload/IMG/10 Best C++ Courses, Tutorials Online 2021/10 Best C++ Courses, Tutorials Online 2021.jpg', NULL, ' 10 Best C++ Courses, Tutorials Online 2021', 'C/C++', NULL, 22, 150000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud3602', '#u9928', 'Designing Learn JavaScript\'s course portal', 'Upload/FILE/Designing Learn JavaScript\'s course portal/Designing Learn JavaScript\'s course portal.zip', 'Upload/IMG/Designing Learn JavaScript\'s course portal/Designing Learn JavaScript\'s course portal.png', NULL, ' Designing Learn JavaScript\'s course portal', 'HTML+Javascript', NULL, 22, 170000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud3754', '#u9928', 'Learn CSS Course Online', 'Upload/FILE/Learn CSS Course Online/Learn CSS Course Online.zip', 'Upload/IMG/Learn CSS Course Online/Learn CSS Course Online.jpg', NULL, ' Learn CSS Course Online', 'HTML+Javascript', NULL, 22, 49000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud3823', '#u9928', 'The IETLS Workshop', 'Upload/FILE/The IETLS Workshop/The IETLS Workshop.zip', 'Upload/IMG/The IETLS Workshop/The IETLS Workshop.jpg', NULL, ' The IETLS Workshop', 'Ielts', NULL, 22, 50000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud3938', '#u9928', 'Learning C#', 'Upload/FILE/Learning C#/Learning C#.zip', 'Upload/IMG/Learning C#/Learning C#.png', NULL, ' Learning C#', 'C#', NULL, 22, 10000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud4294', '#u9928', 'file test', 'Upload/FILE/test/test.zip', 'Upload/IMG/ddos-la-gi-va-cach-phong-chong-bang-vpn-01/ddos-la-gi-va-cach-phong-chong-bang-vpn-01.jpg', NULL, 'file test                                        ', 'Sách', NULL, 24, 10000, 1, '2022-01-06', 'OK', 'tienganh', 0),
('ud4345', '#u9928', 'C++ Programming Course Online 2022', 'Upload/FILE/C++ Programming Course Online 2022/C++ Programming Course Online 2022.zip', 'Upload/IMG/C++ Programming Course Online 2022/C++ Programming Course Online 2022.png', NULL, ' C++ Programming Course Online 2022', 'C/C++', NULL, 22, 0, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud4394', '#u9928', 'Tiếng Anh giao tiếp trong 30 ngày', 'Upload/FILE/Tiếng Anh giao tiếp trong 30 ngày/Tiếng Anh giao tiếp trong 30 ngày.zip', 'Upload/IMG/Tiếng Anh giao tiếp trong 30 ngày/Tiếng Anh giao tiếp trong 30 ngày.jpg', NULL, ' Tiếng Anh giao tiếp trong 30 ngày', 'Giao tiếp', NULL, 22, 160000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud4519', '#u9928', 'Toeic - Oxford University Press', 'Upload/FILE/Toeic - Oxford University Press/Toeic - Oxford University Press.zip', 'Upload/IMG/Toeic - Oxford University Press/Toeic - Oxford University Press.jpg', NULL, ' Toeic - Oxford University Press', 'Sách', NULL, 22, 79000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud4931', '#u9928', 'test', 'Upload/FILE/test/test.zip', 'Upload/IMG/269684471_3018800285028165_947434811097993792_n/269684471_3018800285028165_947434811097993792_n.jpg', NULL, ' test', 'Java', NULL, 24, 0, 1, '2022-01-03', 'OK', 'laptrinh', 1),
('ud5147', '#u9928', 'Dev Express C# Course with Project', 'Upload/FILE/Dev Express C# Course with Project/Dev Express C# Course with Project.zip', 'Upload/IMG/Dev Express C# Course with Project/Dev Express C# Course with Project.jpg', NULL, ' Dev Express C# Course with Project', 'C#', NULL, 22, 90000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud5466', '#u9928', 'Longman Introductory Course For The Toeft Test', 'Upload/FILE/Longman Introductory Course For The Toeft Test/Longman Introductory Course For The Toeft Test.zip', 'Upload/IMG/Longman Introductory Course For The Toeft Test/Longman Introductory Course For The Toeft Test.jpeg', NULL, ' Longman Introductory Course For The Toeft Test', 'Toeft', NULL, 22, 179000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud5669', '#u9928', 'British-Council-Free-Online-Courses-IELTS-Preparation-Courses-Free-IELTS-Practice-Tests', 'Upload/FILE/British-Council-Free-Online-Courses-IELTS-Preparation-Courses-Free-IELTS-Practice-Tests/British-Council-Free-Online-Courses-IELTS-Preparation-Courses-Free-IELTS-Practice-Tests.zip', 'Upload/IMG/British-Council-Free-Online-Courses-IELTS-Preparation-Courses-Free-IELTS-Practice-Tests/British-Council-Free-Online-Courses-IELTS-Preparation-Courses-Free-IELTS-Practice-Tests.png', NULL, ' British-Council-Free-Online-Courses-IELTS-Preparation-Courses-Free-IELTS-Practice-Tests', 'Ielts', NULL, 22, 0, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud5688', '#u9928', 'Full Java Script Course for Beginners', 'Upload/FILE/Full Java Script Course for Beginners/Full Java Script Course for Beginners.zip', 'Upload/IMG/Full Java Script Course for Beginners/Full Java Script Course for Beginners.png', NULL, ' Full Java Script Course for Beginners', 'HTML+Javascript', NULL, 22, 140000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud5721', '#u9928', 'TOEIC-TACTIS-lr-lg', 'Upload/FILE/toeic-tactics-lr-154x200-lg/toeic-tactics-lr-154x200-lg.zip', 'Upload/IMG/toeic-tactics-lr-154x200-lg/toeic-tactics-lr-154x200-lg.jpg', NULL, ' TOEIC-TACTIS-lr-lg', 'Toeic', NULL, 22, 50000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud5953', '#u9928', 'C C++ Training in Chennai', 'Upload/FILE/C C++ Training in Chennai/C C++ Training in Chennai.zip', 'Upload/IMG/C C++ Training in Chennai/C C++ Training in Chennai.png', NULL, ' C C++ Training in Chennai', 'C/C++', NULL, 22, 35000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud6123', '#u9928', '14 C# Courses Bundle', 'Upload/FILE/14 C# Courses Bundle/14 C# Courses Bundle.zip', 'Upload/IMG/14 C# Courses Bundle/14 C# Courses Bundle.png', NULL, ' 14 C# Courses Bundle                         ', 'C#', NULL, 22, 80000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud6530', '#u9928', 'JavaScript Introduction', 'Upload/FILE/JavaScript Introduction/JavaScript Introduction.zip', 'Upload/IMG/JavaScript Introduction/JavaScript Introduction.png', NULL, ' JavaScript Introduction', 'Java', NULL, 22, 0, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud6533', '#u9928', 'IELTS Trainer Books', 'Upload/FILE/IELTS Trainer Books/IELTS Trainer Books.zip', 'Upload/IMG/IELTS Trainer Books/IELTS Trainer Books.jpg', NULL, ' IELTS Trainer Books', 'Sách', NULL, 22, 125000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud6572', '#u9928', 'HTML & CSS Full Course', 'Upload/FILE/HTML & CSS Full Course/HTML & CSS Full Course.zip', 'Upload/IMG/HTML & CSS Full Course/HTML & CSS Full Course.jpg', NULL, ' HTML & CSS Full Course', 'HTML+Javascript', NULL, 22, 0, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud6611', '#u9928', 'PasstheTOEICTest-Intro', 'Upload/FILE/PasstheTOEICTest-Intro/PasstheTOEICTest-Intro.zip', 'Upload/IMG/PasstheTOEICTest-Intro/PasstheTOEICTest-Intro.jpg', NULL, ' PasstheTOEICTest-Intro', 'Toeic', NULL, 22, 0, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud6730', '#u9928', 'Best for IELTS Preparation', 'Upload/FILE/Best for IELTS Preparation/Best for IELTS Preparation.zip', 'Upload/IMG/Best for IELTS Preparation/Best for IELTS Preparation.jpg', NULL, ' Best for IELTS Preparation', 'Sách', NULL, 22, 90000, 1, '2022-01-04', 'OK', 'tienganh', 0),
('ud6945', '#u9928', '15 Best Free Course to Learn Python in 2022', 'Upload/FILE/15 Best Free Course to Learn Python in 2022/15 Best Free Course to Learn Python in 2022.zip', 'Upload/IMG/15 Best Free Course to Learn Python in 2022/15 Best Free Course to Learn Python in 2022.jpeg', NULL, ' 15 Best Free Course to Learn Python in 2022', 'Python', NULL, 22, 0, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud7063', '#u9928', 'Get Complete C++ Programming Bundle to Build Large-Scale Apps', 'Upload/FILE/Get Complete C++ Programming Bundle to Build Large-Scale Apps/Get Complete C++ Programming Bundle to Build Large-Scale Apps.zip', 'Upload/IMG/Get Complete C++ Programming Bundle to Build Large-Scale Apps/Get Complete C++ Programming Bundle to Build Large-Scale Apps.png', NULL, ' Get Complete C++ Programming Bundle to Build Large-Scale Apps', 'C/C++', NULL, 22, 50000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud7124', '#u9928', 'Free Courses to Learn C Programming for Beginners', 'Upload/FILE/Free Courses to Learn C Programming for Beginners/Free Courses to Learn C Programming for Beginners.zip', 'Upload/IMG/Free Courses to Learn C Programming for Beginners/Free Courses to Learn C Programming for Beginners.png', NULL, ' Free Courses to Learn C Programming for Beginners', 'C/C++', NULL, 22, 0, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud7816', '#u9928', 'TOEIC-Preparation-0', 'Upload/FILE/TOEIC-Preparation-0/TOEIC-Preparation-0.zip', 'Upload/IMG/TOEIC-Preparation-0/TOEIC-Preparation-0.jpg', NULL, ' TOEIC-Preparation-0', 'Sách', NULL, 22, 0, 3, '2022-01-04', '', 'tienganh', 0),
('ud7899', '#u9928', 'khoa-ielts-online-band-5-5', 'Upload/FILE/khoa-ielts-online-band-5-5/khoa-ielts-online-band-5-5.zip', 'Upload/IMG/khoa-ielts-online-band-5-5/khoa-ielts-online-band-5-5.jpg', NULL, ' khoa-ielts-online-band-5-5', 'Ielts', NULL, 22, 299000, 3, '2022-01-04', '', 'tienganh', 0),
('ud7963', '#u9928', 'TOEFL COURSE INDEX', 'Upload/FILE/TOEFL COURSE INDEX/TOEFL COURSE INDEX.zip', 'Upload/IMG/TOEFL COURSE INDEX/TOEFL COURSE INDEX.png', NULL, ' TOEFL COURSE INDEX', 'Toeft', NULL, 22, 120000, 3, '2022-01-04', '', 'tienganh', 0),
('ud8208', '#u9928', 'Học tiếng Anh cơ bản cho người mới bắt đầu và mất gốc', 'Upload/FILE/Học tiếng Anh cơ bản cho người mới bắt đầu và mất gốc/Học tiếng Anh cơ bản cho người mới bắt đầu và mất gốc.zip', 'Upload/IMG/Học tiếng Anh cơ bản cho người mới bắt đầu và mất gốc/Học tiếng Anh cơ bản cho người mới bắt đầu và mất gốc.jpg', NULL, ' Học tiếng Anh cơ bản cho người mới bắt đầu và mất gốc', 'Giao tiếp', NULL, 22, 0, 3, '2022-01-04', '', 'tienganh', 0),
('ud8344', '#u9928', '5500 câu giao tiếp Tiếng Anh thông dụng', 'Upload/FILE/5500 câu giao tiếp Tiếng Anh thông dụng/5500 câu giao tiếp Tiếng Anh thông dụng.zip', 'Upload/IMG/5500 câu giao tiếp Tiếng Anh thông dụng/5500 câu giao tiếp Tiếng Anh thông dụng.jpg', NULL, ' 5500 câu giao tiếp Tiếng Anh thông dụng', 'Sách', NULL, 22, 10000, 3, '2022-01-04', '', 'tienganh', 0),
('ud8497', '#u9928', 'HTML & CSS Basics course', 'Upload/FILE/HTML & CSS Basics course/HTML & CSS Basics course.zip', 'Upload/IMG/HTML & CSS Basics course/HTML & CSS Basics course.jpg', NULL, ' HTML & CSS Basics course', 'HTML+Javascript', NULL, 22, 100000, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud8771', '#u9928', 'Course Logical - Html css template for course', 'Upload/FILE/Course Logical - Html css template for course/Course Logical - Html css template for course.zip', 'Upload/IMG/Course Logical - Html css template for course/Course Logical - Html css template for course.png', NULL, ' Course Logical - Html css template for course', 'HTML+Javascript', NULL, 22, 0, 3, '2022-01-03', '', 'laptrinh', 0),
('ud8928', '#u9928', 'NewTOEIC700_b1', 'Upload/FILE/NewTOEIC700_b1/NewTOEIC700_b1.zip', 'Upload/IMG/NewTOEIC700_b1/NewTOEIC700_b1.jpg', NULL, ' NewTOEIC700_b1', 'Toeic', NULL, 22, 139000, 3, '2022-01-04', '', 'tienganh', 0),
('ud9431', '#u9928', 'Top 3 JavaScript Online Courses', 'Upload/FILE/Top 3 JavaScript Online Courses/Top 3 JavaScript Online Courses.zip', 'Upload/IMG/Top 3 JavaScript Online Courses/Top 3 JavaScript Online Courses.png', NULL, 'Top 3 JavaScript Online Courses', 'Java', NULL, 22, 0, 1, '2022-01-03', 'OK', 'laptrinh', 0),
('ud9520', '#u9928', 'IELTS-preparation-books', 'Upload/FILE/IELTS-preparation-books/IELTS-preparation-books.zip', 'Upload/IMG/IELTS-preparation-books/IELTS-preparation-books.jpg', NULL, ' IELTS-preparation-books', 'Ielts', NULL, 22, 50000, 3, '2022-01-04', '', 'tienganh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lich`
--

CREATE TABLE `lich` (
  `STT` int(11) NOT NULL,
  `ID` char(6) NOT NULL,
  `IDUngDung` char(6) NOT NULL,
  `Lichhocvaday` varchar(50) NOT NULL,
  `Lichthi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lich`
--

INSERT INTO `lich` (`STT`, `ID`, `IDUngDung`, `Lichhocvaday`, `Lichthi`) VALUES
(25, '#u9928', 'ud4294', 'Thứ 2 - 17:45 - 45 phút', 'Thứ 7 (08/01/2022) - 17:00 - 120 phút'),
(32, '#u9928', 'ud6123', 'Chủ nhật - 10:00 AM - 120 phút', 'Thứ 2 (10/01/2022) - 15:30 - 120 phút');

-- --------------------------------------------------------

--
-- Table structure for table `lichsutai`
--

CREATE TABLE `lichsutai` (
  `STT` int(10) NOT NULL COMMENT 'Số thứ tự',
  `ID` char(6) NOT NULL,
  `IDUngDung` char(6) NOT NULL,
  `ThoiGianTai` datetime NOT NULL DEFAULT current_timestamp(),
  `GiaTien` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lichsutai`
--

INSERT INTO `lichsutai` (`STT`, `ID`, `IDUngDung`, `ThoiGianTai`, `GiaTien`) VALUES
(361, '#u9928', 'ud4931', '2022-01-03 19:54:05', 0),
(362, '#u9928', 'ud0058', '2022-01-04 14:43:13', 60000),
(364, '#u7026', 'ud0790', '2022-01-06 13:31:26', 100000),
(366, '#u7026', 'ud1522', '2022-01-06 16:29:16', 0),
(368, '#u7026', 'ud4294', '2022-01-06 16:38:32', 10000),
(369, '#u9928', 'ud6123', '2022-01-06 17:11:06', 80000),
(370, '#u9928', 'ud0197', '2022-01-07 19:44:19', 170000),
(371, '#u9928', 'ud0197', '2022-01-07 19:49:08', 170000);

-- --------------------------------------------------------

--
-- Table structure for table `luottai`
--

CREATE TABLE `luottai` (
  `id` int(10) NOT NULL,
  `IDUngDung` char(6) NOT NULL,
  `TinhPhi` int(1) NOT NULL COMMENT '1: Có phí\r\n0: Miễn phí',
  `LuotTai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reset_token`
--

CREATE TABLE `reset_token` (
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expire_on` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reset_token`
--

INSERT INTO `reset_token` (`email`, `token`, `expire_on`) VALUES
('mvmanh@gmail.com', '', 0),
('mvmanh@it.tdt.edu.vn', '', 0),
('vanquangduc224@gmail.com', '8827072600fe5f21c8801751d309ccd0', 1621193818),
('vanquangduc2242000@gmail.com', '8de86e293889b7a13d635637533e70cf', 1621101356);

-- --------------------------------------------------------

--
-- Table structure for table `thecao`
--

CREATE TABLE `thecao` (
  `IDThe` int(5) NOT NULL,
  `SoSeri` varchar(255) NOT NULL,
  `GiaTien` int(10) NOT NULL COMMENT 'Giá của 1 thẻ',
  `Checked` bit(1) NOT NULL DEFAULT b'0' COMMENT '0:chưa nạp, 1:đã nạp',
  `NgayTao` date NOT NULL DEFAULT current_timestamp(),
  `NgayHetHan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thecao`
--

INSERT INTO `thecao` (`IDThe`, `SoSeri`, `GiaTien`, `Checked`, `NgayTao`, `NgayHetHan`) VALUES
(77, '4940L-A5DMD-H2', 10000, b'1', '2021-04-20', '2021-10-20'),
(139, 'GZFUF-W0MVX-C8', 10000, b'0', '2021-05-10', '2021-11-10'),
(140, 'WOORO-QRX77-MX', 10000, b'0', '2021-05-10', '2021-11-10'),
(141, 'J6BZH-IHA6T-6Y', 10000, b'0', '2021-05-10', '2021-11-10'),
(142, 'FMFR2-CKTCX-W3', 10000, b'0', '2021-05-10', '2021-11-10'),
(143, 'N525Z-RCH85-TD', 100000, b'1', '2021-05-10', '2021-11-10'),
(144, '615PX-8EP2L-OR', 10000, b'0', '2021-05-10', '2021-11-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `binhluan&danhgia`
--
ALTER TABLE `binhluan&danhgia`
  ADD PRIMARY KEY (`MaBL&DG`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `diem`
--
ALTER TABLE `diem`
  ADD PRIMARY KEY (`STT`),
  ADD UNIQUE KEY `ID` (`ID`,`IDUngDung`);

--
-- Indexes for table `hoadonnapthe`
--
ALTER TABLE `hoadonnapthe`
  ADD PRIMARY KEY (`IDHoaDon`),
  ADD UNIQUE KEY `SoSeri` (`SoSeri`);

--
-- Indexes for table `khoungdung`
--
ALTER TABLE `khoungdung`
  ADD PRIMARY KEY (`IDUngDung`);

--
-- Indexes for table `lich`
--
ALTER TABLE `lich`
  ADD PRIMARY KEY (`STT`),
  ADD KEY `ID` (`ID`),
  ADD KEY `IDUngDung` (`IDUngDung`);

--
-- Indexes for table `lichsutai`
--
ALTER TABLE `lichsutai`
  ADD PRIMARY KEY (`STT`);

--
-- Indexes for table `luottai`
--
ALTER TABLE `luottai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_token`
--
ALTER TABLE `reset_token`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `thecao`
--
ALTER TABLE `thecao`
  ADD PRIMARY KEY (`IDThe`),
  ADD UNIQUE KEY `SoSeri` (`SoSeri`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diem`
--
ALTER TABLE `diem`
  MODIFY `STT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `hoadonnapthe`
--
ALTER TABLE `hoadonnapthe`
  MODIFY `IDHoaDon` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lich`
--
ALTER TABLE `lich`
  MODIFY `STT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `lichsutai`
--
ALTER TABLE `lichsutai`
  MODIFY `STT` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Số thứ tự', AUTO_INCREMENT=372;

--
-- AUTO_INCREMENT for table `luottai`
--
ALTER TABLE `luottai`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thecao`
--
ALTER TABLE `thecao`
  MODIFY `IDThe` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
