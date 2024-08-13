

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE IF NOT EXISTS  `laundry_categories` (
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `name` varchar(200) NOT NULL,
  `unit_price` double NOT NULL,
  `is_active` BOOLEAN NOT NULL DEFAULT TRUE,
  `created_by` int(100)  NULL,
  `updated_by` int(100)  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `business_id`int(100)  NOT NULL,
 	FOREIGN KEY(`business_id`) REFERENCES `businesses`(`id`),
	FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
  FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `laundry_categories` (`id`, `name`, `unit_price`, `is_active`, `business_id`, `created_by`) VALUES
(1, 'Bed Sheets', 30000, 1,1, 1),
(2, 'Trousers', 25000, 1, 1, 1);



CREATE TABLE IF NOT EXISTS `laundry_lists`  (
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `supplier_id` int NOT NULL,
  `status` int NOT NULL,
  `total_quantity` int NOT NULL,
  `total_amount` double NOT NULL,
  `payment_type` int NOT NULL,
  `paid` double  NULL,
  `comments` text  NULL,
  `created_by` int(100)  NULL,
  `updated_by` int(100)  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `business_id`int(100)  NOT NULL,

 	FOREIGN KEY(`payment_type`) REFERENCES `payment_types`(`id`),
 	FOREIGN KEY(`status`) REFERENCES `laundry_statuses`(`id`),
 	FOREIGN KEY(`business_id`) REFERENCES `businesses`(`id`),
 	FOREIGN KEY(`supplier_id`) REFERENCES `suppliers`(`id`),
	FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
  FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_id` int NOT NULL,
  `business_id` int  NULL,
  `is_active` BOOLEAN  NOT NULL DEFAULT TRUE,
  `created_by` int  NULL,
  `updated_by` int  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`),
  FOREIGN KEY (`business_id`) REFERENCES `businesses`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `phone`, `address`,`username`, `email`, `password`, `role_id`, `business_id`, `created_by`) VALUES
(1, 'superadmin', '0783021730', 'Entebbe', 'superadmin', 'superadmin@example.com' ,'superadmin21', 1, 0, 1),
(2, 'Admin', '0783021731', 'Arua', 'admin', 'admin@example.com' ,'admin21', 1, 1, 1),
(3, 'Staff', '0783021732', 'Gulu', 'staff', 'staff@example.com' ,'staff21', 1, 1, 1);



CREATE TABLE IF NOT EXISTS `businesses` (
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `name` varchar(200) NOT NULL,
   `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `is_active` BOOLEAN NOT NULL DEFAULT TRUE,
  `created_by` int(100)  NULL,
  `updated_by` int(100)  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
   FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `businesses` (`id`, `name`, `email`,`phone`, `address`, `is_active`, `created_by`) VALUES
(1, 'Cam cam shop', 'business1@gmail.com','0783021733', 'Entebbe', 1, 1);


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

CREATE TABLE IF NOT EXISTS `roles`(
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `name` varchar(200) NOT NULL,
  `created_by` int(100)  NULL,
  `updated_by` int(100)  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
   FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `roles` (`id`, `name`,`created_by`) VALUES
(1, 'admin',  1),
(2, 'staff',  1),





CREATE TABLE `laundry_statuses` (
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `name` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `created_by` int(100)  NULL,
  `updated_by` int(100)  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
   FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `laundry_statuses` (`id`, `name`, `code`, `created_by`) VALUES
(1, 'incoming', 'INCOMING',  1),
(2, 'ongoing', 'ONGOING',  1),
(3, 'ready', 'READY',  1),
(4, 'picked', 'PICKED',  1) ;


CREATE TABLE `payment_types` (
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `name` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `created_by` int(100)  NULL,
  `updated_by` int(100)  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY(`created_by`) REFERENCES `users`(`id`),
   FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `payment_types` (`id`, `name`, `code`, `created_by`) VALUES
(1, 'unpaid', 'UNPAID',  1),
(2, 'cash', 'ONGOING',  1),
(3, 'mobile money', 'MOBILE_MONEY',  1);



CREATE TABLE  IF NOT EXISTS `cart` (
  `id` int(11)  NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `item` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `laundry_list_id` int(11) DEFAULT NULL,
  `updated_by` int(100)  NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY(`laundry_list_id`) REFERENCES `laundry_lists`(`id`),
	FOREIGN KEY(`user_id`) REFERENCES `users`(`id`),
   FOREIGN KEY(`updated_by`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS`suppliers`(
  `id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(100)  NULL,
  `is_active` BOOLEAN NOT NULL DEFAULT TRUE,
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
