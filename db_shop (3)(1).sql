-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2019 at 02:23 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `nama` varchar(180) NOT NULL,
  `alias` varchar(180) NOT NULL,
  `alamat` varchar(180) NOT NULL,
  `telpon` varchar(180) NOT NULL,
  `email` varchar(180) NOT NULL,
  `tanda_tangan` varchar(180) NOT NULL,
  `nama_ttd` varchar(180) NOT NULL,
  `no_peg` varchar(180) NOT NULL,
  `moto` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `nama`, `alias`, `alamat`, `telpon`, `email`, `tanda_tangan`, `nama_ttd`, `no_peg`, `moto`) VALUES
(1, 'CV. AIR MANDIRI DISTRIBUSINDO', 'CV. AMD', 'Jl. A Yani Km. 17,9 Komp. Pergudangan Sumber Baru no. 47', '089999999999', 'airmandi@mail.com', 'Pimpinan CV. AMD', 'Udin Tampan', 'ID. 920209372', 'Anda Puas Kami Senang');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `password` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin@admin.com', '$2y$10$eF5INhHqW0Gm514MAdZih.l/P3T9LEdKM3dX6zQoS5kuZPPg1icBG'),
(2, 'adminbaru@mail.com', '$2y$10$gGC7jF1G.BPrtaoIKHhHaenqm6B2s7yNfbdmRWEzSy/.JT3RzwJie'),
(3, 'admintampan@mail.com', '$2y$10$NRSefTW2VNvchN6CI1Kic.N0xKVbR.AIJPZjC.qMqYhQsS/4CghL2');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'Buah'),
(2, 'Sayur'),
(3, 'Bulat'),
(4, 'Daging'),
(8, 'Makanan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id`, `id_kategori`, `id_produk`) VALUES
(2, 1, 3),
(5, 2, 4),
(6, 3, 3),
(84, 2, 2),
(85, 3, 2),
(90, 1, 1),
(97, 1, 5),
(98, 3, 5),
(105, 1, 18),
(106, 2, 18),
(110, 1, 65),
(111, 3, 65),
(112, 2, 66);

-- --------------------------------------------------------

--
-- Table structure for table `kunci`
--

CREATE TABLE `kunci` (
  `id` int(10) NOT NULL,
  `lisensi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kunci`
--

INSERT INTO `kunci` (`id`, `lisensi`) VALUES
(1, 'xy123');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `password` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `username`, `password`) VALUES
(8, 'udin@mail.com', '$2y$10$kM40mcBWthdVWrtq8IdHreq638oTaigXvH35wquAehLx1tqRGROv.'),
(9, 'warik@mail.com', '$2y$10$8A3BKXGcJuqYNCtBuQJWAOHm6w8f5h67/n.ncuxy/m6SBQlPY/UhS'),
(10, 'ayam@mail.com', '$2y$10$X1h0f9fxug2ND7VgmdskZuBDKbSMSpaMAYBAqBFceZV.mNiFLH6Re'),
(11, 'pelanggan@mail.com', '$2y$10$eqg9sFHp1XdHfVriW3.hCO2/rbWTr/84AArpBEhNnvtYCWshZR9pm'),
(12, 'aluh@mail.com', '$2y$10$Xcry0WXIbZVap4MW1p518upaTc8IxI5U3WVHjBv5D2RbdxzxubPjK'),
(13, 'kambing@mail.com', '$2y$10$.9xuhy4IpKjzkPkig2hqxe.Nw8KWdQTN/ZPS72qVist/dtnalg5N.');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan_profile`
--

CREATE TABLE `pelanggan_profile` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(180) NOT NULL,
  `no_telpon` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan_profile`
--

INSERT INTO `pelanggan_profile` (`id`, `id_pelanggan`, `nama_pelanggan`, `no_telpon`, `alamat`, `created_at`) VALUES
(3, 8, 'Udin Udinerer', '0852333223232', 'Jl. Udin ABC ae', '2019-07-14'),
(4, 9, 'Warik Warrikkks', '88888888', 'wrwewrwewe', '2019-07-15'),
(5, 11, 'Toko Pelanggan', '081234567890', 'Jl. Tampan Dan Berani', ''),
(6, 12, 'Toko Aluh', '085292929292', 'Jl. ALuh abc', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `dibayar` int(11) DEFAULT NULL,
  `tanggal_verifikasi` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_penjualan`, `id_sales`, `dibayar`, `tanggal_verifikasi`) VALUES
(18, 27, 8, 147000, '2019-07-16'),
(19, 26, 9, 7350, '2019-07-16'),
(20, 29, 9, 40000, '2019-07-17'),
(21, 28, 8, 980000, '2019-07-22'),
(22, 25, 8, 49490, '2019-07-22'),
(23, 31, 8, 494900, '2019-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `tanggal_penjualan` varchar(180) NOT NULL,
  `id_pelanggan_profile` int(11) NOT NULL,
  `utang` int(11) NOT NULL,
  `jatuh_tempo` varchar(180) NOT NULL,
  `diskon` int(11) NOT NULL,
  `status` varchar(40) DEFAULT 'keranjang',
  `bukti_bayar` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal_penjualan`, `id_pelanggan_profile`, `utang`, `jatuh_tempo`, `diskon`, `status`, `bukti_bayar`) VALUES
(25, '2019-07-15', 3, 50500, '2019-07-30', 1010, 'lunas', '../assets/img/bukti_25_122204_bukti.JPG'),
(26, '2019-07-15', 3, 7500, '2019-07-30', 150, 'lunas', '../assets/img/bukti_27_104857_bukti.JPG'),
(27, '2019-07-16', 4, 150000, '2019-07-31', 3000, 'lunas', '../assets/img/bukti_27_104857_bukti.JPG'),
(28, '2019-07-16', 4, 1000000, '2019-07-31', 20000, 'lunas', '../assets/img/bukti_28_041020_bukti.JPG'),
(29, '2019-07-17', 5, 21900, '2019-08-01', 0, 'utang', NULL),
(30, '2019-07-20', 6, 34400, '2019-08-04', 0, 'utang', NULL),
(31, '2019-07-22', 3, 505000, '2019-08-06', 10100, 'lunas', '../assets/img/bukti_31_122734_bukti.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(180) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `foto_utama` varchar(180) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `harga_produk`, `foto_utama`, `stok`) VALUES
(1, 'Pisang', 1000, '../assets/img/p_121327_pisang.jpg', 1090),
(2, 'Tomat', 1000, '../assets/img/tomat.jpg', 555),
(3, 'Apel', 5000, '../assets/img/apel.jpg', 500),
(4, 'Wortel', 800, '../assets/img/wortel.jpg', 535),
(5, 'Anggur', 1500, '../assets/img/p_021651_anggur3.jpg', 505),
(18, 'Waluha', 2300, '../assets/img/p_054601_labu.jpg', 500),
(65, 'Labu', 1500, 'tes', 100),
(66, 'Labu 2', 100, '../assets/img/p_022250_labu.jpg', 105);

-- --------------------------------------------------------

--
-- Table structure for table `produk_record`
--

CREATE TABLE `produk_record` (
  `id` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_record`
--

INSERT INTO `produk_record` (`id`, `id_penjualan`, `id_produk`, `jumlah`) VALUES
(23, 25, 18, 10),
(24, 25, 3, 3),
(25, 25, 5, 5),
(26, 26, 5, 5),
(27, 27, 5, 100),
(28, 28, 1, 1000),
(30, 29, 1, 5),
(31, 29, 2, 10),
(32, 29, 18, 3),
(33, 30, 5, 5),
(34, 30, 18, 3),
(35, 30, 3, 4),
(36, 31, 1, 500),
(37, 31, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `nama_sales` varchar(180) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `tempat_lahir` varchar(180) NOT NULL,
  `tanggal_lahir` varchar(180) NOT NULL,
  `no_telpon` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(180) NOT NULL,
  `created_at` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `nama_sales`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `no_telpon`, `alamat`, `email`, `password`, `created_at`) VALUES
(8, 'Aninda', 'P', 'Banjarbaru', '1995-07-12', '29329392392', 'Jl. Aninda 123', 'aninda@mail.com', '$2y$10$TwsK2IeRxiEomDQoo8fd5OU3TjzprLxm/Ja58R86TkImxpw8LkEo6', '2019-07-14'),
(9, 'Anang', 'L', 'Martapura', '1990-06-20', '089999222323', 'Jl. ANang Ining', 'anang@mail.com', '$2y$10$XZPO3O6DDMMacP3Yq7q4ceI.BZ5KZv4tAWitb8g3mS9eY/NonE8dm', '2019-07-15'),
(10, 'Pria', 'L', 'abc', '1995-07-12', '082392932323', 'Jl. Pria tampans', 'pria@mail.com', '$2y$10$aGaW0iN.1JAoHx2I92i9XOcL3Z77iCYPqE/Iw.lvlngkSVGea0pZK', '2019-07-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `kunci`
--
ALTER TABLE `kunci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan_profile`
--
ALTER TABLE `pelanggan_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan_profile`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_record`
--
ALTER TABLE `produk_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `kunci`
--
ALTER TABLE `kunci`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pelanggan_profile`
--
ALTER TABLE `pelanggan_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `produk_record`
--
ALTER TABLE `produk_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD CONSTRAINT `kategori_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategori_produk_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelanggan_profile`
--
ALTER TABLE `pelanggan_profile`
  ADD CONSTRAINT `pelanggan_profile_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_pelanggan_profile`) REFERENCES `pelanggan_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk_record`
--
ALTER TABLE `produk_record`
  ADD CONSTRAINT `produk_record_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_record_ibfk_2` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
