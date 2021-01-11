-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table datomed.agenda
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rut_doctor` varchar(12) DEFAULT NULL,
  `rut_paciente` varchar(12) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` varchar(50) DEFAULT NULL,
  `tipo_atencion` varchar(200) DEFAULT NULL COMMENT '1 = Presencial, 2 = Telemedicina',
  `motivo` longtext DEFAULT NULL,
  `estado` int(2) DEFAULT 1 COMMENT '1 = En espera, 2 = Aprobado, 3 = Rechazado',
  PRIMARY KEY (`id`),
  KEY `rut_doctor_rut_paciente_tipo_atencion` (`rut_doctor`,`rut_paciente`,`tipo_atencion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table datomed.agenda: ~1 rows (approximately)
DELETE FROM `agenda`;
/*!40000 ALTER TABLE `agenda` DISABLE KEYS */;
INSERT INTO `agenda` (`id`, `rut_doctor`, `rut_paciente`, `fecha`, `hora`, `tipo_atencion`, `motivo`, `estado`) VALUES
	(1, '5087160-6', '5193162-9', '2020-04-14', '12:30', '2', '<p>Dolor de cabeza extremo</p>', 1);
/*!40000 ALTER TABLE `agenda` ENABLE KEYS */;

-- Dumping structure for table datomed.cocomentarios
CREATE TABLE IF NOT EXISTS `cocomentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publicacion_id` int(10) NOT NULL,
  `rut_usuario` varchar(12) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` int(10) DEFAULT 0 COMMENT '0 = Comentario aprobado\n1 = Comentario rechazado ',
  `comentario` varchar(200) DEFAULT NULL,
  `reserva_id` varchar(45) DEFAULT NULL COMMENT 'Para evaluar la video conferencia',
  `evaluacion` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`,`publicacion_id`,`rut_usuario`),
  KEY `idxrut` (`publicacion_id`,`rut_usuario`,`estado`,`reserva_id`,`evaluacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table datomed.cocomentarios: ~0 rows (approximately)
DELETE FROM `cocomentarios`;
/*!40000 ALTER TABLE `cocomentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `cocomentarios` ENABLE KEYS */;

-- Dumping structure for table datomed.coespecialidades
CREATE TABLE IF NOT EXISTS `coespecialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

-- Dumping data for table datomed.coespecialidades: ~68 rows (approximately)
DELETE FROM `coespecialidades`;
/*!40000 ALTER TABLE `coespecialidades` DISABLE KEYS */;
INSERT INTO `coespecialidades` (`id`, `nombre`) VALUES
	(1, 'Adolescencia'),
	(2, 'Anatomía patológica'),
	(3, 'Anestesiología y reanimación'),
	(4, 'Cardiología'),
	(5, 'Cardiología pediátrica'),
	(6, 'Cateterismo cardíaco y cardiología intervencional'),
	(7, 'Cirugía cardiovascular'),
	(8, 'Cirugía coloproctológica'),
	(9, 'Cirugía de cabeza, cuello y plástica máxilo facial'),
	(10, 'Cirugía de tórax'),
	(11, 'Cirugía digestiva'),
	(12, 'Cirugía general'),
	(13, 'Cirugía pediátrica'),
	(14, 'Cirugía plástica y reparadora'),
	(15, 'Cirugía vascular periférica'),
	(16, 'Cuidados intensivos pediátricos'),
	(17, 'Dermatología'),
	(18, 'Diabetes de adultos'),
	(19, 'Endocrinología'),
	(20, 'Endocrinología pediátrica'),
	(21, 'Enfermedades respiratorias'),
	(22, 'Enfermedades respiratorias pediátricas'),
	(23, 'Fisiatría'),
	(24, 'Gastroenterología'),
	(25, 'Gastroenterología pediátrica'),
	(26, 'Genética clínica'),
	(27, 'Geriatría'),
	(28, 'Ginecología oncológica'),
	(29, 'Ginecología pediátrica y de la adolescencia'),
	(30, 'Hematología'),
	(31, 'Hematología oncológica pediátrica'),
	(32, 'Infectología'),
	(33, 'Infectología pediátrica'),
	(34, 'Inmunología'),
	(35, 'Laboratorio clínico'),
	(36, 'Mastología'),
	(37, 'Medicina de urgencia'),
	(38, 'Medicina general familiar'),
	(39, 'Medicina intensiva de adultos'),
	(40, 'Medicina interna'),
	(41, 'Medicina legal'),
	(42, 'Medicina materno fetal'),
	(43, 'Medicina nuclear'),
	(44, 'Medicina reproductiva e infertilidad'),
	(45, 'Microbiología'),
	(46, 'Nefrología'),
	(47, 'Nefrología pediátrica'),
	(48, 'Neonatología'),
	(49, 'Neurocirugía'),
	(50, 'Neurología'),
	(51, 'Neurología pediátrica'),
	(52, 'Nutrición clínica del niño y del adolescente'),
	(53, 'Obstetricia y ginecología'),
	(54, 'Oftalmología'),
	(55, 'Oncología médica'),
	(56, 'Ortopedia y traumatología'),
	(57, 'Otorrinolaringología'),
	(58, 'Pediatría'),
	(59, 'Psiquiatría adultos'),
	(60, 'Psiquiatría infantil y del adolescente'),
	(61, 'Radiología'),
	(62, 'Radioterapia oncológica'),
	(63, 'Reumatología'),
	(64, 'Reumatología pediátrica'),
	(65, 'Salud pública'),
	(66, 'Trastornos del lenguaje, habla y deglución en adultos'),
	(67, 'Urología'),
	(68, 'Urología Pediátrica');
/*!40000 ALTER TABLE `coespecialidades` ENABLE KEYS */;

-- Dumping structure for table datomed.cofichamedica
CREATE TABLE IF NOT EXISTS `cofichamedica` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rut_doctor` varchar(12) DEFAULT NULL,
  `rut_paciente` varchar(12) DEFAULT NULL,
  `motivo_consulta` longtext DEFAULT NULL,
  `enf_actual` longtext DEFAULT NULL,
  `sexo` varchar(30) DEFAULT NULL,
  `peso` varchar(30) DEFAULT NULL,
  `talla` varchar(30) DEFAULT NULL,
  `sangre` varchar(30) DEFAULT NULL,
  `pulso` varchar(30) DEFAULT NULL,
  `presion_arterial` varchar(30) DEFAULT NULL,
  `temperatura` varchar(30) DEFAULT NULL,
  `frec_respiratoria` varchar(120) DEFAULT NULL,
  `int_quirur` longtext DEFAULT NULL,
  `alergias` longtext DEFAULT NULL,
  `enfermedades` longtext DEFAULT NULL,
  `medicamentos` longtext DEFAULT NULL,
  `fuma` longtext DEFAULT NULL,
  `alcohol` longtext DEFAULT NULL,
  `enf_congenita` longtext DEFAULT NULL,
  `enf_cardiaca` longtext DEFAULT NULL,
  `enf_genetica` longtext DEFAULT NULL,
  `otras` longtext DEFAULT NULL,
  `diagnostico` longtext DEFAULT NULL,
  `proxima_cita` longtext DEFAULT NULL,
  `receta_id` int(10) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `rut_doctor_rut_paciente` (`rut_doctor`,`rut_paciente`,`fecha`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table datomed.cofichamedica: ~0 rows (approximately)
DELETE FROM `cofichamedica`;
/*!40000 ALTER TABLE `cofichamedica` DISABLE KEYS */;
INSERT INTO `cofichamedica` (`id`, `rut_doctor`, `rut_paciente`, `motivo_consulta`, `enf_actual`, `sexo`, `peso`, `talla`, `sangre`, `pulso`, `presion_arterial`, `temperatura`, `frec_respiratoria`, `int_quirur`, `alergias`, `enfermedades`, `medicamentos`, `fuma`, `alcohol`, `enf_congenita`, `enf_cardiaca`, `enf_genetica`, `otras`, `diagnostico`, `proxima_cita`, `receta_id`, `fecha`) VALUES
	(1, '5087160-6', '5193162-9', '<p>Ninguno</p>', '<p>Ninguno</p>', 'Masculino', '122', '111', '111', '111', '111', '111', '111', '<p>Ninguno</p>', '<p>Ninguno</p>', '<p>Ninguno</p>', '<p>Ninguno</p>', '<p>Ninguno</p>', '<p>Ninguno</p>', '<p>Ninguno</p>', '<p>Ninguno</p>', '<p>Ninguno</p>', '<p>Ninguno</p>', '<p>Ninguno</p>', '<p>Ninguno</p>', NULL, '2020-04-04 17:58:24');
/*!40000 ALTER TABLE `cofichamedica` ENABLE KEYS */;

-- Dumping structure for table datomed.comunas
CREATE TABLE IF NOT EXISTS `comunas` (
  `comuna_id` int(11) NOT NULL AUTO_INCREMENT,
  `comuna_nombre` varchar(64) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  PRIMARY KEY (`comuna_id`)
) ENGINE=MyISAM AUTO_INCREMENT=346 DEFAULT CHARSET=utf8;

-- Dumping data for table datomed.comunas: 345 rows
DELETE FROM `comunas`;
/*!40000 ALTER TABLE `comunas` DISABLE KEYS */;
INSERT INTO `comunas` (`comuna_id`, `comuna_nombre`, `provincia_id`) VALUES
	(1, 'Arica', 1),
	(2, 'Camarones', 1),
	(3, 'General Lagos', 2),
	(4, 'Putre', 2),
	(5, 'Alto Hospicio', 3),
	(6, 'Iquique', 3),
	(7, 'Camiña', 4),
	(8, 'Colchane', 4),
	(9, 'Huara', 4),
	(10, 'Pica', 4),
	(11, 'Pozo Almonte', 4),
	(12, 'Antofagasta', 5),
	(13, 'Mejillones', 5),
	(14, 'Sierra Gorda', 5),
	(15, 'Taltal', 5),
	(16, 'Calama', 6),
	(17, 'Ollague', 6),
	(18, 'San Pedro de Atacama', 6),
	(19, 'María Elena', 7),
	(20, 'Tocopilla', 7),
	(21, 'Chañaral', 8),
	(22, 'Diego de Almagro', 8),
	(23, 'Caldera', 9),
	(24, 'Copiapó', 9),
	(25, 'Tierra Amarilla', 9),
	(26, 'Alto del Carmen', 10),
	(27, 'Freirina', 10),
	(28, 'Huasco', 10),
	(29, 'Vallenar', 10),
	(30, 'Canela', 11),
	(31, 'Illapel', 11),
	(32, 'Los Vilos', 11),
	(33, 'Salamanca', 11),
	(34, 'Andacollo', 12),
	(35, 'Coquimbo', 12),
	(36, 'La Higuera', 12),
	(37, 'La Serena', 12),
	(38, 'Paihuaco', 12),
	(39, 'Vicuña', 12),
	(40, 'Combarbalá', 13),
	(41, 'Monte Patria', 13),
	(42, 'Ovalle', 13),
	(43, 'Punitaqui', 13),
	(44, 'Río Hurtado', 13),
	(45, 'Isla de Pascua', 14),
	(46, 'Calle Larga', 15),
	(47, 'Los Andes', 15),
	(48, 'Rinconada', 15),
	(49, 'San Esteban', 15),
	(50, 'La Ligua', 16),
	(51, 'Papudo', 16),
	(52, 'Petorca', 16),
	(53, 'Zapallar', 16),
	(54, 'Hijuelas', 17),
	(55, 'La Calera', 17),
	(56, 'La Cruz', 17),
	(57, 'Limache', 17),
	(58, 'Nogales', 17),
	(59, 'Olmué', 17),
	(60, 'Quillota', 17),
	(61, 'Algarrobo', 18),
	(62, 'Cartagena', 18),
	(63, 'El Quisco', 18),
	(64, 'El Tabo', 18),
	(65, 'San Antonio', 18),
	(66, 'Santo Domingo', 18),
	(67, 'Catemu', 19),
	(68, 'Llaillay', 19),
	(69, 'Panquehue', 19),
	(70, 'Putaendo', 19),
	(71, 'San Felipe', 19),
	(72, 'Santa María', 19),
	(73, 'Casablanca', 20),
	(74, 'Concón', 20),
	(75, 'Juan Fernández', 20),
	(76, 'Puchuncaví', 20),
	(77, 'Quilpué', 20),
	(78, 'Quintero', 20),
	(79, 'Valparaíso', 20),
	(80, 'Villa Alemana', 20),
	(81, 'Viña del Mar', 20),
	(82, 'Colina', 21),
	(83, 'Lampa', 21),
	(84, 'Tiltil', 21),
	(85, 'Pirque', 22),
	(86, 'Puente Alto', 22),
	(87, 'San José de Maipo', 22),
	(88, 'Buin', 23),
	(89, 'Calera de Tango', 23),
	(90, 'Paine', 23),
	(91, 'San Bernardo', 23),
	(92, 'Alhué', 24),
	(93, 'Curacaví', 24),
	(94, 'María Pinto', 24),
	(95, 'Melipilla', 24),
	(96, 'San Pedro', 24),
	(97, 'Cerrillos', 25),
	(98, 'Cerro Navia', 25),
	(99, 'Conchalí', 25),
	(100, 'El Bosque', 25),
	(101, 'Estación Central', 25),
	(102, 'Huechuraba', 25),
	(103, 'Independencia', 25),
	(104, 'La Cisterna', 25),
	(105, 'La Granja', 25),
	(106, 'La Florida', 25),
	(107, 'La Pintana', 25),
	(108, 'La Reina', 25),
	(109, 'Las Condes', 25),
	(110, 'Lo Barnechea', 25),
	(111, 'Lo Espejo', 25),
	(112, 'Lo Prado', 25),
	(113, 'Macul', 25),
	(114, 'Maipú', 25),
	(115, 'Ñuñoa', 25),
	(116, 'Pedro Aguirre Cerda', 25),
	(117, 'Peñalolén', 25),
	(118, 'Providencia', 25),
	(119, 'Pudahuel', 25),
	(120, 'Quilicura', 25),
	(121, 'Quinta Normal', 25),
	(122, 'Recoleta', 25),
	(123, 'Renca', 25),
	(124, 'San Miguel', 25),
	(125, 'San Joaquín', 25),
	(126, 'San Ramón', 25),
	(127, 'Santiago', 25),
	(128, 'Vitacura', 25),
	(129, 'El Monte', 26),
	(130, 'Isla de Maipo', 26),
	(131, 'Padre Hurtado', 26),
	(132, 'Peñaflor', 26),
	(133, 'Talagante', 26),
	(134, 'Codegua', 27),
	(135, 'Coínco', 27),
	(136, 'Coltauco', 27),
	(137, 'Doñihue', 27),
	(138, 'Graneros', 27),
	(139, 'Las Cabras', 27),
	(140, 'Machalí', 27),
	(141, 'Malloa', 27),
	(142, 'Mostazal', 27),
	(143, 'Olivar', 27),
	(144, 'Peumo', 27),
	(145, 'Pichidegua', 27),
	(146, 'Quinta de Tilcoco', 27),
	(147, 'Rancagua', 27),
	(148, 'Rengo', 27),
	(149, 'Requínoa', 27),
	(150, 'San Vicente de Tagua Tagua', 27),
	(151, 'La Estrella', 28),
	(152, 'Litueche', 28),
	(153, 'Marchihue', 28),
	(154, 'Navidad', 28),
	(155, 'Peredones', 28),
	(156, 'Pichilemu', 28),
	(157, 'Chépica', 29),
	(158, 'Chimbarongo', 29),
	(159, 'Lolol', 29),
	(160, 'Nancagua', 29),
	(161, 'Palmilla', 29),
	(162, 'Peralillo', 29),
	(163, 'Placilla', 29),
	(164, 'Pumanque', 29),
	(165, 'San Fernando', 29),
	(166, 'Santa Cruz', 29),
	(167, 'Cauquenes', 30),
	(168, 'Chanco', 30),
	(169, 'Pelluhue', 30),
	(170, 'Curicó', 31),
	(171, 'Hualañé', 31),
	(172, 'Licantén', 31),
	(173, 'Molina', 31),
	(174, 'Rauco', 31),
	(175, 'Romeral', 31),
	(176, 'Sagrada Familia', 31),
	(177, 'Teno', 31),
	(178, 'Vichuquén', 31),
	(179, 'Colbún', 32),
	(180, 'Linares', 32),
	(181, 'Longaví', 32),
	(182, 'Parral', 32),
	(183, 'Retiro', 32),
	(184, 'San Javier', 32),
	(185, 'Villa Alegre', 32),
	(186, 'Yerbas Buenas', 32),
	(187, 'Constitución', 33),
	(188, 'Curepto', 33),
	(189, 'Empedrado', 33),
	(190, 'Maule', 33),
	(191, 'Pelarco', 33),
	(192, 'Pencahue', 33),
	(193, 'Río Claro', 33),
	(194, 'San Clemente', 33),
	(195, 'San Rafael', 33),
	(196, 'Talca', 33),
	(197, 'Arauco', 34),
	(198, 'Cañete', 34),
	(199, 'Contulmo', 34),
	(200, 'Curanilahue', 34),
	(201, 'Lebu', 34),
	(202, 'Los Álamos', 34),
	(203, 'Tirúa', 34),
	(204, 'Alto Biobío', 35),
	(205, 'Antuco', 35),
	(206, 'Cabrero', 35),
	(207, 'Laja', 35),
	(208, 'Los Ángeles', 35),
	(209, 'Mulchén', 35),
	(210, 'Nacimiento', 35),
	(211, 'Negrete', 35),
	(212, 'Quilaco', 35),
	(213, 'Quilleco', 35),
	(214, 'San Rosendo', 35),
	(215, 'Santa Bárbara', 35),
	(216, 'Tucapel', 35),
	(217, 'Yumbel', 35),
	(218, 'Chiguayante', 36),
	(219, 'Concepción', 36),
	(220, 'Coronel', 36),
	(221, 'Florida', 36),
	(222, 'Hualpén', 36),
	(223, 'Hualqui', 36),
	(224, 'Lota', 36),
	(225, 'Penco', 36),
	(226, 'San Pedro de La Paz', 36),
	(227, 'Santa Juana', 36),
	(228, 'Talcahuano', 36),
	(229, 'Tomé', 36),
	(230, 'Bulnes', 37),
	(231, 'Chillán', 37),
	(232, 'Chillán Viejo', 37),
	(233, 'Cobquecura', 37),
	(234, 'Coelemu', 37),
	(235, 'Coihueco', 37),
	(236, 'El Carmen', 37),
	(237, 'Ninhue', 37),
	(238, 'Ñiquen', 37),
	(239, 'Pemuco', 37),
	(240, 'Pinto', 37),
	(241, 'Portezuelo', 37),
	(242, 'Quillón', 37),
	(243, 'Quirihue', 37),
	(244, 'Ránquil', 37),
	(245, 'San Carlos', 37),
	(246, 'San Fabián', 37),
	(247, 'San Ignacio', 37),
	(248, 'San Nicolás', 37),
	(249, 'Treguaco', 37),
	(250, 'Yungay', 37),
	(251, 'Carahue', 38),
	(252, 'Cholchol', 38),
	(253, 'Cunco', 38),
	(254, 'Curarrehue', 38),
	(255, 'Freire', 38),
	(256, 'Galvarino', 38),
	(257, 'Gorbea', 38),
	(258, 'Lautaro', 38),
	(259, 'Loncoche', 38),
	(260, 'Melipeuco', 38),
	(261, 'Nueva Imperial', 38),
	(262, 'Padre Las Casas', 38),
	(263, 'Perquenco', 38),
	(264, 'Pitrufquén', 38),
	(265, 'Pucón', 38),
	(266, 'Saavedra', 38),
	(267, 'Temuco', 38),
	(268, 'Teodoro Schmidt', 38),
	(269, 'Toltén', 38),
	(270, 'Vilcún', 38),
	(271, 'Villarrica', 38),
	(272, 'Angol', 39),
	(273, 'Collipulli', 39),
	(274, 'Curacautín', 39),
	(275, 'Ercilla', 39),
	(276, 'Lonquimay', 39),
	(277, 'Los Sauces', 39),
	(278, 'Lumaco', 39),
	(279, 'Purén', 39),
	(280, 'Renaico', 39),
	(281, 'Traiguén', 39),
	(282, 'Victoria', 39),
	(283, 'Corral', 40),
	(284, 'Lanco', 40),
	(285, 'Los Lagos', 40),
	(286, 'Máfil', 40),
	(287, 'Mariquina', 40),
	(288, 'Paillaco', 40),
	(289, 'Panguipulli', 40),
	(290, 'Valdivia', 40),
	(291, 'Futrono', 41),
	(292, 'La Unión', 41),
	(293, 'Lago Ranco', 41),
	(294, 'Río Bueno', 41),
	(295, 'Ancud', 42),
	(296, 'Castro', 42),
	(297, 'Chonchi', 42),
	(298, 'Curaco de Vélez', 42),
	(299, 'Dalcahue', 42),
	(300, 'Puqueldón', 42),
	(301, 'Queilén', 42),
	(302, 'Quemchi', 42),
	(303, 'Quellón', 42),
	(304, 'Quinchao', 42),
	(305, 'Calbuco', 43),
	(306, 'Cochamó', 43),
	(307, 'Fresia', 43),
	(308, 'Frutillar', 43),
	(309, 'Llanquihue', 43),
	(310, 'Los Muermos', 43),
	(311, 'Maullín', 43),
	(312, 'Puerto Montt', 43),
	(313, 'Puerto Varas', 43),
	(314, 'Osorno', 44),
	(315, 'Puero Octay', 44),
	(316, 'Purranque', 44),
	(317, 'Puyehue', 44),
	(318, 'Río Negro', 44),
	(319, 'San Juan de la Costa', 44),
	(320, 'San Pablo', 44),
	(321, 'Chaitén', 45),
	(322, 'Futaleufú', 45),
	(323, 'Hualaihué', 45),
	(324, 'Palena', 45),
	(325, 'Aisén', 46),
	(326, 'Cisnes', 46),
	(327, 'Guaitecas', 46),
	(328, 'Cochrane', 47),
	(329, 'O\'higgins', 47),
	(330, 'Tortel', 47),
	(331, 'Coihaique', 48),
	(332, 'Lago Verde', 48),
	(333, 'Chile Chico', 49),
	(334, 'Río Ibáñez', 49),
	(335, 'Antártica', 50),
	(336, 'Cabo de Hornos', 50),
	(337, 'Laguna Blanca', 51),
	(338, 'Punta Arenas', 51),
	(339, 'Río Verde', 51),
	(340, 'San Gregorio', 51),
	(341, 'Porvenir', 52),
	(342, 'Primavera', 52),
	(343, 'Timaukel', 52),
	(344, 'Natales', 53),
	(345, 'Torres del Paine', 53);
/*!40000 ALTER TABLE `comunas` ENABLE KEYS */;

-- Dumping structure for table datomed.conotificaciones
CREATE TABLE IF NOT EXISTS `conotificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL COMMENT 'Titulo descriptivo de la notificación',
  `estado` int(10) DEFAULT 0 COMMENT '0 = Activo\n1 = Inactivo',
  `asunto` varchar(120) DEFAULT NULL COMMENT 'Asunto para el correo que se enviará',
  `de` varchar(45) DEFAULT NULL COMMENT 'Ej: noreply@datomed.com',
  `para` varchar(45) DEFAULT NULL COMMENT 'Destinatario del mensaje',
  `cuerpo` longtext DEFAULT NULL,
  `tipo_notificacion` int(10) NOT NULL DEFAULT 0 COMMENT '0 = Mail de bienvenida.\n1 = Mail solicitud de hora telemedicina\n2 = Mail solicitud de hora presencial\n3 = Mail solicitud de hora telemedicina aprobado\n4 = Mail solicitud de hora presencial aprobado\n5 = Mail solicitud de hora rechazado',
  PRIMARY KEY (`id`,`tipo_notificacion`),
  KEY `idx` (`estado`,`tipo_notificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table datomed.conotificaciones: ~0 rows (approximately)
DELETE FROM `conotificaciones`;
/*!40000 ALTER TABLE `conotificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `conotificaciones` ENABLE KEYS */;

-- Dumping structure for table datomed.copublicacion
CREATE TABLE IF NOT EXISTS `copublicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(10) DEFAULT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `cuerpo` longtext DEFAULT NULL,
  `estado` varchar(45) DEFAULT '0' COMMENT '0 = Activo, 1 = Inactivo',
  `fecha` datetime DEFAULT current_timestamp(),
  `extracto` varchar(150) DEFAULT NULL,
  `imagen_url` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table datomed.copublicacion: ~0 rows (approximately)
DELETE FROM `copublicacion`;
/*!40000 ALTER TABLE `copublicacion` DISABLE KEYS */;
INSERT INTO `copublicacion` (`id`, `categoria_id`, `titulo`, `cuerpo`, `estado`, `fecha`, `extracto`, `imagen_url`) VALUES
	(1, 1, 'Noticia Blog Demo', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis quis nisi et ullamcorper. Sed fermentum ligula a enim placerat elementum. Curabitur eu nisi molestie odio efficitur tincidunt vitae non nunc. Suspendisse nec magna felis. Aliquam erat volutpat. Duis nunc nisl, mollis eget tristique non, condimentum sit amet quam. Nunc sit amet eleifend magna. Fusce ligula arcu, mattis ut lorem at, fringilla lacinia metus. Curabitur eget eros lorem.</p>\r\n<p>&nbsp;</p>\r\n<p>Phasellus eleifend quam vel arcu varius, vel tristique nisl efficitur. Fusce venenatis, lorem id porta luctus, elit dolor sodales lorem, aliquet commodo libero dolor ac sapien. Donec efficitur nisi risus, fermentum semper felis consequat tempor. Vivamus ac lacinia purus. Etiam porta sem vel massa ultrices fringilla. Mauris risus magna, feugiat et turpis nec, elementum vestibulum odio. Aliquam ac facilisis massa. Sed suscipit justo sed metus elementum, fermentum congue justo porta. Maecenas suscipit justo eu facilisis feugiat. Phasellus nec odio et tortor accumsan pharetra sed at quam. Mauris rhoncus orci sem, eu auctor arcu porta ac. Proin egestas elit at lobortis suscipit.</p>\r\n<p>&nbsp;</p>\r\n<p>Praesent malesuada molestie dignissim. Nulla maximus laoreet consectetur. Vestibulum ac nisl vitae nisi sagittis dictum at id magna. Vivamus porta nisl et augue posuere, in congue lectus porttitor. Nulla eget enim tincidunt, congue turpis id, tempus elit. Sed euismod, eros at pellentesque porttitor, tellus est accumsan ante, ut porta massa nisi quis nisi. In interdum mattis libero, eget rutrum elit laoreet nec. Nullam congue, augue eget lobortis viverra, urna massa facilisis lectus, vel rhoncus sem ligula sit amet erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ut neque libero. Phasellus aliquet ut libero tincidunt luctus. Pellentesque egestas finibus nisl ac pulvinar. Maecenas faucibus, purus et dignissim eleifend, odio mauris mattis elit, a mollis leo eros ut est. Nam lobortis nibh eu enim maximus aliquam. Aliquam erat volutpat. Aliquam erat volutpat.</p>', '0', '2019-01-09 09:39:33', '<p>Lorem ipsum dolor sit amet</p>', '');
/*!40000 ALTER TABLE `copublicacion` ENABLE KEYS */;

-- Dumping structure for table datomed.coreceta
CREATE TABLE IF NOT EXISTS `coreceta` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rut_doctor` varchar(12) NOT NULL,
  `rut_paciente` varchar(12) NOT NULL,
  `fecha` datetime NOT NULL,
  `desc` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rut_doctor_rut_paciente_fecha` (`rut_doctor`,`rut_paciente`,`fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table datomed.coreceta: ~0 rows (approximately)
DELETE FROM `coreceta`;
/*!40000 ALTER TABLE `coreceta` DISABLE KEYS */;
/*!40000 ALTER TABLE `coreceta` ENABLE KEYS */;

-- Dumping structure for table datomed.empresas
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table datomed.empresas: ~0 rows (approximately)
DELETE FROM `empresas`;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` (`id`, `empresa`) VALUES
	(1, 'NETSTREAM');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;

-- Dumping structure for table datomed.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table datomed.groups: ~5 rows (approximately)
DELETE FROM `groups`;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
	(1, 'admin', 'Administrator'),
	(2, 'usuarios', 'Usuarios sin privilegios'),
	(3, 'Front', 'Menu para el front'),
	(4, 'Soy Paciente', 'Paciente'),
	(5, 'Soy Doctor', 'Doctor'),
	(6, 'Soy Centro de Salud', 'Centro de salud, Clínicas');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Dumping structure for table datomed.login_attempts
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table datomed.login_attempts: ~0 rows (approximately)
DELETE FROM `login_attempts`;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;

-- Dumping structure for table datomed.macategorias
CREATE TABLE IF NOT EXISTS `macategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre de la categoría, sirve para publicación de contenidos',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table datomed.macategorias: ~0 rows (approximately)
DELETE FROM `macategorias`;
/*!40000 ALTER TABLE `macategorias` DISABLE KEYS */;
INSERT INTO `macategorias` (`id`, `nombre`) VALUES
	(1, 'Blog');
/*!40000 ALTER TABLE `macategorias` ENABLE KEYS */;

-- Dumping structure for table datomed.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_menu` varchar(200) NOT NULL,
  `descripcion` varchar(140) DEFAULT NULL,
  `controlador` varchar(200) NOT NULL,
  `orden` int(1) DEFAULT NULL,
  `front` int(1) DEFAULT 1 COMMENT '0 = Se muestra en sistema interior de navegacion\n1 = Se muestra en front',
  PRIMARY KEY (`id`),
  KEY `nombre_menu` (`nombre_menu`),
  KEY `controlador` (`controlador`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COMMENT='items de menu asociados a un controlador';

-- Dumping data for table datomed.menu: ~9 rows (approximately)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `nombre_menu`, `descripcion`, `controlador`, `orden`, `front`) VALUES
	(1, 'Menu', 'Mantenedor Menu', 'admin/menu/index', 2, 0),
	(2, 'Usuarios', 'Menú para usuarios', 'admin/usuarios/index', 1, 0),
	(3, 'Mensajería', 'notificaciones del sistema', 'admin/mensajeria/index', 4, 0),
	(4, 'Categorías', 'categorías del sistema', 'admin/categorias/index', 3, 0),
	(9, 'Grupos', 'Sin descripción', 'admin/grupos/index', 5, 0),
	(10, 'Blog', 'Blog sistema', 'admin/blog/index', 6, 0),
	(11, 'Agenda', 'Agenda', '/datomed/agenda/index', 1, 0),
	(12, 'Especialidades', 'Especialidades médicas', '/admin/especialidades/index', 7, 0),
	(13, 'Ficha RME', 'Ficha médica', '/datomed/ficha/index', 2, 0),
	(14, 'Editar Perfil', 'Edición de perfil', '/datomed/usuarios/index', 9, 0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table datomed.permisos
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(10) NOT NULL DEFAULT 0,
  `menu_id` int(10) NOT NULL DEFAULT 0,
  `permiso_id` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`grupo_id`,`menu_id`,`permiso_id`),
  KEY `grupo_id` (`grupo_id`),
  KEY `menu_id` (`menu_id`),
  KEY `permiso_id` (`permiso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COMMENT='asociaciÃ³n permisos por grupos de usuarios asociados a un item de menu';

-- Dumping data for table datomed.permisos: ~18 rows (approximately)
DELETE FROM `permisos`;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` (`id`, `grupo_id`, `menu_id`, `permiso_id`) VALUES
	(1, 1, 1, 1),
	(2, 1, 2, 1),
	(3, 1, 3, 1),
	(4, 1, 4, 1),
	(5, 1, 9, 1),
	(6, 3, 5, 1),
	(7, 3, 6, 1),
	(8, 3, 7, 1),
	(9, 3, 8, 1),
	(10, 1, 10, 1),
	(11, 4, 11, 1),
	(12, 5, 11, 1),
	(13, 1, 12, 1),
	(14, 1, 12, 1),
	(15, 4, 13, 1),
	(16, 5, 13, 1),
	(17, 4, 14, 1),
	(18, 5, 14, 1);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;

-- Dumping structure for table datomed.permisos_dic
CREATE TABLE IF NOT EXISTS `permisos_dic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_permiso` varchar(50) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nombre_permiso` (`nombre_permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='diccionario de permisos';

-- Dumping data for table datomed.permisos_dic: ~0 rows (approximately)
DELETE FROM `permisos_dic`;
/*!40000 ALTER TABLE `permisos_dic` DISABLE KEYS */;
/*!40000 ALTER TABLE `permisos_dic` ENABLE KEYS */;

-- Dumping structure for table datomed.provincias
CREATE TABLE IF NOT EXISTS `provincias` (
  `provincia_id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia_nombre` varchar(64) NOT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`provincia_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- Dumping data for table datomed.provincias: 53 rows
DELETE FROM `provincias`;
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` (`provincia_id`, `provincia_nombre`, `region_id`) VALUES
	(1, 'Arica', 1),
	(2, 'Parinacota', 1),
	(3, 'Iquique', 2),
	(4, 'El Tamarugal', 2),
	(5, 'Antofagasta', 3),
	(6, 'El Loa', 3),
	(7, 'Tocopilla', 3),
	(8, 'Chañaral', 4),
	(9, 'Copiapó', 4),
	(10, 'Huasco', 4),
	(11, 'Choapa', 5),
	(12, 'Elqui', 5),
	(13, 'Limarí', 5),
	(14, 'Isla de Pascua', 6),
	(15, 'Los Andes', 6),
	(16, 'Petorca', 6),
	(17, 'Quillota', 6),
	(18, 'San Antonio', 6),
	(19, 'San Felipe de Aconcagua', 6),
	(20, 'Valparaiso', 6),
	(21, 'Chacabuco', 7),
	(22, 'Cordillera', 7),
	(23, 'Maipo', 7),
	(24, 'Melipilla', 7),
	(25, 'Santiago', 7),
	(26, 'Talagante', 7),
	(27, 'Cachapoal', 8),
	(28, 'Cardenal Caro', 8),
	(29, 'Colchagua', 8),
	(30, 'Cauquenes', 9),
	(31, 'Curicó', 9),
	(32, 'Linares', 9),
	(33, 'Talca', 9),
	(34, 'Arauco', 10),
	(35, 'Bio Bío', 10),
	(36, 'Concepción', 10),
	(37, 'Ñuble', 10),
	(38, 'Cautín', 11),
	(39, 'Malleco', 11),
	(40, 'Valdivia', 12),
	(41, 'Ranco', 12),
	(42, 'Chiloé', 13),
	(43, 'Llanquihue', 13),
	(44, 'Osorno', 13),
	(45, 'Palena', 13),
	(46, 'Aisén', 14),
	(47, 'Capitán Prat', 14),
	(48, 'Coihaique', 14),
	(49, 'General Carrera', 14),
	(50, 'Antártica Chilena', 15),
	(51, 'Magallanes', 15),
	(52, 'Tierra del Fuego', 15),
	(53, 'Última Esperanza', 15);
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;

-- Dumping structure for table datomed.regiones
CREATE TABLE IF NOT EXISTS `regiones` (
  `region_id` int(11) NOT NULL AUTO_INCREMENT,
  `region_nombre` varchar(64) NOT NULL,
  `region_ordinal` varchar(4) NOT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table datomed.regiones: 15 rows
DELETE FROM `regiones`;
/*!40000 ALTER TABLE `regiones` DISABLE KEYS */;
INSERT INTO `regiones` (`region_id`, `region_nombre`, `region_ordinal`) VALUES
	(1, 'Arica y Parinacota', 'XV'),
	(2, 'Tarapacá', 'I'),
	(3, 'Antofagasta', 'II'),
	(4, 'Atacama', 'III'),
	(5, 'Coquimbo', 'IV'),
	(6, 'Valparaiso', 'V'),
	(7, 'Metropolitana de Santiago', 'RM'),
	(8, 'Libertador General Bernardo O\'Higgins', 'VI'),
	(9, 'Maule', 'VII'),
	(10, 'Biobío', 'VIII'),
	(11, 'La Araucanía', 'IX'),
	(12, 'Los Ríos', 'XIV'),
	(13, 'Los Lagos', 'X'),
	(14, 'Aisén del General Carlos Ibáñez del Campo', 'XI'),
	(15, 'Magallanes y de la Antártica Chilena', 'XII');
/*!40000 ALTER TABLE `regiones` ENABLE KEYS */;

-- Dumping structure for table datomed.seo
CREATE TABLE IF NOT EXISTS `seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta_description` varchar(200) NOT NULL DEFAULT '0',
  `titulo` varchar(200) NOT NULL DEFAULT '0',
  `meta_tags` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla para posicionamiento web';

-- Dumping data for table datomed.seo: ~0 rows (approximately)
DELETE FROM `seo`;
/*!40000 ALTER TABLE `seo` DISABLE KEYS */;
/*!40000 ALTER TABLE `seo` ENABLE KEYS */;

-- Dumping structure for table datomed.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `rut` varchar(12) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `comuna_id` int(10) DEFAULT NULL,
  `region_id` int(10) DEFAULT NULL,
  `provincia_id` int(10) DEFAULT NULL,
  `prevision_id` varchar(50) DEFAULT NULL,
  `imagen_url` varchar(100) DEFAULT NULL,
  `membresia` int(2) NOT NULL DEFAULT 0 COMMENT '0 = sin membresía\n1 = membresía premium',
  `rut_colegio_medico` varchar(20) DEFAULT NULL,
  `especialidad` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`membresia`,`rut`),
  KEY `rut_idx` (`rut`,`comuna_id`,`region_id`,`first_name`,`last_name`,`provincia_id`,`rut_colegio_medico`),
  KEY `especialidad` (`especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table datomed.users: ~5 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `rut`, `direccion`, `comuna_id`, `region_id`, `provincia_id`, `prevision_id`, `imagen_url`, `membresia`, `rut_colegio_medico`, `especialidad`) VALUES
	(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'px3bqP5cNMehnAWjQCcfBO', 1268889823, 1586359539, 1, 'Admin', 'istrator', 'ADMIN', '0', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0),
	(8, '::1', '', '$2y$08$OYTQkNL3jO0Kkm3hT9xn9u5YESgwo0W7meaWIKddxMO3Ft2lnxRLm', NULL, 'ralf@netstream.cl', NULL, 'eHZrdcYgTLcMiFGxV1ycbu239f66f55d300a8368', 1517083546, 'jHuEYS7GSYJBNNor4BjHQO', 1517070481, 1542635430, 1, 'Rodrigo', 'Alfaro', NULL, NULL, '15021038-0', 'Santa Isabel 502', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(9, '::1', '', '$2y$08$39l7oP5EvwLl9WRMt3oiTOCz1h3cIk5aQwjZ/X7ZGEeL6NTaRpx5G', NULL, 'jdoe@gmail.com', 'a1ac2e0c35d065130c7021b12b695cfa2cbdcc48', NULL, NULL, 'o6skID649m5DOtLWYaEIVu', 1585759866, 1586362124, 1, 'Jhon', 'Doe', NULL, NULL, '5193162-9', 'Lo Barnechea 1200', NULL, NULL, NULL, NULL, NULL, 0, NULL, 0),
	(10, '::1', '', '$2y$08$DOCj8n25XwCWyl1PBcKI6uYe7IXnyiihLHffpN9/DiFjyTklHVbFG', NULL, 'jwalker@gmail.com', '7538d06a13febb3d53f20300ac3c2688061644db', NULL, NULL, 'oMq8JMgg8EgohpqUUGKgiO', 1585763126, 1586033829, 1, 'Jhonnie', 'Walker', NULL, NULL, '5087160-6', 'Avenida Los Presidentes', NULL, NULL, NULL, NULL, NULL, 0, NULL, 3),
	(11, '::1', '', '$2y$08$eYiYM6AzTSO6Z04QgcXDA.ODgS.jgeOoAOG5FjK0LCgFxmnqSYP3a', NULL, 'jdaniels@gmail.com', '90d935ed7ab6ccc62c4a0294ab934032456a40ba', NULL, NULL, 'dJ4/vXAY4nzznxGni1xKtu', 1585768032, 1586362232, 1, 'Jack', 'Daniels', NULL, NULL, '6668303-6', 'Vitacura 7000', NULL, NULL, NULL, NULL, NULL, 0, '1-9', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table datomed.users_groups
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table datomed.users_groups: ~4 rows (approximately)
DELETE FROM `users_groups`;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1, 1, 1),
	(11, 1, 2),
	(12, 9, 4),
	(13, 10, 5),
	(14, 11, 5);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
