/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50718
 Source Host           : localhost
 Source Database       : ba_news

 Target Server Type    : MySQL
 Target Server Version : 50718
 File Encoding         : utf-8

 Date: 06/13/2018 07:25:08 AM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `advance_field`
-- ----------------------------
DROP TABLE IF EXISTS `advance_field`;
CREATE TABLE `advance_field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `advertising`
-- ----------------------------
DROP TABLE IF EXISTS `advertising`;
CREATE TABLE `advertising` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_mobile` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0.PC 1.Mobile',
  `location` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `advertising`
-- ----------------------------
BEGIN;
INSERT INTO `advertising` VALUES ('3', 'Test', 'test', '0', '10', '2018-06-04 23:39:21', '2018-06-04 23:39:21'), ('4', 'M1', 'm12', '1', '1', '2018-06-04 23:39:49', '2018-06-05 00:17:28'), ('5', 'M2', 'M2', '1', '2', '2018-06-05 07:26:39', '2018-06-05 07:26:41');
COMMIT;

-- ----------------------------
--  Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint(4) NOT NULL DEFAULT '0',
  `system_link_type_id` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_slug_unique` (`slug`),
  KEY `category_parent_id_foreign` (`parent_id`),
  CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `category`
-- ----------------------------
BEGIN;
INSERT INTO `category` VALUES ('1', 'Tin tuc', 'tin-tuc', null, null, null, null, null, null, null, '0', '1', '1', null, null), ('2', 'Game hanh dong', 'hanh-dong', null, null, null, null, null, null, null, '0', '2', '1', null, null), ('3', 'Game nhap vai', 'nhap-vai', '2', null, null, null, null, null, null, '0', '2', '1', null, null), ('4', 'Game chien thuat', 'chien-thuat', '2', null, null, null, null, null, null, '0', '2', '1', null, null), ('5', 'Game ban sung', 'ban-sung', null, null, null, null, null, null, null, '0', '2', '1', null, null), ('6', 'Game danh bai', 'danh-bai', null, null, null, null, null, null, null, '0', '2', '1', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `groups`
-- ----------------------------
BEGIN;
INSERT INTO `groups` VALUES ('1', 'Hot', null, null, '1');
COMMIT;

-- ----------------------------
--  Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `direct` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_group_id` int(11) NOT NULL,
  `order` tinyint(4) NOT NULL DEFAULT '0',
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `system_link_type_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `menu`
-- ----------------------------
BEGIN;
INSERT INTO `menu` VALUES ('1', 'Game hanh dong', 'hanh-dong', null, null, null, '1', '0', '', '2', '2018-05-29 23:03:58', '2018-05-29 23:03:58'), ('2', 'Game nhap vai', 'nhap-vai', null, null, null, '1', '0', 'List Games', '2', '2018-05-29 23:03:58', '2018-05-31 18:53:04'), ('3', 'Game chien thuat', 'chien-thuat', null, null, null, '1', '0', 'List Games', '2', '2018-05-29 23:03:58', '2018-05-31 18:53:13'), ('4', 'Game ban sung', 'ban-sung', null, null, null, '1', '0', '', '2', '2018-05-29 23:03:58', '2018-05-29 23:03:58'), ('5', 'Game danh bai', 'danh-bai', null, null, null, '1', '0', '', '2', '2018-05-29 23:03:58', '2018-05-29 23:03:58'), ('6', 'Gioi thieu', 'gioi-thieu', null, null, null, '2', '0', 'page', '3', '2018-05-29 23:06:41', '2018-05-29 23:06:41'), ('7', 'Dieu khoan', 'dieu-khoan', null, null, null, '2', '0', 'page', '3', '2018-05-29 23:06:41', '2018-05-29 23:06:41'), ('8', 'Game hanh dong', 'hanh-dong', null, null, null, '3', '0', '', '2', '2018-05-30 00:07:41', '2018-05-30 00:07:41'), ('9', 'Game nhap vai', 'nhap-vai', null, null, null, '3', '0', 'List Games', '2', '2018-05-30 00:07:41', '2018-05-31 18:53:04'), ('10', 'Game chien thuat', 'chien-thuat', null, null, null, '3', '0', 'List Games', '2', '2018-05-30 00:07:41', '2018-05-31 18:53:13'), ('11', 'Game ban sung', 'ban-sung', null, null, null, '3', '0', '', '2', '2018-05-30 00:07:41', '2018-05-30 00:07:41'), ('12', 'Game danh bai', 'danh-bai', null, null, null, '3', '0', '', '2', '2018-05-30 00:07:41', '2018-05-30 00:07:41');
COMMIT;

-- ----------------------------
--  Table structure for `menu_group`
-- ----------------------------
DROP TABLE IF EXISTS `menu_group`;
CREATE TABLE `menu_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `menu_group`
-- ----------------------------
BEGIN;
INSERT INTO `menu_group` VALUES ('1', 'Main menu', '2018-05-29 23:03:49', '2018-05-29 23:03:49', '1'), ('2', 'Bottom Menu', '2018-05-29 23:06:34', '2018-05-29 23:06:34', '1'), ('3', 'Left Menu', '2018-05-29 23:27:44', '2018-05-29 23:27:44', '1');
COMMIT;

