-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2026 at 07:41 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bukutamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `instansi` varchar(100) DEFAULT NULL,
  `tujuan` text,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku_tamu`
--

INSERT INTO `buku_tamu` (`id`, `nama`, `instansi`, `tujuan`, `tanggal`, `waktu`) VALUES
(3, 'Budi Santoso', 'SMA Negeri 5 Surabaya', 'Konsultasi beasiswa pendidikan', '2025-05-01', '08:15:00'),
(4, 'Siti Rahayu', 'Dinas Pendidikan Kota Surabaya', 'Koordinasi program kurikulum merdeka', '2025-05-03', '09:30:00'),
(5, 'Ahmad Fauzi', 'SMK Negeri 1 Sidoarjo', 'Studi banding fasilitas laboratorium', '2025-05-05', '10:00:00'),
(6, 'Dewi Lestari', 'Universitas Airlangga', 'Penelitian skripsi bidang pendidikan', '2025-05-07', '11:15:00'),
(7, 'Riko Firmansyah', 'Komite Sekolah Gresik', 'Rapat pembahasan anggaran tahunan', '2025-05-08', '08:45:00'),
(8, 'Nurul Hidayah', 'SMP Negeri 2 Sidoarjo', 'Konsultasi program pertukaran pelajar', '2025-05-10', '13:00:00'),
(9, 'Hendra Kusuma', 'Dinas Kesehatan Kota Surabaya', 'Sosialisasi program UKS sekolah', '2025-05-12', '09:00:00'),
(10, 'Rina Wulandari', 'Yayasan Peduli Anak Surabaya', 'Pengajuan bantuan beasiswa siswa', '2025-05-14', '10:30:00'),
(11, 'Agus Prasetyo', 'BPJS Ketenagakerjaan Surabaya', 'Sosialisasi program jaminan tenaga kerja', '2025-05-15', '14:00:00'),
(12, 'Maya Anggraini', 'SD Negeri Wonokromo Surabaya', 'Konsultasi akreditasi sekolah dasar', '2025-05-17', '08:30:00'),
(13, 'Fajar Nugroho', 'Institut Teknologi Sepuluh Nopember', 'Kerjasama program magang siswa SMK', '2025-05-19', '11:00:00'),
(14, 'Lina Marlina', 'Komite Orang Tua Siswa Gresik', 'Pembahasan kegiatan perpisahan kelas', '2025-05-21', '13:30:00'),
(15, 'Doni Setiawan', 'Perpustakaan Daerah Surabaya', 'Pengembangan pojok baca sekolah', '2025-05-23', '09:45:00'),
(16, 'Sari Novitasari', 'LSM Literasi Jawa Timur', 'Program donasi buku perpustakaan', '2025-05-28', '10:15:00'),
(17, 'Wahyu Hidayatullah', 'Kecamatan Rungkut Surabaya', 'Verifikasi data siswa kurang mampu', '2025-05-30', '08:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
