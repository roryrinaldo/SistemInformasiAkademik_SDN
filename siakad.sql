-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2023 at 06:26 PM
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
-- Database: `siakad`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `id_ta` varchar(5) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `id_wali_kelas` varchar(5) NOT NULL,
  `id_siswa` varchar(10) NOT NULL,
  `hadir` int(3) NOT NULL,
  `sakit` int(3) NOT NULL,
  `izin` int(3) NOT NULL,
  `alfa` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_kelas`, `id_ta`, `semester`, `id_wali_kelas`, `id_siswa`, `hadir`, `sakit`, `izin`, `alfa`) VALUES
(1, '1', '1', '1', '1', '2', 2, 0, 0, 0),
(2, '1', '1', '1', '1', '1', 1, 1, 0, 0),
(3, '1', '1', '1', '1', '3', 2, 0, 0, 0),
(4, '2', '2', '1', '2', '1', 2, 10, 0, 0),
(5, '2', '2', '1', '2', '2', 2, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(3) NOT NULL,
  `nama_admin` varchar(25) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(15) NOT NULL,
  `foto` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama_admin`, `username`, `password`, `level`, `foto`) VALUES
(7, 'Rory Rinaldo', 'admin', 'admin', 'Master', '');

-- --------------------------------------------------------

--
-- Table structure for table `data_absensi`
--

CREATE TABLE `data_absensi` (
  `id` int(11) NOT NULL,
  `id_walikelas` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_ta` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `ket` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_absensi`
--

INSERT INTO `data_absensi` (`id`, `id_walikelas`, `id_kelas`, `id_ta`, `semester`, `tanggal`, `id_siswa`, `ket`) VALUES
(1, 1, 1, 1, 1, '2023-07-26', 1, 'Hadir'),
(2, 1, 1, 1, 1, '2023-07-26', 2, 'Hadir'),
(3, 1, 1, 1, 1, '2023-07-26', 3, 'Hadir'),
(4, 1, 1, 1, 1, '2023-07-27', 1, 'Sakit'),
(5, 1, 1, 1, 1, '2023-07-27', 2, 'Hadir'),
(6, 1, 1, 1, 1, '2023-07-27', 3, 'Hadir'),
(7, 2, 2, 2, 1, '2023-07-26', 1, 'Hadir'),
(8, 2, 2, 2, 1, '2023-07-26', 2, 'Sakit'),
(9, 2, 2, 2, 1, '2023-07-26', 3, 'Hadir'),
(10, 1, 1, 2, 1, '2023-08-19', 4, 'Hadir'),
(11, 1, 1, 2, 1, '2023-08-20', 4, 'Hadir'),
(12, 1, 1, 2, 1, '2023-08-20', 5, 'Sakit'),
(13, 2, 2, 2, 1, '2023-08-19', 1, 'Hadir'),
(14, 2, 2, 2, 1, '2023-08-19', 2, 'Hadir'),
(15, 2, 2, 2, 1, '2023-08-19', 3, 'Hadir');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(25) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `tmpl` varchar(25) NOT NULL,
  `tgll` date NOT NULL,
  `nip` varchar(25) NOT NULL,
  `gol` varchar(25) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `tmt` date NOT NULL,
  `mulai_masuk` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `ijazah_tahun` varchar(25) NOT NULL,
  `foto` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `jk`, `tmpl`, `tgll`, `nip`, `gol`, `jabatan`, `tmt`, `mulai_masuk`, `alamat`, `nohp`, `ijazah_tahun`, `foto`) VALUES
