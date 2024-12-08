-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Agu 2023 pada 17.10
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spkamanah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kendaraan` varchar(255) NOT NULL,
  `nama_kendaraan` varchar(255) NOT NULL,
  `tenor` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`id_alternatif`, `nama`, `alamat`, `jenis_kendaraan`, `nama_kendaraan`, `tenor`, `id_periode`) VALUES
(1, 'Dedi Hendra', 'Jl. Gunung Ledang', 'Kendaraan Roda Dua / Motor', 'Yamaha Aerox 155', 18, 1),
(2, 'Nadilla', 'Batu Gadang', 'Kendaraan Roda Dua / Motor', 'Honda Scoopy Prestige', 24, 1),
(3, 'Nelidawati', 'Jl. Lumbalumba', 'Kendaraan Roda Dua / Motor', 'Yamaha Fino Premium', 24, 1),
(4, 'Sri Wahyuni', 'Sei Beremas', 'Kendaraan Roda Dua / Motor', 'Honda Vario 160', 24, 1),
(5, 'Deno Pandu', 'Jl. Berok Rakik', 'Kendaraan Roda Empat / Mobil', 'Toyota Kijang Innova', 60, 1),
(6, 'Syamsuarina', 'Jl. Indarung', 'Kendaraan Roda Dua / Motor', 'Honda Beat Sporty', 24, 1),
(7, 'Nadia Rozaq', 'Simpang Ampek Air Pacah', 'Kendaraan Roda Dua / Motor', 'Honda Beat', 12, 1),
(8, 'Farrel Arya', 'Perum Wisma Indah Lestari', 'Kendaraan Roda Dua / Motor', 'Yamaha N-Max', 24, 1),
(9, 'Putree Wulan', 'Jl. Manunggal Sako', 'Kendaraan Roda Dua / Motor', 'Honda Beat Sporty', 24, 1),
(10, 'Rahmadina', 'Parak Laweh', 'Kendaraan Roda Dua / Motor', 'Yamaha Aerox 155', 24, 1),
(11, 'Yetti Jonni', 'Perum Padang Sarai Permai', 'Kendaraan Roda Dua / Motor', 'Honda Genio CBS', 24, 1),
(12, 'Rustiamnur', 'Jl. Salak 2', 'Kendaraan Roda Dua / Motor', 'Honda PCX 160', 18, 1),
(13, 'Deli Sofrizon', 'Kampung Tangah', 'Kendaraan Roda Dua / Motor', 'Honda Beat Street', 24, 1),
(14, 'Bun Heng', 'Komp. Prima Lestari', 'Kendaraan Roda Empat / Mobil', 'Toyota Agya', 36, 1),
(15, 'Adelina', 'Perumahan Korem', 'Kendaraan Roda Dua / Motor', 'Yamaha Fino Premium', 18, 1),
(18, 'amsnajs', 'aksjahsas', 'Kendaraan Roda Empat / Mobil', 'njahsjas', 18, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hasil`
--

CREATE TABLE `tbl_hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `hasil` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_hasil`
--

INSERT INTO `tbl_hasil` (`id_hasil`, `id_alternatif`, `id_periode`, `hasil`) VALUES
(1, 1, 1, 0.8),
(2, 2, 1, 0.5125),
(3, 3, 1, 0.5),
(4, 4, 1, 0.8),
(5, 5, 1, 0.65),
(6, 6, 1, 0.2875),
(7, 7, 1, 0.75),
(8, 8, 1, 0.7125),
(9, 9, 1, 0.3625),
(10, 10, 1, 0.4125),
(11, 11, 1, 0.8),
(12, 12, 1, 0.6),
(13, 13, 1, 0.65),
(14, 14, 1, 0.9875),
(15, 15, 1, 0.425);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `jenis_kriteria` varchar(255) NOT NULL,
  `bobot` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `nama_kriteria`, `jenis_kriteria`, `bobot`) VALUES
(1, 'Character', 'Benefit', 0.40),
(2, 'Capital', 'Benefit', 0.20),
(3, 'Capacity', 'Benefit', 0.20),
(4, 'Condition', 'Benefit', 0.15),
(5, 'Collateral', 'Benefit', 0.05);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penilaian`
--

CREATE TABLE `tbl_penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_subkriteria` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_penilaian`
--

