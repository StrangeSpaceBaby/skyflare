CREATE TABLE `~~table~~` (
  `~~table~~_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `~~table~~_new` timestamp NULL DEFAULT NULL,
  `~~table~~_edit` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `~~table~~_del` timestamp NULL DEFAULT NULL,
  `~~table~~_arch` timestamp NULL DEFAULT NULL,
  `~~table~~_active` tinyint(1) DEFAULT 1,
  `fk__co_id` int(11) DEFAULT NULL,
  `~~table~~_ulid` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_nopad_ci;
