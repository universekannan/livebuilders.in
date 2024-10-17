CREATE TABLE `categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `category_name` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;


CREATE TABLE `categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `category_name` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

CREATE TABLE `banners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table `banners` ADD `description` varchar(200) DEFAULT NULL;
alter table `banners` ADD `banner_url` varchar(50) DEFAULT NULL;

CREATE TABLE `productorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `qity` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `aderss` varchar(500) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

ALTER TABLE `productorder` CHANGE `created_at` `created_at` DATE NULL DEFAULT NULL;


CREATE TABLE `productorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `subject` varchar(10) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `aderss` varchar(500) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

ALTER TABLE `website_contacts` CHANGE `name` `full_name` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `website_contacts` ADD `phone` VARCHAR(15) NULL DEFAULT NULL AFTER `email`;
ALTER TABLE `website_contacts` ADD `created_at` VARCHAR(50) NULL DEFAULT NULL AFTER `message`;
