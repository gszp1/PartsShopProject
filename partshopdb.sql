-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 03:20 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `partshopdb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customers`
--

CREATE TABLE `customers` (
  `CustomerID` bigint(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Surname` varchar(50) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `PhoneNumber` varchar(13) DEFAULT NULL,
  `Password` char(32) CHARACTER SET latin2 COLLATE latin2_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `Email`, `Username`, `Surname`, `Name`, `PhoneNumber`, `Password`) VALUES
(21, 'aaaa', 'aaa@aaa', NULL, NULL, NULL, '0cc175b9c0f1b6a83'),
(22, 'aaaa', 'aaa@aaa', NULL, NULL, NULL, '4124bc0a9335c27f0'),
(23, 'aaa@aaa', 'aaaa', NULL, NULL, NULL, '0cc175b9c0f1b6a83'),
(24, 'sto@gmail.cum', 'stoker', NULL, NULL, NULL, '74b87337454200d4d'),
(25, 'BuryZenek@gmail.com', 'Bezi', NULL, NULL, NULL, '0cc175b9c0f1b6a83'),
(26, 'aa@aaaaa', 'aa', NULL, NULL, NULL, '0cc175b9c0f1b6a83'),
(27, 'suk@suksuk.cum', 'suksuk', NULL, NULL, NULL, '76be879a667b655cec8f70bbf7b6cb99');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `manufacturers`
--

CREATE TABLE `manufacturers` (
  `ManufacturerID` bigint(20) NOT NULL,
  `ManufacturerName` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Region` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Phone` varchar(13) NOT NULL,
  `HomePage` varchar(50) NOT NULL,
  `PostalCode` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`ManufacturerID`, `ManufacturerName`, `Country`, `City`, `Region`, `Address`, `Phone`, `HomePage`, `PostalCode`) VALUES
(1, 'ASUS', 'Taiwan', 'Taipei', 'Beitou District', 'adress', '225718040', 'https://www.asus.com/', '12-450');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderID` bigint(20) NOT NULL,
  `ProductsID` bigint(20) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Discount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `OrderID` bigint(20) NOT NULL,
  `CustomerID` bigint(20) NOT NULL,
  `ShipperID` bigint(20) NOT NULL,
  `OrderDate` datetime NOT NULL,
  `ShipDate` datetime NOT NULL,
  `RequiredDate` datetime NOT NULL,
  `ShipAddress` varchar(50) NOT NULL,
  `ShipRegion` varchar(50) NOT NULL,
  `ShipCountry` varchar(50) NOT NULL,
  `ShipCity` varchar(50) NOT NULL,
  `ShipPostalCode` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `partcategories`
--

CREATE TABLE `partcategories` (
  `CategoryID` bigint(20) NOT NULL,
  `CategoryName` varchar(50) NOT NULL,
  `Description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `partcategories`
--

INSERT INTO `partcategories` (`CategoryID`, `CategoryName`, `Description`) VALUES
(1, 'GPU', 'Graphics Processing Unit'),
(3, 'CPU', 'Central Processing Unit');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `partsuppliers`
--

CREATE TABLE `partsuppliers` (
  `SupplierID` bigint(20) NOT NULL,
  `SupplierName` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Region` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Phone` varchar(13) NOT NULL,
  `HomePage` varchar(50) NOT NULL,
  `PostalCode` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `partsuppliers`
--

INSERT INTO `partsuppliers` (`SupplierID`, `SupplierName`, `Country`, `City`, `Region`, `Address`, `Phone`, `HomePage`, `PostalCode`) VALUES
(1, 'Supplier1', 'Poland', 'Warsaw', 'Masovian', 'Czerniakowska 55', '123 456 789', 'https://www.Supplier1.com', '00-001');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `ProductID` bigint(20) NOT NULL,
  `CategoryID` bigint(20) NOT NULL,
  `SupplierID` bigint(20) NOT NULL,
  `ManufacturerID` bigint(20) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `UnitsInStock` int(11) NOT NULL,
  `OrderedUnits` int(11) NOT NULL,
  `Picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `CategoryID`, `SupplierID`, `ManufacturerID`, `ProductName`, `Price`, `UnitsInStock`, `OrderedUnits`, `Picture`) VALUES
(1, 1, 1, 1, 'GeForce RTX 3060 DUAL OC V2', 1559.00, 12, 0, './resources/assets/images/GPU/GeForce RTX 3060 DUAL OC V2.webp'),
(2, 1, 1, 1, 'GeForce RTX 3070 DUAL OC V2', 2399.00, 2, 0, './resources/assets/images/GPU/GeForce RTX 3070 DUAL OC V2.webp'),
(3, 1, 1, 1, 'GeForce RTX 4070 Ti ProArt OC', 4459.00, 15, 2, './resources/assets/images/GPU/GeForce RTX 4070 Ti ProArt OC.webp'),
(4, 1, 1, 1, 'Radeon RX 7800 XT TUF Gaming', 2900.00, 23, 2, './resources/assets/images/GPU/Radeon RX 7800 XT TUF Gaming.webp'),
(5, 1, 1, 1, 'GeForce RTX 4070 TI ROG STRIX GAMING', 4999.00, 21, 2, './resources/assets/images/GPU/GeForce RTX 4070 TI ROG STRIX GAMING.webp');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `productwarranties`
--

CREATE TABLE `productwarranties` (
  `ProductID` bigint(20) NOT NULL,
  `WarrantyID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shipperid`
--

CREATE TABLE `shipperid` (
  `ShipperID` bigint(20) NOT NULL,
  `CompanyName` varchar(50) NOT NULL,
  `PhoneNumber` varchar(13) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `Region` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `HomePage` varchar(50) NOT NULL,
  `PostalCode` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `ProductID` bigint(20) NOT NULL,
  `CustomerID` bigint(20) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `warranties`
--

CREATE TABLE `warranties` (
  `WarrantyID` bigint(20) NOT NULL,
  `WarrantyName` varchar(50) NOT NULL,
  `Duration` time NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indeksy dla tabeli `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`ManufacturerID`),
  ADD UNIQUE KEY `ManufacturerName` (`ManufacturerName`);

--
-- Indeksy dla tabeli `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`OrderID`,`ProductsID`),
  ADD KEY `OrderDetails_fk1` (`ProductsID`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `Orders_fk0` (`CustomerID`),
  ADD KEY `Orders_fk1` (`ShipperID`);

--
-- Indeksy dla tabeli `partcategories`
--
ALTER TABLE `partcategories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryName` (`CategoryName`);

--
-- Indeksy dla tabeli `partsuppliers`
--
ALTER TABLE `partsuppliers`
  ADD PRIMARY KEY (`SupplierID`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `Products_fk0` (`CategoryID`),
  ADD KEY `Products_fk1` (`SupplierID`),
  ADD KEY `Products_fk2` (`ManufacturerID`);

--
-- Indeksy dla tabeli `productwarranties`
--
ALTER TABLE `productwarranties`
  ADD PRIMARY KEY (`ProductID`,`WarrantyID`),
  ADD KEY `ProductWarranties_fk1` (`WarrantyID`);

--
-- Indeksy dla tabeli `shipperid`
--
ALTER TABLE `shipperid`
  ADD PRIMARY KEY (`ShipperID`);

--
-- Indeksy dla tabeli `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`ProductID`,`CustomerID`),
  ADD KEY `ShoppingCart_fk1` (`CustomerID`);

--
-- Indeksy dla tabeli `warranties`
--
ALTER TABLE `warranties`
  ADD PRIMARY KEY (`WarrantyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `ManufacturerID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partcategories`
--
ALTER TABLE `partcategories`
  MODIFY `CategoryID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `partsuppliers`
--
ALTER TABLE `partsuppliers`
  MODIFY `SupplierID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipperid`
--
ALTER TABLE `shipperid`
  MODIFY `ShipperID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warranties`
--
ALTER TABLE `warranties`
  MODIFY `WarrantyID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `OrderDetails_fk0` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `OrderDetails_fk1` FOREIGN KEY (`ProductsID`) REFERENCES `products` (`ProductID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Orders_fk0` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`),
  ADD CONSTRAINT `Orders_fk1` FOREIGN KEY (`ShipperID`) REFERENCES `shipperid` (`ShipperID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Products_fk0` FOREIGN KEY (`CategoryID`) REFERENCES `partcategories` (`CategoryID`),
  ADD CONSTRAINT `Products_fk1` FOREIGN KEY (`SupplierID`) REFERENCES `partsuppliers` (`SupplierID`),
  ADD CONSTRAINT `Products_fk2` FOREIGN KEY (`ManufacturerID`) REFERENCES `manufacturers` (`ManufacturerID`);

--
-- Constraints for table `productwarranties`
--
ALTER TABLE `productwarranties`
  ADD CONSTRAINT `ProductWarranties_fk0` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
  ADD CONSTRAINT `ProductWarranties_fk1` FOREIGN KEY (`WarrantyID`) REFERENCES `warranties` (`WarrantyID`);

--
-- Constraints for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `ShoppingCart_fk0` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
  ADD CONSTRAINT `ShoppingCart_fk1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
