-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2014 at 05:49 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stikiproj`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cekdosen`(IN `TGLx` DATE, IN `IDDOSENx` TINYINT)
BEGIN
	SELECT 
		IDDOSEN,
		TGL,
		HARI,
		STTHDR,
		KET
	FROM
		absensidosen
	WHERE
		TGL=TGLx and IDDOSEN=IDDOSENx;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dosenpengajar`(IN `harix` VARCHAR(10), IN `tglx` datE)
BEGIN
	SELECT DISTINCT
	   a.IDDOSEN,
	   a.DOSEN,
		o.TGL,
		o.JAM1,
		o.JAM2,
		o.STTHDR,
		o.KET
	FROM
		dp as a
   		left outer join absensidosen as o on a.IDDOSEN = o.IDDOSEN
	WHERE
		a.HARI=harix and o.TGL=tglx;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ishdrdosen`(IN `tglx` DATE, IN `iddosenx` TINYINT)
BEGIN
	SELECT
		absensidosen.IDDOSEN,
		absensidosen.JAM1,
		absensidosen.JAM2,
		absensidosen.TGL
	FROM
		absensidosen
	WHERE
		absensidosen.tgl = tglx and absensidosen.IDDOSEN=iddosenx;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ruangkelas_list`(IN `GR` VARCHAR(10))
BEGIN
	SELECT * FROM ruangkelas WHERE ruang like concat(GR,'%');
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `absensidosen`
--

CREATE TABLE IF NOT EXISTS `absensidosen` (
`idaksesndosen` int(10) NOT NULL,
  `IDDOSEN` tinyint(10) DEFAULT '0',
  `TGL` date DEFAULT '2014-01-01',
  `JAM1` time DEFAULT '00:00:00',
  `JAM2` time DEFAULT '00:00:00',
  `HARI` varchar(10) DEFAULT 'Minggu',
  `STTHDR` enum('0','1','2') DEFAULT '0' COMMENT '0=Belum,1=Hadir,2=Tidak Hadir',
  `KET` varchar(255) DEFAULT '',
  `STTKLS` int(11) NOT NULL,
  `IDJADWAL` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `absensidosen`
--

INSERT INTO `absensidosen` (`idaksesndosen`, `IDDOSEN`, `TGL`, `JAM1`, `JAM2`, `HARI`, `STTHDR`, `KET`, `STTKLS`, `IDJADWAL`) VALUES
(11, 1, '2014-09-15', '00:00:00', '00:00:00', 'Senin', '0', '', 0, 1),
(12, 2, '2014-09-15', '00:00:00', '00:00:00', 'Senin', '0', '', 0, 2),
(13, 3, '2014-09-15', '00:00:00', '00:00:00', 'Senin', '0', '', 0, 3),
(14, 4, '2014-09-15', '00:00:00', '00:00:00', 'Senin', '0', '', 0, 4),
(15, 5, '2014-09-15', '00:00:00', '00:00:00', 'Senin', '0', '', 0, 5),
(16, 6, '2014-09-15', '00:00:00', '00:00:00', 'Senin', '0', '', 0, 7),
(17, 7, '2014-09-15', '00:00:00', '00:00:00', 'Senin', '0', '', 0, 8),
(18, 8, '2014-09-15', '00:00:00', '00:00:00', 'Senin', '0', '', 0, 10),
(19, 7, '2014-09-15', '00:00:00', '00:00:00', 'Senin', '0', '', 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
`IDDOSEN` tinyint(10) NOT NULL,
  `DOSEN` varchar(50) DEFAULT '',
  `NIDN` varchar(10) DEFAULT ''
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`IDDOSEN`, `DOSEN`, `NIDN`) VALUES
(1, 'Ni Luh PT. Trisnawati, M. Si', ''),
(2, 'Agus Aan Jiwa Permana, MCs', '1231'),
(3, 'I Nengah Artawan, M.Si', ''),
(4, 'Sri Widiastutik, M.Hum', ''),
(5, 'Bagus Kusuma Wijaya, SE, MBA', ''),
(6, 'GD AditraPradnyana, M.Kom', ''),
(7, 'Satria Pratama, ST', ''),
(8, 'AA Raka Wahyu Brahma, M.Hum', ''),
(9, 'PT. Imdah Ciptayani, M.Cs', ''),
(10, 'I G A Anom, SE', ''),
(11, 'I DW  NYM Ketha Sudhiatmika, MH', ''),
(12, 'Ni Wayn Ari Suryati, M.Pd', ''),
(13, 'I Made Suwitra, S.S.,m.Hum', ''),
(14, 'Ir. Windaryoto, M.Si', ''),
(15, 'Aniek Suryanti K.,M.Kom', ''),
(16, 'I MD GD Sri Artha, S.T', ''),
(17, 'I Gd Sujana Eka Putra, ST', ''),
(18, 'I Wayan Sudiarsa, M. Kom', ''),
(19, 'Gd Aditra Pradnyana, M.Kom', ''),
(20, 'I Gd Antha Kasmawan, M.Si', ''),
(21, 'I Putu Lokantara, M.T', ''),
(22, 'Ayu Manik Dirgayusari, M.MT', ''),
(23, 'I KM Wijayana, S.Kom', ''),
(24, 'I MD Harta Wijaya', ''),
(25, 'Ni kd Ayu Wirdiani, M.T', ''),
(26, 'I Dw Md Adi Baskara Joni, M.Kom', ''),
(27, 'Mirah Ayu Putri Tratrintya, MM', ''),
(28, 'Ni Nyoman Supuwiningsih, S.T', ''),
(29, 'Ni Wayan Sri Darmayanti, M.Pd', ''),
(30, 'Ir. Mahardika', ''),
(31, 'Drs. Komang Dewanta Pendit', ''),
(32, 'Mirah Ayu Putri T.,MM', ''),
(33, 'Ketut Laksmi Maswari, MM', ''),
(34, 'Gede Dana Paramitha, SE.,MM', ''),
(35, 'I Made Ardwi Pradnyana, M.T', ''),
(36, 'Agus Aan Jiwa Permana, MCs', ''),
(37, 'Nia Maharani, M.Si', ''),
(38, 'Ida Bagus Ary Indra Iswara, ', ''),
(39, 'Brigida Arie Minartiningtyas, M.Kom', ''),
(40, 'Eddy Indrayana, MT', ''),
(41, 'I Nyoman Rudy Hendrawan, M.Kom', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `dp`
--
CREATE TABLE IF NOT EXISTS `dp` (
`IDDOSEN` tinyint(4)
,`DOSEN` varchar(50)
,`TGL` date
,`JAM1` time
,`JAM2` time
,`hari` varchar(10)
);
-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
`IDJADWAL` int(10) NOT NULL,
  `HARI` varchar(10) DEFAULT '',
  `MULAIJAMKE` tinyint(4) DEFAULT '0',
  `BERAKHIRJAMKE` tinyint(4) DEFAULT '0',
  `RUANG` varchar(7) DEFAULT '',
  `IDMK` varchar(10) DEFAULT '',
  `KELAS` char(50) NOT NULL DEFAULT '0',
  `IDDOSEN` tinyint(4) DEFAULT NULL,
  `IDORDER` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`IDJADWAL`, `HARI`, `MULAIJAMKE`, `BERAKHIRJAMKE`, `RUANG`, `IDMK`, `KELAS`, `IDDOSEN`, `IDORDER`) VALUES
(1, 'SENIN', 1, 2, 'R.101', 'ID001', 'A', 1, 0),
(2, 'SENIN', 3, 5, 'R.101', 'ID002', 'C', 2, 0),
(3, 'SENIN', 8, 10, 'R.101', 'ID003', 'I', 3, 0),
(4, 'SENIN', 14, 15, 'R.101', 'ID004', 'B', 4, 0),
(5, 'SENIN', 18, 19, 'R.101', 'ID005', 'B', 5, 0),
(7, 'SENIN', 1, 3, 'R.102', 'ID006', 'B', 6, 0),
(8, 'SENIN', 10, 11, 'R.102', 'ID007', 'A', 7, 0),
(9, 'SENIN', 11, 13, 'R.103', 'ID008', 'F', 7, 0),
(10, 'SENIN', 14, 15, 'R.102', 'ID012', 'M', 8, 0),
(11, 'SABTU', 1, 2, 'R.101', 'ID013', 'B', 14, 0),
(12, 'SABTU', 3, 4, 'R.101', 'ID019', 'D', 20, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `jadwalview`
--
CREATE TABLE IF NOT EXISTS `jadwalview` (
`HARI` varchar(10)
,`MULAIJAMKE` tinyint(4)
,`BERAKHIRJAMKE` tinyint(4)
,`RUANG` varchar(7)
,`KELAS` char(50)
,`DOSEN` varchar(50)
,`MK` varchar(40)
,`SKS` tinyint(4)
);
-- --------------------------------------------------------

--
-- Table structure for table `jampertemuan`
--

CREATE TABLE IF NOT EXISTS `jampertemuan` (
  `JAMKE` tinyint(4) NOT NULL,
  `MULAI` time DEFAULT NULL,
  `BERAKHIR` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jampertemuan`
