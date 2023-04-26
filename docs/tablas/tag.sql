CREATE TABLE `tags` ( 
  `id` INT AUTO_INCREMENT NULL,
  `name` VARCHAR(50) NOT NULL,
  `description` VARCHAR(250) NOT NULL,
   PRIMARY KEY (`id`)
);

CREATE TABLE `customer_tag` ( 
  `customer_id` INT NOT NULL,
  `tag_id` INT NOT NULL
);

