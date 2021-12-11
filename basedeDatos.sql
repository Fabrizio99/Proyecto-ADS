use dulcekat;
-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2021 a las 19:41:26
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleta`
--

CREATE TABLE `boleta` (
  `idB_boleta` int(10) UNSIGNED NOT NULL,
  `TIPOPAGO_id_tipopago` int(10) UNSIGNED NOT NULL,
  `NOTADEVENTAS_id_boletaventa` int(10) UNSIGNED NOT NULL,
  `codigo_boleta` varchar(20) DEFAULT NULL,
  `evidencia` varchar(45) DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'NOATENDIDO',
  `fecha` datetime DEFAULT current_timestamp(),
  `monto` float NOT NULL,
  `telefono_yape` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `boleta`
--

INSERT INTO `boleta` (`idB_boleta`, `TIPOPAGO_id_tipopago`, `NOTADEVENTAS_id_boletaventa`, `codigo_boleta`, `evidencia`, `estado`, `fecha`, `monto`, `telefono_yape`) VALUES
(1, 1, 1, '1', NULL, 'ATENDIDO', '2021-01-14', 70, NULL),
(2, 2, 2, '2', 'pago1.jpg', 'NOATENDIDO', '2021-01-15', 80, '987654321'),
(3, 1, 3, '3', NULL, 'ATENDIDO', '2021-01-16', 90, NULL),
(16, 1, 4, '16', NULL, 'NOATENDIDO', '2021-01-29', 100, NULL),
(17, 1, 5, '17', NULL, 'NOATENDIDO', '2021-01-29', 110, NULL),
(18, 1, 6, '18', NULL, 'NOATENDIDO', '2021-02-01', 100, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
(1, 'dulce'),
(2, 'salado'),
(3, 'DECORACION'),
(4, 'UTENSILIOS'),
(5, 'PREPARADOS'),
(6, 'CREMAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documentos` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documentos`, `nombre`) VALUES
(1, 'DNI'),
(2, 'CARNET DE EXTRANJERIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notadeventas`
--

