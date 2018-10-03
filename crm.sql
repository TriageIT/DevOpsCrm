-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2018 at 02:40 PM
-- Server version: 5.5.60-0+deb8u1
-- PHP Version: 5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c6bedrijfsadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `accompanies`
--

CREATE TABLE `accompanies` (
  `FK_EMPL_ID` int(11) NOT NULL,
  `FK_CUSTOMER_VISIT_ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `ACTION_ID` int(11) NOT NULL,
  `ACTION_DATE` date DEFAULT NULL,
  `ACTION_DESCRIPTION` char(250) NOT NULL DEFAULT '',
  `ACTION_NOTES` char(240) DEFAULT NULL,
  `ACTION_STATUS` char(1) DEFAULT NULL,
  `ACTION_CREATOR` int(11) NOT NULL,
  `ACTION_CREATION_DATE` date NOT NULL,
  `ACTION_SORT` text NOT NULL,
  `FK_COMPANY_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `BILLING_ID` int(11) NOT NULL,
  `FK_CONTRACT_ID` int(11) NOT NULL,
  `FK_TIMESHEET_ID` int(11) NOT NULL,
  `BILLING_DATE` date DEFAULT NULL,
  `BILLABLE_HOURS` double(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `BOOK_ID` int(11) NOT NULL,
  `BOOK_DATE` date DEFAULT NULL,
  `BOOK_TITLE` char(250) NOT NULL DEFAULT '',
  `BOOK_AUTHOR` char(250) NOT NULL DEFAULT '',
  `BOOK_NOTES` char(240) DEFAULT NULL,
  `BOOK_STATUS` char(1) DEFAULT NULL,
  `BOOK_COUNT` char(1) DEFAULT NULL,
  `BOOK_CREATOR` int(11) NOT NULL,
  `BOOK_CREATION_DATE` date NOT NULL,
  `BOOK_SORT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branche`
--

CREATE TABLE `branche` (
  `BRANCHE_ID` int(11) NOT NULL DEFAULT '0',
  `BRANCHE_NAME` varchar(30) NOT NULL DEFAULT '',
  `BRANCHE_DESCRIPTION` varchar(100) DEFAULT NULL,
  `BRANCHE_CREATION_DATE` date DEFAULT NULL,
  `BRANCHE_CREATOR` int(11) DEFAULT NULL,
  `BRANCHE_OWNER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

INSERT INTO `branche` (`BRANCHE_ID`, `BRANCHE_NAME`, `BRANCHE_DESCRIPTION`, `BRANCHE_CREATION_DATE`, `BRANCHE_CREATOR`, `BRANCHE_OWNER`) VALUES
(1, 'Banking', NULL, '2008-03-01', 1, 1),
(2, 'Bicycles', NULL, '2008-03-01', 1, 1),
(3, 'Supermarket', NULL, '2008-03-01', 1, 1),
(4, 'Land Ownership', NULL, '2008-03-01', 1, 1),
(5, 'Lease Organisation', NULL, '2008-03-01', 1, 1),
(6, 'Telecom', NULL, '2008-03-01', 1, 1),
(7, 'Flowers', NULL, '2008-03-01', 1, 1),
(8, 'Taxes', NULL, '2008-03-01', 1, 1),
(9, 'Insurance', NULL, '2008-03-01', 1, 1),
(10, 'Consultancy', NULL, '2008-03-01', 1, 1),
(11, 'Education', NULL, '2008-03-01', 1, 1),
(12, 'Credit Company', '', '2008-03-01', 1, 1),
(13, 'Army', NULL, '2008-03-01', 1, 1),
(14, 'Food', NULL, '2008-03-01', 1, 1),
(15, 'Pension', NULL, '2008-03-01', 1, 1),
(16, 'Software Vendor', NULL, '2008-03-01', 1, 1),
(17, 'KvK', NULL, '2008-03-01', 1, 1),
(18, 'Cars', NULL, '2008-03-01', 1, 1),
(19, 'Students loans', NULL, '2008-03-01', 1, 1),
(20, 'Arbodienst', '', '2008-03-01', 1, 1),
(21, 'Conferences & Training', NULL, '2008-03-01', 1, 1),
(22, 'Consumer Electronics', NULL, '2008-03-01', 1, 1),
(23, 'ISP', NULL, '2008-03-01', 1, 1),
(24, 'Merchandising', NULL, '2008-03-01', 1, 1),
(25, 'Logistics', NULL, '2008-03-01', 1, 1),
(26, 'Energy', NULL, '2008-03-01', 1, 1),
(27, 'Vliegtuigmaatschappijen', '', '2008-03-01', 1, 1),
(28, 'University', NULL, '2008-03-01', 1, 1),
(29, 'Gemeente', NULL, '2008-03-01', 1, 1),
(30, 'Pharmacy', NULL, '2008-03-01', 1, 1),
(31, 'Construction Company', NULL, '2008-03-01', 1, 1),
(32, 'Police Department', NULL, '2008-03-01', 1, 1),
(33, 'Makelaars', NULL, '2008-03-01', 1, 1),
(34, 'Childsupport', NULL, '2008-03-01', 1, 1),
(35, 'Morgages', NULL, '2008-03-01', 1, 1),
(36, 'Investment Banking', NULL, '2008-03-01', 1, 1),
(37, 'Statistics', NULL, '2008-03-01', 1, 1),
(38, 'Patents', NULL, '2008-03-01', 1, 1),
(39, 'Hospital', NULL, '2008-03-01', 1, 1),
(40, 'Ministerie van Landbouw', NULL, '2008-03-01', 1, 1),
(41, 'Justice', NULL, '2008-03-01', 1, 1),
(42, 'Minsteries', NULL, '2008-03-01', 1, 1),
(43, 'Telemarketing', NULL, '2008-03-01', 1, 1),
(44, 'Chemistry', NULL, '2008-03-01', 1, 1);

--
-- Table structure for table `calender`
--

CREATE TABLE `calender` (
  `CALENDER_ID` int(11) NOT NULL,
  `CALENDER_DATE` date NOT NULL,
  `CALENDER_DESCRIPTION` text NOT NULL,
  `CALENDER_SORT` text NOT NULL,
  `CALENDER_CREATOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `COMPANY_ID` int(11) NOT NULL DEFAULT '0',
  `FK_BRANCHE_ID` int(11) NOT NULL,
  `FK_HOLDING_ID` int(11) NOT NULL DEFAULT '0',
  `FK_COMPANY_STATUS_ID` int(11) DEFAULT NULL,
  `COMPANY_NAME` char(40) NOT NULL DEFAULT '',
  `COMPANY_ADDRESS` char(50) DEFAULT NULL,
  `COMPANY_ZIPCODE` char(8) DEFAULT NULL,
  `COMPANY_CITY` char(50) DEFAULT NULL,
  `COMPANY_PHONE` char(12) DEFAULT NULL,
  `COMPANY_FAX` char(12) DEFAULT NULL,
  `COMPANY_ASK` text,
  `COMPANY_DIRECT` text,
  `BILLING_HEADER` varchar(50) DEFAULT NULL,
  `BILLING_ADDRESS` varchar(50) DEFAULT NULL,
  `BILLING_ZIPCODE` varchar(8) DEFAULT NULL,
  `BILLING_CITY` varchar(50) DEFAULT NULL,
  `COMPANY_POBOX` varchar(8) DEFAULT NULL,
  `COMPANY_NOTES` char(255) DEFAULT NULL,
  `COMPANY_STATUS` varchar(1) DEFAULT ' ',
  `COMPANY_BILLINGNUMBER` int(5) DEFAULT NULL,
  `REFERENCE_SITE` char(1) DEFAULT NULL,
  `COM_CREATION_DATE` date DEFAULT NULL,
  `COM_CREATOR` int(11) DEFAULT NULL,
  `COM_OWNER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_status`
--

CREATE TABLE `company_status` (
  `COMPANY_STATUS_ID` int(11) NOT NULL,
  `COMPANY_STATUS_NAME` varchar(50) NOT NULL,
  `COMPANY_STATUS_DESCIPTION` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `CONTACT_ID` int(11) NOT NULL DEFAULT '0',
  `FK_COMPANY_ID` int(11) DEFAULT NULL,
  `FK_FUNCTION_ID` int(11) DEFAULT NULL,
  `CONTACT_SURNAME` varchar(20) DEFAULT NULL,
  `CONTACT_FIRSTNAME` varchar(20) DEFAULT NULL,
  `CONTACT_PHONE` varchar(15) DEFAULT NULL,
  `CONTACT_FAXNUMBER` varchar(15) DEFAULT NULL,
  `CONTACT_MOBILENUMBER` varchar(15) DEFAULT NULL,
  `CONTACT_EMAIL` varchar(55) DEFAULT NULL,
  `CONTACT_DMU` char(1) DEFAULT NULL,
  `CONTACT_ASK` char(1) NOT NULL DEFAULT 'N',
  `CONTACT_BUDGET` char(1) NOT NULL DEFAULT 'N',
  `CONTACT_SOURCE` char(1) NOT NULL DEFAULT 'N',
  `CONTACT_ZZP` char(1) NOT NULL,
  `CONTRACTER_EMAIL` varchar(60) DEFAULT NULL,
  `PRIVATE_ADDRESS` varchar(25) DEFAULT NULL,
  `PRIVATE_HOUSENUMBER` varchar(5) DEFAULT NULL,
  `PRIVATE_ZIPCODE` varchar(8) DEFAULT NULL,
  `PRIVATE_CITY` varchar(20) DEFAULT NULL,
  `PRIVATE_PHONE` varchar(15) DEFAULT NULL,
  `PRIVATE_MAIL` varchar(35) DEFAULT NULL,
  `CONTACT_NOTES` longtext,
  `CONTACT_STATUS` char(1) DEFAULT NULL,
  `C_CREATION_DATE` date NOT NULL,
  `C_CREATOR` int(11) DEFAULT NULL,
  `C_OWNER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_for`
--

CREATE TABLE `contact_for` (
  `FK_CONTACT_ID` smallint(6) NOT NULL DEFAULT '0',
  `FK_CONTRACT_ID` int(11) NOT NULL DEFAULT '0',
  `CONTRACT_DMU` text,
  `CONTRACT_ASK` text,
  `CONTRACT_SOURCE` text,
  `CONTRACT_BUDGET` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `CONTRACT_ID` int(11) NOT NULL,
  `FK_CONTACT_ID` int(11) NOT NULL,
  `FK_COMPANY_ID` int(11) NOT NULL,
  `FK_PROGRAM_ID` int(11) DEFAULT NULL,
  `CONTRACT_NAME` varchar(35) NOT NULL,
  `CONTRACT_DESCRIPTION` varchar(200) NOT NULL,
  `CONTRACT_STATUS` varchar(1) NOT NULL,
  `CONTRACT_RATE` int(5) DEFAULT NULL,
  `CONTRACT_START_DATE` date DEFAULT NULL,
  `CONTRACT_END` date DEFAULT NULL,
  `CONTRACT_END_DATE` date DEFAULT NULL,
  `CONTRACT_CREATION_DATE` date NOT NULL,
  `CONTRACT_CREATOR` int(11) NOT NULL,
  `CONTRACT_OWNER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contract_has_employee`
--

CREATE TABLE `contract_has_employee` (
  `RELATION_ID` int(11) NOT NULL,
  `FK_EMPL_ID` int(11) NOT NULL,
  `FK_CONTRACT_ID` int(11) NOT NULL,
  `FK_CONTACT_ID` int(11) NOT NULL,
  `FK_COMPANY_ID` int(11) DEFAULT NULL,
  `FK_FUNCTION_ID` int(11) DEFAULT NULL,
  `RELATION_START_DATE` date DEFAULT NULL,
  `RELATION_END_DATE` date DEFAULT NULL,
  `RELATION_END` date DEFAULT NULL,
  `RELATION_RATE` decimal(5,2) DEFAULT '0.00',
  `RELATION_COST` decimal(5,2) DEFAULT NULL,
  `RELATION_MARGE` decimal(5,2) DEFAULT '0.00',
  `RELATION_NOTES` text,
  `RELATION_KM_PRICE` decimal(3,2) DEFAULT NULL,
  `RELATION_STATUS` text,
  `BILLING_ADDRESS_01` text,
  `BILLING_ADDRESS_02` text,
  `BILLING_ADDRESS_03` text,
  `BILLING_ADDRESS_04` text,
  `BILLING_REMARK` text,
  `BILLING_CLOSING` text,
  `TIMESHEET_REMARK` text,
  `RELATION_CREATOR` int(11) DEFAULT NULL,
  `RELATION_CREATION_DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `COST_ID` int(11) NOT NULL,
  `COST_VALUE` double(5,2) DEFAULT NULL,
  `COST_DATE` date DEFAULT NULL,
  `BILLABLE_YN` varchar(1) NOT NULL,
  `FK_TIMESHEET_ID` int(11) NOT NULL,
  `FK_COST_TYPE` int(11) NOT NULL,
  `COST_CREATOR` int(11) NOT NULL,
  `COST_CREATION_DATE` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cost_type`
--

CREATE TABLE `cost_type` (
  `COST_TYPE_ID` int(11) NOT NULL,
  `COST_TYPE_NAME` text NOT NULL,
  `COST_TYPE_CREATOR` int(11) NOT NULL,
  `COST_TYPE_CREATION_DATE` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_visit`
--

CREATE TABLE `customer_visit` (
  `VISIT_ID` int(11) NOT NULL,
  `VISIT_DATE` date DEFAULT NULL,
  `VISIT_DESCRIPTION` varchar(50) DEFAULT NULL,
  `VISIT_NOTES` longtext,
  `VISIT_DOC` text NOT NULL,
  `FK_COMPANY_ID` int(11) DEFAULT NULL,
  `VISIT_CREATOR` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EMPL_ID` int(11) NOT NULL DEFAULT '0',
  `FK_FUNCTION_ID` int(11) NOT NULL,
  `FK_COMPANY_ID` int(11) DEFAULT NULL,
  `EMPL_USERID` varchar(10) NOT NULL,
  `EMPL_FIRSTNAME` varchar(15) DEFAULT NULL,
  `EMPL_LASTNAME` varchar(30) DEFAULT NULL,
  `EMPL_MAIL` varchar(45) DEFAULT NULL,
  `EMPL_PHONE` varchar(15) DEFAULT NULL,
  `EMPL_PASSWORD` varchar(35) DEFAULT NULL,
  `EMPL_ADMIN` char(1) DEFAULT NULL,
  `EMPL_STATUS` char(1) DEFAULT NULL,
  `EMPL_ZZP` varchar(1) NOT NULL DEFAULT 'Y',
  `EMPL_RATE` int(5) DEFAULT NULL,
  `EMPL_NUMBER_HOLIDAYS` int(2) DEFAULT NULL,
  `EMPL_NOTES` varchar(255) DEFAULT NULL,
  `EMPL_PROFILE` text,
  `PRIVATE_ADDRESS` varchar(45) DEFAULT NULL,
  `PRIVATE_NUMBER` varchar(5) DEFAULT NULL,
  `PRIVATE_ZIPCODE` varchar(8) DEFAULT NULL,
  `PRIVATE_CITY` varchar(45) DEFAULT NULL,
  `PRIVATE_PHONE` varchar(15) DEFAULT NULL,
  `PRIVATE_MOBILE` varchar(15) DEFAULT NULL,
  `PRIVATE_MAIL` varchar(45) DEFAULT NULL,
  `PRIVATE_BIRTHDAY` date DEFAULT NULL,
  `EMPL_START_DATE` date DEFAULT NULL,
  `EMPL_END_DATE` date DEFAULT NULL,
  `MAX_NUMBER_DAYS` int(11) DEFAULT '5',
  `MAX_NUMBER_HOURS` int(11) DEFAULT '40',
  `EMPL_CREATION_DATE` date NOT NULL,
  `EMPL_CREATOR` int(11) NOT NULL,
  `EMPL_OWNER` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

INSERT INTO `employee` (`EMPL_ID`, `FK_FUNCTION_ID`, `FK_COMPANY_ID`, `EMPL_USERID`, `EMPL_FIRSTNAME`, `EMPL_LASTNAME`, `EMPL_MAIL`, `EMPL_PHONE`, `EMPL_PASSWORD`, `EMPL_ADMIN`, `EMPL_STATUS`, `EMPL_ZZP`, `EMPL_RATE`, `EMPL_NUMBER_HOLIDAYS`, `EMPL_NOTES`, `EMPL_PROFILE`, `PRIVATE_ADDRESS`, `PRIVATE_NUMBER`, `PRIVATE_ZIPCODE`, `PRIVATE_CITY`, `PRIVATE_PHONE`, `PRIVATE_MOBILE`, `PRIVATE_MAIL`, `PRIVATE_BIRTHDAY`, `EMPL_START_DATE`, `EMPL_END_DATE`, `MAX_NUMBER_DAYS`, `MAX_NUMBER_HOURS`, `EMPL_CREATION_DATE`, `EMPL_CREATOR`, `EMPL_OWNER`) VALUES
(1, 1, NULL, 'paul', 'Paul', 'Willems', 'PAUL.WILLEMS@TRIAGE-IT.NL', '0615954824', '6c63212ab48e8401eaf6b59b95d816a9', 'Y', 'A', 'N', NULL, 0, '', '', 'Fazantstraat', '13', '4105WL', 'Culemborg', '0345-516216', NULL, 'WUIFUTRECHT@HOTMAIL.COM', NULL, '2008-10-01', NULL, 5, 36, '2008-05-07', 1, 1);

--
-- Table structure for table `emp_function`
--

CREATE TABLE `emp_function` (
  `FUNCTION_ID` int(11) NOT NULL,
  `FUNCTION_NAME` char(25) NOT NULL DEFAULT '',
  `FUNCTION_DESCR` char(50) DEFAULT NULL,
  `FUNCTION_STATUS` char(1) NOT NULL DEFAULT '',
  `CREATION_DATE` date DEFAULT NULL,
  `FUNC_CREATOR` int(11) NOT NULL,
  `FUNC_OWNER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `executes`
--

CREATE TABLE `executes` (
  `FK_ACTION_ID` int(11) NOT NULL,
  `FK_EMPL_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ext_function`
--

CREATE TABLE `ext_function` (
  `FUNCTION_ID` int(11) NOT NULL,
  `FUNCTION_NAME` char(25) NOT NULL DEFAULT '',
  `FUNCTION_DESCR` text,
  `FUNCTION_SKILLS` text,
  `FUNCTION_EXTRA` text,
  `FUNCTION_ORG` text,
  `FUNCTION_STATUS` char(1) NOT NULL DEFAULT '',
  `CREATION_DATE` date DEFAULT NULL,
  `FUNC_CREATOR` int(11) NOT NULL,
  `FUNC_OWNER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `function`
--

CREATE TABLE `function` (
  `FUNCTION_ID` int(11) NOT NULL,
  `FUNCTION_NAME` char(25) NOT NULL DEFAULT '',
  `FUNCTION_DESCR` char(250) DEFAULT NULL,
  `FUNCTION_STATUS` char(1) NOT NULL DEFAULT '',
  `CREATION_DATE` date DEFAULT NULL,
  `FUNC_CREATOR` int(11) NOT NULL,
  `FUNC_OWNER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `goal_sort`
--

CREATE TABLE `goal_sort` (
  `GOAL_SORT_ID` int(11) NOT NULL DEFAULT '0',
  `GOAL_SORT_NAME` char(25) NOT NULL,
  `GOAL_SORT_DESCRIPTION` char(240) DEFAULT NULL,
  `GOAL_UNIT` text NOT NULL,
  `GOAL_SORT_CREATOR` int(11) DEFAULT NULL,
  `GOAL_SORT_DATE` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `goal_status`
--

CREATE TABLE `goal_status` (
  `GOAL_STATUS_ID` int(11) NOT NULL DEFAULT '0',
  `GOAL_STATUS_NAME` varchar(15) NOT NULL,
  `GOAL_STATUS_DESCRIPTION` char(240) DEFAULT NULL,
  `GOAL_STATUS_CREATOR` int(11) DEFAULT NULL,
  `GOAL_STATUS_DATE` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `had_as_an_employee`
--

CREATE TABLE `had_as_an_employee` (
  `FK_COMPANY_ID` int(11) NOT NULL,
  `FK_CONTACT_ID` int(11) NOT NULL,
  `CHANGE_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_employee`
--

CREATE TABLE `history_employee` (
  `HISTORY_ID` int(11) NOT NULL,
  `FK_FUNCTION_ID` int(11) NOT NULL,
  `EMPL_ID` int(11) NOT NULL DEFAULT '0',
  `EMPL_ACTION` char(20) NOT NULL,
  `EMPL_FIRSTNAME` varchar(15) DEFAULT NULL,
  `EMPL_LASTNAME` varchar(30) DEFAULT NULL,
  `EMPL_MAIL` varchar(45) DEFAULT NULL,
  `EMPL_PHONE` varchar(15) DEFAULT NULL,
  `EMPL_ADMIN` char(1) NOT NULL DEFAULT '',
  `EMPL_ZZP` varchar(1) DEFAULT NULL,
  `EMPL_NUMBER_HOLIDAYS` int(2) DEFAULT NULL,
  `EMPL_STATUS` char(1) NOT NULL DEFAULT '',
  `EMPL_NOTES` varchar(255) DEFAULT NULL,
  `EMPL_PROFILE` text,
  `PRIVATE_ADDRESS` varchar(45) DEFAULT NULL,
  `PRIVATE_NUMBER` varchar(5) DEFAULT NULL,
  `PRIVATE_ZIPCODE` varchar(6) DEFAULT NULL,
  `PRIVATE_CITY` varchar(45) DEFAULT NULL,
  `PRIVATE_PHONE` varchar(15) DEFAULT NULL,
  `PRIVATE_MOBILE` varchar(15) DEFAULT NULL,
  `PRIVATE_MAIL` varchar(45) DEFAULT NULL,
  `FK_OLD_FUNCTION_ID` int(11) DEFAULT NULL,
  `FK_OLD_CONTRACT_ID` int(11) DEFAULT NULL,
  `EMPL_START_DATE` date DEFAULT NULL,
  `EMPL_END_DATE` date DEFAULT NULL,
  `MAX_NUMBER_DAYS` int(1) DEFAULT NULL,
  `MAX_NUMBER_HOURS` int(2) DEFAULT NULL,
  `EMPL_LOG_DATE` date NOT NULL,
  `EMPL_CREATOR` int(11) NOT NULL,
  `EMPL_OWNER` int(11) NOT NULL,
  `HISTORY_CREATOR` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_login`
--

CREATE TABLE `history_login` (
  `LOGIN_ID` int(11) NOT NULL,
  `LOGIN_DATE` date DEFAULT NULL,
  `LOGIN_TIME` time DEFAULT NULL,
  `FK_EMPL_ID` int(11) NOT NULL,
  `FK_FUNCTION_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `holding`
--

CREATE TABLE `holding` (
  `HOLDING_ID` int(11) NOT NULL DEFAULT '0',
  `HOLDING_NAME` varchar(60) NOT NULL DEFAULT '',
  `HOLDING_NOTES` varchar(255) DEFAULT NULL,
  `HOLDING_CREATION_DATE` date DEFAULT NULL,
  `HOLDING_CREATOR` int(11) DEFAULT NULL,
  `HOLDING_OWNER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `HOLIDAY_ID` int(11) NOT NULL,
  `HOLIDAY_DESCRIPTION` text,
  `HOLIDAY_START_DATE` date NOT NULL,
  `HOLIDAY_END_DATE` date NOT NULL,
  `HOLIDAY_START_VALUE` double(4,1) NOT NULL,
  `HOLIDAY_END_VALUE` double(4,1) NOT NULL,
  `HOLIDAY_VALUE` double(4,1) DEFAULT NULL,
  `HOLIDAY_STATUS` varchar(1) DEFAULT NULL,
  `HOLIDAY_CREATOR` int(11) NOT NULL,
  `HOLIDAY_CREATION_DATE` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead`
--

CREATE TABLE `lead` (
  `LEAD_ID` int(11) NOT NULL DEFAULT '0',
  `FK_COMPANY_ID` int(11) NOT NULL,
  `FK_LEAD_BUSINESS_OWNER` int(11) NOT NULL,
  `FK_LEAD_STATUS` int(11) NOT NULL,
  `FK_LEAD_SORT` int(11) NOT NULL,
  `LEAD_NAME` char(30) NOT NULL,
  `LEAD_AMOUNT` decimal(8,2) DEFAULT NULL,
  `LEAD_DATE` date DEFAULT NULL,
  `LEAD_INSIDE` char(1) DEFAULT NULL,
  `LEAD_PERCENTAGE` smallint(6) DEFAULT NULL,
  `LEAD_DESCRIPTION` char(240) DEFAULT NULL,
  `LEAD_CREATOR` int(11) DEFAULT NULL,
  `LEAD_OWNER` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead_sort`
--

CREATE TABLE `lead_sort` (
  `LEAD_SORT_ID` int(11) NOT NULL DEFAULT '0',
  `LEAD_SORT_NAME` char(25) NOT NULL,
  `LEAD_SORT_DESCRIPTION` char(240) DEFAULT NULL,
  `LEAD_SORT_CREATOR` int(11) DEFAULT NULL,
  `LEAD_SORT_DATE` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead_status`
--

CREATE TABLE `lead_status` (
  `LEAD_STATUS_ID` int(11) NOT NULL DEFAULT '0',
  `LEAD_STATUS_NAME` varchar(15) NOT NULL,
  `LEAD_STATUS_DESCRIPTION` char(240) DEFAULT NULL,
  `LEAD_STATUS_CREATOR` int(11) DEFAULT NULL,
  `LEAD_STATUS_DATE` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loaned_to`
--

CREATE TABLE `loaned_to` (
  `LOAN_ID` int(11) NOT NULL,
  `FK_EMPL_ID` int(11) DEFAULT NULL,
  `FK_ADMIN` int(11) NOT NULL,
  `LOAN_DATE` date NOT NULL,
  `FK_BOOK_ID` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `MAIL_ID` int(11) NOT NULL,
  `FK_EMPL_ID` int(11) NOT NULL,
  `FK_CONTACT_ID` int(11) NOT NULL,
  `MAIL_DATE` text NOT NULL,
  `MAIL_SUBJECT` text,
  `MAIL_BODY` text,
  `MAIL_ADDRESS` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MESSAGE_ID` int(11) NOT NULL,
  `MESSAGE_SHORTTEXT` char(25) NOT NULL,
  `MESSAGE_FULLTEXT` varchar(250) NOT NULL,
  `MESSAGE_DATE` date NOT NULL,
  `MESSAGE_TIME` time NOT NULL,
  `FK_EMPL_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mycompany`
--

CREATE TABLE `mycompany` (
  `MYCOMP_ID` smallint(6) NOT NULL DEFAULT '0',
  `BEDRIJFNAAM` char(30) NOT NULL DEFAULT '',
  `BEDRIJFFACSTRAAT` char(35) DEFAULT NULL,
  `BEDRIJFFACHUISNR` char(5) DEFAULT NULL,
  `BEDRIJFFACPOSTCODE` char(6) DEFAULT NULL,
  `BEDRIJFFACSTAD` char(35) DEFAULT NULL,
  `BEDRIJFPOSTSTRAAT` char(35) DEFAULT NULL,
  `BEDRIJFPOSTHUISNR` char(5) DEFAULT NULL,
  `BEDRIJFPOSTPOSTCODE` char(6) DEFAULT NULL,
  `BEDRIJFPOSTSTAD` char(35) DEFAULT NULL,
  `BEDRIJFTELEFOON` char(11) DEFAULT NULL,
  `BEDRIJFFAX` char(11) DEFAULT NULL,
  `BEDRIJFMOBIEL` char(11) DEFAULT NULL,
  `BEDRIJFBANKNUMMER` char(11) DEFAULT NULL,
  `BEDRIJFGIRONUMMER` char(11) DEFAULT NULL,
  `BEDRIJFKVK` char(8) DEFAULT NULL,
  `BEDRIJFBTW` char(12) DEFAULT NULL,
  `BEDRIJFWEBSITE` char(35) DEFAULT NULL,
  `BEDRIJFEMAIL` char(25) DEFAULT NULL,
  `POSTBUSNUMMER` char(6) DEFAULT NULL,
  `ANTWOORDNUMMER` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `non_billable_hour_type`
--

CREATE TABLE `non_billable_hour_type` (
  `NON_BILLABLE_HOUR_TYPE_ID` int(11) NOT NULL,
  `NON_BILLABLE_HOUR_TYPE_NAME` text NOT NULL,
  `NON_BILLABLE_HOUR_TYPE_CREATOR` int(11) NOT NULL,
  `NON_BILLABLE_HOUR_TYPE_CREATION_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `NOTES_ID` int(11) NOT NULL,
  `NOTES_DATE` date NOT NULL,
  `FK_EMPL_ID` int(11) DEFAULT NULL,
  `FK_CONTACT_ID` int(11) DEFAULT NULL,
  `FK_RELATION_ID` int(11) DEFAULT NULL,
  `NOTES_DESCRIPTION` text,
  `NOTES_TEXT` text,
  `NOTES_CREATION_DATE` date NOT NULL,
  `NOTES_CREATOR` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `PERSON_ID` int(11) NOT NULL DEFAULT '0',
  `FK_FUNCTION_ID` int(11) NOT NULL,
  `FK_COMPANY_ID` int(11) DEFAULT NULL,
  `PERSON_USERID` varchar(10) NOT NULL,
  `PERSON_FIRSTNAME` varchar(15) DEFAULT NULL,
  `PERSON_LASTNAME` varchar(30) DEFAULT NULL,
  `PERSON_MAIL` varchar(45) DEFAULT NULL,
  `CONTRACTER_EMAIL` varchar(60) DEFAULT NULL,
  `PERSON_PHONE` varchar(15) DEFAULT NULL,
  `PERSON_MOBILENUMBER` varchar(10) DEFAULT NULL,
  `PERSON_FAXNUMBER` varchar(10) DEFAULT NULL,
  `PERSON_PASSWORD` varchar(8) DEFAULT NULL,
  `PERSON_ADMIN` char(1) DEFAULT NULL,
  `PERSON_STATUS` char(1) DEFAULT NULL,
  `PERSON_TYPE` varchar(2) NOT NULL,
  `PERSON_DMU` char(1) DEFAULT NULL,
  `PERSON_ZZP` varchar(1) NOT NULL DEFAULT 'Y',
  `PERSON_NOTES` varchar(255) DEFAULT NULL,
  `PERSON_PROFILE` text,
  `PRIVATE_ADDRESS` varchar(45) DEFAULT NULL,
  `PRIVATE_NUMBER` varchar(5) DEFAULT NULL,
  `PRIVATE_ZIPCODE` varchar(6) DEFAULT NULL,
  `PRIVATE_CITY` varchar(45) DEFAULT NULL,
  `PRIVATE_PHONE` varchar(15) DEFAULT NULL,
  `PRIVATE_MOBILE` varchar(15) DEFAULT NULL,
  `PRIVATE_MAIL` varchar(45) DEFAULT NULL,
  `PERSON_START_DATE` date DEFAULT NULL,
  `PERSON_END_DATE` date DEFAULT NULL,
  `PERSON_CREATION_DATE` date NOT NULL,
  `PERSON_CREATOR` int(11) NOT NULL,
  `PERSON_OWNER` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `FK_EMPL_ID` int(11) NOT NULL,
  `MONDAY_HOURS` int(1) NOT NULL,
  `TUESDAY_HOURS` int(1) NOT NULL,
  `WEDNESDAY_HOURS` int(1) NOT NULL,
  `THURSDAY_HOURS` int(1) NOT NULL,
  `FRIDAY_HOURS` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `PROGRAM_ID` int(11) NOT NULL DEFAULT '0',
  `FK_COMPANY_ID` int(11) NOT NULL DEFAULT '0',
  `FK_PROG_MAN_ID` int(11) NOT NULL,
  `FK_DMU_ID` int(11) DEFAULT NULL,
  `FK_ASK_ID` int(11) DEFAULT NULL,
  `FK_BUDGET_ID` int(11) DEFAULT NULL,
  `FK_STRATEGY_ID` int(11) NOT NULL,
  `PROGRAM_NAME` char(40) NOT NULL DEFAULT '',
  `PROGRAM_GOAL` char(255) DEFAULT NULL,
  `PROGRAM_NOTES` char(255) DEFAULT NULL,
  `PROGRAM_STATUS` varchar(1) DEFAULT ' ',
  `PROG_START_DATE` date NOT NULL,
  `PROG_END_DATE` date NOT NULL,
  `PROG_CREATION_DATE` date DEFAULT NULL,
  `PROG_CREATOR` int(11) DEFAULT NULL,
  `PROG_OWNER` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `PROJECT_ID` int(11) NOT NULL DEFAULT '0',
  `FK_PROGRAM_ID` int(11) NOT NULL,
  `FK_EMPL_ID` int(11) NOT NULL,
  `PROJECT_NAME` char(40) NOT NULL DEFAULT '',
  `PROJECT_GOAL` char(255) DEFAULT NULL,
  `PROJECT_NOTES` char(255) DEFAULT NULL,
  `PROJECT_STATUS` varchar(1) DEFAULT ' ',
  `PROJECT_START_DATE` date NOT NULL,
  `PROJECT_END_DATE` date NOT NULL,
  `PROJECT_CREATION_DATE` date DEFAULT NULL,
  `PROJECT_CREATOR` int(11) DEFAULT NULL,
  `PROJECT_OWNER` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_sort`
--

CREATE TABLE `project_sort` (
  `PROJECT_SORT_ID` int(11) NOT NULL DEFAULT '0',
  `PROJECT_SORT_NAME` char(25) NOT NULL,
  `PROJECT_SORT_DESCRIPTION` char(240) DEFAULT NULL,
  `PROJECT_SORT_CREATOR` int(11) DEFAULT NULL,
  `PROJECT_SORT_DATE` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

CREATE TABLE `project_status` (
  `PROJECT_STATUS_ID` int(11) NOT NULL DEFAULT '0',
  `PROJECT_STATUS_NAME` varchar(15) NOT NULL,
  `PROJECT_STATUS_DESCRIPTION` char(240) DEFAULT NULL,
  `PROJECT_STATUS_CREATOR` int(11) DEFAULT NULL,
  `PROJECT_STATUS_DATE` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receives`
--

CREATE TABLE `receives` (
  `FK_CONTACT_ID` int(11) NOT NULL,
  `FK_CUSTOMER_VISIT_ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receives_bills`
--

CREATE TABLE `receives_bills` (
  `FK_COMPANY_ID` int(11) NOT NULL,
  `FK_RELATION_ID` int(11) NOT NULL,
  `FK_CONTACT_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requires`
--

CREATE TABLE `requires` (
  `FK_ACTION_ID` int(11) NOT NULL,
  `FK_CONTACT_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timesheet`
--

CREATE TABLE `timesheet` (
  `TIMESHEET_ID` int(11) NOT NULL,
  `FK_EMPL_ID` int(11) NOT NULL,
  `FK_CONTRACT_ID` int(11) NOT NULL,
  `TIMESHEET_CREATION_DATE` date NOT NULL,
  `TIMESHEET_PERIOD` int(2) NOT NULL,
  `TOTAL_BILLABLE` float DEFAULT NULL,
  `TOTAL_BILLABLE_KM` float DEFAULT NULL,
  `TOTAL_NON_BILLABLE` float DEFAULT NULL,
  `TIMESHEET_YEAR` int(4) NOT NULL,
  `TIMESHEET_STATUS` text NOT NULL,
  `TIMESHEET_CREATOR` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_line`
--

CREATE TABLE `timesheet_line` (
  `TIMESHEET_LINE_ID` int(11) NOT NULL,
  `FK_TIMESHEET_ID` int(11) NOT NULL,
  `FK_WORKED_HOURS_TYPE_ID` int(11) NOT NULL,
  `FK_TRAVEL_TYPE_ID` int(11) NOT NULL,
  `TIMESHEET_LINE_HOURS` float DEFAULT '0',
  `TIMESHEET_LINE_HOURS_CONTRACT_ID` int(11) DEFAULT NULL,
  `TIMESHEET_HOURS_NON_BILLABLE` float DEFAULT '0',
  `TIMESHEET_HOURS_NON_BILLABLE_TYPE_ID` text,
  `TIMESHEET_LINE_DISTANCE` int(11) DEFAULT '0',
  `TIMESHEET_LINE_DISTANCE_DESCRIPTION` text,
  `TIMESHEET_LINE_DISTANCE_NON_BILLABLE` int(11) DEFAULT NULL,
  `TIMESHEET_LINE_COSTS` float DEFAULT '0',
  `TIMESHEET_LINE_COST_TYPE_ID` int(11) DEFAULT NULL,
  `TIMESHEET_LINE_CREATION_DATE` date DEFAULT NULL,
  `TIMESHEET_LINE_CREATOR` int(11) DEFAULT NULL,
  `TIMESHEET_LINE_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `travel_type`
--

CREATE TABLE `travel_type` (
  `TRAVEL_TYPE_ID` int(11) NOT NULL,
  `TRAVEL_TYPE_NAME` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `worked_hours_type`
--

CREATE TABLE `worked_hours_type` (
  `WORKED_HOURS_TYPE_ID` int(11) NOT NULL,
  `WORKED_HOURS_TYPE_NAME` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `w_kosten`
--

CREATE TABLE `w_kosten` (
  `w_kosten_id` int(11) NOT NULL,
  `w_maandkosten_id` int(11) NOT NULL,
  `w_kosten_status` text NOT NULL,
  `fk_w_kosten_soort_id` int(11) NOT NULL,
  `w_kosten_omschrijving` text NOT NULL,
  `w_kosten_bedrag` decimal(6,2) NOT NULL,
  `w_kosten_afbij` text NOT NULL,
  `w_kosten_datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `w_kosten_soort`
--

CREATE TABLE `w_kosten_soort` (
  `w_kosten_soort_id` int(11) NOT NULL,
  `fk_w_type_id` int(11) NOT NULL,
  `w_kosten_soort_naam` text NOT NULL,
  `w_kosten_soort_omschrijving` text NOT NULL,
  `w_kosten_soort_vast` text NOT NULL,
  `w_kosten_soort_afbij` text NOT NULL,
  `w_kosten_soort_bedrag` decimal(6,2) NOT NULL,
  `w_kosten_soort_datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `w_maandkosten`
--

CREATE TABLE `w_maandkosten` (
  `w_maandkosten_id` int(11) NOT NULL,
  `fk_timesheet_id` int(11) NOT NULL,
  `w_maandkosten_jaar` int(4) NOT NULL,
  `w_maandkosten_maand` int(2) NOT NULL,
  `w_maandkosten_bedrag` decimal(6,2) NOT NULL,
  `w_maandkosten_datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `w_type`
--

CREATE TABLE `w_type` (
  `w_type_id` int(11) NOT NULL,
  `w_type_naam` text NOT NULL,
  `w_type_beschrijving` text NOT NULL,
  `w_type_datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`ACTION_ID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`BOOK_ID`);

--
-- Indexes for table `branche`
--
ALTER TABLE `branche`
  ADD PRIMARY KEY (`BRANCHE_ID`);

--
-- Indexes for table `calender`
--
ALTER TABLE `calender`
  ADD PRIMARY KEY (`CALENDER_ID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`COMPANY_ID`,`FK_BRANCHE_ID`,`FK_HOLDING_ID`);

--
-- Indexes for table `company_status`
--
ALTER TABLE `company_status`
  ADD PRIMARY KEY (`COMPANY_STATUS_ID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`CONTACT_ID`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`CONTRACT_ID`);

--
-- Indexes for table `contract_has_employee`
--
ALTER TABLE `contract_has_employee`
  ADD PRIMARY KEY (`RELATION_ID`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`COST_ID`);

--
-- Indexes for table `cost_type`
--
ALTER TABLE `cost_type`
  ADD PRIMARY KEY (`COST_TYPE_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EMPL_ID`,`FK_FUNCTION_ID`),
  ADD KEY `EMPL_ID` (`EMPL_ID`);

--
-- Indexes for table `emp_function`
--
ALTER TABLE `emp_function`
  ADD PRIMARY KEY (`FUNCTION_ID`);

--
-- Indexes for table `ext_function`
--
ALTER TABLE `ext_function`
  ADD PRIMARY KEY (`FUNCTION_ID`);

--
-- Indexes for table `function`
--
ALTER TABLE `function`
  ADD PRIMARY KEY (`FUNCTION_ID`);

--
-- Indexes for table `history_employee`
--
ALTER TABLE `history_employee`
  ADD PRIMARY KEY (`HISTORY_ID`);

--
-- Indexes for table `history_login`
--
ALTER TABLE `history_login`
  ADD PRIMARY KEY (`LOGIN_ID`);

--
-- Indexes for table `holding`
--
ALTER TABLE `holding`
  ADD PRIMARY KEY (`HOLDING_ID`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`HOLIDAY_ID`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`MAIL_ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MESSAGE_ID`);

--
-- Indexes for table `non_billable_hour_type`
--
ALTER TABLE `non_billable_hour_type`
  ADD PRIMARY KEY (`NON_BILLABLE_HOUR_TYPE_ID`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`NOTES_ID`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`PERSON_ID`,`FK_FUNCTION_ID`),
  ADD KEY `PERSON_ID` (`PERSON_ID`);

--
-- Indexes for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`TIMESHEET_ID`);

--
-- Indexes for table `timesheet_line`
--
ALTER TABLE `timesheet_line`
  ADD PRIMARY KEY (`TIMESHEET_LINE_ID`);

--
-- Indexes for table `travel_type`
--
ALTER TABLE `travel_type`
  ADD PRIMARY KEY (`TRAVEL_TYPE_ID`);

--
-- Indexes for table `worked_hours_type`
--
ALTER TABLE `worked_hours_type`
  ADD PRIMARY KEY (`WORKED_HOURS_TYPE_ID`);

--
-- Indexes for table `w_kosten`
--
ALTER TABLE `w_kosten`
  ADD PRIMARY KEY (`w_kosten_id`);

--
-- Indexes for table `w_kosten_soort`
--
ALTER TABLE `w_kosten_soort`
  ADD PRIMARY KEY (`w_kosten_soort_id`);

--
-- Indexes for table `w_maandkosten`
--
ALTER TABLE `w_maandkosten`
  ADD PRIMARY KEY (`w_maandkosten_id`);

--
-- Indexes for table `w_type`
--
ALTER TABLE `w_type`
  ADD PRIMARY KEY (`w_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `ACTION_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `BOOK_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calender`
--
ALTER TABLE `calender`
  MODIFY `CALENDER_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `CONTRACT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contract_has_employee`
--
ALTER TABLE `contract_has_employee`
  MODIFY `RELATION_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `COST_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cost_type`
--
ALTER TABLE `cost_type`
  MODIFY `COST_TYPE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_employee`
--
ALTER TABLE `history_employee`
  MODIFY `HISTORY_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_login`
--
ALTER TABLE `history_login`
  MODIFY `LOGIN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `HOLIDAY_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `MAIL_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MESSAGE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `non_billable_hour_type`
--
ALTER TABLE `non_billable_hour_type`
  MODIFY `NON_BILLABLE_HOUR_TYPE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `NOTES_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timesheet`
--
ALTER TABLE `timesheet`
  MODIFY `TIMESHEET_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timesheet_line`
--
ALTER TABLE `timesheet_line`
  MODIFY `TIMESHEET_LINE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `worked_hours_type`
--
ALTER TABLE `worked_hours_type`
  MODIFY `WORKED_HOURS_TYPE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `w_kosten`
--
ALTER TABLE `w_kosten`
  MODIFY `w_kosten_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `w_kosten_soort`
--
ALTER TABLE `w_kosten_soort`
  MODIFY `w_kosten_soort_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `w_maandkosten`
--
ALTER TABLE `w_maandkosten`
  MODIFY `w_maandkosten_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `w_type`
--
ALTER TABLE `w_type`
  MODIFY `w_type_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