-- ----------------------------
--  Table structure for `menu_system`
-- ----------------------------
DROP TABLE IF EXISTS `menu_system`;
CREATE TABLE `menu_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `order` tinyint(4) NOT NULL DEFAULT '0',
  `show` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1,2',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `menu_system`
-- ----------------------------
BEGIN;
INSERT INTO `menu_system` VALUES ('1', 'Category', 'icon-grid', 'category', '0', '0', '1,2', '1'), ('2', 'Create Category', 'icon-plus', 'category.create', '1', '1', '1,2', '1'), ('3', 'All Category', 'icon-list', 'category.index', '1', '2', '1,2', '1'), ('4', 'Post', 'icon-book-open', 'post', '0', '0', '1,2', '0'), ('5', 'Create Post', 'icon-plus', 'post.create', '4', '1', '1,2', '1'), ('6', 'All Posts', 'icon-list', 'post.index', '4', '2', '1,2', '1'), ('7', 'Page', 'icon-notebook', 'page', '0', '0', '1,2', '1'), ('8', 'Create Page', 'icon-plus', 'page.create', '7', '1', '1,2', '1'), ('10', 'All Pages', 'icon-list', 'page.index', '7', '2', '1,2', '1'), ('11', 'Custom field', 'icon-puzzle', 'advanceField', '0', '0', '1', '0'), ('12', 'Create Field', 'icon-plus', 'advanceField.create', '11', '1', '1', '1'), ('13', 'All Custom Field', 'icon-list', 'advanceField.index', '11', '2', '1', '1'), ('14', 'Games', 'icon-handbag', 'game', '0', '0', '1,2', '1'), ('15', 'Create Game', 'icon-plus', 'game.create', '14', '0', '1,2', '1'), ('16', 'All Games', 'icon-list', 'game.index', '14', '0', '1,2', '1'), ('17', 'Users', 'icon-user', 'user', '0', '0', '1', '1'), ('18', 'Create User', 'icon-user-follow', 'user.create', '17', '1', '1', '1'), ('19', 'All User', 'icon-users', 'user.index', '17', '2', '1', '1'), ('20', 'Themes', 'icon-globe', 'setting', '0', '0', '1,2', '1'), ('21', 'Menu', 'icon-diamond', 'setting.menu', '20', '1', '1,2', '1'), ('22', 'Setting', 'icon-settings', 'setting.index', '20', '2', '1,2', '1'), ('23', 'Advertising', 'icon-list', 'advertising', '0', '0', '1,2', '1'), ('24', 'Create Ads', 'icon-plus', 'advertising.create', '23', '1', '1,2', '1'), ('25', 'All Ads', 'icon-list', 'advertising.index', '23', '2', '1,2', '1');
COMMIT;

-- ----------------------------
--  Table structure for `meta_field`
-- ----------------------------
DROP TABLE IF EXISTS `meta_field`;
CREATE TABLE `meta_field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key_value` text COLLATE utf8mb4_unicode_ci,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_field_post_id_index` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `meta_field`
-- ----------------------------
BEGIN;
INSERT INTO `meta_field` VALUES ('1', 'url-download-ios', 'https://laravel.com/docs/5.6/routing#route-parameters', '1'), ('2', 'url-download-android', 'https://laravel.com/docs/5.6/routing#route-parameters', '1'), ('3', 'url-download-window-phone', 'http://css2sass.herokuapp.com/', '1'), ('4', 'url-download-window', 'http://css2sass.herokuapp.com/', '1'), ('5', 'url-download-ios', 'http://game.nvh/asdf', '2'), ('6', 'url-download-android', 'http://dichvumobile.vn/game-bigfox.html', '2'), ('7', 'url-download-ios', 'https://laravel.com/docs/5.6/routing#route-parameters', '3'), ('8', 'url-download-ios', 'http://dichvumobile.vn/game-ninja-school-online.html', '4'), ('9', 'url-download-android', 'http://dichvumobile.vn/game-ninja-school-online.html', '4'), ('10', 'url-download-ios', 'https://laravel.com/docs/5.6/routing#route-parameters', '5'), ('11', 'url-download-android', 'https://laravel.com/docs/5.6/routing#route-parameters', '6');
COMMIT;

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `migrations`
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1'), ('2', '2014_10_12_100000_create_password_resets_table', '1'), ('3', '2017_08_16_045421_create_menu_system_table', '1'), ('4', '2017_09_10_220943_create_posts_table', '1'), ('5', '2017_09_10_221006_create_category_table', '1'), ('6', '2017_09_10_221017_create_post_category_table', '1'), ('7', '2017_09_12_165520_create_tags_table', '1'), ('8', '2017_09_12_165607_create_post_tag_table', '1'), ('9', '2017_09_17_092109_create_advance_field_table', '1'), ('10', '2017_09_17_092158_create_meta_field_table', '1'), ('11', '2017_09_17_233557_create_groups_table', '1'), ('12', '2017_09_17_233651_create_post_group_table', '1'), ('13', '2017_09_18_184909_create_setting_table', '1'), ('14', '2017_09_23_023547_add_post_id_to_setting_table', '1'), ('15', '2017_09_23_082745_add_telephone_to_setting_table', '1'), ('16', '2017_09_23_090015_add_subtime_to_setting_table', '1'), ('17', '2017_09_24_212525_create_menu_table', '1'), ('18', '2017_09_24_214045_create_menu_group_table', '1'), ('19', '2017_09_24_214456_drop_value_in_menu_group_table', '1'), ('20', '2017_10_07_083055_rename_alias_in_menu', '1'), ('21', '2017_10_24_085906_add_set_menu_to_setting', '1'), ('22', '2017_11_13_074422_create_options_table', '1'), ('23', '2018_05_21_212504_create_system_link_type_table', '1'), ('24', '2018_05_31_182903_create_sessions_table', '2'), ('25', '2018_06_04_202507_create_advertising_table', '3');
COMMIT;