(1, 'H. Sambah, S.Pd', 'L', 'Salo', '1966-10-11', '19661011 199602 1 001', 'Kepala Sekolah', 'PEMBINA IV/A', '2019-04-01', '', '', '', '2009', ''),
(2, 'Parmidi, S.Pd.SD', 'L', 'Teluk Meranti', '1960-10-13', '19601013 198210 1 001', 'Guru', 'PEMBINA IV/A', '1990-03-29', '', '', '', '2013', ''),
(3, 'Nurima, S.Pd.SD', 'P', 'Tembilahan', '1961-12-04', '19611204 198410 2 002', 'Guru', 'PEMBINA IV/A', '1984-10-01', '', '', '', '', ''),
(4, 'Hasmah, S.Pd.SD', 'L', 'PP. Rumbio', '1965-05-11', '19650511 198803 2 001', 'Guru', 'PEMBINA IV/A', '1991-12-01', '', '', '', '2010', '');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(3) NOT NULL,
  `nama_kelas` varchar(25) NOT NULL,
  `tingkat` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `tingkat`) VALUES
(1, '1A', '1'),
(2, '2A', '2'),
(3, '3A', '3'),
(4, '4A', '4'),
(5, '5A', '5'),
(6, '6A', '6');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id_ks` int(11) NOT NULL,
  `id_siswa` varchar(10) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `id_wali_kelas` varchar(5) NOT NULL,
  `id_ta` varchar(5) NOT NULL,
  `id_next_kelas` varchar(5) NOT NULL,
  `id_ta_next` varchar(5) NOT NULL,
  `status_ks` varchar(15) NOT NULL,
  `catatan_wali_kelas_semester_1` text NOT NULL,
  `catatan_wali_kelas_semester_2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id_ks`, `id_siswa`, `id_kelas`, `id_wali_kelas`, `id_ta`, `id_next_kelas`, `id_ta_next`, `status_ks`, `catatan_wali_kelas_semester_1`, `catatan_wali_kelas_semester_2`) VALUES
(1, '1', '1', '1', '1', '2', '2', 'Lanjut', '', ''),
(2, '2', '1', '1', '1', '2', '2', 'Lanjut', '', ''),
(3, '3', '1', '1', '1', '2', '2', 'Lanjut', '', ''),
(4, '1', '2', '2', '2', '', '', 'Aktif', 'Tidak naik kelas', ''),
(5, '2', '2', '2', '2', '', '', 'Aktif', '', ''),
(6, '3', '2', '2', '2', '', '', 'Aktif', '', ''),
(7, '4', '1', '1', '2', '', '', 'Aktif', '', ''),
(8, '5', '1', '1', '2', '', '', 'Aktif', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(4) NOT NULL,
  `tingkat` varchar(5) NOT NULL,
  `nama_mapel` text NOT NULL,
  `kkm` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `tingkat`, `nama_mapel`, `kkm`) VALUES
(1, '1', 'Pendidikan Agama Islam dan Budi Pekerti', 70),
(2, '1', 'Pendidikan Kewarganegaraan', 70),
(3, '1', 'Bahasa Indonesia', 70),
(4, '1', 'Matematika', 70),
(5, '1', 'Ilmu Pengetahuan Alam', 70),
(6, '1', 'Ilmu Pengetahuan Sosial', 70),
(10, '2', 'Bahasa Indonesia', 70),
(11, '2', 'Agama', 70);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `id_ta` varchar(5) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `id_wali_kelas` varchar(5) NOT NULL,
  `id_mapel` varchar(5) NOT NULL,
  `id_siswa` varchar(10) NOT NULL,
  `nilai` int(3) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_kelas`, `id_ta`, `semester`, `id_wali_kelas`, `id_mapel`, `id_siswa`, `nilai`, `deskripsi`) VALUES
