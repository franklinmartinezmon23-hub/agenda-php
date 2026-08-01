-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-08-2026 a las 21:09:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(3, 'desconocidos'),
(8, 'familia'),
(9, 'trabajo'),
(10, 'hola'),
(11, 'vecinos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `imagen` varchar(255) DEFAULT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `nombres`, `apellidos`, `telefono`, `correo`, `direccion`, `fecha_registro`, `imagen`, `nombre_categoria`) VALUES
(2, 'edgar', 'melga', '8765-4332', 'edgar24@gmail.com', 'res.palmira', '2026-08-01 18:51:07', '../assets/uploads/1785532646_images (5).jpg', 'desconocidos'),
(3, 'pedro', 'lopez', '9876-1232', 'franklinmartinezmon23@gmail.com', 'res.mirador', '2026-08-01 18:51:15', '../assets/uploads/1785532633_images (6).jpg', 'familia'),
(4, 'maria', 'montejo', '9854-6754', 'maria@gmail.com', 'col.elder romero', '2026-08-01 18:51:55', '../assets/uploads/1785532583_images (7).jpg', 'trabajo'),
(5, 'Kenan ', 'Zamora', '9876-1245', 'kenanlamora@gmail.com', 'La cichilla', '2026-08-01 18:52:50', '../assets/uploads/1785267858_images.jpg', 'vecinos'),
(6, 'sns', 'sand', '9872-1234', 'nose@gmail.com', 'nose', '2026-08-01 18:52:59', '../assets/uploads/1785268140_images (2).jpg', 'vecinos'),
(7, 'karen', 'coto', '9087-1132', 'karen@gmail.com', 'nose', '2026-08-01 18:52:39', '../assets/uploads/1785268373_images (3).jpg', 'hola'),
(8, 'saira', 'garcia', '9876-8234', 'garcia@gmail.com', 'nose', '2026-08-01 18:51:29', '../assets/uploads/1785532619_images (8).jpg', 'hola'),
(9, 'arnold', 'mayorga', '9876-1234', 'arnold@gmail.com', 'nose', '2026-08-01 18:51:47', '../assets/uploads/1785532594_images (6).jpg', 'vecinos'),
(10, 'arnold', 'vasquez', '7898-1234', 'vasquez@gmail.com', 'dolores', '2026-08-01 18:52:04', '../assets/uploads/1785531718_images (6).jpg', 'familia'),
(11, 'kenan', 'la mora', '1234-1234', 'lamora@gmail.com', 'el cerro la cuchilla', '2026-08-01 18:52:09', '../assets/uploads/1785531694_images (5).jpg', 'desconocidos'),
(12, 'karen', 'tejada', '1243-1256', 'tejada@gmail.com', 'los plancitos', '2026-08-01 18:52:23', '../assets/uploads/1785531505_images (5).jpg', 'familia'),
(13, 'nose', 'nose', '911', 'nose@gmail.com', 'tampoco se', '2026-08-01 18:52:31', '../assets/uploads/1785531422_images (5).jpg', 'vecinos'),
(14, 'ns', 'sns', '99239', 'g@gmail.com', 'dferd', '2026-08-01 18:52:14', '../assets/uploads/1785531556_images (5).jpg', 'desconocidos'),
(15, 'juan', 'monroy', '9876-1233', 'juan@gmail.com', 'nose', '2026-08-01 18:50:57', '../assets/uploads/1785609949_images (6).jpg', 'trabajo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
