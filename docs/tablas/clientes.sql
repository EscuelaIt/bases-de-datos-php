CREATE TABLE `customers` ( 
  `id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  CONSTRAINT `PRIMARY` PRIMARY KEY (`id`)
);
