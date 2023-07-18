-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2023 at 08:28 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warung-reza`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(225) NOT NULL,
  `kategori_barang` varchar(255) NOT NULL,
  `harga_barang` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `id_barang`, `nama_barang`, `kategori_barang`, `harga_barang`) VALUES
(1, 1, 'Beras', 'Makanan', 20000),
(2, 2, 'Gula', 'Makanan', 15000),
(3, 3, 'Sabun', 'Kebersihan', 5000),
(4, 4, 'Shampoo', 'Kebersihan', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_barang`
--

CREATE TABLE `penerimaan_barang` (
  `id` int(11) NOT NULL,
  `id_penerimaan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang` int(50) NOT NULL,
  `tanggal_penerimaan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerimaan_barang`
--

INSERT INTO `penerimaan_barang` (`id`, `id_penerimaan`, `id_barang`, `jumlah_barang`, `tanggal_penerimaan`) VALUES
(1, 1, 1, 50, '2023-07-10'),
(2, 2, 2, 30, '2023-07-11'),
(3, 3, 3, 100, '2023-07-12'),
(0, 77, 3, 17, '2023-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang_terjual` int(50) NOT NULL,
  `tanggal_penjualan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_penjualan`, `id_barang`, `jumlah_barang_terjual`, `tanggal_penjualan`) VALUES
(1, 1, 1, 10, '2023-07-10'),
(2, 2, 1, 20, '2023-07-11'),
(3, 3, 2, 5, '2023-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`) VALUES
(1, 'reza12@gmail.com', 'reza123', 'reza321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  ADD PRIMARY KEY (`id_penerimaan`),
  ADD KEY `penerimaan_barang_ibfk_1` (`id_barang`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  ADD CONSTRAINT `penerimaan_barang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
