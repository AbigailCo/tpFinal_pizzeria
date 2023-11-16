-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2023 a las 20:15:35
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
-- Base de datos: `bdpizzeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idcompra` bigint(20) NOT NULL,
  `cofecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idusuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`idcompra`, `cofecha`, `idusuario`) VALUES
(1, '2023-11-01 23:49:23', 1),
(2, '2023-11-01 12:13:19', 2),
(3, '2023-11-01 12:14:38', 2),
(4, '2023-11-02 11:19:07', 2),
(5, '2023-11-02 12:08:13', 1),
(6, '2023-11-02 12:40:40', 1),
(7, '2023-11-02 12:51:20', 1),
(8, '2023-11-02 12:52:24', 1),
(9, '2023-11-02 12:56:01', 1),
(10, '2023-11-02 13:43:15', 1),
(11, '2023-11-02 13:52:03', 1),
(12, '2023-11-02 18:04:39', 1),
(13, '2023-11-02 18:35:36', 1),
(14, '2023-11-02 19:39:22', 7),
(15, '2023-11-02 20:45:35', 6),
(16, '2023-11-02 00:26:48', 2),
(17, '2023-11-02 00:27:21', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestado`
--

CREATE TABLE `compraestado` (
  `idcompraestado` bigint(20) UNSIGNED NOT NULL,
  `idcompra` bigint(11) NOT NULL,
  `idcompraestadotipo` int(11) NOT NULL,
  `cefechaini` timestamp NOT NULL DEFAULT current_timestamp(),
  `cefechafin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `compraestado`
--

INSERT INTO `compraestado` (`idcompraestado`, `idcompra`, `idcompraestadotipo`, `cefechaini`, `cefechafin`) VALUES
(1, 1, 1, '2023-11-01 23:50:17', '2023-11-01 15:33:43'),
(2, 2, 2, '2023-11-01 12:13:19', '2023-11-01 15:22:42'),
(3, 3, 1, '2023-11-01 12:14:38', '2023-11-01 14:12:17'),
(6, 3, 2, '2023-11-01 14:12:17', '2023-11-01 15:21:01'),
(7, 3, 5, '2023-11-01 15:21:02', '2023-11-01 19:42:36'),
(8, 2, 5, '2023-11-01 15:22:42', '0000-00-00 00:00:00'),
(9, 1, 2, '2023-11-01 15:33:43', '2023-11-01 15:34:08'),
(10, 1, 5, '2023-11-01 15:34:08', '2023-11-01 18:44:04'),
(11, 1, 2, '2023-11-01 18:44:04', '2023-11-04 12:07:53'),
(12, 3, 2, '2023-11-02 19:42:36', '2023-11-02 19:42:47'),
(13, 3, 5, '2023-11-02 19:42:47', '0000-00-00 00:00:00'),
(14, 4, 1, '2023-11-04 11:19:07', '2023-11-04 20:44:59'),
(15, 1, 5, '2023-11-01 12:07:53', '0000-00-00 00:00:00'),
(16, 5, 1, '2023-11-04 12:08:13', '2023-11-04 12:08:28'),
(17, 5, 2, '2023-11-04 12:08:28', '2023-11-04 12:26:47'),
(18, 5, 3, '2023-11-04 12:26:47', '2023-11-04 12:26:55'),
(19, 5, 4, '2023-11-04 12:26:55', '2023-11-04 12:27:05'),
(20, 5, 5, '2023-11-04 12:27:05', '0000-00-00 00:00:00'),
(21, 6, 1, '2023-11-04 12:40:40', '2023-11-04 12:48:39'),
(22, 6, 2, '2023-11-04 12:48:39', '2023-11-04 12:48:58'),
(23, 6, 2, '2023-11-04 12:48:58', '2023-11-04 12:50:18'),
(24, 6, 2, '2023-11-04 12:50:18', '2023-11-04 12:53:25'),
(25, 7, 1, '2023-11-04 12:51:20', '2023-11-04 12:51:43'),
(26, 7, 2, '2023-11-04 12:51:43', '2023-11-04 12:53:29'),
(27, 8, 1, '2023-11-04 12:52:24', '2023-11-04 12:53:05'),
(28, 8, 2, '2023-11-04 12:53:05', '2023-11-04 12:57:29'),
(29, 6, 5, '2023-11-04 12:53:25', '0000-00-00 00:00:00'),
(30, 7, 5, '2023-11-04 12:53:29', '0000-00-00 00:00:00'),
(31, 9, 1, '2023-11-04 12:56:01', '2023-11-04 12:56:44'),
(32, 9, 2, '2023-11-04 12:56:44', '2023-11-04 12:58:13'),
(33, 8, 5, '2023-11-04 12:57:29', '0000-00-00 00:00:00'),
(34, 9, 5, '2023-11-04 12:58:13', '0000-00-00 00:00:00'),
(35, 10, 1, '2023-11-04 13:43:15', '2023-11-04 13:43:42'),
(36, 10, 2, '2023-11-04 13:43:42', '2023-11-04 13:43:50'),
(37, 10, 3, '2023-11-04 13:43:50', '2023-11-04 13:43:55'),
(38, 10, 5, '2023-11-04 13:43:55', '0000-00-00 00:00:00'),
(39, 11, 1, '2023-11-04 13:52:03', '2023-11-04 13:52:38'),
(40, 11, 2, '2023-11-04 13:52:38', '2023-11-04 15:17:01'),
(41, 11, 3, '2023-11-04 15:17:01', '2023-11-04 18:33:51'),
(42, 12, 1, '2023-11-04 18:04:39', '2023-11-04 18:20:16'),
(43, 12, 2, '2023-11-04 18:20:16', '2023-11-04 18:20:32'),
(44, 12, 5, '2023-11-04 18:20:33', '0000-00-00 00:00:00'),
(45, 11, 4, '2023-11-04 18:33:51', '0000-00-00 00:00:00'),
(46, 13, 1, '2023-11-04 18:35:36', '0000-00-00 00:00:00'),
(47, 14, 1, '2023-11-04 19:39:22', '0000-00-00 00:00:00'),
(48, 4, 2, '2023-11-01 20:44:59', '2023-11-04 20:47:20'),
(49, 15, 1, '2023-11-04 20:45:35', '0000-00-00 00:00:00'),
(50, 4, 5, '2023-11-04 20:47:20', '0000-00-00 00:00:00'),
(51, 16, 1, '2023-11-05 00:26:48', '2023-11-05 00:27:04'),
(52, 16, 2, '2023-11-05 00:27:04', '2023-11-05 00:27:49'),
(53, 17, 1, '2023-11-02 00:27:21', '0000-00-00 00:00:00'),
(54, 16, 3, '2023-11-02 00:27:49', '2023-11-02 00:27:54'),
(55, 16, 4, '2023-11-02 00:27:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestadotipo`
--

CREATE TABLE `compraestadotipo` (
  `idcompraestadotipo` int(11) NOT NULL,
  `cetdescripcion` varchar(50) NOT NULL,
  `cetdetalle` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `compraestadotipo`
--

INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'carrito', 'Items en el carrito'),
(2, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(3, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1'),
(4, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2'),
(5, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraitem`
--

CREATE TABLE `compraitem` (
  `idcompraitem` bigint(20) UNSIGNED NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `compraitem`
--

INSERT INTO `compraitem` (`idcompraitem`, `idproducto`, `idcompra`, `cicantidad`) VALUES
(2, 4, 1, 16),
(3, 5, 1, 23),
(4, 6, 1, 3),
(5, 3, 2, 5),
(9, 2, 3, 3),
(10, 5, 3, 10),
(13, 3, 5, 10),
(14, 2, 6, 1),
(15, 1, 7, 10),
(16, 3, 8, 40),
(17, 2, 9, 10),
(18, 4, 9, 5),
(19, 6, 9, 5),
(20, 2, 10, 10),
(21, 6, 11, 12),
(22, 1, 12, 10),
(23, 3, 12, 10),
(24, 5, 12, 10),
(27, 6, 14, 203),
(29, 2, 13, 2),
(30, 2, 4, 20),
(31, 3, 16, 10),
(32, 3, 17, 1),
(33, 4, 15, 1),
(34, 3, 15, 1),
(35, 6, 13, 1),
(36, 7, 14, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `idmenu` bigint(20) NOT NULL,
  `menombre` varchar(50) NOT NULL COMMENT 'Nombre del item del menu',
  `medescripcion` varchar(124) NOT NULL COMMENT 'Descripcion mas detallada del item del menu',
  `idpadre` bigint(20) DEFAULT NULL COMMENT 'Referencia al id del menu que es subitem',
  `medeshabilitado` timestamp NULL DEFAULT current_timestamp() COMMENT 'Fecha en la que el menu fue deshabilitado por ultima vez'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idmenu`, `menombre`, `medescripcion`, `idpadre`, `medeshabilitado`) VALUES
(7, 'fasdfasdf', 'asdfasdfas', NULL, '2023-11-03 02:53:06'),
(8, 'Usuarios', '../ABMUsuario/index.php', NULL, '0000-00-00 00:00:00'),
(9, 'Roles y Permisos', 'Panel de administración de roles y permisos', 7, '2023-11-06 03:03:14'),
(10, 'maam', 'kkkkk', NULL, '2023-11-03 02:40:23'),
(11, 'Roles y Permisos', '../ABMRol/index.php', NULL, '0000-00-00 00:00:00'),
(15, 'Menús', '../ABMMenu/index.php', NULL, '0000-00-00 00:00:00'),
(16, 'Productos', '../Producto/index.php', NULL, '2023-11-07 14:22:48'),
(17, 'Productos', '../ABMProducto/index.php', NULL, '0000-00-00 00:00:00'),
(18, 'Carrito', '../Carrito/index.php', NULL, '0000-00-00 00:00:00'),
(19, 'Editar Perfil', '../Perfil/index.php', NULL, '2023-11-08 04:44:24'),
(20, 'Editar Perfil', '../Perfil/index.php', NULL, '0000-00-00 00:00:00'),
(21, 'Pago', '../pago/index.php', NULL, '0000-00-00 00:00:00'),
(22, 'Pedidos', '../Pedidos/index.php', NULL, '0000-00-00 00:00:00'),
(23, 'Compras', '../ABMCompra/index.php', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menurol`
--

CREATE TABLE `menurol` (
  `idmenu` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `menurol`
--

INSERT INTO `menurol` (`idmenu`, `idrol`) VALUES
(8, 1),
(11, 1),
(15, 1),
(17, 2),
(18, 3),
(20, 1),
(20, 2),
(20, 3),
(21, 3),
(22, 3),
(23, 2),
(23, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL,
  `pronombre` varchar(250) NOT NULL,
  `prodetalle` varchar(512) NOT NULL,
  `procantstock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `pronombre`, `prodetalle`, `procantstock`) VALUES
(1, 'COMBO 1 - 2 mozzarellas + un voucher de regalo', '4500///Comprando 2 muzzarella te regalamos un voucher.\r\nMUZZARELLA\r\nEs una receta compuesta por una masa baja y crocante con una cubierta de salsa de tomate, mozzarella, aceitunas y orégano.\r\n\r\nVoucher de cualquier bebida de nuestro stock', 10),
(2, 'COMBO 2 - Caprese + doble pinta', '5000///Una exquisita mezcla de queso mozzarella, tomate cherry y shot de pesto. Pide esta bomba de sabor en sus diversos tamaños: mediano, familiar o XL. Para delivery o retiro en tienda.', 20),
(3, 'COMBO 3 - Jamon y queso + doble pinta + coca-cola 1ltr', '7000///PIZZA ORIGINALE JAMÓN Y QUESO\r\nLa pizza clásica, de masa fina y crujiente, elaborada con jamón cocido extra y fundentes prelas de mozzarella.', 40),
(4, 'VEGETARIANA | base pizza - cebolla - pimiento verde rojo - champiñones - aceitunas negras - queso mozarella - tomate frito - orégano', '5000/// Pizza elaborada solo con verduras y vegetales sin cárnico alguno, para satisfacer las necesidades del público vegetariano, sin embargo es sin duda un plato exquisito. Se puede preparar con o sin salsa de tomate.', 30),
(5, 'NAPOLITANA | Masa de pizza - tomates - queso mozzarella - Hojas de albahaca fresca - Aceite de oliva virgen extra', '8000///La pizza napolitana se caracteriza por tener una masa fina pero esponjosa, con un borde alto, aireado y crujiente. En la región de Nápoles utilizan unos tomates conocidos como “San Marzano”, que le aportan un sabor dulce y potente a la salsa. Este tipo de tomate suele usarse también para otras preparaciones clásicas de la gastronomía italiana. ', 100),
(6, 'ANCHOAS | Masa  madre - salsa - queso mozzarella - anchoas - olivas neras', '9000///Es una masa básica para pizzas. Lleva salsa de tomate, queso mozzarella y anchoas. Las anchoas es lo que hace especial a esta pizza. Riquísima e ideal para agasajar a los amigos, compartir en familia e incluso para hacerla en forma de pizzetas individuales.', 100),
(7, 'JAMON Y MORRONES | masa madre a la piedra - mozzarella - jamón cocido - morrón - aceitunas verdes - orégano', '7000///*agregar des*', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `roldescripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `roldescripcion`) VALUES
(1, 'Administrador'),
(2, 'Depósito'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL,
  `usnombre` varchar(50) NOT NULL,
  `uspass` varchar(150) NOT NULL,
  `usmail` varchar(50) NOT NULL,
  `usdeshabilitado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado`) VALUES
(1, 'abi', '25d55ad283aa400af464c76d713c07ad', 'abi@mail.com', '0000-00-00 00:00:00'),
(2, 'mel', '25d55ad283aa400af464c76d713c07ad', 'mel@gmail.com', '0000-00-00 00:00:00'),
(3, 'fran', '25d55ad283aa400af464c76d713c07ad', 'fran@empleado.com', '0000-00-00 00:00:00'),
(4, 'santi', '25d55ad283aa400af464c76d713c07ad', 'santi@test.com', '2023-11-06 22:09:49'),
(6, 'repo', '25d55ad283aa400af464c76d713c07ad', 'repo2018@gmail.com', '0000-00-00 00:00:00'),
(7, 'cliente', '25d55ad283aa400af464c76d713c07ad', 'cliente@mail.com', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariorol`
--

CREATE TABLE `usuariorol` (
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuariorol`
--

INSERT INTO `usuariorol` (`idusuario`, `idrol`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 3),
(3, 2),
(4, 3),
(6, 2),
(7, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD UNIQUE KEY `idcompra` (`idcompra`),
  ADD KEY `fkcompra_1` (`idusuario`);

--
-- Indices de la tabla `compraestado`
--
ALTER TABLE `compraestado`
  ADD PRIMARY KEY (`idcompraestado`),
  ADD UNIQUE KEY `idcompraestado` (`idcompraestado`),
  ADD KEY `fkcompraestado_1` (`idcompra`),
  ADD KEY `fkcompraestado_2` (`idcompraestadotipo`);

--
-- Indices de la tabla `compraestadotipo`
--
ALTER TABLE `compraestadotipo`
  ADD PRIMARY KEY (`idcompraestadotipo`);

--
-- Indices de la tabla `compraitem`
--
ALTER TABLE `compraitem`
  ADD PRIMARY KEY (`idcompraitem`),
  ADD UNIQUE KEY `idcompraitem` (`idcompraitem`),
  ADD KEY `fkcompraitem_1` (`idcompra`),
  ADD KEY `fkcompraitem_2` (`idproducto`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD UNIQUE KEY `idmenu` (`idmenu`),
  ADD KEY `fkmenu_1` (`idpadre`);

--
-- Indices de la tabla `menurol`
--
ALTER TABLE `menurol`
  ADD PRIMARY KEY (`idmenu`,`idrol`),
  ADD KEY `fkmenurol_2` (`idrol`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD UNIQUE KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `idrol` (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD PRIMARY KEY (`idusuario`,`idrol`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `compraestado`
--
ALTER TABLE `compraestado`
  MODIFY `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `compraitem`
--
ALTER TABLE `compraitem`
  MODIFY `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fkcompra_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compraestado`
--
ALTER TABLE `compraestado`
  ADD CONSTRAINT `fkcompraestado_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraestado_2` FOREIGN KEY (`idcompraestadotipo`) REFERENCES `compraestadotipo` (`idcompraestadotipo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compraitem`
--
ALTER TABLE `compraitem`
  ADD CONSTRAINT `fkcompraitem_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraitem_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fkmenu_1` FOREIGN KEY (`idpadre`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `menurol`
--
ALTER TABLE `menurol`
  ADD CONSTRAINT `fkmenurol_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkmenurol_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD CONSTRAINT `fkmovimiento_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
