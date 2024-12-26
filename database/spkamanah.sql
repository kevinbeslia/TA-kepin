-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2024 at 01:21 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `id_alternatif` varchar(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `jenis_kejahatan` varchar(255) NOT NULL,
  `tanggal_mulai_ditahan` date NOT NULL,
  `lama_pidana` varchar(20) NOT NULL,
  `id_blok` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`id_alternatif`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `jenis_kejahatan`, `tanggal_mulai_ditahan`, `lama_pidana`, `id_blok`, `id_periode`) VALUES
('A.1', 'kevin', '2014-02-14', 'Laki-Laki', 'Kesusilaan', '2024-11-12', '1 tahun', 1, 19),
('A.2', 'Rapi', '2000-12-10', 'Laki-Laki', 'Kekerasan dalam Rumah Tangga', '2020-12-07', '1 tahun', 1, 19),
('B.I-124/2022', 'Adek Irwan', '1983-11-09', 'Laki-Laki', 'Narkotika', '2021-05-29', '2 bulan', 1, 12),
('B.I-124/2024', 'Fauzan', '2012-06-05', 'Laki-Laki', 'Kekerasan dalam Rumah Tangga', '2024-11-05', '1 tahun 5 bulan', 1, 12),
('B.I-146/2022', 'Beni Afrianto', '1993-11-03', 'Laki-Laki', 'Narkotika', '2021-09-09', '1 tahun', 1, 12),
('B.I-146/2023', 'Andri Arjuna', '1986-01-18', 'Laki-Laki', 'Pencurian', '2022-08-19', '1 tahun', 1, 12),
('B.I-152/2021', 'Ryan Hidayatullah', '1987-10-31', 'Laki-Laki', 'Pencurian', '2020-06-03', '1 tahun', 1, 12),
('B.I-159/2023', 'Agus Nopriadi Siritoitet', '1986-10-19', 'Laki-Laki', 'Perlindungan Anak', '2022-07-30', '1 tahun', 1, 12),
('B.I-196/2023', 'Aditya Nurhidayat', '1991-07-20', 'Laki-Laki', 'Perlindungan Anak', '2022-08-02', '1 tahun', 1, 12),
('B.I-203/2022', 'Diky Wahyudi', '1988-09-01', 'Laki-Laki', 'Perampokan', '2022-10-22', '1 tahun', 1, 12),
('B.I-372/2022', 'Sepdi Herman', '1998-06-19', 'Laki-Laki', 'Perlindungan Anak', '2022-11-11', '1 tahun', 1, 12),
('B.I-764/2022', 'Dodi Linastra', '2002-02-28', 'Laki-Laki', 'Narkotika', '2022-05-31', '2 tahun 3 bulan', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blok`
--

CREATE TABLE `tbl_blok` (
  `id` int(11) NOT NULL,
  `blok` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_blok`
--

INSERT INTO `tbl_blok` (`id`, `blok`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hasil`
--

CREATE TABLE `tbl_hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_alternatif` varchar(15) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `hasil` double NOT NULL,
  `persetujuan` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_hasil`
--

INSERT INTO `tbl_hasil` (`id_hasil`, `id_alternatif`, `id_periode`, `hasil`, `persetujuan`) VALUES
(44, 'A.1', 19, 0.2, '0'),
(45, 'A.2', 19, 1, '0'),
(46, 'B.I-124/2022', 12, 0.244741596, '0'),
(47, 'B.I-124/2024', 12, 1, '1'),
(48, 'B.I-146/2022', 12, 0.720614939, '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `jenis_kriteria` varchar(255) NOT NULL,
  `bobot` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `id_periode`, `nama_kriteria`, `jenis_kriteria`, `bobot`) VALUES
(21, 12, 'sudah membayar denda', 'Benefit', 0.05),
(22, 12, 'p', 'Benefit', 0.40),
(26, 12, 'a', 'Benefit', 0.30),
(27, 12, 'ww', 'Benefit', 0.15),
(29, 19, 'k19-1', 'Benefit', 0.30),
(30, 19, 'k19-2', 'Benefit', 0.05),
(31, 19, 'k19-3', 'Benefit', 0.05),
(32, 19, 'k19-4', 'Benefit', 0.30),
(33, 19, 'k19-5', 'Benefit', 0.30),
(34, 12, 'qq', 'Benefit', 0.10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penilaian`
--

CREATE TABLE `tbl_penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_alternatif` varchar(15) NOT NULL,
  `id_subkriteria` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_penilaian`
--

INSERT INTO `tbl_penilaian` (`id_penilaian`, `id_alternatif`, `id_subkriteria`, `id_periode`) VALUES
(224, 'A.1', 73, 19),
(225, 'A.1', 79, 19),
(226, 'A.1', 84, 19),
(227, 'A.1', 89, 19),
(228, 'A.1', 94, 19),
(229, 'A.2', 69, 19),
(230, 'A.2', 74, 19),
(231, 'A.2', 80, 19),
(232, 'A.2', 85, 19),
(233, 'A.2', 90, 19),
(234, 'B.I-124/2024', 48, 12),
(235, 'B.I-124/2024', 57, 12),
(236, 'B.I-124/2024', 61, 12),
(237, 'B.I-124/2024', 65, 12),
(238, 'B.I-124/2024', 95, 12),
(239, 'B.I-124/2022', 51, 12),
(240, 'B.I-124/2022', 60, 12),
(241, 'B.I-124/2022', 64, 12),
(242, 'B.I-124/2022', 68, 12),
(243, 'B.I-124/2022', 99, 12),
(244, 'B.I-146/2022', 50, 12),
(245, 'B.I-146/2022', 58, 12),
(246, 'B.I-146/2022', 62, 12),
(247, 'B.I-146/2022', 66, 12),
(248, 'B.I-146/2022', 97, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periode`
--

CREATE TABLE `tbl_periode` (
  `id_periode` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_periode`
--

INSERT INTO `tbl_periode` (`id_periode`, `keterangan`) VALUES
(12, 'Periode I (Januari - Juni) 2024'),
(19, 'Periode II (Juli-Desember) 2024'),
(20, 'Periode III');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subkriteria`
--

CREATE TABLE `tbl_subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `nbobot` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subkriteria`
--

INSERT INTO `tbl_subkriteria` (`id_subkriteria`, `id_kriteria`, `ket`, `nbobot`) VALUES
(48, 21, 'sudah', 1.00),
(49, 21, 'sedang', 0.75),
(50, 21, 'akan', 0.50),
(51, 21, 'belum', 0.25),
(57, 22, 'p1', 1.00),
(58, 22, 'p2', 0.75),
(59, 22, 'p3', 0.50),
(60, 22, 'p4', 0.25),
(61, 26, 'a1', 1.00),
(62, 26, 'a2', 0.75),
(63, 26, 'a3', 0.50),
(64, 26, 'a4', 0.25),
(65, 27, 'ww1', 1.00),
(66, 27, 'ww2', 0.75),
(67, 27, 'ww3', 0.50),
(68, 27, 'ww4', 0.25),
(69, 29, '1a', 1.00),
(70, 29, '1b', 0.80),
(71, 29, '1c', 0.60),
(72, 29, '1d', 0.40),
(73, 29, '1e', 0.20),
(74, 30, '2a', 1.00),
(75, 30, '2b', 0.80),
(77, 30, '2c', 0.60),
(78, 30, '2d', 0.40),
(79, 30, '2e', 0.20),
(80, 31, '3a', 1.00),
(81, 31, '3b', 0.80),
(82, 31, '3c', 0.60),
(83, 31, '3d', 0.40),
(84, 31, '3e', 0.20),
(85, 32, '4a', 1.00),
(86, 32, '4b', 0.80),
(87, 32, '4c', 0.60),
(88, 32, '4d', 0.40),
(89, 32, '4e', 0.20),
(90, 33, '5a', 1.00),
(91, 33, '5b', 0.80),
(92, 33, '5c', 0.60),
(93, 33, '5d', 0.40),
(94, 33, '5e', 0.20),
(95, 34, 'qq1', 1.00),
(96, 34, 'qq2', 0.80),
(97, 34, 'qq3', 0.60),
(98, 34, 'qq4', 0.40),
(99, 34, 'qq5', 0.20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `id_blok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `level`, `nama_lengkap`, `id_blok`) VALUES
(1, 'Admin', 'admin', 'Admin', 'M Kevin Beslia', NULL),
(2, 'Pimpinan', 'pimpinan', 'Pimpinan', 'Raul', NULL),
(3, 'Adminblok', 'adminblok', 'Admin Blok', 'Edderson', 1),
(30, 'RubenD', 'qwerty123', 'Admin Blok', 'Ruben Dias', 2),
(32, 'kevin', 'qwerty123', 'Admin Blok', 'kevin beslia', 3),
(33, 'RAUL', 'QWERTY123', 'Admin Blok', 'raul habibillah', 3),
(35, 'fauzan', 'fauzan123', 'Admin Blok', 'Ahmad fauzan', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `tbl_blok`
--
ALTER TABLE `tbl_blok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tbl_penilaian`
--
ALTER TABLE `tbl_penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `tbl_periode`
--
ALTER TABLE `tbl_periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_blok` (`id_blok`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_penilaian`
--
ALTER TABLE `tbl_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `tbl_periode`
--
ALTER TABLE `tbl_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`id_blok`) REFERENCES `tbl_blok` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
