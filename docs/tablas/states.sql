CREATE TABLE `states` ( 
  `id` INT AUTO_INCREMENT NULL,
  `name` VARCHAR(100) NOT NULL,
  `country_id` INT NOT NULL,
   PRIMARY KEY (`id`)
);

ALTER TABLE `customers` ADD `state_id` INT NOT NULL DEFAULT 1 ;

INSERT INTO `states` (`name`, `country_id`) VALUES ('Madrid', 3);
INSERT INTO `states` (`name`, `country_id`) VALUES ('Algarve', 3);
INSERT INTO `states` (`name`, `country_id`) VALUES ('Porto', 3);
INSERT INTO `states` (`name`, `country_id`) VALUES ('Barcelona', 1);
INSERT INTO `states` (`name`, `country_id`) VALUES ('Valencia', 1);
INSERT INTO `states` (`name`, `country_id`) VALUES ('Bretaña', 2);
INSERT INTO `states` (`name`, `country_id`) VALUES ('Centre', 2);
INSERT INTO `states` (`name`, `country_id`) VALUES ('Lorena', 2);
INSERT INTO `states` (`name`, `country_id`) VALUES ('Milan', 4);
INSERT INTO `states` (`name`, `country_id`) VALUES ('Trentino', 4);
INSERT INTO `states` (`name`, `country_id`) VALUES ('Babiera', 5);

