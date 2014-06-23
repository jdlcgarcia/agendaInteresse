-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.12-log - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para agenda
CREATE DATABASE IF NOT EXISTS `agenda` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `agenda`;


-- Volcando estructura para procedimiento agenda.BorrarTelefonos
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `BorrarTelefonos`(IN `i1` INT)
BEGIN
DELETE FROM telefonos WHERE id = i1;
END//
DELIMITER ;


-- Volcando estructura para tabla agenda.contactos
CREATE TABLE IF NOT EXISTS `contactos` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'vacio@vacio.com',
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agenda.contactos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` (`id`, `nombre`, `apellido`, `direccion`, `email`, `creado`) VALUES
	(1, 'Andres', 'Meneses Requena', 'Trafalgar 50', 'andres@gmail.com', '2014-04-07 15:28:29'),
	(2, 'Josue', 'Sánchez', 'Acacias 8', 'josue@gmail.com', '2014-04-07 15:28:36'),
	(3, 'Daniel', 'Guzmán', 'Trafalgar 29', 'daniel@gmail.com', '2014-04-07 15:28:46'),
	(4, 'Diana', 'Hernández', 'Cafetales 23', 'diana@gmail.com', '2014-04-07 15:29:16');
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;


-- Volcando estructura para procedimiento agenda.CrearTelefono
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearTelefono`(IN `i1` INT, IN `i2` VARCHAR(8), IN `i3` VARCHAR(16))
BEGIN 
	INSERT INTO telefonos (id,tipo,numero) VALUES (i1,i2,i3);
END//
DELIMITER ;


-- Volcando estructura para procedimiento agenda.datosDe
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `datosDe`(IN `i` INTEGER)
BEGIN 
SELECT * from contactos where id = i;
END//
DELIMITER ;


-- Volcando estructura para procedimiento agenda.EditarContacto
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `EditarContacto`(IN `i1` INT, IN `i2` VARCHAR(50), IN `i3` VARCHAR(50), IN `i4` VARCHAR(50), IN `i5` VARCHAR(50))
BEGIN
update contactos 
SET nombre = i2,
apellido = i3,
direccion = i4,
email = i5
WHERE id = i1;
END//
DELIMITER ;


-- Volcando estructura para procedimiento agenda.NuevoContacto
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `NuevoContacto`(IN `i1` VARCHAR(32), IN `i2` VARCHAR(128), IN `i3` VARCHAR(128), IN `i4` VARCHAR(64), OUT `i5` INT)
BEGIN
INSERT INTO contactos (nombre, apellido, direccion, email, creado) VALUES
(
	i1,
	i2,
	i3,
	i4,
	NOW());
	select LAST_INSERT_ID() into i5;
END//
DELIMITER ;


-- Volcando estructura para tabla agenda.telefonos
CREATE TABLE IF NOT EXISTS `telefonos` (
  `id` int(8) NOT NULL,
  `tipo` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agenda.telefonos: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `telefonos` DISABLE KEYS */;
INSERT INTO `telefonos` (`id`, `tipo`, `numero`) VALUES
	(1, 'Casa', '956200703'),
	(1, 'España M', '645406763'),
	(1, 'México M', '23123213'),
	(2, 'Fijo', '823918731928'),
	(2, 'Móvil', '645.406.763'),
	(2, 'Oficina', '0981724983'),
	(3, 'Busca', '123'),
	(3, 'Mi Casa', '123456789'),
	(3, 'Primero', '123123123'),
	(4, 'Casa', '3423423'),
	(4, 'Mi Movil', '987654321');
/*!40000 ALTER TABLE `telefonos` ENABLE KEYS */;


-- Volcando estructura para procedimiento agenda.TelefonosDe
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `TelefonosDe`(IN i INTEGER)
BEGIN
SELECT * from telefonos where id = i;
END//
DELIMITER ;


-- Volcando estructura para procedimiento agenda.TodosContactos
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `TodosContactos`()
BEGIN
   SELECT * FROM contactos order by apellido ASC,nombre ASC;
   END//
DELIMITER ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
