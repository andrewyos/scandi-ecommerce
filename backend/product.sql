-- Adminer 4.8.1 MySQL 8.0.26 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;


DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id_product` int NOT NULL AUTO_INCREMENT,
  `sku` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int NOT NULL,
  `type` enum('dvd','book','furniture') NOT NULL,
  `value` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
USE `product`;

INSERT INTO `product` (`id_product`, `sku`, `name`, `price`, `type`, `value`) VALUES
(17,	'PR452301638961941',	'Harry potta',	300,	'book',	'30 KG'),
(18,	'PR619061638961998',	'Ikea Bekant',	500,	'furniture',	'100 CM x 175 CM x 70 CM'),
(19,	'PR3122491638962046',	'Marvel The Captain',	1200,	'dvd',	'300 MB')
ON DUPLICATE KEY UPDATE `id_product` = VALUES(`id_product`), `sku` = VALUES(`sku`), `name` = VALUES(`name`), `price` = VALUES(`price`), `type` = VALUES(`type`), `value` = VALUES(`value`);

-- 2021-12-08 11:14:48
