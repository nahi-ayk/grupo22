-- MySQL dump 10.13  Distrib 9.5.0, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ecommerce_grupo22
-- ------------------------------------------------------
-- Server version	12.2.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Primera Infancia','Juguetes seguros y coloridos diseñados para estimular los sentidos, la motricidad y la curiosidad de tu bebé en sus primeros años. ¡Acompañá su crecimiento jugando!',1,'2026-05-29 19:11:29','2026-05-29 19:11:29',NULL,'img/catInicio/catPrimInf.jpg'),(2,'Juegos De Mesa','Diversión para todas las edades. Descubrí juegos de mesa de ingenio, estrategia y azar perfectos para compartir momentos inolvidables en familia o con amigos. ¡Que empiece la partida!',1,'2026-05-29 19:15:15','2026-05-29 19:15:15',NULL,'img/catInicio/catJuegosMesa.jpg'),(3,'Construccion','¡Imaginá, armá y transformá! Bloques y sets de construcción para todas las edades. El juego perfecto para potenciar la creatividad, la lógica y crear mundos sin límites pieza por pieza.',1,'2026-05-30 00:14:36','2026-05-30 00:14:36',NULL,'img/catInicio/catConstruccion.jpg'),(4,'Muñecas','Las mejores compañeras para crear historias inolvidables. Descubrí muñecas, accesorios y bebés interactivos que estimulan la empatía, el juego de rol y la imaginación de los más chicos.',1,'2026-05-30 00:17:23','2026-05-30 00:17:23',NULL,'img/catInicio/catMuñecas.jpg'),(5,'Vehiculos','¡A toda velocidad! Descubrí autitos, camiones, pistas de carreras y vehículos a radiocontrol para vivir aventuras llenas de acción. El juego perfecto para estimular la coordinación y la destreza.',1,'2026-05-30 00:21:43','2026-05-30 00:21:43',NULL,'img/catInicio/catVehiculos.jpg'),(6,'Peluches','Abrazos que acompañan siempre. Descubrí peluches súper suaves, tiernos y seguros, ideales para convertirse en los mejores amigos de los más chicos y los compañeros perfectos para la hora de dormir.',1,'2026-05-30 00:43:39','2026-05-30 00:43:39',NULL,'img/catInicio/catPeluches.jpg'),(7,'Figuras De Coleccion','Llevá tu pasión a la repisa. Descubrí figuras de acción y de colección de tus películas, series, anime y videojuegos favoritos con detalles increíbles. ¡El tesoro que le falta a tu colección!',1,'2026-05-30 00:46:21','2026-05-30 00:46:21',NULL,'img/catInicio/catFigus.jpg'),(8,'Juguetes De Accion','¡Preparate para la acción! Lanzadores, pistolas de dardos y accesorios para jugar al aire libre. Diseños seguros y divertidos ideales para armar estrategias, desafiar a tus amigos y vivir la adrenalina.',1,'2026-05-30 00:48:24','2026-05-30 00:48:24',NULL,'img/catInicio/catLanzadores.jpg');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `contestado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` VALUES (1,'Juan Carlos','juanCarlitos@gmail.com','Disponibilidad de producto','Buenos dias, hace poco vi un producto en la página pero hoy ya no lo pude encontrar, se debe a que ya no lo tienen en stock? gracias',0,'2026-06-16 14:21:14','2026-06-16 14:21:14',NULL),(2,'Tobias Agustin','tobias@gmail.com','Producto Lego','Hola buenas noches, vi un producto de lego que me intereso en la pagina y queria saber si traeran mas modelos de la misma marca.',0,'2026-06-17 04:35:31','2026-06-17 04:35:31',NULL),(3,'Juan Alberto','juanAlberto32@gmail.com','Apertura en feriados','Hola,  ¿abren los dias feriados o tienen horario reducido?',0,'2026-06-17 04:37:10','2026-06-17 04:37:10',NULL),(4,'Juana Guadalupe','juanaguada@gmail.com','Figuras de colección','Hola, ¿traeran mas figuras de colección de tipo anime?',0,'2026-06-17 04:38:25','2026-06-17 04:38:25',NULL),(5,'Maria Florencia','mariaflor@gmail.com','Juguetes para niños','Buenas noches, ¿traeran mas juguetes didacticos para niños?',0,'2026-06-17 04:43:05','2026-06-17 04:43:05',NULL),(6,'Juan Ignacio','juanigna@gmail.com','Juegos de cartas','Sumaria mucho al local que trajeran juegos de cartas como UNO',0,'2026-06-17 04:46:02','2026-06-17 04:46:02',NULL),(7,'Pedro Francisco','franciscopedro@gmail.com','Juego de damas','¿Traeran juegos como damas, o parecidos?',0,'2026-06-17 04:47:29','2026-06-17 04:47:29',NULL),(8,'Pedro Agustin','pedroag@gmail.com','Lego','¿Tienen la nueva linea de juguetes Lego?',0,'2026-06-17 07:01:05','2026-06-17 07:01:05',NULL),(9,'Marcos Luis','marcosluis@gmail.com','Juegos didacticos','¿Cuando traeran nuevos juegos didacticos para niños ?',1,'2026-06-17 07:02:06','2026-06-17 07:03:44',NULL);
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_pedidos`
--

DROP TABLE IF EXISTS `detalle_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_pedidos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_pedidos_pedido_id_foreign` (`pedido_id`),
  KEY `detalle_pedidos_producto_id_foreign` (`producto_id`),
  CONSTRAINT `detalle_pedidos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detalle_pedidos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedidos`
--

LOCK TABLES `detalle_pedidos` WRITE;
/*!40000 ALTER TABLE `detalle_pedidos` DISABLE KEYS */;
INSERT INTO `detalle_pedidos` VALUES (1,1,1,2,8000.00,16000.00,'2026-06-10 16:06:53','2026-06-10 16:06:53',NULL),(2,1,8,1,235000.00,235000.00,'2026-06-10 16:08:44','2026-06-10 16:08:44',NULL),(3,2,15,1,23000.00,23000.00,'2026-06-10 16:10:54','2026-06-10 16:10:54',NULL),(4,3,2,1,7500.00,7500.00,'2026-06-10 19:27:47','2026-06-10 19:33:18','2026-06-10 19:33:18'),(5,3,14,1,21000.00,21000.00,'2026-06-13 21:09:03','2026-06-13 21:09:03',NULL),(6,3,12,1,18000.00,18000.00,'2026-06-13 21:09:10','2026-06-13 21:09:10',NULL),(7,4,10,1,105000.00,105000.00,'2026-06-13 21:24:51','2026-06-13 21:24:51',NULL),(8,4,2,1,7500.00,7500.00,'2026-06-13 21:25:00','2026-06-13 21:25:00',NULL),(9,5,16,1,65000.00,65000.00,'2026-06-15 19:30:20','2026-06-15 19:30:20',NULL),(10,6,2,1,7500.00,7500.00,'2026-06-15 19:54:59','2026-06-15 20:30:33','2026-06-15 20:30:33'),(11,6,3,1,7300.00,7300.00,'2026-06-15 20:32:29','2026-06-15 20:37:14','2026-06-15 20:37:14'),(12,6,2,2,7500.00,15000.00,'2026-06-15 20:39:04','2026-06-15 20:39:04',NULL),(13,7,3,2,7300.00,14600.00,'2026-06-17 05:02:11','2026-06-17 05:07:24','2026-06-17 05:07:24'),(14,7,15,2,23000.00,46000.00,'2026-06-17 05:03:28','2026-06-17 05:07:24','2026-06-17 05:07:24'),(15,7,14,1,21000.00,21000.00,'2026-06-17 05:03:34','2026-06-17 05:07:07','2026-06-17 05:07:07'),(16,7,13,1,23000.00,23000.00,'2026-06-17 05:07:40','2026-06-17 05:07:40',NULL),(17,7,18,1,13000.00,13000.00,'2026-06-17 05:07:47','2026-06-17 05:07:47',NULL),(18,8,18,1,13000.00,13000.00,'2026-06-17 05:26:13','2026-06-17 05:26:13',NULL),(19,9,3,2,7300.00,14600.00,'2026-06-17 05:27:05','2026-06-17 05:27:05',NULL);
/*!40000 ALTER TABLE `detalle_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direcciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `direccion` varchar(255) NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `codigo_postal` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direcciones`
--

LOCK TABLES `direcciones` WRITE;
/*!40000 ALTER TABLE `direcciones` DISABLE KEYS */;
INSERT INTO `direcciones` VALUES (1,'Calle Turin 2938','Corrientes','Corrientes','3400','2026-06-17 03:34:31','2026-06-17 03:34:31',NULL),(2,'Nicaragua 278','Resistencia','Chaco','3500','2026-06-17 05:09:12','2026-06-17 05:09:12',NULL);
/*!40000 ALTER TABLE `direcciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `envios`
--

