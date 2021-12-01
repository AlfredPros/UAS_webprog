-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2021 at 05:33 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

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

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `day_taken` (`id` INT, `start_date` DATE, `end_date` DATE) RETURNS TINYINT(1) BEGIN
    DECLARE finished INTEGER DEFAULT 0;
    declare temp1 DATE;
    declare temp2 date;
    declare ans BOOLEAN;


DEClARE curReq 
CURSOR FOR 
SELECT start_time, end_time FROM request WHERE status = 1 AND id_book = id;


DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET finished = 1;
    
    SET ans = false;

    OPEN curReq;
         check_day: LOOP
            FETCH curReq INTO temp1, temp2;
            IF finished = 1 THEN 
                LEAVE check_day;
            END IF;
            if (start_date >= temp1 AND start_date <= temp2) OR (end_date >= temp1 AND end_date <= temp2) then
              SET ans = true;
              LEAVE check_day;
            end if;
            SET temp1 = '';
            SET temp2 = '';
    END LOOP check_day;
    CLOSE curReq;

    RETURN ans;
END$$

DELIMITER ;

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
  `link_cover` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_book`
--

INSERT INTO `list_book` (`id_book`, `title`, `year`, `author`, `publisher`, `link_cover`, `description`) VALUES
(2, 'Gyate Gyate Vol 2', 2020, 'Zen Kyara', 'ZeroRespect', 'assets/cover/2f510cf8dff66aada74df4a153840907.gif', 'Bootstrap includes several predefined button styles, each serving its own\r\nsemantic purpose, with a few extras thrown in for more control.\r\nUsing color to add meaning only provides a visual indication, which will\r\nnot be conveyed to users of assistive technologies – such as screen readers. \r\nEnsure that information denoted by the color is either obvious from the \r\ncontent itself (e.g. the visible text), or is included through alternative\r\nmeans, such as additional text hidden with the .sr-only class.'),
(5, 'Menaricc Roll', 2019, 'Alert', 'Maki Ligon', 'assets/cover/97a0c7ce4572c22f7e48ecefeab7d69a.png', 'Online download videos from YouTube for FREE to PC, mobile. Supports downloading all formats: MP4, 3GP, WebM, HD videos, convert YouTube to MP3, M4A.'),
(6, 'Food and Musik', 2017, 'Elegant Sister', 'Sakuzyo', 'assets/cover/78f637e9c5e924f23d103931df8126f7.png', 'Windows Movie Maker. Windows Movie Maker is a great video editing tool and has been a part of the Windows system for many years. ...\r\niMovie. As the equivalent of Windows Movie Make for Mac OS X, iMovie gives you the chance to turn any movie into a major production. ...\r\nAvidemux. ...\r\nLightworks. ...\r\nVSDC Free Video Editor.'),
(7, 'Alert - Blue Archive', 2021, 'KARUT', 'Maki Ligon', 'assets/cover/a893170fefb73096dfe2e1b806572fbd.png', 'Bluehost – best overall PHP hosting provider.\r\nHostGator – best for uptime.\r\nInMotion – best for secure PHP hosting.\r\nA2 Hosting – best for PHP hosting support.\r\nSiteGround – best for PHP features.\r\nHostinger – best for affordability.\r\niPage – best for PHP updates.'),
(9, 'No Game NO LIFE', 2018, 'Madhouse', 'Yū Kamiya', 'assets/cover/400b0c34de768dbe4d0e0775bafbfa16.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor totam laborum esse voluptatibus rerum suscipit, perferendis quod temporibus et error inventore, exercitationem maiores unde, enim sed veritatis nulla dignissimos culpa! Corporis placeat mollitia nisi dolorem porro odit voluptatem deserunt enim adipisci laborum et accusantium iste a tempora, aliquam molestiae. Aut architecto voluptate fuga fugit ullam magni, optio aperiam magnam excepturi.');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id_request` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_book` bigint(20) NOT NULL,
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `status` char(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id_request`, `id_user`, `id_book`, `start_time`, `end_time`, `status`) VALUES
(2, 6, 7, '2021-11-02', '2021-11-07', '1'),
(3, 6, 9, '2021-12-01', '2021-12-03', '1'),
(4, 6, 2, '2021-12-04', '2021-12-07', '2'),
(7, 6, 5, '2021-12-01', '2021-12-04', '2'),
(9, 6, 7, '2021-11-02', '2021-11-07', '2'),
(10, 6, 7, '2021-11-02', '2021-11-07', '2'),
(11, 6, 7, '2021-11-08', '2021-11-14', '2'),
(12, 6, 7, '2021-11-08', '2021-11-14', '2'),
(13, 6, 7, '2021-11-09', '2021-11-12', '2'),
(14, 6, 7, '2021-11-08', '2021-11-12', '2');

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
(4, 'user@user.com', 'cd1839476f44a1b93c5d442b671a99bbdd55dcd829c319a479460a5c58925f3cf7d4fa080c65b92de4375687b9616f78e28b431deb820bda2e3c76805fabe264', 'Adhitya Bagus Wicaksono 2', 'User', 'assets/pp/e920427c06fdae2746ffb7869c598126.gif'),
(6, 'ikan@goreng.com', 'b14361404c078ffd549c03db443c3fede2f3e534d73f78f77301ed97d4a436a9fd9db05ee8b325c0ad36438b43fec8510c204fc1c1edb21d0941c00e9e2c1ce2', 'Ikan Goreng', 'User', 'assets/pp/63f73a6dc3153eddf5a19fc2f172f3eb.png');

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
  MODIFY `id_book` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
