CREATE DATABASE `app_nco` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
CREATE DATABASE `debug_kit` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE debug_kit;
CREATE TABLE debug_kit.panels (
  `id` char(36) NOT NULL,
  `request_id` char(36) NOT NULL,
  `panel` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `element` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `content` longblob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_panel` (`request_id`,`panel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

USE app_nco;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `password` varchar(255) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `es_admin` tinyint(1) DEFAULT '0',
  `alta` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `eliminado` datetime DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `caducidad_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE  app_nco.`citas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `nota_profesional` varchar(255) DEFAULT NULL,
  `nota_paciente` varchar(255) DEFAULT NULL,
  `usuario_id` int NOT NULL,
  `calendario_id` int DEFAULT NULL,
  `alta` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_id_calend_idx` (`calendario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;

CREATE TABLE  app_nco.`calendarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fecha_UNIQUE` (`fecha`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb3;


ALTER TABLE `app_nco`.`usuarios` 
ADD COLUMN `reset_token` VARCHAR(255) NULL DEFAULT NULL AFTER `eliminado`,
ADD COLUMN `caducidad_token` DATETIME NULL DEFAULT NULL AFTER `reset_token`;
