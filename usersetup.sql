
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_types_id` int(11) DEFAULT NULL,
  `full_name` varchar(191) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `gender` varchar(191) DEFAULT NULL,
  `default_address_id` int(11) DEFAULT 0,
  `country_code` varchar(191) DEFAULT NULL,
  `mobile_number` varchar(12) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT '1',
  `is_seen` tinyint(1) DEFAULT 0,
  `phone_verified` varchar(191) DEFAULT '0',
  `remember_token` varchar(191) DEFAULT NULL,
  `auth_id_tiwilo` varchar(191) DEFAULT NULL,
  `dob` varchar(33) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `check_password` varchar(191) DEFAULT NULL,
  `states` varchar(10) DEFAULT '1',
  `district_id` int(11) DEFAULT NULL,
  `taluk_id` int(11) DEFAULT NULL,
  `village_id` int(11) DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `nric` varchar(191) DEFAULT NULL,
  `login_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Super','','','1',0,NULL,'9876543210','superadmin@gmail.com','$2y$10$HW.RWivIXhSkpgAqVY4ov.wB4abs6Stzjg/GQKKLzxoBVEj2bZYi.',NULL,'1',0,'',NULL,NULL,NULL,NULL,'2022-07-01 19:29:12','',NULL,NULL,NULL,NULL,NULL,'',NULL),(15,2,'Nagercoil','','','Mail',0,NULL,'0897685432','spiderman@gmail.com','$2y$10$.rW85UaT0fsSh4KDnICzWeW./2hKsK.QD4qj6pRCl6m7buWfr4gNK',NULL,'1',0,'0',NULL,NULL,NULL,'2022-09-22 04:41:15',NULL,'spider',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,2,'Parvathipuram','','','Mail',0,NULL,'0867578457','superamin@gmail.com','$2y$10$tSXhoMjf2ArwkCMVZFPyv.OlwWqJdLH9KZcZJnEy0OMKTOUNUVehW',NULL,'1',0,'0',NULL,NULL,NULL,'2022-09-22 04:20:13',NULL,'admi',NULL,NULL,NULL,NULL,'ajnhyiwhnhfhvf',NULL,NULL),(17,3,'Nagercoil Staff','','','Mail',0,NULL,'9740858642','werwinjoker@gmail.com','$2y$10$PO0nfBl/.Yde.5NgTNUkl.9mQM.p3Kduc8ucMhIyH7HFRWyuRgFA6',NULL,'1',0,'0',NULL,NULL,NULL,'2022-09-19 16:33:18',NULL,'werwinjoker','1',NULL,NULL,NULL,'pallpannai\r\npallpannai (p.o)',NULL,NULL),(18,3,'Parvathipuram Staff','','','Mail',0,NULL,'9344332244','kannan@gmail.com','$2y$10$hHyQNggemJB2nAdj5xk9OeK8hUt0u7IuCmcE/60vkKmyCoELtdq2S',NULL,'1',0,'0',NULL,NULL,NULL,'2022-09-28 11:46:08',NULL,'123456','1',NULL,NULL,NULL,'Mottavilai\r\nKarankadu PO',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_types_name` varchar(191) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,'Super','2022-06-07 11:42:03','2022-06-07 11:42:08',1),(2,'Admin','2022-06-07 06:11:55','2022-06-07 06:11:55',1),(3,'Staff','2022-06-07 06:12:39','2022-06-07 06:12:39',1);
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permission`
--

DROP TABLE IF EXISTS `user_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_types_id` int(11) DEFAULT NULL,
  `roles` int(11) DEFAULT 0,
  `addrole` int(11) DEFAULT 0,
  `editrole` int(11) DEFAULT 0,
  `deleterole` int(11) DEFAULT 0,
  `dashboard` int(11) DEFAULT 1,
  `users` int(11) DEFAULT 0,
  `adduser` int(11) DEFAULT 0,
  `edituser` int(11) DEFAULT 0,
  `deleteuser` int(11) DEFAULT 0,
  `patients` int(11) DEFAULT 0,
  `addpatient` int(11) DEFAULT 0,
  `editpatient` int(11) DEFAULT 0,
  `deletepatient` int(11) DEFAULT 0,
  `blocks` int(11) DEFAULT 0,
  `addblock` int(11) DEFAULT 0,
  `editblock` int(11) DEFAULT 0,
  `deleteblock` int(11) DEFAULT 0,
  `rooms` int(11) DEFAULT 0,
  `addroom` int(11) DEFAULT 0,
  `editroom` int(11) DEFAULT 0,
  `deleteroom` int(11) DEFAULT 0,
  `admission` int(11) NOT NULL DEFAULT 0,
  `billing` int(11) NOT NULL DEFAULT 0,
  `pharmacy` int(11) NOT NULL DEFAULT 0,
  `investigation` int(11) NOT NULL DEFAULT 0,
  `ot` int(11) NOT NULL DEFAULT 0,
  `mrd` int(11) NOT NULL DEFAULT 0,
  `appointments` int(11) NOT NULL DEFAULT 0,
  `mis` int(11) NOT NULL DEFAULT 0,
  `Login_id` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permission`
--

LOCK TABLES `user_permission` WRITE;
/*!40000 ALTER TABLE `user_permission` DISABLE KEYS */;
INSERT INTO `user_permission` VALUES (1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,1),(47,74,1,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1),(48,75,2,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1),(49,18,3,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `user_permission` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-05 15:32:05
