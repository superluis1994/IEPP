-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2024 a las 22:57:14
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `iepp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `congregacion`
--

CREATE TABLE `congregacion` (
  `id_hermano` int(11) NOT NULL,
  `usuario` varchar(11) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `online` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL,
  `intento_fallidos` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `congregacion`
--

INSERT INTO `congregacion` (`id_hermano`, `usuario`, `password`, `email`, `tipo_usuario`, `online`, `status`, `intento_fallidos`) VALUES
(2, '04949668-8', '4tio8g75OEs1Q/km9jcnoq2mU5FIQWmAx+1NVxDAbjU=', 'superluis1994@gmail.com', 2, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE `datos_personales` (
  `id_datos_personales` int(11) NOT NULL,
  `nombre` varchar(70) DEFAULT NULL,
  `apellido` varchar(70) DEFAULT NULL,
  `fecha_nacimiento` datetime DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `telefono` varchar(15) NOT NULL,
  `id_congregacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id_datos_personales`, `nombre`, `apellido`, `fecha_nacimiento`, `direccion`, `telefono`, `id_congregacion`, `fecha_creacion`, `fecha_actualizacion`, `usuario_actualizacion`) VALUES
(1, 'LUIS ALVERTO', 'SORTO LEMUS', '2024-03-25 22:21:02', 'CHALCHUAPA / COLONIA SAN ANTONIO 1 POLIGONO H CASA # 3', '', 2, '2024-03-25 21:22:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directiva`
--

