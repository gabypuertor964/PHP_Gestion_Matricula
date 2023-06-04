-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2023 a las 23:50:26
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
CREATE DATABASE IF NOT EXISTS `dbgestionmatriculas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbgestionmatriculas`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarCursos` ()   BEGIN  
        SELECT 
            * 
        FROM cursos

        WHERE fechaInicio>NOW();

    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarEntidades` ()   BEGIN  
    SELECT
        *
    FROM entidades;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarMatriculas` (IN `num_doc` INT)   BEGIN  
    SELECT
     
        cursos.nombre as 'nombreCurso',
        cursos.fechaInicio,
        cursos.fechaFin,
        matriculas.totalMatricula 

    FROM matriculas 

    LEFT JOIN cursos
    ON cursos.idCurso=fkIdCurso

    LEFT JOIN estudiantes
    ON estudiantes.numDoc=num_doc

    WHERE estado=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarEstudiante` (IN `num_doc` INT, IN `nombre_completo` VARCHAR(60), IN `password` VARCHAR(255), IN `edad` INT, IN `id_entidad` INT)   BEGIN  

        START TRANSACTION;

            INSERT INTO estudiantes VALUES(num_doc,nombre_completo,password,edad,id_entidad);

        COMMIT;

    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarMatricula` (IN `id_curso` INT, IN `id_estudiante` INT, IN `sub_total` INT, IN `valor_descuento` INT, IN `total_matricula` INT, IN `fecha_matricula` DATETIME)   BEGIN  
        START TRANSACTION;

            INSERT INTO matriculas VALUES(null,id_curso,id_estudiante,sub_total,valor_descuento,total_matricula,fecha_matricula,1);

        COMMIT;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validarCurso` (IN `id_curso` INT)   BEGIN
        SELECT
            *
        FROM cursos

        WHERE idCurso=id_curso;
    
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validarDocumento` (IN `num_doc` INT)   BEGIN
        SELECT
            numDoc
        FROM estudiantes

        WHERE numDoc=num_doc;
    
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validarEntidad` (IN `id_entidad` INT)   BEGIN
        SELECT
            *
        FROM entidades

        WHERE idEntidad=id_entidad;
    
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validarLogin` (IN `num_doc` INT)   BEGIN  
    SELECT 
        password,
        numDoc,
        entidades.nombreEntidad,
        entidades.nombreGrupo,
        edad
    FROM estudiantes 
    
    LEFT JOIN entidades
    ON entidades.idEntidad=estudiantes.fkIdEntidad
    
    WHERE numDoc=num_doc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validarNombre` (IN `nombre_completo` VARCHAR(60))   BEGIN
        SELECT
            nombreCompleto
        FROM estudiantes

        WHERE nombreCompleto=nombre_completo;
    
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `idCurso` int(11) NOT NULL COMMENT 'Identificador del Curso',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre del Curso',
  `fechaInicio` date NOT NULL COMMENT 'Fecha programada de inicio del curso',
  `fechaFin` date NOT NULL COMMENT 'Fecha programada de finalizacion del curso',
  `precioNeto` int(11) NOT NULL COMMENT 'Valor base del curso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`idCurso`, `nombre`, `fechaInicio`, `fechaFin`, `precioNeto`) VALUES
(1, 'Python', '2023-12-12', '2023-06-29', 20000),
(2, 'PHP', '2023-06-23', '2023-06-30', 250000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidades`
--

CREATE TABLE `entidades` (
  `idEntidad` int(11) NOT NULL COMMENT 'Idenificador de la entidad',
  `nombreEntidad` varchar(40) NOT NULL COMMENT 'Nombre de la Entidad',
  `nombreGrupo` varchar(40) NOT NULL COMMENT 'Nombre del subgrupo de la entidad'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entidades`
--

INSERT INTO `entidades` (`idEntidad`, `nombreEntidad`, `nombreGrupo`) VALUES
(1, 'SENA', 'ADSO'),
(2, 'SENA', 'TECNICO'),
(3, 'SENA', 'TECNOLOGO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `numDoc` int(11) NOT NULL COMMENT 'Numero de Documento del Estudiante',
  `nombreCompleto` varchar(60) NOT NULL COMMENT 'Nombre Completo del Estudiante',
  `password` varchar(255) NOT NULL COMMENT 'Contraseña Hasheada del Estudiante',
  `edad` int(11) NOT NULL COMMENT 'Edad del Estudiante',
  `fkIdEntidad` int(11) NOT NULL COMMENT 'Llave Foranea tabla Entidades'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`numDoc`, `nombreCompleto`, `password`, `edad`, `fkIdEntidad`) VALUES
(1019604621, 'LUIS', '$2y$10$u/cLZLgMRPp8XU5//mE.uOg0sXxJ.eFd7NSdvxLi410OhgCIopWpO', 17, 2),
(1019604622, 'SANDRA GABRIELA PUERTO ROJAS', '$2y$10$0rcUoX0r.x6ubBoW/XlqG.4QR8Z0eXq3dUkQI2yaNUoPu37sgZmCS', 17, 1),
(2147483647, 'PEPE', '$2y$10$RGA/w/PZrsUsCexpdHuTSux5VS9TXCK15c3L./sHjl9ZAIc0tNKOu', 18, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

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
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Curso', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `entidades`
--
ALTER TABLE `entidades`
  MODIFY `idEntidad` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Idenificador de la entidad', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `idMatricula` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Matricula', AUTO_INCREMENT=6;

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
