-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2023 at 03:36 PM
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
-- Database: `drive_thru`
--

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `menu` varchar(10) DEFAULT NULL,
  `akses` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `user`, `menu`, `akses`) VALUES
(2, 1, 'ADMIN', 'Y'),
(3, 10, 'ADMIN', 'N'),
(4, 10, 'KASIR', 'N'),
(5, 10, 'OUTDOOR', 'N'),
(6, 10, 'DAPUR', 'Y'),
(7, 10, 'PENGAMBILA', 'N'),
(8, 8, 'ADMIN', 'N'),
(9, 8, 'KASIR', 'N'),
(10, 8, 'OUTDOOR', 'Y'),
(11, 8, 'DAPUR', 'N'),
(12, 8, 'PENGAMBILA', 'N'),
(13, 7, 'ADMIN', 'N'),
(14, 7, 'KASIR', 'Y'),
(15, 7, 'OUTDOOR', 'N'),
(16, 7, 'DAPUR', 'N'),
(17, 7, 'PENGAMBILA', 'N'),
(18, 9, 'ADMIN', 'N'),
(19, 9, 'KASIR', 'N'),
(20, 9, 'OUTDOOR', 'N'),
(21, 9, 'DAPUR', 'N'),
(22, 9, 'PENGAMBILA', 'Y'),
(23, 11, 'ADMIN', 'N'),
(24, 11, 'KASIR', 'N'),
(25, 11, 'OUTDOOR', 'N'),
(26, 11, 'DAPUR', 'N'),
(27, 11, 'PENGAMBILA', 'N'),
(28, 2, 'ADMIN', 'N'),
(29, 2, 'KASIR', 'N'),
(30, 2, 'OUTDOOR', 'N'),
(31, 2, 'DAPUR', 'N'),
(32, 2, 'PENGAMBILA', 'N'),
(33, 11, 'AMBIL_CS', 'Y'),
(34, 2, 'KASIR_CS', 'Y'),
(35, 2, 'AMBIL_CS', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `kasir_outdoor`
--

CREATE TABLE `kasir_outdoor` (
  `kasir` int(11) NOT NULL,
  `masuk` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kasir_outdoor`
--

INSERT INTO `kasir_outdoor` (`kasir`, `masuk`) VALUES
(7, '2023-09-05 05:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `gambar` varchar(20) DEFAULT NULL,
  `proses_dapur` varchar(1) DEFAULT NULL,
  `aktif` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `gambar`, `proses_dapur`, `aktif`) VALUES
(1, 'FOOD', 'food.png', 'Y', 'Y'),
(2, 'DRINK', 'drink.png', 'Y', 'Y'),
(3, 'PACKAGE', 'package.png', 'Y', 'Y'),
(4, 'ADD ONS', 'addon.png', 'Y', 'Y'),
(9, 'SNACK', 'snack.png', 'T', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `kode`, `nama`) VALUES
(1, 'ADMIN', 'Admin'),
(2, 'KASIR', 'Kasir'),
(4, 'OUTDOOR', 'Outdoor'),
(5, 'DAPUR', 'Dapur'),
(6, 'PENGAMBILA', 'Pengambilan'),
(7, 'AMBIL_CS', 'Pengambilan CS'),
(3, 'KASIR_CS', 'Kasir CS');

-- --------------------------------------------------------

--
-- Table structure for table `nourut`
--

CREATE TABLE `nourut` (
  `tgl` varchar(10) NOT NULL,
  `noakhir` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nourut`
--

INSERT INTO `nourut` (`tgl`, `noakhir`) VALUES
('230820002', 1),
('230820007', 1),
('230824002', 1),
('230824007', 5),
('230825007', 2),
('230825000', 1),
('230825002', 2),
('230829002', 2),
('230901002', 5),
('230901007', 1),
('230904007', 1),
('230904002', 1),
('230905007', 2);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kategori` int(11) DEFAULT NULL,
  `sku` varchar(30) DEFAULT NULL,
  `barcode` varchar(50) DEFAULT NULL,
  `gambar` varchar(30) DEFAULT NULL,
  `harga` decimal(16,2) DEFAULT NULL,
  `aktif` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `kategori`, `sku`, `barcode`, `gambar`, `harga`, `aktif`) VALUES
(1, 'Burger', 1, 'P00001', '324324832844', 'burger.jpg', '15000.00', 'Y'),
(2, 'HotDog', 1, 'P00002', '483249348444', 'hotdog.jpg', '12000.00', 'Y'),
(3, 'Fried Chicken', 3, 'P00003', '342343244343', 'fried_chicken.jpg', '25000.00', 'Y'),
(4, 'Ice Tea', 2, 'P00004', NULL, 'es_teh.jpg', '8000.00', 'Y'),
(5, 'Fanta', 2, 'P00005', '213213123123', 'fanta.jpg', '10000.00', 'Y'),
(6, 'Coca Cola', 2, 'P00006', NULL, 'cola.jpg', '10000.00', 'Y'),
(14, 'Chitato Sapi Panggang', 9, '32432432432', '123456721', '1692932543.jpg', '5500.00', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `nama_pt` varchar(50) DEFAULT NULL,
  `alamat` varchar(60) DEFAULT NULL,
  `telp` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`nama_pt`, `alamat`, `telp`) VALUES
('DRIVE THRUU', 'Jl. Kemerdekaan 11, Timor Leste', '0892301231');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `bukti` varchar(20) NOT NULL,
  `tgl` date DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `cust` varchar(30) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `jns_kasir` varchar(1) DEFAULT NULL,
  `kasir` int(11) DEFAULT NULL,
  `sub_total` decimal(16,2) DEFAULT NULL,
  `ppn` decimal(16,2) DEFAULT NULL,
  `disc` decimal(16,2) DEFAULT NULL,
  `ndisc` decimal(16,2) DEFAULT NULL,
  `total` decimal(16,2) DEFAULT NULL,
  `voucher` varchar(20) DEFAULT NULL,
  `jns_bayar` varchar(1) DEFAULT NULL,
  `no_kartu` varchar(20) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `diambil` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`bukti`, `tgl`, `waktu`, `cust`, `catatan`, `telp`, `jns_kasir`, `kasir`, `sub_total`, `ppn`, `disc`, `ndisc`, `total`, `voucher`, `jns_bayar`, `no_kartu`, `status`, `diambil`) VALUES
('230901002002', '2023-09-01', '2023-09-01 11:03:53', '', '', '', '2', 2, '23000.00', '0.00', NULL, NULL, '23000.00', NULL, NULL, NULL, '0', 'N'),
('230901002003', '2023-09-01', '2023-09-01 11:07:59', '', '', '', '2', 2, '27000.00', '0.00', '10.00', '2700.00', '24300.00', 'abcd', '2', '2737123123', '2', 'Y'),
('230901002004', '2023-09-01', '2023-09-01 11:25:24', '', '', '', '2', 2, '15000.00', '0.00', '10.00', '1500.00', '13500.00', 'abcd', '2', 'dfdfewrwer', '2', 'N'),
('230901007001', '2023-09-01', '2023-09-01 11:27:29', 'eqweqwe', 'saous yang pedas', '3343242', '1', 7, '27000.00', '0.00', '10.00', '2700.00', '24300.00', 'abcd', '2', 'erqewqewqeq', '2', 'N'),
('230901002005', '2023-09-01', '2023-09-01 12:59:30', '34324', '', '34324', '2', 2, '48000.00', '0.00', '10.00', '4800.00', '43200.00', 'abcd', '1', '', '2', 'N'),
('230901002006', '2023-09-01', '2023-09-01 13:03:51', '', '', '', '2', 2, '15000.00', '0.00', NULL, NULL, '15000.00', NULL, NULL, NULL, '0', 'N'),
('230904002001', '2023-09-04', '2023-09-04 09:14:57', '', '', '', '2', 2, '90000.00', '0.00', '10.00', '9000.00', '81000.00', 'ABCD', '1', '', '2', 'N'),
('230904007001', '2023-09-04', '2023-09-04 21:30:45', 'ewqe', '', 'qwe', '1', 7, '39000.00', '0.00', NULL, NULL, '39000.00', NULL, '1', NULL, '2', 'N'),
('230905002001', '2023-09-05', '2023-09-05 04:58:20', 'weeqw', 'Saos lagi', 'eqweqweqweq', '2', 2, '30000.00', '0.00', NULL, NULL, '30000.00', NULL, '1', NULL, '2', 'N'),
('230905007001', '2023-09-05', '2023-09-05 05:19:49', 'ALI', 'sambel', '0431231231', '1', 7, '27000.00', '0.00', NULL, NULL, '27000.00', NULL, '2', NULL, '2', 'N'),
('230905007002', '2023-09-05', '2023-09-05 05:23:01', 'HERU', 'Panas', '0231233123', '1', 7, '30000.00', '0.00', NULL, NULL, '30000.00', NULL, '', NULL, '3', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL,
  `bukti` varchar(20) DEFAULT NULL,
  `produk` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `hsatuan` decimal(16,2) DEFAULT NULL,
  `harga` decimal(16,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id`, `bukti`, `produk`, `qty`, `hsatuan`, `harga`) VALUES
(1, '230901002002', 1, 1, '15000.00', '15000.00'),
(2, '230901002002', 4, 1, '8000.00', '8000.00'),
(3, '230901002003', 1, 1, '15000.00', '15000.00'),
(4, '230901002003', 2, 1, '12000.00', '12000.00'),
(5, '230901002004', 1, 1, '15000.00', '15000.00'),
(6, '230901007001', 1, 1, '15000.00', '15000.00'),
(7, '230901007001', 2, 1, '12000.00', '12000.00'),
(8, '230901002005', 1, 1, '15000.00', '15000.00'),
(9, '230901002005', 3, 1, '25000.00', '25000.00'),
(10, '230901002005', 4, 1, '8000.00', '8000.00'),
(11, '230901002006', 1, 1, '15000.00', '15000.00'),
(14, '230904007001', 1, 1, '15000.00', '15000.00'),
(13, '230904002001', 5, 6, '15000.00', '90000.00'),
(15, '230904007001', 2, 2, '12000.00', '24000.00'),
(17, '230905002001', 1, 2, '15000.00', '30000.00'),
(18, '230905007001', 1, 1, '15000.00', '15000.00'),
(19, '230905007001', 2, 1, '12000.00', '12000.00'),
(20, '230905007002', 1, 2, '15000.00', '30000.00'),
(21, '230904007001', 6, 4, NULL, NULL),
(22, '230904007001', 3, 8, NULL, NULL),
(23, '230904007001', 7, 5, NULL, NULL),
(24, '230904007001', 4, 3, NULL, NULL),
(25, '230904007001', 5, 7, NULL, NULL),
(26, '230904007001', 14, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `aktif` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `aktif`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Y'),
(2, 'kasir2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Y'),
(3, 'agustinus', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Y'),
(7, 'kasir', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Y'),
(8, 'outdoor', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Y'),
(9, 'pengambilan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Y'),
(10, 'dapur', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Y'),
(11, 'pengambilan2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `disc` decimal(16,2) DEFAULT NULL,
  `ndisc` decimal(16,2) DEFAULT NULL,
  `quota` int(11) DEFAULT NULL,
  `aktif` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id`, `kode`, `disc`, `ndisc`, `quota`, `aktif`) VALUES
(1, 'ABCD', '10.00', '0.00', 18, 'Y'),
(4, 'FGHIJ', '0.00', '1000.00', 30, 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kasir_outdoor`
--
ALTER TABLE `kasir_outdoor`
  ADD PRIMARY KEY (`kasir`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`,`nama`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nourut`
--
ALTER TABLE `nourut`
  ADD PRIMARY KEY (`tgl`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`bukti`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
