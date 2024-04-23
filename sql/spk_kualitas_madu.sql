-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 04:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_kualitas_madu`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `kode`, `nama`) VALUES
(1, 'A1', 'Air Mata Pengantin'),
(2, 'A2', 'Pagoda'),
(3, 'A3', 'Jantung Pisang'),
(4, 'A4', 'Bunga Kelapa'),
(5, 'A5', 'Bunga Srikaya'),
(6, 'A6', 'Asoka');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bobot` float(11,2) NOT NULL,
  `jenis` enum('benefit','cost') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode`, `nama`, `bobot`, `jenis`) VALUES
(1, 'C1', 'Rasa', 30.00, 'benefit'),
(2, 'C2', 'Warna', 15.00, 'benefit'),
(3, 'C3', 'Kejernihan', 15.00, 'benefit'),
(4, 'C4', 'Aroma', 10.00, 'benefit'),
(5, 'C5', 'Kekentalan', 10.00, 'benefit'),
(6, 'C6', 'Kadar Air', 20.00, 'cost');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_alternatif`
--

CREATE TABLE `nilai_alternatif` (
  `id` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_subkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_alternatif`
--

INSERT INTO `nilai_alternatif` (`id`, `id_alternatif`, `id_kriteria`, `id_subkriteria`) VALUES
(69, 1, 1, 36),
(70, 1, 2, 41),
(71, 1, 3, 44),
(72, 1, 4, 46),
(73, 1, 5, 48),
(74, 1, 6, 53),
(75, 2, 1, 37),
(76, 2, 2, 39),
(77, 2, 3, 42),
(78, 2, 4, 45),
(79, 2, 5, 49),
(80, 2, 6, 52),
(81, 3, 1, 38),
(82, 3, 2, 40),
(83, 3, 3, 43),
(84, 3, 4, 47),
(85, 3, 5, 50),
(86, 3, 6, 51),
(87, 4, 1, 38),
(88, 4, 2, 41),
(89, 4, 3, 44),
(90, 4, 4, 46),
(91, 4, 5, 49),
(92, 4, 6, 52),
(93, 5, 1, 36),
(94, 5, 2, 41),
(95, 5, 3, 44),
(96, 5, 4, 46),
(97, 5, 5, 48),
(98, 5, 6, 52),
(99, 6, 1, 38),
(100, 6, 2, 39),
(101, 6, 3, 42),
(102, 6, 4, 45),
(103, 6, 5, 48),
(104, 6, 6, 53);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `skala_nilai` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id`, `id_kriteria`, `nama`, `skala_nilai`) VALUES
(36, 1, 'Kecut Asam', 3.00),
(37, 1, 'Pahit Asam', 4.00),
(38, 1, 'Manis Asam', 5.00),
(39, 2, 'Hitam', 3.00),
(40, 2, 'Kuning Kecoklatan', 4.00),
(41, 2, 'Kuning Jernih', 5.00),
(42, 3, 'Kurang Jernih', 3.00),
(43, 3, 'Jernih', 4.00),
(44, 3, 'Sangat Jernih', 5.00),
(45, 4, 'Kurang Wangi', 3.00),
(46, 4, 'Wangi', 4.00),
(47, 4, 'Sangat Wangi', 5.00),
(48, 5, 'Cukup Kental', 3.00),
(49, 5, 'Kental', 4.00),
(50, 5, 'Cair', 5.00),
(51, 6, '> 25%', 3.00),
(52, 6, '25%', 4.00),
(53, 6, '< 25%', 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_admin` int(10) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_admin`, `nama_admin`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'admin1', 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nilai_alternatif` (`id_alternatif`),
  ADD KEY `fk_nilai_kriteria` (`id_kriteria`),
  ADD KEY `fk_nilai_subkriteria` (`id_subkriteria`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kriteria_subkriteria` (`id_kriteria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD CONSTRAINT `fk_nilai_alternatif` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_nilai_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_nilai_subkriteria` FOREIGN KEY (`id_subkriteria`) REFERENCES `subkriteria` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `fk_kriteria_subkriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
