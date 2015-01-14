-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2014-05-19 22:18:22
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table bcmtia.members
DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_username` varchar(42) NOT NULL,
  `member_password` varchar(42) NOT NULL,
  `member_admin` int(11) NOT NULL DEFAULT '0',
  `member_email` varchar(128) NOT NULL,
  `member_forgot` varchar(128) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table bcmtia.members: 2 rows
DELETE FROM `members`;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` (`member_id`, `member_username`, `member_password`, `member_admin`, `member_email`, `member_forgot`) VALUES
	(1, 'adminaja', '2dd315c28a2d9d2ecd9c4d257505f55d', 1, 'made@artha.web.id', ''),
	(2, 'stiki', 'e64f7ad58961e855c5fcc4d4a576844e', 0, '', '');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
