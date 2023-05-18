CREATE DATABASE `app_nco` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE cake_cms;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `password` varchar(255) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `es_admin` tinyint(1) DEFAULT '0',
  `eliminado` datetime DEFAULT NULL,
  `alta` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

CREATE TABLE `citas` (
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

CREATE TABLE `calendarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `fecha` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fecha_UNIQUE` (`fecha`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb3;


