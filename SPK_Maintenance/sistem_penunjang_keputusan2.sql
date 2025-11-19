-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2025 at 07:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_penunjang_keputusan2`
--

-- --------------------------------------------------------

--
-- Table structure for table `classification`
--

CREATE TABLE `classification` (
  `id_classification` int(11) NOT NULL,
  `classification_name` varchar(50) NOT NULL,
  `classification_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classification`
--

INSERT INTO `classification` (`id_classification`, `classification_name`, `classification_point`) VALUES
(1, 'BM', 5),
(2, 'PdM', 4),
(3, 'Rotating work', 4),
(4, 'Static work', 2),
(5, 'NDT', 3),
(6, 'Certification work', 3),
(7, 'VI', 1),
(8, 'z', 0);

-- --------------------------------------------------------

--
-- Table structure for table `compute_history`
--

CREATE TABLE `compute_history` (
  `id_history` int(11) NOT NULL,
  `computed_by` varchar(100) DEFAULT NULL,
  `computed_at` datetime DEFAULT current_timestamp(),
  `filters` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compute_history`
--

INSERT INTO `compute_history` (`id_history`, `computed_by`, `computed_at`, `filters`) VALUES
(1, 'admin', '2025-11-19 10:53:20', '{\"id_inspection_period\":2}'),
(2, 'admin', '2025-11-19 10:56:22', '{\"id_inspection_period\":1}'),
(3, 'admin', '2025-11-19 11:07:49', '{\"id_classification\":3}');

-- --------------------------------------------------------

--
-- Table structure for table `compute_results`
--

CREATE TABLE `compute_results` (
  `id_result` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `id_equipment` int(11) NOT NULL,
  `score` float NOT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compute_results`
--

INSERT INTO `compute_results` (`id_result`, `history_id`, `id_equipment`, `score`, `details`) VALUES
(1, 1, 4, 0.34375, '{\"raw\":{\"1\":1,\"2\":2,\"3\":1,\"4\":4}}'),
(2, 1, 12, 0, '{\"raw\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0}}'),
(3, 1, 15, 0, '{\"raw\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0}}'),
(4, 1, 20, 0.75, '{\"raw\":{\"1\":2,\"2\":4,\"3\":3,\"4\":4}}'),
(5, 2, 3, 0.75, '{\"raw\":{\"1\":2,\"2\":4,\"3\":2,\"4\":5}}'),
(6, 2, 10, 0, '{\"raw\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0}}'),
(7, 2, 11, 0, '{\"raw\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0}}'),
(8, 2, 13, 0, '{\"raw\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0}}'),
(9, 2, 14, 0, '{\"raw\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0}}'),
(10, 2, 16, 0, '{\"raw\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0}}'),
(11, 2, 17, 0, '{\"raw\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0}}'),
(12, 2, 18, 0, '{\"raw\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0}}'),
(13, 2, 19, 0, '{\"raw\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0}}'),
(14, 3, 11, 0.803125, '{\"raw\":{\"1\":4,\"2\":3,\"3\":3,\"4\":5}}'),
(15, 3, 12, 0.853125, '{\"raw\":{\"1\":4,\"2\":3,\"3\":3,\"4\":4}}'),
(16, 3, 14, 0.853125, '{\"raw\":{\"1\":4,\"2\":4,\"3\":3,\"4\":5}}'),
(17, 3, 15, 0.903125, '{\"raw\":{\"1\":4,\"2\":4,\"3\":3,\"4\":4}}'),
(18, 3, 16, 0.853125, '{\"raw\":{\"1\":4,\"2\":4,\"3\":3,\"4\":5}}'),
(19, 3, 19, 0.95, '{\"raw\":{\"1\":4,\"2\":5,\"3\":4,\"4\":5}}');

-- --------------------------------------------------------

--
-- Table structure for table `criteria_weight`
--

CREATE TABLE `criteria_weight` (
  `id_criteria` int(11) NOT NULL,
  `criteria_name` varchar(50) NOT NULL,
  `weight` float NOT NULL,
  `type` enum('benefit','cost') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criteria_weight`
--

INSERT INTO `criteria_weight` (`id_criteria`, `criteria_name`, `weight`, `type`) VALUES
(1, 'Classification', 0.3125, 'benefit'),
(2, 'Equipment Class', 0.25, 'benefit'),
(3, 'Grade', 0.1875, 'benefit'),
(4, 'Inspection Period', 0.25, 'cost');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id_equipment` int(11) NOT NULL,
  `equipment_name` varchar(100) NOT NULL,
  `id_equipment_class` int(11) NOT NULL,
  `id_grade` int(11) NOT NULL,
  `id_plant` int(11) NOT NULL,
  `id_classification` int(11) NOT NULL,
  `id_inspection_period` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id_equipment`, `equipment_name`, `id_equipment_class`, `id_grade`, `id_plant`, `id_classification`, `id_inspection_period`) VALUES
