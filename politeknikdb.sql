-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 07:04 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `politeknikdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `angkatan` int(4) NOT NULL,
  `semester` int(2) NOT NULL,
  `ipk` double NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `angkatan`, `semester`, `ipk`, `email`, `telepon`) VALUES
('43321201', 'Afif Ramzy', 2021, 4, 3.7, 'afiframzy@gmail.com', '0899812910023'),
('43321202', 'Aji Dwi Prakoso', 2021, 4, 4, 'ajidwiprakoso@gmail.com', '081233123412'),
('43321203', 'Ashabul Kahfi', 2021, 4, 4, 'ashabulkahfi@gmail.com', '08128812379'),
('43321204', 'Bina Satria Fauzi', 2021, 4, 3.97, 'binasatriafauzi@gmail.com', '0812737182182'),
('43321205', 'Bukhary Azrillorezqa Yufar', 2021, 4, 3.8, 'asrilsogsaa@gmail.com', '0899120301212'),
('43321206', 'Eka Yulianto', 2021, 4, 3.98, 'ekayulianto@gmail.com', '0812737182182');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
