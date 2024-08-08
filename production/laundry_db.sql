

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `inventory` (
  `id` int(30) NOT NULL,
  `supply_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `stock_type` tinyint(1) NOT NULL COMMENT '1= in , 2 = used',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `inventory` (`id`, `supply_id`, `qty`, `stock_type`, `date_created`) VALUES
(1, 1, 20, 1, '2020-09-23 14:08:04'),
(2, 2, 10, 1, '2020-09-23 14:08:14'),
(3, 3, 20, 1, '2020-09-23 14:09:29');


CREATE TABLE `laundry_categories` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `laundry_categories` (`id`, `name`, `price`) VALUES
(1, 'Bed Sheets', 30),
(3, 'Clothes', 25);


CREATE TABLE `laundry_items` (
  `id` int(30) NOT NULL,
  `laundry_category_id` int(30) NOT NULL,
  `weight` double NOT NULL,
  `laundry_id` int(30) NOT NULL,
  `unit_price` double NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `laundry_items` (`id`, `laundry_category_id`, `weight`, `laundry_id`, `unit_price`, `amount`) VALUES
(4, 3, 10, 4, 25, 250);



CREATE TABLE `laundry_list` (
  `id` int(30) NOT NULL,
  `customer_name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1 = ongoing,2= ready,3= claimed',
  `queue` int(30) NOT NULL,
  `total_amount` double NOT NULL,
  `pay_status` tinyint(1) DEFAULT 0,
  `amount_tendered` double NOT NULL,
  `amount_change` double NOT NULL,
  `remarks` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_id` int NOT NULL,
  `business_id` int NOT NULL,
  `created_by` int  NULL,
  `updated_by` int  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`),
    FOREIGN KEY (`business_id`) REFERENCES `businesses`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `phone`, `address`,`username`, `email`, `password`, `role_id`, `business_id`, `created_by`, `updated_by`) VALUES
(1, 'Admin', '0783021733', 'Entebbe', 'admin', 'admin@example.com' ,'admin21', 0, 1, 1, 1);


CREATE TABLE `businesses` (
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `name` varchar(200) NOT NULL,
   `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
    `address` varchar(100) NOT NULL,
  `created_by` int(100) NOT NULL,
  `updated_by` int(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
   FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `businesses` (`id`, `name`, `email`,`phone`, `address`,`created_by`, `updated_by`) VALUES
(1, 'Business1', 'business1@gmail.com','0783021733', 'Entebbe', 1, 1);




CREATE TABLE `roles` (
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `name` varchar(200) NOT NULL,
  `created_by` int(100) NOT NULL,
  `updated_by` int(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
   FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `roles` (`id`, `name`,`created_by`, `updated_by`) VALUES
(1, 'super_admin',  1, 1);


CREATE TABLE `suppliers` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`) VALUES
(1, 'vicent', 'vicent@example.com' , '0783021733', 'Entebbe');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
