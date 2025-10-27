-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2025 a las 23:30:54
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
-- Base de datos: `inventario_pos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:61:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:17:\"create-categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:15:\"read-categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"update-categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:17:\"delete-categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:15:\"create-products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"read-products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"update-products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"delete-products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:17:\"create-warehouses\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"read-warehouses\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:17:\"update-warehouses\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:17:\"delete-warehouses\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:16:\"create-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:14:\"read-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"update-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:16:\"delete-suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:22:\"create-purchase_orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:20:\"read-purchase_orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:22:\"update-purchase_orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:22:\"delete-purchase_orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:16:\"create-purchases\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:14:\"read-purchases\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:16:\"update-purchases\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:16:\"delete-purchases\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:16:\"create-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:14:\"read-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:16:\"update-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:16:\"delete-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:13:\"create-quotes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:11:\"read-quotes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:13:\"update-quotes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:13:\"delete-quotes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:12:\"create-sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:10:\"read-sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:12:\"update-sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:12:\"delete-sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:16:\"create-movements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:14:\"read-movements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:16:\"update-movements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:16:\"delete-movements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:16:\"create-transfers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:14:\"read-transfers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:16:\"update-transfers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:16:\"delete-transfers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:17:\"read-top-products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:18:\"read-top-customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:14:\"read-low-stock\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:12:\"create-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:10:\"read-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:12:\"update-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:12:\"delete-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:12:\"create-roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:10:\"read-roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:12:\"update-roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:12:\"delete-roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:18:\"create-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:16:\"read-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:18:\"update-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:18:\"delete-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:12:\"read-setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:14:\"update-setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:6:\"editor\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:6:\"viewer\";s:1:\"c\";s:3:\"web\";}}}', 1761511599);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Electronicos', 'Productos Electronicos', '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(2, 'Ropa', 'Productos de ropa', '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(3, 'Hogar', 'Productos para el hogar', '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(4, 'Juguetes', 'Productos de juguetes', '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(5, 'Alimentos', 'Productos de alimentos', '2025-10-24 03:28:58', '2025-10-24 03:28:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `identity_id` bigint(20) UNSIGNED NOT NULL,
  `document_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `identity_id`, `document_number`, `name`, `address`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, '12345678', 'Cliente de Prueba', 'Dirección de prueba', 'cliente@example.com', '999999999', '2025-10-24 03:29:02', '2025-10-24 03:29:02'),
