-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 02, 2013 at 06:01 PM
-- Server version: 5.1.50
-- PHP Version: 5.3.9-ZS5.6.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rainbow`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `admin_user_name` varchar(222) NOT NULL,
  `admin_first_name` varchar(255) NOT NULL,
  `admin_photo` varchar(255) NOT NULL,
  `admin_password` varchar(222) NOT NULL,
  `pin` varchar(222) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_user_name`, `admin_first_name`, `admin_photo`, `admin_password`, `pin`) VALUES
(1, 'admin', 'admin', 'admin.jpg', 'pass', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `attachements_after_pending_status`
--

CREATE TABLE IF NOT EXISTS `attachements_after_pending_status` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `tender_id` int(255) NOT NULL,
  `file` text NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `attachements_after_pending_status`
--

INSERT INTO `attachements_after_pending_status` (`id`, `tender_id`, `file`, `file_real_name`) VALUES
(3, 832, 'manish.jpg', '6f510f57557891ef66f196f5e6b1dfa0.jpg'),
(6, 832, 'manish.jpg', 'c17e5d961616e9604878f6fae900d7a4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bid_number_printed_firm`
--

CREATE TABLE IF NOT EXISTS `bid_number_printed_firm` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `tender_id` int(55) NOT NULL,
  `firm_id` int(55) NOT NULL,
  `bid_number` varchar(255) DEFAULT NULL,
  `bid_created_by` varchar(255) DEFAULT NULL,
  `bid_created_by_table` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=292 ;

--
-- Dumping data for table `bid_number_printed_firm`
--

INSERT INTO `bid_number_printed_firm` (`id`, `tender_id`, `firm_id`, `bid_number`, `bid_created_by`, `bid_created_by_table`) VALUES
(201, 826, 13, '98989', '1', '0'),
(202, 826, 13, '899899', '1', '0'),
(203, 826, 14, 'sasasa', '1', '0'),
(204, 826, 15, '322323', '1', '0'),
(277, 827, 13, '21212', '1', '0'),
(278, 827, 15, '65656', '1', '0'),
(279, 827, 15, 'saas', '1', '0'),
(280, 827, 16, '8989', '1', '0'),
(281, 827, 16, '2500', '1', '0'),
(282, 827, 16, '9500', '1', '0'),
(284, 827, 16, '565', '1', '0'),
(285, 827, 19, '89989', '1', '0'),
(286, 827, 19, '8989', '1', '0'),
(287, 827, 19, '6+6+6+6+', '1', '0'),
(288, 827, 19, '', '1', '0'),
(290, 827, 19, '', '1', '0'),
(291, 827, 19, '', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `consignee`
--

CREATE TABLE IF NOT EXISTS `consignee` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `csign_firm_name` varchar(255) NOT NULL,
  `csign_short_name` varchar(255) NOT NULL,
  `csign_address` varchar(255) NOT NULL,
  `csign_pin_code` varchar(255) NOT NULL,
  `csign_email` varchar(255) NOT NULL,
  `csign_tel_number` varchar(255) DEFAULT NULL,
  `csign_fax_number` varchar(255) DEFAULT NULL,
  `csign_cst_number` varchar(255) DEFAULT NULL,
  `csign_tin_number` varchar(255) NOT NULL,
  `csign_digital_sign` varchar(255) DEFAULT NULL,
  `csign_digital_sign_expd` varchar(255) DEFAULT NULL,
  `csign_digital_sign_remark` varchar(255) DEFAULT NULL,
  `csign_nsci` varchar(255) DEFAULT NULL,
  `csign_nsci_expd` varchar(255) DEFAULT NULL,
  `csign_nsci_remark` varchar(255) DEFAULT NULL,
  `csign_dgdd` varchar(255) DEFAULT NULL,
  `csign_dgdd_expd` varchar(255) DEFAULT NULL,
  `csign_dgdd_remark` varchar(255) DEFAULT NULL,
  `csign_dgq` varchar(255) DEFAULT NULL,
  `csign_dgq_expd` varchar(255) DEFAULT NULL,
  `csign_dgq_remark` varchar(255) DEFAULT NULL,
  `csign_pan_number` varchar(255) DEFAULT NULL,
  `csign_pan_remark` varchar(255) DEFAULT NULL,
  `csign_remark` varchar(255) NOT NULL,
  `csign_delv_schedule` varchar(255) NOT NULL,
  `csign_delv_peride` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` int(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `consignee`
--

INSERT INTO `consignee` (`id`, `csign_firm_name`, `csign_short_name`, `csign_address`, `csign_pin_code`, `csign_email`, `csign_tel_number`, `csign_fax_number`, `csign_cst_number`, `csign_tin_number`, `csign_digital_sign`, `csign_digital_sign_expd`, `csign_digital_sign_remark`, `csign_nsci`, `csign_nsci_expd`, `csign_nsci_remark`, `csign_dgdd`, `csign_dgdd_expd`, `csign_dgdd_remark`, `csign_dgq`, `csign_dgq_expd`, `csign_dgq_remark`, `csign_pan_number`, `csign_pan_remark`, `csign_remark`, `csign_delv_schedule`, `csign_delv_peride`, `created_by`, `created_table`, `updated_by`, `updated_table`) VALUES
(13, 'firm third', 'third short name', 'asasasas', '777777', 'xxxshaan@gmail.com', '', '', '', '777777777777777777', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'sasas', 'asas', 'asasasasasas', '1', 0, '1', '0'),
(14, 'firm second', 'second shorname', 'fdfdfdfd', '777777', 'ss@gmail.com', '', '', '', '777777777777777777', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'zzzzzzz', 'xxxxx', 'qqqqqqqqq', '1', 0, '1', '0'),
(15, 'Seventh Firm', 'seventh short name', 'sasasa', '777777', 'ss@gmail.com', 'aaaaaaaaa', 'sssssss', 'ddddddddd', '777777777777777777', '22222222', '08-04-2013', '4434', '33333333', '13-04-2013', '3434', '4444444444', '17-04-2013', '3434', '55555555', '06-04-2013', '343434343', '666666666', '', 'dasasa', 'sasasa', 'sasasa', '1', 0, '1', '0'),
(16, 'forth firm', 'forth short name', 'jaipur', '334001', 'ss@gmail.com', '', '', '', '777777777777777777', '', '', '', '', '', '', '', '', '', '', '', '', 'xxxxxxxx', '', '500', '200', '8500', '1', 0, '1', '0'),
(17, 'firm first', 'first shortname', 'dsadsad', '222222', 'ss@gmail.com', '', '', '', '111111111111111111', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'sasa', 'sasas', 'sasaas', '1', 0, '1', '0'),
(18, 'sixth firm', 'sixth short name', 'dsdsd', '333333', 'ss@gmail.com', '', '', '', '111111111111111111', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'dsdsddsds', 'dsdsd', 'dsdsds', '1', 0, '1', '0'),
(19, 'fifth firm', 'fifth short name', 'sasasasas', '777777', 'ss@gmail.com', '', '', '', '111111111111111111', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 's', 'sss', 'ssss', '1', 0, '1', '0'),
(20, 'Kareena Kapoor', 'What Happended that time', 'bikaner', '334001', 'xxxshaan@gmail.com', '9898', 'xxxxxxxx', 'ccccccccc', 'ffffffff', 'gggggggggg', '24-04-2013', 'wew', 'hhhhhhhhhhh', '12-04-2013', 'weewe', 'jjjjjjjjjj', '28-04-2013', 'wew', 'mmmmmmmmmmm', '03-04-2013', 'ewewewewe', '12212121212121212', 'meenu', '6565', '56565', '5656565', '1', 0, '1', '0'),
(21, 'Asjash Ajsjhahas Hajhsahs', 'aaBB', 'asasasasasa', '111111', 'xxxshaan@gmail.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'XX', 'SS', 'QQQa', '1', 0, '1', '0'),
(22, 'Qqqq Eee Rrrrrrrrrr', 'sasaas', 'sasasas', '111111', 'xxxshaan@gmail.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'dsdsd', 'dsdsd', 'dsdsdsdsdsd', '1', 0, '1', '0'),
(23, 'Last Firm To Try What', 'sasasa', 'sasasasa', '111111', 'xxxshaan@gmail.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'sasasasa', 'sasasa', 'ssasa', '1', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `consignee_director`
--

CREATE TABLE IF NOT EXISTS `consignee_director` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `csign_id` int(50) NOT NULL,
  `csign_director` varchar(255) NOT NULL,
  `csign_pan_number` varchar(255) NOT NULL,
  `csign_tel_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `consignee_director`
--

INSERT INTO `consignee_director` (`id`, `csign_id`, `csign_director`, `csign_pan_number`, `csign_tel_number`) VALUES
(5, 3, 'SURENDRA RATHI', 'AEWPR5803C', '9312555170'),
(9, 3, 'vikram', 'sharma', '9858569665'),
(10, 3, 'shakeb', '786', '9413142167'),
(11, 3, 'meenu', '1024', '656565656'),
(12, 3, 'kj', '', ''),
(13, 7, 'second', '785412369', '566565656'),
(16, 9, 'xxxxx', '', ''),
(17, 9, 'zzzzzzzzz', '', ''),
(18, 9, 'mmmmmmmm', '', ''),
(19, 9, 'nnnnnnnnn', '', ''),
(20, 9, 'ppppppppppp', '', ''),
(21, 16, 'kalpish', '1212', '21212'),
(22, 16, 'meneusasasas', '12212', '21212'),
(23, 20, 'sayma', '2332', '232323233223'),
(24, 21, 'sasa', 'sasasa', 'sasasasa'),
(25, 22, 'sdsds', 'dsdsd', 'sdsdsd'),
(26, 23, 'saasas', '', ''),
(27, 20, 'sasas', '211', '212121212');

-- --------------------------------------------------------

--
-- Table structure for table `create_purchaser`
--

CREATE TABLE IF NOT EXISTS `create_purchaser` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `purchaser_name` varchar(255) NOT NULL,
  `purchaser_short_name` varchar(255) NOT NULL,
  `purchaser_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `Fax_No` varchar(255) DEFAULT NULL,
  `store_page` varchar(255) DEFAULT NULL,
  `bulletin_url` varchar(255) DEFAULT NULL,
  `limited_url` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(55) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `create_purchaser`
--

INSERT INTO `create_purchaser` (`id`, `purchaser_name`, `purchaser_short_name`, `purchaser_address`, `city`, `pin`, `website`, `Fax_No`, `store_page`, `bulletin_url`, `limited_url`, `created_by`, `created_table`, `updated_by`, `updated_table`) VALUES
(48, 'Vikas', 'VIKKI', 'UMAR HOUSE', 'BIKANER', '334001', 'gopogle', NULL, 'yahoo', 'websity.co/tendr', 'po detail', '1', '0', '1', '0'),
(49, 'Dsdsdsdsd', 'dsdsd', ' dsdsdsds ', 'dsdsdsdsd', '777777', 'sdsds', NULL, 'dsdsdsd', 'sdsdsds', 'dsdsds', '1', '0', '1', '0'),
(50, 'Mmmmm Jjjjjjjjjj Ssssssssss', 'sasasasas', ' jaipur ', 'bikaner', '555555', '', NULL, '', '', '', '1', '0', '1', '0'),
(51, 'Xxxxxxxxxxxx', 'sasasas', ' xxxxxxxxx ', 'xxxxxxxxx', '111111', 'dsdsd', 'DDDDDDDDDDDDDDD', '', '', '', '1', '0', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `csign_attachments`
--

CREATE TABLE IF NOT EXISTS `csign_attachments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `csign_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `other_title` varchar(255) DEFAULT NULL,
  `file` text NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `csign_attachments`
--

INSERT INTO `csign_attachments` (`id`, `csign_id`, `title`, `other_title`, `file`, `file_real_name`) VALUES
(18, 15, '10', 'shubhangiX', 'SSS', 'SSS'),
(19, 15, '10', 'sdasdsadasdas', '3de2965a600ecf005414a267c9658325.', ''),
(20, 15, '5', '', '918a34ee1dff1e0b7419d9153c6fa424.', ''),
(21, 16, '10', 'hemant', '46358f950e69b4ecc612f5d2dfe05a9b.pdf', 'EvaluationCommercialStmt3980975.pdf'),
(24, 16, '3', '', 'b832293b653aba5139e8bc0d2cc5ea83.txt', 'link.txt'),
(25, 16, '8', '', 'fdf0b9fef906998cee4c9446392bac9a.txt', 'dss.txt'),
(26, 16, '10', 'hemant', '5cbc1d89bb5efbbeaeec7283e20b2dec.pdf', 'EvaluationCommercialStmt3980975.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_office` varchar(255) NOT NULL,
  `employee_first_name` varchar(255) DEFAULT NULL,
  `employee_last_name` varchar(255) DEFAULT NULL,
  `employee_user_name` varchar(255) DEFAULT NULL,
  `employee_password` varchar(255) DEFAULT NULL,
  `employee_pin` varchar(255) DEFAULT NULL,
  `employee_photo` varchar(255) DEFAULT NULL,
  `employee_mail` varchar(255) DEFAULT NULL,
  `employee_mobile` varchar(255) DEFAULT NULL,
  `employee_address` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(55) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_office`, `employee_first_name`, `employee_last_name`, `employee_user_name`, `employee_password`, `employee_pin`, `employee_photo`, `employee_mail`, `employee_mobile`, `employee_address`, `created_by`, `created_table`, `updated_by`, `updated_table`) VALUES
(6, '8', 'SAYMA', 'shaan', 'shaan123', 'password', '8596', '3cc05dbb4dcb7975058eded56fff1884.jpg', 'xxxshaan@gmail.cm', '7737911704', 'bikaner', '1', '0', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attachments`
--

CREATE TABLE IF NOT EXISTS `employee_attachments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `employee_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `other_title` varchar(255) DEFAULT NULL,
  `file` text NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `employee_attachments`
--

INSERT INTO `employee_attachments` (`id`, `employee_id`, `title`, `other_title`, `file`, `file_real_name`) VALUES
(2, 7, '1', '', 'f87a9b96f83fc921ca34040bfbac745e.dll', 'axvlc.dll'),
(3, 7, '2', '', '8df576c632a6acb8add1516082d32f8d.dll', 'axvlc.dll'),
(5, 6, '4', '', '9614a3c8345a44269db856569746f0ab.txt', 'AUTHORS.txt'),
(6, 6, '10', 'aaaa', '115e748d4a60db7aedf35d4df25b9af3.manifest', 'axvlc.dll.manifest');

-- --------------------------------------------------------

--
-- Table structure for table `history_po`
--

CREATE TABLE IF NOT EXISTS `history_po` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `po_office` int(55) NOT NULL,
  `po_purchaser` int(55) NOT NULL,
  `po_firm` int(55) NOT NULL,
  `po_number` varchar(256) DEFAULT NULL,
  `po_due_date` date DEFAULT NULL,
  `po_value` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(55) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(55) DEFAULT NULL,
  `status` int(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `history_po`
--

INSERT INTO `history_po` (`id`, `po_office`, `po_purchaser`, `po_firm`, `po_number`, `po_due_date`, `po_value`, `created_by`, `created_table`, `updated_by`, `updated_table`, `status`) VALUES
(1, 8, 48, 2, 'shaan', '2013-03-12', NULL, '1', '0', '1', '0', 0),
(2, 8, 48, 14, 'sasasas', '2013-03-12', NULL, '1', '0', NULL, NULL, 0),
(3, 8, 48, 14, 'XXXXXXXXXX', '2013-03-05', NULL, '1', '0', '1', '0', 0),
(4, 8, 48, 14, 'shaklen', '2013-03-18', '00', '1', '0', '1', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `history_po_attachements`
--

CREATE TABLE IF NOT EXISTS `history_po_attachements` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `po_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `other_title` varchar(255) DEFAULT NULL,
  `file` text NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `history_po_attachements`
--

INSERT INTO `history_po_attachements` (`id`, `po_id`, `title`, `other_title`, `file`, `file_real_name`) VALUES
(1, 2, '3', '', '8707bc7d1f27bca3aa3a8d7aa8e83c90.txt', 'dss.txt'),
(2, 3, '2', '', 'f57d71dab9a3cee88035e9c891a51f69.pdf', 'NIT FOR FONT AND SIZE.pdf'),
(3, 3, '10', 'sasas', '8351939f6c978d3221987b103c7dfc42.pdf', 'NIT FOR FONT AND SIZE.pdf'),
(4, 3, '3', '', '7713f819ea13db69c8495b013639d998.pdf', 'NIT FOR FONT AND SIZE.pdf'),
(5, 3, '3', '', 'c5fbade6a07bdc727c7e1437f2373e16.pdf', 'NIT FOR FONT AND SIZE.pdf'),
(6, 4, '2', '', 'f7a143e7f9dbb446f7cba582372ed8dd.jpg', 'L Shape Kitchen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `history_po_firm_product`
--

CREATE TABLE IF NOT EXISTS `history_po_firm_product` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `po_id` int(55) NOT NULL,
  `category` text,
  `inspection` varchar(255) DEFAULT NULL,
  `discription` varchar(255) DEFAULT NULL,
  `consignee` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `tax_type` varchar(255) DEFAULT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `history_po_firm_product`
--

INSERT INTO `history_po_firm_product` (`id`, `po_id`, `category`, `inspection`, `discription`, `consignee`, `quantity`, `unit`, `tax_type`, `tax`, `rate`) VALUES
(1, 1, '32', '1', '', '24', '21211', '4', '1', '2121', '21121'),
(2, 2, '32', '8', 'mummmy', '28', '130', '4', '5', '5000', '2000'),
(3, 2, '29', '10', 'dsdsdsdsds', '26', '3232323', '5', '3', 'dfdfdf', 'dfddf'),
(4, 2, '34', '5', '', '27', '', '1', '3', 'fdfdfdf', 'fdfdfd'),
(5, 3, '32', '1', '', '24', '', '1', '2', '', ''),
(6, 3, '32', '5', '', '26', '', '1', '3', '', ''),
(7, 3, '34', '5', 'sasasasa', '24', '', '3', '4', 'sasasa', 'sasasas'),
(8, 3, '29', '1', '', '24', '', '1', '', '', ''),
(9, 3, '34', '1', '', '26', '', '1', '', '', ''),
(10, 4, '32', '3', 'asasas', '26', '332323', '4', '5', '3232', '323232');

-- --------------------------------------------------------

--
-- Table structure for table `history_tender`
--

CREATE TABLE IF NOT EXISTS `history_tender` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `tender_office` varchar(255) NOT NULL,
  `tender_purchaser` int(55) NOT NULL,
  `tender_number` varchar(256) NOT NULL,
  `tender_due_date` date NOT NULL,
  `tender_sample` int(1) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(55) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(55) DEFAULT NULL,
  `status` int(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `history_tender`
--

INSERT INTO `history_tender` (`id`, `tender_office`, `tender_purchaser`, `tender_number`, `tender_due_date`, `tender_sample`, `created_by`, `created_table`, `updated_by`, `updated_table`, `status`) VALUES
(6, '8', 48, '1212XXXXXXXXXX', '2013-03-21', 1, '1', '0', NULL, NULL, 0),
(18, '8', 48, '1212Meenu', '2013-03-13', 1, '1', '0', NULL, NULL, 0),
(19, '8', 48, '121ShubhangiXX', '2013-03-13', 1, '1', '0', '1', '0', 0),
(20, '8', 48, 'yamuna', '2013-03-29', 0, '1', '0', '1', '0', 0),
(21, '8', 48, '0202', '2013-09-22', 1, '1', '0', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history_tender_attachments`
--

CREATE TABLE IF NOT EXISTS `history_tender_attachments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `tender_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `other_title` varchar(255) DEFAULT NULL,
  `file` text NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `history_tender_attachments`
--

INSERT INTO `history_tender_attachments` (`id`, `tender_id`, `title`, `other_title`, `file`, `file_real_name`) VALUES
(3, 6, '5', '', '2063bacfdd600c8c2f1298426d956458.ini', 'desktop.ini'),
(4, 6, '3', '', '40246a6e0dd5389e32a2c30927f01ade.ini', 'desktop.ini'),
(5, 6, '3', '', '6694614d2f6de9613d525d290a2487d1.jpg', '5.jpg'),
(6, 18, '2', '', '74a5f2978130d5ea8050d5b196ad3d11.jpg', 'L Shape Kitchen.jpg'),
(13, 20, '3', '', '6694614d2f6de9613d525d290a2487d1.jpg', '5.jpg'),
(14, 20, '3', '', '40246a6e0dd5389e32a2c30927f01ade.ini', 'desktop.ini'),
(15, 20, '5', '', '2063bacfdd600c8c2f1298426d956458.ini', 'desktop.ini'),
(16, 20, '2', '', '205ea37d0ca9a43c736e06710407f40e.jpg', 'L Shape Kitchen.jpg'),
(17, 20, '10', 'meeenu', 'e063e5124a6e8d46184f21269f3625d8.jpg', 'L Shape Kitchen.jpg'),
(18, 20, '3', '', '1f87c3ede3fd093430bce659b00be414.jpg', 'L Shape Kitchen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `history_tender_firm_product`
--

CREATE TABLE IF NOT EXISTS `history_tender_firm_product` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `tender_id` int(55) NOT NULL,
  `category` text,
  `inspection` varchar(255) DEFAULT NULL,
  `discription` varchar(255) DEFAULT NULL,
  `consignee` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `history_tender_firm_product`
--

INSERT INTO `history_tender_firm_product` (`id`, `tender_id`, `category`, `inspection`, `discription`, `consignee`, `quantity`, `unit`) VALUES
(1, 6, '34', '1', 'sayma', '26', 'saasas', '1'),
(2, 6, '32', '3', 'gfgfgfgf', '24', '223232', '3'),
(3, 6, '32', '5', '3323', '23', '32323', '1'),
(4, 6, '34', '3', '232323', '24', '2323232', '1'),
(5, 14, '34', '1', '', '24', '', '1'),
(6, 18, '34', '3', '232323', '24', '2323232', '6'),
(7, 18, '32', '1', '3323', '23', '32323', '5'),
(8, 18, '32', '3', 'gfgfgfgf', '24', '223232', '4'),
(9, 18, '34', '1', 'sasasa', '23', 'saasas', '3'),
(10, 18, '32', '1', '', '28', '', '2'),
(11, 18, '32', '1', '', '25', '', '1'),
(12, 18, '32', '1', '', '26', '', '3'),
(26, 19, '32', '3', 'asasa', '26', 'sasa', '5'),
(27, 20, '34', '3', '232323', '24', '2323232', '1'),
(28, 20, '32', '5', '3323', '23', '32323', '1'),
(29, 20, '32', '9', 'gfgfgfgf', '24', '223232', '3'),
(30, 20, '34', '1', 'sayma', '26', 'saasas', '1'),
(31, 20, '32', '4', 'xxxxxxxxxxxx', '27', '', '1'),
(32, 20, '32', '1', '', '25', '', '1'),
(33, 21, '34', '3', 'why product discription is not coming', '25', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `item_manager`
--

CREATE TABLE IF NOT EXISTS `item_manager` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `item_discription` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(55) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_name` (`item_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `item_manager`
--

INSERT INTO `item_manager` (`id`, `item_name`, `item_discription`, `created_by`, `created_table`, `updated_by`, `updated_table`) VALUES
(29, 'meenu', 'kkkkkkk', '1', '0', '1', '0'),
(32, 'shubhangi', 'item category shubhangi', '1', '0', '1', '0'),
(34, 'kailash', 'pailash disciptionb', '1', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `main_consignee`
--

CREATE TABLE IF NOT EXISTS `main_consignee` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `main_csign_purchaser` varchar(255) NOT NULL,
  `main_csign_name` varchar(255) NOT NULL,
  `main_csign_short_name` varchar(255) NOT NULL,
  `main_csign_address` text,
  `main_csign_city` varchar(255) NOT NULL,
  `main_csign_addpin` varchar(255) DEFAULT NULL,
  `main_csign_fax` varchar(255) DEFAULT NULL,
  `main_csign_createdby` varchar(255) DEFAULT NULL,
  `created_table` varchar(55) DEFAULT NULL,
  `main_csign_updatedby` varchar(255) DEFAULT NULL,
  `updated_table` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `main_consignee`
--

INSERT INTO `main_consignee` (`id`, `main_csign_purchaser`, `main_csign_name`, `main_csign_short_name`, `main_csign_address`, `main_csign_city`, `main_csign_addpin`, `main_csign_fax`, `main_csign_createdby`, `created_table`, `main_csign_updatedby`, `updated_table`) VALUES
(23, '48', 'Kareena', 'Naved3', 'umar house', 'bikner', '787', '87', '1', '0', '1', '0'),
(24, '48', 'sayma qadir', 'sayma', 'jaipur', 'jaipur', '334112', '656565', '1', '0', '', ''),
(25, '48', 'dsdds', 'dsdsd', 'dsdsds', 'dsd', 'ds', 'dsds', '1', '0', '', ''),
(26, '48', 'shubhangi', 'shu', 'bikaner', 'rajasthan', '', '', '1', '0', '', ''),
(27, '48', 'eedfdds', 'fdsfsd', 'fsdfsdfsd', 'fsdfsdf', 'sdfd', 'fdsfsdfsdfds', '1', '0', '', ''),
(28, '48', 'Qqqqqqqasaddsd Qwqw', 'MEENU', 'sasas', 'sasasasasas', '', '', '1', '0', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `main_consignee_contacts`
--

CREATE TABLE IF NOT EXISTS `main_consignee_contacts` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `main_csign_id` int(55) NOT NULL,
  `contact_postname` varchar(255) NOT NULL,
  `contact_officername` varchar(255) NOT NULL,
  `contact_telephone` varchar(255) DEFAULT NULL,
  `contact_mobile` varchar(255) DEFAULT NULL,
  `contact_fax` varchar(255) DEFAULT NULL,
  `contact_residence` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_deal` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `main_consignee_contacts`
--

INSERT INTO `main_consignee_contacts` (`id`, `main_csign_id`, `contact_postname`, `contact_officername`, `contact_telephone`, `contact_mobile`, `contact_fax`, `contact_residence`, `contact_email`, `contact_deal`) VALUES
(25, 23, '', 'jaipur', '', '', 'fax noXXX', 'residence no', '', ''),
(26, 24, 'saasaXXXXXX', 'sasasa', 'sasa', 'sasa', 'asas', 'asas', 'asasWW', 'asasaXXWWWQW'),
(27, 24, 'sasasasas', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `main_csign_attachments`
--

CREATE TABLE IF NOT EXISTS `main_csign_attachments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `main_csign_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `file` text NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `main_csign_attachments`
--

INSERT INTO `main_csign_attachments` (`id`, `main_csign_id`, `title`, `file`, `file_real_name`) VALUES
(1, 14, 'assasasa', 'e92d7dc4ef043b5bc5179d7a5473e095.png', 'delete_icon.png'),
(2, 14, 'mmmmmmm', '6843a1f6fb71b29a45615ac40a804f4d.png', 'error.png');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE IF NOT EXISTS `office` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `office_code` varchar(255) NOT NULL,
  `office_name` varchar(255) NOT NULL,
  `office_address` text NOT NULL,
  `office_city` varchar(255) DEFAULT NULL,
  `office_pin` varchar(255) DEFAULT NULL,
  `office_telephone` varchar(255) DEFAULT NULL,
  `office_fax` varchar(255) DEFAULT NULL,
  `office_contact_person` varchar(255) DEFAULT NULL,
  `office_mobile` varchar(255) DEFAULT NULL,
  `office_email` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(55) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`id`, `office_code`, `office_name`, `office_address`, `office_city`, `office_pin`, `office_telephone`, `office_fax`, `office_contact_person`, `office_mobile`, `office_email`, `created_by`, `created_table`, `updated_by`, `updated_table`) VALUES
(8, '786', 'jaipur udyg', 'bikaner', 'jaipur ciyu', 'pin code', '9414454', 'fax no', 'meenu', '94131421670', 'xxxshaan@gmail.com', '1', '0', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE IF NOT EXISTS `officer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `officer_office` varchar(255) NOT NULL,
  `officer_first_name` varchar(255) DEFAULT NULL,
  `officer_last_name` varchar(255) DEFAULT NULL,
  `officer_user_name` varchar(255) DEFAULT NULL,
  `officer_password` varchar(255) DEFAULT NULL,
  `officer_pin` varchar(255) DEFAULT NULL,
  `officer_photo` varchar(255) DEFAULT NULL,
  `officer_mail` varchar(255) DEFAULT NULL,
  `officer_mobile` varchar(255) DEFAULT NULL,
  `officer_address` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(55) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`id`, `officer_office`, `officer_first_name`, `officer_last_name`, `officer_user_name`, `officer_password`, `officer_pin`, `officer_photo`, `officer_mail`, `officer_mobile`, `officer_address`, `created_by`, `created_table`, `updated_by`, `updated_table`) VALUES
(4, '8', 'zzXX', 'qadie', 'sayma123', 'sayma', '1145', 'no_pic.jpg', 'sayma@yahoo.com', '94131421678', 'lkldjfdfd', '1', '0', '1', '0'),
(5, '8', 'sasasasasasa', 'sasas', 'asasasas', 'asasas', '1234', 'no_pic.jpg', 'dsdsd', 'dsds', 'dsdsd', '1', '0', NULL, NULL),
(6, '8', 'Giriraaj', 'mehra', 'giri123', 'password', '3344', '4ed493ce3abf06d12649a6e7fdc46c6e.jpg', 'xxxshaan@gmail.com', '9413142167', 'sdsdsd', '1', '0', '1', '0'),
(7, '8', 'shubham', 'khan', 'shu', 'shu123', '1258', 'no_pic.jpg', 'sdsd', 'sdsd', '', '1', '0', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `officer_attachments`
--

CREATE TABLE IF NOT EXISTS `officer_attachments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `officer_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `other_title` varchar(255) DEFAULT NULL,
  `file` text NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `officer_attachments`
--

INSERT INTO `officer_attachments` (`id`, `officer_id`, `title`, `other_title`, `file`, `file_real_name`) VALUES
(1, 4, '2', '', '501950d7a6308c17672320a876f44425.dll', 'axvlc.dll'),
(2, 4, '10', 'fdsfsdf', '147aca8958907cfb5d3a6cb89b85f84c.dll', 'axvlc.dll'),
(3, 4, '3', '', 'c8d670cafdf6a8c94a1109c31d41423b.dll', 'axvlc.dll'),
(4, 4, '10', 'sasasasa', '29f9dc1c9a4da3497d2eebfd7bc4cb89.', ''),
(5, 5, '10', '', '387b37bfc95cdcd986844c1004c694a4.manifest', 'axvlc.dll.manifest'),
(6, 5, '2', '', '39a0d4fbf58b279913e9a48e890eee34.txt', 'COPYING.txt'),
(7, 6, '10', '', 'd6678452e472c821b3891033d4468528.txt', 'link.txt'),
(8, 6, '3', '', '258df5b1e0cd3b4a0d0790afb333eb15.txt', 'link.txt');

-- --------------------------------------------------------

--
-- Table structure for table `office_attachments`
--

CREATE TABLE IF NOT EXISTS `office_attachments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `office_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `file` text NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `office_attachments`
--

INSERT INTO `office_attachments` (`id`, `office_id`, `title`, `file`, `file_real_name`) VALUES
(1, 4, 'dsdsdsds', 'baf6c13f9b79c0023d71879dcc852139.dll', 'AccessibleMarshal.dll'),
(2, 5, 'unknown', '9c4e22841a77d8b9ba84a7e3cdef952a.png', 'user-icon-hover.png'),
(3, 5, 'second', '8bc54d6bcce3b64dece791e3abad0be1.png', 'error.png'),
(4, 5, 'forth', 'a73769535c7aad380c1a663916da2a62.jpg', 'submit.jpg'),
(5, 5, 'third', 'b6e5c5a2040377ba80fa2f864d589d00.png', 'user-icon-hover.png');

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE IF NOT EXISTS `po` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `tender_type` int(55) NOT NULL,
  `tender_number` varchar(255) DEFAULT NULL,
  `tender_id` int(55) DEFAULT NULL,
  `tender_office` int(55) DEFAULT NULL,
  `tender_purchaser` int(55) DEFAULT NULL,
  `file_number` varchar(255) DEFAULT NULL,
  `name_of_firm` varchar(255) DEFAULT NULL,
  `po_number` varchar(255) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `refi_date` date DEFAULT NULL,
  `extended_date` date DEFAULT NULL,
  `security_deposit` varchar(255) DEFAULT NULL,
  `security_deposit_text_area` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`id`, `tender_type`, `tender_number`, `tender_id`, `tender_office`, `tender_purchaser`, `file_number`, `name_of_firm`, `po_number`, `due_date`, `refi_date`, `extended_date`, `security_deposit`, `security_deposit_text_area`, `created_by`, `created_table`, `updated_by`, `updated_table`) VALUES
(1, 1, '452', 839, 8, 48, '3256330405_786', '13', 'tytyt', '2013-04-10', '2013-04-25', '2013-04-20', '1', '', '1', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `po_attachments`
--

CREATE TABLE IF NOT EXISTS `po_attachments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `tender_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `other_title` varchar(255) DEFAULT NULL,
  `file` text NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `po_attachments`
--

INSERT INTO `po_attachments` (`id`, `tender_id`, `title`, `other_title`, `file`, `file_real_name`) VALUES
(1, 1, '4', '', '78040ecdf0d38763b15b2f309e2d34e4.pdf', 'EvaluationCommercialStmt3980975.pdf'),
(2, 1, '2', '', '016786cb6b251620f956dbc1fe22380a.jpg', 'L Shape Kitchen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `po_products`
--

CREATE TABLE IF NOT EXISTS `po_products` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `po_id` int(55) NOT NULL,
  `category` text NOT NULL,
  `inspection` varchar(255) NOT NULL,
  `discription` varchar(255) NOT NULL,
  `consignee` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `taxtype` varchar(255) DEFAULT NULL,
  `includingall` varchar(255) DEFAULT NULL,
  `totalvalue` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `paymentother` varchar(255) DEFAULT NULL,
  `payingauthority` varchar(255) DEFAULT NULL,
  `inspectionplace` varchar(255) DEFAULT NULL,
  `deliverydate` varchar(255) DEFAULT NULL,
  `quantitymannual` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `po_products`
--

INSERT INTO `po_products` (`id`, `po_id`, `category`, `inspection`, `discription`, `consignee`, `quantity`, `unit`, `rate`, `taxtype`, `includingall`, `totalvalue`, `payment`, `paymentother`, `payingauthority`, `inspectionplace`, `deliverydate`, `quantitymannual`) VALUES
(1, 1, '32', '3', 'product discripton part first', '25', '200', '2', '89', '3', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchaser_director`
--

CREATE TABLE IF NOT EXISTS `purchaser_director` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(255) NOT NULL,
  `purchaser_post_name` varchar(255) DEFAULT NULL,
  `purchaser_office_name` varchar(255) NOT NULL,
  `purchaser_tel` varchar(255) DEFAULT NULL,
  `purchaser_mob` varchar(255) DEFAULT NULL,
  `purchaser_residence` varchar(255) DEFAULT NULL,
  `purchaser_fax` varchar(255) DEFAULT NULL,
  `purchaser_email` varchar(255) DEFAULT NULL,
  `purchaser_deals` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `purchaser_director`
--

INSERT INTO `purchaser_director` (`id`, `purchase_id`, `purchaser_post_name`, `purchaser_office_name`, `purchaser_tel`, `purchaser_mob`, `purchaser_residence`, `purchaser_fax`, `purchaser_email`, `purchaser_deals`) VALUES
(38, 18, 'sddsdd', 'sdsdsd', 'sdsdsdsd', '', '', '', '', ''),
(39, 19, 'sasa', 'sasa', 'sas', 'sas', 'as', 'asas', 'asa', 'sassa'),
(40, 46, 'sasa', 'sasas', '', '', '', '', '', ''),
(41, 46, 'asas', 'asas', 'asasasa', '', '', '', '', ''),
(42, 46, 'asa', '', '', '', '', '', '', ''),
(43, 46, 'XXXXXXXXX', 'XXXXXXXX', '', '', '', '', '', ''),
(44, 48, 'sasasas', '', '', '', '', '', '', ''),
(45, 48, '', 'dfdfdfdfdfdf', '', '', '', '', '', ''),
(46, 50, 'dsdsd', 'sdsds', 'dsdsdsd', 'dsdsds', 'dsdsds', 'dsdsd', 'sd', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_attachments`
--

CREATE TABLE IF NOT EXISTS `purchase_attachments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file` text,
  `file_real_name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `purchase_attachments`
--

INSERT INTO `purchase_attachments` (`id`, `purchase_id`, `title`, `file`, `file_real_name`) VALUES
(2, 19, 'another', '61200741b01f86bca81cdb2fe751b1be.png', 'error.png'),
(3, 19, 'once another', '0d2f6f6f4714ff4393caace84cf32e79.png', 'go.png');

-- --------------------------------------------------------

--
-- Table structure for table `specification`
--

CREATE TABLE IF NOT EXISTS `specification` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `specification_no` varchar(255) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  `revision` varchar(255) DEFAULT NULL,
  `reaffirmed` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `issued` varchar(255) DEFAULT NULL,
  `other_issued` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `specification`
--

INSERT INTO `specification` (`id`, `specification_no`, `part`, `revision`, `reaffirmed`, `year`, `title`, `issued`, `other_issued`, `created_by`, `created_table`, `updated_by`, `updated_table`) VALUES
(5, '786', 'parth1212', 'yes', 'nope', '2006', 'meenu', '2', '', '1', '0', '1', '0'),
(6, 'dsdsd', 'dsdsd', 'dsdsd', 'dsds', 'sdsdsdsdsd', 'kareena', '2', '', '1', '0', '1', '0'),
(7, 'fffdfdf', 'fdfd', 'fdfd', 'ddfd', '12121212', 'm', '1', '', '1', '0', '1', '0'),
(8, 'asas', 'sasas', 'sasas', 'sasasa', 'sasasas', NULL, '10', NULL, '1', '0', NULL, NULL),
(9, 'pooja', 'dsdsd', 'dsdsdsdds', 'dsdsd', 'dsdsdsdsd', 's', '10', 'XXXXXX', '1', '0', '1', '0'),
(10, '11', '22222222', '333333333', '444444444', '55555555555', '5', '2', '', '1', '0', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `specification_attachements`
--

CREATE TABLE IF NOT EXISTS `specification_attachements` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `specs_id` int(255) NOT NULL,
  `file` text NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `specification_attachements`
--

INSERT INTO `specification_attachements` (`id`, `specs_id`, `file`, `file_real_name`) VALUES
(1, 7, 'NIT FOR FONT AND SIZE.pdf', 'cb3fdc61fb223f2ca8ad314b6c2f17b0.pdf'),
(2, 7, 'L Shape Kitchen.jpg', '832d2b9c0d7b7e2da0e2a090001076cc.jpg'),
(3, 8, 'NIT FOR FONT AND SIZE.pdf', '2c084b7202d735974c43c7ebd6f9f123.pdf'),
(4, 8, 'L Shape Kitchen.jpg', 'f484b96c75886c004be936eca9c44be6.jpg'),
(5, 8, 'EvaluationCommercialStmt3980975.pdf', 'adecb9ed35493ad8d65e99c59b503e22.pdf'),
(9, 9, 'L Shape Kitchen.jpg', '20f713286075d43362d1bd3ecedf4237.jpg'),
(10, 9, 'L Shape Kitchen.jpg', '2009c4c6794a6c9739393f4b10885cdf.jpg'),
(11, 6, 'EvaluationCommercialStmt3980975.pdf', 'e08b54ad7ae242331bde23bc3af6fca0.pdf'),
(15, 10, 'NIT FOR FONT AND SIZE.pdf', '3b77e4e31e85cec72ea5801fbd7c9cda.pdf'),
(18, 10, 'L Shape Kitchen.jpg', '158b445d7a254b1156c1dc9445078de3.jpg'),
(19, 9, 'NIT FOR FONT AND SIZE.pdf', '69e5f59cf04426fd599d68ee804244c6.pdf'),
(20, 9, 'EvaluationCommercialStmt3980975.pdf', 'dbb7b1707c48ccebacec9e6e6e0d4ff0.pdf'),
(21, 9, 'manish.jpg', 'c165241f7ee66e7d91b885ab680602d7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `table_after_pending_status`
--

CREATE TABLE IF NOT EXISTS `table_after_pending_status` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `tender_id` int(55) NOT NULL,
  `after_pending_status` int(55) NOT NULL,
  `after_pending_remark` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `table_after_pending_status`
--

INSERT INTO `table_after_pending_status` (`id`, `tender_id`, `after_pending_status`, `after_pending_remark`, `created_by`, `created_table`) VALUES
(9, 832, 4, 'meenu', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tender`
--

CREATE TABLE IF NOT EXISTS `tender` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `tender_office` varchar(255) NOT NULL,
  `tender_purchaser` int(55) NOT NULL,
  `tender_type` int(1) NOT NULL,
  `tender_number` varchar(256) NOT NULL,
  `tender_due_date` date NOT NULL,
  `tender_time` varchar(256) NOT NULL,
  `tender_sample` int(1) NOT NULL,
  `tender_tdc` float NOT NULL,
  `tender_emd` float NOT NULL,
  `tender_criteria` text NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(55) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(55) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `firm_status` int(55) DEFAULT NULL,
  `tender_composition_rate` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=840 ;

--
-- Dumping data for table `tender`
--

INSERT INTO `tender` (`id`, `tender_office`, `tender_purchaser`, `tender_type`, `tender_number`, `tender_due_date`, `tender_time`, `tender_sample`, `tender_tdc`, `tender_emd`, `tender_criteria`, `created_by`, `created_table`, `updated_by`, `updated_table`, `status`, `firm_status`, `tender_composition_rate`) VALUES
(828, '8', 48, 1, '11XX', '2026-03-26', '18:00', 0, 787, 878, 'Shaan', '1', '0', '1', '0', 0, 0, ''),
(832, '8', 49, 1, 'z', '2015-06-24', '09:21', 0, 2323, 2323, '323232332', '1', '0', '1', '0', 1, 0, ''),
(838, '8', 48, 1, 'Taranum', '2014-03-27', '', 0, 787, 878, 'Shaan', '1', '0', '1', '0', 1, 0, ''),
(839, '8', 48, 2, '452', '2012-07-18', '12:32', 0, 5656, 5656, '565565665', '1', '0', '1', '0', 3, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tender_attachments`
--

CREATE TABLE IF NOT EXISTS `tender_attachments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `tender_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `other_title` varchar(255) DEFAULT NULL,
  `file` text NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `tender_attachments`
--

INSERT INTO `tender_attachments` (`id`, `tender_id`, `title`, `other_title`, `file`, `file_real_name`) VALUES
(68, 831, '1', '', 'd140941f4d84fcad4821ec1ddd8a003c.jpg', 'L Shape Kitchen.jpg'),
(69, 831, '5', '', '6a97e94719a9319c01bad55157122ab0.jpg', 'L Shape Kitchen.jpg'),
(70, 831, '5', '', '8695e8f77e56d32b4cd49cc930a40d48.jpg', 'L Shape Kitchen.jpg'),
(71, 835, '2', '', 'f60d7752130f95ffc817771e77ddc78a.pdf', 'DigWP Publishing Digging into WordPress (2011).pdf'),
(72, 835, '5', '', '5e30d94392cb0cb297bd9e83bbd01b9f.jpg', 'L Shape Kitchen.jpg'),
(73, 828, '1', '', 'd6f985c98f9170e91a5743ac9b14f354.pdf', 'DigWP Publishing Digging into WordPress (2011).pdf'),
(74, 828, '10', 'sayma', 'a05b4712f599778ba66fd2e7f8224bbe.pdf', 'NIT FOR FONT AND SIZE.pdf'),
(75, 838, '10', 'sayma', 'a05b4712f599778ba66fd2e7f8224bbe.pdf', 'NIT FOR FONT AND SIZE.pdf'),
(76, 838, '1', '', 'd6f985c98f9170e91a5743ac9b14f354.pdf', 'DigWP Publishing Digging into WordPress (2011).pdf'),
(77, 18, '10', 'meeeeeenu', '6694614d2f6de9613d525d290a2487d1.jpg', '5.jpg'),
(78, 18, '3', '', 'a90d868746a2fd3ffee52b17ebc1dc2d.jpg', '5.jpg'),
(79, 18, '1', '', 'e1cf19b8b3787410562fb8b372f5a190.pdf', 'EvaluationCommercialStmt3980975.pdf'),
(80, 839, '2', '', '016786cb6b251620f956dbc1fe22380a.jpg', 'L Shape Kitchen.jpg'),
(81, 839, '4', '', '78040ecdf0d38763b15b2f309e2d34e4.pdf', 'EvaluationCommercialStmt3980975.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tender_bid_attachements`
--

CREATE TABLE IF NOT EXISTS `tender_bid_attachements` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `tender_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `other_title` varchar(255) DEFAULT NULL,
  `file` text NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `tender_bid_attachements`
--

INSERT INTO `tender_bid_attachements` (`id`, `tender_id`, `title`, `other_title`, `file`, `file_real_name`) VALUES
(18, 827, '3', '', '873bea0feeef877430ae5007589c49b3.dll', 'nspr4.dll'),
(19, 827, '3', '', '97221e5d2786df59a58602d73a5138c4.ini', 'application.ini'),
(21, 827, '1', '', '7856ff7f7cc80c1f08230e54ae3ed897.xml', 'blocklist.xml'),
(22, 827, '10', 'sayma', 'eff39e26a795cdfeacb4584197c0e508.xml', 'blocklist.xml'),
(23, 829, '1', '', '173a7fb924bcd4c27aebbe4c16a489fb.sql', 'rainbow.sql'),
(24, 828, '3', '', 'e6fe8afd78fd87d1e423128e455512b8.pdf', 'EvaluationCommercialStmt3980975.pdf'),
(25, 828, '10', 'shama', '55958e7f2243779e218ab08b67dce7c2.pdf', 'EvaluationCommercialStmt3980975.pdf'),
(26, 828, '2', '', '9af61018ee40fa2e3fa358686dc04dd1.pdf', 'NIT FOR FONT AND SIZE.pdf'),
(27, 828, '10', 'meeneu', '6aa46965a41d566de89c9d489ce2d88c.jpg', 'L Shape Kitchen.jpg'),
(28, 828, '1', '', 'bc5c4d2fa73a0d7554296213ca8928ea.pdf', 'NIT FOR FONT AND SIZE.pdf'),
(29, 828, '3', '', '6e5dd3445150721b73156d19fcba47aa.pdf', 'NIT FOR FONT AND SIZE.pdf'),
(30, 832, '1', '', 'c0beaea84cc45ac62bb7a5939204073c.pdf', 'NIT FOR FONT AND SIZE.pdf'),
(31, 838, '3', '', '39fa0ac85abbb04c482732936c33224e.pdf', 'NIT FOR FONT AND SIZE.pdf'),
(32, 838, '3', '', 'a03fc2259725df5c36b24680c6276b9d.jpg', 'manish.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tender_firms`
--

CREATE TABLE IF NOT EXISTS `tender_firms` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `product_id` int(55) DEFAULT NULL,
  `firm` int(55) DEFAULT NULL,
  `inspection` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `taxtype` int(10) DEFAULT NULL,
  `taxper` varchar(255) DEFAULT NULL,
  `oct` int(10) DEFAULT NULL,
  `othercharg` varchar(255) DEFAULT NULL,
  `disper` varchar(255) DEFAULT NULL,
  `finalrate` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `delperod` varchar(255) DEFAULT NULL,
  `delschedule` varchar(255) DEFAULT NULL,
  `validday` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `tdc` varchar(10) DEFAULT NULL,
  `emd` varchar(10) DEFAULT NULL,
  `spinate` varchar(255) DEFAULT NULL,
  `bid_number` varchar(255) DEFAULT NULL,
  `bid_rate` text,
  `bid_created_by` varchar(255) DEFAULT NULL,
  `bid_created_by_table` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(255) DEFAULT NULL,
  `flag` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tender_firms`
--

INSERT INTO `tender_firms` (`id`, `product_id`, `firm`, `inspection`, `rate`, `taxtype`, `taxper`, `oct`, `othercharg`, `disper`, `finalrate`, `payment`, `delperod`, `delschedule`, `validday`, `remark`, `tdc`, `emd`, `spinate`, `bid_number`, `bid_rate`, `bid_created_by`, `bid_created_by_table`, `created_by`, `created_table`, `updated_by`, `updated_table`, `flag`) VALUES
(17, 237, 15, '7', '3232', 4, '23', 2, '32', '1', '3254.13', '1', 'meenu', 'sayma', '', 'dasasa', '', '', 'Remark is not editable', NULL, NULL, '1', '0', '1', '0', '1', '0', 0),
(19, 232, 13, '3', '2323', 1, '232', 1, '3', '', '7943.73', '1', 'asasasasasas', 'asas', '', 'sasas', '', '', '', NULL, NULL, NULL, NULL, '1', '0', '1', '0', 0),
(20, 236, 14, '4', '45.26', 3, '25.30', 2, '89', '8', '146.8', '1', 'qqqqqqqqq', 'xxxxx', '', 'zzzzzzz', '', '', '', NULL, NULL, NULL, NULL, '1', '0', NULL, NULL, 0),
(21, 236, 14, '3', '87', 1, '78', 1, '8', '8', '153.87', '1', 'qqqqqqqqq', 'xxxxx', '', 'zzzzzzz', '', '', '', NULL, NULL, NULL, NULL, '1', '0', NULL, NULL, 0),
(22, 237, 15, '3', '89', 1, '898', 1, '0', '0', '888.22', '1', 'sasasa', 'sasasa', '', 'dasasa', '', '', '', NULL, NULL, NULL, NULL, '1', '0', NULL, NULL, 0),
(25, 249, 13, '3', '89', 3, '900', 1, '20', '50', '534', '1', 'asasasasasas', 'asas', '', 'sasas', '', '', '', NULL, NULL, NULL, NULL, '1', '0', '1', '0', 0),
(26, 249, 15, '5', '20', 1, '30', 1, '850', '', '247', '1', 'sasasa', 'sasasa', '', 'dasasa', '', '', '', NULL, NULL, NULL, NULL, '1', '0', NULL, NULL, 0),
(28, 250, 15, '5', '25', 1, '25', 1, '25', '25', '29.29', '1', 'sasasa', 'sasasa', '', 'dasasa', '', '', '', NULL, NULL, NULL, NULL, '1', '0', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tender_firm_product`
--

CREATE TABLE IF NOT EXISTS `tender_firm_product` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `tender_id` int(55) NOT NULL,
  `category` text NOT NULL,
  `inspection` varchar(255) NOT NULL,
  `discription` varchar(255) NOT NULL,
  `consignee` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=251 ;

--
-- Dumping data for table `tender_firm_product`
--

INSERT INTO `tender_firm_product` (`id`, `tender_id`, `category`, `inspection`, `discription`, `consignee`, `quantity`, `unit`) VALUES
(232, 828, '34', '3', 'aaaaaa', '25', '1', '4'),
(233, 828, '34', '3', 'bbbbbbbb', '24', '20', '4'),
(236, 838, '34', '3', 'asasas', '24', '10', '4'),
(237, 838, '34', '3', 'asasas', '25', '20', '4'),
(238, 838, '32', '3', '', '25', '30', '1'),
(239, 838, '35', '3', '', '27', '', '1'),
(240, 832, '32', '5', 'sasasa', '26', '2121212', '1'),
(241, 832, '32', '5', 'sasasa', '27', '21', '5'),
(242, 832, '32', '4', 'aaaaaaaaaa aaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaa', '24', '', '1'),
(243, 832, '34', '5', 'zzzzzzzzzzzz zzzzzzzzzzzzzzzzzzzzz zzzzzzzzzzzzzzzzzzzzz zzzzzzzzzzzzzzzzzzzzzzzzzzzzz', '25', '', '1'),
(244, 832, '32', '5', 'ccccccccccccccc ccccccccccccccccccccccccccc cccccccccccccccccccccccccc cccccccccccccccccccc', '26', '', '1'),
(245, 832, '34', '5', 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', '26', '', '1'),
(246, 832, '32', '5', 'vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', '28', '', '1'),
(247, 828, '32', '5', 'ccccccc', '26', '10', '4'),
(248, 828, '29', '3', 'dddddddddd', '27', '', '5'),
(249, 839, '32', '3', 'product discripton part first', '25', '200', '2'),
(250, 839, '34', '5', 'product discripton part second', '23', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tender_limited_firm`
--

CREATE TABLE IF NOT EXISTS `tender_limited_firm` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `tender_id` int(55) NOT NULL,
  `firm_id` int(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tender_limited_firm`
--

INSERT INTO `tender_limited_firm` (`id`, `tender_id`, `firm_id`) VALUES
(1, 831, 13),
(2, 831, 16),
(3, 831, 18),
(4, 835, 14),
(5, 836, 14),
(6, 836, 17),
(7, 836, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tender_quoted_attachments`
--

CREATE TABLE IF NOT EXISTS `tender_quoted_attachments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `tender_firm_id` int(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file` text,
  `file_real_name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tender_quoted_attachments`
--

INSERT INTO `tender_quoted_attachments` (`id`, `tender_firm_id`, `title`, `file`, `file_real_name`) VALUES
(4, 28, 'jhjhghjh', 'c730e3cf465237e5a0b87771a1df9135.docx', 'nifty bio data-1.docx');

-- --------------------------------------------------------

--
-- Table structure for table `tender_rate_attachements`
--

CREATE TABLE IF NOT EXISTS `tender_rate_attachements` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `tender_id` int(255) NOT NULL,
  `file` text,
  `file_real_name` text,
  `bid_number` varchar(255) DEFAULT NULL,
  `bid_rate` text,
  `bid_created_by` varchar(255) DEFAULT NULL,
  `bid_created_by_table` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_table` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_table` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tender_rate_attachements`
--

