SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `_auth_token` (
  `_auth_token_id` int(11) NOT NULL,
  `_auth_token_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_auth_token_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_auth_token_del` timestamp(6) NULL DEFAULT NULL,
  `_auth_token_arch` timestamp(6) NULL DEFAULT NULL,
  `_auth_token_active` tinyint(1) DEFAULT 1,
  `fk__mem_id` int(11) DEFAULT NULL,
  `fk__co_id` int(11) DEFAULT NULL,
  `_auth_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_auth_token_type` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_auth_token_expires` datetime DEFAULT NULL,
  `_auth_token_expired` tinyint(1) DEFAULT 0,
  `_auth_token_entity_ulid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_meditation_exclude` (
  `_meditation_exclude_id` int(11) NOT NULL,
  `_meditation_exclude_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_meditation_exclude_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_meditation_exclude_del` timestamp(6) NULL DEFAULT NULL,
  `_meditation_exclude_arch` timestamp(6) NULL DEFAULT NULL,
  `_meditation_exclude_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `_meditation_exclude_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_meditation_exclude_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_meditation_obj` (
  `_meditation_obj_id` int(11) NOT NULL,
  `_meditation_obj_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_meditation_obj_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_meditation_obj_del` timestamp(6) NULL DEFAULT NULL,
  `_meditation_obj_arch` timestamp(6) NULL DEFAULT NULL,
  `_meditation_obj_active` tinyint(1) DEFAULT 1,
  `_meditation_obj_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_meditation_obj_table` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_meditation_obj_obj` tinyint(1) DEFAULT 0,
  `_meditation_obj_ctlr` tinyint(1) DEFAULT 0,
  `_meditation_obj_page` tinyint(1) DEFAULT 0,
  `_meditation_obj_perm` tinyint(1) DEFAULT 0,
  `_meditation_obj_role_perm` tinyint(1) DEFAULT 0,
  `_meditation_obj_save_modal` tinyint(1) DEFAULT 0,
  `_meditation_obj_valid_form` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_meditation_obj` (`_meditation_obj_id`, `_meditation_obj_new`, `_meditation_obj_edit`, `_meditation_obj_del`, `_meditation_obj_arch`, `_meditation_obj_active`, `_meditation_obj_name`, `_meditation_obj_table`, `_meditation_obj_obj`, `_meditation_obj_ctlr`, `_meditation_obj_page`, `_meditation_obj_perm`, `_meditation_obj_role_perm`, `_meditation_obj_save_modal`, `_meditation_obj_valid_form`) VALUES
(1, '2021-10-05 16:32:28.440091', '2021-10-05 23:32:28.439930', NULL, NULL, 1, '_auth_token', '_auth_token', 1, 1, 1, 1, 1, 1, 1),
(2, '2021-10-05 16:32:28.506624', '2021-10-05 23:32:28.506407', NULL, NULL, 1, '_meditation_exclude', '_meditation_exclude', 1, 1, 1, 1, 1, 1, 1),
(3, '2021-10-05 16:32:28.553493', '2021-10-05 23:32:28.553315', NULL, NULL, 1, '_meditation_obj', '_meditation_obj', 1, 1, 1, 1, 1, 1, 1),
(4, '2021-10-05 16:32:28.960927', '2021-10-05 23:32:28.960770', NULL, NULL, 1, '_config', '_config', 1, 1, 1, 1, 1, 1, 1),
(5, '2021-10-05 16:32:29.003639', '2021-10-05 23:32:29.003487', NULL, NULL, 1, '_country', '_country', 1, 1, 1, 1, 1, 1, 1),
(6, '2021-10-05 16:32:29.086228', '2021-10-05 23:32:29.086088', NULL, NULL, 1, '_doc', '_doc', 1, 1, 1, 1, 1, 1, 1),
(7, '2021-10-05 16:32:29.124157', '2021-10-05 23:32:29.123993', NULL, NULL, 1, '_follow', '_follow', 1, 1, 1, 1, 1, 1, 1),
(8, '2021-10-05 16:32:29.175481', '2021-10-05 23:32:29.175333', NULL, NULL, 1, '_lang', '_lang', 1, 1, 1, 1, 1, 1, 1),
(9, '2021-10-05 16:32:29.196711', '2021-10-05 23:32:29.196554', NULL, NULL, 1, '_log', '_log', 1, 1, 1, 1, 1, 1, 1),
(10, '2021-10-05 16:32:29.259514', '2021-10-05 23:32:29.259385', NULL, NULL, 1, '_mem', '_mem', 1, 1, 1, 1, 1, 1, 1),
(11, '2021-10-05 16:32:29.370558', '2021-10-05 23:32:29.370298', NULL, NULL, 1, '_mem_auth', '_mem_auth', 1, 1, 1, 1, 1, 1, 1),
(12, '2021-10-05 16:32:29.455330', '2021-10-05 23:32:29.455149', NULL, NULL, 1, '_mem_pref', '_mem_pref', 1, 1, 1, 1, 1, 1, 1),
(13, '2021-10-05 16:32:29.472437', '2021-10-05 23:32:29.472227', NULL, NULL, 1, '_mem_reset', '_mem_reset', 1, 1, 1, 1, 1, 1, 1),
(14, '2021-10-05 16:32:29.510211', '2021-10-05 23:32:29.510078', NULL, NULL, 1, '_menu_item', '_menu_item', 1, 1, 1, 1, 1, 1, 1),
(15, '2021-10-05 16:32:29.585959', '2021-10-05 23:32:29.585820', NULL, NULL, 1, '_module', '_module', 1, 1, 1, 1, 1, 1, 1),
(16, '2021-09-09 05:36:43.690813', '2021-09-09 12:36:43.690532', NULL, NULL, 1, '_module_mem', '_module_mem', 1, 1, 1, 1, 1, 1, 1),
(17, '2021-10-05 16:32:29.668169', '2021-10-05 23:32:29.668054', NULL, NULL, 1, '_note', '_note', 1, 1, 1, 1, 1, 1, 1),
(18, '2021-10-05 16:32:29.804737', '2021-10-05 23:32:29.804489', NULL, NULL, 1, '_notif', '_notif', 1, 1, 1, 1, 1, 1, 1),
(19, '2021-10-05 16:32:29.849722', '2021-10-05 23:32:29.849500', NULL, NULL, 1, '_notif_signal', '_notif_signal', 1, 1, 1, 1, 1, 1, 1),
(20, '2021-10-05 16:32:29.956017', '2021-10-05 23:32:29.955847', NULL, NULL, 1, '_perm', '_perm', 1, 1, 1, 1, 1, 1, 1),
(21, '2021-10-05 16:32:29.998571', '2021-10-05 23:32:29.998424', NULL, NULL, 1, '_perm_menu_item', '_perm_menu_item', 1, 1, 1, 1, 1, 1, 1),
(22, '2021-10-05 16:32:30.048076', '2021-10-05 23:32:30.047928', NULL, NULL, 1, '_pricing', '_pricing', 1, 1, 1, 1, 1, 1, 1),
(23, '2021-10-05 16:32:30.094018', '2021-10-05 23:32:30.093874', NULL, NULL, 1, '_pricing_limit', '_pricing_limit', 1, 1, 1, 1, 1, 1, 1),
(24, '2021-10-05 16:32:30.142570', '2021-10-05 23:32:30.142436', NULL, NULL, 1, '_pricing_module', '_pricing_module', 1, 1, 1, 1, 1, 1, 1),
(25, '2021-10-05 16:32:30.178937', '2021-10-05 23:32:30.178817', NULL, NULL, 1, '_public_path', '_public_path', 1, 1, 1, 1, 1, 1, 1),
(26, '2021-10-05 16:32:30.224025', '2021-10-05 23:32:30.223913', NULL, NULL, 1, '_report', '_report', 1, 1, 1, 1, 1, 1, 1),
(27, '2021-10-05 16:32:30.270614', '2021-10-05 23:32:30.270457', NULL, NULL, 1, '_report_lib', '_report_lib', 1, 1, 1, 1, 1, 1, 1),
(28, '2021-10-05 16:32:30.310783', '2021-10-05 23:32:30.310620', NULL, NULL, 1, '_role', '_role', 1, 1, 1, 1, 1, 1, 1),
(29, '2021-10-05 16:32:30.349239', '2021-10-05 23:32:30.349103', NULL, NULL, 1, '_role_perm', '_role_perm', 1, 1, 1, 1, 1, 1, 1),
(30, '2021-10-05 16:32:30.388629', '2021-10-05 23:32:30.388481', NULL, NULL, 1, '_setting', '_setting', 1, 1, 1, 1, 1, 1, 1),
(31, '2021-10-05 16:32:30.428355', '2021-10-05 23:32:30.428185', NULL, NULL, 1, '_signal', '_signal', 1, 1, 1, 1, 1, 1, 1),
(32, '2021-10-05 16:32:30.470818', '2021-10-05 23:32:30.470671', NULL, NULL, 1, '_signal_mem', '_signal_mem', 1, 1, 1, 1, 1, 1, 1),
(33, '2021-10-05 16:32:30.512433', '2021-10-05 23:32:30.512244', NULL, NULL, 1, '_state', '_state', 1, 1, 1, 1, 1, 1, 1),
(34, '2021-10-05 16:32:30.610505', '2021-10-05 23:32:30.610345', NULL, NULL, 1, '_co', '_co', 1, 1, 1, 1, 1, 1, 1),
(35, '2021-09-09 05:36:45.009755', '2021-09-09 12:36:45.009641', NULL, NULL, 1, '_co_module', '_co_module', 1, 1, 1, 1, 1, 1, 1),
(36, '2021-10-05 16:32:30.879314', '2021-10-05 23:32:30.879174', NULL, NULL, 1, '_co_pref', '_co_pref', 1, 1, 1, 1, 1, 1, 1),
(37, '2021-10-05 16:32:30.974795', '2021-10-05 23:32:30.974650', NULL, NULL, 1, '_tag', '_tag', 1, 1, 1, 1, 1, 1, 1),
(38, '2021-10-05 16:32:31.093229', '2021-10-05 23:32:31.093100', NULL, NULL, 1, '_task', '_task', 1, 1, 1, 1, 1, 1, 1),
(39, '2021-10-05 16:32:31.135219', '2021-10-05 23:32:31.135096', NULL, NULL, 1, '_token', '_token', 1, 1, 1, 1, 1, 1, 1),
(40, '2021-10-05 16:32:31.239186', '2021-10-05 23:32:31.239069', NULL, NULL, 1, '_token_xl8', '_token_xl8', 1, 1, 1, 1, 1, 1, 1),
(41, '2021-10-05 16:32:31.281107', '2021-10-05 23:32:31.280986', NULL, NULL, 1, '_tz', '_tz', 1, 1, 1, 1, 1, 1, 1),
(42, '2021-10-05 16:32:31.334688', '2021-10-05 23:32:31.334493', NULL, NULL, 1, '_valid_field', '_valid_field', 1, 1, 1, 1, 1, 1, 1),
(43, '2021-10-05 16:32:31.393260', '2021-10-05 23:32:31.393106', NULL, NULL, 1, '_valid_form', '_valid_form', 1, 1, 1, 1, 1, 1, 1),
(44, '2021-10-05 16:32:29.621865', '2021-10-05 23:32:29.621735', NULL, NULL, 1, '_module_perm', '_module_perm', 1, 1, 1, 1, 1, 1, 1),
(64, '2021-10-05 16:32:29.314716', '2021-10-05 23:32:29.314545', NULL, NULL, 1, '_mem_addr', '_mem_addr', 1, 1, 1, 1, 1, 1, 1),
(65, '2021-10-05 16:32:29.408357', '2021-10-05 23:32:29.408209', NULL, NULL, 1, '_mem_phone', '_mem_phone', 1, 1, 1, 1, 1, 1, 1),
(66, '2021-10-05 16:32:28.608920', '2021-10-05 23:32:28.608778', NULL, NULL, 1, '_cal', '_cal', 1, 1, 1, 1, 1, 1, 1),
(67, '2021-10-05 16:32:28.656937', '2021-10-05 23:32:28.656779', NULL, NULL, 1, '_cal_ext', '_cal_ext', 1, 1, 1, 1, 1, 1, 1),
(68, '2021-10-05 16:32:28.697545', '2021-10-05 23:32:28.697381', NULL, NULL, 1, '_cal_follow', '_cal_follow', 1, 1, 1, 1, 1, 1, 1),
(69, '2021-10-05 16:32:28.732637', '2021-10-05 23:32:28.732496', NULL, NULL, 1, '_cal_item', '_cal_item', 1, 1, 1, 1, 1, 1, 1),
(70, '2021-10-05 16:32:28.906593', '2021-10-05 23:32:28.906349', NULL, NULL, 1, '_cat_phone', '_cat_phone', 1, 1, 1, 1, 1, 1, 1),
(71, '2021-10-05 16:32:28.781858', '2021-10-05 23:32:28.781715', NULL, NULL, 1, '_cat_addr', '_cat_addr', 1, 1, 1, 1, 1, 1, 1),
(72, '2021-10-05 16:32:28.858561', '2021-10-05 23:32:28.858387', NULL, NULL, 1, '_cat_note', '_cat_note', 1, 1, 1, 1, 1, 1, 1),
(73, '2021-10-05 16:32:29.913624', '2021-10-05 23:32:29.913486', NULL, NULL, 1, '_pay', '_pay', 1, 1, 1, 1, 1, 1, 1),
(74, '2021-10-05 16:32:30.698807', '2021-10-05 23:32:30.698643', NULL, NULL, 1, '_co_mem', '_co_mem', 1, 1, 1, 1, 1, 1, 1);

CREATE TABLE `_cal` (
  `_cal_id` int(11) NOT NULL,
  `_cal_new` timestamp NULL DEFAULT NULL,
  `_cal_edit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `_cal_del` timestamp NULL DEFAULT NULL,
  `_cal_arch` timestamp NULL DEFAULT NULL,
  `_cal_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `_cal_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_cal_ext` (
  `_cal_ext_id` int(11) NOT NULL,
  `_cal_ext_new` timestamp NULL DEFAULT NULL,
  `_cal_ext_edit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `_cal_ext_del` timestamp NULL DEFAULT NULL,
  `_cal_ext_arch` timestamp NULL DEFAULT NULL,
  `_cal_ext_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `_cal_ext_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_cal_follow` (
  `_cal_follow_id` int(11) NOT NULL,
  `_cal_follow_new` timestamp NULL DEFAULT NULL,
  `_cal_follow_edit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `_cal_follow_del` timestamp NULL DEFAULT NULL,
  `_cal_follow_arch` timestamp NULL DEFAULT NULL,
  `_cal_follow_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `_cal_follow_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_cal_item` (
  `_cal_item_id` int(11) NOT NULL,
  `_cal_item_new` timestamp NULL DEFAULT NULL,
  `_cal_item_edit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `_cal_item_del` timestamp NULL DEFAULT NULL,
  `_cal_item_arch` timestamp NULL DEFAULT NULL,
  `_cal_item_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `_cal_item_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_cat_addr` (
  `_cat_addr_id` int(11) NOT NULL,
  `_cat_addr_new` timestamp NULL DEFAULT NULL,
  `_cat_addr_edit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `_cat_addr_del` timestamp NULL DEFAULT NULL,
  `_cat_addr_arch` timestamp NULL DEFAULT NULL,
  `_cat_addr_active` tinyint(1) DEFAULT 1,
  `_cat_addr_order` smallint(6) DEFAULT NULL,
  `_cat_addr_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_cat_note` (
  `_cat_note_id` int(11) NOT NULL,
  `_cat_note_new` timestamp NULL DEFAULT NULL,
  `_cat_note_edit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `_cat_note_del` timestamp NULL DEFAULT NULL,
  `_cat_note_arch` timestamp NULL DEFAULT NULL,
  `_cat_note_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `_cat_note_order` smallint(6) DEFAULT NULL,
  `_cat_note_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_cat_phone` (
  `_cat_phone_id` int(11) NOT NULL,
  `_cat_phone_new` timestamp NULL DEFAULT NULL,
  `_cat_phone_edit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `_cat_phone_del` timestamp NULL DEFAULT NULL,
  `_cat_phone_arch` timestamp NULL DEFAULT NULL,
  `_cat_phone_active` tinyint(1) DEFAULT 1,
  `_cat_phone_order` smallint(6) DEFAULT NULL,
  `_cat_phone_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_config` (
  `_config_id` int(11) NOT NULL,
  `_config_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_config_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_config_del` timestamp(6) NULL DEFAULT NULL,
  `_config_arch` timestamp(6) NULL DEFAULT NULL,
  `_config_active` tinyint(1) DEFAULT 1,
  `_config_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_config_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_config_table` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_config_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_country` (
  `_country_id` int(11) NOT NULL,
  `_country_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_country_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_country_del` timestamp(6) NULL DEFAULT NULL,
  `_country_arch` timestamp(6) NULL DEFAULT NULL,
  `_country_active` tinyint(1) DEFAULT 1,
  `_country_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_country_abbrev` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_country_display_order` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_country` (`_country_id`, `_country_new`, `_country_edit`, `_country_del`, `_country_arch`, `_country_active`, `_country_name`, `_country_abbrev`, `_country_display_order`) VALUES
(1, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Afghanistan', 'AF', NULL),
(2, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Albania', 'AL', NULL),
(3, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Algeria', 'DZ', NULL),
(4, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'American Samoa', 'DS', NULL),
(5, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Andorra', 'AD', NULL),
(6, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Angola', 'AO', NULL),
(7, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Anguilla', 'AI', NULL),
(8, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antarctica', 'AQ', NULL),
(9, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antigua and Barbuda', 'AG', NULL),
(10, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Argentina', 'AR', NULL),
(11, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Armenia', 'AM', NULL),
(12, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Aruba', 'AW', NULL),
(13, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'AU', NULL),
(14, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Austria', 'AT', NULL),
(15, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Azerbaijan', 'AZ', NULL),
(16, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Bahamas', 'BS', NULL),
(17, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Bahrain', 'BH', NULL),
(18, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Bangladesh', 'BD', NULL),
(19, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Barbados', 'BB', NULL),
(20, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Belarus', 'BY', NULL),
(21, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Belgium', 'BE', NULL),
(22, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Belize', 'BZ', NULL),
(23, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Benin', 'BJ', NULL),
(24, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Bermuda', 'BM', NULL),
(25, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Bhutan', 'BT', NULL),
(26, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Bolivia', 'BO', NULL),
(27, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Bosnia and Herzegovina', 'BA', NULL),
(28, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Botswana', 'BW', NULL),
(29, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Bouvet Island', 'BV', NULL),
(30, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Brazil', 'BR', NULL),
(31, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'British Indian Ocean Territory', 'IO', NULL),
(32, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Brunei Darussalam', 'BN', NULL),
(33, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Bulgaria', 'BG', NULL),
(34, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Burkina Faso', 'BF', NULL),
(35, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Burundi', 'BI', NULL),
(36, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Cambodia', 'KH', NULL),
(37, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Cameroon', 'CM', NULL),
(38, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Canada', 'CA', NULL),
(39, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Cape Verde', 'CV', NULL),
(40, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Cayman Islands', 'KY', NULL),
(41, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Central African Republic', 'CF', NULL),
(42, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Chad', 'TD', NULL),
(43, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Chile', 'CL', NULL),
(44, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'China', 'CN', NULL),
(45, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Christmas Island', 'CX', NULL),
(46, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Cocos (Keeling) Islands', 'CC', NULL),
(47, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Colombia', 'CO', NULL),
(48, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Comoros', 'KM', NULL),
(49, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Congo', 'CG', NULL),
(50, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Cook Islands', 'CK', NULL),
(51, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Costa Rica', 'CR', NULL),
(52, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Croatia (Hrvatska)', 'HR', NULL),
(53, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Cuba', 'CU', NULL),
(54, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Cyprus', 'CY', NULL),
(55, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Czech Republic', 'CZ', NULL),
(56, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Denmark', 'DK', NULL),
(57, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Djibouti', 'DJ', NULL),
(58, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Dominica', 'DM', NULL),
(59, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Dominican Republic', 'DO', NULL),
(60, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'East Timor', 'TP', NULL),
(61, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Ecuador', 'EC', NULL),
(62, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Egypt', 'EG', NULL),
(63, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'El Salvador', 'SV', NULL),
(64, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Equatorial Guinea', 'GQ', NULL),
(65, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Eritrea', 'ER', NULL),
(66, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Estonia', 'EE', NULL),
(67, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Ethiopia', 'ET', NULL),
(68, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Falkland Islands (Malvinas)', 'FK', NULL),
(69, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Faroe Islands', 'FO', NULL),
(70, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Fiji', 'FJ', NULL),
(71, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Finland', 'FI', NULL),
(72, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'France', 'FR', NULL),
(73, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'France, Metropolitan', 'FX', NULL),
(74, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'French Guiana', 'GF', NULL),
(75, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'French Polynesia', 'PF', NULL),
(76, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'French Southern Territories', 'TF', NULL),
(77, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Gabon', 'GA', NULL),
(78, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Gambia', 'GM', NULL),
(79, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Georgia', 'GE', NULL),
(80, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Germany', 'DE', NULL),
(81, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Ghana', 'GH', NULL),
(82, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Gibraltar', 'GI', NULL),
(83, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Guernsey', 'GK', NULL),
(84, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Greece', 'GR', NULL),
(85, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Greenland', 'GL', NULL),
(86, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Grenada', 'GD', NULL),
(87, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Guadeloupe', 'GP', NULL),
(88, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Guam', 'GU', NULL),
(89, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Guatemala', 'GT', NULL),
(90, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Guinea', 'GN', NULL),
(91, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Guinea-Bissau', 'GW', NULL),
(92, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Guyana', 'GY', NULL),
(93, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Haiti', 'HT', NULL),
(94, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Heard and Mc Donald Islands', 'HM', NULL),
(95, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Honduras', 'HN', NULL),
(96, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Hong Kong', 'HK', NULL),
(97, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Hungary', 'HU', NULL),
(98, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Iceland', 'IS', NULL),
(99, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'India', 'IN', NULL),
(100, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Isle of Man', 'IM', NULL),
(101, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indonesia', 'ID', NULL),
(102, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Iran (Islamic Republic of)', 'IR', NULL),
(103, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Iraq', 'IQ', NULL),
(104, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Ireland', 'IE', NULL),
(105, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Israel', 'IL', NULL),
(106, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Italy', 'IT', NULL),
(107, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Ivory Coast', 'CI', NULL),
(108, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Jersey', 'JE', NULL),
(109, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Jamaica', 'JM', NULL),
(110, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Japan', 'JP', NULL),
(111, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Jordan', 'JO', NULL),
(112, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Kazakhstan', 'KZ', NULL),
(113, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Kenya', 'KE', NULL),
(114, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Kiribati', 'KI', NULL),
(115, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Korea, Democratic People\'s Republic of', 'KP', NULL),
(116, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Korea, Republic of', 'KR', NULL),
(117, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Kosovo', 'XK', NULL),
(118, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Kuwait', 'KW', NULL),
(119, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Kyrgyzstan', 'KG', NULL),
(120, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Lao People\'s Democratic Republic', 'LA', NULL),
(121, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Latvia', 'LV', NULL),
(122, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Lebanon', 'LB', NULL),
(123, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Lesotho', 'LS', NULL),
(124, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Liberia', 'LR', NULL),
(125, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Libyan Arab Jamahiriya', 'LY', NULL),
(126, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Liechtenstein', 'LI', NULL),
(127, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Lithuania', 'LT', NULL),
(128, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Luxembourg', 'LU', NULL),
(129, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Macau', 'MO', NULL),
(130, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Macedonia', 'MK', NULL),
(131, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Madagascar', 'MG', NULL),
(132, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Malawi', 'MW', NULL),
(133, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Malaysia', 'MY', NULL),
(134, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Maldives', 'MV', NULL),
(135, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Mali', 'ML', NULL),
(136, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Malta', 'MT', NULL),
(137, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Marshall Islands', 'MH', NULL),
(138, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Martinique', 'MQ', NULL),
(139, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Mauritania', 'MR', NULL),
(140, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Mauritius', 'MU', NULL),
(141, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Mayotte', 'TY', NULL),
(142, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Mexico', 'MX', NULL),
(143, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Micronesia, Federated States of', 'FM', NULL),
(144, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Moldova, Republic of', 'MD', NULL),
(145, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Monaco', 'MC', NULL),
(146, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Mongolia', 'MN', NULL),
(147, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Montenegro', 'ME', NULL),
(148, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Montserrat', 'MS', NULL),
(149, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Morocco', 'MA', NULL),
(150, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Mozambique', 'MZ', NULL),
(151, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Myanmar', 'MM', NULL),
(152, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Namibia', 'NA', NULL),
(153, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Nauru', 'NR', NULL),
(154, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Nepal', 'NP', NULL),
(155, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Netherlands', 'NL', NULL),
(156, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Netherlands Antilles', 'AN', NULL),
(157, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'New Caledonia', 'NC', NULL),
(158, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'New Zealand', 'NZ', NULL),
(159, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Nicaragua', 'NI', NULL),
(160, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Niger', 'NE', NULL),
(161, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Nigeria', 'NG', NULL),
(162, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Niue', 'NU', NULL),
(163, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Norfolk Island', 'NF', NULL),
(164, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Northern Mariana Islands', 'MP', NULL),
(165, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Norway', 'NO', NULL),
(166, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Oman', 'OM', NULL),
(167, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pakistan', 'PK', NULL),
(168, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Palau', 'PW', NULL),
(169, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Palestine', 'PS', NULL),
(170, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Panama', 'PA', NULL),
(171, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Papua New Guinea', 'PG', NULL),
(172, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Paraguay', 'PY', NULL),
(173, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Peru', 'PE', NULL),
(174, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Philippines', 'PH', NULL),
(175, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pitcairn', 'PN', NULL),
(176, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Poland', 'PL', NULL),
(177, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Portugal', 'PT', NULL),
(178, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Puerto Rico', 'PR', NULL),
(179, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Qatar', 'QA', NULL),
(180, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Reunion', 'RE', NULL),
(181, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Romania', 'RO', NULL),
(182, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Russian Federation', 'RU', NULL),
(183, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Rwanda', 'RW', NULL),
(184, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Saint Kitts and Nevis', 'KN', NULL),
(185, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Saint Lucia', 'LC', NULL),
(186, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Saint Vincent and the Grenadines', 'VC', NULL),
(187, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Samoa', 'WS', NULL),
(188, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'San Marino', 'SM', NULL),
(189, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Sao Tome and Principe', 'ST', NULL),
(190, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Saudi Arabia', 'SA', NULL),
(191, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Senegal', 'SN', NULL),
(192, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Serbia', 'RS', NULL),
(193, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Seychelles', 'SC', NULL),
(194, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Sierra Leone', 'SL', NULL),
(195, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Singapore', 'SG', NULL),
(196, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Slovakia', 'SK', NULL),
(197, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Slovenia', 'SI', NULL),
(198, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Solomon Islands', 'SB', NULL),
(199, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Somalia', 'SO', NULL),
(200, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'South Africa', 'ZA', NULL),
(201, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'South Georgia South Sandwich Islands', 'GS', NULL),
(202, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'South Sudan', 'SS', NULL),
(203, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Spain', 'ES', NULL),
(204, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Sri Lanka', 'LK', NULL),
(205, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'St. Helena', 'SH', NULL),
(206, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'St. Pierre and Miquelon', 'PM', NULL),
(207, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Sudan', 'SD', NULL),
(208, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Suriname', 'SR', NULL),
(209, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Svalbard and Jan Mayen Islands', 'SJ', NULL),
(210, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Swaziland', 'SZ', NULL),
(211, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Sweden', 'SE', NULL),
(212, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Switzerland', 'CH', NULL),
(213, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Syrian Arab Republic', 'SY', NULL),
(214, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Taiwan', 'TW', NULL),
(215, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Tajikistan', 'TJ', NULL),
(216, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Tanzania, United Republic of', 'TZ', NULL),
(217, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Thailand', 'TH', NULL),
(218, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Togo', 'TG', NULL),
(219, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Tokelau', 'TK', NULL),
(220, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Tonga', 'TO', NULL),
(221, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Trinidad and Tobago', 'TT', NULL),
(222, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Tunisia', 'TN', NULL),
(223, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Turkey', 'TR', NULL),
(224, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Turkmenistan', 'TM', NULL),
(225, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Turks and Caicos Islands', 'TC', NULL),
(226, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Tuvalu', 'TV', NULL),
(227, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Uganda', 'UG', NULL),
(228, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Ukraine', 'UA', NULL),
(229, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'United Arab Emirates', 'AE', NULL),
(230, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'United Kingdom', 'GB', NULL),
(231, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'United States', 'US', 1),
(232, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'United States minor outlying islands', 'UM', NULL),
(233, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Uruguay', 'UY', NULL),
(234, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Uzbekistan', 'UZ', NULL),
(235, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Vanuatu', 'VU', NULL),
(236, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Vatican City State', 'VA', NULL),
(237, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Venezuela', 'VE', NULL),
(238, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Vietnam', 'VN', NULL),
(239, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Virgin Islands (British)', 'VG', NULL),
(240, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Virgin Islands (U.S.)', 'VI', NULL),
(241, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Wallis and Futuna Islands', 'WF', NULL),
(242, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Western Sahara', 'EH', NULL),
(243, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Yemen', 'YE', NULL),
(244, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Zaire', 'ZR', NULL),
(245, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Zambia', 'ZM', NULL),
(246, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Zimbabwe', 'ZW', NULL);

CREATE TABLE `_doc` (
  `_doc_id` int(11) NOT NULL,
  `_doc_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_doc_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_doc_del` timestamp(6) NULL DEFAULT NULL,
  `_doc_arch` timestamp(6) NULL DEFAULT NULL,
  `_doc_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL COMMENT '_mem the document relates to',
  `fk_uploader__mem_id` int(11) DEFAULT NULL,
  `_doc_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_doc_orig_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_doc_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_doc_size` int(11) DEFAULT NULL COMMENT 'in kb',
  `_doc_s3_loc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_doc_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_follow` (
  `_follow_id` int(11) NOT NULL,
  `_follow_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_follow_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_follow_del` timestamp(6) NULL DEFAULT NULL,
  `_follow_arch` timestamp(6) NULL DEFAULT NULL,
  `_follow_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL,
  `_follow_obj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_follow_obj_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_lang` (
  `_lang_id` int(11) NOT NULL,
  `_lang_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_lang_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_lang_del` timestamp(6) NULL DEFAULT NULL,
  `_lang_arch` timestamp(6) NULL DEFAULT NULL,
  `_lang_active` tinyint(1) DEFAULT 1,
  `_lang_order` smallint(6) DEFAULT NULL,
  `_lang_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_lang_code` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_lang_default` tinyint(1) DEFAULT 0,
  `_lang_system` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_lang` (`_lang_id`, `_lang_new`, `_lang_edit`, `_lang_del`, `_lang_arch`, `_lang_active`, `_lang_order`, `_lang_name`, `_lang_code`, `_lang_default`, `_lang_system`) VALUES
(1, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 1, 'English', 'en', 1, 1),
(2, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 2, 'Spanish', 'es', 0, 1),
(3, '2021-08-02 15:24:19.743004', '2021-08-02 22:24:19.742919', NULL, NULL, 1, 3, 'Abkhazian', 'ab', 0, 0),
(4, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Afrikaans', 'af', 0, 0),
(5, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Amharic', 'am', 0, 0),
(6, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Arabic', 'ar', 0, 0),
(7, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Assamese', 'as', 0, 0),
(8, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Aymara', 'ay', 0, 0),
(9, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Azerbaijani', 'az', 0, 0),
(10, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Bashkir', 'ba', 0, 0),
(11, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Belarusian', 'be', 0, 0),
(12, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Bulgarian', 'bg', 0, 0),
(13, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Bihari', 'bh', 0, 0),
(14, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Bislama', 'bi', 0, 0),
(15, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Bengali/Bangla', 'bn', 0, 0),
(16, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Tibetan', 'bo', 0, 0),
(17, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Breton', 'br', 0, 0),
(18, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Catalan', 'ca', 0, 0),
(19, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Corsican', 'co', 0, 0),
(20, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Czech', 'cs', 0, 0),
(21, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Welsh', 'cy', 0, 0),
(22, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Danish', 'da', 0, 0),
(23, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'German', 'de', 0, 0),
(24, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Bhutani', 'dz', 0, 0),
(25, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Greek', 'el', 0, 0),
(26, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Esperanto', 'eo', 0, 0),
(27, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Afar', 'aa', 0, 0),
(28, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Estonian', 'et', 0, 0),
(29, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Basque', 'eu', 0, 0),
(30, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Persian', 'fa', 0, 0),
(31, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Finnish', 'fi', 0, 0),
(32, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Fiji', 'fj', 0, 0),
(33, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Faeroese', 'fo', 0, 0),
(34, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'French', 'fr', 0, 0),
(35, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Frisian', 'fy', 0, 0),
(36, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Irish', 'ga', 0, 0),
(37, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Scots/Gaelic', 'gd', 0, 0),
(38, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Galician', 'gl', 0, 0),
(39, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Guarani', 'gn', 0, 0),
(40, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Gujarati', 'gu', 0, 0),
(41, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Hausa', 'ha', 0, 0),
(42, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Hindi', 'hi', 0, 0),
(43, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Croatian', 'hr', 0, 0),
(44, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Hungarian', 'hu', 0, 0),
(45, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Armenian', 'hy', 0, 0),
(46, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Interlingua', 'ia', 0, 0),
(47, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Interlingue', 'ie', 0, 0),
(48, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Inupiak', 'ik', 0, 0),
(49, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Indonesian', 'in', 0, 0),
(50, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Icelandic', 'is', 0, 0),
(51, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Italian', 'it', 0, 0),
(52, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Hebrew', 'iw', 0, 0),
(53, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Japanese', 'ja', 0, 0),
(54, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Yiddish', 'ji', 0, 0),
(55, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Javanese', 'jw', 0, 0),
(56, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Georgian', 'ka', 0, 0),
(57, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Kazakh', 'kk', 0, 0),
(58, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Greenlandic', 'kl', 0, 0),
(59, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Cambodian', 'km', 0, 0),
(60, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Kannada', 'kn', 0, 0),
(61, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Korean', 'ko', 0, 0),
(62, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Kashmiri', 'ks', 0, 0),
(63, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Kurdish', 'ku', 0, 0),
(64, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Kirghiz', 'ky', 0, 0),
(65, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Latin', 'la', 0, 0),
(66, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Lingala', 'ln', 0, 0),
(67, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Laothian', 'lo', 0, 0),
(68, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Lithuanian', 'lt', 0, 0),
(69, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Latvian/Lettish', 'lv', 0, 0),
(70, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Malagasy', 'mg', 0, 0),
(71, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Maori', 'mi', 0, 0),
(72, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Macedonian', 'mk', 0, 0),
(73, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Malayalam', 'ml', 0, 0),
(74, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Mongolian', 'mn', 0, 0),
(75, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Moldavian', 'mo', 0, 0),
(76, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Marathi', 'mr', 0, 0),
(77, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Malay', 'ms', 0, 0),
(78, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Maltese', 'mt', 0, 0),
(79, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Burmese', 'my', 0, 0),
(80, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Nauru', 'na', 0, 0),
(81, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Nepali', 'ne', 0, 0),
(82, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Dutch', 'nl', 0, 0),
(83, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Norwegian', 'no', 0, 0),
(84, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Occitan', 'oc', 0, 0),
(85, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, '(Afan)/Oromoor/Oriya', 'om', 0, 0),
(86, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Punjabi', 'pa', 0, 0),
(87, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Polish', 'pl', 0, 0),
(88, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Pashto/Pushto', 'ps', 0, 0),
(89, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Portuguese', 'pt', 0, 0),
(90, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Quechua', 'qu', 0, 0),
(91, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Rhaeto-Romance', 'rm', 0, 0),
(92, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Kirundi', 'rn', 0, 0),
(93, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Romanian', 'ro', 0, 0),
(94, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Russian', 'ru', 0, 0),
(95, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Kinyarwanda', 'rw', 0, 0),
(96, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Sanskrit', 'sa', 0, 0),
(97, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Sindhi', 'sd', 0, 0),
(98, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Sangro', 'sg', 0, 0),
(99, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Serbo-Croatian', 'sh', 0, 0),
(100, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Singhalese', 'si', 0, 0),
(101, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Slovak', 'sk', 0, 0),
(102, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Slovenian', 'sl', 0, 0),
(103, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Samoan', 'sm', 0, 0),
(104, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Shona', 'sn', 0, 0),
(105, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Somali', 'so', 0, 0),
(106, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Albanian', 'sq', 0, 0),
(107, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Serbian', 'sr', 0, 0),
(108, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Siswati', 'ss', 0, 0),
(109, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Sesotho', 'st', 0, 0),
(110, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Sundanese', 'su', 0, 0),
(111, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Swedish', 'sv', 0, 0),
(112, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Swahili', 'sw', 0, 0),
(113, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Tamil', 'ta', 0, 0),
(114, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Telugu', 'te', 0, 0),
(115, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Tajik', 'tg', 0, 0),
(116, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Thai', 'th', 0, 0),
(117, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Tigrinya', 'ti', 0, 0),
(118, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Turkmen', 'tk', 0, 0),
(119, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Tagalog', 'tl', 0, 0),
(120, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Setswana', 'tn', 0, 0),
(121, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Tonga', 'to', 0, 0),
(122, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Turkish', 'tr', 0, 0),
(123, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Tsonga', 'ts', 0, 0),
(124, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Tatar', 'tt', 0, 0),
(125, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Twi', 'tw', 0, 0),
(126, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Ukrainian', 'uk', 0, 0),
(127, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Urdu', 'ur', 0, 0),
(128, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Uzbek', 'uz', 0, 0),
(129, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Vietnamese', 'vi', 0, 0),
(130, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Volapuk', 'vo', 0, 0),
(131, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Wolof', 'wo', 0, 0),
(132, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Xhosa', 'xh', 0, 0),
(133, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Yoruba', 'yo', 0, 0),
(134, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Chinese', 'zh', 0, 0),
(135, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 3, 'Zulu', 'zu', 0, 0);

CREATE TABLE `_log` (
  `_log_id` int(11) NOT NULL,
  `_log_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_log_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_log_del` timestamp(6) NULL DEFAULT NULL,
  `_log_arch` timestamp(6) NULL DEFAULT NULL,
  `_log_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL,
  `fk__module_id` int(11) DEFAULT NULL,
  `_log_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_log_obj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_log_obj_id` int(11) DEFAULT NULL,
  `_log_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_mem` (
  `_mem_id` int(11) NOT NULL,
  `_mem_new` timestamp(6) NULL DEFAULT NULL,
  `_mem_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_mem_del` timestamp(6) NULL DEFAULT NULL,
  `_mem_arch` timestamp(6) NULL DEFAULT NULL,
  `_mem_active` tinyint(1) DEFAULT 1,
  `fk__doc_id` int(11) DEFAULT NULL COMMENT 'Profile Pic',
  `_mem_ulid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_mname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_dob` date DEFAULT NULL,
  `_mem_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_email_verified` tinyint(1) DEFAULT 0,
  `_mem_configured` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Short for member';

INSERT INTO `_mem` (`_mem_id`, `_mem_new`, `_mem_edit`, `_mem_del`, `_mem_arch`, `_mem_active`, `fk__doc_id`, `_mem_ulid`, `_mem_code`, `_mem_fname`, `_mem_mname`, `_mem_lname`, `_mem_name`, `_mem_dob`, `_mem_email`, `_mem_email_verified`, `_mem_configured`) VALUES
(1, '2021-11-14 20:13:54.995658', '2021-11-19 20:39:44.595677', NULL, NULL, 1, NULL, '25c30dce8daf4c4795825127fbc6a221', 'default_admin', 'Default', NULL, 'Admin', 'Default Admin', NULL, 'default@admin', 0, 0);

CREATE TABLE `_mem_addr` (
  `_mem_addr_id` int(11) NOT NULL,
  `_mem_addr_new` timestamp NULL DEFAULT NULL,
  `_mem_addr_edit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `_mem_addr_del` timestamp NULL DEFAULT NULL,
  `_mem_addr_arch` timestamp NULL DEFAULT NULL,
  `_mem_addr_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL,
  `fk__state_id` int(11) DEFAULT NULL,
  `fk__country_id` int(11) DEFAULT NULL,
  `fk__cat_addr_id` int(11) DEFAULT NULL,
  `_mem_addr_street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_addr_street_two` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_addr_apt_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_addr_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_addr_postal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_addr_owned` tinyint(1) DEFAULT 0,
  `_mem_addr_rented` tinyint(1) DEFAULT 0,
  `_mem_addr_start` date DEFAULT NULL,
  `_mem_addr_end` date DEFAULT NULL,
  `_mem_addr_current` tinyint(1) DEFAULT 0,
  `_mem_addr_renewal` date DEFAULT NULL,
  `_mem_addr_duration` smallint(6) DEFAULT NULL,
  `_mem_addr_homeless` tinyint(1) DEFAULT 0,
  `_mem_addr_protect` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_mem_auth` (
  `_mem_auth_id` int(11) NOT NULL,
  `_mem_auth_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_mem_auth_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_mem_auth_del` timestamp(6) NULL DEFAULT NULL,
  `_mem_auth_arch` timestamp(6) NULL DEFAULT NULL,
  `_mem_auth_active` tinyint(1) DEFAULT 1,
  `fk__mem_id` int(11) DEFAULT NULL,
  `fk__co_id` int(11) DEFAULT NULL,
  `_mem_login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_password` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_mem_auth` (`_mem_auth_id`, `_mem_auth_new`, `_mem_auth_edit`, `_mem_auth_del`, `_mem_auth_arch`, `_mem_auth_active`, `fk__mem_id`, `fk__co_id`, `_mem_login`, `_mem_password`) VALUES
(1, '2021-11-19 22:08:16.345440', '2021-11-19 22:08:16.345440', NULL, NULL, 1, 1, 1, 'default@admin', '');

CREATE TABLE `_mem_phone` (
  `_mem_phone_id` int(11) NOT NULL,
  `_mem_phone_new` timestamp NULL DEFAULT NULL,
  `_mem_phone_edit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `_mem_phone_del` timestamp NULL DEFAULT NULL,
  `_mem_phone_arch` timestamp NULL DEFAULT NULL,
  `_mem_phone_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL,
  `fk__cat_phone_id` int(11) DEFAULT NULL,
  `_mem_phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_phone_verified` tinyint(1) DEFAULT 0,
  `_mem_phone_verify_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_mem_pref` (
  `_mem_pref_id` int(11) NOT NULL,
  `_mem_pref_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_mem_pref_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_mem_pref_del` timestamp(6) NULL DEFAULT NULL,
  `_mem_pref_arch` timestamp(6) NULL DEFAULT NULL,
  `_mem_pref_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL,
  `_mem_pref_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_pref_group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_pref_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_mem_reset` (
  `_mem_reset_id` int(11) NOT NULL,
  `_mem_reset_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_mem_reset_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_mem_reset_del` timestamp(6) NULL DEFAULT NULL,
  `_mem_reset_arch` timestamp(6) NULL DEFAULT NULL,
  `_mem_reset_active` tinyint(1) DEFAULT 1,
  `fk__mem_id` int(11) DEFAULT NULL,
  `fk__co_id` int(11) DEFAULT NULL,
  `_mem_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_reset_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_reset_match_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_mem_reset_new_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_menu_item` (
  `_menu_item_id` int(11) NOT NULL,
  `_menu_item_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_menu_item_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_menu_item_del` timestamp(6) NULL DEFAULT NULL,
  `_menu_item_arch` timestamp(6) NULL DEFAULT NULL,
  `_menu_item_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `_menu_item_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_menu_item_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_menu_item_href` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_menu_item_click` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_menu_item_target` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_menu_item_toggle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_menu_item_icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_menu_item_public` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_module` (
  `_module_id` int(11) NOT NULL,
  `_module_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_module_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_module_del` timestamp(6) NULL DEFAULT NULL,
  `_module_arch` timestamp(6) NULL DEFAULT NULL,
  `_module_active` tinyint(1) DEFAULT 1,
  `_module_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'token to translate',
  `_module_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_module_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_module_default` tinyint(1) DEFAULT 0,
  `_module_display_order` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_module` (`_module_id`, `_module_new`, `_module_edit`, `_module_del`, `_module_arch`, `_module_active`, `_module_name`, `_module_desc`, `_module_type`, `_module_default`, `_module_display_order`) VALUES
(1, '2021-11-19 20:46:01.258470', '2021-11-19 20:46:01.258470', NULL, NULL, 1, 'Default Module', 'A module you should edit or delete and make your own.', 'default', 1, 1);

CREATE TABLE `_module_perm` (
  `_module_perm_id` int(11) NOT NULL,
  `_module_perm_new` datetime DEFAULT NULL,
  `_module_perm_edit` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `_module_perm_del` datetime DEFAULT NULL,
  `_module_perm_arch` datetime DEFAULT NULL,
  `_module_perm_active` tinyint(1) DEFAULT 1,
  `fk__module_id` int(11) DEFAULT NULL,
  `fk__perm_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_note` (
  `_note_id` int(11) NOT NULL,
  `_note_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_note_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_note_del` timestamp(6) NULL DEFAULT NULL,
  `_note_arch` timestamp(6) NULL DEFAULT NULL,
  `_note_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL,
  `fk__cat_note_id` int(11) DEFAULT NULL,
  `fk__note_id` int(11) DEFAULT NULL COMMENT 'if !NULL, this is a reply to this note_id',
  `_note_edited` tinyint(1) DEFAULT 0,
  `_note_effective_date` timestamp(6) NULL DEFAULT NULL,
  `_note_text` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `_note_obj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_note_obj_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_notif` (
  `_notif_id` int(11) NOT NULL,
  `_notif_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_notif_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_notif_del` timestamp(6) NULL DEFAULT NULL,
  `_notif_arch` timestamp(6) NULL DEFAULT NULL,
  `_notif_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL COMMENT 'Author, 0 if system',
  `_notif_text` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_notif_signal` (
  `_notif_signal_id` int(11) NOT NULL,
  `_notif_signal_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_notif_signal_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_notif_signal_del` timestamp(6) NULL DEFAULT NULL,
  `_notif_signal_arch` timestamp(6) NULL DEFAULT NULL,
  `_notif_signal_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__signal_id` int(11) DEFAULT NULL,
  `fk__notif_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_pay` (
  `_pay_id` int(11) NOT NULL,
  `_pay_new` timestamp NULL DEFAULT NULL,
  `_pay_edit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `_pay_del` timestamp NULL DEFAULT NULL,
  `_pay_arch` timestamp NULL DEFAULT NULL,
  `_pay_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `_pay_count` smallint(6) DEFAULT NULL,
  `_pay_cust_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_perm` (
  `_perm_id` int(11) NOT NULL,
  `_perm_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_perm_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_perm_del` timestamp(6) NULL DEFAULT NULL,
  `_perm_arch` timestamp(6) NULL DEFAULT NULL,
  `_perm_active` tinyint(1) DEFAULT 1,
  `_perm_protected` tinyint(1) NOT NULL DEFAULT 0,
  `_perm_role_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `_perm_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_perm_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_perm_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_perm` (`_perm_id`, `_perm_new`, `_perm_edit`, `_perm_del`, `_perm_arch`, `_perm_active`, `_perm_protected`, `_perm_role_type`, `_perm_name`, `_perm_path`, `_perm_desc`) VALUES
(1, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Authentication', '/_auth_token', 'All authentication actions'),
(2, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Beehive Excluded Objects', '/_meditation_exclude', 'All Beehive excluded object actions'),
(3, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Beehive Objects', '/_meditation_obj', 'All objects Beehive has under its control'),
(4, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Configuration', '/_config', 'All configuration actions'),
(5, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Countries', '/_country', 'All country actions'),
(6, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Documents', '/_doc', 'All document actions'),
(7, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Follows/Following', '/_follow', 'All permissions for following'),
(8, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Language', '/_lang', 'All language actions'),
(9, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Log', '/_log', 'All log actions'),
(10, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Users', '/_mem', 'All user actions'),
(11, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'User Authentication', '/_mem_auth', 'Users may log in and be authenticated'),
(12, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'User Preferences', '/_mem_pref', 'All user preference actions'),
(13, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'User Password Reset', '/_mem_reset', 'All password reset actions'),
(14, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Menu Items', '/_menu_item', 'All menu item actions'),
(15, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Modules', '/_module', 'All module actions'),
(16, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Module Users', '/_module_mem', 'All module user actions'),
(17, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Notes', '/_note', 'All note actions'),
(18, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Notifications', '/_notif', 'All notification actions'),
(19, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Notification Signals', '/_notif_signal', 'All notification signal actions'),
(20, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Permissions', '/_perm', 'All permission actions'),
(21, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Permission Menu Items', '/_perm_menu_item', 'All permission menu item actions'),
(22, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Pricing', '/_pricing', 'All pricing actions'),
(23, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Pricing Limits', '/_pricing_limit', 'All pricing limit actions'),
(24, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Pricing Modules', '/_pricing_module', 'All pricing module actions'),
(25, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Public Paths', '/_public_path', 'All public path actions'),
(26, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Reports', '/_report', 'All report actions'),
(27, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Report Libraries', '/_report_lib', 'All report library actions'),
(28, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Roles', '/_role', 'All role actions'),
(29, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Role Permissions', '/_role_perm', 'All role permission actions'),
(30, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Settings', '/_setting', 'All setting actions'),
(31, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Signals', '/_signal', 'All signal actions'),
(32, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Signal Users', '/_signal_mem', 'All signal user actions'),
(33, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'States/Provinces/Regions', '/_state', 'All state actions'),
(34, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Subscribers', '/_co', 'All subscriber actions'),
(35, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Subscribed Modules', '/_co_module', 'All subscribed module actions'),
(36, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Subscriber Preferences', '/_co_pref', 'All subscriber preference actions'),
(37, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Tags', '/_tag', 'All tag actions'),
(38, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Tasks', '/_task', 'All task actions'),
(39, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Language Tokens', '/_token', 'All language token actions'),
(40, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Token Translations', '/_token_xl8', 'All token translation actions'),
(41, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Timezones', '/_tz', 'All timezone actions'),
(42, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Valid Form Fields', '/_valid_field', 'All form field actions'),
(43, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Valid Forms', '/_valid_form', 'All valid form actions'),
(44, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Beehive Actions - All', '/_meditation', 'To manage all aspects of Beehive'),
(45, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Registration', '/_register', 'All registration actions'),
(46, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Module Permissions', '/_module_perm', 'All module permission actions'),
(47, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'User Addresses', '/_mem_addr', 'All user address actions'),
(48, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'User Phones', '/_mem_phone', 'All user phone actions'),
(49, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Calendar', '/_cal', 'All calendar actions'),
(50, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'External Calendars', '/_cal_ext', 'All external calendar actions'),
(51, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Calendar Followers', '/_cal_follow', 'All calendar follower actions'),
(52, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Calendar Items', '/_cal_item', 'All calendar item actions'),
(53, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Phone Types', '/_cat_phone', 'All phone type actions'),
(54, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Address Types', '/_cat_addr', 'All address type actions'),
(55, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Headquarters', '/_hq', 'All headquarter actions'),
(56, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, 'superadmin', 'Payment Actions', '/_pay', 'For all payment actions necessary for a checkout and subscription recurring billing'),
(57, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', 'Configuration Page', '/page/configuration', 'Allow users access to the configuration page'),
(58, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 1, '', 'List Members', '/_mem/list', 'To be able to list members in dropdowns and lists.'),
(59, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', 'Get all subscriber users', '/_co_mem/list', 'To be able to see all metered users for a subscriber in dropdowns and lists'),
(60, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', 'Role Permissions Page', '/page/role_perms', 'To be able to manage roles and permissions'),
(61, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', 'Fetch Subscriber User', '/_co_mem/fetch', NULL),
(62, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', 'Fetch Active Roles', '/_role/fetch', NULL),
(63, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', 'List all roles', '/_role/list', NULL),
(64, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', 'Save Subscriber Member', '/_co_mem/save', NULL),
(65, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', 'Roles & Permissions Configuration Page', '/page/_role_perm', NULL),
(66, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', 'Manage Organization Details', '/page/_coscriber', NULL),
(67, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', '/_cat_note', '/_cat_note', NULL),
(68, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', '/_co_mem', '/_co_mem', NULL),
(69, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', 'Note Category List', '/_cat_note/list', NULL),
(70, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', NULL, '/_cat_note/fetch', NULL),
(71, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', NULL, '/_cat_note/save', NULL),
(72, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', NULL, '/_cat_note/delete', NULL),
(73, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', NULL, '/page/billing', NULL),
(74, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', 'Managing Subscriber Preferences', '/_co_pref/pref', NULL),
(75, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', NULL, '/_co/save_email_footer', NULL),
(76, '2021-10-08 20:32:36.000000', '2021-10-08 20:32:36.000000', NULL, NULL, 1, 0, '', NULL, '/_note/get_by_obj', NULL),
(77, '2021-10-10 23:34:26.000000', '2021-10-10 23:34:26.000000', NULL, NULL, 1, 0, '', NULL, '/_page/_mem_reset', NULL),
(78, '2021-11-19 22:05:48.000000', '2021-11-19 22:05:48.000000', NULL, NULL, 1, 0, 'superadmin', 'All Pages', '/page', 'This gives the admin the right to see all pages.');

CREATE TABLE `_perm_menu_item` (
  `_perm_menu_item_id` int(11) NOT NULL,
  `_perm_menu_item_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_perm_menu_item_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_perm_menu_item_del` timestamp(6) NULL DEFAULT NULL,
  `_perm_menu_item_arch` timestamp(6) NULL DEFAULT NULL,
  `_perm_menu_item_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__perm_id` int(11) DEFAULT NULL,
  `fk__menu_item_id` int(11) DEFAULT NULL,
  `_perm_menu_item_disp_order` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_pricing` (
  `_pricing_id` int(11) NOT NULL,
  `_pricing_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_pricing_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_pricing_del` timestamp(6) NULL DEFAULT NULL,
  `_pricing_arch` timestamp(6) NULL DEFAULT NULL,
  `_pricing_active` tinyint(1) DEFAULT 1,
  `_pricing_default` tinyint(1) NOT NULL DEFAULT 0,
  `_pricing_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_pricing_desc` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `_pricing_price` decimal(20,2) DEFAULT NULL,
  `_pricing_display_order` smallint(6) DEFAULT NULL,
  `_pricing_pay_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Payment integration id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_pricing_limit` (
  `_pricing_limit_id` int(11) NOT NULL,
  `_pricing_limit_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_pricing_limit_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_pricing_limit_del` timestamp(6) NULL DEFAULT NULL,
  `_pricing_limit_arch` timestamp(6) NULL DEFAULT NULL,
  `_pricing_limit_active` tinyint(1) DEFAULT 1,
  `_pricing_limit_default` tinyint(1) DEFAULT 0,
  `fk__pricing_id` int(11) DEFAULT NULL,
  `fk__pricing_module_id` int(11) DEFAULT NULL,
  `_pricing_limit_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_pricing_limit_price` decimal(10,2) DEFAULT NULL,
  `_pricing_limit_free` smallint(6) DEFAULT NULL COMMENT 'The number of this usage that is free',
  `_pricing_limit_free_days` int(11) DEFAULT NULL,
  `_pricing_limit_min` int(11) DEFAULT NULL,
  `_pricing_limit_max` int(11) DEFAULT NULL,
  `_pricing_limit_unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_pricing_limit_unit_src` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The table or service that will check the meter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_pricing_module` (
  `_pricing_module_id` int(11) NOT NULL,
  `_pricing_module_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_pricing_module_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_pricing_module_del` timestamp(6) NULL DEFAULT NULL,
  `_pricing_module_arch` timestamp(6) NULL DEFAULT NULL,
  `_pricing_module_active` tinyint(1) DEFAULT 1,
  `fk__pricing_id` int(11) DEFAULT NULL,
  `fk__module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_public_path` (
  `_public_path_id` int(11) NOT NULL,
  `_public_path_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_public_path_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_public_path_del` timestamp(6) NULL DEFAULT NULL,
  `_public_path_arch` timestamp(6) NULL DEFAULT NULL,
  `_public_path_active` tinyint(1) DEFAULT 1,
  `_public_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_public_path` (`_public_path_id`, `_public_path_new`, `_public_path_edit`, `_public_path_del`, `_public_path_arch`, `_public_path_active`, `_public_path`) VALUES
(1, '2021-07-31 03:48:49.804572', '2021-07-31 03:48:49.804572', NULL, NULL, 1, '_auth/password'),
(2, '2021-09-16 01:52:48.326487', '2021-09-16 01:52:48.326487', NULL, NULL, 1, '_tpl'),
(3, '2021-09-16 01:52:50.905655', '2021-09-16 01:52:50.905655', NULL, NULL, 1, '_setting/get_base_settings'),
(4, '2021-09-16 01:52:53.719502', '2021-09-16 01:52:53.719502', NULL, NULL, 1, '_auth/logout'),
(5, '2021-09-16 01:53:14.656621', '2021-09-16 01:53:14.656621', NULL, NULL, 1, '_pricing'),
(6, '2021-09-16 01:53:17.822908', '2021-09-16 01:53:17.822908', NULL, NULL, 1, 'page/index'),
(7, '2021-09-16 14:51:58.000000', '2021-09-16 14:51:58.000000', NULL, NULL, 1, '_register/register_co'),
(8, '2021-09-21 15:50:39.715911', '2021-09-21 15:50:39.715911', NULL, NULL, 1, '_verify/email'),
(9, '2021-09-21 16:10:04.000000', '2021-09-21 16:10:04.000000', NULL, NULL, 1, 'page/_verify'),
(10, '2021-09-27 22:16:55.616683', '2021-09-27 22:16:55.616683', NULL, NULL, 1, 'page/password_reset'),
(11, '2021-09-28 16:10:52.000000', '2021-09-28 16:10:52.000000', NULL, NULL, 1, '_mem_reset/reset'),
(12, '2021-09-30 00:09:43.343747', '2021-09-30 00:09:43.343747', NULL, NULL, 1, '_valid_field/form_fields'),
(13, '2021-09-28 16:10:52.000000', '2021-09-28 16:10:52.000000', NULL, NULL, 1, 'page/_meditation')
;

CREATE TABLE `_report` (
  `_report_id` int(11) NOT NULL,
  `_report_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_report_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_report_del` timestamp(6) NULL DEFAULT NULL,
  `_report_arch` timestamp(6) NULL DEFAULT NULL,
  `_report_active` tinyint(1) DEFAULT 1,
  `_report_public` tinyint(1) DEFAULT NULL,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL COMMENT 'Report Author',
  `_report_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_report_filter_json` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `_report_out_json` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_report_lib` (
  `_report_lib_id` int(11) NOT NULL,
  `_report_lib_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_report_lib_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_report_lib_del` timestamp(6) NULL DEFAULT NULL,
  `_report_lib_arch` timestamp(6) NULL DEFAULT NULL,
  `_report_lib_active` tinyint(1) DEFAULT 1,
  `_report_lib_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_report_lib_filter_json` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `_report_lib_out_json` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_role` (
  `_role_id` int(11) NOT NULL,
  `_role_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_role_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_role_del` timestamp(6) NULL DEFAULT NULL,
  `_role_arch` timestamp(6) NULL DEFAULT NULL,
  `_role_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `_role_default` tinyint(1) DEFAULT 0,
  `_role_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_role_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_role_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Logical value of the role'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_role` (`_role_id`, `_role_new`, `_role_edit`, `_role_del`, `_role_arch`, `_role_active`, `fk__co_id`, `_role_default`, `_role_name`, `_role_desc`, `_role_type`) VALUES
(1, '2021-11-19 20:47:18.286851', '2021-11-19 20:47:18.286851', NULL, NULL, 1, 1, 1, 'Administrator', 'This is your default admin account. Do not make changes unless you are sure.', 'admin');

CREATE TABLE `_role_perm` (
  `_role_perm_id` int(11) NOT NULL,
  `_role_perm_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_role_perm_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_role_perm_del` timestamp(6) NULL DEFAULT NULL,
  `_role_perm_arch` timestamp(6) NULL DEFAULT NULL,
  `_role_perm_active` tinyint(1) DEFAULT 1,
  `fk__role_id` int(11) DEFAULT NULL,
  `fk__perm_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_role_perm` (`_role_perm_id`, `_role_perm_new`, `_role_perm_edit`, `_role_perm_del`, `_role_perm_arch`, `_role_perm_active`, `fk__role_id`, `fk__perm_id`) VALUES
(1, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 1),
(2, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 2),
(3, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 3),
(4, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 4),
(5, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 5),
(6, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 6),
(7, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 7),
(8, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 8),
(9, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 9),
(10, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 10),
(11, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 11),
(12, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 12),
(13, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 13),
(14, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 14),
(15, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 15),
(16, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 16),
(17, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 17),
(18, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 18),
(19, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 19),
(20, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 20),
(21, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 21),
(22, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 22),
(23, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 23),
(24, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 24),
(25, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 25),
(26, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 26),
(27, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 27),
(28, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 28),
(29, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 29),
(30, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 30),
(31, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 31),
(32, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 32),
(33, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 33),
(34, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 34),
(35, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 35),
(36, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 36),
(37, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 37),
(38, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 38),
(39, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 39),
(40, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 40),
(41, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 41),
(42, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 42),
(43, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 43),
(44, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 44),
(45, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 45),
(46, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 46),
(47, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 47),
(48, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 48),
(49, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 49),
(50, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 50),
(51, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 51),
(52, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 52),
(53, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 53),
(54, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 54),
(55, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 55),
(56, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 56),
(57, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 57),
(58, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 58),
(59, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 59),
(60, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 60),
(61, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 61),
(62, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 62),
(63, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 63),
(64, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 64),
(65, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 65),
(66, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 66),
(67, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 67),
(68, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 68),
(69, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 69),
(70, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 70),
(71, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 71),
(72, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 72),
(73, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 73),
(74, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 74),
(75, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 75),
(76, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 76),
(77, '2021-11-19 22:04:31.942970', '2021-11-19 22:04:31.942970', NULL, NULL, 1, 1, 77),
(78, '2021-11-19 22:06:22.855649', '2021-11-19 22:06:22.855649', NULL, NULL, 1, 1, 78);

CREATE TABLE `_setting` (
  `_setting_id` int(11) NOT NULL,
  `_setting_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_setting_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_setting_del` timestamp(6) NULL DEFAULT NULL,
  `_setting_arch` timestamp(6) NULL DEFAULT NULL,
  `_setting_active` tinyint(1) DEFAULT 1,
  `_setting_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_setting_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_setting` (`_setting_id`, `_setting_new`, `_setting_edit`, `_setting_del`, `_setting_arch`, `_setting_active`, `_setting_key`, `_setting_value`) VALUES
(1, '2021-09-14 02:24:23.998547', '2021-09-14 02:24:23.998547', NULL, NULL, 1, 'product_name', ''),
(2, '2021-08-13 23:21:20.201349', '2021-08-14 06:21:20.201155', NULL, NULL, 1, 'app_domain', ''),
(3, '2021-09-16 20:03:50.179030', '2021-09-16 20:03:50.179030', NULL, NULL, 1, 'postmark_api_key', ''),
(4, '2021-09-21 20:48:12.987730', '2021-09-21 20:48:12.987730', NULL, NULL, 1, 'system_from_email', ''),
(5, '2021-10-08 01:00:42.663296', '2021-10-08 01:00:42.663296', NULL, NULL, 1, 'storage_access_key', ''),
(6, '2021-10-08 01:00:35.519612', '2021-10-08 01:00:35.519612', NULL, NULL, 1, 'storage_private_key', ''),
(7, '2021-10-08 00:23:39.311472', '2021-10-08 00:23:39.311472', NULL, NULL, 1, 'storage_bucket', ''),
(8, '2021-09-16 22:26:53.634350', '2021-09-16 22:26:53.634350', NULL, NULL, 1, 'stripe_private_test_key', ''),
(9, '2021-07-31 08:05:35.000000', '2021-07-31 08:06:05.000000', NULL, NULL, 1, 'stripe_webhook_secret', NULL),
(10, '2021-08-13 23:21:42.752690', '2021-08-14 06:21:42.752593', NULL, NULL, 1, 'meta_desc', ''),
(11, '2021-07-31 19:48:41.645476', '2021-07-31 19:48:41.645476', NULL, NULL, 1, 'meta_author', ''),
(12, '2021-08-03 16:20:39.872723', '2021-08-03 16:20:39.872723', NULL, NULL, 1, 'copyright_banner', ''),
(13, '2021-09-16 22:27:02.010711', '2021-09-16 22:27:02.010711', NULL, NULL, 1, 'stripe_public_test_key', '');

CREATE TABLE `_signal` (
  `_signal_id` int(11) NOT NULL,
  `_signal_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_signal_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_signal_del` timestamp(6) NULL DEFAULT NULL,
  `_signal_arch` timestamp(6) NULL DEFAULT NULL,
  `_signal_active` tinyint(1) DEFAULT 1,
  `_signal_configurable` tinyint(1) DEFAULT 0,
  `_signal_channel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_signal_flag` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_signal_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_signal_mem` (
  `_signal_mem_id` int(11) NOT NULL,
  `_signal_mem_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_signal_mem_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_signal_mem_del` timestamp(6) NULL DEFAULT NULL,
  `_signal_mem_arch` timestamp(6) NULL DEFAULT NULL,
  `_signal_mem_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL,
  `fk__signal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_state` (
  `_state_id` int(11) NOT NULL,
  `_state_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_state_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_state_arch` timestamp(6) NULL DEFAULT NULL,
  `_state_del` timestamp(6) NULL DEFAULT NULL,
  `_state_active` tinyint(1) DEFAULT 1,
  `_state_name` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_state_abbrev` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk__country_id` int(11) DEFAULT NULL,
  `_state_display_order` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_state` (`_state_id`, `_state_new`, `_state_edit`, `_state_arch`, `_state_del`, `_state_active`, `_state_name`, `_state_abbrev`, `fk__country_id`, `_state_display_order`) VALUES
(1, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Alabama', 'AL', 231, 0),
(2, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Alaska', 'AK', 231, 0),
(3, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Arizona', 'AZ', 231, 0),
(4, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Arkansas', 'AR', 231, 0),
(5, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'California', 'CA', 231, 0),
(6, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Colorado', 'CO', 231, 0),
(7, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Connecticut', 'CT', 231, 0),
(8, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Delaware', 'DE', 231, 0),
(9, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Florida', 'FL', 231, 0),
(10, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Georgia', 'GA', 231, 0),
(11, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Hawaii', 'HI', 231, 0),
(12, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Idaho', 'ID', 231, 0),
(13, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Illinois', 'IL', 231, 0),
(14, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indiana', 'IN', 231, 0),
(15, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Iowa', 'IA', 231, 0),
(16, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Kansas', 'KS', 231, 0),
(17, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Kentucky', 'KY', 231, 0),
(18, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Louisiana', 'LA', 231, 0),
(19, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Maine', 'ME', 231, 0),
(20, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Maryland', 'MD', 231, 0),
(21, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Massachusetts', 'MA', 231, 0),
(22, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Michigan', 'MI', 231, 0),
(23, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Minnesota', 'MN', 231, 0),
(24, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Mississippi', 'MS', 231, 0),
(25, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Missouri', 'MO', 231, 0),
(26, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Montana', 'MT', 231, 0),
(27, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Nebraska', 'NE', 231, 0),
(28, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Nevada', 'NV', 231, 0),
(29, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'New Hampshire', 'NH', 231, 0),
(30, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'New Jersey', 'NJ', 231, 0),
(31, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'New Mexico', 'NM', 231, 0),
(32, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'New York', 'NY', 231, 0),
(33, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'North Carolina', 'NC', 231, 0),
(34, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'North Dakota', 'ND', 231, 0),
(35, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Ohio', 'OH', 231, 0),
(36, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Oklahoma', 'OK', 231, 0),
(37, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Oregon', 'OR', 231, 0),
(38, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pennsylvania', 'PA', 231, 0),
(39, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Rhode Island', 'RI', 231, 0),
(40, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'South Carolina', 'SC', 231, 0),
(41, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'South Dakota', 'SD', 231, 0),
(42, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Tennessee', 'TN', 231, 0),
(43, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Texas', 'TX', 231, 0),
(44, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Utah', 'UT', 231, 0),
(45, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Vermont', 'VT', 231, 0),
(46, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Virginia', 'VA', 231, 0),
(47, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Washington', 'WA', 231, 0),
(48, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'West Virginia', 'WV', 231, 0),
(49, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Wisconsin', 'WI', 231, 0),
(50, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Wyoming', 'WY', 231, 0),
(51, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'District of Columbia', 'DC', 231, 0);

CREATE TABLE `_co` (
  `_co_id` int(11) NOT NULL,
  `_co_new` timestamp(6) NULL DEFAULT NULL,
  `_co_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_co_del` timestamp(6) NULL DEFAULT NULL,
  `_co_arch` timestamp(6) NULL DEFAULT NULL,
  `_co_active` tinyint(1) DEFAULT 1,
  `fk__mem_id` int(11) DEFAULT NULL COMMENT 'The owner of the subscription',
  `fk__pricing_id` int(11) DEFAULT NULL,
  `_co_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_co_domain` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'This is the subdomain that is used to scope all calls',
  `_co_ulid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_co_setup` tinyint(1) DEFAULT 0,
  `_co_configured` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Short for subscriber';

INSERT INTO `_co` (`_co_id`, `_co_new`, `_co_edit`, `_co_del`, `_co_arch`, `_co_active`, `fk__mem_id`, `fk__pricing_id`, `_co_name`, `_co_domain`, `_co_ulid`, `_co_setup`, `_co_configured`) VALUES
(1, '2021-10-08 19:53:38.000000', '2021-10-08 19:53:38.000000', NULL, NULL, 1, 1, NULL, 'Default Install', 'setup', NULL, 1, 1);

CREATE TABLE `_co_mem` (
  `_co_mem_id` int(11) NOT NULL,
  `_co_mem_new` timestamp NULL DEFAULT NULL,
  `_co_mem_edit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `_co_mem_del` timestamp NULL DEFAULT NULL,
  `_co_mem_arch` timestamp NULL DEFAULT NULL,
  `_co_mem_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL,
  `fk__role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_co_mem` (`_co_mem_id`, `_co_mem_new`, `_co_mem_edit`, `_co_mem_del`, `_co_mem_arch`, `_co_mem_active`, `fk__co_id`, `fk__mem_id`, `fk__role_id`) VALUES
(1, '2021-11-14 20:17:30', '2021-11-19 20:47:06', NULL, NULL, 1, 1, 1, 1);

CREATE TABLE `_co_pref` (
  `_co_pref_id` int(11) NOT NULL,
  `_co_pref_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_co_pref_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_co_pref_del` timestamp(6) NULL DEFAULT NULL,
  `_co_pref_arch` timestamp(6) NULL DEFAULT NULL,
  `_co_pref_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `_co_pref_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_co_pref_val` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_tag` (
  `_tag_id` int(11) NOT NULL,
  `_tag_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_tag_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_tag_del` timestamp(6) NULL DEFAULT NULL,
  `_tag_arch` timestamp(6) NULL DEFAULT NULL,
  `_tag_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL,
  `_tag` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_tag_obj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_tag_obj_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_task` (
  `_task_id` int(11) NOT NULL,
  `_task_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_task_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_task_del` timestamp(6) NULL DEFAULT NULL,
  `_task_arch` timestamp(6) NULL DEFAULT NULL,
  `_task_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `fk__mem_id` int(11) DEFAULT NULL,
  `fk_task_completer_id` int(11) DEFAULT NULL,
  `fk_cat_task_id` int(11) DEFAULT NULL,
  `fk_program_id` int(11) DEFAULT NULL,
  `_task_due_date` date DEFAULT NULL,
  `_task_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_task_desc` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `_task_obj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_task_obj_id` int(11) DEFAULT NULL,
  `_task_required` tinyint(1) DEFAULT 0,
  `_task_completion_date` date DEFAULT NULL,
  `_task_status` tinytext COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '0 = No disposition, -1 = did not complete, 1 = did complete',
  `_task_private` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_token` (
  `_token_id` int(11) NOT NULL,
  `_token_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_token_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_token_del` timestamp(6) NULL DEFAULT NULL,
  `_token_arch` timestamp(6) NULL DEFAULT NULL,
  `_token_active` tinyint(1) DEFAULT 1,
  `_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_token_xl8` (
  `_token_xl8_id` int(11) NOT NULL,
  `_token_xl8_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_token_xl8_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_token_xl8_del` timestamp(6) NULL DEFAULT NULL,
  `_token_xl8_arch` timestamp(6) NULL DEFAULT NULL,
  `_token_xl8_active` tinyint(1) DEFAULT 1,
  `fk__token_id` int(11) DEFAULT NULL,
  `fk__lang_id` int(11) DEFAULT NULL,
  `_token_xl8` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_tz` (
  `_tz_id` int(11) NOT NULL,
  `_tz_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_tz_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_tz_del` timestamp(6) NULL DEFAULT NULL,
  `_tz_arch` timestamp(6) NULL DEFAULT NULL,
  `_tz_active` tinyint(1) DEFAULT 1,
  `_tz_region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_tz_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_tz_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `_tz` (`_tz_id`, `_tz_new`, `_tz_edit`, `_tz_del`, `_tz_arch`, `_tz_active`, `_tz_region`, `_tz_city`, `_tz_value`) VALUES
(1, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Abidjan', 'Africa/Abidjan'),
(2, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Accra', 'Africa/Accra'),
(3, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Addis_Ababa', 'Africa/Addis_Ababa'),
(4, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Algiers', 'Africa/Algiers'),
(5, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Asmara', 'Africa/Asmara'),
(6, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Bamako', 'Africa/Bamako'),
(7, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Bangui', 'Africa/Bangui'),
(8, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Banjul', 'Africa/Banjul'),
(9, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Bissau', 'Africa/Bissau'),
(10, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Blantyre', 'Africa/Blantyre'),
(11, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Brazzaville', 'Africa/Brazzaville'),
(12, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Bujumbura', 'Africa/Bujumbura'),
(13, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Cairo', 'Africa/Cairo'),
(14, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Casablanca', 'Africa/Casablanca'),
(15, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Ceuta', 'Africa/Ceuta'),
(16, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Conakry', 'Africa/Conakry'),
(17, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Dakar', 'Africa/Dakar'),
(18, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Dar_es_Salaam', 'Africa/Dar_es_Salaam'),
(19, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Djibouti', 'Africa/Djibouti'),
(20, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Douala', 'Africa/Douala'),
(21, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'El_Aaiun', 'Africa/El_Aaiun'),
(22, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Freetown', 'Africa/Freetown'),
(23, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Gaborone', 'Africa/Gaborone'),
(24, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Harare', 'Africa/Harare'),
(25, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Johannesburg', 'Africa/Johannesburg'),
(26, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Juba', 'Africa/Juba'),
(27, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Kampala', 'Africa/Kampala'),
(28, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Khartoum', 'Africa/Khartoum'),
(29, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Kigali', 'Africa/Kigali'),
(30, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Kinshasa', 'Africa/Kinshasa'),
(31, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Lagos', 'Africa/Lagos'),
(32, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Libreville', 'Africa/Libreville'),
(33, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Lome', 'Africa/Lome'),
(34, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Luanda', 'Africa/Luanda'),
(35, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Lubumbashi', 'Africa/Lubumbashi'),
(36, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Lusaka', 'Africa/Lusaka'),
(37, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Malabo', 'Africa/Malabo'),
(38, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Maputo', 'Africa/Maputo'),
(39, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Maseru', 'Africa/Maseru'),
(40, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Mbabane', 'Africa/Mbabane'),
(41, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Mogadishu', 'Africa/Mogadishu'),
(42, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Monrovia', 'Africa/Monrovia'),
(43, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Nairobi', 'Africa/Nairobi'),
(44, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Ndjamena', 'Africa/Ndjamena'),
(45, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Niamey', 'Africa/Niamey'),
(46, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Nouakchott', 'Africa/Nouakchott'),
(47, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Ouagadougou', 'Africa/Ouagadougou'),
(48, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'PortoNovo', 'Africa/PortoNovo'),
(49, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Sao_Tome', 'Africa/Sao_Tome'),
(50, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Tripoli', 'Africa/Tripoli'),
(51, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Tunis', 'Africa/Tunis'),
(52, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Africa', 'Windhoek', 'Africa/Windhoek'),
(53, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Adak', 'America/Adak'),
(54, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Anchorage', 'America/Anchorage'),
(55, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Anguilla', 'America/Anguilla'),
(56, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Antigua', 'America/Antigua'),
(57, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Araguaina', 'America/Araguaina'),
(58, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Argentina/Buenos_Aires', 'America/Argentina/Buenos_Aires'),
(59, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Argentina/Catamarca', 'America/Argentina/Catamarca'),
(60, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Argentina/Cordoba', 'America/Argentina/Cordoba'),
(61, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Argentina/Jujuy', 'America/Argentina/Jujuy'),
(62, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Argentina/La_Rioja', 'America/Argentina/La_Rioja'),
(63, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Argentina/Mendoza', 'America/Argentina/Mendoza'),
(64, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Argentina/Rio_Gallegos', 'America/Argentina/Rio_Gallegos'),
(65, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Argentina/Salta', 'America/Argentina/Salta'),
(66, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Argentina/San_Juan', 'America/Argentina/San_Juan'),
(67, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Argentina/San_Luis', 'America/Argentina/San_Luis'),
(68, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Argentina/Tucuman', 'America/Argentina/Tucuman'),
(69, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Argentina/Ushuaia', 'America/Argentina/Ushuaia'),
(70, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Aruba', 'America/Aruba'),
(71, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Asuncion', 'America/Asuncion'),
(72, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Atikokan', 'America/Atikokan'),
(73, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Bahia', 'America/Bahia'),
(74, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Bahia_Banderas', 'America/Bahia_Banderas'),
(75, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Barbados', 'America/Barbados'),
(76, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Belem', 'America/Belem'),
(77, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Belize', 'America/Belize'),
(78, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'BlancSablon', 'America/BlancSablon'),
(79, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Boa_Vista', 'America/Boa_Vista'),
(80, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Bogota', 'America/Bogota'),
(81, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Boise', 'America/Boise'),
(82, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Cambridge_Bay', 'America/Cambridge_Bay'),
(83, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Campo_Grande', 'America/Campo_Grande'),
(84, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Cancun', 'America/Cancun'),
(85, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Caracas', 'America/Caracas'),
(86, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Cayenne', 'America/Cayenne'),
(87, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Cayman', 'America/Cayman'),
(88, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Chicago', 'America/Chicago'),
(89, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Chihuahua', 'America/Chihuahua'),
(90, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Costa_Rica', 'America/Costa_Rica'),
(91, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Creston', 'America/Creston'),
(92, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Cuiaba', 'America/Cuiaba'),
(93, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Curacao', 'America/Curacao'),
(94, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Danmarkshavn', 'America/Danmarkshavn'),
(95, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Dawson', 'America/Dawson'),
(96, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Dawson_Creek', 'America/Dawson_Creek'),
(97, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Denver', 'America/Denver'),
(98, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Detroit', 'America/Detroit'),
(99, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Dominica', 'America/Dominica'),
(100, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Edmonton', 'America/Edmonton'),
(101, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Eirunepe', 'America/Eirunepe'),
(102, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'El_Salvador', 'America/El_Salvador'),
(103, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Fort_Nelson', 'America/Fort_Nelson'),
(104, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Fortaleza', 'America/Fortaleza'),
(105, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Glace_Bay', 'America/Glace_Bay'),
(106, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Godthab', 'America/Godthab'),
(107, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Goose_Bay', 'America/Goose_Bay'),
(108, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Grand_Turk', 'America/Grand_Turk'),
(109, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Grenada', 'America/Grenada'),
(110, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Guadeloupe', 'America/Guadeloupe'),
(111, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Guatemala', 'America/Guatemala'),
(112, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Guayaquil', 'America/Guayaquil'),
(113, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Guyana', 'America/Guyana'),
(114, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Halifax', 'America/Halifax'),
(115, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Havana', 'America/Havana'),
(116, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Hermosillo', 'America/Hermosillo'),
(117, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Indiana/Indianapolis', 'America/Indiana/Indianapolis'),
(118, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Indiana/Knox', 'America/Indiana/Knox'),
(119, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Indiana/Marengo', 'America/Indiana/Marengo'),
(120, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Indiana/Petersburg', 'America/Indiana/Petersburg'),
(121, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Indiana/Tell_City', 'America/Indiana/Tell_City'),
(122, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Indiana/Vevay', 'America/Indiana/Vevay'),
(123, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Indiana/Vincennes', 'America/Indiana/Vincennes'),
(124, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Indiana/Winamac', 'America/Indiana/Winamac'),
(125, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Inuvik', 'America/Inuvik'),
(126, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Iqaluit', 'America/Iqaluit'),
(127, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Jamaica', 'America/Jamaica'),
(128, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Juneau', 'America/Juneau'),
(129, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Kentucky/Louisville', 'America/Kentucky/Louisville'),
(130, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Kentucky/Monticello', 'America/Kentucky/Monticello'),
(131, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Kralendijk', 'America/Kralendijk'),
(132, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'La_Paz', 'America/La_Paz'),
(133, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Lima', 'America/Lima'),
(134, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Los_Angeles', 'America/Los_Angeles'),
(135, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Lower_Princes', 'America/Lower_Princes'),
(136, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Maceio', 'America/Maceio'),
(137, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Managua', 'America/Managua'),
(138, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Manaus', 'America/Manaus'),
(139, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Marigot', 'America/Marigot'),
(140, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Martinique', 'America/Martinique'),
(141, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Matamoros', 'America/Matamoros'),
(142, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Mazatlan', 'America/Mazatlan'),
(143, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Menominee', 'America/Menominee'),
(144, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Merida', 'America/Merida'),
(145, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Metlakatla', 'America/Metlakatla'),
(146, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Mexico_City', 'America/Mexico_City'),
(147, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Miquelon', 'America/Miquelon'),
(148, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Moncton', 'America/Moncton'),
(149, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Monterrey', 'America/Monterrey'),
(150, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Montevideo', 'America/Montevideo'),
(151, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Montserrat', 'America/Montserrat'),
(152, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Nassau', 'America/Nassau'),
(153, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'New_York', 'America/New_York'),
(154, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Nipigon', 'America/Nipigon'),
(155, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Nome', 'America/Nome'),
(156, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Noronha', 'America/Noronha'),
(157, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'North_Dakota/Beulah', 'America/North_Dakota/Beulah'),
(158, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'North_Dakota/Center', 'America/North_Dakota/Center'),
(159, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'North_Dakota/New_Salem', 'America/North_Dakota/New_Salem'),
(160, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Ojinaga', 'America/Ojinaga'),
(161, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Panama', 'America/Panama'),
(162, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Pangnirtung', 'America/Pangnirtung'),
(163, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Paramaribo', 'America/Paramaribo'),
(164, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Phoenix', 'America/Phoenix'),
(165, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'PortauPrince', 'America/PortauPrince'),
(166, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Port_of_Spain', 'America/Port_of_Spain'),
(167, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Porto_Velho', 'America/Porto_Velho'),
(168, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Puerto_Rico', 'America/Puerto_Rico'),
(169, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Punta_Arenas', 'America/Punta_Arenas'),
(170, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Rainy_River', 'America/Rainy_River'),
(171, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Rankin_Inlet', 'America/Rankin_Inlet'),
(172, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Recife', 'America/Recife'),
(173, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Regina', 'America/Regina'),
(174, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Resolute', 'America/Resolute'),
(175, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Rio_Branco', 'America/Rio_Branco'),
(176, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Santarem', 'America/Santarem'),
(177, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Santiago', 'America/Santiago'),
(178, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Santo_Domingo', 'America/Santo_Domingo'),
(179, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Sao_Paulo', 'America/Sao_Paulo'),
(180, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Scoresbysund', 'America/Scoresbysund'),
(181, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Sitka', 'America/Sitka'),
(182, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'St_Barthelemy', 'America/St_Barthelemy'),
(183, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'St_Johns', 'America/St_Johns'),
(184, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'St_Kitts', 'America/St_Kitts'),
(185, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'St_Lucia', 'America/St_Lucia'),
(186, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'St_Thomas', 'America/St_Thomas'),
(187, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'St_Vincent', 'America/St_Vincent'),
(188, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Swift_Current', 'America/Swift_Current'),
(189, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Tegucigalpa', 'America/Tegucigalpa'),
(190, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Thule', 'America/Thule'),
(191, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Thunder_Bay', 'America/Thunder_Bay'),
(192, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Tijuana', 'America/Tijuana'),
(193, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Toronto', 'America/Toronto'),
(194, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Tortola', 'America/Tortola'),
(195, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Vancouver', 'America/Vancouver'),
(196, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Whitehorse', 'America/Whitehorse'),
(197, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Winnipeg', 'America/Winnipeg'),
(198, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Yakutat', 'America/Yakutat'),
(199, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'America', 'Yellowknife', 'America/Yellowknife'),
(200, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antarctica', 'Casey', 'Antarctica/Casey'),
(201, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antarctica', 'Davis', 'Antarctica/Davis'),
(202, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antarctica', 'DumontDUrville', 'Antarctica/DumontDUrville'),
(203, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antarctica', 'Macquarie', 'Antarctica/Macquarie'),
(204, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antarctica', 'Mawson', 'Antarctica/Mawson'),
(205, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antarctica', 'McMurdo', 'Antarctica/McMurdo'),
(206, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antarctica', 'Palmer', 'Antarctica/Palmer'),
(207, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antarctica', 'Rothera', 'Antarctica/Rothera'),
(208, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antarctica', 'Syowa', 'Antarctica/Syowa'),
(209, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antarctica', 'Troll', 'Antarctica/Troll'),
(210, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Antarctica', 'Vostok', 'Antarctica/Vostok'),
(211, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Arctic', 'Longyearbyen', 'Arctic/Longyearbyen'),
(212, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Aden', 'Asia/Aden'),
(213, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Almaty', 'Asia/Almaty'),
(214, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Amman', 'Asia/Amman'),
(215, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Anadyr', 'Asia/Anadyr'),
(216, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Aqtau', 'Asia/Aqtau'),
(217, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Aqtobe', 'Asia/Aqtobe'),
(218, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Ashgabat', 'Asia/Ashgabat'),
(219, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Atyrau', 'Asia/Atyrau'),
(220, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Baghdad', 'Asia/Baghdad'),
(221, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Bahrain', 'Asia/Bahrain'),
(222, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Baku', 'Asia/Baku'),
(223, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Bangkok', 'Asia/Bangkok'),
(224, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Barnaul', 'Asia/Barnaul'),
(225, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Beirut', 'Asia/Beirut'),
(226, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Bishkek', 'Asia/Bishkek'),
(227, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Brunei', 'Asia/Brunei'),
(228, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Chita', 'Asia/Chita'),
(229, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Choibalsan', 'Asia/Choibalsan'),
(230, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Colombo', 'Asia/Colombo'),
(231, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Damascus', 'Asia/Damascus'),
(232, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Dhaka', 'Asia/Dhaka'),
(233, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Dili', 'Asia/Dili'),
(234, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Dubai', 'Asia/Dubai'),
(235, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Dushanbe', 'Asia/Dushanbe'),
(236, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Famagusta', 'Asia/Famagusta'),
(237, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Gaza', 'Asia/Gaza'),
(238, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Hebron', 'Asia/Hebron'),
(239, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Ho_Chi_Minh', 'Asia/Ho_Chi_Minh'),
(240, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Hong_Kong', 'Asia/Hong_Kong'),
(241, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Hovd', 'Asia/Hovd'),
(242, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Irkutsk', 'Asia/Irkutsk'),
(243, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Jakarta', 'Asia/Jakarta'),
(244, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Jayapura', 'Asia/Jayapura'),
(245, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Jerusalem', 'Asia/Jerusalem'),
(246, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Kabul', 'Asia/Kabul'),
(247, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Kamchatka', 'Asia/Kamchatka'),
(248, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Karachi', 'Asia/Karachi'),
(249, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Kathmandu', 'Asia/Kathmandu'),
(250, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Khandyga', 'Asia/Khandyga'),
(251, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Kolkata', 'Asia/Kolkata'),
(252, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Krasnoyarsk', 'Asia/Krasnoyarsk'),
(253, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Kuala_Lumpur', 'Asia/Kuala_Lumpur'),
(254, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Kuching', 'Asia/Kuching'),
(255, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Kuwait', 'Asia/Kuwait'),
(256, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Macau', 'Asia/Macau'),
(257, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Magadan', 'Asia/Magadan'),
(258, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Makassar', 'Asia/Makassar'),
(259, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Manila', 'Asia/Manila'),
(260, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Muscat', 'Asia/Muscat'),
(261, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Nicosia', 'Asia/Nicosia'),
(262, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Novokuznetsk', 'Asia/Novokuznetsk'),
(263, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Novosibirsk', 'Asia/Novosibirsk'),
(264, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Omsk', 'Asia/Omsk'),
(265, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Oral', 'Asia/Oral'),
(266, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Phnom_Penh', 'Asia/Phnom_Penh'),
(267, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Pontianak', 'Asia/Pontianak'),
(268, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Pyongyang', 'Asia/Pyongyang'),
(269, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Qatar', 'Asia/Qatar'),
(270, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Qostanay', 'Asia/Qostanay'),
(271, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Qyzylorda', 'Asia/Qyzylorda'),
(272, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Riyadh', 'Asia/Riyadh'),
(273, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Sakhalin', 'Asia/Sakhalin'),
(274, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Samarkand', 'Asia/Samarkand'),
(275, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Seoul', 'Asia/Seoul'),
(276, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Shanghai', 'Asia/Shanghai'),
(277, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Singapore', 'Asia/Singapore'),
(278, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Srednekolymsk', 'Asia/Srednekolymsk'),
(279, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Taipei', 'Asia/Taipei'),
(280, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Tashkent', 'Asia/Tashkent'),
(281, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Tbilisi', 'Asia/Tbilisi'),
(282, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Tehran', 'Asia/Tehran'),
(283, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Thimphu', 'Asia/Thimphu'),
(284, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Tokyo', 'Asia/Tokyo'),
(285, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Tomsk', 'Asia/Tomsk'),
(286, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Ulaanbaatar', 'Asia/Ulaanbaatar'),
(287, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Urumqi', 'Asia/Urumqi'),
(288, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'UstNera', 'Asia/UstNera'),
(289, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Vientiane', 'Asia/Vientiane'),
(290, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Vladivostok', 'Asia/Vladivostok'),
(291, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Yakutsk', 'Asia/Yakutsk'),
(292, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Yangon', 'Asia/Yangon'),
(293, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Yekaterinburg', 'Asia/Yekaterinburg'),
(294, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Asia', 'Yerevan', 'Asia/Yerevan'),
(295, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Atlantic', 'Azores', 'Atlantic/Azores'),
(296, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Atlantic', 'Bermuda', 'Atlantic/Bermuda'),
(297, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Atlantic', 'Canary', 'Atlantic/Canary'),
(298, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Atlantic', 'Cape_Verde', 'Atlantic/Cape_Verde'),
(299, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Atlantic', 'Faroe', 'Atlantic/Faroe'),
(300, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Atlantic', 'Madeira', 'Atlantic/Madeira'),
(301, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Atlantic', 'Reykjavik', 'Atlantic/Reykjavik'),
(302, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Atlantic', 'South_Georgia', 'Atlantic/South_Georgia'),
(303, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Atlantic', 'St_Helena', 'Atlantic/St_Helena'),
(304, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Atlantic', 'Stanley', 'Atlantic/Stanley'),
(305, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'Adelaide', 'Australia/Adelaide'),
(306, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'Brisbane', 'Australia/Brisbane'),
(307, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'Broken_Hill', 'Australia/Broken_Hill'),
(308, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'Currie', 'Australia/Currie'),
(309, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'Darwin', 'Australia/Darwin'),
(310, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'Eucla', 'Australia/Eucla'),
(311, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'Hobart', 'Australia/Hobart'),
(312, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'Lindeman', 'Australia/Lindeman'),
(313, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'Lord_Howe', 'Australia/Lord_Howe'),
(314, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'Melbourne', 'Australia/Melbourne'),
(315, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'Perth', 'Australia/Perth'),
(316, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Australia', 'Sydney', 'Australia/Sydney'),
(317, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Amsterdam', 'Europe/Amsterdam'),
(318, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Andorra', 'Europe/Andorra'),
(319, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Astrakhan', 'Europe/Astrakhan'),
(320, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Athens', 'Europe/Athens'),
(321, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Belgrade', 'Europe/Belgrade'),
(322, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Berlin', 'Europe/Berlin'),
(323, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Bratislava', 'Europe/Bratislava'),
(324, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Brussels', 'Europe/Brussels'),
(325, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Bucharest', 'Europe/Bucharest'),
(326, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Budapest', 'Europe/Budapest'),
(327, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Busingen', 'Europe/Busingen'),
(328, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Chisinau', 'Europe/Chisinau'),
(329, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Copenhagen', 'Europe/Copenhagen'),
(330, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Dublin', 'Europe/Dublin'),
(331, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Gibraltar', 'Europe/Gibraltar'),
(332, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Guernsey', 'Europe/Guernsey'),
(333, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Helsinki', 'Europe/Helsinki'),
(334, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Isle_of_Man', 'Europe/Isle_of_Man'),
(335, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Istanbul', 'Europe/Istanbul'),
(336, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Jersey', 'Europe/Jersey'),
(337, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Kaliningrad', 'Europe/Kaliningrad'),
(338, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Kiev', 'Europe/Kiev'),
(339, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Kirov', 'Europe/Kirov'),
(340, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Lisbon', 'Europe/Lisbon'),
(341, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Ljubljana', 'Europe/Ljubljana'),
(342, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'London', 'Europe/London'),
(343, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Luxembourg', 'Europe/Luxembourg'),
(344, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Madrid', 'Europe/Madrid'),
(345, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Malta', 'Europe/Malta'),
(346, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Mariehamn', 'Europe/Mariehamn'),
(347, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Minsk', 'Europe/Minsk'),
(348, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Monaco', 'Europe/Monaco'),
(349, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Moscow', 'Europe/Moscow'),
(350, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Oslo', 'Europe/Oslo'),
(351, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Paris', 'Europe/Paris'),
(352, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Podgorica', 'Europe/Podgorica'),
(353, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Prague', 'Europe/Prague'),
(354, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Riga', 'Europe/Riga'),
(355, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Rome', 'Europe/Rome'),
(356, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Samara', 'Europe/Samara'),
(357, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'San_Marino', 'Europe/San_Marino'),
(358, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Sarajevo', 'Europe/Sarajevo'),
(359, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Saratov', 'Europe/Saratov'),
(360, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Simferopol', 'Europe/Simferopol'),
(361, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Skopje', 'Europe/Skopje'),
(362, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Sofia', 'Europe/Sofia'),
(363, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Stockholm', 'Europe/Stockholm'),
(364, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Tallinn', 'Europe/Tallinn'),
(365, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Tirane', 'Europe/Tirane'),
(366, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Ulyanovsk', 'Europe/Ulyanovsk'),
(367, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Uzhgorod', 'Europe/Uzhgorod'),
(368, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Vaduz', 'Europe/Vaduz'),
(369, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Vatican', 'Europe/Vatican'),
(370, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Vienna', 'Europe/Vienna'),
(371, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Vilnius', 'Europe/Vilnius'),
(372, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Volgograd', 'Europe/Volgograd'),
(373, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Warsaw', 'Europe/Warsaw'),
(374, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Zagreb', 'Europe/Zagreb'),
(375, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Zaporozhye', 'Europe/Zaporozhye'),
(376, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Europe', 'Zurich', 'Europe/Zurich'),
(377, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indian', 'Antananarivo', 'Indian/Antananarivo'),
(378, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indian', 'Chagos', 'Indian/Chagos'),
(379, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indian', 'Christmas', 'Indian/Christmas'),
(380, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indian', 'Cocos', 'Indian/Cocos'),
(381, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indian', 'Comoro', 'Indian/Comoro'),
(382, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indian', 'Kerguelen', 'Indian/Kerguelen'),
(383, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indian', 'Mahe', 'Indian/Mahe'),
(384, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indian', 'Maldives', 'Indian/Maldives'),
(385, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indian', 'Mauritius', 'Indian/Mauritius'),
(386, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indian', 'Mayotte', 'Indian/Mayotte'),
(387, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Indian', 'Reunion', 'Indian/Reunion'),
(388, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Apia', 'Pacific/Apia'),
(389, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Auckland', 'Pacific/Auckland'),
(390, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Bougainville', 'Pacific/Bougainville'),
(391, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Chatham', 'Pacific/Chatham'),
(392, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Chuuk', 'Pacific/Chuuk'),
(393, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Easter', 'Pacific/Easter'),
(394, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Efate', 'Pacific/Efate'),
(395, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Enderbury', 'Pacific/Enderbury'),
(396, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Fakaofo', 'Pacific/Fakaofo'),
(397, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Fiji', 'Pacific/Fiji'),
(398, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Funafuti', 'Pacific/Funafuti'),
(399, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Galapagos', 'Pacific/Galapagos'),
(400, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Gambier', 'Pacific/Gambier'),
(401, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Guadalcanal', 'Pacific/Guadalcanal'),
(402, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Guam', 'Pacific/Guam'),
(403, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Honolulu', 'Pacific/Honolulu'),
(404, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Kiritimati', 'Pacific/Kiritimati'),
(405, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Kosrae', 'Pacific/Kosrae'),
(406, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Kwajalein', 'Pacific/Kwajalein'),
(407, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Majuro', 'Pacific/Majuro'),
(408, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Marquesas', 'Pacific/Marquesas'),
(409, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Midway', 'Pacific/Midway');
INSERT INTO `_tz` (`_tz_id`, `_tz_new`, `_tz_edit`, `_tz_del`, `_tz_arch`, `_tz_active`, `_tz_region`, `_tz_city`, `_tz_value`) VALUES
(410, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Nauru', 'Pacific/Nauru'),
(411, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Niue', 'Pacific/Niue'),
(412, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Norfolk', 'Pacific/Norfolk'),
(413, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Noumea', 'Pacific/Noumea'),
(414, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Pago_Pago', 'Pacific/Pago_Pago'),
(415, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Palau', 'Pacific/Palau'),
(416, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Pitcairn', 'Pacific/Pitcairn'),
(417, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Pohnpei', 'Pacific/Pohnpei'),
(418, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Port_Moresby', 'Pacific/Port_Moresby'),
(419, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Rarotonga', 'Pacific/Rarotonga'),
(420, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Saipan', 'Pacific/Saipan'),
(421, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Tahiti', 'Pacific/Tahiti'),
(422, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Tarawa', 'Pacific/Tarawa'),
(423, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Tongatapu', 'Pacific/Tongatapu'),
(424, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Wake', 'Pacific/Wake'),
(425, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'Pacific', 'Wallis', 'Pacific/Wallis'),
(426, '2021-07-31 03:05:35.000000', '2021-07-31 03:06:05.000000', NULL, NULL, 1, 'UTC', 'GMT', 'UTC/GMT');

CREATE TABLE `_valid_field` (
  `_valid_field_id` int(11) NOT NULL,
  `_valid_field_new` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_valid_field_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_valid_field_del` timestamp(6) NULL DEFAULT NULL,
  `_valid_field_arch` timestamp(6) NULL DEFAULT NULL,
  `_valid_field_active` tinyint(1) DEFAULT 1,
  `fk__valid_form_id` int(11) DEFAULT NULL,
  `_valid_field_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_valid_field_input_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_valid_field_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'input type="[]"',
  `_valid_field_required` tinyint(1) DEFAULT 0,
  `_valid_field_src` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_valid_field_mask` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_valid_field_default_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_valid_field_min` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_valid_field_max` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_valid_field_format` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk__valid_field_id` int(11) DEFAULT NULL COMMENT 'This validation rule only if this field exists and has the valid_field_if_value',
  `_valid_field_if_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `_valid_form` (
  `_valid_form_id` int(11) NOT NULL,
  `_valid_form_new` timestamp(6) NULL DEFAULT NULL,
  `_valid_form_edit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `_valid_form_del` timestamp(6) NULL DEFAULT NULL,
  `_valid_form_arch` timestamp(6) NULL DEFAULT NULL,
  `_valid_form_active` tinyint(1) DEFAULT 1,
  `_valid_form_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_valid_form_input_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_valid_form_table` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_valid_form_action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `_auth_token`
  ADD PRIMARY KEY (`_auth_token_id`);

ALTER TABLE `_meditation_exclude`
  ADD PRIMARY KEY (`_meditation_exclude_id`);

ALTER TABLE `_meditation_obj`
  ADD PRIMARY KEY (`_meditation_obj_id`);

ALTER TABLE `_cal`
  ADD PRIMARY KEY (`_cal_id`);

ALTER TABLE `_cal_ext`
  ADD PRIMARY KEY (`_cal_ext_id`);

ALTER TABLE `_cal_follow`
  ADD PRIMARY KEY (`_cal_follow_id`);

ALTER TABLE `_cal_item`
  ADD PRIMARY KEY (`_cal_item_id`);

ALTER TABLE `_cat_addr`
  ADD PRIMARY KEY (`_cat_addr_id`);

ALTER TABLE `_cat_note`
  ADD PRIMARY KEY (`_cat_note_id`);

ALTER TABLE `_cat_phone`
  ADD PRIMARY KEY (`_cat_phone_id`);

ALTER TABLE `_config`
  ADD PRIMARY KEY (`_config_id`);

ALTER TABLE `_country`
  ADD PRIMARY KEY (`_country_id`),
  ADD KEY `_country_abbrev` (`_country_abbrev`),
  ADD KEY `_country_name` (`_country_name`) USING BTREE;

ALTER TABLE `_doc`
  ADD PRIMARY KEY (`_doc_id`);

ALTER TABLE `_follow`
  ADD PRIMARY KEY (`_follow_id`),
  ADD KEY `_follow_obj` (`_follow_obj`),
  ADD KEY `_follow_obj_id` (`_follow_obj_id`);

ALTER TABLE `_lang`
  ADD PRIMARY KEY (`_lang_id`);

ALTER TABLE `_log`
  ADD PRIMARY KEY (`_log_id`);

ALTER TABLE `_mem`
  ADD PRIMARY KEY (`_mem_id`);

ALTER TABLE `_mem_addr`
  ADD PRIMARY KEY (`_mem_addr_id`);

ALTER TABLE `_mem_auth`
  ADD PRIMARY KEY (`_mem_auth_id`);

ALTER TABLE `_mem_phone`
  ADD PRIMARY KEY (`_mem_phone_id`);

ALTER TABLE `_mem_pref`
  ADD PRIMARY KEY (`_mem_pref_id`);

ALTER TABLE `_mem_reset`
  ADD PRIMARY KEY (`_mem_reset_id`);

ALTER TABLE `_menu_item`
  ADD PRIMARY KEY (`_menu_item_id`);

ALTER TABLE `_module`
  ADD PRIMARY KEY (`_module_id`);

ALTER TABLE `_module_perm`
  ADD PRIMARY KEY (`_module_perm_id`);

ALTER TABLE `_note`
  ADD PRIMARY KEY (`_note_id`);

ALTER TABLE `_notif`
  ADD PRIMARY KEY (`_notif_id`);

ALTER TABLE `_notif_signal`
  ADD PRIMARY KEY (`_notif_signal_id`);

ALTER TABLE `_pay`
  ADD PRIMARY KEY (`_pay_id`);

ALTER TABLE `_perm`
  ADD PRIMARY KEY (`_perm_id`);

ALTER TABLE `_perm_menu_item`
  ADD PRIMARY KEY (`_perm_menu_item_id`);

ALTER TABLE `_pricing`
  ADD PRIMARY KEY (`_pricing_id`);

ALTER TABLE `_pricing_limit`
  ADD PRIMARY KEY (`_pricing_limit_id`);

ALTER TABLE `_pricing_module`
  ADD PRIMARY KEY (`_pricing_module_id`);

ALTER TABLE `_public_path`
  ADD PRIMARY KEY (`_public_path_id`);

ALTER TABLE `_report`
  ADD PRIMARY KEY (`_report_id`);

ALTER TABLE `_report_lib`
  ADD PRIMARY KEY (`_report_lib_id`);

ALTER TABLE `_role`
  ADD PRIMARY KEY (`_role_id`);

ALTER TABLE `_role_perm`
  ADD PRIMARY KEY (`_role_perm_id`);

ALTER TABLE `_setting`
  ADD PRIMARY KEY (`_setting_id`);

ALTER TABLE `_signal`
  ADD PRIMARY KEY (`_signal_id`);

ALTER TABLE `_signal_mem`
  ADD PRIMARY KEY (`_signal_mem_id`);

ALTER TABLE `_state`
  ADD PRIMARY KEY (`_state_id`);

ALTER TABLE `_co`
  ADD PRIMARY KEY (`_co_id`),
  ADD UNIQUE KEY `_co_domain` (`_co_domain`);

ALTER TABLE `_co_mem`
  ADD PRIMARY KEY (`_co_mem_id`);

ALTER TABLE `_co_pref`
  ADD PRIMARY KEY (`_co_pref_id`);

ALTER TABLE `_tag`
  ADD PRIMARY KEY (`_tag_id`);

ALTER TABLE `_task`
  ADD PRIMARY KEY (`_task_id`);

ALTER TABLE `_token`
  ADD PRIMARY KEY (`_token_id`),
  ADD KEY `token` (`_token`);

ALTER TABLE `_token_xl8`
  ADD PRIMARY KEY (`_token_xl8_id`),
  ADD KEY `fk_token_id` (`fk__token_id`),
  ADD KEY `fk_lang_id` (`fk__lang_id`);

ALTER TABLE `_tz`
  ADD PRIMARY KEY (`_tz_id`);

ALTER TABLE `_valid_field`
  ADD PRIMARY KEY (`_valid_field_id`),
  ADD KEY `fk__valid_form_id` (`fk__valid_form_id`),
  ADD KEY `fk__valid_field_id` (`fk__valid_field_id`);

ALTER TABLE `_valid_form`
  ADD PRIMARY KEY (`_valid_form_id`),
  ADD KEY `_valid_form_input_id` (`_valid_form_input_id`);


ALTER TABLE `_auth_token`
  MODIFY `_auth_token_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_meditation_exclude`
  MODIFY `_meditation_exclude_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_meditation_obj`
  MODIFY `_meditation_obj_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_cal`
  MODIFY `_cal_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_cal_ext`
  MODIFY `_cal_ext_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_cal_follow`
  MODIFY `_cal_follow_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_cal_item`
  MODIFY `_cal_item_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_cat_addr`
  MODIFY `_cat_addr_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_cat_note`
  MODIFY `_cat_note_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_cat_phone`
  MODIFY `_cat_phone_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_config`
  MODIFY `_config_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_country`
  MODIFY `_country_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_doc`
  MODIFY `_doc_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_follow`
  MODIFY `_follow_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_lang`
  MODIFY `_lang_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_log`
  MODIFY `_log_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_mem`
  MODIFY `_mem_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_mem_addr`
  MODIFY `_mem_addr_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_mem_auth`
  MODIFY `_mem_auth_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_mem_phone`
  MODIFY `_mem_phone_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_mem_pref`
  MODIFY `_mem_pref_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_mem_reset`
  MODIFY `_mem_reset_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_menu_item`
  MODIFY `_menu_item_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_module`
  MODIFY `_module_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_module_perm`
  MODIFY `_module_perm_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_note`
  MODIFY `_note_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_notif`
  MODIFY `_notif_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_notif_signal`
  MODIFY `_notif_signal_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_pay`
  MODIFY `_pay_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_perm`
  MODIFY `_perm_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_perm_menu_item`
  MODIFY `_perm_menu_item_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_pricing`
  MODIFY `_pricing_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_pricing_limit`
  MODIFY `_pricing_limit_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_pricing_module`
  MODIFY `_pricing_module_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_public_path`
  MODIFY `_public_path_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_report`
  MODIFY `_report_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_report_lib`
  MODIFY `_report_lib_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_role`
  MODIFY `_role_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_role_perm`
  MODIFY `_role_perm_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_setting`
  MODIFY `_setting_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_signal`
  MODIFY `_signal_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_signal_mem`
  MODIFY `_signal_mem_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_state`
  MODIFY `_state_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_co`
  MODIFY `_co_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_co_mem`
  MODIFY `_co_mem_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_co_pref`
  MODIFY `_co_pref_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_tag`
  MODIFY `_tag_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_task`
  MODIFY `_task_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_token`
  MODIFY `_token_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_token_xl8`
  MODIFY `_token_xl8_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_tz`
  MODIFY `_tz_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_valid_field`
  MODIFY `_valid_field_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `_valid_form`
  MODIFY `_valid_form_id` int(11) NOT NULL AUTO_INCREMENT;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
