DROP TABLE IF EXISTS `#__xcal_category`;
DROP TABLE IF EXISTS `#__xcal_events`;
DROP TABLE IF EXISTS `#__xcal_registration`;
DROP TABLE IF EXISTS `#__xcal_location`;

CREATE TABLE `#__xcal_category` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`title` VARCHAR(255)  NOT NULL ,
`alias` VARCHAR( 255 ) NOT NULL ,
`color` VARCHAR(255)  NOT NULL ,
`desc` TEXT(65535)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE `#__xcal_events` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`title` VARCHAR(255)  NOT NULL ,
`alias` VARCHAR( 255 ) NOT NULL ,
`username` VARCHAR(255)  NOT NULL ,
`email` VARCHAR(255)  NOT NULL ,
`catid` INT(11)  NOT NULL ,
`image` VARCHAR(255)  NOT NULL ,
`file` VARCHAR(255)  NOT NULL ,
`dates` TEXT(65535)  NOT NULL ,
`next` DATE NOT NULL ,
`time` VARCHAR(255)  NOT NULL ,
`location` INT(11)  NOT NULL ,
`coordinate` VARCHAR(255)  NOT NULL ,
`desc` TEXT(65535)  NOT NULL ,
`params` TEXT(65535)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE `#__xcal_registration` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`userid` INT(11)  NOT NULL ,
`eventid` INT(11)  NOT NULL ,
`name` VARCHAR(255)  NOT NULL ,
`email` VARCHAR(255)  NOT NULL ,
`phone` VARCHAR(255)  NOT NULL ,
`date` DATE NOT NULL ,
`people` INT(2)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE `#__xcal_location` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`name` VARCHAR( 255 ) NOT NULL ,
`city` VARCHAR( 255 ) NOT NULL ,
`address` VARCHAR( 255 ) NOT NULL ,
`coordinate` VARCHAR( 255 ) NOT NULL ,
`desc` TEXT NOT NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