(3, 'agitator', 2, 9, 1, 4, 1),
(4, 'agitator 3', 4, 10, 1, 7, 2),
(10, 'Pompa Air Utama', 1, 7, 1, 1, 1),
(11, 'F-1725 Agitator', 3, 8, 1, 3, 1),
(12, 'F-1725 Agitator', 3, 8, 1, 3, 2),
(13, 'F-1725 Agitator', 3, 7, 1, 5, 1),
(14, 'F-1726 Agitator', 2, 8, 1, 3, 1),
(15, 'F-1726 Agitator', 2, 8, 1, 3, 2),
(16, 'F-1726 Agitator', 2, 8, 1, 3, 1),
(17, 'F-1726 Agitator', 2, 8, 1, 5, 1),
(18, 'F-1726 Agitator', 2, 7, 1, 5, 1),
(19, 'D-1731 Agitator', 1, 7, 1, 3, 1),
(20, 'wwwwwwww', 2, 8, 2, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_class`
--

CREATE TABLE `equipment_class` (
  `id_equipment_class` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `equipment_class_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_class`
--

INSERT INTO `equipment_class` (`id_equipment_class`, `class_name`, `equipment_class_point`) VALUES
(1, 'A', 5),
(2, 'B', 4),
(3, 'C', 3),
(4, 'D', 2);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id_grade` int(11) NOT NULL,
  `grade_name` varchar(20) NOT NULL,
  `grade_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id_grade`, `grade_name`, `grade_point`) VALUES
