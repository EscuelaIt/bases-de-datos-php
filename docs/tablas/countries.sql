CREATE TABLE `countries` ( 
  `id` INT AUTO_INCREMENT NULL,
  `name` VARCHAR(100) NOT NULL,
   PRIMARY KEY (`id`)
);
INSERT INTO `countries` (`name`) VALUES ('España');
INSERT INTO `countries` (`name`) VALUES ('Francia');
INSERT INTO `countries` (`name`) VALUES ('Portugal');
INSERT INTO `countries` (`name`) VALUES ('Italia');

ALTER TABLE `customers` ADD `country_id` INT NOT NULL DEFAULT 1 ;
