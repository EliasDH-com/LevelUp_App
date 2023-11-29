
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `assigned` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `certificate` text NOT NULL,
  `deadline` date DEFAULT NULL,
  `completion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `zone` (
  `zone_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `zone_id` (`zone_id`),
  ADD KEY `assigned` (`assigned`);

ALTER TABLE `location` ADD PRIMARY KEY (`location_id`);

ALTER TABLE `users` ADD PRIMARY KEY (`user_id`);

ALTER TABLE `zone` ADD PRIMARY KEY (`zone_id`), ADD KEY `location_id` (`location_id`);

ALTER TABLE `item`  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

ALTER TABLE `location` MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `users` MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `zone` MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `item` ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`zone_id`),
ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`assigned`) REFERENCES `users` (`user_id`);


ALTER TABLE `zone` ADD CONSTRAINT `zone_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);
COMMIT;