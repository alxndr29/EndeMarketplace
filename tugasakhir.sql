-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 07:10 PM
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
  `kota` varchar(45) NOT NULL,
  `provinsi` varchar(45) NOT NULL,
  `telepon` varchar(45) NOT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `merchant_users_iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `alamatpembeli`
--

CREATE TABLE `alamatpembeli` (
  `idalamat` int(11) NOT NULL,
  `simpan_sebagai` varchar(45) NOT NULL,
  `nama_penerima` varchar(45) NOT NULL,
  `alamatlengkap` varchar(45) NOT NULL,
  `kota` varchar(45) NOT NULL,
  `provinsi` varchar(45) NOT NULL,
  `telepon` varchar(45) NOT NULL,
  `users_iduser` int(11) NOT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `datapengiriman`
--

CREATE TABLE `datapengiriman` (
  `iddatapengiriman` int(11) NOT NULL,
  `koordinat_asal` varchar(45) DEFAULT NULL,
  `koordinat_tujuan` varchar(45) DEFAULT NULL,
  `jarak` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `iddevice` int(11) NOT NULL,
  `alamatip` varchar(45) NOT NULL,
  `jenis_perangkat` varchar(45) NOT NULL,
  `sistem_operasi` varchar(45) NOT NULL,
  `users_iduser` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `diskusi`
--

CREATE TABLE `diskusi` (
  `iddiskusi` int(11) NOT NULL,
  `users_iduser` int(11) NOT NULL,
  `produk_idproduk` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `pesandiskusi` varchar(45) DEFAULT NULL,
  `balas_ke` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dukunganpengiriman`
--

