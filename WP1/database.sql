﻿--
-- Script was generated by Devart dbForge Studio for MySQL, Version 7.4.201.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 12.06.2018 18:20:29
-- Server version: 5.7.20
-- Client version: 4.1
--

-- 
-- Disable foreign keys
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set SQL mode
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE burger;

--
-- Drop table `orders`
--
DROP TABLE IF EXISTS orders;

--
-- Drop table `customers`
--
DROP TABLE IF EXISTS customers;

--
-- Set default database
--
USE burger;

--
-- Create table `customers`
--
CREATE TABLE customers (
  id int(11) NOT NULL AUTO_INCREMENT,
  email varchar(50) NOT NULL,
  name varchar(50) NOT NULL,
  tel varchar(20) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 19,
AVG_ROW_LENGTH = 8192,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Create table `orders`
--
CREATE TABLE orders (
  id int(11) NOT NULL AUTO_INCREMENT,
  customer_id int(11) NOT NULL,
  street varchar(255) DEFAULT NULL,
  house varchar(10) DEFAULT NULL,
  corp varchar(10) DEFAULT NULL,
  appt int(11) DEFAULT NULL,
  floor int(11) DEFAULT NULL,
  payment varchar(10) DEFAULT NULL,
  callback tinyint(1) DEFAULT NULL,
  comment varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 89,
AVG_ROW_LENGTH = 5461,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Create foreign key
--
ALTER TABLE orders
ADD CONSTRAINT FK_order_customer_idd FOREIGN KEY (customer_id)
REFERENCES customers (id) ON DELETE NO ACTION;

-- 
-- Dumping data for table customers
--
INSERT INTO customers VALUES
(17, 'sheekanov@gmail.com', 'Евгений', '+7 (978) 999 99 99'),
(18, 'olga@gmail.com', 'Ольга', '+7 (978) 864 14 68');

-- 
-- Dumping data for table orders
--
INSERT INTO orders VALUES
(86, 17, 'Суворова', '99', '9', 99, 9, 'change', 1, 'А можно мне такой же, только с перламутровыми пуговицами?'),
(87, 18, 'Большая Морская', '2', '9', 56, 6, 'creditcard', 0, ''),
(88, 17, 'Ленина', '1', '1', 1, 1, 'creditcard', 1, 'Скорее, я голодный');

-- 
-- Restore previous SQL mode
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;