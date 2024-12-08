-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 08:17 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

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
  `id_blok` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`id_alternatif`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `jenis_kejahatan`, `tanggal_mulai_ditahan`, `id_blok`, `id_periode`) VALUES
('A.1', 'kevin', '2014-02-14', 'Laki-Laki', 'Kesusilaan', '2024-11-12', 1, 19),
('B.I-124/2022', 'Adek Irwan', '1983-11-09', 'Laki-Laki', 'Narkotika', '2021-05-29', 1, 12),
('B.I-124/2024', 'Fauzan', '2012-06-05', 'Laki-Laki', 'Kekerasan dalam Rumah Tangga', '2024-11-05', 1, 12),
('B.I-146/2022', 'Beni Afrianto', '1993-11-03', 'Laki-Laki', 'Narkotika', '2021-09-09', 1, 12),
('B.I-146/2023', 'Andri Arjuna', '1986-01-18', 'Laki-Laki', 'Pencurian', '2022-08-19', 1, 12),
('B.I-152/2021', 'Ryan Hidayatullah', '1987-10-31', 'Laki-Laki', 'Pencurian', '2020-06-03', 1, 12),
('B.I-159/2023', 'Agus Nopriadi Siritoitet', '1986-10-19', 'Laki-Laki', 'Perlindungan Anak', '2022-07-30', 1, 12),
('B.I-196/2023', 'Aditya Nurhidayat', '1991-07-20', 'Laki-Laki', 'Perlindungan Anak', '2022-08-02', 1, 12),
('B.I-203/2022', 'Diky Wahyudi', '1988-09-01', 'Laki-Laki', 'Perampokan', '2022-10-22', 1, 12),
('B.I-372/2022', 'Sepdi Herman', '1998-06-19', 'Laki-Laki', 'Perlindungan Anak', '2022-11-11', 1, 12),
('B.I-764/2022', 'Dodi Linastra', '2002-02-28', 'Laki-Laki', 'Narkotika', '2022-05-31', 1, 12),
('B.I-82/2023', 'Raplis', '1983-07-09', 'Laki-Laki', 'Penggelapan', '2022-08-03', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blok`
--

CREATE TABLE `tbl_blok` (
  `id` int(11) NOT NULL,
  `blok` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hasil`
--

INSERT INTO `tbl_hasil` (`id_hasil`, `id_alternatif`, `id_periode`, `hasil`, `persetujuan`) VALUES
(17, 'B.I-124/2022', 12, 0.5, '1'),
(18, 'B.I-146/2022', 12, 0.5, '1'),
(19, 'B.I-146/2023', 12, 0.5, '1'),
(20, 'B.I-152/2021', 12, 0.5, '1'),
(21, 'B.I-159/2023', 12, 0.5, '0'),
(22, 'B.I-196/2023', 12, 0.5, '1'),
(23, 'B.I-203/2022', 12, 0.5, '0'),
(24, 'B.I-372/2022', 12, 0.5, '0'),
(25, 'B.I-764/2022', 12, 0.5, '1'),
(26, 'B.I-82/2023', 12, 0.5, '0'),
(39, 'B.I-124/2024', 12, 0.5, '0'),
(40, 'A.1', 19, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `jenis_kriteria` varchar(255) NOT NULL,
  `bobot` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `nama_kriteria`, `jenis_kriteria`, `bobot`) VALUES
(19, 'sudah menjalani hukuman selama 6 bulan', 'Benefit', 0.30),
(20, 'berkelakuan baik', 'Benefit', 0.50),
(21, 'sudah membayar denda', 'Benefit', 0.20),
(22, 'p', 'Benefit', 0.50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penilaian`
--

CREATE TABLE `tbl_penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_alternatif` varchar(15) NOT NULL,
  `id_subkriteria` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_penilaian`
--

INSERT INTO `tbl_penilaian` (`id_penilaian`, `id_alternatif`, `id_subkriteria`, `id_periode`) VALUES
(96, 'B.I-196/2023', 27, 12),
(97, 'B.I-196/2023', 31, 12),
(98, 'B.I-196/2023', 36, 12),
(99, 'B.I-196/2023', 40, 12),
(100, 'B.I-196/2023', 43, 12),
(101, 'B.I-146/2023', 27, 12),
(102, 'B.I-146/2023', 32, 12),
(103, 'B.I-146/2023', 36, 12),
(104, 'B.I-146/2023', 39, 12),
(105, 'B.I-146/2023', 43, 12),
(106, 'B.I-146/2022', 28, 12),
(107, 'B.I-146/2022', 32, 12),
(108, 'B.I-146/2022', 36, 12),
(109, 'B.I-146/2022', 39, 12),
(110, 'B.I-146/2022', 44, 12),
(111, 'B.I-764/2022', 28, 12),
(112, 'B.I-764/2022', 32, 12),
(113, 'B.I-764/2022', 36, 12),
(114, 'B.I-764/2022', 40, 12),
(115, 'B.I-764/2022', 42, 12),
(116, 'B.I-82/2023', 28, 12),
(117, 'B.I-82/2023', 31, 12),
(118, 'B.I-82/2023', 36, 12),
(119, 'B.I-82/2023', 40, 12),
(120, 'B.I-82/2023', 43, 12),
(121, 'B.I-124/2022', 26, 12),
(122, 'B.I-124/2022', 30, 12),
(123, 'B.I-124/2022', 34, 12),
(124, 'B.I-124/2022', 39, 12),
(125, 'B.I-124/2022', 42, 12),
(126, 'B.I-152/2021', 26, 12),
(127, 'B.I-152/2021', 31, 12),
(128, 'B.I-152/2021', 33, 12),
(129, 'B.I-152/2021', 38, 12),
(130, 'B.I-152/2021', 42, 12),
(131, 'B.I-159/2023', 27, 12),
(132, 'B.I-159/2023', 30, 12),
(133, 'B.I-159/2023', 33, 12),
(134, 'B.I-159/2023', 38, 12),
(135, 'B.I-159/2023', 43, 12),
(136, 'B.I-203/2022', 26, 12),
(137, 'B.I-203/2022', 30, 12),
(138, 'B.I-203/2022', 33, 12),
(139, 'B.I-203/2022', 38, 12),
(140, 'B.I-203/2022', 42, 12),
(141, 'B.I-372/2022', 26, 12),
(142, 'B.I-372/2022', 30, 12),
(143, 'B.I-372/2022', 33, 12),
(144, 'B.I-372/2022', 38, 12),
(145, 'B.I-372/2022', 43, 12),
(201, 'B.I-124/2024', 28, 12),
(202, 'B.I-124/2024', 32, 12),
(203, 'B.I-124/2024', 36, 12),
(204, 'B.I-124/2024', 40, 12),
(205, 'B.I-124/2024', 44, 12),
(206, 'A.1', 28, 19),
(207, 'A.1', 31, 19),
(208, 'A.1', 36, 19),
(209, 'A.1', 40, 19),
(210, 'A.1', 44, 19);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periode`
--

CREATE TABLE `tbl_periode` (
  `id_periode` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subkriteria`
--

INSERT INTO `tbl_subkriteria` (`id_subkriteria`, `id_kriteria`, `ket`, `nbobot`) VALUES
(45, 19, 'sudah', 1.00),
(46, 19, 'belum', 0.00),
(47, 19, 'ff', 0.50),
(48, 21, 'sudahh', 1.00);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_penilaian`
--
ALTER TABLE `tbl_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `tbl_periode`
--
ALTER TABLE `tbl_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