-- ----------------------------
--  Table structure for `options`
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `options`
-- ----------------------------
BEGIN;
INSERT INTO `options` VALUES ('6', 'top_menu_id', '1'), ('7', 'left_menu_id', '3'), ('8', 'bottom_menu_id', '2'), ('9', 'meta_title', 'Meta title'), ('10', 'meta_description', 'meta desc'), ('11', 'company_logo', '/uploads/setting/2018/05/20180531003035-logo-dichvumobile.png'), ('12', 'parent', '2,3');
COMMIT;

-- ----------------------------
--  Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_username_index` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `post_category`
-- ----------------------------
DROP TABLE IF EXISTS `post_category`;
CREATE TABLE `post_category` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  KEY `post_category_post_id_index` (`post_id`),
  KEY `post_category_category_id_index` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `post_category`
-- ----------------------------
BEGIN;
INSERT INTO `post_category` VALUES ('1', '2'), ('2', '2'), ('3', '2'), ('4', '2'), ('5', '2'), ('6', '2'), ('6', '3'), ('6', '4'), ('6', '5'), ('5', '3'), ('5', '4'), ('5', '5'), ('4', '3'), ('4', '4'), ('4', '5'), ('3', '3'), ('3', '4'), ('1', '3'), ('1', '4'), ('2', '3');
COMMIT;

-- ----------------------------
--  Table structure for `post_group`
-- ----------------------------
DROP TABLE IF EXISTS `post_group`;
CREATE TABLE `post_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_group_post_id_index` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `post_group`
-- ----------------------------
BEGIN;
INSERT INTO `post_group` VALUES ('1', '1', '1', null, null), ('2', '2', '1', null, null), ('3', '3', '1', null, null), ('4', '4', '1', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `post_tag`
-- ----------------------------
DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE `post_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_tag_post_id_index` (`post_id`),
  KEY `post_tag_tag_id_index` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `introduction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `system_link_type_id` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `posts`
