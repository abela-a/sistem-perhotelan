/*
Navicat MySQL Data Transfer

Source Server         : Database
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_hotel

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-10-27 10:33:18
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

-- ----------------------------
-- Table structure for `tagihan`
-- ----------------------------
DROP TABLE IF EXISTS `tagihan`;
CREATE TABLE `tagihan` (
  `kode_tagihan` char(10) NOT NULL,
  `id_tamu` char(8) DEFAULT NULL,
  `kode_kamar` char(8) DEFAULT NULL,
  `kode_jasa` char(8) DEFAULT NULL,
  `total_tagihan` double(10,0) DEFAULT NULL,
  PRIMARY KEY (`kode_tagihan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tagihan
-- ----------------------------

-- ----------------------------
-- Table structure for `tamu`
-- ----------------------------
DROP TABLE IF EXISTS `tamu`;
CREATE TABLE `tamu` (
  `id_tamu` char(8) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(20) DEFAULT NULL,
  `telepon` char(14) DEFAULT NULL,
  `tanggal_check_out` date DEFAULT NULL,
  `tanggal_check_in` date DEFAULT NULL,
  `kode_kamar` char(8) DEFAULT NULL,
  `kode_jasa` char(8) DEFAULT NULL,
  `status_tamu` enum('Check Out','Check In') DEFAULT NULL,
  PRIMARY KEY (`id_tamu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tamu
-- ----------------------------