--

INSERT INTO `jampertemuan` (`JAMKE`, `MULAI`, `BERAKHIR`) VALUES
(1, '07:30:00', '08:15:00'),
(2, '08:15:00', '09:00:00'),
(3, '09:00:00', '09:45:00'),
(4, '09:45:00', '10:30:00'),
(5, '10:30:00', '11:15:00'),
(6, '11:15:00', '12:00:00'),
(7, '12:00:00', '12:45:00'),
(8, '12:45:00', '13:30:00'),
(9, '13:30:00', '14:15:00'),
(10, '14:15:00', '15:00:00'),
(11, '15:00:00', '15:45:00'),
(12, '15:45:00', '16:30:00'),
(13, '16:30:00', '17:15:00'),
(14, '17:30:00', '18:15:00'),
(15, '18:15:00', '19:00:00'),
(16, '19:00:00', '19:45:00'),
(17, '19:45:00', '20:30:00'),
(18, '20:30:00', '21:15:00'),
(19, '21:15:00', '22:00:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `list`
--
CREATE TABLE IF NOT EXISTS `list` (
`mulaijamke` tinyint(4)
,`berakhirjamke` tinyint(4)
,`ruang` varchar(7)
,`idmk` varchar(10)
,`matakuliah` varchar(40)
,`kelas` char(50)
,`iddosen` tinyint(4)
,`namadosen` varchar(50)
,`hari` varchar(10)
);
-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE IF NOT EXISTS `matakuliah` (
  `IDMK` varchar(10) NOT NULL DEFAULT '',
  `MK` varchar(40) DEFAULT NULL,
  `SKS` tinyint(4) DEFAULT '0',
  `JURUSAN` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`IDMK`, `MK`, `SKS`, `JURUSAN`) VALUES
('ID001', 'Kalkulus', 2, 'TI'),
('ID002', 'Sistem Operasi', 3, 'SK'),
('ID003', 'Matematika Diskrit', 3, ''),
('ID004', 'Bhs. Inggris II', 2, ''),
('ID005', 'Interpersonal Skill', 2, ''),
('ID006', 'Struktur Data', 3, ''),
('ID007', 'Pemrograman Web', 2, ''),
('ID008', 'Sistem Basis Data (SK)', 2, ''),
('ID009', 'Sistem Basis Data', 3, ''),
('ID010', 'Pengantar Tek. Infor', 2, ''),
('ID011', 'Bahasa Indonesia', 3, ''),
('ID012', 'Bhs. Inggris', 2, 'TI'),
('ID013', 'Metode Numerik', 2, ''),
('ID014', 'Analisa & Desain Sistem Informasi', 3, ''),
('ID015', 'Pemrograman Visual II', 2, ''),
('ID016', 'Manajemen Pemasaran ', 3, ''),
('ID017', 'Rangkaian Listrik', 3, ''),
('ID018', 'Sistem Informasi Manajemen', 3, ''),
('ID019', 'Kalkulus II', 3, ''),
('ID020', 'Pengantar Tek. Informasi', 2, ''),
('ID021', 'Arsitektur & Organisasi Komputer', 2, ''),
('ID022', 'Business Intelligence', 3, ''),
('ID023', 'Etika Profesi', 2, ''),
('ID024', 'Sensor & Transduser ', 3, ''),
('ID025', 'Seminar ', 3, ''),
('ID026', 'Kewirausahaan', 2, ''),
('ID027', 'Peng. Teknologi Informasi', 2, ''),
('ID028', 'Riset Teknologi Informasi', 3, ''),
('ID029', 'Jaringan Komputer', 3, ''),
('ID030', 'Artificial Intelegence', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`member_id` int(11) NOT NULL,
  `member_username` varchar(42) NOT NULL,
  `member_password` varchar(42) NOT NULL,
  `member_admin` int(11) NOT NULL DEFAULT '0',
  `member_email` varchar(128) NOT NULL,
  `member_forgot` varchar(128) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_username`, `member_password`, `member_admin`, `member_email`, `member_forgot`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'made@artha.web.id', ''),
(2, 'stiki', 'e64f7ad58961e855c5fcc4d4a576844e', 2, '', ''),
(4, 'coba', 'b446f051184329c31e4c546f0a22b7d7', 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ruangkelas`
--

CREATE TABLE IF NOT EXISTS `ruangkelas` (
`idruang` int(10) NOT NULL,
  `ruang` varchar(15) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `ruangkelas`
--

INSERT INTO `ruangkelas` (`idruang`, `ruang`) VALUES
(1, 'R.101'),
(2, 'R.102'),
(3, 'R.103'),
(4, 'R.104'),
(5, 'R.201'),
(6, 'R.202'),
(7, 'R.203'),
(8, 'R.204'),
(9, 'R.301'),
(10, 'R.302'),
(11, 'R.303'),
(12, 'R.304'),
(13, 'R.401'),
(14, 'R.402'),
(15, 'R.403'),
(16, 'R.404'),
(17, 'R.105'),
(18, 'LAB A'),
(19, 'LAB B'),
(20, 'LAB C'),
(21, 'LAB D'),
(22, 'LAB JARKOM'),
(23, 'LAB ROBOTIK');

-- --------------------------------------------------------

--
-- Structure for view `dp`
--
DROP TABLE IF EXISTS `dp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dp` AS select distinct `a`.`IDDOSEN` AS `IDDOSEN`,`d`.`DOSEN` AS `DOSEN`,`o`.`TGL` AS `TGL`,`o`.`JAM1` AS `JAM1`,`o`.`JAM2` AS `JAM2`,`o`.`HARI` AS `hari` from ((`jadwal` `a` join `dosen` `d` on((`a`.`IDDOSEN` = `d`.`IDDOSEN`))) left join `absensidosen` `o` on((`a`.`IDDOSEN` = `o`.`IDDOSEN`)));

-- --------------------------------------------------------

--
-- Structure for view `jadwalview`
--
DROP TABLE IF EXISTS `jadwalview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jadwalview` AS select `jadwal`.`HARI` AS `HARI`,`jadwal`.`MULAIJAMKE` AS `MULAIJAMKE`,`jadwal`.`BERAKHIRJAMKE` AS `BERAKHIRJAMKE`,`jadwal`.`RUANG` AS `RUANG`,`jadwal`.`KELAS` AS `KELAS`,`dosen`.`DOSEN` AS `DOSEN`,`matakuliah`.`MK` AS `MK`,`matakuliah`.`SKS` AS `SKS` from ((`jadwal` join `dosen` on((`jadwal`.`IDDOSEN` = `dosen`.`IDDOSEN`))) join `matakuliah` on((`jadwal`.`IDMK` = `matakuliah`.`IDMK`))) order by `jadwal`.`MULAIJAMKE`;

-- --------------------------------------------------------

--
-- Structure for view `list`
--
DROP TABLE IF EXISTS `list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list` AS select `jadwal`.`MULAIJAMKE` AS `mulaijamke`,`jadwal`.`BERAKHIRJAMKE` AS `berakhirjamke`,`jadwal`.`RUANG` AS `ruang`,`jadwal`.`IDMK` AS `idmk`,`matakuliah`.`MK` AS `matakuliah`,`jadwal`.`KELAS` AS `kelas`,`jadwal`.`IDDOSEN` AS `iddosen`,`dosen`.`DOSEN` AS `namadosen`,`jadwal`.`HARI` AS `hari` from ((`jadwal` join `dosen` on((`jadwal`.`IDDOSEN` = `dosen`.`IDDOSEN`))) join `matakuliah` on((`jadwal`.`IDMK` = `matakuliah`.`IDMK`))) order by `jadwal`.`RUANG`,`jadwal`.`MULAIJAMKE`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensidosen`
--
ALTER TABLE `absensidosen`
 ADD PRIMARY KEY (`idaksesndosen`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
 ADD PRIMARY KEY (`IDDOSEN`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
 ADD PRIMARY KEY (`IDJADWAL`);

--
-- Indexes for table `jampertemuan`
--
ALTER TABLE `jampertemuan`
 ADD PRIMARY KEY (`JAMKE`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
 ADD PRIMARY KEY (`IDMK`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `ruangkelas`
--
ALTER TABLE `ruangkelas`
 ADD PRIMARY KEY (`idruang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensidosen`
--
ALTER TABLE `absensidosen`
MODIFY `idaksesndosen` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
MODIFY `IDDOSEN` tinyint(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
MODIFY `IDJADWAL` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ruangkelas`
--
ALTER TABLE `ruangkelas`
MODIFY `idruang` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
