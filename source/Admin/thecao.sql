-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 25, 2021 lúc 07:32 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `chplay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thecao`
--

CREATE TABLE `thecao` (
  `IDThe` int(5) NOT NULL,
  `SoSeri` varchar(255) NOT NULL,
  `GiaTien` int(10) NOT NULL COMMENT 'Giá của 1 thẻ',
  `Check` bit(1) NOT NULL DEFAULT b'0' COMMENT '0:chưa nạp, 1:đã nạp',
  `NgayTao` datetime NOT NULL DEFAULT current_timestamp(),
  `NgayHetHan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `thecao`
--

INSERT INTO `thecao` (`IDThe`, `SoSeri`, `GiaTien`, `Check`, `NgayTao`, `NgayHetHan`) VALUES
(76, 'Q3I4Y-YSD7F-9M', 10000, b'0', '2021-04-20 00:00:00', '2021-10-20 00:00:00'),
(77, '4940L-A5DMD-H2', 10000, b'0', '2021-04-20 00:00:00', '2021-10-20 00:00:00'),
(79, '2H3TE-XJT1E-TC', 10000, b'0', '2021-04-20 00:00:00', '2021-10-20 00:00:00'),
(80, '780BF-I2JQS-9B', 10000, b'0', '2021-04-20 00:00:00', '2021-10-20 00:00:00'),
(81, 'PYURN-2QWZY-5J', 10000, b'0', '2021-04-20 00:00:00', '2021-10-20 00:00:00'),
(82, '90LIC-6HIKS-JD', 10000, b'0', '2021-04-20 00:00:00', '2021-10-20 00:00:00'),
(83, 'UYKM0-L9Z5P-8C', 10000, b'0', '2021-04-20 00:00:00', '2021-10-20 00:00:00'),
(87, 'TPYK4-NCH2O-Q6', 50000, b'0', '2021-04-25 00:00:00', '2021-10-25 00:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `thecao`
--
ALTER TABLE `thecao`
  ADD PRIMARY KEY (`IDThe`),
  ADD UNIQUE KEY `SoSeri` (`SoSeri`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `thecao`
--
ALTER TABLE `thecao`
  MODIFY `IDThe` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
