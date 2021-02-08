/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : 127.0.0.7:3306
 Source Schema         : fumigaciones

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 08/02/2021 17:35:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bitacora
-- ----------------------------
DROP TABLE IF EXISTS `bitacora`;
CREATE TABLE `bitacora`  (
  `id_bitacora` int NOT NULL AUTO_INCREMENT,
  `fecha` timestamp(0) NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `usuario` int NULL DEFAULT NULL,
  `tabla` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_tabla` int NULL DEFAULT NULL,
  `bitacora` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `estado` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  PRIMARY KEY (`id_bitacora`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bitacora
-- ----------------------------
INSERT INTO `bitacora` VALUES (1, '2020-10-16 00:33:48', 2, 'usuarios', 1, 'Usuario editado', '1');
INSERT INTO `bitacora` VALUES (2, '2020-10-17 05:56:26', 2, 'usuarios', 2, 'Usuario editado', '1');
INSERT INTO `bitacora` VALUES (3, '2020-10-16 00:32:19', 2, 'usuarios', 3, 'Usuario editado', '1');
INSERT INTO `bitacora` VALUES (4, '2020-10-16 00:32:19', 2, 'clientes', 1, 'Cliente restaurado', '1');
INSERT INTO `bitacora` VALUES (5, '2020-10-16 00:31:38', 2, 'clientes', 3, 'Cliente editado', '1');
INSERT INTO `bitacora` VALUES (6, '2020-10-16 00:32:19', 2, 'clientes', 2, 'Cliente creado', '1');
INSERT INTO `bitacora` VALUES (7, '2020-10-16 00:32:19', 2, 'clientes', 4, 'Cliente creado', '1');
INSERT INTO `bitacora` VALUES (8, '2020-10-16 00:31:47', 2, 'clientes', 5, 'Cliente eliminado', '0');
INSERT INTO `bitacora` VALUES (9, '2020-10-16 00:32:19', 2, 'clientes', 6, 'Cliente creado', '1');
INSERT INTO `bitacora` VALUES (10, '2020-10-16 00:32:19', 2, 'clientes', 7, 'Cliente creado', '1');
INSERT INTO `bitacora` VALUES (11, '2020-10-16 00:34:53', 1, 'usuarios', 4, 'Usuario creado', '1');
INSERT INTO `bitacora` VALUES (12, '2020-12-23 09:14:51', 1, 'usuarios', 5, 'Usuario eliminado', '0');
INSERT INTO `bitacora` VALUES (13, '2020-10-17 06:38:58', 2, 'usuarios', 6, 'Usuario restaurado', '1');
INSERT INTO `bitacora` VALUES (14, '2020-10-17 06:07:42', 2, 'clientes', 8, 'Cliente creado', '1');
INSERT INTO `bitacora` VALUES (15, '2020-12-23 10:09:55', 8, 'clientes', 9, 'Cliente eliminado', '0');
INSERT INTO `bitacora` VALUES (16, '2020-10-23 02:04:23', 1, 'suministros', 1, 'Suministro editado', '1');
INSERT INTO `bitacora` VALUES (17, '2020-10-23 02:03:25', 1, 'suministros', 2, 'Suministro editado', '1');
INSERT INTO `bitacora` VALUES (18, '2020-10-23 02:03:51', 1, 'suministros', 3, 'Suministro editado', '1');
INSERT INTO `bitacora` VALUES (19, '2020-10-23 02:03:01', 1, 'suministros', 4, 'Suministro editado', '1');
INSERT INTO `bitacora` VALUES (20, '2020-10-23 02:55:37', 1, 'suministros', 5, 'Suministro eliminado', '0');
INSERT INTO `bitacora` VALUES (21, '2020-10-23 15:14:38', 1, 'usuarios', 7, 'Usuario creado', '1');
INSERT INTO `bitacora` VALUES (22, '2020-12-30 16:30:43', 1, 'servicios', 1, 'Servicio editado', '1');
INSERT INTO `bitacora` VALUES (23, '2020-12-30 16:36:05', 1, 'servicios', 2, 'Servicio editado', '1');
INSERT INTO `bitacora` VALUES (24, '2021-01-12 11:16:48', 1, 'servicios', 3, 'Servicio restaurado', '1');
INSERT INTO `bitacora` VALUES (25, '2020-12-30 16:29:01', 1, 'servicios', 4, 'Servicio editado', '1');
INSERT INTO `bitacora` VALUES (26, '2020-12-23 09:15:34', 1, 'usuarios', 8, 'Usuario restaurado', '1');
INSERT INTO `bitacora` VALUES (27, '2020-12-23 10:03:08', 8, 'usuarios', 9, 'Usuario restaurado', '1');
INSERT INTO `bitacora` VALUES (28, '2020-12-30 13:44:33', 1, 'servicios', 5, 'Servicio editado', '1');
INSERT INTO `bitacora` VALUES (29, '2020-12-30 16:37:58', 1, 'servicios', 6, 'Servicio creado', '1');

-- ----------------------------
-- Table structure for clientes
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes`  (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `cedula` int NULL DEFAULT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `apellido` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `tlf` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `alergias` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id_cliente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of clientes
-- ----------------------------
INSERT INTO `clientes` VALUES (1, 1234, 'Mario', 'Palacios', 'mario@correo.com', '04121234567', '');
INSERT INTO `clientes` VALUES (2, 12345, 'Angel', 'Aquino', 'angel@correo.com', '04121234567', 'polvo');
INSERT INTO `clientes` VALUES (3, 123456, 'Alejandra', 'Rodriguez', 'alejandra@correo.com', '04121234567', 'abejas');
INSERT INTO `clientes` VALUES (4, 21345, 'Daniela', 'Franco', 'daniela@correo.com', '04127654321', 'picadura de zancudos');
INSERT INTO `clientes` VALUES (5, 22222, 'Jose', 'Ochoa', 'jose@correo.com', '04141234567', '');
INSERT INTO `clientes` VALUES (6, 11111, 'Rafael', 'Blanco', 'rafael@correo.com', '04121324567', '');
INSERT INTO `clientes` VALUES (7, 333333, 'Yocoima', 'Gonzalez', 'yoco@correo.com', '02441234567', '');
INSERT INTO `clientes` VALUES (8, 4444, 'Brandom', 'Wellington', 'brandom@correo.com', '04121234567', 'plastico');
INSERT INTO `clientes` VALUES (9, 5555, 'Josefina', 'Chacon', 'chepa@correo.com', '11111111111', 'a los billetes');

-- ----------------------------
-- Table structure for dolares
-- ----------------------------
DROP TABLE IF EXISTS `dolares`;
CREATE TABLE `dolares`  (
  `id_dolar` int NOT NULL AUTO_INCREMENT,
  `fecha_dolar` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `bolivares` decimal(20, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_dolar`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dolares
-- ----------------------------
INSERT INTO `dolares` VALUES (1, '2020-10-14 13:10:18', 440000.00);
INSERT INTO `dolares` VALUES (2, '2020-10-15 13:10:55', 442000.00);
INSERT INTO `dolares` VALUES (3, '2020-10-16 04:38:00', 445000.00);
INSERT INTO `dolares` VALUES (4, '2020-10-20 04:38:42', 447000.00);
INSERT INTO `dolares` VALUES (5, '2020-10-21 04:39:31', 450000.00);
INSERT INTO `dolares` VALUES (6, '2020-10-22 04:39:48', 455000.00);
INSERT INTO `dolares` VALUES (7, '2020-10-23 04:54:27', 458000.00);
INSERT INTO `dolares` VALUES (8, '2020-10-23 11:59:43', 464000.00);
INSERT INTO `dolares` VALUES (9, '2020-10-23 15:07:17', 465000.00);
INSERT INTO `dolares` VALUES (10, '2020-11-09 11:04:02', 510000.00);
INSERT INTO `dolares` VALUES (11, '2020-11-09 11:04:19', 535000.00);
INSERT INTO `dolares` VALUES (12, '2020-11-20 14:54:26', 826000.00);
INSERT INTO `dolares` VALUES (13, '2020-11-26 10:11:00', 1023000.00);
INSERT INTO `dolares` VALUES (14, '2020-12-08 09:12:51', 1054000.00);
INSERT INTO `dolares` VALUES (15, '2020-12-10 14:45:30', 1095000.00);

-- ----------------------------
-- Table structure for fumigaciones
-- ----------------------------
DROP TABLE IF EXISTS `fumigaciones`;
CREATE TABLE `fumigaciones`  (
  `id_fumigacion` int NOT NULL AUTO_INCREMENT,
  `id_presupuesto` int NULL DEFAULT NULL,
  `control` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cita` date NULL DEFAULT NULL,
  `ejecucion` date NULL DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_fumigacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fumigaciones
-- ----------------------------

-- ----------------------------
-- Table structure for garantias
-- ----------------------------
DROP TABLE IF EXISTS `garantias`;
CREATE TABLE `garantias`  (
  `id_garantia` int NOT NULL AUTO_INCREMENT,
  `id_fumigacion` int NULL DEFAULT NULL,
  `plan` date NULL DEFAULT NULL,
  `aplicacion` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_garantia`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of garantias
-- ----------------------------

-- ----------------------------
-- Table structure for pre_serv
-- ----------------------------
DROP TABLE IF EXISTS `pre_serv`;
CREATE TABLE `pre_serv`  (
  `id_pre_serv` int NOT NULL AUTO_INCREMENT,
  `id_presupuesto` int NULL DEFAULT NULL,
  `id_servicios` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_pre_serv`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pre_serv
-- ----------------------------

-- ----------------------------
-- Table structure for presupuestos
-- ----------------------------
DROP TABLE IF EXISTS `presupuestos`;
CREATE TABLE `presupuestos`  (
  `id_presupuesto` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NULL DEFAULT NULL,
  `vencimiento` date NULL DEFAULT NULL,
  `area` enum('1','2','3','4','5','6','7','8') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `direccion` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `total` decimal(20, 2) NULL DEFAULT NULL,
  `estado` enum('1','2','3') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_presupuesto`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of presupuestos
-- ----------------------------

-- ----------------------------
-- Table structure for serv_sum
-- ----------------------------
DROP TABLE IF EXISTS `serv_sum`;
CREATE TABLE `serv_sum`  (
  `id_serv_sum` int NOT NULL AUTO_INCREMENT,
  `id_servicio` int NULL DEFAULT NULL,
  `id_suministro` int NULL DEFAULT NULL,
  `requerido` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_serv_sum`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of serv_sum
-- ----------------------------
INSERT INTO `serv_sum` VALUES (1, 1, 1, 5);
INSERT INTO `serv_sum` VALUES (2, 1, 3, 1);
INSERT INTO `serv_sum` VALUES (3, 2, 4, 5);
INSERT INTO `serv_sum` VALUES (4, 3, 1, 1);
INSERT INTO `serv_sum` VALUES (5, 3, 3, 1);
INSERT INTO `serv_sum` VALUES (6, 4, 1, 5);
INSERT INTO `serv_sum` VALUES (7, 4, 3, 1);
INSERT INTO `serv_sum` VALUES (9, 5, 3, 1);
INSERT INTO `serv_sum` VALUES (10, 5, 1, 3);
INSERT INTO `serv_sum` VALUES (11, 5, 2, 3);
INSERT INTO `serv_sum` VALUES (12, 1, 2, 5);
INSERT INTO `serv_sum` VALUES (13, 6, 4, 3);

-- ----------------------------
-- Table structure for servicios
-- ----------------------------
DROP TABLE IF EXISTS `servicios`;
CREATE TABLE `servicios`  (
  `id_servicio` int NOT NULL AUTO_INCREMENT,
  `servicio` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `precio` decimal(20, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_servicio`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of servicios
-- ----------------------------
INSERT INTO `servicios` VALUES (1, 'Empresarial Anti voladores', 180.00);
INSERT INTO `servicios` VALUES (2, 'Especial Anti roedores', 150.00);
INSERT INTO `servicios` VALUES (3, 'anti dengue', 9999999999999.00);
INSERT INTO `servicios` VALUES (4, 'Especial Anti zancudos', 160.00);
INSERT INTO `servicios` VALUES (5, 'Insectos voladores', 50.00);
INSERT INTO `servicios` VALUES (6, 'Anti roedores', 40.00);

-- ----------------------------
-- Table structure for suministros
-- ----------------------------
DROP TABLE IF EXISTS `suministros`;
CREATE TABLE `suministros`  (
  `id_suministro` int NOT NULL AUTO_INCREMENT,
  `suministro` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `unidad` enum('unidad','mg','ml') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'unidad',
  `existencia` int NULL DEFAULT NULL,
  `minimo` int NULL DEFAULT NULL,
  `costo` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_suministro`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suministros
-- ----------------------------
INSERT INTO `suministros` VALUES (1, 'Mata zancudos', 'unidad', 120, 10, 2.00);
INSERT INTO `suministros` VALUES (2, 'Mata moscas', 'mg', 100, 20, 3.50);
INSERT INTO `suministros` VALUES (3, 'Maquina que echa humo', 'unidad', 3, 1, 150.00);
INSERT INTO `suministros` VALUES (4, 'Mata ratas', 'unidad', 80, 10, 5.00);
INSERT INTO `suministros` VALUES (5, 'Anti pulgas', 'ml', 200, 10, 1.50);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nivel` enum('administrador','usuario') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'usuario',
  `cedula` int NULL DEFAULT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `apellido` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `clave` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `pregunta` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `respuesta` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'administrador', 25880768, 'Gabriel', 'Hernandez', 'gabo@correo.com', 'b06e3cbaa4d50cc97817313917c0ff3da630ab91a9f1860b13ba5c302bfb5e9f8ab5c78f5a1fa831f515b9aeab99b4090d210199914c702bd9e33d9193d3435esSMe7Sj5LT88jqCR77T1nHhJc9TkppIT3ZktU3leRgM=', 'd57b0f1df7a4ee6ba7a05553f2225901e217e5efd734789d146e018ec0245f05840b3af91127289ca584d3a69be6138d5ad294b23a9d53292d6cb33a41e3f08eXTbIwyQbGhipbpSh3kOiR+6NWFFpRs94MnEWRmed2Uw=', 'dadbe5417eff24c7919d00ee2211cf76f9e6d2126f2e49155ed80881f2acd69b165efa11fe09424111077d9e4f0dc20d130f687b35a9682899a9f7db2003da96FsE65mCY1iLClhqTAJPDUPCMgzjzZ+jCYO5bSnBfwZA=');
INSERT INTO `usuarios` VALUES (2, 'administrador', 1234, 'Maria', 'Gudiño', 'maria@correo.com', 'b86d6da3e94999efb44e3bd081c1e1f0b77013e9030aa6221a5b891c77855af06f67e199d602e53ba90ca1563c2e0170fcb1876e8b5f975723eec0328615b1be0vN1M9QPF2ZgwRYJnS52sg9m7reAq2Sp47Rn4W8pwFs=', '7707111b22ed7d112fa28ed292c2d94571ad00786f608537ff93c72a67b14f194cdf91e875819e5061ec9da81f1dd8f92d5b094409621f297eaf7ac7dcb03f33MBXaQRzIDU8LuNKNCVF4c1VHVlDfW2Ja/22dXE8hVaA=', '3d8b57e730eea91fd9887dcb1a77cef3d821acac0f4173a1648cc883cbc5794ae3874d8063365b69dc62f8a7a37b961d64890f3f7ffccb0de6b21aee8a96e4d3vrmV3/GRQ+Zf9KzS1RdNpolYB0byXLuyVvQa7JoJ1Fs=');
INSERT INTO `usuarios` VALUES (3, 'usuario', 12345, 'Gloria', 'Hernandez', 'gloria@correo.com', 'b4e259a306d4961d08c5942ceb0ac7c67670f0ed5b8b0a668d503dc0667426b0813d1eb38c356e478eada795517d035c35c85a05425f9298ca771c3a4142553csk+J9bW9vKh901qhMLNeJTb7735T5tGBFwATyteMTWA=', '50c109123ee3eeebd190ef25650e3a0152667ec275d51b5d379a6e17df3ac8cce5ce430a3ece57e2cb7b8ea92baa8656f19c6e8904f747ed2327dd343ba5cfe6y3LS36rPui9400Tnstl8oUA2GInQ6R2Y6HQSs4vWVY8=', 'e0c8d47b7184ebf69f2e76ffa56061af1cd566667e142f318e7f657fa8ac9697ba8fdb96cedf9a9cfb7b4a10ec7702d49b1d5f0854ba9d3dfab445332128105cvnLJoLUU8Xub7f7Wfz7DT4kVEg6L3/4bN8iU784+lNA=');
INSERT INTO `usuarios` VALUES (4, 'usuario', 4321, 'Eloy', 'Rodriguez', 'eloy@correo.com', 'f1be783b5a7157a53a0c3b48405190e9805ec37521ffea3ad10366388b961b543022838ef3518c35f48e4b5020e9ed0a7a00741cfa33414a22bdf8dbefa76741pyCosNHBTQ+Y4KP8YO7ir2pdxKERRB6qz4BYcV++nnE=', 'f4672dc218bef9602d2e0369b72350cf7e8c1c10759dff7c8f9b3949b138c1e6086d3fae26d1e84038a6ec45f0c69ae8b990d6c9e61ff5438451c1601820d901lb1Cq18rS0+Lzk21nTTPAwjsSZwF9yomTXJh0EEwnFA=', 'da0330310a24f4ed3e81c89d7cdd6cdf800e515c7c0a26765d895244859c2cba8fa0592855da89f32a335e9ae3face5e5a7ca58ed3c4d29901547defc2fc1793y6SoaAmV68b0El1MI8WdtqspDsYZaQxhEF4jbklZ99I=');
INSERT INTO `usuarios` VALUES (5, 'usuario', 11111, 'Bradley', 'Cooper', 'bradley@correo.com', 'c9f5292d3015047846f20f344f27d4d5a57570de0ea3005b0f92acf7c8c1a97483fad95cac311f838cf527ab99bb1031484542004b2566f891f53f8e25f96540bcXHvJJh6el36CDbzjEI1kO4bALgE4QKo1uMnxjjAe4=', '44d9e310c5c735819fa6f820e61cab5ba848c7a2581fb04d1fc362eddb40a4ccfb264b1fb9650d21d1f2787176e8d9fd089f409c5c7bb6a402c4959a8c150704py5XLyT1ZN6onq3kOIvCH77Zr1rHNzXg51gzBR2kWzI=', '9726d9c13973ae0b6d079b9852413ffb29e3dc692f379ade1fc68a9c4a0b25ee9d3dc4227eace6ed8db618375dfc977bae2513ab044ef8c6708af0385598318eL2Bq/WcZFICutNgB/8K6gxDhf0OTwH5DQHCNHglTSw0=');
INSERT INTO `usuarios` VALUES (6, 'usuario', 22222, 'Rolangel ', 'Rodriguez', 'rolangel@correo.com', '198d7afed429cdec9f2ef871a5dad3d5860706e792e3c44fc72398429de228736d75dd6717e6688fe62da384ebde6af8ee492ad6b470b9af19881c5a7ae5754ei8uO0Q/99oD0k+Q6+c2e9H1CLN1CIPoX13dyJwfn0a0=', 'e22ef7e5ad589026a3d403a0669c5cca8747359ba677255765ef871ab8c44bb27b5344d35ddfb4a73ee8a5ffbc78d4fbba056abc87379b474327d4338c49ff84DvUz6FPwDeYC2/Jxu1JWMzU4paVH7QwrT/t0FnC6wCc=', '6572ea5fa9ccee38f4bb4c868b0984786006f62ef6e5e12309c0680b2eca5e4a34aabb70f1b7f56d67ff7ae2aad27c18f63c96001d6324f6ecb820e58e2189efAMO/B/TUvDT689hBV7EbvwLhJvFeFwNQVvuAOpkbDc4=');
INSERT INTO `usuarios` VALUES (7, 'administrador', 123456, 'Orangel', 'Briceño', 'orangel@correo.com', '5a4ab2232229916e4712c4089f0aac0870581e30d62446b87f2bd70d02727e9c4757c806efd0cc46c327e08b5fe8140a24157ab9157c4203abd1690180672459u1YcPEal1EY08oymF2X3H35ttxL/hUpWI+hkw82m8hQ=', '9d877ec7eafdbbd82c442ef55a127a67b410f9f6df43a545a01334bc5c19d9207ff9e0a563d901c0668f3410582f4506a2769706578b2322ea8f475667ee4d76V6e9+V83GPqq/681WH8byWXBfRYbFkVUVGIWItY9Vyk=', 'b17569234eea157a4182bed8099460e9453da6599e42b8dd3bf016efd645f8b3d1e772756f588457023492efec2672f8367ecbb886c8e887f579c5150d2f0ba7IoAT6ww+PLGGdZdWy3+bl5m7eL8kIf+2aorHxoCCAmY=');
INSERT INTO `usuarios` VALUES (8, 'administrador', 1234567, 'admin', 'admin', 'admin@correo.com', '78deee29b9ea35f3122fbd591f2520cda4a3b3908ddea6e6a974424f5636908da71413a96d08901d40547e542949cbcbe04335678270085801e0c128f943db37TdtBf7SczptywC20e+BHM6eZ5jK1092KUed+XDzTwEg=', 'c5cfa7fcad7ccd1fd68202545e562b70514356d3f3dcda9c5f7b8951f8ed0cbbe1442f9ae6045b91dbe5c8185a549d6811b6e713f76233b60bf410ee67310d58uv9g5EICCVuyrtyV96Fwt+Yr1FA4axSBvMQe5NiXtu0=', '7d1bd467d76749fa7b800469b582a148ba994c8eb9fb806ab15d3ab4384940ebc547bd1f08fc8879331be93947d91732d5588ba32bb8b560756582ce7daa737fUKZp2iaqyUdowq/eGUs2mEvSPRPa9nx3IYj0lTpk1/w=');
INSERT INTO `usuarios` VALUES (9, 'usuario', 12345678, 'usuario', 'usuario', 'usuario@correo.com', '217f12e4b093d1e789950793d0d6317e4e937fc20466ebd43dde7c789854eb29f123cf0a8a76323891f8a25dd6f6e330b21bb5ee353e930662fc820a0c2684c5RVl+t+PKZ97TQGuNSGNmJ7gQ8hoJ8Eox+/mtUt8BNOM=', '75268a40032331d842328d60b6256fb69b05c73ad977867923313f308b7d1386f58f14aec53e10733a02c6dd32799f78b4f8ae0192b9bb9ad9f258a843533608ciwDSufHl6UT3v/2lq1Lco4mgUHhg82w71zRqxzFVVA=', 'e9e4c4b2fa07a50ac397a7c4b30c4f18720514225d6aeea12227982326a69e556fb6520eed4364513f66bda2a1d6dfbb7531e014396591a68789a38f72f8e982k325C4N/B/kFDAblKIfpyLp3IrWOsBw+Hsh2/5c9tXA=');

SET FOREIGN_KEY_CHECKS = 1;