DROP TABLE IF EXISTS `envios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `envios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint(20) unsigned NOT NULL,
  `direccion_id` bigint(20) unsigned DEFAULT NULL,
  `tarifa_envio_id` bigint(20) unsigned DEFAULT NULL,
  `costo_envio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado_envio` varchar(255) NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `envios_pedido_id_foreign` (`pedido_id`),
  KEY `envios_tarifa_envio_id_foreign` (`tarifa_envio_id`),
  KEY `envios_direccion_id_foreign` (`direccion_id`),
  CONSTRAINT `envios_direccion_id_foreign` FOREIGN KEY (`direccion_id`) REFERENCES `direcciones` (`id`),
  CONSTRAINT `envios_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `envios_tarifa_envio_id_foreign` FOREIGN KEY (`tarifa_envio_id`) REFERENCES `tarifas_envios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `envios`
--

LOCK TABLES `envios` WRITE;
/*!40000 ALTER TABLE `envios` DISABLE KEYS */;
INSERT INTO `envios` VALUES (1,5,1,1,3500.00,'preparacion','2026-06-15 19:31:25','2026-06-15 19:31:25',NULL),(2,7,2,2,9000.00,'preparacion','2026-06-17 05:09:12','2026-06-17 05:09:12',NULL),(3,8,2,2,9000.00,'preparacion','2026-06-17 05:26:27','2026-06-17 05:26:27',NULL);
/*!40000 ALTER TABLE `envios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favoritos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `favoritos_usuario_id_producto_id_unique` (`usuario_id`,`producto_id`),
  KEY `favoritos_producto_id_foreign` (`producto_id`),
  CONSTRAINT `favoritos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favoritos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoritos`
--

LOCK TABLES `favoritos` WRITE;
/*!40000 ALTER TABLE `favoritos` DISABLE KEYS */;
INSERT INTO `favoritos` VALUES (4,1,1,NULL,NULL),(5,1,8,NULL,NULL),(6,3,4,NULL,NULL),(7,4,20,NULL,NULL),(8,4,3,NULL,NULL);
/*!40000 ALTER TABLE `favoritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_logins`
--

DROP TABLE IF EXISTS `historial_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_logins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `fecha_login` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `historial_logins_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `historial_logins_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_logins`
--

LOCK TABLES `historial_logins` WRITE;
/*!40000 ALTER TABLE `historial_logins` DISABLE KEYS */;
INSERT INTO `historial_logins` VALUES (1,1,'2026-05-27 22:06:05','2026-05-27 22:06:05','2026-05-27 22:06:05'),(2,2,'2026-05-27 22:07:01','2026-05-27 22:07:01','2026-05-27 22:07:01'),(3,3,'2026-05-27 22:26:43','2026-05-27 22:26:43','2026-05-27 22:26:43'),(4,2,'2026-05-27 22:27:03','2026-05-27 22:27:03','2026-05-27 22:27:03'),(5,2,'2026-05-28 01:47:33','2026-05-28 01:47:33','2026-05-28 01:47:33'),(6,2,'2026-05-28 19:21:50','2026-05-28 19:21:50','2026-05-28 19:21:50'),(7,1,'2026-05-29 02:45:16','2026-05-29 02:45:16','2026-05-29 02:45:16'),(8,2,'2026-05-29 02:45:36','2026-05-29 02:45:36','2026-05-29 02:45:36'),(9,2,'2026-05-29 18:28:28','2026-05-29 18:28:28','2026-05-29 18:28:28'),(10,1,'2026-05-30 00:05:34','2026-05-30 00:05:34','2026-05-30 00:05:34'),(11,3,'2026-05-30 00:05:52','2026-05-30 00:05:52','2026-05-30 00:05:52'),(12,2,'2026-05-30 00:06:09','2026-05-30 00:06:09','2026-05-30 00:06:09'),(13,1,'2026-05-30 01:56:45','2026-05-30 01:56:45','2026-05-30 01:56:45'),(14,2,'2026-05-30 01:57:14','2026-05-30 01:57:14','2026-05-30 01:57:14'),(15,1,'2026-05-30 17:51:58','2026-05-30 17:51:58','2026-05-30 17:51:58'),(16,1,'2026-05-30 18:17:20','2026-05-30 18:17:20','2026-05-30 18:17:20'),(17,1,'2026-06-03 17:49:23','2026-06-03 17:49:23','2026-06-03 17:49:23'),(18,2,'2026-06-03 17:55:30','2026-06-03 17:55:30','2026-06-03 17:55:30'),(19,2,'2026-06-05 14:37:07','2026-06-05 14:37:07','2026-06-05 14:37:07'),(20,2,'2026-06-05 18:12:41','2026-06-05 18:12:41','2026-06-05 18:12:41'),(21,2,'2026-06-05 18:14:30','2026-06-05 18:14:30','2026-06-05 18:14:30'),(22,3,'2026-06-06 00:24:23','2026-06-06 00:24:23','2026-06-06 00:24:23'),(23,3,'2026-06-06 03:24:53','2026-06-06 03:24:53','2026-06-06 03:24:53'),(24,2,'2026-06-06 03:35:57','2026-06-06 03:35:57','2026-06-06 03:35:57'),(25,3,'2026-06-06 04:46:40','2026-06-06 04:46:40','2026-06-06 04:46:40'),(26,2,'2026-06-07 14:51:44','2026-06-07 14:51:44','2026-06-07 14:51:44'),(27,3,'2026-06-07 17:05:23','2026-06-07 17:05:23','2026-06-07 17:05:23'),(28,2,'2026-06-07 17:34:47','2026-06-07 17:34:47','2026-06-07 17:34:47'),(29,1,'2026-06-07 17:35:22','2026-06-07 17:35:22','2026-06-07 17:35:22'),(30,4,'2026-06-08 02:36:57','2026-06-08 02:36:57','2026-06-08 02:36:57'),(31,2,'2026-06-08 02:39:51','2026-06-08 02:39:51','2026-06-08 02:39:51'),(32,4,'2026-06-08 03:30:18','2026-06-08 03:30:18','2026-06-08 03:30:18'),(33,2,'2026-06-08 04:02:13','2026-06-08 04:02:13','2026-06-08 04:02:13'),(34,4,'2026-06-08 04:04:41','2026-06-08 04:04:41','2026-06-08 04:04:41'),(35,2,'2026-06-08 04:06:59','2026-06-08 04:06:59','2026-06-08 04:06:59'),(36,4,'2026-06-08 04:16:03','2026-06-08 04:16:03','2026-06-08 04:16:03'),(37,2,'2026-06-08 04:30:53','2026-06-08 04:30:53','2026-06-08 04:30:53'),(38,4,'2026-06-08 04:34:07','2026-06-08 04:34:07','2026-06-08 04:34:07'),(39,2,'2026-06-08 04:36:41','2026-06-08 04:36:41','2026-06-08 04:36:41'),(40,4,'2026-06-08 05:03:14','2026-06-08 05:03:14','2026-06-08 05:03:14'),(41,3,'2026-06-08 14:19:29','2026-06-08 14:19:29','2026-06-08 14:19:29'),(42,4,'2026-06-09 01:22:51','2026-06-09 01:22:51','2026-06-09 01:22:51'),(43,2,'2026-06-09 13:48:24','2026-06-09 13:48:24','2026-06-09 13:48:24'),(44,3,'2026-06-09 14:46:17','2026-06-09 14:46:17','2026-06-09 14:46:17'),(45,2,'2026-06-09 14:59:48','2026-06-09 14:59:48','2026-06-09 14:59:48'),(46,4,'2026-06-09 15:01:27','2026-06-09 15:01:27','2026-06-09 15:01:27'),(47,2,'2026-06-09 15:02:06','2026-06-09 15:02:06','2026-06-09 15:02:06'),(48,4,'2026-06-09 15:17:14','2026-06-09 15:17:14','2026-06-09 15:17:14'),(49,2,'2026-06-09 15:30:26','2026-06-09 15:30:26','2026-06-09 15:30:26'),(50,4,'2026-06-09 15:33:25','2026-06-09 15:33:25','2026-06-09 15:33:25'),(51,2,'2026-06-09 15:40:10','2026-06-09 15:40:10','2026-06-09 15:40:10'),(52,4,'2026-06-09 15:42:14','2026-06-09 15:42:14','2026-06-09 15:42:14'),(53,2,'2026-06-09 16:29:01','2026-06-09 16:29:01','2026-06-09 16:29:01'),(54,3,'2026-06-09 16:37:10','2026-06-09 16:37:10','2026-06-09 16:37:10'),(55,2,'2026-06-09 16:45:38','2026-06-09 16:45:38','2026-06-09 16:45:38'),(56,1,'2026-06-10 16:06:39','2026-06-10 16:06:39','2026-06-10 16:06:39'),(57,2,'2026-06-10 16:34:14','2026-06-10 16:34:14','2026-06-10 16:34:14'),(58,1,'2026-06-10 18:03:29','2026-06-10 18:03:29','2026-06-10 18:03:29'),(59,2,'2026-06-10 19:29:59','2026-06-10 19:29:59','2026-06-10 19:29:59'),(60,1,'2026-06-10 19:33:12','2026-06-10 19:33:12','2026-06-10 19:33:12'),(61,2,'2026-06-10 19:33:36','2026-06-10 19:33:36','2026-06-10 19:33:36'),(62,1,'2026-06-13 21:08:29','2026-06-13 21:08:29','2026-06-13 21:08:29'),(63,3,'2026-06-13 21:24:00','2026-06-13 21:24:00','2026-06-13 21:24:00'),(64,1,'2026-06-14 16:27:55','2026-06-14 16:27:55','2026-06-14 16:27:55'),(65,1,'2026-06-14 20:06:27','2026-06-14 20:06:27','2026-06-14 20:06:27'),(66,1,'2026-06-15 17:30:49','2026-06-15 17:30:49','2026-06-15 17:30:49'),(67,3,'2026-06-15 19:29:51','2026-06-15 19:29:51','2026-06-15 19:29:51'),(68,1,'2026-06-15 23:14:25','2026-06-15 23:14:25','2026-06-15 23:14:25'),(69,2,'2026-06-15 23:36:11','2026-06-15 23:36:11','2026-06-15 23:36:11'),(70,2,'2026-06-16 11:29:56','2026-06-16 11:29:56','2026-06-16 11:29:56'),(71,1,'2026-06-16 14:19:17','2026-06-16 14:19:17','2026-06-16 14:19:17'),(72,2,'2026-06-16 14:21:32','2026-06-16 14:21:32','2026-06-16 14:21:32'),(73,2,'2026-06-17 02:15:16','2026-06-17 02:15:16','2026-06-17 02:15:16'),(74,3,'2026-06-17 03:22:42','2026-06-17 03:22:42','2026-06-17 03:22:42'),(75,3,'2026-06-17 03:55:11','2026-06-17 03:55:11','2026-06-17 03:55:11'),(76,1,'2026-06-17 03:55:38','2026-06-17 03:55:38','2026-06-17 03:55:38'),(77,2,'2026-06-17 04:14:46','2026-06-17 04:14:46','2026-06-17 04:14:46'),(78,2,'2026-06-17 04:30:29','2026-06-17 04:30:29','2026-06-17 04:30:29'),(79,4,'2026-06-17 04:32:22','2026-06-17 04:32:22','2026-06-17 04:32:22'),(80,2,'2026-06-17 04:48:07','2026-06-17 04:48:07','2026-06-17 04:48:07'),(81,2,'2026-06-17 04:55:06','2026-06-17 04:55:06','2026-06-17 04:55:06'),(82,4,'2026-06-17 04:58:03','2026-06-17 04:58:03','2026-06-17 04:58:03'),(83,2,'2026-06-17 05:28:46','2026-06-17 05:28:46','2026-06-17 05:28:46'),(85,2,'2026-06-17 05:49:39','2026-06-17 05:49:39','2026-06-17 05:49:39'),(86,3,'2026-06-17 06:03:30','2026-06-17 06:03:30','2026-06-17 06:03:30'),(87,3,'2026-06-17 06:04:56','2026-06-17 06:04:56','2026-06-17 06:04:56'),(88,2,'2026-06-17 06:08:58','2026-06-17 06:08:58','2026-06-17 06:08:58'),(89,3,'2026-06-17 06:20:02','2026-06-17 06:20:02','2026-06-17 06:20:02'),(90,2,'2026-06-17 06:20:27','2026-06-17 06:20:27','2026-06-17 06:20:27'),(91,3,'2026-06-17 06:21:59','2026-06-17 06:21:59','2026-06-17 06:21:59'),(92,2,'2026-06-17 07:02:17','2026-06-17 07:02:17','2026-06-17 07:02:17'),(93,2,'2026-06-17 07:07:53','2026-06-17 07:07:53','2026-06-17 07:07:53');
/*!40000 ALTER TABLE `historial_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodos_pago`
--

DROP TABLE IF EXISTS `metodos_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metodos_pago` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodos_pago`
--

LOCK TABLES `metodos_pago` WRITE;
/*!40000 ALTER TABLE `metodos_pago` DISABLE KEYS */;
INSERT INTO `metodos_pago` VALUES (1,'Tarjeta de Crédito','2026-06-06 05:18:18','2026-06-06 05:18:18',NULL),(2,'Tarjeta de Débito','2026-06-06 05:18:18','2026-06-06 05:18:18',NULL),(3,'Transferencia Bancaria','2026-06-06 05:18:18','2026-06-06 05:18:18',NULL),(4,'Efectivo al retirar','2026-06-06 05:18:18','2026-06-06 05:18:18',NULL);
/*!40000 ALTER TABLE `metodos_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_05_14_203848_create_categorias_table',1),(5,'2026_05_14_220900_create_roles_table',1),(6,'2026_05_14_220910_create_usuarios_table',1),(7,'2026_05_15_181507_create_productos_table',1),(8,'2026_05_23_235643_add_dni_to_usuarios_table',1),(9,'2026_05_25_210000_create_pedidos_table',1),(10,'2026_05_25_215208_create_envios_table',1),(11,'2026_05_25_223055_create_pedido_detalles_table',1),(12,'2026_05_25_230326_create_consultas_table',1),(14,'2026_05_27_155058_add_ultimo_login_to_usuarios_table',2),(16,'2026_05_27_182942_create_historial_logins_table',3),(17,'2026_05_29_003739_add_imagen_to_productos_table',4),(19,'2026_05_30_143353_create_favoritos_table',5),(20,'2026_05_30_202146_add_provincia_to_envios_table',6),(21,'2026_05_30_203633_create_metodos_pago_table',6),(22,'2026_05_30_215718_add_fields_to_pedidos_table',6),(23,'2026_06_01_013331_alter_default_in_pedidos_table',6),(24,'2026_06_09_105424_add_asunto_to_consultas_table',7),(25,'2026_06_10_135331_add_imagen_to_categorias_table',8),(26,'2026_06_15_021240_create_direcciones_table',9),(27,'2026_06_15_022243_add_direccion_id_to_usuarios_table',9),(28,'2026_06_15_035421_create_tarifa_envios_table',9),(29,'2026_06_15_035725_add_tarifa_envio_id_to_envios_table',9),(30,'2026_06_16_135223_modificar_columnas_en_envios_table',10),(31,'2026_06_16_140103_agregar_softdeletes_a_direcciones_table',10),(32,'2026_06_16_143600_eliminar_usuario_id_de_direcciones_table',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `numero_pedido` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'carrito',
  `usuario_id` bigint(20) unsigned NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `metodo_pago_id` bigint(20) unsigned DEFAULT NULL,
  `fecha_venta` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pedidos_numero_pedido_unique` (`numero_pedido`),
  KEY `pedidos_usuario_id_foreign` (`usuario_id`),
  KEY `pedidos_metodo_pago_id_foreign` (`metodo_pago_id`),
  CONSTRAINT `pedidos_metodo_pago_id_foreign` FOREIGN KEY (`metodo_pago_id`) REFERENCES `metodos_pago` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pedidos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,'PED-171621','confirmado',1,251000.00,251000.00,'2026-06-10 16:06:53','2026-06-10 16:08:59',NULL,4,'2026-06-10 16:08:59'),(2,'PED-512355','confirmado',1,23000.00,23000.00,'2026-06-10 16:10:38','2026-06-10 16:12:06',NULL,2,'2026-06-10 16:12:06'),(3,'PED-678327','carrito',1,0.00,39000.00,'2026-06-10 16:33:41','2026-06-13 21:09:10',NULL,NULL,NULL),(4,'PED-612269','confirmado',3,112500.00,112500.00,'2026-06-13 21:24:51','2026-06-13 21:26:09',NULL,2,'2026-06-13 21:26:09'),(5,'PED-121565','confirmado',3,65000.00,68500.00,'2026-06-15 19:30:20','2026-06-15 19:31:25',NULL,2,'2026-06-15 19:31:25'),(6,'PED-645447','carrito',3,0.00,15000.00,'2026-06-15 19:54:36','2026-06-15 20:39:04',NULL,NULL,NULL),(7,'PED-907020','confirmado',4,36000.00,45000.00,'2026-06-17 04:58:13','2026-06-17 05:09:12',NULL,1,'2026-06-17 05:09:12'),(8,'PED-423831','pendiente_pago',4,13000.00,22000.00,'2026-06-17 05:10:14','2026-06-17 05:26:27',NULL,3,'2026-06-17 05:26:27'),(9,'PED-786440','confirmado',4,14600.00,14600.00,'2026-06-17 05:27:05','2026-06-17 05:27:42',NULL,2,'2026-06-17 05:27:42');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `stock_actual` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `categoria_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Barquito Salvavidas Mi Primera Infancia Duravit','¡Al agua, barquito! Un juguete flotante y seguro para la hora del baño, ideal para estimular la motricidad fina y la imaginación de tu bebé en sus primeros chapuzones.\r\n\r\nCaracteristicas:\r\n-Libre de toxicos\r\n-Material: Plástico\r\n-Medidas: 40 cm largo x 18 cm ancho aproximadamente\r\n-Edad Recomendada: + 3 años',8000.00,14,3,1,1,'2026-05-30 01:20:42','2026-06-10 16:08:59',NULL,'img/catalogo/1780104042_prim-inf-barco.jpg'),(2,'Juego De Encastre Duravit Torre De Anillos Apilables','¡Aprender jugando es mas divertido! Apilá los coloridos anillos en la torre y descubri tamaños, colores y formas mientras desarrollás la coordinación y la motricidad de una manera entretenida. Ideal para los mas pequeños de la casa.\r\n\r\nCaracteristicas: \r\n-Libre de toxicos\r\n-Material: Plástico\r\n-Medidas: 15 cm alto x 15 cm largo x 25 cm ancho aproximadamente\r\n-Edad Recomendada: + 1 año',7500.00,14,3,1,1,'2026-06-03 18:09:07','2026-06-13 21:26:09',NULL,'img/catalogo/1780510147_prim-inf-torre-anillos.jpg'),(3,'Tren Locomotora Sonido Didactico Duravit','¡Todos a bordo! Esta divertida locomotora con sonido hará volar la imaginación de los más pequeños. Dale cuerda y disfrutá de sus efectos de sonido mientras vivís emocionantes aventuras sobre rieles. Ideal para horas de juego y diversión.\r\n\r\nCaracterísticas:\r\n-Libre de toxicos\r\n-Material: Plástico\r\n-Medidas: 20 Cm Largo x 12 Cm ancho x 14 Cm Alto\r\n-Edad recomendada: + 1 año',7300.00,8,3,1,1,'2026-06-03 18:28:55','2026-06-17 05:27:42',NULL,'img/catalogo/1780511335_prim-inf-locomotora.jpg'),(4,'Juego Ajedrez Línea Azul Ruibal','Poné a prueba tu estrategia y concentración con este clásico juego de ajedrez. Ideal para compartir en familia o con amigos, desarrollando el pensamiento lógico, la planificación y la toma de decisiones mientras te divertís. ¡Cada partida es un nuevo desafío!\r\n\r\nCaracteristicas: \r\n-Material: Plástico\r\n-Medidas del Tablero: 24,5 cm x 24,5 cm \r\n-Cantidad de jugadores: 2\r\n-Edad Recomendada: + 5 años',19000.00,10,3,1,2,'2026-06-03 18:44:53','2026-06-03 18:44:53',NULL,'img/catalogo/1780512293_jm-ajedrez-plastico.jpg'),(5,'Bingo Familiar Loteria Con Bolillero Ruibal','¡La diversión está en cada bolilla! Disfrutá de emocionantes partidas de lotería con familiares y amigos. Su práctico bolillero hace que el juego sea mas dinámico y entretenido, ideal para compartir momentos llenos de emoción y diversión\r\n\r\nCaracterísticas:\r\n-Material: Plástico\r\n-Cantidad de jugadores: + 2 \r\n-Edad recomendada: + 6 años',63500.00,8,3,1,2,'2026-06-03 19:03:38','2026-06-03 19:03:38',NULL,'img/catalogo/1780513418_jm-bingo.jpg'),(6,'Ruleta Club Casino Familiar Clasica Ruibal','¡Hacé girar la ruleta y que empiece la emoción! Esta divertida ruleta es perfecta para compartir con amigos y familia, poniendo a prueba la suerte en cada giro. Ideal para animar reuniones y disfrutar de momentos llenos de expectativa y diversión\r\nCaracterísticas: \r\n-Material: Plástico\r\n-Medidas: 28,6 cm largo x 40,8 cm ancho x 6,2 cm alto\r\n-Cantidad de jugadores: + 2 \r\n-Edad recomendada: + 14 años',81200.00,8,3,1,2,'2026-06-03 19:13:57','2026-06-03 19:13:57',NULL,'img/catalogo/1780514037_jm-ruleta.jpg'),(7,'Blocky Balde 200 Piezas','¡Construí sin límites! Con sus 200 piezas de colores, este balde invita a crear torres, casas, vehículos y todo lo que puedas imaginar. Ideal para estimular la creatividad, la coordinación y el juego libre mientras los más pequeños se divierten.\r\nCaracteristicas:\r\n-Material: Plástico\r\n-Edad Recomendada: + 3 años\r\n-Coleccionable',40000.00,10,3,1,3,'2026-06-03 19:35:13','2026-06-03 19:35:13',NULL,'img/catalogo/1780515313_balde-block.jpg'),(8,'Lego City Police Station Chase 172 piezas','¡Convertite en el héroe de la ciudad! Armá tu propia estación de policía y viví emocionantes misiones junto a los oficiales. Un ser ideal para desarrollar la creatividad, la concentración y la imaginación mientras disfrutás de horas de diversión construyendo y jugando.\r\nCaracteristicas:\r\n-Material: Plástico\r\n-Medidas: 26 cm alto x 6 cm ancho x 28 cm largo\r\n-Edad recomendada: + 4 años',235000.00,1,2,1,3,'2026-06-03 19:43:41','2026-06-10 16:08:59',NULL,'img/catalogo/1780515821_lego-est-policia.jpg'),(9,'Muñeca Barbie Baby Doctora Pediatra','¡La doctora favoria del baúl de los juguetes! Barbie Pediatra tiene el super poder de curar llantos en tiempo record, recetar ositos de peluche y convencer a cualquier muñeco de que la vacuna no va a doler. Viene con su estetoscopio y una paciencia infinita. ¡Lista para su ronda médica de 24/7!',93000.00,6,3,1,4,'2026-06-05 18:28:10','2026-06-05 18:28:10',NULL,'img/catalogo/1780684090_barbiePediatra.jpg'),(10,'Barbie Profesiones Maestra Con Bebé','¿Multiplicaciones dificiles? ¿Letra cursiva rebelde? ¡Ningún desafío escolar detiene a Barbie Maestra! Con su pizarra magica y su sonrisa infalible, demuestra todos los días que aprender puede ser la mayor aventura del mundo.',105000.00,4,3,1,4,'2026-06-05 18:34:44','2026-06-13 21:26:09',NULL,'img/catalogo/1780684484_j-barbie-maestra.jpg'),(11,'Hotwheels Pista Stunt Garage Set Parking Mattel','¡Bienvenidos al festival del derrape! Olvídate de los limites de velocidad: aqui se corre a todo o nada. El regallo perfecto para transformar tu salón en un circuito de Fórmula 1 y descubrir que coche es el verdadero rey del asfalto.',140000.00,5,2,1,5,'2026-06-05 18:40:50','2026-06-05 18:40:50',NULL,'img/catalogo/1780684850_j-pista-hw.jpg'),(12,'Auto de Policia De La Ciudad Fricción','¡Manos arriba y pisando el acelerador! El patrullero definitivo para mantener el orden en la alfombra del salón. Perfecto para persecuciones de alta velocidad, derrapes de película y arrestar al dinosaurio que se quiere comer los bloques. ¡La ley y el orden nunca fueron tan rápidos!',18000.00,9,3,1,5,'2026-06-05 18:46:39','2026-06-09 16:38:20',NULL,'img/catalogo/1780685199_j-auto-policia.jpg'),(13,'Camión Bomberos Radio Control Remoto Con Luces Y Marcha Atrás','¡Activa las sirenas y toma el control! Conduce a toda velocidad, despliega la escalera y salva el día con solo tocar un botón. El camión definitivo para los pequeños héroes que aman la adrenalina, el ruido y las misiones de rescate a prueba de choques. ¡La diversión está que arde!',23000.00,9,3,1,5,'2026-06-05 18:52:53','2026-06-17 05:09:12',NULL,'img/catalogo/1780685573_j-cam-bomberos.jpg'),(14,'Osito de Peluche','¡Licenciado experto en abrazos de oso! Este osito ha aprobado con la nota más alta el curso de \"Protección contra monstruos debajo de la cama\". Esponjoso, gordoncho y con orejas perfectas para escuchar todos tus secretos. No come miel, pero es lo más dulce que vas a tener en tu cuarto.',21000.00,10,3,1,6,'2026-06-05 19:05:08','2026-06-05 19:05:08',NULL,'img/catalogo/1780686308_peluche-osito.jpg'),(15,'Peluche de Ranita Kawaii','!Un salto directo a tu corazón¡ La ranita más esponjosa del mundo, lista para acompañarte en tus maratones de pelis o para recordarte que la vida es más linda si te la tomas con calma. Ideal para abrazar fuerte en los dias de lluvia.',23000.00,9,3,1,6,'2026-06-05 19:16:55','2026-06-10 16:12:06',NULL,'img/catalogo/1780687015_ranitaGordita.jpg'),(16,'Funko Pop Iron Man #1421','3000 toneladas de actitud en solo 9 centimetros. Este mini Tony Stark viene con su armadura impecable, propulsores listos y el doble de cabeza para almacenar todo su genio. Ideal para proteger tu escritorio de amenazas intergalácticas o de que alguien te toque los cables.',65000.00,0,2,1,7,'2026-06-05 19:23:27','2026-06-17 06:20:36',NULL,'img/catalogo/1780687407_fig-iron-man.jpg'),(17,'Figura Hatsune Miku con Microfono','¡La reina del J-Pop se muda a tu estantería! Con sus icónicas coletas de color cian desafiando la gravedad y un outfit que derrocha estilo digital. Esta figura de Hatsune Miku no canta a medianoche pero le da un subidón de energia y color a cualquier habitación. ¡Lista para el concierto de tu vida!',150000.00,4,2,1,7,'2026-06-05 19:30:22','2026-06-05 19:30:22',NULL,'img/catalogo/1780687822_hatsuneMiku.jpg'),(18,'Pistola de Agua','¡Puntería, chorrazo y a correr! Olvídate del calor con el juguete oficial de las vacaciones. Con un tanque listo para la acción y un gatillo suave para disparos rápidos. ¡El verano es tuyo, un chorro a la vez!',13000.00,13,4,1,8,'2026-06-05 19:37:23','2026-06-17 05:26:27',NULL,'img/catalogo/1780688243_pistolaAgua.jpg'),(19,'Minecraft Espada De Piedra Mattel','¡Ya no necesitas picar diamantes toda la noche para tener una! Esta réplica pixelada es el arma definitiva para defender tu habitación de los Creepers molestos y los zombies que aparecen cuando se apaga la luz. ¡Lista para tu próxima aventura!',55000.00,8,3,1,8,'2026-06-05 19:42:09','2026-06-05 19:42:09',NULL,'img/catalogo/1780688529_espadaMine.jpg'),(20,'Pistola Revolver Lanza Dardos Zuru X-shot 5761','¡Que no te atrapen desarmado! Ligera, rápida y con una potencia que dejará a todos con la boca abierta. El juguete definitivo para armar batallas campales en el patio, defender tu búnker de mantas y demostrar quién es el verdadero rey de la puntería. ¡Un disparo, una risa asegurada!',30000.00,8,3,1,8,'2026-06-05 19:49:05','2026-06-05 19:49:05',NULL,'img/catalogo/1780688945_j-pistola-dardos.jpg');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrador del sistema','2026-05-27 14:32:17','2026-05-27 14:32:17',NULL),(2,'cliente','Cliente del ecommerce','2026-05-27 14:32:17','2026-05-27 14:32:17',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('SxXQUqlos8TuEBCpCu0DVF7XL8uMoHNvUbnRKvdH',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.28.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','eyJfdG9rZW4iOiJMc2pTQUo4WDVSTDh5Y3g2QnhtWkdvd0xtejE2a1lvbFdzNmFqZEdDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2dydXBvMjIudGVzdFwvP2hlcmQ9cHJldmlldyIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781670547),('ZgZvvZf0QCp0tjhPWv9YhHyMRUuBaVSOKiGZbQ1Z',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJkR2kzbDNzVkdsTEd3MnpFaFQ1a2ZvZ2xOa2VVRlpJN0g2YkNjZGZrIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvZ3J1cG8yMi50ZXN0XC9ub3NvdHJvcyIsInJvdXRlIjpudWxsfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjJ9',1781681146);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarifas_envios`
--

DROP TABLE IF EXISTS `tarifas_envios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tarifas_envios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zona` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarifas_envios`
--

LOCK TABLES `tarifas_envios` WRITE;
/*!40000 ALTER TABLE `tarifas_envios` DISABLE KEYS */;
INSERT INTO `tarifas_envios` VALUES (1,'Local (Corrientes)',3500.00,'2026-06-15 17:20:29','2026-06-15 17:20:29'),(2,'Interprovincial (Resistencia)',9000.00,'2026-06-15 17:20:29','2026-06-15 17:20:29'),(3,'Nacional',18000.00,'2026-06-15 17:20:29','2026-06-15 17:20:29');
/*!40000 ALTER TABLE `tarifas_envios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ultimo_login` timestamp NULL DEFAULT NULL,
  `rol_id` bigint(20) unsigned NOT NULL,
  `direccion_id` bigint(20) unsigned DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`),
  UNIQUE KEY `usuarios_dni_unique` (`dni`),
  KEY `usuarios_rol_id_foreign` (`rol_id`),
  KEY `usuarios_direccion_id_foreign` (`direccion_id`),
  CONSTRAINT `usuarios_direccion_id_foreign` FOREIGN KEY (`direccion_id`) REFERENCES `direcciones` (`id`) ON DELETE SET NULL,
  CONSTRAINT `usuarios_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Nahiara Ayelen','Meza','46923097','mezanahiara07@gmail.com','$2y$12$NYjVgOlvm7KnBa.kx/T6ZeOeNPPpPY5Sp5Hvmde9MQcBJjo6Jis9a','2026-06-17 03:55:38',2,NULL,NULL,'2026-05-27 14:32:18','2026-06-17 03:55:38',NULL),(2,'Tn Toys',' Administrador','00000000','tntoysjugueteria@gmail.com','$2y$12$f/zVW1y.XTTdYxthAooMIuoEIJoFdPLKjyAu23aF.MWrJZI/n5yPC','2026-06-17 07:07:53',1,NULL,NULL,'2026-05-27 14:32:18','2026-06-17 07:07:53',NULL),(3,'Maria','Lopez','42234567','maria@gmail.com','$2y$12$gfD2rZyZqiA3C2e54DqzkuxnO8gc3teex/tIYG11h./fdPhstUE4W','2026-06-17 06:21:59',2,1,NULL,'2026-05-27 14:32:18','2026-06-17 06:21:59',NULL),(4,'Tobias','Sanchez','47223845','tobiasagustin069@gmail.com','$2y$12$28RjiZoqdKMwfHXMwd7Pi.NiGy8sOSSBin45iDpQcXsnuI7MRoQ/y','2026-06-17 04:58:03',2,2,NULL,'2026-05-27 18:19:42','2026-06-17 05:09:12',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ecommerce_grupo22'
--
--
-- WARNING: can't read the INFORMATION_SCHEMA.libraries table. It's most probably an old server 12.2.2-MariaDB.
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-17  4:35:14
