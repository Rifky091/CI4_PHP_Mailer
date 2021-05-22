-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Bulan Mei 2021 pada 08.10
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schedular`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'c93ccd78b2076528346216b3b2f701e6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `email_jadwal`
--

CREATE TABLE `email_jadwal` (
  `kode_email_jadwal` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `subject` text NOT NULL,
  `pesan` text NOT NULL,
  `waktu_kirim` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `email_jadwal`
--

INSERT INTO `email_jadwal` (`kode_email_jadwal`, `id_jadwal`, `subject`, `pesan`, `waktu_kirim`, `status`) VALUES
(1, 1, 'Jadwal Kegiatan Hari ini : Matkul Andal', 'Halo aldisaeps, jangan lupa jadwalmu hari ini yaitu Matkul Andal pada jam 07:00', '2021-05-05', 0),
(2, 1, 'Jadwal Kegiatan Hari ini : Matkul Andal', 'Halo aldisaeps, jangan lupa jadwalmu hari ini yaitu Matkul Andal pada jam 07:00', '2021-04-30', 1),
(3, 2, 'Jadwal Kegiatan Hari ini : Matkul RPL', 'Halo aldisaeps, jangan lupa jadwalmu hari ini yaitu Matkul RPL pada jam 13:00', '2021-05-03', 0),
(4, 2, 'Jadwal Kegiatan Hari ini : Matkul RPL', 'Halo aldisaeps, jangan lupa jadwalmu hari Senin yaitu Matkul RPL pada jam 13:00', '2021-04-30', 1),
(5, 3, 'Jadwal Kegiatan Hari ini : Matkul Jarkom', 'Halo aldisaeps, jangan lupa jadwalmu hari ini yaitu Matkul Jarkom pada jam 13:00', '2021-05-05', 0),
(6, 3, 'Jadwal Kegiatan Hari ini : Matkul Jarkom', 'Halo aldisaeps, jangan lupa jadwalmu hari Rabu yaitu Matkul Jarkom pada jam 13:00', '2021-05-01', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `email_tugas`
--

CREATE TABLE `email_tugas` (
  `kode_email_tugas` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `subject` text NOT NULL,
  `pesan` text NOT NULL,
  `waktu_kirim` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_jadwal` varchar(150) NOT NULL,
  `jam` time NOT NULL,
  `hari` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_pengguna`, `nama_jadwal`, `jam`, `hari`) VALUES
(1, 2, 'Matkul Andal', '07:00:00', 'Wednesday'),
(2, 2, 'Matkul RPL', '13:00:00', 'Monday'),
(3, 2, 'Matkul Jarkom', '13:00:00', 'Wednesday');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `email`, `password`) VALUES
(2, 'aldisaeps', 'aldisaepurahman@gmail.com', 'd7bce380682432b74704fbd8b6b947ee');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_tugas` varchar(100) NOT NULL,
  `deadline` datetime NOT NULL,
  `tipe_tugas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `email_jadwal`
--
ALTER TABLE `email_jadwal`
  ADD PRIMARY KEY (`kode_email_jadwal`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `email_tugas`
--
ALTER TABLE `email_tugas`
  ADD PRIMARY KEY (`kode_email_tugas`),
  ADD KEY `id_tugas` (`id_tugas`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `email_jadwal`
--
ALTER TABLE `email_jadwal`
  MODIFY `kode_email_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `email_tugas`
--
ALTER TABLE `email_tugas`
  MODIFY `kode_email_tugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `email_jadwal`
--
ALTER TABLE `email_jadwal`
  ADD CONSTRAINT `email_jadwal_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `email_tugas`
--
ALTER TABLE `email_tugas`
  ADD CONSTRAINT `email_tugas_ibfk_1` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
