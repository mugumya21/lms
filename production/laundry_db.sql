

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


CREATE TABLE `laundry_categories` (
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `name` varchar(200) NOT NULL,
  `price_per_kg` double NOT NULL,
  `created_by` int(100)  NULL,
  `updated_by` int(100)  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `business_id`int(100)  NOT NULL,
 	FOREIGN KEY(`business_id`) REFERENCES `businesses`(`id`),
	FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
  FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `laundry_categories` (`id`, `name`, `price_per_kg`, `business_id`, `created_by`) VALUES
(1, 'Bed Sheets', 30000, 1, 1),
(2, 'Clothes', 25000, 1, 1);


CREATE TABLE `laundry_items` (
  `id` int(30) NOT NULL,
  `laundry_category_id` int(30) NOT NULL,
  `weight` double NOT NULL,
  `laundry_id` int(30) NOT NULL,
  `unit_price` double NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `laundry_items` (`id`, `laundry_category_id`, `weight`, `laundry_id`, `unit_price`, `amount`, `status`) VALUES
(4, 3, 10, 4, 25, 250);



CREATE TABLE IF NOT EXISTS `laundry_lists`  (
  `id` int(30) NOT NULL,
  `supplier_id` int NOT NULL,
  `category_id` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= incoming, 2 = ongoing, 3 = ready, 4= picked' ,
  `amount` double NOT NULL,
  `payment_type` tinyint(1) DEFAULT 0 COMMENT '0= unpaid, 1 = mobilemoney, 2 = cash',
  `paid` double  NULL,
  `balance` double  NULL,
  `comments` text  NULL,
  `created_by` int(100)  NULL,
  `updated_by` int(100)  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `business_id`int(100)  NOT NULL,
 	FOREIGN KEY(`business_id`) REFERENCES `businesses`(`id`),
 	FOREIGN KEY(`supplier_id`) REFERENCES `suppliers`(`id`),
 	FOREIGN KEY(`category_id`) REFERENCES `laundry_categories`(`id`),
	FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
  FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `laundry_lists` (`id`, `supplier_id`, `category_id`, `status`, `amount`, `payment_type`, `paid`,`balance`, `comments`, `created_by`,`business_id`) VALUES
(1, 1, 1,1,10000, 1, 10000, 0, 'amount paid',1,1);


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
  `created_by` int(100)  NULL,
  `updated_by` int(100)  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
   FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `businesses` (`id`, `name`, `email`,`phone`, `address`,`created_by`, `updated_by`) VALUES
(1, 'Business1', 'business1@gmail.com','0783021733', 'Entebbe', 1, 1);


CREATE TABLE `activity_logs` (
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` bigint(30) NOT NULL,
  `url` text NOT NULL,
  `action` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `business_id` int NULL,
	FOREIGN KEY(`business_id`) REFERENCES `businesses`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `activity_logs` (`id`, `user_id`, `url`, `action`) VALUES
(1, 1, 'http://localhost/lms/production/login.php', 'successfully logged-in')

CREATE TABLE `roles` (
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `name` varchar(200) NOT NULL,
  `created_by` int(100)  NULL,
  `updated_by` int(100)  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
   FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `roles` (`id`, `name`,`created_by`, `updated_by`) VALUES
(1, 'super_admin',  1, 1);


CREATE TABLE IF NOT EXISTS`suppliers`(
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(100)  NULL,
  `created_by` int(100)  NULL,
  `updated_by` int(100)  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `business_id` int(100)  NULL,
	FOREIGN KEY(`business_id`) REFERENCES `businesses`(`id`),	
  FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
   FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`, `created_by`,  `business_id`) VALUES
(1, 'vicent', 'vicent@example.com' , '0783021733', 'Entebbe', 1, 1);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
