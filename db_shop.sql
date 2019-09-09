-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Sep 2019 pada 18.37
-- Versi server: 10.1.33-MariaDB
-- Versi PHP: 7.2.6

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
-- Struktur dari tabel `about`
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
-- Dumping data untuk tabel `about`
--

INSERT INTO `about` (`id`, `nama`, `alias`, `alamat`, `telpon`, `email`, `tanda_tangan`, `nama_ttd`, `no_peg`, `moto`) VALUES
(1, 'CV. AIR MANDIRI DISTRIBUSINDO', 'CV. AMD', 'Jl. A yani km 17,9 Komp. Sumber Baru no A7 sebrang dealer mazda', '085101899600', 'airmandiri.sms@gmail.com', 'Pimpinan', 'Miftahul Hair', 'Operasional Manager', 'Anda Puas Kami Senang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `password` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin@admin.com', '$2y$10$eF5INhHqW0Gm514MAdZih.l/P3T9LEdKM3dX6zQoS5kuZPPg1icBG'),
(2, 'adminbaru@mail.com', '$2y$10$gGC7jF1G.BPrtaoIKHhHaenqm6B2s7yNfbdmRWEzSy/.JT3RzwJie'),
(4, 'admin123@mail.com', '$2y$10$kSuSC2Nor9/YM5gZIyWyAOk6gm9bwgR/FCi1a.cQkrEMPkXbHDpaW'),
(5, 'haris@haris.com', '$2y$10$ef/is7qkKKZ.lo9umD55w.Ut0cNE0qjxQ..6qOMNoWXn.u7lvu1jW');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(11, 'OREO'),
(12, 'BOLU FAMILY'),
(13, 'BISKUAT'),
(14, 'CHIP AHOY!'),
(15, 'BELVITA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id`, `id_kategori`, `id_produk`) VALUES
(127, 11, 71),
(128, 11, 72),
(129, 11, 73),
(130, 11, 74),
(131, 11, 75),
(132, 12, 76),
(133, 12, 77),
(134, 12, 78),
(135, 12, 79),
(136, 13, 80),
(137, 13, 81),
(138, 13, 82),
(142, 15, 85),
(143, 15, 86),
(144, 15, 87),
(145, 14, 83),
(148, 14, 84),
(150, 13, 88);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunci`
--

CREATE TABLE `kunci` (
  `id` int(10) NOT NULL,
  `lisensi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kunci`
--

INSERT INTO `kunci` (`id`, `lisensi`) VALUES
(1, 'xy123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `password` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `username`, `password`) VALUES
(17, 'baru@baru.com', '$2y$10$N9652yxMBQ/b9hwNOIqureBu3oO9//5wrbXfaGegYXaATqHWfdBRy'),
(18, 'tes@tes.com', '$2y$10$u5VsR./SLyYSk1enBPAb0urUQ.p4mrTjCZB/cy2Y2iIoa3r/U3Ftq'),
(19, 'azmicina@gmail.com', '$2y$10$ab7ZZxm99OQ333S2X2lOFORA.XAVhEY51wgyGlVNmoX0V7VjYYz2S'),
(20, 'yayanse@gmail.com', '$2y$10$Nqh5kPjsKIUVYQnBEs4b.O32wmhMzGrR0FxQ9Kb92cS0mBksEpxFq'),
(21, 'dense@gmail.com', '$2y$10$sX9.1VpB0qQliEtNp.WDZOkhbWVfO0JJ.MS8krMs6G.yff9s618za'),
(22, 'avryz@gmail.com', '$2y$10$MiCow7AMhFWceoYGHFoTEu7jBl05.0fbnr5R/qSlqf8x9erYjryW.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan_profile`
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
-- Dumping data untuk tabel `pelanggan_profile`
--

INSERT INTO `pelanggan_profile` (`id`, `id_pelanggan`, `nama_pelanggan`, `no_telpon`, `alamat`, `created_at`) VALUES
(1, 17, 'Toko Haries', '085346066284', 'Jl Jurusan Pelaihari Desa Pembataan', '2019-08-03'),
(2, 19, 'Al-barokah', '081253340179', 'jl bati-bati', '2019-08-05'),
(3, 20, 'Yanuar snack', '085751738501', 'jl. panglima batur banjarbaru', '2019-08-10'),
(4, 21, 'Denis Snack', '085101765775', 'jl. wengga kuda banjarbaru', '2019-08-05'),
(5, 22, 'toko syihab', '0811885744', 'panglima batur', '2019-08-01'),
(6, 18, 'toko tes', '085754687767', 'banjarmasin', '2019-08-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `dibayar` int(11) DEFAULT NULL,
  `tanggal_verifikasi` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_penjualan`, `id_sales`, `dibayar`, `tanggal_verifikasi`) VALUES
(1, 1, 10, 3601383, '2019-08-12'),
(2, 2, 10, 2194358, '2019-08-15'),
(3, 5, 10, 723769, '2019-08-15'),
(4, 3, 10, 1102464, '2019-08-19'),
(5, 7, 10, 180070, '2019-08-19'),
(6, 8, 10, 360139, '2019-08-19'),
(7, 4, 10, 773676, '2019-08-20'),
(8, 9, 10, 183744, '2019-09-27'),
(9, 10, 10, 360139, '2019-08-27'),
(10, 12, 10, 183744, '2019-09-27'),
(11, 13, 11, 551232, '2019-08-31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `tanggal_penjualan` varchar(180) NOT NULL,
  `id_pelanggan_profile` int(11) NOT NULL,
  `utang` int(11) NOT NULL,
  `jatuh_tempo` varchar(180) NOT NULL,
  `diskon` int(11) NOT NULL,
  `status` varchar(40) DEFAULT 'keranjang',
  `bukti_bayar` varchar(180) DEFAULT NULL,
  `tgl_bayar` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal_penjualan`, `id_pelanggan_profile`, `utang`, `jatuh_tempo`, `diskon`, `status`, `bukti_bayar`, `tgl_bayar`) VALUES
(1, '2019-08-10', 1, 3674880, '2019-08-25', 73497, 'lunas', '../assets/img/bukti_1_023515_14033711_1373867745976427_621156488_a.jpg', NULL),
(2, '2019-08-12', 1, 2239140, '2019-08-27', 44782, 'lunas', '../assets/img/bukti_2_024340_14033711_1373867745976427_621156488_a.jpg', NULL),
(3, '2019-08-15', 1, 1102464, '2019-08-30', 0, 'lunas', NULL, NULL),
(4, '2019-08-15', 2, 789465, '2019-08-30', 15789, 'lunas', '../assets/img/bukti_4_112938_14033711_1373867745976427_621156488_a.jpg', NULL),
(5, '2019-08-15', 3, 738539, '2019-08-30', 14770, 'lunas', '../assets/img/bukti_5_065359__LN2kiem_400x400.jpg', NULL),
(6, '2019-08-15', 4, 195888, '2019-08-30', 3917, 'wait', '../assets/img/bukti_6_101818__LN2kiem_400x400.jpg', '2019-08-27'),
(7, '2019-08-15', 3, 183744, '2019-08-30', 3674, 'lunas', '../assets/img/bukti_7_080200_14033711_1373867745976427_621156488_a.jpg', NULL),
(8, '2019-08-19', 3, 367488, '2019-09-03', 7349, 'lunas', '../assets/img/bukti_8_080610_checkout.PNG', NULL),
(9, '2019-08-19', 3, 183744, '2019-09-03', 0, 'lunas', '../assets/img/bukti_9_113304_orang stres.jpg', '2019-09-27'),
(10, '2019-08-20', 2, 367488, '2019-09-04', 7349, 'lunas', '../assets/img/bukti_10_043316__LN2kiem_400x400.jpg', '2019-08-24'),
(12, '2019-08-27', 2, 183744, '2019-09-11', 0, 'lunas', '../assets/img/bukti_12_125138_input data manual.png', '2019-09-27'),
(13, '2019-08-30', 1, 551232, '2019-09-14', 0, 'lunas', NULL, NULL),
(14, '2019-08-30', 6, 334118, '2019-09-14', 0, 'utang', NULL, NULL),
(15, '2019-08-30', 2, 551232, '2019-09-14', 0, 'utang', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(180) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `foto_utama` varchar(180) NOT NULL,
  `stok` int(11) NOT NULL,
  `expired` varchar(180) NOT NULL,
  `sup` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `harga_produk`, `foto_utama`, `stok`, `expired`, `sup`) VALUES
(71, 'OREO 29,4 Strawberry', 183744, '../assets/img/p_110559_oreo strawberi 29,4.jpg', 80, '2020-08-08', 'MIT (Mondelez Indonesia Trading)'),
(72, 'OREO 29,4 Peanut Butter', 183744, '../assets/img/p_110808_oreo peanut butter 29,4.jpg', 84, '2020-08-08', 'MIT (Mondelez Indonesia Trading)'),
(73, 'OREO 29,4 Vanilla', 183744, '../assets/img/p_110919_oreo vanilla 29,4.jpg', 94, '2020-08-08', 'MIT (Mondelez Indonesia Trading)'),
(74, 'OREO 29,4 Coklat', 183744, '../assets/img/p_110955_oreo coklat 29,4.jpg', 98, '2020-08-08', 'MIT (Mondelez Indonesia Trading)'),
(75, 'OREO 29,4 Ice Cream Blueberry', 183744, '../assets/img/p_111123_oreo ice cream blue berry 29,4.jpg', 98, '2020-08-08', 'MIT (Mondelez Indonesia Trading)'),
(76, 'BISKUAT Bolu Pandan 16gr', 185803, '../assets/img/p_111703_biskuat bolu pandan.jpg', 99, '2020-05-08', 'MIT (Mondelez Indonesia Trading)'),
(77, 'BISKUAT Bolu Coklat 16gr', 185803, '../assets/img/p_111740_biskuat bolu coklat.jpg', 95, '2020-05-08', 'MIT (Mondelez Indonesia Trading)'),
(78, 'OREO Softcake 16gr', 236174, '../assets/img/p_111953_oreo softcake.jpg', 97, '2020-05-08', 'MIT (Mondelez Indonesia Trading)'),
(79, 'Kraft Keju Cake 16gr', 236174, '../assets/img/p_112125_keju cake.jpg', 96, '2020-05-08', 'MIT (Mondelez Indonesia Trading)'),
(80, 'BISKUAT Original 10gr', 97944, '../assets/img/p_112329_biskuat original 10gram.jpg', 98, '2020-05-08', 'MIT (Mondelez Indonesia Trading)'),
(81, 'BISKUAT Coklat 10gr', 97944, '../assets/img/p_112517_biskuat coklat 10gram.jpg', 99, '2020-05-08', 'MIT (Mondelez Indonesia Trading)'),
(82, 'BISKUAT Sandwich 27gr', 132818, '../assets/img/p_112736_biskuat sandwich 27gram.jpg', 99, '2020-05-08', 'MIT (Mondelez Indonesia Trading)'),
(83, 'CHIP AHOY! Choco Original 84gr', 148923, '../assets/img/p_113233_CHIP AHOY ORI.jpg', 120, '2020-02-08', 'MIT (Mondelez Indonesia Trading)'),
(84, 'CHIP AHOY! Choco Delight 84gr', 148922, '../assets/img/p_113429_chip ahoy cok.jpg', 110, '2020-02-08', 'MIT (Mondelez Indonesia Trading)'),
(85, 'BELVITA Susu dan Sereal 80gr', 148922, '../assets/img/p_113625_belvita susu sereal.jpg', 100, '2020-02-08', 'MIT (Mondelez Indonesia Trading)'),
(86, 'BELVITA Madu dan Coklat 80gr', 148922, '../assets/img/p_113727_belvita madu coklat.jpg', 100, '2020-03-08', 'MIT (Mondelez Indonesia Trading)'),
(87, 'BELVITA Pisang dan Sereal 80gr', 148922, '../assets/img/p_113852_belvita banana sereal.jpg', 100, '2020-03-08', 'MIT (Mondelez Indonesia Trading)'),
(88, 'BISKUAT Coklat 140gr', 201185, '../assets/img/p_050059_piutang.png', 100, '2020-02-18', 'MIT (Mondelez Indonesia Trading)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_record`
--

CREATE TABLE `produk_record` (
  `id` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk_record`
--

INSERT INTO `produk_record` (`id`, `id_penjualan`, `id_produk`, `jumlah`) VALUES
(1, 1, 71, 10),
(2, 1, 72, 10),
(3, 2, 74, 1),
(4, 2, 75, 2),
(5, 2, 76, 1),
(6, 2, 77, 3),
(7, 2, 78, 2),
(8, 2, 79, 2),
(9, 3, 71, 1),
(10, 3, 72, 2),
(11, 3, 73, 3),
(12, 4, 71, 1),
(13, 4, 72, 1),
(14, 4, 77, 1),
(15, 4, 78, 1),
(16, 5, 73, 1),
(17, 5, 77, 1),
(18, 5, 79, 1),
(19, 5, 82, 1),
(20, 6, 80, 1),
(21, 6, 81, 1),
(22, 7, 74, 1),
(23, 8, 71, 1),
(24, 8, 72, 1),
(25, 9, 71, 1),
(28, 10, 72, 1),
(29, 10, 73, 1),
(30, 12, 71, 1),
(31, 13, 71, 1),
(32, 13, 72, 1),
(33, 13, 73, 1),
(34, 14, 80, 1),
(35, 14, 79, 1),
(36, 15, 71, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
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
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`id`, `nama_sales`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `no_telpon`, `alamat`, `email`, `password`, `created_at`) VALUES
(10, 'haries', 'L', 'banjarbaru', '1996-03-26', '085346066284', 'Jl. Jurusan Pelaihari Desa Pembataan', 'haries@gmail.com', '$2y$10$dsB2jYKKN9Ph5i/vR2tF6OUun5gasNzqoiJJ3wzwtRFAz81nnqZUa', '2019-08-10'),
(11, 'denis', 'L', 'banjarmasin', '1995-07-21', '081253340179', 'jl wengga', 'denis@gmail.com', '$2y$10$jjAepvF0eLCYWrLB233xm.Np19cUSLmpw7KEb/WBrJTOMlIwYZuTW', '2019-08-27');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `kunci`
--
ALTER TABLE `kunci`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan_profile`
--
ALTER TABLE `pelanggan_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan_profile`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk_record`
--
ALTER TABLE `produk_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT untuk tabel `kunci`
--
ALTER TABLE `kunci`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pelanggan_profile`
--
ALTER TABLE `pelanggan_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `produk_record`
--
ALTER TABLE `produk_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD CONSTRAINT `kategori_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategori_produk_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelanggan_profile`
--
ALTER TABLE `pelanggan_profile`
  ADD CONSTRAINT `pelanggan_profile_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_pelanggan_profile`) REFERENCES `pelanggan_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk_record`
--
ALTER TABLE `produk_record`
  ADD CONSTRAINT `produk_record_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_record_ibfk_2` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
