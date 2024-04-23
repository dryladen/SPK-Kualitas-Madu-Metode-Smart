-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2022 at 03:18 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_pegawai_tetap`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'admin1', 'admin1', 'e00cf25ad42683b3df678c61f42c6bda'),
(3, 'admin2', 'admin2', 'c84258e9c39059a89ab77d846ddab909'),
(4, 'guntur', 'guntur', 'ef803eebfaaaee381a84a353e05cae91');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(10) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `kehadiran` int(10) NOT NULL,
  `kualitas_kerja` int(10) NOT NULL,
  `disiplin` int(10) NOT NULL,
  `kerjasama` int(10) NOT NULL,
  `pengembangan_pribadi` int(10) NOT NULL,
  `nilai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `kehadiran`, `kualitas_kerja`, `disiplin`, `kerjasama`, `pengembangan_pribadi`, `nilai`) VALUES
(1, 'Achmad Mirza', 86, 81, 84, 81, 75, 0),
(2, 'Agung Dwi Wicaksono', 87, 82, 83, 80, 77, 0),
(3, 'Agusnawati', 84, 85, 81, 81, 90, 0),
(4, 'Alfian Nur', 90, 80, 79, 78, 82, 0),
(5, 'Andi Nina Maharani', 88, 83, 87, 86, 79, 0),
(6, 'Fitri Cayanti', 90, 92, 90, 86, 55, 0),
(7, 'Hamartini Nurilhairani', 90, 82, 77, 88, 56, 0),
(8, 'Hendra', 89, 85, 80, 90, 53, 0),
(9, 'Irawansyah', 87, 82, 81, 83, 81, 0),
(10, 'Jumiati', 90, 80, 83, 85, 60, 0),
(11, 'Manto Yesman Reinaldy Sitompul', 87, 84, 82, 80, 75, 0),
(12, 'Muhammad Rahmani', 83, 74, 79, 80, 84, 0),
(13, 'Muhammad Rivai Tenarubun', 85, 79, 88, 90, 57, 0),
(14, 'Ragil Ananda Nugraha', 86, 75, 85, 88, 69, 0),
(15, 'Rahmat Aji Juliardi', 86, 81, 83, 84, 85, 0),
(16, 'Ramazan', 88, 87, 88, 87, 83, 0),
(17, 'Rendra Andika Putra', 86, 84, 84, 77, 70, 0),
(18, 'Rumastyo', 89, 85, 87, 89, 80, 0),
(19, 'Veliks Kia Vester', 85, 90, 87, 92, 56, 0),
(20, 'Viktorio Asael Henpratama', 89, 87, 88, 86, 78, 0),
(21, 'Yosef Risal Gleko', 85, 85, 87, 91, 80, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
