-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 26, 2024 at 04:46 AM
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
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `email`, `password`) VALUES
(5, 'admin@admin.admin', '21232f297a57a5a743894a0e4a801fc3');

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
(29, 'test@gmail.com', 'test', 'surname', 'name', '111222333', '098f6bcd4621d373cade4e832627b4f6'),
(32, 'test2@gmail.com', 'test2', NULL, NULL, NULL, 'ad0234829205b9033196ba818f7a872b');

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
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`OrderID`, `ProductsID`, `Price`, `Quantity`) VALUES
(1, 1, 1559.00, 1),
(2, 1, 1559.00, 1),
(2, 2, 2399.00, 1),
(2, 3, 4459.00, 1),
(2, 4, 2900.00, 1),
(2, 5, 4999.00, 1),
(2, 6, 250.00, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `OrderID` bigint(20) NOT NULL,
  `CustomerID` bigint(20) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `Status`) VALUES
(1, 29, 2),
(2, 29, 1);

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
  `Picture` varchar(150) NOT NULL,
  `Discontinued` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `CategoryID`, `SupplierID`, `ManufacturerID`, `ProductName`, `Price`, `UnitsInStock`, `OrderedUnits`, `Picture`, `Discontinued`) VALUES
(1, 1, 1, 1, 'GeForce RTX 3060 DUAL OC V2', 1559.00, 12, 0, '/resources/assets/images/GeForce_RTX_3060_DUAL_OC_V2.webp', 0),
(2, 1, 1, 1, 'GeForce RTX 3070 DUAL OC V2', 2399.00, 2, 0, '/resources/assets/images/GeForce_RTX_3070_DUAL_OC_V2.webp', 0),
(3, 1, 1, 1, 'GeForce RTX 4070 Ti ProArt OC', 4459.00, 15, 2, '/resources/assets/images/GeForce_RTX_4070_Ti_ProArt_OC.webp', 0),
(4, 1, 1, 1, 'Radeon RX 7800 XT TUF Gaming', 2900.00, 23, 2, '/resources/assets/images/Radeon_RX_7800_XT_TUF_Gaming.webp', 0),
(5, 1, 1, 1, 'GeForce RTX 4070 TI ROG STRIX GAMING', 4999.00, 21, 2, '/resources/assets/images/GeForce_RTX_4070_TI_ROG_STRIX_GAMING.webp', 0),
(6, 1, 1, 1, 'Intel Arc A750 8GB GDDR6', 250.00, 2, 0, '/resources/assets/images/Intel_Arc_A750_8GB_GDDR6.webp', 0);

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

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `email` (`email`);

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
  ADD KEY `Orders_fk0` (`CustomerID`);

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
-- Indeksy dla tabeli `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`ProductID`,`CustomerID`),
  ADD KEY `ShoppingCart_fk1` (`CustomerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `ManufacturerID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `ProductID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `Orders_fk0` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Products_fk0` FOREIGN KEY (`CategoryID`) REFERENCES `partcategories` (`CategoryID`),
  ADD CONSTRAINT `Products_fk1` FOREIGN KEY (`SupplierID`) REFERENCES `partsuppliers` (`SupplierID`),
  ADD CONSTRAINT `Products_fk2` FOREIGN KEY (`ManufacturerID`) REFERENCES `manufacturers` (`ManufacturerID`);

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
