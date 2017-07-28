-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-07-28 07:48:59
-- 服务器版本： 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore-2`
--

-- --------------------------------------------------------

--
-- 表的结构 `bs_books`
--

CREATE TABLE `bs_books` (
  `bid` int(10) UNSIGNED NOT NULL,
  `bookName` varchar(255) COLLATE utf8_bin NOT NULL,
  `author` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `publisher` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `isOut` tinyint(1) NOT NULL DEFAULT '0',
  `genre` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `coverPath` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `holderId` int(10) DEFAULT '0',
  `detail` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `bs_books`
--

INSERT INTO `bs_books` (`bid`, `bookName`, `author`, `publisher`, `isOut`, `genre`, `coverPath`, `holderId`, `detail`) VALUES
(39, '2', '', '', 0, '文学', NULL, 0, ''),
(40, '3', '', '', 0, '文学', NULL, 0, ''),
(41, '4', '', '', 0, '文学', NULL, 0, ''),
(43, '三十而立', '王小波', '', 0, '文学', 'D:\\xampp\\htdocs\\git\\changshi_project\\thinkphp\\public\\uploads\\20170720\\90a383c2956923cd0adf65ccb31a296f.jpg', 0, ''),
(50, 'testBookName', 'notyet', 'fd', 0, NULL, NULL, 0, ''),
(51, 'fsdadf', NULL, NULL, 0, NULL, NULL, 0, ''),
(53, 'testBookName', NULL, NULL, 1, NULL, NULL, 0, ''),
(55, '123456', NULL, NULL, 0, NULL, NULL, 0, ''),
(56, '123456', NULL, NULL, 0, NULL, NULL, 0, ''),
(57, '123456', NULL, NULL, 0, NULL, NULL, 0, ''),
(58, '123456', NULL, NULL, 0, NULL, NULL, 0, ''),
(59, '123456', NULL, NULL, 0, NULL, NULL, 0, ''),
(60, '123456', NULL, NULL, 0, NULL, NULL, 0, ''),
(61, '123456', NULL, NULL, 0, NULL, NULL, 0, ''),
(62, '123456', NULL, NULL, 0, NULL, NULL, 0, ''),
(63, '123456', NULL, NULL, 0, NULL, NULL, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `bs_records`
--

CREATE TABLE `bs_records` (
  `rid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `userName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `bookName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `bid` int(10) UNSIGNED NOT NULL,
  `borrowTime` int(10) UNSIGNED NOT NULL,
  `returnTime` int(10) UNSIGNED DEFAULT '0',
  `isBack` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `bs_records`
--

INSERT INTO `bs_records` (`rid`, `uid`, `userName`, `bookName`, `bid`, `borrowTime`, `returnTime`, `isBack`) VALUES
(20, 0, '123', 'fsdadf', 51, 1501217246, 1501217246, 0),
(21, 0, '123', 'fsdadf', 51, 1501217321, 1501217321, 0),
(22, 0, '123', 'fsdadf', 51, 1501217323, 1501217323, 0),
(23, 0, '123', 'fsdadf', 51, 1501217356, 1501217356, 0),
(24, 0, '123', 'fsdadf', 51, 1501217447, 1501217447, 0),
(25, 0, '123', 'fsdadf', 51, 1501217508, 1501217508, 0);

-- --------------------------------------------------------

--
-- 表的结构 `bs_users`
--

CREATE TABLE `bs_users` (
  `uid` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `userName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `passWord` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1',
  `uType` tinyint(1) NOT NULL DEFAULT '0',
  `rigTime` int(10) NOT NULL,
  `editTime` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `bs_users`
--

INSERT INTO `bs_users` (`uid`, `name`, `userName`, `passWord`, `gender`, `uType`, `rigTime`, `editTime`) VALUES
(37, 'qwe', 'qwe', '202cb962ac59075b964b07152d234b70', 1, 0, 1500018164, 1500018164),
(38, '123', '123', '202cb962ac59075b964b07152d234b70', 1, 1, 1500018200, 1500018200),
(39, '753', '753', '6f2268bd1d3d3ebaabb04d6b5d099425', 1, 0, 1500018605, 1500018605),
(40, '456', '456', '250cf8b51c773f3f8dc8b4be867a9a02', 1, 0, 1500018750, 1500018750),
(41, 'j', 'j', '363b122c528f54df4a0446b6bab05515', 1, 0, 1500025801, 1500025801),
(42, 'q', 'q', '7694f4a66316e53c8cdd9d9954bd611d', 1, 0, 1500025952, 1500025952),
(43, 'a', 'a', '0cc175b9c0f1b6a831c399e269772661', 1, 0, 1500025977, 1500025977),
(44, 'as', 'as', 'f970e2767d0cfe75876ea857f92e319b', 1, 0, 1500026000, 1500026000),
(46, 'z', '   z', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 0, 1500026077, 1500026077),
(47, 'c', 'c', '4a8a08f09d37b73795649038408b5f33', 1, 0, 1500026489, 1500026489),
(48, 'qaz', 'qaz', '4eae18cf9e54a0f62b44176d074cbe2f', 1, 0, 1500253944, 1500253944),
(49, 'iop', 'iop', '9fbfb220e03aa76d424088e43314b0d0', 1, 0, 1500254712, 1500254712),
(50, '4646', 'testName', '50f3f8c42b998a48057e9d33f4144b8b', 1, 0, 1500275027, 1500878852),
(51, '7979', '7979', '1eb590c1259ff05809830227e2b7e782', 1, 0, 1500275155, 1500275155),
(52, '345', '345', 'd81f9c1be2e08964bf9f24b15f0e4900', 1, 0, 1500340999, 1500340999),
(55, 'charles', 'charlesTestName', 'charlesTestName', 1, 0, 1500975320, 1500975320),
(56, '123', '123', '123', 1, 0, 1501032408, 1501032408),
(58, 'charles', 'charles', 'charles', 1, 0, 1501032565, 1501032565),
(60, 'itcantbe', 'itcantbe', 'itcantbe', 1, 0, 1501036115, 1501036115),
(61, 'asdf', 'sadfsc', 'sadfsc', 1, 0, 1501036228, 1501036228),
(67, 'ghj', 'ghj', 'ea7d201d1cdd240f3798b2dc51d6adcb', 1, 0, 1501056299, 1501056299),
(68, 'wer', 'wer', '22c276a05aa7c90566ae2175bcc2a9b0', 1, 0, 1501056359, 1501056359),
(69, 'cvb', 'cvb', '116fa690d8dd9c3bd7465b59158f995c', 1, 0, 1501059502, 1501059502),
(70, 'zxc', 'zxc', '5fa72358f0b4fb4f2c5d7de8c9a41846', 1, 0, 1501059659, 1501059659);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bs_books`
--
ALTER TABLE `bs_books`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `bs_records`
--
ALTER TABLE `bs_records`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `bs_users`
--
ALTER TABLE `bs_users`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `name` (`name`),
  ADD KEY `userName` (`userName`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bs_books`
--
ALTER TABLE `bs_books`
  MODIFY `bid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- 使用表AUTO_INCREMENT `bs_records`
--
ALTER TABLE `bs_records`
  MODIFY `rid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用表AUTO_INCREMENT `bs_users`
--
ALTER TABLE `bs_users`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