(1, '2', '2    ', '1', '2    ', '10', '1      ', 80, 'asdas'),
(2, '2', '2    ', '1', '2    ', '11', '1      ', 60, 'asdsad');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `nama_pengumuman` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_input` date NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `nama_pengumuman`, `keterangan`, `tgl_input`, `file`) VALUES
(1, 'Libur', '<p>Libur pada tanggal <strong>33 Februari 2023</strong></p>\r\n', '2023-07-26', '');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(150) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `nisn` varchar(120) NOT NULL,
  `tmpl` varchar(25) NOT NULL,
  `tgll` date NOT NULL,
  `jk` varchar(1) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `pendidikan_sebelumnya` varchar(25) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `nama_ayah` varchar(25) NOT NULL,
  `nama_ibu` varchar(25) NOT NULL,
  `kerja_ayah` varchar(25) NOT NULL,
  `kerja_ibu` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `foto` text NOT NULL,
  `status_siswa` varchar(25) NOT NULL,
  `daftar_via` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `kelas_awal` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `nis`, `nisn`, `tmpl`, `tgll`, `jk`, `agama`, `pendidikan_sebelumnya`, `alamat`, `no_telp`, `nama_ayah`, `nama_ibu`, `kerja_ayah`, `kerja_ibu`, `password`, `foto`, `status_siswa`, `daftar_via`, `keterangan`, `kelas_awal`) VALUES
(1, 'AGUS RIZAL', '001', '', 'Desa Kampar', '2000-01-01', 'L', 'Islam', 'TK Kampar', 'Jl. Batu', '0788888888', 'Suherman', 'Mirna', 'Karyawan BUMN', 'IRT', '123', '230726013551siswa.JPG', 'Aktif', 'Offline', '', '2'),
(2, 'ALDI ZAHRI', '002', '', 'Desa Kampar', '1999-01-01', 'L', 'Islam', 'TK Kampar', 'Jl. Durian', '282629595', 'Heri', 'Mirna', 'Pedagang', 'Pedagang', '123', '230726014137siswa.JPG', 'Aktif', 'Offline', '', '2'),
(3, 'ALRESKI ALES SAPURA', '003', '', 'Desa Gunung', '1999-01-01', 'L', 'Islam', 'TK Kampar', 'Jln. Ahmad Yani', '65959656', 'Eddy', 'Ziyi', 'Karyawan BUMN', 'Guru', '123', '230726014346siswa.JPG', 'Aktif', 'Offline', '', '2'),
(4, 'Ahmad Pedian', '006', '', 'Desa Kampar', '2000-01-01', 'L', 'Islam', 'TK Kampar', 'Jl. Durian', '082255225522', 'Ali', 'Heni', 'Guru', 'Guru', '123', '230726101554siswa.JPG', 'Aktif', 'Offline', '', '2'),
(5, 'Putr', '007', '', 'Umban Sari', '1999-08-17', 'L', 'Islam', 'TK Umban Sari', 'Jln. Umban Sari', '082323322332', 'Budi', 'Elli', 'Pedagang', 'Pedagang', '123', '230817094637wallpaperflare.com_wallpaper (2).jpg', 'Aktif', 'Offline', '', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `no` int(11) NOT NULL,
  `id_ta` varchar(5) NOT NULL,
  `nama_ta` varchar(25) NOT NULL,
  `semester` int(2) NOT NULL,
  `status_ta` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`no`, `id_ta`, `nama_ta`, `semester`, `status_ta`) VALUES
(1, '1', '2023', 1, 'Selesai'),
(2, '1', '2023', 2, 'Selesai'),
(3, '2', '2024', 1, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `wali_kelas`
--

CREATE TABLE `wali_kelas` (
  `id_walikelas` int(11) NOT NULL,
  `id_guru` varchar(5) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `status_wali_kelas` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wali_kelas`
--

INSERT INTO `wali_kelas` (`id_walikelas`, `id_guru`, `id_kelas`, `username`, `password`, `status_wali_kelas`) VALUES
(1, '2', '1', '19601013 198210 1 001', '123', '1'),
(2, '3', '2', '19611204 198410 2 002', '123', '1'),
(3, '4', '3', '19650511 198803 2 001', '123', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_absensi`
--
ALTER TABLE `data_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id_ks`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD PRIMARY KEY (`id_walikelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_absensi`
--
ALTER TABLE `data_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id_ks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  MODIFY `id_walikelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
