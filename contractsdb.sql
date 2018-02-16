/*
Navicat MySQL Data Transfer

Source Server         : MYSQL
Source Server Version : 100122
Source Host           : localhost:3306
Source Database       : contractsdb

Target Server Type    : MYSQL
Target Server Version : 100122
File Encoding         : 65001

Date: 2018-01-29 08:28:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cna
-- ----------------------------
DROP TABLE IF EXISTS `cna`;
CREATE TABLE `cna` (
  `id` int(11) NOT NULL,
  `reeup_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nit_code` int(11) NOT NULL,
  `social_object` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_741BBB8CBF396750` FOREIGN KEY (`id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cna
-- ----------------------------

-- ----------------------------
-- Table structure for contract
-- ----------------------------
DROP TABLE IF EXISTS `contract`;
CREATE TABLE `contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suplier_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `days` int(11) NOT NULL,
  `expiration_date` date NOT NULL,
  `start_date` date NOT NULL,
  `contractualObject` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cuc_value` double NOT NULL,
  `cup_value` double NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agreement_no_uasi` int(11) NOT NULL,
  `agreement_no_cubanacan` int(11) DEFAULT NULL,
  `contract_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` double NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `agreement_date_uasi` date NOT NULL,
  `agreement_date_cc` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E98F28598299B5EC` (`suplier_id`),
  KEY `IDX_E98F2859A76ED395` (`user_id`),
  KEY `IDX_E98F2859AE80F5DF` (`department_id`),
  CONSTRAINT `FK_E98F28598299B5EC` FOREIGN KEY (`suplier_id`) REFERENCES `supplier` (`id`),
  CONSTRAINT `FK_E98F2859A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_E98F2859AE80F5DF` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of contract
-- ----------------------------
INSERT INTO `contract` VALUES ('2', '2', '3', '52', '2017-01-16', '2017-01-16', 'dfhjdjfhjdfh', '5555', '4444', 'prestacion de serviciosd', '5', '6', '', '0', null, '0000-00-00', null);
INSERT INTO `contract` VALUES ('3', '1', '2', '58', '2017-01-17', '2017-01-17', 'dfdhhdf', '555', '555', 'jhfjdhfj', '888888', '8888', '', '0', null, '0000-00-00', null);
INSERT INTO `contract` VALUES ('4', '2', '1', '555', '2018-01-17', '2017-01-17', 'jhdfjhjh', '888', '8888', 'fhjdhjf', '555', '555', '12', '0', null, '0000-00-00', null);
INSERT INTO `contract` VALUES ('7', '2', null, '55', '2018-03-16', '2017-11-13', 'kdjfkkdfjkdjfk', '55', '55', 'kajkfj', '55', '55', '22', '55', null, '0000-00-00', null);

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES ('1', 'Informática');
INSERT INTO `department` VALUES ('2', 'Jurídico');
INSERT INTO `department` VALUES ('3', 'UASI');
INSERT INTO `department` VALUES ('4', 'Promoción');

-- ----------------------------
-- Table structure for ee
-- ----------------------------
DROP TABLE IF EXISTS `ee`;
CREATE TABLE `ee` (
  `id` int(11) NOT NULL,
  `reeup_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nit_code` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_648B18CABF396750` FOREIGN KEY (`id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ee
-- ----------------------------
INSERT INTO `ee` VALUES ('2', '555555', '555555');
INSERT INTO `ee` VALUES ('4', '123456', '123456');
INSERT INTO `ee` VALUES ('5', '123456', '123');
INSERT INTO `ee` VALUES ('6', '123', '123');
INSERT INTO `ee` VALUES ('7', '123', '123');
INSERT INTO `ee` VALUES ('8', '123456', '123456');
INSERT INTO `ee` VALUES ('9', '555', '555');
INSERT INTO `ee` VALUES ('10', '22', '222');

-- ----------------------------
-- Table structure for email
-- ----------------------------
DROP TABLE IF EXISTS `email`;
CREATE TABLE `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E7927C742ADD6D8C` (`supplier_id`),
  CONSTRAINT `FK_E7927C742ADD6D8C` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of email
-- ----------------------------
INSERT INTO `email` VALUES ('1', '1', 'javiernieto1989@gmail.com');
INSERT INTO `email` VALUES ('2', '1', 'ejnb1989@gmail.com');
INSERT INTO `email` VALUES ('3', '1', 'informatico4@cubanacan.tur.cu');
INSERT INTO `email` VALUES ('4', '1', 'javiernieto1989@icloud.com');
INSERT INTO `email` VALUES ('5', '4', 'ee1@example.com');

-- ----------------------------
-- Table structure for licence
-- ----------------------------
DROP TABLE IF EXISTS `licence`;
CREATE TABLE `licence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `licence_number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of licence
-- ----------------------------
INSERT INTO `licence` VALUES ('1', '12345');
INSERT INTO `licence` VALUES ('2', '123');

-- ----------------------------
-- Table structure for notification
-- ----------------------------
DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of notification
-- ----------------------------

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', 'administrador', 'ROLE_ADMIN');
INSERT INTO `role` VALUES ('2', 'usuario', 'ROLE_USER');

-- ----------------------------
-- Table structure for supplement
-- ----------------------------
DROP TABLE IF EXISTS `supplement`;
CREATE TABLE `supplement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) DEFAULT NULL,
  `consecutive_number` int(11) NOT NULL,
  `contractual_object` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cuc_value` double NOT NULL,
  `cup_value` double NOT NULL,
  `id_supplement` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_15A73C92576E0FD` (`contract_id`),
  CONSTRAINT `FK_15A73C92576E0FD` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of supplement
-- ----------------------------
INSERT INTO `supplement` VALUES ('3', '4', '22', 'kjfkdjfk', '55', '55', '12-S1');
INSERT INTO `supplement` VALUES ('4', '4', '222', '222dfdhfhjdhf', '55.01', '55', '12-S2');

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cuc_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cup_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usd_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES ('1', 'Enio Javier Nieto Basnueva', 'Calle B No. 14358 n/ 2da y 3ra. Monterrey.SMP', '9202959872482777', '9224959873640104', 'tcp', null);
INSERT INTO `supplier` VALUES ('2', 'GET', 'Calle O No. 258, n/ 23 y Humboldt,Vedado', '333336622', '2255', 'ee', null);
INSERT INTO `supplier` VALUES ('4', 'EE1', 'DEE1', '123456', '123456', 'ee', null);
INSERT INTO `supplier` VALUES ('5', 'EE2', 'DEE2', '123466', '123456', 'ee', null);
INSERT INTO `supplier` VALUES ('6', 'EE2', 'D EE3', '123', '123', 'ee', null);
INSERT INTO `supplier` VALUES ('7', 'EE 4', 'D EE4', '123', '1223', 'ee', null);
INSERT INTO `supplier` VALUES ('8', 'dfdhfjhjh', 'dhfjdhf', '123456', '123456', 'ee', null);
INSERT INTO `supplier` VALUES ('9', 'fdhjfhdj', 'dhjfhjh', '5555', '555', 'ee', null);
INSERT INTO `supplier` VALUES ('10', 'kdfkdjfkj', 'kdjfkjdk', '222', '22', 'ee', null);

-- ----------------------------
-- Table structure for tcp
-- ----------------------------
DROP TABLE IF EXISTS `tcp`;
CREATE TABLE `tcp` (
  `id` int(11) NOT NULL,
  `ci` bigint(20) NOT NULL,
  `social_object` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B26C50C63B67F367` (`ci`),
  CONSTRAINT `FK_B26C50C6BF396750` FOREIGN KEY (`id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tcp
-- ----------------------------
INSERT INTO `tcp` VALUES ('1', '89020845946', 'Programador de equipo de computo');

-- ----------------------------
-- Table structure for tcps_licences
-- ----------------------------
DROP TABLE IF EXISTS `tcps_licences`;
CREATE TABLE `tcps_licences` (
  `tcp_id` int(11) NOT NULL,
  `licence_id` int(11) NOT NULL,
  PRIMARY KEY (`tcp_id`,`licence_id`),
  KEY `IDX_62747F81DDC5F57` (`tcp_id`),
  KEY `IDX_62747F8126EF07C9` (`licence_id`),
  CONSTRAINT `FK_62747F8126EF07C9` FOREIGN KEY (`licence_id`) REFERENCES `licence` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_62747F81DDC5F57` FOREIGN KEY (`tcp_id`) REFERENCES `tcp` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tcps_licences
-- ----------------------------
INSERT INTO `tcps_licences` VALUES ('1', '1');

-- ----------------------------
-- Table structure for telephone
-- ----------------------------
DROP TABLE IF EXISTS `telephone`;
CREATE TABLE `telephone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_450FF0102ADD6D8C` (`supplier_id`),
  CONSTRAINT `FK_450FF0102ADD6D8C` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of telephone
-- ----------------------------
INSERT INTO `telephone` VALUES ('1', '1', '53138324');
INSERT INTO `telephone` VALUES ('2', '1', '76912681');
INSERT INTO `telephone` VALUES ('3', '4', '1234569');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `occupation` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  KEY `IDX_8D93D649AE80F5DF` (`department_id`),
  CONSTRAINT `FK_8D93D649AE80F5DF` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'Enio javier', 'javier@gmail.com', 'javier', '$2y$12$hMgl09bjRNzbBkVuKwKyGuTTw8BE4GnNwYPrEtTxlwJqkefPAsXn.', 'Esp. Informatico', '1', '1');
INSERT INTO `user` VALUES ('2', 'Rainy Rodriguez Araque', 'informatico2@cubanacan.tur.cu', 'rainy', '$2y$12$VCDh8Uz15njl6N2jUiNj3uJym1N4PvrK5gwa1R5.VgXMzCGfzpcgm', 'Esp. Informatico', '1', '1');
INSERT INTO `user` VALUES ('3', 'admin', 'informatico4@cubanacan.tur.cu', 'admin', '$2y$12$J99jLSbJNo.xEKd61t6fyu27W5HXIuYK7ZG6Xc9IpQMZIKUZWxvje', 'Esp. Informatico', '1', '1');

-- ----------------------------
-- Table structure for users_roles
-- ----------------------------
DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE `users_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_51498A8EA76ED395` (`user_id`),
  KEY `IDX_51498A8ED60322AC` (`role_id`),
  CONSTRAINT `FK_51498A8EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_51498A8ED60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users_roles
-- ----------------------------
INSERT INTO `users_roles` VALUES ('1', '1');
INSERT INTO `users_roles` VALUES ('2', '1');
INSERT INTO `users_roles` VALUES ('2', '2');
INSERT INTO `users_roles` VALUES ('3', '1');
