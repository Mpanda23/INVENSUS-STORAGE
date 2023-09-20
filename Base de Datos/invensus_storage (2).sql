-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-09-2023 a las 02:23:11
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `invensus_storage`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carta`
--

CREATE TABLE `carta` (
  `idcarta` int(11) NOT NULL,
  `idpedidos` int(11) DEFAULT NULL,
  `idplatos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL,
  `cat_nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `cat_nombre`) VALUES
(1, 'dos'),
(2, 'dos'),
(3, 'tres'),
(4, 'uno'),
(5, 'uno'),
(6, 'uno'),
(7, 'PESCADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_almacen`
--

CREATE TABLE `inventario_almacen` (
  `idinventario_almacen` int(11) NOT NULL,
  `alm_entrada` int(11) DEFAULT NULL,
  `alm_salida` int(11) DEFAULT NULL,
  `alm_saldos` int(11) DEFAULT NULL,
  `idproductos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_local1`
--

CREATE TABLE `inventario_local1` (
  `idinventario_local1` int(11) NOT NULL,
  `invl_entradas` int(11) DEFAULT NULL,
  `invl_salidas` int(11) DEFAULT NULL,
  `invl_saldos` int(11) DEFAULT NULL,
  `idmovimiento_inventario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_local2`
--

CREATE TABLE `inventario_local2` (
  `idinventario_local2` int(11) NOT NULL,
  `invl2_fecha` date DEFAULT NULL,
  `invl2_entradas` int(11) DEFAULT NULL,
  `invl2_salidas` int(11) DEFAULT NULL,
  `invl2_saldos` int(11) DEFAULT NULL,
  `idmovimiento_inventario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_local2`
--

CREATE TABLE `movimientos_local2` (
  `idmovimientos_local2` int(11) NOT NULL,
  `mv2_fecha` date DEFAULT NULL,
  `mv2_tipo_movimiento` varchar(30) DEFAULT NULL,
  `mv2_producto` int(11) DEFAULT NULL,
  `mv2_cantidad` int(11) DEFAULT NULL,
  `idinventario_local2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_inventario`
--

CREATE TABLE `movimiento_inventario` (
  `idmovimiento_inventario` int(11) NOT NULL,
  `mov_fecha` date DEFAULT NULL,
  `mov_cantidad` int(11) DEFAULT NULL,
  `idinventario_almacen` int(11) DEFAULT NULL,
  `idproductos` int(11) DEFAULT NULL,
  `idtipo_movimiento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_local1`
--

CREATE TABLE `movimiento_local1` (
  `idmovimiento_local1` int(11) NOT NULL,
  `mv1_fecha` date DEFAULT NULL,
  `mv1_tipomovimiento` varchar(30) DEFAULT NULL,
  `mv1_producto` int(11) DEFAULT NULL,
  `mv1_cantidad` int(11) DEFAULT NULL,
  `idinventario_local1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idpedidos` int(11) NOT NULL,
  `ped_fecha` date DEFAULT NULL,
  `ped_cantidad` int(11) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `idusuarios` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `idplatos` int(11) NOT NULL,
  `pla_nombre` varchar(50) DEFAULT NULL,
  `pla_descripcion` varchar(250) DEFAULT NULL,
  `pla_precio` int(11) DEFAULT NULL,
  `pla_imagen` blob DEFAULT NULL,
  `pla_tiempopre` varchar(250) DEFAULT NULL,
  `pla_categoria` int(30) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `idproductos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproductos` int(11) NOT NULL,
  `prod_nombre` varchar(150) DEFAULT NULL,
  `prod_descripcion` varchar(150) DEFAULT NULL,
  `prod_valor` decimal(10,0) DEFAULT NULL,
  `prod_imagen` blob DEFAULT NULL,
  `prod_vencimiento` date DEFAULT NULL,
  `prod_alerta` date DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `idproveedores` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproductos`, `prod_nombre`, `prod_descripcion`, `prod_valor`, `prod_imagen`, `prod_vencimiento`, `prod_alerta`, `idcategoria`, `idproveedores`) VALUES
(1, 'uno', 'uno', '1234123', NULL, '2023-09-01', '2023-09-01', 1, 1),
(2, 'camarom', 'camarom', '12', 0x31322e636f6d, '2332-02-12', '2023-02-12', 1, 1),
(3, 'camarom', 'camarom', '12', 0x31322e636f6d, '2023-09-19', '2023-09-19', 1, 1),
(4, 'camarom', 'camarom', '12', 0x31322e636f6d, '2022-11-12', '2012-11-12', 1, 1),
(5, 'camarom', 'camarom', '14', 0x31322e636f6d, '2023-09-19', '2023-09-19', 1, 1),
(6, 'camarom', 'camarom', '14', 0x31322e636f6d, '2023-09-19', '2023-09-19', 1, 1),
(7, 'camarom', 'camarom', '14', 0x31322e636f6d, '2023-09-19', '2023-09-19', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idproveedores` int(11) NOT NULL,
  `pro_nombre` varchar(50) DEFAULT NULL,
  `pro_direccion` varchar(50) DEFAULT NULL,
  `pro_mail` varchar(150) DEFAULT NULL,
  `pro_telefono` int(11) DEFAULT NULL,
  `pro_estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idproveedores`, `pro_nombre`, `pro_direccion`, `pro_mail`, `pro_telefono`, `pro_estado`) VALUES
(1, 'cuatro', 'un', 'uno@gmail.com', 123, 'activo'),
(2, 'unooo', 'uno', 'uno@gmail.com', 321232123, 'Activo'),
(3, 'unodos', 'uno', 'uno@gmail.com', 321312312, 'Activo'),
(4, 'unooo', 'unood', 'uno@gmail.com', 321232123, 'Activo'),
(5, 'seis', 'unood', 'uno@gmail.com', 123123123, 'activo'),
(6, 'unodostres', 'uno', 'uno@gmail.com', 1232123312, 'Activo'),
(7, 'carnes', 'uno', 'uno@gmail.com', 310982732, 'Activo'),
(8, 'unodos', 'uno', 'uno@gmail.com', 3212321, 'Activo'),
(9, 'unodos', 'dos', 'uno@gmail.com', 321, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idroles` int(11) NOT NULL,
  `rol_nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idroles`, `rol_nombre`) VALUES
(1, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

CREATE TABLE `sexo` (
  `idsexo` int(11) NOT NULL,
  `sexo_tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sexo`
--

INSERT INTO `sexo` (`idsexo`, `sexo_tipo`) VALUES
(1, 'femenino'),
(2, 'masculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `idsubcategorias` int(11) NOT NULL,
  `subc_nombre` varchar(50) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimientos`
--

CREATE TABLE `tipo_movimientos` (
  `idtipo_movimientos` int(11) NOT NULL,
  `movimientos` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `usu_nombre` varchar(50) DEFAULT NULL,
  `usu_tipoid` varchar(30) DEFAULT NULL,
  `usu_identificacion` int(11) DEFAULT NULL,
  `usu_numerotel` int(11) DEFAULT NULL,
  `usu_correo` varchar(150) DEFAULT NULL,
  `usu_contrasena` varchar(150) DEFAULT NULL,
  `usu_estado` varchar(20) DEFAULT NULL,
  `idsexo` int(11) DEFAULT NULL,
  `idroles` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `usu_nombre`, `usu_tipoid`, `usu_identificacion`, `usu_numerotel`, `usu_correo`, `usu_contrasena`, `usu_estado`, `idsexo`, `idroles`) VALUES
(1, 'uno', 'Tarjeta Identidad', 1, 1, '1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Activo', 2, 1),
(7, 'uno', 'Tarjeta Identidad', 1, 2, '1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Activo', 1, 1),
(8, 'dos', 'Tarjeta Identidad', 1, 2147483647, '1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Activo', 2, 1),
(9, 'siete', 'Cedula Extranjera', 1, 2147483647, '7@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Inactivo', 2, 1),
(10, 'Administrador', 'Cedula de Ciudadania', 1, 2147483647, '1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Activo', 2, 1),
(11, 'uno', 'Tarjeta Identidad', 1, 2147483647, '8@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Activo', 2, 1),
(12, 'uno', 'Cedula de Ciudadania', 1, 2147483647, '8@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Activo', 1, 1),
(13, 'tres', 'Tarjeta Identidad', 1233123312, 2147483647, 'uno@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Activo', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carta`
--
ALTER TABLE `carta`
  ADD PRIMARY KEY (`idcarta`),
  ADD KEY `idpedidos` (`idpedidos`),
  ADD KEY `idplatos` (`idplatos`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `inventario_almacen`
--
ALTER TABLE `inventario_almacen`
  ADD PRIMARY KEY (`idinventario_almacen`),
  ADD KEY `idproductos` (`idproductos`);

--
-- Indices de la tabla `inventario_local1`
--
ALTER TABLE `inventario_local1`
  ADD PRIMARY KEY (`idinventario_local1`),
  ADD KEY `idmovimiento_inventario` (`idmovimiento_inventario`);

--
-- Indices de la tabla `inventario_local2`
--
ALTER TABLE `inventario_local2`
  ADD PRIMARY KEY (`idinventario_local2`),
  ADD KEY `idmovimiento_inventario` (`idmovimiento_inventario`);

--
-- Indices de la tabla `movimientos_local2`
--
ALTER TABLE `movimientos_local2`
  ADD PRIMARY KEY (`idmovimientos_local2`),
  ADD KEY `idinventario_local2` (`idinventario_local2`);

--
-- Indices de la tabla `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  ADD PRIMARY KEY (`idmovimiento_inventario`),
  ADD KEY `idinventario_almacen` (`idinventario_almacen`),
  ADD KEY `idproductos` (`idproductos`),
  ADD KEY `idtipo_movimiento` (`idtipo_movimiento`);

--
-- Indices de la tabla `movimiento_local1`
--
ALTER TABLE `movimiento_local1`
  ADD PRIMARY KEY (`idmovimiento_local1`),
  ADD KEY `idinventario_local1` (`idinventario_local1`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idpedidos`),
  ADD KEY `idusuarios` (`idusuarios`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`idplatos`),
  ADD KEY `idproductos` (`idproductos`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproductos`),
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `idproveedores` (`idproveedores`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idproveedores`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idroles`);

--
-- Indices de la tabla `sexo`
--
ALTER TABLE `sexo`
  ADD PRIMARY KEY (`idsexo`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`idsubcategorias`),
  ADD KEY `idcategoria` (`idcategoria`);

--
-- Indices de la tabla `tipo_movimientos`
--
ALTER TABLE `tipo_movimientos`
  ADD PRIMARY KEY (`idtipo_movimientos`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`),
  ADD KEY `idsexo` (`idsexo`),
  ADD KEY `idroles` (`idroles`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carta`
--
ALTER TABLE `carta`
  MODIFY `idcarta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `inventario_almacen`
--
ALTER TABLE `inventario_almacen`
  MODIFY `idinventario_almacen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_local1`
--
ALTER TABLE `inventario_local1`
  MODIFY `idinventario_local1` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_local2`
--
ALTER TABLE `inventario_local2`
  MODIFY `idinventario_local2` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientos_local2`
--
ALTER TABLE `movimientos_local2`
  MODIFY `idmovimientos_local2` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  MODIFY `idmovimiento_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimiento_local1`
--
ALTER TABLE `movimiento_local1`
  MODIFY `idmovimiento_local1` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idpedidos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `idplatos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234124;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproductos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idproveedores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idroles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sexo`
--
ALTER TABLE `sexo`
  MODIFY `idsexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `idsubcategorias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_movimientos`
--
ALTER TABLE `tipo_movimientos`
  MODIFY `idtipo_movimientos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carta`
--
ALTER TABLE `carta`
  ADD CONSTRAINT `carta_ibfk_1` FOREIGN KEY (`idpedidos`) REFERENCES `pedidos` (`idpedidos`),
  ADD CONSTRAINT `carta_ibfk_2` FOREIGN KEY (`idplatos`) REFERENCES `platos` (`idplatos`);

--
-- Filtros para la tabla `inventario_almacen`
--
ALTER TABLE `inventario_almacen`
  ADD CONSTRAINT `inventario_almacen_ibfk_1` FOREIGN KEY (`idproductos`) REFERENCES `productos` (`idproductos`);

--
-- Filtros para la tabla `inventario_local1`
--
ALTER TABLE `inventario_local1`
  ADD CONSTRAINT `inventario_local1_ibfk_1` FOREIGN KEY (`idmovimiento_inventario`) REFERENCES `movimiento_inventario` (`idmovimiento_inventario`);

--
-- Filtros para la tabla `inventario_local2`
--
ALTER TABLE `inventario_local2`
  ADD CONSTRAINT `inventario_local2_ibfk_1` FOREIGN KEY (`idmovimiento_inventario`) REFERENCES `movimiento_inventario` (`idmovimiento_inventario`);

--
-- Filtros para la tabla `movimientos_local2`
--
ALTER TABLE `movimientos_local2`
  ADD CONSTRAINT `movimientos_local2_ibfk_1` FOREIGN KEY (`idinventario_local2`) REFERENCES `inventario_local2` (`idinventario_local2`);

--
-- Filtros para la tabla `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  ADD CONSTRAINT `movimiento_inventario_ibfk_1` FOREIGN KEY (`idinventario_almacen`) REFERENCES `inventario_almacen` (`idinventario_almacen`),
  ADD CONSTRAINT `movimiento_inventario_ibfk_2` FOREIGN KEY (`idproductos`) REFERENCES `productos` (`idproductos`),
  ADD CONSTRAINT `movimiento_inventario_ibfk_3` FOREIGN KEY (`idtipo_movimiento`) REFERENCES `tipo_movimientos` (`idtipo_movimientos`);

--
-- Filtros para la tabla `movimiento_local1`
--
ALTER TABLE `movimiento_local1`
  ADD CONSTRAINT `movimiento_local1_ibfk_1` FOREIGN KEY (`idinventario_local1`) REFERENCES `inventario_local1` (`idinventario_local1`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`);

--
-- Filtros para la tabla `platos`
--
ALTER TABLE `platos`
  ADD CONSTRAINT `platos_ibfk_1` FOREIGN KEY (`idproductos`) REFERENCES `productos` (`idproductos`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`idproveedores`) REFERENCES `proveedores` (`idproveedores`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idsexo`) REFERENCES `sexo` (`idsexo`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idroles`) REFERENCES `roles` (`idroles`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
