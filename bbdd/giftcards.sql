DROP DATABASE IF EXISTS `giftcards`;
CREATE DATABASE IF NOT EXISTS `giftcards`;

CREATE TABLE IF NOT EXISTS `giftcards`.`aliados` (
  `id_aliado` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(35) NOT NULL,
  `nit` varchar(15) NOT NULL,
  `email` varchar(190) NOT NULL,
  `celular` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `giftcards`.`denuncia_tarjeta` (
  `id_denuncia` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(35) NOT NULL,
  `cedula` varchar(11) NOT NULL,
  `tarjeta_codigo` varchar(8)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `giftcards`.`envio_correo_tar` (
  `id_envio` int(11) NOT NULL AUTO_INCREMENT,
  `email_remitente` varchar(50) NOT NULL,
  `email_destinatario` varchar(50) NOT NULL,
  `asunto` varchar(50) NOT NULL,
  `mensaje` text NOT NULL,
  `tarjeta_id` int(11) NOT NULL,
  PRIMARY KEY (`id_envio`),
  KEY `tarjeta_id` (`tarjeta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `giftcards`.`estrategia` (
  `id_estrategia` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `estrategia` varchar(35) NOT NULL,
  `pedido` text NOT NULL,
  `aliado_id` int(11) NOT NULL,
  `est_estado_id` int(11) DEFAULT NULL,
  KEY `aliado_id` (`aliado_id`),
  KEY `est_estado_id` (`est_estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `giftcards`.`estrategia_estados` (
  `id_estrategia_est` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `estado_est` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `giftcards`.`tarjetas` (
  `id_tarjeta` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `cedula` varchar(11) DEFAULT NULL,
  `codigo` varchar(8) NOT NULL,
  `consecutivo` varchar(3) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_venc` date NOT NULL,
  `fecha_renova` date NOT NULL,
  `estrategia_id` int(11) NOT NULL,
  `tar_estado_id` int(11) NOT NULL,
  `monto_id` int(11) DEFAULT NULL,
  KEY `estrategia_id` (`estrategia_id`),
  KEY `tar_estado_id` (`tar_estado_id`),
  KEY `monto_id` (`monto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `giftcards`.`tarjeta_estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `estado` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `giftcards`.`tarjeta_montos` (
  `id_monto` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `monto` varchar(11) NOT NULL,
  `opcion` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `giftcards`.`envio_correo_tar`
  ADD CONSTRAINT `envio_correo_tar_ibfk_1` FOREIGN KEY (`tarjeta_id`) REFERENCES `tarjetas` (`id_tarjeta`) ON UPDATE CASCADE;

ALTER TABLE `estrategia`
  ADD CONSTRAINT `estrategia_ibfk_1` FOREIGN KEY (`aliado_id`) REFERENCES `aliados` (`id_aliado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estrategia_ibfk_2` FOREIGN KEY (`est_estado_id`) REFERENCES `estrategia_estados` (`id_estrategia_est`) ON UPDATE CASCADE;

ALTER TABLE `giftcards`.`tarjetas`
  ADD CONSTRAINT `tarjetas_ibfk_1` FOREIGN KEY (`estrategia_id`) REFERENCES `estrategia` (`id_estrategia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tarjetas_ibfk_2` FOREIGN KEY (`tar_estado_id`) REFERENCES `tarjeta_estados` (`id_estado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tarjetas_ibfk_3` FOREIGN KEY (`monto_id`) REFERENCES `tarjeta_montos` (`id_monto`) ON UPDATE CASCADE;

INSERT INTO `estrategia_estados` (`id_estrategia_est`, `estado_est`) VALUES
(1, 'INACTIVA'),
(2, 'ACTIVA');

INSERT INTO `tarjeta_estados` (`id_estado`, `estado`) VALUES
(1, 'INACTIVA'),
(2, 'HABILITADA'),
(3, 'VENDIDA'),
(4, 'REDIMIDA'),
(5, 'VENCIDA'),
(6, 'RENOVADA'),
(7, 'DENUNCIADA'),
(8, 'BLOQUEDA'),
(9, 'REHABILITAD');

INSERT INTO `tarjeta_montos` (`id_monto`, `monto`, `opcion`) VALUES
(1, '20000', ''),
(2, '50000', ''),
(3, '70000', ''),
(4, '100000', ''),
(5, '150000', ''),
(6, '200000', ''),
(7, '300000', '');