CREATE TABLE `directiva` (
  `id_directiva` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `id_iglesia` int(11) NOT NULL,
  `id_tipo_directiva` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `directiva`
--

INSERT INTO `directiva` (`id_directiva`, `year`, `id_iglesia`, `id_tipo_directiva`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, '2023', 1, 1, '2024-03-25 19:31:05', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directivos`
--

CREATE TABLE `directivos` (
  `id_directivos` int(11) NOT NULL,
  `id_directiva` int(11) NOT NULL,
  `id_congregacion` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `directivos`
--

INSERT INTO `directivos` (`id_directivos`, `id_directiva`, `id_congregacion`, `status`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, 1, 2, 1, '2024-03-25 12:48:29', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iglesia`
--

CREATE TABLE `iglesia` (
  `id_iglesia` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `ubicacion` text NOT NULL,
  `logitud` text NOT NULL,
  `latitud` text NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `iglesia`
--

INSERT INTO `iglesia` (`id_iglesia`, `nombre`, `ubicacion`, `logitud`, `latitud`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, 'PRINCIPE DE PAZ DE COLONIA SAN ANTONIO 1', 'El Salvador / Chalchuapa / colonia san Antonio 2, donde antes era la ladrillera', '-89.68673081078315', '13.985013064216144', '2024-03-25 19:08:20', '2024-03-25 19:08:20', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `enlace` varchar(255) DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `tipo` varchar(40) NOT NULL,
  `orden` int(11) NOT NULL,
  `id_padre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `titulo`, `enlace`, `icono`, `tipo`, `orden`, `id_padre`) VALUES
(1, 'FINANZAS', '/panel/adm', '<svg width=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" class=\"icon-20\">\n                                    <path opacity=\"0.4\" d=\"M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z\" fill=\"currentColor\"></path>\n                                    <path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z\" fill=\"currentColor\"></path>\n                                </svg>                                    <path opacity=\"0.4\" d=\"M10.0833 15.958H3.50777C2.67555 15.958 2 16.6217 2 17.4393C2 18.2559 2.67555 18.9207 3.50777 18.9207H10.0833C10.9155 18.9207 11.5911 18.2559 11.5911 17.4393C11.5911 16.6217 10.9155 15.958 10.0833 15.958Z\" fill=\"currentColor\"></path>\n                                    <path opacity=\"0.4\" d=\"M22.0001 6.37867C22.0001 5.56214 21.3246 4.89844 20.4934 4.89844H13.9179C13.0857 4.89844 12.4102 5.56214 12.4102 6.37867C12.4102 7.1963 13.0857 7.86 13.9179 7.86H20.4934C21.3246 7.86 22.0001 7.1963 22.0001 6.37867Z\" fill=\"currentColor\"></path>\n                                    <path d=\"M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856Z\" fill=\"currentColor\"></path>\n                                    <path d=\"M21.9998 17.3992C21.9998 19.2648 20.4609 20.7777 18.5609 20.7777C16.6621 20.7777 15.1221 19.2648 15.1221 17.3992C15.1221 15.5325 16.6621 14.0195 18.5609 14.0195C20.4609 14.0195 21.9998 15.5325 21.9998 17.3992Z\" fill=\"currentColor\"></path>                               </svg>', 'titulo', 1, NULL),
(2, 'Talento', '/panel/adm/Talento', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 1, 1),
(3, 'Ventas', '/panel/adm/Ventas', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 3, 1),
(5, 'ASISTENCIA', '/panel/asig', '<svg width=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" class=\"icon-20\">\r\n                                    <path opacity=\"0.4\" d=\"M10.0833 15.958H3.50777C2.67555 15.958 2 16.6217 2 17.4393C2 18.2559 2.67555 18.9207 3.50777 18.9207H10.0833C10.9155 18.9207 11.5911 18.2559 11.5911 17.4393C11.5911 16.6217 10.9155 15.958 10.0833 15.958Z\" fill=\"currentColor\"></path>\r\n                                    <path opacity=\"0.4\" d=\"M22.0001 6.37867C22.0001 5.56214 21.3246 4.89844 20.4934 4.89844H13.9179C13.0857 4.89844 12.4102 5.56214 12.4102 6.37867C12.4102 7.1963 13.0857 7.86 13.9179 7.86H20.4934C21.3246 7.86 22.0001 7.1963 22.0001 6.37867Z\" fill=\"currentColor\"></path>\r\n                                    <path d=\"M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856Z\" fill=\"currentColor\"></path>\r\n                                    <path d=\"M21.9998 17.3992C21.9998 19.2648 20.4609 20.7777 18.5609 20.7777C16.6621 20.7777 15.1221 19.2648 15.1221 17.3992C15.1221 15.5325 16.6621 14.0195 18.5609 14.0195C20.4609 14.0195 21.9998 15.5325 21.9998 17.3992Z\" fill=\"currentColor\"></path>\r\n                                </svg>', 'titulo', 2, NULL),
(6, 'menu 3', '/panel/asig/sorto', '<svg class=\"icon-20\" xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                    <path d=\"M8 10.5378C8 9.43327 8.89543 8.53784 10 8.53784H11.3333C12.4379 8.53784 13.3333 9.43327 13.3333 10.5378V19.8285C13.3333 20.9331 14.2288 21.8285 15.3333 21.8285H16C16 21.8285 12.7624 23.323 10.6667 22.9361C10.1372 22.8384 9.52234 22.5913 9.01654 22.3553C8.37357 22.0553 8 21.3927 8 20.6832V10.5378Z\" fill=\"currentColor\" />\n                                    <rect opacity=\"0.4\" x=\"8\" y=\"1\" width=\"5\" height=\"5\" rx=\"2.5\" fill=\"currentColor\" />\n                                </svg>', 'subMenu', 3, 5),
(7, 'Rifas', '/panel/adm/Rifas', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\r\n                                            <g>\r\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\r\n                                            </g>\r\n                                        </svg>', 'subMenu', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_user`
--

CREATE TABLE `permisos_user` (
  `id_permiso` int(11) NOT NULL,
  `id_hermano` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `tipo_permiso` enum('lectura','escritura','ninguno') DEFAULT 'lectura'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `permisos_user`
--

INSERT INTO `permisos_user` (`id_permiso`, `id_hermano`, `id_menu`, `tipo_permiso`) VALUES
(4, 2, 1, 'lectura'),
(9, 2, 2, 'escritura'),
(11, 2, 3, 'escritura'),
(12, 2, 7, 'escritura'),
(13, 2, 5, 'lectura'),
(14, 2, 6, 'escritura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id_status`, `titulo`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, 'ACTIVO', '2024-04-08 21:08:51', NULL, 1, NULL),
(2, 'DESACTIVO', '2024-04-08 21:08:51', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_entrada`
--

CREATE TABLE `tipo_de_entrada` (
  `id_tipo_entrada` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `status` int(11) NOT NULL,
  `posicion` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo_de_entrada`
--

INSERT INTO `tipo_de_entrada` (`id_tipo_entrada`, `titulo`, `status`, `posicion`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, 'TALENTO', 1, 1, '2024-03-25 19:36:26', NULL, 1, NULL),
(2, 'VENTAS', 1, 2, '2024-03-25 19:36:42', NULL, 1, NULL),
(3, 'OFRENDA', 1, 4, '2024-03-25 19:36:54', NULL, 1, NULL),
(4, 'RIFAS', 1, 3, '2024-03-28 23:34:20', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_usuario`
--

CREATE TABLE `tipo_de_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `titulo` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo_de_usuario`
--

INSERT INTO `tipo_de_usuario` (`id_tipo_usuario`, `titulo`, `status`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, 'Admin', 1, '2024-03-27 00:01:52', NULL, 1, NULL),
(2, 'Directivo', 1, '2024-03-27 00:01:52', NULL, 1, NULL),
(3, 'Cristiano', 1, '2024-03-27 00:02:05', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_directiva`
--

CREATE TABLE `tipo_directiva` (
  `id_tipo_directiva` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `status` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo_directiva`
--

INSERT INTO `tipo_directiva` (`id_tipo_directiva`, `titulo`, `status`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, 'DIRECTIVA DE JOVENES', 1, '2024-03-25 19:32:27', NULL, 1, NULL),
(2, 'DIRECTIVA DE UNION FEMENIL', 1, '2024-03-25 19:32:53', NULL, 1, NULL),
(3, 'DIRECTIVA DE CONSEJEROS', 1, '2024-03-25 19:33:45', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_transacion`
--

CREATE TABLE `tipo_transacion` (
  `id_tipo_transacion` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo_transacion`
--

INSERT INTO `tipo_transacion` (`id_tipo_transacion`, `titulo`, `status`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, 'INGRESO', 1, '2024-03-25 19:39:42', NULL, 1, NULL),
(2, 'RETIRO', 1, '2024-03-25 19:39:42', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `id_transacciones` int(11) NOT NULL,
  `monto` decimal(11,2) NOT NULL,
  `id_realizada_por` int(11) NOT NULL,
  `id_tipo_transacion` int(11) NOT NULL,
  `id_tipo_entrada` int(11) NOT NULL,
  `id_directiva` int(11) NOT NULL,
  `fecha_transacion` datetime NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`id_transacciones`, `monto`, `id_realizada_por`, `id_tipo_transacion`, `id_tipo_entrada`, `id_directiva`, `fecha_transacion`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, 3.35, 1, 1, 1, 1, '2024-03-28 22:16:42', '2024-03-28 22:16:42', NULL, 1, NULL),
(2, 4.50, 1, 1, 1, 1, '2024-03-28 22:18:46', '2024-03-28 22:18:46', NULL, 1, NULL),
(3, 1.25, 1, 1, 2, 1, '2024-03-28 22:28:24', '2024-03-28 22:28:24', NULL, 1, NULL),
(4, 1.00, 1, 1, 2, 1, '2024-03-28 22:29:25', '2024-03-28 22:29:25', NULL, 1, NULL),
(5, 1.00, 1, 2, 1, 1, '2024-03-28 22:51:13', '2024-03-28 22:51:13', NULL, 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `congregacion`
--
ALTER TABLE `congregacion`
  ADD PRIMARY KEY (`id_hermano`);

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`id_datos_personales`);

--
-- Indices de la tabla `directiva`
--
ALTER TABLE `directiva`
  ADD PRIMARY KEY (`id_directiva`);

--
-- Indices de la tabla `directivos`
--
ALTER TABLE `directivos`
  ADD PRIMARY KEY (`id_directivos`);

--
-- Indices de la tabla `iglesia`
--
ALTER TABLE `iglesia`
  ADD PRIMARY KEY (`id_iglesia`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_id_padre` (`id_padre`);

--
-- Indices de la tabla `permisos_user`
--
ALTER TABLE `permisos_user`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `id_hermano` (`id_hermano`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indices de la tabla `tipo_de_entrada`
--
ALTER TABLE `tipo_de_entrada`
  ADD PRIMARY KEY (`id_tipo_entrada`);

--
-- Indices de la tabla `tipo_de_usuario`
--
ALTER TABLE `tipo_de_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `tipo_directiva`
--
ALTER TABLE `tipo_directiva`
  ADD PRIMARY KEY (`id_tipo_directiva`);

--
-- Indices de la tabla `tipo_transacion`
--
ALTER TABLE `tipo_transacion`
  ADD PRIMARY KEY (`id_tipo_transacion`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id_transacciones`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `congregacion`
--
ALTER TABLE `congregacion`
  MODIFY `id_hermano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id_datos_personales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `directiva`
--
ALTER TABLE `directiva`
  MODIFY `id_directiva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `directivos`
--
ALTER TABLE `directivos`
  MODIFY `id_directivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `iglesia`
--
ALTER TABLE `iglesia`
  MODIFY `id_iglesia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permisos_user`
--
ALTER TABLE `permisos_user`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_de_entrada`
--
ALTER TABLE `tipo_de_entrada`
  MODIFY `id_tipo_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_de_usuario`
--
ALTER TABLE `tipo_de_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_directiva`
--
ALTER TABLE `tipo_directiva`
  MODIFY `id_tipo_directiva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_transacion`
--
ALTER TABLE `tipo_transacion`
  MODIFY `id_tipo_transacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id_transacciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_id_padre` FOREIGN KEY (`id_padre`) REFERENCES `menu` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_padre`) REFERENCES `menu` (`id`);

--
-- Filtros para la tabla `permisos_user`
--
ALTER TABLE `permisos_user`
  ADD CONSTRAINT `permisos_user_ibfk_1` FOREIGN KEY (`id_hermano`) REFERENCES `congregacion` (`id_hermano`),
  ADD CONSTRAINT `permisos_user_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
