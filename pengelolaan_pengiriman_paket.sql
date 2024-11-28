-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 11:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengelolaan_pengiriman_paket`
--
CREATE DATABASE IF NOT EXISTS `pengelolaan_pengiriman_paket` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pengelolaan_pengiriman_paket`;

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_kurir` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL DEFAULT '0',
  `area_pengiriman` varchar(100) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `user_id`, `nama_kurir`, `no_hp`, `area_pengiriman`, `status`) VALUES
(5, 10, 'John', '0881178745', 'Cimuning', 'Aktif'),
(6, 12, 'Albert', '08125458923', 'Tambun Selatan', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `id_pengirim` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `id_kurir` int(11) NOT NULL,
  `status` enum('Pending','Diambil','Dalam Pengiriman','Terkirim','Gagal') NOT NULL,
  `tanggal_pengiriman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `id_pengirim`, `id_penerima`, `id_kurir`, `status`, `tanggal_pengiriman`) VALUES
(18, 11, 12, 5, 'Terkirim', '2024-11-29'),
(19, 12, 11, 5, 'Diambil', '2024-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `user_id`, `nama_pelanggan`, `alamat`, `email`, `no_hp`) VALUES
(11, 20, 'Achmad Fahry Baihaki', 'Jl. Joyo Raharjo Gg. 5', 'fahrybaihaki0105@gmail.com', '088159840241'),
(12, 21, 'Johar Arifin', 'Jl. Bandung 105', 'johararf01@gmail.com', '082193425348');

-- --------------------------------------------------------

--
-- Table structure for table `status_pengiriman`
--

CREATE TABLE `status_pengiriman` (
  `id_status` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `status` enum('Pending','Diambil','Dalam Pengiriman','Terkirim','Gagal') NOT NULL,
  `waktu_status` datetime NOT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_pengiriman`
--

INSERT INTO `status_pengiriman` (`id_status`, `id_paket`, `status`, `waktu_status`, `catatan`) VALUES
(41, 18, 'Pending', '2024-11-28 17:40:51', 'Paket baru dibuat dan menunggu proses pengambilan oleh kurir'),
(42, 18, 'Diambil', '2024-11-28 18:56:29', 'Paket baru diambil oleh John dan akan dikirimkan ke lokasi tujuan'),
(43, 18, 'Terkirim', '2024-11-28 18:57:30', 'Paket telah sampai ke lokasi tujuan'),
(44, 19, 'Pending', '2024-11-28 19:49:32', 'Paket baru dibuat dan menunggu proses pengambilan oleh kurir'),
(45, 19, 'Diambil', '2024-11-28 19:50:21', 'Paket baru diambil oleh John dan akan dikirimkan ke lokasi tujuan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','kurir','pelanggan') NOT NULL DEFAULT 'pelanggan',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(10, 'John', 'kurir.john@gmail.com', 'kurir', NULL, '$2y$12$nCZ5eVeKjhNHtTi9IOXG0OSoler7yoOJ0JngSDPcQOCZ4mOFhX90W', NULL, '2024-11-27 12:39:51', '2024-11-27 12:39:51'),
(12, 'Albert', 'kurir.albert@gmail.com', 'kurir', NULL, '$2y$12$rlz/fRUuQJmxVo/8RgNSEOuWVFhcgGZyDSi0/Wkn7aFb2/1wj2iOO', NULL, '2024-11-27 13:07:22', '2024-11-27 13:07:22'),
(19, 'Admin', 'admin@example.com', 'admin', NULL, '$2y$12$Xufv21skWqJU8YgT8J8L/uzLkAijL.hIOmYlRxB/4tq9POPNYVTG6', NULL, '2024-11-28 08:05:03', '2024-11-28 08:05:03'),
(20, 'Achmad Fahry Baihaki', 'fahrybaihaki0105@gmail.com', 'pelanggan', NULL, '$2y$12$GMTveYFonnNDLDZ/oK0qMePzkpWL4ZWQPWJ2ra0rxUXjHcDhB0eX2', NULL, '2024-11-28 08:19:22', '2024-11-28 08:19:22'),
(21, 'Johar Arifin', 'johararf01@gmail.com', 'pelanggan', NULL, '$2y$12$tSrASqE.ATnnvo6xRRA3uOhLntYNwNwSmuyCkTNv4uxD8mroVC2s.', NULL, '2024-11-28 08:21:30', '2024-11-28 08:21:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`),
  ADD KEY `kurir_user_id_foreign` (`user_id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `id_pengirim` (`id_pengirim`),
  ADD KEY `id_penerima` (`id_penerima`),
  ADD KEY `id_kurir` (`id_kurir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `pelanggan_user_id_foreign` (`user_id`);

--
-- Indexes for table `status_pengiriman`
--
ALTER TABLE `status_pengiriman`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `status_pengiriman`
--
ALTER TABLE `status_pengiriman`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kurir`
--
ALTER TABLE `kurir`
  ADD CONSTRAINT `kurir_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `paket_ibfk_1` FOREIGN KEY (`id_pengirim`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE,
  ADD CONSTRAINT `paket_ibfk_2` FOREIGN KEY (`id_penerima`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE,
  ADD CONSTRAINT `paket_ibfk_3` FOREIGN KEY (`id_kurir`) REFERENCES `kurir` (`id_kurir`) ON DELETE CASCADE;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `status_pengiriman`
--
ALTER TABLE `status_pengiriman`
  ADD CONSTRAINT `status_pengiriman_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
