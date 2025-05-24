-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-05-2025 a las 01:10:35
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_lab4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos`
--

DROP TABLE IF EXISTS `correos`;
CREATE TABLE IF NOT EXISTS `correos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_remitente` int NOT NULL,
  `id_destinatario` int NOT NULL,
  `asunto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cuerpo` text COLLATE utf8mb4_general_ci,
  `fecha_envio` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` char(10) COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `correos`
--

INSERT INTO `correos` (`id`, `id_remitente`, `id_destinatario`, `asunto`, `cuerpo`, `fecha_envio`, `estado`, `tipo`) VALUES
(3, 2, 1, 'Nisi sit repellendu', 'Ducimus aliquip asp editado 2 6 7 9', '2025-05-24 01:08:13', 'pendiente', 1),
(4, 2, 1, 'Architecto cupiditat', 'Nam rerum tenetur al', '2025-05-23 20:14:18', 'enviado', 1),
(5, 1, 2, 'Exercitation invento', 'Modi soluta atque ex', '2025-05-23 20:14:53', 'enviado', 1),
(6, 1, 2, 'Autem quam quaerat r', 'Quam in sunt officii', '2025-05-23 20:15:09', 'pendiente', 1),
(7, 2, 1, 'Nostrud reprehenderi', 'Aut accusantium aute', '2025-05-23 20:30:11', 'enviado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nivel` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `password`, `nombre`, `correo`, `nivel`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrador', 'admin@sis256.edu', 1),
(2, 'user', '12dea96fec20593566ab75692c9949596833adc9', 'Usuario', 'user@sis256.edu', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
