-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 02, 2011 at 09:12 PM
-- Server version: 5.1.58
-- PHP Version: 5.2.17

SET FOREIGN_KEY_CHECKS=0;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `idesign_vfont`
--

-- --------------------------------------------------------

--
-- Table structure for table `if_assets`
--

DROP TABLE IF EXISTS `if_assets`;
CREATE TABLE `if_assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `if_assets`
--

INSERT INTO `if_assets` VALUES(1, 0, 1, 424, 0, 'root.1', 'Root Asset', '{"core.login.site":{"6":1,"2":1},"core.login.admin":{"6":1},"core.login.offline":{"6":1},"core.admin":{"8":1},"core.manage":{"7":1},"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}');
INSERT INTO `if_assets` VALUES(2, 1, 1, 2, 1, 'com_admin', 'com_admin', '{}');
INSERT INTO `if_assets` VALUES(3, 1, 3, 6, 1, 'com_banners', 'com_banners', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `if_assets` VALUES(4, 1, 7, 8, 1, 'com_cache', 'com_cache', '{"core.admin":{"7":1},"core.manage":{"7":1}}');
INSERT INTO `if_assets` VALUES(5, 1, 9, 10, 1, 'com_checkin', 'com_checkin', '{"core.admin":{"7":1},"core.manage":{"7":1}}');
INSERT INTO `if_assets` VALUES(6, 1, 11, 12, 1, 'com_config', 'com_config', '{}');
INSERT INTO `if_assets` VALUES(7, 1, 13, 16, 1, 'com_contact', 'com_contact', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}');
INSERT INTO `if_assets` VALUES(8, 1, 17, 26, 1, 'com_content', 'com_content', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}');
INSERT INTO `if_assets` VALUES(9, 1, 27, 28, 1, 'com_cpanel', 'com_cpanel', '{}');
INSERT INTO `if_assets` VALUES(10, 1, 29, 30, 1, 'com_installer', 'com_installer', '{"core.admin":{"7":1},"core.manage":{"7":1},"core.delete":[],"core.edit.state":[]}');
INSERT INTO `if_assets` VALUES(11, 1, 31, 32, 1, 'com_languages', 'com_languages', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `if_assets` VALUES(12, 1, 33, 34, 1, 'com_login', 'com_login', '{}');
INSERT INTO `if_assets` VALUES(13, 1, 35, 36, 1, 'com_mailto', 'com_mailto', '{}');
INSERT INTO `if_assets` VALUES(14, 1, 37, 38, 1, 'com_massmail', 'com_massmail', '{}');
INSERT INTO `if_assets` VALUES(15, 1, 39, 40, 1, 'com_media', 'com_media', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":{"5":1}}');
INSERT INTO `if_assets` VALUES(16, 1, 41, 42, 1, 'com_menus', 'com_menus', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `if_assets` VALUES(17, 1, 43, 44, 1, 'com_messages', 'com_messages', '{"core.admin":{"7":1},"core.manage":{"7":1}}');
INSERT INTO `if_assets` VALUES(18, 1, 45, 46, 1, 'com_modules', 'com_modules', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `if_assets` VALUES(19, 1, 47, 50, 1, 'com_newsfeeds', 'com_newsfeeds', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}');
INSERT INTO `if_assets` VALUES(20, 1, 51, 52, 1, 'com_plugins', 'com_plugins', '{"core.admin":{"7":1},"core.manage":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `if_assets` VALUES(21, 1, 53, 54, 1, 'com_redirect', 'com_redirect', '{"core.admin":{"7":1},"core.manage":[]}');
INSERT INTO `if_assets` VALUES(22, 1, 55, 56, 1, 'com_search', 'com_search', '{"core.admin":{"7":1},"core.manage":{"6":1}}');
INSERT INTO `if_assets` VALUES(23, 1, 57, 58, 1, 'com_templates', 'com_templates', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `if_assets` VALUES(24, 1, 59, 60, 1, 'com_users', 'com_users', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.own":{"6":1},"core.edit.state":[]}');
INSERT INTO `if_assets` VALUES(25, 1, 61, 64, 1, 'com_weblinks', 'com_weblinks', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}');
INSERT INTO `if_assets` VALUES(26, 1, 65, 66, 1, 'com_wrapper', 'com_wrapper', '{}');
INSERT INTO `if_assets` VALUES(27, 8, 18, 25, 2, 'com_content.category.2', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}');
INSERT INTO `if_assets` VALUES(28, 3, 4, 5, 2, 'com_banners.category.3', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `if_assets` VALUES(29, 7, 14, 15, 2, 'com_contact.category.4', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}');
INSERT INTO `if_assets` VALUES(30, 19, 48, 49, 2, 'com_newsfeeds.category.5', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}');
INSERT INTO `if_assets` VALUES(31, 25, 62, 63, 2, 'com_weblinks.category.6', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}');
INSERT INTO `if_assets` VALUES(32, 27, 19, 20, 3, 'com_content.article.1', 'Giới thiệu', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `if_assets` VALUES(40, 1, 420, 421, 1, 'com_shop', 'shop', '{}');
INSERT INTO `if_assets` VALUES(41, 27, 21, 22, 3, 'com_content.article.2', 'Gửi bán', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `if_assets` VALUES(42, 27, 23, 24, 3, 'com_content.article.3', 'Đặt phông', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}');
INSERT INTO `if_assets` VALUES(43, 1, 422, 423, 1, 'com_extplorer', 'extplorer', '{}');

-- --------------------------------------------------------

--
-- Table structure for table `if_associations`
--

DROP TABLE IF EXISTS `if_associations`;
CREATE TABLE `if_associations` (
  `id` varchar(50) NOT NULL COMMENT 'A reference to the associated item.',
  `context` varchar(50) NOT NULL COMMENT 'The context of the associated item.',
  `key` char(32) NOT NULL COMMENT 'The key for the association computed from an md5 on associated ids.',
  PRIMARY KEY (`context`,`id`),
  KEY `idx_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `if_associations`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_banners`
--

DROP TABLE IF EXISTS `if_banners`;
CREATE TABLE `if_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `custombannercode` varchar(2048) NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `params` text NOT NULL,
  `own_prefix` tinyint(1) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reset` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_state` (`state`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`),
  KEY `idx_banner_catid` (`catid`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `if_banners`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_banner_clients`
--

DROP TABLE IF EXISTS `if_banner_clients`;
CREATE TABLE `if_banner_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey` text NOT NULL,
  `own_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `if_banner_clients`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_banner_tracks`
--

DROP TABLE IF EXISTS `if_banner_tracks`;
CREATE TABLE `if_banner_tracks` (
  `track_date` datetime NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`track_date`,`track_type`,`banner_id`),
  KEY `idx_track_date` (`track_date`),
  KEY `idx_track_type` (`track_type`),
  KEY `idx_banner_id` (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `if_banner_tracks`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_categories`
--

DROP TABLE IF EXISTS `if_categories`;
CREATE TABLE `if_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `extension` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(5120) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`extension`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `if_categories`
--

INSERT INTO `if_categories` VALUES(1, 0, 0, 0, 11, 0, '', 'system', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{}', '', '', '', 0, '2009-10-18 16:07:09', 0, '0000-00-00 00:00:00', 0, '*');
INSERT INTO `if_categories` VALUES(2, 27, 1, 1, 2, 1, 'uncategorised', 'com_content', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2010-06-28 13:26:37', 0, '0000-00-00 00:00:00', 0, '*');
INSERT INTO `if_categories` VALUES(3, 28, 1, 3, 4, 1, 'uncategorised', 'com_banners', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":"","foobar":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2010-06-28 13:27:35', 0, '0000-00-00 00:00:00', 0, '*');
INSERT INTO `if_categories` VALUES(4, 29, 1, 5, 6, 1, 'uncategorised', 'com_contact', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2010-06-28 13:27:57', 0, '0000-00-00 00:00:00', 0, '*');
INSERT INTO `if_categories` VALUES(5, 30, 1, 7, 8, 1, 'uncategorised', 'com_newsfeeds', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2010-06-28 13:28:15', 0, '0000-00-00 00:00:00', 0, '*');
INSERT INTO `if_categories` VALUES(6, 31, 1, 9, 10, 1, 'uncategorised', 'com_weblinks', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2010-06-28 13:28:33', 0, '0000-00-00 00:00:00', 0, '*');

-- --------------------------------------------------------

--
-- Table structure for table `if_contact_details`
--

DROP TABLE IF EXISTS `if_contact_details`;
CREATE TABLE `if_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  `sortname1` varchar(255) NOT NULL,
  `sortname2` varchar(255) NOT NULL,
  `sortname3` varchar(255) NOT NULL,
  `language` char(7) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `if_contact_details`
--

INSERT INTO `if_contact_details` VALUES(1, 'Administrator', 'administrator', '', '', '', '', '', '', '', '', '', '', NULL, '', 0, 1, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","contact_layout":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":""}', 42, 4, 1, '', '', '', '', '', '*', '2011-10-10 23:59:15', 42, '', '0000-00-00 00:00:00', 0, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `if_content`
--

DROP TABLE IF EXISTS `if_content`;
CREATE TABLE `if_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `title_alias` varchar(255) NOT NULL DEFAULT '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(10) unsigned NOT NULL DEFAULT '0',
  `mask` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` varchar(5120) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `language` char(7) NOT NULL COMMENT 'The language code for the article.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `if_content`
--

INSERT INTO `if_content` VALUES(1, 32, 'Giới thiệu', 'gii-thiu', '', '<div class="w455 about">\r\n<ul>\r\n<ul>Đáp ứng nhu cầu về chất lượng phông tiếng Việt. Đặc biệt với những phông nổi tiếng trên thế giới.</ul>\r\n</ul>\r\n<h4>CHẤT LƯỢNG</h4>\r\n<ul>\r\n<ul>\r\n<li>Mỗi chữ cái đều được thiết kế chuẩn mực</li>\r\n<li>Gõ Unicode</li>\r\n<li>Tương thích với nhiều trình duyệt</li>\r\n<li>Hỗ trợ, tư vấn lựa chọn phông</li>\r\n</ul>\r\n</ul>\r\n<div><img src="images/2.jpg" border="0" alt="" style="display: block; margin-left: auto; margin-right: auto;" /></div>\r\n<h4>chỉnh theo yêu cầu</h4>\r\n<ul>\r\n<ul>\r\n<li>Tại Vf.vn bạn có yêu cầu sửa các dấu/chữ theo ý muốn để phù hợp với mục đích sử dụng.</li>\r\n</ul>\r\n</ul>\r\n<h4>Bảo hành</h4>\r\n<ul>\r\n<li>Các vấn đề lỗi phông sẽ được bộ phận kỹ thuật chỉnh sửa và gửi lại cho khách hàng.</li>\r\n<li>Các vấn đề khiến phông của khách hàng bị thất lạc trong vòng 6 tháng kể từ ngày mua sẽ được gửi lại miễn phí.</li>\r\n<li>Thất lạc 6 tháng tới 1 năm kể từ ngày mua sẽ được gửi lại với chi phí bằng 50% thời điểm mua phông.</li>\r\n</ul>\r\n</div>', '', 1, 0, 0, 2, '2011-11-02 00:49:26', 42, '', '2011-11-23 15:05:56', 42, 0, '0000-00-00 00:00:00', '2011-11-02 00:49:26', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 7, 0, 2, '', '', 1, 32, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');
INSERT INTO `if_content` VALUES(2, 41, 'Gửi bán', 'sell-font', '', '<div class="w455 detail">Tại vf.vn bạn có thể gửi những phông mình thiết kế để bán trên vf.\r\n<h4>Các bước để có thể gửi bán phông</h4>\r\n<ul>\r\n<li class="change_font">1</li>\r\n<li>Đăng ký một tài khoản trên vf.vn <a href="#">tại đây</a>.</li>\r\n<li class="change_font">2</li>\r\n<li>Bạn cần gửi phông cần việt hóa chúng tôi qua địa chỉ mail: <a href="#">viethoa@vf.vn</a></li>\r\n<li class="change_font">3</li>\r\n<li>Chúng tôi sẽ đưa bạn một mẫu văn bản đề nghị bạn sử dụng phông bạn thiết kế với mẫu văn bản đó.</li>\r\n<li class="change_font">4</li>\r\n<li>Sau đó bạn chỉ cần gửi file chụp màn hình gửi lại cho chúng tôi. <br /><br /> Sau khi kiểm tra và thấy đạt chất lượng (hoặc có thể có đề nghị chỉnh sửa từ vf.vn). Bạn và vf có thể thỏa thuận giá bán, số tiền bạn sẽ nhận với mỗi phông.</li>\r\n<li class="change_font">5</li>\r\n<li>Sau kí hợp đồng thỏa thuận bạn có thể gửi phông cho chúng tôi. <br /><br /> Chúng tôi cấp quyền trên trang web để bạn có thể thấy phông của bạn được bao nhiêu lượt mua, qua đó kiểm tra được lợi nhuận của mình.</li>\r\n<li class="change_font">6</li>\r\n<li class="last">Mỗi tháng chúng tôi sẽ chuyển tiền cho bạn theo số lần mua trong tháng đó và chuyển tiền theo thông tin bạn cung cấp.</li>\r\n</ul>\r\n</div>', '', 1, 0, 0, 2, '2011-11-23 14:57:01', 42, '', '2011-11-23 15:30:37', 42, 0, '0000-00-00 00:00:00', '2011-11-23 14:57:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 11, 0, 1, '', '', 1, 39, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');
INSERT INTO `if_content` VALUES(3, 42, 'Đặt phông', 'font-place', '', '<div class="w455 detail">Tại vf.vn bạn có thể gửi những phông mình thích để vf.vn tiến hành việt hóa.\r\n<h4>Các bước để có thể đặt việt hoá phông</h4>\r\n<ul>\r\n<li class="change_font">1</li>\r\n<li>Đăng ký một tài khoản trên vf.vn <a href="#">tại đây</a>.</li>\r\n<li class="change_font">2</li>\r\n<li>Bạn cần gửi phông cần việt hóa chúng tôi qua địa chỉ mail: <a href="http://mce_host/mailto?viethoa@vf.vn">viethoa@vf.vn</a></li>\r\n<li class="change_font">a</li>\r\n<li>Nếu bạn không có phông đó, bạn cần nói tên để chúng tôi mua tại nơi khác và tiến hành việt hoá. Lúc này chi phí sẽ bao gồm cả tiền mua phông.</li>\r\n<li class="change_font">b</li>\r\n<li>Nếu bạn chỉ có hình ảnh mà không biết tên phông thì cần gửi chúng tôi hình ảnh, sau khi giúp bạn tìm ra tên phông, bước tiến hành giống như ở trên (2a).</li>\r\n<li class="change_font">3</li>\r\n<li>Sau khi tiến hành kiểm tra độ khó của phông cần việt hóa, bạn và chúng tôi sẽ thỏa thuận thời gian và chi phí công việc. <br /><br /> Bạn đồng ý và chuyển 100% số tiền qua tài khoản của vf.vn. Xem cách thanh toán tại đây.</li>\r\n<li class="change_font">4</li>\r\n<li>Sau khi hoàn thành chúng tôi sẽ gửi bạn phông, và bảo hành trong 6 tháng kể từ ngày giao phông.</li>\r\n</ul>\r\n</div>', '', 1, 0, 0, 2, '2011-11-23 15:46:21', 42, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2011-11-23 15:46:21', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 1, 0, 0, '', '', 1, 9, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');

-- --------------------------------------------------------

--
-- Table structure for table `if_content_frontpage`
--

DROP TABLE IF EXISTS `if_content_frontpage`;
CREATE TABLE `if_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `if_content_frontpage`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_content_rating`
--

DROP TABLE IF EXISTS `if_content_rating`;
CREATE TABLE `if_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(10) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `if_content_rating`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_core_log_searches`
--

DROP TABLE IF EXISTS `if_core_log_searches`;
CREATE TABLE `if_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `if_core_log_searches`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_extensions`
--

DROP TABLE IF EXISTS `if_extensions`;
CREATE TABLE `if_extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `element` varchar(100) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `client_id` tinyint(3) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `protected` tinyint(3) NOT NULL DEFAULT '0',
  `manifest_cache` text NOT NULL,
  `params` text NOT NULL,
  `custom_data` text NOT NULL,
  `system_data` text NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`extension_id`),
  KEY `element_clientid` (`element`,`client_id`),
  KEY `element_folder_clientid` (`element`,`folder`,`client_id`),
  KEY `extension` (`type`,`element`,`folder`,`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10021 ;

--
-- Dumping data for table `if_extensions`
--

INSERT INTO `if_extensions` VALUES(1, 'com_mailto', 'component', 'com_mailto', '', 0, 1, 1, 1, '{"legacy":false,"name":"com_mailto","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_MAILTO_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(2, 'com_wrapper', 'component', 'com_wrapper', '', 0, 1, 1, 1, '{"legacy":false,"name":"com_wrapper","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_WRAPPER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(3, 'com_admin', 'component', 'com_admin', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_admin","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_ADMIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(4, 'com_banners', 'component', 'com_banners', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_banners","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_BANNERS_XML_DESCRIPTION","group":""}', '{"purchase_type":"3","track_impressions":"0","track_clicks":"0","metakey_prefix":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(5, 'com_cache', 'component', 'com_cache', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_cache","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CACHE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(6, 'com_categories', 'component', 'com_categories', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_categories","type":"component","creationDate":"December 2007","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(7, 'com_checkin', 'component', 'com_checkin', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_checkin","type":"component","creationDate":"Unknown","author":"Joomla! Project","copyright":"(C) 2005 - 2008 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CHECKIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(8, 'com_contact', 'component', 'com_contact', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_contact","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CONTACT_XML_DESCRIPTION","group":""}', '{"show_contact_category":"hide","show_contact_list":"0","presentation_style":"sliders","show_name":"1","show_position":"1","show_email":"0","show_street_address":"1","show_suburb":"1","show_state":"1","show_postcode":"1","show_country":"1","show_telephone":"1","show_mobile":"1","show_fax":"1","show_webpage":"1","show_misc":"1","show_image":"1","image":"","allow_vcard":"0","show_articles":"0","show_profile":"0","show_links":"0","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","contact_icons":"0","icon_address":"","icon_email":"","icon_telephone":"","icon_mobile":"","icon_fax":"","icon_misc":"","show_headings":"1","show_position_headings":"1","show_email_headings":"0","show_telephone_headings":"1","show_mobile_headings":"0","show_fax_headings":"0","allow_vcard_headings":"0","show_suburb_headings":"1","show_state_headings":"1","show_country_headings":"1","show_email_form":"1","show_email_copy":"1","banned_email":"","banned_subject":"","banned_text":"","validate_session":"1","custom_reply":"0","redirect":"","show_category_crumb":"0","metakey":"","metadesc":"","robots":"","author":"","rights":"","xreference":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(9, 'com_cpanel', 'component', 'com_cpanel', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_cpanel","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CPANEL_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(10, 'com_installer', 'component', 'com_installer', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_installer","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_INSTALLER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(11, 'com_languages', 'component', 'com_languages', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_languages","type":"component","creationDate":"2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_LANGUAGES_XML_DESCRIPTION","group":""}', '{"administrator":"en-GB","site":"vi-VN"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(12, 'com_login', 'component', 'com_login', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_login","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(13, 'com_media', 'component', 'com_media', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_media","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_MEDIA_XML_DESCRIPTION","group":""}', '{"upload_extensions":"bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS,ttf","upload_maxsize":"10","file_path":"images","image_path":"images","restrict_uploads":"0","check_mime":"0","image_extensions":"bmp,gif,jpg,png,ttf,txt","ignore_extensions":"","upload_mime":"image\\/jpeg,image\\/gif,image\\/png,image\\/bmp,application\\/x-shockwave-flash,application\\/msword,application\\/excel,application\\/pdf,application\\/powerpoint,text\\/plain,application\\/x-zip","upload_mime_illegal":"text\\/html","enable_flash":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(14, 'com_menus', 'component', 'com_menus', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_menus","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_MENUS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(15, 'com_messages', 'component', 'com_messages', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_messages","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_MESSAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(16, 'com_modules', 'component', 'com_modules', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_modules","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_MODULES_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(17, 'com_newsfeeds', 'component', 'com_newsfeeds', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_newsfeeds","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{"show_feed_image":"1","show_feed_description":"1","show_item_description":"1","feed_word_count":"0","show_headings":"1","show_name":"1","show_articles":"0","show_link":"1","show_description":"1","show_description_image":"1","display_num":"","show_pagination_limit":"1","show_pagination":"1","show_pagination_results":"1","show_cat_items":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(18, 'com_plugins', 'component', 'com_plugins', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_plugins","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_PLUGINS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(19, 'com_search', 'component', 'com_search', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_search","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_SEARCH_XML_DESCRIPTION","group":""}', '{"enabled":"0","show_date":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(20, 'com_templates', 'component', 'com_templates', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_templates","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_TEMPLATES_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(21, 'com_weblinks', 'component', 'com_weblinks', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_weblinks","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_WEBLINKS_XML_DESCRIPTION","group":""}', '{"show_comp_description":"1","comp_description":"","show_link_hits":"1","show_link_description":"1","show_other_cats":"0","show_headings":"0","show_numbers":"0","show_report":"1","count_clicks":"1","target":"0","link_icons":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(22, 'com_content', 'component', 'com_content', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_content","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CONTENT_XML_DESCRIPTION","group":""}', '{"article_layout":"_:default","show_title":"1","link_titles":"1","show_intro":"0","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"0","show_readmore":"1","show_readmore_title":"1","readmore_limit":"100","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_hits":"0","show_noauth":"0","category_layout":"_:blog","show_category_title":"0","show_description":"0","show_description_image":"0","maxLevel":"1","show_empty_categories":"0","show_no_articles":"1","show_subcat_desc":"1","show_cat_num_articles":"0","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_num_articles_cat":"1","num_leading_articles":"1","num_intro_articles":"4","num_columns":"2","num_links":"4","multi_column_order":"0","show_subcategory_content":"0","show_pagination_limit":"1","filter_field":"hide","show_headings":"1","list_show_date":"0","date_format":"","list_show_hits":"1","list_show_author":"1","orderby_pri":"order","orderby_sec":"rdate","order_date":"published","show_pagination":"2","show_pagination_results":"1","show_feed_link":"1","feed_summary":"0","filters":{"1":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"6":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"7":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"2":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"3":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"4":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"5":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"8":{"filter_type":"BL","filter_tags":"","filter_attributes":""}}}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(23, 'com_config', 'component', 'com_config', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_config","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CONFIG_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(24, 'com_redirect', 'component', 'com_redirect', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_redirect","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_REDIRECT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(25, 'com_users', 'component', 'com_users', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_users","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_USERS_XML_DESCRIPTION","group":""}', '{"allowUserRegistration":"1","new_usertype":"2","useractivation":"1","frontend_userparams":"1","mailSubjectPrefix":"","mailBodySuffix":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(100, 'PHPMailer', 'library', 'phpmailer', '', 0, 1, 1, 1, '{"legacy":false,"name":"PHPMailer","type":"library","creationDate":"2008","author":"PHPMailer","copyright":"Copyright (C) PHPMailer.","authorEmail":"","authorUrl":"http:\\/\\/phpmailer.codeworxtech.com\\/","version":"1.7.0","description":"Classes for sending email","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(101, 'SimplePie', 'library', 'simplepie', '', 0, 1, 1, 1, '{"legacy":false,"name":"SimplePie","type":"library","creationDate":"2008","author":"SimplePie","copyright":"Copyright (C) 2008 SimplePie","authorEmail":"","authorUrl":"http:\\/\\/simplepie.org\\/","version":"1.0.1","description":"A PHP-Based RSS and Atom Feed Framework.","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(102, 'phputf8', 'library', 'phputf8', '', 0, 1, 1, 1, '{"legacy":false,"name":"phputf8","type":"library","creationDate":"2008","author":"Harry Fuecks","copyright":"Copyright various authors","authorEmail":"","authorUrl":"http:\\/\\/sourceforge.net\\/projects\\/phputf8","version":"1.7.0","description":"Classes for UTF8","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(103, 'Joomla! Web Application Framework', 'library', 'joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"Joomla! Web Application Framework","type":"library","creationDate":"2008","author":"Joomla","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"http:\\/\\/www.joomla.org","version":"1.7.0","description":"The Joomla! Web Application Framework is the Core of the Joomla! Content Management System","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(200, 'mod_articles_archive', 'module', 'mod_articles_archive', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_archive","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters.\\n\\t\\tAll rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_ARTICLES_ARCHIVE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(201, 'mod_articles_latest', 'module', 'mod_articles_latest', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_LATEST_NEWS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(202, 'mod_articles_popular', 'module', 'mod_articles_popular', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_articles_popular","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(203, 'mod_banners', 'module', 'mod_banners', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_banners","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_BANNERS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(204, 'mod_breadcrumbs', 'module', 'mod_breadcrumbs', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_breadcrumbs","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_BREADCRUMBS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(205, 'mod_custom', 'module', 'mod_custom', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(206, 'mod_feed', 'module', 'mod_feed', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_FEED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(207, 'mod_footer', 'module', 'mod_footer', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_footer","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_FOOTER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(208, 'mod_login', 'module', 'mod_login', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_login","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(209, 'mod_menu', 'module', 'mod_menu', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_menu","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_MENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(210, 'mod_articles_news', 'module', 'mod_articles_news', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_articles_news","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_ARTICLES_NEWS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(211, 'mod_random_image', 'module', 'mod_random_image', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_random_image","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_RANDOM_IMAGE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(212, 'mod_related_items', 'module', 'mod_related_items', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_related_items","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_RELATED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(213, 'mod_search', 'module', 'mod_search', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_search","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_SEARCH_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(214, 'mod_stats', 'module', 'mod_stats', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_stats","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_STATS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(215, 'mod_syndicate', 'module', 'mod_syndicate', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_syndicate","type":"module","creationDate":"May 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_SYNDICATE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(216, 'mod_users_latest', 'module', 'mod_users_latest', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_users_latest","type":"module","creationDate":"December 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_USERS_LATEST_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(217, 'mod_weblinks', 'module', 'mod_weblinks', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_weblinks","type":"module","creationDate":"July 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_WEBLINKS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(218, 'mod_whosonline', 'module', 'mod_whosonline', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_whosonline","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_WHOSONLINE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(219, 'mod_wrapper', 'module', 'mod_wrapper', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_wrapper","type":"module","creationDate":"October 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_WRAPPER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(220, 'mod_articles_category', 'module', 'mod_articles_category', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_category","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters.\\n\\t\\tAll rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_ARTICLES_CATEGORY_XML_DESCRIPTION\\n\\t","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(221, 'mod_articles_categories', 'module', 'mod_articles_categories', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_categories","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_ARTICLES_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(222, 'mod_languages', 'module', 'mod_languages', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_languages","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_LANGUAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(300, 'mod_custom', 'module', 'mod_custom', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(301, 'mod_feed', 'module', 'mod_feed', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_FEED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(302, 'mod_latest', 'module', 'mod_latest', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_LATEST_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(303, 'mod_logged', 'module', 'mod_logged', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_logged","type":"module","creationDate":"January 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_LOGGED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(304, 'mod_login', 'module', 'mod_login', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_login","type":"module","creationDate":"March 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(305, 'mod_menu', 'module', 'mod_menu', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_menu","type":"module","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_MENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(306, 'mod_online', 'module', 'mod_online', '', 1, 1, 1, 1, 'false', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(307, 'mod_popular', 'module', 'mod_popular', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_popular","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(308, 'mod_quickicon', 'module', 'mod_quickicon', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_quickicon","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_QUICKICON_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(309, 'mod_status', 'module', 'mod_status', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_status","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_STATUS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(310, 'mod_submenu', 'module', 'mod_submenu', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_submenu","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_SUBMENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(311, 'mod_title', 'module', 'mod_title', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_title","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_TITLE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(312, 'mod_toolbar', 'module', 'mod_toolbar', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_toolbar","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_TOOLBAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(313, 'mod_unread', 'module', 'mod_unread', '', 1, 1, 1, 1, 'false', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(400, 'plg_authentication_gmail', 'plugin', 'gmail', 'authentication', 0, 0, 1, 0, '{"legacy":false,"name":"plg_authentication_gmail","type":"plugin","creationDate":"February 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_GMAIL_XML_DESCRIPTION","group":""}', '{"applysuffix":"0","suffix":"","verifypeer":"1","user_blacklist":""}', '', '', 0, '0000-00-00 00:00:00', 1, 0);
INSERT INTO `if_extensions` VALUES(401, 'plg_authentication_joomla', 'plugin', 'joomla', 'authentication', 0, 1, 1, 1, '{"legacy":false,"name":"plg_authentication_joomla","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_AUTH_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(402, 'plg_authentication_ldap', 'plugin', 'ldap', 'authentication', 0, 0, 1, 0, '{"legacy":false,"name":"plg_authentication_ldap","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_LDAP_XML_DESCRIPTION","group":""}', '{"host":"","port":"389","use_ldapV3":"0","negotiate_tls":"0","no_referrals":"0","auth_method":"bind","base_dn":"","search_string":"","users_dn":"","username":"admin","password":"bobby7","ldap_fullname":"fullName","ldap_email":"mail","ldap_uid":"uid"}', '', '', 0, '0000-00-00 00:00:00', 3, 0);
INSERT INTO `if_extensions` VALUES(404, 'plg_content_emailcloak', 'plugin', 'emailcloak', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"plg_content_emailcloak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_CONTENT_EMAILCLOAK_XML_DESCRIPTION","group":""}', '{"mode":"1"}', '', '', 0, '0000-00-00 00:00:00', 1, 0);
INSERT INTO `if_extensions` VALUES(405, 'plg_content_geshi', 'plugin', 'geshi', 'content', 0, 0, 1, 0, '{"legacy":false,"name":"plg_content_geshi","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"","authorUrl":"qbnz.com\\/highlighter","version":"1.7.0","description":"PLG_CONTENT_GESHI_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0);
INSERT INTO `if_extensions` VALUES(406, 'plg_content_loadmodule', 'plugin', 'loadmodule', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"plg_content_loadmodule","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_LOADMODULE_XML_DESCRIPTION","group":""}', '{"style":"none"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(407, 'plg_content_pagebreak', 'plugin', 'pagebreak', 'content', 0, 1, 1, 1, '{"legacy":false,"name":"plg_content_pagebreak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_CONTENT_PAGEBREAK_XML_DESCRIPTION","group":""}', '{"title":"1","multipage_toc":"1","showall":"1"}', '', '', 0, '0000-00-00 00:00:00', 4, 0);
INSERT INTO `if_extensions` VALUES(408, 'plg_content_pagenavigation', 'plugin', 'pagenavigation', 'content', 0, 1, 1, 1, '{"legacy":false,"name":"plg_content_pagenavigation","type":"plugin","creationDate":"January 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_PAGENAVIGATION_XML_DESCRIPTION","group":""}', '{"position":"1"}', '', '', 0, '0000-00-00 00:00:00', 5, 0);
INSERT INTO `if_extensions` VALUES(409, 'plg_content_vote', 'plugin', 'vote', 'content', 0, 1, 1, 1, '{"legacy":false,"name":"plg_content_vote","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_VOTE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 6, 0);
INSERT INTO `if_extensions` VALUES(410, 'plg_editors_codemirror', 'plugin', 'codemirror', 'editors', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors_codemirror","type":"plugin","creationDate":"28 March 2011","author":"Marijn Haverbeke","copyright":"","authorEmail":"N\\/A","authorUrl":"","version":"1.0","description":"PLG_CODEMIRROR_XML_DESCRIPTION","group":""}', '{"linenumbers":"0","tabmode":"indent"}', '', '', 0, '0000-00-00 00:00:00', 1, 0);
INSERT INTO `if_extensions` VALUES(411, 'plg_editors_none', 'plugin', 'none', 'editors', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors_none","type":"plugin","creationDate":"August 2004","author":"Unknown","copyright":"","authorEmail":"N\\/A","authorUrl":"","version":"1.7.0","description":"PLG_NONE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0);
INSERT INTO `if_extensions` VALUES(412, 'plg_editors_tinymce', 'plugin', 'tinymce', 'editors', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors_tinymce","type":"plugin","creationDate":"2005-2011","author":"Moxiecode Systems AB","copyright":"Moxiecode Systems AB","authorEmail":"N\\/A","authorUrl":"tinymce.moxiecode.com\\/","version":"3.4.3.2","description":"PLG_TINY_XML_DESCRIPTION","group":""}', '{"mode":"2","skin":"0","entity_encoding":"raw","lang_mode":"0","lang_code":"en","text_direction":"ltr","content_css":"1","content_css_custom":"","relative_urls":"1","newlines":"0","invalid_elements":"script,applet,iframe","extended_elements":"","toolbar":"top","toolbar_align":"left","html_height":"550","html_width":"750","resizing":"true","resize_horizontal":"false","element_path":"1","fonts":"1","paste":"1","searchreplace":"1","insertdate":"1","format_date":"%Y-%m-%d","inserttime":"1","format_time":"%H:%M:%S","colors":"1","table":"1","smilies":"1","media":"1","hr":"1","directionality":"1","fullscreen":"1","style":"1","layer":"1","xhtmlxtras":"1","visualchars":"1","nonbreaking":"1","template":"1","blockquote":"1","wordcount":"1","advimage":"1","advlink":"1","advlist":"1","autosave":"1","contextmenu":"1","inlinepopups":"1","custom_plugin":"","custom_button":""}', '', '', 0, '0000-00-00 00:00:00', 3, 0);
INSERT INTO `if_extensions` VALUES(413, 'plg_editors-xtd_article', 'plugin', 'article', 'editors-xtd', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors-xtd_article","type":"plugin","creationDate":"October 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_ARTICLE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0);
INSERT INTO `if_extensions` VALUES(414, 'plg_editors-xtd_image', 'plugin', 'image', 'editors-xtd', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors-xtd_image","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_IMAGE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0);
INSERT INTO `if_extensions` VALUES(415, 'plg_editors-xtd_pagebreak', 'plugin', 'pagebreak', 'editors-xtd', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors-xtd_pagebreak","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_EDITORSXTD_PAGEBREAK_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 0);
INSERT INTO `if_extensions` VALUES(416, 'plg_editors-xtd_readmore', 'plugin', 'readmore', 'editors-xtd', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors-xtd_readmore","type":"plugin","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_READMORE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 4, 0);
INSERT INTO `if_extensions` VALUES(417, 'plg_search_categories', 'plugin', 'categories', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_categories","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SEARCH_CATEGORIES_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(418, 'plg_search_contacts', 'plugin', 'contacts', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_contacts","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SEARCH_CONTACTS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(419, 'plg_search_content', 'plugin', 'content', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_content","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SEARCH_CONTENT_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(420, 'plg_search_newsfeeds', 'plugin', 'newsfeeds', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_newsfeeds","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SEARCH_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(421, 'plg_search_weblinks', 'plugin', 'weblinks', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_weblinks","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SEARCH_WEBLINKS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(422, 'plg_system_languagefilter', 'plugin', 'languagefilter', 'system', 0, 0, 1, 1, '{"legacy":false,"name":"plg_system_languagefilter","type":"plugin","creationDate":"July 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SYSTEM_LANGUAGEFILTER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0);
INSERT INTO `if_extensions` VALUES(423, 'plg_system_p3p', 'plugin', 'p3p', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_p3p","type":"plugin","creationDate":"September 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_P3P_XML_DESCRIPTION","group":""}', '{"headers":"NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"}', '', '', 0, '0000-00-00 00:00:00', 2, 0);
INSERT INTO `if_extensions` VALUES(424, 'plg_system_cache', 'plugin', 'cache', 'system', 0, 0, 1, 1, '{"legacy":false,"name":"plg_system_cache","type":"plugin","creationDate":"February 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_CACHE_XML_DESCRIPTION","group":""}', '{"browsercache":"0","cachetime":"15"}', '', '', 0, '0000-00-00 00:00:00', 9, 0);
INSERT INTO `if_extensions` VALUES(425, 'plg_system_debug', 'plugin', 'debug', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"plg_system_debug","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_DEBUG_XML_DESCRIPTION","group":""}', '{"profile":"1","queries":"1","memory":"1","language_files":"1","language_strings":"1","strip-first":"1","strip-prefix":"","strip-suffix":""}', '', '', 0, '0000-00-00 00:00:00', 4, 0);
INSERT INTO `if_extensions` VALUES(426, 'plg_system_log', 'plugin', 'log', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_log","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_LOG_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 5, 0);
INSERT INTO `if_extensions` VALUES(427, 'plg_system_redirect', 'plugin', 'redirect', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_redirect","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_REDIRECT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 6, 0);
INSERT INTO `if_extensions` VALUES(428, 'plg_system_remember', 'plugin', 'remember', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_remember","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_REMEMBER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 7, 0);
INSERT INTO `if_extensions` VALUES(429, 'plg_system_sef', 'plugin', 'sef', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"plg_system_sef","type":"plugin","creationDate":"December 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SEF_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 8, 0);
INSERT INTO `if_extensions` VALUES(430, 'plg_system_logout', 'plugin', 'logout', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_logout","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SYSTEM_LOGOUT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 0);
INSERT INTO `if_extensions` VALUES(431, 'plg_user_contactcreator', 'plugin', 'contactcreator', 'user', 0, 0, 1, 1, '{"legacy":false,"name":"plg_user_contactcreator","type":"plugin","creationDate":"August 2009","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_CONTACTCREATOR_XML_DESCRIPTION","group":""}', '{"autowebpage":"","category":"34","autopublish":"0"}', '', '', 0, '0000-00-00 00:00:00', 1, 0);
INSERT INTO `if_extensions` VALUES(432, 'plg_user_joomla', 'plugin', 'joomla', 'user', 0, 1, 1, 0, '{"legacy":false,"name":"plg_user_joomla","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2009 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_USER_JOOMLA_XML_DESCRIPTION","group":""}', '{"autoregister":"1"}', '', '', 0, '0000-00-00 00:00:00', 2, 0);
INSERT INTO `if_extensions` VALUES(433, 'plg_user_profile', 'plugin', 'profile', 'user', 0, 0, 1, 1, '{"legacy":false,"name":"plg_user_profile","type":"plugin","creationDate":"January 2008","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_USER_PROFILE_XML_DESCRIPTION","group":""}', '{"register-require_address1":"1","register-require_address2":"1","register-require_city":"1","register-require_region":"1","register-require_country":"1","register-require_postal_code":"1","register-require_phone":"1","register-require_website":"1","register-require_favoritebook":"1","register-require_aboutme":"1","register-require_tos":"1","register-require_dob":"1","profile-require_address1":"1","profile-require_address2":"1","profile-require_city":"1","profile-require_region":"1","profile-require_country":"1","profile-require_postal_code":"1","profile-require_phone":"1","profile-require_website":"1","profile-require_favoritebook":"1","profile-require_aboutme":"1","profile-require_tos":"1","profile-require_dob":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(434, 'plg_extension_joomla', 'plugin', 'joomla', 'extension', 0, 1, 1, 1, '{"legacy":false,"name":"plg_extension_joomla","type":"plugin","creationDate":"May 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_EXTENSION_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0);
INSERT INTO `if_extensions` VALUES(435, 'plg_content_joomla', 'plugin', 'joomla', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"plg_content_joomla","type":"plugin","creationDate":"November 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_CONTENT_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(502, 'bluestork', 'template', 'bluestork', '', 1, 1, 1, 0, '{"legacy":false,"name":"bluestork","type":"template","creationDate":"07\\/02\\/09","author":"Ron Severdia","copyright":"Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.","authorEmail":"contact@kontentdesign.com","authorUrl":"http:\\/\\/www.kontentdesign.com","version":"1.7.0","description":"TPL_BLUESTORK_XML_DESCRIPTION","group":""}', '{"useRoundedCorners":"1","showSiteName":"0","textBig":"0","highContrast":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(504, 'hathor', 'template', 'hathor', '', 1, 1, 1, 0, '{"legacy":false,"name":"hathor","type":"template","creationDate":"May 2010","author":"Andrea Tarr","copyright":"Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.","authorEmail":"hathor@tarrconsulting.com","authorUrl":"http:\\/\\/www.tarrconsulting.com","version":"1.7.0","description":"TPL_HATHOR_XML_DESCRIPTION","group":""}', '{"showSiteName":"0","colourChoice":"0","boldText":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(600, 'English (United Kingdom)', 'language', 'en-GB', '', 0, 1, 1, 1, '{"legacy":false,"name":"English (United Kingdom)","type":"language","creationDate":"2008-03-15","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"en-GB site language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(601, 'English (United Kingdom)', 'language', 'en-GB', '', 1, 1, 1, 1, '{"legacy":false,"name":"English (United Kingdom)","type":"language","creationDate":"2008-03-15","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"en-GB administrator language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(700, 'files_joomla', 'file', 'joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"files_joomla","type":"file","creationDate":"July 2011","author":"Joomla!","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"FILES_JOOMLA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(800, 'Joomla! Content Management System', 'package', 'pkg_joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"Joomla! Content Management System","type":"package","creationDate":"2006","author":"Joomla!","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"http:\\/\\/www.joomla.org","version":"1.7.0","description":"The Joomla! Content Management System is one of the most popular content management system''s available today.","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(10002, 'vi-VN', 'package', 'pkg_vi-VN', '', 0, 1, 1, 0, '{"legacy":false,"name":"Vietnamese Language Pack","type":"package","creationDate":"Unknown","author":"Unknown","copyright":"","authorEmail":"","authorUrl":"","version":"1.7","description":"Joomla! 1.7 Vietnamese Language Pack","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(10005, 'site', 'template', 'site', '', 0, 1, 1, 0, '{"legacy":false,"name":"site","type":"template","creationDate":"03 September 2011","author":"Duong Thien Duc","copyright":"Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.","authorEmail":"duongthienduc@yahoo.com","authorUrl":"http:\\/\\/www.idesign.vn","version":"1.7.0","description":"TPL_SITE_XML_DESCRIPTION","group":""}', '{"wrapperSmall":"53","wrapperLarge":"72","sitetitle":"","sitedescription":"","navposition":"center","html5":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(10006, 'iFont Contact', 'module', 'mod_contact', '', 0, 1, 1, 0, '{"legacy":false,"name":"iFont Contact","type":"module","creationDate":"September 2011","author":"Duong Thien Duc","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"duongthienduc","authorUrl":"www.ovis.com","version":"1.7.0","description":"iFont Contact module","group":""}', '{"cache":"1","cache_time":"900"}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(10014, 'shop', 'component', 'com_shop', '', 1, 1, 0, 0, '{"legacy":false,"name":"Shop","type":"component","creationDate":"April 2006","author":"Duong Thien Duc","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"Shop Component","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(10015, 'Shop Package', 'module', 'mod_shop_packages', '', 0, 1, 1, 0, '{"legacy":false,"name":"Shop Package","type":"module","creationDate":"July 2004","author":"Duong Thien Duc","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"Shop Package Module","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(10016, 'VietnameseVitNam', 'language', 'vi-VN', '', 0, 1, 0, 0, '{"legacy":false,"name":"Vietnamese (Vi\\u1ec7t Nam)","type":"language","creationDate":"2011-07-21","author":"buaxua.vn","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"contact@buaxua.vn","authorUrl":"www.buaxua.vn","version":"1.7.0v1","description":"Ng\\u00f4n ng\\u1eef ti\\u1ebfng Vi\\u1ec7t cho Joomla 1.7.0 (Front-end)","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(10017, 'VietnameseVitNam', 'language', 'vi-VN', '', 1, 1, 0, 0, '{"legacy":false,"name":"Vietnamese (Vi\\u1ec7t Nam)","type":"language","creationDate":"2011-07-21","author":"buaxua.vn","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"contact@buaxua.vn","authorUrl":"www.buaxua.vn","version":"1.7.0v1","description":"Ng\\u00f4n ng\\u1eef ti\\u1ebfng Vi\\u1ec7t cho Joomla 1.7.0 (Back-end)","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(10018, 'Authentication - Awo Email Login', 'plugin', 'awoelogin', 'authentication', 0, 0, 1, 0, '{"legacy":false,"name":"Authentication - Awo Email Login","type":"plugin","creationDate":"2011-07-22","author":"Seyi Awofadeju","copyright":"Copyright (C) 2010 Seyi Awofadeju - All rights reserved.","authorEmail":"dev@awofadeju.com","authorUrl":"http:\\/\\/dev.awofadeju.com","version":"1.7.0","description":"A user authentication through email","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(10019, 'Shop Cart', 'module', 'mod_shop_cart', '', 0, 1, 0, 0, '{"legacy":false,"name":"Shop Cart","type":"module","creationDate":"July 2004","author":"Duong Thien Duc","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"Shop Cart Module","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `if_extensions` VALUES(10020, 'extplorer', 'component', 'com_extplorer', '', 1, 1, 0, 0, '{"legacy":true,"name":"eXtplorer","type":"component","creationDate":"31.08.2011","author":"soeren, QuiX Project","copyright":"Soeren Eberhardt-Biermann, QuiX Project","authorEmail":"infp|at|extploter.net","authorUrl":"http:\\/\\/extplorer.net\\/","version":"2.1.0RC5","description":"\\n\\t<div align=\\"left\\"><img src=\\"components\\/com_extplorer\\/images\\/eXtplorer_logo.png\\" alt=\\"eXtplorer Logo\\" \\/><\\/div>\\n\\t<h2>Successfully installed eXtplorer&nbsp;<\\/h2>\\n\\teXtplorer is a powerful File- and FTP\\/WebDAV Manager script. \\n\\t<br\\/>It allows \\n\\t  <ul><li>Browsing Directories & Files,<\\/li>\\n\\t  <li>Editing, Copying, Moving and Deleting files,<\\/li>\\n\\t  <li>Searching, Uploading and Downloading files,<\\/li>\\n\\t  <li>Creating new Files and Directories,<\\/li>\\n\\t  <li>Creating and Extracting Archives with Files and Directories,<\\/li>\\n\\t  <li>Changing file permissions (chmod)<\\/li><\\/ul><br\\/>and much more.<br\\/><br\\/>\\n\\t  <strong>By default restricted to Superadministrators!<\\/strong>\\n\\t","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `if_languages`
--

DROP TABLE IF EXISTS `if_languages`;
CREATE TABLE `if_languages` (
  `lang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` char(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_native` varchar(50) NOT NULL,
  `sef` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `idx_sef` (`sef`),
  KEY `idx_ordering` (`ordering`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `if_languages`
--

INSERT INTO `if_languages` VALUES(1, 'en-GB', 'English (UK)', 'English (UK)', 'en', 'en', '', '', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `if_menu`
--

DROP TABLE IF EXISTS `if_menu`;
CREATE TABLE `if_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL COMMENT 'The type of menu this item belongs to. FK to #__menu_types.menutype',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(1024) NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `ordering` int(11) NOT NULL DEFAULT '0' COMMENT 'The relative ordering of the menu item in the tree.',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__users.id',
  `checked_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_client_id_parent_id_alias` (`client_id`,`parent_id`,`alias`),
  KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`),
  KEY `idx_menutype` (`menutype`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_path` (`path`(255)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=191 ;

--
-- Dumping data for table `if_menu`
--

INSERT INTO `if_menu` VALUES(1, '', 'Menu_Item_Root', 'root', '', '', '', '', 1, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '', 0, '', 0, 67, 0, '*', 0);
INSERT INTO `if_menu` VALUES(2, 'menu', 'com_banners', 'Banners', '', 'Banners', 'index.php?option=com_banners', 'component', 0, 1, 1, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 1, 10, 0, '*', 1);
INSERT INTO `if_menu` VALUES(3, 'menu', 'com_banners', 'Banners', '', 'Banners/Banners', 'index.php?option=com_banners', 'component', 0, 2, 2, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 2, 3, 0, '*', 1);
INSERT INTO `if_menu` VALUES(4, 'menu', 'com_banners_categories', 'Categories', '', 'Banners/Categories', 'index.php?option=com_categories&extension=com_banners', 'component', 0, 2, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-cat', 0, '', 4, 5, 0, '*', 1);
INSERT INTO `if_menu` VALUES(5, 'menu', 'com_banners_clients', 'Clients', '', 'Banners/Clients', 'index.php?option=com_banners&view=clients', 'component', 0, 2, 2, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-clients', 0, '', 6, 7, 0, '*', 1);
INSERT INTO `if_menu` VALUES(6, 'menu', 'com_banners_tracks', 'Tracks', '', 'Banners/Tracks', 'index.php?option=com_banners&view=tracks', 'component', 0, 2, 2, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-tracks', 0, '', 8, 9, 0, '*', 1);
INSERT INTO `if_menu` VALUES(7, 'menu', 'com_contact', 'Contacts', '', 'Contacts', 'index.php?option=com_contact', 'component', 0, 1, 1, 8, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 23, 28, 0, '*', 1);
INSERT INTO `if_menu` VALUES(8, 'menu', 'com_contact', 'Contacts', '', 'Contacts/Contacts', 'index.php?option=com_contact', 'component', 0, 7, 2, 8, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 24, 25, 0, '*', 1);
INSERT INTO `if_menu` VALUES(9, 'menu', 'com_contact_categories', 'Categories', '', 'Contacts/Categories', 'index.php?option=com_categories&extension=com_contact', 'component', 0, 7, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact-cat', 0, '', 26, 27, 0, '*', 1);
INSERT INTO `if_menu` VALUES(10, 'menu', 'com_messages', 'Messaging', '', 'Messaging', 'index.php?option=com_messages', 'component', 0, 1, 1, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages', 0, '', 29, 34, 0, '*', 1);
INSERT INTO `if_menu` VALUES(11, 'menu', 'com_messages_add', 'New Private Message', '', 'Messaging/New Private Message', 'index.php?option=com_messages&task=message.add', 'component', 0, 10, 2, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-add', 0, '', 30, 31, 0, '*', 1);
INSERT INTO `if_menu` VALUES(12, 'menu', 'com_messages_read', 'Read Private Message', '', 'Messaging/Read Private Message', 'index.php?option=com_messages', 'component', 0, 10, 2, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-read', 0, '', 32, 33, 0, '*', 1);
INSERT INTO `if_menu` VALUES(13, 'menu', 'com_newsfeeds', 'News Feeds', '', 'News Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 1, 1, 17, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 35, 40, 0, '*', 1);
INSERT INTO `if_menu` VALUES(14, 'menu', 'com_newsfeeds_feeds', 'Feeds', '', 'News Feeds/Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 13, 2, 17, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 36, 37, 0, '*', 1);
INSERT INTO `if_menu` VALUES(15, 'menu', 'com_newsfeeds_categories', 'Categories', '', 'News Feeds/Categories', 'index.php?option=com_categories&extension=com_newsfeeds', 'component', 0, 13, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds-cat', 0, '', 38, 39, 0, '*', 1);
INSERT INTO `if_menu` VALUES(16, 'menu', 'com_redirect', 'Redirect', '', 'Redirect', 'index.php?option=com_redirect', 'component', 0, 1, 1, 24, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:redirect', 0, '', 49, 50, 0, '*', 1);
INSERT INTO `if_menu` VALUES(17, 'menu', 'com_search', 'Search', '', 'Search', 'index.php?option=com_search', 'component', 0, 1, 1, 19, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:search', 0, '', 41, 42, 0, '*', 1);
INSERT INTO `if_menu` VALUES(18, 'menu', 'com_weblinks', 'Weblinks', '', 'Weblinks', 'index.php?option=com_weblinks', 'component', 0, 1, 1, 21, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 43, 48, 0, '*', 1);
INSERT INTO `if_menu` VALUES(19, 'menu', 'com_weblinks_links', 'Links', '', 'Weblinks/Links', 'index.php?option=com_weblinks', 'component', 0, 18, 2, 21, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 44, 45, 0, '*', 1);
INSERT INTO `if_menu` VALUES(20, 'menu', 'com_weblinks_categories', 'Categories', '', 'Weblinks/Categories', 'index.php?option=com_categories&extension=com_weblinks', 'component', 0, 18, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks-cat', 0, '', 46, 47, 0, '*', 1);
INSERT INTO `if_menu` VALUES(101, 'mainmenu', 'Bán phông', 'ban-phong', '', 'ban-phong', 'index.php?option=com_shop&view=packages', 'component', 1, 1, 1, 10014, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"display_num":"10","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"Ch\\u1ecdn Ph\\u00f4ng","show_page_heading":1,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 11, 12, 1, '*', 0);
INSERT INTO `if_menu` VALUES(102, 'mainmenu', 'Đặt phông', 'font-place', '', 'font-place', 'index.php?option=com_content&view=article&id=3', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 13, 14, 0, '*', 0);
INSERT INTO `if_menu` VALUES(103, 'mainmenu', 'Gửi bán', 'sell-font', '', 'sell-font', 'index.php?option=com_content&view=article&id=2', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 15, 16, 0, '*', 0);
INSERT INTO `if_menu` VALUES(104, 'mainmenu', 'Web Embedding', '2011-10-10-16-38-44', '', '2011-10-10-16-38-44', '#', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1}', 17, 18, 0, '*', 0);
INSERT INTO `if_menu` VALUES(105, 'mainmenu', 'Embedding', 'embedding', '', 'embedding', '#', 'url', -2, 1, 1, 8, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1}', 19, 20, 0, '*', 0);
INSERT INTO `if_menu` VALUES(106, 'mainmenu', 'Giới thiệu', 'gioi-thieu', '', 'gioi-thieu', 'index.php?option=com_content&view=article&id=1', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 7, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":1,"page_heading":"M\\u1ee5c ti\\u00eau","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 21, 22, 0, '*', 0);
INSERT INTO `if_menu` VALUES(183, 'hiddenmenu', 'Đăng nhập', 'login', '', 'login', 'index.php?option=com_users&view=login', 'component', 1, 1, 1, 25, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"login_redirect_url":"","logindescription_show":"1","login_description":"","login_image":"","logout_redirect_url":"","logoutdescription_show":"1","logout_description":"","logout_image":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"\\u0110\\u0103ng nh\\u1eadp","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 51, 52, 0, '*', 0);
INSERT INTO `if_menu` VALUES(184, 'hiddenmenu', 'Đăng ký', 'register', '', 'register', 'index.php?option=com_users&view=registration', 'component', 1, 1, 1, 25, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"\\u0110\\u0103ng k\\u00fd","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 53, 54, 0, '*', 0);
INSERT INTO `if_menu` VALUES(185, 'hiddenmenu', 'Giỏ hàng', 'shop-cart', '', 'shop-cart', 'index.php?option=com_shop&view=cart', 'component', 1, 1, 1, 10014, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"page_subheading":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"Gi\\u1ecf h\\u00e0ng","show_page_heading":1,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 55, 56, 0, '*', 0);
INSERT INTO `if_menu` VALUES(186, 'main', 'COM_SHOP_MENU_SHOP', 'comshopmenushop', '', 'comshopmenushop', 'index.php?option=com_shop', 'component', 0, 1, 1, 10014, 0, 0, '0000-00-00 00:00:00', 0, 1, 'class:contact', 0, '', 57, 64, 0, '', 1);
INSERT INTO `if_menu` VALUES(187, 'main', 'COM_SHOP_SUBMENU_PACKAGES', 'comshopsubmenupackages', '', 'comshopmenushop/comshopsubmenupackages', 'index.php?option=com_shop&view=packages', 'component', 0, 186, 2, 10014, 0, 0, '0000-00-00 00:00:00', 0, 1, 'class:contact', 0, '', 58, 59, 0, '', 1);
INSERT INTO `if_menu` VALUES(188, 'main', 'COM_SHOP_SUBMENU_FONTS', 'comshopsubmenufonts', '', 'comshopmenushop/comshopsubmenufonts', 'index.php?option=com_shop&view=fonts', 'component', 0, 186, 2, 10014, 0, 0, '0000-00-00 00:00:00', 0, 1, 'class:contact', 0, '', 60, 61, 0, '', 1);
INSERT INTO `if_menu` VALUES(189, 'main', 'COM_SHOP_SUBMENU_TYPES', 'comshopsubmenutypes', '', 'comshopmenushop/comshopsubmenutypes', 'index.php?option=com_shop&view=types', 'component', 0, 186, 2, 10014, 0, 0, '0000-00-00 00:00:00', 0, 1, 'class:contact', 0, '', 62, 63, 0, '', 1);
INSERT INTO `if_menu` VALUES(190, 'main', 'eXtplorer', 'extplorer', '', 'extplorer', 'index.php?option=com_extplorer&tmpl=component', 'component', 0, 1, 1, 10020, 0, 0, '0000-00-00 00:00:00', 0, 1, '../administrator/components/com_extplorer/images/x_icon.png', 0, '', 65, 66, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `if_menu_types`
--

DROP TABLE IF EXISTS `if_menu_types`;
CREATE TABLE `if_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menutype` (`menutype`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `if_menu_types`
--

INSERT INTO `if_menu_types` VALUES(1, 'mainmenu', 'Main Menu', 'The main menu for the site');
INSERT INTO `if_menu_types` VALUES(2, 'hiddenmenu', 'Hidden Menu', 'Hidden Menu');

-- --------------------------------------------------------

--
-- Table structure for table `if_messages`
--

DROP TABLE IF EXISTS `if_messages`;
CREATE TABLE `if_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `if_messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_messages_cfg`
--

DROP TABLE IF EXISTS `if_messages_cfg`;
CREATE TABLE `if_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `if_messages_cfg`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_modules`
--

DROP TABLE IF EXISTS `if_modules`;
CREATE TABLE `if_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) DEFAULT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `if_modules`
--

INSERT INTO `if_modules` VALUES(1, 'Main Menu', '', '', 1, 'position-7', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 1, '{"menutype":"mainmenu","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"_mm","window_open":"","layout":"_:default","moduleclass_sfx":"_menu","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*');
INSERT INTO `if_modules` VALUES(2, 'Login', '', '', 1, 'login', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '', 1, '*');
INSERT INTO `if_modules` VALUES(3, 'Popular Articles', '', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_popular', 3, 1, '{"count":"5","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*');
INSERT INTO `if_modules` VALUES(4, 'Recently Added Articles', '', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_latest', 3, 1, '{"count":"5","ordering":"c_dsc","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*');
INSERT INTO `if_modules` VALUES(8, 'Toolbar', '', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_toolbar', 3, 1, '', 1, '*');
INSERT INTO `if_modules` VALUES(9, 'Quick Icons', '', '', 1, 'icon', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_quickicon', 3, 1, '', 1, '*');
INSERT INTO `if_modules` VALUES(10, 'Logged-in Users', '', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_logged', 3, 1, '{"count":"5","name":"1","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*');
INSERT INTO `if_modules` VALUES(12, 'Admin Menu', '', '', 1, 'menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 3, 1, '{"layout":"","moduleclass_sfx":"","shownew":"1","showhelp":"1","cache":"0"}', 1, '*');
INSERT INTO `if_modules` VALUES(13, 'Admin Submenu', '', '', 1, 'submenu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_submenu', 3, 1, '', 1, '*');
INSERT INTO `if_modules` VALUES(14, 'User Status', '', '', 1, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_status', 3, 1, '', 1, '*');
INSERT INTO `if_modules` VALUES(15, 'Title', '', '', 1, 'title', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_title', 3, 1, '', 1, '*');
INSERT INTO `if_modules` VALUES(16, 'Login Form', '', '', 2, 'position-6', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '{"pretext":"","posttext":"","login":"","logout":"","greeting":"1","name":"0","usesecure":"0","layout":"_:default","moduleclass_sfx":"","cache":"0"}', 0, '*');
INSERT INTO `if_modules` VALUES(17, 'Breadcrumbs', '', '', 1, 'position-2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_breadcrumbs', 1, 1, '{"moduleclass_sfx":"","showHome":"1","homeText":"Home","showComponent":"1","separator":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*');
INSERT INTO `if_modules` VALUES(18, 'Book Store', '', '', 1, 'position-10', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', -2, 'mod_banners', 1, 0, '{"target":"1","count":"1","cid":"3","catid":[""],"tag_search":"0","ordering":"0","header_text":"","footer_text":"Books!","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900"}', 0, '*');
INSERT INTO `if_modules` VALUES(19, 'Contact', '', '', 1, 'position-4', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_contact', 1, 1, '{"contact_id":"1","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900"}', 0, '*');
INSERT INTO `if_modules` VALUES(20, 'Shop Packages', '', '', 1, 'position-5', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_shop_packages', 1, 1, '{"moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*');
INSERT INTO `if_modules` VALUES(21, 'Search', '', '', 1, 'position-6', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_search', 1, 1, '{"label":"","width":"20","text":"t\\u00ecm ph\\u00f4ng","button":"","button_pos":"right","imagebutton":"","button_text":"","opensearch":"1","opensearch_title":"","set_itemid":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*');
INSERT INTO `if_modules` VALUES(22, 'Shop Cart', '', '', 0, NULL, 42, '2011-11-17 08:37:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_shop_cart', 1, 1, '', 0, '*');

-- --------------------------------------------------------

--
-- Table structure for table `if_modules_menu`
--

DROP TABLE IF EXISTS `if_modules_menu`;
CREATE TABLE `if_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `if_modules_menu`
--

INSERT INTO `if_modules_menu` VALUES(1, 0);
INSERT INTO `if_modules_menu` VALUES(2, 0);
INSERT INTO `if_modules_menu` VALUES(3, 0);
INSERT INTO `if_modules_menu` VALUES(4, 0);
INSERT INTO `if_modules_menu` VALUES(6, 0);
INSERT INTO `if_modules_menu` VALUES(7, 0);
INSERT INTO `if_modules_menu` VALUES(8, 0);
INSERT INTO `if_modules_menu` VALUES(9, 0);
INSERT INTO `if_modules_menu` VALUES(10, 0);
INSERT INTO `if_modules_menu` VALUES(12, 0);
INSERT INTO `if_modules_menu` VALUES(13, 0);
INSERT INTO `if_modules_menu` VALUES(14, 0);
INSERT INTO `if_modules_menu` VALUES(15, 0);
INSERT INTO `if_modules_menu` VALUES(16, 0);
INSERT INTO `if_modules_menu` VALUES(17, 0);
INSERT INTO `if_modules_menu` VALUES(18, 0);
INSERT INTO `if_modules_menu` VALUES(19, 0);
INSERT INTO `if_modules_menu` VALUES(20, 101);
INSERT INTO `if_modules_menu` VALUES(21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `if_newsfeeds`
--

DROP TABLE IF EXISTS `if_newsfeeds`;
CREATE TABLE `if_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `alias` varchar(100) NOT NULL DEFAULT '',
  `link` varchar(200) NOT NULL DEFAULT '',
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(10) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(10) unsigned NOT NULL DEFAULT '3600',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `if_newsfeeds`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_redirect_links`
--

DROP TABLE IF EXISTS `if_redirect_links`;
CREATE TABLE `if_redirect_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `old_url` varchar(150) NOT NULL,
  `new_url` varchar(150) NOT NULL,
  `referer` varchar(150) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_link_old` (`old_url`),
  KEY `idx_link_modifed` (`modified_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `if_redirect_links`
--

INSERT INTO `if_redirect_links` VALUES(1, 'http://ifont.local/index.php/gii-thiu/Shop', '', 'http://ifont.local/index.php/embedding', '', 0, '2011-11-02 00:51:31', '0000-00-00 00:00:00');
INSERT INTO `if_redirect_links` VALUES(2, 'http://ifont.local/index.php/gii-thiu', '', 'http://ifont.local/', '', 0, '2011-11-02 00:55:45', '0000-00-00 00:00:00');
INSERT INTO `if_redirect_links` VALUES(3, 'http://ifont.local/index.php/index.php', '', 'http://ifont.local/index.php/register', '', 0, '2011-11-07 02:59:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `if_schemas`
--

DROP TABLE IF EXISTS `if_schemas`;
CREATE TABLE `if_schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) NOT NULL,
  PRIMARY KEY (`extension_id`,`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `if_schemas`
--

INSERT INTO `if_schemas` VALUES(700, '1.7.0-2011-06-06-2');

-- --------------------------------------------------------

--
-- Table structure for table `if_session`
--

DROP TABLE IF EXISTS `if_session`;
CREATE TABLE `if_session` (
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `guest` tinyint(4) unsigned DEFAULT '1',
  `time` varchar(14) DEFAULT '',
  `data` varchar(20480) DEFAULT NULL,
  `userid` int(11) DEFAULT '0',
  `username` varchar(150) DEFAULT '',
  `usertype` varchar(50) DEFAULT '',
  PRIMARY KEY (`session_id`),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `if_session`
--

INSERT INTO `if_session` VALUES('239cdd18a867e93ce3379cfaa3c0d09f', 0, 1, '1322834908', '__default|a:8:{s:15:"session.counter";i:9;s:19:"session.timer.start";i:1322834837;s:18:"session.timer.last";i:1322834905;s:17:"session.timer.now";i:1322834906;s:22:"session.client.browser";s:107:"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.91 Safari/534.30";s:8:"registry";O:9:"JRegistry":1:{s:7:"\0*\0data";O:8:"stdClass":0:{}}s:4:"user";O:5:"JUser":23:{s:9:"\0*\0isRoot";b:0;s:2:"id";i:0;s:4:"name";N;s:8:"username";N;s:5:"email";N;s:8:"password";N;s:14:"password_clear";s:0:"";s:8:"usertype";N;s:5:"block";N;s:9:"sendEmail";i:0;s:12:"registerDate";N;s:13:"lastvisitDate";N;s:10:"activation";N;s:6:"params";N;s:6:"groups";a:0:{}s:5:"guest";i:1;s:10:"\0*\0_params";O:9:"JRegistry":1:{s:7:"\0*\0data";O:8:"stdClass":0:{}}s:14:"\0*\0_authGroups";a:1:{i:0;i:1;}s:14:"\0*\0_authLevels";a:2:{i:0;i:1;i:1;i:1;}s:15:"\0*\0_authActions";N;s:12:"\0*\0_errorMsg";N;s:10:"\0*\0_errors";a:0:{}s:3:"aid";i:0;}s:13:"session.token";s:32:"2603ac76e2c59888de356eb8050faed3";}', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `if_shop_font`
--

DROP TABLE IF EXISTS `if_shop_font`;
CREATE TABLE `if_shop_font` (
  `font_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `alias` varchar(150) NOT NULL DEFAULT '',
  `description` varchar(1024) NOT NULL DEFAULT '',
  `price` double NOT NULL DEFAULT '0',
  `package_id` int(10) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `ordering` int(3) NOT NULL DEFAULT '0',
  `file_path` varchar(250) NOT NULL DEFAULT '',
  `thumb` varchar(250) NOT NULL DEFAULT '',
  `order_times` int(10) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) NOT NULL,
  `created_by_alias` varchar(150) NOT NULL DEFAULT '',
  `modified_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`font_id`),
  UNIQUE KEY `font_id` (`font_id`),
  KEY `FK_sf_sp_package_id` (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `if_shop_font`
--

INSERT INTO `if_shop_font` VALUES(10, 'Helvetica Ultra Light Extended', 'helvetica-ultralight-extended', '<p>Helvetica Ultra Light Extended</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-ultltex.ttf', '', 4, '2011-11-25 02:23:33', '0000-00-00 00:00:00', 42, '', 0);
INSERT INTO `if_shop_font` VALUES(15, 'EurostileLTStd', 'eurostileltstd', '<p>abc</p>', 100000, 4, 0, 0, 'images/fonts/EurostileLTStd/eurostileltstd.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(16, 'Helvetica Ultra Light Extended Oblique', 'helvetica-ultralight-ex-ob', '', 70000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-ultltexo.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(17, 'Helvetica Extra Black Condensed', 'helvetica-extra-black-condensed', '', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-xblkcn.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(18, 'Helvetica Extra Black Condensed Oblique', 'helvetica-exblkcnob', '', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-xblkcno.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(19, 'Helvetica Ultra Light Extended', 'helvetica-ultra-light-extended', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-ultltex.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(20, 'Helvetica Ultra Light Condensed Oblique', 'helvetica-ultra-light-condensed-oblique', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-ultltcno.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(21, 'Helvetica Ultra Light Condensed', 'helvetica-ultra-light-condensed-oblique', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-ultltcn.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(22, 'Helvetica Ultra Light', 'helvetica-ultra-light', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-ultlt.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(23, 'Helvetica Thin Italic', 'helvetica-thin-italic', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-thit.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(24, 'Helvetica Thin Extended Oblique', 'helvetica-thin-extended-oblique', '<p>abv</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-thexo.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(25, 'Helvetica Thin Extended', 'helvetica-thin-extended', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-thex.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(26, 'Helvetica Thin Condensed Oblique', 'helvetica-thin-condensed-oblique', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-thcno.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(27, 'Helvetica Thin Condensed ', 'helvetica-thin-condensed', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-thcn.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(28, 'Helvetica Thin', 'helvetica-thin', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-th.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(29, 'Helvetica Roman', 'helvetica-roman', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-roman.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(30, 'Helvetica Medium Italic', 'helvetica-medium-italic', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-mdit.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(31, 'Helvetica Medium', 'helvetica-medium', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-md.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(32, 'Helvetica Light Italic', 'helvetica-light-italic', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-ltit.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(33, 'Helvetica Light', 'helvetica-light', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-lt.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(34, 'Helvetica Light Condensed Oblique', 'helvetica-light-condensed-oblique', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-ltcno.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(35, 'Helvetica Light Condensed', 'helvetica-light-condensed', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-ltcn.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(36, 'Helvetica Italic', 'helvetica-italic', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-it.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(37, 'Helvetica Heavy', 'helvetica-heavy', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-hv.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(38, 'Helvetica Extended Oblique', 'helvetica-extended-oblique', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-exo.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(39, 'Helvetica Extended', 'helvetica-extended', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-ex.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(40, 'Helvetica Condensed Oblique', 'helvetica-condensed-oblique', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-cno.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(41, 'Helvetica Condensed', 'helvetica-condensed', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-cn.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(42, 'Helvetica Black Italic', 'helvetica-black-italic', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-blkit.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(43, 'Helvetica Black', 'helvetica-black', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-blk.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(44, 'Helvetica Black Condensed Oblique', 'helvetica-black-condensed-oblique', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-blkcno.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(45, 'Helvetica Black Condensed', 'helvetica-black-condensed', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-blkcn.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(46, 'Helvetica Bold Extended Oblique', 'helvetica-bold-extended-oblique', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-bdexo.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(47, 'Helvetica Bold Extended', 'helvetica-bold-extended', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-bdex.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(48, 'Helvetica Bold Condensed Oblique', 'helvetica-bold-condensed-oblique', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-bdcno.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(49, 'Helvetica Bold Condensed', 'helvetica-bold-condensed', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-bdcn.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(50, 'Helvetica Bold Italic', 'helvetica-bold-italic', '<p>abc</p>', 80000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-bdit.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(51, 'Helvetica Bold', 'helvetica-bold', '<p>abc</p>', 100000, 3, 0, 0, 'images/fonts/Helvetica_neue/helveticaidesignvn-bd.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(52, 'Eurostile LT Std Oblique', 'eurostileltstd-oblique', '<p>abc</p>', 80000, 4, 0, 0, 'images/fonts/EurostileLTStd/eurostileltstd-oblique.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(53, 'Eurostile LT Std Demi', 'eurostileltstd-demi', '<p>abc</p>', 100000, 4, 0, 0, 'images/fonts/EurostileLTStd/eurostileltstd-demi.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(54, 'Eurostile LT Std Demi Oblique', 'eurostileltstd-demi-oblique', '<p>abc</p>', 80000, 4, 0, 0, 'images/fonts/EurostileLTStd/eurostileltstd-demioblique.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(55, 'Eurostile LT Std Bold Oblique', 'eurostileltstd-bold-oblique', '<p>abc</p>', 80000, 4, 0, 0, 'images/fonts/EurostileLTStd/eurostileltstd-boldoblique.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(56, 'EurostileLTStd Bold', 'eurostileltstd-bold', '<p>abc</p>', 100000, 4, 0, 0, 'images/fonts/EurostileLTStd/eurostileltstd-bold.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(57, 'Eurostile LT Std Condensed', 'eurostileltstd-condensed', '<p>abc</p>', 100000, 4, 0, 0, 'images/fonts/EurostileLTStd/eurostileltstd-cn.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(58, 'Narziss Drops', 'narziss-drops', '<p>abc</p>', 150000, 2, 0, 0, 'images/fonts/Narziss/narziss-drops.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(59, 'Narziss Regular', 'narziss-regular', '<p>abc</p>', 150000, 2, 0, 0, 'images/fonts/Narziss/narziss-regular.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(60, 'Narziss Swirls', 'narziss-swirls', '<p>abc</p>', 150000, 2, 0, 0, 'images/fonts/Narziss/narziss-swirls.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);
INSERT INTO `if_shop_font` VALUES(61, 'NarzissText Medium Drops', 'narzisstext-medium-drops', '<p>bac</p>', 150000, 2, 0, 0, 'images/fonts/Narziss/narzisstext-medium-drops.ttf', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `if_shop_order`
--

DROP TABLE IF EXISTS `if_shop_order`;
CREATE TABLE `if_shop_order` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `FK_ifso_user_created_by` (`created_by`),
  KEY `FK_ifso_user_modified_by` (`modified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `if_shop_order`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_shop_order_history`
--

DROP TABLE IF EXISTS `if_shop_order_history`;
CREATE TABLE `if_shop_order_history` (
  `order_history_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `comment` varchar(1024) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) NOT NULL,
  PRIMARY KEY (`order_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `if_shop_order_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_shop_order_item`
--

DROP TABLE IF EXISTS `if_shop_order_item`;
CREATE TABLE `if_shop_order_item` (
  `order_item_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL,
  `font_id` int(10) DEFAULT NULL,
  `package_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `FK_sod_so_order_id` (`order_id`),
  KEY `FK_soi_sp_package_id` (`package_id`),
  KEY `FK_if_sod_sf_font_id` (`font_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `if_shop_order_item`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_shop_package`
--

DROP TABLE IF EXISTS `if_shop_package`;
CREATE TABLE `if_shop_package` (
  `package_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `alias` varchar(150) NOT NULL DEFAULT '',
  `description` varchar(1024) NOT NULL DEFAULT '',
  `price` double NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `thumb` varchar(150) NOT NULL DEFAULT '',
  `is_vietnamese` tinyint(1) NOT NULL DEFAULT '0',
  `is_mac` tinyint(1) NOT NULL DEFAULT '0',
  `is_windows` tinyint(1) NOT NULL DEFAULT '0',
  `order_times` int(10) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) NOT NULL,
  `modified_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`package_id`),
  KEY `FK_sp_user_created_by` (`created_by`),
  KEY `FK_sp_user_modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `if_shop_package`
--

INSERT INTO `if_shop_package` VALUES(2, 'Narziss', 'narziss', '<p>Được thiết kế bởi Hubert Jocham năm 2009. Narziss có sự tương phản lớn trong phong cách tân cổ điển, hoàn hảo với các đường nét uốn lượng. Ngay cả với những chữ hoa, Narziss nhìn vẫn vô cùng thanh lịch trong các tiêu đề kích cỡ lớn.</p>', 350000, 1, 'images/fonts/1.jpg', 0, 1, 1, 15, '2011-11-15 16:35:36', '0000-00-00 00:00:00', 42, NULL);
INSERT INTO `if_shop_package` VALUES(3, 'Helvetica', 'helvetica', '<p><strong><img border="0" /></strong></p>\r\n<p><strong><img border="0" /></strong></p>\r\n<p><strong><img src="images/fonts/Helvetica_neue/helvetica_is_art__by_rodoabad.jpg" border="0" width="500" /></strong></p>\r\n<p><strong>"Khi không biết dùng font chữ gì, hãy chọn Helvetica"</strong> - Là một câu nói nổi tiếng về Helvetica, và vẫn đúng đắn cho tới bây giờ. </p>\r\n<p>Helvetica đã được phát triển vào năm 1957 bởi Max Miedinger và Eduard Hoffmann tại Haas''sche Schriftgiesserei (Xưởng đúc chữ của Haas) Münchenstein , Thụy Sĩ . Haas đặt ra để thiết kế một kiểu chữ sans-serif mới có thể cạnh tranh với thành công của Akzidenz Grotesk tại thị trường Thụy Sĩ. </p>\r\n<p>Ban đầu gọi là Neue Haas Grotesk, thiết kế của nó được dựa trên Schelter-Grotesk và Haas'' Normal Grotesk. Mục đích của thiết kế mới là tạo ra một kiểu chữ trung lập mà rõ ràng, không có ý nghĩa nội tại trong hình thức của nó, và có thể được sử dụng trên các biển báo.</p>', 2500000, 1, 'images/fonts/1.jpg', 1, 1, 1, 20, '2011-11-12 16:35:36', '0000-00-00 00:00:00', 42, NULL);
INSERT INTO `if_shop_package` VALUES(4, 'Eurostile LT Std', 'eurostileltstd', '<p>Eurostile là một trong những thiết kế quan trọng nhất của nhà ​​thiết kế phông chữ người Ý, Aldo Novarese. Ban đầu nó được sản xuất vào năm 1962 tại xưởng đúc Nebiolo như một phiên bản hoàn chỉnh của phông Microgramma trước đó, một phông chữ được thiết kế toàn chữ hoa bởi Novarese và A. Butti.</p>\r\n<p>Eurostile phản ánh hương vị và tinh thần của những năm 1950 và 1960. Nó lớn, hình dạng vuông vắn với các góc được làm tròn như các màn hình tivi thời kỳ đó. Eurostile duy trì khả năng cung cấp sự năng động và công nghệ. Nó tốt cho tiêu đề và các nội dung nhỏ.</p>', 400000, 1, '', 1, 1, 1, 0, '2011-11-30 04:17:19', '0000-00-00 00:00:00', 42, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `if_shop_package_type`
--

DROP TABLE IF EXISTS `if_shop_package_type`;
CREATE TABLE `if_shop_package_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `package_id` int(10) NOT NULL,
  `type_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=82 ;

--
-- Dumping data for table `if_shop_package_type`
--

INSERT INTO `if_shop_package_type` VALUES(68, 3, 2);
INSERT INTO `if_shop_package_type` VALUES(69, 3, 3);
INSERT INTO `if_shop_package_type` VALUES(79, 4, 3);
INSERT INTO `if_shop_package_type` VALUES(80, 2, 6);
INSERT INTO `if_shop_package_type` VALUES(81, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `if_shop_type`
--

DROP TABLE IF EXISTS `if_shop_type`;
CREATE TABLE `if_shop_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` varchar(250) NOT NULL,
  `ordering` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=8 ;

--
-- Dumping data for table `if_shop_type`
--

INSERT INTO `if_shop_type` VALUES(1, 'Có chân', '<p>Kiểu chữ có chân</p>', 0);
INSERT INTO `if_shop_type` VALUES(2, 'Hiện đại', '<p>Kiểu chữ hiện đại</p>', 0);
INSERT INTO `if_shop_type` VALUES(3, 'Không chân', '<p>Kiểu chữ không chân</p>', 0);
INSERT INTO `if_shop_type` VALUES(4, 'Chuyển tiếp', '<p>Kiểu chữ chuyển tiếp</p>', 0);
INSERT INTO `if_shop_type` VALUES(5, 'Cổ điển', '<p>Kiểu chữ cổ điển</p>', 0);
INSERT INTO `if_shop_type` VALUES(6, 'Trang trí', '', 0);
INSERT INTO `if_shop_type` VALUES(7, 'Viết tay', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `if_template_styles`
--

DROP TABLE IF EXISTS `if_template_styles`;
CREATE TABLE `if_template_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(50) NOT NULL DEFAULT '',
  `client_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `home` char(7) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_template` (`template`),
  KEY `idx_home` (`home`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `if_template_styles`
--

INSERT INTO `if_template_styles` VALUES(2, 'bluestork', 1, '1', 'Bluestork - Default', '{"useRoundedCorners":"1","showSiteName":"0"}');
INSERT INTO `if_template_styles` VALUES(3, 'atomic', 0, '0', 'Atomic - Default', '{}');
INSERT INTO `if_template_styles` VALUES(4, 'beez_20', 0, '0', 'Beez2 - Default', '{"wrapperSmall":"53","wrapperLarge":"72","logo":"images\\/joomla_black.gif","sitetitle":"Joomla!","sitedescription":"Open Source Content Management","navposition":"left","templatecolor":"personal","html5":"0"}');
INSERT INTO `if_template_styles` VALUES(5, 'hathor', 1, '0', 'Hathor - Default', '{"showSiteName":"0","colourChoice":"","boldText":"0"}');
INSERT INTO `if_template_styles` VALUES(6, 'beez5', 0, '0', 'Beez5 - Default-Fruit Shop', '{"wrapperSmall":"53","wrapperLarge":"72","logo":"images\\/sampledata\\/fruitshop\\/fruits.gif","sitetitle":"Matuna Market ","sitedescription":"Fruit Shop Sample Site","navposition":"left","html5":"0"}');
INSERT INTO `if_template_styles` VALUES(7, 'site', 0, '1', 'site - Default', '{"wrapperSmall":"53","wrapperLarge":"72","sitetitle":"","sitedescription":"","navposition":"center","html5":"0"}');

-- --------------------------------------------------------

--
-- Table structure for table `if_updates`
--

DROP TABLE IF EXISTS `if_updates`;
CREATE TABLE `if_updates` (
  `update_id` int(11) NOT NULL AUTO_INCREMENT,
  `update_site_id` int(11) DEFAULT '0',
  `extension_id` int(11) DEFAULT '0',
  `categoryid` int(11) DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `description` text NOT NULL,
  `element` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `folder` varchar(20) DEFAULT '',
  `client_id` tinyint(3) DEFAULT '0',
  `version` varchar(10) DEFAULT '',
  `data` text NOT NULL,
  `detailsurl` text NOT NULL,
  PRIMARY KEY (`update_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Available Updates' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `if_updates`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_update_categories`
--

DROP TABLE IF EXISTS `if_update_categories`;
CREATE TABLE `if_update_categories` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '',
  `description` text NOT NULL,
  `parent` int(11) DEFAULT '0',
  `updatesite` int(11) DEFAULT '0',
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Update Categories' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `if_update_categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_update_sites`
--

DROP TABLE IF EXISTS `if_update_sites`;
CREATE TABLE `if_update_sites` (
  `update_site_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `location` text NOT NULL,
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`update_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Update Sites' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `if_update_sites`
--

INSERT INTO `if_update_sites` VALUES(1, 'Joomla Core', 'collection', 'http://update.joomla.org/core/list.xml', 1);
INSERT INTO `if_update_sites` VALUES(2, 'Joomla Extension Directory', 'collection', 'http://update.joomla.org/jed/list.xml', 1);

-- --------------------------------------------------------

--
-- Table structure for table `if_update_sites_extensions`
--

DROP TABLE IF EXISTS `if_update_sites_extensions`;
CREATE TABLE `if_update_sites_extensions` (
  `update_site_id` int(11) NOT NULL DEFAULT '0',
  `extension_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`update_site_id`,`extension_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Links extensions to update sites';

--
-- Dumping data for table `if_update_sites_extensions`
--

INSERT INTO `if_update_sites_extensions` VALUES(1, 700);
INSERT INTO `if_update_sites_extensions` VALUES(2, 700);

-- --------------------------------------------------------

--
-- Table structure for table `if_usergroups`
--

DROP TABLE IF EXISTS `if_usergroups`;
CREATE TABLE `if_usergroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Adjacency List Reference Id',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `title` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_usergroup_parent_title_lookup` (`parent_id`,`title`),
  KEY `idx_usergroup_title_lookup` (`title`),
  KEY `idx_usergroup_adjacency_lookup` (`parent_id`),
  KEY `idx_usergroup_nested_set_lookup` (`lft`,`rgt`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `if_usergroups`
--

INSERT INTO `if_usergroups` VALUES(1, 0, 1, 20, 'Public');
INSERT INTO `if_usergroups` VALUES(2, 1, 6, 17, 'Registered');
INSERT INTO `if_usergroups` VALUES(3, 2, 7, 14, 'Author');
INSERT INTO `if_usergroups` VALUES(4, 3, 8, 11, 'Editor');
INSERT INTO `if_usergroups` VALUES(5, 4, 9, 10, 'Publisher');
INSERT INTO `if_usergroups` VALUES(6, 1, 2, 5, 'Manager');
INSERT INTO `if_usergroups` VALUES(7, 6, 3, 4, 'Administrator');
INSERT INTO `if_usergroups` VALUES(8, 1, 18, 19, 'Super Users');

-- --------------------------------------------------------

--
-- Table structure for table `if_users`
--

DROP TABLE IF EXISTS `if_users`;
CREATE TABLE `if_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `idx_block` (`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `if_users`
--

INSERT INTO `if_users` VALUES(42, 'Super User', 'ifont_admin', 'duongthienduc@yahoo.com', '8537efa817c26b08e7036e622f65bb0b:aawuHgEyjDGaNgMLCgMsREQdFFKpJ589', 'deprecated', 0, 1, '2011-08-29 14:48:39', '2011-12-02 10:28:11', '', '');
INSERT INTO `if_users` VALUES(46, 'duc@yahoo.com', 'duc@yahoo.com', 'duc@yahoo.com', '164ce9a69a2c91366771bfc5dbc0546a:mTFJrbhVNRhYJEbVuSeSSds5c4Xmk2Tw', '', 0, 1, '2011-11-16 18:01:09', '2011-11-25 10:40:47', '', '{}');
INSERT INTO `if_users` VALUES(47, 'duc1@yahoo.com', 'duc1@yahoo.com', 'duc1@yahoo.com', '6e34a6844498814a069c95956568076b:qulMTOVskkN6W7OM6QIdWrCRZdZW7x8L', '', 1, 0, '2011-11-20 08:46:45', '0000-00-00 00:00:00', '2413c69c16aebabf9b3f4781ff2184da', '{}');
INSERT INTO `if_users` VALUES(48, 'duongthienduc@gmail.com', 'duongthienduc@gmail.com', 'duongthienduc@gmail.com', '9c9d4f0ed21722611b66519e23c31fbe:3upGuMsrpVGcVRETm9N4gAYKc7KbhTOx', '', 0, 0, '2011-11-20 08:47:24', '2011-11-20 09:11:23', '', '{}');
INSERT INTO `if_users` VALUES(49, 'jahid_bas@yahoo.com', 'jahid_bas@yahoo.com', 'jahid_bas@yahoo.com', '9ada750d6b76ffe57dc6a2556c8b54f1:IXejvefXTSGHQLJIomZIUWJtvzkGQ9XI', '', 1, 0, '2011-11-29 04:44:45', '0000-00-00 00:00:00', '4a4bc4bab3ebc61a9f2079759ac023b6', '{}');

-- --------------------------------------------------------

--
-- Table structure for table `if_user_profiles`
--

DROP TABLE IF EXISTS `if_user_profiles`;
CREATE TABLE `if_user_profiles` (
  `user_id` int(11) NOT NULL,
  `profile_key` varchar(100) NOT NULL,
  `profile_value` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `idx_user_id_profile_key` (`user_id`,`profile_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Simple user profile storage table';

--
-- Dumping data for table `if_user_profiles`
--


-- --------------------------------------------------------

--
-- Table structure for table `if_user_usergroup_map`
--

DROP TABLE IF EXISTS `if_user_usergroup_map`;
CREATE TABLE `if_user_usergroup_map` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__users.id',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__usergroups.id',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `if_user_usergroup_map`
--

INSERT INTO `if_user_usergroup_map` VALUES(42, 8);
INSERT INTO `if_user_usergroup_map` VALUES(43, 2);
INSERT INTO `if_user_usergroup_map` VALUES(44, 2);
INSERT INTO `if_user_usergroup_map` VALUES(45, 2);
INSERT INTO `if_user_usergroup_map` VALUES(46, 2);
INSERT INTO `if_user_usergroup_map` VALUES(47, 2);
INSERT INTO `if_user_usergroup_map` VALUES(48, 2);
INSERT INTO `if_user_usergroup_map` VALUES(49, 2);

-- --------------------------------------------------------

--
-- Table structure for table `if_viewlevels`
--

DROP TABLE IF EXISTS `if_viewlevels`;
CREATE TABLE `if_viewlevels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(100) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_assetgroup_title_lookup` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `if_viewlevels`
--

INSERT INTO `if_viewlevels` VALUES(1, 'Public', 0, '[1]');
INSERT INTO `if_viewlevels` VALUES(2, 'Registered', 1, '[6,2,8]');
INSERT INTO `if_viewlevels` VALUES(3, 'Special', 2, '[6,3,8]');

-- --------------------------------------------------------

--
-- Table structure for table `if_weblinks`
--

DROP TABLE IF EXISTS `if_weblinks`;
CREATE TABLE `if_weblinks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `access` int(11) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `language` char(7) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if link is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `if_weblinks`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `if_shop_font`
--
ALTER TABLE `if_shop_font`
  ADD CONSTRAINT `FK_sf_sp_package_id` FOREIGN KEY (`package_id`) REFERENCES `if_shop_package` (`package_id`);

--
-- Constraints for table `if_shop_order`
--
ALTER TABLE `if_shop_order`
  ADD CONSTRAINT `FK_ifso_user_created_by` FOREIGN KEY (`created_by`) REFERENCES `if_users` (`id`),
  ADD CONSTRAINT `FK_ifso_user_modified_by` FOREIGN KEY (`modified_by`) REFERENCES `if_users` (`id`);

--
-- Constraints for table `if_shop_order_item`
--
ALTER TABLE `if_shop_order_item`
  ADD CONSTRAINT `FK_if_sod_sf_font_id` FOREIGN KEY (`font_id`) REFERENCES `if_shop_font` (`font_id`),
  ADD CONSTRAINT `FK_sod_so_order_id` FOREIGN KEY (`order_id`) REFERENCES `if_shop_order` (`order_id`),
  ADD CONSTRAINT `FK_soi_sp_package_id` FOREIGN KEY (`package_id`) REFERENCES `if_shop_package` (`package_id`);

--
-- Constraints for table `if_shop_package`
--
ALTER TABLE `if_shop_package`
  ADD CONSTRAINT `FK_sp_user_created_by` FOREIGN KEY (`created_by`) REFERENCES `if_users` (`id`),
  ADD CONSTRAINT `FK_sp_user_modified_by` FOREIGN KEY (`modified_by`) REFERENCES `if_users` (`id`);

SET FOREIGN_KEY_CHECKS=1;
