-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 03:38 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

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
CREATE DATABASE IF NOT EXISTS `tstingp_furniture_website` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tstingp_furniture_website`;

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

DROP TABLE IF EXISTS `jenis`;
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
(3, 'Bookshelf', 4),
(4, 'Stools', 3),
(5, 'sofa', 3),
(6, 'Outdoor Chair', 3),
(7, 'Foldable Chair', 3),
(8, 'office chair', 3),
(9, 'Bar Stools', 3),
(10, 'Gaming Chair', 3);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
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

DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `kode_produk` int(11) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `desc_produk` varchar(100) DEFAULT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `kode_jenis` int(11) NOT NULL,
  `url_gambar` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `desc_produk`, `harga_produk`, `stok_produk`, `kode_jenis`, `url_gambar`) VALUES
(1, 'Brimnes', 'Wardrobe with 2 doors, white, 78x190 cm', 2099000, 5, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/406/0140624_PE300605_S4.jpg'),
(3, 'baggebo', 'Rak buku, putih, 50x30x80 cm', 299000, 8, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/189/1018918_PE831218_S4.jpg'),
(5, 'Vuku', 'Wardrobe, white, 74x51x149 cm', 299000, 6, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/980/0498088_PE629449_S4.jpg'),
(6, 'GRIMSBU', 'Bed frame, grey/luröy, 90x200 cm', 1099000, 3, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/492/0749251_PE747239_S5.jpg'),
(7, 'SLATTUM', 'Upholstered bed frame, knisa light grey, 120x200 cm', 1799000, 5, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/471/0947171_PE798382_S4.jpg'),
(8, 'IDANÄS', 'Upholstered ottoman bed, gunnared pale pink, 180x200 cm', 10199000, 13, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/124/1012433_PE829083_S4.jpg'),
(9, 'TYSSEDAL', 'Bed frame, white/luröy, 90x200 cm', 3499000, 13, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/491/0749137_PE745493_S4.jpg'),
(10, 'KLEPPSTAD', 'Wardrobe with 3 doors, white, 117x176 cm', 1999000, 2, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/535/0753594_PE748782_S4.jpg'),
(13, 'MARIUS', 'Stool, black, 45 cm', 70000, 10, 4, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/273/0727386_PE735638_S4.jpg'),
(14, 'ODDVAR', 'Stool, pine', 175000, 20, 4, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/273/0727390_PE735642_S4.jpg'),
(15, 'INGOLF', 'Stool, white', 495000, 15, 4, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/273/0727383_PE735636_S4.jpg'),
(16, 'KYRRE', 'Stool, black', 275000, 13, 4, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/141/0714155_PE729953_S4.jpg'),
(17, 'RÅSKOG', 'Bar stool, black, 63 cm', 495000, 18, 4, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/280/0728072_PE736045_S4.jpg'),
(18, 'JANINGE', 'Bar stool, white, 76 cm', 1795000, 7, 4, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/280/0728069_PE736042_S4.jpg'),
(19, 'GLENN', 'Bar stool, white/chrome-plated, 77 cm', 1499000, 45, 9, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/524/0452400_PE601325_S4.jpg'),
(20, 'NORDVIKEN', 'Bar stool with backrest, black, 75 cm', 1250000, 21, 9, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/141/0714185_PE729959_S4.jpg'),
(21, 'FRANKLIN', 'Bar stool with backrest, foldable, white/white, 63 cm', 495000, 16, 9, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/274/0727489_PE735714_S4.jpg'),
(22, 'SKOGSTA', 'Bar stool, acacia, 48x70 cm', 3950000, 12, 9, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/654/0365459_PE548274_S4.jpg'),
(23, 'NILSOLLE', 'Bar stool, birch, 74 cm', 699000, 30, 9, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/822/0082210_PE142507_S4.jpg'),
(24, 'BERGMUND', 'Bar stool with backrest, black/inseros white, 75 cm', 1595000, 12, 9, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/020/1002069_PE824596_S4.jpg'),
(25, 'BERGMUND', 'Bar stool with backrest, black/orrsta light grey, 75 cm', 1595000, 12, 9, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/264/0926477_PE789264_S4.jpg'),
(26, 'BERGMUND', 'Bar stool with backrest, black/rommele dark blue/white, 75 cm', 1595000, 12, 9, 'Rp 1.595.000'),
(27, 'YNGVAR', 'Bar stool, anthracite, 75 cm', 2099000, 17, 9, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/142/0714270_PE729999_S4.jpg'),
(28, 'BERNHARD', 'Bar stool with backrest, chrome-plated/mjuk white, 66 cm', 29990000, 24, 9, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/274/0727477_PE735703_S4.jpg'),
(29, 'BERGMUND', 'Bar stool with backrest, black/gunnared medium grey, 75 cm', 1595000, 19, 9, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/789/0878966_PE781764_S4.jpg'),
(30, 'HEMLINGBY', '2-seat sofa, knisa dark grey', 1799000, 3, 5, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/288/0728848_PE736539_S4.jpg'),
(31, 'NYKIL', '2-seat sofa-bed, dark grey', 1499000, 5, 5, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/commons/1633321084_20515908_S4.jpeg'),
(32, 'GLOSTAD', '2-seat sofa, knisa medium blue', 1799000, 7, 5, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/509/0950900_PE800740_S4.jpg'),
(33, 'GLOSTAD', '2-seat sofa, knisa dark grey', 1799000, 4, 5, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/508/0950864_PE800736_S4.jpg'),
(34, 'INGMARSÖ', '2-seat sofa, in/outdoor, white green/beige, 118x69x69 cm', 1499000, 1, 5, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/284/0928417_PE789849_S4.jpg'),
(35, 'KLIPPAN', 'KLIPPAN', 2899000, 6, 5, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/399/0239990_PE379591_S4.jpg'),
(36, 'HAMMARN', 'Sofa-bed, knisa dark grey/black, 120 cm', 1699000, 3, 5, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/190/0519027_PE641353_S4.jpg'),
(37, ' KLIPPAN', '2-seat sofa, kabusa dark grey', 3199000, 7, 5, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/629/0562986_PE663639_S4.jpg'),
(38, 'KIVIK', 'Two-seat sofa, orrsta light grey', 4499000, 5, 5, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/494/0249483_PE387758_S4.jpg'),
(39, 'FRIHETEN', 'Corner sofa-bed with storage, skiftebo dark grey', 8499000, 5, 5, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/756/0175610_PE328883_S4.jpg'),
(40, 'FEJAN', 'Chair, outdoor, foldable white', 199000, 15, 6, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/283/0728344_PE736190_S4.jpg'),
(41, 'ASKHOLMEN', 'Chair, outdoor, foldable light brown stained', 399000, 21, 6, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/283/0728342_PE736203_S4.jpg'),
(42, 'TORPARÖ', 'Chair with armrests, in/outdoor, white/beige', 499000, 14, 6, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/120/0812003_PE771902_S4.jpg'),
(43, 'ÄPPLARÖ', 'Chair, outdoor, foldable brown stained', 599000, 16, 6, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/651/0665140_PE713007_S4.jpg'),
(44, 'FALHOLMEN', 'Chair with armrests, outdoor, light brown stained', 699000, 11, 6, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/283/0728343_PE736204_S4.jpg'),
(45, 'GUBBÖN', 'Rocking-chair, in/outdoor, white', 1299000, 13, 6, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/257/0825771_PE776354_S4.jpg'),
(46, ' SJÄLLAND', 'Chair with armrests, outdoor, light grey/dark grey', 1499000, 14, 6, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/283/0728350_PE736196_S4.jpg'),
(47, 'HAVSTEN', 'Easy chair, in/outdoor, beige, 83x94x90 cm', 4499000, 12, 6, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/293/0729301_PE736941_S4.jpg'),
(48, 'FRANKLIN', 'Bar stool with backrest, foldable, black/black, 74 cm', 599000, 15, 7, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/274/0727487_PE735712_S4.jpg'),
(49, 'FLINTAN', 'Office chair with armrests, black', 1299000, 16, 8, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/072/1007241_PE825960_S4.jpg'),
(50, 'FLINTAN', 'Office chair, black', 999000, 14, 8, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/072/1007236_PE825956_S4.jpg'),
(51, 'MARKUS', 'Office chair, vissle dark grey', 2299000, 13, 8, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/247/0724714_PE734597_S4.jpg'),
(52, 'FJÄLLBERGET', 'Conference chair, white stained oak veneer/gunnared beige', 2999000, 20, 8, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/247/0724716_PE734599_S4.jpg'),
(53, 'ALEFJÄLL', 'Office chair, grann beige', 4999000, 9, 8, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/247/0724710_PE734592_S4.jpg'),
(54, 'HATTEFJÄLL', 'Office chair, gunnared medium grey', 3499000, 15, 8, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/246/0724694_PE734576_S4.jpg'),
(55, 'LÅNGFJÄLL', 'Office chair with armrests, gunnared dark grey/black', 3199000, 14, 8, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/269/0726990_PE735485_S4.jpg'),
(56, 'LÅNGFJÄLL', 'Conference chair, gunnared beige/white', 1999000, 7, 8, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/254/0725413_PE734845_S4.jpg'),
(57, 'LÅNGFJÄLL', 'Office chair with armrests, gunnared dark grey/black', 2999000, 4, 8, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/269/0726991_PE735482_S4.jpg'),
(58, 'MATCHSPEL', 'Gaming chair, bomstad black', 2799000, 17, 10, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/856/0985645_PE816716_S4.jpg'),
(59, 'UTESPELARE', 'Gaming chair, bomstad grey', 1999000, 4, 10, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/856/0985643_PE816715_S4.jpg'),
(60, 'UTESPELARE', 'Gaming chair, bomstad black', 1999000, 17, 10, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/848/0984819_PE816424_S4.jpg'),
(61, 'HUVUDSPELARE', 'Gaming chair, black', 1199000, 5, 10, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/396/1039672_PE840417_S4.jpg'),
(62, 'MUSKEN', 'Wardrobe with 2 doors+3 drawers, white, 124x60x201 cm', 3999000, 5, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/903/0590338_PE673833_S4.jpg'),
(63, 'PAX', 'Wardrobe frame, white, 100x58x236 cm\r\n', 2199000, 3, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/210/0721077_PE733043_S4.jpg'),
(64, 'SANGESON', 'Wardrobe, white, 120x60x191 cm', 3499000, 9, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/551/0555120_PE660185_S4.jpg'),
(65, 'RAKKESTAD', 'Wardrobe with 3 doors, black-brown, 117x176 cm', 2399000, 10, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/239/0823987_PE776018_S4.jpg'),
(66, 'GODISHUS', 'Wardrobe, white, 60x51x178 cm', 1999000, 11, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/211/0721180_PE735622_S4.jpg'),
(67, 'NORDKISA', 'Open wardrobe with sliding door, bamboo, 120x186 cm', 4299000, 16, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/560/0756084_PE748766_S4.jpg'),
(68, 'BURUNGE', 'Wardrobe, white, 80x140 cm', 2999000, 16, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/426/0642649_PE701364_S4.jpg'),
(69, 'VISTHUS', 'Wardrobe, grey/white, 122x59x216 cm', 599900, 7, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/255/0625545_PE692344_S4.jpg'),
(70, 'SYVDE', 'Cabinet with glass doors, white, 100x123 cm', 2999000, 15, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/208/0720837_PE740012_S4.jpg'),
(71, 'MUSKEN', 'Wardrobe with 2 doors+3 drawers, brown, 124x60x201 cm', 3999000, 14, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/798/0179835_PE332005_S4.jpg'),
(72, 'LAIVA', 'Bookcase, black-brown, 62x165 cm', 399000, 20, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/442/0644278_PE702556_S4.jpg'),
(73, 'BILLY', 'Bookcase, white, 80x28x202 cm', 1999000, 19, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/255/0625599_PE692385_S4.jpg'),
(74, 'BILLY', 'Bookcase, white, 80x28x106 cm', 599000, 5, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/447/0644780_PE702956_S4.jpg'),
(75, ' BILLY / OXBERG', 'Bookcase, white, 80x30x202 cm', 2499000, 24, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/412/0641255_PE700390_S4.jpg'),
(76, 'HEMNES', 'Bookcase, white stain/light brown, 90x198 cm\r\n', 2999000, 20, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/800/0980092_PE814822_S4.jpg'),
(77, 'SMÅGÖRA', 'Changing table/bookshelf, white', 1799000, 17, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/732/0773261_PE756246_S4.jpg'),
(78, 'BERGIG', 'Book display with storage, white', 2199000, 21, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/442/0844238_PE783371_S4.jpg'),
(79, ' BILLY / MORLIDEN', 'Bookcase with glass door, white/glass, 40x30x106 cm', 999000, 9, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/679/0667924_PE714170_S4.jpg'),
(80, 'EKENABBEN', 'Open shelving unit, aspen/white, 70x34x86 cm', 699000, 8, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/294/1029426_PE835815_S4.jpg'),
(81, 'LIATORP', 'Bookcase, white, 96x215 cm\r\n', 4999000, 14, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/442/0644273_PE702551_S4.jpg'),
(82, 'SMÅGÖRA', 'Changing tbl/bookshelf w 1 shlf ut, white\r\n', 2199000, 19, 3, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/777/0777789_PE758717_S4.jpg'),
(83, 'TUFFING', 'Bunk bed frame, dark grey, 90x200 cm', 1999000, 19, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/380/0638044_PE698660_S4.jpg'),
(84, 'NESTTUN', 'Bed frame, white/luröy, 120x200 cm', 1899000, 14, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/306/0430662_PE584729_S4.jpg'),
(85, 'SLÄKT', 'Bed frame with underbed and storage, white, 90x200 cm', 4399000, 16, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/377/0637775_PE698535_S4.jpg'),
(86, 'UTÅKER', 'Stackable bed, pine, 80x200 cm', 2499000, 13, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/550/0655003_PE708895_S4.jpg'),
(87, 'MALM', 'Bed frame, high, w 2 storage boxes, white/luröy, 120x200 cm', 3699000, 12, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/488/0948881_PE799354_S4.jpg'),
(88, 'MINNEN', 'Ext bed frame with slatted bed base, white, 80x200 cm', 1799000, 17, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/362/0636271_PE697771_S4.jpg'),
(89, 'TARVA', 'Bed frame, pine/luröy, 90x200 cm', 1599000, 12, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/550/0655004_PE708894_S4.jpg'),
(90, 'NORDLI', 'Bed frame with storage, white, 120x200 cm', 44999000, 13, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/550/0655083_PE708900_S4.jpg'),
(91, 'TARVA', 'Bed frame, pine/lönset, 120x200 cm', 2599000, 13, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/550/0655004_PE708894_S4.jpg'),
(92, 'SANGESON', 'Bed frame, brown/luröy, 160x200 cm', 2999000, 13, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/385/0638582_PE699001_S4.jpg'),
(93, 'VITVAL', 'Loft bed frame with desk top, white/light grey, 90x200 cm', 4599000, 15, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/881/0688141_PE722337_S4.jpg'),
(94, 'SAGSTUA', 'Bed frame, white/lönset, 120x200 cm', 3599000, 12, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/832/0783214_PE761515_S4.jpg'),
(95, 'FLEKKE', 'Day-bed w 2 drawers/2 mattresses, white/moshult firm, 80x200 cm', 6999000, 14, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/549/0654991_PE708885_S4.jpg'),
(96, 'BLÅKULLEN', 'Uph bed frame with corner headboard, knisa medium blue, 90x200 cm', 2199000, 21, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/954/0995498_PE821743_S4.jpg'),
(97, 'ESPEVÄR', 'Slatted mattress base, dark grey, 120x200 cm', 3399000, 14, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/077/0407770_PE570641_S4.jpg'),
(98, 'GONATT', 'Cot with drawer, white, 60x120 cm', 3499000, 17, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/420/0842037_PE778850_S4.jpg'),
(99, 'SANDISK', 'Ext bed frame with slatted bed base, grey, 80x200 cm', 3299000, 13, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/578/0957811_PE806113_S4.jpg'),
(100, 'BRIMNES', 'Bed frame with storage, white/luröy, 120x200 cm', 3499000, 14, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/393/0639331_PE699518_S4.jpg'),
(101, 'GRIMSBU', 'Bed frame, grey/luröy, 90x200 cm\r\n', 1099000, 5, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/492/0749251_PE747239_S4.jpg'),
(102, 'VADSÖ', 'Spring mattress, extra firm/light blue, 90x200 cm', 799000, 3, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/987/0898718_PE782604_S4.jpg'),
(103, 'VADSÖ', 'Spring mattress, extra firm/light blue, 90x200 cm', 799000, 3, 1, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/987/0898718_PE782604_S4.jpg'),
(104, 'PAX', 'Wardrobe frame, white, 100x58x236 cm\r\n', 3299000, 11, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/210/0721077_PE733043_S4.jpg'),
(105, ' PAX / VIKEDAL', 'Wardrobe combination, white/mirror glass, 150x60x201 cm', 7499000, 3, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/353/0935354_PE792735_S4.jpg'),
(106, 'FÄRVIK', 'Pair of sliding doors, white glass, 150x236 cm', 5199000, 8, 2, 'https://d2xjmi1k71iy2m.cloudfront.net/dairyfarm/id/images/404/0640492_PE699863_S4.jpg'),
(107, 'AHIHIHI', 'AHIHIHI with a lot of fun', 100000, 10, 9, 'https://www.pngitem.com/pimgs/m/552-5522068_thumb-image-bernard-bear-png-transparent-png.png'),
(108, 'AWUWUWU', 'awuwuwu with a lot of noise', 10000, 4, 9, 'https://www.pngitem.com/pimgs/m/552-5522068_thumb-image-bernard-bear-png-transparent-png.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
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
(2, 'acxel', 'derian', 'acxel', 'acxel@gmail.com', 1000000),
(3, 'ziiie', 'awuwu', 'Jonathan Kenzie', 'jokenlims@gmail.com', 1000000),
(4, 'dummy', 'dummy', 'dummy', 'dummy@gmail.com', 1000000);

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
  MODIFY `kode_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kode_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `kode_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `kode_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
