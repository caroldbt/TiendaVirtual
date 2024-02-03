-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 16-10-2021 a las 19:21:19
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Tienda`
--
CREATE DATABASE IF NOT EXISTS `TiendaRopa` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `TiendaRopa`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

DROP TABLE IF EXISTS `carrito`;
CREATE TABLE IF NOT EXISTS `carrito` (
  `codigo` varchar(5) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `unidades` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `FK_carrito_usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`codigo`, `usuario`, `unidades`) VALUES
('c12', 'carol2', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `codigoCategoria` varchar(3) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`codigoCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`codigoCategoria`, `tipo`) VALUES
('A1', 'ABRIGOS'),
('J1', 'JERSÉIS'),
('P1', 'PANTALONES'),
('V1', 'VESTIDOS');

DROP TABLE IF EXISTS `tallas`;
CREATE TABLE IF NOT EXISTS `tallas` (
  `codigoTallas` int(1) NOT NULL,
  `tipo` varchar(3) NOT NULL,
  PRIMARY KEY (`codigoTallas`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `tallas` (`codigoTallas`, `tipo`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `codigo` varchar(5) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `composicion` varchar(255) NOT NULL,
  `precio` decimal(3,2) NOT NULL,
  `codigoCategoria` varchar(3) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `unidad` int(3) NOT NULL,
  `codigoTallas` int(1) NOT NULL,
  `seccion` varchar(255) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codigo`, `nombre`, `descripcion`,`composicion`,`precio`, `codigoCategoria`, `foto`, `unidad`,`codigoTallas`,`seccion`) VALUES
('C10', 'Jersey punto ochos', 'Tejido de punto grueso. Tejido mezcla de algodón. Manga larga. Cuello redondo.',' Composición: 57% acrílico,43% algodón', '26.99', 'J1', 'imagen1.jpg', 0,1,'MUJER'),
('C12', 'Jersey punto rombos', 'Tejido de punto grueso. Diseño de rombos. Diseño oversize. Cuello pico. Manga larga. Diseño geométrico.','Composición: 83% acrílico,10% poliamida,7% poliéster', '39.99', 'J1', 'imagen2.jpg', 27,2,'MUJER'),
('C13', 'Jersey fino lino', 'Tejido mezcla de algodón y lino. Tejido fluido. Cuello redondo. Manga larga.','Composición: 39% viscosa,35% lino,26% algodón', '19.99', 'J1', 'imagen3.jpg', 12,4,'HOMBRE'),
('C14', 'Vestido estampado floral', 'Tejido fluido. Diseño entallado. Diseño midi. Diseño acampanado. Diseño estampado. Estampado floral. Escote de pico cruzado. Manga larga con puños abotonados. Cordón ajustable en la cintura.','Composición: 100% viscosa', '49.99', 'V1', 'vestido1.jpg', 17,3,'MUJER'),
('C15', 'Vestido algodón rayas', '100% Algodón. Estampado de rayas. Diseño midi. Diseño acampanado. Escote recto. Tirantes anchos. Panel elástico. Detalles fruncidos.', '29.99', 'V1', 'vestido2.jpg', 36,2,'MUJER'),
('C16', 'Pantalón skinny crop', 'Tejido ligero. Diseño estampado. Corte skinny. Tiro alto. Diseño tobillero. Dos bolsillos laterales. Trabillas. Cierre de cremallera y botón.','Composición: 64% poliéster,34% viscosa,2% elastano. Forro bolsillo: 80% poliéster,20% algodón', '25.99', 'P1', 'pantalon1.jpg', 15,3,'MUJER'),
('C17', 'Abrigo anorak ultralight  botones', 'Tejido técnico repelente al agua. Diseño acolchado. Diseño recto. Diseño corto. Cuello redondo. Manga larga. Cierre de botones a presión en la parte delantera.','Composición: 55% poliéster,45% poliamida. Relleno: 85% poliéster ( reciclado ),15% poliéster', '39.99', 'A1', 'abrigo1.jpg', 10,3,'MUJER'),
('C18', 'Abrigo algodón botones', 'Tejido con algodón. Diseño entallado, largo, acampanado. Cuello clásico. Manga larga. Dos bolsillos laterales. Forro interior, botones en la parte delantera.','Composición: 50% poliéster,50% algodón. Forro: 51% viscosa,49% poliéster. Vivo: 100% poliéster', '99.99', 'A1', 'abrigo2.jpg', 18,2,'MUJER');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario` varchar(30) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  PRIMARY KEY (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `email`, `contrasena`) VALUES
('carol2', 'carol2@gmail.com', '$2y$10$tdUKHowtt7m89fpbsdNDCuiWCEo7yKjUaa6PRQEfi4Z3xbZH6aLj2'),
('leslie', 'leslie@gmail.com', '$2y$10$H8upvUCL2W0nZyOIS4cumubk7kKnhFCQi0P6qSY63i//1kKwBIQt.');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `FK_Carrito_producto` FOREIGN KEY (`codigo`) REFERENCES `producto` (`codigo`),
  ADD CONSTRAINT `FK_carrito_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`);

Alter table `producto`
Add constraint `FK_producto_categoria` foreign key (`codigoCategoria`) references `categorias`(`codigoCategoria`),
Add constraint `FK_producto_talla` foreign key (`codigoTallas`) references `tallas`(`codigoTallas`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
