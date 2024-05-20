-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2024 a las 02:22:46
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directiva`
--

CREATE TABLE `directiva` (
  `id_directiva` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `id_iglesia` int(11) NOT NULL,
  `id_tipo_directiva` int(11) NOT NULL,
  `status` varchar(35) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `directiva`
--

INSERT INTO `directiva` (`id_directiva`, `year`, `id_iglesia`, `id_tipo_directiva`, `status`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, '2023', 1, 1, '1', '2024-03-25 19:31:05', NULL, 1, NULL);

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
  `usuario_creacion` int(11) NOT NULL DEFAULT current_timestamp(),
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `directivos`
--

INSERT INTO `directivos` (`id_directivos`, `id_directiva`, `id_congregacion`, `status`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, 1, 2, 1, '2024-03-25 12:48:29', NULL, 2, 0),
(2, 1, 3, 1, '2024-05-12 13:43:43', NULL, 3, NULL),
(3, 1, 4, 1, '2024-05-12 13:46:54', NULL, 4, NULL),
(4, 1, 5, 1, '2024-05-12 13:50:13', NULL, 5, NULL),
(5, 1, 6, 1, '2024-05-12 14:11:33', NULL, 6, NULL);

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
  `Descripcion` text NOT NULL,
  `id_padre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `titulo`, `enlace`, `icono`, `tipo`, `orden`, `Descripcion`, `id_padre`) VALUES
