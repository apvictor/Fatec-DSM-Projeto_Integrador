-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: doctor_on
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_doctor` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(2) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `units_id` bigint(20) unsigned NOT NULL,
  `specialties_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctors_units_id_foreign` (`units_id`),
  KEY `doctors_specialties_id_foreign` (`specialties_id`),
  CONSTRAINT `doctors_specialties_id_foreign` FOREIGN KEY (`specialties_id`) REFERENCES `specialties` (`id`) ON DELETE CASCADE,
  CONSTRAINT `doctors_units_id_foreign` FOREIGN KEY (`units_id`) REFERENCES `units` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
INSERT INTO `doctors` VALUES (1,'João','','M','https://super.abril.com.br/wp-content/uploads/2019/02/tecnologia-ia-rostos-02.png',1,NULL,NULL,1,1),(2,'Maria','','F','https://e7.pngegg.com/pngimages/972/682/png-clipart-beauty-parlour-face-threading-eyebrow-hair-removal-face-people-head.png',1,NULL,NULL,2,2),(3,'Godofredo','','M','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfSbs5U5oHe8uyamkJIzvaxNLNemdOB6kkgStT1EapaoLIWTg0zPzsX9h5nMUY-IB42Og&usqp=CAU',0,NULL,NULL,2,3),(4,'Gafanhoto','','M','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRn5X1MgmUQcfZb7_rlHjSV0pMB8E1EaQ0i9Zaxrc3yroywpuEaiaHf5E8fJYb0fmYrYRs&usqp=CAU',1,NULL,NULL,3,4),(5,'Vitor','','M','https://super.abril.com.br/wp-content/uploads/2019/02/tecnologia-ia-rostos-01.png',0,NULL,NULL,1,5),(6,'Amanda','','F','https://img.r7.com/images/rosto-humano-irreal-inteligencia-artificial-19022019142838450',1,NULL,NULL,4,3),(7,'Armando','','M','https://media-exp1.licdn.com/dms/image/C4D03AQGO2tlZf7Rg8g/profile-displayphoto-shrink_800_800/0/1621803951876?e=1640217600&v=beta&t=CcIrMKkGtjkhFVsjsj8E9L0Ic8EA2TohdvBFFSuAcsA',1,NULL,NULL,2,1),(8,'Allany','','F','https://img.r7.com/images/rosto-humano-irreal-inteligencia-artificial-19022019142839436',1,NULL,NULL,3,2),(9,'Adriele','','F','https://img.r7.com/images/rosto-humano-irreal-inteligencia-artificial-19022019142837823',1,NULL,NULL,1,4),(10,'Denis','','M','https://tecnoblog.net/wp-content/uploads/2019/02/thispersondoesnotexist.jpg',1,NULL,NULL,2,5),(11,'Joice','','F','https://portalrondon.com.br/wp-content/uploads/2021/02/transferir-2.jpg',1,NULL,NULL,1,4);
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (21,'2021_10_05_212711_create_doctors_table',2),(25,'2014_10_12_000000_create_users_table',3),(26,'2014_10_12_100000_create_password_resets_table',3),(27,'2016_06_01_000001_create_oauth_auth_codes_table',3),(28,'2016_06_01_000002_create_oauth_access_tokens_table',3),(29,'2016_06_01_000003_create_oauth_refresh_tokens_table',3),(30,'2016_06_01_000004_create_oauth_clients_table',3),(31,'2016_06_01_000005_create_oauth_personal_access_clients_table',3),(32,'2021_09_29_130629_create_products_table',3),(33,'2021_10_05_211941_create_units_table',3),(34,'2021_10_05_213128_create_specialties_table',3),(35,'2021_10_05_214615_create_doctors_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('a@g.com','$2y$10$JBbWVWYO703vWs3klnX/pe3FwmV7fPHSeT1PHhNV7SHRNK3T3ufyG','2021-10-13 22:54:59'),('Armandinho14.ap@gmail.com','$2y$10$HabnUfRc8IeYMcR.O/gB8OpJspqk8jQuhBBIR5rFzxLKlO5hEogJ2','2021-10-14 00:25:57');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialties`
--

