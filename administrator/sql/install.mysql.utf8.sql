DROP TABLE IF EXISTS `#__ccgslider_slider`;

CREATE TABLE IF NOT EXISTS `#__ccgslider_slider` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`title` VARCHAR(255)  NOT NULL ,
`file` VARCHAR(255)  NOT NULL ,
`description` TEXT NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `#__ccgslider_slider_mapping`;

CREATE TABLE IF NOT EXISTS `#__ccgslider_slider_mapping` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`sliderid` INT(11) NOT NULL,
`file` VARCHAR(255)  NOT NULL ,
`params` TEXT,
FOREIGN KEY (`sliderid`) REFERENCES `#__ccgslider_slider` (`id`)
ON UPDATE CASCADE
ON DELETE CASCADE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