CREATE TABLE `dukunganpengiriman` (
  `merchant_users_iduser` int(11) NOT NULL,
  `kurir_idkurir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gambarproduk`
--

CREATE TABLE `gambarproduk` (
  `idgambarproduk` int(11) NOT NULL,
  `nama_file` varchar(45) DEFAULT NULL,
  `produk_idproduk` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Kebutuhan Harian', NULL, NULL);

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
(5, 'Testing', '2021-04-15 14:11:55', '2021-04-15 14:11:55', 4),
(6, 'Testong', NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `users_iduser` int(11) NOT NULL,
  `produk_idproduk` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `nama` varchar(45) NOT NULL,
  `status_merchant` enum('Aktif','NonAktif') DEFAULT 'Aktif',
  `foto_profil` varchar(45) DEFAULT NULL,
  `foto_sampul` varchar(45) DEFAULT NULL,
  `deskripsi` varchar(45) DEFAULT NULL,
  `status_buka` enum('Ya','Tidak') DEFAULT NULL,
  `jam_buka` varchar(45) DEFAULT NULL,
  `jam_tutup` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `users_iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`nama`, `status_merchant`, `foto_profil`, `foto_sampul`, `deskripsi`, `status_buka`, `jam_buka`, `jam_tutup`, `created_at`, `updated_at`, `users_iduser`) VALUES
('Merchant Gaje', 'Aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
('Merchant Felix', 'Aktif', NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-15 14:03:59', '2021-04-15 14:03:59', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `idnotifikasi` int(11) NOT NULL,
  `pesan_notifikasi` varchar(45) NOT NULL,
  `baca` enum('Ya','Tidak') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `users_iduser` int(11) NOT NULL,
  `merchant_idmerchant` int(11) NOT NULL
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
  `status_baca` enum('SudahBaca','BelumBaca') DEFAULT NULL,
  `users_iduser` int(11) NOT NULL,
  `merchant_users_iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `idpengiriman` int(11) NOT NULL,
  `tanggal_waktu_pengiriman` datetime DEFAULT NULL,
  `estimasi` int(11) DEFAULT NULL,
  `jenis_kurir` enum('KurirPribadi','KurirPihakKe3') DEFAULT NULL,
  `biaya_pengiriman` int(11) DEFAULT NULL,
  `nomor_resi` varchar(45) DEFAULT NULL,
  `status_pengiriman` varchar(45) DEFAULT NULL,
  `kurir_idkurir` int(11) NOT NULL,
  `datapengiriman_iddatapengiriman` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `deskripsi` varchar(45) NOT NULL,
  `minimum_pemesanan` int(11) NOT NULL,
  `status` enum('Aktif','TidakAktif') NOT NULL,
  `stok` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `preorder` enum('Aktif','TidakAktif') NOT NULL,
  `volume` int(11) NOT NULL,
  `kategori_idkategori` int(11) NOT NULL,
  `jenisproduk_idjenisproduk` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reviewproduk`
--

CREATE TABLE `reviewproduk` (
  `idreviewproduk` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `komentar_produk` varchar(45) DEFAULT NULL,
  `rating_produk` int(11) DEFAULT NULL,
  `users_iduser` int(11) NOT NULL,
  `produk_idproduk` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int(11) NOT NULL,
  `nomor_transaksi` varchar(45) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `status_transaksi` enum('MenungguKonfirmasi','PesananDiproses','PesananDikirim','SampaiTujuan') DEFAULT NULL,
  `jenis_pembayaran` enum('COD','Transfer') DEFAULT NULL,
  `nominal_pembayaran` int(11) DEFAULT NULL,
  `users_iduser` int(11) NOT NULL,
  `merchant_users_iduser` int(11) NOT NULL,
  `alamatpembeli_idalamat` int(11) NOT NULL,
  `pengiriman_idpengiriman` int(11) NOT NULL,
  `pembayaran_idpembayaran` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telepon` varchar(45) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `foto_profil` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`iduser`, `name`, `email`, `password`, `telepon`, `email_verified_at`, `foto_profil`, `created_at`, `updated_at`) VALUES
(1, 'ewq', '@gmail.com', '123', '123', '2021-04-16 00:00:00', '31', '2021-04-07 00:00:00', '2021-04-16 00:00:00'),
(4, 'Alexander Evan', 'alexevan2810@gmail.com', '$2y$10$.LvuS27gw18vIkm9nETN../ZDBLLUWQfe1EXu15H/qfkq08w1hX9q', NULL, '2021-04-15 14:02:19', NULL, '2021-04-15 14:01:44', '2021-04-15 14:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `users_iduser` int(11) NOT NULL,
  `produk_idproduk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamatmerchant`
--
ALTER TABLE `alamatmerchant`
  ADD PRIMARY KEY (`merchant_users_iduser`),
  ADD KEY `fk_alamatmerchant_merchant1_idx` (`merchant_users_iduser`);

--
-- Indexes for table `alamatpembeli`
--
ALTER TABLE `alamatpembeli`
  ADD PRIMARY KEY (`idalamat`),
  ADD KEY `fk_alamat_user_idx` (`users_iduser`);

--
-- Indexes for table `datapengiriman`
--
ALTER TABLE `datapengiriman`
  ADD PRIMARY KEY (`iddatapengiriman`);

--
-- Indexes for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD PRIMARY KEY (`produk_idproduk`,`transaksi_idtransaksi`),
  ADD KEY `fk_produk_has_transaksi_transaksi1_idx` (`transaksi_idtransaksi`),
  ADD KEY `fk_produk_has_transaksi_produk1_idx` (`produk_idproduk`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`iddevice`),
  ADD KEY `fk_device_user1_idx` (`users_iduser`);

--
-- Indexes for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`iddiskusi`),
  ADD KEY `fk_diskusi_user1_idx` (`users_iduser`),
  ADD KEY `fk_diskusi_produk1_idx` (`produk_idproduk`),
  ADD KEY `fk_diskusi_diskusi1_idx` (`balas_ke`);

--
-- Indexes for table `dukunganpengiriman`
--
ALTER TABLE `dukunganpengiriman`
  ADD PRIMARY KEY (`merchant_users_iduser`,`kurir_idkurir`),
  ADD KEY `fk_merchant_has_kurir_kurir1_idx` (`kurir_idkurir`),
  ADD KEY `fk_merchant_has_kurir_merchant1_idx` (`merchant_users_iduser`);

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
  ADD KEY `fk_notifikasi_users1_idx` (`users_iduser`);

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
  ADD PRIMARY KEY (`idpembayaran`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`idpengiriman`),
  ADD KEY `fk_pengiriman_kurir1_idx` (`kurir_idkurir`),
  ADD KEY `fk_pengiriman_datapengiriman1_idx` (`datapengiriman_iddatapengiriman`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `fk_produk_kategori1_idx` (`kategori_idkategori`),
  ADD KEY `fk_produk_jenisproduk1_idx` (`jenisproduk_idjenisproduk`);

--
-- Indexes for table `reviewproduk`
--
ALTER TABLE `reviewproduk`
  ADD PRIMARY KEY (`idreviewproduk`),
  ADD KEY `fk_reviewproduk_user1_idx` (`users_iduser`),
  ADD KEY `fk_reviewproduk_produk1_idx` (`produk_idproduk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`),
  ADD KEY `fk_transaksi_user1_idx` (`users_iduser`),
  ADD KEY `fk_transaksi_alamatpembeli1_idx` (`alamatpembeli_idalamat`),
  ADD KEY `fk_transaksi_pengiriman1_idx` (`pengiriman_idpengiriman`),
  ADD KEY `fk_transaksi_pembayaran1_idx` (`pembayaran_idpembayaran`),
  ADD KEY `fk_transaksi_merchant1_idx` (`merchant_users_iduser`);

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
  MODIFY `idalamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `datapengiriman`
--
ALTER TABLE `datapengiriman`
  MODIFY `iddatapengiriman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `iddevice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `iddiskusi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gambarproduk`
--
ALTER TABLE `gambarproduk`
  MODIFY `idgambarproduk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenisproduk`
--
ALTER TABLE `jenisproduk`
  MODIFY `idjenisproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `idkurir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `idnotifikasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obrolan`
--
ALTER TABLE `obrolan`
  MODIFY `idobrolan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `idpembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `idpengiriman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviewproduk`
--
ALTER TABLE `reviewproduk`
  MODIFY `idreviewproduk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamatmerchant`
--
ALTER TABLE `alamatmerchant`
  ADD CONSTRAINT `fk_alamatmerchant_merchant1` FOREIGN KEY (`merchant_users_iduser`) REFERENCES `merchant` (`users_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `alamatpembeli`
--
ALTER TABLE `alamatpembeli`
  ADD CONSTRAINT `fk_alamat_user` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD CONSTRAINT `fk_produk_has_transaksi_produk1` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produk_has_transaksi_transaksi1` FOREIGN KEY (`transaksi_idtransaksi`) REFERENCES `transaksi` (`idtransaksi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `fk_device_user1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD CONSTRAINT `fk_diskusi_diskusi1` FOREIGN KEY (`balas_ke`) REFERENCES `diskusi` (`iddiskusi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_diskusi_produk1` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_diskusi_user1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dukunganpengiriman`
--
ALTER TABLE `dukunganpengiriman`
  ADD CONSTRAINT `fk_merchant_has_kurir_kurir1` FOREIGN KEY (`kurir_idkurir`) REFERENCES `kurir` (`idkurir`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_merchant_has_kurir_merchant1` FOREIGN KEY (`merchant_users_iduser`) REFERENCES `merchant` (`users_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gambarproduk`
--
ALTER TABLE `gambarproduk`
  ADD CONSTRAINT `fk_gambarproduk_produk1` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_notifikasi_users1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `obrolan`
--
ALTER TABLE `obrolan`
  ADD CONSTRAINT `fk_obrolan_merchant1` FOREIGN KEY (`merchant_users_iduser`) REFERENCES `merchant` (`users_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_obrolan_user1` FOREIGN KEY (`users_iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `fk_pengiriman_datapengiriman1` FOREIGN KEY (`datapengiriman_iddatapengiriman`) REFERENCES `datapengiriman` (`iddatapengiriman`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pengiriman_kurir1` FOREIGN KEY (`kurir_idkurir`) REFERENCES `kurir` (`idkurir`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_jenisproduk1` FOREIGN KEY (`jenisproduk_idjenisproduk`) REFERENCES `jenisproduk` (`idjenisproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produk_kategori1` FOREIGN KEY (`kategori_idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_transaksi_pembayaran1` FOREIGN KEY (`pembayaran_idpembayaran`) REFERENCES `pembayaran` (`idpembayaran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaksi_pengiriman1` FOREIGN KEY (`pengiriman_idpengiriman`) REFERENCES `pengiriman` (`idpengiriman`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
