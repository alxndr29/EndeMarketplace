-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2021 at 09:30 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugasakhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamatmerchant`
--

CREATE TABLE `alamatmerchant` (
  `alamat_lengkap` varchar(45) NOT NULL,
  `telepon` varchar(45) NOT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `merchant_users_iduser` int(11) NOT NULL,
  `kabupatenkota_idkabupatenkota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alamatmerchant`
--

INSERT INTO `alamatmerchant` (`alamat_lengkap`, `telepon`, `latitude`, `longitude`, `created_at`, `updated_at`, `merchant_users_iduser`, `kabupatenkota_idkabupatenkota`) VALUES
('rte', '1', '121.66775249999999', '121.66775249999999', NULL, NULL, 1, 276),
('dasdas', 'asdasd', '-8.832791918904743', '121.65873795747757', NULL, NULL, 4, 122);

-- --------------------------------------------------------

--
-- Table structure for table `alamatpembeli`
--

CREATE TABLE `alamatpembeli` (
  `idalamat` int(11) NOT NULL,
  `simpan_sebagai` varchar(45) NOT NULL,
  `nama_penerima` varchar(45) NOT NULL,
  `alamatlengkap` varchar(45) NOT NULL,
  `telepon` varchar(45) NOT NULL,
  `users_iduser` int(11) NOT NULL,
  `latitude` varchar(45) NOT NULL,
  `longitude` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `kabupatenkota_idkabupatenkota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alamatpembeli`
--

INSERT INTO `alamatpembeli` (`idalamat`, `simpan_sebagai`, `nama_penerima`, `alamatlengkap`, `telepon`, `users_iduser`, `latitude`, `longitude`, `created_at`, `updated_at`, `kabupatenkota_idkabupatenkota`) VALUES
(5, 'Alamat Kos', 'Alexander Evan', 'Kokos raya no 34', '081353522525', 4, '-8.8438137886983', '121.6678360104561', '2021-04-19 04:19:58', '2021-05-07 13:02:35', 122),
(8, 'Alamat Nando', 'Fernando W', 'Rnkut mjt slt', '321', 4, '-7.320648203091388', '112.76708364486696', '2021-04-19 04:33:47', '2021-04-19 16:45:04', 16),
(9, 'Rumah nico', 'i gede bagus', 'erer', '4333', 5, '-8.844187', '121.66775179999999', '2021-04-19 16:47:56', '2021-04-19 16:47:56', 32),
(10, 'EVAN BUPATI', 'Evaan', 'dfdfsdfsd', '324234', 4, '-8.848148880690733', '121.65992669680773', '2021-05-07 23:00:59', '2021-05-07 23:12:39', 27),
(15, 'Alamat Hero', 'ewrwe', 'dfsfds', '2312', 4, '-8.843567304263315', '121.64383756863155', '2021-05-07 23:15:14', '2021-05-07 23:15:14', 106);

-- --------------------------------------------------------

--
-- Table structure for table `datapengiriman`
--

CREATE TABLE `datapengiriman` (
  `iddatapengiriman` int(11) NOT NULL,
  `latitude_user` varchar(45) DEFAULT NULL,
  `longitude_user` varchar(45) DEFAULT NULL,
  `latitude_merchant` varchar(45) DEFAULT NULL,
  `longitude_merchant` varchar(45) DEFAULT NULL,
  `jarak` double DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `status` enum('MenungguPengiriman','SedangDiantar','SampaiTujuan') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `pengiriman_idpengiriman` int(11) NOT NULL,
  `latitude_sekarang` varchar(45) DEFAULT NULL,
  `longitude_sekarang` varchar(45) DEFAULT NULL,
  `jarak_sekarang` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `datapengiriman`
--

INSERT INTO `datapengiriman` (`iddatapengiriman`, `latitude_user`, `longitude_user`, `latitude_merchant`, `longitude_merchant`, `jarak`, `volume`, `berat`, `status`, `created_at`, `updated_at`, `pengiriman_idpengiriman`, `latitude_sekarang`, `longitude_sekarang`, `jarak_sekarang`) VALUES
(2, '-7.320648203091388', '112.76708364486696', '-8.8438137886983', '121.6678360104561', 994.3176266111211, 0, 0, 'MenungguPengiriman', NULL, NULL, 6, NULL, NULL, NULL),
(3, '-8.848148880690733', '121.65992669680773', '-8.832791918904743', '121.65873795747757', 1.7125216390082771, 0, 0, 'MenungguPengiriman', NULL, NULL, 7, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaksi`
--

