-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-07-2018 a las 22:54:32
-- Versión del servidor: 5.7.12
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `homestead`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(10) unsigned NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `titulo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Burgers', '2018-07-27 05:54:21', '2018-07-27 05:54:21', NULL),
(2, 'Pizza', '2018-07-27 05:54:30', '2018-07-27 05:54:30', NULL),
(3, 'Wraps', '2018-07-27 05:54:41', '2018-07-27 05:54:41', NULL),
(4, 'Fries', '2018-07-27 05:54:50', '2018-07-27 05:54:50', NULL),
(5, 'Drinks', '2018-07-27 05:54:58', '2018-07-27 05:54:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_07_23_072351_create_categorias_table', 1),
(4, '2018_07_23_072725_create_productos_table', 1),
(5, '2018_07_23_072745_create_ordens_table', 1),
(6, '2018_07_23_072807_create_orden_detalles_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordens`
--

CREATE TABLE IF NOT EXISTS `ordens` (
  `id` int(10) unsigned NOT NULL,
  `cliente_id` int(10) unsigned NOT NULL DEFAULT '0',
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('pendiente','cocina','enviado','cancelado','facturado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ordens`
--

INSERT INTO `ordens` (`id`, `cliente_id`, `direccion`, `estado`, `total`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'direccion', 'pendiente', 161000, '2018-08-01 02:41:49', '2018-08-01 02:41:49', NULL),
(2, 1, 'direccion', 'pendiente', 161000, '2018-08-01 02:41:51', '2018-08-01 02:41:51', NULL),
(3, 1, 'direccion', 'pendiente', 186500, '2018-08-01 02:42:34', '2018-08-01 02:42:34', NULL),
(4, 1, 'direccion', 'pendiente', 186500, '2018-08-01 02:42:48', '2018-08-01 02:42:48', NULL),
(5, 1, 'direccion', 'pendiente', 25500, '2018-08-01 02:43:58', '2018-08-01 02:43:58', NULL),
(6, 1, 'esto es la direccion', 'facturado', 66000, '2018-08-01 03:04:19', '2018-08-01 03:04:19', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_detalles`
--

CREATE TABLE IF NOT EXISTS `orden_detalles` (
  `id` int(10) unsigned NOT NULL,
  `cantidad` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `orden_id` int(10) unsigned NOT NULL DEFAULT '0',
  `producto_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orden_detalles`
--

INSERT INTO `orden_detalles` (`id`, `cantidad`, `precio`, `subtotal`, `orden_id`, `producto_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, '1', 13500, 13500, 5, 5, '2018-08-01 02:43:58', '2018-08-01 02:43:58', NULL),
(6, '1', 12000, 12000, 5, 6, '2018-08-01 02:43:58', '2018-08-01 02:43:58', NULL),
(7, '4', 13500, 54000, 6, 5, '2018-08-01 03:04:19', '2018-08-01 03:04:19', NULL),
(8, '1', 12000, 12000, 6, 6, '2018-08-01 03:04:19', '2018-08-01 03:04:19', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `imagen` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `categoria_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Blue Moon Burgers', '250 gr Carne, papas a la francesa, ensalada', 13500, 'storage/Productos/Blue Moon Burgers.jpg', 1, '2018-07-27 05:58:43', '2018-07-27 05:58:43', NULL),
(6, 'Guinness Burgers', 'Fast food refers to food that can be ', 12000, 'storage/Productos/Guinness Burgers.jpg', 1, '2018-07-27 05:59:50', '2018-07-27 05:59:50', NULL),
(7, 'Chicken Cordon Bleu Burgers', 'Fast food refers to food that can be ve-thru ', 8500, 'storage/Productos/Chicken Cordon Bleu Burgers.jpg', 1, '2018-07-27 06:00:47', '2018-07-27 06:00:47', NULL),
(8, 'Cajun Shrimp Burger', 'Fast food refers to food that can be prepared', 98000, 'storage/Productos/Cajun Shrimp Burger.jpg', 1, '2018-07-27 06:01:25', '2018-07-27 06:01:25', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` enum('cliente','administrador') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `telefono`, `rol`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'jamer pinto', 'hammer92@hotmail.es', '55828515', 'administrador', '$2y$10$Lwu/mSXBIwkSAOGdg6Z5nOIQeOKNPZabSzACZlp.7xzlYVb4.afiW', 'PhRQqA1QNCrYIT6aIc0gWLfrSBRAy3UADeWgcV6hgI5UsQzGI7pE3YXoMnq3', '2018-07-26 20:07:23', '2018-07-26 20:07:23'),
(2, 'cliente', 'hammer92@yopmail.com', '45454654', 'cliente', '$2y$10$4PgwIUtqhvQHTNVAinKdr.k9No8E8hLNtB3hObhG0ZRUHEpFMkqgK', 'wXBAX799PV2lo4TODomMxdM7pe9LKA5VkvuKONAI8CUDuX2kj4KIIFCL3F00', '2018-07-31 03:29:45', '2018-07-31 03:29:45'),
(3, 'jamer pinto', 'hammer92@hotmail.es', '55828515', 'administrador', '$2y$10$Lwu/mSXBIwkSAOGdg6Z5nOIQeOKNPZabSzACZlp.7xzlYVb4.afiW', 'PhRQqA1QNCrYIT6aIc0gWLfrSBRAy3UADeWgcV6hgI5UsQzGI7pE3YXoMnq3', '2018-07-27 01:07:23', '2018-07-27 01:07:23'),
(4, 'cliente', 'hammer92@yopmail.com', '45454654', 'cliente', '$2y$10$4PgwIUtqhvQHTNVAinKdr.k9No8E8hLNtB3hObhG0ZRUHEpFMkqgK', 'wXBAX799PV2lo4TODomMxdM7pe9LKA5VkvuKONAI8CUDuX2kj4KIIFCL3F00', '2018-07-31 08:29:45', '2018-07-31 08:29:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordens`
--
ALTER TABLE `ordens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordens_cliente_id_foreign` (`cliente_id`);

--
-- Indices de la tabla `orden_detalles`
--
ALTER TABLE `orden_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orden_detalles_orden_id_foreign` (`orden_id`),
  ADD KEY `orden_detalles_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_categoria_id_foreign` (`categoria_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `ordens`
--
ALTER TABLE `ordens`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `orden_detalles`
--
ALTER TABLE `orden_detalles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ordens`
--
ALTER TABLE `ordens`
  ADD CONSTRAINT `ordens_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `orden_detalles`
--
ALTER TABLE `orden_detalles`
  ADD CONSTRAINT `orden_detalles_orden_id_foreign` FOREIGN KEY (`orden_id`) REFERENCES `ordens` (`id`),
  ADD CONSTRAINT `orden_detalles_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
