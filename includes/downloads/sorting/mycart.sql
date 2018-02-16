-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for my_cart
CREATE DATABASE IF NOT EXISTS `my_cart` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `my_cart`;


-- Dumping structure for table my_cart.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_country` varchar(255) NOT NULL,
  `user_postcode` varchar(255) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table my_cart.users: ~11 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_phone`, `user_password`, `user_address`, `user_country`, `user_postcode`, `user_ip`, `created`) VALUES
	(1, 'Aaliyah', 'pink53@hotmail.com', '493.241.4167 x26594', 'G38$loI-idMoV?L/sk', '57988 Shannon Creek\nEast Stephanie, ND 94560-7607', 'Australia', '55620-5399', '99.82.4.201', '2000-03-10'),
	(2, 'Stacy', 'lgrimes@yahoo.com', '663-543-0108', 'shUa:D(oq', '51599 Jimmy Lock\nCruickshankshire, AL 96756', 'Taiwan', '94730', '228.218.26.182', '2016-11-08'),
	(3, 'Jeffrey', 'cheyanne.hane@hotmail.com', '(781) 215-4689', 'BOK~"d&m`!Q', '7485 Frami Vista\nJustinamouth, DE 08972-5076', 'Korea', '60045-0815', '15.173.70.46', '2009-12-03'),
	(4, 'Horacio', 'becker.wilfredo@yahoo.com', '1-656-208-2645 x37493', 'ql@(;Y@', '259 Alexandrea Ports\nEast Carletonport, OH 12729', 'Wallis and Futuna', '77840-6369', '57.105.220.0', '1971-09-30'),
	(5, 'Maxie', 'bergnaum.brisa@hessel.org', '(908) 277-6217', 'bh>hn=M9P}rGQdJ"qiN', '8923 Luigi Plains Suite 860\nKoelpinbury, CO 13178', 'Monaco', '30040', '245.103.122.30', '1997-06-23'),
	(6, 'Leif', 'obins@hotmail.com', '1-432-490-2312 x0241', 'C8[c"Z>N8k}b7)J', '104 Lind Cliffs Suite 280\nNorth Antwanburgh, NH 81077-2432', 'Sudan', '85213-1749', '85.134.161.85', '1996-11-01'),
	(7, 'Ericka', 'stephania13@davis.com', '806-731-5422 x603', 'vAV-QYvu25r*V<Z', '44212 Alysha Roads Apt. 378\nTorptown, MT 62293', 'Myanmar', '01965', '81.77.15.90', '2000-10-14'),
	(8, 'Martina', 'harris.horace@marquardt.com', '+1-719-271-7059', 'OIOS%>f', '842 Retha Run\nNew Kelsieborough, NE 24220-1429', 'Western Sahara', '88492', '207.118.127.180', '1998-08-24'),
	(9, 'Julius', 'heller.ashley@gulgowski.com', '(898) 845-8482', 'Fe(FfT$T', '830 Leon Locks\nSouth Aimeebury, NV 07955-5851', 'Mauritius', '40145', '137.163.92.65', '2008-06-26'),
	(10, 'Mathias', 'bgerlach@gmail.com', '615-629-6622 x333', '8RJV8VG_T@IDj,1\'4G7', '69215 Bryce Ramp Apt. 786\nBrakuschester, AL 55889-3145', 'Tuvalu', '06573-4456', '115.173.172.186', '1999-03-30'),
	(11, 'Ashley', 'gibson.donny@kris.com', '(837) 735-7259 x87148', '9%PC3L<lXG!YwmF:', '665 Beahan Mills Suite 180\nSouth Michealmouth, OK 07643-4366', 'Mauritius', '16909', '219.67.243.110', '1996-01-04'),
	(12, 'Alejandrin', 'brakus.ericka@runte.net', '+1-584-617-6047', 'dj9h1uViL5_', '98847 Tillman Row\nWest Pascale, GA 29110', 'Heard Island and McDonald Islands', '35606', '28.111.252.211', '1984-06-14'),
	(13, 'Carlo', 'dwight42@beahan.com', '(223) 281-8376 x3580', 'pD@r~USF#%L,/5U)"Z>}', '4818 Johnston Common\nBoyerton, NJ 18282', 'Anguilla', '51085-1569', '188.125.209.147', '1987-08-09'),
	(14, 'Tyshawn', 'fidel26@kling.info', '+1-332-862-4235', 'GHgi7u+kp', '1850 Boehm Fall Apt. 393\nSouth Quincy, KY 25579', 'Aruba', '23151-4582', '216.14.145.218', '2010-12-06'),
	(15, 'Loren', 'laisha.russel@gmail.com', '921-870-1718 x65999', '%(*]xk>7h~5>QN"$', '19692 Camille Estates\nRollinshire, ID 94743', 'Djibouti', '01195-8403', '231.28.40.177', '1980-10-25'),
	(16, 'Rosemary', 'udouglas@buckridge.com', '770-461-1585 x0623', 'r-DU|c5}dDGTh=i', '81921 Deanna Drive Apt. 382\nFannymouth, OR 56157-3068', 'Russian Federation', '93520-8753', '53.149.89.184', '2007-09-16'),
	(17, 'Claire', 'jack38@altenwerth.com', '387-673-3688', 'qFGucD!', '105 Funk Track\nSouth Ferne, DC 87699', 'Reunion', '88305-2298', '202.163.164.233', '2012-12-29'),
	(18, 'Pinkie', 'vbeatty@parker.org', '(436) 247-2353 x44796', 'v^iKH/7>&XpNTML|3H6E', '7146 McClure Bridge\nLake Sheldon, PA 15807-2547', 'Zimbabwe', '32877', '120.9.184.178', '2000-03-04'),
	(19, 'Brenda', 'kristy44@yahoo.com', '+1-882-241-7358', 'Fwa"q,Mej', '7826 Streich Manor\nEast Madisenport, ID 23031-4597', 'Cocos (Keeling) Islands', '87112', '224.243.22.13', '1989-08-12'),
	(20, 'Nicole', 'hcrooks@gmail.com', '1-415-766-9202 x10446', 'u(yr,I.&M%3h.tX1C`', '177 Polly Divide\nArnaldoberg, CT 05368-0564', 'Argentina', '57149', '210.180.122.220', '1996-05-04'),
	(21, 'Aliza', 'roberta.muller@mclaughlin.net', '853-777-6846', 'Ev41/AE0pcjSa&1', '9902 Hills Island Apt. 905\nJusticefurt, TN 37913-7602', 'Taiwan', '90412-4838', '246.183.10.215', '1985-06-20'),
	(22, 'Reyes', 'eugene.crist@yahoo.com', '(256) 821-4312 x826', 'T*oU_nq)}iw?%+[Xf', '34806 Maryam Dale\nKristinport, WI 24446-3093', 'Vanuatu', '08143-8852', '118.108.130.16', '1971-11-19'),
	(23, 'Moshe', 'bridgette.bahringer@wilkinson.info', '387.902.5686', '[6:Ivt&rKn', '3444 Ernestina Isle\nSouth Rachellefort, WY 38868-6959', 'Taiwan', '30133', '68.103.75.102', '2000-07-11'),
	(24, 'Barton', 'eldridge21@hotmail.com', '845-402-7244 x51978', '43g-TFt}h', '81995 Jannie Throughway Suite 376\nFridaburgh, MO 07742-3499', 'Congo', '90477', '209.213.141.198', '2017-02-08'),
	(25, 'Sandra', 'maybelle.swaniawski@gmail.com', '487-663-2812', 'CTdRs7', '58226 Jacky Burg\nLake Gideon, CO 72113', 'Swaziland', '60444-9069', '71.189.31.162', '1996-04-16'),
	(26, 'Adella', 'linwood.farrell@nicolas.org', '694.478.6506 x2098', '{,j9&L', '30107 Leilani Tunnel\nNorth Karson, RI 68375-7429', 'South Africa', '06444', '182.196.95.213', '1978-04-24'),
	(27, 'Alvera', 'kassulke.elfrieda@rogahn.info', '+14934965327', 'O2Aq2U', '12714 Gleason Landing\nPort Grover, OK 06774-4485', 'Djibouti', '65134', '10.235.32.65', '2017-10-18'),
	(28, 'Andres', 'al20@moen.com', '707-361-5317 x23473', '`f[,90l>jGpk$A$2>6', '269 Sasha Extension\nMullerfurt, MA 59904', 'Christmas Island', '83587-5752', '202.9.10.65', '1971-06-21'),
	(29, 'Tristian', 'darlene54@jenkins.com', '885.399.5038 x39854', 'b4%b6Pkl+V=^n<x', '3180 Zion Corners Suite 644\nDachstad, DC 71118', 'Bahamas', '56315-5945', '158.250.201.61', '1977-12-20'),
	(30, 'Rachael', 'omohr@fisher.com', '637-608-8844 x24064', '"q;5O`M]]it[/UCnm=aw', '1496 Schaefer Well Suite 554\nLake Marcelle, MN 64407', 'Afghanistan', '92777', '102.229.126.67', '1978-01-13'),
	(31, 'Makenzie', 'bergnaum.manley@gmail.com', '829-600-2768 x23238', '[>T!-$hH@FYn&4', '88830 Rau Roads Suite 316\nLake Giuseppefurt, MS 69605', 'Vanuatu', '39441-2133', '1.110.106.195', '2014-11-18');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
