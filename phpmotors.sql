-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2021 at 11:46 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(3, 'Jeremy', 'Johnson', 'jjcjson19@gmail.com', '$2y$10$M2R3zR2L/CSfKBEBDMD0A.BpH/qkUdkZsDzr/64zNTfg/W..OpUku', '1', NULL),
(4, 'Jessica', 'Gerber', 'jessicaegerber@gmail.com', '$2y$10$7jn3GN1Gox3jN.Rg5hMNkeOIBY.Z9YDUN5fgOLhQgdhp0eVicvkU2', '1', NULL),
(5, 'Admin', 'User', 'admin@cse340.net', '$2y$10$bKHR.jvQHCt1a7fT6RBFSOMpWNu3I4xYYJfvmeoOZLiTkBfbu/osm', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(3, 1, 'jeep-wrangler.jpg', '/phpmotors/images/vehicles/jeep-wrangler.jpg', '2021-03-20 00:50:30', 1),
(4, 1, 'jeep-wrangler-tn.jpg', '/phpmotors/images/vehicles/jeep-wrangler-tn.jpg', '2021-03-20 00:50:30', 1),
(5, 2, 'ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt.jpg', '2021-03-20 00:51:14', 1),
(6, 2, 'ford-modelt-tn.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '2021-03-20 00:51:14', 1),
(7, 3, 'lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve.jpg', '2021-03-20 00:51:56', 1),
(8, 3, 'lambo-Adve-tn.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '2021-03-20 00:51:56', 1),
(9, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2021-03-20 00:52:28', 1),
(10, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2021-03-20 00:52:28', 1),
(11, 5, 'ms.jpg', '/phpmotors/images/vehicles/ms.jpg', '2021-03-20 00:52:54', 1),
(12, 5, 'ms-tn.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '2021-03-20 00:52:54', 1),
(13, 6, 'bat.jpg', '/phpmotors/images/vehicles/bat.jpg', '2021-03-20 00:53:12', 1),
(14, 6, 'bat-tn.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '2021-03-20 00:53:12', 1),
(15, 7, 'mm.jpg', '/phpmotors/images/vehicles/mm.jpg', '2021-03-20 00:53:56', 1),
(16, 7, 'mm-tn.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '2021-03-20 00:53:56', 1),
(17, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2021-03-20 00:54:18', 1),
(18, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2021-03-20 00:54:18', 1),
(19, 9, 'crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic.jpg', '2021-03-20 00:54:37', 1),
(20, 9, 'crown-vic-tn.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '2021-03-20 00:54:37', 1),
(21, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2021-03-20 00:54:56', 1),
(22, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2021-03-20 00:54:56', 1),
(23, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2021-03-20 00:55:17', 1),
(24, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2021-03-20 00:55:17', 1),
(25, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2021-03-20 00:55:39', 1),
(26, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2021-03-20 00:55:39', 1),
(27, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2021-03-20 00:55:57', 1),
(28, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2021-03-20 00:55:57', 1),
(29, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2021-03-20 00:56:19', 1),
(30, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2021-03-20 00:56:20', 1),
(31, 15, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2021-03-20 00:56:43', 1),
(32, 15, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2021-03-20 00:56:43', 1),
(33, 19, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2021-03-20 00:59:52', 1),
(34, 19, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2021-03-20 00:59:52', 1),
(35, 1, 'jeep_wrangler_1.jpg', '/phpmotors/images/vehicles/jeep_wrangler_1.jpg', '2021-03-20 01:05:02', 0),
(36, 1, 'jeep_wrangler_1-tn.jpg', '/phpmotors/images/vehicles/jeep_wrangler_1-tn.jpg', '2021-03-20 01:05:02', 0),
(38, 3, 'lamborghini_aventador-tn.webp', '/phpmotors/images/vehicles/lamborghini_aventador-tn.webp', '2021-03-20 01:05:32', 0),
(39, 11, 'cadillac_xt6.jpg', '/phpmotors/images/vehicles/cadillac_xt6.jpg', '2021-03-20 01:06:08', 0),
(40, 11, 'cadillac_xt6-tn.jpg', '/phpmotors/images/vehicles/cadillac_xt6-tn.jpg', '2021-03-20 01:06:08', 0),
(42, 12, 'hummer_new-tn.jpg', '/phpmotors/images/vehicles/hummer_new-tn.jpg', '2021-03-20 01:09:43', 0),
(43, 10, 'camaro_new.jpg', '/phpmotors/images/vehicles/camaro_new.jpg', '2021-03-20 01:11:39', 0),
(44, 10, 'camaro_new-tn.jpg', '/phpmotors/images/vehicles/camaro_new-tn.jpg', '2021-03-20 01:11:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text DEFAULT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,2) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/phpmotors/images/vehicles/jeep-wrangler.jpg', '/phpmotors/images/vehicles/jeep-wrangler-tn.jpg', '28045.00', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it\'s black.', '/phpmotors/images/vehicles/ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '30000.00', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws. ', '/phpmotors/images/vehicles/lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '417650.00', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '150000.00', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new.', '/phpmotors/images/vehicles/ms.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '100.00', 200, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', '/phpmotors/images/vehicles/bat.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '65000.00', 2, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mm.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '10000.00', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000.00', 2, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '10000.00', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the ar you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000.00', 10, 'Silver', 3),
(11, 'Cadilac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195.00', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800.00', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000.00', 6, 'Red', 2),
(14, 'FBI', 'Survalence Van', 'do you like police shows? You\'ll feel right at home driving this van, come complete with survalence equipments for and extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/fbi.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '20000.00', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well this car is for you straight from the 90s from Aspen, Colorado we have the orginal Dog Car complete with fluffy ears.  ', '/phpmotors/images/vehicles/dog.jpg', '/phpmotors/images/vehicles/dog-tn.jpg', '35000.00', 1, 'Brown', 2),
(19, 'DMC', 'Delorean', 'Fastest Car around!', '/phpmotors/images/delorean.jpg', '/phpmotors/images/delorean.jpg', '125000.00', 1, 'Stainless Steel', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(3, 'Best $100 I have ever spent', '2021-04-02 03:30:38', 5, 3),
(4, 'Naturally aspirated engine has some serious pep', '2021-04-02 20:18:07', 3, 5),
(5, 'My other car is a ferrari', '2021-04-02 21:05:33', 13, 5),
(6, 'Adequate for a night job.', '2021-04-02 21:05:44', 6, 5),
(8, 'Why were there so many cameras inside? Super weird...', '2021-04-02 21:06:17', 14, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `clientId_fk` (`clientId`),
  ADD KEY `invId_fk` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `clientId_fk` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invId_fk` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
