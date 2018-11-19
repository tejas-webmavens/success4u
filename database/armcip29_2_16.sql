-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2016 at 07:35 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `armcip`
--

-- --------------------------------------------------------

--
-- Table structure for table `arm_banned`
--

CREATE TABLE IF NOT EXISTS `arm_banned` (
  `BannedId` int(11) NOT NULL,
  `Ip` varchar(20) NOT NULL,
  `Status` enum('0','1') NOT NULL,
  `DateAdded` datetime NOT NULL,
  `isDelete` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_banned`
--

INSERT INTO `arm_banned` (`BannedId`, `Ip`, `Status`, `DateAdded`, `isDelete`) VALUES
(1, '::1', '0', '2016-02-25 05:33:25', '0');

-- --------------------------------------------------------

--
-- Table structure for table `arm_category`
--

CREATE TABLE IF NOT EXISTS `arm_category` (
  `categoryId` int(11) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Description` text NOT NULL,
  `ParentId` int(11) NOT NULL DEFAULT '0',
  `SortOrder` int(3) NOT NULL DEFAULT '0',
  `Status` tinyint(1) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `arm_category`
--

INSERT INTO `arm_category` (`categoryId`, `Category`, `Image`, `Description`, `ParentId`, `SortOrder`, `Status`, `DateAdded`, `DateModified`) VALUES
(1, 'teetet', 'd926894e6921bf0de8dad8f5b85f4d08.png', '', 6, 1, 1, '2016-02-01 05:39:31', '2016-02-22 05:59:01'),
(2, 'sdsd', '011a7bd1efdad96e5f4a0177827e8058.jpg', '', 2, 1, 1, '2016-02-01 05:44:27', '0000-00-00 00:00:00'),
(4, 'testing', '56f623765fc3b92e074b99d0094c899b.jpg', '', 0, 1, 1, '2016-02-01 12:25:52', '0000-00-00 00:00:00'),
(5, 'tesseee', 'c01d0fc7acdf1c8bab975b25c3f99bd5.jpg', '', 0, 1, 1, '2016-02-01 12:27:20', '0000-00-00 00:00:00'),
(9, 'teetet', NULL, '', 0, 0, 1, '2016-02-20 05:57:33', '0000-00-00 00:00:00'),
(6, 'test', '1d671c2c5522ef6a9605edeef6e3aa61.jpg', '', 4, 5, 1, '2016-02-08 11:51:17', '0000-00-00 00:00:00'),
(7, 'test2', '2805c5b3349a5d730f9c275acaabe565.jpg', '', 6, 4, 1, '2016-02-08 12:18:46', '0000-00-00 00:00:00'),
(8, 'iphone', 'ee4024cf48fbadb46bf8811340691cb2.jpg', '', 3, 5, 1, '2016-02-08 02:44:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `arm_country`
--

CREATE TABLE IF NOT EXISTS `arm_country` (
  `country_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `iso_code_2` varchar(2) NOT NULL,
  `iso_code_3` varchar(3) NOT NULL,
  `address_format` text NOT NULL,
  `postcode_required` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=258 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `arm_country`
--

INSERT INTO `arm_country` (`country_id`, `name`, `iso_code_2`, `iso_code_3`, `address_format`, `postcode_required`, `status`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', '', 0, 1),
(2, 'Albania', 'AL', 'ALB', '', 0, 1),
(3, 'Algeria', 'DZ', 'DZA', '', 0, 1),
(4, 'American Samoa', 'AS', 'ASM', '', 0, 1),
(5, 'Andorra', 'AD', 'AND', '', 0, 1),
(6, 'Angola', 'AO', 'AGO', '', 0, 1),
(7, 'Anguilla', 'AI', 'AIA', '', 0, 1),
(8, 'Antarctica', 'AQ', 'ATA', '', 0, 1),
(9, 'Antigua and Barbuda', 'AG', 'ATG', '', 0, 1),
(10, 'Argentina', 'AR', 'ARG', '', 0, 1),
(11, 'Armenia', 'AM', 'ARM', '', 0, 1),
(12, 'Aruba', 'AW', 'ABW', '', 0, 1),
(13, 'Australia', 'AU', 'AUS', '', 0, 1),
(14, 'Austria', 'AT', 'AUT', '', 0, 1),
(15, 'Azerbaijan', 'AZ', 'AZE', '', 0, 1),
(16, 'Bahamas', 'BS', 'BHS', '', 0, 1),
(17, 'Bahrain', 'BH', 'BHR', '', 0, 1),
(18, 'Bangladesh', 'BD', 'BGD', '', 0, 1),
(19, 'Barbados', 'BB', 'BRB', '', 0, 1),
(20, 'Belarus', 'BY', 'BLR', '', 0, 1),
(21, 'Belgium', 'BE', 'BEL', '{firstname} {lastname}\n{company}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}', 0, 1),
(22, 'Belize', 'BZ', 'BLZ', '', 0, 1),
(23, 'Benin', 'BJ', 'BEN', '', 0, 1),
(24, 'Bermuda', 'BM', 'BMU', '', 0, 1),
(25, 'Bhutan', 'BT', 'BTN', '', 0, 1),
(26, 'Bolivia', 'BO', 'BOL', '', 0, 1),
(27, 'Bosnia and Herzegovina', 'BA', 'BIH', '', 0, 1),
(28, 'Botswana', 'BW', 'BWA', '', 0, 1),
(29, 'Bouvet Island', 'BV', 'BVT', '', 0, 1),
(30, 'Brazil', 'BR', 'BRA', '', 0, 1),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', '', 0, 1),
(32, 'Brunei Darussalam', 'BN', 'BRN', '', 0, 1),
(33, 'Bulgaria', 'BG', 'BGR', '', 0, 1),
(34, 'Burkina Faso', 'BF', 'BFA', '', 0, 1),
(35, 'Burundi', 'BI', 'BDI', '', 0, 1),
(36, 'Cambodia', 'KH', 'KHM', '', 0, 1),
(37, 'Cameroon', 'CM', 'CMR', '', 0, 1),
(38, 'Canada', 'CA', 'CAN', '', 0, 1),
(39, 'Cape Verde', 'CV', 'CPV', '', 0, 1),
(40, 'Cayman Islands', 'KY', 'CYM', '', 0, 1),
(41, 'Central African Republic', 'CF', 'CAF', '', 0, 1),
(42, 'Chad', 'TD', 'TCD', '', 0, 1),
(43, 'Chile', 'CL', 'CHL', '', 0, 1),
(44, 'China', 'CN', 'CHN', '', 0, 1),
(45, 'Christmas Island', 'CX', 'CXR', '', 0, 1),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', '', 0, 1),
(47, 'Colombia', 'CO', 'COL', '', 0, 1),
(48, 'Comoros', 'KM', 'COM', '', 0, 1),
(49, 'Congo', 'CG', 'COG', '', 0, 1),
(50, 'Cook Islands', 'CK', 'COK', '', 0, 1),
(51, 'Costa Rica', 'CR', 'CRI', '', 0, 1),
(52, 'Cote DIvoire', 'CI', 'CIV', '', 0, 1),
(53, 'Croatia', 'HR', 'HRV', '', 0, 1),
(54, 'Cuba', 'CU', 'CUB', '', 0, 1),
(55, 'Cyprus', 'CY', 'CYP', '', 0, 1),
(56, 'Czech Republic', 'CZ', 'CZE', '', 0, 1),
(57, 'Denmark', 'DK', 'DNK', '', 0, 1),
(58, 'Djibouti', 'DJ', 'DJI', '', 0, 1),
(59, 'Dominica', 'DM', 'DMA', '', 0, 1),
(60, 'Dominican Republic', 'DO', 'DOM', '', 0, 1),
(61, 'East Timor', 'TL', 'TLS', '', 0, 1),
(62, 'Ecuador', 'EC', 'ECU', '', 0, 1),
(63, 'Egypt', 'EG', 'EGY', '', 0, 1),
(64, 'El Salvador', 'SV', 'SLV', '', 0, 1),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', '', 0, 1),
(66, 'Eritrea', 'ER', 'ERI', '', 0, 1),
(67, 'Estonia', 'EE', 'EST', '', 0, 1),
(68, 'Ethiopia', 'ET', 'ETH', '', 0, 1),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', '', 0, 1),
(70, 'Faroe Islands', 'FO', 'FRO', '', 0, 1),
(71, 'Fiji', 'FJ', 'FJI', '', 0, 1),
(72, 'Finland', 'FI', 'FIN', '', 0, 1),
(74, 'France, Metropolitan', 'FR', 'FRA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1),
(75, 'French Guiana', 'GF', 'GUF', '', 0, 1),
(76, 'French Polynesia', 'PF', 'PYF', '', 0, 1),
(77, 'French Southern Territories', 'TF', 'ATF', '', 0, 1),
(78, 'Gabon', 'GA', 'GAB', '', 0, 1),
(79, 'Gambia', 'GM', 'GMB', '', 0, 1),
(80, 'Georgia', 'GE', 'GEO', '', 0, 1),
(81, 'Germany', 'DE', 'DEU', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1),
(82, 'Ghana', 'GH', 'GHA', '', 0, 1),
(83, 'Gibraltar', 'GI', 'GIB', '', 0, 1),
(84, 'Greece', 'GR', 'GRC', '', 0, 1),
(85, 'Greenland', 'GL', 'GRL', '', 0, 1),
(86, 'Grenada', 'GD', 'GRD', '', 0, 1),
(87, 'Guadeloupe', 'GP', 'GLP', '', 0, 1),
(88, 'Guam', 'GU', 'GUM', '', 0, 1),
(89, 'Guatemala', 'GT', 'GTM', '', 0, 1),
(90, 'Guinea', 'GN', 'GIN', '', 0, 1),
(91, 'Guinea-Bissau', 'GW', 'GNB', '', 0, 1),
(92, 'Guyana', 'GY', 'GUY', '', 0, 1),
(93, 'Haiti', 'HT', 'HTI', '', 0, 1),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', '', 0, 1),
(95, 'Honduras', 'HN', 'HND', '', 0, 1),
(96, 'Hong Kong', 'HK', 'HKG', '', 0, 1),
(97, 'Hungary', 'HU', 'HUN', '', 0, 1),
(98, 'Iceland', 'IS', 'ISL', '', 0, 1),
(99, 'India', 'IN', 'IND', '', 0, 1),
(100, 'Indonesia', 'ID', 'IDN', '', 0, 1),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN', '', 0, 1),
(102, 'Iraq', 'IQ', 'IRQ', '', 0, 1),
(103, 'Ireland', 'IE', 'IRL', '', 0, 1),
(104, 'Israel', 'IL', 'ISR', '', 0, 1),
(105, 'Italy', 'IT', 'ITA', '', 0, 1),
(106, 'Jamaica', 'JM', 'JAM', '', 0, 1),
(107, 'Japan', 'JP', 'JPN', '', 0, 1),
(108, 'Jordan', 'JO', 'JOR', '', 0, 1),
(109, 'Kazakhstan', 'KZ', 'KAZ', '', 0, 1),
(110, 'Kenya', 'KE', 'KEN', '', 0, 1),
(111, 'Kiribati', 'KI', 'KIR', '', 0, 1),
(112, 'North Korea', 'KP', 'PRK', '', 0, 1),
(113, 'South Korea', 'KR', 'KOR', '', 0, 1),
(114, 'Kuwait', 'KW', 'KWT', '', 0, 1),
(115, 'Kyrgyzstan', 'KG', 'KGZ', '', 0, 1),
(116, 'Lao Peoples Democratic Republic', 'LA', 'LAO', '', 0, 1),
(117, 'Latvia', 'LV', 'LVA', '', 0, 1),
(118, 'Lebanon', 'LB', 'LBN', '', 0, 1),
(119, 'Lesotho', 'LS', 'LSO', '', 0, 1),
(120, 'Liberia', 'LR', 'LBR', '', 0, 1),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', '', 0, 1),
(122, 'Liechtenstein', 'LI', 'LIE', '', 0, 1),
(123, 'Lithuania', 'LT', 'LTU', '', 0, 1),
(124, 'Luxembourg', 'LU', 'LUX', '', 0, 1),
(125, 'Macau', 'MO', 'MAC', '', 0, 1),
(126, 'FYROM', 'MK', 'MKD', '', 0, 1),
(127, 'Madagascar', 'MG', 'MDG', '', 0, 1),
(128, 'Malawi', 'MW', 'MWI', '', 0, 1),
(129, 'Malaysia', 'MY', 'MYS', '', 0, 1),
(130, 'Maldives', 'MV', 'MDV', '', 0, 1),
(131, 'Mali', 'ML', 'MLI', '', 0, 1),
(132, 'Malta', 'MT', 'MLT', '', 0, 1),
(133, 'Marshall Islands', 'MH', 'MHL', '', 0, 1),
(134, 'Martinique', 'MQ', 'MTQ', '', 0, 1),
(135, 'Mauritania', 'MR', 'MRT', '', 0, 1),
(136, 'Mauritius', 'MU', 'MUS', '', 0, 1),
(137, 'Mayotte', 'YT', 'MYT', '', 0, 1),
(138, 'Mexico', 'MX', 'MEX', '', 0, 1),
(139, 'Micronesia, Federated States of', 'FM', 'FSM', '', 0, 1),
(140, 'Moldova, Republic of', 'MD', 'MDA', '', 0, 1),
(141, 'Monaco', 'MC', 'MCO', '', 0, 1),
(142, 'Mongolia', 'MN', 'MNG', '', 0, 1),
(143, 'Montserrat', 'MS', 'MSR', '', 0, 1),
(144, 'Morocco', 'MA', 'MAR', '', 0, 1),
(145, 'Mozambique', 'MZ', 'MOZ', '', 0, 1),
(146, 'Myanmar', 'MM', 'MMR', '', 0, 1),
(147, 'Namibia', 'NA', 'NAM', '', 0, 1),
(148, 'Nauru', 'NR', 'NRU', '', 0, 1),
(149, 'Nepal', 'NP', 'NPL', '', 0, 1),
(150, 'Netherlands', 'NL', 'NLD', '', 0, 1),
(151, 'Netherlands Antilles', 'AN', 'ANT', '', 0, 1),
(152, 'New Caledonia', 'NC', 'NCL', '', 0, 1),
(153, 'New Zealand', 'NZ', 'NZL', '', 0, 1),
(154, 'Nicaragua', 'NI', 'NIC', '', 0, 1),
(155, 'Niger', 'NE', 'NER', '', 0, 1),
(156, 'Nigeria', 'NG', 'NGA', '', 0, 1),
(157, 'Niue', 'NU', 'NIU', '', 0, 1),
(158, 'Norfolk Island', 'NF', 'NFK', '', 0, 1),
(159, 'Northern Mariana Islands', 'MP', 'MNP', '', 0, 1),
(160, 'Norway', 'NO', 'NOR', '', 0, 1),
(161, 'Oman', 'OM', 'OMN', '', 0, 1),
(162, 'Pakistan', 'PK', 'PAK', '', 0, 1),
(163, 'Palau', 'PW', 'PLW', '', 0, 1),
(164, 'Panama', 'PA', 'PAN', '', 0, 1),
(165, 'Papua New Guinea', 'PG', 'PNG', '', 0, 1),
(166, 'Paraguay', 'PY', 'PRY', '', 0, 1),
(167, 'Peru', 'PE', 'PER', '', 0, 1),
(168, 'Philippines', 'PH', 'PHL', '', 0, 1),
(169, 'Pitcairn', 'PN', 'PCN', '', 0, 1),
(170, 'Poland', 'PL', 'POL', '', 0, 1),
(171, 'Portugal', 'PT', 'PRT', '', 0, 1),
(172, 'Puerto Rico', 'PR', 'PRI', '', 0, 1),
(173, 'Qatar', 'QA', 'QAT', '', 0, 1),
(174, 'Reunion', 'RE', 'REU', '', 0, 1),
(175, 'Romania', 'RO', 'ROM', '', 0, 1),
(176, 'Russian Federation', 'RU', 'RUS', '', 0, 1),
(177, 'Rwanda', 'RW', 'RWA', '', 0, 1),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA', '', 0, 1),
(179, 'Saint Lucia', 'LC', 'LCA', '', 0, 1),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', '', 0, 1),
(181, 'Samoa', 'WS', 'WSM', '', 0, 1),
(182, 'San Marino', 'SM', 'SMR', '', 0, 1),
(183, 'Sao Tome and Principe', 'ST', 'STP', '', 0, 1),
(184, 'Saudi Arabia', 'SA', 'SAU', '', 0, 1),
(185, 'Senegal', 'SN', 'SEN', '', 0, 1),
(186, 'Seychelles', 'SC', 'SYC', '', 0, 1),
(187, 'Sierra Leone', 'SL', 'SLE', '', 0, 1),
(188, 'Singapore', 'SG', 'SGP', '', 0, 1),
(189, 'Slovak Republic', 'SK', 'SVK', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city} {postcode}\r\n{zone}\r\n{country}', 0, 1),
(190, 'Slovenia', 'SI', 'SVN', '', 0, 1),
(191, 'Solomon Islands', 'SB', 'SLB', '', 0, 1),
(192, 'Somalia', 'SO', 'SOM', '', 0, 1),
(193, 'South Africa', 'ZA', 'ZAF', '', 0, 1),
(194, 'South Georgia &amp; South Sandwich Islands', 'GS', 'SGS', '', 0, 1),
(195, 'Spain', 'ES', 'ESP', '', 0, 1),
(196, 'Sri Lanka', 'LK', 'LKA', '', 0, 1),
(197, 'St. Helena', 'SH', 'SHN', '', 0, 1),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM', '', 0, 1),
(199, 'Sudan', 'SD', 'SDN', '', 0, 1),
(200, 'Suriname', 'SR', 'SUR', '', 0, 1),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '', 0, 1),
(202, 'Swaziland', 'SZ', 'SWZ', '', 0, 1),
(203, 'Sweden', 'SE', 'SWE', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1),
(204, 'Switzerland', 'CH', 'CHE', '', 0, 1),
(205, 'Syrian Arab Republic', 'SY', 'SYR', '', 0, 1),
(206, 'Taiwan', 'TW', 'TWN', '', 0, 1),
(207, 'Tajikistan', 'TJ', 'TJK', '', 0, 1),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA', '', 0, 1),
(209, 'Thailand', 'TH', 'THA', '', 0, 1),
(210, 'Togo', 'TG', 'TGO', '', 0, 1),
(211, 'Tokelau', 'TK', 'TKL', '', 0, 1),
(212, 'Tonga', 'TO', 'TON', '', 0, 1),
(213, 'Trinidad and Tobago', 'TT', 'TTO', '', 0, 1),
(214, 'Tunisia', 'TN', 'TUN', '', 0, 1),
(215, 'Turkey', 'TR', 'TUR', '', 0, 1),
(216, 'Turkmenistan', 'TM', 'TKM', '', 0, 1),
(217, 'Turks and Caicos Islands', 'TC', 'TCA', '', 0, 1),
(218, 'Tuvalu', 'TV', 'TUV', '', 0, 1),
(219, 'Uganda', 'UG', 'UGA', '', 0, 1),
(220, 'Ukraine', 'UA', 'UKR', '', 0, 1),
(221, 'United Arab Emirates', 'AE', 'ARE', '', 0, 1),
(222, 'United Kingdom', 'GB', 'GBR', '', 1, 1),
(223, 'United States', 'US', 'USA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city}, {zone} {postcode}\r\n{country}', 0, 1),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI', '', 0, 1),
(225, 'Uruguay', 'UY', 'URY', '', 0, 1),
(226, 'Uzbekistan', 'UZ', 'UZB', '', 0, 1),
(227, 'Vanuatu', 'VU', 'VUT', '', 0, 1),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT', '', 0, 1),
(229, 'Venezuela', 'VE', 'VEN', '', 0, 1),
(230, 'Viet Nam', 'VN', 'VNM', '', 0, 1),
(231, 'Virgin Islands (British)', 'VG', 'VGB', '', 0, 1),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', '', 0, 1),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF', '', 0, 1),
(234, 'Western Sahara', 'EH', 'ESH', '', 0, 1),
(235, 'Yemen', 'YE', 'YEM', '', 0, 1),
(237, 'Democratic Republic of Congo', 'CD', 'COD', '', 0, 1),
(238, 'Zambia', 'ZM', 'ZMB', '', 0, 1),
(239, 'Zimbabwe', 'ZW', 'ZWE', '', 0, 1),
(242, 'Montenegro', 'ME', 'MNE', '', 0, 1),
(243, 'Serbia', 'RS', 'SRB', '', 0, 1),
(244, 'Aaland Islands', 'AX', 'ALA', '', 0, 1),
(245, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', '', 0, 1),
(246, 'Curacao', 'CW', 'CUW', '', 0, 1),
(247, 'Palestinian Territory, Occupied', 'PS', 'PSE', '', 0, 1),
(248, 'South Sudan', 'SS', 'SSD', '', 0, 1),
(249, 'St. Barthelemy', 'BL', 'BLM', '', 0, 1),
(250, 'St. Martin (French part)', 'MF', 'MAF', '', 0, 1),
(251, 'Canary Islands', 'IC', 'ICA', '', 0, 1),
(252, 'Ascension Island (British)', 'AC', 'ASC', '', 0, 1),
(253, 'Kosovo, Republic of', 'XK', 'UNK', '', 0, 1),
(254, 'Isle of Man', 'IM', 'IMN', '', 0, 1),
(255, 'Tristan da Cunha', 'TA', 'SHN', '', 0, 1),
(256, 'Guernsey', 'GG', 'GGY', '', 0, 1),
(257, 'Jersey', 'JE', 'JEY', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `arm_coupon`
--

CREATE TABLE IF NOT EXISTS `arm_coupon` (
  `CouponId` int(11) NOT NULL,
  `CouponName` varchar(255) NOT NULL,
  `CouponCode` varchar(20) NOT NULL,
  `CouponType` char(1) NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `UseUser` int(11) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `UsedTotal` int(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `isDelete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_coupon`
--

INSERT INTO `arm_coupon` (`CouponId`, `CouponName`, `CouponCode`, `CouponType`, `StartDate`, `EndDate`, `UseUser`, `Total`, `UsedTotal`, `Status`, `DateAdded`, `isDelete`) VALUES
(2, '10% OFF', 'GVUJFGTICE3JBAPK', 'p', '2016-02-18 12:00:00', '2016-02-24 12:00:00', 0, '10.00', 1, 1, '2016-02-17 06:14:03', 0),
(3, 'testing new', 'TFXBP4QSYRT0DHOE', 'p', '2016-02-17 12:00:00', '2016-02-18 12:00:00', 0, '100.00', 1, 1, '2016-02-17 06:47:53', 0),
(4, '20% Off', 'KYVQPGXWEFN3AJWS', 'p', '2016-02-18 12:00:00', '2016-02-24 12:00:00', 0, '20.00', 1, 0, '2016-02-17 01:02:29', 0),
(5, '23435', 'UXKSCH5QWMSEXYJI', 'p', '2016-02-18 12:00:00', '2016-02-19 12:00:00', 0, '0.00', 0, 1, '2016-02-18 09:30:27', 0),
(6, '23435', 'QIVER9GBBKYLDIUZ', 'p', '2016-02-18 12:00:00', '2016-02-19 12:00:00', 0, '0.00', 2, 1, '2016-02-18 09:33:02', 0),
(7, '23435', 'BUXAIKPZS8LUTP4D', 'p', '2016-02-18 12:00:00', '2016-02-19 12:00:00', 0, '232323.00', 2, 1, '2016-02-18 09:34:21', 0),
(8, 'sdsdsdsd', '5TAUB6TQ98NGSXCX', 'f', '2016-02-18 12:00:00', '2016-02-19 12:00:00', 0, '34.00', 1, 1, '2016-02-18 09:43:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `arm_coupon_category`
--

CREATE TABLE IF NOT EXISTS `arm_coupon_category` (
  `CouponCategoryId` int(11) NOT NULL,
  `CouponId` int(11) NOT NULL,
  `CategoryId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_coupon_category`
--

INSERT INTO `arm_coupon_category` (`CouponCategoryId`, `CouponId`, `CategoryId`) VALUES
(1, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `arm_coupon_history`
--

CREATE TABLE IF NOT EXISTS `arm_coupon_history` (
  `HistoryId` int(1) NOT NULL,
  `CouponId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `Amount` decimal(15,4) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `arm_coupon_product`
--

CREATE TABLE IF NOT EXISTS `arm_coupon_product` (
  `CouponProductId` int(11) NOT NULL,
  `CouponId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_coupon_product`
--

INSERT INTO `arm_coupon_product` (`CouponProductId`, `CouponId`, `ProductId`) VALUES
(1, 4, 7),
(2, 4, 8),
(3, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `arm_currency`
--

CREATE TABLE IF NOT EXISTS `arm_currency` (
  `CurrencyId` int(11) NOT NULL,
  `CurrencyName` varchar(50) NOT NULL,
  `CurrencyCode` varchar(50) NOT NULL,
  `CurrencySymbol` varchar(50) NOT NULL,
  `CurrencyValue` decimal(15,4) NOT NULL,
  `Status` tinyint(4) NOT NULL COMMENT '0-Deleted, 1-Active',
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_customfields`
--

CREATE TABLE IF NOT EXISTS `arm_customfields` (
  `CustomFieldId` int(11) NOT NULL,
  `CustomLabel` varchar(50) NOT NULL,
  `CustomName` varchar(50) NOT NULL,
  `CustomType` varchar(50) NOT NULL,
  `CustomValue` text NOT NULL,
  `CustomFieldRequire` int(11) NOT NULL,
  `Location` varchar(50) NOT NULL,
  `Status` tinyint(4) NOT NULL COMMENT '0-Deleted, 1-Active',
  `SortOrder` tinyint(4) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_customfields`
--

INSERT INTO `arm_customfields` (`CustomFieldId`, `CustomLabel`, `CustomName`, `CustomType`, `CustomValue`, `CustomFieldRequire`, `Location`, `Status`, `SortOrder`, `DateAdded`, `DateModified`) VALUES
(1, 'NIC', 'NicNumber', 'int', '123', 0, 'register', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'facebookid', 'FacebookId', 'varchar', 'arun@fb.com', 1, 'register', 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `arm_discount`
--

CREATE TABLE IF NOT EXISTS `arm_discount` (
  `CouponId` int(11) NOT NULL,
  `CouponName` varchar(50) NOT NULL,
  `CouponCode` varchar(10) NOT NULL,
  `CouponType` varchar(10) NOT NULL,
  `Total` decimal(15,4) NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `UsedCount` int(5) NOT NULL,
  `UseCustomer` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_epin`
--

CREATE TABLE IF NOT EXISTS `arm_epin` (
  `EpinRecordId` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL COMMENT '1-enable, 0- disable',
  `EpinPackageId` int(11) NOT NULL,
  `EpinCount` int(11) NOT NULL,
  `EpinTransactionId` varchar(50) NOT NULL,
  `EpinVoucherId` varchar(50) NOT NULL,
  `EpinAmount` decimal(10,2) NOT NULL,
  `ExpiryDay` datetime NOT NULL,
  `AllocatedBy` int(11) NOT NULL COMMENT 'Which user can allocated this epin ',
  `UsedBy` int(11) NOT NULL COMMENT 'Which user can used this epin ',
  `DateAdded` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `EpinStatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-unused, 1-allocated, 2-used, 3-cancel',
  `isDelete` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_epin`
--

INSERT INTO `arm_epin` (`EpinRecordId`, `Status`, `EpinPackageId`, `EpinCount`, `EpinTransactionId`, `EpinVoucherId`, `EpinAmount`, `ExpiryDay`, `AllocatedBy`, `UsedBy`, `DateAdded`, `ModifiedDate`, `EpinStatus`, `isDelete`) VALUES
(40, 0, 2, 1, 'S3EPWQ5U792Y1JKG', '', '500.00', '2016-02-29 00:00:00', 1, 0, '2016-02-12 18:30:59', '2016-02-13 12:40:39', 1, 0),
(41, 0, 2, 1, 'SWTF5QERP6KCHMBN', '', '500.00', '2016-02-29 00:00:00', 1, 0, '2016-02-12 18:30:59', '2016-02-12 18:31:22', 1, 0),
(42, 0, 2, 1, 'AXHGQSMCEYZR46VP', '', '500.00', '2016-02-29 00:00:00', 1, 0, '2016-02-12 18:30:59', '2016-02-12 18:31:22', 1, 0),
(43, 0, 2, 1, 'G27J613HU4PERQKY', '', '500.00', '2016-02-29 00:00:00', 1, 0, '2016-02-12 18:30:59', '2016-02-12 18:31:22', 1, 0),
(44, 0, 2, 1, 'SCPQ986K7W1VUJ4D', '', '500.00', '2016-02-29 00:00:00', 1, 0, '2016-02-12 18:30:59', '2016-02-12 18:31:22', 1, 0),
(45, 0, 4, 1, 'F9J5YP6217EWVKT3', '', '140.00', '2016-02-25 00:00:00', 0, 0, '2016-02-13 11:00:07', '0000-00-00 00:00:00', 0, 0),
(46, 0, 4, 1, '7H1MJZDK5NFCTV3B', '', '140.00', '2016-02-25 00:00:00', 0, 0, '2016-02-13 11:00:07', '0000-00-00 00:00:00', 0, 0),
(47, 0, 4, 1, 'JBKZM7WHDY6N5RG2', '', '140.00', '2016-02-25 00:00:00', 0, 0, '2016-02-13 11:00:07', '0000-00-00 00:00:00', 0, 0),
(48, 0, 5, 1, 'CGHU5PJFB9S16VMA', '', '222.00', '2016-02-23 00:00:00', 0, 0, '2016-02-13 11:52:26', '0000-00-00 00:00:00', 0, 0),
(49, 0, 5, 1, 'GE637ACT58DJY219', '', '222.00', '2016-02-23 00:00:00', 0, 0, '2016-02-13 11:52:26', '0000-00-00 00:00:00', 0, 0),
(50, 0, 5, 1, 'RDYT5MHGZ6BA487U', '', '222.00', '2016-02-23 00:00:00', 0, 0, '2016-02-13 11:52:26', '0000-00-00 00:00:00', 0, 0),
(51, 0, 5, 1, 'ZUYMV5APD6Q7BKXC', '', '222.00', '2016-02-23 00:00:00', 0, 0, '2016-02-13 11:52:26', '0000-00-00 00:00:00', 0, 0),
(52, 0, 5, 1, 'P2M7WECBXH1NYR4K', '', '222.00', '2016-02-23 00:00:00', 0, 0, '2016-02-13 11:52:26', '0000-00-00 00:00:00', 0, 0),
(53, 0, 2, 1, 'UFHEK2QYC6RN78GJ', '', '500.00', '2016-02-24 00:00:00', 1, 0, '2016-02-13 11:52:39', '2016-02-13 12:40:39', 1, 0),
(54, 0, 2, 1, '83Y2SBGK4T1D9RC6', '', '500.00', '2016-02-24 00:00:00', 1, 0, '2016-02-13 11:52:39', '2016-02-13 12:40:39', 1, 0),
(55, 0, 2, 1, 'VWEAP6JDQYG8M43N', '', '500.00', '2016-02-18 00:00:00', 1, 0, '2016-02-13 12:40:21', '2016-02-13 12:40:39', 1, 0),
(56, 0, 2, 1, 'M9WRCJH1SYBPXAGD', '', '500.00', '2016-02-18 00:00:00', 1, 0, '2016-02-13 12:40:21', '2016-02-13 12:40:39', 1, 0),
(57, 0, 2, 1, '8C4MVZ1HQTY2GNK6', '', '500.00', '2016-02-18 00:00:00', 1, 0, '2016-02-13 12:40:21', '2016-02-13 12:40:39', 1, 0),
(58, 0, 2, 1, 'GPJ9618RC3SYH42Z', '', '500.00', '2016-02-18 00:00:00', 1, 0, '2016-02-13 12:40:21', '2016-02-13 12:40:39', 1, 0),
(59, 0, 2, 1, 'VA9T6XSB13DNY8MJ', '', '500.00', '2016-02-18 00:00:00', 1, 0, '2016-02-13 12:40:21', '2016-02-13 12:40:39', 1, 0),
(60, 0, 2, 1, 'JZDHKTX78BSCMRG3', '', '500.00', '2015-12-02 00:00:00', 0, 0, '2016-02-13 13:55:20', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `arm_ewallet`
--

CREATE TABLE IF NOT EXISTS `arm_ewallet` (
  `EwalletId` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `Debit` decimal(15,4) NOT NULL,
  `Credit` decimal(15,4) NOT NULL,
  `Balance` decimal(15,4) NOT NULL,
  `Description` text NOT NULL,
  `TransactionId` varchar(32) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_forcedmatrix`
--

CREATE TABLE IF NOT EXISTS `arm_forcedmatrix` (
  `ForcedMatrixId` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `DirectId` int(11) NOT NULL,
  `SpilloverId` int(11) NOT NULL,
  `LevelCount` int(5) NOT NULL,
  `MemberCount` int(5) NOT NULL,
  `Status` tinyint(1) NOT NULL COMMENT '0-InActive, 1-Active',
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_history`
--

CREATE TABLE IF NOT EXISTS `arm_history` (
  `HistoryId` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `TypeId` int(11) NOT NULL,
  `Credit` decimal(15,4) NOT NULL COMMENT '(+)',
  `Debit` decimal(15,4) NOT NULL COMMENT '(-)',
  `Balance` decimal(15,4) NOT NULL,
  `Description` text NOT NULL,
  `TransactionId` varchar(30) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `isDelete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_history`
--

INSERT INTO `arm_history` (`HistoryId`, `MemberId`, `TypeId`, `Credit`, `Debit`, `Balance`, `Description`, `TransactionId`, `Status`, `DateAdded`, `isDelete`) VALUES
(1, 1, 1, '0.0000', '100.0000', '100.0000', 'testing', 'txt123', 1, '2016-02-18 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `arm_language`
--

CREATE TABLE IF NOT EXISTS `arm_language` (
  `LanguageId` int(11) NOT NULL,
  `LanguageCode` varchar(50) NOT NULL,
  `Status` tinyint(4) NOT NULL COMMENT '0-Deleted, 1-Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_layout`
--

CREATE TABLE IF NOT EXISTS `arm_layout` (
  `LayoutId` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `LayoutName` varchar(64) NOT NULL,
  `LayoutType` tinyint(1) NOT NULL,
  `Content` text NOT NULL,
  `LanguageId` int(11) NOT NULL,
  `LayoutStatus` tinyint(1) NOT NULL,
  `ViewCount` int(5) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_mailbox`
--

CREATE TABLE IF NOT EXISTS `arm_mailbox` (
  `MailId` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `SenderId` varchar(50) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `Status` tinyint(1) NOT NULL COMMENT '0-Deleted, 1-Active, 2-Read, 3-UnRead',
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_marketing`
--

CREATE TABLE IF NOT EXISTS `arm_marketing` (
  `AdsId` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `Content` text NOT NULL,
  `AdsType` enum('Image','Content','Video') NOT NULL,
  `DestinationUrl` varchar(255) NOT NULL,
  `Counts` int(5) NOT NULL,
  `TotalCounts` int(5) NOT NULL,
  `Status` enum('Deleted','Active','publish','UnPublish') NOT NULL,
  `Comment` text NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_members`
--

CREATE TABLE IF NOT EXISTS `arm_members` (
  `MemberId` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MiddleName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `MemberStatus` enum('Free','Active','Inactive','Suspend') NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Salt` varchar(100) NOT NULL,
  `Gender` enum('Male','Female','Others') NOT NULL,
  `BirthDate` datetime NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Fax` varchar(30) NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `SubscriptionsStatus` enum('Free','Active','Inactive','Suspend') NOT NULL,
  `DirectId` int(11) NOT NULL,
  `SpilloverId` int(11) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `EnrollerId` int(11) NOT NULL,
  `Ip` varchar(30) NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `DateAdded` datetime NOT NULL,
  `UserType` enum('1','2','3','4') NOT NULL DEFAULT '3',
  `isDelete` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_members`
--

INSERT INTO `arm_members` (`MemberId`, `FirstName`, `MiddleName`, `LastName`, `Email`, `UserName`, `MemberStatus`, `Password`, `Salt`, `Gender`, `BirthDate`, `Phone`, `Fax`, `StartDate`, `EndDate`, `SubscriptionsStatus`, `DirectId`, `SpilloverId`, `Address`, `City`, `State`, `Country`, `Zip`, `EnrollerId`, `Ip`, `ModifiedDate`, `DateAdded`, `UserType`, `isDelete`) VALUES
(1, 'arm', '', 'admin', 'admin@arm.com', 'admin', 'Active', '010438e6515e45aeaea0ac5303dbf9c2806eb0d0', '', 'Male', '0000-00-00 00:00:00', '213214343434', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0, 'ytuytu', 'Madurai', 'Tamil Nadu', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '0'),
(6, 'saravana1', '', 'kumar1', 'saravanan@arminfotech.org', 'saravanan', 'Inactive', '69c5fcebaa65b560eaf06c3fbeb481ae44b8d618', '', 'Male', '0000-00-00 00:00:00', '9898989897', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Free', 0, 0, '25, north street1', 'mumbai', '', '', '', 0, '', '0000-00-00 00:00:00', '2016-01-28 03:24:19', '3', '0'),
(7, 'admin', '', 'admin', 'admin1@arm.com', 'admin1', 'Inactive', '69c5fcebaa65b560eaf06c3fbeb481ae44b8d618', '', 'Male', '0000-00-00 00:00:00', '9494949494', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Free', 0, 0, '25, north street', 'mumbai', '', '', '', 0, '', '0000-00-00 00:00:00', '2016-02-02 08:54:31', '3', '0'),
(8, 'sdsds', '', 'sdsdsd', 'asasds@gma.com', 'sdsdsdsd', 'Free', '69c5fcebaa65b560eaf06c3fbeb481ae44b8d618', '', 'Male', '0000-00-00 00:00:00', '9898989898', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Free', 6, 0, '25, north street', 'ssdsdsdsdsd', '', '', '', 0, '', '0000-00-00 00:00:00', '2016-02-22 06:42:43', '3', '0');

-- --------------------------------------------------------

--
-- Table structure for table `arm_news`
--

CREATE TABLE IF NOT EXISTS `arm_news` (
  `NewsId` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `Type` tinyint(1) NOT NULL COMMENT '0-flash,1-others',
  `Subject` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `Comment` text NOT NULL,
  `Status` tinyint(1) NOT NULL COMMENT '0-Deleted, 1-Active, 2-publish,3-UnPublish',
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_order`
--

CREATE TABLE IF NOT EXISTS `arm_order` (
  `OrderId` int(11) NOT NULL,
  `OrderNumber` varchar(20) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Address1` varchar(100) NOT NULL,
  `Address2` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PaymentMethod` varchar(50) NOT NULL,
  `PaymentCode` varchar(50) NOT NULL,
  `CustomField` text NOT NULL,
  `ShipFirstName` varchar(50) NOT NULL,
  `ShipLastName` varchar(50) NOT NULL,
  `ShipEmail` varchar(100) NOT NULL,
  `ShipPhone` varchar(15) NOT NULL,
  `ShipAddress1` varchar(50) NOT NULL,
  `ShipAddress2` varchar(50) NOT NULL,
  `ShipCity` varchar(50) NOT NULL,
  `ShipState` varchar(50) NOT NULL,
  `ShipCountry` varchar(50) NOT NULL,
  `ShipZip` varchar(10) NOT NULL,
  `ShipMethod` varchar(50) NOT NULL,
  `ShipCode` varchar(50) NOT NULL,
  `ShipCustomField` text NOT NULL,
  `Comment` text NOT NULL,
  `OrderTotal` decimal(15,4) NOT NULL,
  `Discount` decimal(15,4) NOT NULL,
  `Commission` decimal(15,4) NOT NULL,
  `CouponId` int(11) NOT NULL,
  `Tracking` varchar(50) NOT NULL,
  `CurrencyId` int(11) NOT NULL,
  `CurrencyCode` varchar(10) NOT NULL,
  `Ip` varchar(50) NOT NULL,
  `Status` enum('pending','paid','unpaid','cancelled') NOT NULL,
  `DateAdded` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `isDelete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_order`
--

INSERT INTO `arm_order` (`OrderId`, `OrderNumber`, `MemberId`, `FirstName`, `LastName`, `Email`, `Phone`, `Address1`, `Address2`, `City`, `State`, `Country`, `Zip`, `PaymentMethod`, `PaymentCode`, `CustomField`, `ShipFirstName`, `ShipLastName`, `ShipEmail`, `ShipPhone`, `ShipAddress1`, `ShipAddress2`, `ShipCity`, `ShipState`, `ShipCountry`, `ShipZip`, `ShipMethod`, `ShipCode`, `ShipCustomField`, `Comment`, `OrderTotal`, `Discount`, `Commission`, `CouponId`, `Tracking`, `CurrencyId`, `CurrencyCode`, `Ip`, `Status`, `DateAdded`, `ModifiedDate`, `isDelete`) VALUES
(2, '651284090561', 6, 'saravana1', 'kumar1', 'saravanan@arminfotech.org', '9898989897', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'sdsd+sdsd+sdsd+sdsd', '1000.0000', '0.0000', '0.0000', 0, '', 0, '', '', 'cancelled', '2016-02-17 07:58:57', '2016-02-17 01:55:51', 0),
(3, '461054128705', 7, 'admin', 'admin', 'admin1@arm.com', '9494949494', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.0000', '0.0000', '0.0000', 0, '', 0, '', '', 'pending', '2016-02-18 10:58:29', '0000-00-00 00:00:00', 0),
(4, '159233275478', 7, 'admin', 'admin', 'admin1@arm.com', '9494949494', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'test+sdsdsdsds', '0.0000', '0.0000', '0.0000', 0, '', 0, '', '', 'cancelled', '2016-02-18 10:59:06', '2016-02-18 01:29:15', 0),
(5, 'OD0249367518', 6, 'saravana1', 'kumar1', 'saravanan@arminfotech.org', '9898989897', '25, north street1', '', 'mumbai', '', '', '', '', '', '', 'saravana1', 'kumar1', '', '9898989897', '25, north street1', '', 'mumbai', '', '', '', '', '', '', '', '0.0000', '0.0000', '0.0000', 0, '', 0, '', '', 'pending', '2016-02-18 01:39:41', '0000-00-00 00:00:00', 0),
(6, 'OD2490578631', 6, 'saravana1', 'kumar1', 'saravanan@arminfotech.org', '9898989897', '25, north street1', '', 'mumbai', '', '', '', '', '', '', 'saravana1', 'kumar1', '', '9898989897', '25, north street1', '', 'mumbai', '', '', '', '', '', '', '', '0.0000', '0.0000', '0.0000', 0, '', 0, '', '', 'pending', '2016-02-18 01:40:45', '0000-00-00 00:00:00', 0),
(7, 'OD4192650873', 6, 'saravana1', 'kumar1', 'saravanan@arminfotech.org', '9898989897', '25, north street1', '', 'mumbai', '', '', '', '', '', '', 'saravana1', 'kumar1', '', '9898989897', '25, north street1', '', 'mumbai', '', '', '', '', '', '', 'testinggggg+', '1100.0000', '0.0000', '0.0000', 0, '', 0, '', '', 'unpaid', '2016-02-18 01:43:35', '2016-02-18 02:30:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `arm_order_product`
--

CREATE TABLE IF NOT EXISTS `arm_order_product` (
  `Id` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `Quantity` int(3) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_order_product`
--

INSERT INTO `arm_order_product` (`Id`, `OrderId`, `ProductId`, `ProductName`, `Quantity`, `Price`, `Total`) VALUES
(1, 7, 1, 'iphone', 1, '1000.00', 1000),
(2, 7, 2, 'new test', 1, '100.00', 100);

-- --------------------------------------------------------

--
-- Table structure for table `arm_package`
--

CREATE TABLE IF NOT EXISTS `arm_package` (
  `PackageId` int(11) NOT NULL,
  `PackageName` varchar(50) NOT NULL,
  `PackageFee` decimal(10,2) NOT NULL,
  `RenewalStatus` tinyint(4) NOT NULL COMMENT '1-enable,0-disable',
  `RenewalFee` decimal(15,2) NOT NULL,
  `RenewalTerm` tinyint(4) NOT NULL COMMENT '1-yearly,2-Half yearly,3-monthly',
  `AutoDebitStatus` int(11) NOT NULL COMMENT '1-enable,0-disable',
  `AutoCreateOrderStatus` int(11) NOT NULL COMMENT '1-enable,0-disable',
  `RecurringStatus` tinyint(4) NOT NULL COMMENT '1-enable,0-disable',
  `RecurringFee` decimal(10,2) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `OwnCommission` decimal(10,2) NOT NULL,
  `MatrixCompletionCommission` decimal(10,2) NOT NULL,
  `LevelCompletedCommission` decimal(10,2) NOT NULL,
  `LevelCommissions` text NOT NULL,
  `ProductLevelCommissions` text NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Points` int(5) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_package`
--

INSERT INTO `arm_package` (`PackageId`, `PackageName`, `PackageFee`, `RenewalStatus`, `RenewalFee`, `RenewalTerm`, `AutoDebitStatus`, `AutoCreateOrderStatus`, `RecurringStatus`, `RecurringFee`, `ProductId`, `ProductName`, `OwnCommission`, `MatrixCompletionCommission`, `LevelCompletedCommission`, `LevelCommissions`, `ProductLevelCommissions`, `Image`, `Points`, `Status`, `DateAdded`, `ModifiedDate`) VALUES
(2, 'basic', '500.00', 1, '12.00', 1, 1, 1, 1, '10.00', 1, 'gold', '10.00', '12.00', '11.00', '12,1', '2,23', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'classic', '140.00', 1, '12.00', 1, 1, 0, 1, '2.00', 1, 'gold', '1.00', '2.00', '1.00', '2,1', '4,3', '', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'utlra', '222.00', 1, '11.00', 1, 1, 0, 1, '22.00', 1, 'gold', '1.00', '3.00', '2.00', '5,4,3,2', '9,8,7', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `arm_paymentsetting`
--

CREATE TABLE IF NOT EXISTS `arm_paymentsetting` (
  `PaymentId` int(11) NOT NULL,
  `PaymentName` varchar(100) NOT NULL,
  `PaymentMode` tinyint(4) NOT NULL COMMENT '1-live,0-test',
  `PaymentLogo` varchar(150) NOT NULL,
  `PaymentStatus` tinyint(4) NOT NULL COMMENT '1-enable,0-disable',
  `PaymentRecurring` tinyint(4) NOT NULL COMMENT '1-on,0-off',
  `PaymentMerchantId` varchar(100) NOT NULL,
  `PaymentMerchantPassword` varchar(100) NOT NULL,
  `PaymentMerchantKey` varchar(100) NOT NULL,
  `PaymentMerchantApi` varchar(100) NOT NULL,
  `PaymentField1` varchar(100) NOT NULL,
  `PaymentField2` varchar(100) NOT NULL,
  `PaymentField3` varchar(100) NOT NULL,
  `Position` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_paymentsetting`
--

INSERT INTO `arm_paymentsetting` (`PaymentId`, `PaymentName`, `PaymentMode`, `PaymentLogo`, `PaymentStatus`, `PaymentRecurring`, `PaymentMerchantId`, `PaymentMerchantPassword`, `PaymentMerchantKey`, `PaymentMerchantApi`, `PaymentField1`, `PaymentField2`, `PaymentField3`, `Position`) VALUES
(1, 'bankwire', 0, 'bankwire.jpg', 1, 1, '0', '123456', '121323', '123', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `arm_point`
--

CREATE TABLE IF NOT EXISTS `arm_point` (
  `PointId` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `TransactionId` varchar(15) NOT NULL,
  `Type` tinyint(4) NOT NULL,
  `Debit` decimal(10,0) NOT NULL,
  `Credit` decimal(10,0) NOT NULL,
  `Balance` decimal(10,0) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_product`
--

CREATE TABLE IF NOT EXISTS `arm_product` (
  `ProductId` int(11) NOT NULL,
  `CatId` int(11) NOT NULL,
  `ProductType` int(2) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Quantity` int(4) NOT NULL,
  `StockStatusId` int(4) NOT NULL,
  `Image` text NOT NULL,
  `Price` decimal(15,4) NOT NULL,
  `TaxClassId` int(11) NOT NULL,
  `Weight` decimal(15,4) NOT NULL,
  `Height` decimal(15,4) NOT NULL,
  `Length` decimal(15,4) NOT NULL,
  `DisplyShop` tinyint(1) NOT NULL DEFAULT '1',
  `AutoShip` tinyint(1) NOT NULL DEFAULT '0',
  `iSentrole` tinyint(1) NOT NULL DEFAULT '0',
  `Viewed` int(5) NOT NULL,
  `Attributes` text NOT NULL,
  `WeightClassId` int(11) NOT NULL,
  `LengthClassId` int(11) NOT NULL,
  `Type` tinyint(1) NOT NULL,
  `Shipping` int(4) NOT NULL,
  `Points` int(5) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `isDelete` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_product`
--

INSERT INTO `arm_product` (`ProductId`, `CatId`, `ProductType`, `ProductName`, `Description`, `Quantity`, `StockStatusId`, `Image`, `Price`, `TaxClassId`, `Weight`, `Height`, `Length`, `DisplyShop`, `AutoShip`, `iSentrole`, `Viewed`, `Attributes`, `WeightClassId`, `LengthClassId`, `Type`, `Shipping`, `Points`, `Status`, `DateAdded`, `ModifiedDate`, `isDelete`) VALUES
(1, 5, 1, 'iphone', '', 10, 1, '', '1000.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, '2016-02-02 07:22:32', '0000-00-00 00:00:00', '0'),
(2, 0, 0, 'new test', 'new testing', 50, 1, '', '100.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, '2016-02-06 12:41:00', '2016-02-17 02:40:04', '0'),
(4, 3, 1, 'asdsdsdsd', '', 100, 1, 'f90379b0c1c418819452a8c52a259409.jpg', '100.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, '2016-02-06 01:31:29', '0000-00-00 00:00:00', '0'),
(5, 0, 0, 'sdsdsd', 'sdsdsdsds sdsd', 12, 1, '', '1500.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, '2016-02-09 06:14:26', '2016-02-09 06:28:09', '0'),
(6, 0, 0, 'sdsdsd', 'sdsdsdsd', 11, 1, '', '1212.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, '2016-02-09 06:52:14', '2016-02-09 07:20:01', '0'),
(7, 0, 0, 'logoasasa', 'logo design', 10, 1, '', '150.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, '2016-02-09 02:08:46', '2016-02-17 03:27:25', '0'),
(8, 6, 2, 'testing', 'testing product', 15, 1, 'bef000529e8fabf439588badf987d3bb.jpg', '150.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, '2016-02-09 02:17:35', '0000-00-00 00:00:00', '0'),
(9, 2, 2, 'testing producteee', 'eeeee', 15, 1, 'b1d0d81f3c169aa52566cc3f7ad8414b.jpg', '450.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, '2016-02-09 02:19:42', '0000-00-00 00:00:00', '0'),
(10, 0, 0, 'logoasasa', 'logo design', 10, 1, '0f1cc9e6da1215eaa4624818446d6a04.jpg', '150.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 1, '2016-02-17 10:30:44', '0000-00-00 00:00:00', '0'),
(11, 1, 0, 'iphone', 'testing iphone', 100, 0, '', '6000.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '{"weight":"200","length":"5","pixel":"320 X 280"}', 0, 0, 0, 0, 0, 1, '2016-02-19 04:54:14', '2016-02-22 06:21:12', '0'),
(12, 0, 0, 'sdsds', '<p><br></p><table class="table table-bordered"><tbody><tr><td>sdsdsd<br></td><td>sdsdsd<br></td></tr><tr><td>sdsds<br></td><td>sdsdsd<br></td></tr><tr><td>sdsdsd<br></td><td>sdsdsd<br></td></tr></tbody></table><p>sdsdssd sssd</p><p>sdsd</p><p>sd</p><p><br></p><p>sdsd<br></p>', 100, 0, '', '2323.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '{"":""}', 0, 0, 0, 0, 0, 1, '2016-02-19 07:39:44', '2016-02-19 10:31:04', '0'),
(13, 2, 1, 'sdsds', '&lt;p&gt;asdsdsdsdsd s&lt;/p&gt;&lt;table class=&quot;table table-bordered&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;sdsd&lt;br&gt;&lt;/td&gt;&lt;td&gt;sdsd&lt;br&gt;&lt;/td&gt;&lt;td&gt;sdsd&lt;br&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;sdsd&lt;br&gt;&lt;/td&gt;&lt;td&gt;sdsd&lt;br&gt;&lt;/td&gt;&lt;td&gt;sdsd&lt;br&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;span xss=removed&gt;sdsdsd&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 100, 0, '8a6863f7141f2d03e6e234be52a93475.jpg', '120.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '{"":""}', 0, 0, 0, 0, 0, 1, '2016-02-19 09:17:30', '0000-00-00 00:00:00', '0'),
(14, 4, 1, 'brand', '&lt;p&gt;asdsds sdsds sdsd&lt;/p&gt;&lt;p&gt;sdsdsds&lt;/p&gt;&lt;p&gt;sdsd&lt;br&gt;&lt;/p&gt;', 100, 1, '0e6445ef4ee25134e2880a38769d1cd6.png,a86437e28f2fd34b310a5729e3dbf0e8.png,40430af7c75fb4621bd0059e75152c7d.png', '500.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '{"":""}', 0, 0, 0, 0, 0, 1, '2016-02-19 10:32:35', '0000-00-00 00:00:00', '0'),
(15, 4, 1, 'tester', 'tetet eetet ete ete&lt;br&gt;', 100, 1, '3ee7c039c9fe92f963d316671103db99.png,baf3893d66f0c535328be525aca9b1f1.png', '500.0000', 0, '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, '{"":""}', 0, 0, 0, 0, 0, 1, '2016-02-19 10:35:13', '0000-00-00 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `arm_productimage`
--

CREATE TABLE IF NOT EXISTS `arm_productimage` (
  `ImageId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `productImage` varchar(250) NOT NULL,
  `SortOrder` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_productimage`
--

INSERT INTO `arm_productimage` (`ImageId`, `ProductId`, `productImage`, `SortOrder`) VALUES
(1, 7, 'f160f43f3108c6ac0ad42c46b741712d.png', 0),
(2, 7, 'cf8f057b443a73dccf29a6cf4231ad7b.png', 0),
(3, 7, '02ce90e3b0a78c87f9cc948b6479dfb7.png', 0),
(4, 8, 'bef000529e8fabf439588badf987d3bb.jpg', 0),
(5, 8, '3af55c47a0dc08cc8c3a72924523c2d7.jpg', 0),
(6, 9, 'b1d0d81f3c169aa52566cc3f7ad8414b.jpg', 0),
(7, 9, 'c753fbe346f0b054cd44102ac96ab96c.jpg', 0),
(8, 10, '0f1cc9e6da1215eaa4624818446d6a04.jpg', 0),
(9, 7, 'b8778cd635a03aafaad77677fe24f534.jpg', 0),
(10, 11, '45fd1f7654e976f121e124ad4a95339d.jpg', 0),
(11, 12, '11135df9a356aba660a8ef747be6db34.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `arm_product_desc`
--

CREATE TABLE IF NOT EXISTS `arm_product_desc` (
  `id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_product_desc`
--

INSERT INTO `arm_product_desc` (`id`, `ProductId`, `Description`) VALUES
(1, 2, 'testing product'),
(2, 3, 'etetetet'),
(3, 4, 'sdddddddddddddddsdsd');

-- --------------------------------------------------------

--
-- Table structure for table `arm_requestepin`
--

CREATE TABLE IF NOT EXISTS `arm_requestepin` (
  `RequestId` int(11) NOT NULL,
  `PackageId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL COMMENT 'Which user can allocated this epin ',
  `PayThrough` varchar(100) NOT NULL,
  `PaymentAmount` decimal(10,2) NOT NULL,
  `EpinCount` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-request, 1- allocate, 2-cancel',
  `DateAdded` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_requestepin`
--

INSERT INTO `arm_requestepin` (`RequestId`, `PackageId`, `UserId`, `PayThrough`, `PaymentAmount`, `EpinCount`, `Status`, `DateAdded`, `ModifiedDate`) VALUES
(40, 2, 1, 'bankwire', '1000.00', 3, 0, '2016-02-18 07:16:33', '2016-02-13 12:40:39'),
(41, 4, 2, 'cheque', '420.00', 5, 0, '2016-02-09 10:13:22', '2016-02-13 11:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `arm_requirefields`
--

CREATE TABLE IF NOT EXISTS `arm_requirefields` (
  `RequireId` int(11) NOT NULL,
  `ReuireFieldName` varchar(100) NOT NULL,
  `ReuireFieldStatus` int(2) NOT NULL,
  `FieldEnableStatus` int(2) NOT NULL,
  `FieldPosition` int(11) NOT NULL,
  `Page` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_requirefields`
--

INSERT INTO `arm_requirefields` (`RequireId`, `ReuireFieldName`, `ReuireFieldStatus`, `FieldEnableStatus`, `FieldPosition`, `Page`) VALUES
(1, 'MemberId', 1, 0, 1, 'register'),
(2, 'FirstName', 0, 1, 2, 'register'),
(3, 'MiddleName', 1, 0, 5, 'register'),
(5, '', 0, 0, 0, 'register'),
(6, 'Email', 0, 1, 4, 'register'),
(7, 'Address', 1, 1, 0, 'register'),
(8, 'Gender', 1, 1, 5, 'register');

-- --------------------------------------------------------

--
-- Table structure for table `arm_setting`
--

CREATE TABLE IF NOT EXISTS `arm_setting` (
  `SettingId` int(11) NOT NULL,
  `StoreId` int(11) NOT NULL,
  `StoreCode` varchar(32) NOT NULL,
  `Page` varchar(50) NOT NULL,
  `KeyValue` varchar(50) NOT NULL,
  `ContentValue` text NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_setting`
--

INSERT INTO `arm_setting` (`SettingId`, `StoreId`, `StoreCode`, `Page`, `KeyValue`, `ContentValue`, `DateAdded`) VALUES
(111, 1, '', 'sitesetting', 'sitename', 'ARMCIP', '2016-02-03 12:22:53'),
(112, 1, '', 'sitesetting', 'siteurl', 'http://192.168.2.13/saravanan/armcip', '2016-02-03 12:22:53'),
(113, 1, '', 'sitesetting', 'adminmailid', 'admin@gmail.com', '2016-02-03 12:22:53'),
(114, 1, '', 'sitesetting', 'sitemetatitle', 'ARMCIP', '2016-02-03 12:22:53'),
(115, 1, '', 'sitesetting', 'sitemetakeyword', 'testin testing, AMCIP', '2016-02-03 12:22:53'),
(116, 1, '', 'sitesetting', 'sitemetadescription', 'testing tesing', '2016-02-03 12:22:53'),
(117, 1, '', 'sitesetting', 'sitestatus', 'on', '2016-02-03 12:22:53'),
(118, 1, '', 'sitesetting', 'sitegooglecode', 'tetet', '2016-02-03 12:22:53'),
(119, 1, '', 'sitesetting', 'sitelogo', 'uploads/admin/site/sitelogo.jpg', '2016-02-03 12:22:53'),
(125, 3, '', 'smtpsetting', 'smtpstatus', '0', '2016-02-04 11:08:28'),
(126, 3, '', 'smtpsetting', 'smtpmail', 'sdsds@gmai.com', '2016-02-04 11:08:29'),
(127, 3, '', 'smtpsetting', 'smtppassword', '1255454sdfsd', '2016-02-04 11:08:30'),
(128, 3, '', 'smtpsetting', 'smtpport', '9898', '2016-02-04 11:08:31'),
(129, 3, '', 'smtpsetting', 'smtphost', 'http://www.sdsddsdssd.com', '2016-02-04 11:08:31'),
(157, 0, '', 'easypost', 'api_id', 'asdsdsdsd', '2016-02-22 13:51:02'),
(158, 0, '', 'easypost', 'company', 'armcip', '2016-02-22 13:51:02'),
(159, 0, '', 'easypost', 'address', '153, North street,', '2016-02-22 13:51:02'),
(160, 0, '', 'easypost', 'city', 'madurai', '2016-02-22 13:51:03'),
(161, 0, '', 'easypost', 'zip_code', '10011', '2016-02-22 13:51:03'),
(162, 0, '', 'easypost', 'easypost_status', '1', '2016-02-22 13:51:03'),
(163, 0, '', 'easypost', 'shipping_size', 'LARGE', '2016-02-22 13:51:03'),
(164, 0, '', 'easypost', 'shipping_container', 'NONRECTANGULAR', '2016-02-22 13:51:03'),
(165, 0, '', 'easypost', 'shipping_length', '10', '2016-02-22 13:51:03'),
(166, 0, '', 'easypost', 'shipping_width', '50', '2016-02-22 13:51:03'),
(167, 0, '', 'easypost', 'shipping_height', '45', '2016-02-22 13:51:03'),
(168, 0, '', 'easypost', 'shipping_weight', 'gram', '2016-02-22 13:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `arm_shipping`
--

CREATE TABLE IF NOT EXISTS `arm_shipping` (
  `ShippingId` int(11) NOT NULL,
  `Country` varchar(5) NOT NULL,
  `MinValue` decimal(10,2) NOT NULL,
  `MaxValue` decimal(10,2) NOT NULL,
  `Rates` decimal(10,2) NOT NULL,
  `FastDelivery` float(5,2) NOT NULL,
  `Status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_subcategory`
--

CREATE TABLE IF NOT EXISTS `arm_subcategory` (
  `SubCatId` int(11) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `SubCategory` varchar(30) NOT NULL,
  `Descriptions` text NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `Attributes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_testimonial`
--

CREATE TABLE IF NOT EXISTS `arm_testimonial` (
  `MonialId` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `Type` tinyint(4) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `Comment` text NOT NULL,
  `Status` tinyint(1) NOT NULL COMMENT '0-Deleted, 1-Active, 2-publish,3-UnPublish',
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arm_ticket`
--

CREATE TABLE IF NOT EXISTS `arm_ticket` (
  `TicketId` int(11) NOT NULL,
  `TransactionId` varchar(16) NOT NULL,
  `Subject` varchar(150) NOT NULL,
  `Priority` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT '1=low, 2=medium, 3=high, 4=very high',
  `Status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0=closed, 1=open, 2=reopen',
  `DateAdded` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `isDelete` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0=undelete, 1=delete'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_ticket`
--

INSERT INTO `arm_ticket` (`TicketId`, `TransactionId`, `Subject`, `Priority`, `Status`, `DateAdded`, `ModifiedDate`, `isDelete`) VALUES
(10, 'TIC1614562', 'testin testing', '2', '1', '2016-02-24 05:53:52', '2016-02-24 05:53:52', '0'),
(11, 'TIC1714562', 'new testing', '', '2', '2016-02-24 07:53:47', '0000-00-00 00:00:00', '0'),
(12, 'TIC1614563', 'asdsdsdsdsdsdsdsd', '2', '1', '2016-02-24 02:14:53', '0000-00-00 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `arm_ticket_list`
--

CREATE TABLE IF NOT EXISTS `arm_ticket_list` (
  `id` int(11) NOT NULL,
  `TicketId` int(11) NOT NULL,
  `SenderId` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Attatchement` text NOT NULL,
  `DateAdded` datetime NOT NULL,
  `isDelete` enum('0','1') NOT NULL COMMENT '1=deleted'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_ticket_list`
--

INSERT INTO `arm_ticket_list` (`id`, `TicketId`, `SenderId`, `MemberId`, `Description`, `Attatchement`, `DateAdded`, `isDelete`) VALUES
(1, 10, 1, 6, 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id\r\n                                    quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus\r\n                                    legentis in iis qui facit eorum claritatem.', '', '2016-02-24 05:53:52', '0'),
(2, 10, 6, 1, 'Investigationes demonstraverunt lectores\r\n                                    legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui\r\n                                    sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica,\r\n                                    quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per\r\n                                    seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur\r\n                                    parum clari, fiant sollemnes in futurum.', '', '2016-02-24 06:44:16', '0'),
(3, 10, 1, 6, '<span xss=removed>quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</span>', '', '2016-02-24 07:38:46', '0'),
(4, 10, 6, 1, 'Typi non habent claritatem insitam; est usus\r\n                                    legentis in iis qui facit eorum claritatem.', '', '2016-02-24 07:40:04', '0'),
(5, 10, 6, 1, '\n\n                            <div class="message-body">\n                                Typi non habent claritatem insitam; est usus\n                                    legentis in iis qui facit eorum claritatem.                            </div>', '', '2016-02-24 07:41:01', '0'),
(6, 11, 1, 7, 'Claritas est etiam processus dynamicus, qui\r\n                                    sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica,\r\n                                    quam nunc putamus parum claram.', '', '2016-02-24 07:53:48', '0'),
(7, 11, 1, 7, 'dynamicus, qui\r\n                                    sequitur mutationem consuetudium lectorum', '31a35ed659a958b1b090e56b6e730765.txt', '2016-02-24 11:43:41', '0'),
(8, 11, 1, 7, 'asdsdsd sdsds sdsds<br>', 'd32b3e5537cf9f58f7343420ba6b17cb.png', '2016-02-24 11:46:13', '0'),
(9, 12, 1, 6, '<p><br></p><table class="table table-bordered"><tbody><tr><td>asdsdssdsd<br></td><td>asdsds<br></td><td>sdsdsd<br></td><td>sdsd<br></td></tr><tr><td>343</td><td>5656<br></td><td>6767<br></td><td>8989<br></td></tr></tbody></table><p>a dfdf dfdf dfdf<br></p>', '', '2016-02-24 02:14:53', '0');

-- --------------------------------------------------------

--
-- Table structure for table `arm_transaction_type`
--

CREATE TABLE IF NOT EXISTS `arm_transaction_type` (
  `TypeId` int(11) NOT NULL,
  `TransactionName` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arm_transaction_type`
--

INSERT INTO `arm_transaction_type` (`TypeId`, `TransactionName`) VALUES
(1, 'Register'),
(2, 'Subscription'),
(3, 'Upgrade'),
(4, 'Commissions'),
(5, 'Bonus'),
(6, 'Penalty'),
(7, 'Withdrawlpending'),
(8, 'Withdrawal'),
(9, 'Deposit'),
(10, 'Admin Fees'),
(11, 'Admin Earnings'),
(12, 'Purchase'),
(13, 'Epin Purchase'),
(14, 'Product Purchase'),
(15, 'Fund Received'),
(16, 'Fund Send'),
(17, 'Wallet Transfer'),
(18, 'Wallet Received'),
(19, 'Transaction Report');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `cookiee` text NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `logged_in` varchar(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `MemberId`, `cookiee`, `full_name`, `logged_in`) VALUES
(1, 1, '6c5de1b510e8bdd0bc40eff99dcd03f8', 'arm admin', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arm_banned`
--
ALTER TABLE `arm_banned`
  ADD PRIMARY KEY (`BannedId`);

--
-- Indexes for table `arm_category`
--
ALTER TABLE `arm_category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `parentId` (`ParentId`);

--
-- Indexes for table `arm_country`
--
ALTER TABLE `arm_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `arm_coupon`
--
ALTER TABLE `arm_coupon`
  ADD PRIMARY KEY (`CouponId`);

--
-- Indexes for table `arm_coupon_category`
--
ALTER TABLE `arm_coupon_category`
  ADD PRIMARY KEY (`CouponCategoryId`);

--
-- Indexes for table `arm_coupon_history`
--
ALTER TABLE `arm_coupon_history`
  ADD PRIMARY KEY (`HistoryId`);

--
-- Indexes for table `arm_coupon_product`
--
ALTER TABLE `arm_coupon_product`
  ADD PRIMARY KEY (`CouponProductId`);

--
-- Indexes for table `arm_currency`
--
ALTER TABLE `arm_currency`
  ADD PRIMARY KEY (`CurrencyId`);

--
-- Indexes for table `arm_customfields`
--
ALTER TABLE `arm_customfields`
  ADD PRIMARY KEY (`CustomFieldId`);

--
-- Indexes for table `arm_discount`
--
ALTER TABLE `arm_discount`
  ADD PRIMARY KEY (`CouponId`);

--
-- Indexes for table `arm_epin`
--
ALTER TABLE `arm_epin`
  ADD PRIMARY KEY (`EpinRecordId`);

--
-- Indexes for table `arm_ewallet`
--
ALTER TABLE `arm_ewallet`
  ADD PRIMARY KEY (`EwalletId`);

--
-- Indexes for table `arm_forcedmatrix`
--
ALTER TABLE `arm_forcedmatrix`
  ADD PRIMARY KEY (`ForcedMatrixId`);

--
-- Indexes for table `arm_history`
--
ALTER TABLE `arm_history`
  ADD PRIMARY KEY (`HistoryId`);

--
-- Indexes for table `arm_language`
--
ALTER TABLE `arm_language`
  ADD PRIMARY KEY (`LanguageId`);

--
-- Indexes for table `arm_layout`
--
ALTER TABLE `arm_layout`
  ADD PRIMARY KEY (`LayoutId`);

--
-- Indexes for table `arm_mailbox`
--
ALTER TABLE `arm_mailbox`
  ADD PRIMARY KEY (`MailId`);

--
-- Indexes for table `arm_marketing`
--
ALTER TABLE `arm_marketing`
  ADD PRIMARY KEY (`AdsId`);

--
-- Indexes for table `arm_members`
--
ALTER TABLE `arm_members`
  ADD PRIMARY KEY (`MemberId`),
  ADD KEY `City` (`City`);

--
-- Indexes for table `arm_news`
--
ALTER TABLE `arm_news`
  ADD PRIMARY KEY (`NewsId`);

--
-- Indexes for table `arm_order`
--
ALTER TABLE `arm_order`
  ADD PRIMARY KEY (`OrderId`);

--
-- Indexes for table `arm_order_product`
--
ALTER TABLE `arm_order_product`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `arm_package`
--
ALTER TABLE `arm_package`
  ADD PRIMARY KEY (`PackageId`);

--
-- Indexes for table `arm_paymentsetting`
--
ALTER TABLE `arm_paymentsetting`
  ADD PRIMARY KEY (`PaymentId`);

--
-- Indexes for table `arm_point`
--
ALTER TABLE `arm_point`
  ADD PRIMARY KEY (`PointId`);

--
-- Indexes for table `arm_product`
--
ALTER TABLE `arm_product`
  ADD PRIMARY KEY (`ProductId`);

--
-- Indexes for table `arm_productimage`
--
ALTER TABLE `arm_productimage`
  ADD PRIMARY KEY (`ImageId`);

--
-- Indexes for table `arm_product_desc`
--
ALTER TABLE `arm_product_desc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arm_requestepin`
--
ALTER TABLE `arm_requestepin`
  ADD PRIMARY KEY (`RequestId`);

--
-- Indexes for table `arm_requirefields`
--
ALTER TABLE `arm_requirefields`
  ADD PRIMARY KEY (`RequireId`);

--
-- Indexes for table `arm_setting`
--
ALTER TABLE `arm_setting`
  ADD PRIMARY KEY (`SettingId`);

--
-- Indexes for table `arm_shipping`
--
ALTER TABLE `arm_shipping`
  ADD PRIMARY KEY (`ShippingId`);

--
-- Indexes for table `arm_subcategory`
--
ALTER TABLE `arm_subcategory`
  ADD PRIMARY KEY (`SubCatId`);

--
-- Indexes for table `arm_ticket`
--
ALTER TABLE `arm_ticket`
  ADD PRIMARY KEY (`TicketId`);

--
-- Indexes for table `arm_ticket_list`
--
ALTER TABLE `arm_ticket_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arm_transaction_type`
--
ALTER TABLE `arm_transaction_type`
  ADD PRIMARY KEY (`TypeId`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arm_banned`
--
ALTER TABLE `arm_banned`
  MODIFY `BannedId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `arm_category`
--
ALTER TABLE `arm_category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `arm_country`
--
ALTER TABLE `arm_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=258;
--
-- AUTO_INCREMENT for table `arm_coupon`
--
ALTER TABLE `arm_coupon`
  MODIFY `CouponId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `arm_coupon_category`
--
ALTER TABLE `arm_coupon_category`
  MODIFY `CouponCategoryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `arm_coupon_history`
--
ALTER TABLE `arm_coupon_history`
  MODIFY `HistoryId` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_coupon_product`
--
ALTER TABLE `arm_coupon_product`
  MODIFY `CouponProductId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `arm_currency`
--
ALTER TABLE `arm_currency`
  MODIFY `CurrencyId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_customfields`
--
ALTER TABLE `arm_customfields`
  MODIFY `CustomFieldId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `arm_discount`
--
ALTER TABLE `arm_discount`
  MODIFY `CouponId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_epin`
--
ALTER TABLE `arm_epin`
  MODIFY `EpinRecordId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `arm_ewallet`
--
ALTER TABLE `arm_ewallet`
  MODIFY `EwalletId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_forcedmatrix`
--
ALTER TABLE `arm_forcedmatrix`
  MODIFY `ForcedMatrixId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_history`
--
ALTER TABLE `arm_history`
  MODIFY `HistoryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `arm_language`
--
ALTER TABLE `arm_language`
  MODIFY `LanguageId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_layout`
--
ALTER TABLE `arm_layout`
  MODIFY `LayoutId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_mailbox`
--
ALTER TABLE `arm_mailbox`
  MODIFY `MailId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_marketing`
--
ALTER TABLE `arm_marketing`
  MODIFY `AdsId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_members`
--
ALTER TABLE `arm_members`
  MODIFY `MemberId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `arm_news`
--
ALTER TABLE `arm_news`
  MODIFY `NewsId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_order`
--
ALTER TABLE `arm_order`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `arm_order_product`
--
ALTER TABLE `arm_order_product`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `arm_package`
--
ALTER TABLE `arm_package`
  MODIFY `PackageId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `arm_paymentsetting`
--
ALTER TABLE `arm_paymentsetting`
  MODIFY `PaymentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `arm_point`
--
ALTER TABLE `arm_point`
  MODIFY `PointId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_product`
--
ALTER TABLE `arm_product`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `arm_productimage`
--
ALTER TABLE `arm_productimage`
  MODIFY `ImageId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `arm_product_desc`
--
ALTER TABLE `arm_product_desc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `arm_requestepin`
--
ALTER TABLE `arm_requestepin`
  MODIFY `RequestId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `arm_requirefields`
--
ALTER TABLE `arm_requirefields`
  MODIFY `RequireId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `arm_setting`
--
ALTER TABLE `arm_setting`
  MODIFY `SettingId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `arm_shipping`
--
ALTER TABLE `arm_shipping`
  MODIFY `ShippingId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_subcategory`
--
ALTER TABLE `arm_subcategory`
  MODIFY `SubCatId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `arm_ticket`
--
ALTER TABLE `arm_ticket`
  MODIFY `TicketId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `arm_ticket_list`
--
ALTER TABLE `arm_ticket_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `arm_transaction_type`
--
ALTER TABLE `arm_transaction_type`
  MODIFY `TypeId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
