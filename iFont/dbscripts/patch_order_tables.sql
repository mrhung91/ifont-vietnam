CREATE TABLE `if_shop_order` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `code` varchar(6) NOT NULL,
     `state` tinyint(2) NOT NULL,
     `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
     `created_by` int(11) NOT NULL,
     `modified` datetime DEFAULT '0000-00-00 00:00:00',
     `modified_by` int(11) DEFAULT NULL,
     PRIMARY KEY (`id`),
     KEY `FK_ifso_user_created_by` (`created_by`),
     KEY `FK_ifso_user_modified_by` (`modified_by`),
     CONSTRAINT `FK_ifso_user_created_by` FOREIGN KEY (`created_by`) REFERENCES `if_users` (`id`),
     CONSTRAINT `FK_ifso_user_modified_by` FOREIGN KEY (`modified_by`) REFERENCES `if_users` (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

CREATE TABLE `if_shop_order_history` (
     `id` int(10) NOT NULL AUTO_INCREMENT,
     `order_id` int(10) NOT NULL,
     `status` int(2) NOT NULL DEFAULT '0',
     `comment` varchar(1024) NOT NULL DEFAULT '',
     `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
     `created_by` int(10) NOT NULL,
     PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `if_shop_order_item` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL,
  `font_id` int(10) DEFAULT NULL,
  `package_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sod_so_order_id` (`order_id`),
  KEY `FK_soi_sp_package_id` (`package_id`),
  KEY `FK_if_sod_sf_font_id` (`font_id`),
  CONSTRAINT `FK_sod_so_order_id` FOREIGN KEY (`order_id`) REFERENCES `if_shop_order` (`id`),
  CONSTRAINT `FK_if_sod_sf_font_id` FOREIGN KEY (`font_id`) REFERENCES `if_shop_font` (`font_id`),
  CONSTRAINT `FK_soi_sp_package_id` FOREIGN KEY (`package_id`) REFERENCES `if_shop_package` (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;