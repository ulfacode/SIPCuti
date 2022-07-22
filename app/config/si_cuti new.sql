-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2022 at 07:22 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_cuti`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_doswal`
--

CREATE TABLE `tb_doswal` (
  `id_doswal` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `thn_jabatan` varchar(9) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_doswal`
--

INSERT INTO `tb_doswal` (`id_doswal`, `id_pegawai`, `thn_jabatan`, `status`) VALUES
(2, 12, '2019-2022', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hak_akses`
--

CREATE TABLE `tb_hak_akses` (
  `id_hak_akses` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `id_jabatan` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_hak_akses`
--

INSERT INTO `tb_hak_akses` (`id_hak_akses`, `id_pegawai`, `id_jabatan`) VALUES
(1, 1, 1),
(3, 4, 3),
(4, 5, 4),
(5, 6, 3),
(6, 7, 5),
(7, 8, 6),
(8, 9, 2),
(9, 9, 3),
(11, 11, 3),
(12, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id_jabatan` int(1) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `nama_folder` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `nama_jabatan`, `nama_folder`) VALUES
(1, 'Administrator', 'admin'),
(2, 'Dosen Wali', 'doswal'),
(3, 'Ketua Jurusan', 'kajur'),
(4, 'Wakil Direktur 1', 'wadir1'),
(5, 'Koordinator Subbagian Akademik dan Kemahasiswaan', 'KetuaAkademik'),
(6, 'Bagian Keuangan', 'keuangan'),
(7, 'Bagian Perpustakaan', 'perpus');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kajur`
--

CREATE TABLE `tb_kajur` (
  `id_kajur` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `nm_jurusan` varchar(50) NOT NULL,
  `thn_jabatan` varchar(9) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kajur`
--

INSERT INTO `tb_kajur` (`id_kajur`, `id_pegawai`, `nm_jurusan`, `thn_jabatan`, `status`) VALUES
(4, 9, 'Teknik Informatika', '2019-2022', 'Aktif'),
(5, 11, 'Teknik Elektronika', '2019-2022', 'Tidak Aktif'),
(6, 6, 'Teknik Mesin', '2019-2022', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `id_mahasiswa` int(5) NOT NULL,
  `nim` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_doswal` int(5) NOT NULL,
  `id_kajur` int(5) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `thn_angkatan` char(4) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `tempat_lhr` varchar(25) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `jk` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` char(13) NOT NULL,
  `foto` varchar(60) DEFAULT NULL,
  `ttd` varchar(60) DEFAULT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`id_mahasiswa`, `nim`, `email`, `id_doswal`, `id_kajur`, `password`, `nama`, `thn_angkatan`, `kelas`, `tempat_lhr`, `tgl_lhr`, `jk`, `alamat`, `no_telp`, `foto`, `ttd`, `token`) VALUES
(1, 190102031, 'ulfatunnasikhah49@gmail.com', 2, 4, 'ulfa', 'Ulfatun', '2019', 'C', 'Banyumas', '2001-06-29', 'Perempuan', 'Jl. Jatisari RT 03 RW 03 Ketanda, Kec. Sumpiuh, Kab. Banyumas', '081390181520', 'foto_62d0f8a534687Ulfatun Nasikhah.jpg', 'ttd_62d0f8b3c57e3Ulfatun Nasikhah.png', ''),
(2, 190302098, 'ummuhab@gmail.com', 2, 4, 'ummuhab', 'Ummu Habibah', '2019', 'C', 'Cilacap', '2001-02-04', 'Perempuan', 'Wungu', '081234567895', NULL, NULL, ''),
(7, 4345, 'gff@gmail.com', 2, 4, 'ddfdv', 'dfdf.gfg,', '2019', 'C', 'xcvgdfg', '2022-07-22', 'Perempuan', 'ffgfdg', '344564654', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int(5) NOT NULL,
  `nip_npak` char(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `thn_jabatan` varchar(9) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `no_telp` char(13) NOT NULL,
  `foto` varchar(60) DEFAULT NULL,
  `ttd` varchar(60) DEFAULT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `nip_npak`, `email`, `password`, `nama`, `jabatan`, `thn_jabatan`, `status`, `no_telp`, `foto`, `ttd`, `token`) VALUES
(1, '198204092021212008', 'EriHastuti@gmail.com', 'admin', 'Eri Hastuti, S.E.', 'Administrator', '2019-2022', 'Aktif', '2147483647', NULL, 'ttd_62d40c397de5dEri Hastuti, S.E..png', ''),
(4, '04.17.8028', 'taufan@gmail.com', 'tppl', 'Taufan Ratri Harjanto, S.T., M.Eng.', '', '2019-2022', 'Aktif', '08656', NULL, NULL, ''),
(5, '08.001', 'agussantoso@gmail.com', 'wadir1', 'Dr. Eng. Agus Santoso', '', '2019-2022', 'Aktif', '08642', NULL, 'ttd_62d4cef0bd305Dr. Eng. Agus Santoso.png', ''),
(6, '197703022021211008', 'jokosetia@gmail.com', 'kajurtm', 'Joko Setia Pribadi, S.T., M.Eng.', '', '2019-2022', 'Aktif', '2147483647', NULL, NULL, ''),
(7, '197911172021212009', 'NoviaP@gmail.com', 'akademik', 'Dwi Novia Prasetyanti, S.Kom, M.Cs.', '', '2019-2022', 'Aktif', '087568', NULL, NULL, ''),
(8, '197912062010121001', 'faidzin@gmail.com', 'keuangan', 'Faidzin Firdhaus, S.E., M.Ak.', '', '2019-2022', 'Aktif', '0856834', NULL, 'ttd_62d2c0c31e4f0Faidzin Firdhaus, S.E., M.Ak..png', ''),
(9, '198105092021211004', 'nwahyu@gmail.com', 'kajurti', 'Nur Wahyu Rahadi, S.Kom., M.Eng.', '', '2019-2022', 'Aktif', '087476574', 'foto_62d40983b8664Nur Wahyu Rahadi, S.Kom., M.Eng..png', 'ttd_62d40991e1ec8Nur Wahyu Rahadi, S.Kom., M.Eng..png', ''),
(11, '198509172019031005', 'galihmustiko@gmail.com', 'kajurte', 'Galih Mustiko Aji, S.T., M.T.', '', '2019-2022', 'Aktif', '08476545', NULL, NULL, ''),
(12, '198405072019031011', 'andesita@gmail.com', 'doswal', 'Andesita Prihantara, S.T., M.Eng.', '', '2019-2022', 'Aktif', '0787874', NULL, 'ttd_62d2c647dca43Andesita Prihantara, S.T., M.Eng..png', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id_pengajuan` int(5) NOT NULL,
  `id_mahasiswa` int(5) NOT NULL,
  `jns_pengajuan` enum('Cuti','Izin Aktif') NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `semester_cuti` int(1) NOT NULL,
  `tingkat` int(1) NOT NULL,
  `thn_akademik` varchar(9) NOT NULL,
  `nm_prodi` varchar(50) NOT NULL,
  `alasan` varchar(200) DEFAULT NULL,
  `lampiran` varchar(60) NOT NULL,
  `ttd_ortu` varchar(60) NOT NULL,
  `nama_ortu` varchar(50) NOT NULL,
  `status` enum('1','2','3','4','5','6') DEFAULT NULL,
  `no_sk` varchar(30) DEFAULT NULL,
  `tgl_sk` date DEFAULT NULL,
  `upload_sk` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id_pengajuan`, `id_mahasiswa`, `jns_pengajuan`, `tgl_pengajuan`, `semester_cuti`, `tingkat`, `thn_akademik`, `nm_prodi`, `alasan`, `lampiran`, `ttd_ortu`, `nama_ortu`, `status`, `no_sk`, `tgl_sk`, `upload_sk`) VALUES
(1, 1, 'Cuti', '2022-07-15', 5, 3, '2022/2023', 'Teknik Informatika', 'dnbvnmvc', 'lampiran_cuti62d0fd2be3ed1190102031.pdf', 'ortu_cuti62d10111ea0a0190102031.png', 'Ahmad Fadoli', '5', NULL, NULL, 'sk_62d424cab96c8_190102031.pdf'),
(2, 1, 'Izin Aktif', '2022-07-17', 5, 3, '2023/2024', 'Teknik Informatika', NULL, 'lampiran_aktif62d4277aee827190102031.pdf', 'ortu_aktif62d4277aee32c190102031.png', 'Ahmad Fadoli', '5', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_verifikasi`
--

CREATE TABLE `tb_verifikasi` (
  `id_verifikasi` int(11) NOT NULL,
  `id_pengajuan` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `tgl_verif` date NOT NULL,
  `status` enum('Diterima','Ditolak') DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_verifikasi`
--

INSERT INTO `tb_verifikasi` (`id_verifikasi`, `id_pengajuan`, `id_pegawai`, `tgl_verif`, `status`, `keterangan`) VALUES
(1, 1, 8, '2022-07-16', 'Diterima', ''),
(2, 1, 12, '2022-07-16', 'Diterima', ''),
(3, 1, 9, '2022-07-17', 'Diterima', ''),
(4, 1, 1, '2022-07-17', 'Diterima', ''),
(5, 2, 12, '2022-07-17', 'Diterima', ''),
(6, 2, 9, '2022-07-17', 'Diterima', ''),
(10, 2, 1, '2022-07-18', 'Diterima', '');

-- --------------------------------------------------------

--
-- Table structure for table `v_laporan`
--

CREATE TABLE `v_laporan` (
  `nim` int(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jk` varchar(10) DEFAULT NULL,
  `thn_angkatan` char(4) DEFAULT NULL,
  `nm_prodi` varchar(50) DEFAULT NULL,
  `no_sk` varchar(30) DEFAULT NULL,
  `tgl_sk` date DEFAULT NULL,
  `thn_akademik` varchar(9) DEFAULT NULL,
  `jns_pengajuan` enum('Cuti','Izin Aktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `v_pengajuan`
--

CREATE TABLE `v_pengajuan` (
  `nim` int(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `id_pengajuan` int(5) DEFAULT NULL,
  `jns_pengajuan` enum('Cuti','Izin Aktif') DEFAULT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `semester_cuti` int(1) DEFAULT NULL,
  `thn_akademik` varchar(9) DEFAULT NULL,
  `alasan` varchar(200) DEFAULT NULL,
  `status` enum('1','2','3','4','5','6') DEFAULT NULL,
  `lampiran` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `v_pengajuan_perpus`
--

CREATE TABLE `v_pengajuan_perpus` (
  `nim` int(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jns_pengajuan` enum('Cuti','Izin Aktif') DEFAULT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `semester_cuti` int(1) DEFAULT NULL,
  `thn_akademik` varchar(9) DEFAULT NULL,
  `upload_sk` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `v_tampil_doswal`
--

CREATE TABLE `v_tampil_doswal` (
  `nama` varchar(50) DEFAULT NULL,
  `nip_npak` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `v_wdpengajuan`
--

CREATE TABLE `v_wdpengajuan` (
  `nim` int(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `id_pengajuan` int(5) DEFAULT NULL,
  `jns_pengajuan` enum('Cuti','Izin Aktif') DEFAULT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `semester_cuti` int(1) DEFAULT NULL,
  `thn_akademik` varchar(9) DEFAULT NULL,
  `alasan` varchar(200) DEFAULT NULL,
  `status` enum('1','2','3','4','5','6') DEFAULT NULL,
  `lampiran` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_doswal`
--
ALTER TABLE `tb_doswal`
  ADD PRIMARY KEY (`id_doswal`),
  ADD KEY `id_pegawai_fk_doswal` (`id_pegawai`);

--
-- Indexes for table `tb_hak_akses`
--
ALTER TABLE `tb_hak_akses`
  ADD PRIMARY KEY (`id_hak_akses`),
  ADD KEY `id_jabatan` (`id_jabatan`) USING BTREE,
  ADD KEY `id_pegawai_fkhak` (`id_pegawai`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tb_kajur`
--
ALTER TABLE `tb_kajur`
  ADD PRIMARY KEY (`id_kajur`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `id_doswal_fk` (`id_doswal`),
  ADD KEY `id_kajur_fk` (`id_kajur`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `tb_verifikasi`
--
ALTER TABLE `tb_verifikasi`
  ADD PRIMARY KEY (`id_verifikasi`),
  ADD KEY `id_pengajuan_fk_ver` (`id_pengajuan`),
  ADD KEY `id_pegawai_fk_ver` (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_doswal`
--
ALTER TABLE `tb_doswal`
  MODIFY `id_doswal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_hak_akses`
--
ALTER TABLE `tb_hak_akses`
  MODIFY `id_hak_akses` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_kajur`
--
ALTER TABLE `tb_kajur`
  MODIFY `id_kajur` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  MODIFY `id_mahasiswa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_pegawai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id_pengajuan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_verifikasi`
--
ALTER TABLE `tb_verifikasi`
  MODIFY `id_verifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_doswal`
--
ALTER TABLE `tb_doswal`
  ADD CONSTRAINT `id_pegawai_fk_doswal` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_hak_akses`
--
ALTER TABLE `tb_hak_akses`
  ADD CONSTRAINT `id_jabatan_fk` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pegawai_fkhak` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kajur`
--
ALTER TABLE `tb_kajur`
  ADD CONSTRAINT `id_pegawai_fk_kajur` FOREIGN KEY (`id_kajur`) REFERENCES `tb_pegawai` (`id_pegawai`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD CONSTRAINT `id_doswal_fk` FOREIGN KEY (`id_doswal`) REFERENCES `tb_doswal` (`id_doswal`),
  ADD CONSTRAINT `id_kajur_fk` FOREIGN KEY (`id_kajur`) REFERENCES `tb_kajur` (`id_kajur`);

--
-- Constraints for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD CONSTRAINT `id_mahasiswa` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tb_mahasiswa` (`id_mahasiswa`);

--
-- Constraints for table `tb_verifikasi`
--
ALTER TABLE `tb_verifikasi`
  ADD CONSTRAINT `id_pegawai_fk_ver` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`),
  ADD CONSTRAINT `id_pengajuan_fk_ver` FOREIGN KEY (`id_pengajuan`) REFERENCES `tb_pengajuan` (`id_pengajuan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
