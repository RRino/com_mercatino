
--
-- Table structure for table `#__mymercatos`
--

CREATE TABLE IF NOT EXISTS `#__mymercatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `costo` decimal(10,0) NOT NULL,
  `marca` varchar(64) DEFAULT NULL,
  `telefono` varchar(64) DEFAULT NULL,
  `tipo` varchar(64) DEFAULT NULL,
  `tuaemail` varchar(64) DEFAULT NULL,
  `nome` varchar(64) DEFAULT NULL,
  `picture` varchar(128) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `alt` varchar(64) DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

--
-- Dumping data for table `#__mymercatos`
--

INSERT IGNORE INTO `#__mymercatos` (`id`, `title`, `description`, `costo`, `marca`,`telefono`, `tipo`, `tuaemail`, `nome`, `picture`, `width`, `height`, `alt`) VALUES
(1, 'City Centre', 'Highligts of Anycity', '5', 'Salewa', '12345','1', '0', '0', NULL, NULL, NULL,''),
(2, 'Woods', 'Woodland mercato on hard paths', '4', '0', '12345', '0', '1', '1', NULL, NULL, NULL,''),
(3, 'Tuaemail', 'Hill mercato with good views on established path.', '6', '0', '12345', '0', '3', '2', NULL, NULL, NULL,''),
(4, 'Lake Thingy', 'Mercato around the lake on an accessible path.', '2', '1', '12345', '1', '0', '0', NULL, NULL, NULL,''),
(5, 'Castle Railway Track', 'Mercato along the line of the old railway track from start point car park to Thing castle', '2', '12345',' 1', '1', '0', '0', NULL, NULL, NULL,'');

-- --------------------------------------------------------

--
-- Table structure for table `#__mymercato_dates`
--

CREATE TABLE IF NOT EXISTS `#__mymercato_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `mercato_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `weather` varchar(256) DEFAULT NULL,
  `state` TINYINT NOT NULL DEFAULT '1',
  KEY `idx_mercato` (`mercato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

--
-- Dumping data for table `#__mymercato_dates`
--

INSERT IGNORE INTO `#__mymercato_dates` (`id`, `mercato_id`, `date`, `weather`) VALUES
(1, 1, '2019-05-12', 'Dry and Sunny'),
(2, 2, '2019-06-09', 'Wet and Windy'),
(3, 3, '2019-01-01', 'Cold and wet'),
(4, 4, '2019-01-20', 'Bright but frosty'),
(5, 5, '2019-04-28', 'Dry and warm'),
(6, 1, '2019-05-12', 'Wet and windy'),
(7, 3, '2019-06-09', 'Hot and dry'),
(8, 5, '2019-07-21', 'Overcast but warm and humid');
