/*
Navicat MySQL Data Transfer

Source Server         : coba01
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_water

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-06-06 10:26:57
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'jidan', '$argon2i$v=19$m=65536,t=4,p=1$NUdvL2ZkY3pOWERqazZKRQ$FVSZsWGPJwVm4yqQ3JZqWMS5HGAazS2GXpR/Q0laLwA');
INSERT INTO `admins` VALUES ('2', 'wildan', '$argon2i$v=19$m=65536,t=4,p=1$RWQ1MkJBaXNkL0psSWRVNw$h3Or1UEbeDIfLrtnj2jUiBFb0ng49Zhddk85dxhyEeU');
INSERT INTO `admins` VALUES ('3', 'adrian', '$argon2i$v=19$m=65536,t=4,p=1$NUVMRmFHZmNqU2lXdnExLw$SRu13o30z+Ujcu2DNuDnUBnCIF6u6gHzbyXikqm2pgY');
INSERT INTO `admins` VALUES ('5', 'shidiq', '$argon2i$v=19$m=65536,t=4,p=1$d2dvZ2ZEb29xQU43MEtuTw$g2OQcyDCM0GIFpRXGZxonGhokc+YMuoufEE27zz4nOM');

-- ----------------------------
-- Table structure for `jenis_sumber_air`
-- ----------------------------
DROP TABLE IF EXISTS `jenis_sumber_air`;
CREATE TABLE `jenis_sumber_air` (
  `id_jenis_sumber_air` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis_sumber_air` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jenis_sumber_air`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of jenis_sumber_air
-- ----------------------------
INSERT INTO `jenis_sumber_air` VALUES ('1', 'Mata air');
INSERT INTO `jenis_sumber_air` VALUES ('2', 'Sumur');
INSERT INTO `jenis_sumber_air` VALUES ('3', 'Waduk');
INSERT INTO `jenis_sumber_air` VALUES ('4', 'Danau');
INSERT INTO `jenis_sumber_air` VALUES ('5', 'Sungai');

-- ----------------------------
-- Table structure for `log_delete_sumber_air`
-- ----------------------------
DROP TABLE IF EXISTS `log_delete_sumber_air`;
CREATE TABLE `log_delete_sumber_air` (
  `id_log_delete_sumber_air` int(11) NOT NULL AUTO_INCREMENT,
  `id_sumber_air` int(11) NOT NULL,
  `nama_sumber_air` varchar(100) NOT NULL,
  `kondisi_sumber_air` varchar(100) NOT NULL,
  `suhu` decimal(11,0) NOT NULL,
  `warna` varchar(100) NOT NULL,
  `pH` decimal(11,1) NOT NULL,
  `layak_minum` varchar(100) NOT NULL,
  `id_jenis_sumber_air` int(11) NOT NULL,
  `id_kabupaten` int(4) NOT NULL,
  `foto_sumber_air` varchar(100) NOT NULL,
  `tgl_delete` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_log_delete_sumber_air`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- ----------------------------
-- -- Records of log_delete_sumber_air
-- -- ----------------------------
-- INSERT INTO `log_delete_sumber_air` VALUES ('4', '15', 'test123', 'Baik', '25', 'Keruh', '8.0', 'Layak', '1', '2', 'default.png', '2023-06-01');
-- INSERT INTO `log_delete_sumber_air` VALUES ('5', '16', 'Haloa', 'Rusak Parah', '25', 'Bening', '7.0', 'Layak', '3', '0', 'default.png', '2023-06-02');
-- INSERT INTO `log_delete_sumber_air` VALUES ('6', '17', 'Halo', 'Rusak Sedang', '14', 'Keruh', '6.4', 'Tidak', '3', '0', 'default.png', '2023-06-02');
-- INSERT INTO `log_delete_sumber_air` VALUES ('7', '18', 'testb', 'Rusak Sedang', '25', 'Keruh', '7.0', 'Tidak', '4', '0', 'default.png', '2023-06-02');
-- INSERT INTO `log_delete_sumber_air` VALUES ('8', '21', 'testd', 'Baik', '25', 'Bening', '7.0', 'Layak', '2', '5103', 'default.png', '2023-06-03');

-- ----------------------------
-- Table structure for `log_update_sumber_air`
-- ----------------------------
DROP TABLE IF EXISTS `log_update_sumber_air`;
CREATE TABLE `log_update_sumber_air` (
  `id_log_update_sumber_air` int(11) NOT NULL AUTO_INCREMENT,
  `id_sumber_air` int(11) DEFAULT NULL,
  `old_nama_sumber_air` varchar(100) DEFAULT NULL,
  `old_kondisi_sumber_air` varchar(100) DEFAULT NULL,
  `old_suhu` decimal(11,0) DEFAULT NULL,
  `old_warna` varchar(100) DEFAULT NULL,
  `old_pH` decimal(11,1) DEFAULT NULL,
  `old_layak_minum` varchar(100) DEFAULT NULL,
  `old_id_jenis_sumber_air` int(11) DEFAULT NULL,
  `old_id_kabupaten` int(4) DEFAULT NULL,
  `old_foto_sumber_air` varchar(100) DEFAULT NULL,
  `tgl_update` date DEFAULT NULL,
  PRIMARY KEY (`id_log_update_sumber_air`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- ----------------------------
-- -- Records of log_update_sumber_air
-- -- ----------------------------
-- INSERT INTO `log_update_sumber_air` VALUES ('5', '1', 'Waduk Jati Luhur', 'Baik', '26', 'Keruh', '7.6', 'Tidak', '3', '0', 'foto_waduk_jatiluhur.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('6', '2', 'Sungai Citarum', 'Baik', '28', 'Bening', '7.3', 'Layak', '5', '0', 'foto_sungai_citarum.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('7', '3', 'Mata Air Aqua Cipondok', 'Baik', '26', 'Bening', '7.4', 'Layak', '1', '0', 'foto_mata_air_aqua_cipondok.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('8', '4', 'Sungai Ciliwung', 'Rusak Sedang', '29', 'Keruh', '7.9', 'Tidak', '5', '0', 'foto_sungai_ciliwung.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('9', '5', 'Mata Air Lubuk Bonta', 'Baik', '26', 'Bening', '7.4', 'Layak', '1', '0', 'foto_mata_air_lubuk_bonta.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('10', '6', 'Waduk Sermo', 'Rusak Sedang', '29', 'Keruh', '7.7', 'Tidak', '3', '0', 'foto_waduk_sermo.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('11', '7', 'Sumur Abadi', 'Baik', '26', 'Bening', '7.3', 'Layak', '2', '0', 'foto_sumur_abadi_semarang.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('12', '8', 'Danau Cermin Lamaru', 'Baik', '25', 'Bening', '7.3', 'Layak', '4', '0', 'foto_danau_cermin_lamaru.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('13', '9', 'Danau Batur', 'Rusak Parah', '30', 'Keruh', '6.9', 'Tidak', '4', '0', 'foto_danau_batur_bali.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('14', '16', 'Haloa', 'Rusak Parah', '25', 'Bening', '7.0', 'Layak', '3', '0', 'default.png', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('15', '10', 'Sungai Bengawan Solo', 'Baik', '29', 'Keruh', '7.3', 'Tidak', '5', '0', 'foto_sungai_bengawan_solo.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('16', '17', 'Halo', 'Rusak Sedang', '14', 'Keruh', '6.4', 'Tidak', '3', '0', 'default.png', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('17', '1', 'Waduk Jati Luhur', 'Baik', '26', 'Keruh', '7.6', 'Tidak', '3', '0', 'foto_waduk_jatiluhur.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('18', '2', 'Sungai Citarum', 'Baik', '28', 'Bening', '7.3', 'Layak', '5', '0', 'foto_sungai_citarum.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('19', '3', 'Mata Air Aqua Cipondok', 'Baik', '26', 'Bening', '7.4', 'Layak', '1', '0', 'foto_mata_air_aqua_cipondok.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('20', '4', 'Sungai Ciliwung', 'Rusak Sedang', '29', 'Keruh', '7.9', 'Tidak', '5', '0', 'foto_sungai_ciliwung.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('21', '5', 'Mata Air Lubuk Bonta', 'Baik', '26', 'Bening', '7.4', 'Layak', '1', '0', 'foto_mata_air_lubuk_bonta.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('22', '6', 'Waduk Sermo', 'Rusak Sedang', '29', 'Keruh', '7.7', 'Tidak', '3', '0', 'foto_waduk_sermo.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('23', '7', 'Sumur Abadi', 'Baik', '26', 'Bening', '7.3', 'Layak', '2', '0', 'foto_sumur_abadi_semarang.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('24', '17', 'Halo', 'Rusak Sedang', '14', 'Keruh', '6.4', 'Tidak', '3', '0', 'default.png', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('25', '16', 'Haloa', 'Rusak Parah', '25', 'Bening', '7.0', 'Layak', '3', '0', 'default.png', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('26', '10', 'Sungai Bengawan Solo', 'Baik', '29', 'Keruh', '7.3', 'Tidak', '5', '0', 'foto_sungai_bengawan_solo.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('27', '9', 'Danau Batur', 'Rusak Parah', '30', 'Keruh', '6.9', 'Tidak', '4', '0', 'foto_danau_batur_bali.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('28', '8', 'Danau Cermin Lamaru', 'Baik', '25', 'Bening', '7.3', 'Layak', '4', '0', 'foto_danau_cermin_lamaru.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('34', '3', 'Mata Air Aqua Cipondok', 'Baik', '26', 'Bening', '7.4', 'Layak', '1', '0', 'foto_mata_air_aqua_cipondok.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('35', '3', 'Mata Air Aqua Cipondok', 'Baik', '26', 'Bening', '7.4', 'Layak', '1', '0', 'foto_mata_air_aqua_cipondok.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('36', '18', 'testb', 'Rusak Sedang', '25', 'Keruh', '7.0', 'Tidak', '4', '0', 'default.png', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('37', '11', 'Sungai Musi', 'Rusak Sedang', '29', 'Keruh', '8.2', 'Tidak', '5', '0', 'foto_sungai_musi.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('38', '11', 'Sungai Musi', 'Rusak Sedang', '29', 'Keruh', '8.2', 'Tidak', '5', '0', 'foto_sungai_musi.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('39', '11', 'Sungai Musi', 'Rusak Sedang', '29', 'Keruh', '8.0', 'Tidak', '5', '0', 'foto_sungai_musi.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('40', '11', 'Sungai Musi', 'Rusak Sedang', '29', 'Keruh', '8.2', 'Tidak', '5', '0', 'foto_sungai_musi.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('41', '11', 'Sungai Musi', 'Rusak Sedang', '30', 'Keruh', '8.2', 'Tidak', '5', '0', 'foto_sungai_musi.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('42', '1', 'Waduk Jati Luhur', 'Baik', '26', 'Keruh', '7.6', 'Tidak', '3', '0', 'foto_waduk_jatiluhur.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('43', '2', 'Sungai Citarum', 'Baik', '28', 'Bening', '7.3', 'Layak', '5', '0', 'foto_sungai_citarum.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('44', '4', 'Sungai Ciliwung', 'Rusak Sedang', '29', 'Keruh', '7.9', 'Tidak', '5', '0', 'foto_sungai_ciliwung.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('45', '5', 'Mata Air Lubuk Bonta', 'Baik', '26', 'Bening', '7.4', 'Layak', '1', '0', 'foto_mata_air_lubuk_bonta.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('46', '6', 'Waduk Sermo', 'Rusak Sedang', '29', 'Keruh', '7.7', 'Tidak', '3', '0', 'foto_waduk_sermo.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('47', '7', 'Sumur Abadi', 'Baik', '26', 'Bening', '7.3', 'Layak', '2', '0', 'foto_sumur_abadi_semarang.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('48', '8', 'Danau Cermin Lamaru', 'Baik', '25', 'Bening', '7.3', 'Layak', '4', '0', 'foto_danau_cermin_lamaru.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('49', '9', 'Danau Batur', 'Rusak Parah', '30', 'Keruh', '6.9', 'Tidak', '4', '0', 'foto_danau_batur_bali.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('50', '10', 'Sungai Bengawan Solo', 'Baik', '29', 'Keruh', '7.3', 'Tidak', '5', '0', 'foto_sungai_bengawan_solo.jpg', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('51', '19', 'Sungai Mamberamo', 'Rusak Sedang', '28', 'Keruh', '6.4', 'Tidak', '5', '0', 'default.png', '2023-06-02');
-- INSERT INTO `log_update_sumber_air` VALUES ('52', '21', 'testd', 'Rusak Parah', '25', 'Bening', '7.0', 'Layak', '2', '5103', 'default.png', '2023-06-03');
-- INSERT INTO `log_update_sumber_air` VALUES ('53', '7', 'Sumur Abadi', 'Baik', '26', 'Bening', '7.3', 'Layak', '2', '3203', 'foto_sumur_abadi_semarang.jpg', '2023-06-03');
-- INSERT INTO `log_update_sumber_air` VALUES ('54', '1', 'Waduk Jati Luhur', 'Baik', '26', 'Keruh', '7.6', 'Tidak', '3', '3214', 'foto_waduk_jatiluhur.jpg', '2023-06-03');
-- INSERT INTO `log_update_sumber_air` VALUES ('55', '10', 'Sungai Bengawan Solo', 'Baik', '29', 'Keruh', '7.3', 'Tidak', '5', '3372', 'foto_sungai_bengawan_solo.jpg', '2023-06-03');

-- ----------------------------
-- Table structure for `provinces`
-- ----------------------------
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces` (
  `id` char(2) NOT NULL,
  `provinces_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of provinces
-- ----------------------------
INSERT INTO `provinces` VALUES ('11', 'ACEH');
INSERT INTO `provinces` VALUES ('12', 'SUMATERA UTARA');
INSERT INTO `provinces` VALUES ('13', 'SUMATERA BARAT');
INSERT INTO `provinces` VALUES ('14', 'RIAU');
INSERT INTO `provinces` VALUES ('15', 'JAMBI');
INSERT INTO `provinces` VALUES ('16', 'SUMATERA SELATAN');
INSERT INTO `provinces` VALUES ('17', 'BENGKULU');
INSERT INTO `provinces` VALUES ('18', 'LAMPUNG');
INSERT INTO `provinces` VALUES ('19', 'KEPULAUAN BANGKA BELITUNG');
INSERT INTO `provinces` VALUES ('21', 'KEPULAUAN RIAU');
INSERT INTO `provinces` VALUES ('31', 'DKI JAKARTA');
INSERT INTO `provinces` VALUES ('32', 'JAWA BARAT');
INSERT INTO `provinces` VALUES ('33', 'JAWA TENGAH');
INSERT INTO `provinces` VALUES ('34', 'DI YOGYAKARTA');
INSERT INTO `provinces` VALUES ('35', 'JAWA TIMUR');
INSERT INTO `provinces` VALUES ('36', 'BANTEN');
INSERT INTO `provinces` VALUES ('51', 'BALI');
INSERT INTO `provinces` VALUES ('52', 'NUSA TENGGARA BARAT');
INSERT INTO `provinces` VALUES ('53', 'NUSA TENGGARA TIMUR');
INSERT INTO `provinces` VALUES ('61', 'KALIMANTAN BARAT');
INSERT INTO `provinces` VALUES ('62', 'KALIMANTAN TENGAH');
INSERT INTO `provinces` VALUES ('63', 'KALIMANTAN SELATAN');
INSERT INTO `provinces` VALUES ('64', 'KALIMANTAN TIMUR');
INSERT INTO `provinces` VALUES ('65', 'KALIMANTAN UTARA');
INSERT INTO `provinces` VALUES ('71', 'SULAWESI UTARA');
INSERT INTO `provinces` VALUES ('72', 'SULAWESI TENGAH');
INSERT INTO `provinces` VALUES ('73', 'SULAWESI SELATAN');
INSERT INTO `provinces` VALUES ('74', 'SULAWESI TENGGARA');
INSERT INTO `provinces` VALUES ('75', 'GORONTALO');
INSERT INTO `provinces` VALUES ('76', 'SULAWESI BARAT');
INSERT INTO `provinces` VALUES ('81', 'MALUKU');
INSERT INTO `provinces` VALUES ('82', 'MALUKU UTARA');
INSERT INTO `provinces` VALUES ('91', 'PAPUA BARAT');
INSERT INTO `provinces` VALUES ('94', 'PAPUA');

-- ----------------------------
-- Table structure for `regencies`
-- ----------------------------
DROP TABLE IF EXISTS `regencies`;
CREATE TABLE `regencies` (
  `id` int(4) NOT NULL,
  `province_id` char(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `regencies_province_id_index` (`province_id`),
  CONSTRAINT `regencies_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of regencies
-- ----------------------------
INSERT INTO `regencies` VALUES ('1101', '11', 'KABUPATEN SIMEULUE');
INSERT INTO `regencies` VALUES ('1102', '11', 'KABUPATEN ACEH SINGKIL');
INSERT INTO `regencies` VALUES ('1103', '11', 'KABUPATEN ACEH SELATAN');
INSERT INTO `regencies` VALUES ('1104', '11', 'KABUPATEN ACEH TENGGARA');
INSERT INTO `regencies` VALUES ('1105', '11', 'KABUPATEN ACEH TIMUR');
INSERT INTO `regencies` VALUES ('1106', '11', 'KABUPATEN ACEH TENGAH');
INSERT INTO `regencies` VALUES ('1107', '11', 'KABUPATEN ACEH BARAT');
INSERT INTO `regencies` VALUES ('1108', '11', 'KABUPATEN ACEH BESAR');
INSERT INTO `regencies` VALUES ('1109', '11', 'KABUPATEN PIDIE');
INSERT INTO `regencies` VALUES ('1110', '11', 'KABUPATEN BIREUEN');
INSERT INTO `regencies` VALUES ('1111', '11', 'KABUPATEN ACEH UTARA');
INSERT INTO `regencies` VALUES ('1112', '11', 'KABUPATEN ACEH BARAT DAYA');
INSERT INTO `regencies` VALUES ('1113', '11', 'KABUPATEN GAYO LUES');
INSERT INTO `regencies` VALUES ('1114', '11', 'KABUPATEN ACEH TAMIANG');
INSERT INTO `regencies` VALUES ('1115', '11', 'KABUPATEN NAGAN RAYA');
INSERT INTO `regencies` VALUES ('1116', '11', 'KABUPATEN ACEH JAYA');
INSERT INTO `regencies` VALUES ('1117', '11', 'KABUPATEN BENER MERIAH');
INSERT INTO `regencies` VALUES ('1118', '11', 'KABUPATEN PIDIE JAYA');
INSERT INTO `regencies` VALUES ('1171', '11', 'KOTA BANDA ACEH');
INSERT INTO `regencies` VALUES ('1172', '11', 'KOTA SABANG');
INSERT INTO `regencies` VALUES ('1173', '11', 'KOTA LANGSA');
INSERT INTO `regencies` VALUES ('1174', '11', 'KOTA LHOKSEUMAWE');
INSERT INTO `regencies` VALUES ('1175', '11', 'KOTA SUBULUSSALAM');
INSERT INTO `regencies` VALUES ('1201', '12', 'KABUPATEN NIAS');
INSERT INTO `regencies` VALUES ('1202', '12', 'KABUPATEN MANDAILING NATAL');
INSERT INTO `regencies` VALUES ('1203', '12', 'KABUPATEN TAPANULI SELATAN');
INSERT INTO `regencies` VALUES ('1204', '12', 'KABUPATEN TAPANULI TENGAH');
INSERT INTO `regencies` VALUES ('1205', '12', 'KABUPATEN TAPANULI UTARA');
INSERT INTO `regencies` VALUES ('1206', '12', 'KABUPATEN TOBA SAMOSIR');
INSERT INTO `regencies` VALUES ('1207', '12', 'KABUPATEN LABUHAN BATU');
INSERT INTO `regencies` VALUES ('1208', '12', 'KABUPATEN ASAHAN');
INSERT INTO `regencies` VALUES ('1209', '12', 'KABUPATEN SIMALUNGUN');
INSERT INTO `regencies` VALUES ('1210', '12', 'KABUPATEN DAIRI');
INSERT INTO `regencies` VALUES ('1211', '12', 'KABUPATEN KARO');
INSERT INTO `regencies` VALUES ('1212', '12', 'KABUPATEN DELI SERDANG');
INSERT INTO `regencies` VALUES ('1213', '12', 'KABUPATEN LANGKAT');
INSERT INTO `regencies` VALUES ('1214', '12', 'KABUPATEN NIAS SELATAN');
INSERT INTO `regencies` VALUES ('1215', '12', 'KABUPATEN HUMBANG HASUNDUTAN');
INSERT INTO `regencies` VALUES ('1216', '12', 'KABUPATEN PAKPAK BHARAT');
INSERT INTO `regencies` VALUES ('1217', '12', 'KABUPATEN SAMOSIR');
INSERT INTO `regencies` VALUES ('1218', '12', 'KABUPATEN SERDANG BEDAGAI');
INSERT INTO `regencies` VALUES ('1219', '12', 'KABUPATEN BATU BARA');
INSERT INTO `regencies` VALUES ('1220', '12', 'KABUPATEN PADANG LAWAS UTARA');
INSERT INTO `regencies` VALUES ('1221', '12', 'KABUPATEN PADANG LAWAS');
INSERT INTO `regencies` VALUES ('1222', '12', 'KABUPATEN LABUHAN BATU SELATAN');
INSERT INTO `regencies` VALUES ('1223', '12', 'KABUPATEN LABUHAN BATU UTARA');
INSERT INTO `regencies` VALUES ('1224', '12', 'KABUPATEN NIAS UTARA');
INSERT INTO `regencies` VALUES ('1225', '12', 'KABUPATEN NIAS BARAT');
INSERT INTO `regencies` VALUES ('1271', '12', 'KOTA SIBOLGA');
INSERT INTO `regencies` VALUES ('1272', '12', 'KOTA TANJUNG BALAI');
INSERT INTO `regencies` VALUES ('1273', '12', 'KOTA PEMATANG SIANTAR');
INSERT INTO `regencies` VALUES ('1274', '12', 'KOTA TEBING TINGGI');
INSERT INTO `regencies` VALUES ('1275', '12', 'KOTA MEDAN');
INSERT INTO `regencies` VALUES ('1276', '12', 'KOTA BINJAI');
INSERT INTO `regencies` VALUES ('1277', '12', 'KOTA PADANGSIDIMPUAN');
INSERT INTO `regencies` VALUES ('1278', '12', 'KOTA GUNUNGSITOLI');
INSERT INTO `regencies` VALUES ('1301', '13', 'KABUPATEN KEPULAUAN MENTAWAI');
INSERT INTO `regencies` VALUES ('1302', '13', 'KABUPATEN PESISIR SELATAN');
INSERT INTO `regencies` VALUES ('1303', '13', 'KABUPATEN SOLOK');
INSERT INTO `regencies` VALUES ('1304', '13', 'KABUPATEN SIJUNJUNG');
INSERT INTO `regencies` VALUES ('1305', '13', 'KABUPATEN TANAH DATAR');
INSERT INTO `regencies` VALUES ('1306', '13', 'KABUPATEN PADANG PARIAMAN');
INSERT INTO `regencies` VALUES ('1307', '13', 'KABUPATEN AGAM');
INSERT INTO `regencies` VALUES ('1308', '13', 'KABUPATEN LIMA PULUH KOTA');
INSERT INTO `regencies` VALUES ('1309', '13', 'KABUPATEN PASAMAN');
INSERT INTO `regencies` VALUES ('1310', '13', 'KABUPATEN SOLOK SELATAN');
INSERT INTO `regencies` VALUES ('1311', '13', 'KABUPATEN DHARMASRAYA');
INSERT INTO `regencies` VALUES ('1312', '13', 'KABUPATEN PASAMAN BARAT');
INSERT INTO `regencies` VALUES ('1371', '13', 'KOTA PADANG');
INSERT INTO `regencies` VALUES ('1372', '13', 'KOTA SOLOK');
INSERT INTO `regencies` VALUES ('1373', '13', 'KOTA SAWAH LUNTO');
INSERT INTO `regencies` VALUES ('1374', '13', 'KOTA PADANG PANJANG');
INSERT INTO `regencies` VALUES ('1375', '13', 'KOTA BUKITTINGGI');
INSERT INTO `regencies` VALUES ('1376', '13', 'KOTA PAYAKUMBUH');
INSERT INTO `regencies` VALUES ('1377', '13', 'KOTA PARIAMAN');
INSERT INTO `regencies` VALUES ('1401', '14', 'KABUPATEN KUANTAN SINGINGI');
INSERT INTO `regencies` VALUES ('1402', '14', 'KABUPATEN INDRAGIRI HULU');
INSERT INTO `regencies` VALUES ('1403', '14', 'KABUPATEN INDRAGIRI HILIR');
INSERT INTO `regencies` VALUES ('1404', '14', 'KABUPATEN PELALAWAN');
INSERT INTO `regencies` VALUES ('1405', '14', 'KABUPATEN S I A K');
INSERT INTO `regencies` VALUES ('1406', '14', 'KABUPATEN KAMPAR');
INSERT INTO `regencies` VALUES ('1407', '14', 'KABUPATEN ROKAN HULU');
INSERT INTO `regencies` VALUES ('1408', '14', 'KABUPATEN BENGKALIS');
INSERT INTO `regencies` VALUES ('1409', '14', 'KABUPATEN ROKAN HILIR');
INSERT INTO `regencies` VALUES ('1410', '14', 'KABUPATEN KEPULAUAN MERANTI');
INSERT INTO `regencies` VALUES ('1471', '14', 'KOTA PEKANBARU');
INSERT INTO `regencies` VALUES ('1473', '14', 'KOTA D U M A I');
INSERT INTO `regencies` VALUES ('1501', '15', 'KABUPATEN KERINCI');
INSERT INTO `regencies` VALUES ('1502', '15', 'KABUPATEN MERANGIN');
INSERT INTO `regencies` VALUES ('1503', '15', 'KABUPATEN SAROLANGUN');
INSERT INTO `regencies` VALUES ('1504', '15', 'KABUPATEN BATANG HARI');
INSERT INTO `regencies` VALUES ('1505', '15', 'KABUPATEN MUARO JAMBI');
INSERT INTO `regencies` VALUES ('1506', '15', 'KABUPATEN TANJUNG JABUNG TIMUR');
INSERT INTO `regencies` VALUES ('1507', '15', 'KABUPATEN TANJUNG JABUNG BARAT');
INSERT INTO `regencies` VALUES ('1508', '15', 'KABUPATEN TEBO');
INSERT INTO `regencies` VALUES ('1509', '15', 'KABUPATEN BUNGO');
INSERT INTO `regencies` VALUES ('1571', '15', 'KOTA JAMBI');
INSERT INTO `regencies` VALUES ('1572', '15', 'KOTA SUNGAI PENUH');
INSERT INTO `regencies` VALUES ('1601', '16', 'KABUPATEN OGAN KOMERING ULU');
INSERT INTO `regencies` VALUES ('1602', '16', 'KABUPATEN OGAN KOMERING ILIR');
INSERT INTO `regencies` VALUES ('1603', '16', 'KABUPATEN MUARA ENIM');
INSERT INTO `regencies` VALUES ('1604', '16', 'KABUPATEN LAHAT');
INSERT INTO `regencies` VALUES ('1605', '16', 'KABUPATEN MUSI RAWAS');
INSERT INTO `regencies` VALUES ('1606', '16', 'KABUPATEN MUSI BANYUASIN');
INSERT INTO `regencies` VALUES ('1607', '16', 'KABUPATEN BANYU ASIN');
INSERT INTO `regencies` VALUES ('1608', '16', 'KABUPATEN OGAN KOMERING ULU SELATAN');
INSERT INTO `regencies` VALUES ('1609', '16', 'KABUPATEN OGAN KOMERING ULU TIMUR');
INSERT INTO `regencies` VALUES ('1610', '16', 'KABUPATEN OGAN ILIR');
INSERT INTO `regencies` VALUES ('1611', '16', 'KABUPATEN EMPAT LAWANG');
INSERT INTO `regencies` VALUES ('1612', '16', 'KABUPATEN PENUKAL ABAB LEMATANG ILIR');
INSERT INTO `regencies` VALUES ('1613', '16', 'KABUPATEN MUSI RAWAS UTARA');
INSERT INTO `regencies` VALUES ('1671', '16', 'KOTA PALEMBANG');
INSERT INTO `regencies` VALUES ('1672', '16', 'KOTA PRABUMULIH');
INSERT INTO `regencies` VALUES ('1673', '16', 'KOTA PAGAR ALAM');
INSERT INTO `regencies` VALUES ('1674', '16', 'KOTA LUBUKLINGGAU');
INSERT INTO `regencies` VALUES ('1701', '17', 'KABUPATEN BENGKULU SELATAN');
INSERT INTO `regencies` VALUES ('1702', '17', 'KABUPATEN REJANG LEBONG');
INSERT INTO `regencies` VALUES ('1703', '17', 'KABUPATEN BENGKULU UTARA');
INSERT INTO `regencies` VALUES ('1704', '17', 'KABUPATEN KAUR');
INSERT INTO `regencies` VALUES ('1705', '17', 'KABUPATEN SELUMA');
INSERT INTO `regencies` VALUES ('1706', '17', 'KABUPATEN MUKOMUKO');
INSERT INTO `regencies` VALUES ('1707', '17', 'KABUPATEN LEBONG');
INSERT INTO `regencies` VALUES ('1708', '17', 'KABUPATEN KEPAHIANG');
INSERT INTO `regencies` VALUES ('1709', '17', 'KABUPATEN BENGKULU TENGAH');
INSERT INTO `regencies` VALUES ('1771', '17', 'KOTA BENGKULU');
INSERT INTO `regencies` VALUES ('1801', '18', 'KABUPATEN LAMPUNG BARAT');
INSERT INTO `regencies` VALUES ('1802', '18', 'KABUPATEN TANGGAMUS');
INSERT INTO `regencies` VALUES ('1803', '18', 'KABUPATEN LAMPUNG SELATAN');
INSERT INTO `regencies` VALUES ('1804', '18', 'KABUPATEN LAMPUNG TIMUR');
INSERT INTO `regencies` VALUES ('1805', '18', 'KABUPATEN LAMPUNG TENGAH');
INSERT INTO `regencies` VALUES ('1806', '18', 'KABUPATEN LAMPUNG UTARA');
INSERT INTO `regencies` VALUES ('1807', '18', 'KABUPATEN WAY KANAN');
INSERT INTO `regencies` VALUES ('1808', '18', 'KABUPATEN TULANGBAWANG');
INSERT INTO `regencies` VALUES ('1809', '18', 'KABUPATEN PESAWARAN');
INSERT INTO `regencies` VALUES ('1810', '18', 'KABUPATEN PRINGSEWU');
INSERT INTO `regencies` VALUES ('1811', '18', 'KABUPATEN MESUJI');
INSERT INTO `regencies` VALUES ('1812', '18', 'KABUPATEN TULANG BAWANG BARAT');
INSERT INTO `regencies` VALUES ('1813', '18', 'KABUPATEN PESISIR BARAT');
INSERT INTO `regencies` VALUES ('1871', '18', 'KOTA BANDAR LAMPUNG');
INSERT INTO `regencies` VALUES ('1872', '18', 'KOTA METRO');
INSERT INTO `regencies` VALUES ('1901', '19', 'KABUPATEN BANGKA');
INSERT INTO `regencies` VALUES ('1902', '19', 'KABUPATEN BELITUNG');
INSERT INTO `regencies` VALUES ('1903', '19', 'KABUPATEN BANGKA BARAT');
INSERT INTO `regencies` VALUES ('1904', '19', 'KABUPATEN BANGKA TENGAH');
INSERT INTO `regencies` VALUES ('1905', '19', 'KABUPATEN BANGKA SELATAN');
INSERT INTO `regencies` VALUES ('1906', '19', 'KABUPATEN BELITUNG TIMUR');
INSERT INTO `regencies` VALUES ('1971', '19', 'KOTA PANGKAL PINANG');
INSERT INTO `regencies` VALUES ('2101', '21', 'KABUPATEN KARIMUN');
INSERT INTO `regencies` VALUES ('2102', '21', 'KABUPATEN BINTAN');
INSERT INTO `regencies` VALUES ('2103', '21', 'KABUPATEN NATUNA');
INSERT INTO `regencies` VALUES ('2104', '21', 'KABUPATEN LINGGA');
INSERT INTO `regencies` VALUES ('2105', '21', 'KABUPATEN KEPULAUAN ANAMBAS');
INSERT INTO `regencies` VALUES ('2171', '21', 'KOTA B A T A M');
INSERT INTO `regencies` VALUES ('2172', '21', 'KOTA TANJUNG PINANG');
INSERT INTO `regencies` VALUES ('3101', '31', 'KABUPATEN KEPULAUAN SERIBU');
INSERT INTO `regencies` VALUES ('3171', '31', 'KOTA JAKARTA SELATAN');
INSERT INTO `regencies` VALUES ('3172', '31', 'KOTA JAKARTA TIMUR');
INSERT INTO `regencies` VALUES ('3173', '31', 'KOTA JAKARTA PUSAT');
INSERT INTO `regencies` VALUES ('3174', '31', 'KOTA JAKARTA BARAT');
INSERT INTO `regencies` VALUES ('3175', '31', 'KOTA JAKARTA UTARA');
INSERT INTO `regencies` VALUES ('3201', '32', 'KABUPATEN BOGOR');
INSERT INTO `regencies` VALUES ('3202', '32', 'KABUPATEN SUKABUMI');
INSERT INTO `regencies` VALUES ('3203', '32', 'KABUPATEN CIANJUR');
INSERT INTO `regencies` VALUES ('3204', '32', 'KABUPATEN BANDUNG');
INSERT INTO `regencies` VALUES ('3205', '32', 'KABUPATEN GARUT');
INSERT INTO `regencies` VALUES ('3206', '32', 'KABUPATEN TASIKMALAYA');
INSERT INTO `regencies` VALUES ('3207', '32', 'KABUPATEN CIAMIS');
INSERT INTO `regencies` VALUES ('3208', '32', 'KABUPATEN KUNINGAN');
INSERT INTO `regencies` VALUES ('3209', '32', 'KABUPATEN CIREBON');
INSERT INTO `regencies` VALUES ('3210', '32', 'KABUPATEN MAJALENGKA');
INSERT INTO `regencies` VALUES ('3211', '32', 'KABUPATEN SUMEDANG');
INSERT INTO `regencies` VALUES ('3212', '32', 'KABUPATEN INDRAMAYU');
INSERT INTO `regencies` VALUES ('3213', '32', 'KABUPATEN SUBANG');
INSERT INTO `regencies` VALUES ('3214', '32', 'KABUPATEN PURWAKARTA');
INSERT INTO `regencies` VALUES ('3215', '32', 'KABUPATEN KARAWANG');
INSERT INTO `regencies` VALUES ('3216', '32', 'KABUPATEN BEKASI');
INSERT INTO `regencies` VALUES ('3217', '32', 'KABUPATEN BANDUNG BARAT');
INSERT INTO `regencies` VALUES ('3218', '32', 'KABUPATEN PANGANDARAN');
INSERT INTO `regencies` VALUES ('3271', '32', 'KOTA BOGOR');
INSERT INTO `regencies` VALUES ('3272', '32', 'KOTA SUKABUMI');
INSERT INTO `regencies` VALUES ('3273', '32', 'KOTA BANDUNG');
INSERT INTO `regencies` VALUES ('3274', '32', 'KOTA CIREBON');
INSERT INTO `regencies` VALUES ('3275', '32', 'KOTA BEKASI');
INSERT INTO `regencies` VALUES ('3276', '32', 'KOTA DEPOK');
INSERT INTO `regencies` VALUES ('3277', '32', 'KOTA CIMAHI');
INSERT INTO `regencies` VALUES ('3278', '32', 'KOTA TASIKMALAYA');
INSERT INTO `regencies` VALUES ('3279', '32', 'KOTA BANJAR');
INSERT INTO `regencies` VALUES ('3301', '33', 'KABUPATEN CILACAP');
INSERT INTO `regencies` VALUES ('3302', '33', 'KABUPATEN BANYUMAS');
INSERT INTO `regencies` VALUES ('3303', '33', 'KABUPATEN PURBALINGGA');
INSERT INTO `regencies` VALUES ('3304', '33', 'KABUPATEN BANJARNEGARA');
INSERT INTO `regencies` VALUES ('3305', '33', 'KABUPATEN KEBUMEN');
INSERT INTO `regencies` VALUES ('3306', '33', 'KABUPATEN PURWOREJO');
INSERT INTO `regencies` VALUES ('3307', '33', 'KABUPATEN WONOSOBO');
INSERT INTO `regencies` VALUES ('3308', '33', 'KABUPATEN MAGELANG');
INSERT INTO `regencies` VALUES ('3309', '33', 'KABUPATEN BOYOLALI');
INSERT INTO `regencies` VALUES ('3310', '33', 'KABUPATEN KLATEN');
INSERT INTO `regencies` VALUES ('3311', '33', 'KABUPATEN SUKOHARJO');
INSERT INTO `regencies` VALUES ('3312', '33', 'KABUPATEN WONOGIRI');
INSERT INTO `regencies` VALUES ('3313', '33', 'KABUPATEN KARANGANYAR');
INSERT INTO `regencies` VALUES ('3314', '33', 'KABUPATEN SRAGEN');
INSERT INTO `regencies` VALUES ('3315', '33', 'KABUPATEN GROBOGAN');
INSERT INTO `regencies` VALUES ('3316', '33', 'KABUPATEN BLORA');
INSERT INTO `regencies` VALUES ('3317', '33', 'KABUPATEN REMBANG');
INSERT INTO `regencies` VALUES ('3318', '33', 'KABUPATEN PATI');
INSERT INTO `regencies` VALUES ('3319', '33', 'KABUPATEN KUDUS');
INSERT INTO `regencies` VALUES ('3320', '33', 'KABUPATEN JEPARA');
INSERT INTO `regencies` VALUES ('3321', '33', 'KABUPATEN DEMAK');
INSERT INTO `regencies` VALUES ('3322', '33', 'KABUPATEN SEMARANG');
INSERT INTO `regencies` VALUES ('3323', '33', 'KABUPATEN TEMANGGUNG');
INSERT INTO `regencies` VALUES ('3324', '33', 'KABUPATEN KENDAL');
INSERT INTO `regencies` VALUES ('3325', '33', 'KABUPATEN BATANG');
INSERT INTO `regencies` VALUES ('3326', '33', 'KABUPATEN PEKALONGAN');
INSERT INTO `regencies` VALUES ('3327', '33', 'KABUPATEN PEMALANG');
INSERT INTO `regencies` VALUES ('3328', '33', 'KABUPATEN TEGAL');
INSERT INTO `regencies` VALUES ('3329', '33', 'KABUPATEN BREBES');
INSERT INTO `regencies` VALUES ('3371', '33', 'KOTA MAGELANG');
INSERT INTO `regencies` VALUES ('3372', '33', 'KOTA SURAKARTA');
INSERT INTO `regencies` VALUES ('3373', '33', 'KOTA SALATIGA');
INSERT INTO `regencies` VALUES ('3374', '33', 'KOTA SEMARANG');
INSERT INTO `regencies` VALUES ('3375', '33', 'KOTA PEKALONGAN');
INSERT INTO `regencies` VALUES ('3376', '33', 'KOTA TEGAL');
INSERT INTO `regencies` VALUES ('3401', '34', 'KABUPATEN KULON PROGO');
INSERT INTO `regencies` VALUES ('3402', '34', 'KABUPATEN BANTUL');
INSERT INTO `regencies` VALUES ('3403', '34', 'KABUPATEN GUNUNG KIDUL');
INSERT INTO `regencies` VALUES ('3404', '34', 'KABUPATEN SLEMAN');
INSERT INTO `regencies` VALUES ('3471', '34', 'KOTA YOGYAKARTA');
INSERT INTO `regencies` VALUES ('3501', '35', 'KABUPATEN PACITAN');
INSERT INTO `regencies` VALUES ('3502', '35', 'KABUPATEN PONOROGO');
INSERT INTO `regencies` VALUES ('3503', '35', 'KABUPATEN TRENGGALEK');
INSERT INTO `regencies` VALUES ('3504', '35', 'KABUPATEN TULUNGAGUNG');
INSERT INTO `regencies` VALUES ('3505', '35', 'KABUPATEN BLITAR');
INSERT INTO `regencies` VALUES ('3506', '35', 'KABUPATEN KEDIRI');
INSERT INTO `regencies` VALUES ('3507', '35', 'KABUPATEN MALANG');
INSERT INTO `regencies` VALUES ('3508', '35', 'KABUPATEN LUMAJANG');
INSERT INTO `regencies` VALUES ('3509', '35', 'KABUPATEN JEMBER');
INSERT INTO `regencies` VALUES ('3510', '35', 'KABUPATEN BANYUWANGI');
INSERT INTO `regencies` VALUES ('3511', '35', 'KABUPATEN BONDOWOSO');
INSERT INTO `regencies` VALUES ('3512', '35', 'KABUPATEN SITUBONDO');
INSERT INTO `regencies` VALUES ('3513', '35', 'KABUPATEN PROBOLINGGO');
INSERT INTO `regencies` VALUES ('3514', '35', 'KABUPATEN PASURUAN');
INSERT INTO `regencies` VALUES ('3515', '35', 'KABUPATEN SIDOARJO');
INSERT INTO `regencies` VALUES ('3516', '35', 'KABUPATEN MOJOKERTO');
INSERT INTO `regencies` VALUES ('3517', '35', 'KABUPATEN JOMBANG');
INSERT INTO `regencies` VALUES ('3518', '35', 'KABUPATEN NGANJUK');
INSERT INTO `regencies` VALUES ('3519', '35', 'KABUPATEN MADIUN');
INSERT INTO `regencies` VALUES ('3520', '35', 'KABUPATEN MAGETAN');
INSERT INTO `regencies` VALUES ('3521', '35', 'KABUPATEN NGAWI');
INSERT INTO `regencies` VALUES ('3522', '35', 'KABUPATEN BOJONEGORO');
INSERT INTO `regencies` VALUES ('3523', '35', 'KABUPATEN TUBAN');
INSERT INTO `regencies` VALUES ('3524', '35', 'KABUPATEN LAMONGAN');
INSERT INTO `regencies` VALUES ('3525', '35', 'KABUPATEN GRESIK');
INSERT INTO `regencies` VALUES ('3526', '35', 'KABUPATEN BANGKALAN');
INSERT INTO `regencies` VALUES ('3527', '35', 'KABUPATEN SAMPANG');
INSERT INTO `regencies` VALUES ('3528', '35', 'KABUPATEN PAMEKASAN');
INSERT INTO `regencies` VALUES ('3529', '35', 'KABUPATEN SUMENEP');
INSERT INTO `regencies` VALUES ('3571', '35', 'KOTA KEDIRI');
INSERT INTO `regencies` VALUES ('3572', '35', 'KOTA BLITAR');
INSERT INTO `regencies` VALUES ('3573', '35', 'KOTA MALANG');
INSERT INTO `regencies` VALUES ('3574', '35', 'KOTA PROBOLINGGO');
INSERT INTO `regencies` VALUES ('3575', '35', 'KOTA PASURUAN');
INSERT INTO `regencies` VALUES ('3576', '35', 'KOTA MOJOKERTO');
INSERT INTO `regencies` VALUES ('3577', '35', 'KOTA MADIUN');
INSERT INTO `regencies` VALUES ('3578', '35', 'KOTA SURABAYA');
INSERT INTO `regencies` VALUES ('3579', '35', 'KOTA BATU');
INSERT INTO `regencies` VALUES ('3601', '36', 'KABUPATEN PANDEGLANG');
INSERT INTO `regencies` VALUES ('3602', '36', 'KABUPATEN LEBAK');
INSERT INTO `regencies` VALUES ('3603', '36', 'KABUPATEN TANGERANG');
INSERT INTO `regencies` VALUES ('3604', '36', 'KABUPATEN SERANG');
INSERT INTO `regencies` VALUES ('3671', '36', 'KOTA TANGERANG');
INSERT INTO `regencies` VALUES ('3672', '36', 'KOTA CILEGON');
INSERT INTO `regencies` VALUES ('3673', '36', 'KOTA SERANG');
INSERT INTO `regencies` VALUES ('3674', '36', 'KOTA TANGERANG SELATAN');
INSERT INTO `regencies` VALUES ('5101', '51', 'KABUPATEN JEMBRANA');
INSERT INTO `regencies` VALUES ('5102', '51', 'KABUPATEN TABANAN');
INSERT INTO `regencies` VALUES ('5103', '51', 'KABUPATEN BADUNG');
INSERT INTO `regencies` VALUES ('5104', '51', 'KABUPATEN GIANYAR');
INSERT INTO `regencies` VALUES ('5105', '51', 'KABUPATEN KLUNGKUNG');
INSERT INTO `regencies` VALUES ('5106', '51', 'KABUPATEN BANGLI');
INSERT INTO `regencies` VALUES ('5107', '51', 'KABUPATEN KARANG ASEM');
INSERT INTO `regencies` VALUES ('5108', '51', 'KABUPATEN BULELENG');
INSERT INTO `regencies` VALUES ('5171', '51', 'KOTA DENPASAR');
INSERT INTO `regencies` VALUES ('5201', '52', 'KABUPATEN LOMBOK BARAT');
INSERT INTO `regencies` VALUES ('5202', '52', 'KABUPATEN LOMBOK TENGAH');
INSERT INTO `regencies` VALUES ('5203', '52', 'KABUPATEN LOMBOK TIMUR');
INSERT INTO `regencies` VALUES ('5204', '52', 'KABUPATEN SUMBAWA');
INSERT INTO `regencies` VALUES ('5205', '52', 'KABUPATEN DOMPU');
INSERT INTO `regencies` VALUES ('5206', '52', 'KABUPATEN BIMA');
INSERT INTO `regencies` VALUES ('5207', '52', 'KABUPATEN SUMBAWA BARAT');
INSERT INTO `regencies` VALUES ('5208', '52', 'KABUPATEN LOMBOK UTARA');
INSERT INTO `regencies` VALUES ('5271', '52', 'KOTA MATARAM');
INSERT INTO `regencies` VALUES ('5272', '52', 'KOTA BIMA');
INSERT INTO `regencies` VALUES ('5301', '53', 'KABUPATEN SUMBA BARAT');
INSERT INTO `regencies` VALUES ('5302', '53', 'KABUPATEN SUMBA TIMUR');
INSERT INTO `regencies` VALUES ('5303', '53', 'KABUPATEN KUPANG');
INSERT INTO `regencies` VALUES ('5304', '53', 'KABUPATEN TIMOR TENGAH SELATAN');
INSERT INTO `regencies` VALUES ('5305', '53', 'KABUPATEN TIMOR TENGAH UTARA');
INSERT INTO `regencies` VALUES ('5306', '53', 'KABUPATEN BELU');
INSERT INTO `regencies` VALUES ('5307', '53', 'KABUPATEN ALOR');
INSERT INTO `regencies` VALUES ('5308', '53', 'KABUPATEN LEMBATA');
INSERT INTO `regencies` VALUES ('5309', '53', 'KABUPATEN FLORES TIMUR');
INSERT INTO `regencies` VALUES ('5310', '53', 'KABUPATEN SIKKA');
INSERT INTO `regencies` VALUES ('5311', '53', 'KABUPATEN ENDE');
INSERT INTO `regencies` VALUES ('5312', '53', 'KABUPATEN NGADA');
INSERT INTO `regencies` VALUES ('5313', '53', 'KABUPATEN MANGGARAI');
INSERT INTO `regencies` VALUES ('5314', '53', 'KABUPATEN ROTE NDAO');
INSERT INTO `regencies` VALUES ('5315', '53', 'KABUPATEN MANGGARAI BARAT');
INSERT INTO `regencies` VALUES ('5316', '53', 'KABUPATEN SUMBA TENGAH');
INSERT INTO `regencies` VALUES ('5317', '53', 'KABUPATEN SUMBA BARAT DAYA');
INSERT INTO `regencies` VALUES ('5318', '53', 'KABUPATEN NAGEKEO');
INSERT INTO `regencies` VALUES ('5319', '53', 'KABUPATEN MANGGARAI TIMUR');
INSERT INTO `regencies` VALUES ('5320', '53', 'KABUPATEN SABU RAIJUA');
INSERT INTO `regencies` VALUES ('5321', '53', 'KABUPATEN MALAKA');
INSERT INTO `regencies` VALUES ('5371', '53', 'KOTA KUPANG');
INSERT INTO `regencies` VALUES ('6101', '61', 'KABUPATEN SAMBAS');
INSERT INTO `regencies` VALUES ('6102', '61', 'KABUPATEN BENGKAYANG');
INSERT INTO `regencies` VALUES ('6103', '61', 'KABUPATEN LANDAK');
INSERT INTO `regencies` VALUES ('6104', '61', 'KABUPATEN MEMPAWAH');
INSERT INTO `regencies` VALUES ('6105', '61', 'KABUPATEN SANGGAU');
INSERT INTO `regencies` VALUES ('6106', '61', 'KABUPATEN KETAPANG');
INSERT INTO `regencies` VALUES ('6107', '61', 'KABUPATEN SINTANG');
INSERT INTO `regencies` VALUES ('6108', '61', 'KABUPATEN KAPUAS HULU');
INSERT INTO `regencies` VALUES ('6109', '61', 'KABUPATEN SEKADAU');
INSERT INTO `regencies` VALUES ('6110', '61', 'KABUPATEN MELAWI');
INSERT INTO `regencies` VALUES ('6111', '61', 'KABUPATEN KAYONG UTARA');
INSERT INTO `regencies` VALUES ('6112', '61', 'KABUPATEN KUBU RAYA');
INSERT INTO `regencies` VALUES ('6171', '61', 'KOTA PONTIANAK');
INSERT INTO `regencies` VALUES ('6172', '61', 'KOTA SINGKAWANG');
INSERT INTO `regencies` VALUES ('6201', '62', 'KABUPATEN KOTAWARINGIN BARAT');
INSERT INTO `regencies` VALUES ('6202', '62', 'KABUPATEN KOTAWARINGIN TIMUR');
INSERT INTO `regencies` VALUES ('6203', '62', 'KABUPATEN KAPUAS');
INSERT INTO `regencies` VALUES ('6204', '62', 'KABUPATEN BARITO SELATAN');
INSERT INTO `regencies` VALUES ('6205', '62', 'KABUPATEN BARITO UTARA');
INSERT INTO `regencies` VALUES ('6206', '62', 'KABUPATEN SUKAMARA');
INSERT INTO `regencies` VALUES ('6207', '62', 'KABUPATEN LAMANDAU');
INSERT INTO `regencies` VALUES ('6208', '62', 'KABUPATEN SERUYAN');
INSERT INTO `regencies` VALUES ('6209', '62', 'KABUPATEN KATINGAN');
INSERT INTO `regencies` VALUES ('6210', '62', 'KABUPATEN PULANG PISAU');
INSERT INTO `regencies` VALUES ('6211', '62', 'KABUPATEN GUNUNG MAS');
INSERT INTO `regencies` VALUES ('6212', '62', 'KABUPATEN BARITO TIMUR');
INSERT INTO `regencies` VALUES ('6213', '62', 'KABUPATEN MURUNG RAYA');
INSERT INTO `regencies` VALUES ('6271', '62', 'KOTA PALANGKA RAYA');
INSERT INTO `regencies` VALUES ('6301', '63', 'KABUPATEN TANAH LAUT');
INSERT INTO `regencies` VALUES ('6302', '63', 'KABUPATEN KOTA BARU');
INSERT INTO `regencies` VALUES ('6303', '63', 'KABUPATEN BANJAR');
INSERT INTO `regencies` VALUES ('6304', '63', 'KABUPATEN BARITO KUALA');
INSERT INTO `regencies` VALUES ('6305', '63', 'KABUPATEN TAPIN');
INSERT INTO `regencies` VALUES ('6306', '63', 'KABUPATEN HULU SUNGAI SELATAN');
INSERT INTO `regencies` VALUES ('6307', '63', 'KABUPATEN HULU SUNGAI TENGAH');
INSERT INTO `regencies` VALUES ('6308', '63', 'KABUPATEN HULU SUNGAI UTARA');
INSERT INTO `regencies` VALUES ('6309', '63', 'KABUPATEN TABALONG');
INSERT INTO `regencies` VALUES ('6310', '63', 'KABUPATEN TANAH BUMBU');
INSERT INTO `regencies` VALUES ('6311', '63', 'KABUPATEN BALANGAN');
INSERT INTO `regencies` VALUES ('6371', '63', 'KOTA BANJARMASIN');
INSERT INTO `regencies` VALUES ('6372', '63', 'KOTA BANJAR BARU');
INSERT INTO `regencies` VALUES ('6401', '64', 'KABUPATEN PASER');
INSERT INTO `regencies` VALUES ('6402', '64', 'KABUPATEN KUTAI BARAT');
INSERT INTO `regencies` VALUES ('6403', '64', 'KABUPATEN KUTAI KARTANEGARA');
INSERT INTO `regencies` VALUES ('6404', '64', 'KABUPATEN KUTAI TIMUR');
INSERT INTO `regencies` VALUES ('6405', '64', 'KABUPATEN BERAU');
INSERT INTO `regencies` VALUES ('6409', '64', 'KABUPATEN PENAJAM PASER UTARA');
INSERT INTO `regencies` VALUES ('6411', '64', 'KABUPATEN MAHAKAM HULU');
INSERT INTO `regencies` VALUES ('6471', '64', 'KOTA BALIKPAPAN');
INSERT INTO `regencies` VALUES ('6472', '64', 'KOTA SAMARINDA');
INSERT INTO `regencies` VALUES ('6474', '64', 'KOTA BONTANG');
INSERT INTO `regencies` VALUES ('6501', '65', 'KABUPATEN MALINAU');
INSERT INTO `regencies` VALUES ('6502', '65', 'KABUPATEN BULUNGAN');
INSERT INTO `regencies` VALUES ('6503', '65', 'KABUPATEN TANA TIDUNG');
INSERT INTO `regencies` VALUES ('6504', '65', 'KABUPATEN NUNUKAN');
INSERT INTO `regencies` VALUES ('6571', '65', 'KOTA TARAKAN');
INSERT INTO `regencies` VALUES ('7101', '71', 'KABUPATEN BOLAANG MONGONDOW');
INSERT INTO `regencies` VALUES ('7102', '71', 'KABUPATEN MINAHASA');
INSERT INTO `regencies` VALUES ('7103', '71', 'KABUPATEN KEPULAUAN SANGIHE');
INSERT INTO `regencies` VALUES ('7104', '71', 'KABUPATEN KEPULAUAN TALAUD');
INSERT INTO `regencies` VALUES ('7105', '71', 'KABUPATEN MINAHASA SELATAN');
INSERT INTO `regencies` VALUES ('7106', '71', 'KABUPATEN MINAHASA UTARA');
INSERT INTO `regencies` VALUES ('7107', '71', 'KABUPATEN BOLAANG MONGONDOW UTARA');
INSERT INTO `regencies` VALUES ('7108', '71', 'KABUPATEN SIAU TAGULANDANG BIARO');
INSERT INTO `regencies` VALUES ('7109', '71', 'KABUPATEN MINAHASA TENGGARA');
INSERT INTO `regencies` VALUES ('7110', '71', 'KABUPATEN BOLAANG MONGONDOW SELATAN');
INSERT INTO `regencies` VALUES ('7111', '71', 'KABUPATEN BOLAANG MONGONDOW TIMUR');
INSERT INTO `regencies` VALUES ('7171', '71', 'KOTA MANADO');
INSERT INTO `regencies` VALUES ('7172', '71', 'KOTA BITUNG');
INSERT INTO `regencies` VALUES ('7173', '71', 'KOTA TOMOHON');
INSERT INTO `regencies` VALUES ('7174', '71', 'KOTA KOTAMOBAGU');
INSERT INTO `regencies` VALUES ('7201', '72', 'KABUPATEN BANGGAI KEPULAUAN');
INSERT INTO `regencies` VALUES ('7202', '72', 'KABUPATEN BANGGAI');
INSERT INTO `regencies` VALUES ('7203', '72', 'KABUPATEN MOROWALI');
INSERT INTO `regencies` VALUES ('7204', '72', 'KABUPATEN POSO');
INSERT INTO `regencies` VALUES ('7205', '72', 'KABUPATEN DONGGALA');
INSERT INTO `regencies` VALUES ('7206', '72', 'KABUPATEN TOLI-TOLI');
INSERT INTO `regencies` VALUES ('7207', '72', 'KABUPATEN BUOL');
INSERT INTO `regencies` VALUES ('7208', '72', 'KABUPATEN PARIGI MOUTONG');
INSERT INTO `regencies` VALUES ('7209', '72', 'KABUPATEN TOJO UNA-UNA');
INSERT INTO `regencies` VALUES ('7210', '72', 'KABUPATEN SIGI');
INSERT INTO `regencies` VALUES ('7211', '72', 'KABUPATEN BANGGAI LAUT');
INSERT INTO `regencies` VALUES ('7212', '72', 'KABUPATEN MOROWALI UTARA');
INSERT INTO `regencies` VALUES ('7271', '72', 'KOTA PALU');
INSERT INTO `regencies` VALUES ('7301', '73', 'KABUPATEN KEPULAUAN SELAYAR');
INSERT INTO `regencies` VALUES ('7302', '73', 'KABUPATEN BULUKUMBA');
INSERT INTO `regencies` VALUES ('7303', '73', 'KABUPATEN BANTAENG');
INSERT INTO `regencies` VALUES ('7304', '73', 'KABUPATEN JENEPONTO');
INSERT INTO `regencies` VALUES ('7305', '73', 'KABUPATEN TAKALAR');
INSERT INTO `regencies` VALUES ('7306', '73', 'KABUPATEN GOWA');
INSERT INTO `regencies` VALUES ('7307', '73', 'KABUPATEN SINJAI');
INSERT INTO `regencies` VALUES ('7308', '73', 'KABUPATEN MAROS');
INSERT INTO `regencies` VALUES ('7309', '73', 'KABUPATEN PANGKAJENE DAN KEPULAUAN');
INSERT INTO `regencies` VALUES ('7310', '73', 'KABUPATEN BARRU');
INSERT INTO `regencies` VALUES ('7311', '73', 'KABUPATEN BONE');
INSERT INTO `regencies` VALUES ('7312', '73', 'KABUPATEN SOPPENG');
INSERT INTO `regencies` VALUES ('7313', '73', 'KABUPATEN WAJO');
INSERT INTO `regencies` VALUES ('7314', '73', 'KABUPATEN SIDENRENG RAPPANG');
INSERT INTO `regencies` VALUES ('7315', '73', 'KABUPATEN PINRANG');
INSERT INTO `regencies` VALUES ('7316', '73', 'KABUPATEN ENREKANG');
INSERT INTO `regencies` VALUES ('7317', '73', 'KABUPATEN LUWU');
INSERT INTO `regencies` VALUES ('7318', '73', 'KABUPATEN TANA TORAJA');
INSERT INTO `regencies` VALUES ('7322', '73', 'KABUPATEN LUWU UTARA');
INSERT INTO `regencies` VALUES ('7325', '73', 'KABUPATEN LUWU TIMUR');
INSERT INTO `regencies` VALUES ('7326', '73', 'KABUPATEN TORAJA UTARA');
INSERT INTO `regencies` VALUES ('7371', '73', 'KOTA MAKASSAR');
INSERT INTO `regencies` VALUES ('7372', '73', 'KOTA PAREPARE');
INSERT INTO `regencies` VALUES ('7373', '73', 'KOTA PALOPO');
INSERT INTO `regencies` VALUES ('7401', '74', 'KABUPATEN BUTON');
INSERT INTO `regencies` VALUES ('7402', '74', 'KABUPATEN MUNA');
INSERT INTO `regencies` VALUES ('7403', '74', 'KABUPATEN KONAWE');
INSERT INTO `regencies` VALUES ('7404', '74', 'KABUPATEN KOLAKA');
INSERT INTO `regencies` VALUES ('7405', '74', 'KABUPATEN KONAWE SELATAN');
INSERT INTO `regencies` VALUES ('7406', '74', 'KABUPATEN BOMBANA');
INSERT INTO `regencies` VALUES ('7407', '74', 'KABUPATEN WAKATOBI');
INSERT INTO `regencies` VALUES ('7408', '74', 'KABUPATEN KOLAKA UTARA');
INSERT INTO `regencies` VALUES ('7409', '74', 'KABUPATEN BUTON UTARA');
INSERT INTO `regencies` VALUES ('7410', '74', 'KABUPATEN KONAWE UTARA');
INSERT INTO `regencies` VALUES ('7411', '74', 'KABUPATEN KOLAKA TIMUR');
INSERT INTO `regencies` VALUES ('7412', '74', 'KABUPATEN KONAWE KEPULAUAN');
INSERT INTO `regencies` VALUES ('7413', '74', 'KABUPATEN MUNA BARAT');
INSERT INTO `regencies` VALUES ('7414', '74', 'KABUPATEN BUTON TENGAH');
INSERT INTO `regencies` VALUES ('7415', '74', 'KABUPATEN BUTON SELATAN');
INSERT INTO `regencies` VALUES ('7471', '74', 'KOTA KENDARI');
INSERT INTO `regencies` VALUES ('7472', '74', 'KOTA BAUBAU');
INSERT INTO `regencies` VALUES ('7501', '75', 'KABUPATEN BOALEMO');
INSERT INTO `regencies` VALUES ('7502', '75', 'KABUPATEN GORONTALO');
INSERT INTO `regencies` VALUES ('7503', '75', 'KABUPATEN POHUWATO');
INSERT INTO `regencies` VALUES ('7504', '75', 'KABUPATEN BONE BOLANGO');
INSERT INTO `regencies` VALUES ('7505', '75', 'KABUPATEN GORONTALO UTARA');
INSERT INTO `regencies` VALUES ('7571', '75', 'KOTA GORONTALO');
INSERT INTO `regencies` VALUES ('7601', '76', 'KABUPATEN MAJENE');
INSERT INTO `regencies` VALUES ('7602', '76', 'KABUPATEN POLEWALI MANDAR');
INSERT INTO `regencies` VALUES ('7603', '76', 'KABUPATEN MAMASA');
INSERT INTO `regencies` VALUES ('7604', '76', 'KABUPATEN MAMUJU');
INSERT INTO `regencies` VALUES ('7605', '76', 'KABUPATEN MAMUJU UTARA');
INSERT INTO `regencies` VALUES ('7606', '76', 'KABUPATEN MAMUJU TENGAH');
INSERT INTO `regencies` VALUES ('8101', '81', 'KABUPATEN MALUKU TENGGARA BARAT');
INSERT INTO `regencies` VALUES ('8102', '81', 'KABUPATEN MALUKU TENGGARA');
INSERT INTO `regencies` VALUES ('8103', '81', 'KABUPATEN MALUKU TENGAH');
INSERT INTO `regencies` VALUES ('8104', '81', 'KABUPATEN BURU');
INSERT INTO `regencies` VALUES ('8105', '81', 'KABUPATEN KEPULAUAN ARU');
INSERT INTO `regencies` VALUES ('8106', '81', 'KABUPATEN SERAM BAGIAN BARAT');
INSERT INTO `regencies` VALUES ('8107', '81', 'KABUPATEN SERAM BAGIAN TIMUR');
INSERT INTO `regencies` VALUES ('8108', '81', 'KABUPATEN MALUKU BARAT DAYA');
INSERT INTO `regencies` VALUES ('8109', '81', 'KABUPATEN BURU SELATAN');
INSERT INTO `regencies` VALUES ('8171', '81', 'KOTA AMBON');
INSERT INTO `regencies` VALUES ('8172', '81', 'KOTA TUAL');
INSERT INTO `regencies` VALUES ('8201', '82', 'KABUPATEN HALMAHERA BARAT');
INSERT INTO `regencies` VALUES ('8202', '82', 'KABUPATEN HALMAHERA TENGAH');
INSERT INTO `regencies` VALUES ('8203', '82', 'KABUPATEN KEPULAUAN SULA');
INSERT INTO `regencies` VALUES ('8204', '82', 'KABUPATEN HALMAHERA SELATAN');
INSERT INTO `regencies` VALUES ('8205', '82', 'KABUPATEN HALMAHERA UTARA');
INSERT INTO `regencies` VALUES ('8206', '82', 'KABUPATEN HALMAHERA TIMUR');
INSERT INTO `regencies` VALUES ('8207', '82', 'KABUPATEN PULAU MOROTAI');
INSERT INTO `regencies` VALUES ('8208', '82', 'KABUPATEN PULAU TALIABU');
INSERT INTO `regencies` VALUES ('8271', '82', 'KOTA TERNATE');
INSERT INTO `regencies` VALUES ('8272', '82', 'KOTA TIDORE KEPULAUAN');
INSERT INTO `regencies` VALUES ('9101', '91', 'KABUPATEN FAKFAK');
INSERT INTO `regencies` VALUES ('9102', '91', 'KABUPATEN KAIMANA');
INSERT INTO `regencies` VALUES ('9103', '91', 'KABUPATEN TELUK WONDAMA');
INSERT INTO `regencies` VALUES ('9104', '91', 'KABUPATEN TELUK BINTUNI');
INSERT INTO `regencies` VALUES ('9105', '91', 'KABUPATEN MANOKWARI');
INSERT INTO `regencies` VALUES ('9106', '91', 'KABUPATEN SORONG SELATAN');
INSERT INTO `regencies` VALUES ('9107', '91', 'KABUPATEN SORONG');
INSERT INTO `regencies` VALUES ('9108', '91', 'KABUPATEN RAJA AMPAT');
INSERT INTO `regencies` VALUES ('9109', '91', 'KABUPATEN TAMBRAUW');
INSERT INTO `regencies` VALUES ('9110', '91', 'KABUPATEN MAYBRAT');
INSERT INTO `regencies` VALUES ('9111', '91', 'KABUPATEN MANOKWARI SELATAN');
INSERT INTO `regencies` VALUES ('9112', '91', 'KABUPATEN PEGUNUNGAN ARFAK');
INSERT INTO `regencies` VALUES ('9171', '91', 'KOTA SORONG');
INSERT INTO `regencies` VALUES ('9401', '94', 'KABUPATEN MERAUKE');
INSERT INTO `regencies` VALUES ('9402', '94', 'KABUPATEN JAYAWIJAYA');
INSERT INTO `regencies` VALUES ('9403', '94', 'KABUPATEN JAYAPURA');
INSERT INTO `regencies` VALUES ('9404', '94', 'KABUPATEN NABIRE');
INSERT INTO `regencies` VALUES ('9408', '94', 'KABUPATEN KEPULAUAN YAPEN');
INSERT INTO `regencies` VALUES ('9409', '94', 'KABUPATEN BIAK NUMFOR');
INSERT INTO `regencies` VALUES ('9410', '94', 'KABUPATEN PANIAI');
INSERT INTO `regencies` VALUES ('9411', '94', 'KABUPATEN PUNCAK JAYA');
INSERT INTO `regencies` VALUES ('9412', '94', 'KABUPATEN MIMIKA');
INSERT INTO `regencies` VALUES ('9413', '94', 'KABUPATEN BOVEN DIGOEL');
INSERT INTO `regencies` VALUES ('9414', '94', 'KABUPATEN MAPPI');
INSERT INTO `regencies` VALUES ('9415', '94', 'KABUPATEN ASMAT');
INSERT INTO `regencies` VALUES ('9416', '94', 'KABUPATEN YAHUKIMO');
INSERT INTO `regencies` VALUES ('9417', '94', 'KABUPATEN PEGUNUNGAN BINTANG');
INSERT INTO `regencies` VALUES ('9418', '94', 'KABUPATEN TOLIKARA');
INSERT INTO `regencies` VALUES ('9419', '94', 'KABUPATEN SARMI');
INSERT INTO `regencies` VALUES ('9420', '94', 'KABUPATEN KEEROM');
INSERT INTO `regencies` VALUES ('9426', '94', 'KABUPATEN WAROPEN');
INSERT INTO `regencies` VALUES ('9427', '94', 'KABUPATEN SUPIORI');
INSERT INTO `regencies` VALUES ('9428', '94', 'KABUPATEN MAMBERAMO RAYA');
INSERT INTO `regencies` VALUES ('9429', '94', 'KABUPATEN NDUGA');
INSERT INTO `regencies` VALUES ('9430', '94', 'KABUPATEN LANNY JAYA');
INSERT INTO `regencies` VALUES ('9431', '94', 'KABUPATEN MAMBERAMO TENGAH');
INSERT INTO `regencies` VALUES ('9432', '94', 'KABUPATEN YALIMO');
INSERT INTO `regencies` VALUES ('9433', '94', 'KABUPATEN PUNCAK');
INSERT INTO `regencies` VALUES ('9434', '94', 'KABUPATEN DOGIYAI');
INSERT INTO `regencies` VALUES ('9435', '94', 'KABUPATEN INTAN JAYA');
INSERT INTO `regencies` VALUES ('9436', '94', 'KABUPATEN DEIYAI');
INSERT INTO `regencies` VALUES ('9471', '94', 'KOTA JAYAPURA');

-- ----------------------------
-- Table structure for `sumber_air`
-- ----------------------------
DROP TABLE IF EXISTS `sumber_air`;
CREATE TABLE `sumber_air` (
  `id_sumber_air` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sumber_air` varchar(100) NOT NULL,
  `kondisi_sumber_air` varchar(100) DEFAULT NULL,
  `suhu` decimal(10,0) NOT NULL,
  `warna` varchar(10) NOT NULL,
  `pH` decimal(10,1) NOT NULL,
  `layak_minum` varchar(10) NOT NULL,
  `id_jenis_sumber_air` int(11) NOT NULL,
  `id_kabupaten` int(4) NOT NULL,
  `foto_sumber_air` varchar(100) NOT NULL,
  PRIMARY KEY (`id_sumber_air`),
  KEY `id_jenis_sumber_air` (`id_jenis_sumber_air`),
  KEY `kabupaten` (`id_kabupaten`),
  CONSTRAINT `jenis_sumber_air` FOREIGN KEY (`id_jenis_sumber_air`) REFERENCES `jenis_sumber_air` (`id_jenis_sumber_air`),
  CONSTRAINT `kabupaten` FOREIGN KEY (`id_kabupaten`) REFERENCES `regencies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of sumber_air
-- ----------------------------
INSERT INTO `sumber_air` VALUES ('1', 'Waduk Jati Luhur', 'Rusak Sedang', '26', 'Keruh', '7.6', 'Tidak', '3', '3214', 'foto_waduk_jatiluhur.jpg');
INSERT INTO `sumber_air` VALUES ('2', 'Sungai Citarum', 'Baik', '28', 'Bening', '7.3', 'Layak', '5', '3204', 'foto_sungai_citarum.jpg');
INSERT INTO `sumber_air` VALUES ('3', 'Mata Air Aqua Cipondok', 'Baik', '26', 'Bening', '7.4', 'Layak', '1', '3213', 'foto_mata_air_aqua_cipondok.jpg');
INSERT INTO `sumber_air` VALUES ('4', 'Sungai Ciliwung', 'Rusak Sedang', '29', 'Keruh', '7.9', 'Tidak', '5', '3175', 'foto_sungai_ciliwung.jpg');
INSERT INTO `sumber_air` VALUES ('5', 'Mata Air Lubuk Bonta', 'Baik', '26', 'Bening', '7.4', 'Layak', '1', '1306', 'foto_mata_air_lubuk_bonta.jpg');
INSERT INTO `sumber_air` VALUES ('6', 'Waduk Sermo', 'Rusak Sedang', '29', 'Keruh', '7.7', 'Tidak', '3', '3401', 'foto_waduk_sermo.jpg');
INSERT INTO `sumber_air` VALUES ('7', 'Sumur Abadi', 'Baik', '26', 'Bening', '7.3', 'Layak', '2', '3374', 'foto_sumur_abadi_semarang.jpg');
INSERT INTO `sumber_air` VALUES ('8', 'Danau Cermin Lamaru', 'Baik', '25', 'Bening', '7.3', 'Layak', '4', '6471', 'foto_danau_cermin_lamaru.jpg');
INSERT INTO `sumber_air` VALUES ('9', 'Danau Batur', 'Rusak Parah', '30', 'Keruh', '6.9', 'Tidak', '4', '5106', 'foto_danau_batur_bali.jpg');
INSERT INTO `sumber_air` VALUES ('10', 'Sungai Bengawan Solo', 'Rusak Parah', '29', 'Keruh', '8.2', 'Tidak', '5', '3372', 'foto_sungai_bengawan_solo.jpg');
INSERT INTO `sumber_air` VALUES ('11', 'Sungai Musi', 'Rusak Sedang', '30', 'Keruh', '8.2', 'Tidak', '5', '1671', 'foto_sungai_musi.jpg');
INSERT INTO `sumber_air` VALUES ('12', 'Danau Toba', 'Baik', '24', 'Bening', '7.2', 'Layak', '4', '1217', 'foto_danau_toba.jpg');
INSERT INTO `sumber_air` VALUES ('13', 'Waduk Riam Kanan', 'Rusak Parah', '29', 'Keruh', '8.6', 'Tidak', '3', '6303', 'foto_waduk_riam_kanan.jpg');
INSERT INTO `sumber_air` VALUES ('14', 'Sungai Barito', 'Rusak Parah', '31', 'Keruh', '6.0', 'Tidak', '5', '6371', 'foto_sungai_barito.jpg');
INSERT INTO `sumber_air` VALUES ('15', 'Mata Air Nyandeng', 'Baik', '23', 'Bening', '7.2', 'Layak', '1', '6405', 'foto_mata_air_nyandeng.jpg');
INSERT INTO `sumber_air` VALUES ('16', 'Danau Laguna', 'Rusak Sedang', '29', 'Keruh', '8.5', 'Tidak', '4', '8271', 'foto_danau_laguna.jpg');
INSERT INTO `sumber_air` VALUES ('17', 'Danau Sentani', 'Baik', '22', 'Bening', '7.1', 'Layak', '4', '9471', 'foto_danau_sentani.jpg');
INSERT INTO `sumber_air` VALUES ('18', 'Sumur Raksasa', 'Rusak Sedang', '31', 'Keruh', '6.6', 'Tidak', '2', '3310', 'foto_sumur_raksasa_klaten.jpg');
INSERT INTO `sumber_air` VALUES ('19', 'Sungai Mamberamo', 'Rusak Sedang', '28', 'Keruh', '6.4', 'Tidak', '5', '9419', 'foto_sungai_mamberamo.jpg');
INSERT INTO `sumber_air` VALUES ('20', 'Mata Air Belanda', 'Baik', '25', 'Bening', '7.4', 'Layak', '1', '8204', 'foto_mata_air_belanda_maluku.jpg');

-- ----------------------------
-- Table structure for `sumber_air_upaya_peningkatan`
-- ----------------------------
DROP TABLE IF EXISTS `sumber_air_upaya_peningkatan`;
CREATE TABLE `sumber_air_upaya_peningkatan` (
  `id_sumber_air_upaya_peningkatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_sumber_air` int(11) NOT NULL,
  `id_upaya_peningkatan_ketersediaan_air` int(11) NOT NULL,
  PRIMARY KEY (`id_sumber_air_upaya_peningkatan`),
  KEY `id_sumber_air` (`id_sumber_air`),
  KEY `id_upaya_peningkatan` (`id_upaya_peningkatan_ketersediaan_air`),
  CONSTRAINT `id_sumber_air` FOREIGN KEY (`id_sumber_air`) REFERENCES `sumber_air` (`id_sumber_air`) ON DELETE CASCADE,
  CONSTRAINT `id_upaya_peningkatan` FOREIGN KEY (`id_upaya_peningkatan_ketersediaan_air`) REFERENCES `upaya_peningkatan_ketersediaan_air` (`id_upaya_ketersediaan_air`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of sumber_air_upaya_peningkatan
-- ----------------------------
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('66', '3', '2');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('67', '3', '4');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('68', '3', '5');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('79', '11', '1');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('80', '11', '5');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('81', '11', '6');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('82', '12', '1');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('83', '13', '1');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('84', '13', '2');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('85', '13', '6');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('86', '14', '2');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('87', '14', '4');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('88', '14', '5');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('89', '15', '1');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('90', '15', '7');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('91', '16', '1');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('92', '16', '7');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('93', '17', '1');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('94', '17', '7');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('95', '18', '1');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('96', '18', '5');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('97', '18', '7');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('101', '20', '5');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('102', '20', '7');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('106', '2', '1');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('107', '2', '2');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('108', '2', '7');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('109', '4', '1');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('110', '4', '2');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('111', '4', '3');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('112', '4', '4');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('113', '5', '4');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('114', '5', '5');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('115', '6', '2');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('116', '6', '3');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('117', '6', '4');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('122', '8', '1');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('123', '8', '2');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('124', '8', '5');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('125', '9', '2');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('126', '9', '3');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('127', '9', '4');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('131', '19', '4');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('132', '19', '6');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('133', '19', '7');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('141', '7', '1');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('142', '7', '2');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('143', '7', '5');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('144', '7', '6');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('145', '1', '1');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('146', '1', '2');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('147', '1', '7');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('148', '10', '2');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('149', '10', '3');
INSERT INTO `sumber_air_upaya_peningkatan` VALUES ('150', '10', '4');

-- ----------------------------
-- Table structure for `upaya_peningkatan_ketersediaan_air`
-- ----------------------------
DROP TABLE IF EXISTS `upaya_peningkatan_ketersediaan_air`;
CREATE TABLE `upaya_peningkatan_ketersediaan_air` (
  `id_upaya_ketersediaan_air` int(11) NOT NULL AUTO_INCREMENT,
  `nama_upaya` text NOT NULL,
  PRIMARY KEY (`id_upaya_ketersediaan_air`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of upaya_peningkatan_ketersediaan_air
-- ----------------------------
INSERT INTO `upaya_peningkatan_ketersediaan_air` VALUES ('1', ' Memberikan kesadaran terhadap masyarakat tentang arti lingkungan hidup sehingga manusia lebih mencintai lingkungan hidupnya.');
INSERT INTO `upaya_peningkatan_ketersediaan_air` VALUES ('2', 'Pengawasan terhadap penggunaan jenis-jenis zat kimia dan pestisida karena dapat menimbulkan pencemaran air.');
INSERT INTO `upaya_peningkatan_ketersediaan_air` VALUES ('3', 'Memperluas gerakan penghijauan.');
INSERT INTO `upaya_peningkatan_ketersediaan_air` VALUES ('4', 'Menempatkan daerah industri atau tempat-tempat pabrik jaug dari sekitar daerah perumahan-pemukiman.');
INSERT INTO `upaya_peningkatan_ketersediaan_air` VALUES ('5', 'Keamanan terhadap air minum harus mendapat perhatian yang khusus, baik dari pemrintah maupun kita sebagai warga masyarakat.');
INSERT INTO `upaya_peningkatan_ketersediaan_air` VALUES ('6', 'Menggunakan air bersih dengan bijaksana atau seperlunya saja');
INSERT INTO `upaya_peningkatan_ketersediaan_air` VALUES ('7', 'Tidak membuang sampah sembarangan');
DELIMITER ;;
CREATE TRIGGER `tr_log_update_sumber_air` BEFORE UPDATE ON `sumber_air` FOR EACH ROW BEGIN
 		INSERT INTO log_update_sumber_air (id_sumber_air, old_nama_sumber_air, old_kondisi_sumber_air, old_suhu, old_warna, old_pH, old_layak_minum, old_id_jenis_sumber_air, old_id_kabupaten, old_foto_sumber_air, tgl_update) VALUES( OLD.id_sumber_air, OLD.nama_sumber_air, OLD.kondisi_sumber_air, OLD.suhu, OLD.warna, OLD.pH, OLD.layak_minum, OLD.id_jenis_sumber_air, OLD.id_kabupaten, OLD.foto_sumber_air, NOW());
 END
;;
DELIMITER ;
DELIMITER ;;
CREATE TRIGGER `tr_log_delete_sumber_air` BEFORE DELETE ON `sumber_air` FOR EACH ROW BEGIN
 		INSERT INTO log_delete_sumber_air (id_sumber_air, nama_sumber_air, kondisi_sumber_air, suhu, warna, pH, layak_minum, id_jenis_sumber_air, id_kabupaten, foto_sumber_air, tgl_delete) VALUES( OLD.id_sumber_air, OLD.nama_sumber_air, OLD.kondisi_sumber_air, OLD.suhu, OLD.warna, OLD.pH, OLD.layak_minum, OLD.id_jenis_sumber_air, OLD.id_kabupaten, OLD.foto_sumber_air, NOW());
 END
;;
DELIMITER ;
