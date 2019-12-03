/*
Navicat MySQL Data Transfer

Source Server         : Database
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_hotel

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-12-03 07:57:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `jasa`
-- ----------------------------
DROP TABLE IF EXISTS `jasa`;
CREATE TABLE `jasa` (
  `kode_jasa` char(10) NOT NULL,
  `jasa` varchar(30) DEFAULT NULL,
  `unit_jasa` varchar(20) DEFAULT NULL,
  `harga_jasa` double(10,0) DEFAULT NULL,
  PRIMARY KEY (`kode_jasa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jasa
-- ----------------------------
INSERT INTO `jasa` VALUES ('JASA-00001', 'Mengepel', 'Kebersihan', '30000');
INSERT INTO `jasa` VALUES ('JASA-00002', 'Keamanan barang', 'Keamanan', '40000');
INSERT INTO `jasa` VALUES ('JASA-00003', 'Bodyguard', 'Keamanan', '70000');

-- ----------------------------
-- Table structure for `kamar`
-- ----------------------------
DROP TABLE IF EXISTS `kamar`;
CREATE TABLE `kamar` (
  `kode_kamar` char(8) NOT NULL,
  `kamar` enum('Reguler','VIP') DEFAULT NULL,
  `harga_kamar` double(10,0) DEFAULT NULL,
  `status_kamar` enum('Terpakai','Kosong') DEFAULT NULL,
  PRIMARY KEY (`kode_kamar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kamar
-- ----------------------------
INSERT INTO `kamar` VALUES ('KMR-001', 'VIP', '500000', 'Kosong');
INSERT INTO `kamar` VALUES ('KMR-002', 'Reguler', '280000', 'Kosong');
INSERT INTO `kamar` VALUES ('KMR-003', 'Reguler', '300000', 'Kosong');
INSERT INTO `kamar` VALUES ('KMR-004', 'VIP', '300000', 'Kosong');

-- ----------------------------
-- Table structure for `tagihan`
-- ----------------------------
DROP TABLE IF EXISTS `tagihan`;
CREATE TABLE `tagihan` (
  `kode_tagihan` char(10) NOT NULL,
  `id_tamu` char(10) DEFAULT NULL,
  `kode_kamar` char(10) DEFAULT NULL,
  `kode_jasa` char(10) DEFAULT NULL,
  `total_tagihan` double(10,0) DEFAULT NULL,
  PRIMARY KEY (`kode_tagihan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tagihan
-- ----------------------------
INSERT INTO `tagihan` VALUES ('TG-0000001', 'TM-00001', 'KMR-001', 'JASA-00001', '530000');

-- ----------------------------
-- Table structure for `tamu`
-- ----------------------------
DROP TABLE IF EXISTS `tamu`;
CREATE TABLE `tamu` (
  `id_tamu` char(8) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text,
  `pekerjaan` varchar(20) DEFAULT NULL,
  `telepon` char(14) DEFAULT NULL,
  `tanggal_check_in` date DEFAULT NULL,
  `tanggal_check_out` date DEFAULT NULL,
  `hari` int(10) DEFAULT NULL,
  `kode_kamar` char(10) DEFAULT NULL,
  `kode_jasa` char(10) DEFAULT NULL,
  `status_tamu` enum('Check Out','Check In') DEFAULT NULL,
  PRIMARY KEY (`id_tamu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tamu
-- ----------------------------
INSERT INTO `tamu` VALUES ('TM-00001', 'Abel Ardhana S', 'Jl. Goa Ria Pondok Asri 1', 'Mahasiswa', '087816973617', '2019-12-02', '2019-12-03', '1', 'KMR-001', 'JASA-00001', 'Check Out');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(1) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('abela', 'Abel Ardhana S', '6e79ed05baec2754e25b4eac73a332d2', '1');

-- ----------------------------
-- View structure for `view_tagihan`
-- ----------------------------
DROP VIEW IF EXISTS `view_tagihan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tagihan` AS select `kamar`.`kamar` AS `kamar`,`kamar`.`harga_kamar` AS `harga_kamar`,`jasa`.`jasa` AS `jasa`,`jasa`.`harga_jasa` AS `harga_jasa`,`tagihan`.`kode_tagihan` AS `kode_tagihan`,`tagihan`.`id_tamu` AS `id_tamu`,`tagihan`.`kode_kamar` AS `kode_kamar`,`tagihan`.`kode_jasa` AS `kode_jasa`,`tagihan`.`total_tagihan` AS `total_tagihan`,`tamu`.`nama` AS `nama`,`tamu`.`alamat` AS `alamat`,`tamu`.`pekerjaan` AS `pekerjaan`,`tamu`.`telepon` AS `telepon`,`tamu`.`tanggal_check_in` AS `tanggal_check_in`,`tamu`.`tanggal_check_out` AS `tanggal_check_out`,`tamu`.`hari` AS `hari`,`tamu`.`status_tamu` AS `status_tamu` from (((`tagihan` join `kamar` on((`kamar`.`kode_kamar` = `tagihan`.`kode_kamar`))) join `jasa` on((`jasa`.`kode_jasa` = `tagihan`.`kode_jasa`))) join `tamu` on((`tagihan`.`id_tamu` = `tamu`.`id_tamu`))) ;

-- ----------------------------
-- View structure for `view_tamu`
-- ----------------------------
DROP VIEW IF EXISTS `view_tamu`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tamu` AS select `tamu`.`id_tamu` AS `id_tamu`,`tamu`.`nama` AS `nama`,`tamu`.`alamat` AS `alamat`,`tamu`.`pekerjaan` AS `pekerjaan`,`tamu`.`telepon` AS `telepon`,`tamu`.`tanggal_check_in` AS `tanggal_check_in`,`tamu`.`tanggal_check_out` AS `tanggal_check_out`,`tamu`.`hari` AS `hari`,`tamu`.`kode_kamar` AS `kode_kamar`,`tamu`.`kode_jasa` AS `kode_jasa`,`tamu`.`status_tamu` AS `status_tamu`,`jasa`.`jasa` AS `jasa`,`jasa`.`harga_jasa` AS `harga_jasa`,`kamar`.`kamar` AS `kamar`,`kamar`.`harga_kamar` AS `harga_kamar` from ((`tamu` join `kamar` on((`tamu`.`kode_kamar` = `kamar`.`kode_kamar`))) join `jasa` on((`jasa`.`kode_jasa` = `tamu`.`kode_jasa`))) ;
