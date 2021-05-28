-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2021 at 04:19 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `community`
--

CREATE TABLE `community` (
  `Id` int(11) NOT NULL,
  `sender_id` varchar(70) NOT NULL,
  `receiver_id` varchar(70) NOT NULL,
  `Message` longblob NOT NULL,
  `Time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `community`
--

INSERT INTO `community` (`Id`, `sender_id`, `receiver_id`, `Message`, `Time`) VALUES
(1, 'e1e0db869081e571cdcbad7b5c7597133d79a749084b9a08ccf05a1ba5e771cc8196cc', 'community', 0x4869692c20536f6d65626f647920486572653f, 'May 28, 2021, 08:08 pm'),
(2, '3349e3db36d1cd5659c618f304c339fb5f2c3cd88011573e76105c9cfa9b798c51e2ac', 'community', 0x4869692c205468657265212121, 'May 28, 2021, 08:09 pm'),
(3, 'community', 'community', 0x57656c636f6d6520546f204f4820436f6d6d756e6974792e2054686973206973206120636f6d6d756e6974792065766572796f6e652063616e20636f6e747269627574652e20536f2c2072656a6f6963652e204f70656e20796f75722068656172747320616e64206c6561702075702077697468206368617474696e672e, 'May 28, 2021, 08:11 pm'),
(4, 'community', 'community', 0x596f7572207072697661637920697320736563757265642e204f757220646576656c6f70657273206861766520626c6f636b6564205853532c2053514c20496e6a656374696f6e20616e6420466f726d204d616e6970756c6174696f6e2e202854686573652061726520736f6d65206861636b696e6720776179732e29, 'May 28, 2021, 08:11 pm'),
(5, 'community', 'community', 0x5468757320796f752063616e20756e6465727374616e642c20497420697320612073656375726564207765627369746520776974682070617373776f726420616e64206d65737361676520656e6372797074696f6e2e20536f2c20454e4a4f59204348415454494e472120f09f988a, 'May 28, 2021, 08:11 pm'),
(6, 'community', 'community', 0x4d6f726520616e64206d6f72652066656174757265732061726520636f6d696e672e2e2e, 'May 28, 2021, 08:11 pm'),
(7, 'community', 'community', 0x596f752063616e2061646420696d6167657320696620796f752077616e742e, 'May 28, 2021, 08:14 pm'),
(8, 'community', 'community', 0x7370656369616c496d61676546696c65546f426553617665642e3a33323434343232353436456e6a6f795f6c6966652e6a7067, 'May 28, 2021, 08:14 pm');

-- --------------------------------------------------------

--
-- Table structure for table `lads`
--

CREATE TABLE `lads` (
  `Id` int(11) NOT NULL,
  `Unique Id` varchar(32) NOT NULL,
  `User Id` varchar(70) NOT NULL,
  `Full Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Image` varchar(200) NOT NULL,
  `Active` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lads`
--

INSERT INTO `lads` (`Id`, `Unique Id`, `User Id`, `Full Name`, `Email`, `Password`, `Gender`, `Image`, `Active`) VALUES
(1, 'e7123cbd420e919563ffc0b359c3cd27', 'community', 'OH Community', 'oh@community.com', '3538363964366135613064333535343939356539656566326262663132333662', 'male', '16209865623538609.png', 1622211481000),
(2, '29142d40e143940a1f0fb94de4d75b73', '3349e3db36d1cd5659c618f304c339fb5f2c3cd88011573e76105c9cfa9b798c51e2ac', 'Shirshen Shuvro', 'shuvro@gmail.com', '3033633763306163653339356438303138326462303761653263333066303334', 'male', '1620986812meOnTable.png', 1622211567),
(3, '8a90d311d041b6b34ec43f37068ebda9', 'e1e0db869081e571cdcbad7b5c7597133d79a749084b9a08ccf05a1ba5e771cc8196cc', 'Friend From Mars', 'test@id.com', '6533353865666134383966353830363266313064643733313662363536343965', 'female', '162098711420201026_110040.jpg', 1622210967);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `Id` int(11) NOT NULL,
  `sender_id` varchar(70) NOT NULL,
  `receiver_id` varchar(70) NOT NULL,
  `Message` longblob NOT NULL,
  `Time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `community`
--
ALTER TABLE `community`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `lads`
--
ALTER TABLE `lads`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `community`
--
ALTER TABLE `community`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lads`
--
ALTER TABLE `lads`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
