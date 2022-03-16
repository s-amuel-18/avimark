-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-03-2022 a las 17:03:07
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `avimark`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arabe_bonos`
--

CREATE TABLE `arabe_bonos` (
  `id` int(11) NOT NULL,
  `arabe_registro_id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `bono` float NOT NULL,
  `tabajo_extra` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `arabe_bonos`
--

INSERT INTO `arabe_bonos` (`id`, `arabe_registro_id`, `empleado_id`, `bono`, `tabajo_extra`) VALUES
(13, 9, 9, 1, 2),
(14, 9, 10, 4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arabe_registros`
--

CREATE TABLE `arabe_registros` (
  `id` int(11) NOT NULL,
  `reporte_facturado` int(1) NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `arabe_registros`
--

INSERT INTO `arabe_registros` (`id`, `reporte_facturado`, `updated_at`, `created_at`) VALUES
(9, 0, NULL, '2022-03-16 14:00:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arabe_servicios_cantidad`
--

CREATE TABLE `arabe_servicios_cantidad` (
  `id` int(11) NOT NULL,
  `arabe_registro_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `arabe_servicios_cantidad`
--

INSERT INTO `arabe_servicios_cantidad` (`id`, `arabe_registro_id`, `servicio_id`, `empleado_id`, `cantidad`) VALUES
(31, 9, 30, 9, 1),
(32, 9, 30, 10, 4),
(33, 9, 29, 9, 2),
(34, 9, 29, 10, 5),
(35, 9, 33, 9, 3),
(36, 9, 33, 10, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carteras`
--

CREATE TABLE `carteras` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carteras`
--

INSERT INTO `carteras` (`id`, `usuario_id`, `nombre`, `email`, `updated_at`, `created_at`) VALUES
(2, 19, 'Paypal', 'correo@sd.s', '2022-03-03 18:57:33', '2022-02-18 13:20:57'),
(3, 19, 'sdadsad', 'samuelgraterol12@gmail.com', NULL, '2022-03-10 20:31:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `usuario_id`, `nombre`, `updated_at`, `created_at`) VALUES
(1, 19, 'dsadsa', NULL, '2022-03-04 15:50:53'),
(2, 19, 's', NULL, '2022-03-04 18:37:57'),
(3, 19, 'dsa', NULL, '2022-03-04 18:38:01'),
(4, 19, 'dsd', NULL, '2022-03-04 18:38:04'),
(5, 19, 'dsadsaas', NULL, '2022-03-04 18:38:09'),
(6, 19, 'ggg', NULL, '2022-03-04 18:38:31'),
(7, 19, '232', NULL, '2022-03-04 18:38:38'),
(8, 19, '21212', NULL, '2022-03-04 18:38:43'),
(9, 19, '1212', NULL, '2022-03-04 18:38:50'),
(10, 19, '122', NULL, '2022-03-04 18:39:01'),
(11, 19, '566+6541', NULL, '2022-03-04 18:39:07'),
(12, 19, '001212', NULL, '2022-03-04 18:39:12'),
(13, 19, 'dsasadsadsadsadsa', NULL, '2022-03-04 18:39:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `nombre_empresa` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `usuario_id`, `nombre`, `nombre_empresa`, `telefono`, `email`, `updated_at`, `created_at`) VALUES
(4, 19, 'dsadsa', 'dsdsadsa', '+58 424 2805116', 'samuelgraterol12@gmail.com', NULL, '2022-03-14 17:25:27'),
(5, 19, 'pedro', 'dsadas', '+58 424 2805116', 'samuelgraterol12@gmail.com', NULL, '2022-03-14 18:17:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emails_contacto`
--

CREATE TABLE `emails_contacto` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `enviado` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `cartera_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `usuario_id`, `cartera_id`, `nombre`, `email`, `updated_at`, `created_at`) VALUES
(9, 19, 2, 'Pedro Camacho', 'samuelgraterol12@gmail.com', '2022-03-15 19:14:52', '2022-03-14 16:54:18'),
(10, 19, 2, 'Samuel Graterol', 'samuedsadsalgraterol12@gmail.com', '2022-03-15 19:15:00', '2022-03-14 18:18:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_arabe`
--

CREATE TABLE `empleados_arabe` (
  `id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados_arabe`
--

INSERT INTO `empleados_arabe` (`id`, `empleado_id`, `created_at`) VALUES
(54, 10, '2022-03-15 12:57:25'),
(55, 9, '2022-03-15 12:57:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `info_interna_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `cartera_id` int(11) DEFAULT NULL,
  `servicio_trabajo` varchar(255) NOT NULL,
  `numero_factura` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `usuario_id`, `info_interna_id`, `cliente_id`, `cartera_id`, `servicio_trabajo`, `numero_factura`, `updated_at`, `created_at`) VALUES
(14, 19, 1, 4, 2, 'Desing Services', 10024, NULL, '2022-03-10 17:52:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_facturas`
--

CREATE TABLE `historico_facturas` (
  `id` int(11) NOT NULL,
  `numero_factura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `historico_facturas`
--

INSERT INTO `historico_facturas` (`id`, `numero_factura`) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(4, NULL),
(5, NULL),
(6, NULL),
(7, NULL),
(8, NULL),
(9, NULL),
(10, NULL),
(11, NULL),
(12, NULL),
(13, NULL),
(14, NULL),
(15, NULL),
(16, NULL),
(17, NULL),
(18, NULL),
(19, NULL),
(20, NULL),
(21, NULL),
(22, NULL),
(23, NULL),
(24, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_interna`
--

CREATE TABLE `informacion_interna` (
  `id` int(11) NOT NULL,
  `nombre_empresa` varchar(255) NOT NULL,
  `direccion_empresa` varchar(255) NOT NULL,
  `telefono_empresa` varchar(255) NOT NULL,
  `email_empresa` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informacion_interna`
--

INSERT INTO `informacion_interna` (`id`, `nombre_empresa`, `direccion_empresa`, `telefono_empresa`, `email_empresa`, `updated_at`, `created_at`) VALUES
(1, 'dsdsadsa', '525 Federal Street Bluefield, WV–Bluefield, USA', '+51 151 55____', 'samuelgraterol12@gmail.com', NULL, '2022-03-03 12:55:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo_arabe`
--

CREATE TABLE `modulo_arabe` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulo_arabe`
--

INSERT INTO `modulo_arabe` (`id`, `cliente_id`) VALUES
(11, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio_servicios`
--

CREATE TABLE `precio_servicios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `factura_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `precio` float NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `precio_servicios`
--

INSERT INTO `precio_servicios` (`id`, `usuario_id`, `factura_id`, `servicio_id`, `cantidad`, `precio`, `updated_at`, `created_at`) VALUES
(19, 19, 14, 29, 1, 22000, NULL, '2022-03-15 20:45:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio_total` float NOT NULL,
  `precio_empleado` float NOT NULL,
  `precio_empleado_mayor` float DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `usuario_id`, `nombre`, `precio_total`, `precio_empleado`, `precio_empleado_mayor`, `updated_at`, `created_at`) VALUES
(29, 19, 'Programacion', 22000, 2, 0, '2022-03-16 18:58:43', '2022-03-14 16:56:31'),
(30, 19, 'marketing', 30, 20, 0, '2022-03-15 19:15:35', '2022-03-14 18:17:58'),
(33, 19, 'redes sociales', 30, 25, 0, '2022-03-15 19:15:44', '2022-03-15 12:55:23'),
(34, 19, 'web', 50000, 20, 0, '2022-03-15 19:15:52', '2022-03-15 12:55:33'),
(35, 19, 'orders', 3000, 30, 0, '2022-03-15 19:15:59', '2022-03-15 12:55:43'),
(36, 19, 'dsada', 200, 0, 0, NULL, '2022-03-16 15:06:29'),
(37, 19, 'dsadsa', 2000, 2, 0, NULL, '2022-03-16 15:06:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_arabe`
--

CREATE TABLE `servicios_arabe` (
  `id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios_arabe`
--

INSERT INTO `servicios_arabe` (`id`, `servicio_id`, `created_at`) VALUES
(36, 30, '2022-03-15 12:57:25'),
(37, 33, '2022-03-15 12:57:25'),
(38, 29, '2022-03-15 12:57:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `perfil` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `ultimo_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `nombre_usuario`, `password`, `perfil`, `foto`, `ultimo_login`, `created_at`, `activado`) VALUES
(19, 'Samuel Graterol', 'admin', 'admin', 'administrador', 'uploads/usuarios/admin/foto-perfil-620a5d84e9e24.png', '2022-03-16 17:06:21', '2022-02-14 13:47:48', 1),
(21, 'Armando Graterol', 'armando', '123123', 'administrador', NULL, '2022-03-02 18:24:11', '2022-03-02 14:23:52', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arabe_bonos`
--
ALTER TABLE `arabe_bonos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `arabe_registros`
--
ALTER TABLE `arabe_registros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `arabe_servicios_cantidad`
--
ALTER TABLE `arabe_servicios_cantidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carteras`
--
ALTER TABLE `carteras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `emails_contacto`
--
ALTER TABLE `emails_contacto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `empleados_arabe`
--
ALTER TABLE `empleados_arabe`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historico_facturas`
--
ALTER TABLE `historico_facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `informacion_interna`
--
ALTER TABLE `informacion_interna`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulo_arabe`
--
ALTER TABLE `modulo_arabe`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precio_servicios`
--
ALTER TABLE `precio_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios_arabe`
--
ALTER TABLE `servicios_arabe`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arabe_bonos`
--
ALTER TABLE `arabe_bonos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `arabe_registros`
--
ALTER TABLE `arabe_registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `arabe_servicios_cantidad`
--
ALTER TABLE `arabe_servicios_cantidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `carteras`
--
ALTER TABLE `carteras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `emails_contacto`
--
ALTER TABLE `emails_contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `empleados_arabe`
--
ALTER TABLE `empleados_arabe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `historico_facturas`
--
ALTER TABLE `historico_facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `informacion_interna`
--
ALTER TABLE `informacion_interna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `modulo_arabe`
--
ALTER TABLE `modulo_arabe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `precio_servicios`
--
ALTER TABLE `precio_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `servicios_arabe`
--
ALTER TABLE `servicios_arabe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
