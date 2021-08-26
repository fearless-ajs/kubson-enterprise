
/**
 * Author:  Adurotimi Joshua
 * Created: 22-May-2019
 */

 CREATE TABLE IF NOT EXISTS `smartshop`.`customers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `lastname` VARCHAR(100) NOT NULL,
  `firstname` VARCHAR(100) NOT NULL,
  `othername` VARCHAR(100) NOT NULL,
  `age` VARCHAR(100) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `phone_number` VARCHAR(50) NOT NULL,
  `reg_date` VARCHAR(50) NOT NULL,
  `reg_time` VARCHAR(50) NOT NULL,
  `reg_day` VARCHAR(50) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `password` VARCHAR(500) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB;

 CREATE TABLE IF NOT EXISTS `smartshop`.`administrators` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `lastname` VARCHAR(100) NOT NULL,
  `firstname` VARCHAR(100) NOT NULL,
  `othername` VARCHAR(100) NOT NULL,
  `age` VARCHAR(100) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `phone_number` VARCHAR(50) NOT NULL,
  `reg_date` VARCHAR(50) NOT NULL,
  `reg_time` VARCHAR(50) NOT NULL,
  `reg_day` VARCHAR(50) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `password` VARCHAR(500) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB;

  CREATE TABLE IF NOT EXISTS `smartshop`.`items_image` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `item_name` VARCHAR(100) NOT NULL,
  `item_id` INT(11) NOT NULL,
  `item_new_price` VARCHAR(100) NOT NULL,
  `date_uploaded` VARCHAR(200) NOT NULL,
  `time_uploaded` VARCHAR(50) NOT NULL,
  `full_image` VARCHAR(50) NOT NULL,
  `left_side_image` VARCHAR(50) NOT NULL,
  `right_side_image` VARCHAR(50) NOT NULL,
  `Back_side_image` VARCHAR(255) NOT NULL,
  `address` VARCHAR(500) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB;

 CREATE TABLE IF NOT EXISTS `smartshop`.`men_wear` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `sub_category` VARCHAR(200) NOT NULL,
  `stock_date` VARCHAR(50) NOT NULL,
  `status` VARCHAR(50) NOT NULL,
  `date_released` VARCHAR(50) NOT NULL,
  `description` VARCHAR(50) NOT NULL,
  `last_order_date` VARCHAR(255) NOT NULL,
  `old_price` VARCHAR(500) NOT NULL,
  `new_price` VARCHAR(500) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB;

 CREATE TABLE IF NOT EXISTS `smartshop`.`women_wear` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `sub_category` VARCHAR(200) NOT NULL,
  `stock_date` VARCHAR(50) NOT NULL,
  `status` VARCHAR(50) NOT NULL,
  `date_released` VARCHAR(50) NOT NULL,
  `description` VARCHAR(50) NOT NULL,
  `last_order_date` VARCHAR(255) NOT NULL,
  `old_price` VARCHAR(500) NOT NULL,
  `new_price` VARCHAR(500) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB;

  CREATE TABLE IF NOT EXISTS `smartshop`.`electronics` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `sub_category` VARCHAR(200) NOT NULL,
  `stock_date` VARCHAR(50) NOT NULL,
  `status` VARCHAR(50) NOT NULL,
  `date_released` VARCHAR(50) NOT NULL,
  `description` VARCHAR(50) NOT NULL,
  `last_order_date` VARCHAR(255) NOT NULL,
  `old_price` VARCHAR(500) NOT NULL,
  `new_price` VARCHAR(500) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB;

  CREATE TABLE IF NOT EXISTS `smartshop`.`other_items` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `sub_category` VARCHAR(200) NOT NULL,
  `stock_date` VARCHAR(50) NOT NULL,
  `status` VARCHAR(50) NOT NULL,
  `date_released` VARCHAR(50) NOT NULL,
  `description` VARCHAR(50) NOT NULL,
  `last_order_date` VARCHAR(255) NOT NULL,
  `old_price` VARCHAR(500) NOT NULL,
  `new_price` VARCHAR(500) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB; 

 CREATE TABLE IF NOT EXISTS `smartshop`.`mail` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `sender_mail` VARCHAR(100) NOT NULL,
  `sender_fullname` VARCHAR(100) NOT NULL,
  `subject` VARCHAR(200) NOT NULL,
  `content` VARCHAR(50) NOT NULL,
  `date_recieved` VARCHAR(50) NOT NULL,
  `time_recieved` VARCHAR(50) NOT NULL,
  `status` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB;

 CREATE TABLE IF NOT EXISTS `smartshop`.`draft` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `composer_mail` VARCHAR(100) NOT NULL,
  `composer_fullname` VARCHAR(100) NOT NULL,
  `subject` VARCHAR(200) NOT NULL,
  `content` VARCHAR(50) NOT NULL,
  `date_composed` VARCHAR(50) NOT NULL,
  `time_composed` VARCHAR(50) NOT NULL,
  `status` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB;

 CREATE TABLE IF NOT EXISTS `smartshop`.`sent_mail` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `target_mail` VARCHAR(100) NOT NULL,
  `subject` VARCHAR(200) NOT NULL,
  `content` VARCHAR(50) NOT NULL,
  `date_sent` VARCHAR(50) NOT NULL,
  `time_sent` VARCHAR(50) NOT NULL,
  `status` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB;

  CREATE TABLE IF NOT EXISTS `smartshop`.`orders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `item_name` VARCHAR(100) NOT NULL,
  `item_id` VARCHAR(100) NOT NULL,
  `item_image` VARCHAR(100) NOT NULL,
  `date_ordered` VARCHAR(100) NOT NULL,
  `time_ordered` VARCHAR(100) NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `sub_category` VARCHAR(200) NOT NULL,
  `stock_date` VARCHAR(50) NOT NULL,
  `status` VARCHAR(50) NOT NULL,
  `date_released` VARCHAR(50) NOT NULL,
  `description` VARCHAR(50) NOT NULL,
  `old_price` VARCHAR(500) NOT NULL,
  `new_price` VARCHAR(500) NOT NULL,
  `customer_id` VARCHAR(100) NOT NULL,
  `cumstomer_mail` VARCHAR(100) NOT NULL,
  `customer_phone` VARCHAR(100) NOT NULL, 
  PRIMARY KEY(`id`)
) ENGINE = InnoDB; 