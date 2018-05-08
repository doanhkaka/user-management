/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : user_api

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2018-05-09 08:20:28
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO migrations VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO migrations VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` tinyint(4) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO users VALUES ('1', 'Doanh Ka Ka', 'Ngõ 1 Phạm Văn Đồng', '26', 'doanhkaka12@gmail.com', '$2y$10$B6zT8UJcuXwPBWCVxXsOWef7nAMpiTOWlwDXpXixIMxz5gbgn2plO', '096365874', null, null, '2018-05-08 16:02:08');
INSERT INTO users VALUES ('2', 'User mLmPD1N82V', 'xp7TbHFDmKB1uSL', '21', 'pc7Jwj6bOh@email.com', '$2y$10$8J5EnOhrXp3y7Mk5HsgRF.6zu2Y055MKBu7sSJl3DTReAKlUQJJma', '+8466255369', null, null, null);
INSERT INTO users VALUES ('3', 'User eAQH3Xwxva', 'ZTAJxTmsJnYVAIg', '97', '7kpfalgzu6@email.com', '$2y$10$C2tnQgVpb8.x/QLcwGr/wujAybKvWkVH.yn/rDVewMhQX2bQkmbSO', '+8472841796', null, null, null);
INSERT INTO users VALUES ('4', 'Doanh Ka Ka 1', 'PVD - Cầu Giấy - Hà Nội', '26', 'oznqeqkx9s@email.com', '$2y$10$tKOGqQUJv7y64SS9uvQq/.IHWXlbrM058DfZ65lgKg3qS1W3L9KTC', '09876543212', null, null, '2018-05-08 16:29:00');
INSERT INTO users VALUES ('5', 'DoanhHT', 'Hải Dương - Việt Nam', '28', 'example@email.com', '$2y$10$O7QWm3aimqQAp1z1TOAIeOJthXTUTQgZeUOZIjpajWP1R6ZCTBKhK', '+8472841796', null, null, '2018-05-09 01:06:47');

-- ----------------------------
-- Table structure for `users_copy`
-- ----------------------------
DROP TABLE IF EXISTS `users_copy`;
CREATE TABLE `users_copy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` tinyint(4) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users_copy
-- ----------------------------
INSERT INTO users_copy VALUES ('1', 'Doanh Ka Ka', 'Ngõ 1 Phạm Văn Đồng', '26', 'doanhkaka12@gmail.com', '$2y$10$B6zT8UJcuXwPBWCVxXsOWef7nAMpiTOWlwDXpXixIMxz5gbgn2plO', '096365874', null, null, '2018-05-08 16:02:08');
INSERT INTO users_copy VALUES ('2', 'User mLmPD1N82V', 'xp7TbHFDmKB1uSL', '21', 'pc7Jwj6bOh@email.com', '$2y$10$8J5EnOhrXp3y7Mk5HsgRF.6zu2Y055MKBu7sSJl3DTReAKlUQJJma', '+8466255369', null, null, null);
INSERT INTO users_copy VALUES ('3', 'User eAQH3Xwxva', 'ZTAJxTmsJnYVAIg', '97', '7kpfalgzu6@email.com', '$2y$10$C2tnQgVpb8.x/QLcwGr/wujAybKvWkVH.yn/rDVewMhQX2bQkmbSO', '+8472841796', null, null, null);
INSERT INTO users_copy VALUES ('4', 'Doanh Ka Ka 1', 'PVD - Cầu Giấy - Hà Nội', '26', 'oznqeqkx9s@email.com', '$2y$10$tKOGqQUJv7y64SS9uvQq/.IHWXlbrM058DfZ65lgKg3qS1W3L9KTC', '09876543212', null, null, '2018-05-08 16:29:00');
INSERT INTO users_copy VALUES ('5', 'DoanhHT', 'Hải Dương - Việt Nam', '28', 'example@email.com', '$2y$10$O7QWm3aimqQAp1z1TOAIeOJthXTUTQgZeUOZIjpajWP1R6ZCTBKhK', '+8472841796', null, null, '2018-05-09 01:06:47');
