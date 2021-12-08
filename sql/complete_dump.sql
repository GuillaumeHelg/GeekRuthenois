-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 25, 2021 at 10:58 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `my_activities_CC2`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_log`
--

CREATE TABLE `action_log` (
                              `id` bigint(20) NOT NULL,
                              `action_date` datetime NOT NULL,
                              `action_name` varchar(50) NOT NULL,
                              `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `action_log`
--

INSERT INTO `action_log` (`id`, `action_date`, `action_name`, `user_id`) VALUES
                                                                             (5, '2021-11-25 11:54:26', 'askDeletion', 7),
                                                                             (6, '2021-11-25 11:54:32', 'askDeletion', 4);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
                          `id` int(11) NOT NULL,
                          `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
                                        (1, 'Waiting for account validation'),
                                        (2, 'Active account'),
                                        (3, 'Waiting for account deletion');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `username` varchar(50) NOT NULL,
                         `id` bigint(20) NOT NULL,
                         `email` varchar(100) NOT NULL,
                         `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `id`, `email`, `status_id`) VALUES
                                                                 ('bobdeniro', 1, 'bobdeniro@hollywood.com', 1),
                                                                 ('eliseB', 2, 'eliseb@ihm.com', 1),
                                                                 ('arthurH', 3, 'arthurH@michelin.com', 1),
                                                                 ('wandaL', 4, 'wandal@lalaland.com', 3),
                                                                 ('paulsimon', 5, 'paulsimon@guitare.org', 2),
                                                                 ('jessicaA', 6, 'jessicaa@hollywood.com', 2),
                                                                 ('steveM', 7, 'stevem@cars.com', 3),
                                                                 ('evaM', 8, 'evam@movieland.com', 2),
                                                                 ('alpacino', 9, 'alpacino@moviecountry.com', 2),
                                                                 ('eddym', 10, 'eddym@beverly.com', 2),
                                                                 ('francoises', 11, 'francoises@quaidesbrumes.org', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_log`
--
ALTER TABLE `action_log`
    ADD PRIMARY KEY (`id`),
  ADD KEY `action_log_users_id_fk` (`user_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_id_uindex` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_uindex` (`id`),
  ADD KEY `user_status_id_index` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_log`
--
ALTER TABLE `action_log`
    MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action_log`
--
ALTER TABLE `action_log`
    ADD CONSTRAINT `action_log_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
    ADD CONSTRAINT `user_status__fk` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);