-- ----------------------------
BEGIN;
INSERT INTO `posts` VALUES ('1', 'Luyện rồng', 'luyen-rong', '/uploads/games/2018/05/20180529214245-luyen-rong-150x150.png', 'Hòa mình vào thế giới loài Rồng', 'Features the 2018 World Cup\r\n150 teams from the world\'s biggest leagues\r\nSingle player and online multiplayer\r\nComplete Customisation of teams and players', '<p>Đầu năm 2016 nh&agrave; ph&aacute;t h&agrave;nh Soha vừa cho ra mắt&nbsp;game Luyện Rồng, một game h&agrave;nh động top 1 H&agrave;n Quốc với hy vọng đem lại l&agrave;n gi&oacute; mới cho cộng đồng game Việt. Hiện tại th&igrave;&nbsp;Luyện Rồng&nbsp;đ&atilde; được hỗ trợ tr&ecirc;n hai hệ điều h&agrave;nh ch&iacute;nh l&agrave;&nbsp;Android&nbsp;v&agrave;&nbsp;Ios, c&aacute;c bạn c&oacute; thể&nbsp;<a href=\"http://dichvumobile.vn/luyen-rong.html\">tải Luyện Rồng</a>&nbsp;miễn ph&iacute; ngay tr&ecirc;n&nbsp;dichvumobile.vn&nbsp;nh&eacute;</p>', '0', '1', null, null, null, '2018-05-29 21:42:45', '2018-05-29 21:56:08', '5', '1'), ('2', 'Bigfox Online', 'bigfox-online', '/uploads/games/2018/05/20180529214409-tai-game-bigfox-0.png', 'Let your imagination fly and build your own world in Minecraft!', 'Features the 2018 World Cup\r\n150 teams from the world\'s biggest leagues\r\nSingle player and online multiplayer\r\nComplete Customisation of teams and players', '<p>BigFox&nbsp;online&nbsp;l&agrave; tựa game đ&aacute;nh b&agrave;i online mới ra mắt với giao diện đẹp mắt, c&aacute;ch chơi đơn giản, hứa hẹn sẽ đem lại cho bạn nhưng gi&acirc;y ph&uacute;t giải tr&iacute; thoải m&aacute;i nhất. Đặc biệt mọi người sẽ được&nbsp;<a href=\"http://dichvumobile.vn/game-bigfox.html\">tải game BigFox</a>&nbsp;ho&agrave;n to&agrave;n miễn ph&iacute; tr&ecirc;n&nbsp;<a href=\"http://dichvumobile.vn/\">dichvumobile.vn</a>, h&atilde;y nhanh tay nh&eacute;.</p>', '0', '1', null, null, null, '2018-05-29 21:44:09', '2018-05-29 21:56:56', '5', '1'), ('3', 'Song Long Truyền Kỳ', 'song-long-truyen-ky', '/uploads/games/2018/05/20180529214458-game-song-long-truyen-ky.png', 'Let your imagination fly and build your own world in Minecraft!', 'Features the 2018 World Cup\r\n150 teams from the world\'s biggest leagues\r\nSingle player and online multiplayer\r\nComplete Customisation of teams and players', '<p style=\"text-align:justify\">C&oacute; thể n&oacute;i&nbsp;<strong>Song Long truyền kỳ</strong>&nbsp;l&agrave; một game kiếm hiệp, nhập vai của&nbsp;<strong>VTC&nbsp;10 năm c&oacute; 1</strong>, đ&atilde; rất l&acirc;u rồi c&aacute;c game thủ Việt mới c&oacute; được cơ hội tr&atilde;i nghiệm một si&ecirc;u phẩm đ&igrave;nh đ&aacute;m v&agrave; hấp dẫn như thế. Chỉ với v&agrave;i thao t&aacute;c đơn giản mọi người đ&atilde; c&oacute; thể&nbsp;<strong><a href=\"http://dichvumobile.vn/song-long-truyen-ky.html\">tải game Song Long Truyền Kỳ</a></strong>&nbsp;v&agrave; h&ograve;a m&igrave;nh v&agrave;o thế giới v&otilde; hiệp đầy hiểm &aacute;c.</p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"Song long truyen ky\" src=\"http://dichvumobile.vn/wp-content/uploads/2015/12/Song-long-truyen-ky.jpg\" style=\"height:auto; margin:20px auto; width:560px\" /></p>\r\n\r\n<h2 style=\"text-align:justify\"><strong>Th&ocirc;ng tin sơ lược về game Song Long Truyền Kỳ:</strong></h2>\r\n\r\n<p style=\"text-align:justify\"><strong>Song long truyền kỳ</strong>&nbsp;l&agrave; một game kiếm hiệp 3D với đề t&agrave;i kh&aacute; mới lạ, dựa tr&ecirc;n tiểu thuyết kiếm hiệp Song Long Đại Đường của&nbsp;Huỳnh Dị n&ecirc;n đậm chất hiện đại trong&nbsp;<a href=\"http://dichvumobile.vn/game\">game</a>. Cốt truyện kể về cuộc h&agrave;nh tr&igrave;nh&nbsp;h&oacute;a rồng của hai nh&acirc;n vật ch&iacute;nh l&agrave; Khấu Trọng v&agrave;&nbsp;Từ Tử Lăng.</p>\r\n\r\n<p style=\"text-align:justify\">Sở hữu h&igrave;nh ảnh 3D tương đối dễ nh&igrave;n, c&aacute;c hiệu ứng skill &nbsp;trong Song Long Truyền Kỳ được thiết kế kh&aacute; bắt mắt, tạo thiện cảm với người chơi. Tuy nhi&ecirc;n t&ocirc;ng m&agrave;u hơi trầm, tối.</p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"Tai game Song Long Truyen Ky\" src=\"http://dichvumobile.vn/wp-content/uploads/2015/12/Tai-game-Song-Long-Truyen-Ky.png\" style=\"height:auto; margin:20px auto; width:500px\" /></p>\r\n\r\n<p style=\"text-align:justify\">Mỗi nhận vật đều được sỡ hiệu một hệ thống skill ri&ecirc;ng, đầy hấp dẫn. Đặc biệt với t&iacute;nh năng tổ đội 3 người được cho l&agrave; điểm đặc sắc nhất khi chơi&nbsp;<strong>Song Long Truyền Kỳ của VTC</strong></p>', '0', '1', null, null, null, '2018-05-29 21:44:58', '2018-05-29 21:57:02', '5', '1'), ('4', 'Ninja School 119', 'ninja-school-119', '/uploads/games/2018/05/20180529214552-ninjaschool.png', 'Let your imagination fly and build your own world in Minecraft!', 'Features the 2018 World Cup\r\n150 teams from the world\'s biggest leagues\r\nSingle player and online multiplayer\r\nComplete Customisation of teams and players', '<p style=\"text-align:justify\">Chắc hẳn trong tất cả ch&uacute;ng ta, ai cũng đ&atilde; từng nghe về những&nbsp;<strong>chiến binh Ninja</strong>, những người rất th&ocirc;ng minh, nhanh tr&iacute; v&agrave; t&agrave;i giỏi.&nbsp;Bạn c&oacute; muốn được một lần h&oacute;a th&acirc;n th&agrave;nh c&aacute;c chiến binh Ninja thực thụ để c&ugrave;ng chiến đấu bảo vệ ch&iacute;nh nghĩa, với việc sử dụng c&aacute;c vũ kh&iacute; mới lạ, c&aacute;c thuật biến h&oacute;a kỳ diệu, với&nbsp;<strong>&nbsp;<em><a href=\"http://dichvumobile.vn/game-ninja-school-online.html\">game Ninja Shool online</a></em></strong>&nbsp;chắc chắn sẽ mang lại cho c&aacute;c bạn niềm vui giải tr&iacute; cực cao khi chơi game.</p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"Game ninja school\" src=\"http://dichvumobile.vn/wp-content/uploads/2015/12/Game-ninja-school.png\" style=\"height:auto; margin:20px auto; width:500px\" /></p>\r\n\r\n<h2 style=\"text-align:justify\"><strong>Th&ocirc;ng tin sơ lược về game Ninja School:</strong></h2>\r\n\r\n<p style=\"text-align:justify\">Khi tham gia v&agrave;o<strong>&nbsp;game Ninja Shool 119</strong>&nbsp;bạn sẽ phải tự m&igrave;nh h&oacute;a th&acirc;n v&agrave;o nh&acirc;n vật, chọn cho m&igrave;nh con đường tu luyện để th&agrave;nh t&agrave;i bằng c&aacute;ch chọn 1 trong 3 ng&ocirc;i trường để tu luyện bản th&acirc;n. Trong những ng&ocirc;i trường n&agrave;y bạn sẽ được học v&agrave; tham gia những kh&oacute;a huấn luyện với bạn b&egrave; dưới sự hướng dẫn của sư phụ. Sau đ&oacute; c&aacute;c bạn sẽ đi thực hiện nhiệm vụ được giao ph&oacute; để ho&agrave;n th&agrave;nh kh&oacute;a học.</p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"Tai game ninja school\" src=\"http://dichvumobile.vn/wp-content/uploads/2015/12/Tai-game-ninja-school.png\" style=\"height:auto; margin:20px auto; width:500px\" /></p>\r\n\r\n<p style=\"text-align:justify\">Khi tham gia&nbsp;<a href=\"http://dichvumobile.vn/game\">game</a>, c&aacute;c nh&acirc;n vật trong game sẽ mang cho m&igrave;nh một c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch độc đ&aacute;o ri&ecirc;ng, ch&iacute;nh v&igrave; thế&nbsp;<em><strong>Ninja Shool online</strong></em>&nbsp;l&agrave; một&nbsp;<a href=\"http://dichvumobile.vn/game-nhap-vai\">game nhập vai</a>&nbsp;đang được rất nhiều c&aacute;c bạn trẻ quan t&acirc;m v&agrave; sử dụng. Đến với&nbsp;<em><strong>Game Ninja Shool</strong></em>&nbsp;bạn kh&ocirc;ng chỉ được giải tr&iacute; kh&ocirc;ng th&ocirc;i m&agrave; c&ograve;n được ph&aacute;t triển khả năng tr&iacute; tuệ, tham gia trải nghiệm m&igrave;nh trong những thử th&aacute;ch mang đầy t&iacute;nh nh&acirc;n văn cũng như t&iacute;nh tư duy chiến lược cao.</p>\r\n\r\n<p style=\"text-align:justify\">N&agrave;o, c&ograve;n chờ đợi g&igrave; nữa m&agrave; bạn kh&ocirc;ng&nbsp;<em><strong>tải game Ninja Shool online</strong>&nbsp;</em>ngay th&ocirc;i, h&atilde;y tham gia v&agrave; trở th&agrave;nh một chiến binh Ninja thực thụ bạn nh&eacute;!</p>', '0', '1', null, null, null, '2018-05-29 21:45:52', '2018-05-29 21:57:11', '5', '1'), ('5', 'LOL Arena', 'lol-arena', '/uploads/games/2018/05/20180529214634-lol-arena-150x150.png', 'Let your imagination fly and build your own world in Minecraft!', 'Features the 2018 World Cup\r\n150 teams from the world\'s biggest leagues\r\nSingle player and online multiplayer\r\nComplete Customisation of teams and players', '<h1>LOL Arena</h1>', '0', '1', 'bbb', 'ccc', 'aaa', '2018-05-29 21:46:34', '2018-05-29 21:57:06', '5', '1'), ('6', 'Game teen teen 6.0', 'game-teen-teen-60', '/uploads/games/2018/05/20180529223343-teen-teen.png', 'Game bắn súng thời đại mới', 'Allows for endless levels of exploration and creativity.\r\nInteresting visual style.\r\nThousands of secrets to discover.\r\nIt\'s effectively many games in one package.', '<p style=\"text-align:justify\">Được ph&aacute;t triển tr&ecirc;n nền tảng của tr&ograve; chơi Gunny tr&ecirc;n m&aacute;y t&iacute;nh,&nbsp;<strong>game teen teen 6.0</strong>&nbsp;cho&nbsp;<strong>Android</strong>&nbsp;v&agrave;&nbsp;<strong>Ios</strong>&nbsp;với thể loại nhập vai ấn tượng đ&atilde; ch&iacute;nh thức c&oacute; mặt tr&ecirc;n c&aacute;c nền tảng di động. Vậy c&ograve;n chờ đợi g&igrave; nữa m&agrave; kh&ocirc;ng&nbsp;<strong><a href=\"http://dichvumobile.vn/game-teen-teen.html\">tải game teen teen</a></strong>&nbsp;về m&aacute;y v&agrave; trải nghiệm ngay từ h&ocirc;m nay th&ocirc;i.</p>\r\n\r\n<p style=\"text-align:center\"><a href=\"http://dichvumobile.vn/wp-content/uploads/2015/12/game-teen-teen-6.0.jpg\"><img alt=\"game-teen-teen-6.0\" src=\"http://dichvumobile.vn/wp-content/uploads/2015/12/game-teen-teen-6.0.jpg\" style=\"border-style:initial; border-width:0px; height:auto; margin:20px auto; width:500px\" /></a></p>\r\n\r\n<h2 style=\"text-align:justify\"><strong>Giới thiệu sơ lược về game Teen Teen:</strong></h2>\r\n\r\n<p style=\"text-align:justify\">Khi tham gia&nbsp;<a href=\"http://dichvumobile.vn/game\">game</a>, bạn sẽ c&oacute; cho m&igrave;nh những gi&acirc;y ph&uacute;t trải nghiệm đầy kỳ th&uacute; với những v&ugrave;ng đất ph&eacute;p thuật đầy huyền ảo, những nhiệm vụ hấp dẫn th&ocirc;i th&uacute;c bạn mỗi ph&uacute;t gi&acirc;y khi chơi. Kh&ocirc;ng chỉ c&oacute; vậy, trong game người chơi cũng sẽ phải ho&aacute; th&acirc;n th&agrave;nh c&aacute;c nh&acirc;n vật v&agrave; trở th&agrave;nh những si&ecirc;u anh h&ugrave;ng thực thụ c&ugrave;ng kề vai s&aacute;t c&aacute;nh với c&aacute;c chibi kh&aacute;c để c&oacute; thể chiến đấu với ti&ecirc;n hắc &aacute;m.</p>\r\n\r\n<p style=\"text-align:justify\">Điểm hấp dẫn trong phi&ecirc;n bản&nbsp;<em><strong>Teen Teen 6.0</strong></em>&nbsp;lần n&agrave;y ch&iacute;nh l&agrave; việc ph&aacute;t triển th&ecirc;m Phụ bản mới Tuyệt Địa Phản K&iacute;ch. Lấy &acirc;m hưởng từ Chiến tranh giữa c&aacute;c v&igrave; sao, Boss trong Tuyệt Địa Phản K&iacute;ch cũng được tạo h&igrave;nh theo nh&acirc;n vật hư cấu Dark Vader trong phim ch&iacute;nh v&igrave; thế đ&atilde; mang lại cho người chơi những trải nghiệm v&ocirc; c&ugrave;ng th&uacute; vị khi tham gia chơi.</p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"tai game teen teen\" src=\"http://dichvumobile.vn/wp-content/uploads/2015/12/tai-game-teen-teen.png\" style=\"height:auto; margin:20px auto; width:500px\" /></p>\r\n\r\n<p style=\"text-align:justify\">Vậy bạn c&ograve;n chờ đợi g&igrave; nữa m&agrave; kh&ocirc;ng tham gia&nbsp;<strong>tải teen teen</strong>&nbsp;về m&aacute;y v&agrave;&nbsp;<a href=\"http://dichvumobile.vn/dang-ky-3g-mobifone.html\">đăng k&yacute; 3g Mobi</a>&nbsp;để bắt đầu cho m&igrave;nh những cuộc phưu lưu kỳ th&uacute; đầy mầu sắc đang chờ đ&oacute;n bạn ph&iacute;a trước.&nbsp;H&atilde;y trải nghiệm&nbsp;<em><strong>game teen teen 6.0</strong></em>&nbsp;ngay h&ocirc;m nay để c&oacute; cho m&igrave;nh những gi&acirc;y ph&uacute;t thoải m&aacute;i v&agrave; thư gi&atilde;n sau những giờ học tập v&agrave; l&agrave;m việc đầy căng thẳng bạn nh&eacute;.</p>', '0', '1', null, null, null, '2018-05-29 22:33:43', '2018-05-29 22:33:43', '5', '1'), ('7', 'Gioi thieu', 'gioi-thieu', null, null, '', '<p>Gioi thieu</p>', '0', '1', null, null, null, '2018-05-29 23:06:11', '2018-05-29 23:06:11', '3', '1'), ('8', 'Dieu khoan', 'dieu-khoan', null, null, '', '<p>Dieu khoan</p>', '0', '1', null, null, null, '2018-05-29 23:06:22', '2018-05-29 23:06:22', '3', '1');
COMMIT;

-- ----------------------------
--  Table structure for `sessions`
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `system_link_type`
-- ----------------------------
DROP TABLE IF EXISTS `system_link_type`;
CREATE TABLE `system_link_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1.category 2.details',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `system_link_type_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `system_link_type`
-- ----------------------------
BEGIN;
INSERT INTO `system_link_type` VALUES ('1', 'List News', 'category', '1', null, null), ('2', 'List Games', '', '1', null, null), ('3', 'Page Details', 'page', '2', null, null), ('4', 'News Details', 'post', '2', null, null), ('5', 'Game Details', 'game', '2', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `tags`
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tags_slug_index` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(1) NOT NULL COMMENT '1.administrator 2.support',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'hung.nguyen', 'admin', '$2y$10$nDqj44TbypHSuBpacHBzp.ZsGPyG9adbxd.Y8pg9lfvDxWHlKV34W', '1', null, null, null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
