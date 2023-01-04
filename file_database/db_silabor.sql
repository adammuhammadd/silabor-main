-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2023 at 11:39 AM
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
-- Database: `db_silabor`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_alat`
--

CREATE TABLE `tb_alat` (
  `id_alat` int(11) NOT NULL,
  `id_bidang_lab` int(11) NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `jumlah_alat` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_alat`
--

INSERT INTO `tb_alat` (`id_alat`, `id_bidang_lab`, `nama_alat`, `gambar`, `jumlah_alat`, `date_created`, `date_modified`) VALUES
(1, 1, 'Gelas Ukur', '31481fe9901aacde89c7c0b553d7a8d3.jpg', 100, '2022-11-01 13:44:02', NULL),
(2, 10, 'Mesin Pengaduk Semen', '4f9317210d845807463054a8aa08ba4f1.jpg', 100, '2022-11-01 13:45:25', NULL),
(3, 20, 'Leaf Area Meter', 'download.jpg', 100, '2022-11-01 13:47:47', NULL),
(4, 23, 'Rasberry Pi 3 B+', 'raspberry-pi-3-model-b-1.jpg', 100, '2022-11-01 13:48:38', NULL),
(5, 30, '3D Printer', '41AyZR+YfLL__AC_.jpg', 100, '2022-11-01 13:49:46', NULL),
(6, 4, 'test', 'Screenshot_(1).png', 100, '2022-12-29 19:20:28', NULL),
(7, 7, 'test 2', 'Screenshot_(1)1.png', 100, '2022-12-29 19:21:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bidang_lab`
--

CREATE TABLE `tb_bidang_lab` (
  `id_bidang_lab` int(11) NOT NULL,
  `bidang_lab` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_bidang_lab`
--

INSERT INTO `tb_bidang_lab` (`id_bidang_lab`, `bidang_lab`, `date_created`, `date_modified`) VALUES
(1, 'LAB. KIMIA', '2022-06-27 01:27:52', '2022-06-26 18:27:52'),
(2, 'LAB. FISIKA', '2022-06-27 01:27:57', '2022-06-26 18:27:57'),
(3, 'LAB. MULTIMEDIA', '2022-06-27 01:28:01', '2022-06-26 18:28:01'),
(4, 'LAB. BIOLOGI', '2022-06-27 01:28:04', '2022-06-26 18:28:04'),
(5, 'LAB. SAINS ATMOSFER & KEPLANETAN', '2022-06-26 18:26:58', NULL),
(6, 'LAB. FARMASI', '2022-06-26 18:27:07', NULL),
(7, 'LAB. MATEMATIKA', '2022-06-26 18:28:07', NULL),
(8, 'LAB. AKTUARIA', '2022-06-26 18:28:16', NULL),
(9, 'LAB. SAINS LINGKUNGAN KELAUTAN', '2022-06-26 18:28:22', NULL),
(10, 'LAB. TEKNIK SIPIL', '2022-07-03 12:57:26', NULL),
(11, 'LAB. TEKNIK GEOMATIKA', '2022-07-03 12:57:44', NULL),
(12, 'LAB. TEKNIK LINGKUNGAN', '2022-07-03 12:57:53', NULL),
(13, 'LAB. TEKNIK KELAUTAN', '2022-07-03 12:58:03', NULL),
(14, 'STUDIO PWK', '2022-07-03 12:58:13', NULL),
(15, 'STUDIO ARSITEKTUR', '2022-07-03 12:58:22', NULL),
(16, 'STUDIO DKV', '2022-07-03 12:58:30', NULL),
(17, 'STUDIO ARSITEKTUR LANSKAP', '2022-07-03 12:58:45', NULL),
(18, 'LAB. TEKNIK BIOSISTEM', '2022-07-03 12:59:06', NULL),
(19, 'LAB. TEKNIK KIMIA', '2022-07-03 12:59:18', NULL),
(20, 'LAB. TEKNOLOGI INDUSTRI PERTANIAN', '2022-07-03 12:59:41', NULL),
(21, 'LAB. TEKNOLOGI PANGAN', '2022-07-03 12:59:57', NULL),
(22, 'LAB. REKAYASA KEHUTANAN', '2022-07-03 13:00:09', NULL),
(23, 'LAB. TEKNIK ELEKTRO', '2022-07-03 13:00:24', NULL),
(24, 'LAB. TEKNIK FISIKA', '2022-07-03 13:01:05', NULL),
(25, 'LAB. TEKNIK SISTEM ENERGI', '2022-07-03 13:01:17', NULL),
(26, 'LAB. TEKNIK TELEKOMUNIKASI', '2022-07-03 13:01:30', NULL),
(27, 'LAB. TEKNIK BIOMEDIK', '2022-07-03 13:01:37', NULL),
(28, 'LAB. TEKNIK GEOLOGI', '2022-07-03 13:02:01', NULL),
(29, 'LAB. TEKNIK GEOFISIKA', '2022-07-03 13:02:16', NULL),
(30, 'LAB. TEKNIK MESIN', '2022-07-03 13:02:29', NULL),
(31, 'LAB. TEKNIK INDUSTRI', '2022-07-03 13:02:43', NULL),
(32, 'LAB. TEKNIK MATERIAL', '2022-07-03 13:03:03', NULL),
(33, 'LAB. TEKNIK PERTAMBANGAN', '2022-07-03 13:03:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_fakultas`
--

CREATE TABLE `tb_fakultas` (
  `id_fakultas` int(11) NOT NULL,
  `fakultas` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_fakultas`
--

INSERT INTO `tb_fakultas` (`id_fakultas`, `fakultas`, `date_created`, `date_modified`) VALUES
(1, 'Teknologi Infrastruktur dan Kewilayahan', '2022-08-24 16:21:16', NULL),
(2, 'Sains', '2022-08-24 16:21:27', NULL),
(3, 'Teknik Proses dan Hayati', '2022-08-24 16:21:42', NULL),
(4, 'Teknik Elektro, Informatika, dan Sistem Fisis', '2022-08-24 16:23:11', NULL),
(5, 'Teknik Manufaktur dan Mineral Kebumian', '2022-08-24 16:23:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_permohonan_bebas_lab`
--

CREATE TABLE `tb_permohonan_bebas_lab` (
  `id_permohonan_bebas_lab` int(11) NOT NULL,
  `no_surat` text NOT NULL,
  `kode_permohonan` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kepala_upt` int(11) DEFAULT NULL,
  `tgl_penerimaan` date DEFAULT NULL,
  `file` varchar(50) NOT NULL,
  `status` enum('Belum diizinkan','Diizinkan','Tidak diizinkan') NOT NULL,
  `status_kepala_upt` enum('Belum diizinkan','Diizinkan','Tidak diizinkan') NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_permohonan_bebas_lab`
--

INSERT INTO `tb_permohonan_bebas_lab` (`id_permohonan_bebas_lab`, `no_surat`, `kode_permohonan`, `id_user`, `id_kepala_upt`, `tgl_penerimaan`, `file`, `status`, `status_kepala_upt`, `date_created`, `date_modified`) VALUES
(1, '', 'PBL-1-040123', 70, 2, '2023-01-04', 'Screenshot_(1)5.png', 'Belum diizinkan', 'Belum diizinkan', '2023-01-04 17:06:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_permohonan_pinjam_alat`
--

CREATE TABLE `tb_permohonan_pinjam_alat` (
  `id_permohonan_pinjam_alat` int(11) NOT NULL,
  `kode_pinjam` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_laboran` int(11) DEFAULT NULL,
  `id_kepala_upt_lab` int(11) DEFAULT NULL,
  `status` enum('Belum diizinkan','Diizinkan','Tidak diizinkan') NOT NULL,
  `status_laboran` enum('Belum diizinkan','Diizinkan','Tidak diizinkan') NOT NULL,
  `status_kepala_upt` enum('Belum diizinkan','Diizinkan','Tidak diizinkan') NOT NULL,
  `status_track` enum('Sedang diajukan','Belum diambil','Sudah diambil','Telah dikembalikan','Ditolak') NOT NULL,
  `tgl_peminjaman` date DEFAULT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pinjam`
--

CREATE TABLE `tb_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `id_permohonan_pinjam_alat` int(11) NOT NULL,
  `id_bidang_lab` int(11) NOT NULL,
  `jml_alat` int(11) NOT NULL,
  `kondisi_awal` enum('Baik','Rusak','Hilang') DEFAULT NULL,
  `kondisi_akhir` enum('Baik','Rusak','Hilang') DEFAULT NULL,
  `status` enum('Sedang diajukan','Belum diambil','Sedang dipinjam','Telah dikembalikan','Ditolak') NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `id_prodi` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_prodi`
--

INSERT INTO `tb_prodi` (`id_prodi`, `id_fakultas`, `prodi`, `date_created`, `date_modified`) VALUES
(1, 2, 'KIMIA', '2022-07-03 13:06:37', NULL),
(2, 2, 'FISIKA', '2022-07-03 13:06:43', NULL),
(3, 2, 'BIOLOGI', '2022-07-03 13:06:54', NULL),
(4, 2, 'SAINS ATMOSFER & KEPLANETAN', '2022-07-03 13:08:05', NULL),
(5, 2, 'FARMASI', '2022-07-03 13:08:13', NULL),
(6, 2, 'MATEMATIKA', '2022-07-03 13:08:20', NULL),
(7, 2, 'SAINS DATA', '2022-07-03 13:08:41', NULL),
(8, 2, 'SAINS AKTUARIA', '2022-07-03 13:09:13', NULL),
(9, 2, 'SAINS LINGKUNGAN KELAUTAN', '2022-07-03 13:09:37', NULL),
(10, 1, 'TEKNIK SIPIL', '2022-07-03 13:09:53', NULL),
(11, 1, 'TEKNIK GEOMATIKA', '2022-07-03 13:10:27', NULL),
(12, 1, 'TEKNIK LINGKUNGAN', '2022-07-03 13:10:44', NULL),
(13, 1, 'TEKNIK KELAUTAN', '2022-07-03 13:11:00', NULL),
(14, 1, 'PWK', '2022-07-03 13:11:10', NULL),
(15, 1, 'ARSITEKTUR', '2022-07-03 13:11:21', NULL),
(16, 1, 'DKV', '2022-07-03 13:11:28', NULL),
(17, 1, 'ARSITEKTUR LANSKAP', '2022-07-03 13:11:41', NULL),
(18, 1, 'TEKNIK PERKRETAAPIAN', '2022-07-03 13:11:57', NULL),
(19, 3, 'TEKNIK BIOSISTEM', '2022-08-24 21:26:59', NULL),
(20, 3, 'TEKNIK KIMIA', '2022-08-24 21:27:14', NULL),
(21, 3, 'TEKNOLOGI INDUSTRI PERTANIAN', '2022-08-24 21:27:44', NULL),
(22, 3, 'TEKNOLOGI PANGAN', '2022-08-24 21:27:54', NULL),
(23, 3, 'REKAYASA KEHUTANAN', '2022-08-24 21:28:04', NULL),
(24, 4, 'TEKNIK ELEKTRO', '2022-08-24 21:28:17', NULL),
(25, 4, 'TEKNIK INFORMATIKA', '2022-08-24 21:28:29', NULL),
(26, 4, 'TEKNIK FISIKA', '2022-08-24 21:28:40', NULL),
(27, 4, 'TEKNIK SISTEM ENERGI', '2022-08-24 21:28:51', NULL),
(28, 4, 'TEKNIK TELEKOMUNIKASI', '2022-08-24 21:29:13', NULL),
(29, 5, 'TEKNIK BIOMEDIK', '2022-08-24 21:30:56', NULL),
(30, 5, 'TEKNIK GEOLOGI', '2022-08-24 21:30:38', NULL),
(31, 5, 'TEKNIK GEOFISIKA', '2022-08-24 21:31:08', NULL),
(32, 5, 'TEKNIK MESIN', '2022-08-24 21:31:18', NULL),
(33, 5, 'TEKNIK INDUSTRI', '2022-08-24 21:31:30', NULL),
(34, 5, 'TEKNIK MATERIAL', '2022-08-24 21:30:24', NULL),
(35, 5, 'TEKNIK PERTAMBANGAN', '2022-08-24 21:31:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `id_bidang_lab` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nim` int(11) NOT NULL,
  `jenkel` enum('Laki-laki','Perempuan') NOT NULL,
  `is_level` enum('Mahasiswa','Dosen','Laboran','Kepala Lab','Kepala UPT Lab','Super Admin') NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `email`, `id_prodi`, `id_bidang_lab`, `password`, `alamat`, `tgl_lahir`, `nim`, `jenkel`, `is_level`, `date_created`, `date_modified`) VALUES
(1, 'Admin UPT Lab', 'admin.uptlab@itera.ac.id', NULL, NULL, '$2y$10$0Gr4Os1V.7CHQh1vCeCjO.IJcLcwUqHoLH3jhyeT/Rw/MQWQDbsyC', 'Itera', '2022-10-28', 1, 'Perempuan', 'Super Admin', '2022-10-28 09:53:58', NULL),
(2, 'kepala_upt_lab', 'kepala.uptlab@itera.ac.id', NULL, NULL, '$2y$10$7tD.8AjQr0TgTM0EV1wt.O588GYMJ0UaVgn5eAAXglRge9QkYWJhy', 'Itera', '1990-01-01', 2, 'Laki-laki', 'Kepala UPT Lab', '2022-12-28 23:13:13', NULL),
(3, 'Koorlab Kimia', 'koorlab.kimia@itera.ac.id', NULL, 1, '$2y$10$mo7wLrpKgwDjZgvGYBy7U.J0Z6xlmFOv6YkAjDHlp20jQ/g1vP1Ba', 'Itera', '1990-01-01', 3, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:03:58', NULL),
(4, 'Koorlab Fisika', 'koorlab.fisika@itera.ac.id', NULL, 2, '$2y$10$aG5CShRX4B/i3gbO8RlBuuyBjlC5j0Hc.8Ill.riOHgUBk3C6NA1a', 'Itera', '1990-01-01', 4, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:06:57', NULL),
(5, 'Koorlab Multimedia', 'koorlab.multimedia@itera.ac.id', NULL, 3, '$2y$10$SRVIHhYTaqC9gSVLb36NneOQtdG8z8SP5WYCSwWNyMAgW3A9sYAmO', 'Itera', '1990-01-01', 5, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:07:18', NULL),
(6, 'Koorlab Biologi', 'koorlab.biologi@itera.ac.id', NULL, 4, '$2y$10$X4mppw9Dj6KZqQxAylgAi.pcQiPJaso3/5rJnHkdIL1ZCAEZ83GuS', 'Itera', '1990-01-01', 6, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:07:31', NULL),
(7, 'Koorlab SAP', 'koorlab.sap@itera.ac.id', NULL, 5, '$2y$10$We6UIQl0nzeJGoyMD7v7GuOvYgG6ANwNQ24qhegsI9Ni5fNo1o7Lm', 'Itera', '1990-01-01', 7, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:07:50', NULL),
(8, 'Koorlab Farmasi', 'koorlab.farmasi@itera.ac.id', NULL, 6, '$2y$10$PG9XVK/xY2Sb5.QiQygJZ.5e52K.TwVrmhmcL5shWiCXsEM9xjN.W', 'Itera', '1990-01-01', 8, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:07:57', NULL),
(9, 'Koorlab Matematika', 'koorlab.matematika@itera.ac.id', NULL, 7, '$2y$10$uXcGgtfHcezFh3dPXSCzwOOxNTCTtRswSrB42R9HZdakNt/f5Tdny', 'Itera', '1990-01-01', 9, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:08:12', NULL),
(10, 'Koorlab Aktuaria', 'koorlab.aktuaria@itera.ac.id', NULL, 8, '$2y$10$us1qgKCVEokTpLNGUkkAJ.swGlnAlBVdGax5X7iug05FJGy96Fowy', 'Itera', '1990-01-01', 10, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:08:23', NULL),
(11, 'Koorlab SLL', 'koorlab.sll@itera.ac.id', NULL, 9, '$2y$10$I5m2reVKuI7CnVEnlhQ7ceyFpHpnCW96DFyl.PfF.y5cY4gL0wWyO', 'Itera', '1990-01-01', 11, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:09:36', NULL),
(12, 'Koorlab Sipil', 'koorlab.sipil@itera.ac.id', NULL, 10, '$2y$10$X9f.yv/CqlS8KWMWTBSWEuRVsxCpSDmu0UuaEqn/DXzt4.Pqqa.fC', 'Itera', '1990-01-01', 12, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:09:47', NULL),
(13, 'Koorlab Geomatika', 'koorlab.geomatika@itera.ac.id', NULL, 11, '$2y$10$jhTTvx59jiPte29rfZis.ugO6LMpDiuyEcxQmSAy9M/jZYKTLqAAi', 'Itera', '1990-01-01', 13, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:09:56', NULL),
(14, 'Koorlab Lingkungan', 'koorlab.lingkungan@itera.ac.id', NULL, 12, '$2y$10$bbKcPL64gpw1KKVSfkP0le/MFNkvDDM3lG8PedLZ5Mb.p9HhIzW9O', 'Itera', '1990-01-01', 14, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:10:18', NULL),
(15, 'Koorlab Kelautan', 'koorlab.kelautan@itera.ac.id', NULL, 13, '$2y$10$USBm/5On6pgIkbye/K6SH.LpkhBvfMnP7AVaMRJ9ht4PEmvjB9PBq', 'Itera', '1990-01-01', 15, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:10:31', NULL),
(16, 'Koorlab PWK', 'koorlab.pwk@itera.ac.id', NULL, 14, '$2y$10$eqfxmRE72QBPAWw3olEPvOaJRiY1pymMYvwUsbH3ciOPpiIynyw1q', 'Itera', '1990-01-01', 16, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:10:43', NULL),
(17, 'Koorlab Arsitektur', 'koorlab.arsitektur@itera.ac.id', NULL, 15, '$2y$10$ialaejqz4I4aMOcmhji/buGkYF0ZSNmSyuEEt5NoXi1RNH4lNvZPS', 'Itera', '1990-01-01', 17, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:11:14', NULL),
(18, 'Koorlab DKV', 'koorlab.dkv@itera.ac.id', NULL, 16, '$2y$10$3wnC1aYJynSXlfEr/6Wkc.wTTmxhAowbPcxlIiDW3SsBv2MZ960je', 'Itera', '1990-01-01', 18, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:11:45', NULL),
(19, 'Koorlab ARL', 'koorlab.arl@itera.ac.id', NULL, 17, '$2y$10$SMnHZH2MbFnXKCuQWlSs7u29zuoKR4mhPjQL95ZlwbY6nXW8sQmVa', 'Itera', '1990-01-01', 19, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:12:00', NULL),
(20, 'Koorlab Biosistem', 'koorlab.biosistem@itera.ac.id', NULL, 18, '$2y$10$RRWB5PxfXGb.kRBSgyd3eOvPjPXOm1bdsLxSNjEBvXVghYZumu0yC', 'Itera', '1990-01-01', 20, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:12:30', NULL),
(21, 'Koorlab Tekim', 'koorlab.tekim@itera.ac.id', NULL, 19, '$2y$10$0j.CzGiLMd224z36fVoC4elfE/J7BsKOA18gJVoaAWtuyr4kpJ2ZS', 'Itera', '1990-01-01', 21, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:12:50', NULL),
(22, 'Koorlab TIP', 'koorlab.tip@itera.ac.id', NULL, 20, '$2y$10$9O5k5/xeOcGb3qMwQuY7O.IutWrLwdcmEDMSolpwt8Bq7CoDa92M6', 'Itera', '1990-01-01', 22, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:14:02', NULL),
(23, 'Koorlab Tekpang', 'koorlab.tekpang@itera.ac.id', NULL, 21, '$2y$10$BASnMfkMMFZkbOeTCZWQI.Dd50SFrLJGCFSLT1Jf6/BBAMdfF0TsW', 'Itera', '1990-01-01', 23, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:22:28', NULL),
(24, 'Koorlab RK', 'koorlab.rk@itera.ac.id', NULL, 22, '$2y$10$2Xf0Cyr3BtsqH6DPlluo..RumPA9tChnCjtfqiHlHfL1hzcVeTW3i', 'Itera', '1990-01-01', 24, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:22:55', NULL),
(25, 'Koorlab Elektro', 'koorlab.elektro@itera.ac.id', NULL, 23, '$2y$10$CtdpNTbA0RGeTmcsOHzoz.P9j7467k5rmfKa00wzV/ELnbzbdDUpW', 'Itera', '1990-01-01', 25, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:23:27', NULL),
(26, 'Koorlab Tekfis', 'koorlab.tekfis@itera.ac.id', NULL, 24, '$2y$10$aM.6sPfNGdCTXU/HV9hOnO2ma5DO7BL6SrCdJ/xUR6KgSweWuTVQe', 'Itera', '1990-01-01', 26, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:24:01', NULL),
(27, 'Koorlab TSE', 'koorlab.tse@itera.ac.id', NULL, 25, '$2y$10$F4gpMn0yc2UX3ygfIGlHk.fs/o3tEKl5ynusCtYBEGBrFqIRHrRA6', 'Itera', '1990-01-01', 27, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:24:17', NULL),
(28, 'Koorlab Telkom', 'koorlab.telkom@itera.ac.id', NULL, 26, '$2y$10$x76Q1oFUWhCrGZgZcZ0Yqe.abLLrdkYN8a1NV/kUIuUt98vm4HB7O', 'Itera', '1990-01-01', 28, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:24:41', NULL),
(29, 'Koorlab Biomedik', 'koorlab.biomedik@itera.ac.id', NULL, 27, '$2y$10$JxxOOm2oBUPS3oAJi3j3KeP1aMpZP/ZjkCYHA0eH1XLYwIxMiAclS', 'Itera', '1990-01-01', 29, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:25:22', NULL),
(30, 'Koorlab Geologi', 'koorlab.geologi@itera.ac.id', NULL, 28, '$2y$10$EoZLMI3rNO6aOD8.GEx3XOhkw7S455DlFPAGKvM0g.wbebQyu7G/O', 'Itera', '1990-01-01', 30, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:25:52', NULL),
(31, 'Koorlab Geofisika', 'koorlab.geofisika@itera.ac.id', NULL, 29, '$2y$10$yUBj9ogXeipNV5Hj8ytX4O8d5rgC998UVm8sluRcJgLYOyA0WZ6ZC', 'Itera', '1990-01-01', 31, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:26:40', NULL),
(32, 'Koorlab Mesin', 'koorlab.mesin@itera.ac.id', NULL, 30, '$2y$10$akbcopiVaa4Ll8ErAOyPF.rEs9Dgpx7dOzH9NqKDoXvSDsH9QRjTC', 'Itera', '1990-01-01', 32, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:27:06', NULL),
(33, 'Koorlab Industri', 'koorlab.industri@itera.ac.id', NULL, 31, '$2y$10$6s5fbivNTxTonJ09tE5YAeJq9XNdlpri9m/rG1IS4uSg7JJvweIC.', 'Itera', '1990-01-01', 33, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:27:55', NULL),
(34, 'Koorlab Material', 'koorlab.material@itera.ac.id', NULL, 32, '$2y$10$Ml9rR.o7tB1L92InRsP4IecY9t9PCuCjgZD6jHcoV9BH173EBKv1u', 'Itera', '1990-01-01', 34, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:29:06', NULL),
(35, 'Koorlab Tambang', 'koorlab.tambang@itera.ac.id', NULL, 33, '$2y$10$8JNu2bWHKP7OuKnkRjpI1OBT0bzIrXQsR/FXFPrvmOdUPfRsYn.7K', 'Itera', '1990-01-01', 35, 'Laki-laki', 'Kepala Lab', '2022-10-28 11:29:22', NULL),
(36, 'Laboran Kimia', 'laboran.kimia@itera.ac.id', NULL, 1, '$2y$10$jT3An6VSRvzIimNaAGWTCO1mJeDPFD/u94oozPZ77k7pgHTglwTL2', 'Itera', '1990-01-01', 36, 'Laki-laki', 'Laboran', '2022-10-28 11:03:02', NULL),
(37, 'Laboran Fisika', 'laboran.fisika@itera.ac.id', NULL, 2, '$2y$10$QbVoyKjJpF.7OLczNTaltOcPCkKEuaIX2hsYsVzgyMCgr7QaDQ0x6', 'Itera', '1990-01-01', 37, 'Laki-laki', 'Laboran', '2022-11-01 12:34:41', NULL),
(38, 'Laboran Multimedia', 'laboran.Multimedia@itera.ac.id', NULL, 3, '$2y$10$aLek1d.Ha.Q3Zz2uBcGH9e0wM8Du2CsO4WmpZd8Nn6gkb0DJd3.HS', 'Itera', '1990-01-01', 38, 'Laki-laki', 'Laboran', '2022-11-01 12:35:58', NULL),
(39, 'Laboran Biologi', 'laboran.biologi@itera.ac.id', NULL, 4, '$2y$10$prbuZn/r7xv9Hcz09vo3Au7Tu3hiaTOdEhXBXjPN4pRh9wd9LUVM.', 'Itera', '1990-01-01', 39, 'Laki-laki', 'Laboran', '2022-11-01 12:42:22', NULL),
(40, 'Laboran SAP', 'laboran.sap@itera.ac.id', NULL, 5, '$2y$10$AifmcYjwoWhv9dy04qCnguvckCkjWHVcj5Y.D9dHYrWr2QNiD6PNe', 'Itera', '1990-01-01', 40, 'Laki-laki', 'Laboran', '2022-11-01 12:42:51', NULL),
(41, 'Laboran Farmasi', 'laboran.farmasi@itera.ac.id', NULL, 6, '$2y$10$.//hooOX1FRiACTS3zoxIuco5bEOXbm4hRH9Nq1A3CcKhl9ZhmtCK', 'Itera', '1990-01-01', 41, 'Laki-laki', 'Laboran', '2022-11-01 12:43:34', NULL),
(42, 'Laboran Matematika', 'laboran.matematika@itera.ac.id', NULL, 7, '$2y$10$c5//fIUiClwdfLGZA3EuXeSyhpusTq9GG.zDqooFD699h0UhvaIe6', 'Itera', '1990-01-01', 42, 'Laki-laki', 'Laboran', '2022-11-01 12:44:49', NULL),
(43, 'Laboran Aktuaria', 'laboran.aktuaria@itera.ac.id', NULL, 8, '$2y$10$w2Mgiw1Iv8Tx/8lk/OZ/4.UHQJZQtXG2tvM4z1RQ7ZPaaMyT8t5A2', 'Itera', '1990-01-01', 43, 'Laki-laki', 'Laboran', '2022-11-01 12:45:27', NULL),
(44, 'Laboran SLL', 'laboran.sll@itera.ac.id', NULL, 9, '$2y$10$Ew5IFal/5ft05WyDvc7GA.eLbE6psWYlP55vUAYjbzVfQEruA.PLq', 'Itera', '1990-01-01', 44, 'Laki-laki', 'Laboran', '2022-11-01 12:46:57', NULL),
(45, 'Laboran Sipil', 'laboran.sipil@itera.ac.id', NULL, 10, '$2y$10$LwTNLASYYUvL6mYTwJjEd./VKxgGezx7uPAB75ZS6qR51dHZaUFky', 'Itera', '1990-01-01', 45, 'Laki-laki', 'Laboran', '2022-11-01 12:47:32', NULL),
(46, 'Laboran Geomatika', 'laboran.geomatika@itera.ac.id', NULL, 11, '$2y$10$OmbG4p86zEbarNmJeJIrKu9m8ZORgE2iHLD8dFdHvZ51kf6lW20KG', 'Itera', '1990-01-01', 46, 'Laki-laki', 'Laboran', '2022-11-01 12:48:25', NULL),
(47, 'Laboran Lingkungan', 'laboran.lingkungan@itera.ac.id', NULL, 12, '$2y$10$RVEiUXNPxGoOHXlWuF4Vk.5pPoSU2P8GVO9IAv.Ih42CRIFpvKUu.', 'Itera', '1990-01-01', 47, 'Laki-laki', 'Laboran', '2022-11-01 12:49:07', NULL),
(48, 'Laboran Kelautan', 'laboran.kelautan@itera.ac.id', NULL, 13, '$2y$10$ucZdHd8lmCJpqDEeLMf.Du5mo7amodUxVH1XIK9QIZcKtXqY3zheq', 'Itera', '1990-01-01', 48, 'Laki-laki', 'Laboran', '2022-11-01 12:50:40', NULL),
(49, 'Laboran PWK', 'laboran.pwk@itera.ac.id', NULL, 14, '$2y$10$f1yEjXcvgp8VJ2fg2GHSsewLt6lWxEWLbUKHzUTvwGbdJ9PSJkkmC', 'Itera', '1990-01-01', 49, 'Laki-laki', 'Laboran', '2022-11-01 12:51:40', NULL),
(50, 'Laboran Arsitektur', 'laboran.arsitektur@itera.ac.id', NULL, 15, '$2y$10$zPMpHA7Dh3fjkvxj2AttUe0dawm3enI7WFhhJmYjTAq3UDH9jcONi', 'Itera', '1990-01-01', 50, 'Laki-laki', 'Laboran', '2022-11-01 12:52:33', NULL),
(51, 'Laboran DKV', 'laboran.dkv@itera.ac.id', NULL, 16, '$2y$10$849VEEVa9FK4NCEiTU/r0e5SivkEtSEVCErmtF0Dm0y5YSXJk9ZOu', 'Itera', '1990-01-01', 51, 'Laki-laki', 'Laboran', '2022-11-01 12:53:17', NULL),
(52, 'Laboran ARL', 'laboran.arl@itera.ac.id', NULL, 17, '$2y$10$iwgwCAy0XouLnXupcEzPyelm.iE4Mm7M3KzPUIZqWhfEN.EbnOheS', 'Itera', '1990-01-01', 52, 'Laki-laki', 'Laboran', '2022-11-01 12:54:31', NULL),
(53, 'Laboran Biosistem', 'laboran.biosistem@itera.ac.id', NULL, 18, '$2y$10$jgNJLEi2Fx4LqiOBkl3IvuJC1JLKawqvNZ2HfV36dw3SdjtRhmci2', 'Itera', '1990-01-01', 53, 'Laki-laki', 'Laboran', '2022-11-01 12:55:34', NULL),
(54, 'Laboran Tekim', 'laboran.tekim@itera.ac.id', NULL, 19, '$2y$10$8jFEbX/1xkjn9sxHaZiBYO7YXbi1u5CAe.6lR7qtSUXJCYWSzFLje', 'Itera', '1990-01-01', 54, 'Laki-laki', 'Laboran', '2022-11-01 12:56:36', NULL),
(55, 'Laboran TIP', 'laboran.tip@itera.ac.id', NULL, 20, '$2y$10$pX6esYrqkqhRsng6awSh1eLyw2qGUbOBGwhphMatQYfpjYEcIykDu', 'Itera', '1990-01-01', 55, 'Laki-laki', 'Laboran', '2022-11-01 12:57:03', NULL),
(56, 'Laboran Tekpang', 'laboran.tekpang@itera.ac.id', NULL, 21, '$2y$10$2usGFO1J2P69Lk4QHd0OfO2lbvJc5VYaZmO0niFeRRvRBPQdATlWm', 'Itera', '1990-01-01', 56, 'Laki-laki', 'Laboran', '2022-11-01 12:57:47', NULL),
(57, 'Laboran RK', 'laboran.rk@itera.ac.id', NULL, 22, '$2y$10$sBVfpXJpB61CyVBCy/9FA.n9V3iC/.Xvv5N4RY.soSkhgUhoZHGRu', 'Itera', '1990-01-01', 57, 'Laki-laki', 'Laboran', '2022-11-01 12:59:08', NULL),
(58, 'Laboran Elektro', 'laboran.elektro@itera.ac.id', NULL, 23, '$2y$10$HNT6S2ykOOnfOhUWsp3skezseZ6E5uiuBvDDfMH4FNryfyxvi98X2', 'Itera', '1990-01-01', 58, 'Laki-laki', 'Laboran', '2022-11-01 13:02:00', NULL),
(59, 'Laboran Tekfis', 'laboran.tekfis@itera.ac.id', NULL, 24, '$2y$10$LSW97zb/sKrpLc0J1Kv1MuGyZJhGVgFmN7zdJjWlsjFxthV07qmRK', 'Itera', '1990-01-01', 59, 'Laki-laki', 'Laboran', '2022-11-01 13:02:37', NULL),
(60, 'Laboran TSE', 'laboran.tse@itera.ac.id', NULL, 25, '$2y$10$Qf0lD3s0kgkyP7uBHeWcZuSM.FqZVQ6Kg0UXMx5HPC90e1seUg/na', 'Itera', '1990-01-01', 60, 'Laki-laki', 'Laboran', '2022-11-01 13:03:20', NULL),
(61, 'Laboran Telkom', 'laboran.telkom@itera.ac.id', NULL, 26, '$2y$10$qnzwS/2imMDj/LrEk3igqOISksSuow04towW7GbHesMQi/IjeOdCW', 'Itera', '1990-01-01', 61, 'Laki-laki', 'Laboran', '2022-11-01 13:04:32', NULL),
(62, 'Laboran Biomedik', 'laboran.biomedik@itera.ac.id', NULL, 27, '$2y$10$qqaGbzHIM8cEtOMIgvs5kOh1kyaTCxxvfkq/T1QSK/T8pRLIMQ0ZK', 'Itera', '1990-01-01', 62, 'Laki-laki', 'Laboran', '2022-11-01 13:05:18', NULL),
(63, 'Laboran Geologi', 'laboran.geologi@itera.ac.id', NULL, 28, '$2y$10$8Nr5xLeMWT2P4OjPPn6uJepQ4qYcP2Yvrj6xRDWvt7OM/9ZN7Cth6', 'Itera', '1990-01-01', 63, 'Laki-laki', 'Laboran', '2022-11-01 13:09:50', NULL),
(64, 'Laboran Geofisika', 'laboran.geofisika@itera.ac.id', NULL, 29, '$2y$10$mqZgoKHN12lxdGHuGbl4QOFEkzo/ztYOHgwjj8VrbyWw/Crn9q8pK', 'Itera', '1990-01-01', 64, 'Laki-laki', 'Laboran', '2022-11-01 13:10:38', NULL),
(65, 'Laboran Mesin', 'laboran.mesin@itera.ac.id', NULL, 30, '$2y$10$KOy8zmGWZWxWe8lxQkXL.eovBFhBp7wpXmHFqgykz/ce7h6G80/sS', 'Itera', '1990-01-01', 65, 'Laki-laki', 'Laboran', '2022-11-01 13:11:16', NULL),
(66, 'Laboran Industri', 'laboran.industri@itera.ac.id', NULL, 31, '$2y$10$mSaLocqx.EAjufUeYFBcgefQZE0TvgMdNoC.alvhUYgcoAWZaLZ02', 'Itera', '1990-01-01', 66, 'Laki-laki', 'Laboran', '2022-11-01 13:12:39', NULL),
(67, 'Laboran Material', 'laboran.material@itera.ac.id', NULL, 32, '$2y$10$Dy0cSewz.HZ7QOe8xLWJEutZrsxSFrsSCkhOFaM8VCHBye1aepWqG', 'Itera', '1990-01-01', 67, 'Laki-laki', 'Laboran', '2022-11-01 13:13:24', NULL),
(68, 'Laboran Tambang', 'laboran.tambang@itera.ac.id', NULL, 33, '$2y$10$VzErw4zYSstjiLFKj.9Qd.oePeMG/kFPE6BL.iuVO3ZIVsPAjaqQ6', 'Itera', '1990-01-01', 68, 'Laki-laki', 'Laboran', '2022-11-01 13:14:14', NULL),
(69, 'Muhammad Adam Aslamsyah', 'muhammad.118140154@student.itera.ac.id', 25, NULL, '$2y$10$zND7BYmkAc.EvXHzuhgn5O3K3Shi.pRDobjsKn4GiwsJrkEsdNBku', 'Rajabasa', '2000-09-02', 118140154, 'Laki-laki', 'Mahasiswa', '2022-11-01 13:18:41', NULL),
(70, 'Sabila Ayu Permata', 'sabila.118220153@student.itera.ac.id', 14, NULL, '$2y$10$nCnHPSqROg.dBeqG/iZBaOzYJnq/ODNvm2iGSq75VOP8hwt8HS13S', 'Korpri', '2001-05-24', 118220153, 'Laki-laki', 'Mahasiswa', '2022-11-01 13:17:23', NULL),
(71, 'Robby Satya Wicaksana', 'robby.118140155@student.itera.ac.id', 25, NULL, '$2y$10$wSI1DL0KQntpZw/gAy8/F.y57kGDPsbrGAyREF.n6XSA2dRlzdWz6', 'Korpri', '1990-01-01', 118140155, 'Laki-laki', 'Mahasiswa', '2022-11-01 13:18:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_validasi_kalab`
--

CREATE TABLE `tb_validasi_kalab` (
  `id_validasi_kalab` int(11) NOT NULL,
  `id_permohonan_bebas_lab` int(11) NOT NULL,
  `id_kalab` int(11) NOT NULL,
  `status_validasi` enum('Diizinkan','Tidak diizinkan') DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alat`
--
ALTER TABLE `tb_alat`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indexes for table `tb_bidang_lab`
--
ALTER TABLE `tb_bidang_lab`
  ADD PRIMARY KEY (`id_bidang_lab`);

--
-- Indexes for table `tb_fakultas`
--
ALTER TABLE `tb_fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `tb_permohonan_bebas_lab`
--
ALTER TABLE `tb_permohonan_bebas_lab`
  ADD PRIMARY KEY (`id_permohonan_bebas_lab`);

--
-- Indexes for table `tb_permohonan_pinjam_alat`
--
ALTER TABLE `tb_permohonan_pinjam_alat`
  ADD PRIMARY KEY (`id_permohonan_pinjam_alat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_permohonan_pinjam_alat` (`id_permohonan_pinjam_alat`);

--
-- Indexes for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `tb_validasi_kalab`
--
ALTER TABLE `tb_validasi_kalab`
  ADD PRIMARY KEY (`id_validasi_kalab`),
  ADD KEY `id_permohonan_bebas_lab` (`id_permohonan_bebas_lab`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alat`
--
ALTER TABLE `tb_alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_bidang_lab`
--
ALTER TABLE `tb_bidang_lab`
  MODIFY `id_bidang_lab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_fakultas`
--
ALTER TABLE `tb_fakultas`
  MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_permohonan_bebas_lab`
--
ALTER TABLE `tb_permohonan_bebas_lab`
  MODIFY `id_permohonan_bebas_lab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_permohonan_pinjam_alat`
--
ALTER TABLE `tb_permohonan_pinjam_alat`
  MODIFY `id_permohonan_pinjam_alat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `tb_validasi_kalab`
--
ALTER TABLE `tb_validasi_kalab`
  MODIFY `id_validasi_kalab` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_permohonan_pinjam_alat`
--
ALTER TABLE `tb_permohonan_pinjam_alat`
  ADD CONSTRAINT `tb_permohonan_pinjam_alat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD CONSTRAINT `tb_pinjam_ibfk_2` FOREIGN KEY (`id_permohonan_pinjam_alat`) REFERENCES `tb_permohonan_pinjam_alat` (`id_permohonan_pinjam_alat`);

--
-- Constraints for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD CONSTRAINT `tb_prodi_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `tb_fakultas` (`id_fakultas`);

--
-- Constraints for table `tb_validasi_kalab`
--
ALTER TABLE `tb_validasi_kalab`
  ADD CONSTRAINT `tb_validasi_kalab_ibfk_1` FOREIGN KEY (`id_permohonan_bebas_lab`) REFERENCES `tb_permohonan_bebas_lab` (`id_permohonan_bebas_lab`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
