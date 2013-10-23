-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-10-2013 a las 13:01:11
-- Versión del servidor: 5.1.70-cll
-- Versión de PHP: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sersubs_kentucky`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jb_media`
--

CREATE TABLE IF NOT EXISTS `jb_media` (
  `id_user` varchar(12) NOT NULL,
  `name` varchar(20) NOT NULL,
  `media_type` varchar(10) NOT NULL,
  `date_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` blob NOT NULL,
  KEY `FK_media` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jb_user`
--

CREATE TABLE IF NOT EXISTS `jb_user` (
  `id` varchar(12) NOT NULL,
  `username` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `birthday` date NOT NULL,
  `gender` char(1) NOT NULL,
  `email` varchar(70) NOT NULL,
  `date_register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jb_voters`
--

CREATE TABLE IF NOT EXISTS `jb_voters` (
  `id_user` varchar(12) NOT NULL,
  `id_voter` varchar(12) NOT NULL,
  `vote_date` date NOT NULL,
  `kty_votes` bigint(30) NOT NULL,
  KEY `FK_voters` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jb_media`
--
ALTER TABLE `jb_media`
  ADD CONSTRAINT `FK_media` FOREIGN KEY (`id_user`) REFERENCES `jb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jb_voters`
--
ALTER TABLE `jb_voters`
  ADD CONSTRAINT `FK_voters` FOREIGN KEY (`id_user`) REFERENCES `jb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
         