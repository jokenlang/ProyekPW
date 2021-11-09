-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2021 at 04:08 AM
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
CREATE DATABASE IF NOT EXISTS `furniture_website` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `furniture_website`;

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

DROP TABLE IF EXISTS `jenis`;
CREATE TABLE IF NOT EXISTS `jenis` (
  `kode_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(30) NOT NULL,
  `kode_kategori` int(11) NOT NULL,
  PRIMARY KEY (`kode_jenis`),
  KEY `fk_kode_kategori` (`kode_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

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

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `kode_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(20) NOT NULL,
  PRIMARY KEY (`kode_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

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

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `kode_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(30) NOT NULL,
  `desc_produk` varchar(100) DEFAULT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `kode_jenis` int(11) NOT NULL,
  `url_gambar` varchar(200) NOT NULL,
  PRIMARY KEY (`kode_produk`),
  KEY `fk_kode_jenis` (`kode_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `desc_produk`, `harga_produk`, `stok_produk`, `kode_jenis`, `url_gambar`) VALUES
(1, 'Brimnes', 'Wardrobe with 2 doors, white, 78x190 cm', 2099000, 5, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/406/0140624_PE300605_S4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `kode_user` int(11) NOT NULL,
  `username_user` varchar(30) NOT NULL,
  `password_user` varchar(20) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `email_user` varchar(30) NOT NULL,
  `saldo_user` int(11) NOT NULL,
  PRIMARY KEY (`kode_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_user`, `username_user`, `password_user`, `nama_user`, `email_user`, `saldo_user`) VALUES
(0, 'adi', '123', 'adi', 'adi@gmail.com', 1000000);

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
