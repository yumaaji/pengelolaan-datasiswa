-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 11:59 AM
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
-- Database: `smart_kita`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id` int(11) NOT NULL,
  `nisn_siswa` varchar(10) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `kelas_siswa` varchar(100) NOT NULL,
  `agama_siswa` varchar(100) NOT NULL,
  `telepon_siswa` varchar(14) NOT NULL,
  `foto_siswa` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_siswa`
--

INSERT INTO `data_siswa` (`id`, `nisn_siswa`, `nama_siswa`, `kelas_siswa`, `agama_siswa`, `telepon_siswa`, `foto_siswa`, `password`, `created_at`) VALUES
(1, '0062902902', 'FATIMAH AZZAHRA', 'XI IPA 1', 'ISLAM', '089756449000', '65d878c9db76f.jpg', '', '2024-02-23 17:51:53'),
(2, '0067867867', 'ZIDAN ADE RIFAI', 'X IPS 4', 'BUDHA', '089655342201', '65d8790d1da48.jpg', '', '2024-02-23 17:53:01'),
(3, '0063123123', 'KAILANDRI NURHALIMAH', 'XII IPA 3', 'ISLAM', '089647447645', '65d87945bfb2e.jpg', '', '2024-02-23 17:53:57'),
(4, '0069829829', 'MICHELLE ELFIRGI', 'XII IPS 1', 'KRISTEN', '089556353353', '65d8799b161c3.jpg', '', '2024-02-23 17:55:23'),
(6, '0063493493', 'KEVIN PUTRA AIRLANGGA', 'XI IPA 6', 'KATOLIK', '087963455543', '65d879ed78b79.jpg', '', '2024-02-23 17:56:45'),
(7, '0068128128', 'DELLA PUTRI', 'XII IPA 7', 'BUDHA', '089665353339', '65d87a6f37b30.jpg', '', '2024-02-23 17:58:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nisn_siswa` (`nisn_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