(2, 5, 'Mona Dalton', 'Macaulay Welch', 'Hayley Mcpherson', 'ciqamap@mailinator.com', 'Basia Grimes', '2025-10-25 20:35:31', '2025-10-25 20:35:31'),
(3, 3, 'Caldwell Holder', 'Adrienne Gutierrez', 'Angelica Wise', 'vevi@mailinator.com', '687665', '2025-10-25 20:35:49', '2025-10-25 20:35:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `identities`
--

CREATE TABLE `identities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `identities`
--

INSERT INTO `identities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sin documento', '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(2, 'DNI', '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(3, 'Carnet de Extranjeria', '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(4, 'Pasaporte', '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(5, 'Cedula de Identidad', '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(6, 'RUC', '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(7, 'Otro', '2025-10-24 03:28:58', '2025-10-24 03:28:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `size` int(11) NOT NULL DEFAULT 0,
  `imageable_type` varchar(255) NOT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `path`, `size`, `imageable_type`, `imageable_id`, `created_at`, `updated_at`) VALUES
(2, 'images/J50wsyg80X2U7rPh1UU76P22hTomflNPe0JKTbQr.png', 1044008, 'App\\Models\\Product', 3, '2025-10-24 04:36:27', '2025-10-24 04:36:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `quantity_in` int(11) NOT NULL DEFAULT 0,
  `cost_in` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_in` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity_out` int(11) NOT NULL DEFAULT 0,
  `cost_out` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_out` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity_balance` int(11) NOT NULL DEFAULT 0,
  `cost_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `inventoryable_type` varchar(255) NOT NULL,
  `inventoryable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inventories`
--

INSERT INTO `inventories` (`id`, `detail`, `quantity_in`, `cost_in`, `total_in`, `quantity_out`, `cost_out`, `total_out`, `quantity_balance`, `cost_balance`, `total_balance`, `product_id`, `warehouse_id`, `inventoryable_type`, `inventoryable_id`, `created_at`, `updated_at`) VALUES
(1, 'Compra', 26, 345.00, 8970.00, 0, 0.00, 0.00, 26, 345.00, 8970.00, 3, 1, 'App\\Models\\Purchase', 1, '2025-10-24 03:34:41', '2025-10-24 03:34:41'),
(2, 'Compra', 42, 232.00, 9744.00, 0, 0.00, 0.00, 42, 232.00, 9744.00, 2, 1, 'App\\Models\\Purchase', 1, '2025-10-24 03:34:41', '2025-10-24 03:34:41'),
(3, 'Compra', 30, 545.00, 16350.00, 0, 0.00, 0.00, 30, 545.00, 16350.00, 1, 1, 'App\\Models\\Purchase', 1, '2025-10-24 03:34:41', '2025-10-24 03:34:41'),
(4, 'Venta', 0, 0.00, 0.00, 2, 545.00, 1090.00, 28, 545.00, 15260.00, 1, 1, 'App\\Models\\Sale', 1, '2025-10-25 17:48:14', '2025-10-25 17:48:14'),
(5, 'Venta', 0, 0.00, 0.00, 1, 232.00, 232.00, 41, 232.00, 9512.00, 2, 1, 'App\\Models\\Sale', 3, '2025-10-25 19:52:39', '2025-10-25 19:52:39'),
(6, 'Venta', 0, 0.00, 0.00, 1, 232.00, 232.00, 40, 232.00, 9280.00, 2, 1, 'App\\Models\\Sale', 4, '2025-10-25 19:54:14', '2025-10-25 19:54:14'),
(7, 'Venta', 0, 0.00, 0.00, 1, 232.00, 232.00, 39, 232.00, 9048.00, 2, 1, 'App\\Models\\Sale', 5, '2025-10-25 20:19:49', '2025-10-25 20:19:49'),
(8, 'Venta', 0, 0.00, 0.00, 2, 345.00, 690.00, 24, 345.00, 8280.00, 3, 1, 'App\\Models\\Sale', 5, '2025-10-25 20:19:49', '2025-10-25 20:19:49'),
(9, 'Compra', 86, 545.00, 46870.00, 0, 0.00, 0.00, 114, 545.00, 62130.00, 1, 1, 'App\\Models\\Purchase', 2, '2025-10-25 20:34:55', '2025-10-25 20:34:55'),
(10, 'Compra', 51, 232.00, 11832.00, 0, 0.00, 0.00, 90, 232.00, 20880.00, 2, 1, 'App\\Models\\Purchase', 2, '2025-10-25 20:34:55', '2025-10-25 20:34:55'),
(11, 'Compra', 80, 345.00, 27600.00, 0, 0.00, 0.00, 104, 345.00, 35880.00, 3, 1, 'App\\Models\\Purchase', 2, '2025-10-25 20:34:55', '2025-10-25 20:34:55'),
(12, 'Venta', 0, 0.00, 0.00, 1, 545.00, 545.00, 113, 545.00, 61585.00, 1, 1, 'App\\Models\\Sale', 8, '2025-10-25 20:36:23', '2025-10-25 20:36:23'),
(13, 'Venta', 0, 0.00, 0.00, 1, 232.00, 232.00, 89, 232.00, 20648.00, 2, 1, 'App\\Models\\Sale', 8, '2025-10-25 20:36:23', '2025-10-25 20:36:23'),
(14, 'Venta', 0, 0.00, 0.00, 1, 345.00, 345.00, 103, 345.00, 35535.00, 3, 1, 'App\\Models\\Sale', 9, '2025-10-25 20:41:54', '2025-10-25 20:41:54'),
(15, 'Venta', 0, 0.00, 0.00, 1, 545.00, 545.00, 112, 545.00, 61040.00, 1, 1, 'App\\Models\\Sale', 9, '2025-10-25 20:41:54', '2025-10-25 20:41:54'),
(16, 'Venta', 0, 0.00, 0.00, 1, 232.00, 232.00, 88, 232.00, 20416.00, 2, 1, 'App\\Models\\Sale', 9, '2025-10-25 20:41:54', '2025-10-25 20:41:54'),
(17, 'Venta', 0, 0.00, 0.00, 1, 545.00, 545.00, 111, 545.00, 60495.00, 1, 1, 'App\\Models\\Sale', 10, '2025-10-25 20:47:14', '2025-10-25 20:47:14'),
(18, 'Venta', 0, 0.00, 0.00, 1, 345.00, 345.00, 102, 345.00, 35190.00, 3, 1, 'App\\Models\\Sale', 10, '2025-10-25 20:47:14', '2025-10-25 20:47:14'),
(19, 'Venta', 0, 0.00, 0.00, 1, 232.00, 232.00, 87, 232.00, 20184.00, 2, 1, 'App\\Models\\Sale', 10, '2025-10-25 20:47:14', '2025-10-25 20:47:14'),
(20, 'Venta', 0, 0.00, 0.00, 1, 545.00, 545.00, 110, 545.00, 59950.00, 1, 1, 'App\\Models\\Sale', 11, '2025-10-25 20:49:46', '2025-10-25 20:49:46'),
(21, 'Venta', 0, 0.00, 0.00, 1, 232.00, 232.00, 86, 232.00, 19952.00, 2, 1, 'App\\Models\\Sale', 11, '2025-10-25 20:49:46', '2025-10-25 20:49:46'),
(22, 'Venta', 0, 0.00, 0.00, 1, 545.00, 545.00, 109, 545.00, 59405.00, 1, 1, 'App\\Models\\Sale', 12, '2025-10-25 21:04:34', '2025-10-25 21:04:34'),
(23, 'Venta', 0, 0.00, 0.00, 1, 232.00, 232.00, 85, 232.00, 19720.00, 2, 1, 'App\\Models\\Sale', 3, '2025-10-25 21:30:06', '2025-10-25 21:30:06'),
(24, 'Venta', 0, 0.00, 0.00, 1, 545.00, 545.00, 108, 545.00, 58860.00, 1, 1, 'App\\Models\\Sale', 3, '2025-10-25 21:30:06', '2025-10-25 21:30:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_13_170101_add_two_factor_columns_to_users_table', 1),
(5, '2025_09_13_170128_create_personal_access_tokens_table', 1),
(6, '2025_09_14_171906_create_categories_table', 1),
(7, '2025_09_14_172124_create_products_table', 1),
(8, '2025_09_14_172604_create_warehouses_table', 1),
(9, '2025_09_14_173039_create_identities_table', 1),
(10, '2025_09_14_173152_create_suppliers_table', 1),
(11, '2025_09_14_173847_create_customers_table', 1),
(12, '2025_09_14_174021_create_reasons_table', 1),
(13, '2025_09_14_174115_create_purchase_orders_table', 1),
(14, '2025_09_14_191129_create_purchases_table', 1),
(15, '2025_09_14_191411_create_quotes_table', 1),
(16, '2025_09_14_191649_create_sales_table', 1),
(17, '2025_09_14_191852_create_movements_table', 1),
(18, '2025_09_14_192815_create_productables_table', 1),
(19, '2025_09_14_200206_create_inventories_table', 1),
(20, '2025_09_14_200928_create_images_table', 1),
(21, '2025_09_14_210159_create_transfers_table', 1),
(22, '2025_10_17_000801_create_permission_tables', 1),
(23, '2025_10_25_121415_add_payment_method_to_sales_table', 2),
(24, '2025_10_25_135210_add_amount_paid_and_change_to_sales_table', 3),
(25, '2025_10_25_135816_create_shopping_carts_table', 4),
(26, '2025_10_25_143000_alter_shopping_carts_table', 5),
(27, '2025_10_25_144248_alter_shopping_carts_table_change_products_to_product_id', 6),
(28, '2025_10_25_145848_alter_shopping_carts_table_drop_sale_id', 7),
(29, '2025_10_25_151507_add_warehouse_id_to_shopping_carts_table', 8),
(30, '2025_10_25_153446_add_change_to_shopping_carts_table', 9),
(32, '2025_10_25_164354_alter_shopping_carts_table_add_products_json_remove_product_id', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movements`
--

CREATE TABLE `movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `serie` varchar(255) NOT NULL,
  `correlative` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `observation` varchar(255) DEFAULT NULL,
  `reason_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create-categories', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(2, 'read-categories', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(3, 'update-categories', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(4, 'delete-categories', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(5, 'create-products', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(6, 'read-products', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(7, 'update-products', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(8, 'delete-products', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(9, 'create-warehouses', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(10, 'read-warehouses', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(11, 'update-warehouses', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(12, 'delete-warehouses', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(13, 'create-suppliers', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(14, 'read-suppliers', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(15, 'update-suppliers', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(16, 'delete-suppliers', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(17, 'create-purchase_orders', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(18, 'read-purchase_orders', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(19, 'update-purchase_orders', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(20, 'delete-purchase_orders', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(21, 'create-purchases', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(22, 'read-purchases', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(23, 'update-purchases', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(24, 'delete-purchases', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(25, 'create-customers', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(26, 'read-customers', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(27, 'update-customers', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(28, 'delete-customers', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(29, 'create-quotes', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(30, 'read-quotes', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(31, 'update-quotes', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(32, 'delete-quotes', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(33, 'create-sales', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(34, 'read-sales', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(35, 'update-sales', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(36, 'delete-sales', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(37, 'create-movements', 'web', '2025-10-24 03:28:59', '2025-10-24 03:28:59'),
(38, 'read-movements', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(39, 'update-movements', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(40, 'delete-movements', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(41, 'create-transfers', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(42, 'read-transfers', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(43, 'update-transfers', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(44, 'delete-transfers', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(45, 'read-top-products', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(46, 'read-top-customers', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(47, 'read-low-stock', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(48, 'create-users', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(49, 'read-users', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(50, 'update-users', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(51, 'delete-users', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(52, 'create-roles', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(53, 'read-roles', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(54, 'update-roles', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(55, 'delete-roles', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(56, 'create-permissions', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(57, 'read-permissions', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(58, 'update-permissions', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(59, 'delete-permissions', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(60, 'read-setting', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(61, 'update-setting', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productables`
--

CREATE TABLE `productables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `productable_type` varchar(255) NOT NULL,
  `productable_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productables`
--

INSERT INTO `productables` (`id`, `product_id`, `productable_type`, `productable_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 3, 'App\\Models\\Purchase', 1, 26, 345.00, 8970.00, '2025-10-24 03:34:41', '2025-10-24 03:34:41'),
(2, 2, 'App\\Models\\Purchase', 1, 42, 232.00, 9744.00, '2025-10-24 03:34:41', '2025-10-24 03:34:41'),
(3, 1, 'App\\Models\\Purchase', 1, 30, 545.00, 16350.00, '2025-10-24 03:34:41', '2025-10-24 03:34:41'),
(4, 1, 'App\\Models\\Sale', 1, 2, 10.00, 20.00, '2025-10-25 17:48:14', '2025-10-25 17:48:14'),
(5, 2, 'App\\Models\\Sale', 2, 1, 20.00, 20.00, '2025-10-25 19:45:25', '2025-10-25 19:45:25'),
(6, 2, 'App\\Models\\Sale', 3, 1, 20.00, 20.00, '2025-10-25 19:52:39', '2025-10-25 19:52:39'),
(7, 2, 'App\\Models\\Sale', 4, 1, 20.00, 20.00, '2025-10-25 19:54:14', '2025-10-25 19:54:14'),
(8, 2, 'App\\Models\\Sale', 5, 1, 67.00, 67.00, '2025-10-25 20:19:49', '2025-10-25 20:19:49'),
(9, 3, 'App\\Models\\Sale', 5, 2, 15.00, 30.00, '2025-10-25 20:19:49', '2025-10-25 20:19:49'),
(10, 3, 'App\\Models\\Sale', 6, 1, 15.00, 15.00, '2025-10-25 20:32:13', '2025-10-25 20:32:13'),
(11, 1, 'App\\Models\\Sale', 7, 1, 10.00, 10.00, '2025-10-25 20:33:40', '2025-10-25 20:33:40'),
(12, 1, 'App\\Models\\Purchase', 2, 86, 545.00, 46870.00, '2025-10-25 20:34:55', '2025-10-25 20:34:55'),
(13, 2, 'App\\Models\\Purchase', 2, 51, 232.00, 11832.00, '2025-10-25 20:34:55', '2025-10-25 20:34:55'),
(14, 3, 'App\\Models\\Purchase', 2, 80, 345.00, 27600.00, '2025-10-25 20:34:55', '2025-10-25 20:34:55'),
(15, 1, 'App\\Models\\Sale', 8, 1, 10.00, 10.00, '2025-10-25 20:36:23', '2025-10-25 20:36:23'),
(16, 2, 'App\\Models\\Sale', 8, 1, 20.00, 20.00, '2025-10-25 20:36:23', '2025-10-25 20:36:23'),
(17, 3, 'App\\Models\\Sale', 9, 1, 15.00, 15.00, '2025-10-25 20:41:54', '2025-10-25 20:41:54'),
(18, 1, 'App\\Models\\Sale', 9, 1, 10.00, 10.00, '2025-10-25 20:41:54', '2025-10-25 20:41:54'),
(19, 2, 'App\\Models\\Sale', 9, 1, 20.00, 20.00, '2025-10-25 20:41:54', '2025-10-25 20:41:54'),
(20, 1, 'App\\Models\\Sale', 10, 1, 10.00, 10.00, '2025-10-25 20:47:14', '2025-10-25 20:47:14'),
(21, 3, 'App\\Models\\Sale', 10, 1, 15.00, 15.00, '2025-10-25 20:47:14', '2025-10-25 20:47:14'),
(22, 2, 'App\\Models\\Sale', 10, 1, 20.00, 20.00, '2025-10-25 20:47:14', '2025-10-25 20:47:14'),
(23, 1, 'App\\Models\\Sale', 11, 1, 10.00, 10.00, '2025-10-25 20:49:46', '2025-10-25 20:49:46'),
(24, 2, 'App\\Models\\Sale', 11, 1, 20.00, 20.00, '2025-10-25 20:49:46', '2025-10-25 20:49:46'),
(25, 1, 'App\\Models\\Sale', 12, 1, 10.00, 10.00, '2025-10-25 21:04:34', '2025-10-25 21:04:34'),
(26, 2, 'App\\Models\\Sale', 3, 1, 20.00, 20.00, '2025-10-25 21:30:06', '2025-10-25 21:30:06'),
(27, 1, 'App\\Models\\Sale', 3, 1, 10.00, 10.00, '2025-10-25 21:30:06', '2025-10-25 21:30:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `sku`, `barcode`, `price`, `category_id`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'Producto de Prueba 1', 'Descripción del producto 1', NULL, NULL, 10.00, 1, 158, '2025-10-24 03:29:02', '2025-10-25 21:30:06'),
(2, 'Producto de Prueba 2', 'Descripción del producto 2', NULL, NULL, 20.00, 1, 115, '2025-10-24 03:29:02', '2025-10-25 21:30:06'),
(3, 'Producto de Prueba 3', 'Descripción del producto 3', NULL, NULL, 15.00, 1, 127, '2025-10-24 03:29:02', '2025-10-25 20:47:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `voucher_type` int(11) NOT NULL,
  `serie` varchar(255) NOT NULL,
  `correlative` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `purchase_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `observation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `purchases`
--

INSERT INTO `purchases` (`id`, `voucher_type`, `serie`, `correlative`, `date`, `purchase_order_id`, `supplier_id`, `warehouse_id`, `total`, `observation`, `created_at`, `updated_at`) VALUES
(1, 2, 'nh78', 776, '2025-10-23 04:00:00', NULL, 1, 1, 35064.00, NULL, '2025-10-24 03:34:40', '2025-10-24 03:34:40'),
(2, 1, 'xd442', 45, '2025-10-25 04:00:00', NULL, 1, 1, 86302.00, NULL, '2025-10-25 20:34:55', '2025-10-25 20:34:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `voucher_type` int(11) NOT NULL,
  `serie` varchar(255) NOT NULL,
  `correlative` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `observation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `voucher_type` int(11) NOT NULL,
  `serie` varchar(255) NOT NULL,
  `correlative` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `observation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reasons`
--

CREATE TABLE `reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reasons`
--

INSERT INTO `reasons` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Ajuste por inventario', 1, '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(2, 'Devolución de cliente', 1, '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(3, 'Produccion terminada', 1, '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(4, 'Error en salida anterior', 1, '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(5, 'Ajuste por inventario', 2, '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(6, 'Merma o deterioro', 2, '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(7, 'Consumo interno', 2, '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(8, 'Caducidad', 2, '2025-10-24 03:28:58', '2025-10-24 03:28:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(2, 'editor', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00'),
(3, 'viewer', 'web', '2025-10-24 03:29:00', '2025-10-24 03:29:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(14, 3),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(26, 3),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(30, 1),
(30, 3),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(34, 3),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(38, 3),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(42, 3),
(43, 1),
(44, 1),
(45, 1),
(45, 3),
(46, 1),
(46, 3),
(47, 1),
(47, 3),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `voucher_type` int(11) NOT NULL,
  `serie` varchar(255) NOT NULL,
  `correlative` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `quote_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `observation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `voucher_type`, `serie`, `correlative`, `date`, `quote_id`, `customer_id`, `warehouse_id`, `total`, `observation`, `created_at`, `updated_at`) VALUES
(3, 2, 'mj67', 1, '1985-12-09 04:00:00', NULL, 3, 1, 30.00, 'Oprah Carlson', '2025-10-25 21:30:06', '2025-10-25 21:30:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EyNBQgQzW7awJcgmoPC2UvSa7yj1Nhwb65SQ4JlE', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRXNKWVBxWDEyYjFtd055MHRRalZIa2R4am1CbFFnYnN1d2pqenRSSSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vc2hvcHBpbmctY2FydHMvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1761426303),
('rXHBrNfjGZqKtm5RU5LhfhC9E2eOhr6Dvrnyit7U', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRjB4bGREQVFmZjh2a2E5RVdlNW1JTEFLUDM5REdpYVBjaHlTQW11bSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vaW52ZW50YXJpby1wb3MudGVzdC9hZG1pbi9zYWxlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1761427807);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shopping_carts`
--

CREATE TABLE `shopping_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products`)),
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `quote_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_method` enum('efectivo','tarjeta','cheque','transferencia') NOT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `change` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `shopping_carts`
--

INSERT INTO `shopping_carts` (`id`, `customer_id`, `products`, `warehouse_id`, `quote_id`, `total`, `payment_method`, `amount_paid`, `change`, `created_at`, `updated_at`) VALUES
(9, 3, '[{\"id\":1,\"name\":\"Producto de Prueba 1\",\"price\":\"10.00\",\"quantity\":1,\"subtotal\":\"10.00\",\"image\":\"http:\\/\\/inventario-pos.test\\/img\\/no-image.jpeg\",\"stock\":162},{\"id\":3,\"name\":\"Producto de Prueba 3\",\"price\":\"15.00\",\"quantity\":1,\"subtotal\":\"15.00\",\"image\":\"\\/storage\\/images\\/J50wsyg80X2U7rPh1UU76P22hTomflNPe0JKTbQr.png\",\"stock\":128},{\"id\":2,\"name\":\"Producto de Prueba 2\",\"price\":\"20.00\",\"quantity\":1,\"subtotal\":\"20.00\",\"image\":\"http:\\/\\/inventario-pos.test\\/img\\/no-image.jpeg\",\"stock\":118}]', 1, NULL, 53.10, 'cheque', 60.00, 6.90, '2025-10-25 20:47:14', '2025-10-25 20:47:14'),
(10, 3, '[{\"id\":1,\"name\":\"Producto de Prueba 1\",\"price\":\"10.00\",\"quantity\":1,\"subtotal\":\"10.00\",\"image\":\"http:\\/\\/inventario-pos.test\\/img\\/no-image.jpeg\",\"stock\":161},{\"id\":2,\"name\":\"Producto de Prueba 2\",\"price\":\"20.00\",\"quantity\":1,\"subtotal\":\"20.00\",\"image\":\"http:\\/\\/inventario-pos.test\\/img\\/no-image.jpeg\",\"stock\":117}]', 1, NULL, 35.40, 'efectivo', 78.00, 42.60, '2025-10-25 20:49:46', '2025-10-25 20:49:46'),
(11, 1, '[{\"id\":1,\"name\":\"Producto de Prueba 1\",\"price\":\"10.00\",\"quantity\":1,\"subtotal\":\"10.00\",\"image\":\"http:\\/\\/inventario-pos.test\\/img\\/no-image.jpeg\",\"stock\":160}]', 1, NULL, 11.80, 'efectivo', 20.00, 8.20, '2025-10-25 21:04:34', '2025-10-25 21:04:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `identity_id` bigint(20) UNSIGNED NOT NULL,
  `document_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `suppliers`
--

INSERT INTO `suppliers` (`id`, `identity_id`, `document_number`, `name`, `address`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 3, 'Lareina Moreno', 'Reed Oneil', 'Thor Thompson', 'lyry@mailinator.com', 'Sierra Singleton', '2025-10-24 03:33:34', '2025-10-24 03:33:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serie` varchar(255) NOT NULL,
  `correlative` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `observation` varchar(255) DEFAULT NULL,
  `origin_warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `destination_warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Amy', 'amygarcia9618@gmail.com', '2025-10-24 03:29:01', '$2y$12$/jF7Yb4oY8Xr4gZxW4CeHeopwby6cLzylO.n4XFRdlEv34IPvVfNi', NULL, NULL, NULL, '9vNPJbMsmg', NULL, NULL, '2025-10-24 03:29:02', '2025-10-24 03:29:02'),
(2, 'Admin User', 'admin@example.com', '2025-10-24 03:29:02', '$2y$12$1yGPmxM2qYPqun7JqTPyUOR.NfOtyJhkBhurKVlEhnnqi8GuGtkZO', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-24 03:29:02', '2025-10-24 03:29:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Almacen Principal', 'Oficina Principal, Calle principal', '2025-10-24 03:28:58', '2025-10-24 03:28:58'),
(2, 'Almacen Secundario', 'Oficina sucre, Calle sucre', '2025-10-24 03:28:58', '2025-10-24 03:28:58');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_document_number_unique` (`document_number`),
  ADD KEY `customers_identity_id_foreign` (`identity_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `identities`
--
ALTER TABLE `identities`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `images_path_unique` (`path`),
  ADD KEY `images_imageable_type_imageable_id_index` (`imageable_type`,`imageable_id`);

--
-- Indices de la tabla `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_product_id_foreign` (`product_id`),
  ADD KEY `inventories_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `inventories_inventoryable_type_inventoryable_id_index` (`inventoryable_type`,`inventoryable_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `movements`
--
ALTER TABLE `movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movements_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `movements_reason_id_foreign` (`reason_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indices de la tabla `productables`
--
ALTER TABLE `productables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productables_product_id_foreign` (`product_id`),
  ADD KEY `productables_productable_type_productable_id_index` (`productable_type`,`productable_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indices de la tabla `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `purchases_supplier_id_foreign` (`supplier_id`),
  ADD KEY `purchases_warehouse_id_foreign` (`warehouse_id`);

--
-- Indices de la tabla `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_orders_supplier_id_foreign` (`supplier_id`);

--
-- Indices de la tabla `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotes_customer_id_foreign` (`customer_id`);

--
-- Indices de la tabla `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_quote_id_foreign` (`quote_id`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`),
  ADD KEY `sales_warehouse_id_foreign` (`warehouse_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopping_carts_customer_id_foreign` (`customer_id`),
  ADD KEY `shopping_carts_quote_id_foreign` (`quote_id`),
  ADD KEY `shopping_carts_warehouse_id_foreign` (`warehouse_id`);

--
-- Indices de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_document_number_unique` (`document_number`),
  ADD KEY `suppliers_identity_id_foreign` (`identity_id`);

--
-- Indices de la tabla `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfers_origin_warehouse_id_foreign` (`origin_warehouse_id`),
  ADD KEY `transfers_destination_warehouse_id_foreign` (`destination_warehouse_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `warehouses_name_unique` (`name`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `identities`
--
ALTER TABLE `identities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `movements`
--
ALTER TABLE `movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productables`
--
ALTER TABLE `productables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `shopping_carts`
--
ALTER TABLE `shopping_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_identity_id_foreign` FOREIGN KEY (`identity_id`) REFERENCES `identities` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventories_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movements`
--
ALTER TABLE `movements`
  ADD CONSTRAINT `movements_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `reasons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movements_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productables`
--
ALTER TABLE `productables`
  ADD CONSTRAINT `productables_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `quotes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD CONSTRAINT `shopping_carts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shopping_carts_quote_id_foreign` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shopping_carts_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_identity_id_foreign` FOREIGN KEY (`identity_id`) REFERENCES `identities` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_destination_warehouse_id_foreign` FOREIGN KEY (`destination_warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_origin_warehouse_id_foreign` FOREIGN KEY (`origin_warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
