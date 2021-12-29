-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2021 at 05:26 AM
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
-- Database: `sistem_cuti`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id_bayar` int(11) NOT NULL,
  `nim` char(10) NOT NULL,
  `ukt_smt` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bukti` varchar(100) NOT NULL,
  `validasi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bayar`
--

INSERT INTO `tb_bayar` (`id_bayar`, `nim`, `ukt_smt`, `jumlah`, `tgl_bayar`, `bukti`, `validasi`) VALUES
(6, '190102031', 3, 2500000, '2021-11-15', 'bukti_61920f265f727190102031.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_doswal`
--

CREATE TABLE `tb_doswal` (
  `id_doswal` int(11) NOT NULL,
  `nip_npak` char(20) NOT NULL,
  `thn_jabatan` varchar(9) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_doswal`
--

INSERT INTO `tb_doswal` (`id_doswal`, `nip_npak`, `thn_jabatan`, `status`) VALUES
(3, '098776', '2019-2022', 'Aktif'),
(4, '4556', '2019-2022', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kajur`
--

CREATE TABLE `tb_kajur` (
  `id_kajur` int(11) NOT NULL,
  `nip_npak` char(20) NOT NULL,
  `nm_jurusan` varchar(50) NOT NULL,
  `thn_jabatan` varchar(9) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kajur`
--

INSERT INTO `tb_kajur` (`id_kajur`, `nip_npak`, `nm_jurusan`, `thn_jabatan`, `status`) VALUES
(1, '170203041', 'Teknik Elektronika', '2019-2022', 'Aktif'),
(4, '098776', 'Teknik Informatika', '2019-2022', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `nim` char(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_doswal` int(11) NOT NULL,
  `id_kajur` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `thn_angkatan` char(4) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `tempat_lhr` varchar(25) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `jk` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` char(13) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `ttd` varchar(100) DEFAULT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`nim`, `email`, `id_doswal`, `id_kajur`, `username`, `password`, `nama`, `thn_angkatan`, `kelas`, `tempat_lhr`, `tgl_lhr`, `jk`, `alamat`, `no_telp`, `foto`, `ttd`, `token`) VALUES
('190102024', '', 3, 4, 'Ara', 'ara', 'Ara S', '2019', 'A', 'Kebumen', '2021-09-01', 'Perempuan', 'Bulus Pesantren, Kebumen', '234345094895', 'foto_618236be6898bAra S.png', 'ttd_Ara S.jpeg', '0'),
('190102025', '', 4, 1, 'Zakiyah', 'zakiyah', 'Zakiyah', '2019', 'C', 'Cilacap', '2021-11-18', 'Perempuan', 'sd', '878', NULL, NULL, '0'),
('190102031', 'adieron97@gmail.com', 4, 1, 'Ulfa', 'ulfa', 'Ulfatun Nasikhah', '2019', 'C', 'Banyumas', '2001-06-29', 'Perempuan', 'Jl. Jatisari RT 03 RW 03 Ketanda, Kec. Sumpiuh, Kab. Banyumas', '081390185120', 'foto_617bcea879d9dUlfatun Nasikhah.jpg', 'ttd_Ulfatun Nasikhah.jpeg', '990a1aeb1f5630064e5308716c308583'),
('190302098', '', 4, 1, 'Ummu', 'ummu', 'Ummu Habibah', '2019', 'C', 'Cilacap', '2011-11-09', 'Perempuan', 'Jl. Wungu', '083374348', 'foto_6188e2110d5d3Ummu Habibah.png', 'ttd_61c537419ce64Ummu Habibah.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `nip_npak` char(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `thn_jabatan` varchar(9) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `no_telp` char(13) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `ttd` varchar(100) DEFAULT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`nip_npak`, `email`, `username`, `password`, `nama`, `jabatan`, `thn_jabatan`, `status`, `no_telp`, `foto`, `ttd`, `token`) VALUES
('092334445', '', 'Uang', 'uang', 'Keuangan', 'Bagian Keuangan', '2019-2022', 'Aktif', '123454', 'foto_Keuangan.jpg', 'ttd_Keuangan.jpg', '0'),
('098776', '', 'dua', 'dua', 'dua', 'Dosen Wali dan Ketua Jurusan', '2019-2022', 'Aktif', '345', 'foto_617ba762dd538dua.png', '', '0'),
('12343445', '', 'Cek', 'cek', 'Cek', 'Ketua Jurusan', '2019-2022', 'Aktif', '1283347', '', '', '0'),
('170203041', '', 'Ardana', 'ardana', 'Ardana', 'Ketua Jurusan', '2019-2022', 'Aktif', '085846981234', '', 'ttd_Ardana.png', '0'),
('180203041', '', 'Fadhilah', 'doswal', 'Fadhilah', 'Dosen Wali', '2019-2022', 'Tidak Aktif', '085846980987', NULL, NULL, '0'),
('18101920234', '', 'Aka', 'aka', 'Akademik', 'Ketua Akademik', '2019-2022', 'Aktif', '3435455', 'foto_Akademik.jpg', '', '0'),
('345', 'ulfatunnasikhah49@gmail.com', 'Erry', 'erry', 'Erry', 'Administrator', '2019-2022', 'Aktif', '5657', 'foto_6177931ece819Erry.png', 'ttd_6177944072943Erry.png', '257d7adc91a97123f27e80f734196918'),
('34555667', '', 'Coba', 'coba', 'Coba', 'Wakil Direktur 1', '2019-2022', 'Aktif', '873453', '', 'ttd_Coba.jpg', '0'),
('4556', '', 'a', 'a', 'aaaa', 'Dosen Wali', '2021-2022', 'Aktif', '345', 'foto_aaaa.jpg', '', '0'),
('4565776576879', '', 'werrtrtyt', 'wertrtty', 'wertrytytyy', 'Dosen Wali', '2019-2022', 'Aktif', '34545', '', '', '0'),
('55676', '', 'lk', 'fgfg', 'Ini Coba', 'Dosen Wali', '2019-2022', 'Aktif', '44545', '', '', '0'),
('56767', '', 'jelek', 'jelek', 'Jelek', 'Dosen Wali dan Ketua Jurusan', '2019-2022', 'Aktif', '54', '', '', '0'),
('5677878', '', 'Anni', 'anni', 'Anni Lestari', 'Bagian Keuangan', '2019-2022', 'Aktif', '4565', '', '', '0'),
('67687854', '', 'Aim', 'aim', 'Aimatuz Z', 'Bagian Perpustakaan', '2019-2022', 'Aktif', '6868', 'foto_Aimatuz Z.jpg', '', '0'),
('78564', '', 'sdfdg', 'asdff', 'Danang', 'Dosen Wali', '2019-2022', 'Aktif', '34', NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `nim` char(10) NOT NULL,
  `jns_pengajuan` enum('Cuti','Izin Aktif') NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `semester_cuti` int(1) NOT NULL,
  `tingkat` int(1) NOT NULL,
  `thn_akademik` varchar(9) NOT NULL,
  `nm_prodi` varchar(50) NOT NULL,
  `alasan` varchar(200) DEFAULT NULL,
  `lampiran` varchar(100) NOT NULL,
  `ttd_ortu` varchar(100) NOT NULL,
  `nama_ortu` varchar(50) NOT NULL,
  `status` enum('1','2','3','4','5') DEFAULT NULL,
  `no_sk` varchar(30) DEFAULT NULL,
  `tgl_sk` date DEFAULT NULL,
  `upload_sk` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id_pengajuan`, `nim`, `jns_pengajuan`, `tgl_pengajuan`, `semester_cuti`, `tingkat`, `thn_akademik`, `nm_prodi`, `alasan`, `lampiran`, `ttd_ortu`, `nama_ortu`, `status`, `no_sk`, `tgl_sk`, `upload_sk`) VALUES
(58, '190102031', 'Cuti', '2021-11-08', 3, 2, '2021/2022', 'Teknik Listrik', 'ghdfdf', 'lampiran_cuti6188d61d09c06190102031.pdf', 'ortu_cuti61b2b18fcbf0e190102031.png', 'Rohmah', '', NULL, '0000-00-00', NULL),
(62, '190102024', 'Cuti', '2021-11-10', 2, 1, '2021/2022', 'Teknik Elektronika', 'afsdf', 'lampiran_cuti618b443d5c4d6190102024.pdf', 'ortu_cuti618b443d4cdee190102024.png', 'sdsds', '', NULL, NULL, NULL),
(72, '190302098', 'Cuti', '2021-12-24', 4, 2, '2022/2023', 'Teknik Mesin', 'Daftar Polwan', 'lampiran_cuti61c5377d44d1d190302098.pdf', 'ortu_cuti61c5377d446ac190302098.png', 'Apakah', '', NULL, NULL, NULL),
(73, '190302098', 'Izin Aktif', '2021-12-27', 4, 2, '2022/2023', 'Teknik Mesin', NULL, 'lampiran_aktif61c914b609a3e190302098.pdf', 'ortu_aktif61c914b60927d190302098.png', 'Apakah', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_verifikasi`
--

CREATE TABLE `tb_verifikasi` (
  `id_verifikasi` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `nip_npak` char(20) DEFAULT NULL,
  `tgl_verif` date NOT NULL,
  `status` enum('Diterima','Ditolak') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bayar`
-- (See below for the actual view)
--
CREATE TABLE `v_bayar` (
`nim` char(10)
,`nama` varchar(50)
,`ukt_smt` int(11)
,`jumlah` int(11)
,`tgl_bayar` date
,`validasi` varchar(8)
,`bukti` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_data_doswal`
-- (See below for the actual view)
--
CREATE TABLE `v_data_doswal` (
`id_doswal` int(11)
,`nip_npak` char(20)
,`nama` varchar(50)
,`thn_jabatan` varchar(9)
,`status` enum('Aktif','Tidak Aktif')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_data_kajur`
-- (See below for the actual view)
--
CREATE TABLE `v_data_kajur` (
`id_kajur` int(11)
,`nip_npak` char(20)
,`nama` varchar(50)
,`thn_jabatan` varchar(9)
,`status` enum('Aktif','Tidak Aktif')
,`nm_jurusan` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_data_pegawai`
-- (See below for the actual view)
--
CREATE TABLE `v_data_pegawai` (
`nip_npak` char(20)
,`username` varchar(15)
,`password` varchar(15)
,`nama` varchar(50)
,`jabatan` varchar(50)
,`thn_jabatan` varchar(9)
,`status` enum('Aktif','Tidak Aktif')
,`no_telp` char(13)
,`foto` varchar(100)
,`ttd` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_dpengajuan`
-- (See below for the actual view)
--
CREATE TABLE `v_dpengajuan` (
`nim` char(10)
,`nama` varchar(50)
,`id_pengajuan` int(11)
,`jns_pengajuan` enum('Cuti','Izin Aktif')
,`tgl_pengajuan` date
,`semester_cuti` int(1)
,`thn_akademik` varchar(9)
,`alasan` varchar(200)
,`status` enum('1','2','3','4','5')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_laporan`
-- (See below for the actual view)
--
CREATE TABLE `v_laporan` (
`nim` char(10)
,`nama` varchar(50)
,`jk` varchar(10)
,`thn_angkatan` char(4)
,`nm_prodi` varchar(50)
,`no_sk` varchar(30)
,`tgl_sk` date
,`thn_akademik` varchar(9)
,`jns_pengajuan` enum('Cuti','Izin Aktif')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pengajuan`
-- (See below for the actual view)
--
CREATE TABLE `v_pengajuan` (
`nim` char(10)
,`nama` varchar(50)
,`id_pengajuan` int(11)
,`jns_pengajuan` enum('Cuti','Izin Aktif')
,`tgl_pengajuan` date
,`semester_cuti` int(1)
,`thn_akademik` varchar(9)
,`alasan` varchar(200)
,`status` enum('1','2','3','4','5')
,`lampiran` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pengajuan_kp`
-- (See below for the actual view)
--
CREATE TABLE `v_pengajuan_kp` (
`nim` char(10)
,`nama` varchar(50)
,`jns_pengajuan` enum('Cuti','Izin Aktif')
,`tgl_pengajuan` date
,`semester_cuti` int(1)
,`thn_akademik` varchar(9)
,`upload_sk` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tampil_doswal`
-- (See below for the actual view)
--
CREATE TABLE `v_tampil_doswal` (
`nip_npak` char(20)
,`username` varchar(15)
,`password` varchar(15)
,`nama` varchar(50)
,`jabatan` varchar(50)
,`thn_jabatan` varchar(9)
,`status` enum('Aktif','Tidak Aktif')
,`no_telp` char(13)
,`foto` varchar(100)
,`ttd` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tampil_kajur`
-- (See below for the actual view)
--
CREATE TABLE `v_tampil_kajur` (
`nip_npak` char(20)
,`username` varchar(15)
,`password` varchar(15)
,`nama` varchar(50)
,`jabatan` varchar(50)
,`thn_jabatan` varchar(9)
,`status` enum('Aktif','Tidak Aktif')
,`no_telp` char(13)
,`foto` varchar(100)
,`ttd` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_wdpengajuan`
-- (See below for the actual view)
--
CREATE TABLE `v_wdpengajuan` (
`nim` char(10)
,`nama` varchar(50)
,`id_pengajuan` int(11)
,`jns_pengajuan` enum('Cuti','Izin Aktif')
,`tgl_pengajuan` date
,`semester_cuti` int(1)
,`thn_akademik` varchar(9)
,`alasan` varchar(200)
,`status` enum('1','2','3','4','5')
);

-- --------------------------------------------------------

--
-- Structure for view `v_bayar`
--
DROP TABLE IF EXISTS `v_bayar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bayar`  AS SELECT `m`.`nim` AS `nim`, `m`.`nama` AS `nama`, `b`.`ukt_smt` AS `ukt_smt`, `b`.`jumlah` AS `jumlah`, `b`.`tgl_bayar` AS `tgl_bayar`, `b`.`validasi` AS `validasi`, `b`.`bukti` AS `bukti` FROM (`tb_mahasiswa` `m` join `tb_bayar` `b`) WHERE `m`.`nim` = `b`.`nim` ORDER BY `b`.`tgl_bayar` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_data_doswal`
--
DROP TABLE IF EXISTS `v_data_doswal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_data_doswal`  AS SELECT `d`.`id_doswal` AS `id_doswal`, `p`.`nip_npak` AS `nip_npak`, `p`.`nama` AS `nama`, `d`.`thn_jabatan` AS `thn_jabatan`, `d`.`status` AS `status` FROM (`tb_doswal` `d` join `tb_pegawai` `p`) WHERE `d`.`nip_npak` = `p`.`nip_npak` ORDER BY `p`.`nama` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_data_kajur`
--
DROP TABLE IF EXISTS `v_data_kajur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_data_kajur`  AS SELECT `k`.`id_kajur` AS `id_kajur`, `p`.`nip_npak` AS `nip_npak`, `p`.`nama` AS `nama`, `k`.`thn_jabatan` AS `thn_jabatan`, `k`.`status` AS `status`, `k`.`nm_jurusan` AS `nm_jurusan` FROM (`tb_kajur` `k` join `tb_pegawai` `p`) WHERE `k`.`nip_npak` = `p`.`nip_npak` ORDER BY `p`.`nama` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_data_pegawai`
--
DROP TABLE IF EXISTS `v_data_pegawai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_data_pegawai`  AS SELECT `tb_pegawai`.`nip_npak` AS `nip_npak`, `tb_pegawai`.`username` AS `username`, `tb_pegawai`.`password` AS `password`, `tb_pegawai`.`nama` AS `nama`, `tb_pegawai`.`jabatan` AS `jabatan`, `tb_pegawai`.`thn_jabatan` AS `thn_jabatan`, `tb_pegawai`.`status` AS `status`, `tb_pegawai`.`no_telp` AS `no_telp`, `tb_pegawai`.`foto` AS `foto`, `tb_pegawai`.`ttd` AS `ttd` FROM `tb_pegawai` ORDER BY `tb_pegawai`.`nama` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_dpengajuan`
--
DROP TABLE IF EXISTS `v_dpengajuan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dpengajuan`  AS SELECT `tb_mahasiswa`.`nim` AS `nim`, `tb_mahasiswa`.`nama` AS `nama`, `tb_pengajuan`.`id_pengajuan` AS `id_pengajuan`, `tb_pengajuan`.`jns_pengajuan` AS `jns_pengajuan`, `tb_pengajuan`.`tgl_pengajuan` AS `tgl_pengajuan`, `tb_pengajuan`.`semester_cuti` AS `semester_cuti`, `tb_pengajuan`.`thn_akademik` AS `thn_akademik`, `tb_pengajuan`.`alasan` AS `alasan`, `tb_pengajuan`.`status` AS `status` FROM ((`tb_mahasiswa` join `tb_pengajuan`) join `tb_doswal`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_laporan`
--
DROP TABLE IF EXISTS `v_laporan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan`  AS SELECT `m`.`nim` AS `nim`, `m`.`nama` AS `nama`, `m`.`jk` AS `jk`, `m`.`thn_angkatan` AS `thn_angkatan`, `p`.`nm_prodi` AS `nm_prodi`, `p`.`no_sk` AS `no_sk`, `p`.`tgl_sk` AS `tgl_sk`, `p`.`thn_akademik` AS `thn_akademik`, `p`.`jns_pengajuan` AS `jns_pengajuan` FROM ((`tb_mahasiswa` `m` join `tb_kajur` `k`) join `tb_pengajuan` `p`) WHERE `m`.`nim` = `p`.`nim` AND `m`.`id_kajur` = `k`.`id_kajur` AND `p`.`status` = '4' ORDER BY `m`.`nama` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_pengajuan`
--
DROP TABLE IF EXISTS `v_pengajuan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengajuan`  AS SELECT `m`.`nim` AS `nim`, `m`.`nama` AS `nama`, `p`.`id_pengajuan` AS `id_pengajuan`, `p`.`jns_pengajuan` AS `jns_pengajuan`, `p`.`tgl_pengajuan` AS `tgl_pengajuan`, `p`.`semester_cuti` AS `semester_cuti`, `p`.`thn_akademik` AS `thn_akademik`, `p`.`alasan` AS `alasan`, `p`.`status` AS `status`, `p`.`lampiran` AS `lampiran` FROM (`tb_mahasiswa` `m` join `tb_pengajuan` `p`) WHERE `m`.`nim` = `p`.`nim` ORDER BY `p`.`tgl_pengajuan` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_pengajuan_kp`
--
DROP TABLE IF EXISTS `v_pengajuan_kp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengajuan_kp`  AS SELECT `m`.`nim` AS `nim`, `m`.`nama` AS `nama`, `p`.`jns_pengajuan` AS `jns_pengajuan`, `p`.`tgl_pengajuan` AS `tgl_pengajuan`, `p`.`semester_cuti` AS `semester_cuti`, `p`.`thn_akademik` AS `thn_akademik`, `p`.`upload_sk` AS `upload_sk` FROM (`tb_mahasiswa` `m` join `tb_pengajuan` `p`) WHERE `m`.`nim` = `p`.`nim` AND `p`.`status` = '4' ORDER BY `p`.`tgl_pengajuan` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_tampil_doswal`
--
DROP TABLE IF EXISTS `v_tampil_doswal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tampil_doswal`  AS SELECT `tb_pegawai`.`nip_npak` AS `nip_npak`, `tb_pegawai`.`username` AS `username`, `tb_pegawai`.`password` AS `password`, `tb_pegawai`.`nama` AS `nama`, `tb_pegawai`.`jabatan` AS `jabatan`, `tb_pegawai`.`thn_jabatan` AS `thn_jabatan`, `tb_pegawai`.`status` AS `status`, `tb_pegawai`.`no_telp` AS `no_telp`, `tb_pegawai`.`foto` AS `foto`, `tb_pegawai`.`ttd` AS `ttd` FROM `tb_pegawai` WHERE (`tb_pegawai`.`jabatan` = 'Dosen Wali' OR `tb_pegawai`.`jabatan` = 'Dosen Wali dan Ketua Jurusan') AND `tb_pegawai`.`status` = 'Aktif' ;

-- --------------------------------------------------------

--
-- Structure for view `v_tampil_kajur`
--
DROP TABLE IF EXISTS `v_tampil_kajur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tampil_kajur`  AS SELECT `tb_pegawai`.`nip_npak` AS `nip_npak`, `tb_pegawai`.`username` AS `username`, `tb_pegawai`.`password` AS `password`, `tb_pegawai`.`nama` AS `nama`, `tb_pegawai`.`jabatan` AS `jabatan`, `tb_pegawai`.`thn_jabatan` AS `thn_jabatan`, `tb_pegawai`.`status` AS `status`, `tb_pegawai`.`no_telp` AS `no_telp`, `tb_pegawai`.`foto` AS `foto`, `tb_pegawai`.`ttd` AS `ttd` FROM `tb_pegawai` WHERE (`tb_pegawai`.`jabatan` = 'Ketua Jurusan' OR `tb_pegawai`.`jabatan` = 'Dosen Wali dan Ketua Jurusan') AND `tb_pegawai`.`status` = 'Aktif' ;

-- --------------------------------------------------------

--
-- Structure for view `v_wdpengajuan`
--
DROP TABLE IF EXISTS `v_wdpengajuan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_wdpengajuan`  AS SELECT `m`.`nim` AS `nim`, `m`.`nama` AS `nama`, `p`.`id_pengajuan` AS `id_pengajuan`, `p`.`jns_pengajuan` AS `jns_pengajuan`, `p`.`tgl_pengajuan` AS `tgl_pengajuan`, `p`.`semester_cuti` AS `semester_cuti`, `p`.`thn_akademik` AS `thn_akademik`, `p`.`alasan` AS `alasan`, `p`.`status` AS `status` FROM (`tb_mahasiswa` `m` join `tb_pengajuan` `p`) WHERE `m`.`nim` = `p`.`nim` AND `p`.`jns_pengajuan` = 'Izin Aktif' ORDER BY `p`.`tgl_pengajuan` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `nim_bayar_fk` (`nim`);

--
-- Indexes for table `tb_doswal`
--
ALTER TABLE `tb_doswal`
  ADD PRIMARY KEY (`id_doswal`),
  ADD KEY `nip_npak_fk` (`nip_npak`);

--
-- Indexes for table `tb_kajur`
--
ALTER TABLE `tb_kajur`
  ADD PRIMARY KEY (`id_kajur`),
  ADD KEY `nip_fk` (`nip_npak`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_doswal_fk` (`id_doswal`),
  ADD KEY `id_kajur_fk` (`id_kajur`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`nip_npak`);

--
-- Indexes for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `nim_fk` (`nim`);

--
-- Indexes for table `tb_verifikasi`
--
ALTER TABLE `tb_verifikasi`
  ADD PRIMARY KEY (`id_verifikasi`),
  ADD KEY `id_pengajuan_fk` (`id_pengajuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_doswal`
--
ALTER TABLE `tb_doswal`
  MODIFY `id_doswal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kajur`
--
ALTER TABLE `tb_kajur`
  MODIFY `id_kajur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tb_verifikasi`
--
ALTER TABLE `tb_verifikasi`
  MODIFY `id_verifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD CONSTRAINT `nim_bayar_fk` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`);

--
-- Constraints for table `tb_doswal`
--
ALTER TABLE `tb_doswal`
  ADD CONSTRAINT `nip_npak_fk` FOREIGN KEY (`nip_npak`) REFERENCES `tb_pegawai` (`nip_npak`);

--
-- Constraints for table `tb_kajur`
--
ALTER TABLE `tb_kajur`
  ADD CONSTRAINT `nip_fk` FOREIGN KEY (`nip_npak`) REFERENCES `tb_pegawai` (`nip_npak`);

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
  ADD CONSTRAINT `nim_fk` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`);

--
-- Constraints for table `tb_verifikasi`
--
ALTER TABLE `tb_verifikasi`
  ADD CONSTRAINT `id_pengajuan_fk` FOREIGN KEY (`id_pengajuan`) REFERENCES `tb_pengajuan` (`id_pengajuan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
