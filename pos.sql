-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2014 at 08:10 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `ID_BARANG` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA` varchar(50) NOT NULL,
  `STOK` int(11) NOT NULL,
  `HARGA_BELI` int(11) NOT NULL,
  `HARGA_JUAL` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_BARANG`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_BARANG`, `NAMA`, `STOK`, `HARGA_BELI`, `HARGA_JUAL`, `STATUS`) VALUES
(1, 'Coca Colas', 83, 2500, 3750, 'Launch'),
(2, 'Sprite', 47, 3300, 3800, 'Standby'),
(3, 'Pepsi', 122, 4500, 5000, 'Launch'),
(4, 'Fanta', 64, 5000, 5500, 'Standby'),
(5, 'Pocari', 52, 3000, 3500, 'Standby'),
(6, 'Kopiko', 12, 6000, 6500, 'Launch'),
(7, 'M&M', 82, 10000, 10500, 'Standby'),
(8, 'Monster', 33, 15000, 15500, 'Launch'),
(9, 'Kratingdaeng', 124, 4000, 4500, 'Launch'),
(10, 'Mizone', 34, 4000, 4500, 'Launch'),
(11, 'Fruit Tea', 39, 5500, 6000, 'Launch'),
(12, 'Nescafe Original', 11, 6000, 6500, 'Launch'),
(13, 'Milkita Susu', 5, 7300, 8000, 'Standby');

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaksi`
--