INSERT INTO `tbl_penilaian` (`id_penilaian`, `id_alternatif`, `id_subkriteria`, `id_periode`) VALUES
(1, 1, 2, 1),
(2, 1, 6, 1),
(3, 1, 10, 1),
(4, 1, 13, 1),
(5, 1, 17, 1),
(6, 2, 3, 1),
(7, 2, 8, 1),
(8, 2, 11, 1),
(9, 2, 14, 1),
(10, 2, 17, 1),
(11, 3, 4, 1),
(12, 3, 7, 1),
(13, 3, 11, 1),
(14, 3, 13, 1),
(15, 3, 17, 1),
(16, 4, 1, 1),
(17, 4, 7, 1),
(18, 4, 11, 1),
(19, 4, 13, 1),
(20, 4, 17, 1),
(21, 5, 3, 1),
(22, 5, 6, 1),
(23, 5, 10, 1),
(24, 5, 14, 1),
(25, 5, 18, 1),
(26, 6, 4, 1),
(27, 6, 8, 1),
(28, 6, 12, 1),
(29, 6, 16, 1),
(30, 6, 17, 1),
(31, 7, 1, 1),
(32, 7, 7, 1),
(33, 7, 11, 1),
(34, 7, 14, 1),
(35, 7, 18, 1),
(36, 8, 2, 1),
(37, 8, 7, 1),
(38, 8, 10, 1),
(39, 8, 14, 1),
(40, 8, 17, 1),
(41, 9, 4, 1),
(42, 9, 8, 1),
(43, 9, 12, 1),
(44, 9, 14, 1),
(45, 9, 17, 1),
(46, 10, 4, 1),
(47, 10, 8, 1),
(48, 10, 11, 1),
(49, 10, 14, 1),
(50, 10, 17, 1),
(51, 11, 1, 1),
(52, 11, 7, 1),
(53, 11, 11, 1),
(54, 11, 13, 1),
(55, 11, 17, 1),
(56, 12, 4, 1),
(57, 12, 6, 1),
(58, 12, 10, 1),
(59, 12, 13, 1),
(60, 12, 17, 1),
(61, 13, 3, 1),
(62, 13, 7, 1),
(63, 13, 10, 1),
(64, 13, 13, 1),
(65, 13, 17, 1),
(66, 14, 1, 1),
(67, 14, 5, 1),
(68, 14, 9, 1),
(69, 14, 13, 1),
(70, 14, 18, 1),
(71, 15, 4, 1),
(72, 15, 7, 1),
(73, 15, 11, 1),
(74, 15, 15, 1),
(75, 15, 17, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_periode`
--

CREATE TABLE `tbl_periode` (
  `id_periode` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `periode` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_periode`
--

INSERT INTO `tbl_periode` (`id_periode`, `keterangan`, `periode`) VALUES
(1, 'Periode Januari 2023', '2023-01-31'),
(2, 'Periode Februari 2023', '2023-02-28'),
(3, 'Periode Maret 2023', '2023-03-31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_subkriteria`
--

CREATE TABLE `tbl_subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `nbobot` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_subkriteria`
--

INSERT INTO `tbl_subkriteria` (`id_subkriteria`, `id_kriteria`, `ket`, `nbobot`) VALUES
(1, 1, 'Resiko Kredit Sangat Rendah', 1.00),
(2, 1, 'Resiko Kredit Rendah', 0.75),
(3, 1, 'Resiko Kredit Sedang', 0.50),
(4, 1, 'Resiko Kredit Tinggi', 0.25),
(5, 2, '> Rp. 20.000.000', 1.00),
(6, 2, '> Rp. 10.000.000 - Rp. 20.000.000', 0.75),
(7, 2, '> Rp. 5.000.000 - Rp. 10.000.000', 0.50),
(8, 2, '≤ Rp. 5.000.000', 0.25),
(9, 3, '> Rp. 5.000.000', 1.00),
(10, 3, '> Rp. 2.500.000 - Rp. 5.000.000', 0.75),
(11, 3, '> Rp. 1.000.000 - Rp. 2.500.000', 0.50),
(12, 3, '≤ Rp.1.000.000', 0.25),
(13, 4, 'Rumah Milik Pribadi', 1.00),
(14, 4, 'Rumah Milik Keluarga / Orang Tua', 0.75),
(15, 4, 'Rumah Dinas', 0.50),
(16, 4, 'Kontrak / Sewa', 0.25),
(17, 5, 'BPKB Kendaraan Baru', 1.00),
(18, 5, 'BPKB Kendaraan Bekas', 0.75);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `level`, `nama_lengkap`) VALUES
(1, 'Admin', 'admin', 'Admin', 'Muhammad Rafvy Octa Nugraha'),
(2, 'Pimpinan', 'pimpinan', 'Pimpinan', 'Afrio Gunawan, S.E');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indeks untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tbl_penilaian`
--
ALTER TABLE `tbl_penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indeks untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indeks untuk tabel `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_penilaian`
--
ALTER TABLE `tbl_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
