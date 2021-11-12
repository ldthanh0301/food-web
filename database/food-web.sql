-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 03:17 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-web`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `SoDonDH` int(11) NOT NULL,
  `MSHH` varchar(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaDatHang` int(11) NOT NULL,
  `GiamGia` int(11) NOT NULL,
  `MaDC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dathang`
--

CREATE TABLE `dathang` (
  `SoDonDH` int(11) NOT NULL,
  `MSKH` varchar(10) NOT NULL,
  `MSNV` varchar(10) DEFAULT NULL,
  `NgayDH` timestamp NOT NULL DEFAULT current_timestamp(),
  `TrangThaiDH` tinyint(4) NOT NULL,
  `TongTien` int(11) NOT NULL,
  `MaDC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `diachikh`
--

CREATE TABLE `diachikh` (
  `MaDC` int(11) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `MSKH` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diachikh`
--

INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES
(45, 'Nhơn mỹ', 'KH76f038b');

-- --------------------------------------------------------

--
-- Table structure for table `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MSHH` varchar(10) NOT NULL,
  `TenHH` varchar(255) NOT NULL,
  `MoTa` text NOT NULL,
  `Gia` int(11) NOT NULL,
  `SoLuongHang` int(11) NOT NULL,
  `MaLoaiHang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hanghoa`
--

INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `MoTa`, `Gia`, `SoLuongHang`, `MaLoaiHang`) VALUES
('Pe4f551f05', '2 MIẾNG GÀ GIÒN', '2 MIẾNG GÀ GIÒN', 60, 10000, 11),
('Pe4f878865', '4 MIẾNG GÀ GIÒN', '4 MIẾNG GÀ GIÒN', 116000, 1000000, 11),
('Pe4fe41042', '6 MIẾNG GÀ GIÒN', '6 MIẾNG GÀ GIÒN', 174000, 100000, 11),
('Pe5021e192', '01 MIẾNG GÀ GIÒN VUI VẺ + 01 MỲ Ý SỐT BÒ BẰM + 01 NƯỚC NGỌT (VỪA)', '01 MIẾNG GÀ GIÒN VUI VẺ + 01 MỲ Ý SỐT BÒ BẰM + 01 NƯỚC NGỌT (VỪA)', 65000, 10000, 12),
('Pe504d4cd8', 'MÌ Ý SỐT BÒ BẰM LỚN + 2 MIẾNG GÀ KHÔNG XƯƠNG + KHOAI TÂY VỪA + NƯỚC NGỌT', 'MÌ Ý SỐT BÒ BẰM LỚN + 2 MIẾNG GÀ KHÔNG XƯƠNG + KHOAI TÂY VỪA + NƯỚC NGỌT', 75000, 5000, 12),
('Pe5078cde6', 'MÌ Ý SỐT BÒ BẰM', 'MÌ Ý SỐT BÒ BẰM', 30000, 3000, 12),
('Pe50c03aeb', 'SANDWICH GÀ GIÒN + NƯỚC NGỌT', 'SANDWICH GÀ GIÒN + NƯỚC NGỌT', 30000, 6000, 10),
('Pe50f60a05', 'SANDWICH GÀ GIÒN', 'SANDWICH GÀ GIÒN', 25000, 4000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `hinhhanghoa`
--

CREATE TABLE `hinhhanghoa` (
  `MaHinh` int(11) NOT NULL,
  `TenHinh` varchar(255) NOT NULL,
  `MSHH` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hinhhanghoa`
--

INSERT INTO `hinhhanghoa` (`MaHinh`, `TenHinh`, `MSHH`) VALUES
(34, 'image618e4f551fc0f.png', 'Pe4f551f05'),
(35, 'image618e4f878914e.png', 'Pe4f878865'),
(36, 'image618e4fe410bc8.png', 'Pe4fe41042'),
(37, 'image618e5021e219a.png', 'Pe5021e192'),
(38, 'image618e504d4d41a.png', 'Pe504d4cd8'),
(39, 'image618e5078ce58b.png', 'Pe5078cde6'),
(40, 'image618e50c03b539.png', 'Pe50c03aeb'),
(41, 'image618e50f60a7c6.jpg', 'Pe50f60a05');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MSKH` varchar(10) NOT NULL,
  `HoTenKH` varchar(255) NOT NULL,
  `SoDienThoai` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `SoDienThoai`, `Email`, `username`, `password`) VALUES
('KH76f038b', 'Thanh', '0333618825', 'Thanh123@gmail.com', 'ldthanh2', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `loaihanghoa`
--

CREATE TABLE `loaihanghoa` (
  `MaLoaiHang` int(11) NOT NULL,
  `TenLoaiHang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES
(10, 'Burger & Cơm'),
(11, 'Gà Chiên Giòn'),
(12, 'Mì Ý'),
(13, 'Món Tráng Miệng');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `HoTenNV` varchar(255) NOT NULL,
  `ChucVu` varchar(255) NOT NULL,
  `DiaChi` varchar(500) NOT NULL,
  `SoDienThoai` varchar(255) NOT NULL,
  `MSNV` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `MSNV`, `username`, `password`) VALUES
('Lê Duy Thanh', '3', '123 Trần Văn Hoài, Ninh Kiều', '0333618825', 'staff2705f', 'ldthanh', '827ccb0eea8a706c4c34a16891f84e7b'),
('Yến Linh', '1', 'Nhơn mỹ', '0333618825', 'staff3e9eb', 'ylinh', '827ccb0eea8a706c4c34a16891f84e7b'),
('Phan Hữu Phúc', '0', 'Nhơn mỹ', '0333618825', 'staff590bc', 'phphuc', '827ccb0eea8a706c4c34a16891f84e7b'),
('Trương Thiện Tín', '0', 'An Châu', '0333618825', 'staff79e6b', 'tttin', '827ccb0eea8a706c4c34a16891f84e7b'),
('Trần Thị Mỹ Tiên', '2', 'Nhơn mỹ', '0333618825', 'staffb8cb2', 'ttmtien', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD KEY `SoDonDH` (`SoDonDH`),
  ADD KEY `MSHH_Chitietdathang` (`MSHH`),
  ADD KEY `MaDC_chitietdathang` (`MaDC`);

--
-- Indexes for table `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`SoDonDH`),
  ADD KEY `MSNV_DatHang` (`MSNV`),
  ADD KEY `MSKH_DatHang` (`MSKH`),
  ADD KEY `MaDC_DatHang` (`MaDC`);

--
-- Indexes for table `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`MaDC`),
  ADD KEY `MSKH_DiachiKH` (`MSKH`);

--
-- Indexes for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`MSHH`),
  ADD KEY `MaLoaiHang_hanghoa` (`MaLoaiHang`);

--
-- Indexes for table `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD PRIMARY KEY (`MaHinh`),
  ADD KEY `MSHH_HinhHangHoa` (`MSHH`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MSKH`),
  ADD UNIQUE KEY `unique_username_khachhang` (`username`);

--
-- Indexes for table `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`MaLoaiHang`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD UNIQUE KEY `unique_nhanvien` (`MSNV`),
  ADD UNIQUE KEY `unique_username_nhanvien` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dathang`
--
ALTER TABLE `dathang`
  MODIFY `SoDonDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `MaDC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  MODIFY `MaHinh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  MODIFY `MaLoaiHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `MSHH_Chitietdathang` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`) ON UPDATE CASCADE,
  ADD CONSTRAINT `MaDC_chitietdathang` FOREIGN KEY (`MaDC`) REFERENCES `diachikh` (`MaDC`),
  ADD CONSTRAINT `SoDonDH` FOREIGN KEY (`SoDonDH`) REFERENCES `dathang` (`SoDonDH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `MSKH_DatHang` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`) ON UPDATE CASCADE,
  ADD CONSTRAINT `MSNV_DatHang` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`) ON UPDATE CASCADE,
  ADD CONSTRAINT `MaDC_DatHang` FOREIGN KEY (`MaDC`) REFERENCES `diachikh` (`MaDC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `MSKH_DiachiKH` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `MaLoaiHang_hanghoa` FOREIGN KEY (`MaLoaiHang`) REFERENCES `loaihanghoa` (`MaLoaiHang`);

--
-- Constraints for table `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD CONSTRAINT `MSHH_HinhHangHoa` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