CREATE TABLE IF NOT EXISTS `detailtransaksi` (
  `ID_DETAIL` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TRANSAKSI` int(11) NOT NULL,
  `ID_BARANG` int(11) NOT NULL,
  `JUMLAH` int(11) NOT NULL,
  `HARGA` int(11) NOT NULL,
  PRIMARY KEY (`ID_DETAIL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

--
-- Dumping data for table `detailtransaksi`
--

INSERT INTO `detailtransaksi` (`ID_DETAIL`, `ID_TRANSAKSI`, `ID_BARANG`, `JUMLAH`, `HARGA`) VALUES
(1, 1, 1, 3, 3000),
(2, 2, 3, 40, 4500),
(3, 3, 4, 3, 5000),
(4, 4, 1, 3, 3000),
(5, 4, 3, 2, 4500),
(6, 4, 2, 1, 3000),
(7, 7, 1, 2, 3000),
(8, 7, 2, 3, 3000),
(9, 7, 4, 4, 5000),
(10, 8, 2, 2, 3000),
(11, 8, 1, 1, 3000),
(12, 8, 3, 1, 4500),
(13, 9, 2, 2, 3000),
(14, 9, 3, 3, 4500),
(15, 9, 4, 5, 5000),
(16, 10, 2, 2, 3000),
(17, 10, 3, 3, 4500),
(18, 10, 4, 5, 5000),
(19, 11, 2, 2, 3000),
(20, 11, 3, 3, 4500),
(21, 11, 4, 5, 5000),
(22, 12, 2, 2, 3000),
(23, 12, 3, 3, 4500),
(24, 12, 4, 5, 5000),
(25, 13, 2, 2, 3000),
(26, 13, 3, 3, 4500),
(27, 13, 4, 5, 5000),
(28, 14, 2, 2, 3000),
(29, 14, 3, 3, 4500),
(30, 14, 4, 5, 5000),
(31, 15, 2, 2, 3000),
(32, 15, 3, 3, 4500),
(33, 15, 4, 5, 5000),
(34, 16, 2, 2, 3000),
(35, 16, 3, 3, 4500),
(36, 16, 4, 5, 5000),
(37, 17, 2, 2, 3000),
(38, 17, 3, 3, 4500),
(39, 17, 4, 5, 5000),
(40, 18, 2, 2, 3000),
(41, 18, 3, 3, 4500),
(42, 18, 4, 5, 5000),
(43, 19, 2, 3, 3000),
(44, 19, 4, 2, 5000),
(45, 20, 5, 2, 3000),
(46, 21, 1, 5, 2700),
(47, 21, 2, 3, 3000),
(48, 21, 4, 2, 5000),
(49, 21, 5, 10, 3000),
(50, 22, 6, 0, 0),
(51, 23, 1, 2, 2700),
(52, 23, 3, 3, 4500),
(53, 24, 7, 30, 10000),
(54, 25, 1, 2, 2700),
(55, 25, 3, 2, 4500),
(56, 26, 4, 3, 5000),
(57, 26, 7, 32, 10000),
(58, 27, 6, 10, 6000),
(59, 28, 1, 3, 2800),
(60, 28, 5, 2, 3000),
(61, 28, 7, 1, 10000),
(62, 28, 3, 2, 4500),
(63, 29, 1, 3, 2800),
(64, 29, 5, 2, 3000),
(65, 29, 7, 1, 10000),
(66, 29, 3, 2, 4500),
(67, 30, 1, 3, 2800),
(68, 30, 5, 2, 3000),
(69, 30, 7, 1, 10000),
(70, 30, 3, 2, 4500),
(71, 31, 1, 3, 2800),
(72, 31, 5, 2, 3000),
(73, 31, 7, 1, 10000),
(74, 31, 3, 2, 4500),
(75, 32, 1, 3, 2800),
(76, 32, 5, 2, 3000),
(77, 32, 7, 1, 10000),
(78, 32, 3, 2, 4500),
(79, 33, 1, 3, 2800),
(80, 33, 5, 2, 3000),
(81, 33, 7, 1, 10000),
(82, 33, 3, 2, 4500),
(83, 34, 1, 3, 2800),
(84, 34, 5, 2, 3000),
(85, 34, 7, 1, 10000),
(86, 34, 3, 2, 4500),
(87, 35, 1, 3, 2800),
(88, 35, 5, 2, 3000),
(89, 35, 7, 1, 10000),
(90, 35, 3, 2, 4500),
(91, 36, 1, 3, 2800),
(92, 36, 5, 2, 3000),
(93, 36, 7, 1, 10000),
(94, 36, 3, 2, 4500),
(95, 37, 1, 3, 2800),
(96, 37, 5, 2, 3000),
(97, 37, 7, 1, 10000),
(98, 37, 3, 2, 4500),
(99, 38, 1, 3, 2800),
(100, 38, 5, 2, 3000),
(101, 38, 7, 1, 10000),
(102, 38, 3, 2, 4500),
(103, 39, 1, 3, 2800),
(104, 39, 5, 2, 3000),
(105, 39, 7, 1, 10000),
(106, 39, 3, 2, 4500),
(107, 40, 1, 3, 2800),
(108, 40, 5, 2, 3000),
(109, 40, 7, 1, 10000),
(110, 40, 3, 2, 4500),
(111, 41, 1, 3, 2800),
(112, 41, 5, 2, 3000),
(113, 41, 7, 1, 10000),
(114, 41, 3, 2, 4500),
(115, 42, 1, 3, 2800),
(116, 42, 5, 2, 3000),
(117, 42, 7, 1, 10000),
(118, 42, 3, 2, 4500),
(119, 43, 1, 3, 2800),
(120, 43, 5, 2, 3000),
(121, 43, 7, 1, 10000),
(122, 43, 3, 2, 4500),
(123, 44, 1, 3, 2800),
(124, 44, 5, 2, 3000),
(125, 44, 7, 1, 10000),
(126, 44, 3, 2, 4500),
(127, 45, 1, 3, 2800),
(128, 45, 5, 2, 3000),
(129, 45, 7, 1, 10000),
(130, 45, 3, 2, 4500),
(131, 46, 1, 3, 2800),
(132, 46, 5, 2, 3000),
(133, 46, 7, 1, 10000),
(134, 46, 3, 2, 4500),
(135, 47, 1, 3, 2800),
(136, 47, 5, 2, 3000),
(137, 47, 7, 1, 10000),
(138, 48, 2, 5, 3000),
(139, 49, 8, 30, 15000),
(140, 50, 9, 20, 4000),
(141, 51, 10, 25, 4000),
(142, 52, 11, 30, 5500),
(143, 53, 12, 5, 6000),
(144, 54, 3, 3, 4500),
(145, 54, 9, 4, 4000),
(146, 54, 10, 5, 4000),
(147, 54, 12, 2, 6000),
(148, 54, 8, 1, 15000),
(149, 54, 11, 1, 5500),
(150, 55, 3, 3, 4500),
(151, 55, 10, 2, 4000),
(152, 55, 11, 4, 5500),
(153, 55, 12, 3, 6000),
(154, 55, 6, 2, 6000),
(155, 56, 1, 1, 2500),
(156, 56, 8, 2, 15000),
(157, 57, 13, 5, 7500),
(158, 58, 11, 2, 5500),
(159, 58, 9, 100, 4000),
(160, 59, 1, 2, 2500),
(161, 59, 11, 2, 5500),
(162, 59, 12, 1, 6000),
(163, 59, 10, 2, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `ID_TRANSAKSI` int(11) NOT NULL AUTO_INCREMENT,
  `USER` varchar(50) NOT NULL,
  `TGLTRANSAKSI` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TOTAL` int(11) NOT NULL,
  PRIMARY KEY (`ID_TRANSAKSI`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`ID_TRANSAKSI`, `USER`, `TGLTRANSAKSI`, `TOTAL`) VALUES
(1, 'albert', '2014-07-07 02:49:18', 9000),
(2, 'albert', '2014-07-07 07:28:24', 180000),
(3, 'antonius', '2014-07-07 08:28:44', 15000),
(4, 'albert', '2014-07-07 11:25:37', 21000),
(7, 'albert', '2014-07-07 11:27:43', 35000),
(8, 'albert', '2014-07-07 11:28:26', 13500),
(9, 'albert', '2014-07-07 11:35:07', 44500),
(10, 'albert', '2014-07-07 11:35:23', 44500),
(11, 'albert', '2014-07-07 11:36:23', 44500),
(12, 'albert', '2014-07-07 11:36:58', 44500),
(13, 'albert', '2014-07-07 11:37:40', 44500),
(14, 'albert', '2014-07-07 11:37:44', 44500),
(15, 'albert', '2014-07-07 11:37:47', 44500),
(16, 'albert', '2014-07-07 11:38:04', 44500),
(17, 'albert', '2014-07-07 11:38:28', 44500),
(18, 'albert', '2014-07-07 11:39:51', 44500),
(19, 'albert', '2014-07-08 00:54:54', 19000),
(20, 'albert', '2014-07-08 01:54:45', 6000),
(21, 'albert', '2014-07-08 02:00:38', 62500),
(22, 'albert', '2014-07-08 02:52:49', 0),
(23, 'albert', '2014-07-08 03:25:42', 18900),
(24, 'albert', '2014-07-08 03:42:04', 300000),
(25, 'albert', '2014-07-08 03:43:00', 14400),
(26, 'albert', '2014-07-08 04:04:23', 335000),
(27, 'albert', '2014-07-08 04:05:02', 60000),
(28, 'albert', '2014-07-08 08:50:56', 33400),
(29, 'albert', '2014-07-08 08:51:44', 33400),
(30, 'albert', '2014-07-08 08:52:10', 33400),
(31, 'albert', '2014-07-08 08:52:33', 33400),
(32, 'albert', '2014-07-08 08:53:03', 33400),
(33, 'albert', '2014-07-08 08:53:07', 33400),
(34, 'albert', '2014-07-08 08:53:34', 33400),
(35, 'albert', '2014-07-08 08:54:14', 33400),
(36, 'albert', '2014-07-08 08:54:30', 33400),
(37, 'albert', '2014-07-08 08:57:14', 33400),
(38, 'albert', '2014-07-08 08:59:26', 33400),
(39, 'albert', '2014-07-08 09:00:45', 33400),
(40, 'albert', '2014-07-08 09:01:15', 33400),
(41, 'albert', '2014-07-08 09:01:26', 33400),
(42, 'albert', '2014-07-08 09:02:09', 33400),
(43, 'albert', '2014-07-08 09:02:28', 33400),
(44, 'albert', '2014-07-08 09:02:57', 33400),
(45, 'albert', '2014-07-08 09:03:19', 33400),
(46, 'albert', '2014-07-08 09:03:48', 33400),
(47, 'albert', '2014-07-08 09:08:47', 24400),
(48, 'albert', '2014-07-11 01:44:15', 15000),
(49, 'albert', '2014-07-11 02:08:59', 450000),
(50, 'albert', '2014-07-11 02:32:55', 80000),
(51, 'albert', '2014-07-11 02:42:10', 100000),
(52, 'albert', '2014-07-11 02:42:34', 165000),
(53, 'albert', '2014-07-11 03:03:33', 30000),
(54, 'albert', '2014-07-11 03:33:50', 82000),
(55, 'albert', '2014-07-11 03:38:52', 73500),
(56, 'albert', '2014-07-11 03:43:34', 32500),
(57, 'albert', '2014-07-11 03:48:53', 37500),
(58, 'albert', '2014-07-11 03:50:37', 411000),
(59, 'albert', '2014-07-11 04:34:30', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'albert', 'tjahyono'),
(2, 'antonius', 'henry');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
