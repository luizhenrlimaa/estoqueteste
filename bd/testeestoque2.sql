/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : testeestoque2

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 20/08/2019 09:08:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for contato
-- ----------------------------
DROP TABLE IF EXISTS `contato`;
CREATE TABLE `contato`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `assunto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sobrenome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of contato
-- ----------------------------
INSERT INTO `contato` VALUES (19, 'Luiz', 'asas', 'asa', 'dadaa');
INSERT INTO `contato` VALUES (20, 'Luiz', 'Teste', 'Lima', 'sdjhjasd');

-- ----------------------------
-- Table structure for fornecedor
-- ----------------------------
DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE `fornecedor`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cnpj` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ie` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of fornecedor
-- ----------------------------
INSERT INTO `fornecedor` VALUES (7, 'Luiz', '111.111.111-11', 'luizhenrlimaa@gmail.com', '111.111.111/1111');
INSERT INTO `fornecedor` VALUES (8, 'Teste', '111.111.111-11', 'teste@teste.com', '111.111.111/1111');

-- ----------------------------
-- Table structure for produto
-- ----------------------------
DROP TABLE IF EXISTS `produto`;
CREATE TABLE `produto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `quantidade` int(11) NOT NULL,
  `tipo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `valor` float(255, 0) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `fk_fornecedor` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cfop` int(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of produto
-- ----------------------------
INSERT INTO `produto` VALUES (12, 'B', 2, '0', 25, 39, '7', 1234);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cpf` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sobrenome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'llasl', '31125415', 'lslska', 'luizhenrlimaa@gmail.com', '');
INSERT INTO `usuario` VALUES (2, 'llasl', '21251', 'Lima', 'luizhenrlimaa@gmail.com', '');
INSERT INTO `usuario` VALUES (3, 'Luiz', '12706424648', 'Lima', 'luizhenrlimaa@gmail.com', '');
INSERT INTO `usuario` VALUES (4, 'Luiz', '12706424648', 'Lima', 'luizhenrlimaa@gmail.com', '');
INSERT INTO `usuario` VALUES (5, 'Luiz', '12706424648', 'Lima', 'luizhenrlimaa@gmail.com', '');
INSERT INTO `usuario` VALUES (6, 'Luiz', '12706424648', 'Lima', 'luizhenrlimaa@gmail.com', '');
INSERT INTO `usuario` VALUES (7, 'lll', '51515', 'lll', '123@123', '');
INSERT INTO `usuario` VALUES (8, 'll', '123', 'll', 'l@l.com', '');
INSERT INTO `usuario` VALUES (9, 'lll', '123', 'lll', 'luizhenrlimaa@gmail.com', '');
INSERT INTO `usuario` VALUES (10, 'll', '123', 'll', 'luizhenrlimaa@gmail.com', '');
INSERT INTO `usuario` VALUES (11, 'll', '123', 'll', 'll@123.com', '');
INSERT INTO `usuario` VALUES (12, 'lll', '123', 'll', '123@123.com', '');
INSERT INTO `usuario` VALUES (13, 'll', '123', 'll', '1234@123.com', '');
INSERT INTO `usuario` VALUES (14, 'Luiz', '1234', 'LL', 'luiz@luiz.com', '');
INSERT INTO `usuario` VALUES (15, 'll', '012', 'll', 'll@123.com', '');
INSERT INTO `usuario` VALUES (16, 'Luiz', '1234', 'LL', '1234@1234.com', '');
INSERT INTO `usuario` VALUES (17, 'll', '123', 'll', 'luiz1@luiz1.com', '');
INSERT INTO `usuario` VALUES (18, 'Luiz', '123', 'Lima', '1@1.com', '');
INSERT INTO `usuario` VALUES (19, 'll', '127.064.246-48', 'll', 'aa@aa.com', '');
INSERT INTO `usuario` VALUES (20, 'Luiz', '127.064.246-48', 'll', '123@123.com', '');
INSERT INTO `usuario` VALUES (21, 'Luiz', '127.064.246-48', 'll', 'bb@bb.com', '');
INSERT INTO `usuario` VALUES (22, 'Luiz', '127.064.246-48', 'Lima', 'luiz@luiz.com', '');
INSERT INTO `usuario` VALUES (23, 'Luiz', '127.064.246-48', 'Lima', 'l.@l.com', '');
INSERT INTO `usuario` VALUES (24, 'Luiz', '127.064.246-48', 'Lima', 'l@l.com', '');
INSERT INTO `usuario` VALUES (25, 'Luiz', '127.064.246-48', 'Lima', 'l@l1.com', '');
INSERT INTO `usuario` VALUES (26, 'aa', '127.064.246-48', 'aa', 'aa@l.com', '');
INSERT INTO `usuario` VALUES (27, 'cc', '127.064.246-48', 'asa', 'cc@gmail.com.com', '');
INSERT INTO `usuario` VALUES (28, 'ss', '127.064.246-48', 'Lima', 'ss@s.com', '');
INSERT INTO `usuario` VALUES (29, '123', '127.064.246-48', '$2y$10$/PWnyAO52WMFM1LWLkyUTOjzmLgHg/qB2IWOlcq2Sj.knKnlXHQhG', '123@123', '');
INSERT INTO `usuario` VALUES (30, '123', '127.064.246-48', 'teste@teste', '$2y$10$PedWD71fFPxcUp6gbQQEi.tZ4ZT5ZlkNcBo5bBXCxofAkvDMrp1/m', '');
INSERT INTO `usuario` VALUES (31, 'darlan', '127.064.246-48', '1223@gmail.com', '$2y$10$Qt3PdwRLfxU.ma.Rg.anl.pf3IGfPK0M43iOSw04T1HOBkBkKvW7e', '');
INSERT INTO `usuario` VALUES (32, 'eu', '127.064.246-48', '123@123', '$2y$10$FGH8Ol7qCRf5wxkGyQQ7euWKhTpmKa0EePsGPBm6JT10TyrMsnQAq', '');
INSERT INTO `usuario` VALUES (33, 'darlan', '127.064.246-48', '$2y$10$SzqnzqB1JFj7DrE5XbIMX.Vy66M9AuMwn1Uj1lyfOGdHt0MtbdBw6', '123@123', '');
INSERT INTO `usuario` VALUES (34, 'Luiz', '127.064.246-48', '$2y$10$TencgS/b4Pwor/Kh9umdTuu58Ux8ooFyBjda3qN78NM16vp5lys.q', '1@1.com', '');
INSERT INTO `usuario` VALUES (35, 'Luiz', '127.064.246-48', '', '12@12.com', '');
INSERT INTO `usuario` VALUES (36, 'a', '130.651.986-14', '$2y$10$Q9cNJIilNe81M1NpX5NYpurj6SwjdsZ7s0Z2u8w8FQKqJ7KFCaiGi', '123@456', '');
INSERT INTO `usuario` VALUES (37, '1998@0', '127.064.246-48', '$2y$10$PZby8Q.UZIB5snSBNldbS.mMqzmInFKVVQmMXZCfAgeqyGCq.5el.', '1998@0', 'Lima');
INSERT INTO `usuario` VALUES (38, 'Luiz', '127.064.246-48', '$2y$10$rUdBcj0zKuwgN3nsNdetWOl4V7uUqLq7LeZ51s.7wtEDfx0WH32ky', 'teste@teste', '');
INSERT INTO `usuario` VALUES (39, 'Luiz', '127.064.246-48', '$2y$10$Pa5GCnTxHGqkgTitaVpw7OwGPxYeC5OGZ/7j2odIM.wWEuTGrxaA6', 'u@u.com', 'Lima');

SET FOREIGN_KEY_CHECKS = 1;
