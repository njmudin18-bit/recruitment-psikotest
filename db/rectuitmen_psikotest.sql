/*
 Navicat Premium Data Transfer

 Source Server         : Localhost on Laragon
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3309
 Source Schema         : laravel_starter

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 24/08/2024 11:44:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (6, '2024_04_05_080046_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (7, '2024_04_07_065632_create_navigations_table', 1);
INSERT INTO `migrations` VALUES (8, '2024_04_10_125314_create_navigation_role_table', 1);
INSERT INTO `migrations` VALUES (9, '2024_04_13_014727_create_user_profiles_table', 1);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 2);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 3);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 5);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 10);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 11);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 12);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 13);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 14);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 15);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 16);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 17);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 18);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 19);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 20);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 21);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 22);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 23);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 24);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 25);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 26);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 27);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 28);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 29);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 30);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 31);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 32);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 33);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 34);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 35);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 36);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 37);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 38);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 39);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 40);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 41);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 42);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 43);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 44);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 45);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 46);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 47);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 48);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 49);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 50);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 51);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\User', 52);

-- ----------------------------
-- Table structure for ms_faq
-- ----------------------------
DROP TABLE IF EXISTS `ms_faq`;
CREATE TABLE `ms_faq`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `StatusAktivasi` enum('Aktif','Non') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TypePertanyaan` enum('PU','PD') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Pertanyaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Jawaban` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_faq
-- ----------------------------
INSERT INTO `ms_faq` VALUES (1, 'Aktif', 'PU', 'Cara mengakses aplikasi?', '<p><span style=\"color: rgb(0, 0, 0);\">Buka aplikasi browser (Google Chrome, Mozilla Firefox, Safari dll) di perangkat Anda, seperti komputer atau handphone anda lalu masukan tautan ini&nbsp;</span><span style=\"font-weight: bolder; color: rgb(0, 0, 0);\">https://e-recruitment.omas-mfg.com</span><span style=\"color: rgb(0, 0, 0);\">&nbsp;atau cukup dengan mengklik&nbsp;</span><a href=\"https://e-recruitment.omas-mfg.com/\" class=\"text-danger fw-bold\" style=\"--bs-text-opacity: 1;\">disini</a><span style=\"color: rgb(0, 0, 0);\">.</span><br></p>', '2024-06-10 07:48:03', '1', '2024-06-10 07:59:22', '1');
INSERT INTO `ms_faq` VALUES (2, 'Aktif', 'PU', 'Cara mendaftar aplikasi?', '<p class=\"mb-0 text-black\" style=\"--bs-text-opacity: 1;\">Cukup dengan menekan tombol warna merah bertuliskan&nbsp;<span style=\"font-weight: bolder;\">Daftar</span>&nbsp;dipojok kanan atas atau cukup klik&nbsp;<a href=\"https://e-recruitment.omas-mfg.com/register\" class=\"text-danger fw-bold\" style=\"--bs-text-opacity: 1;\">disini</a>.</p><p class=\"mb-0 text-black\" style=\"--bs-text-opacity: 1;\">Masukkan informasi yang diperlukan, seperti nama, alamat email, dan kata sandi lalu tekan tombol&nbsp;<span style=\"font-weight: bolder;\">Register</span>&nbsp;.</p>', '2024-06-10 07:52:52', '1', '2024-06-10 07:59:08', '1');
INSERT INTO `ms_faq` VALUES (3, 'Aktif', 'PU', 'Cara masuk aplikasi?', '<ul class=\"text-black\" style=\"--bs-text-opacity: 1;\"><li>Tekan tombol warna hijau bertuliskan&nbsp;<span style=\"font-weight: bolder;\">Sign in</span>&nbsp;dipojok kanan atas atau cukup dengan klik&nbsp;<a href=\"https://e-recruitment.omas-mfg.com/login\" class=\"text-danger fw-bold\" style=\"--bs-text-opacity: 1;\">disini</a>.</li><li>Masukkan alamat email dan kata sandi yang Anda gunakan saat membuat akun.</li><li>Ketuk tombol&nbsp;<span style=\"font-weight: bolder;\">Log in</span>&nbsp;untuk masuk ke akun Anda.</li></ul>', '2024-06-10 07:53:55', '1', '2024-06-10 07:59:35', '1');
INSERT INTO `ms_faq` VALUES (4, 'Aktif', 'PU', 'Apakah perlu memiliki akun email?', '<p><span style=\"font-weight: bolder; color: rgb(0, 0, 0);\">Ya</span><span style=\"color: rgb(0, 0, 0);\">. Sistem kami akan mengirimkan email verifikasi ke alamat email yang Anda daftarkan sebelumnya. Harap periksa kotak masuk atau folder spam Anda untuk menemukan email tersebut.</span><br></p>', '2024-06-10 07:54:21', '1', '2024-06-10 07:59:47', '1');
INSERT INTO `ms_faq` VALUES (5, 'Aktif', 'PU', 'Cara mengirim lamaran?', '<ul class=\"mb-0 text-black\" style=\"--bs-text-opacity: 1;\"><li>Lengkapi semua formulir dan unggah semua dokumen yang dibutuhkan sebagai persyaratan rekrutmen yang tertera di menu&nbsp;<span style=\"font-weight: bolder;\">Pelamar</span>&nbsp;setelah anda login.</li><li>Pastikan anda melengkapi semua persyaratan yang dibutuhkan sebagai bahan pertimbangan kelulusan anda sebagai pelamar.</li><li>Setelah itu sistem akan otomatis mengirimkan lamaran anda ke Department terkait dan anda akan dihubungi oleh tim terkait untuk proses selanjutnya.</li></ul>', '2024-06-10 07:54:51', '1', '2024-06-10 07:57:35', '1');
INSERT INTO `ms_faq` VALUES (6, 'Aktif', 'PU', 'Dokumen yang dibawa ketika interview?', '<p><span style=\"color: rgb(0, 0, 0);\">Anda cukup membawa&nbsp;</span><span style=\"font-weight: bolder; color: rgb(0, 0, 0);\">data identitas yang telah dicetak</span><span style=\"color: rgb(0, 0, 0);\">&nbsp;dari formulir yang telah anda isi sebelumnya di aplikasi&nbsp;</span><span style=\"font-weight: bolder; color: rgb(0, 0, 0);\">eRecruitment</span><span style=\"color: rgb(0, 0, 0);\">&nbsp;dan dokumen penunjang lainnya.</span><br></p>', '2024-06-10 07:55:23', '1', '2024-06-10 07:57:30', '1');
INSERT INTO `ms_faq` VALUES (7, 'Aktif', 'PU', 'Lulus interview apakah diinformasikan?', '<p><span style=\"color: rgb(0, 0, 0);\">Kelulusan anda sebagai pelamar akan diinformasikan oleh tim terkait langsung ke nomor handphone yang tercantum di formulir identitas diri yang sebelumnya telah anda isi.</span><br></p>', '2024-06-10 07:55:54', '1', '2024-06-10 07:57:22', '1');
INSERT INTO `ms_faq` VALUES (8, 'Aktif', 'PD', 'Apakah data dan dokumen yang saya unggah aman?', '<p><span style=\"color: rgb(0, 0, 0);\">Seluruh data kandidat yang tercantum dalam lamaran akan dirahasiakan dan hanya digunakan untuk keperluan rekrutmen.</span><br></p>', '2024-06-10 08:01:47', '1', NULL, NULL);
INSERT INTO `ms_faq` VALUES (9, 'Aktif', 'PD', 'Apakah data saya akan dibagikan kepihak lain?', '<p><span style=\"font-weight: bolder; color: rgb(0, 0, 0);\">Tidak</span><span style=\"color: rgb(0, 0, 0);\">. Perusahaan tidak akan membagikan data kandidat kepada pihak lain.</span><br></p>', '2024-06-10 08:02:15', '1', '2024-06-10 10:38:28', '1');

-- ----------------------------
-- Table structure for ms_pernyataan
-- ----------------------------
DROP TABLE IF EXISTS `ms_pernyataan`;
CREATE TABLE `ms_pernyataan`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Urutan` int NULL DEFAULT NULL,
  `Pernyataan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `StatusAktivasi` enum('Aktif','Non') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_pernyataan
-- ----------------------------
INSERT INTO `ms_pernyataan` VALUES (5, 1, 'Saya menyatakan bahwa segala keterangan yang saya berikan adalah benar apa adanya. Tanpa batas waktu, saya bertanggung jawab penuh atas segala konsekuensinya, menurut peraturan dan perundang-undangan yang berlaku atas keaslian dan kebenaran data dan dokumen lamaran saya.', 'Aktif', '2024-05-22 07:56:04', '1', NULL, NULL);
INSERT INTO `ms_pernyataan` VALUES (6, 2, 'Saya menyatakan bahwa saya dengan suka rela telah menyerahkan semua data dan dokumen lamaran saya kepada perusahaan untuk dapat menjadi wewenang sepenuhnya kepada perusahaan, untuk dipelajari, diarsip, diverifikasi maupun tindakan lainnya dalam memproses lamaran saya.', 'Aktif', '2024-05-22 07:56:22', '1', '2024-05-22 07:56:32', '1');
INSERT INTO `ms_pernyataan` VALUES (7, 3, 'Dalam hal ini saya juga membebaskan perusahaan dari tuntutan apapun terhadap data, dokumen, proses dan hasil keputusan terhadap lamaran kerja saya ini.', 'Aktif', '2024-05-22 07:56:46', '1', NULL, NULL);
INSERT INTO `ms_pernyataan` VALUES (8, 4, 'Bila sudah diterima dan ditemukan ada pemalsuan data atas lamaran saya ini, ataupun bila masih ada kekurangan lampiran dokumen asli persyaratan kerja yang diminta perusahaan, saya dengan ini menyatakan mengundurkan diri dari perusahaan secara automatis pada saat tersebut. Dengan ini, saya telah membaca, mengerti, mengisi, dan telah setuju atas seluruh isi dokumen dan proses lamaran saya di PT Multi Arta Sekawan.', 'Aktif', '2024-05-22 07:57:00', '1', NULL, NULL);
INSERT INTO `ms_pernyataan` VALUES (9, 5, 'Dengan ini, saya telah membaca, mengerti, mengisi, dan telah setuju atas seluruh isi dokumen dan proses lamaran saya di PT Multi Arta Sekawan.', 'Aktif', '2024-05-22 07:57:18', '1', '2024-05-22 14:57:01', '1');

-- ----------------------------
-- Table structure for ms_pertanyaan
-- ----------------------------
DROP TABLE IF EXISTS `ms_pertanyaan`;
CREATE TABLE `ms_pertanyaan`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Urutan` int NULL DEFAULT NULL,
  `Pertanyaan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `StatusAktivasi` enum('Aktif','Non') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_pertanyaan
-- ----------------------------
INSERT INTO `ms_pertanyaan` VALUES (6, 1, 'Apakah anda pernah mengajukan lamaran ke perusahaan kami sebelumnya? Waktu dan posisi.', 'Aktif', '2024-05-21 15:40:49', '1', '2024-05-22 07:31:18', '1');
INSERT INTO `ms_pertanyaan` VALUES (7, 2, 'Apakah anda bersedia kami melakukan konfirmasi kepada perusahaan anda saat ini dan sebelumnya.', 'Aktif', '2024-05-21 15:41:39', '1', '2024-05-22 07:31:25', '1');
INSERT INTO `ms_pertanyaan` VALUES (8, 3, 'Apakah ada keluarga/ kenalan anda yang bekerja pada perusahaan kami? Nama dan posisi.', 'Aktif', '2024-05-21 15:41:53', '1', '2024-05-22 07:31:32', '1');
INSERT INTO `ms_pertanyaan` VALUES (9, 4, 'Adakah kondisi kesehatan jasmasni & rohani anda yang dapat menghalangi anda dalam melakukan aktivitas & tugas.', 'Aktif', '2024-05-21 15:42:06', '1', '2024-05-22 07:30:46', '1');
INSERT INTO `ms_pertanyaan` VALUES (10, 5, 'Apakah anda pernah melakukan tes kesehatan dan test psikologis? Waktu, tempat dan keperluan test.', 'Aktif', '2024-05-21 15:42:20', '1', '2024-05-22 07:30:39', '1');
INSERT INTO `ms_pertanyaan` VALUES (11, 6, 'Apakah anda bersedia untuk ikut test psikologis perusahaan?', 'Aktif', '2024-05-21 15:43:06', '1', '2024-05-22 07:26:14', '1');
INSERT INTO `ms_pertanyaan` VALUES (12, 7, 'Apakan anda bersedia melengkapi dukumen asli seperti KTP, KK, Ijasah terakhir, Verklaring & SKKB yang masih berlaku?', 'Aktif', '2024-05-21 15:43:34', '1', '2024-05-22 07:26:05', '1');
INSERT INTO `ms_pertanyaan` VALUES (13, 8, 'Bila diterima kapan anda dapat begabung?', 'Aktif', '2024-05-21 15:43:55', '1', '2024-05-22 14:57:09', '1');

-- ----------------------------
-- Table structure for ms_typeujian
-- ----------------------------
DROP TABLE IF EXISTS `ms_typeujian`;
CREATE TABLE `ms_typeujian`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nama` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Urutan` int NULL DEFAULT NULL,
  `Status` enum('AKTIF','TIDAK') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ContohSoal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_typeujian
-- ----------------------------
INSERT INTO `ms_typeujian` VALUES (1, 'Tes Pengetahuan Umum', 1, 'AKTIF', '<p class=\"MsoNormal\"><span style=\"background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Tahoma;\">Soal-soal 01 – 20 terdiri atas kalimat-kalimat. Pada setiap kalimat satu kata hilang dan disediakan 5 (lima) kata&nbsp;</span><span style=\"color: var(--bs-modal-color); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Tahoma; background-color: var(--bs-modal-bg);\">pilihan sebagai jawabannya. Pilihlah kata yang tepat yang dapat menyempurnakan kalimat itu!</span><br></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Contoh :</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Seekor kuda mempunyai kesamaan terbanyak dengan seekor…………………</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">a) kucing </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">b) bajing </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">c) keledai </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">d) lembu </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">e) anjing</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Jawaban yang benar adalah : c) keledai</span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Contoh berikutnya :</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Lawannya ‘harapan’ adalah………………</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">a) duka </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">b) putus asa </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">c) sengsara </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">d) cinta </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">e) benci</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Jawaban yang benar adalah : b) putus asa</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p>', '2024-08-13 08:39:42', '1', '2024-08-14 12:47:07', '1');
INSERT INTO `ms_typeujian` VALUES (2, 'Tes Kesamaan Kata', 2, 'AKTIF', '<p class=\"MsoNormal\"><span style=\"background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-family: Tahoma; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Ditentukan lima kata. Pada 4 dari 5 kata itu terdapat suatu kesamaan. Carilah satu kata yang tidak memiliki kesamaan dengan keempat kata yang lain.</span><br></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Contoh:</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">a. meja </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">b. kursi </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">c. burung </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">d. lemari </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">e. tempat tidur</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Meja, kursi, lemari, dan tempat tidur adalah perabot rumah, sedangkan “burung” bukanlah perabot rumah yang tidak memiliki kesamaan dengan keempat kata yang lain. <br>Jawaban yang benar adalah : burung </span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Oleh karena itu pada kertas jawaban, pilih jawaban c. burung</span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Contoh berikutnya:</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">a. duduk </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">b. berbaring </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">c. berdiri </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">d. berjalan </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">e. berjongkok</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Pada duduk, berbaring, berdiri dan berjongkok adalah yang orang berada dalam keadaan tidak bergerak,&nbsp;</span><span style=\"font-family: Tahoma; background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">sedangkan “berjalan” orang berada dalam keadaan bergerak. <br>Jawaban yang benar adalah : berjalan</span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Oleh karena itu pada kertas jawaban, pilih jawaban d. berjalan</span></p>', '2024-08-13 08:44:22', '1', '2024-08-14 12:47:17', '1');
INSERT INTO `ms_typeujian` VALUES (3, 'Tes Hubungan Kata', 3, 'AKTIF', '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma; background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Ditentukan tiga kata. Antara kata pertama dan kata kedua terdapat suatu hubungan tertentu. Antara kata ketiga dan salah satu kata di antara kelima kata pilihan, harus pula terdapat hubungan yang sama. Carilah kata itu.</span><br></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Contoh:</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">HUTAN : POHON = TEMBOK : …</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">a. batu bata</span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">&nbsp;b. rumah </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">c. semen </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">d. putih </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">e. dinding</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Hubungan antara hutan dan pohon adalah bahwa hutan terdiri atas pohon-pohon, maka hubungan antara tembok dan salah satu kata pilihan adalah bahwa tembok terdiri atas batu bata. Jawaban yang benar adalah : batu&nbsp;</span><span style=\"font-family: Tahoma; background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">bata . Oleh karena itu pada kertas jawaban, pilih jawaban a. batu bata</span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Contoh berikutnya:</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">GELAP : TERANG = BASAH : …</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">a. hujan </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">b. hari </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">c. lembab </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">d. angin </span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">e. kering</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Gelap adalah lawan kata dari terang, maka untuk basah lawan katanya adalah kering. Jawaban yang benar adalah : kering. Oleh karena itu pada kertas jawaban, pilih jawaban a. kering</span></p>', '2024-08-13 08:44:39', '1', '2024-08-14 12:47:26', '1');
INSERT INTO `ms_typeujian` VALUES (4, 'Tes Aritmatika', 4, 'AKTIF', '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma; background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Test berikutnya adalah soal-soal hitungan.</span><br></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Contoh:</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Sebatang pensil harganya 25 rupiah. Berapakah harga 3 batang ?</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><!--[if !supportLists]--><span style=\"font-family: Tahoma;\">A.&nbsp;</span><!--[endif]--><span style=\"font-family: Tahoma;\">30</span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">B. 45</span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">C. 75</span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">	</span><span style=\"font-family: Tahoma;\">D. 85</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Jawabannya adalah : 75</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Cara menjawabnya adalah 25 x 3 = 75 rupiah</span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Contoh lain:</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Dengan sepeda, Husin dapat menempuh 15 km dalam waktu 1 jam. Berapa km kah yang dapat Husin tempuh selama 4 jam?</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Jawabannya adalah : 60</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Cara menjawabnya adalah 4 jam x 15 km = 60 km</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p>', '2024-08-13 08:44:49', '1', '2024-08-14 12:47:35', '1');
INSERT INTO `ms_typeujian` VALUES (7, 'Tes Buta Warna', 5, 'AKTIF', '<p class=\"MsoNormal\"><!--[if !supportLists]--><span style=\"font-family: Tahoma; color: rgb(33, 37, 41); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">1.&nbsp;</span><!--[endif]--><span style=\"font-family: Tahoma; color: rgb(33, 37, 41); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Duduk sekitar 75 cm dari layar monitor / plates dengan masing-masing lingkaran disesuaikan dengan tinggi mata.</span><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;font-size:12,0000pt;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><!--[if !supportLists]--><span style=\"font-family: Tahoma; color: rgb(33, 37, 41); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">2.&nbsp;</span><!--[endif]--><span style=\"font-family: Tahoma; color: rgb(33, 37, 41); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Gunakan cahaya yang ringan, jangan terlalu terang atau jangan terlalu redup. Lampu yang terlalu silau dapat merubah warna gambar</span><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;font-size:12,0000pt;\"><o:p></o:p></span></p><p class=\"MsoNormal\"><!--[if !supportLists]--><span style=\"font-family: Tahoma; color: rgb(33, 37, 41); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">3.&nbsp;</span><!--[endif]--><span style=\"font-family: Tahoma; color: rgb(33, 37, 41); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Mulai mencoba mengidentifikasi nomor yang tersembunyi ataupun baris dalam waktu 5 detik</span><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;font-size:12,0000pt;\"><o:p></o:p></span></p>', '2024-08-16 07:11:37', '1', '2024-08-20 12:56:11', '1');

-- ----------------------------
-- Table structure for ms_ujian
-- ----------------------------
DROP TABLE IF EXISTS `ms_ujian`;
CREATE TABLE `ms_ujian`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nama` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Acak` enum('YA','TIDAK') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Acak soal untuk masing-masing user jika pilihan YA',
  `StartDate` datetime NULL DEFAULT NULL,
  `EndDate` datetime NULL DEFAULT NULL,
  `Durasi` decimal(10, 0) NULL DEFAULT NULL,
  `Score` decimal(10, 0) NULL DEFAULT NULL,
  `Pin` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Status` enum('AKTIF','TIDAK') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_ujian
-- ----------------------------
INSERT INTO `ms_ujian` VALUES (1, 'Psikotest', 'YA', '2024-08-22 07:10:00', '2024-08-22 10:45:00', 90, 5, 'Q6PGBF', 'AKTIF', '2024-08-13 10:18:53', '1', '2024-08-21 07:53:36', '1');
INSERT INTO `ms_ujian` VALUES (2, 'Psikotest 2', 'TIDAK', '2024-08-15 08:00:00', '2024-08-15 09:30:00', 90, 5, '6TAJFU', 'TIDAK', '2024-08-13 10:20:17', '1', '2024-08-15 14:53:03', '1');

-- ----------------------------
-- Table structure for navigation_role
-- ----------------------------
DROP TABLE IF EXISTS `navigation_role`;
CREATE TABLE `navigation_role`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `navigation_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `navigation_role_navigation_id_foreign`(`navigation_id` ASC) USING BTREE,
  INDEX `navigation_role_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `navigation_role_navigation_id_foreign` FOREIGN KEY (`navigation_id`) REFERENCES `navigations` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `navigation_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of navigation_role
-- ----------------------------
INSERT INTO `navigation_role` VALUES (1, 1, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (2, 2, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (3, 3, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (4, 4, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (5, 5, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (7, 7, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (8, 8, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (9, 9, 2, NULL, NULL);
INSERT INTO `navigation_role` VALUES (10, 9, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (13, 12, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (14, 13, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (15, 14, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (17, 16, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (18, 17, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (19, 18, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (20, 19, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (21, 20, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (22, 21, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (23, 22, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (25, 24, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (27, 25, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (28, 25, 4, NULL, NULL);
INSERT INTO `navigation_role` VALUES (29, 26, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (30, 26, 4, NULL, NULL);
INSERT INTO `navigation_role` VALUES (31, 27, 1, NULL, NULL);
INSERT INTO `navigation_role` VALUES (32, 27, 4, NULL, NULL);
INSERT INTO `navigation_role` VALUES (33, 28, 1, NULL, NULL);

-- ----------------------------
-- Table structure for navigations
-- ----------------------------
DROP TABLE IF EXISTS `navigations`;
CREATE TABLE `navigations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `main_menu` bigint NULL DEFAULT NULL,
  `sort` int NOT NULL DEFAULT 0,
  `type_menu` enum('parent','child','single') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'single',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of navigations
-- ----------------------------
INSERT INTO `navigations` VALUES (1, 'Konfigurasi', 'konfigurasi', 'bx bx-cog', NULL, 0, 'parent', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `navigations` VALUES (2, 'Roles', 'roles', '', 1, 0, 'child', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `navigations` VALUES (3, 'Permissions', 'permissions', '', 1, 0, 'child', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `navigations` VALUES (4, 'Navigation', 'navigation', '', 1, 0, 'child', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `navigations` VALUES (5, 'Users', 'users', 'bx bxs-user-plus', NULL, 0, 'single', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `navigations` VALUES (7, 'Master Data', '#', 'bx bx-sitemap', NULL, 0, 'parent', '2024-05-15 01:31:05', '2024-05-15 01:31:05');
INSERT INTO `navigations` VALUES (8, 'Pertanyaan', 'pertanyaan', NULL, 7, 0, 'child', '2024-05-15 07:57:26', '2024-05-15 07:57:26');
INSERT INTO `navigations` VALUES (9, 'Pernyataan', 'pernyataan', NULL, 7, 0, 'child', '2024-05-17 14:15:47', '2024-05-17 14:15:47');
INSERT INTO `navigations` VALUES (12, 'Pelamar', 'pelamar', 'bx bxs-folder-open', NULL, 0, 'parent', '2024-05-17 16:34:11', '2024-05-17 16:34:11');
INSERT INTO `navigations` VALUES (13, 'Identitas Pribadi', 'identitas', NULL, 12, 0, 'child', '2024-05-17 16:35:37', '2024-05-17 16:35:37');
INSERT INTO `navigations` VALUES (14, 'Keluarga & Lingkungan', 'keluarga', NULL, 12, 0, 'child', '2024-05-17 16:36:13', '2024-05-17 16:36:13');
INSERT INTO `navigations` VALUES (16, 'Tambahan Lainnya', 'tambahan', NULL, 12, 0, 'child', '2024-05-17 16:38:24', '2024-05-17 16:39:08');
INSERT INTO `navigations` VALUES (17, 'Catatan Tambahan', 'catatan', NULL, 12, 0, 'child', '2024-05-17 16:39:44', '2024-05-17 16:39:44');
INSERT INTO `navigations` VALUES (18, 'Upload Dokumen', 'dokumen', NULL, 12, 0, 'child', '2024-05-17 16:41:27', '2024-05-17 16:42:21');
INSERT INTO `navigations` VALUES (19, 'Laporan', 'laporan', 'bx bx-receipt', NULL, 0, 'parent', '2024-05-28 09:29:04', '2024-05-28 09:29:04');
INSERT INTO `navigations` VALUES (20, 'Data pelamar', 'report', NULL, 19, 0, 'child', '2024-05-28 09:30:04', '2024-05-28 09:30:34');
INSERT INTO `navigations` VALUES (21, 'Pengalaman Kerja', 'pengalaman', NULL, 12, 0, 'child', '2024-05-30 09:49:52', '2024-05-30 09:49:52');
INSERT INTO `navigations` VALUES (22, 'FAQs', 'faqs', NULL, 7, 0, 'child', '2024-06-10 07:16:09', '2024-06-10 07:16:49');
INSERT INTO `navigations` VALUES (24, 'Psikotest', 'psikotest', 'bx bx-file', NULL, 0, 'parent', '2024-08-13 07:53:38', '2024-08-13 07:53:38');
INSERT INTO `navigations` VALUES (25, 'Type ujian', 'type', NULL, 24, 0, 'child', '2024-08-13 08:04:12', '2024-08-13 08:53:07');
INSERT INTO `navigations` VALUES (26, 'Nama ujian', 'ujian', NULL, 24, 0, 'child', '2024-08-13 08:53:59', '2024-08-13 09:28:15');
INSERT INTO `navigations` VALUES (27, 'Ikut Ujian', 'ikuti', NULL, 24, 0, 'child', '2024-08-14 10:11:10', '2024-08-14 10:11:10');
INSERT INTO `navigations` VALUES (28, 'Laporan Hasil Psikotest', 'hasil', NULL, 19, 0, 'child', '2024-08-19 12:34:13', '2024-08-19 12:34:13');

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 161 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (2, 'read permissions', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (3, 'read roles', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (4, 'read navigation', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (5, 'read users', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (7, 'create permissions', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (8, 'create roles', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (9, 'create navigation', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (10, 'create users', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (12, 'update permissions', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (13, 'update roles', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (14, 'update navigation', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (15, 'update users', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (17, 'delete permissions', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (18, 'delete roles', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (19, 'delete navigation', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (20, 'delete users', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `permissions` VALUES (29, 'read konfigurasi', 'web', '2024-05-15 01:27:10', '2024-05-15 01:27:10');
INSERT INTO `permissions` VALUES (30, 'create konfigurasi', 'web', '2024-05-15 01:27:10', '2024-05-15 01:27:10');
INSERT INTO `permissions` VALUES (31, 'update konfigurasi', 'web', '2024-05-15 01:27:10', '2024-05-15 01:27:10');
INSERT INTO `permissions` VALUES (32, 'delete konfigurasi', 'web', '2024-05-15 01:27:10', '2024-05-15 01:27:10');
INSERT INTO `permissions` VALUES (37, 'read #', 'web', '2024-05-15 01:31:05', '2024-05-15 01:31:05');
INSERT INTO `permissions` VALUES (38, 'create #', 'web', '2024-05-15 01:31:05', '2024-05-15 01:31:05');
INSERT INTO `permissions` VALUES (39, 'update #', 'web', '2024-05-15 01:31:05', '2024-05-15 01:31:05');
INSERT INTO `permissions` VALUES (40, 'delete #', 'web', '2024-05-15 01:31:05', '2024-05-15 01:31:05');
INSERT INTO `permissions` VALUES (41, 'read pertanyaan', 'web', '2024-05-15 07:57:26', '2024-05-15 07:57:26');
INSERT INTO `permissions` VALUES (42, 'create pertanyaan', 'web', '2024-05-15 07:57:26', '2024-05-15 07:57:26');
INSERT INTO `permissions` VALUES (43, 'update pertanyaan', 'web', '2024-05-15 07:57:26', '2024-05-15 07:57:26');
INSERT INTO `permissions` VALUES (44, 'delete pertanyaan', 'web', '2024-05-15 07:57:26', '2024-05-15 07:57:26');
INSERT INTO `permissions` VALUES (49, 'read pernyataan', 'web', '2024-05-17 14:16:41', '2024-05-17 14:16:41');
INSERT INTO `permissions` VALUES (50, 'create pernyataan', 'web', '2024-05-17 14:16:41', '2024-05-17 14:16:41');
INSERT INTO `permissions` VALUES (51, 'update pernyataan', 'web', '2024-05-17 14:16:41', '2024-05-17 14:16:41');
INSERT INTO `permissions` VALUES (52, 'delete pernyataan', 'web', '2024-05-17 14:16:41', '2024-05-17 14:16:41');
INSERT INTO `permissions` VALUES (65, 'read pelamar', 'web', '2024-05-17 16:34:10', '2024-05-17 16:34:10');
INSERT INTO `permissions` VALUES (66, 'create pelamar', 'web', '2024-05-17 16:34:10', '2024-05-17 16:34:10');
INSERT INTO `permissions` VALUES (67, 'update pelamar', 'web', '2024-05-17 16:34:10', '2024-05-17 16:34:10');
INSERT INTO `permissions` VALUES (68, 'delete pelamar', 'web', '2024-05-17 16:34:10', '2024-05-17 16:34:10');
INSERT INTO `permissions` VALUES (69, 'read identitas', 'web', '2024-05-17 16:35:37', '2024-05-17 16:35:37');
INSERT INTO `permissions` VALUES (70, 'create identitas', 'web', '2024-05-17 16:35:37', '2024-05-17 16:35:37');
INSERT INTO `permissions` VALUES (71, 'update identitas', 'web', '2024-05-17 16:35:37', '2024-05-17 16:35:37');
INSERT INTO `permissions` VALUES (72, 'delete identitas', 'web', '2024-05-17 16:35:37', '2024-05-17 16:35:37');
INSERT INTO `permissions` VALUES (73, 'read keluarga', 'web', '2024-05-17 16:36:13', '2024-05-17 16:36:13');
INSERT INTO `permissions` VALUES (74, 'create keluarga', 'web', '2024-05-17 16:36:13', '2024-05-17 16:36:13');
INSERT INTO `permissions` VALUES (75, 'update keluarga', 'web', '2024-05-17 16:36:13', '2024-05-17 16:36:13');
INSERT INTO `permissions` VALUES (76, 'delete keluarga', 'web', '2024-05-17 16:36:13', '2024-05-17 16:36:13');
INSERT INTO `permissions` VALUES (85, 'read tambahan', 'web', '2024-05-17 16:39:08', '2024-05-17 16:39:08');
INSERT INTO `permissions` VALUES (86, 'create tambahan', 'web', '2024-05-17 16:39:08', '2024-05-17 16:39:08');
INSERT INTO `permissions` VALUES (87, 'update tambahan', 'web', '2024-05-17 16:39:08', '2024-05-17 16:39:08');
INSERT INTO `permissions` VALUES (88, 'delete tambahan', 'web', '2024-05-17 16:39:08', '2024-05-17 16:39:08');
INSERT INTO `permissions` VALUES (89, 'read catatan', 'web', '2024-05-17 16:39:44', '2024-05-17 16:39:44');
INSERT INTO `permissions` VALUES (90, 'create catatan', 'web', '2024-05-17 16:39:44', '2024-05-17 16:39:44');
INSERT INTO `permissions` VALUES (91, 'update catatan', 'web', '2024-05-17 16:39:44', '2024-05-17 16:39:44');
INSERT INTO `permissions` VALUES (92, 'delete catatan', 'web', '2024-05-17 16:39:44', '2024-05-17 16:39:44');
INSERT INTO `permissions` VALUES (97, 'read dokumen', 'web', '2024-05-17 16:42:21', '2024-05-17 16:42:21');
INSERT INTO `permissions` VALUES (98, 'create dokumen', 'web', '2024-05-17 16:42:21', '2024-05-17 16:42:21');
INSERT INTO `permissions` VALUES (99, 'update dokumen', 'web', '2024-05-17 16:42:21', '2024-05-17 16:42:21');
INSERT INTO `permissions` VALUES (100, 'delete dokumen', 'web', '2024-05-17 16:42:21', '2024-05-17 16:42:21');
INSERT INTO `permissions` VALUES (101, 'read laporan', 'web', '2024-05-28 09:29:04', '2024-05-28 09:29:04');
INSERT INTO `permissions` VALUES (102, 'create laporan', 'web', '2024-05-28 09:29:04', '2024-05-28 09:29:04');
INSERT INTO `permissions` VALUES (103, 'update laporan', 'web', '2024-05-28 09:29:04', '2024-05-28 09:29:04');
INSERT INTO `permissions` VALUES (104, 'delete laporan', 'web', '2024-05-28 09:29:04', '2024-05-28 09:29:04');
INSERT INTO `permissions` VALUES (109, 'read report', 'web', '2024-05-28 09:30:34', '2024-05-28 09:30:34');
INSERT INTO `permissions` VALUES (110, 'create report', 'web', '2024-05-28 09:30:34', '2024-05-28 09:30:34');
INSERT INTO `permissions` VALUES (111, 'update report', 'web', '2024-05-28 09:30:34', '2024-05-28 09:30:34');
INSERT INTO `permissions` VALUES (112, 'delete report', 'web', '2024-05-28 09:30:34', '2024-05-28 09:30:34');
INSERT INTO `permissions` VALUES (113, 'read pengalaman', 'web', '2024-05-30 09:49:52', '2024-05-30 09:49:52');
INSERT INTO `permissions` VALUES (114, 'create pengalaman', 'web', '2024-05-30 09:49:52', '2024-05-30 09:49:52');
INSERT INTO `permissions` VALUES (115, 'update pengalaman', 'web', '2024-05-30 09:49:52', '2024-05-30 09:49:52');
INSERT INTO `permissions` VALUES (116, 'delete pengalaman', 'web', '2024-05-30 09:49:52', '2024-05-30 09:49:52');
INSERT INTO `permissions` VALUES (121, 'read faqs', 'web', '2024-06-10 07:16:49', '2024-06-10 07:16:49');
INSERT INTO `permissions` VALUES (122, 'create faqs', 'web', '2024-06-10 07:16:49', '2024-06-10 07:16:49');
INSERT INTO `permissions` VALUES (123, 'update faqs', 'web', '2024-06-10 07:16:49', '2024-06-10 07:16:49');
INSERT INTO `permissions` VALUES (124, 'delete faqs', 'web', '2024-06-10 07:16:49', '2024-06-10 07:16:49');
INSERT INTO `permissions` VALUES (125, 'read test', 'web', '2024-06-10 10:08:09', '2024-06-10 10:08:09');
INSERT INTO `permissions` VALUES (126, 'create test', 'web', '2024-06-10 10:08:09', '2024-06-10 10:08:09');
INSERT INTO `permissions` VALUES (127, 'update test', 'web', '2024-06-10 10:08:09', '2024-06-10 10:08:09');
INSERT INTO `permissions` VALUES (128, 'delete test', 'web', '2024-06-10 10:08:09', '2024-06-10 10:08:09');
INSERT INTO `permissions` VALUES (137, 'read type', 'web', '2024-08-13 08:53:07', '2024-08-13 08:53:07');
INSERT INTO `permissions` VALUES (138, 'create type', 'web', '2024-08-13 08:53:07', '2024-08-13 08:53:07');
INSERT INTO `permissions` VALUES (139, 'update type', 'web', '2024-08-13 08:53:07', '2024-08-13 08:53:07');
INSERT INTO `permissions` VALUES (140, 'delete type', 'web', '2024-08-13 08:53:07', '2024-08-13 08:53:07');
INSERT INTO `permissions` VALUES (145, 'read ujian', 'web', '2024-08-13 09:28:15', '2024-08-13 09:28:15');
INSERT INTO `permissions` VALUES (146, 'create ujian', 'web', '2024-08-13 09:28:15', '2024-08-13 09:28:15');
INSERT INTO `permissions` VALUES (147, 'update ujian', 'web', '2024-08-13 09:28:15', '2024-08-13 09:28:15');
INSERT INTO `permissions` VALUES (148, 'delete ujian', 'web', '2024-08-13 09:28:15', '2024-08-13 09:28:15');
INSERT INTO `permissions` VALUES (149, 'read ikuti', 'web', '2024-08-14 10:11:10', '2024-08-14 10:11:10');
INSERT INTO `permissions` VALUES (150, 'create ikuti', 'web', '2024-08-14 10:11:10', '2024-08-14 10:11:10');
INSERT INTO `permissions` VALUES (151, 'update ikuti', 'web', '2024-08-14 10:11:10', '2024-08-14 10:11:10');
INSERT INTO `permissions` VALUES (152, 'delete ikuti', 'web', '2024-08-14 10:11:10', '2024-08-14 10:11:10');
INSERT INTO `permissions` VALUES (153, 'read hasil', 'web', '2024-08-19 12:34:12', '2024-08-19 12:34:12');
INSERT INTO `permissions` VALUES (154, 'create hasil', 'web', '2024-08-19 12:34:12', '2024-08-19 12:34:12');
INSERT INTO `permissions` VALUES (155, 'update hasil', 'web', '2024-08-19 12:34:12', '2024-08-19 12:34:12');
INSERT INTO `permissions` VALUES (156, 'delete hasil', 'web', '2024-08-19 12:34:13', '2024-08-19 12:34:13');
INSERT INTO `permissions` VALUES (157, 'read psikotest', 'web', '2024-08-21 09:23:17', '2024-08-21 09:23:17');
INSERT INTO `permissions` VALUES (158, 'create psikotest', 'web', '2024-08-21 09:23:17', '2024-08-21 09:23:17');
INSERT INTO `permissions` VALUES (159, 'update psikotest', 'web', '2024-08-21 09:23:17', '2024-08-21 09:23:17');
INSERT INTO `permissions` VALUES (160, 'delete psikotest', 'web', '2024-08-21 09:23:17', '2024-08-21 09:23:17');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (2, 1);
INSERT INTO `role_has_permissions` VALUES (3, 1);
INSERT INTO `role_has_permissions` VALUES (4, 1);
INSERT INTO `role_has_permissions` VALUES (5, 1);
INSERT INTO `role_has_permissions` VALUES (7, 1);
INSERT INTO `role_has_permissions` VALUES (8, 1);
INSERT INTO `role_has_permissions` VALUES (9, 1);
INSERT INTO `role_has_permissions` VALUES (10, 1);
INSERT INTO `role_has_permissions` VALUES (12, 1);
INSERT INTO `role_has_permissions` VALUES (13, 1);
INSERT INTO `role_has_permissions` VALUES (14, 1);
INSERT INTO `role_has_permissions` VALUES (15, 1);
INSERT INTO `role_has_permissions` VALUES (17, 1);
INSERT INTO `role_has_permissions` VALUES (18, 1);
INSERT INTO `role_has_permissions` VALUES (19, 1);
INSERT INTO `role_has_permissions` VALUES (20, 1);
INSERT INTO `role_has_permissions` VALUES (29, 1);
INSERT INTO `role_has_permissions` VALUES (30, 1);
INSERT INTO `role_has_permissions` VALUES (31, 1);
INSERT INTO `role_has_permissions` VALUES (32, 1);
INSERT INTO `role_has_permissions` VALUES (37, 1);
INSERT INTO `role_has_permissions` VALUES (38, 1);
INSERT INTO `role_has_permissions` VALUES (39, 1);
INSERT INTO `role_has_permissions` VALUES (40, 1);
INSERT INTO `role_has_permissions` VALUES (41, 1);
INSERT INTO `role_has_permissions` VALUES (42, 1);
INSERT INTO `role_has_permissions` VALUES (43, 1);
INSERT INTO `role_has_permissions` VALUES (44, 1);
INSERT INTO `role_has_permissions` VALUES (49, 1);
INSERT INTO `role_has_permissions` VALUES (50, 1);
INSERT INTO `role_has_permissions` VALUES (51, 1);
INSERT INTO `role_has_permissions` VALUES (52, 1);
INSERT INTO `role_has_permissions` VALUES (65, 1);
INSERT INTO `role_has_permissions` VALUES (66, 1);
INSERT INTO `role_has_permissions` VALUES (67, 1);
INSERT INTO `role_has_permissions` VALUES (68, 1);
INSERT INTO `role_has_permissions` VALUES (69, 1);
INSERT INTO `role_has_permissions` VALUES (70, 1);
INSERT INTO `role_has_permissions` VALUES (71, 1);
INSERT INTO `role_has_permissions` VALUES (72, 1);
INSERT INTO `role_has_permissions` VALUES (73, 1);
INSERT INTO `role_has_permissions` VALUES (74, 1);
INSERT INTO `role_has_permissions` VALUES (75, 1);
INSERT INTO `role_has_permissions` VALUES (76, 1);
INSERT INTO `role_has_permissions` VALUES (85, 1);
INSERT INTO `role_has_permissions` VALUES (86, 1);
INSERT INTO `role_has_permissions` VALUES (87, 1);
INSERT INTO `role_has_permissions` VALUES (88, 1);
INSERT INTO `role_has_permissions` VALUES (89, 1);
INSERT INTO `role_has_permissions` VALUES (90, 1);
INSERT INTO `role_has_permissions` VALUES (91, 1);
INSERT INTO `role_has_permissions` VALUES (92, 1);
INSERT INTO `role_has_permissions` VALUES (97, 1);
INSERT INTO `role_has_permissions` VALUES (98, 1);
INSERT INTO `role_has_permissions` VALUES (99, 1);
INSERT INTO `role_has_permissions` VALUES (100, 1);
INSERT INTO `role_has_permissions` VALUES (101, 1);
INSERT INTO `role_has_permissions` VALUES (102, 1);
INSERT INTO `role_has_permissions` VALUES (103, 1);
INSERT INTO `role_has_permissions` VALUES (104, 1);
INSERT INTO `role_has_permissions` VALUES (109, 1);
INSERT INTO `role_has_permissions` VALUES (110, 1);
INSERT INTO `role_has_permissions` VALUES (111, 1);
INSERT INTO `role_has_permissions` VALUES (112, 1);
INSERT INTO `role_has_permissions` VALUES (113, 1);
INSERT INTO `role_has_permissions` VALUES (114, 1);
INSERT INTO `role_has_permissions` VALUES (115, 1);
INSERT INTO `role_has_permissions` VALUES (116, 1);
INSERT INTO `role_has_permissions` VALUES (121, 1);
INSERT INTO `role_has_permissions` VALUES (122, 1);
INSERT INTO `role_has_permissions` VALUES (123, 1);
INSERT INTO `role_has_permissions` VALUES (124, 1);
INSERT INTO `role_has_permissions` VALUES (125, 1);
INSERT INTO `role_has_permissions` VALUES (126, 1);
INSERT INTO `role_has_permissions` VALUES (127, 1);
INSERT INTO `role_has_permissions` VALUES (128, 1);
INSERT INTO `role_has_permissions` VALUES (137, 1);
INSERT INTO `role_has_permissions` VALUES (138, 1);
INSERT INTO `role_has_permissions` VALUES (139, 1);
INSERT INTO `role_has_permissions` VALUES (140, 1);
INSERT INTO `role_has_permissions` VALUES (145, 1);
INSERT INTO `role_has_permissions` VALUES (146, 1);
INSERT INTO `role_has_permissions` VALUES (147, 1);
INSERT INTO `role_has_permissions` VALUES (148, 1);
INSERT INTO `role_has_permissions` VALUES (149, 1);
INSERT INTO `role_has_permissions` VALUES (150, 1);
INSERT INTO `role_has_permissions` VALUES (151, 1);
INSERT INTO `role_has_permissions` VALUES (152, 1);
INSERT INTO `role_has_permissions` VALUES (153, 1);
INSERT INTO `role_has_permissions` VALUES (154, 1);
INSERT INTO `role_has_permissions` VALUES (155, 1);
INSERT INTO `role_has_permissions` VALUES (156, 1);
INSERT INTO `role_has_permissions` VALUES (157, 1);
INSERT INTO `role_has_permissions` VALUES (158, 1);
INSERT INTO `role_has_permissions` VALUES (159, 1);
INSERT INTO `role_has_permissions` VALUES (160, 1);
INSERT INTO `role_has_permissions` VALUES (2, 2);
INSERT INTO `role_has_permissions` VALUES (3, 2);
INSERT INTO `role_has_permissions` VALUES (4, 2);
INSERT INTO `role_has_permissions` VALUES (5, 2);
INSERT INTO `role_has_permissions` VALUES (29, 2);
INSERT INTO `role_has_permissions` VALUES (49, 2);
INSERT INTO `role_has_permissions` VALUES (50, 2);
INSERT INTO `role_has_permissions` VALUES (51, 2);
INSERT INTO `role_has_permissions` VALUES (52, 2);
INSERT INTO `role_has_permissions` VALUES (41, 4);
INSERT INTO `role_has_permissions` VALUES (65, 4);
INSERT INTO `role_has_permissions` VALUES (69, 4);
INSERT INTO `role_has_permissions` VALUES (70, 4);
INSERT INTO `role_has_permissions` VALUES (71, 4);
INSERT INTO `role_has_permissions` VALUES (72, 4);
INSERT INTO `role_has_permissions` VALUES (73, 4);
INSERT INTO `role_has_permissions` VALUES (74, 4);
INSERT INTO `role_has_permissions` VALUES (75, 4);
INSERT INTO `role_has_permissions` VALUES (76, 4);
INSERT INTO `role_has_permissions` VALUES (85, 4);
INSERT INTO `role_has_permissions` VALUES (86, 4);
INSERT INTO `role_has_permissions` VALUES (87, 4);
INSERT INTO `role_has_permissions` VALUES (88, 4);
INSERT INTO `role_has_permissions` VALUES (89, 4);
INSERT INTO `role_has_permissions` VALUES (90, 4);
INSERT INTO `role_has_permissions` VALUES (91, 4);
INSERT INTO `role_has_permissions` VALUES (92, 4);
INSERT INTO `role_has_permissions` VALUES (97, 4);
INSERT INTO `role_has_permissions` VALUES (98, 4);
INSERT INTO `role_has_permissions` VALUES (99, 4);
INSERT INTO `role_has_permissions` VALUES (100, 4);
INSERT INTO `role_has_permissions` VALUES (113, 4);
INSERT INTO `role_has_permissions` VALUES (114, 4);
INSERT INTO `role_has_permissions` VALUES (115, 4);
INSERT INTO `role_has_permissions` VALUES (116, 4);
INSERT INTO `role_has_permissions` VALUES (149, 4);
INSERT INTO `role_has_permissions` VALUES (150, 4);
INSERT INTO `role_has_permissions` VALUES (151, 4);
INSERT INTO `role_has_permissions` VALUES (152, 4);
INSERT INTO `role_has_permissions` VALUES (157, 4);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', 'web', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `roles` VALUES (2, 'Manager', 'web', '2024-05-13 02:26:25', '2024-05-15 03:07:21');
INSERT INTO `roles` VALUES (3, 'Spv', 'web', '2024-05-13 02:26:25', '2024-05-15 03:07:36');
INSERT INTO `roles` VALUES (4, 'Pelamar', 'web', '2024-05-13 02:44:47', '2024-05-17 16:21:07');

-- ----------------------------
-- Table structure for trans_anak
-- ----------------------------
DROP TABLE IF EXISTS `trans_anak`;
CREATE TABLE `trans_anak`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nama` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TempatLahir` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TanggalLahir` date NULL DEFAULT NULL,
  `Pendidikan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Pekerjaan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_anak
-- ----------------------------

-- ----------------------------
-- Table structure for trans_catatan_tambahan
-- ----------------------------
DROP TABLE IF EXISTS `trans_catatan_tambahan`;
CREATE TABLE `trans_catatan_tambahan`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Keterangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_catatan_tambahan
-- ----------------------------

-- ----------------------------
-- Table structure for trans_document
-- ----------------------------
DROP TABLE IF EXISTS `trans_document`;
CREATE TABLE `trans_document`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `NamaDokumen` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TypeDokumen` enum('Lamaran','CV','KTP','NPWP','Ijazah','SKCK','KK','Dokter','Vaksin','Foto') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TypeFile` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UkuranFile` decimal(10, 2) NULL DEFAULT NULL,
  `File` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_document
-- ----------------------------

-- ----------------------------
-- Table structure for trans_hasilujian
-- ----------------------------
DROP TABLE IF EXISTS `trans_hasilujian`;
CREATE TABLE `trans_hasilujian`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `IdUjian` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Score` decimal(10, 2) NULL DEFAULT NULL,
  `Benar` decimal(10, 0) NULL DEFAULT NULL,
  `Salah` decimal(10, 0) NULL DEFAULT NULL,
  `Kosong` decimal(10, 0) NULL DEFAULT NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_hasilujian
-- ----------------------------
INSERT INTO `trans_hasilujian` VALUES (6, '1', 0.00, 0, 0, 85, '2024-08-22 09:30:50', '52');

-- ----------------------------
-- Table structure for trans_identitaspribadi
-- ----------------------------
DROP TABLE IF EXISTS `trans_identitaspribadi`;
CREATE TABLE `trans_identitaspribadi`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nama` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TempatLahir` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TanggalLahir` date NULL DEFAULT NULL,
  `Jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `StatusNikah` enum('BK','K','CH','CM') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `NoKtp` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `AlamatKtp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `AlamatRumahTinggal` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `StatusKepemilikan` enum('Sendiri','Keluarga','Sewa','Kost') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `NoHp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Sosmed` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `Kewarganegaraan` enum('WNI','WNA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Agama` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `BeratBadan` decimal(10, 0) NULL DEFAULT NULL,
  `TinggiBadan` decimal(10, 0) NULL DEFAULT NULL,
  `GolDarah` enum('A','B','AB','O') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Vaksin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `Alergi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `Pengobatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `Department` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Posisi` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `SumberInfo` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `GajiDiminta` decimal(10, 2) NULL DEFAULT NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_identitaspribadi
-- ----------------------------
INSERT INTO `trans_identitaspribadi` VALUES (6, 'Mudin', 'Tangerang', '2024-08-22', 'L', 'BK', '8900010001222', 'Perum Griya Curug Blok A3 No. 08', 'Perum Griya Curug Blok A3 No. 08', 'Sendiri', '081298061130', 'nj.mudin18@gmail.com', 'https://wordcounter.net/character-count', 'WNI', 'Islam', 70, 170, 'A', 'V1', 'Alergi debu', NULL, 'IT', 'Staff IT', 'Jobstreet', 5000000.00, '2024-08-22 09:27:39', '52', NULL, NULL);

-- ----------------------------
-- Table structure for trans_jawaban_pertanyaan
-- ----------------------------
DROP TABLE IF EXISTS `trans_jawaban_pertanyaan`;
CREATE TABLE `trans_jawaban_pertanyaan`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `KodePertanyaan` int NULL DEFAULT NULL,
  `Jawaban` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Penjelasan` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_jawaban_pertanyaan
-- ----------------------------

-- ----------------------------
-- Table structure for trans_kontakdarurat
-- ----------------------------
DROP TABLE IF EXISTS `trans_kontakdarurat`;
CREATE TABLE `trans_kontakdarurat`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nama` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Hubungan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `NoHp` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_kontakdarurat
-- ----------------------------

-- ----------------------------
-- Table structure for trans_orangtua
-- ----------------------------
DROP TABLE IF EXISTS `trans_orangtua`;
CREATE TABLE `trans_orangtua`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nama` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TempatLahir` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TanggalLahir` date NULL DEFAULT NULL,
  `Alamat` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `Pendidikan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Pekerjaan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_orangtua
-- ----------------------------

-- ----------------------------
-- Table structure for trans_pasangan
-- ----------------------------
DROP TABLE IF EXISTS `trans_pasangan`;
CREATE TABLE `trans_pasangan`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `NamaPasangan` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TempatLahir` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TanggalLahir` date NULL DEFAULT NULL,
  `Jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `AlamatKtp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `Pendidikan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Pekerjaan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Perusahaan` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `NoHp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Jabatan` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Sosmed` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_pasangan
-- ----------------------------

-- ----------------------------
-- Table structure for trans_pengalaman_kerja
-- ----------------------------
DROP TABLE IF EXISTS `trans_pengalaman_kerja`;
CREATE TABLE `trans_pengalaman_kerja`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Perusahaan` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Posisi` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `StartDate` date NULL DEFAULT NULL,
  `EndDate` date NULL DEFAULT NULL,
  `JobDesc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_pengalaman_kerja
-- ----------------------------

-- ----------------------------
-- Table structure for trans_saudara
-- ----------------------------
DROP TABLE IF EXISTS `trans_saudara`;
CREATE TABLE `trans_saudara`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nama` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TempatLahir` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TanggalLahir` date NULL DEFAULT NULL,
  `Pendidikan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Pekerjaan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_saudara
-- ----------------------------

-- ----------------------------
-- Table structure for trans_soal
-- ----------------------------
DROP TABLE IF EXISTS `trans_soal`;
CREATE TABLE `trans_soal`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `IdUjian` int NULL DEFAULT NULL,
  `IdTypeUjian` int NULL DEFAULT NULL,
  `Soal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `A` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `B` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `C` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `D` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `E` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Kunci` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Gambar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `PosisiGambar` enum('Atas','Bawah','None','Tengah') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Status` enum('AKTIF','TIDAK') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 112 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_soal
-- ----------------------------
INSERT INTO `trans_soal` VALUES (3, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Suatu …………….. tidak termasuk persoalan pencegahan kecelakaan</span></p>', 'Lampu Lalu Lintas', 'Kacamata Pelindung', 'Kotak PPPK', 'Tanda Peringatan', 'Palang Kereta Api', 'C', NULL, 'None', 'AKTIF', '2024-08-13 14:41:49', '1', '2024-08-14 08:01:49', '1');
INSERT INTO `trans_soal` VALUES (4, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Mata uang dari <b>Rp.50</b>,- garis tengahnya adalah ……………………… mm</span></p>', '17', '29', '25', '24', '15', 'C', NULL, 'None', 'AKTIF', '2024-08-13 14:55:09', '1', '2024-08-14 08:01:44', '1');
INSERT INTO `trans_soal` VALUES (5, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Seseorang yang bersikap menyangsikan setiap kemajuan adalah seorang yang ………………………</span></p>', 'Demokratis', 'Radikal', 'Liberal', 'Konservatif', 'Anarkis', 'D', NULL, 'None', 'AKTIF', '2024-08-13 14:56:54', '1', '2024-08-14 08:01:39', '1');
INSERT INTO `trans_soal` VALUES (6, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Lawannya “tidak pernah” adalah …………………………..</span></p>', 'Sering', 'Kadang', 'Jarang', 'Kerap Kali', 'Selalu', 'E', NULL, 'None', 'AKTIF', '2024-08-13 14:58:49', '1', '2024-08-14 08:01:31', '1');
INSERT INTO `trans_soal` VALUES (7, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Jarak antara Jakarta – Surabaya ialah kira-kira ……………</span></p>', '650', '1000', '800', '6000', '950', 'C', NULL, 'None', 'AKTIF', '2024-08-13 14:59:47', '1', '2024-08-14 08:01:21', '1');
INSERT INTO `trans_soal` VALUES (8, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Untuk dapat membuat nada yang rendah dan mendalam, kita memerlukan banyak………………</span></p>', 'Kekuatan', 'Peranan', 'Ayunan', 'Berat', 'Suara', 'A', NULL, 'None', 'AKTIF', '2024-08-13 15:04:31', '1', '2024-08-14 08:01:15', '1');
INSERT INTO `trans_soal` VALUES (9, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Ayah …………………….. lebih pengalaman daripada anaknya</span></p>', 'Selalu', 'Biasanya', 'Jauh', 'Jarang', 'Pada Dasarnya', 'B', NULL, 'None', 'AKTIF', '2024-08-13 15:10:42', '1', '2024-08-14 08:01:05', '1');
INSERT INTO `trans_soal` VALUES (10, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Diantara kota-kota berikut, maka kota ……………….. letaknya paling selatan</span></p>', 'Jakarta', 'Bandung', 'Cirebon', 'Semarang', 'Surabaya', 'B', NULL, 'None', 'AKTIF', '2024-08-13 15:11:39', '1', '2024-08-14 08:00:59', '1');
INSERT INTO `trans_soal` VALUES (11, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Jika kita mengetahui jumlah persentase nomor-nomor lotere yang tidak menang, maka kita dapat&nbsp;</span><span style=\"font-family: Tahoma; background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">menghitung……………………</span></p>', 'Jumlah Nomor Yang Menang', 'Pajak Lotere', 'Kemungkinan Menang', 'Jumlah Pengikut', 'Tinggi', 'C', NULL, 'None', 'AKTIF', '2024-08-13 15:17:05', '1', '2024-08-14 08:00:52', '1');
INSERT INTO `trans_soal` VALUES (12, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Seorang anak yang baru berumur 10 tahun tingginya rata-rata ……………………</span></p>', '150', '130', '110', '105', '115', 'B', NULL, 'None', 'AKTIF', '2024-08-13 15:18:07', '1', '2024-08-14 08:00:17', '1');
INSERT INTO `trans_soal` VALUES (13, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Pengaruh seseorang terhadap orang lain seharusnya tergantung pada……………………</span></p>', 'Kekuasaan', 'Bujukan', 'Kekayaan', 'Keberanian', 'Kewibawaan', 'E', NULL, 'None', 'AKTIF', '2024-08-14 08:05:28', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (14, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Lawannya “hemat” adalah ………………………….</span></p>', 'Murah', 'Kikir', 'Boros', 'Berani', 'Kaya', 'C', NULL, 'None', 'AKTIF', '2024-08-14 08:18:14', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (15, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">……………………..tidak termasuk cuaca</span></p>', 'Angin Puyuh', 'Halilintar', 'Salju', 'Gempa Bumi', 'Kabut', 'D', NULL, 'None', 'AKTIF', '2024-08-14 08:19:20', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (16, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Lawannya “setia” adalah ……………………….</span></p>', 'Cinta', 'Benci', 'Persahabatan', 'Khianat', 'Permusuhan', 'D', NULL, 'None', 'AKTIF', '2024-08-14 08:20:27', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (17, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Seekor kuda selalu mempunyai …………………………</span></p>', 'Kandang', 'Ladam', 'Pelana', 'Kuku', 'Surai', 'D', NULL, 'None', 'AKTIF', '2024-08-14 08:21:27', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (18, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Seorang paman …………………. lebih tua dari kemenakannya</span></p>', 'Jarang', 'Biasanya', 'Selalu', 'Tak Pernah', 'Kadang-kadang', 'B', NULL, 'None', 'AKTIF', '2024-08-14 08:22:25', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (19, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Pada jumlah yang sama, nilai kalori tertinggi terdapat pada ………………….</span></p>', 'Ikan', 'Daging', 'Lemak', 'Tahu', 'Sayuran', 'C', NULL, 'None', 'AKTIF', '2024-08-14 08:23:05', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (20, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Pada suatu pertandingan selalu terdapat ………………………</span></p>', 'Lawan', 'Wasit', 'Penonton', 'Sorak', 'Kemenangan', 'A', NULL, 'None', 'AKTIF', '2024-08-14 08:23:43', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (21, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Suatu pernyataan yang belum dipastikan dikatakan sebagai pernyataan yang ……………….</span></p>', 'Paradoks', 'Tergesa-gesa', 'Mempunyai Arti Lengkap', 'Menyesatkan', 'Hipotesis', 'E', NULL, 'None', 'AKTIF', '2024-08-14 08:24:37', '1', '2024-08-14 09:12:12', '1');
INSERT INTO `trans_soal` VALUES (22, 1, 1, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Pada sepatu selalu terdapat …………………</span></p>', 'Kulit', 'Sol', 'Tali Sepatu', 'Gesper', 'Lidah', 'B', NULL, 'None', 'AKTIF', '2024-08-14 08:25:15', '1', '2024-08-14 10:05:28', '1');
INSERT INTO `trans_soal` VALUES (27, 1, 2, '<p>-</p>', 'Jarak', 'Perpisahan', 'Tugas', 'Batas', 'Perceraian', 'A', NULL, 'None', 'AKTIF', '2024-08-15 08:45:11', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (28, 1, 2, '<p>-</p>', 'Saringan', 'Kelambu', 'Payung', 'Tapisan', 'Jala', 'C', NULL, 'None', 'AKTIF', '2024-08-15 08:46:02', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (29, 1, 2, '<p>-</p>', 'Putih', 'Pucat', 'Buram', 'Kasar', 'Berkilauan', 'D', NULL, 'None', 'AKTIF', '2024-08-15 08:47:02', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (30, 1, 2, '<p>-</p>', 'Otobis', 'Pesawat Terbang', 'Sepeda Motor', 'Sepeda', 'Kapal Api', 'D', NULL, 'None', 'AKTIF', '2024-08-15 08:47:51', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (31, 1, 2, '<p>-</p>', 'Biola', 'Seruling', 'Clarinet', 'Terompet', 'Saxophone', 'A', NULL, 'None', 'AKTIF', '2024-08-15 08:48:38', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (32, 1, 2, '<p>-</p>', 'Lingkaran', 'Panah', 'Elips', 'Busur', 'Lengkungan', 'B', NULL, 'None', 'AKTIF', '2024-08-15 08:49:38', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (33, 1, 2, '<p>-</p>', 'Mengetuk', 'Memaki', 'Menjahit', 'Menggergaji', 'Memukul', 'B', NULL, 'None', 'AKTIF', '2024-08-15 08:50:26', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (34, 1, 2, '<p>-</p>', 'Lebar', 'Keliling', 'Luas', 'Isi', 'Panjang', 'D', NULL, 'None', 'AKTIF', '2024-08-15 08:51:07', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (35, 1, 2, '<p>-</p>', 'Mengikat', 'Menyatukan', 'Melepaskan', 'Mengaitkan', 'Melekatkan', 'C', NULL, 'None', 'AKTIF', '2024-08-15 08:52:13', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (36, 1, 2, '<p>-</p>', 'Arah', 'Timur', 'Perjalanan', 'Tujuan', 'Selatan', 'C', NULL, 'None', 'AKTIF', '2024-08-15 08:52:58', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (37, 1, 2, '<p>-</p>', 'Bergelombang', 'Kasar', 'Berduri', 'Licin', 'Lurus', 'E', NULL, 'None', 'AKTIF', '2024-08-15 08:54:06', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (38, 1, 2, '<p>-</p>', 'Jam', 'Kompas', 'Penunjuk Jalan', 'Bintang Pari', 'Arah', 'A', NULL, 'None', 'AKTIF', '2024-08-15 08:54:51', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (39, 1, 2, '<p>-</p>', 'Kebijaksanaan', 'Pendidikan', 'Perencanaan', 'Penempatan', 'Pengarahan', 'A', NULL, 'None', 'AKTIF', '2024-08-15 08:55:48', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (40, 1, 2, '<p>-</p>', 'Bermotor', 'Berjalan', 'Berlayar', 'Bersepeda', 'Berkuda', 'B', NULL, 'None', 'AKTIF', '2024-08-15 08:56:37', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (41, 1, 2, '<p>-</p>', 'Gambar', 'Lukisan', 'Potret', 'Patung', 'Ukiran', 'D', NULL, 'None', 'AKTIF', '2024-08-15 08:57:27', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (42, 1, 2, '<p>-</p>', 'Jembatan', 'Batas', 'Perkawinan', 'Pagar', 'Masyarakat', 'E', NULL, 'None', 'AKTIF', '2024-08-15 08:58:19', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (43, 1, 2, '<p>-</p>', 'Mengetam', 'Memahat', 'Mengasah', 'Melicinkan', 'Menggosok', 'B', NULL, 'None', 'AKTIF', '2024-08-15 08:59:06', '1', '2024-08-15 14:07:18', '1');
INSERT INTO `trans_soal` VALUES (44, 1, 2, '<p>-</p>', 'Panjang', 'Lonjong', 'Runcing', 'Bulat', 'Bersudut', 'A', NULL, 'None', 'AKTIF', '2024-08-15 08:59:49', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (45, 1, 2, '<p>-</p>', 'Kunci', 'Palang Pintu', 'Gerendel', 'Gunting', 'Obeng', 'D', NULL, 'None', 'AKTIF', '2024-08-15 09:00:36', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (46, 1, 2, '<p>-</p>', 'Batu', 'Baja', 'Bulu', 'Karet', 'Kayu', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:01:17', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (47, 1, 3, '<p><span style=\"font-family: Tahoma;\">Menemukan : menghilangkan &gt; Mengingat :</span><br></p>', 'Mengahafal', 'Mengenal', 'Melupakan', 'Berfikir', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:09:06', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (48, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Bunga : jambangan &gt; Burung :</span></p>', 'Sarang', 'Langit', 'Pohon', 'Sangkar', '', 'D', NULL, 'None', 'AKTIF', '2024-08-15 09:18:38', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (49, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Kereta api : Rel &gt; Otobis</span></p>', 'Roda', 'Poros', 'Ban', 'Jalan Raya', '', 'D', NULL, 'None', 'AKTIF', '2024-08-15 09:19:20', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (50, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Perak : emas &gt; Cincin :</span></p>', 'Arloji', 'Berlian', 'Permata', 'Gelang', '', 'D', NULL, 'None', 'AKTIF', '2024-08-15 09:19:56', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (51, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Lingakaran : bola &gt; bujur sangkar :</span></p>', 'Bentuk', 'Gambar', 'Segi Empat', 'Kubus', '', 'D', NULL, 'None', 'AKTIF', '2024-08-15 09:20:48', '1', '2024-08-15 09:28:52', '1');
INSERT INTO `trans_soal` VALUES (52, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Saran : keputusan &gt; merundingkan :</span></p>', 'Menawarkan', 'Menentukan', 'Menilai', 'Menimbang', '', 'B', NULL, 'None', 'AKTIF', '2024-08-15 09:21:32', '1', '2024-08-15 09:28:43', '1');
INSERT INTO `trans_soal` VALUES (53, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Lidah : asam &gt; hidung :</span></p>', 'Mencium', 'Bernafas', 'Tengik', 'Asin', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:22:15', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (54, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Darah : pembuluh &gt; air :</span></p>', 'Pintu Air', 'Sungai', 'Talang', 'Hujan', '', 'B', NULL, 'None', 'AKTIF', '2024-08-15 09:23:03', '1', '2024-08-15 09:27:49', '1');
INSERT INTO `trans_soal` VALUES (55, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Saraf : penyalur &gt; pupil :</span></p>', 'Penyinaran', 'Mata', 'Melihat', 'Pelindung', '', 'A', NULL, 'None', 'AKTIF', '2024-08-15 09:24:02', '1', '2024-08-15 09:27:56', '1');
INSERT INTO `trans_soal` VALUES (56, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Pengantar surat : telegram &gt; pandai besi :</span></p>', 'Palu Godam', 'Pedagang Besi', 'Tukang Emas', 'Api', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:24:44', '1', '2024-08-15 09:28:25', '1');
INSERT INTO `trans_soal` VALUES (57, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Buta : warna &gt; tuli :</span></p>', 'Pendengaran', 'Mendengar', 'Nada', 'Kata', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:30:05', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (58, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Makanan : bumbu &gt; ceramah :</span></p>', 'Penghinaan', 'Pidato', 'Kesan', 'Ayat', '', 'D', NULL, 'None', 'AKTIF', '2024-08-15 09:30:53', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (59, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Marah : emosi &gt; duka cita :</span></p>', 'Suka Cita', 'Sakit Hati', 'Suasana Hati', 'Sedih', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:31:38', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (60, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Mantel : jubah &gt; wool :</span></p>', 'Bahan Sandang', 'Domba', 'Sutera', 'Jas', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:32:19', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (61, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Ketinggian puncak : tekanan udara &gt; ketinggian nada :</span></p>', 'Garbu Penala', 'Sopran', 'Suara', 'Panjang Senar', '', 'D', NULL, 'None', 'AKTIF', '2024-08-15 09:33:06', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (62, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Negara : revolusi &gt; makhluk hidup:</span></p>', 'Biologi', 'Keturunan', 'Mutasi', 'Seleksi', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:34:05', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (63, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Kekurangan : penemuan &gt; panas :</span></p>', 'Haus', 'Katulistiwa', 'Es', 'Matahari', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:34:54', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (64, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Kayu : diketam &gt; besi :</span></p>', 'Dipalu', 'Digergaji', 'Dikikir', 'Ditempa', '', 'D', NULL, 'None', 'AKTIF', '2024-08-15 09:35:50', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (65, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Olahragawan : lembing &gt; cendekiawan :</span></p>', 'Perpustakaan', 'Penelitian', 'Karya', 'Studi', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:36:30', '1', '2024-08-15 09:39:17', '1');
INSERT INTO `trans_soal` VALUES (66, 1, 3, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Keledai : kuda pacuan &gt; pembakaran :</span></p>', 'Pemadam', 'Obor', 'Letupan', 'Lautan Api', '', 'D', NULL, 'None', 'AKTIF', '2024-08-15 09:37:16', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (67, 1, 4, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Karena dipanaskan, kawat yang panjang awalnya 48 cm akan mengembang menjadi 52 cm. Setelah pemanasan, berapakah panjangnya kawat yang berukuran 72 cm?</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p>', '76', '77', '75', '78', '', 'A', NULL, 'None', 'AKTIF', '2024-08-15 09:41:15', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (68, 1, 4, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Suatu pabrik dapat menghasilkan 304 batang pensil dalam waktu 8 jam. Berapa batangkah yang dihasilkan dalam waktu setengah jam ?</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p>', '38', '28', '18', '19', '', 'D', NULL, 'None', 'AKTIF', '2024-08-15 09:42:23', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (69, 1, 4, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Untuk suatu campuran diperlukan 2 bagian perak dan 3 bagian timah. Berapa gram-kah perak yang diperlukan untuk mendapatkan campuran itu beratnya 15 gram?</span></p>', '6', '5', '4', '8', '', 'A', NULL, 'None', 'AKTIF', '2024-08-15 09:43:08', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (70, 1, 4, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Untuk setiap Rp. 3,- yang dimiliki Sidin, Hamid memiliki Rp. 5,- . Jika mereka bersama mempunyai Rp. 120,- berapa rupiahkah yang dimiliki Hamid ?</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p>', '77', '75', '200', '175', '', 'B', NULL, 'None', 'AKTIF', '2024-08-15 09:43:52', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (71, 1, 4, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Mesin A menenun 60 m kain, sedangkan mesin B menenun 40 m kain. Berapa meterkah yang ditenun mesin A, Jika mesin B menenun 60 m?</span></p>', '60', '80', '90', '100', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:44:21', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (72, 1, 4, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Seseorang memberikan 1/10 dari uangnya untuk perangko dan 4 kali jumlah itu untuk alat tulis. Sisa uangnya masih Rp. 60,-. Berapa rupiahkah uangnya semula?</span></p>', 'Rp. 120', 'Rp. 100', 'Rp. 110', 'Rp. 130', '', 'A', NULL, 'None', 'AKTIF', '2024-08-15 09:45:26', '1', '2024-08-15 09:47:39', '1');
INSERT INTO `trans_soal` VALUES (73, 1, 4, '<p class=\"MsoNormal\"><span style=\"font-family: Tahoma;\">Dalam 2 peti terdapat 43 piring. Didalam peti yang satu terdapat 9 buah piring lebih banyak daripada didalam peti yang lain. Berapa buah piring terdapat didalam peti yang lebih kecil?</span></p>', '16', '27', '19', '17', '', 'D', NULL, 'None', 'AKTIF', '2024-08-15 09:46:13', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (74, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">Suatu lembaran kain yang panjangnya 60 cm harus dibagi sedemikian rupa sehingga panjangnya satu bagian adalah 2/3 dari bagian yang lain. Berapakah bagian yang terpendek?</span></p>', '15 Cm', '20 Cm', '10 Cm', '25 Cm', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:46:50', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (75, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">Suatu perusahaan mengekspor ¾ dari hasil produksinya dan menjual 4/5 dari sisa itu di dalam negeri. Berapa % kah hasil produksi yang masih tinggal?</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p>', '5%', '8%', '10%', '15%', '', 'A', NULL, 'None', 'AKTIF', '2024-08-15 09:48:46', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (76, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">Jika suatu botol berisi anggur hanya 7/8 bagian dan harganya ialah Rp. 84,-. Berapakah harga anggur itu jika botol itu hanya terisi ½ penuh?</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p>', '45', '48', '55', '35', '', 'B', NULL, 'None', 'AKTIF', '2024-08-15 09:50:18', '1', '2024-08-15 10:06:44', '1');
INSERT INTO `trans_soal` VALUES (77, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">Didalam suatu keluarga setiap anak perempuan mempunyai jumlah saudara laki-laki yang sama dengan jumlah saudara perempuan dan setiap anak laki-laki mempunyai dua kali lebih banyak saudara perempuan daripada saudara laki-laki. Berapa anak laki-laki kah yang terdapat dalam keluarga itu?</span></p>', '5', '7', '8', '3', '', 'D', NULL, 'None', 'AKTIF', '2024-08-15 09:50:47', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (78, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">Jika seorang anak memiliki Rp. 50,- dan memberikan Rp. 15,-. Berapa rupiahkah yang masih tinggal padanya?</span></p>', 'Rp 35', 'Rp 15', 'Rp 30', 'Rp 25', '', 'A', NULL, 'None', 'AKTIF', '2024-08-15 09:51:29', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (79, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">Berapa km-kah yang dapat ditempuh oleh kereta api dalam waktu 7 jam. Jika kecepatannya 40 km/jam ?</span></p>', '280 Km', '380 Km', '180 Km', '240 Km', '', 'A', NULL, 'None', 'AKTIF', '2024-08-15 09:52:05', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (80, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">5 peti buah-buahan beratnya 250 kg dan setiap peti kosong beratnya 3 kg, berapakah berat buah-buahan itu ?</span></p>', '195 Kg', '205 Kg', '215 Kg', '210 Kg', '', 'B', NULL, 'None', 'AKTIF', '2024-08-15 09:52:48', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (81, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">Seseorang mempunyai persediaan rumput yang cukup untuk 7 ekor kuda selama 78 hari. Berapa harikah persediaan itu cukup untuk 21 ekor kuda?</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p>', '28 Hari', '32 Hari', '26 Hari', '22 Hari', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:53:34', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (82, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">3 batang</span><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">&nbsp;</span><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">coklat harganya Rp. 5,-. Berapa batangkah yang dapat kita beli dengan Rp. 50,-?</span><span style=\"font-family: Tahoma;\"><o:p></o:p></span></p>', '40', '20', '30', '50', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:54:21', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (83, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">Seseorang dapat berjalan 1,75 m dalam waktu ¼ detik. Berapa meterkah yang dapat ditempuh dalam waktu 10 detik ?</span></p>', '55 M', '90 M', '70 M', '60 M', '', 'C', NULL, 'None', 'AKTIF', '2024-08-15 09:55:10', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (84, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">Jika sebuah batu terletak 15 m di sebelah selatan dari sebatang pohon dan pohon itu berada 30 m di sebelah selatan dari sebuah rumah. Berapa meterkah jarak antara batu dan rumah itu?</span></p>', '40', '45', '35', '55', '', 'B', NULL, 'None', 'AKTIF', '2024-08-15 09:55:55', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (85, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">Jika 4 ½ m bahan sandang harganya Rp. 90,-. Berapa rupiahkah harga 2 ½ m?</span></p>', 'Rp. 50', 'Rp. 45', 'Rp. 35', 'Rp. 60', '', 'A', NULL, 'None', 'AKTIF', '2024-08-15 09:56:40', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (86, 1, 4, '<p class=\"MsoNormal\"><span style=\"mso-spacerun:\'yes\';font-family:Tahoma;mso-fareast-font-family:SimSun;\r\nfont-size:12,0000pt;\">7 orang dapat menyelesaikan suatu pekerjaan dalam 6 hari. Berapa orangkah yang diperlukan untuk menyelesaikan pekerjaan itu dalam setengah hari ?</span></p>', '84', '80', '94', '88', '', 'A', NULL, 'None', 'AKTIF', '2024-08-15 09:57:18', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (87, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, '52', 'soalx/1723771170-bt1.png', 'Tengah', 'AKTIF', '2024-08-16 08:19:30', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (88, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'soalx/1723771206-bt2.jpg', 'Tengah', 'AKTIF', '2024-08-16 08:20:06', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (89, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, '26', 'soalx/1723771239-bt3.jpg', 'Tengah', 'AKTIF', '2024-08-16 08:20:39', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (90, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, '28', 'soalx/1723771258-bt4.jpg', 'Tengah', 'AKTIF', '2024-08-16 08:20:58', '1', NULL, NULL);
INSERT INTO `trans_soal` VALUES (91, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, '81', 'soalx/1723773271-bt5.jpg', 'Tengah', 'AKTIF', '2024-08-16 08:21:29', '1', '2024-08-16 08:54:31', '1');

-- ----------------------------
-- Table structure for trans_tambahan_dua
-- ----------------------------
DROP TABLE IF EXISTS `trans_tambahan_dua`;
CREATE TABLE `trans_tambahan_dua`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `NamaInstansi` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `Waktu` date NULL DEFAULT NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_tambahan_dua
-- ----------------------------

-- ----------------------------
-- Table structure for trans_tambahan_satu
-- ----------------------------
DROP TABLE IF EXISTS `trans_tambahan_satu`;
CREATE TABLE `trans_tambahan_satu`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `Waktu` date NULL DEFAULT NULL,
  `CreatedDate` datetime NULL DEFAULT NULL,
  `CreatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UpdatedDate` datetime NULL DEFAULT NULL,
  `UpdatedBy` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_tambahan_satu
-- ----------------------------

-- ----------------------------
-- Table structure for user_profiles
-- ----------------------------
DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE `user_profiles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_profiles_user_id_foreign`(`user_id` ASC) USING BTREE,
  CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_profiles
-- ----------------------------
INSERT INTO `user_profiles` VALUES (1, 1, '089678468651', 'Jakarta', '1991-04-05', 'laki-laki', 'Jl. H. Gadung no.20, Pondok Ranji, Ciputat Timur, Tangerang Selatan, Banten', NULL, '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `user_profiles` VALUES (2, 2, '08123456799', 'Bogor', '1994-01-01', 'laki-laki', 'Jalan Bogor Raya No. 19', NULL, '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `user_profiles` VALUES (12, 52, '081298061123', NULL, '2024-08-24', 'laki-laki', 'Perum Griya Curug Blok A3 No. 08', 'images/users/1724473845.png', '2024-08-24 11:29:45', '2024-08-24 11:30:45');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Njmudin', 'nj.mudin18@omas-mfg.com', '2024-05-13 02:26:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '29jA5MsBhruRKkWDRrlYhUp8LHkTfOr7nu5LsbuLBXlv9OYMvB0OvFlEUEN3', '2024-05-13 02:26:25', '2024-05-13 02:26:25');
INSERT INTO `users` VALUES (2, 'Manager 1234', 'manager@gmail.com', '2024-05-13 02:26:25', '$2y$10$C1devK14UeHEV9S2Gx/yAOhUexg4EOoleR81EIGNHCp59aBFomocy', 'jdBKkveTIC', '2024-05-13 02:26:25', '2024-08-23 15:52:06');
INSERT INTO `users` VALUES (52, 'Mudin', 'nj.mudin18@gmail.com', NULL, '$2y$10$T0bVcfwk7lqF3Rlm62uo.uTe2sB6cnXFdqmJVo0FNe1gQyEdXMamm', '2S78l6pEmBABcc2j8XvzEOKFm1b06MoMyEuVPlGGD9TzNm7dRKriX38iP3W2', '2024-08-22 07:04:37', '2024-08-24 09:05:26');

SET FOREIGN_KEY_CHECKS = 1;
