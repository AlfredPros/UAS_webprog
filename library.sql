-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 02:02 PM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_book`
--

CREATE TABLE `list_book` (
  `id_book` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` int(4) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `link_poster` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_book`
--

INSERT INTO `list_book` (`id_book`, `title`, `year`, `author`, `publisher`, `link_poster`, `description`) VALUES
(2, 'Gyate Gyate', 2020, 'Zen Kyara', 'ZeroRespect', 'assets/poster/cb5231121c6a9ffef23894e92b35e1e2.png', ''),
(5, 'Menaricc Roll', 2019, 'Alert', 'Maki Ligon', 'assets/poster/97a0c7ce4572c22f7e48ecefeab7d69a.png', ''),
(6, 'Food and Musik', 2017, 'Elegant Sister', 'Sakuzyo', 'assets/poster/78f637e9c5e924f23d103931df8126f7.png', ''),
(7, 'Alert - Blue Archive', 2021, 'KARUT', 'Maki Ligon', 'assets/poster/a893170fefb73096dfe2e1b806572fbd.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id_request` int(11) NOT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `id_book` bigint(20) DEFAULT NULL,
  `request_date` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'User',
  `link_profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `name`, `role`, `link_profile`) VALUES
(3, 'admin@admin.com', '20a4c7d7bd12a1437f86357edde840fcff61e5f81897ac92f56d01db9ccfeb24493beb0e66e2e4e8e25684f7d3c02002f85f2fa23ad4fbac5ad42fb9ba904d9e', 'Kak Daniel', 'Admin', 'assets\\pp\\gambar6.png'),
(4, 'user@user.com', 'cd1839476f44a1b93c5d442b671a99bbdd55dcd829c319a479460a5c58925f3cf7d4fa080c65b92de4375687b9616f78e28b431deb820bda2e3c76805fabe264', 'Adhitya Bagus Wicaksono', 'Manager', 'assets\\pp\\test.gif'),
(5, 'ikan@goreng.com', 'b14361404c078ffd549c03db443c3fede2f3e534d73f78f77301ed97d4a436a9fd9db05ee8b325c0ad36438b43fec8510c204fc1c1edb21d0941c00e9e2c1ce2', 'Ikan Goreng', 'User', 'assets/pp/82740629cf78c341579eae7631f70114.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_book`
--
ALTER TABLE `list_book`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_book`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_book`
--
ALTER TABLE `list_book`
  MODIFY `id_book` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `list_book` (`id_book`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