CREATE TABLE `notadeventas` (
  `id_boletaventa` int(10) UNSIGNED NOT NULL,
  `DOCUMENTOS_id_documentos` int(10) UNSIGNED NOT NULL,
  `USUARIOS_id_usuario` int(10) UNSIGNED NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `nombre_cliente` varchar(255) DEFAULT NULL,
  `numdocumento_cliente` varchar(8) DEFAULT NULL,
  `telefono_cliente` varchar(20) DEFAULT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'POR ATENDER',
  `monto` float NOT NULL,
  `direccion_cliente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notadeventas`
--

INSERT INTO `notadeventas` (`id_boletaventa`, `DOCUMENTOS_id_documentos`, `USUARIOS_id_usuario`, `fecha`, `nombre_cliente`, `numdocumento_cliente`, `telefono_cliente`, `estado`, `monto`, `direccion_cliente`) VALUES
(1, 1, 1, '2021-01-13', 'alvaro', '123', '123', 'ATENDIDO', 70, 'lejos'),
(2, 1, 1, '2021-01-14', 'newton', '123', '123', 'ELIMINADO', 80, 'cerca'),
(3, 1, 1, '2021-01-15', 'josy', '123', '123', 'POR ATENDER', 90, 'lejitos'),
(4, 1, 1, '2021-01-16', 'marle', '123', '123', 'ATENDIDO', 100, 'aqui al lado'),
(5, 1, 1, '2021-02-01', 'JUAN CARLOS SOLANO', '72371625', '987654321', 'POR ATENDER', 110, 'VILLA EL SALVADOR '),
(6, 1, 1, '2021-02-01', 'JUAN CARLOS SOLANO', '72371625', '987654321', 'POR ATENDER', 100, 'VILLA EL SALVADOR '),
(7, 1, 1, '2021-02-01', 'PEDRO GOMEZ', '12351673', '98877664', 'POR ATENDER', 38, 'VILLA MARIA DEL TRIUNFO '),
(8, 2, 1, '2021-02-01', 'JORGE BUSLON', 'D9001950', '978453221', 'POR ATENDER', 49, 'SAN BOJAR SUR'),
(9, 1, 1, '2021-02-01', 'CARLA ROSMERI', '72381674', '987655522', 'POR ATENDER', 142, 'BOLIVAR AV.1 LT.3'),
(10, 2, 1, '2021-02-01', 'ANGELY LOZANO', 'D9001223', '978263155', 'POR ATENDER', 89, 'CESAR VALLEJO CUADRA 15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notadeventas_has_producto`
--

CREATE TABLE `notadeventas_has_producto` (
  `NOTADEVENTAS_id_boletaventa` int(10) UNSIGNED NOT NULL,
  `PRODUCTO_id_producto` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notadeventas_has_producto`
--

INSERT INTO `notadeventas_has_producto` (`NOTADEVENTAS_id_boletaventa`, `PRODUCTO_id_producto`, `cantidad`) VALUES
(1, 1, 5),
(1, 2, 1),
(2, 3, 7),
(2, 4, 1),
(3, 1, 3),
(3, 4, 1),
(4, 1, 5),
(4, 2, 1),
(6, 1, 10),
(6, 5, 10),
(6, 6, 10),
(7, 6, 10),
(7, 20, 2),
(8, 5, 10),
(8, 7, 2),
(9, 25, 10),
(10, 24, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permisos` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permisos`, `nombre`) VALUES
(1, 'usuario'),
(2, 'producto'),
(3, 'emitir nota de venta'),
(4, 'emitir boleta de venta'),
(5, 'entregar producto'),
(6, 'venta finales del dia'),
(7, 'inventario'),
(8, 'registrar reclamo'),
(9, 'emitir reporte de venta del dia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `stock` int(10) UNSIGNED DEFAULT NULL,
  `marka` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `estado` varchar(1) NOT NULL DEFAULT '1',
  `fk_producto_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `stock`, `marka`, `imagen`, `fecha_mod`, `estado`, `fk_producto_categoria`) VALUES
(1, 'LECHE', 3, 60, 'GLORIA', 'img1.jpg', '0000-00-00', '1', 1),
(2, 'QUEQUERA', 8, 40, 'CHAINA', 'img2.jpg', '0000-00-00', '1', 1),
(3, 'AZUCAR', 3.5, 70, 'DULCEFLOR', 'img3.jpg', '0000-00-00', '1', 1),
(4, 'SAL', 1, 40, 'LA COCINA', 'img4.jpg', '0000-00-00', '1', 2),
(5, 'LECHE CONDENSADA', 4, 50, 'GLORIA', 'img5.jpg', '0000-00-00', '1', 1),
(6, 'FIDEOS', 3, 9, 'LAVALLI', 'img6.jpg', '2021-01-19', '0', 2),
(7, 'FRUTOS SECOS', 4.5, 70, 'SEQUITOS', 'FRUTOSECO.jpg', '2021-01-31', '1', 2),
(8, 'DULCE DE LECHE', 3.5, 25, 'PASTELERO', 'DULCELECHE.jpg', '2021-01-31', '1', 6),
(9, 'CREMA DECORRAR CACAO', 19, 20, 'CCACAO', 'CREMACACAO.jpg', '2021-01-31', '1', 6),
(10, 'CREMA DE CHOCOLATE', 30, 15, 'RUBI', 'CREMACHOCO.jpg', '2021-01-31', '1', 6),
(11, 'MIEL', 24.3, 7, 'MIL FLORES', 'MIEL.jpg', '2021-01-31', '1', 6),
(12, 'LEVADURA QUIMIMCA', 7, 80, 'KING', 'LEVADURA.jpg', '2021-01-31', '1', 5),
(13, 'PREPARADO DE MERENGUE', 5.2, 20, 'CLARAVAL', 'MERENGUE.jpg', '2021-01-31', '1', 5),
(14, 'ACEITUNAS NEGRAS', 8.5, 30, 'JJJ', 'ACEITUNA.jpg', '2021-01-31', '1', 5),
(15, 'MELOCOTON', 5.6, 28, 'TAISI', 'MELOCOTON.jpg', '2021-01-31', '1', 5),
(16, 'MERMELADA DE FRESA\r\n', 6, 18, 'TAISI', 'MERMELADA.jpg', '2021-01-31', '1', 5),
(17, 'MERMELADA DE NARANJA\r\n', 6, 21, 'TAISI', 'MERMELADANARA.jpg', '2021-01-31', '1', 5),
(18, 'VELA', 1.2, 80, 'CHAINA', 'VELA.jpg', '2021-01-31', '1', 4),
(19, 'MANGA THERMO DE TELA', 7, 28, 'CHAINA', 'MANGA.jpg', '2021-01-31', '1', 4),
(20, 'BANDEJA DE CARTON', 4, 35, 'CHAINA', 'BANDEJA.jpg', '2021-01-31', '1', 4),
(21, 'PAPAEL MANTECA', 1, 60, 'NULL', 'PAPEL.jpg', '2021-01-31', '1', 4),
(22, 'ROLLO DE ACETATO', 19.5, 15, 'CHAINA', 'ROLLO.jpg', '2021-01-31', '1', 4),
(23, 'BANDEJA DE PLATA', 6.2, 33, 'CHAINA', 'BANDEJAPLATA.jpg', '2021-01-31', '1', 4),
(24, 'PEPITAS DE CHOCOLATE', 8.9, 27, 'CHOCOLAITE', 'PEPITA.jpg', '2021-01-31', '1', 3),
(25, 'ANIMALES DE CHOCOLATE', 14.2, 24, 'CHOCOLAITE', 'ANIMALES.jpg', '2021-01-31', '1', 3),
(26, 'VAINILLA CRISTALIZADA', 26.4, 12, 'VAINELA', 'VAINILLA.jpg', '2021-01-31', '1', 3),
(27, 'RASPADURA DE NARANJA', 8.9, 16, 'COMETIZA', 'NARANJA.jpg', '2021-01-31', '1', 3),
(28, 'RASPADURA DE LIMON', 16, 22, 'COMETIZA', 'LIMON.jpg', '2021-01-31', '1', 3),
(29, 'GLUCOSA ESPESA', 17, 16, 'EXPRESS', 'GLUCOSA.jpg', '2021-01-31', '1', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamo`
--

CREATE TABLE `reclamo` (
  `id_reclamo` int(10) UNSIGNED NOT NULL,
  `BOLETA_idB_boleta` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `solucion` varchar(255) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reclamo`
--

INSERT INTO `reclamo` (`id_reclamo`, `BOLETA_idB_boleta`, `descripcion`, `estado`, `solucion`, `fecha`) VALUES
(1, 1, 'PRODUCTO DAÑADO', 'A', 'SE CAMBIO EL PRODUCTO', '2021-01-11'),
(2, 2, 'PRODUCTO INCOMPLETO EN PESO ', 'A', 'SE LE OTORGO LO FALTANTE', '2021-01-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id_reporte` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `incidencia` varchar(255) DEFAULT 'SIN INCIDENCIA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(10) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`) VALUES
(1, 'VENDEDOR'),
(2, 'CAJERO'),
(3, 'DISPENSADOR'),
(4, 'ENCARGADOR DE RECLAMO'),
(5, 'ADMINISTRADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_rol_permiso`
--

CREATE TABLE `tabla_rol_permiso` (
  `tabla_fk_permiso` int(11) NOT NULL,
  `tabla_fk_roles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tabla_rol_permiso`
--

INSERT INTO `tabla_rol_permiso` (`tabla_fk_permiso`, `tabla_fk_roles`) VALUES
(3, 1),
(2, 1),
(4, 2),
(9, 2),
(5, 3),
(7, 3),
(8, 4),
(1, 5),
(2, 4),
(3, 5),
(4, 5),
(5, 5),
(6, 5),
(7, 5),
(8, 5),
(9, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

CREATE TABLE `tipopago` (
  `id_tipopago` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipopago`
--

INSERT INTO `tipopago` (`id_tipopago`, `tipo`) VALUES
(1, 'EFECTIVO'),
(2, 'YAPE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `documentos_id_documentos` int(10) UNSIGNED NOT NULL,
  `rol_id_rol` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `contrasenia` varchar(255) DEFAULT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `num_documento` varchar(8) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `telefono` int(9) NOT NULL,
  `estado` varchar(1) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `documentos_id_documentos`, `rol_id_rol`, `usuario`, `contrasenia`, `nombres`, `apellidos`, `num_documento`, `correo`, `telefono`, `estado`, `codigo`, `direccion`) VALUES
(1, 1, 1, '12345678', '123', 'ANGEL', 'HUAMANNAHUI ROBLES', '12345678', 'a@gmail.com', 123456789, 'A', 'U-01090', 'AV. 12 DE MAYO 123'),
(2, 1, 2, '18665678', '123', 'CARLA', 'LIZARRAGA VASQUEZ', '18665678', 'b@gmail.com', 123456789, 'A', 'U-01091', 'LAS TORRES DE MELGAR'),
(3, 1, 3, '12345142', '123', 'FABRIZIO', 'CONDORI GUZMAN', '12345142', 'c@gmail.com', 123456789, 'A', 'U-01092', 'AV. BOLIVAR 422'),
(4, 1, 4, '12333178', '123', 'ANGELY', 'LOZANO DAVILA', '12333178', 'd@gmail.com', 123456789, 'A', 'U-01093', 'AV. PACHACUTEC'),
(5, 1, 1, '14325678', 'adm', 'ALVARO', 'DE LA CRUZ', '14325678', 'e@gmail.com', 369852147, 'A', 'U-01094', 'JIRON VENTANILLA'),
(6, 1, 4, '70623145', 'flor', 'FLOR', 'DE LAS CASAS', '70623145', 'f@gmail.com', 361232147, 'A', 'U-01095', 'CESAR VALLEJO 12'),
(7, 1, 3, '70623156', 'juliana', 'JULIANA', 'MOLINA RIVERA', '70623156', 'g@gmail.com', 951232141, 'A', 'U-01096', 'SAN JUAN DE MIRAFLORES');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD PRIMARY KEY (`idB_boleta`),
  ADD KEY `BOLETA_FKIndex1` (`NOTADEVENTAS_id_boletaventa`),
  ADD KEY `BOLETA_FKIndex2` (`TIPOPAGO_id_tipopago`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documentos`);

--
-- Indices de la tabla `notadeventas`
--
ALTER TABLE `notadeventas`
  ADD PRIMARY KEY (`id_boletaventa`),
  ADD KEY `BOLETADEVENTA_FKIndex1` (`USUARIOS_id_usuario`),
  ADD KEY `NOTADEVENTAS_FKIndex2` (`DOCUMENTOS_id_documentos`);

--
-- Indices de la tabla `notadeventas_has_producto`
--
ALTER TABLE `notadeventas_has_producto`
  ADD PRIMARY KEY (`NOTADEVENTAS_id_boletaventa`,`PRODUCTO_id_producto`),
  ADD KEY `NOTADEVENTAS_has_PRODUCTO_FKIndex1` (`NOTADEVENTAS_id_boletaventa`),
  ADD KEY `NOTADEVENTAS_has_PRODUCTO_FKIndex2` (`PRODUCTO_id_producto`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permisos`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `producto_fk_categoria` (`fk_producto_categoria`);

--
-- Indices de la tabla `reclamo`
--
ALTER TABLE `reclamo`
  ADD PRIMARY KEY (`id_reclamo`),
  ADD KEY `RECLAMO_FKIndex1` (`BOLETA_idB_boleta`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`id_reporte`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tabla_rol_permiso`
--
ALTER TABLE `tabla_rol_permiso`
  ADD KEY `fk_tabla_permiso` (`tabla_fk_permiso`),
  ADD KEY `fk_tabla_rol` (`tabla_fk_roles`);

--
-- Indices de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`id_tipopago`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `USUARIO_FKIndex1` (`rol_id_rol`),
  ADD KEY `USUARIOS_FKIndex2` (`documentos_id_documentos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boleta`
--
ALTER TABLE `boleta`
  MODIFY `idB_boleta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documentos` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `notadeventas`
--
ALTER TABLE `notadeventas`
  MODIFY `id_boletaventa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `reclamo`
--
ALTER TABLE `reclamo`
  MODIFY `id_reclamo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  MODIFY `id_tipopago` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_fk_categoria` FOREIGN KEY (`fk_producto_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `tabla_rol_permiso`
--
ALTER TABLE `tabla_rol_permiso`
  ADD CONSTRAINT `fk_tabla_permiso` FOREIGN KEY (`tabla_fk_permiso`) REFERENCES `permisos` (`id_permisos`),
  ADD CONSTRAINT `fk_tabla_rol` FOREIGN KEY (`tabla_fk_roles`) REFERENCES `rol` (`id_rol`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_DOCUMENTO_USUARIO` FOREIGN KEY (`documentos_id_documentos`) REFERENCES `documentos` (`id_documentos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
