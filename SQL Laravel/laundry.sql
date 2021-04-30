-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Apr 2021 pada 14.39
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_member`
--

CREATE TABLE `tb_member` (
  `id` int(20) NOT NULL,
  `id_user` int(255) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_member`
--

INSERT INTO `tb_member` (`id`, `id_user`, `nama`, `alamat`, `jenis_kelamin`, `tlp`) VALUES
(1, 1, 'Sulthon', 'jl tambingan', 'Laki-Laki', '08135151'),
(2, 1, 'aby', 'jl tambingan', 'Laki-Laki', '0813254687');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `id` int(20) NOT NULL,
  `id_user` int(200) NOT NULL,
  `nama_outlet` varchar(500) NOT NULL,
  `alamat` text NOT NULL,
  `tlp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_outlet`
--

INSERT INTO `tb_outlet` (`id`, `id_user`, `nama_outlet`, `alamat`, `tlp`) VALUES
(1, 1, 'Toko Rico Ramada', 'Jl Durian No 37', '081235654');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id` int(20) NOT NULL,
  `id_outlet` int(20) NOT NULL,
  `jenis` enum('Kiloan','Selimut','Bed Cover','Kaos','Lain') NOT NULL,
  `nama_paket` varchar(200) NOT NULL,
  `harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_paket`
--

INSERT INTO `tb_paket` (`id`, `id_outlet`, `jenis`, `nama_paket`, `harga`) VALUES
(1, 1, 'Kiloan', 'Cuci Kilat Kaos', 20000),
(2, 1, 'Kaos', 'Kaos', 40000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(20) NOT NULL,
  `id_outlet` int(20) NOT NULL,
  `id_paket` int(25) NOT NULL,
  `kode_invoice` int(25) NOT NULL,
  `id_member` int(20) NOT NULL,
  `tgl` date NOT NULL,
  `batas_waktu` date NOT NULL,
  `tgl_bayar` date NOT NULL,
  `biaya_tambahan` int(20) NOT NULL,
  `diskon` double NOT NULL,
  `pajak` int(20) NOT NULL,
  `total_harga` int(255) NOT NULL,
  `status` enum('baru','proses','selesai','diambil') NOT NULL,
  `dibayar` enum('dibayar','belum_dibayar') NOT NULL,
  `id_user` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `id_outlet`, `id_paket`, `kode_invoice`, `id_member`, `tgl`, `batas_waktu`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `total_harga`, `status`, `dibayar`, `id_user`) VALUES
(1, 1, 1, 660000, 1, '2021-04-20', '2021-04-20', '2021-04-20', 0, 0, 2000, 22000, 'baru', 'dibayar', 1),
(4, 1, 1, 872059, 1, '2021-04-22', '2021-04-24', '2021-04-22', 0, 2, 2000, 2400, 'baru', 'dibayar', 1),
(5, 1, 2, 663937, 1, '2021-04-22', '2021-04-22', '2021-04-22', 0, 0, 0, 40000, 'baru', 'dibayar', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(25) NOT NULL,
  `id_outlet` int(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `number_user` int(20) NOT NULL,
  `role` enum('admin','kasir','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `id_outlet`, `email`, `nama`, `username`, `password`, `number_user`, `role`) VALUES
(1, 1, 'rico@gmail.com', 'rico', 'rico', '17f53b55ba7e8e3d703b04c4f391fec1', 950949875, 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_google`
--

CREATE TABLE `tb_user_google` (
  `id` int(25) NOT NULL,
  `id_google` varchar(500) NOT NULL,
  `id_outlet` int(255) NOT NULL,
  `nama_google` varchar(500) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) DEFAULT NULL,
  `number_user` int(255) NOT NULL,
  `role` enum('admin','owner','kasir') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user_google`
--

INSERT INTO `tb_user_google` (`id`, `id_google`, `id_outlet`, `nama_google`, `nama`, `photo`, `email`, `password`, `number_user`, `role`) VALUES
(1, '117077529923685316317', 1, 'google', 'lontong mr', 'https://lh3.googleusercontent.com/a-/AOh14GjrhJLTMuAPWN2UXXm8j94FRcQmWN15D6lkAsA9=s96-c', 'lontongmr@gmail.com', NULL, 173681142, 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_outlet` (`id_outlet`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_outlet` (`id_outlet`);

--
-- Indeks untuk tabel `tb_user_google`
--
ALTER TABLE `tb_user_google`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_outlet` (`id_outlet`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_outlet`
--
ALTER TABLE `tb_outlet`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_user_google`
--
ALTER TABLE `tb_user_google`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
