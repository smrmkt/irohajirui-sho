CREATE TABLE IF NOT EXISTS `iroha_datas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `midashigo` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itaiji1` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itaiji1_no` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itaiji2` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itaiji2_no` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itaiji3` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itaiji3_no` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seiten` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `syozokuhen` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `syozokubu` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maedahonshozai` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurokawahonshozai` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `henbetsububetsu_no` int(8) DEFAULT NULL,
  `gaitouhen_sougosuu` int(4) DEFAULT NULL,
  `tsuu_no` int(8) DEFAULT NULL,
  `bubetsu_tsuu_no` int(8) DEFAULT NULL,
  `bubetsu_onnkunn_no` int(8) DEFAULT NULL,
  `onnkunn` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `onnkunnbetsu_tsuu_no` int(8) DEFAULT NULL,
  `mojisuu` int(8) DEFAULT NULL,
  `onnyomi` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `onnyomi_kanzen` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `onnyomi_gendai` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kunnyomi` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kunnyomi_kanzen` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kunnyomi_gendai` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tyuubun` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sakuseisya_chuu` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1388 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
