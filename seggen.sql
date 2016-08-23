-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-08-2016 a las 16:36:48
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12
--FBM asdasdasd

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `seggen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `glob_comunas`
--

CREATE TABLE IF NOT EXISTS `glob_comunas` (
  `id_co` int(11) NOT NULL COMMENT 'ID unico de la comuna',
  `id_pr` int(11) NOT NULL COMMENT 'ID de la provincia asociada',
  `str_descripcion` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Nombre descriptivo de la comuna',
  PRIMARY KEY (`id_co`,`id_pr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Lista de comunas por provincia';

--
-- Volcado de datos para la tabla `glob_comunas`
--

INSERT INTO `glob_comunas` (`id_co`, `id_pr`, `str_descripcion`) VALUES
(1, 1, 'ARICA'),
(2, 1, 'CAMARONES'),
(3, 2, 'PUTRE'),
(4, 2, 'GENERAL LAGOS'),
(5, 3, 'IQUIQUE'),
(6, 3, 'ALTO HOSPICIO'),
(7, 4, 'POZO ALMONTE'),
(8, 4, 'CAMIÑA'),
(9, 4, 'COLCHANE'),
(10, 4, 'HUARA'),
(11, 4, 'PICA'),
(12, 5, 'ANTOFAGASTA'),
(13, 5, 'MEJILLONES'),
(14, 5, 'SIERRA GORDA'),
(15, 5, 'TALTAL'),
(16, 6, 'CALAMA'),
(17, 6, 'OLLAGÜE'),
(18, 6, 'SAN PEDRO DE ATACAMA'),
(19, 7, 'TOCOPILLA'),
(20, 7, 'MARÍA ELENA'),
(21, 8, 'COPIAPÓ'),
(22, 8, 'CALDERA'),
(23, 8, 'TIERRA AMARILLA'),
(24, 9, 'CHAÑARAL'),
(25, 9, 'DIEGO DE ALMAGRO'),
(26, 10, 'VALLENAR'),
(27, 10, 'ALTO DEL CARMEN'),
(28, 10, 'FREIRINA'),
(29, 10, 'HUASCO'),
(30, 11, 'LA SERENA'),
(31, 11, 'COQUIMBO'),
(32, 11, 'ANDACOLLO'),
(33, 11, 'LA HIGUERA'),
(34, 11, 'PAIGUANO'),
(35, 11, 'VICUÑA'),
(36, 12, 'ILLAPEL'),
(37, 12, 'CANELA'),
(38, 12, 'LOS VILOS'),
(39, 12, 'SALAMANCA'),
(40, 13, 'OVALLE'),
(41, 13, 'COMBARBALÁ'),
(42, 13, 'MONTE PATRIA'),
(43, 13, 'PUNITAQUI'),
(44, 13, 'RÍO HURTADO'),
(45, 14, 'VALPARAÍSO'),
(46, 14, 'CASABLANCA'),
(47, 14, 'CONCÓN'),
(48, 14, 'JUAN FERNÁNDEZ'),
(49, 14, 'PUCHUNCAVÍ'),
(50, 14, 'QUINTERO'),
(51, 14, 'VIÑA DEL MAR'),
(52, 15, 'ISLA DE PASCUA'),
(53, 16, 'LOS ANDES'),
(54, 16, 'CALLE LARGA'),
(55, 16, 'RINCONADA'),
(56, 16, 'SAN ESTEBAN'),
(57, 17, 'LA LIGUA'),
(58, 17, 'CABILDO'),
(59, 17, 'PAPUDO'),
(60, 17, 'PETORCA'),
(61, 17, 'ZAPALLAR'),
(62, 18, 'QUILLOTA'),
(63, 18, 'CALERA'),
(64, 18, 'HIJUELAS'),
(65, 18, 'LA CRUZ'),
(66, 18, 'NOGALES'),
(67, 19, 'SAN ANTONIO'),
(68, 19, 'ALGARROBO'),
(69, 19, 'CARTAGENA'),
(70, 19, 'EL QUISCO'),
(71, 19, 'EL TABO'),
(72, 19, 'SANTO DOMINGO'),
(73, 20, 'SAN FELIPE'),
(74, 20, 'CATEMU'),
(75, 20, 'LLAILLAY'),
(76, 20, 'PANQUEHUE'),
(77, 20, 'PUTAENDO'),
(78, 20, 'SANTA MARÍA'),
(79, 21, 'LIMACHE'),
(80, 21, 'QUILPUÉ'),
(81, 21, 'VILLA ALEMANA'),
(82, 21, 'OLMUÉ'),
(83, 22, 'RANCAGUA'),
(84, 22, 'CODEGUA'),
(85, 22, 'COINCO'),
(86, 22, 'COLTAUCO'),
(87, 22, 'DOÑIHUE'),
(88, 22, 'GRANEROS'),
(89, 22, 'LAS CABRAS'),
(90, 22, 'MACHALÍ'),
(91, 22, 'MALLOA'),
(92, 22, 'MOSTAZAL'),
(93, 22, 'OLIVAR'),
(94, 22, 'PEUMO'),
(95, 22, 'PICHIDEGUA'),
(96, 22, 'QUINTA DE TILCOCO'),
(97, 22, 'RENGO'),
(98, 22, 'REQUÍNOA'),
(99, 22, 'SAN VICENTE'),
(100, 23, 'PICHILEMU'),
(101, 23, 'LA ESTRELLA'),
(102, 23, 'LITUECHE'),
(103, 23, 'MARCHIHUE'),
(104, 23, 'NAVIDAD'),
(105, 23, 'PAREDONES'),
(106, 24, 'SAN FERNANDO'),
(107, 24, 'CHÉPICA'),
(108, 24, 'CHIMBARONGO'),
(109, 24, 'LOLOL'),
(110, 24, 'NANCAGUA'),
(111, 24, 'PALMILLA'),
(112, 24, 'PERALILLO'),
(113, 24, 'PLACILLA'),
(114, 24, 'PUMANQUE'),
(115, 24, 'SANTA CRUZ'),
(116, 25, 'TALCA'),
(117, 25, 'CONSTITUCIÓN'),
(118, 25, 'CUREPTO'),
(119, 25, 'EMPEDRADO'),
(120, 25, 'MAULE'),
(121, 25, 'PELARCO'),
(122, 25, 'PENCAHUE'),
(123, 25, 'RÍO CLARO'),
(124, 25, 'SAN CLEMENTE'),
(125, 25, 'SAN RAFAEL'),
(126, 26, 'CAUQUENES'),
(127, 26, 'CHANCO'),
(128, 26, 'PELLUHUE'),
(129, 27, 'CURICÓ'),
(130, 27, 'HUALAÑÉ'),
(131, 27, 'LICANTÉN'),
(132, 27, 'MOLINA'),
(133, 27, 'RAUCO'),
(134, 27, 'ROMERAL'),
(135, 27, 'SAGRADA FAMILIA'),
(136, 27, 'TENO'),
(137, 27, 'VICHUQUÉN'),
(138, 28, 'LINARES'),
(139, 28, 'COLBÚN'),
(140, 28, 'LONGAVÍ'),
(141, 28, 'PARRAL'),
(142, 28, 'RETIRO'),
(143, 28, 'SAN JAVIER'),
(144, 28, 'VILLA ALEGRE'),
(145, 28, 'YERBAS BUENAS'),
(146, 29, 'CONCEPCIÓN'),
(147, 29, 'CORONEL'),
(148, 29, 'CHIGUAYANTE'),
(149, 29, 'FLORIDA'),
(150, 29, 'HUALQUI'),
(151, 29, 'LOTA'),
(152, 29, 'PENCO'),
(153, 29, 'SAN PEDRO DE LA PAZ'),
(154, 29, 'SANTA JUANA'),
(155, 29, 'TALCAHUANO'),
(156, 29, 'TOMÉ'),
(157, 29, 'HUALPÉN'),
(158, 30, 'LEBU'),
(159, 30, 'ARAUCO'),
(160, 30, 'CAÑETE'),
(161, 30, 'CONTULMO'),
(162, 30, 'CURANILAHUE'),
(163, 30, 'LOS ALAMOS'),
(164, 30, 'TIRÚA'),
(165, 31, 'LOS ANGELES'),
(166, 31, 'ANTUCO'),
(167, 31, 'CABRERO'),
(168, 31, 'LAJA'),
(169, 31, 'MULCHÉN'),
(170, 31, 'NACIMIENTO'),
(171, 31, 'NEGRETE'),
(172, 31, 'QUILACO'),
(173, 31, 'QUILLECO'),
(174, 31, 'SAN ROSENDO'),
(175, 31, 'SANTA BÁRBARA'),
(176, 31, 'TUCAPEL'),
(177, 31, 'YUMBEL'),
(178, 31, 'ALTO BIOBÍO'),
(179, 32, 'CHILLÁN'),
(180, 32, 'BULNES'),
(181, 32, 'COBQUECURA'),
(182, 32, 'COELEMU'),
(183, 32, 'COIHUECO'),
(184, 32, 'CHILLÁN VIEJO'),
(185, 32, 'EL CARMEN'),
(186, 32, 'NINHUE'),
(187, 32, 'ÑIQUÉN'),
(188, 32, 'PEMUCO'),
(189, 32, 'PINTO'),
(190, 32, 'PORTEZUELO'),
(191, 32, 'QUILLÓN'),
(192, 32, 'QUIRIHUE'),
(193, 32, 'RÁNQUIL'),
(194, 32, 'SAN CARLOS'),
(195, 32, 'SAN FABIÁN'),
(196, 32, 'SAN IGNACIO'),
(197, 32, 'SAN NICOLÁS'),
(198, 32, 'TREGUACO'),
(199, 32, 'YUNGAY'),
(200, 33, 'TEMUCO'),
(201, 33, 'CARAHUE'),
(202, 33, 'CUNCO'),
(203, 33, 'CURARREHUE'),
(204, 33, 'FREIRE'),
(205, 33, 'GALVARINO'),
(206, 33, 'GORBEA'),
(207, 33, 'LAUTARO'),
(208, 33, 'LONCOCHE'),
(209, 33, 'MELIPEUCO'),
(210, 33, 'NUEVA IMPERIAL'),
(211, 33, 'PADRE LAS CASAS'),
(212, 33, 'PERQUENCO'),
(213, 33, 'PITRUFQUÉN'),
(214, 33, 'PUCÓN'),
(215, 33, 'SAAVEDRA'),
(216, 33, 'TEODORO SCHMIDT'),
(217, 33, 'TOLTÉN'),
(218, 33, 'VILCÚN'),
(219, 33, 'VILLARRICA'),
(220, 33, 'CHOLCHOL'),
(221, 34, 'ANGOL'),
(222, 34, 'COLLIPULLI'),
(223, 34, 'CURACAUTÍN'),
(224, 34, 'ERCILLA'),
(225, 34, 'LONQUIMAY'),
(226, 34, 'LOS SAUCES'),
(227, 34, 'LUMACO'),
(228, 34, 'PURÉN'),
(229, 34, 'RENAICO'),
(230, 34, 'TRAIGUÉN'),
(231, 34, 'VICTORIA'),
(232, 35, 'VALDIVIA'),
(233, 35, 'CORRAL'),
(234, 35, 'LANCO'),
(235, 35, 'LOS LAGOS'),
(236, 35, 'MÁFIL'),
(237, 35, 'MARIQUINA'),
(238, 35, 'PAILLACO'),
(239, 35, 'PANGUIPULLI'),
(240, 36, 'LA UNIÓN'),
(241, 36, 'FUTRONO'),
(242, 36, 'LAGO RANCO'),
(243, 36, 'RÍO BUENO'),
(244, 37, 'PUERTO MONTT'),
(245, 37, 'CALBUCO'),
(246, 37, 'COCHAMÓ'),
(247, 37, 'FRESIA'),
(248, 37, 'FRUTILLAR'),
(249, 37, 'LOS MUERMOS'),
(250, 37, 'LLANQUIHUE'),
(251, 37, 'MAULLÍN'),
(252, 37, 'PUERTO VARAS'),
(253, 38, 'CASTRO'),
(254, 38, 'ANCUD'),
(255, 38, 'CHONCHI'),
(256, 38, 'CURACO DE VÉLEZ'),
(257, 38, 'DALCAHUE'),
(258, 38, 'PUQUELDÓN'),
(259, 38, 'QUEILÉN'),
(260, 38, 'QUELLÓN'),
(261, 38, 'QUEMCHI'),
(262, 38, 'QUINCHAO'),
(263, 39, 'OSORNO'),
(264, 39, 'PUERTO OCTAY'),
(265, 39, 'PURRANQUE'),
(266, 39, 'PUYEHUE'),
(267, 39, 'RÍO NEGRO'),
(268, 39, 'SAN JUAN DE LA COSTA'),
(269, 39, 'SAN PABLO'),
(270, 40, 'CHAITÉN'),
(271, 40, 'FUTALEUFÚ'),
(272, 40, 'HUALAIHUÉ'),
(273, 40, 'PALENA'),
(274, 41, 'COIHAIQUE'),
(275, 41, 'LAGO VERDE'),
(276, 42, 'AISÉN'),
(277, 42, 'CISNES'),
(278, 42, 'GUAITECAS'),
(279, 43, 'COCHRANE'),
(280, 43, 'O''HIGGINS'),
(281, 43, 'TORTEL'),
(282, 44, 'CHILE CHICO'),
(283, 44, 'RÍO IBÁÑEZ'),
(284, 45, 'PUNTA ARENAS'),
(285, 45, 'LAGUNA BLANCA'),
(286, 45, 'RÍO VERDE'),
(287, 45, 'SAN GREGORIO'),
(288, 46, 'CABO DE HORNOS'),
(289, 46, 'ANTÁRTICA'),
(290, 47, 'PORVENIR'),
(291, 47, 'PRIMAVERA'),
(292, 47, 'TIMAUKEL'),
(293, 48, 'NATALES'),
(294, 48, 'TORRES DEL PAINE'),
(295, 49, 'SANTIAGO'),
(296, 49, 'CERRILLOS'),
(297, 49, 'CERRO NAVIA'),
(298, 49, 'CONCHALÍ'),
(299, 49, 'EL BOSQUE'),
(300, 49, 'ESTACIÓN CENTRAL'),
(301, 49, 'HUECHURABA'),
(302, 49, 'INDEPENDENCIA'),
(303, 49, 'LA CISTERNA'),
(304, 49, 'LA FLORIDA'),
(305, 49, 'LA GRANJA'),
(306, 49, 'LA PINTANA'),
(307, 49, 'LA REINA'),
(308, 49, 'LAS CONDES'),
(309, 49, 'LO BARNECHEA'),
(310, 49, 'LO ESPEJO'),
(311, 49, 'LO PRADO'),
(312, 49, 'MACUL'),
(313, 49, 'MAIPÚ'),
(314, 49, 'ÑUÑOA'),
(315, 49, 'PEDRO AGUIRRE CERDA'),
(316, 49, 'PEÑALOLÉN'),
(317, 49, 'PROVIDENCIA'),
(318, 49, 'PUDAHUEL'),
(319, 49, 'QUILICURA'),
(320, 49, 'QUINTA NORMAL'),
(321, 49, 'RECOLETA'),
(322, 49, 'RENCA'),
(323, 49, 'SAN JOAQUÍN'),
(324, 49, 'SAN MIGUEL'),
(325, 49, 'SAN RAMÓN'),
(326, 49, 'VITACURA'),
(327, 50, 'PUENTE ALTO'),
(328, 50, 'PIRQUE'),
(329, 50, 'SAN JOSÉ DE MAIPO'),
(330, 51, 'COLINA'),
(331, 51, 'LAMPA'),
(332, 51, 'TILTIL'),
(333, 52, 'SAN BERNARDO'),
(334, 52, 'BUIN'),
(335, 52, 'CALERA DE TANGO'),
(336, 52, 'PAINE'),
(337, 53, 'MELIPILLA'),
(338, 53, 'ALHUÉ'),
(339, 53, 'CURACAVÍ'),
(340, 53, 'MARÍA PINTO'),
(341, 53, 'SAN PEDRO'),
(342, 54, 'TALAGANTE'),
(343, 54, 'EL MONTE'),
(344, 54, 'ISLA DE MAIPO'),
(345, 54, 'PADRE HURTADO'),
(346, 54, 'PEÑAFLOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `glob_empresas`
--

CREATE TABLE IF NOT EXISTS `glob_empresas` (
  `rut` varchar(15) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `giro` int(15) NOT NULL,
  `email` varchar(2000) NOT NULL,
  `representante` varchar(2000) NOT NULL,
  `creacion` datetime NOT NULL,
  `modificacion` datetime NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`rut`),
  UNIQUE KEY `rut` (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `glob_empresas`
--

INSERT INTO `glob_empresas` (`rut`, `nombre`, `giro`, `email`, `representante`, `creacion`, `modificacion`, `estado`) VALUES
('61.604.000-6', 'POLLA CHILENA DE BENEFICENCIA', 0, '', '', '2016-07-11 00:00:00', '2016-07-14 00:26:44', 1),
('61.605.000-1', 'INSTITUTO DE SALUD PUBLICA DE CHILE', 0, '', '', '2016-07-11 00:00:00', '2016-07-30 00:00:00', 1),
('61.608.001-6', 'CEMENTERIO GENERAL', 0, '', '', '2016-07-10 00:00:00', '2016-07-12 15:39:52', 1),
('96.571.220-8', 'BANCHILE CORREDORES DE BOLSA S.A.', 0, '', '', '2016-07-12 15:43:19', '2016-07-12 15:43:19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `glob_menu`
--

CREATE TABLE IF NOT EXISTS `glob_menu` (
  `id` int(15) NOT NULL,
  `texto` varchar(50) NOT NULL,
  `texto_en` varchar(50) NOT NULL,
  `url` varchar(2000) NOT NULL,
  `id_padre` int(15) NOT NULL,
  `icono` varchar(200) NOT NULL,
  `orden` int(15) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `glob_menu`
--

INSERT INTO `glob_menu` (`id`, `texto`, `texto_en`, `url`, `id_padre`, `icono`, `orden`, `estado`) VALUES
(13, 'Preguntas', 'Preguntas', '', 4, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 7, 1),
(1, 'Sistema', 'System', '', 0, '<i class="fa fa-lg fa-fw txt-color-blue fa-cogs"></i>', 1, 1),
(11, 'Fórmulas', 'Fórmulas', '', 4, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 5, 1),
(3, 'Mant. de Usuarios', 'User List', 'Sistema/Usuario/listaUsuarios', 1, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 1, 1),
(15, 'Aplicaciones', 'Aplicaciones', '', 4, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 9, 1),
(14, 'Parámetros', 'Parámetros', '', 4, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 8, 1),
(2, 'Productos', 'Productos', '', 0, '<i class="fa fa-lg fa-fw txt-color-blue fa-cubes"></i>', 2, 1),
(4, 'Tablas Maestras', 'Tablas Maestras', '', 2, '<i class="fa fa-lg fa-fw txt-color-blue fa-folder-open"></i> ', 1, 1),
(10, 'Cláusulas', 'Cláusulas', '', 4, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 4, 1),
(12, 'Políticas de autorización', 'Políticas de autorización', '', 4, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 6, 1),
(9, 'Títulos', 'Títulos', '', 4, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 3, 1),
(5, 'Ramos', 'Ramos', '', 4, '<i class="fa fa-lg fa-fw txt-color-blue fa-folder-open"></i> ', 1, 1),
(6, 'Ramos FECU', 'Ramos FECU', '', 5, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 1, 1),
(7, 'Ramos Compañía', 'Ramos Compañía', '', 5, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 2, 1),
(8, 'Planes', 'Planes', '', 4, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 2, 1),
(16, 'Tipos de Movimientos', 'Tipos de Movimientos', '', 4, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 10, 1),
(17, 'Mant. de productos', 'Mantenedor de productos', '', 2, '<i class="fa fa-lg fa-fw txt-color-blue fa-folder-open"></i> ', 3, 1),
(18, 'Nuevo Producto', 'Nuevo Producto', '', 17, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 1, 1),
(19, 'Adm. de Productos', 'Administrador de Productos', '', 17, '<i class="fa fa-lg fa-fw txt-color-blue fa-folder-open"></i> ', 2, 1),
(20, 'Adm. de planes', 'Administración de planes', '', 19, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 1, 1),
(21, 'Adm. de coberturas', 'Administración de coberturas', '', 19, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 2, 1),
(22, 'Adm. de títulos', 'Administración de títulos', '', 19, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 3, 1),
(23, 'Adm. de cláusulas', 'Administración de cláusulas', '', 19, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 4, 1),
(24, 'Adm. de Fórmulas', 'Administración de Fórmulas', '', 19, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 5, 1),
(25, 'Adm. de Preguntas', 'Administración de Preguntas', '', 19, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 6, 1),
(26, 'Adm. de Parámetros', 'Administración de Parámetros', '', 19, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 7, 1),
(27, 'Adm. de Tipos de Mov.', 'Administración de Tipos de Movimiento', '', 19, '<i class="fa fa-lg fa-fw txt-color-blue fa-folder-open"></i> ', 8, 1),
(28, 'Adm. de Políticas de autorización', 'Administración de Políticas de autorización', '', 19, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 9, 1),
(29, 'Alta de Productos', 'Alta de Productos', '', 19, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 10, 1),
(32, 'Parámetros de sistema', 'Parámetros de sistema', '', 1, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 2, 1),
(30, 'Adm. de Secuencia de Pantallas', 'Adm. de Secuencia de Pantallas', '', 27, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 1, 1),
(31, 'Adm. de Validaciones de Secuencia de Pantallas', 'Adm. de Validaciones de Secuencia de Pantallas', '', 27, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 2, 1),
(33, 'Literales', 'Literales', '', 1, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 3, 1),
(34, 'Cargos', 'Cargos', '', 1, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 4, 1),
(35, 'Ciclos', 'Ciclos', '', 0, '<i class="fa fa-lg fa-fw txt-color-blue fa-refresh"></i>', 3, 1),
(36, 'Producción', 'Producción', '', 0, '<i class="fa fa-lg fa-fw txt-color-blue fa-archive"></i>', 4, 1),
(37, 'Parámetros', 'Parámetros', '', 35, '<i class="fa fa-lg fa-fw txt-color-blue fa-folder-open"></i> ', 1, 1),
(38, 'Estados', 'Estados', '', 37, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 1, 1),
(39, 'Sub Estados', 'Sub Estados', '', 37, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 1, 1),
(40, 'Orden de estados y sub estados', 'Orden de estados y sub estados', '', 37, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 1, 1),
(41, 'Nuevo Ciclo', 'Nuevo Ciclo', '', 35, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 2, 1),
(42, 'Asignación de Ciclos', 'Asignación de Ciclos', '', 35, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 3, 1),
(43, 'Consulta de Ciclos', 'Consulta de Ciclos', '', 35, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 4, 1),
(44, 'Entrega de Documentos', 'Entrega de Documentos', '', 35, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 5, 1),
(45, 'Nueva Póliza', 'Nueva Póliza', '', 36, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 1, 1),
(46, 'Nuevo Endoso', 'Nuevo Endoso', '', 36, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 2, 1),
(47, 'Nueva Póliza Madre', 'Nueva Póliza Madre', '', 36, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 3, 1),
(48, 'Producción Pendiente', 'Producción Pendiente', '', 36, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 4, 1),
(49, 'Autorización de Producción', 'Autorización de Producción', '', 36, '<i class="fa fa-lg fa-fw txt-color-blue fa-cube"></i> ', 5, 1);
 
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `glob_menu_perfil`
--

CREATE TABLE IF NOT EXISTS `glob_menu_perfil` (
  `id` int(15) NOT NULL,
  `id_sistema` int(15) NOT NULL,
  `id_perfil` int(15) NOT NULL,
  `id_menu` int(15) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `glob_menu_perfil`
--

INSERT INTO `glob_menu_perfil` (`id`, `id_sistema`, `id_perfil`, `id_menu`, `estado`) VALUES
(16, 1, 1, 16, 1),
(15, 1, 1, 15, 1),
(14, 1, 1, 14, 1),
(13, 1, 1, 13, 1),
(12, 1, 1, 12, 1),
(11, 1, 1, 11, 1),
(10, 1, 1, 10, 1),
(9, 1, 1, 9, 1),
(8, 1, 1, 8, 1),
(7, 1, 1, 7, 1),
(6, 1, 1, 6, 1),
(4, 1, 1, 3, 1),
(3, 1, 1, 4, 1),
(5, 1, 1, 5, 1),
(2, 1, 1, 2, 1),
(1, 1, 1, 1, 1),
(17, 1, 1, 17, 1),
(18, 1, 1, 18, 1),
(19, 1, 1, 19, 1),
(20, 1, 1, 20, 1),
(21, 1, 1, 21, 1),
(22, 1, 1, 22, 1),
(23, 1, 1, 23, 1),
(24, 1, 1, 24, 1),
(25, 1, 1, 25, 1),
(26, 1, 1, 26, 1),
(27, 1, 1, 27, 1),
(28, 1, 1, 28, 1),
(29, 1, 1, 29, 1),
(30, 1, 1, 30, 1),
(31, 1, 1, 31, 1),
(32, 1, 1, 32, 1),
(33, 1, 1, 33, 1),
(34, 1, 1, 34, 1),
(35, 1, 1, 35, 1),
(36, 1, 1, 36, 1),
(37, 1, 1, 37, 1),
(38, 1, 1, 38, 1),
(39, 1, 1, 39, 1),
(40, 1, 1, 40, 1),
(41, 1, 1, 41, 1),
(42, 1, 1, 42, 1),
(43, 1, 1, 43, 1),
(44, 1, 1, 44, 1),
(45, 1, 1, 45, 1),
(46, 1, 1, 46, 1),
(47, 1, 1, 47, 1),
(48, 1, 1, 48, 1),
(49, 1, 1, 49, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `glob_perfil`
--

CREATE TABLE IF NOT EXISTS `glob_perfil` (
  `id` int(15) NOT NULL,
  `id_sistema` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `glob_perfil`
--

INSERT INTO `glob_perfil` (`id`, `id_sistema`, `nombre`, `estado`) VALUES
(1, 1, 'Administrador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `glob_provincias`
--

CREATE TABLE IF NOT EXISTS `glob_provincias` (
  `id_pr` int(11) NOT NULL COMMENT 'ID provincia',
  `id_re` int(11) NOT NULL COMMENT 'ID region asociada',
  `str_descripcion` varchar(30) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre descriptivo',
  `num_comunas` int(11) NOT NULL COMMENT 'Numero de comunas',
  PRIMARY KEY (`id_pr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Lista de provincias por region';

--
-- Volcado de datos para la tabla `glob_provincias`
--

INSERT INTO `glob_provincias` (`id_pr`, `id_re`, `str_descripcion`, `num_comunas`) VALUES
(1, 1, 'ARICA', 2),
(2, 1, 'PARINACOTA', 2),
(3, 2, 'IQUIQUE', 2),
(4, 2, 'TAMARUGAL', 5),
(5, 3, 'ANTOFAGASTA', 4),
(6, 3, 'EL LOA', 3),
(7, 3, 'TOCOPILLA', 2),
(8, 4, 'COPIAPÓ', 3),
(9, 4, 'CHAÑARAL', 2),
(10, 4, 'HUASCO', 4),
(11, 5, 'ELQUI', 6),
(12, 5, 'CHOAPA', 4),
(13, 5, 'LIMARÍ', 5),
(14, 6, 'VALPARAÍSO', 7),
(15, 6, 'ISLA DE PASCUA', 1),
(16, 6, 'LOS ANDES', 4),
(17, 6, 'PETORCA', 5),
(18, 6, 'QUILLOTA', 5),
(19, 6, 'SAN ANTONIO', 6),
(20, 6, 'SAN FELIPE DE ACONCAGUA', 6),
(21, 6, 'MARGA MARGA', 4),
(22, 7, 'CACHAPOAL', 17),
(23, 7, 'CARDENAL CARO', 6),
(24, 7, 'COLCHAGUA', 10),
(25, 8, 'TALCA', 10),
(26, 8, 'CAUQUENES', 3),
(27, 8, 'CURICÓ', 9),
(28, 8, 'LINARES', 8),
(29, 9, 'CONCEPCIÓN', 12),
(30, 9, 'ARAUCO', 7),
(31, 9, 'BIOBÍO', 14),
(32, 9, 'ÑUBLE', 21),
(33, 10, 'CAUTÍN', 21),
(34, 10, 'MALLECO', 11),
(35, 11, 'VALDIVIA', 8),
(36, 11, 'RANCO', 4),
(37, 12, 'LLANQUIHUE', 9),
(38, 12, 'CHILOÉ', 10),
(39, 12, 'OSORNO', 7),
(40, 12, 'PALENA', 4),
(41, 13, 'COIHAIQUE', 2),
(42, 13, 'AISÉN', 3),
(43, 13, 'CAPITÁN PRAT', 3),
(44, 13, 'GENERAL CARRERA', 2),
(45, 14, 'MAGALLANES', 4),
(46, 14, 'ANTÁRTICA CHILENA', 2),
(47, 14, 'TIERRA DEL FUEGO', 3),
(48, 14, 'ULTIMA ESPERANZA', 2),
(49, 15, 'SANTIAGO', 32),
(50, 15, 'CORDILLERA', 3),
(51, 15, 'CHACABUCO', 3),
(52, 15, 'MAIPO', 4),
(53, 15, 'MELIPILLA', 5),
(54, 15, 'TALAGANTE', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `glob_regiones`
--

CREATE TABLE IF NOT EXISTS `glob_regiones` (
  `id_re` int(11) NOT NULL COMMENT 'ID unico',
  `str_descripcion` varchar(60) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre extenso',
  `str_romano` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Número de región',
  `num_provincias` int(11) NOT NULL COMMENT 'total provincias',
  `num_comunas` int(11) NOT NULL COMMENT 'Total de comunas',
  PRIMARY KEY (`id_re`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Lista de regiones de Chile';

--
-- Volcado de datos para la tabla `glob_regiones`
--

INSERT INTO `glob_regiones` (`id_re`, `str_descripcion`, `str_romano`, `num_provincias`, `num_comunas`) VALUES
(1, 'ARICA Y PARINACOTA', 'XV', 2, 4),
(2, 'TARAPACÁ', 'I', 2, 7),
(3, 'ANTOFAGASTA', 'II', 3, 9),
(4, 'ATACAMA ', 'III', 3, 9),
(5, 'COQUIMBO ', 'IV', 3, 15),
(6, 'VALPARAÍSO ', 'V', 8, 38),
(7, 'DEL LIBERTADOR GRAL. BERNARDO O''HIGGINS ', 'VI', 3, 33),
(8, 'DEL MAULE', 'VII', 4, 30),
(9, 'DEL BIOBÍO ', 'VIII', 4, 54),
(10, 'DE LA ARAUCANÍA', 'IX', 2, 32),
(11, 'DE LOS RÍOS', 'XIV', 2, 12),
(12, 'DE LOS LAGOS', 'X', 4, 30),
(13, 'AISÉN DEL GRAL. CARLOS IBAÑEZ DEL CAMPO ', 'XI', 4, 10),
(14, 'MAGALLANES Y DE LA ANTÁRTICA CHILENA', 'XII', 4, 11),
(15, 'METROPOLITANA DE SANTIAGO', 'RM', 6, 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `glob_sistema`
--

CREATE TABLE IF NOT EXISTS `glob_sistema` (
  `id` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `glob_sistema`
--

INSERT INTO `glob_sistema` (`id`, `nombre`, `estado`) VALUES
(1, 'Seguros Generales', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `glob_usuarios`
--

CREATE TABLE IF NOT EXISTS `glob_usuarios` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(200) NOT NULL,
  `nombre` varchar(2000) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(2000) DEFAULT NULL,
  `id_perfil` int(15) NOT NULL,
  `estado` int(1) NOT NULL,
  `rut_empresa` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `glob_usuarios`
--

INSERT INTO `glob_usuarios` (`id`, `usuario`, `nombre`, `password`, `email`, `id_perfil`, `estado`, `rut_empresa`) VALUES
(2, '1-9', 'Usuario de Muestra', 'CLNEg5KeGB4fzEg8YFIFbX0wPBAQdoIrSFQxb8ofSl6JhOx9bmXYuqbJcil5ptuszrZ8eVKhACkVUlw+bQSIoA==', NULL, 1, 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
