-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2025 at 10:44 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aandg_new_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `module_id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `menu_type` int NOT NULL DEFAULT '1',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `has_child` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `module_id`, `parent_id`, `menu_type`, `title`, `slug`, `url`, `icon`, `order`, `is_active`, `has_child`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(86, 3, 84, 2, 'Basic Order', 'basic-order', 'basicorders', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:17:27', '2025-09-05 23:17:27'),
(87, 3, 84, 2, 'Purchase Requisition', 'purchase-requisition', 'purrequisitions', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:18:17', '2025-09-05 23:18:17'),
(88, 3, 84, 2, 'Forwarding', 'forwarding-pur', 'reqforwarding', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:23:10', '2025-09-05 23:29:40'),
(89, 3, 84, 2, 'Pricing', 'pricing-pur', 'reqpricing', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:27:21', '2025-09-05 23:29:52'),
(90, 3, 84, 2, 'Approval', 'approval', 'reqapproval', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:27:55', '2025-09-05 23:27:55'),
(91, 3, 84, 2, 'Account Clearance', 'account-clearance', 'reqaccclearance', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:28:19', '2025-09-05 23:28:19'),
(92, 3, 84, 2, 'Final Approve', 'final-approve', 'reqfinalapproval', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:28:46', '2025-09-05 23:28:46'),
(98, 3, 84, 2, 'Gate Receive (PUR)', 'gate-receive-pur', 'gatepurmrr', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-08 22:45:08', '2025-09-08 22:45:08'),
(106, 3, 84, 2, 'Gate Out Challan', 'gate-out', 'gateoutchallans', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-11 05:07:56', '2025-09-11 05:11:41'),
(107, 3, 84, 2, 'Gate Out Approve', 'gate-out-approve', 'gateoutchallanapprv', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-11 05:10:04', '2025-09-11 05:10:04'),
(108, 3, 84, 2, 'Gate Out', 'gate-out-1', 'gateoutchallangate', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-11 05:12:33', '2025-09-11 05:12:33'),
(109, 3, 84, 2, 'Requisition Tracking', 'requisition-tracking', 'purreqtracking', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-15 20:48:32', '2025-09-15 20:48:32'),
(110, 3, 84, 2, 'Purchase Pending', 'purchase-pending', 'purreqpending', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-15 20:49:54', '2025-09-15 20:49:54'),
(111, 3, 84, 2, 'Purchase Partial', 'purchase-partial', 'purreqpartial', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-15 20:50:51', '2025-09-15 20:50:51'),
(112, 3, 84, 2, 'Purchase Complete', 'purchase-complete', 'purreqcompleted', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-15 20:51:34', '2025-09-15 20:51:34'),
(113, 3, 84, 2, 'Store Receive ( PUR )', 'store-receive-pur', 'purreqstorercv', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-15 20:54:53', '2025-09-15 20:54:53'),
(115, 3, 84, 2, 'QC Check ( PUR )', 'qc-purchase', 'gatequality', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:18:17', '2025-09-05 23:18:17'),
(116, 3, 84, 2, 'Audit ( PUR )', 'audit-purchase', 'puraudit', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:18:17', '2025-09-05 23:18:17'),
(117, 3, 84, 2, 'Bill ( PUR )', 'bill-purchase', 'puracc', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:18:17', '2025-09-05 23:18:17'),
(118, 3, 84, 2, 'Requisition Delivery', 'requisition-delivary', 'intreqdelidary', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:18:17', '2025-09-05 23:18:17'),
(119, 3, 84, 2, 'Internal Requisition', 'internal-requisition', 'intrequisitions', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:18:17', '2025-09-05 23:18:17'),
(120, 3, 84, 2, 'Delivery ( Normal )', 'normal-delivery', 'normaldelivery', 'arrow-right', 0, 1, 0, 1, 1, '2025-09-05 23:18:17', '2025-09-05 23:18:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_module_id_foreign` (`module_id`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`),
  ADD KEY `menus_menu_type_index` (`menu_type`),
  ADD KEY `menus_title_index` (`title`),
  ADD KEY `menus_slug_index` (`slug`),
  ADD KEY `menus_is_active_index` (`is_active`),
  ADD KEY `menus_has_child_index` (`has_child`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
