-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Agu 2023 pada 17.28
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
-- Database: `ta_spkamanah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `merk_kendaraan` varchar(255) NOT NULL,
  `jenis_kendaraan` varchar(255) NOT NULL,
  `tenor` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`id_alternatif`, `nama`, `alamat`, `merk_kendaraan`, `jenis_kendaraan`, `tenor`, `id_periode`) VALUES
(1, 'Dedi Hendra', 'Jl. Gunung Ledang', 'Yamaha Aerox 155', 'Kendaraan Roda Dua / Motor', 18, 1),
(2, 'Nadilla', 'Batu Gadang', 'Honda Scoopy Prestige', 'Kendaraan Roda Dua / Motor', 24, 1),
(3, ' Nelidawati', 'Jl. Lumbalumba', 'Yamaha Fino Premium', 'Kendaraan Roda Dua / Motor', 24, 1),
(7, 'Sri Wahyuni', 'Sei Beremas', 'Honda Vario 160', 'Kendaraan Roda Dua / Motor', 24, 1),
(8, 'Deno Pandu', 'Jl. Berok Rakik', 'Toyota Kijang Innova', 'Kendaraan Roda Empat / Mobil', 60, 1),
(9, 'Syamsuarina', 'Jl. Indarung', 'Honda Beat Sporty', 'Kendaraan Roda Dua / Motor', 24, 1),
(10, 'Nadia Rozaq', 'Simpang Ampek Air Pacah', 'Honda Beat', 'Kendaraan Roda Dua / Motor', 12, 1),
(11, 'Farrel Arya', 'Perum Wisma Indah Lestari', 'Yamaha N-Max', 'Kendaraan Roda Dua / Motor', 24, 1),
(12, 'Putree Wulan', 'Jl. Manunggal Sako', 'Honda Beat Sporty', 'Kendaraan Roda Dua / Motor', 24, 1),
(13, 'Rahmadina', 'Parak Laweh', 'Yamaha Aerox 155', 'Kendaraan Roda Dua / Motor', 24, 1),
(14, 'Yetti Jonni', 'Perum Padang Sarai Permai', 'Honda Genio CBS', 'Kendaraan Roda Dua / Motor', 24, 1),
(15, 'Rustiamnur', 'Jl. Salak 2', 'Honda PCX 160', 'Kendaraan Roda Dua / Motor', 18, 1),
(16, 'Deli Sofrizon', 'Kampung Tangah', 'Honda Beat Street', 'Kendaraan Roda Dua / Motor', 24, 1),
(17, 'Bun Heng', 'Komp. Prima Lestari', 'Toyota Agya', 'Kendaraan Roda Empat / Mobil', 36, 1),
(18, 'Adelina', 'Perumahan Korem', 'Yamaha Fino Premium', 'Kendaraan Roda Dua / Motor', 18, 1);

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
(3, 1, 1, 0.8),
(4, 2, 1, 0.5125),
(5, 3, 1, 0.5),
(6, 7, 1, 0.8),
(7, 8, 1, 0.65),
(8, 9, 1, 0.2875),
(9, 10, 1, 0.75),
(10, 11, 1, 0.7125),
(11, 12, 1, 0.3625),
(12, 13, 1, 0.4125),
(13, 14, 1, 0.8),
(14, 15, 1, 0.6),
(15, 16, 1, 0.65),
(16, 17, 1, 0.9875),
(17, 18, 1, 0.425);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `jenis_kriteria` varchar(10) NOT NULL,
  `bobot` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(11, 1, 2, 1),
(12, 1, 6, 1),
(13, 1, 10, 1),
(14, 1, 13, 1),
(15, 1, 17, 1),
(16, 2, 3, 1),
(17, 2, 8, 1),
(18, 2, 11, 1),
(19, 2, 14, 1),
(20, 2, 17, 1),
(21, 3, 4, 1),
(22, 3, 7, 1),
(23, 3, 11, 1),
(24, 3, 13, 1),
(25, 3, 17, 1),
(26, 7, 1, 1),
(27, 7, 7, 1),
(28, 7, 11, 1),
(29, 7, 13, 1),
(30, 7, 17, 1),
(31, 8, 3, 1),
(32, 8, 6, 1),
(33, 8, 10, 1),
(34, 8, 14, 1),
(35, 8, 18, 1),
(36, 9, 4, 1),
(37, 9, 8, 1),
(38, 9, 12, 1),
(39, 9, 16, 1),
(40, 9, 17, 1),
(41, 10, 1, 1),
(42, 10, 7, 1),
(43, 10, 11, 1),
(44, 10, 14, 1),
(45, 10, 18, 1),
(46, 11, 2, 1),
(47, 11, 7, 1),
(48, 11, 10, 1),
(49, 11, 14, 1),
(50, 11, 17, 1),
(51, 12, 4, 1),
(52, 12, 8, 1),
(53, 12, 12, 1),
(54, 12, 14, 1),
(55, 12, 17, 1),
(56, 13, 4, 1),
(57, 13, 8, 1),
(58, 13, 11, 1),
(59, 13, 14, 1),
(60, 13, 17, 1),
(61, 14, 1, 1),
(62, 14, 7, 1),
(63, 14, 11, 1),
(64, 14, 13, 1),
(65, 14, 17, 1),
(66, 15, 4, 1),
(67, 15, 6, 1),
(68, 15, 10, 1),
(69, 15, 13, 1),
(70, 15, 17, 1),
(71, 16, 3, 1),
(72, 16, 7, 1),
(73, 16, 10, 1),
(74, 16, 13, 1),
(75, 16, 17, 1),
(76, 17, 1, 1),
(77, 17, 5, 1),
(78, 17, 9, 1),
(79, 17, 13, 1),
(80, 17, 18, 1),
(81, 18, 4, 1),
(82, 18, 7, 1),
(83, 18, 11, 1),
(84, 18, 15, 1),
(85, 18, 17, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_periode`
--

CREATE TABLE `tbl_periode` (
  `id_periode` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
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
  `ket` varchar(100) NOT NULL,
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
(9, 3, '> Rp. 5.000.000 ', 1.00),
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
  `id` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(15) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `level`, `nama_lengkap`) VALUES
(1, 'Admin', 'admin', 'Admin', 'MRON'),
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
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_penilaian`
--
ALTER TABLE `tbl_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
