ALTER TABLE `#__xcal_events` ADD `alias` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `title`; 
ALTER TABLE `#__xcal_category` ADD `alias` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `title`;