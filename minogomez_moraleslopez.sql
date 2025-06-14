-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2025 a las 23:40:02
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
-- Base de datos: `minogomez_moraleslopez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `activo` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `descripcion`, `activo`) VALUES
(1, 'Almacenamiento', 1),
(2, 'Audio', 1),
(3, 'Fuentes', 1),
(4, 'Gabinetes', 1),
(5, 'Monitores', 1),
(6, 'Motherboards', 1),
(7, 'Perifericos', 1),
(8, 'Placas de Video', 1),
(9, 'Refrigeracion', 1),
(10, 'Sillas', 1),
(11, 'Memorias RAM', 1),
(12, 'Procesadores', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id_consulta` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `respuesta` text NOT NULL,
  `mensaje` text NOT NULL,
  `estado` varchar(25) NOT NULL DEFAULT 'SIN_RESPONDER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `nombre`, `apellido`, `email`, `telefono`, `respuesta`, `mensaje`, `estado`) VALUES
(12, 'Luis', 'Fernández', 'luis.fernandez@gmail.com', '3794567891', 'Hola Luis, Sí, aceptamos pagos en cuotas con tarjeta de crédito.', '¿Aceptan pagos en cuotas con tarjeta de crédito?', 'CONSULTA ELIMINADA'),
(13, 'Benjamin', 'Zimmerman', 'benjamin.z@gmail.com', '3797896543', '', 'Necesito recomendaciones sobre fuentes de alimentación para una PC gamer.', 'SIN_RESPONDER'),
(14, 'Valeria', 'Álvarez', 'valeria.alvarez@email.com', '3799873210', 'Sí, realizamos ensamblaje de PCs. Contáctanos para más detalles o agenda tu servicio.', '¿Ofrecen servicio técnico para ensamblaje de computadoras?', 'CONSULTA ELIMINADA'),
(15, 'Fernando', 'Castillo', 'fernando.c@gmail.com', '3796547890', '', 'Me interesa comprar un monitor ultrawide. ¿Tienen opciones disponibles?', 'SIN_RESPONDER'),
(16, 'Julieta', 'Ramirez', 'julieta.ramirez@gmail.com', '3793214567', '', '¿Pueden enviarme una cotización para un setup completo de oficina?', 'SIN_RESPONDER'),
(17, 'Martín', 'Rodríguez', 'martin.rodriguez@gmail.com', '03799876543', 'Hola Martín, Sí, tenemos los nuevos Ryzen en stock. Puedes comprarlos en línea o en tienda.', '¿Tienen en stock la última generación de procesadores Ryzen?', 'RESPONDIDA'),
(18, 'Sofía', 'Gómez', 'sofia.gomez@email.com', '03796543210', '', '¿Cuáles son los métodos de envío disponibles para Corrientes Capital?', 'SIN_RESPONDER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `descripcion`) VALUES
(1, 'admin'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre_prod` varchar(100) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `precio_vta` float(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `eliminado` varchar(10) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_prod`, `marca`, `imagen`, `categoria_id`, `precio`, `precio_vta`, `stock`, `stock_min`, `eliminado`) VALUES
(1, 'Memoria RAM ADATA DDR5 8GB', 'ADATA', '1749234745_04044cf0930b53acc6f7.webp', 11, 50000.00, 60000.00, 14, 10, 'NO'),
(2, 'Procesador AMD Ryzen 5 4500', 'AMD', '1749234812_47252cf048427a0ec6fb.webp', 12, 70000.00, 90000.00, 0, 5, 'NO'),
(3, 'Disco Sólido SSD ADATA Ultimate SU630 960GB SATA', 'ADATA', '1749235148_e8d538f0618d43a263c5.webp', 1, 60000.00, 75000.00, 17, 20, 'NO'),
(4, 'Auriculares Headset Gamer Corsair HS60 HAPTIC', 'CORSAIR', '1749235253_281ad1836e16c0737243.png', 2, 100000.00, 125000.00, 27, 10, 'NO'),
(5, 'Fuente GIGABYTE P650SS ICE 650W 80 PLUS Silver Blanca', 'GIGABYTE', '1749235330_049a3b88634996ad8f35.webp', 3, 40000.00, 60000.00, 12, 5, 'NO'),
(6, 'Gabinete Gamer ASUS ROG Strix Helios GX601 Mid Tower E-ATX', 'ASUS', '1749235425_b4023b2eb9804d98cd99.webp', 4, 300000.00, 450000.00, 17, 5, 'NO'),
(7, 'Monitor ASUS Eye Care VY229HF-J 21,45', 'ASUS', '1749235523_3b16f26e29a4f12b1d2f.webp', 5, 120000.00, 145000.00, 40, 15, 'NO'),
(8, 'Motherboard GIGABYTE B760M', 'GIGABYTE', '1749235598_8bbb61e11d8e389168fc.webp', 6, 200000.00, 250000.00, 29, 10, 'NO'),
(9, 'Teclado Mecánico Gamer CORSAIR K70', 'CORSAIR', '1749235682_e7f1d7dfc05f01c895f8.webp', 7, 60000.00, 90000.00, 28, 10, 'NO'),
(10, 'Placa de Video ASUS NVIDIA GeForce RTX 3050', 'ASUS', '1749235758_1e3f65f1c09babed0938.webp', 8, 200000.00, 250000.00, 18, 3, 'NO'),
(11, 'Water Cooler CORSAIR NAUTILUS 360', 'CORSAIR', '1749235843_682eb0ec4e155204bbd8.webp', 9, 120000.00, 150000.00, 19, 30, 'NO'),
(12, 'Silla Gamer ASUS ROG AETHON SL201', 'ASUS', '1749235913_9c99ff047041bad46e2d.webp', 10, 500000.00, 600000.00, 17, 10, 'NO'),
(13, 'Procesador Intel Core i3-10100F', 'INTEL', '1749935605_97d1fd49f3e4a7f74601.png', 12, 75000.00, 100000.00, 20, 10, 'NO'),
(14, 'Mouse Corsair Darkstar SlipStream', 'CORSAIR', '1749935669_8ddbaacebd2371547902.png', 7, 120000.00, 140000.00, 30, 15, 'NO'),
(15, 'Mouse HP M200', 'HP', '1749936360_c7c744152ee26a2d8dcc.png', 7, 8000.00, 12000.00, 50, 20, 'NO'),
(16, 'Memoria RAM DDR5 CORSAIR 64GB (2x32GB)', 'CORSAIR', '1749936623_80403312bca09b710653.webp', 11, 200000.00, 250000.00, 25, 10, 'NO'),
(17, 'Disco Sölido SSD ADATA LEGEND 512GB', 'ADATA', '1749936900_d0cf480337b0c2da518b.webp', 1, 25000.00, 35000.00, 50, 20, 'NO'),
(18, 'Monitor Gamer GIGABYTE GS32Q', 'GIGABYTE', '1749937018_dbed0234a2b9df7f8a03.webp', 5, 300000.00, 380000.00, 20, 10, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `perfil_id` int(11) NOT NULL DEFAULT 2,
  `baja` varchar(2) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `usuario`, `email`, `pass`, `perfil_id`, `baja`) VALUES
(9, 'Luana', 'Morales', 'luanalopez', 'luanalopez@gmail.com', '$2y$10$3luNp/k5ZQKg3IN4kt9tDOtffQLcJeerzBw8rtwWROkkih/eDm6Eu', 1, 'NO'),
(10, 'pepe', 'lopez', 'pepe1', 'pepe@gmail.com', '$2y$10$EZZ9kAxbGxuYt7.x85VnE.AO0NFhtNXlYENJia9/LJQ5jlqOXwrN6', 1, 'NO'),
(13, 'Juan', 'Miño', 'JuanM', 'juan@gmail.com', '$2y$10$McznacKQ03qxkcEwFWQpHeeqYv71Uahh9ukQGSkF8cnMUm1lIab8a', 2, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_cabecera`
--

CREATE TABLE `ventas_cabecera` (
  `id_ventas_cabecera` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `total_venta` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_cabecera`
--

INSERT INTO `ventas_cabecera` (`id_ventas_cabecera`, `fecha`, `usuario_id`, `total_venta`) VALUES
(21, '2025-06-11 16:48:01', 9, 1415000.00),
(22, '2025-06-11 16:48:26', 9, 775000.00),
(23, '2025-06-11 16:52:39', 10, 240000.00),
(24, '2025-06-11 16:53:19', 10, 150000.00),
(25, '2025-06-12 09:19:46', 9, 75000.00),
(26, '2025-06-12 09:24:26', 9, 125000.00),
(27, '2025-06-13 15:30:19', 13, 1050000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id_ventas_detalle` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id_ventas_detalle`, `venta_id`, `producto_id`, `cantidad`, `precio`) VALUES
(24, 21, 4, 1, 125000.00),
(25, 21, 12, 2, 1200000.00),
(26, 21, 9, 1, 90000.00),
(27, 22, 10, 1, 250000.00),
(28, 22, 3, 1, 75000.00),
(29, 22, 6, 1, 450000.00),
(30, 23, 1, 1, 60000.00),
(31, 23, 5, 3, 180000.00),
(32, 24, 11, 1, 150000.00),
(33, 25, 3, 1, 75000.00),
(34, 26, 4, 1, 125000.00),
(35, 27, 12, 1, 600000.00),
(36, 27, 6, 1, 450000.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_consulta`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_categorias` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuarios_perfiles` (`perfil_id`);

--
-- Indices de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD PRIMARY KEY (`id_ventas_cabecera`),
  ADD KEY `fk_ventas_cabecera_usuarios` (`usuario_id`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id_ventas_detalle`),
  ADD KEY `fk_ventas_detalle_productos` (`producto_id`),
  ADD KEY `fk_ventas_detalle_ventas_cabecera` (`venta_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  MODIFY `id_ventas_cabecera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id_ventas_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_perfiles` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id_perfil`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD CONSTRAINT `fk_ventas_cabecera_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD CONSTRAINT `fk_ventas_detalle_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ventas_detalle_ventas_cabecera` FOREIGN KEY (`venta_id`) REFERENCES `ventas_cabecera` (`id_ventas_cabecera`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