(1, 'FINANZAS', '/panel/adm', '<svg width=\"32\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" class=\"icon-32\">\n                                    <path opacity=\"0.4\" d=\"M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z\" fill=\"currentColor\"></path>\n                                    <path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z\" fill=\"currentColor\"></path>\n                                </svg>                                    <path opacity=\"0.4\" d=\"M10.0833 15.958H3.50777C2.67555 15.958 2 16.6217 2 17.4393C2 18.2559 2.67555 18.9207 3.50777 18.9207H10.0833C10.9155 18.9207 11.5911 18.2559 11.5911 17.4393C11.5911 16.6217 10.9155 15.958 10.0833 15.958Z\" fill=\"currentColor\"></path>\n                                    <path opacity=\"0.4\" d=\"M22.0001 6.37867C22.0001 5.56214 21.3246 4.89844 20.4934 4.89844H13.9179C13.0857 4.89844 12.4102 5.56214 12.4102 6.37867C12.4102 7.1963 13.0857 7.86 13.9179 7.86H20.4934C21.3246 7.86 22.0001 7.1963 22.0001 6.37867Z\" fill=\"currentColor\"></path>\n                                    <path d=\"M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856Z\" fill=\"currentColor\"></path>\n                                    <path d=\"M21.9998 17.3992C21.9998 19.2648 20.4609 20.7777 18.5609 20.7777C16.6621 20.7777 15.1221 19.2648 15.1221 17.3992C15.1221 15.5325 16.6621 14.0195 18.5609 14.0195C20.4609 14.0195 21.9998 15.5325 21.9998 17.3992Z\" fill=\"currentColor\"></path>                               </svg>', 'Titulo', 1, '', NULL),
(2, 'ASISTENCIA', '/panel/asig', '<svg width=\"32\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" class=\"icon-32\">\n                                    <path opacity=\"0.4\" d=\"M10.0833 15.958H3.50777C2.67555 15.958 2 16.6217 2 17.4393C2 18.2559 2.67555 18.9207 3.50777 18.9207H10.0833C10.9155 18.9207 11.5911 18.2559 11.5911 17.4393C11.5911 16.6217 10.9155 15.958 10.0833 15.958Z\" fill=\"currentColor\"></path>\n                                    <path opacity=\"0.4\" d=\"M22.0001 6.37867C22.0001 5.56214 21.3246 4.89844 20.4934 4.89844H13.9179C13.0857 4.89844 12.4102 5.56214 12.4102 6.37867C12.4102 7.1963 13.0857 7.86 13.9179 7.86H20.4934C21.3246 7.86 22.0001 7.1963 22.0001 6.37867Z\" fill=\"currentColor\"></path>\n                                    <path d=\"M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856Z\" fill=\"currentColor\"></path>\n                                    <path d=\"M21.9998 17.3992C21.9998 19.2648 20.4609 20.7777 18.5609 20.7777C16.6621 20.7777 15.1221 19.2648 15.1221 17.3992C15.1221 15.5325 16.6621 14.0195 18.5609 14.0195C20.4609 14.0195 21.9998 15.5325 21.9998 17.3992Z\" fill=\"currentColor\"></path>\n                                </svg>', 'Titulo', 2, '', NULL),
(3, 'AHORRO', '/panel/ahorro', '<svg class=\"icon-32\" width=\"32\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">                                                                <path opacity=\"0.4\" d=\"M2 11.0786C2.05 13.4166 2.19 17.4156 2.21 17.8566C2.281 18.7996 2.642 19.7526 3.204 20.4246C3.986 21.3676 4.949 21.7886 6.292 21.7886C8.148 21.7986 10.194 21.7986 12.181 21.7986C14.176 21.7986 16.112 21.7986 17.747 21.7886C19.071 21.7886 20.064 21.3566 20.836 20.4246C21.398 19.7526 21.759 18.7896 21.81 17.8566C21.83 17.4856 21.93 13.1446 21.99 11.0786H2Z\" fill=\"currentColor\"></path>                                <path d=\"M11.2451 15.3843V16.6783C11.2451 17.0923 11.5811 17.4283 11.9951 17.4283C12.4091 17.4283 12.7451 17.0923 12.7451 16.6783V15.3843C12.7451 14.9703 12.4091 14.6343 11.9951 14.6343C11.5811 14.6343 11.2451 14.9703 11.2451 15.3843Z\" fill=\"currentColor\"></path>                                <path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M10.211 14.5565C10.111 14.9195 9.762 15.1515 9.384 15.1015C6.833 14.7455 4.395 13.8405 2.337 12.4815C2.126 12.3435 2 12.1075 2 11.8555V8.38949C2 6.28949 3.712 4.58149 5.817 4.58149H7.784C7.972 3.12949 9.202 2.00049 10.704 2.00049H13.286C14.787 2.00049 16.018 3.12949 16.206 4.58149H18.183C20.282 4.58149 21.99 6.28949 21.99 8.38949V11.8555C21.99 12.1075 21.863 12.3425 21.654 12.4815C19.592 13.8465 17.144 14.7555 14.576 15.1105C14.541 15.1155 14.507 15.1175 14.473 15.1175C14.134 15.1175 13.831 14.8885 13.746 14.5525C13.544 13.7565 12.821 13.1995 11.99 13.1995C11.148 13.1995 10.433 13.7445 10.211 14.5565ZM13.286 3.50049H10.704C10.031 3.50049 9.469 3.96049 9.301 4.58149H14.688C14.52 3.96049 13.958 3.50049 13.286 3.50049Z\" fill=\"currentColor\">                                </path></svg>', 'Titulo', 3, '', NULL),
(4, 'PRIVILEGIOS', '/panel/privilegios', '<svg class=\"icon-32\" width=\"32\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">                                <path opacity=\"0.4\" d=\"M19.9927 18.9534H14.2984C13.7429 18.9534 13.291 19.4124 13.291 19.9767C13.291 20.5422 13.7429 21.0001 14.2984 21.0001H19.9927C20.5483 21.0001 21.0001 20.5422 21.0001 19.9767C21.0001 19.4124 20.5483 18.9534 19.9927 18.9534Z\" fill=\"currentColor\"></path>                                <path d=\"M10.309 6.90385L15.7049 11.2639C15.835 11.3682 15.8573 11.5596 15.7557 11.6929L9.35874 20.0282C8.95662 20.5431 8.36402 20.8344 7.72908 20.8452L4.23696 20.8882C4.05071 20.8903 3.88775 20.7613 3.84542 20.5764L3.05175 17.1258C2.91419 16.4915 3.05175 15.8358 3.45388 15.3306L9.88256 6.95545C9.98627 6.82108 10.1778 6.79743 10.309 6.90385Z\" fill=\"currentColor\"></path>                                <path opacity=\"0.4\" d=\"M18.1208 8.66544L17.0806 9.96401C16.9758 10.0962 16.7874 10.1177 16.6573 10.0124C15.3927 8.98901 12.1545 6.36285 11.2561 5.63509C11.1249 5.52759 11.1069 5.33625 11.2127 5.20295L12.2159 3.95706C13.126 2.78534 14.7133 2.67784 15.9938 3.69906L17.4647 4.87078C18.0679 5.34377 18.47 5.96726 18.6076 6.62299C18.7663 7.3443 18.597 8.0527 18.1208 8.66544Z\" fill=\"currentColor\"></path>                                </svg>                            ', 'Titulo', 4, 'Titulo de encabezado de privilegios ', NULL),
(5, 'MANTENIMIENTO', '/panel/mantenimiento', '<svg class=\"icon-32\" width=\"32\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">                                <path opacity=\"0.4\" d=\"M6.70555 12.8906C6.18944 12.8906 5.77163 13.3146 5.77163 13.8384L5.51416 18.4172C5.51416 19.0847 6.04783 19.6251 6.70555 19.6251C7.36328 19.6251 7.89577 19.0847 7.89577 18.4172L7.63947 13.8384C7.63947 13.3146 7.22167 12.8906 6.70555 12.8906Z\" fill=\"currentColor\"></path>                                <path d=\"M7.98037 3.67345C7.98037 3.67345 7.71236 3.39789 7.54618 3.27793C7.30509 3.09264 7.00783 3 6.71173 3C6.37936 3 6.07039 3.10452 5.81877 3.30169C5.77313 3.34801 5.57886 3.5226 5.41852 3.68532C4.41204 4.6367 2.76539 7.12026 2.26215 8.42083C2.18257 8.618 2.01053 9.11685 2 9.38409C2 9.63827 2.05618 9.88294 2.17087 10.1145C2.3312 10.4044 2.58282 10.6372 2.88009 10.7642C3.08606 10.8462 3.70282 10.9733 3.71453 10.9733C4.38981 11.1016 5.48757 11.1704 6.70003 11.1704C7.85514 11.1704 8.90727 11.1016 9.59308 10.997C9.60478 10.9852 10.3702 10.8581 10.6335 10.7179C11.1133 10.4626 11.4118 9.96371 11.4118 9.43041V9.38409C11.4001 9.03608 11.1016 8.30444 11.0911 8.30444C10.5879 7.07394 9.02079 4.64858 7.98037 3.67345Z\" fill=\"currentColor\"></path>                                <path opacity=\"0.4\" d=\"M17.2949 11.1096C17.811 11.1096 18.2288 10.6856 18.2288 10.1618L18.4851 5.58296C18.4851 4.91543 17.9526 4.375 17.2949 4.375C16.6372 4.375 16.1035 4.91543 16.1035 5.58296L16.361 10.1618C16.361 10.6856 16.7788 11.1096 17.2949 11.1096Z\" fill=\"currentColor\"></path>                                <path d=\"M21.8293 13.8853C21.6689 13.5955 21.4173 13.3638 21.1201 13.2356C20.9141 13.1536 20.2961 13.0265 20.2856 13.0265C19.6103 12.8982 18.5126 12.8293 17.3001 12.8293C16.145 12.8293 15.0929 12.8982 14.4071 13.0028C14.3954 13.0146 13.63 13.1429 13.3666 13.2819C12.8856 13.5373 12.5884 14.0361 12.5884 14.5706V14.6169C12.6001 14.9649 12.8973 15.6954 12.909 15.6954C13.4123 16.9259 14.9782 19.3525 16.0198 20.3265C16.0198 20.3265 16.2878 20.6021 16.454 20.7208C16.6939 20.9073 16.9911 21 17.2896 21C17.6208 21 17.9286 20.8954 18.1814 20.6983C18.227 20.652 18.4213 20.4774 18.5816 20.3158C19.5869 19.3632 21.2347 16.8796 21.7368 15.5802C21.8176 15.383 21.9896 14.883 22.0001 14.6169C22.0001 14.3616 21.944 14.1169 21.8293 13.8853Z\" fill=\"currentColor\"></path>                                </svg>                            ', 'Titulo', 5, 'Titulo de mantenimiento ', NULL),
(11, 'Rifas', '/panel/adm/rifas', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\r\n                                            <g>\r\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\r\n                                            </g>\r\n                                        </svg>', 'subMenu', 2, '', 1),
(12, 'Talento', '/panel/adm/talento', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 1, '', 1),
(13, 'Ventas', '/panel/adm/ventas', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 3, '', 1),
(21, 'RegistrosAs', '/panel/asig/registros', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 2, '', 2),
(22, 'Historial', '/panel/asig/hsAsistencia', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 3, 'Historial de la asistencia de cada uno de los hermanos', 2),
(23, 'Mi Asistencia', '/panel/asig/Miasistencia', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\r\n                                            <g>\r\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\r\n                                            </g>\r\n                                        </svg>', 'subMenu', 1, 'En esta vista se muestra mi asistencia', 2),
(31, 'Historial', '/panel/ahorro/hitorial', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 3, 'Historial de el ahorro que sea ido entregando por cada hermano', 3),
(32, 'Registrar', '/panel/ahorro/RgAhorro', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\r\n                                            <g>\r\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\r\n                                            </g>\r\n                                        </svg>', 'subMenu', 2, 'Aqui se regitra el ahorro de cada hermano', 3),
(33, 'Mi Ahorro', '/panel/ahorro/MiAhorro', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\r\n                                            <g>\r\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\r\n                                            </g>\r\n                                        </svg>', 'subMenu', 1, 'Esta vista muestra el registro de todos los tipo de ahorro que tiene el hermano', 3),
(41, 'Registrar', '/panel/privilegios/Rg', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 2, 'Registrar previlegios del sabado', 4),
(42, 'Historial', '/panel/privilegios/hs', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 3, 'Historial de previlegios dados en los sabados ', 4),
(43, 'Previlegio Actuales', '/panel/privilegios/sabado', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\r\n                                            <g>\r\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\r\n                                            </g>\r\n                                        </svg>', 'subMenu', 1, 'En esta vista se van a mostrar los previlegios actuales', 4),
(51, 'Usuarios', '/panel/mantenimiento/usuarios', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 3, 'Aqui se ministran los usuarios para bloquearlo o activarlos y ver toda la informacion del hermano', 5),
(52, 'Tipos Entradas', '/panel/mantenimiento/TipoEntrada', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 1, 'Aqui se administran los tipos de entradas', 5);

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
(2, 'DESACTIVO', '2024-04-08 21:08:51', NULL, 1, NULL),
(3, 'CERRADO', '2024-05-11 02:29:19', NULL, 1, NULL);

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
  `comentario` text NOT NULL DEFAULT 'S/N',
  `id_realizada_por` int(11) NOT NULL,
  `id_tipo_transacion` int(11) NOT NULL,
  `id_tipo_entrada` int(11) NOT NULL,
  `id_directiva` int(11) NOT NULL,
  `fecha_transacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  MODIFY `id_hermano` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id_datos_personales` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `directiva`
--
ALTER TABLE `directiva`
  MODIFY `id_directiva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `directivos`
--
ALTER TABLE `directivos`
  MODIFY `id_directivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `iglesia`
--
ALTER TABLE `iglesia`
  MODIFY `id_iglesia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos_user`
--
ALTER TABLE `permisos_user`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_transacciones` int(11) NOT NULL AUTO_INCREMENT;

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
