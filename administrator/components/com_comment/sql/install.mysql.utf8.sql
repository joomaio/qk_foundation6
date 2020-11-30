DROP TABLE IF EXISTS `#__comments`;

CREATE TABLE `#__comments` (
	`id`       INT(11) NOT NULL AUTO_INCREMENT,
	`created_by` INT(11),
    `guest_name`   VARCHAR(255),
    `guest_email`   VARCHAR(255),
	`created_at` DATETIME NOT NULL,
	`published` tinyint(4) NOT NULL DEFAULT '1',
    `article_id`   INT(11) NOT NULL,
    `comment`   mediumtext NOT NULL,
	`modified_by` INT(11),
	`modified` DATETIME,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

