-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2021 at 06:35 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_buku`
--

CREATE TABLE `list_buku` (
  `id_buku` bigint(20) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `tahun_terbit` int(4) NOT NULL,
  `penulis_buku` varchar(255) NOT NULL,
  `penerbit_buku` varchar(255) NOT NULL,
  `link_poster` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_buku`
--

INSERT INTO `list_buku` (`id_buku`, `judul_buku`, `tahun_terbit`, `penulis_buku`, `penerbit_buku`, `link_poster`) VALUES
(2, 'Gyate Gyate', 2020, 'Zen Kyara', 'ZeroRespect', 'assets/poster/cb5231121c6a9ffef23894e92b35e1e2.png'),
(5, 'Menaricc Roll', 2019, 'Alert', 'Maki Ligon', 'assets/poster/97a0c7ce4572c22f7e48ecefeab7d69a.png'),
(6, 'Food and Musik', 2017, 'Elegant Sister', 'Sakuzyo', 'assets/poster/78f637e9c5e924f23d103931df8126f7.png'),
(7, 'Alert - Blue Archive', 2021, 'KARUT', 'Maki Ligon', 'assets/poster/a893170fefb73096dfe2e1b806572fbd.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `password`) VALUES
(3, '20a4c7d7bd12a1437f86357edde840fcff61e5f81897ac92f56d01db9ccfeb24493beb0e66e2e4e8e25684f7d3c02002f85f2fa23ad4fbac5ad42fb9ba904d9e'),
(4, 'cd1839476f44a1b93c5d442b671a99bbdd55dcd829c319a479460a5c58925f3cf7d4fa080c65b92de4375687b9616f78e28b431deb820bda2e3c76805fabe264');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_buku`
--
ALTER TABLE `list_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_buku`
--
ALTER TABLE `list_buku`
  MODIFY `id_buku` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