(7, 'A', 4),
(8, 'B', 3),
(9, 'C', 2),
(10, 'NDT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inspection_period`
--

CREATE TABLE `inspection_period` (
  `id_inspection_period` int(11) NOT NULL,
  `period_name` varchar(20) NOT NULL,
  `period_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inspection_period`
--

INSERT INTO `inspection_period` (`id_inspection_period`, `period_name`, `period_point`) VALUES
(1, '2-4', 5),
(2, '5-8', 4),
(3, '9-12', 3),
(4, '13-20', 2),
(5, '>20', 1),
(6, 'NM', 5);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_equipment` int(11) NOT NULL,
  `id_criteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_equipment`, `id_criteria`, `nilai`) VALUES
(1, 3, 1, 2),
(2, 3, 2, 4),
(3, 3, 3, 2),
(4, 3, 4, 5),
(5, 4, 1, 1),
(6, 4, 2, 2),
(7, 4, 3, 1),
(8, 4, 4, 4),
(9, 20, 1, 2),
(10, 20, 2, 4),
(11, 20, 3, 3),
(12, 20, 4, 4),
(13, 10, 1, 5),
(14, 10, 2, 5),
(15, 10, 3, 4),
(16, 10, 4, 5),
(17, 11, 1, 4),
(18, 11, 2, 3),
(19, 11, 3, 3),
(20, 11, 4, 5),
(21, 12, 1, 4),
(22, 12, 2, 3),
(23, 12, 3, 3),
(24, 12, 4, 4),
(25, 13, 1, 3),
(26, 13, 2, 3),
(27, 13, 3, 4),
(28, 13, 4, 5),
(29, 14, 1, 4),
(30, 14, 2, 4),
(31, 14, 3, 3),
(32, 14, 4, 5),
(33, 15, 1, 4),
(34, 15, 2, 4),
(35, 15, 3, 3),
(36, 15, 4, 4),
(37, 16, 1, 4),
(38, 16, 2, 4),
(39, 16, 3, 3),
(40, 16, 4, 5),
(41, 17, 1, 3),
(42, 17, 2, 4),
(43, 17, 3, 3),
(44, 17, 4, 5),
(45, 18, 1, 3),
(46, 18, 2, 4),
(47, 18, 3, 4),
(48, 18, 4, 5),
(49, 19, 1, 4),
(50, 19, 2, 5),
(51, 19, 3, 4),
(52, 19, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `plant`
--

CREATE TABLE `plant` (
  `id_plant` int(11) NOT NULL,
  `plant_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plant`
--

INSERT INTO `plant` (`id_plant`, `plant_name`) VALUES
(1, 'CTA1'),
(2, 'CTA2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classification`
--
ALTER TABLE `classification`
  ADD PRIMARY KEY (`id_classification`);

--
-- Indexes for table `compute_history`
--
ALTER TABLE `compute_history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `compute_results`
--
ALTER TABLE `compute_results`
  ADD PRIMARY KEY (`id_result`),
  ADD KEY `history_id` (`history_id`);

--
-- Indexes for table `criteria_weight`
--
ALTER TABLE `criteria_weight`
  ADD PRIMARY KEY (`id_criteria`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id_equipment`),
  ADD KEY `id_equipment_class` (`id_equipment_class`),
  ADD KEY `id_grade` (`id_grade`),
  ADD KEY `id_plant` (`id_plant`),
  ADD KEY `id_classification` (`id_classification`),
  ADD KEY `id_inspection_period` (`id_inspection_period`);

--
-- Indexes for table `equipment_class`
--
ALTER TABLE `equipment_class`
  ADD PRIMARY KEY (`id_equipment_class`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id_grade`);

--
-- Indexes for table `inspection_period`
--
ALTER TABLE `inspection_period`
  ADD PRIMARY KEY (`id_inspection_period`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_equipment` (`id_equipment`),
  ADD KEY `id_criteria` (`id_criteria`);

--
-- Indexes for table `plant`
--
ALTER TABLE `plant`
  ADD PRIMARY KEY (`id_plant`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classification`
--
ALTER TABLE `classification`
  MODIFY `id_classification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `compute_history`
--
ALTER TABLE `compute_history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `compute_results`
--
ALTER TABLE `compute_results`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `criteria_weight`
--
ALTER TABLE `criteria_weight`
  MODIFY `id_criteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id_equipment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `equipment_class`
--
ALTER TABLE `equipment_class`
  MODIFY `id_equipment_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id_grade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inspection_period`
--
ALTER TABLE `inspection_period`
  MODIFY `id_inspection_period` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `plant`
--
ALTER TABLE `plant`
  MODIFY `id_plant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compute_results`
--
ALTER TABLE `compute_results`
  ADD CONSTRAINT `compute_results_ibfk_1` FOREIGN KEY (`history_id`) REFERENCES `compute_history` (`id_history`) ON DELETE CASCADE;

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`id_equipment_class`) REFERENCES `equipment_class` (`id_equipment_class`),
  ADD CONSTRAINT `equipment_ibfk_2` FOREIGN KEY (`id_grade`) REFERENCES `grade` (`id_grade`),
  ADD CONSTRAINT `equipment_ibfk_3` FOREIGN KEY (`id_plant`) REFERENCES `plant` (`id_plant`),
  ADD CONSTRAINT `equipment_ibfk_4` FOREIGN KEY (`id_classification`) REFERENCES `classification` (`id_classification`),
  ADD CONSTRAINT `equipment_ibfk_5` FOREIGN KEY (`id_inspection_period`) REFERENCES `inspection_period` (`id_inspection_period`);

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_equipment`) REFERENCES `equipment` (`id_equipment`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_criteria`) REFERENCES `criteria_weight` (`id_criteria`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
