-- phpMyAdmin SQL Dump
-- version 3.3.7deb3build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2011 at 01:48 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `seo_blacklists`
--

CREATE TABLE IF NOT EXISTS `seo_blacklists` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_range_start` bigint(20) unsigned NOT NULL,
  `ip_range_end` bigint(20) unsigned NOT NULL,
  `note` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ip_range_start` (`ip_range_start`),
  KEY `ip_range_end` (`ip_range_end`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seo_meta_tags`
--

CREATE TABLE IF NOT EXISTS `seo_meta_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seo_uri_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `is_http_equiv` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seo_uri_id` (`seo_uri_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seo_redirects`
--

CREATE TABLE IF NOT EXISTS `seo_redirects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seo_uri_id` int(11) NOT NULL,
  `redirect` varchar(255) DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '100',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `callback` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seo_uri_id` (`seo_uri_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seo_titles`
--

CREATE TABLE IF NOT EXISTS `seo_titles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seo_uri_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seo_uri_id` (`seo_uri_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seo_uris`
--

CREATE TABLE IF NOT EXISTS `seo_uris` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uri` (`uri`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `seo_honeypot_visits`
--

CREATE TABLE IF NOT EXISTS `seo_honeypot_visits` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` bigint(20) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
