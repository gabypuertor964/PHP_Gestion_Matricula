-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2023 a las 06:43:34
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

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
CREATE DATABASE IF NOT EXISTS `dbgestionmatriculas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbgestionmatriculas`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `consultarEstudiante`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarEstudiante` (IN `num_doc` INT)   BEGIN  
    SELECT 
        * 
    FROM estudiantes 

    INNER JOIN entidades
    ON estudiantes.fkIdEntidad=entidades.idEntidad
    
    WHERE numDoc=num_doc;
END$$

DROP PROCEDURE IF EXISTS `registrarEstudiante`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarEstudiante` (IN `num_doc` INT, IN `nombre_completo` VARCHAR(60), IN `password` VARCHAR(255), IN `edad` INT, IN `id_entidad` INT)   BEGIN  

    START TRANSACTION;

        INSERT INTO estudiantes VALUES(num_doc,nombre_completo,password,edad,id_entidad);

    COMMIT;

END$$

DROP PROCEDURE IF EXISTS `registrarMatricula`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarMatricula` (IN `id_curso` INT, IN `id_estudiante` INT, IN `sub_total` INT, IN `valor_descuento` INT, IN `total_matricula` INT, IN `fecha_matricula` DATETIME)   BEGIN  

    START TRANSACTION;

        INSERT INTO matriculas VALUES(null,id_curso,id_estudiante,sub_total,valor_descuento,total_matricula,fecha_matricula,1);

    COMMIT;

END$$

DROP PROCEDURE IF EXISTS `validarMatriculas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `validarMatriculas` (IN `num_doc` INT)   BEGIN  
    SELECT 
        count(estado) as 'numMatriculas'
    FROM matriculas 

    WHERE numDoc=num_doc AND estado=1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `idCurso` int(11) NOT NULL COMMENT 'Identificador del Curso',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre del Curso',
  `fechaInicio` date NOT NULL COMMENT 'Fecha programada de inicio del curso',
  `fechaFin` date NOT NULL COMMENT 'Fecha programada de finalizacion del curso',
  `precioNeto` int(11) NOT NULL COMMENT 'Valor base del curso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidades`
--

DROP TABLE IF EXISTS `entidades`;
CREATE TABLE `entidades` (
  `idEntidad` int(11) NOT NULL COMMENT 'Idenificador de la entidad',
  `nombreEntidad` varchar(40) NOT NULL COMMENT 'Nombre de la Entidad',
  `nombreGrupo` varchar(40) NOT NULL COMMENT 'Nombre del subgrupo de la entidad'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE `estudiantes` (
  `numDoc` int(11) NOT NULL COMMENT 'Numero de Documento del Estudiante',
  `nombreCompleto` varchar(60) NOT NULL COMMENT 'Nombre Completo del Estudiante',
  `password` varchar(255) NOT NULL COMMENT 'Contraseña Hasheada del Estudiante',
  `edad` int(11) NOT NULL COMMENT 'Edad del Estudiante',
  `fkIdEntidad` int(11) NOT NULL COMMENT 'Llave Foranea tabla Entidades'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idCurso`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `entidades`
--
ALTER TABLE `entidades`
  ADD PRIMARY KEY (`idEntidad`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`numDoc`),
  ADD UNIQUE KEY `nombreCompleto` (`nombreCompleto`),
  ADD UNIQUE KEY `password` (`password`),
  ADD KEY `fkIdEntidad` (`fkIdEntidad`);

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
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Curso';

--
-- AUTO_INCREMENT de la tabla `entidades`
--
ALTER TABLE `entidades`
  MODIFY `idEntidad` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Idenificador de la entidad';

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `idMatricula` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Matricula';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`fkIdEntidad`) REFERENCES `entidades` (`idEntidad`);

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