DROP TABLE IF EXISTS `specialties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialty_used` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialties`
--

LOCK TABLES `specialties` WRITE;
/*!40000 ALTER TABLE `specialties` DISABLE KEYS */;
INSERT INTO `specialties` VALUES (1,'Clínico geral','general_practitioner','https://appdoctoron.s3.sa-east-1.amazonaws.com/general_practitioner.png',NULL,NULL),(2,'Pediatria','pediatrics','https://appdoctoron.s3.sa-east-1.amazonaws.com/pediatrics.png',NULL,NULL),(3,'Cirurgião','surgeon','https://appdoctoron.s3.sa-east-1.amazonaws.com/surgeon.png',NULL,NULL),(4,'Obstetrícia','obstetrics','https://appdoctoron.s3.sa-east-1.amazonaws.com/obstetrics.png',NULL,NULL),(5,'Psiquiatria','psychiatry','https://appdoctoron.s3.sa-east-1.amazonaws.com/psychiatry.png',NULL,NULL),(6,'Todos','all_specialties','https://appdoctoron.s3.sa-east-1.amazonaws.com/all_specialties.png',NULL,NULL);
/*!40000 ALTER TABLE `specialties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `km` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `always_available` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'UBS/AMA Jardim Brasília','','03584-000','Av. Osvaldo Valle Cordeiro','245 ','Jardim Brasilia',NULL,'-23.554631105921676','-46.491997445379035','07:00:00','19:00:00',0,NULL,NULL),(2,'AMA/UBS Integrada Jardim Helena','','08090-370','R. Kumaki Aoki','785','Jardim Helena',NULL,'-23.47921072597422','-46.41963521120692','07:00:00','19:00:00',0,NULL,NULL),(3,'UBS MARINÓPOLIS','11995052373','07172-100','R. Marinopolis','546','Jardim Pres. Dutra',NULL,'-23.420276386173125','-46.42919776108326','07:00:00','17:00:00',0,NULL,NULL),(4,'Hospital Geral de Guarulhos\r\n','','07190-012','Alameda dos Lírios','300','Parque Cecap',NULL,'-23.44807316782676','-46.49515350238121',NULL,NULL,1,NULL,NULL),(5,'Hospital Israelita Albert Einstein','','05652-900','Av. Albert Einstein','627','Jardim Leonor',NULL,'-23.596966906997054','-46.71526219567645',NULL,NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(2) DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `units_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_units_id_foreign` (`units_id`),
  CONSTRAINT `users_units_id_foreign` FOREIGN KEY (`units_id`) REFERENCES `units` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'Armando Pereira','armandinho14.ap@gmail.com',NULL,'$2y$10$meQX7u8xMYPbr.UXkl4hyemmNFXB1bgFIXvHeHD1.bCpzbwTEEqLq',0,NULL,'2021-10-18 22:47:57','2021-10-22 22:42:53',NULL),(5,'amabda','Amanda@gmail.com',NULL,'$2y$10$Vk6NSM1HWQC443znpKLI3O4z6k.pAWHHW9N7C9YVNfRLkRDN9EORO',0,NULL,'2021-10-18 23:44:12','2021-10-18 23:44:12',NULL),(6,'Armando Admin','armando2019ti@gmail.com',NULL,'$2y$10$HXFqut3scr8DXUObLkr6m.Pin1zimmPIAw0uP20lhV6.mvSTO4eJC',1,NULL,'2021-10-18 22:47:57','2021-10-21 22:54:20',1),(7,'Teste Admin','armando2019@gmail.com',NULL,'$2y$10$HXFqut3scr8DXUObLkr6m.Pin1zimmPIAw0uP20lhV6.mvSTO4eJC',1,NULL,'2021-10-18 22:47:57','2021-10-21 22:54:20',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-25 22:01:59
