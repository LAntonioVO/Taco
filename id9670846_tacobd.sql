-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-02-2020 a las 05:35:16
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id9670846_tacobd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asociaciones`
--

CREATE TABLE `asociaciones` (
  `id_asociacion` int(11) NOT NULL,
  `asociacion` text COLLATE latin1_spanish_ci NOT NULL,
  `informacion` text COLLATE latin1_spanish_ci NOT NULL,
  `correo` text COLLATE latin1_spanish_ci NOT NULL,
  `contrasena` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `asociaciones`
--

INSERT INTO `asociaciones` (`id_asociacion`, `asociacion`, `informacion`, `correo`, `contrasena`) VALUES
(3, 'Manos de la caridad', 'Ayudando', 'ayuda@manos', 'manos1234'),
(4, 'dif', 'buenas personas', '16030138@itesa.edu.mx', '1234'),
(5, 'Ayudar', 'kljashlafskdj', 'ayudar@j', '1234'),
(6, 'DIF', 'DFGHJ', 'hola@123', '123'),
(7, 'DIF CARDENAS', 'ayudamos a la gente de cardenas', 'dif@dif.com', 'dif'),
(8, 'Patito', 'patos', 'pato@123', '12345'),
(9, 'Ramiro', 'Ramirito', '16030118@itesa.edu.mx', 'ramiro'),
(10, 'pulque', 'Lázaro Cárdenas Hgo.', 'moralesivan824@gmail.com', 'micorazonestuyo28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisos`
--

CREATE TABLE `avisos` (
  `id_aviso` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `informacion` text COLLATE latin1_spanish_ci NOT NULL,
  `id_asociacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `avisos`
--

INSERT INTO `avisos` (`id_aviso`, `id_restaurante`, `informacion`, `id_asociacion`) VALUES
(12, 6, 'tengo 3 kilos de pescuesos', 8),
(13, 7, 'quiero cosas', 10),
(14, 8, 'dfsdsgf', 5),
(15, 9, 'Tengo un kilo de arroz', 6),
(16, 11, 'tengo unas buenas grasosas!!!!!', 7),
(17, 11, '3 kg de pezcuezos', 8),
(18, 12, 'Perros calientes', 8),
(19, 16, '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `id_restaurante` int(11) NOT NULL,
  `nombre` text COLLATE latin1_spanish_ci NOT NULL,
  `encargado` text COLLATE latin1_spanish_ci NOT NULL,
  `direccion` text COLLATE latin1_spanish_ci NOT NULL,
  `correo` text COLLATE latin1_spanish_ci NOT NULL,
  `contrasena` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`id_restaurante`, `nombre`, `encargado`, `direccion`, `correo`, `contrasena`) VALUES
(1, 'Cobadonga', 'Jose Jaramillo', 'PeÃ±as', 'jose@ghjk', 'jose123'),
(2, 'Grasosas', 'Jose real', 'Del alva 5023', 'grasa@itesa', 'grasas'),
(3, 'Grasosas', 'Jose', 'PeÃ±as 12345', 'papasbird@dfghjk', '1234'),
(4, 'DOGO', 'Lopez', 'Apan', 'dogo@ggmail', '1234'),
(5, 'Grasosas', 'Jose', 'pefghj', 'bird123@itesa', '123'),
(6, 'comidafacil', 'hector', 'PeÃ±itas', '15030400@itesa.edu.mx', 'hector123'),
(7, 'Gracias', 'fghjk', 'kajdhfasldjhasÃ±kj', 'dfghjk@qwerghjk', '1234'),
(8, 'Grasosas', 'juan', 'ITESA', 'itesa@1', '1234'),
(9, 'Grasosas', 'Juan', 'ITESA', 'itesa@123', '123'),
(10, 'PapasBird', 'bird', 'Guerrero #50 apan hidago', 'juantopo@topo', '1234567890'),
(11, 'Grasosas2', 'Ramiro|', 'colonia centro tepeapulco 5 de mayo ', 'ramiro@ramirofood.com', '1234567890'),
(12, 'Grasosas', 'Borre', 'gerrero #5 apan hidalgo', 'grasa@123', 'grasa'),
(13, 'cielborrego', 'borre', 'guerrero 8 apan hidalgo', 'ghjkl@wer', 'qwer'),
(14, 'Cobadonga', 'Hector', 'guerrero 8 apan hidalgo', 'hhernandezm@itesa.edu.mx', 'hector'),
(15, 'Papasbird', 'BIRD', 'AV ITESA', '15030455@itesa.edu.mx', 'nel'),
(16, 'ITESA Cafetería', 'Lic. Jose juan', 'Peñitas S/N. Apan Hidalgo', 'contacto@itesa.edu.mx', 'itesa123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asociaciones`
--
ALTER TABLE `asociaciones`
  ADD PRIMARY KEY (`id_asociacion`);

--
-- Indices de la tabla `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`id_aviso`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`id_restaurante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asociaciones`
--
ALTER TABLE `asociaciones`
  MODIFY `id_asociacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id_aviso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `id_restaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
