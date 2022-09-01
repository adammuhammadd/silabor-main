-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2022 at 11:57 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_alat`
--

INSERT INTO `tb_alat` (`id_alat`, `id_bidang_lab`, `nama_alat`, `gambar`, `jumlah_alat`, `date_created`, `date_modified`) VALUES
(1, 24, 'Rasberry Pi 3 B+', '63dc9351-7869-4406-82d9-4d22b576a52d.jpg', 10, '2022-08-24 17:02:34', NULL),
(2, 10, 'Mesin Pengaduk Beton', '4f9317210d845807463054a8aa08ba4f.jpg', 10, '2022-08-24 17:04:14', NULL),
(3, 1, 'Tabung Reaksi', '49a18735f242b210170b8a8ac87e2ce3.jpg', 10, '2022-08-24 17:19:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bidang_lab`
--

CREATE TABLE `tb_bidang_lab` (
  `id_bidang_lab` int(11) NOT NULL,
  `bidang_lab` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `kode_permohonan` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kepala_upt` int(11) DEFAULT NULL,
  `tgl_penerimaan` date DEFAULT NULL,
  `file` varchar(50) NOT NULL,
  `status` enum('Belum diizinkan','Diizinkan','Tidak diizinkan') NOT NULL,
  `status_kepala_upt` enum('Belum diizinkan','Diizinkan','Tidak diizinkan') NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_permohonan_pinjam_alat`
--

INSERT INTO `tb_permohonan_pinjam_alat` (`id_permohonan_pinjam_alat`, `kode_pinjam`, `id_user`, `id_laboran`, `id_kepala_upt_lab`, `status`, `status_laboran`, `status_kepala_upt`, `status_track`, `tgl_peminjaman`, `tgl_pengembalian`, `date_created`, `date_modified`) VALUES
(2, 'PPA-1-240822', 2, 43, 38, 'Diizinkan', 'Diizinkan', 'Diizinkan', 'Belum diambil', NULL, NULL, '2022-08-25 14:09:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pinjam`
--

CREATE TABLE `tb_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `id_permohonan_pinjam_alat` int(11) NOT NULL,
  `jml_alat` int(11) NOT NULL,
  `kondisi_awal` enum('Baik','Rusak','Hilang') DEFAULT NULL,
  `kondisi_akhir` enum('Baik','Rusak','Hilang') DEFAULT NULL,
  `status` enum('Sedang diajukan','Belum diambil','Sedang dipinjam','Telah dikembalikan','Ditolak') NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pinjam`
--

INSERT INTO `tb_pinjam` (`id_pinjam`, `id_alat`, `id_permohonan_pinjam_alat`, `jml_alat`, `kondisi_awal`, `kondisi_akhir`, `status`, `date_created`, `date_modified`) VALUES
(3, 2, 2, 1, 'Baik', NULL, 'Belum diambil', '2022-08-25 14:09:54', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `email`, `id_prodi`, `id_bidang_lab`, `password`, `alamat`, `tgl_lahir`, `nim`, `jenkel`, `is_level`, `date_created`, `date_modified`) VALUES
(1, 'Super Admin', 'superadmin@staff.itera.ac.id', NULL, NULL, '$2y$10$hTpuGdIuB0p2YMBZyMBIe.JAL2IpnGn8MNx7vTo6s7LN7sXPl/TQC', 'Lampung Selatan', '1990-01-01', 999, 'Perempuan', 'Super Admin', '2022-08-24 16:55:26', NULL),
(2, 'Muhammad Rizky Ramadhani', 'muhammad.118320021@student.itera.ac.id', 26, NULL, '$2y$10$ICkIBAISySnyaJPKiWXBJO6iOaYaUZDWe6Hg3hFH2maczXxt5rmru', 'Lampung Selatan', '1999-12-30', 118320021, 'Laki-laki', 'Mahasiswa', '2022-08-24 16:46:32', NULL),
(3, 'Laboran Teknik Fisika', 'laborantekfis@staff.itera.ac.id', NULL, 24, '$2y$10$Umc/3a5JSKdpKieEUUuC.eVbO2nuG3P868gLysVaw/t.ekQhxyQOm', 'Lampung Selatan', '1990-01-01', 99999, 'Laki-laki', 'Laboran', '2022-08-24 16:55:50', NULL),
(4, 'Shamil Abdul Aziz Wahyudi', 'shamil.118@student.itera.ac.id', 10, NULL, '$2y$10$6u41zoP9EVYX5UXdAWJHJOWE8k1kjvvqmGcI7JDCww1G.o5zdEoAS', 'Lampung Selatan', '2000-11-01', 118, 'Laki-laki', 'Mahasiswa', '2022-08-24 16:57:13', NULL),
(5, 'kalab_kimia', 'kalab_kimia@gmail.com', NULL, 1, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 2221, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(6, 'kalab_fisika', 'kalab_fisika@gmail.com', NULL, 2, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 2222, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(7, 'kalab_multimedia', 'kalab_multimedia@gmail.com', NULL, 3, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 2223, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(8, 'kalab_biologi', 'kalab_biologi@gmail.com', NULL, 4, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 2224, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(9, 'kalab_sains_atm', 'kalab_sains_atm@gmail.com', NULL, 5, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 2225, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(10, 'kalab_farmasi', 'kalab_farmasi@gmail.com', NULL, 6, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 2226, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(11, 'kalab_matematika', 'kalab_matematika@gmail.com', NULL, 7, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 2227, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(12, 'kalab_aktuaria', 'kalab_aktuaria@gmail.com', NULL, 8, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 2228, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(13, 'kalab_sains_ling', 'kalab_sains_ling@gmail.com', NULL, 9, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 2229, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(14, 'kalab_tk_sipil', 'kalab_tk_sipil@gmail.com', NULL, 10, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22210, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(15, 'kalab_tk_geomatika', 'kalab_tk_geomatika@gmail.com', NULL, 11, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22211, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(16, 'kalab_tk_ling', 'kalab_tk_ling@gmail.com', NULL, 12, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22212, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(17, 'kalab_tk_kelautan', 'kalab_tk_kelautan@gmail.com', NULL, 13, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22213, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(18, 'kalab_studio_pwk', 'kalab_studio_pwk@gmail.com', NULL, 14, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22214, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(19, 'kalab_studio_ars', 'kalab_studio_ars@gmail.com', NULL, 15, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22215, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(20, 'kalab_studio_dkv', 'kalab_studio_dkv@gmail.com', NULL, 16, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22216, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(21, 'kalab_studio_ars_lans', 'kalab_studio_ars_lans@gmail.com', NULL, 17, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22217, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(22, 'kalab_tk_biosistem', 'kalab_tk_biosistem@gmail.com', NULL, 18, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22218, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(23, 'kalab_tk_kimia', 'kalab_tk_kimia@gmail.com', NULL, 19, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22219, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(24, 'kalab_tk_ind_tani', 'kalab_tk_ind_tani@gmail.com', NULL, 20, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22220, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(25, 'kalab_tk_pangan', 'kalab_tk_pangan@gmail.com', NULL, 21, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22221, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(26, 'kalab_rek_kehutanan', 'kalab_rek_kehutanan@gmail.com', NULL, 22, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22222, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(27, 'kalab_tk_elektro', 'kalab_tk_elektro@gmail.com', NULL, 23, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22223, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(28, 'kalab_tk_fisika', 'kalab_tk_fisika@gmail.com', NULL, 24, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22224, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(29, 'kalab_tk_sis_energi', 'kalab_tk_ind_tani@gmail.com', NULL, 25, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22225, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(30, 'kalab_tk_telkom', 'kalab_tk_telkom@gmail.com', NULL, 26, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22226, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(31, 'kalab_tk_biomedik', 'kalab_tk_biomedik@gmail.com', NULL, 27, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22227, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(32, 'kalab_tk_geologi', 'kalab_tk_geologi@gmail.com', NULL, 28, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22228, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(33, 'kalab_tk_geofisika', 'kalab_tk_geofisika@gmail.com', NULL, 29, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22229, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(34, 'kalab_tk_mesin', 'kalab_tk_mesin@gmail.com', NULL, 30, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22230, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(35, 'kalab_tk_ind', 'kalab_tk_ind@gmail.com', NULL, 31, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22231, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(36, 'kalab_tk_material', 'kalab_tk_material@gmail.com', NULL, 32, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22232, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(37, 'kalab_tk_tambang', 'kalab_tk_tambang@gmail.com', NULL, 33, '$2y$10$KPMOqf07bwelOdbWCtSHfOe5Rw93hcJw/L0VbD2wxYDeXr1AYfFjq', 'balam', '1990-02-08', 22233, 'Laki-laki', 'Kepala Lab', '2022-07-03 23:41:58', NULL),
(38, 'kepala_upt_lab', 'kepala_upt_lab@gmail.com', NULL, NULL, '$2y$10$kZm/hHMnQZzWZUOVvCLU/OAXjAYfLJ6yVIEGLlhC5oP6UPwnj9nlS', 'balam', '1990-01-26', 9999, 'Laki-laki', 'Kepala UPT Lab', '2022-07-03 17:06:16', NULL),
(39, 'Mahasiswa 3', 'mahasiswa3@gmail.com', 19, NULL, '$2y$10$B4P8X3bm4.Aa3jqHHVySi.e9IsPbTVpprz6ycH2LbVJeuYzBryREq', 'balam', '1990-02-02', 3333, 'Perempuan', 'Mahasiswa', '2022-07-04 16:52:43', NULL),
(40, 'Mahasiswa 4', 'mahasiswa4@gmail.com', 26, NULL, '$2y$10$hqC6tOL57M/lB.d4LINQquzrv.fH8kuoPuKgkrEUu9UTS5ryyXLja', 'balam', '1990-02-03', 3334, 'Laki-laki', 'Mahasiswa', '2022-07-04 17:11:50', NULL),
(41, 'Mahasiswa 5', 'mahasiswa5@gmail.com', 34, NULL, '$2y$10$4U6.KJq9lFFPPfeUc5HPKuNl6RKb5QeRNJuGxhd0x/XWfL7gBSvvW', 'balam', '1990-01-10', 3335, 'Laki-laki', 'Mahasiswa', '2022-07-04 17:28:18', NULL),
(42, 'Mahasiswa 6', 'mahasiswa6@gmail.com', 10, NULL, '$2y$10$QktMCJwbYNH.mnnbUaeoRu7PlYQJ1lY6.ptQK2ADmafzND0oUG/PS', 'balam', '1990-02-02', 3336, 'Laki-laki', 'Mahasiswa', '2022-07-04 19:32:28', NULL),
(43, 'Laboran Teknik Sipil', 'laboransipil@staff.itera.ac.id', NULL, 10, '$2y$10$07fraHmjtzw/VHKeSnYdtO5D4aKNGFOE8.YUKYAWwas6kWdDQT2wi', 'Lampung Selatan', '1990-01-01', 88888, 'Laki-laki', 'Laboran', '2022-08-24 16:59:50', NULL),
(44, 'Laboran Kimia', 'laborankimia@staff.itera.ac.id', NULL, 1, '$2y$10$Yx0ypsWpOZBf0a2wsByT1uG0p0DJ0aGMcZViJ1moowqkvgz6cECD2', 'Lampung Selatan', '1990-01-01', 77777, 'Perempuan', 'Laboran', '2022-08-24 17:18:02', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`id_permohonan_bebas_lab`),
  ADD KEY `id_user` (`id_user`);

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
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_bidang_lab`
--
ALTER TABLE `tb_bidang_lab`
  MODIFY `id_bidang_lab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_fakultas`
--
ALTER TABLE `tb_fakultas`
  MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_permohonan_bebas_lab`
--
ALTER TABLE `tb_permohonan_bebas_lab`
  MODIFY `id_permohonan_bebas_lab` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_permohonan_pinjam_alat`
--
ALTER TABLE `tb_permohonan_pinjam_alat`
  MODIFY `id_permohonan_pinjam_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tb_validasi_kalab`
--
ALTER TABLE `tb_validasi_kalab`
  MODIFY `id_validasi_kalab` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_permohonan_bebas_lab`
--
ALTER TABLE `tb_permohonan_bebas_lab`
  ADD CONSTRAINT `tb_permohonan_bebas_lab_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

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
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `tb_prodi` (`id_prodi`);

--
-- Constraints for table `tb_validasi_kalab`
--
ALTER TABLE `tb_validasi_kalab`
  ADD CONSTRAINT `tb_validasi_kalab_ibfk_1` FOREIGN KEY (`id_permohonan_bebas_lab`) REFERENCES `tb_permohonan_bebas_lab` (`id_permohonan_bebas_lab`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
