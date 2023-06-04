-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2023 a las 23:42:27
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbgestionmatriculas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

DROP TABLE IF EXISTS `matriculas`;
CREATE TABLE `matriculas` (
  `idMatricula` int(11) NOT NULL COMMENT 'Identificador Matricula',
  `fkIdCurso` int(11) NOT NULL COMMENT 'Llave foranea Identificador del Curso',
  `fkIdEstudiante` int(11) NOT NULL COMMENT 'Llave foranea Identificador del Estudiante',
  `subTotal` int(11) NOT NULL COMMENT 'Valor del Curso antes de aplicar el descuento',
  `valorDescuento` int(11) NOT NULL COMMENT 'Valor del descuento el cual sera descontado del subtotal',
  `totalMatricula` int(11) NOT NULL COMMENT 'Valor final de la Matricula',
  `fechaMatricula` datetime NOT NULL COMMENT 'Fecha y Hora de la Matricula',
  `estado` tinyint(1) NOT NULL COMMENT 'Estado Actual de la matricula'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`idMatricula`, `fkIdCurso`, `fkIdEstudiante`, `subTotal`, `valorDescuento`, `totalMatricula`, `fechaMatricula`, `estado`) VALUES
(5, 1, 1019604622, 20000, 7000, 13000, '2023-06-04 23:40:15', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`idMatricula`),
  ADD KEY `fkIdCurso` (`fkIdCurso`),
  ADD KEY `fkIdEstudiante` (`fkIdEstudiante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `idMatricula` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Matricula', AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`fkIdCurso`) REFERENCES `cursos` (`idCurso`),
  ADD CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`fkIdEstudiante`) REFERENCES `estudiantes` (`numDoc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
