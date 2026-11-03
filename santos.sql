-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2026 a las 08:03:49
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `santos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `ventas` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `ventas`) VALUES
(1, 'Abono general', 'Acceso a todos los partidos de local en zona general', 1500.00, 98, 'imagenes/Aficion.jpg', 2),
(2, 'Abono Preferente', 'Asientos con más comodidad y mejor vista de la cancha', 2800.00, 150, 'imagenes/trofeos.jpg', 0),
(4, 'Abono Palco', 'Palco con servicio, comida y atención exclusiva ', 2500.00, 249, 'imagenes/e7.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `celular` varchar(25) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `motivo` text NOT NULL,
  `rol` enum('cliente','admin') NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `celular`, `correo`, `password`, `motivo`, `rol`, `fecha_registro`) VALUES
(1, 'Juan', '8713709075', 'juandypalaciosguevara@gmail.com', '$2y$10$8bsfc8TQUT3fcSj/VQZWKeRuQgZNT2P1ccTLJ/qMcMqwS3kpCGdF.', 'pq quiero ir a todos los juegos del llantos', 'admin', '2026-11-03 06:56:57'),
(2, 'Andres', '7321111', 'santos@gmail.com', '$2y$10$pDLKV5ZD9nH1bsOzFe9wfO/q701bPEM8ZGKtFEOBOrigKpPzUPWpm', 'ssdsafd', 'cliente', '2026-11-03 06:56:57'),
(3, 'javivi', '666', 'ja@gmail.com', '$2y$10$3FkcUiosAYTWasGx6w2uNeM8xVIuqNRNLlBeZ9OhQHexKxiIoNBb6', 'simon', 'cliente', '2026-11-03 06:56:57'),
(4, 'Juan', '8713709075', 'juandypalaciosguevara@gmail.com', '$2y$10$KlK0RrO8uoSWIU7SvlEbGOs7ZlrMRqY7YplgfoPQn2zYe4y2Lxksi', 'h', 'cliente', '2026-11-03 06:56:57'),
(5, 'Juan', '8713709075', 'juandypalaciosguevara@gmail.com', '$2y$10$kZnHLmvFlEMmLlsWLzLMIuaGHidNxVN7lP8EEFJ7XJgJFikDLx2I6', 's', 'cliente', '2026-11-03 06:56:57'),
(6, 'Oribe', '2', 'prueba@gmail.com', '$2y$10$KpucVES.8ezH5uM7MZwA5.2Sbuhb335BS2FWTbp3CYXWxWbdnFgOm', 'a', 'cliente', '2026-11-03 06:58:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `id_paypal` varchar(100) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_usuario`, `id_producto`, `monto`, `id_paypal`, `fecha`) VALUES
(1, 4, 1, 1500.00, '9L24431292697611U', '2026-11-03 06:14:47'),
(2, 5, 1, 1500.00, '1016854646844152E', '2026-11-03 06:40:43'),
(3, 6, 4, 2500.00, '1T8316718L6350536', '2026-11-03 06:59:20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
