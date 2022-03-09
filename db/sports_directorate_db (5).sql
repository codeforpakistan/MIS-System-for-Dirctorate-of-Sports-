-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2022 at 08:48 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sports_directorate_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `athletes`
--

CREATE TABLE `athletes` (
  `ath_id` int(100) NOT NULL,
  `ath_name` varchar(100) NOT NULL,
  `ath_father_name` varchar(100) NOT NULL,
  `ath_cnic` varchar(100) NOT NULL,
  `ath_dob` date NOT NULL,
  `ath_address` varchar(200) NOT NULL,
  `ath_contact` varchar(100) NOT NULL,
  `ath_gender` varchar(100) NOT NULL,
  `ath_emergency_contact` varchar(100) NOT NULL,
  `ath_profession` varchar(100) NOT NULL,
  `ath_date_apply` date NOT NULL,
  `ath_nic_photo` varchar(100) NOT NULL,
  `ath_profile_photo` varchar(100) NOT NULL,
  `ath_email` varchar(100) NOT NULL,
  `ath_password` varchar(100) NOT NULL,
  `district_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role_id_fk` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `athletes`
--

INSERT INTO `athletes` (`ath_id`, `ath_name`, `ath_father_name`, `ath_cnic`, `ath_dob`, `ath_address`, `ath_contact`, `ath_gender`, `ath_emergency_contact`, `ath_profession`, `ath_date_apply`, `ath_nic_photo`, `ath_profile_photo`, `ath_email`, `ath_password`, `district_id`, `user_id`, `user_role_id_fk`, `is_active`, `create_at`) VALUES
(32, '', '', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '', 'salman@gmail.com', '03346657feea0490a4d4f677faa0583d', 0, 0, 5, 1, '2022-03-09 06:36:40'),
(33, 'admin', '', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 19, 0, 6, 1, '2022-03-09 06:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `athlete_games`
--

CREATE TABLE `athlete_games` (
  `ath_game_id` int(11) NOT NULL,
  `ath_game_time_preference` varchar(100) NOT NULL,
  `ath_game_fee` varchar(100) NOT NULL,
  `ath_game_admission_fee` int(11) NOT NULL,
  `ath_game_status` varchar(100) NOT NULL,
  `ath_game_apply_date` date NOT NULL,
  `ath_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `athlete_games`
--

INSERT INTO `athlete_games` (`ath_game_id`, `ath_game_time_preference`, `ath_game_fee`, `ath_game_admission_fee`, `ath_game_status`, `ath_game_apply_date`, `ath_id`, `game_id`, `create_at`) VALUES
(150, 'morning', '800', 100, 'Pending', '2022-03-09', 32, 5, '2022-03-09 06:37:42'),
(151, 'morning', '600', 500, 'Pending', '2022-03-09', 32, 6, '2022-03-09 06:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `athlete_games_fees`
--

CREATE TABLE `athlete_games_fees` (
  `ath_game_fee_id` int(11) NOT NULL,
  `ath_payment_mode` varchar(11) NOT NULL,
  `ath_challan_no` int(11) NOT NULL,
  `ath_upload_challan` varchar(200) NOT NULL,
  `ath_challan_fee` int(11) NOT NULL,
  `ath_fee_status` enum('1','2','3','4') DEFAULT NULL COMMENT '1 for pending 2 for approve 3 for reected 4 expire',
  `fee_monthly_start_date` date NOT NULL,
  `fee_monthly_end_date` date NOT NULL,
  `ath_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `athlete_games_fees`
--

INSERT INTO `athlete_games_fees` (`ath_game_fee_id`, `ath_payment_mode`, `ath_challan_no`, `ath_upload_challan`, `ath_challan_fee`, `ath_fee_status`, `fee_monthly_start_date`, `fee_monthly_end_date`, `ath_id`, `game_id`, `create_at`) VALUES
(36, 'Bank', 10, '', 2000, '2', '2022-03-09', '2022-03-31', 32, 5, '2022-03-09 06:37:42'),
(37, 'Bank', 10, '', 2000, '2', '2022-03-09', '2022-03-31', 32, 6, '2022-03-09 06:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `district_name`, `is_active`) VALUES
(1, 'Abbottabad', 0),
(2, 'Bannu', 0),
(3, 'Battagram', 1),
(4, 'Buner', 1),
(5, 'Charsadda', 1),
(6, 'Chitral', 1),
(7, 'Dera Ismail Khan', 1),
(8, 'Hangu', 1),
(9, 'Haripur', 1),
(10, 'Karak', 1),
(11, 'Kohat', 1),
(12, 'Kohistan', 1),
(13, 'Lakki Marwat', 1),
(14, 'Lower Dir', 1),
(15, 'Malakand', 1),
(16, 'Mansehra', 1),
(17, 'Mardan', 1),
(18, 'Nowshera', 1),
(19, 'Peshawar', 1),
(20, 'Shangla', 1),
(21, 'Swabi', 1),
(22, 'Swat', 1),
(23, 'Tank', 1),
(24, 'Tor Ghar', 1),
(25, 'Upper Dir', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_title` varchar(100) NOT NULL,
  `event_start_date` date NOT NULL,
  `event_end_date` date NOT NULL,
  `session` varchar(100) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `create_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_title`, `event_start_date`, `event_end_date`, `session`, `is_active`, `create_on`) VALUES
(29, 'under 19- games 2020', '2022-01-01', '2022-01-19', '2020', 1, '2022-01-19 06:17:35'),
(30, 'under-22 games- 2022', '2022-01-01', '2022-01-19', '2022', 1, '2022-01-19 07:15:46'),
(31, 'test', '2022-01-25', '2022-06-25', '2022', 1, '2022-01-28 09:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `events_games`
--

CREATE TABLE `events_games` (
  `event_game_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events_games`
--

INSERT INTO `events_games` (`event_game_id`, `event_id`, `game_id`) VALUES
(7, 28, 4),
(8, 28, 5),
(9, 28, 6),
(10, 28, 7),
(11, 28, 8),
(12, 29, 5),
(13, 29, 7),
(14, 30, 5),
(15, 30, 6),
(16, 31, 4),
(17, 31, 5),
(18, 31, 8);

-- --------------------------------------------------------

--
-- Table structure for table `events_trials`
--

CREATE TABLE `events_trials` (
  `event_trial_id` int(11) NOT NULL,
  `trial_name` varchar(100) NOT NULL,
  `trial_start_date` date NOT NULL,
  `trial_end_date` date NOT NULL,
  `trial_session` varchar(100) NOT NULL,
  `max_players` int(11) NOT NULL,
  `closing_date` date NOT NULL,
  `officials` varchar(200) NOT NULL,
  `facilities` varchar(200) NOT NULL,
  `event_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `create_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events_trials`
--

INSERT INTO `events_trials` (`event_trial_id`, `trial_name`, `trial_start_date`, `trial_end_date`, `trial_session`, `max_players`, `closing_date`, `officials`, `facilities`, `event_id`, `game_id`, `is_active`, `create_on`) VALUES
(12, 'basketball', '2022-01-01', '2022-01-12', '2020', 30, '2022-01-14', '5', 'peshawar,mardan', 29, 7, 1, '2022-01-19 06:19:00'),
(13, 'hockey', '2022-01-01', '2022-01-10', '2020', 20, '2022-01-15', '5', 'peshawar,mmardan', 29, 5, 1, '2022-01-19 06:19:43'),
(14, 'hockey', '2022-01-01', '2022-01-12', '2022', 12, '2022-01-18', '5', 'peshawar,mardan', 30, 5, 1, '2022-01-19 07:16:36'),
(15, 'boxing', '2022-01-01', '2022-01-12', '2022', 10, '2022-01-16', '5', 'peshawar', 30, 6, 1, '2022-01-19 07:17:15'),
(16, 'test trial', '2022-02-01', '2022-03-01', '2022', 12, '2022-03-07', '5', 'pesahwar saddar', 31, 8, 1, '2022-01-28 10:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `facility_id` int(11) NOT NULL,
  `facility_name` varchar(100) NOT NULL,
  `facility_description` varchar(500) NOT NULL,
  `is_active` tinyint(11) NOT NULL DEFAULT 1,
  `create_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`facility_id`, `facility_name`, `facility_description`, `is_active`, `create_on`) VALUES
(2, 'sas1111111', 'asas11111111', 1, '2021-12-18 14:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `game_name` varchar(100) NOT NULL,
  `game_fee` varchar(200) NOT NULL,
  `game_admission_fee` varchar(100) NOT NULL,
  `game_description` varchar(1000) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `create_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `game_name`, `game_fee`, `game_admission_fee`, `game_description`, `is_active`, `create_on`) VALUES
(4, 'cricket', '100', '300', 'game', 1, '2022-01-17 10:50:10'),
(5, 'hockey', '800', '100', 'game', 1, '2022-01-17 10:50:17'),
(6, 'boxing', '600', '500', 'game', 1, '2022-01-17 10:50:27'),
(7, 'basket ball', '900', '700', 'game', 1, '2022-01-17 10:53:50'),
(8, 'foot ball', '500', '900', 'game', 1, '2022-01-17 10:54:22'),
(9, 'new game', '200sss', '1000', 'hi', 0, '2022-02-03 09:56:14'),
(10, 'gym', '2000', '2500', 'test', 1, '2022-03-02 06:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `official_id` int(11) NOT NULL,
  `official_name` varchar(100) NOT NULL,
  `official_designation` varchar(100) NOT NULL,
  `official_description` varchar(500) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `create_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(250) NOT NULL,
  `page_status` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_name`, `page_status`) VALUES
(1, 'dashboard', 1),
(9, 'selected_officals', 1),
(3, 'selected_players', 1),
(4, 'events', 1),
(5, 'users', 1),
(6, 'districts', 1),
(7, 'events_trials', 1),
(8, 'games', 1);

-- --------------------------------------------------------

--
-- Table structure for table `page_privileges`
--

CREATE TABLE `page_privileges` (
  `page_privilege_id` int(11) NOT NULL,
  `page_id_fk` int(11) NOT NULL DEFAULT 0,
  `user_role_id_fk` int(11) NOT NULL DEFAULT 0,
  `access` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_privileges`
--

INSERT INTO `page_privileges` (`page_privilege_id`, `page_id_fk`, `user_role_id_fk`, `access`) VALUES
(1, 3, 3, '1'),
(25, 9, 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `selected_players_officials`
--

CREATE TABLE `selected_players_officials` (
  `player_offical_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `cnic` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `physical_status` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `domicle` varchar(200) NOT NULL,
  `district_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `event_trial_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `create_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `selected_players_officials`
--

INSERT INTO `selected_players_officials` (`player_offical_id`, `name`, `father_name`, `cnic`, `age`, `gender`, `physical_status`, `category`, `type`, `domicle`, `district_id`, `event_id`, `user_id`, `game_id`, `event_trial_id`, `is_active`, `create_on`) VALUES
(17, '22', 'kamran112', '11111-1111111-3', 2023, 'male', 'no status11212', 'under 18', 'player', 'Peshawar', 20, 29, 35, 0, 13, 1, '2022-01-19 07:18:07'),
(18, 'kamran', 'usman', '22222-2222222-2', 30, 'male', 'no', 'under 22', 'player', 'Malakand', 8, 30, 35, 0, 15, 1, '2022-01-19 07:18:38'),
(22, '22', 'kamran', '88888-8888888-8', 90222, 'female', 'no222', 'Dcotore', 'offical', 'Mardan', 15, 29, 35, 0, 12, 1, '2022-01-20 10:53:25'),
(23, 'shahzeb', 'siddiq', '12345-6789877-8', 26, 'male', 'Nill', 'under 21', 'player', 'Peshawar', 19, 31, 35, 0, 16, 1, '2022-01-28 10:03:15'),
(24, 'khan', 'khan', '12121-1212121-2', 26, 'male', 'Nill', 'under 21', 'player', 'Peshawar', 19, 31, 36, 0, 16, 1, '2022-01-28 10:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_district_id_fk` int(1) NOT NULL DEFAULT 0,
  `user_role_id_fk` int(1) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_address` varchar(500) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_contact` varchar(255) DEFAULT NULL,
  `user_status` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_district_id_fk`, `user_role_id_fk`, `user_name`, `user_email`, `user_address`, `user_password`, `user_contact`, `user_status`) VALUES
(36, 19, 3, 'salman', 'salman@gmail.com', '', '03346657feea0490a4d4f677faa0583d', NULL, 1),
(35, 0, 1, 'admin', 'admin@gmail.com', 'mardan', '21232f297a57a5a743894a0e4a801fc3', '0381-7267816', 1),
(51, 0, 5, '', 'test@gmail.com', '', 'b0baee9d279d34fa1dfd71aadb908c3f', NULL, 1),
(53, 4, 3, 'kamal', 'kamal@gmail.com', '', 'aa63b0d5d950361c05012235ab520512', NULL, 1),
(54, 0, 5, '', 'shah@gmail.com', '', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_role_id` int(1) NOT NULL,
  `user_role_name` varchar(255) NOT NULL,
  `user_role_status` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `user_role_name`, `user_role_status`) VALUES
(1, 'Super Admin', 1),
(5, 'athlete', 1),
(3, 'District Admin', 1),
(6, 'Membership Admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `athletes`
--
ALTER TABLE `athletes`
  ADD PRIMARY KEY (`ath_id`);

--
-- Indexes for table `athlete_games`
--
ALTER TABLE `athlete_games`
  ADD PRIMARY KEY (`ath_game_id`);

--
-- Indexes for table `athlete_games_fees`
--
ALTER TABLE `athlete_games_fees`
  ADD PRIMARY KEY (`ath_game_fee_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `events_games`
--
ALTER TABLE `events_games`
  ADD PRIMARY KEY (`event_game_id`);

--
-- Indexes for table `events_trials`
--
ALTER TABLE `events_trials`
  ADD PRIMARY KEY (`event_trial_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`facility_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`official_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `page_privileges`
--
ALTER TABLE `page_privileges`
  ADD PRIMARY KEY (`page_privilege_id`);

--
-- Indexes for table `selected_players_officials`
--
ALTER TABLE `selected_players_officials`
  ADD PRIMARY KEY (`player_offical_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `athletes`
--
ALTER TABLE `athletes`
  MODIFY `ath_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `athlete_games`
--
ALTER TABLE `athlete_games`
  MODIFY `ath_game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `athlete_games_fees`
--
ALTER TABLE `athlete_games_fees`
  MODIFY `ath_game_fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `events_games`
--
ALTER TABLE `events_games`
  MODIFY `event_game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `events_trials`
--
ALTER TABLE `events_trials`
  MODIFY `event_trial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `page_privileges`
--
ALTER TABLE `page_privileges`
  MODIFY `page_privilege_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `selected_players_officials`
--
ALTER TABLE `selected_players_officials`
  MODIFY `player_offical_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_role_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
