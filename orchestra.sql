-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2017 at 03:44 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orchestra`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(10) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(1, 'Vocal'),
(2, 'Piano Concertos'),
(3, 'Violin Concertos');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `event_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `event_name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `no_of_tickets` int(10) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time(6) NOT NULL,
  `category_id` int(10) NOT NULL,
  `performer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `user_id`, `location_id`, `event_name`, `description`, `no_of_tickets`, `event_date`, `event_time`, `category_id`, `performer_id`) VALUES
(1, 1, 1, 'Strauss Four Last Songs', 'Diana Damrau has been called the leading coloratura soprano in the world but her gift for characterisation and lustrous, gloriously rich voice makes her a superb interpreter of the music of Richard Strauss. Her performance of the Four Last Songs would light up any concert, but tonight her regular collaborator Sir Antonio Pappano surrounds them with sunshine. Elgar lush musical postcard from Italy, and Brahms most lyrical symphony. Great opera conductors always bring an extra dimension to symphonic music, so expect Pappano to bring out all the latent drama of these three unashamedly romantic masterpieces.', 100, '2017-01-30', '12:00:00.000000', 1, 1),
(2, 2, 2, 'Grandeur out of darkness', 'They want me to write differently. Certainly I could, but I must not, said Anton Bruckner. How then would I stand there before Almighty God, if I followed the others and not Him? The majestic Fifth Symphony is Bruckner at his most personal yet most classical, and Vladimir Jurowski – whose Bruckner performances were praised by The Guardian for their raw and striving authenticity – feels passionately about the music. It will make a magnificent complement to the controlled darkness of Mozart great D minor Piano Concerto, performed tonight by one of our most eloquent and insightful Mozart pianists, Richard Goode.', 100, '2017-02-05', '13:00:00.000000', 2, 3),
(3, 2, 3, 'The Four Seasons', 'They called Alexander Glazunov the Russian Mendelssohn but he was very much his own man, and his 1896 ballet The Seasons is a delight. Tuneful, joyous and glowing with colour, it is the missing link in Russian ballet between Tchaikovsky and Stravinsky – and its exuberant finalBacchanale is the kind of melody that stays with you for life. It will throw a fascinating light on Vivaldi\'s four evergreen concertos, played tonight by the Orchestra\'s Leader Pieter Schoeman. In between comes a real discovery from guest conductor Marius Stravinsky. Dmitry Kabalevsky enchantingly atmospheric musical portrait of spring, in the form of a waltz.', 150, '2017-02-20', '17:00:00.000000', 3, 5),
(4, 3, 1, 'Spring', 'Resembles the sounds in the spring. ', 100, '2017-10-26', '19:00:00.000000', 3, 4),
(5, 4, 3, 'Summer', 'Resembles the sounds in the beach areas', 150, '2017-12-07', '20:00:00.000000', 3, 2),
(6, 1, 3, 'Winter', 'Resembles the winter sound', 250, '2019-12-01', '19:00:00.000000', 2, 6),
(7, 1, 1, 'Autumn', 'Resembles the autumn sound', 55, '2019-06-01', '18:30:00.000000', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_rating`
--

DROP TABLE IF EXISTS `feedback_rating`;
CREATE TABLE `feedback_rating` (
  `user_id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `feedback` text NOT NULL,
  `rating` int(10) NOT NULL,
  `feedback_time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_rating`
--

INSERT INTO `feedback_rating` (`user_id`, `event_id`, `feedback`, `rating`, `feedback_time`) VALUES
(1, 1, 'Throughout a typically searching and innovative programme, Jurowski\'s keen sense of balance, timbre, rhythmic precision and dramatic shape within complex scores was met with technical assurance and colour from the orchestra.', 4, '2017-10-25 15:09:47.118716'),
(2, 1, 'Jurowski managed to withhold the climax and built up the tension again before unleashing a breathtaking finale, red-faced brass players and raised clarinets and oboes included.', 3, '2017-10-25 15:09:47.118716'),
(3, 2, 'Most impressive was Jurowski’s handling of the main climax [of the Bruckner], slowing the tempo without detriment to the basic pulse so that the music had the requisite emotional space through to the disarming final bars ... This cohesive and convincing performance reaffirmed the consistency of Jurowski’s approach to Bruckner.', 5, '2017-10-25 15:09:47.118716'),
(4, 2, 'Cornelius Meister conducts with unassertive elegance, and the playing of the LPO gives much pleasure.', 4, '2017-10-25 15:09:47.118716'),
(5, 3, 'This superbly played premiere of Valentin Silvestrov’s Third Symphony revealed a masterpiece', 5, '2017-10-25 15:09:47.118716');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `location_id` int(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `theater_name` varchar(50) NOT NULL,
  `region_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `address`, `theater_name`, `region_id`) VALUES
(1, '8 Argyll St', 'London Palladium', 1),
(2, 'Southbank Centre Belvedere Rd', 'Royal Festival Hall', 1),
(3, 'Lower Mosley St', 'The Bridgewater Hall', 2);

-- --------------------------------------------------------

--
-- Table structure for table `performer`
--

DROP TABLE IF EXISTS `performer`;
CREATE TABLE `performer` (
  `performer_id` int(10) NOT NULL,
  `performer` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `performer`
--

INSERT INTO `performer` (`performer_id`, `performer`) VALUES
(7, 'AMY ONG'),
(2, 'JAMES DAVIS'),
(4, 'JOE MARX'),
(1, 'JOHNNY OLIVIER'),
(6, 'JOSH SMITH'),
(5, 'LUCY TRACY'),
(3, 'MIKE CAGE');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `region_id` int(10) NOT NULL,
  `city` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`region_id`, `city`) VALUES
(1, 'LONDON'),
(2, 'Manchester');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `event_id` int(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`event_id`, `start_date`, `end_date`, `price`) VALUES
(1, '2016-11-10', '2017-01-19', 60),
(2, '2016-11-20', '2017-01-29', 50),
(3, '2016-11-21', '2017-01-30', 55),
(4, '2017-08-21', '2017-10-23', 50),
(5, '2017-09-21', '2017-11-23', 60),
(6, '2019-10-01', '2019-11-15', 65),
(7, '2017-12-01', '2018-05-01', 70);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `ticket_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `user_id`, `event_id`) VALUES
(1, 1, 1),
(2, 5, 1),
(3, 3, 2),
(4, 2, 2),
(5, 4, 3),
(6, 2, 4),
(7, 4, 4),
(8, 5, 5),
(15, 1, 7),
(16, 1, 7),
(17, 1, 7),
(18, 1, 7),
(19, 1, 7),
(20, 1, 7),
(21, 1, 7),
(22, 1, 7),
(23, 1, 7),
(24, 1, 7),
(25, 1, 7),
(26, 1, 7),
(27, 1, 7),
(28, 1, 7),
(29, 1, 7),
(30, 1, 7),
(31, 1, 7),
(32, 1, 7),
(33, 1, 7),
(34, 1, 7),
(35, 1, 7),
(36, 1, 7),
(37, 1, 7),
(38, 1, 7),
(39, 1, 7),
(40, 1, 7),
(41, 1, 7),
(42, 1, 7),
(43, 1, 7),
(44, 1, 7),
(45, 1, 7),
(46, 1, 7),
(47, 1, 7),
(48, 1, 7),
(49, 1, 7),
(50, 1, 7),
(51, 1, 7),
(52, 1, 7),
(53, 1, 7),
(54, 1, 7),
(55, 1, 7),
(56, 1, 7),
(57, 1, 7),
(58, 1, 7),
(59, 1, 7),
(60, 1, 7),
(61, 1, 7),
(62, 1, 7),
(63, 1, 7),
(64, 1, 7),
(65, 1, 7),
(66, 1, 7),
(76, 2, 7),
(77, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `username`, `password`) VALUES
(1, 'KEVIN', 'WOOD', 'kwood@gmail.com', 'kevin', 'kw1001'),
(2, 'BOB', 'BERGEN', 'bobber@gmail.com', 'bb', 'bobbergen'),
(3, 'KRIS', 'CAGE', 'kriscage@hotmail.com', 'kris99', 'cagerocks'),
(4, 'ELVIS', 'TORN', 'etorn@icould.com', 'elvis', 'et1234'),
(5, 'FRED', 'KIMER', 'kimerf@gmail.com', 'spiderman', 'fredkimer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `feedback_rating`
--
ALTER TABLE `feedback_rating`
  ADD PRIMARY KEY (`user_id`,`event_id`) USING BTREE;

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `performer`
--
ALTER TABLE `performer`
  ADD PRIMARY KEY (`performer_id`),
  ADD UNIQUE KEY `performer` (`performer`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `performer`
--
ALTER TABLE `performer`
  MODIFY `performer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `region_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
