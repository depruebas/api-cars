-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-06-2020 a las 07:16:08
-- Versión del servidor: 5.7.30-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `API_CARS`
--
CREATE DATABASE IF NOT EXISTS `API_CARS` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `API_CARS`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_env`
--

CREATE TABLE `auth_env` (
  `id` int(11) NOT NULL,
  `api_user` varchar(200) NOT NULL,
  `api_pass` varchar(200) NOT NULL,
  `api_name` varchar(50) NOT NULL,
  `token` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `enabled` int(2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auth_env`
--

INSERT INTO `auth_env` (`id`, `api_user`, `api_pass`, `api_name`, `token`, `description`, `enabled`, `created_at`) VALUES
(2, 'tEQUnCs5UdmGApjSksFkeBykC5ANVpns', '8A}yCehpvD5Pm26jtQZY-m;t5^G(WTd]', 'CARS-DEV', 'CARS-DEV-KSDFJHWEKRHOSIHFWMRBDACZXKJH', 'Developer API Access', 1, '2019-11-20 14:51:04'),
(3, 'tEQUsadhjkuiajSksFkeByksafk787ad', '8A}yCehpvD5Pm26jtjasdkasdj893hjc', 'CARS-PROD', 'CARS-PROD-JHWEKJRHFSAZCLYISUKJFGCBZX', 'Production API Access', 1, '2019-11-20 14:51:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cars_brand`
--

CREATE TABLE `cars_brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cars_brand`
--

INSERT INTO `cars_brand` (`id`, `name`, `logo`, `country`, `year`) VALUES
(1, 'Mazda', 'mazda.jpg', 'Japon', 1920),
(2, 'Toyota', 'toyota.jpg', 'Japon', 1937),
(3, 'Peugeot', 'logo_peugeot.jpg', 'Francia', 1896),
(4, 'Renault', 'logo_Renault.jpg', 'Francia', 1898),
(5, 'Seat', 'seat.jpg', 'España', 1950),
(6, 'Ford', 'ford.jpg', 'USA', 1903);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cars_models`
--

CREATE TABLE `cars_models` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_name` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `created` datetime DEFAULT NULL,
  `enabled` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cars_models`
--

INSERT INTO `cars_models` (`id`, `brand_id`, `model_name`, `price`, `created`, `enabled`) VALUES
(1, 1, 'Mazda CX5 - Origin', 25000, NULL, 1),
(8, 6, 'Fiesta - Trend', 30000, NULL, 1),
(3, 1, 'Mazda CX5 - Zenith', 35000, NULL, 1),
(4, 1, 'Mazda CX5 - Evolution', 30000, NULL, 1),
(5, 1, 'Mazda6 - Evolution', 30000, NULL, 1),
(6, 1, 'Mazda6 - Zenith', 35000, NULL, 1),
(7, 1, 'Mazda6 - Evolution', 30000, NULL, 1),
(9, 6, 'Fiesta - ST-Line', 35000, NULL, 1),
(10, 6, 'Fiesta - Active', 30000, NULL, 1),
(11, 4, 'Clio - Life', 11000, NULL, 1),
(12, 4, 'Clio - Intens', 12500, NULL, 1),
(13, 4, 'Clio - Zen', 14500, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `created_at`, `type`, `message`, `code`) VALUES
(1, '2020-06-04 05:14:14', 'ERROR', 'El JSON esta vacio y no hay datos para procesar.', 'm6n8kjpcu3entzfe7evs1414');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_env`
--
ALTER TABLE `auth_env`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `api_user` (`api_user`),
  ADD KEY `api_pass` (`api_pass`),
  ADD KEY `api_name` (`api_name`);

--
-- Indices de la tabla `cars_brand`
--
ALTER TABLE `cars_brand`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `cars_models`
--
ALTER TABLE `cars_models`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auth_env`
--
ALTER TABLE `auth_env`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cars_brand`
--
ALTER TABLE `cars_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cars_models`
--
ALTER TABLE `cars_models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
