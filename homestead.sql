-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: homestead
-- ------------------------------------------------------
-- Server version	8.0.32-0ubuntu0.22.04.2

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
-- Table structure for table `class_types`
--

DROP TABLE IF EXISTS `class_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_types`
--

LOCK TABLES `class_types` WRITE;
/*!40000 ALTER TABLE `class_types` DISABLE KEYS */;
INSERT INTO `class_types` VALUES (1,'10','10A',NULL,NULL),(2,'11','11A',NULL,NULL),(3,'12','12A',NULL,NULL);
/*!40000 ALTER TABLE `class_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_records`
--

DROP TABLE IF EXISTS `exam_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exam_records` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `exam_id` int unsigned NOT NULL,
  `student_id` int unsigned NOT NULL,
  `my_class_id` int unsigned NOT NULL,
  `section_id` int unsigned NOT NULL,
  `total` int DEFAULT NULL,
  `ave` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_ave` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pos` int DEFAULT NULL,
  `af` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_records_exam_id_foreign` (`exam_id`),
  KEY `exam_records_my_class_id_foreign` (`my_class_id`),
  KEY `exam_records_student_id_foreign` (`student_id`),
  CONSTRAINT `exam_records_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_records_my_class_id_foreign` FOREIGN KEY (`my_class_id`) REFERENCES `my_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_records_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_records`
--

LOCK TABLES `exam_records` WRITE;
/*!40000 ALTER TABLE `exam_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exams` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term` tinyint NOT NULL,
  `year` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `exams_term_year_unique` (`term`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exams`
--

LOCK TABLES `exams` WRITE;
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marks`
--

DROP TABLE IF EXISTS `marks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marks` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int unsigned NOT NULL,
  `subject_id` int unsigned NOT NULL,
  `my_class_id` int unsigned NOT NULL,
  `section_id` int unsigned NOT NULL,
  `exam_id` int unsigned NOT NULL,
  `t1` int DEFAULT NULL,
  `t2` int DEFAULT NULL,
  `t3` int DEFAULT NULL,
  `t4` int DEFAULT NULL,
  `tca` int DEFAULT NULL,
  `exm` int DEFAULT NULL,
  `tex1` int DEFAULT NULL,
  `tex2` int DEFAULT NULL,
  `tex3` int DEFAULT NULL,
  `sub_pos` tinyint DEFAULT NULL,
  `cum` int DEFAULT NULL,
  `cum_ave` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade_id` int unsigned DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `marks_student_id_foreign` (`student_id`),
  KEY `marks_my_class_id_foreign` (`my_class_id`),
  KEY `marks_subject_id_foreign` (`subject_id`),
  KEY `marks_exam_id_foreign` (`exam_id`),
  CONSTRAINT `marks_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `marks_my_class_id_foreign` FOREIGN KEY (`my_class_id`) REFERENCES `my_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `marks_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `marks_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marks`
--

LOCK TABLES `marks` WRITE;
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
/*!40000 ALTER TABLE `marks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2022_01_02_124750_create_states_table',1),(2,'2022_01_06_121148_create_nationalities_table',1),(3,'2022_01_12_000000_create_users_table',1),(4,'2022_01_12_100000_create_password_resets_table',1),(5,'2022_09_20_100249_create_user_types_table',1),(6,'2022_09_20_150906_create_class_types_table',1),(7,'2022_09_22_073005_create_my_classes_table',1),(8,'2022_09_22_073526_create_sections_table',1),(9,'2022_09_22_080555_create_settings_table',1),(10,'2022_09_22_081302_create_subjects_table',1),(11,'2022_09_22_100249_create_writte_types_table',1),(12,'2022_09_22_151514_create_student_records_table',1),(13,'2022_09_22_151514_create_student_writtes_table',1),(14,'2022_10_04_224910_create_exams_table',1),(15,'2022_10_06_224846_create_marks_table',1),(16,'2022_10_18_205842_create_exam_records_table',1),(17,'2023_01_02_132115_create_staff_records_table',1),(18,'2023_01_02_142514_create_fks',1),(19,'2022_09_22_151514_create_student_writtes_table_insert',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_classes`
--

DROP TABLE IF EXISTS `my_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_classes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_type_id` int unsigned DEFAULT NULL,
  `teacher_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `my_classes_class_type_id_name_unique` (`class_type_id`,`name`),
  KEY `my_classes_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `my_classes_class_type_id_foreign` FOREIGN KEY (`class_type_id`) REFERENCES `class_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `my_classes_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_classes`
--

LOCK TABLES `my_classes` WRITE;
/*!40000 ALTER TABLE `my_classes` DISABLE KEYS */;
INSERT INTO `my_classes` VALUES (1,'10 A1',1,3,NULL,'2023-03-27 10:57:25'),(2,'10 A2',1,3,NULL,'2023-03-27 10:58:32'),(3,'11 A1',2,21,NULL,'2023-03-28 03:52:17'),(4,'11 A2',2,3,NULL,'2023-03-27 23:15:15'),(5,'12 A1',3,21,NULL,'2023-03-27 23:15:08');
/*!40000 ALTER TABLE `my_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nationalities`
--

DROP TABLE IF EXISTS `nationalities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nationalities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nationalities`
--

LOCK TABLES `nationalities` WRITE;
/*!40000 ALTER TABLE `nationalities` DISABLE KEYS */;
/*!40000 ALTER TABLE `nationalities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
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
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'current_session','2023-2-24',NULL,NULL),(2,'system_title','HỆ THỐNG QUẢN LÝ GIẤY XIN PHÉP',NULL,NULL),(3,'system_footer','Phát triển bởi THPT chuyên Lào Cai',NULL,NULL),(4,'system_name','HỆ THỐNG QUẢN LÝ GIẤY XIN PHÉP',NULL,NULL),(5,'term_ends','7/10/2024',NULL,NULL),(6,'term_begins','7/10/2023',NULL,NULL),(7,'phone','0983456789',NULL,NULL),(8,'address','Ha Noi - Viet Nam',NULL,NULL),(9,'system_email','gxpacademy@gmail.com',NULL,NULL),(10,'alt_email','',NULL,NULL),(11,'email_host','',NULL,NULL),(12,'email_pass','',NULL,NULL),(13,'lock_exam','0',NULL,NULL),(14,'logo','',NULL,NULL),(15,'next_term_fees_j','20000',NULL,NULL),(16,'next_term_fees_pn','25000',NULL,NULL),(17,'next_term_fees_p','25000',NULL,NULL),(18,'next_term_fees_n','25600',NULL,NULL),(19,'next_term_fees_s','15600',NULL,NULL),(20,'next_term_fees_c','1600',NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_records`
--

DROP TABLE IF EXISTS `staff_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff_records` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staff_records_code_unique` (`code`),
  KEY `staff_records_user_id_foreign` (`user_id`),
  CONSTRAINT `staff_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_records`
--

LOCK TABLES `staff_records` WRITE;
/*!40000 ALTER TABLE `staff_records` DISABLE KEYS */;
INSERT INTO `staff_records` VALUES (1,21,'HỆ THỐNG QUẢN LÝ GIẤY XIN PHÉP/STAFF/1970/01/3395',NULL,'2023-03-27 23:14:42','2023-03-27 23:18:49');
/*!40000 ALTER TABLE `staff_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_records`
--

DROP TABLE IF EXISTS `student_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_records` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `my_class_id` int unsigned NOT NULL,
  `adm_no` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `my_parent_id` int unsigned DEFAULT NULL,
  `house` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` tinyint DEFAULT NULL,
  `year_admitted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grad` tinyint NOT NULL DEFAULT '0',
  `grad_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_records_adm_no_unique` (`adm_no`),
  KEY `student_records_user_id_foreign` (`user_id`),
  KEY `student_records_my_class_id_foreign` (`my_class_id`),
  KEY `student_records_my_parent_id_foreign` (`my_parent_id`),
  CONSTRAINT `student_records_my_class_id_foreign` FOREIGN KEY (`my_class_id`) REFERENCES `my_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_records_my_parent_id_foreign` FOREIGN KEY (`my_parent_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `student_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_records`
--

LOCK TABLES `student_records` WRITE;
/*!40000 ALTER TABLE `student_records` DISABLE KEYS */;
INSERT INTO `student_records` VALUES (1,5,1,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:28','2023-03-27 10:33:28'),(2,6,1,NULL,4,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:28','2023-03-29 03:13:05'),(3,7,1,NULL,4,NULL,NULL,'2022',0,NULL,'2023-03-27 10:33:28','2023-03-29 03:12:48'),(4,8,1,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:28','2023-03-27 10:33:28'),(5,9,2,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:29','2023-03-27 10:33:29'),(6,10,2,NULL,4,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:29','2023-03-29 03:13:23'),(7,11,2,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:29','2023-03-27 10:33:29'),(8,12,3,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:29','2023-03-27 10:33:29'),(9,13,3,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:29','2023-03-27 10:33:29'),(10,14,3,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:29','2023-03-27 10:33:29'),(11,15,4,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:29','2023-03-27 10:33:29'),(12,16,4,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:29','2023-03-27 10:33:29'),(13,17,4,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:29','2023-03-27 10:33:29'),(14,18,5,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:29','2023-03-27 10:33:29'),(15,19,5,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:29','2023-03-27 10:33:29'),(16,20,5,NULL,NULL,NULL,NULL,NULL,0,NULL,'2023-03-27 10:33:29','2023-03-27 10:33:29');
/*!40000 ALTER TABLE `student_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_writtes`
--

DROP TABLE IF EXISTS `student_writtes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_writtes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `student_record_id` int unsigned NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint DEFAULT '0',
  `date_at` date NOT NULL,
  `session_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `accept_by` int unsigned DEFAULT NULL,
  `deny_by` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_writtes_student_record_id_foreign` (`student_record_id`),
  CONSTRAINT `student_writtes_student_record_id_foreign` FOREIGN KEY (`student_record_id`) REFERENCES `student_records` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_writtes`
--

LOCK TABLES `student_writtes` WRITE;
/*!40000 ALTER TABLE `student_writtes` DISABLE KEYS */;
INSERT INTO `student_writtes` VALUES (1,1,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(2,1,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(3,1,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(5,1,'Giấy xin phép vừa tạo',0,'2023-03-29','Cả ngày',NULL,NULL,NULL,NULL),(6,2,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(7,2,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(8,2,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(10,2,'Giấy xin phép vừa tạo',0,'2023-03-29','Cả ngày',NULL,NULL,NULL,NULL),(11,3,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(12,3,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(13,3,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(15,3,'Giấy xin phép vừa tạo',0,'2023-03-29','Cả ngày',NULL,NULL,NULL,NULL),(16,4,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(17,4,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(18,4,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(20,4,'Giấy xin phép vừa tạo',0,'2023-03-29','Cả ngày',NULL,NULL,NULL,NULL),(21,5,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(22,5,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(23,5,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(25,5,'Giấy xin phép vừa tạo',0,'2023-03-29','Cả ngày',NULL,NULL,NULL,NULL),(26,6,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(27,6,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(28,6,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(30,6,'Giấy xin phép vừa tạo',0,'2023-03-29','Cả ngày',NULL,NULL,NULL,NULL),(31,7,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(32,7,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(33,7,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(35,7,'Giấy xin phép vừa tạo',0,'2023-03-29','Cả ngày',NULL,NULL,NULL,NULL),(36,8,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(37,8,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(38,8,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(40,8,'Giấy xin phép vừa tạo',0,'2023-03-29','Cả ngày',NULL,NULL,NULL,NULL),(41,9,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(42,9,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(43,9,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(45,9,'Giấy xin phép vừa tạo',0,'2023-03-29','Cả ngày',NULL,NULL,NULL,NULL),(46,10,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(47,10,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(48,10,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(50,10,'Giấy xin phép vừa tạo',0,'2023-03-29','Cả ngày',NULL,NULL,NULL,NULL),(51,11,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(52,11,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(53,11,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(55,11,'Giấy xin phép vừa tạo',0,'2023-03-29','Cả ngày',NULL,NULL,NULL,NULL),(56,12,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(57,12,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(58,12,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(60,12,'Giấy xin phép vừa tạo',0,'2023-03-29','Cả ngày',NULL,NULL,NULL,NULL),(61,13,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(62,13,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(63,13,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(65,13,'Giấy xin phép vừa tạo',1,'2023-03-29','Cả ngày',NULL,'2023-03-28 09:26:04',NULL,NULL),(66,14,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(67,14,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(68,14,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(70,14,'Giấy xin phép vừa tạo',1,'2023-03-29','Cả ngày',NULL,'2023-03-28 09:26:00',NULL,NULL),(71,15,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(72,15,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(73,15,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(75,15,'Giấy xin phép vừa tạo',3,'2023-03-29','Cả ngày',NULL,'2023-03-28 09:25:40',NULL,NULL),(76,16,'Giấy xin phép giáo viên từ chối',4,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(77,16,'Giấy xin phép phụ huynh từ chối',3,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(78,16,'Giấy xin phép giáo viên phê duyệt',2,'2023-03-27','Cả ngày',NULL,NULL,NULL,NULL),(80,16,'Giấy xin phép vừa tạo',1,'2023-03-29','Cả ngày',NULL,'2023-03-28 09:25:21',NULL,NULL),(81,1,'student tajo moio',1,'2023-03-23','Cả ngày','2023-03-28 08:45:43','2023-03-28 08:45:43',NULL,NULL);
/*!40000 ALTER TABLE `student_writtes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjects` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_class_id` int unsigned NOT NULL,
  `teacher_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subjects_my_class_id_name_unique` (`my_class_id`,`name`),
  KEY `subjects_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `subjects_my_class_id_foreign` FOREIGN KEY (`my_class_id`) REFERENCES `my_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subjects_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'English Language','Eng',1,3,NULL,NULL),(2,'Mathematics','Math',1,3,NULL,NULL),(3,'English Language','Eng',2,3,NULL,NULL),(4,'Mathematics','Math',2,3,NULL,NULL),(5,'English Language','Eng',3,3,NULL,NULL),(6,'Mathematics','Math',3,3,NULL,NULL),(7,'English Language','Eng',4,3,NULL,NULL),(8,'Mathematics','Math',4,3,NULL,NULL),(9,'English Language','Eng',5,3,NULL,NULL),(10,'Mathematics','Math',5,3,NULL,NULL);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,'parent','Phụ huynh','4',NULL,NULL),(2,'teacher','Giáo viên','3',NULL,NULL),(3,'admin','Ban giám hiệu','2',NULL,NULL),(4,'super_admin','Admin','1',NULL,NULL);
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://localhost/global_assets/images/user.png',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_code_unique` (`code`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@admin.com','YRYOXPBLV4','admin','super_admin',NULL,NULL,'http://127.0.0.1:8000/storage/uploads/super_admin/YRYOXPBLV4/photo.png',NULL,'địa chỉ',NULL,'$2y$10$dTm35wTXMHdIpd5oE3EgVuR2oyExRRfhQNlUje9EFTHBb0pyqO4ZS','QCz5sAjwJL8SHHeAaA1ANJlKwNA2RlVgI3MBuDJIWOw6RvPxVrdKWttTOad8',NULL,'2023-03-28 03:08:00'),(2,'Ban giám hiệu','bgh@bgh.com','PMPTZTFWJD','bgh','admin',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dTm35wTXMHdIpd5oE3EgVuR2oyExRRfhQNlUje9EFTHBb0pyqO4ZS','S58kiWEWWFsmmxlGKcve79kCHsVh6RYc1RMF8b944nUuPzYenapeGeF83680',NULL,NULL),(3,'Thầy An','teacher@teacher.com','P1EIYEBZIT','teacher','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dTm35wTXMHdIpd5oE3EgVuR2oyExRRfhQNlUje9EFTHBb0pyqO4ZS','HDrcqbw0TDJR0Ed1m8IBQ5h4ukxOCImAe4eEvMLl5WfPMrgEuwa5r1GOWVhg',NULL,NULL),(4,'Bố An','parent@parent.com','JRBCMP1US8','parent','parent',NULL,'Nam','http://127.0.0.1:8000/storage/uploads/parent/JRBCMP1US8/photo.png',NULL,'địa chỉ edit',NULL,'$2y$10$dTm35wTXMHdIpd5oE3EgVuR2oyExRRfhQNlUje9EFTHBb0pyqO4ZS','icP48J0kAk0xEXLpWGMkOBFlb5vrjGMWwWpBMFte3RF0qoEl9yH7vv56L6BW',NULL,'2023-03-28 03:51:05'),(5,'Student DJ','student@student.com','YUX0M0DDJG','student','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$Ep7NSQd/ZawRv5/EOHEVEeF.Gzv6BZc/FqCgQOzJbeep2qohgXcZq','huk41Gy42S4FYrw8TuByeLH4EMVK8xyvt75dJYImJdk7MlHw314c7ZFBVnBD','2023-03-27 10:33:28','2023-03-27 10:33:28'),(6,'Caden DuBuque','vincenza.pouros@example.org','HAMHNJXD9U','aimee.shanahan','student',NULL,'Nam','http://localhost/global_assets/images/user.png',NULL,'việt nam',NULL,'$2y$10$T.2lmjF4941XxL6cL343Q.a413jj1rZgEce6fUiVVoYlf5TRwCOXC','SASqd4iwWO','2023-03-27 10:33:28','2023-03-29 03:13:05'),(7,'Amy Torphy MD','reed.deckow@example.org','OY7OSJZATA','xmitchell','student','06/20/2000','Nam','http://127.0.0.1:8000/storage/uploads/student/OY7OSJZATA/photo.png','0987654312','việt nam',NULL,'$2y$10$T.2lmjF4941XxL6cL343Q.a413jj1rZgEce6fUiVVoYlf5TRwCOXC','pEk0bQqtjw','2023-03-27 10:33:28','2023-03-27 20:57:45'),(8,'Connie Pollich Sr.','sjacobs@example.net','Z3UQJCKSHY','robyn18','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$T.2lmjF4941XxL6cL343Q.a413jj1rZgEce6fUiVVoYlf5TRwCOXC','W3JE6J9wAe','2023-03-27 10:33:28','2023-03-27 10:33:28'),(9,'Lazaro Schultz','stanford.west@example.net','H229ZJKN2T','joel.hintz','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$.sxjAPXyQcnPfL13flvK3OLrQ7srt7xPoAa6IreUWkzT5cwW1kJlO','599C1WQRSC','2023-03-27 10:33:29','2023-03-27 10:33:29'),(10,'Dr. Hassan Waelchi','adeline42@example.com','RV8LQ3LQ0D','lwisozk','student',NULL,'Nam','http://localhost/global_assets/images/user.png',NULL,'viej nam',NULL,'$2y$10$.sxjAPXyQcnPfL13flvK3OLrQ7srt7xPoAa6IreUWkzT5cwW1kJlO','Tt07jj5f6G','2023-03-27 10:33:29','2023-03-29 03:13:23'),(11,'Mrs. Micaela Hane MD','cortez.orn@example.org','YZZJQGJISO','rippin.daphney','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$.sxjAPXyQcnPfL13flvK3OLrQ7srt7xPoAa6IreUWkzT5cwW1kJlO','iIvpufQmCM','2023-03-27 10:33:29','2023-03-27 10:33:29'),(12,'Felicia Lueilwitz','berta.heidenreich@example.com','FMTUGTJDRW','dubuque.marquise','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$tc9q2VIKjjH5/ErAFfaD6ezdzEboPEiEbwlpNPEUmnsdwpWEIdtwa','LSCvzB1NOP','2023-03-27 10:33:29','2023-03-27 10:33:29'),(13,'Domenica Leannon II','ebuckridge@example.org','8OE9VETSXR','nona.hirthe','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$tc9q2VIKjjH5/ErAFfaD6ezdzEboPEiEbwlpNPEUmnsdwpWEIdtwa','OdDTQSBHd3','2023-03-27 10:33:29','2023-03-27 10:33:29'),(14,'Cathrine Labadie','nwalsh@example.org','HDNH5T2HU1','darrin25','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$tc9q2VIKjjH5/ErAFfaD6ezdzEboPEiEbwlpNPEUmnsdwpWEIdtwa','4L1TSN6mUb','2023-03-27 10:33:29','2023-03-27 10:33:29'),(15,'Ms. June Runolfsdottir II','trevion.upton@example.org','TJKHLEMDPE','flatley.bradford','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$Lq.ddAo95JLOAIXc4T/Yo.bWdYL6XGG3qeYRdZx7I7/k2qipMco.W','f4nVp4bm3g','2023-03-27 10:33:29','2023-03-27 10:33:29'),(16,'Mr. Terrance Ledner Jr.','rolfson.mike@example.org','RTBHCG55PC','tatyana.ondricka','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$Lq.ddAo95JLOAIXc4T/Yo.bWdYL6XGG3qeYRdZx7I7/k2qipMco.W','aKsM8pWOcS','2023-03-27 10:33:29','2023-03-27 10:33:29'),(17,'Jules Hayes IV','florine45@example.net','PT8RCBRSJS','nat18','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$Lq.ddAo95JLOAIXc4T/Yo.bWdYL6XGG3qeYRdZx7I7/k2qipMco.W','UzyrDAQsHO','2023-03-27 10:33:29','2023-03-27 10:33:29'),(18,'Joseph Witting','dalton53@example.org','WT3VQWAN2B','wilmer.botsford','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$DimnQci3PfzORr5b3sDPfumCEsjVB61clj1SB3fqA1D6jFtuklCrK','SXexf1TMaw','2023-03-27 10:33:29','2023-03-27 10:33:29'),(19,'Ms. Heath McClure PhD','pbruen@example.com','LCREDHC7UK','vcassin','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$DimnQci3PfzORr5b3sDPfumCEsjVB61clj1SB3fqA1D6jFtuklCrK','MgU7NR3Oqx','2023-03-27 10:33:29','2023-03-27 10:33:29'),(20,'Grady Trantow','ola.damore@example.com','L1ZBDLGG9O','gboehm','student',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$DimnQci3PfzORr5b3sDPfumCEsjVB61clj1SB3fqA1D6jFtuklCrK','WpP3Dg58PR','2023-03-27 10:33:29','2023-03-27 10:33:29'),(21,'Cô Anh','coanh@gmail.com','LX4VBXSKQN','USERS/teacher/888888','teacher',NULL,'Female','http://127.0.0.1:8000/storage/uploads/teacher/LX4VBXSKQN/photo.png',NULL,'Việt nbam',NULL,'$2y$10$8L8CyS/KmMLXOGx3Um.86ewIRRpNuX8j6D8nqfpF23uy.cBGhH4iK',NULL,'2023-03-27 23:14:42','2023-03-27 23:18:49'),(22,'Le Văn Anh','jvma@gmail.com','QEFVFTOR7B','STAFF/parent/328354','parent',NULL,'Nam','http://127.0.0.1:8000/global_assets/images/user.png',NULL,'dịa chỉ viejt nam',NULL,'$2y$10$.YqwzI0aEmbbZjGMXsn5qe9ZzbEqS58ZXecn8Pp9nfQHh.iEtHeeu',NULL,'2023-03-28 03:17:31','2023-03-28 03:17:31'),(23,'Phụ Huynh được Giáo Viên Thêm','giaovienthem@gmail.com','3L6BLCFDDM','USERS/parent/800967','parent',NULL,'Nam','http://127.0.0.1:8000/global_assets/images/user.png',NULL,'giáo viên đã thêm',NULL,'$2y$10$o.hZ3NfWehBS85B9p1/Mye1/qpa5TIL/LmYFHsVv7PcMDRSAAZN.6',NULL,'2023-03-28 03:49:49','2023-03-28 03:49:49'),(24,'Thầy An0','teacher0@teacher.com','CZHLK6KNKE','teacher0','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','h0vDj2SJC8',NULL,NULL),(25,'Bố An0','parent0@parent.com','LVLQ8NDN9E','parent0','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','wsgpZNregy',NULL,NULL),(26,'Thầy An1','teacher1@teacher.com','SRD9YAYIHV','teacher1','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','F22rhyMyAp',NULL,NULL),(27,'Bố An1','parent1@parent.com','MQUTRF2XNU','parent1','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','2bbmypz2yW',NULL,NULL),(28,'Thầy An2','teacher2@teacher.com','SE4FROQQMW','teacher2','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','r4g7lwjr2o',NULL,NULL),(29,'Bố An2','parent2@parent.com','ZPIAR3GRCK','parent2','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','fHbn5JM5VK',NULL,NULL),(30,'Thầy An3','teacher3@teacher.com','HGJQOWCBGJ','teacher3','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','7tCDMtVJGD',NULL,NULL),(31,'Bố An3','parent3@parent.com','MRF4CIFVQW','parent3','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','qGpZEab79w',NULL,NULL),(32,'Thầy An4','teacher4@teacher.com','UWR5OU72JB','teacher4','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','Y2uMSm0BxF',NULL,NULL),(33,'Bố An4','parent4@parent.com','EGSLP3XX7S','parent4','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','oCRqMv7jEx',NULL,NULL),(34,'Thầy An5','teacher5@teacher.com','HITXJAXMD9','teacher5','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','4zBu8oSkAR',NULL,NULL),(35,'Bố An5','parent5@parent.com','U8FYITITBA','parent5','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','F1baTwft7N',NULL,NULL),(36,'Thầy An6','teacher6@teacher.com','HHDTYZSTCN','teacher6','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','4Lmy7LbKNt',NULL,NULL),(37,'Bố An6','parent6@parent.com','BZ56GOVBA5','parent6','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','VbyZeh7SDv',NULL,NULL),(38,'Thầy An7','teacher7@teacher.com','8EUBB81AY6','teacher7','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','tKRopgbj2r',NULL,NULL),(39,'Bố An7','parent7@parent.com','KPPSTGAML9','parent7','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','hsLCe671xM',NULL,NULL),(40,'Thầy An8','teacher8@teacher.com','PQOCKH7ACX','teacher8','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','DAyNs9U4cn',NULL,NULL),(41,'Bố An8','parent8@parent.com','JS7I680T4T','parent8','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','ij1FT88yUT',NULL,NULL),(42,'Thầy An9','teacher9@teacher.com','ZJ8SMSX6I5','teacher9','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','JH2ot5n8r2',NULL,NULL),(43,'Bố An9','parent9@parent.com','A4VJFHSSCW','parent9','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','K4uKx47Jjq',NULL,NULL),(44,'Thầy An10','teacher10@teacher.com','EXKBWF4LGD','teacher10','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','Xm2bBWjsYH',NULL,NULL),(45,'Bố An10','parent10@parent.com','T3EFPAH6KY','parent10','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','2FrN3R4Tpn',NULL,NULL),(46,'Thầy An11','teacher11@teacher.com','75JXZZIGA7','teacher11','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','zZhIftFBLH',NULL,NULL),(47,'Bố An11','parent11@parent.com','L0SSZ7U79Y','parent11','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','ccHpQWOZoA',NULL,NULL),(48,'Thầy An12','teacher12@teacher.com','VZ12ME2TNQ','teacher12','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','XEWaDvXxfB',NULL,NULL),(49,'Bố An12','parent12@parent.com','XZXP4AW3CB','parent12','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','2Y3jResxlh',NULL,NULL),(50,'Thầy An13','teacher13@teacher.com','PBWYHFRBSN','teacher13','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','imKWAiSNLY',NULL,NULL),(51,'Bố An13','parent13@parent.com','TUJ8PCDVOK','parent13','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','9TUdMpQ6tj',NULL,NULL),(52,'Thầy An14','teacher14@teacher.com','DA7JLVN4BX','teacher14','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','zBktBCwfkp',NULL,NULL),(53,'Bố An14','parent14@parent.com','ZJCIDI54NH','parent14','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','l3I4Yhapjo',NULL,NULL),(54,'Thầy An15','teacher15@teacher.com','SCYGTQQQ1V','teacher15','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','aX6Yz7e0ec',NULL,NULL),(55,'Bố An15','parent15@parent.com','CVG0HIRGSF','parent15','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','batEOa3t3O',NULL,NULL),(56,'Thầy An16','teacher16@teacher.com','ZNABOKIGZA','teacher16','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','yiOWYmqJCw',NULL,NULL),(57,'Bố An16','parent16@parent.com','HRG79SUUP0','parent16','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','Q2XeoGfXUE',NULL,NULL),(58,'Thầy An17','teacher17@teacher.com','0N7AATHTTS','teacher17','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','ACarf7dT5y',NULL,NULL),(59,'Bố An17','parent17@parent.com','F3WZO9HW3I','parent17','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','6o2UnUFXoY',NULL,NULL),(60,'Thầy An18','teacher18@teacher.com','XR2X16BFXJ','teacher18','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','9fDvNDDIWo',NULL,NULL),(61,'Bố An18','parent18@parent.com','MUMKB8EZMC','parent18','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','73nlG1Ga1v',NULL,NULL),(62,'Thầy An19','teacher19@teacher.com','FSTVWOQ54F','teacher19','teacher',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','1j5UCA1DWa',NULL,NULL),(63,'Bố An19','parent19@parent.com','HMPUQABQVK','parent19','parent',NULL,NULL,'http://localhost/global_assets/images/user.png',NULL,NULL,NULL,'$2y$10$dKzyJv.Phj7xHA108B5W4.eHTD0CuHn7e9RncoE8V1Pt4I7tFb2Ry','k8YVwfObwp',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `writte_types`
--

DROP TABLE IF EXISTS `writte_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `writte_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `writte_types`
--

LOCK TABLES `writte_types` WRITE;
/*!40000 ALTER TABLE `writte_types` DISABLE KEYS */;
INSERT INTO `writte_types` VALUES (1,'Chờ xử lý','0',NULL,NULL),(2,'Phụ huynh chấp nhận','1',NULL,NULL),(3,'Giáo viên chấp nhận','2',NULL,NULL),(4,'Phụ huynh từ chối','3',NULL,NULL),(5,'Giáo viên từ chối','4',NULL,NULL);
/*!40000 ALTER TABLE `writte_types` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-29 19:54:40
