-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2022 a las 01:32:13
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdcarritocompras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idcompra` bigint(20) NOT NULL,
  `cofecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idusuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`idcompra`, `cofecha`, `idusuario`) VALUES
(1, '2022-11-17 23:49:23', 1),
(2, '2022-11-18 12:13:19', 2),
(3, '2022-11-18 12:14:38', 2),
(4, '2022-11-24 11:19:07', 2),
(5, '2022-11-24 12:08:13', 1),
(6, '2022-11-24 12:40:40', 1),
(7, '2022-11-24 12:51:20', 1),
(8, '2022-11-24 12:52:24', 1),
(9, '2022-11-24 12:56:01', 1),
(10, '2022-11-24 13:43:15', 1),
(11, '2022-11-24 13:52:03', 1),
(12, '2022-11-24 18:04:39', 1),
(13, '2022-11-24 18:35:36', 1),
(14, '2022-11-24 19:39:22', 7),
(15, '2022-11-24 20:45:35', 6),
(16, '2022-11-25 00:26:48', 2),
(17, '2022-11-25 00:27:21', 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraestado`
--

INSERT INTO `compraestado` (`idcompraestado`, `idcompra`, `idcompraestadotipo`, `cefechaini`, `cefechafin`) VALUES
(1, 1, 1, '2022-11-17 23:50:17', '2022-11-18 15:33:43'),
(2, 2, 2, '2022-11-18 12:13:19', '2022-11-18 15:22:42'),
(3, 3, 1, '2022-11-18 12:14:38', '2022-11-18 14:12:17'),
(6, 3, 2, '2022-11-18 14:12:17', '2022-11-18 15:21:01'),
(7, 3, 5, '2022-11-18 15:21:02', '2022-11-19 19:42:36'),
(8, 2, 5, '2022-11-18 15:22:42', '0000-00-00 00:00:00'),
(9, 1, 2, '2022-11-18 15:33:43', '2022-11-18 15:34:08'),
(10, 1, 5, '2022-11-18 15:34:08', '2022-11-18 18:44:04'),
(11, 1, 2, '2022-11-18 18:44:04', '2022-11-24 12:07:53'),
(12, 3, 2, '2022-11-19 19:42:36', '2022-11-19 19:42:47'),
(13, 3, 5, '2022-11-19 19:42:47', '0000-00-00 00:00:00'),
(14, 4, 1, '2022-11-24 11:19:07', '2022-11-24 20:44:59'),
(15, 1, 5, '2022-11-24 12:07:53', '0000-00-00 00:00:00'),
(16, 5, 1, '2022-11-24 12:08:13', '2022-11-24 12:08:28'),
(17, 5, 2, '2022-11-24 12:08:28', '2022-11-24 12:26:47'),
(18, 5, 3, '2022-11-24 12:26:47', '2022-11-24 12:26:55'),
(19, 5, 4, '2022-11-24 12:26:55', '2022-11-24 12:27:05'),
(20, 5, 5, '2022-11-24 12:27:05', '0000-00-00 00:00:00'),
(21, 6, 1, '2022-11-24 12:40:40', '2022-11-24 12:48:39'),
(22, 6, 2, '2022-11-24 12:48:39', '2022-11-24 12:48:58'),
(23, 6, 2, '2022-11-24 12:48:58', '2022-11-24 12:50:18'),
(24, 6, 2, '2022-11-24 12:50:18', '2022-11-24 12:53:25'),
(25, 7, 1, '2022-11-24 12:51:20', '2022-11-24 12:51:43'),
(26, 7, 2, '2022-11-24 12:51:43', '2022-11-24 12:53:29'),
(27, 8, 1, '2022-11-24 12:52:24', '2022-11-24 12:53:05'),
(28, 8, 2, '2022-11-24 12:53:05', '2022-11-24 12:57:29'),
(29, 6, 5, '2022-11-24 12:53:25', '0000-00-00 00:00:00'),
(30, 7, 5, '2022-11-24 12:53:29', '0000-00-00 00:00:00'),
(31, 9, 1, '2022-11-24 12:56:01', '2022-11-24 12:56:44'),
(32, 9, 2, '2022-11-24 12:56:44', '2022-11-24 12:58:13'),
(33, 8, 5, '2022-11-24 12:57:29', '0000-00-00 00:00:00'),
(34, 9, 5, '2022-11-24 12:58:13', '0000-00-00 00:00:00'),
(35, 10, 1, '2022-11-24 13:43:15', '2022-11-24 13:43:42'),
(36, 10, 2, '2022-11-24 13:43:42', '2022-11-24 13:43:50'),
(37, 10, 3, '2022-11-24 13:43:50', '2022-11-24 13:43:55'),
(38, 10, 5, '2022-11-24 13:43:55', '0000-00-00 00:00:00'),
(39, 11, 1, '2022-11-24 13:52:03', '2022-11-24 13:52:38'),
(40, 11, 2, '2022-11-24 13:52:38', '2022-11-24 15:17:01'),
(41, 11, 3, '2022-11-24 15:17:01', '2022-11-24 18:33:51'),
(42, 12, 1, '2022-11-24 18:04:39', '2022-11-24 18:20:16'),
(43, 12, 2, '2022-11-24 18:20:16', '2022-11-24 18:20:32'),
(44, 12, 5, '2022-11-24 18:20:33', '0000-00-00 00:00:00'),
(45, 11, 4, '2022-11-24 18:33:51', '0000-00-00 00:00:00'),
(46, 13, 1, '2022-11-24 18:35:36', '0000-00-00 00:00:00'),
(47, 14, 1, '2022-11-24 19:39:22', '0000-00-00 00:00:00'),
(48, 4, 2, '2022-11-24 20:44:59', '2022-11-24 20:47:20'),
(49, 15, 1, '2022-11-24 20:45:35', '0000-00-00 00:00:00'),
(50, 4, 5, '2022-11-24 20:47:20', '0000-00-00 00:00:00'),
(51, 16, 1, '2022-11-25 00:26:48', '2022-11-25 00:27:04'),
(52, 16, 2, '2022-11-25 00:27:04', '2022-11-25 00:27:49'),
(53, 17, 1, '2022-11-25 00:27:21', '0000-00-00 00:00:00'),
(54, 16, 3, '2022-11-25 00:27:49', '2022-11-25 00:27:54'),
(55, 16, 4, '2022-11-25 00:27:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestadotipo`
--

CREATE TABLE `compraestadotipo` (
  `idcompraestadotipo` int(11) NOT NULL,
  `cetdescripcion` varchar(50) NOT NULL,
  `cetdetalle` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(29, 2, 13, 1),
(30, 2, 4, 20),
(31, 3, 16, 10),
(32, 3, 17, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idmenu`, `menombre`, `medescripcion`, `idpadre`, `medeshabilitado`) VALUES
(7, 'fasdfasdf', 'asdfasdfas', NULL, '2022-11-13 02:53:06'),
(8, 'Usuarios', '../ABMUsuario/index.php', NULL, '0000-00-00 00:00:00'),
(9, 'Roles y Permisos', 'Panel de administración de roles y permisos', 7, '2022-11-16 03:03:14'),
(10, 'maam', 'kkkkk', NULL, '2022-11-13 02:40:23'),
(11, 'Roles y Permisos', '../ABMRol/index.php', NULL, '0000-00-00 00:00:00'),
(12, 'hola', 'test', 7, '2022-11-13 02:34:11'),
(13, 'adsfasd', 'test', 9, '2022-11-16 03:03:27'),
(14, 'abcderf', 'fsadfsdf', NULL, '2022-11-13 03:05:42'),
(15, 'Menús', '../ABMMenu/index.php', NULL, '0000-00-00 00:00:00'),
(16, 'Productos', '../Producto/index.php', NULL, '2022-11-17 14:22:48'),
(17, 'Productos', '../ABMProducto/index.php', NULL, '0000-00-00 00:00:00'),
(18, 'Carrito', '../Carrito/index.php', NULL, '0000-00-00 00:00:00'),
(19, 'Editar Perfil', '../Perfil/index.php', NULL, '2022-11-18 04:44:24'),
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `pronombre`, `prodetalle`, `procantstock`) VALUES
(1, 'Mouse Delux, Negro/vertical/inalambrico/12400 Dpi/1000hz', '1000///Marca<br>\r\nDelux<br>\r\nModelo<br>\r\nDELUX-M618PR-BLACK', 0),
(2, 'Mouse de juego inalámbrico recargable Soul Master Player XM 1000 negro', '20000///Para trabajar desde casa con la computadora o aprovechar los momentos de ocio, necesitás comodidad y facilidad de movimiento. Con tu Soul XM 1000 encontrá eso que buscás en un solo aparato con la mejor tecnología.', 20),
(3, 'Pc Armada Gamer Amd Ryzen 5 4600g 16gb Nvme 240 Radeaon Vega.', '100000///INCLUYE:<br>\n*Gabinete + Fuente 500w Teclado + Mouse + Parlante<br>\n*Microprocesador AMD Ryzen 5 4600G 8MB 3.7GHz AM4<br>\n*Memoria Ddr4 8Gb x 2<br>\n*Disco Solido Ssd 240 Gb<br>\n*Mother A320M Socket AM4<br>\n*Sistema Opperativo: Windows 10 Prueba x 30 Dias<br>', 40),
(4, 'Monitor 22 Pulgadas Daewoo Led 1080p Full Hd Hdmi Vga', '10243///Especificaciones:<br>\n- Marca : Daewoo<br>\n- Color : Negro<br>\n- Tamaño de panel : 22\"<br>\n- Curvo/Plano : Plano<br>\n- Colores : 16.7M<br>\n- Tipo de panel : TN<br>\n- Resolución : 1920 x 1080<br>\n- Brillo(Max) : 230 cd/m2<br>\n- Parlantes : No<br>\n- Conectividad : 1 x HDMI, 1 x VGA<br>\n- Frecuencia de actualizacion : 60 Hz', 30),
(5, 'Sillon Gamer Pc Reclinable Ergonomica Postural Giratoria', '10250///Es gamer: Sí<br>\nEs ergonómica: Sí<br>\nCon altura regulable: Sí<br>\nEs giratoria: Sí<br>\nCon respaldo reclinable: Sí<br>\nCon apoyabrazos: Sí<br>\nCon ruedas: Sí<br>', 100),
(6, 'Teclado gamer T-Dagger Bora T-TGK315 QWERTY T-Dagger Red español color blanco con luz RGB.', '200000///Este teclado T-Dagger de alto rendimiento permite que puedas disfrutar de horas ilimitadas de juegos. Está diseñado especialmente para que puedas expresar tanto tus habilidades como tu estilo. Podrás mejorar tu experiencia de gaming, ya seas un aficionado o todo un experto y hacer que tus jugadas alcancen otro nivel.', 287),
(7, 'Laptop gamer Legion 5 6ta Gen (15.6\", AMD)', '500000///<b>Rendimiento gamer definitivo. Autonomía de la batería excepcional.</b>\r\nDicen que nos pasamos la vida haciendo concesiones. Dicen que no se puede tener un gran rendimiento y una batería que dure mucho en la misma computadora. Cuentan que una laptop para gaming enfocada al gran rendimiento tiene que ser grande y pesada. Se equivocan. Ya puedes disfrutar de un rendimiento para gaming de elite en una laptop delgada y liviana con una duración de la batería increíble.', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `roldescripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado`) VALUES
(1, 'root', '85df15fe22809f41007697ac39cce710', 'root@mail.com', '0000-00-00 00:00:00'),
(2, 'Gustavo', '85df15fe22809f41007697ac39cce710', 'gusa05@gmail.com', '0000-00-00 00:00:00'),
(3, 'Empleado', '85df15fe22809f41007697ac39cce710', 'empleado@empleado.com', '0000-00-00 00:00:00'),
(4, 'Test', 'fc03ac0b2d51c8a17769953c245ef1e0', 'test@test.com', '2022-11-16 22:09:49'),
(6, 'Jose', 'c9c540c6a2266a1fb8b6f5c2500c1342', 'deimoss2018@gmail.com', '0000-00-00 00:00:00'),
(7, 'Gonza', '85df15fe22809f41007697ac39cce710', 'gonza@mail.com', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariorol`
--

CREATE TABLE `usuariorol` (
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(6, 3),
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
  MODIFY `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
