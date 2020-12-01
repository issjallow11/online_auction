-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2020 at 03:53 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enchere`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id_bid` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `price_bid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id_bid`, `id_product`, `id_login`, `price_bid`) VALUES
(19, 28, 10, 150),
(20, 28, 10, 200),
(21, 28, 10, 200),
(22, 28, 10, 250),
(23, 28, 10, 300),
(24, 27, 10, 150),
(25, 29, 10, 650);

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `accounts` (
  `Id_login` int(50) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compte`
--

INSERT INTO `accounts` (`Id_login`, `fullName`, `email`, `password`, `address`, `country`, `type`, `status`) VALUES
(9, 'Ismaila Jallow', 'issjallow11@gmail.com', '$2y$10$Wiiqew/T.tKdGralo7Qo/.tkP1/XyLY4HhO17PBOULxOQxB4y8eXS', 'Bundung', 'Gambia', 'administrator', 1),
(10, 'test', 'test@test.com', '$2y$10$Wiiqew/T.tKdGralo7Qo/.tkP1/XyLY4HhO17PBOULxOQxB4y8eXS', 'Serrekunda', 'Gambia', 'user', 1),
(11, 'test2', 'test2@test.com', '$2y$10$Wiiqew/T.tKdGralo7Qo/.tkP1/XyLY4HhO17PBOULxOQxB4y8eXS', 'Serrekunda', 'Gambia', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactpermanent`
--

CREATE TABLE `contactpermanent` (
  `id_contact_perm` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactpermanent`
--

INSERT INTO `contactpermanent` (`id_contact_perm`, `Name`, `Email`, `message`) VALUES
(1, 'colley', 'colley@gmail.com', 'come na dplay football with us'),
(2, 'lala', 'lala@gmail.com', 'lala in the tobias wonderland'),
(3, 'mahmoud', 'roomy@etc.com', 'owngoabgisbossova\r\nasboanbiabsv osns\r\nsvnbsvnswk'),
(4, 'Ismaila Jallow', 'issjallow11@gmail.com', 'jbiwbvisbvisbsbvisobs');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `price_product` float DEFAULT 0,
  `description` varchar(50) NOT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `image` text NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produit`
--

INSERT INTO `products` (`id_product`, `product_name`, `price_product`, `description`, `duration`, `image`, `category`) VALUES
(23, 'Bic', 500, 'Bic ancienne', 'June 20,2021 01:20', '91761bic.jpg', 'antique'),
(24, 'Armoire', 1000, 'Armoire ancienne', 'June 20, 2021 01:20', '822069armoire.jpg', 'antique'),
(25, 'Gold', 10000, 'Vase Gold of the ancient chinese empire.', 'June 20, 2020 01:20', '627963vase antique.jpg', 'antique'),
(26, 'Painting', 450, 'Painting Remarquable', 'June 20, 2021 01:20', '447491painting.jpg', 'autre'),
(27, 'Ticket cinema Imax', 100, 'Ticket nouveau film', 'June 20, 2020 01:00', '9602ticket bad moms.jpg', 'autre'),
(28, 'Paulo coelho', 150, 'Livre Paulo Coelho', 'June 14, 2020 01:44', '123785livre paulo coelho.jpg', 'autre'),
(29, 'Costume tradition', 600, 'Belle costume tradition', 'June 20,2020 01:30', '234143costume tradition 3.jpg', 'costume'),
(30, 'Best Bootle', 50, 'Bes t Bottle', 'June 25,2020 2:00', '35189perfume.jpg', 'autre');

-- --------------------------------------------------------

--
-- Table structure for table `vendre`
--

CREATE TABLE `sell` (
  `id_sell` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `Price_sell` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendre`
--

INSERT INTO `sell` (`id_sell`, `id_product`, `id_login`, `Price_sell`) VALUES
(10, 28, 10, 300);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id_bid`),
  ADD KEY `fk_id_product` (`id_product`),
  ADD KEY `fk_id_login` (`id_login`);

--
-- Indexes for table `compte`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Id_login`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `contactpermanent`
--
ALTER TABLE `contactpermanent`
  ADD PRIMARY KEY (`id_contact_perm`);

--
-- Indexes for table `produit`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `vendre`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`id_sell`),
  ADD KEY `fk_sell_id_product` (`id_product`),
  ADD KEY `fk_sell_id_login` (`id_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id_bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `accounts`
  MODIFY `Id_login` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contactpermanent`
--
ALTER TABLE `contactpermanent`
  MODIFY `id_contact_perm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vendre`
--
ALTER TABLE `sell`
  MODIFY `id_sell` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `fk_id_login` FOREIGN KEY (`id_login`) REFERENCES `accounts` (`Id_login`),
  ADD CONSTRAINT `fk_id_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendre`
--
ALTER TABLE `sell`
  ADD CONSTRAINT `fk_sell_id_login` FOREIGN KEY (`id_login`) REFERENCES `accounts` (`Id_login`),
  ADD CONSTRAINT `fk_sell_id_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
