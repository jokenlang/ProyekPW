-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2021 at 05:37 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furniture_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `kode_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(30) NOT NULL,
  `kode_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`kode_jenis`, `nama_jenis`, `kode_kategori`) VALUES
(1, 'Bed Frame', 1),
(2, 'Wardrobe', 4),
(3, 'Bookshelf', 4);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`) VALUES
(1, 'Bed'),
(3, 'Chairs'),
(4, 'Cabinet');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `kode_produk` int(11) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `desc_produk` varchar(100) DEFAULT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `kode_jenis` int(11) NOT NULL,
  `url_gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `desc_produk`, `harga_produk`, `stok_produk`, `kode_jenis`, `url_gambar`) VALUES
(1, 'Brimnes', 'Wardrobe with 2 doors, white, 78x190 cm', 2099000, 5, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/406/0140624_PE300605_S4.jpg'),
(3, 'baggebo', 'Rak buku, putih, 50x30x80 cm', 299000, 8, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/189/1018918_PE831218_S4.jpg'),
(5, 'Vuku', 'Wardrobe, white, 74x51x149 cm', 299000, 6, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/980/0498088_PE629449_S4.jpg'),
(6, 'GRIMSBU', 'Bed frame, grey/luröy, 90x200 cm', 1099000, 3, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/492/0749251_PE747239_S5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kode_user` int(11) NOT NULL,
  `username_user` varchar(30) NOT NULL,
  `password_user` varchar(20) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `email_user` varchar(30) NOT NULL,
  `saldo_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_user`, `username_user`, `password_user`, `nama_user`, `email_user`, `saldo_user`) VALUES
(1, 'adi', '123', 'adi', 'adi@gmail.com', 1000000),
(2, 'acxel', 'derian', 'acxel', 'acxel@gmail.com', 1000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`kode_jenis`),
  ADD KEY `fk_kode_kategori` (`kode_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`),
  ADD KEY `fk_kode_jenis` (`kode_jenis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kode_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `kode_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kode_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `kode_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `kode_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jenis`
--
ALTER TABLE `jenis`
  ADD CONSTRAINT `fk_kode_kategori` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori` (`kode_kategori`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_kode_jenis` FOREIGN KEY (`kode_jenis`) REFERENCES `jenis` (`kode_jenis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
