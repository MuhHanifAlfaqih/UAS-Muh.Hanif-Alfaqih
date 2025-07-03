-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 01, 2025 at 02:44 PM
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
-- Database: `sekolah_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', '$2y$10$Q7PDR6nAgawc80wElFA1Bu/FylPasvnNG9XMT09fiVmAoVtRL7H3a');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `konten` text NOT NULL,
  `diterbitkan_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `kategori`, `penulis`, `status`, `konten`, `diterbitkan_pada`) VALUES
(1, 'Tips Belajar Efektif', 'Pendidikan', 'Budi Santoso', 'published', 'Belajar efektif adalah...', '2025-07-01 12:32:46'),
(2, 'Prestasi Sekolah', 'Berita', 'Siti Aminah', 'draft', 'Sekolah kita meraih juara...', '2025-07-01 12:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `ekstrakurikuler`
--

CREATE TABLE `ekstrakurikuler` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `pembina` varchar(100) NOT NULL,
  `ketua` varchar(100) NOT NULL,
  `jadwal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekstrakurikuler`
--

INSERT INTO `ekstrakurikuler` (`id`, `nama`, `deskripsi`, `pembina`, `ketua`, `jadwal`) VALUES
(1, 'Pramuka', 'Kegiatan kepramukaan setiap Jumat', 'Agus Prasetyo', 'Dewi Lestari', 'Jumat, 15.00-17.00'),
(2, 'Futsal', 'Latihan futsal setiap Sabtu', 'Budi Santoso', 'Rizky Ramadhan', 'Sabtu, 08.00-10.00');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `nama_galeri` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `nama_galeri`, `deskripsi`, `thumbnail`, `dibuat_pada`) VALUES
(1, 'Kegiatan Pramuka', 'Dokumentasi kegiatan pramuka sekolah', 'pramuka.jpg', '2025-07-01 12:32:46'),
(2, 'Lomba Sains', 'Galeri foto lomba sains tingkat kota', 'sains.jpg', '2025-07-01 12:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nomor_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `dibuat_pada`) VALUES
(1, 'Libur Akhir Semester', 'Sekolah akan libur mulai tanggal 20 Juni hingga 10 Juli.', '2025-07-01 12:32:46'),
(2, 'Penerimaan Siswa Baru', 'Pendaftaran siswa baru dibuka mulai 1 Juli hingga 15 Juli.', '2025-07-01 12:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `tingkat` varchar(10) NOT NULL,
  `jumlah_siswa` int(11) DEFAULT 0,
  `wali_kelas` varchar(100) DEFAULT NULL,
  `ruangan` varchar(50) DEFAULT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `tingkat`, `jumlah_siswa`, `wali_kelas`, `ruangan`, `tanggal_dibuat`) VALUES
(1, 'X-IPA 1', '10', 30, 'Dr. Ahmad Susanto', 'Lab IPA 1', '2025-07-02 07:00:00'),
(2, 'X-IPS 1', '10', 28, 'Siti Nurhaliza, S.Pd', 'Ruang 101', '2025-07-02 07:00:00'),
(3, 'XI-IPA 1', '11', 32, 'Budi Santoso, M.Pd', 'Lab IPA 2', '2025-07-02 07:00:00'),
(4, 'XI-IPS 1', '11', 29, 'Rina Kartika, S.Pd', 'Ruang 201', '2025-07-02 07:00:00'),
(5, 'XII-IPA 1', '12', 25, 'Dr. Sari Dewi', 'Lab Kimia', '2025-07-02 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nama_wali` varchar(100) NOT NULL,
  `status` enum('Aktif','Tidak Aktif','Lulus') DEFAULT 'Aktif',
  `tanggal_masuk` date NOT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama_lengkap`, `kelas_id`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_hp`, `email`, `nama_wali`, `status`, `tanggal_masuk`, `tanggal_dibuat`) VALUES
(1, '2025001', 'Andi Pratama', 1, 'Laki-laki', '2007-05-15', 'Jl. Merdeka No. 123, Jakarta', '081234567890', 'andi.pratama@email.com', 'Bapak Surya Pratama', 'Aktif', '2025-07-01', '2025-07-02 07:00:00'),
(2, '2025002', 'Sari Dewi', 1, 'Perempuan', '2007-08-22', 'Jl. Pancasila No. 456, Jakarta', '081234567891', 'sari.dewi@email.com', 'Ibu Wati Sari', 'Aktif', '2025-07-01', '2025-07-02 07:00:00'),
(3, '2025003', 'Rizki Maulana', 2, 'Laki-laki', '2007-03-10', 'Jl. Diponegoro No. 789, Jakarta', '081234567892', 'rizki.maulana@email.com', 'Bapak Hadi Maulana', 'Aktif', '2025-07-01', '2025-07-02 07:00:00'),
(4, '2025004', 'Maya Sari', 2, 'Perempuan', '2007-12-05', 'Jl. Sudirman No. 321, Jakarta', '081234567893', 'maya.sari@email.com', 'Ibu Lestari Maya', 'Aktif', '2025-07-01', '2025-07-02 07:00:00'),
(5, '2025005', 'Dani Ramadhan', 3, 'Laki-laki', '2006-09-18', 'Jl. Thamrin No. 654, Jakarta', '081234567894', 'dani.ramadhan@email.com', 'Bapak Ahmad Ramadhan', 'Aktif', '2024-07-01', '2025-07-02 07:00:00'),
(6, '2025006', 'Indah Permata', 3, 'Perempuan', '2006-11-30', 'Jl. Gatot Subroto No. 987, Jakarta', '081234567895', 'indah.permata@email.com', 'Ibu Siti Permata', 'Aktif', '2024-07-01', '2025-07-02 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` int(11) NOT NULL,
  `kode_mapel` varchar(10) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `guru_pengampu` varchar(100) NOT NULL,
  `jam_pelajaran` int(11) NOT NULL,
  `semester` enum('1','2') NOT NULL,
  `tingkat` varchar(10) NOT NULL,
  `kkm` int(11) DEFAULT 75,
  `deskripsi` text DEFAULT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `kode_mapel`, `nama_mapel`, `guru_pengampu`, `jam_pelajaran`, `semester`, `tingkat`, `kkm`, `deskripsi`, `tanggal_dibuat`) VALUES
(1, 'MTK10', 'Matematika', 'Dr. Ahmad Susanto', 4, '1', '10', 75, 'Mata pelajaran matematika dasar untuk kelas X', '2025-07-02 07:00:00'),
(2, 'IPA10', 'Ilmu Pengetahuan Alam', 'Siti Nurhaliza, S.Pd', 3, '1', '10', 75, 'Mata pelajaran IPA terpadu untuk kelas X', '2025-07-02 07:00:00'),
(3, 'BIN10', 'Bahasa Indonesia', 'Budi Santoso, M.Pd', 4, '1', '10', 75, 'Mata pelajaran Bahasa Indonesia untuk kelas X', '2025-07-02 07:00:00'),
(4, 'IPS10', 'Ilmu Pengetahuan Sosial', 'Rina Kartika, S.Pd', 3, '1', '10', 75, 'Mata pelajaran IPS terpadu untuk kelas X', '2025-07-02 07:00:00'),
(5, 'BIG10', 'Bahasa Inggris', 'Dr. Sari Dewi', 3, '1', '10', 75, 'Mata pelajaran Bahasa Inggris untuk kelas X', '2025-07-02 07:00:00'),
(6, 'FIS11', 'Fisika', 'Dr. Ahmad Susanto', 4, '1', '11', 75, 'Mata pelajaran Fisika untuk kelas XI IPA', '2025-07-02 07:00:00'),
(7, 'KIM11', 'Kimia', 'Dr. Sari Dewi', 4, '1', '11', 75, 'Mata pelajaran Kimia untuk kelas XI IPA', '2025-07-02 07:00:00'),
(8, 'BIO11', 'Biologi', 'Siti Nurhaliza, S.Pd', 4, '1', '11', 75, 'Mata pelajaran Biologi untuk kelas XI IPA', '2025-07-02 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `mata_pelajaran_id` int(11) NOT NULL,
  `jenis_nilai` enum('Tugas','UTS','UAS','Harian') NOT NULL,
  `nilai` decimal(5,2) NOT NULL,
  `nilai_huruf` varchar(2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_nilai` date NOT NULL,
  `semester` enum('1','2') NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `siswa_id`, `mata_pelajaran_id`, `jenis_nilai`, `nilai`, `nilai_huruf`, `keterangan`, `tanggal_nilai`, `semester`, `tahun_ajaran`, `tanggal_dibuat`) VALUES
(1, 1, 1, 'UTS', 85.50, 'B', 'Nilai UTS Matematika', '2025-07-01', '1', '2025/2026', '2025-07-02 07:00:00'),
(2, 1, 2, 'UTS', 78.00, 'B', 'Nilai UTS IPA', '2025-07-01', '1', '2025/2026', '2025-07-02 07:00:00'),
(3, 2, 1, 'UTS', 92.00, 'A', 'Nilai UTS Matematika', '2025-07-01', '1', '2025/2026', '2025-07-02 07:00:00'),
(4, 3, 4, 'Tugas', 88.00, 'A', 'Tugas IPS tentang sejarah', '2025-07-01', '1', '2025/2026', '2025-07-02 07:00:00'),
(5, 1, 3, 'Harian', 80.00, 'B', 'Ulangan harian Bahasa Indonesia', '2025-06-28', '1', '2025/2026', '2025-07-02 07:00:00'),
(6, 2, 2, 'Tugas', 85.00, 'B', 'Tugas praktikum IPA', '2025-06-25', '1', '2025/2026', '2025-07-02 07:00:00'),
(7, 4, 1, 'UTS', 76.50, 'B', 'Nilai UTS Matematika', '2025-07-01', '1', '2025/2026', '2025-07-02 07:00:00'),
(8, 5, 6, 'Harian', 90.00, 'A', 'Ulangan harian Fisika', '2025-06-30', '1', '2025/2026', '2025-07-02 07:00:00'),
(9, 6, 7, 'Tugas', 87.50, 'A', 'Laporan praktikum Kimia', '2025-06-27', '1', '2025/2026', '2025-07-02 07:00:00'),
(10, 5, 8, 'UTS', 82.00, 'B', 'Nilai UTS Biologi', '2025-07-01', '1', '2025/2026', '2025-07-02 07:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kelas` (`nama_kelas`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_mapel` (`kode_mapel`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