CREATE TABLE `detailtransaksi` (
  `produk_idproduk` int(11) NOT NULL,
  `transaksi_idtransaksi` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `catatan` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detailtransaksi`
--

INSERT INTO `detailtransaksi` (`produk_idproduk`, `transaksi_idtransaksi`, `jumlah`, `total_harga`, `catatan`) VALUES
(23, 9, 2, 10000, NULL),
(24, 8, 5, 32500, 'dasda'),
(24, 9, 5, 32500, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diskusi`
--

CREATE TABLE `diskusi` (
  `iddiskusi` int(11) NOT NULL,
  `users_iduser` int(11) NOT NULL,
  `produk_idproduk` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `pesandiskusi` varchar(45) DEFAULT NULL,
  `balas_ke` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diskusi`
--

INSERT INTO `diskusi` (`iddiskusi`, `users_iduser`, `produk_idproduk`, `tanggal`, `pesandiskusi`, `balas_ke`, `created_at`, `updated_at`) VALUES
(16, 4, 23, '2021-05-07 02:43:58', 'Test', NULL, '2021-05-07 02:43:58', '2021-05-07 02:43:58'),
(17, 4, 23, '2021-05-07 02:44:11', 'Balas test', 16, '2021-05-07 02:44:11', '2021-05-07 02:44:11'),
(18, 4, 23, '2021-05-08 00:47:34', 'Apakah produk ini aman untuk di konsumsi?', NULL, '2021-05-08 00:47:34', '2021-05-08 00:47:34'),
(19, 5, 23, '2021-05-08 00:48:41', 'YAHHH WADADIDAU AMAN BANGET', 18, '2021-05-08 00:00:00', '2021-05-08 00:00:00'),
(20, 4, 23, '2021-05-08 00:49:17', 'Oke dah', 18, '2021-05-08 00:49:17', '2021-05-08 00:49:17'),
(21, 4, 23, '2021-05-08 00:52:18', 'Lagi', 18, '2021-05-08 00:52:18', '2021-05-08 00:52:18'),
(22, 4, 26, '2021-05-08 00:56:19', 'Komen pertama di id 26', NULL, '2021-05-08 00:56:19', '2021-05-08 00:56:19'),
(23, 1, 26, '2021-05-08 00:56:54', 'YAH KEDULUAN', 22, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dukunganpembayaran`
--

CREATE TABLE `dukunganpembayaran` (
  `merchant_users_iduser` int(11) NOT NULL,
  `tipepembayaran_idtipepembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dukunganpembayaran`
--

INSERT INTO `dukunganpembayaran` (`merchant_users_iduser`, `tipepembayaran_idtipepembayaran`) VALUES
(1, 2),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `dukunganpengiriman`
--

CREATE TABLE `dukunganpengiriman` (
  `merchant_users_iduser` int(11) NOT NULL,
  `kurir_idkurir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dukunganpengiriman`
--

INSERT INTO `dukunganpengiriman` (`merchant_users_iduser`, `kurir_idkurir`) VALUES
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `dukungantarifpengiriman`
--

CREATE TABLE `dukungantarifpengiriman` (
  `merchant_users_iduser` int(11) NOT NULL,
  `tarifpengiriman_idtarifpengiriman` int(11) NOT NULL,
  `minimum_belanja` int(11) NOT NULL,
  `etd` int(11) NOT NULL,
  `tarif_berat` int(11) DEFAULT NULL,
  `tarif_volume` int(11) DEFAULT NULL,
  `tarif_jarak` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dukungantarifpengiriman`
--

INSERT INTO `dukungantarifpengiriman` (`merchant_users_iduser`, `tarifpengiriman_idtarifpengiriman`, `minimum_belanja`, `etd`, `tarif_berat`, `tarif_volume`, `tarif_jarak`) VALUES
(4, 1, 100, 200, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gambarproduk`
--

CREATE TABLE `gambarproduk` (
  `idgambarproduk` int(11) NOT NULL,
  `produk_idproduk` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gambarproduk`
--

INSERT INTO `gambarproduk` (`idgambarproduk`, `produk_idproduk`, `created_at`, `updated_at`) VALUES
(18, 23, '2021-04-21 17:07:02', '2021-04-21 17:07:02'),
(20, 24, '2021-04-22 14:37:17', '2021-04-22 14:37:17'),
(21, 25, '2021-04-30 13:40:30', '2021-04-30 13:40:30'),
(22, 26, '2021-05-03 14:55:29', '2021-05-03 14:55:29'),
(23, 26, '2021-05-05 23:41:54', '2021-05-05 23:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `jenisproduk`
--

CREATE TABLE `jenisproduk` (
  `idjenisproduk` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenisproduk`
--

INSERT INTO `jenisproduk` (`idjenisproduk`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', NULL, NULL),
(2, 'Minuman', NULL, NULL),
(3, 'Susu', NULL, NULL),
(4, 'Beras', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kabupatenkota`
--

CREATE TABLE `kabupatenkota` (
  `idkabupatenkota` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `kodepos` int(5) DEFAULT NULL,
  `provinsi_idprovinsi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kabupatenkota`
--

INSERT INTO `kabupatenkota` (`idkabupatenkota`, `nama`, `kodepos`, `provinsi_idprovinsi`) VALUES
(1, 'Aceh Barat', 23681, 21),
(2, 'Aceh Barat Daya', 23764, 21),
(3, 'Aceh Besar', 23951, 21),
(4, 'Aceh Jaya', 23654, 21),
(5, 'Aceh Selatan', 23719, 21),
(6, 'Aceh Singkil', 24785, 21),
(7, 'Aceh Tamiang', 24476, 21),
(8, 'Aceh Tengah', 24511, 21),
(9, 'Aceh Tenggara', 24611, 21),
(10, 'Aceh Timur', 24454, 21),
(11, 'Aceh Utara', 24382, 21),
(12, 'Agam', 26411, 32),
(13, 'Alor', 85811, 23),
(14, 'Ambon', 97222, 19),
(15, 'Asahan', 21214, 34),
(16, 'Asmat', 99777, 24),
(17, 'Badung', 80351, 1),
(18, 'Balangan', 71611, 13),
(19, 'Balikpapan', 76111, 15),
(20, 'Banda Aceh', 23238, 21),
(21, 'Bandar Lampung', 35139, 18),
(22, 'Bandung', 40311, 9),
(23, 'Bandung', 40111, 9),
(24, 'Bandung Barat', 40721, 9),
(25, 'Banggai', 94711, 29),
(26, 'Banggai Kepulauan', 94881, 29),
(27, 'Bangka', 33212, 2),
(28, 'Bangka Barat', 33315, 2),
(29, 'Bangka Selatan', 33719, 2),
(30, 'Bangka Tengah', 33613, 2),
(31, 'Bangkalan', 69118, 11),
(32, 'Bangli', 80619, 1),
(33, 'Banjar', 70619, 13),
(34, 'Banjar', 46311, 9),
(35, 'Banjarbaru', 70712, 13),
(36, 'Banjarmasin', 70117, 13),
(37, 'Banjarnegara', 53419, 10),
(38, 'Bantaeng', 92411, 28),
(39, 'Bantul', 55715, 5),
(40, 'Banyuasin', 30911, 33),
(41, 'Banyumas', 53114, 10),
(42, 'Banyuwangi', 68416, 11),
(43, 'Barito Kuala', 70511, 13),
(44, 'Barito Selatan', 73711, 14),
(45, 'Barito Timur', 73671, 14),
(46, 'Barito Utara', 73881, 14),
(47, 'Barru', 90719, 28),
(48, 'Batam', 29413, 17),
(49, 'Batang', 51211, 10),
(50, 'Batang Hari', 36613, 8),
(51, 'Batu', 65311, 11),
(52, 'Batu Bara', 21655, 34),
(53, 'Bau-Bau', 93719, 30),
(54, 'Bekasi', 17837, 9),
(55, 'Bekasi', 17121, 9),
(56, 'Belitung', 33419, 2),
(57, 'Belitung Timur', 33519, 2),
(58, 'Belu', 85711, 23),
(59, 'Bener Meriah', 24581, 21),
(60, 'Bengkalis', 28719, 26),
(61, 'Bengkayang', 79213, 12),
(62, 'Bengkulu', 38229, 4),
(63, 'Bengkulu Selatan', 38519, 4),
(64, 'Bengkulu Tengah', 38319, 4),
(65, 'Bengkulu Utara', 38619, 4),
(66, 'Berau', 77311, 15),
(67, 'Biak Numfor', 98119, 24),
(68, 'Bima', 84171, 22),
(69, 'Bima', 84139, 22),
(70, 'Binjai', 20712, 34),
(71, 'Bintan', 29135, 17),
(72, 'Bireuen', 24219, 21),
(73, 'Bitung', 95512, 31),
(74, 'Blitar', 66171, 11),
(75, 'Blitar', 66124, 11),
(76, 'Blora', 58219, 10),
(77, 'Boalemo', 96319, 7),
(78, 'Bogor', 16911, 9),
(79, 'Bogor', 16119, 9),
(80, 'Bojonegoro', 62119, 11),
(81, 'Bolaang Mongondow (Bolmong)', 95755, 31),
(82, 'Bolaang Mongondow Selatan', 95774, 31),
(83, 'Bolaang Mongondow Timur', 95783, 31),
(84, 'Bolaang Mongondow Utara', 95765, 31),
(85, 'Bombana', 93771, 30),
(86, 'Bondowoso', 68219, 11),
(87, 'Bone', 92713, 28),
(88, 'Bone Bolango', 96511, 7),
(89, 'Bontang', 75313, 15),
(90, 'Boven Digoel', 99662, 24),
(91, 'Boyolali', 57312, 10),
(92, 'Brebes', 52212, 10),
(93, 'Bukittinggi', 26115, 32),
(94, 'Buleleng', 81111, 1),
(95, 'Bulukumba', 92511, 28),
(96, 'Bulungan (Bulongan)', 77211, 16),
(97, 'Bungo', 37216, 8),
(98, 'Buol', 94564, 29),
(99, 'Buru', 97371, 19),
(100, 'Buru Selatan', 97351, 19),
(101, 'Buton', 93754, 30),
(102, 'Buton Utara', 93745, 30),
(103, 'Ciamis', 46211, 9),
(104, 'Cianjur', 43217, 9),
(105, 'Cilacap', 53211, 10),
(106, 'Cilegon', 42417, 3),
(107, 'Cimahi', 40512, 9),
(108, 'Cirebon', 45611, 9),
(109, 'Cirebon', 45116, 9),
(110, 'Dairi', 22211, 34),
(111, 'Deiyai (Deliyai)', 98784, 24),
(112, 'Deli Serdang', 20511, 34),
(113, 'Demak', 59519, 10),
(114, 'Denpasar', 80227, 1),
(115, 'Depok', 16416, 9),
(116, 'Dharmasraya', 27612, 32),
(117, 'Dogiyai', 98866, 24),
(118, 'Dompu', 84217, 22),
(119, 'Donggala', 94341, 29),
(120, 'Dumai', 28811, 26),
(121, 'Empat Lawang', 31811, 33),
(122, 'Ende', 86351, 23),
(123, 'Enrekang', 91719, 28),
(124, 'Fakfak', 98651, 25),
(125, 'Flores Timur', 86213, 23),
(126, 'Garut', 44126, 9),
(127, 'Gayo Lues', 24653, 21),
(128, 'Gianyar', 80519, 1),
(129, 'Gorontalo', 96218, 7),
(130, 'Gorontalo', 96115, 7),
(131, 'Gorontalo Utara', 96611, 7),
(132, 'Gowa', 92111, 28),
(133, 'Gresik', 61115, 11),
(134, 'Grobogan', 58111, 10),
(135, 'Gunung Kidul', 55812, 5),
(136, 'Gunung Mas', 74511, 14),
(137, 'Gunungsitoli', 22813, 34),
(138, 'Halmahera Barat', 97757, 20),
(139, 'Halmahera Selatan', 97911, 20),
(140, 'Halmahera Tengah', 97853, 20),
(141, 'Halmahera Timur', 97862, 20),
(142, 'Halmahera Utara', 97762, 20),
(143, 'Hulu Sungai Selatan', 71212, 13),
(144, 'Hulu Sungai Tengah', 71313, 13),
(145, 'Hulu Sungai Utara', 71419, 13),
(146, 'Humbang Hasundutan', 22457, 34),
(147, 'Indragiri Hilir', 29212, 26),
(148, 'Indragiri Hulu', 29319, 26),
(149, 'Indramayu', 45214, 9),
(150, 'Intan Jaya', 98771, 24),
(151, 'Jakarta Barat', 11220, 6),
(152, 'Jakarta Pusat', 10540, 6),
(153, 'Jakarta Selatan', 12230, 6),
(154, 'Jakarta Timur', 13330, 6),
(155, 'Jakarta Utara', 14140, 6),
(156, 'Jambi', 36111, 8),
(157, 'Jayapura', 99352, 24),
(158, 'Jayapura', 99114, 24),
(159, 'Jayawijaya', 99511, 24),
(160, 'Jember', 68113, 11),
(161, 'Jembrana', 82251, 1),
(162, 'Jeneponto', 92319, 28),
(163, 'Jepara', 59419, 10),
(164, 'Jombang', 61415, 11),
(165, 'Kaimana', 98671, 25),
(166, 'Kampar', 28411, 26),
(167, 'Kapuas', 73583, 14),
(168, 'Kapuas Hulu', 78719, 12),
(169, 'Karanganyar', 57718, 10),
(170, 'Karangasem', 80819, 1),
(171, 'Karawang', 41311, 9),
(172, 'Karimun', 29611, 17),
(173, 'Karo', 22119, 34),
(174, 'Katingan', 74411, 14),
(175, 'Kaur', 38911, 4),
(176, 'Kayong Utara', 78852, 12),
(177, 'Kebumen', 54319, 10),
(178, 'Kediri', 64184, 11),
(179, 'Kediri', 64125, 11),
(180, 'Keerom', 99461, 24),
(181, 'Kendal', 51314, 10),
(182, 'Kendari', 93126, 30),
(183, 'Kepahiang', 39319, 4),
(184, 'Kepulauan Anambas', 29991, 17),
(185, 'Kepulauan Aru', 97681, 19),
(186, 'Kepulauan Mentawai', 25771, 32),
(187, 'Kepulauan Meranti', 28791, 26),
(188, 'Kepulauan Sangihe', 95819, 31),
(189, 'Kepulauan Seribu', 14550, 6),
(190, 'Kepulauan Siau Tagulandang Biaro (Sitaro)', 95862, 31),
(191, 'Kepulauan Sula', 97995, 20),
(192, 'Kepulauan Talaud', 95885, 31),
(193, 'Kepulauan Yapen (Yapen Waropen)', 98211, 24),
(194, 'Kerinci', 37167, 8),
(195, 'Ketapang', 78874, 12),
(196, 'Klaten', 57411, 10),
(197, 'Klungkung', 80719, 1),
(198, 'Kolaka', 93511, 30),
(199, 'Kolaka Utara', 93911, 30),
(200, 'Konawe', 93411, 30),
(201, 'Konawe Selatan', 93811, 30),
(202, 'Konawe Utara', 93311, 30),
(203, 'Kotabaru', 72119, 13),
(204, 'Kotamobagu', 95711, 31),
(205, 'Kotawaringin Barat', 74119, 14),
(206, 'Kotawaringin Timur', 74364, 14),
(207, 'Kuantan Singingi', 29519, 26),
(208, 'Kubu Raya', 78311, 12),
(209, 'Kudus', 59311, 10),
(210, 'Kulon Progo', 55611, 5),
(211, 'Kuningan', 45511, 9),
(212, 'Kupang', 85362, 23),
(213, 'Kupang', 85119, 23),
(214, 'Kutai Barat', 75711, 15),
(215, 'Kutai Kartanegara', 75511, 15),
(216, 'Kutai Timur', 75611, 15),
(217, 'Labuhan Batu', 21412, 34),
(218, 'Labuhan Batu Selatan', 21511, 34),
(219, 'Labuhan Batu Utara', 21711, 34),
(220, 'Lahat', 31419, 33),
(221, 'Lamandau', 74611, 14),
(222, 'Lamongan', 64125, 11),
(223, 'Lampung Barat', 34814, 18),
(224, 'Lampung Selatan', 35511, 18),
(225, 'Lampung Tengah', 34212, 18),
(226, 'Lampung Timur', 34319, 18),
(227, 'Lampung Utara', 34516, 18),
(228, 'Landak', 78319, 12),
(229, 'Langkat', 20811, 34),
(230, 'Langsa', 24412, 21),
(231, 'Lanny Jaya', 99531, 24),
(232, 'Lebak', 42319, 3),
(233, 'Lebong', 39264, 4),
(234, 'Lembata', 86611, 23),
(235, 'Lhokseumawe', 24352, 21),
(236, 'Lima Puluh Koto/Kota', 26671, 32),
(237, 'Lingga', 29811, 17),
(238, 'Lombok Barat', 83311, 22),
(239, 'Lombok Tengah', 83511, 22),
(240, 'Lombok Timur', 83612, 22),
(241, 'Lombok Utara', 83711, 22),
(242, 'Lubuk Linggau', 31614, 33),
(243, 'Lumajang', 67319, 11),
(244, 'Luwu', 91994, 28),
(245, 'Luwu Timur', 92981, 28),
(246, 'Luwu Utara', 92911, 28),
(247, 'Madiun', 63153, 11),
(248, 'Madiun', 63122, 11),
(249, 'Magelang', 56519, 10),
(250, 'Magelang', 56133, 10),
(251, 'Magetan', 63314, 11),
(252, 'Majalengka', 45412, 9),
(253, 'Majene', 91411, 27),
(254, 'Makassar', 90111, 28),
(255, 'Malang', 65163, 11),
(256, 'Malang', 65112, 11),
(257, 'Malinau', 77511, 16),
(258, 'Maluku Barat Daya', 97451, 19),
(259, 'Maluku Tengah', 97513, 19),
(260, 'Maluku Tenggara', 97651, 19),
(261, 'Maluku Tenggara Barat', 97465, 19),
(262, 'Mamasa', 91362, 27),
(263, 'Mamberamo Raya', 99381, 24),
(264, 'Mamberamo Tengah', 99553, 24),
(265, 'Mamuju', 91519, 27),
(266, 'Mamuju Utara', 91571, 27),
(267, 'Manado', 95247, 31),
(268, 'Mandailing Natal', 22916, 34),
(269, 'Manggarai', 86551, 23),
(270, 'Manggarai Barat', 86711, 23),
(271, 'Manggarai Timur', 86811, 23),
(272, 'Manokwari', 98311, 25),
(273, 'Manokwari Selatan', 98355, 25),
(274, 'Mappi', 99853, 24),
(275, 'Maros', 90511, 28),
(276, 'Mataram', 83131, 22),
(277, 'Maybrat', 98051, 25),
(278, 'Medan', 20228, 34),
(279, 'Melawi', 78619, 12),
(280, 'Merangin', 37319, 8),
(281, 'Merauke', 99613, 24),
(282, 'Mesuji', 34911, 18),
(283, 'Metro', 34111, 18),
(284, 'Mimika', 99962, 24),
(285, 'Minahasa', 95614, 31),
(286, 'Minahasa Selatan', 95914, 31),
(287, 'Minahasa Tenggara', 95995, 31),
(288, 'Minahasa Utara', 95316, 31),
(289, 'Mojokerto', 61382, 11),
(290, 'Mojokerto', 61316, 11),
(291, 'Morowali', 94911, 29),
(292, 'Muara Enim', 31315, 33),
(293, 'Muaro Jambi', 36311, 8),
(294, 'Muko Muko', 38715, 4),
(295, 'Muna', 93611, 30),
(296, 'Murung Raya', 73911, 14),
(297, 'Musi Banyuasin', 30719, 33),
(298, 'Musi Rawas', 31661, 33),
(299, 'Nabire', 98816, 24),
(300, 'Nagan Raya', 23674, 21),
(301, 'Nagekeo', 86911, 23),
(302, 'Natuna', 29711, 17),
(303, 'Nduga', 99541, 24),
(304, 'Ngada', 86413, 23),
(305, 'Nganjuk', 64414, 11),
(306, 'Ngawi', 63219, 11),
(307, 'Nias', 22876, 34),
(308, 'Nias Barat', 22895, 34),
(309, 'Nias Selatan', 22865, 34),
(310, 'Nias Utara', 22856, 34),
(311, 'Nunukan', 77421, 16),
(312, 'Ogan Ilir', 30811, 33),
(313, 'Ogan Komering Ilir', 30618, 33),
(314, 'Ogan Komering Ulu', 32112, 33),
(315, 'Ogan Komering Ulu Selatan', 32211, 33),
(316, 'Ogan Komering Ulu Timur', 32312, 33),
(317, 'Pacitan', 63512, 11),
(318, 'Padang', 25112, 32),
(319, 'Padang Lawas', 22763, 34),
(320, 'Padang Lawas Utara', 22753, 34),
(321, 'Padang Panjang', 27122, 32),
(322, 'Padang Pariaman', 25583, 32),
(323, 'Padang Sidempuan', 22727, 34),
(324, 'Pagar Alam', 31512, 33),
(325, 'Pakpak Bharat', 22272, 34),
(326, 'Palangka Raya', 73112, 14),
(327, 'Palembang', 30111, 33),
(328, 'Palopo', 91911, 28),
(329, 'Palu', 94111, 29),
(330, 'Pamekasan', 69319, 11),
(331, 'Pandeglang', 42212, 3),
(332, 'Pangandaran', 46511, 9),
(333, 'Pangkajene Kepulauan', 90611, 28),
(334, 'Pangkal Pinang', 33115, 2),
(335, 'Paniai', 98765, 24),
(336, 'Parepare', 91123, 28),
(337, 'Pariaman', 25511, 32),
(338, 'Parigi Moutong', 94411, 29),
(339, 'Pasaman', 26318, 32),
(340, 'Pasaman Barat', 26511, 32),
(341, 'Paser', 76211, 15),
(342, 'Pasuruan', 67153, 11),
(343, 'Pasuruan', 67118, 11),
(344, 'Pati', 59114, 10),
(345, 'Payakumbuh', 26213, 32),
(346, 'Pegunungan Arfak', 98354, 25),
(347, 'Pegunungan Bintang', 99573, 24),
(348, 'Pekalongan', 51161, 10),
(349, 'Pekalongan', 51122, 10),
(350, 'Pekanbaru', 28112, 26),
(351, 'Pelalawan', 28311, 26),
(352, 'Pemalang', 52319, 10),
(353, 'Pematang Siantar', 21126, 34),
(354, 'Penajam Paser Utara', 76311, 15),
(355, 'Pesawaran', 35312, 18),
(356, 'Pesisir Barat', 35974, 18),
(357, 'Pesisir Selatan', 25611, 32),
(358, 'Pidie', 24116, 21),
(359, 'Pidie Jaya', 24186, 21),
(360, 'Pinrang', 91251, 28),
(361, 'Pohuwato', 96419, 7),
(362, 'Polewali Mandar', 91311, 27),
(363, 'Ponorogo', 63411, 11),
(364, 'Pontianak', 78971, 12),
(365, 'Pontianak', 78112, 12),
(366, 'Poso', 94615, 29),
(367, 'Prabumulih', 31121, 33),
(368, 'Pringsewu', 35719, 18),
(369, 'Probolinggo', 67282, 11),
(370, 'Probolinggo', 67215, 11),
(371, 'Pulang Pisau', 74811, 14),
(372, 'Pulau Morotai', 97771, 20),
(373, 'Puncak', 98981, 24),
(374, 'Puncak Jaya', 98979, 24),
(375, 'Purbalingga', 53312, 10),
(376, 'Purwakarta', 41119, 9),
(377, 'Purworejo', 54111, 10),
(378, 'Raja Ampat', 98489, 25),
(379, 'Rejang Lebong', 39112, 4),
(380, 'Rembang', 59219, 10),
(381, 'Rokan Hilir', 28992, 26),
(382, 'Rokan Hulu', 28511, 26),
(383, 'Rote Ndao', 85982, 23),
(384, 'Sabang', 23512, 21),
(385, 'Sabu Raijua', 85391, 23),
(386, 'Salatiga', 50711, 10),
(387, 'Samarinda', 75133, 15),
(388, 'Sambas', 79453, 12),
(389, 'Samosir', 22392, 34),
(390, 'Sampang', 69219, 11),
(391, 'Sanggau', 78557, 12),
(392, 'Sarmi', 99373, 24),
(393, 'Sarolangun', 37419, 8),
(394, 'Sawah Lunto', 27416, 32),
(395, 'Sekadau', 79583, 12),
(396, 'Selayar (Kepulauan Selayar)', 92812, 28),
(397, 'Seluma', 38811, 4),
(398, 'Semarang', 50511, 10),
(399, 'Semarang', 50135, 10),
(400, 'Seram Bagian Barat', 97561, 19),
(401, 'Seram Bagian Timur', 97581, 19),
(402, 'Serang', 42182, 3),
(403, 'Serang', 42111, 3),
(404, 'Serdang Bedagai', 20915, 34),
(405, 'Seruyan', 74211, 14),
(406, 'Siak', 28623, 26),
(407, 'Sibolga', 22522, 34),
(408, 'Sidenreng Rappang/Rapang', 91613, 28),
(409, 'Sidoarjo', 61219, 11),
(410, 'Sigi', 94364, 29),
(411, 'Sijunjung (Sawah Lunto Sijunjung)', 27511, 32),
(412, 'Sikka', 86121, 23),
(413, 'Simalungun', 21162, 34),
(414, 'Simeulue', 23891, 21),
(415, 'Singkawang', 79117, 12),
(416, 'Sinjai', 92615, 28),
(417, 'Sintang', 78619, 12),
(418, 'Situbondo', 68316, 11),
(419, 'Sleman', 55513, 5),
(420, 'Solok', 27365, 32),
(421, 'Solok', 27315, 32),
(422, 'Solok Selatan', 27779, 32),
(423, 'Soppeng', 90812, 28),
(424, 'Sorong', 98431, 25),
(425, 'Sorong', 98411, 25),
(426, 'Sorong Selatan', 98454, 25),
(427, 'Sragen', 57211, 10),
(428, 'Subang', 41215, 9),
(429, 'Subulussalam', 24882, 21),
(430, 'Sukabumi', 43311, 9),
(431, 'Sukabumi', 43114, 9),
(432, 'Sukamara', 74712, 14),
(433, 'Sukoharjo', 57514, 10),
(434, 'Sumba Barat', 87219, 23),
(435, 'Sumba Barat Daya', 87453, 23),
(436, 'Sumba Tengah', 87358, 23),
(437, 'Sumba Timur', 87112, 23),
(438, 'Sumbawa', 84315, 22),
(439, 'Sumbawa Barat', 84419, 22),
(440, 'Sumedang', 45326, 9),
(441, 'Sumenep', 69413, 11),
(442, 'Sungaipenuh', 37113, 8),
(443, 'Supiori', 98164, 24),
(444, 'Surabaya', 60119, 11),
(445, 'Surakarta (Solo)', 57113, 10),
(446, 'Tabalong', 71513, 13),
(447, 'Tabanan', 82119, 1),
(448, 'Takalar', 92212, 28),
(449, 'Tambrauw', 98475, 25),
(450, 'Tana Tidung', 77611, 16),
(451, 'Tana Toraja', 91819, 28),
(452, 'Tanah Bumbu', 72211, 13),
(453, 'Tanah Datar', 27211, 32),
(454, 'Tanah Laut', 70811, 13),
(455, 'Tangerang', 15914, 3),
(456, 'Tangerang', 15111, 3),
(457, 'Tangerang Selatan', 15332, 3),
(458, 'Tanggamus', 35619, 18),
(459, 'Tanjung Balai', 21321, 34),
(460, 'Tanjung Jabung Barat', 36513, 8),
(461, 'Tanjung Jabung Timur', 36719, 8),
(462, 'Tanjung Pinang', 29111, 17),
(463, 'Tapanuli Selatan', 22742, 34),
(464, 'Tapanuli Tengah', 22611, 34),
(465, 'Tapanuli Utara', 22414, 34),
(466, 'Tapin', 71119, 13),
(467, 'Tarakan', 77114, 16),
(468, 'Tasikmalaya', 46411, 9),
(469, 'Tasikmalaya', 46116, 9),
(470, 'Tebing Tinggi', 20632, 34),
(471, 'Tebo', 37519, 8),
(472, 'Tegal', 52419, 10),
(473, 'Tegal', 52114, 10),
(474, 'Teluk Bintuni', 98551, 25),
(475, 'Teluk Wondama', 98591, 25),
(476, 'Temanggung', 56212, 10),
(477, 'Ternate', 97714, 20),
(478, 'Tidore Kepulauan', 97815, 20),
(479, 'Timor Tengah Selatan', 85562, 23),
(480, 'Timor Tengah Utara', 85612, 23),
(481, 'Toba Samosir', 22316, 34),
(482, 'Tojo Una-Una', 94683, 29),
(483, 'Toli-Toli', 94542, 29),
(484, 'Tolikara', 99411, 24),
(485, 'Tomohon', 95416, 31),
(486, 'Toraja Utara', 91831, 28),
(487, 'Trenggalek', 66312, 11),
(488, 'Tual', 97612, 19),
(489, 'Tuban', 62319, 11),
(490, 'Tulang Bawang', 34613, 18),
(491, 'Tulang Bawang Barat', 34419, 18),
(492, 'Tulungagung', 66212, 11),
(493, 'Wajo', 90911, 28),
(494, 'Wakatobi', 93791, 30),
(495, 'Waropen', 98269, 24),
(496, 'Way Kanan', 34711, 18),
(497, 'Wonogiri', 57619, 10),
(498, 'Wonosobo', 56311, 10),
(499, 'Yahukimo', 99041, 24),
(500, 'Yalimo', 99481, 24),
(501, 'Yogyakarta', 55111, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `nama_kategori` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `merchant_users_iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama_kategori`, `created_at`, `updated_at`, `merchant_users_iduser`) VALUES
(3, 'eqwe', '2021-04-15 00:00:00', '2021-04-16 00:00:00', 1),
(5, 'kategori satu', '2021-04-15 14:11:55', '2021-05-03 14:55:48', 4),
(8, 'kategori dua', '2021-05-03 03:49:22', '2021-05-03 14:55:54', 4),
(9, 'kategori waktu', '2021-05-04 20:39:49', '2021-05-04 20:39:49', 4);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `users_iduser` int(11) NOT NULL,
  `produk_idproduk` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`users_iduser`, `produk_idproduk`, `jumlah`) VALUES
(4, 23, 2),
(4, 24, 5),
(4, 25, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `idkurir` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`idkurir`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'JNE', NULL, NULL),
(2, 'Kurir Merchant', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `nama` varchar(45) NOT NULL,
  `status_merchant` enum('Aktif','NonAktif') DEFAULT 'NonAktif',
  `foto_profil` varchar(45) DEFAULT NULL,
  `foto_sampul` varchar(45) DEFAULT NULL,
  `deskripsi` varchar(45) DEFAULT NULL,
  `jam_buka` time DEFAULT NULL,
  `jam_tutup` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `users_iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`nama`, `status_merchant`, `foto_profil`, `foto_sampul`, `deskripsi`, `jam_buka`, `jam_tutup`, `created_at`, `updated_at`, `users_iduser`) VALUES
('Merchant Gaje', 'Aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
('Merchant Ubah', 'Aktif', 'merchant-fotoprofil-4.png', 'merchant-fotosampul-4.png', 'Merchant iki wes dirubah', '07:30:00', '13:30:00', '2021-04-15 14:03:59', '2021-05-08 00:19:39', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `idnotifikasi` int(11) NOT NULL,
  `pesan_notifikasi` varchar(45) NOT NULL,
  `baca` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak',
  `tujuan` enum('Merchant','Pembeli') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `users_iduser` int(11) NOT NULL,
  `merchant_users_iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `obrolan`
--

CREATE TABLE `obrolan` (
  `idobrolan` int(11) NOT NULL,
  `subject` varchar(45) DEFAULT NULL,
  `waktu` datetime DEFAULT current_timestamp(),
  `isi_pesan` varchar(45) DEFAULT NULL,
  `status_baca_user` tinyint(4) DEFAULT NULL,
  `status_baca_merchant` tinyint(4) DEFAULT NULL,
  `pengirim` enum('Pembeli','Merchant') DEFAULT NULL,
  `users_iduser` int(11) NOT NULL,
  `merchant_users_iduser` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obrolan`
--

INSERT INTO `obrolan` (`idobrolan`, `subject`, `waktu`, `isi_pesan`, `status_baca_user`, `status_baca_merchant`, `pengirim`, `users_iduser`, `merchant_users_iduser`, `created_at`, `updated_at`) VALUES
(1, 'gak ada', '2021-04-28 02:03:56', 'Hallo teman teman semua', 1, 1, 'Pembeli', 4, 4, NULL, '2021-05-08 15:31:05'),
(18, 'cobasubject', '2021-04-28 12:47:19', 'Test dari Merchant', 1, 1, 'Merchant', 4, 4, '2021-04-28 04:47:19', '2021-05-08 15:31:05'),
(19, 'cobasubject', '2021-04-28 12:47:39', 'ingat skripsmu ee', 1, 1, 'Merchant', 4, 4, '2021-04-28 04:47:39', '2021-05-08 15:31:05'),
(20, 'cobasubject', '2021-04-28 12:53:57', 'p', 1, 1, 'Merchant', 4, 4, '2021-04-28 04:53:57', '2021-05-08 15:31:05'),
(21, 'cobasubject', '2021-04-28 13:03:43', 'Ya', 1, 1, 'Pembeli', 4, 4, '2021-04-28 05:03:43', '2021-05-08 15:31:05'),
(22, 'cobasubject', '2021-05-04 23:49:14', 'Haii', 1, 1, 'Pembeli', 4, 4, '2021-05-04 23:49:14', '2021-05-08 15:31:05'),
(23, 'cobasubject', '2021-05-04 23:49:39', 'Arigatou', 1, 1, 'Merchant', 4, 4, '2021-05-04 23:49:39', '2021-05-08 15:31:05'),
(24, 'cobasubject', '2021-05-04 23:50:02', 'ichi ni san', 1, 1, 'Merchant', 4, 4, '2021-05-04 23:50:02', '2021-05-08 15:31:05'),
(25, 'cobasubject', '2021-05-04 23:50:20', 'nya', 1, 1, 'Pembeli', 4, 4, '2021-05-04 23:50:20', '2021-05-08 15:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `idpembayaran` int(11) NOT NULL,
  `transaction_time` datetime DEFAULT NULL,
  `order_id` varchar(45) DEFAULT NULL,
  `payment_type` varchar(45) DEFAULT NULL,
  `status_code` varchar(3) DEFAULT NULL,
  `transaction_status` varchar(45) DEFAULT NULL,
  `settlement_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `transaksi_idtransaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `idpengiriman` int(11) NOT NULL,
  `tanggal_pengiriman` date DEFAULT NULL,
  `estimasi` int(11) DEFAULT NULL,
  `biaya_pengiriman` int(11) NOT NULL,
  `nomor_resi` varchar(45) DEFAULT NULL,
  `status_pengiriman` enum('Selesai','BelumSelesai') DEFAULT 'BelumSelesai',
  `keterangan` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `kurir_idkurir` int(11) NOT NULL,
  `transaksi_idtransaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`idpengiriman`, `tanggal_pengiriman`, `estimasi`, `biaya_pengiriman`, `nomor_resi`, `status_pengiriman`, `keterangan`, `created_at`, `updated_at`, `kurir_idkurir`, `transaksi_idtransaksi`) VALUES
(6, '2021-05-08', 1, 10000, 'KM-20210507-233244', 'BelumSelesai', 'CTC1-2', '2021-05-07 23:32:24', '2021-05-07 23:32:48', 2, 8),
(7, '2021-05-10', 200, 0, 'KM-20210510-032852', 'BelumSelesai', 'Kurir Merchant-1-Bebas Ongkir-100-200---', '2021-05-10 03:28:19', '2021-05-10 03:28:56', 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `minimum_pemesanan` int(11) NOT NULL,
  `status` enum('Aktif','TidakAktif') NOT NULL,
  `stok` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `panjang` int(11) DEFAULT NULL,
  `lebar` int(11) DEFAULT NULL,
  `tinggi` int(11) DEFAULT NULL,
  `preorder` enum('Aktif','TidakAktif') NOT NULL DEFAULT 'TidakAktif',
  `waktu_preorder` int(11) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `kategori_idkategori` int(11) NOT NULL,
  `jenisproduk_idjenisproduk` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `merchant_users_iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `nama`, `deskripsi`, `harga`, `minimum_pemesanan`, `status`, `stok`, `berat`, `panjang`, `lebar`, `tinggi`, `preorder`, `waktu_preorder`, `video`, `kategori_idkategori`, `jenisproduk_idjenisproduk`, `created_at`, `updated_at`, `merchant_users_iduser`) VALUES
(23, 'Product Pertama', 'test aja', 5000, 2, 'Aktif', 10, 1, 2, 3, 3, 'TidakAktif', 0, NULL, 5, 1, '2021-04-21 17:07:02', '2021-05-03 14:54:56', 4),
(24, 'product kedua', 'erwrwerwer', 6500, 5, 'Aktif', 22, 2, 3, 1, 1, 'TidakAktif', 0, NULL, 8, 3, '2021-04-22 14:37:17', '2021-05-03 14:49:33', 4),
(25, 'Nestle Milo', 'asdasdasd', 25000, 2, 'Aktif', 19, 1, 2, 3, 4, 'TidakAktif', 0, NULL, 5, 3, '2021-04-30 13:40:30', '2021-04-30 13:40:30', 1),
(26, 'produk ketiga', 'eqweqw', 5400, 1, 'Aktif', 5, 1, 2, 3, 4, 'TidakAktif', 0, 'https://www.youtube.com/embed/1GMar6F_ovY', 5, 1, '2021-05-03 14:55:29', '2021-05-05 23:53:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `idprovinsi` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`idprovinsi`, `nama`) VALUES
(1, 'Bali'),
(2, 'Bangka Belitung'),
(3, 'Banten'),
(4, 'Bengkulu'),
(5, 'DI Yogyakarta'),
(6, 'DKI Jakarta'),
(7, 'Gorontalo'),
(8, 'Jambi'),
(9, 'Jawa Barat'),
(10, 'Jawa Tengah'),
(11, 'Jawa Timur'),
(12, 'Kalimantan Barat'),
(13, 'Kalimantan Selatan'),
(14, 'Kalimantan Tengah'),
(15, 'Kalimantan Timur'),
(16, 'Kalimantan Utara'),
(17, 'Kepulauan Riau'),
(18, 'Lampung'),
(19, 'Maluku'),
(20, 'Maluku Utara'),
(21, 'Nanggroe Aceh Darussalam (NAD)'),
(22, 'Nusa Tenggara Barat (NTB)'),
(23, 'Nusa Tenggara Timur (NTT)'),
(24, 'Papua'),
(25, 'Papua Barat'),
(26, 'Riau'),
(27, 'Sulawesi Barat'),
(28, 'Sulawesi Selatan'),
(29, 'Sulawesi Tengah'),
(30, 'Sulawesi Tenggara'),
(31, 'Sulawesi Utara'),
(32, 'Sumatera Barat'),
(33, 'Sumatera Selatan'),
(34, 'Sumatera Utara');

-- --------------------------------------------------------

--
-- Table structure for table `reviewproduk`
--

CREATE TABLE `reviewproduk` (
  `idreviewproduk` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `komentar_produk` varchar(45) DEFAULT NULL,
  `rating_produk` int(11) NOT NULL,
  `users_iduser` int(11) NOT NULL,
  `produk_idproduk` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tarifpengiriman`
--

CREATE TABLE `tarifpengiriman` (
  `idtarifpengiriman` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tarifpengiriman`
--

INSERT INTO `tarifpengiriman` (`idtarifpengiriman`, `nama`) VALUES
(1, 'Bebas Ongkir'),
(2, 'Tarif Flat'),
(3, 'Tarif Standar');

-- --------------------------------------------------------

--
-- Table structure for table `tipepembayaran`
--

CREATE TABLE `tipepembayaran` (
  `idtipepembayaran` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipepembayaran`
--

INSERT INTO `tipepembayaran` (`idtipepembayaran`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Cash On Delivery', '2021-05-04 20:55:58', '2021-05-04 20:55:58'),
(2, 'Bank Transfer', '2021-05-04 20:55:58', '2021-05-04 20:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `status_transaksi` enum('MenungguPembayaran','MenungguKonfirmasi','PesananDiproses','PesananDikirim','SampaiTujuan','Selesai','Batal') DEFAULT NULL,
  `jenis_transaksi` enum('PreOrder','Langsung') DEFAULT 'Langsung',
  `nominal_pembayaran` int(11) DEFAULT NULL,
  `users_iduser` int(11) NOT NULL,
  `merchant_users_iduser` int(11) NOT NULL,
  `alamatpembeli_idalamat` int(11) NOT NULL,
  `tipepembayaran_idtipepembayaran` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `tanggal`, `status_transaksi`, `jenis_transaksi`, `nominal_pembayaran`, `users_iduser`, `merchant_users_iduser`, `alamatpembeli_idalamat`, `tipepembayaran_idtipepembayaran`, `created_at`, `updated_at`) VALUES
(8, '2021-05-07 23:32:24', 'PesananDikirim', 'Langsung', 52500, 4, 4, 8, 1, '2021-05-07 23:32:24', '2021-05-07 23:32:48'),
(9, '2021-05-10 03:28:19', 'PesananDikirim', 'Langsung', 42500, 4, 4, 10, 1, '2021-05-10 03:28:19', '2021-05-10 03:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telepon` varchar(12) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `foto_profil` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`iduser`, `name`, `email`, `password`, `telepon`, `email_verified_at`, `remember_token`, `foto_profil`, `created_at`, `updated_at`) VALUES
(1, 'ewq', '@gmail.com', '123', '123', '2021-04-16 00:00:00', NULL, '31', '2021-04-07 00:00:00', '2021-04-16 00:00:00'),
(4, 'Alexander Evan', 'alexevan2810@gmail.com', '$2y$10$.LvuS27gw18vIkm9nETN../ZDBLLUWQfe1EXu15H/qfkq08w1hX9q', NULL, '2021-04-15 14:02:19', NULL, NULL, '2021-04-15 14:01:44', '2021-04-15 14:02:19'),
(5, 'Goesti', 'gusti@gusti.com', '$2y$10$qqrqKW5HkHQ0t0R8LXwvg.C1KFgZAM/nmbHVQAb212PijcIXIHqoO', NULL, NULL, NULL, NULL, '2021-04-28 14:54:50', '2021-04-28 14:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `users_iduser` int(11) NOT NULL,
  `produk_idproduk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`users_iduser`, `produk_idproduk`) VALUES
(4, 23),
(4, 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamatmerchant`
--
ALTER TABLE `alamatmerchant`
  ADD PRIMARY KEY (`merchant_users_iduser`),
  ADD KEY `fk_alamatmerchant_merchant1_idx` (`merchant_users_iduser`),
  ADD KEY `fk_alamatmerchant_kabupatenkota1_idx` (`kabupatenkota_idkabupatenkota`);

--
-- Indexes for table `alamatpembeli`
--
ALTER TABLE `alamatpembeli`
  ADD PRIMARY KEY (`idalamat`),
  ADD KEY `fk_alamat_user_idx` (`users_iduser`),
  ADD KEY `fk_alamatpembeli_kabupatenkota1_idx` (`kabupatenkota_idkabupatenkota`);

--
-- Indexes for table `datapengiriman`
--
ALTER TABLE `datapengiriman`
  ADD PRIMARY KEY (`iddatapengiriman`),
  ADD KEY `fk_datapengiriman_pengiriman1_idx` (`pengiriman_idpengiriman`);

--
-- Indexes for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD PRIMARY KEY (`produk_idproduk`,`transaksi_idtransaksi`),
  ADD KEY `fk_produk_has_transaksi_transaksi1_idx` (`transaksi_idtransaksi`),
  ADD KEY `fk_produk_has_transaksi_produk1_idx` (`produk_idproduk`);

--
-- Indexes for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`iddiskusi`),
  ADD KEY `fk_diskusi_user1_idx` (`users_iduser`),
  ADD KEY `fk_diskusi_produk1_idx` (`produk_idproduk`),
  ADD KEY `fk_diskusi_diskusi1_idx` (`balas_ke`);

--
-- Indexes for table `dukunganpembayaran`
--
ALTER TABLE `dukunganpembayaran`
  ADD PRIMARY KEY (`merchant_users_iduser`,`tipepembayaran_idtipepembayaran`),
  ADD KEY `fk_merchant_has_tipepembayaran_tipepembayaran1_idx` (`tipepembayaran_idtipepembayaran`),
  ADD KEY `fk_merchant_has_tipepembayaran_merchant1_idx` (`merchant_users_iduser`);

--
-- Indexes for table `dukunganpengiriman`
--
ALTER TABLE `dukunganpengiriman`
  ADD PRIMARY KEY (`merchant_users_iduser`,`kurir_idkurir`),
  ADD KEY `fk_merchant_has_kurir_kurir1_idx` (`kurir_idkurir`),
  ADD KEY `fk_merchant_has_kurir_merchant1_idx` (`merchant_users_iduser`);

--
-- Indexes for table `dukungantarifpengiriman`
--
ALTER TABLE `dukungantarifpengiriman`
  ADD PRIMARY KEY (`merchant_users_iduser`,`tarifpengiriman_idtarifpengiriman`),
  ADD KEY `fk_merchant_has_tarifpengiriman_tarifpengiriman1_idx` (`tarifpengiriman_idtarifpengiriman`),
  ADD KEY `fk_merchant_has_tarifpengiriman_merchant1_idx` (`merchant_users_iduser`);

--
-- Indexes for table `gambarproduk`
--
ALTER TABLE `gambarproduk`
  ADD PRIMARY KEY (`idgambarproduk`),
  ADD KEY `fk_gambarproduk_produk1_idx` (`produk_idproduk`);

--
-- Indexes for table `jenisproduk`
--
ALTER TABLE `jenisproduk`
  ADD PRIMARY KEY (`idjenisproduk`);

--
-- Indexes for table `kabupatenkota`
--
ALTER TABLE `kabupatenkota`
  ADD PRIMARY KEY (`idkabupatenkota`),
  ADD KEY `fk_kabupatenkota_provinsi1_idx` (`provinsi_idprovinsi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`),
  ADD KEY `fk_kategori_merchant1_idx` (`merchant_users_iduser`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`users_iduser`,`produk_idproduk`),
  ADD KEY `fk_user_has_produk_produk1_idx` (`produk_idproduk`),
  ADD KEY `fk_user_has_produk_user1_idx` (`users_iduser`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`idkurir`);

--
-- Indexes for table `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`users_iduser`),
  ADD KEY `fk_merchant_users1_idx` (`users_iduser`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`idnotifikasi`),
  ADD KEY `fk_notifikasi_users1_idx` (`users_iduser`),
  ADD KEY `fk_notifikasi_merchant1_idx` (`merchant_users_iduser`);

--
-- Indexes for table `obrolan`
--
ALTER TABLE `obrolan`
  ADD PRIMARY KEY (`idobrolan`),
  ADD KEY `fk_obrolan_user1_idx` (`users_iduser`),
  ADD KEY `fk_obrolan_merchant1_idx` (`merchant_users_iduser`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`idpembayaran`),
  ADD KEY `fk_pembayaran_transaksi1_idx` (`transaksi_idtransaksi`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`idpengiriman`),
  ADD KEY `fk_pengiriman_kurir1_idx` (`kurir_idkurir`),
  ADD KEY `fk_pengiriman_transaksi1_idx` (`transaksi_idtransaksi`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `fk_produk_kategori1_idx` (`kategori_idkategori`),
  ADD KEY `fk_produk_jenisproduk1_idx` (`jenisproduk_idjenisproduk`),
  ADD KEY `fk_produk_merchant1_idx` (`merchant_users_iduser`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`idprovinsi`);

--
-- Indexes for table `reviewproduk`
--
ALTER TABLE `reviewproduk`
  ADD PRIMARY KEY (`idreviewproduk`),
  ADD KEY `fk_reviewproduk_user1_idx` (`users_iduser`),
  ADD KEY `fk_reviewproduk_produk1_idx` (`produk_idproduk`);

--
-- Indexes for table `tarifpengiriman`
--
ALTER TABLE `tarifpengiriman`
  ADD PRIMARY KEY (`idtarifpengiriman`);

--
-- Indexes for table `tipepembayaran`
--
ALTER TABLE `tipepembayaran`
  ADD PRIMARY KEY (`idtipepembayaran`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`),
  ADD KEY `fk_transaksi_user1_idx` (`users_iduser`),
  ADD KEY `fk_transaksi_alamatpembeli1_idx` (`alamatpembeli_idalamat`),
  ADD KEY `fk_transaksi_merchant1_idx` (`merchant_users_iduser`),
  ADD KEY `fk_transaksi_tipepembayaran1_idx` (`tipepembayaran_idtipepembayaran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`users_iduser`,`produk_idproduk`),
  ADD KEY `fk_user_has_produk_produk2_idx` (`produk_idproduk`),
  ADD KEY `fk_user_has_produk_user2_idx` (`users_iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamatpembeli`
--
ALTER TABLE `alamatpembeli`
  MODIFY `idalamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `datapengiriman`
--
ALTER TABLE `datapengiriman`
  MODIFY `iddatapengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `iddiskusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `gambarproduk`
--
ALTER TABLE `gambarproduk`
  MODIFY `idgambarproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jenisproduk`
--
ALTER TABLE `jenisproduk`
  MODIFY `idjenisproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `idkurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `idnotifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `obrolan`
--
ALTER TABLE `obrolan`
  MODIFY `idobrolan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `idpembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `idpengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reviewproduk`
--
ALTER TABLE `reviewproduk`
  MODIFY `idreviewproduk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tarifpengiriman`
--
ALTER TABLE `tarifpengiriman`
  MODIFY `idtarifpengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamatmerchant`
--
ALTER TABLE `alamatmerchant`
  ADD CONSTRAINT `fk_alamatmerchant_kabupatenkota1` FOREIGN KEY (`kabupatenkota_idkabupatenkota`) REFERENCES `kabupatenkota` (`idkabupatenkota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alamatmerchant_merchant1` FOREIGN KEY (`merchant_users_iduser`) REFERENCES `merchant` (`users_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `alamatpembeli`
--
ALTER TABLE `alamatpembeli`
  ADD CONSTRAINT `fk_alamat_user` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alamatpembeli_kabupatenkota1` FOREIGN KEY (`kabupatenkota_idkabupatenkota`) REFERENCES `kabupatenkota` (`idkabupatenkota`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `datapengiriman`
--
ALTER TABLE `datapengiriman`
  ADD CONSTRAINT `fk_datapengiriman_pengiriman1` FOREIGN KEY (`pengiriman_idpengiriman`) REFERENCES `pengiriman` (`idpengiriman`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD CONSTRAINT `fk_produk_has_transaksi_produk1` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produk_has_transaksi_transaksi1` FOREIGN KEY (`transaksi_idtransaksi`) REFERENCES `transaksi` (`idtransaksi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD CONSTRAINT `fk_diskusi_diskusi1` FOREIGN KEY (`balas_ke`) REFERENCES `diskusi` (`iddiskusi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_diskusi_produk1` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_diskusi_user1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dukunganpembayaran`
--
ALTER TABLE `dukunganpembayaran`
  ADD CONSTRAINT `fk_merchant_has_tipepembayaran_merchant1` FOREIGN KEY (`merchant_users_iduser`) REFERENCES `merchant` (`users_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_merchant_has_tipepembayaran_tipepembayaran1` FOREIGN KEY (`tipepembayaran_idtipepembayaran`) REFERENCES `tipepembayaran` (`idtipepembayaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dukunganpengiriman`
--
ALTER TABLE `dukunganpengiriman`
  ADD CONSTRAINT `fk_merchant_has_kurir_kurir1` FOREIGN KEY (`kurir_idkurir`) REFERENCES `kurir` (`idkurir`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_merchant_has_kurir_merchant1` FOREIGN KEY (`merchant_users_iduser`) REFERENCES `merchant` (`users_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dukungantarifpengiriman`
--
ALTER TABLE `dukungantarifpengiriman`
  ADD CONSTRAINT `fk_merchant_has_tarifpengiriman_merchant1` FOREIGN KEY (`merchant_users_iduser`) REFERENCES `merchant` (`users_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_merchant_has_tarifpengiriman_tarifpengiriman1` FOREIGN KEY (`tarifpengiriman_idtarifpengiriman`) REFERENCES `tarifpengiriman` (`idtarifpengiriman`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gambarproduk`
--
ALTER TABLE `gambarproduk`
  ADD CONSTRAINT `fk_gambarproduk_produk1` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kabupatenkota`
--
ALTER TABLE `kabupatenkota`
  ADD CONSTRAINT `fk_kabupatenkota_provinsi1` FOREIGN KEY (`provinsi_idprovinsi`) REFERENCES `provinsi` (`idprovinsi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `fk_kategori_merchant1` FOREIGN KEY (`merchant_users_iduser`) REFERENCES `merchant` (`users_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `fk_user_has_produk_produk1` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_produk_user1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `merchant`
--
ALTER TABLE `merchant`
  ADD CONSTRAINT `fk_merchant_users1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `fk_notifikasi_merchant1` FOREIGN KEY (`merchant_users_iduser`) REFERENCES `merchant` (`users_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notifikasi_users1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `obrolan`
--
ALTER TABLE `obrolan`
  ADD CONSTRAINT `fk_obrolan_merchant1` FOREIGN KEY (`merchant_users_iduser`) REFERENCES `merchant` (`users_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_obrolan_user1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_transaksi1` FOREIGN KEY (`transaksi_idtransaksi`) REFERENCES `transaksi` (`idtransaksi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `fk_pengiriman_kurir1` FOREIGN KEY (`kurir_idkurir`) REFERENCES `kurir` (`idkurir`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pengiriman_transaksi1` FOREIGN KEY (`transaksi_idtransaksi`) REFERENCES `transaksi` (`idtransaksi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_jenisproduk1` FOREIGN KEY (`jenisproduk_idjenisproduk`) REFERENCES `jenisproduk` (`idjenisproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produk_kategori1` FOREIGN KEY (`kategori_idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produk_merchant1` FOREIGN KEY (`merchant_users_iduser`) REFERENCES `merchant` (`users_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reviewproduk`
--
ALTER TABLE `reviewproduk`
  ADD CONSTRAINT `fk_reviewproduk_produk1` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reviewproduk_user1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_alamatpembeli1` FOREIGN KEY (`alamatpembeli_idalamat`) REFERENCES `alamatpembeli` (`idalamat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaksi_merchant1` FOREIGN KEY (`merchant_users_iduser`) REFERENCES `merchant` (`users_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaksi_tipepembayaran1` FOREIGN KEY (`tipepembayaran_idtipepembayaran`) REFERENCES `tipepembayaran` (`idtipepembayaran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaksi_user1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_user_has_produk_produk2` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_produk_user2` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
