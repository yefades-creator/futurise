-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 16, 2026 at 03:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `futurise_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judge_assignment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('draft','locked') NOT NULL DEFAULT 'draft',
  `final_score` decimal(5,2) NOT NULL DEFAULT 0.00,
  `general_feedback` text DEFAULT NULL,
  `locked_at` datetime DEFAULT NULL,
  `unlocked_by` bigint(20) UNSIGNED DEFAULT NULL,
  `unlock_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `judge_assignment_id`, `user_id`, `project_id`, `status`, `final_score`, `general_feedback`, `locked_at`, `unlocked_by`, `unlock_reason`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 1, 'locked', 84.00, 'Inovasi sangat aplikatif dan menunjukkan penguasaan teknologi yang matang oleh mahasiswa.', '2026-11-13 13:28:49', 1, 'revisi karena salah input', '2026-11-08 07:55:58', '2026-11-13 06:28:49'),
(2, 2, 12, 1, 'locked', 89.00, 'Potensi hilirisasi tinggi, perlu penguatan perlindungan HKI dan roadmap bisnis.', '2026-11-08 13:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 3, 11, 2, 'locked', 96.00, 'Inovasi sangat aplikatif dan menunjukkan penguasaan teknologi yang matang oleh mahasiswa.', '2026-11-08 12:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 4, 12, 2, 'locked', 91.00, 'Potensi hilirisasi tinggi, perlu penguatan perlindungan HKI dan roadmap bisnis.', '2026-11-08 13:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 5, 11, 3, 'locked', 100.00, 'Inovasi sangat aplikatif dan menunjukkan penguasaan teknologi yang matang oleh mahasiswa.', '2026-11-08 12:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 6, 12, 3, 'locked', 90.00, 'Potensi hilirisasi tinggi, perlu penguatan perlindungan HKI dan roadmap bisnis.', '2026-11-08 13:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 7, 11, 4, 'locked', 86.00, 'Inovasi sangat aplikatif dan menunjukkan penguasaan teknologi yang matang oleh mahasiswa.', '2026-11-08 12:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 8, 12, 4, 'locked', 81.00, 'Potensi hilirisasi tinggi, perlu penguatan perlindungan HKI dan roadmap bisnis.', '2026-11-08 13:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 9, 11, 5, 'locked', 83.00, 'Inovasi sangat aplikatif dan menunjukkan penguasaan teknologi yang matang oleh mahasiswa.', '2026-11-08 12:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 10, 12, 5, 'locked', 88.00, 'Potensi hilirisasi tinggi, perlu penguatan perlindungan HKI dan roadmap bisnis.', '2026-11-08 13:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 11, 11, 6, 'locked', 90.00, 'Inovasi sangat aplikatif dan menunjukkan penguasaan teknologi yang matang oleh mahasiswa.', '2026-11-08 12:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 12, 12, 6, 'locked', 90.00, 'Potensi hilirisasi tinggi, perlu penguatan perlindungan HKI dan roadmap bisnis.', '2026-11-08 13:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 13, 11, 7, 'locked', 93.00, 'Inovasi sangat aplikatif dan menunjukkan penguasaan teknologi yang matang oleh mahasiswa.', '2026-11-08 12:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 14, 12, 7, 'locked', 89.00, 'Potensi hilirisasi tinggi, perlu penguatan perlindungan HKI dan roadmap bisnis.', '2026-11-08 13:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 15, 11, 8, 'locked', 93.00, 'Inovasi sangat aplikatif dan menunjukkan penguasaan teknologi yang matang oleh mahasiswa.', '2026-11-08 12:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 16, 12, 8, 'locked', 87.00, 'Potensi hilirisasi tinggi, perlu penguatan perlindungan HKI dan roadmap bisnis.', '2026-11-08 13:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 17, 11, 9, 'locked', 91.00, 'Inovasi sangat aplikatif dan menunjukkan penguasaan teknologi yang matang oleh mahasiswa.', '2026-11-08 12:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 18, 12, 9, 'locked', 95.00, 'Potensi hilirisasi tinggi, perlu penguatan perlindungan HKI dan roadmap bisnis.', '2026-11-08 13:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 19, 11, 10, 'locked', 83.00, 'Inovasi sangat aplikatif dan menunjukkan penguasaan teknologi yang matang oleh mahasiswa.', '2026-11-08 12:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 20, 12, 10, 'locked', 96.00, 'Potensi hilirisasi tinggi, perlu penguatan perlindungan HKI dan roadmap bisnis.', '2026-11-08 13:55:58', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `entity_type` varchar(255) NOT NULL,
  `entity_id` bigint(20) UNSIGNED NOT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_values`)),
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_values`)),
  `reason` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `event_id`, `user_id`, `action`, `entity_type`, `entity_id`, `old_values`, `new_values`, `reason`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'payment_verified', 'Payment', 1, '{\"status\":\"pending_verification\"}', '{\"status\":\"verified\",\"verified_by\":\"Bendahara & Keuangan\"}', 'Verifikasi transfer lunas rekening koran Bank BJB', '127.0.0.1', '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(2, 1, NULL, 'booth_allocated', 'BoothAllocation', 1, NULL, '{\"booth_code\":\"B-01\",\"organization\":\"Institut Teknologi Bandung (ITB)\"}', 'Penetapan alokasi booth akademik oleh panitia venue', '127.0.0.1', '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(3, 1, 4, 'project_curated', 'Project', 1, '{\"status\":\"lolos\",\"is_locked\":false,\"publication_status\":\"terbit\"}', '{\"status\":\"tidak_lolos\",\"is_locked\":false,\"publication_status\":\"terbit\"}', 'Kurasi karya ID 1 (AgriSense AI: Edge IoT & Computer Vision for Smart Paddy Monitoring)', '::1', '2026-11-13 03:33:01', '2026-11-13 03:33:01'),
(4, 1, 5, 'project_curated', 'Project', 1, '{\"status\":\"tidak_lolos\",\"is_locked\":false,\"publication_status\":\"terbit\"}', '{\"status\":\"tidak_lolos\",\"is_locked\":false,\"publication_status\":\"diarsipkan\"}', 'Kurasi karya ID 1 (AgriSense AI: Edge IoT & Computer Vision for Smart Paddy Monitoring)', '::1', '2026-11-13 03:35:03', '2026-11-13 03:35:03'),
(5, 1, 1, 'voting_period_updated', 'Event', 1, '{\"voting_start_at\":\"2026-11-22T08:55:52+00:00\",\"voting_end_at\":\"2026-11-23T16:55:52+00:00\"}', '{\"voting_start_at\":\"2026-11-12T08:55:00+00:00\",\"voting_end_at\":\"2026-11-14T16:55:00+00:00\"}', 'Periode voting People\'s Choice diperbarui', '::1', '2026-11-13 05:46:14', '2026-11-13 05:46:14'),
(6, 1, 1, 'user_updated', 'User', 11, '{\"name\":\"Prof. Dr. Juri Teknologi (Juri)\",\"email\":\"juri@futurise.id\",\"status\":\"active\",\"role_ids\":[16]}', '{\"name\":\"Prof. Dr. Juri Teknologi (Juri)\",\"email\":\"juri@futurise.id\",\"status\":\"active\",\"role_ids\":[\"16\"]}', 'Super Admin memperbarui akun juri@futurise.id', '::1', '2026-11-13 06:06:36', '2026-11-13 06:06:36'),
(7, 1, 1, 'score_unlocked', 'Assessment', 1, '{\"status\":\"locked\",\"final_score\":\"86.00\"}', '{\"status\":\"draft\",\"unlock_reason\":\"revisi karena salah input\"}', 'Pembukaan kunci nilai karya ID 1 dengan alasan: revisi karena salah input', '::1', '2026-11-13 06:27:41', '2026-11-13 06:27:41'),
(8, 1, 11, 'score_locked', 'Assessment', 1, NULL, '{\"final_score\":84,\"project_id\":1}', 'Juri ID 11 mengunci nilai karya ID 1 sebesar 84', '::1', '2026-11-13 06:28:49', '2026-11-13 06:28:49'),
(9, 1, 5, 'judge_assigned', 'JudgeAssignment', 21, NULL, '{\"judge_id\":11,\"project_id\":16,\"is_active\":true}', 'Juri Prof. Dr. Juri Teknologi (Juri) ditugaskan ke karya CivicVoice: NLP Sentiment Analysis for Public Policy Consultation Jabar', '::1', '2026-11-13 06:30:05', '2026-11-13 06:30:05'),
(10, 1, 1, 'organization_verification_changed', 'Organization', 47, '{\"status\":\"pending_verification\",\"verification_notes\":null}', '{\"status\":\"verified\",\"verification_notes\":null}', 'Status verifikasi organisasi SMA ABCD diubah menjadi verified', '::1', '2026-11-13 06:34:09', '2026-11-13 06:34:09'),
(11, 1, 1, 'tour_slot_created', 'TourSlot', 3, NULL, '{\"slot_name\":\"Slot Tur Sore 1 (Hari 1)\",\"date\":\"2026-11-14T00:00:00.000000Z\",\"start_time\":\"13:00\",\"end_time\":\"17:00\",\"max_capacity\":\"150\",\"guide_name\":\"Kang Reza & Teh Rara\",\"status\":\"open\"}', 'Slot tur Slot Tur Sore 1 (Hari 1) dibuat', '::1', '2026-11-13 06:47:21', '2026-11-13 06:47:21'),
(12, 1, 1, 'school_group_checked_in', 'SchoolVisit', 2, '{\"arrival_status\":\"confirmed\",\"actual_attendees\":0}', '{\"arrival_status\":\"arrived\",\"actual_attendees\":50}', 'Check-in rombongan sekolah dengan jumlah aktual 50', '::1', '2026-11-13 06:51:21', '2026-11-13 06:51:21'),
(13, 1, 1, 'organization_verification_changed', 'Organization', 48, '{\"status\":\"pending_verification\",\"verification_notes\":null}', '{\"status\":\"verified\",\"verification_notes\":null}', 'Status verifikasi organisasi Sponsor ABCD diubah menjadi verified', '::1', '2026-11-13 06:57:03', '2026-11-13 06:57:03'),
(14, 1, 1, 'sponsorship_agreement_created', 'SponsorshipAgreement', 3, NULL, '{\"organization_id\":48,\"agreement_number\":\"SPON\\/2026\\/0861ED5A\",\"agreed_amount\":\"20000000.00\",\"support_type\":\"cash\",\"status\":\"signed\"}', 'Kesepakatan sponsorship SPON/2026/0861ED5A dibuat', '::1', '2026-11-13 07:22:39', '2026-11-13 07:22:39'),
(15, 1, 1, 'sponsorship_agreement_updated', 'SponsorshipAgreement', 3, '{\"agreement_number\":\"SPON\\/2026\\/0861ED5A\",\"package_id\":3,\"agreed_amount\":\"20000000.00\",\"support_type\":\"cash\",\"in_kind_description\":\"-\",\"status\":\"signed\",\"agreed_at\":\"2026-11-13T21:21:00.000000Z\",\"contract_document\":null}', '{\"agreement_number\":\"SPON\\/2026\\/0861ED5A\",\"package_id\":\"2\",\"agreed_amount\":\"20000000.00\",\"support_type\":\"cash\",\"in_kind_description\":\"-\",\"status\":\"signed\",\"agreed_at\":\"2026-11-13T21:21:00.000000Z\",\"contract_document\":null}', 'Kesepakatan SPON/2026/0861ED5A diperbarui', '::1', '2026-11-13 07:23:18', '2026-11-13 07:23:18'),
(16, 1, 1, 'sponsorship_agreement_updated', 'SponsorshipAgreement', 3, '{\"agreement_number\":\"SPON\\/2026\\/0861ED5A\",\"package_id\":2,\"agreed_amount\":\"20000000.00\",\"support_type\":\"cash\",\"in_kind_description\":\"-\",\"status\":\"signed\",\"agreed_at\":\"2026-11-13T21:21:00.000000Z\",\"contract_document\":null}', '{\"agreement_number\":\"SPON\\/2026\\/0861ED5A\",\"package_id\":\"1\",\"agreed_amount\":\"20000000.00\",\"support_type\":\"cash\",\"in_kind_description\":\"-\",\"status\":\"signed\",\"agreed_at\":\"2026-11-13T21:21:00.000000Z\",\"contract_document\":null}', 'Kesepakatan SPON/2026/0861ED5A diperbarui', '::1', '2026-11-13 07:23:42', '2026-11-13 07:23:42'),
(17, 1, 1, 'benefit_fulfillment_created', 'BenefitFulfillment', 2, NULL, '{\"agreement_id\":3,\"benefit_id\":3,\"status\":\"fulfilled\",\"proof_file\":true,\"proof_url\":\"https:\\/\\/futurise.id\\/gallery\\/speaker-bjb\"}', 'Pemenuhan manfaat Booth Korporat 4x4m dicatat', '::1', '2026-11-13 07:24:32', '2026-11-13 07:24:32'),
(18, 1, 1, 'invoice_created', 'Invoice', 2, NULL, '{\"organization_id\":48,\"invoice_number\":\"INV\\/2026\\/261113\\/7DC014\",\"total_amount\":\"20000000.00\",\"due_date\":\"2026-11-14\"}', 'Tagihan INV/2026/261113/7DC014 dibuat untuk Sponsor ABCD', '::1', '2026-11-13 07:26:33', '2026-11-13 07:26:33'),
(19, 1, 1, 'payment_verified', 'Payment', 2, '{\"status\":\"pending_verification\"}', '{\"status\":\"verified\",\"amount\":\"20000000.00\"}', 'Verifikasi pembayaran nomor PAY/2026/11/E6B064 sebesar Rp 20.000.000', '::1', '2026-11-13 07:27:45', '2026-11-13 07:27:45'),
(20, 1, 1, 'organization_verification_changed', 'Organization', 49, '{\"status\":\"pending_verification\",\"verification_notes\":null}', '{\"status\":\"verified\",\"verification_notes\":null}', 'Status verifikasi organisasi PIC Industri ABCD diubah menjadi verified', '::1', '2026-11-13 07:36:30', '2026-11-13 07:36:30'),
(21, 1, 1, 'meeting_status_changed', 'Meeting', 3, '{\"status\":\"requested\"}', '{\"status\":\"confirmed\"}', 'Status pertemuan 3 diperbarui menjadi confirmed', '::1', '2026-11-13 07:37:29', '2026-11-13 07:37:29'),
(22, 1, 1, 'user_created', 'User', 50, NULL, '{\"name\":\"Tim Mahasiswa B\",\"email\":\"timmhsb@gmail.com\",\"roles\":[\"12\"],\"status\":\"active\"}', 'Super Admin membuat akun timmhsb@gmail.com', '::1', '2026-11-13 07:41:37', '2026-11-13 07:41:37'),
(23, 1, 1, 'user_updated', 'User', 15, '{\"name\":\"PIC Kampus Telkom University\",\"email\":\"kampus@telkomuniversity.ac.id\",\"status\":\"active\",\"role_ids\":[11]}', '{\"name\":\"PIC Kampus Telkom University\",\"email\":\"kampus@telkomuniversity.ac.id\",\"status\":\"active\",\"role_ids\":[\"11\"]}', 'Super Admin memperbarui akun kampus@telkomuniversity.ac.id', '::1', '2026-11-13 07:56:33', '2026-11-13 07:56:33'),
(24, 1, 1, 'organization_verification_changed', 'Organization', 50, '{\"status\":\"pending_verification\",\"verification_notes\":null}', '{\"status\":\"verified\",\"verification_notes\":null}', 'Status verifikasi organisasi Universitas ABCD diubah menjadi verified', '::1', '2026-11-13 08:04:10', '2026-11-13 08:04:10'),
(25, 1, 1, 'project_curated', 'Project', 61, '{\"status\":\"diajukan\",\"is_locked\":true,\"publication_status\":\"belum_disetujui\"}', '{\"status\":\"lolos\",\"is_locked\":true,\"publication_status\":\"belum_disetujui\"}', 'Kurasi karya ID 61 (iot)', '::1', '2026-11-13 08:13:41', '2026-11-13 08:13:41'),
(26, 1, 1, 'project_publication_status_changed', 'Project', 61, '{\"publication_status\":\"belum_disetujui\"}', '{\"publication_status\":\"terbit\"}', 'Status publikasi karya iot diubah menjadi terbit', '::1', '2026-11-13 08:13:54', '2026-11-13 08:13:54'),
(27, 1, 1, 'project_curated', 'Project', 61, '{\"status\":\"lolos\",\"is_locked\":true,\"publication_status\":\"terbit\"}', '{\"status\":\"lolos\",\"is_locked\":true,\"publication_status\":\"terbit\"}', 'Kurasi karya ID 61 (iot)', '::1', '2026-11-13 08:14:16', '2026-11-13 08:14:16'),
(28, 1, 1, 'project_publication_status_changed', 'Project', 61, '{\"publication_status\":\"terbit\"}', '{\"publication_status\":\"terbit\"}', 'Status publikasi karya iot diubah menjadi terbit', '::1', '2026-11-13 08:15:58', '2026-11-13 08:15:58'),
(29, 1, 1, 'project_publication_status_changed', 'Project', 61, '{\"publication_status\":\"terbit\"}', '{\"publication_status\":\"siap_publikasi\"}', 'Status publikasi karya iot diubah menjadi siap_publikasi', '::1', '2026-11-13 08:16:18', '2026-11-13 08:16:18'),
(30, 1, 1, 'project_publication_status_changed', 'Project', 61, '{\"publication_status\":\"siap_publikasi\"}', '{\"publication_status\":\"terbit\"}', 'Status publikasi karya iot diubah menjadi terbit', '::1', '2026-11-13 08:16:30', '2026-11-13 08:16:30'),
(31, 1, 1, 'user_updated', 'User', 50, '{\"name\":\"Tim Mahasiswa B\",\"email\":\"timmhsb@gmail.com\",\"status\":\"active\",\"role_ids\":[12]}', '{\"name\":\"Tim Mahasiswa B\",\"email\":\"timmhsb@gmail.com\",\"status\":\"active\",\"role_ids\":[\"12\"]}', 'Super Admin memperbarui akun timmhsb@gmail.com', '::1', '2026-11-13 08:18:19', '2026-11-13 08:18:19'),
(32, 1, 1, 'project_curated', 'Project', 61, '{\"status\":\"lolos\",\"is_locked\":true,\"publication_status\":\"terbit\"}', '{\"status\":\"perlu_revisi\",\"is_locked\":false,\"publication_status\":\"terbit\"}', 'Kurasi karya ID 61 (iot)', '::1', '2026-11-13 08:25:24', '2026-11-13 08:25:24'),
(33, 1, 1, 'user_updated', 'User', 50, '{\"name\":\"Tim Mahasiswa B\",\"email\":\"timmhsb@gmail.com\",\"status\":\"active\",\"role_ids\":[12]}', '{\"name\":\"Tim Mahasiswa B\",\"email\":\"timmhsb@gmail.com\",\"status\":\"active\",\"role_ids\":[\"12\"]}', 'Super Admin memperbarui akun timmhsb@gmail.com', '::1', '2026-11-13 08:38:46', '2026-11-13 08:38:46'),
(34, 1, 1, 'user_updated', 'User', 50, '{\"name\":\"Tim Mahasiswa B\",\"email\":\"timmhsb@gmail.com\",\"status\":\"active\",\"role_ids\":[12]}', '{\"name\":\"Tim Mahasiswa B\",\"email\":\"timmhsb@gmail.com\",\"status\":\"active\",\"role_ids\":[\"12\"]}', 'Super Admin memperbarui akun timmhsb@gmail.com', '::1', '2026-11-13 08:44:31', '2026-11-13 08:44:31'),
(35, 1, 1, 'project_curated', 'Project', 62, '{\"status\":\"draft\",\"is_locked\":false,\"publication_status\":\"belum_disetujui\"}', '{\"status\":\"lolos\",\"is_locked\":true,\"publication_status\":\"belum_disetujui\"}', 'Kurasi karya ID 62 (abcd)', '::1', '2026-11-13 08:51:47', '2026-11-13 08:51:47'),
(36, 1, 1, 'project_publication_status_changed', 'Project', 62, '{\"publication_status\":\"belum_disetujui\"}', '{\"publication_status\":\"terbit\"}', 'Status publikasi karya abcd diubah menjadi terbit', '::1', '2026-11-13 08:52:02', '2026-11-13 08:52:02'),
(37, 1, 1, 'user_updated', 'User', 10, '{\"name\":\"Petugas Registrasi Gate Sabuga\",\"email\":\"registrasi@futurise.id\",\"status\":\"active\",\"role_ids\":[10]}', '{\"name\":\"Petugas Registrasi Gate Sabuga\",\"email\":\"registrasi@futurise.id\",\"status\":\"active\",\"role_ids\":[\"10\"]}', 'Super Admin memperbarui akun registrasi@futurise.id', '::1', '2026-11-13 08:54:11', '2026-11-13 08:54:11'),
(38, 1, 1, 'user_updated', 'User', 9, '{\"name\":\"Tim Publikasi & Media\",\"email\":\"publikasi@futurise.id\",\"status\":\"active\",\"role_ids\":[9]}', '{\"name\":\"Tim Publikasi & Media\",\"email\":\"publikasi@futurise.id\",\"status\":\"active\",\"role_ids\":[\"9\"]}', 'Super Admin memperbarui akun publikasi@futurise.id', '::1', '2026-11-13 09:02:17', '2026-11-13 09:02:17'),
(39, 1, 9, 'news_created', 'News', 3, NULL, '{\"title\":\"FUTURISE\",\"category\":\"Dokumentasi\",\"is_published\":true,\"has_cover\":true,\"has_document\":false}', 'Berita FUTURISE dibuat', '::1', '2026-11-13 09:38:12', '2026-11-13 09:38:12'),
(40, 1, 1, 'user_updated', 'User', 7, '{\"name\":\"Divisi Industri & Sponsor\",\"email\":\"sponsor@futurise.id\",\"status\":\"active\",\"role_ids\":[7]}', '{\"name\":\"Divisi Industri & Sponsor\",\"email\":\"sponsor@futurise.id\",\"status\":\"active\",\"role_ids\":[\"7\"]}', 'Super Admin memperbarui akun sponsor@futurise.id', '::1', '2026-11-13 09:44:15', '2026-11-13 09:44:15'),
(41, 1, 1, 'user_updated', 'User', 3, '{\"name\":\"Sekretariat APTIKOM\",\"email\":\"sekretariat@futurise.id\",\"status\":\"active\",\"role_ids\":[3]}', '{\"name\":\"Sekretariat APTIKOM\",\"email\":\"sekretariat@futurise.id\",\"status\":\"active\",\"role_ids\":[\"3\"]}', 'Super Admin memperbarui akun sekretariat@futurise.id', '::1', '2026-11-13 09:50:09', '2026-11-13 09:50:09'),
(42, 1, 1, 'user_updated', 'User', 2, '{\"name\":\"Dr. Ir. Hendra Gunawan (Ketua Pelaksana)\",\"email\":\"ketua@futurise.id\",\"status\":\"active\",\"role_ids\":[2]}', '{\"name\":\"Dr. Ir. Hendra Gunawan (Ketua Pelaksana)\",\"email\":\"ketua@futurise.id\",\"status\":\"active\",\"role_ids\":[\"2\"]}', 'Super Admin memperbarui akun ketua@futurise.id', '::1', '2026-11-13 09:52:47', '2026-11-13 09:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `benefits`
--

CREATE TABLE `benefits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `required_proof_type` varchar(255) NOT NULL DEFAULT 'photo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `benefits`
--

INSERT INTO `benefits` (`id`, `package_id`, `name`, `description`, `required_proof_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'Keynote Speaker Sesi Pleno', NULL, 'photo', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 'Logo Raksasa Main Backdrop & LED Sabuga', NULL, 'photo', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 'Booth Korporat 4x4m', NULL, 'photo', '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `benefit_fulfillments`
--

CREATE TABLE `benefit_fulfillments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agreement_id` bigint(20) UNSIGNED NOT NULL,
  `benefit_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','in_progress','fulfilled') NOT NULL DEFAULT 'pending',
  `proof_file` varchar(255) DEFAULT NULL,
  `proof_url` varchar(255) DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `benefit_fulfillments`
--

INSERT INTO `benefit_fulfillments` (`id`, `agreement_id`, `benefit_id`, `status`, `proof_file`, `proof_url`, `verified_by`, `verified_at`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'fulfilled', NULL, 'https://futurise.id/gallery/speaker-bjb', NULL, NULL, 'Direktur IT Bank BJB telah dijadwalkan sebagai Keynote Speaker Sesi 1.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 3, 3, 'fulfilled', 'sponsorship-proofs/7VDtANqi6fVNG4lP1GFWNzPPKWSlpbrlwqU6JFCe.jpg', 'https://futurise.id/gallery/speaker-bjb', 1, '2026-11-13 14:24:32', '-', '2026-11-13 07:24:32', '2026-11-13 07:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `booths`
--

CREATE TABLE `booths` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `category` enum('campus','industry','partner') NOT NULL,
  `size` varchar(255) NOT NULL DEFAULT '3x3 m',
  `power_watt` int(11) NOT NULL DEFAULT 450,
  `max_projects` int(11) NOT NULL DEFAULT 2,
  `zone` varchar(255) NOT NULL DEFAULT 'Hall A',
  `location_description` varchar(255) DEFAULT NULL,
  `x_coord` int(11) DEFAULT NULL,
  `y_coord` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booths`
--

INSERT INTO `booths` (`id`, `event_id`, `code`, `category`, `size`, `power_watt`, `max_projects`, `zone`, `location_description`, `x_coord`, `y_coord`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'B-01', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-01', 50, 100, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 'B-02', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-02', 200, 100, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 'B-03', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-03', 350, 100, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 1, 'B-04', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-04', 500, 100, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 1, 'B-05', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-05', 650, 100, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 1, 'B-06', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-06', 800, 100, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 1, 'B-07', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-07', 50, 220, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 1, 'B-08', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-08', 200, 220, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 1, 'B-09', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-09', 350, 220, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 1, 'B-10', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-10', 500, 220, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 1, 'B-11', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-11', 650, 220, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 1, 'B-12', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-12', 800, 220, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 1, 'B-13', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-13', 50, 340, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 1, 'B-14', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-14', 200, 340, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 1, 'B-15', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-15', 350, 340, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 1, 'B-16', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-16', 500, 340, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 1, 'B-17', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-17', 650, 340, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 1, 'B-18', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-18', 800, 340, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 1, 'B-19', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-19', 50, 460, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 1, 'B-20', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-20', 200, 460, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 1, 'B-21', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-21', 350, 460, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(22, 1, 'B-22', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-22', 500, 460, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(23, 1, 'B-23', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-23', 650, 460, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(24, 1, 'B-24', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-24', 800, 460, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(25, 1, 'B-25', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-25', 50, 580, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(26, 1, 'B-26', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-26', 200, 580, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(27, 1, 'B-27', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-27', 350, 580, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(28, 1, 'B-28', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-28', 500, 580, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(29, 1, 'B-29', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-29', 650, 580, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(30, 1, 'B-30', 'campus', '3x3 m', 450, 2, 'Hall Utama - Zona Akademik', 'Sayap Kiri Sabuga Lantai 1, Booth B-30', 800, 580, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(31, 1, 'I-01', 'industry', '4x4 m', 1200, 1, 'Hall Utama - Zona Korporat & Startup', 'Koridor Tengah Sabuga, Booth I-01', 100, 750, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(32, 1, 'I-02', 'industry', '4x4 m', 1200, 1, 'Hall Utama - Zona Korporat & Startup', 'Koridor Tengah Sabuga, Booth I-02', 280, 750, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(33, 1, 'I-03', 'industry', '4x4 m', 1200, 1, 'Hall Utama - Zona Korporat & Startup', 'Koridor Tengah Sabuga, Booth I-03', 460, 750, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(34, 1, 'I-04', 'industry', '4x4 m', 1200, 1, 'Hall Utama - Zona Korporat & Startup', 'Koridor Tengah Sabuga, Booth I-04', 640, 750, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(35, 1, 'I-05', 'industry', '4x4 m', 1200, 1, 'Hall Utama - Zona Korporat & Startup', 'Koridor Tengah Sabuga, Booth I-05', 820, 750, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(36, 1, 'I-06', 'industry', '4x4 m', 1200, 1, 'Hall Utama - Zona Korporat & Startup', 'Koridor Tengah Sabuga, Booth I-06', 100, 900, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(37, 1, 'I-07', 'industry', '4x4 m', 1200, 1, 'Hall Utama - Zona Korporat & Startup', 'Koridor Tengah Sabuga, Booth I-07', 280, 900, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(38, 1, 'I-08', 'industry', '4x4 m', 1200, 1, 'Hall Utama - Zona Korporat & Startup', 'Koridor Tengah Sabuga, Booth I-08', 460, 900, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(39, 1, 'I-09', 'industry', '4x4 m', 1200, 1, 'Hall Utama - Zona Korporat & Startup', 'Koridor Tengah Sabuga, Booth I-09', 640, 900, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(40, 1, 'I-10', 'industry', '4x4 m', 1200, 1, 'Hall Utama - Zona Korporat & Startup', 'Koridor Tengah Sabuga, Booth I-10', 820, 900, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(41, 1, 'M-01', 'partner', '3x3 m', 600, 1, 'Zona Ekosistem & Komunitas Mitra', 'Foyer Depan Sabuga, Booth M-01', 150, 1100, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(42, 1, 'M-02', 'partner', '3x3 m', 600, 1, 'Zona Ekosistem & Komunitas Mitra', 'Foyer Depan Sabuga, Booth M-02', 330, 1100, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(43, 1, 'M-03', 'partner', '3x3 m', 600, 1, 'Zona Ekosistem & Komunitas Mitra', 'Foyer Depan Sabuga, Booth M-03', 510, 1100, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(44, 1, 'M-04', 'partner', '3x3 m', 600, 1, 'Zona Ekosistem & Komunitas Mitra', 'Foyer Depan Sabuga, Booth M-04', 690, 1100, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(45, 1, 'M-05', 'partner', '3x3 m', 600, 1, 'Zona Ekosistem & Komunitas Mitra', 'Foyer Depan Sabuga, Booth M-05', 870, 1100, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `booth_allocations`
--

CREATE TABLE `booth_allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `booth_id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `allocated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('reserved','allocated','confirmed','active','cancelled') NOT NULL DEFAULT 'allocated',
  `allocated_at` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booth_allocations`
--

INSERT INTO `booth_allocations` (`id`, `event_id`, `booth_id`, `organization_id`, `allocated_by`, `status`, `allocated_at`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 2, 2, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 3, 3, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 1, 4, 4, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 1, 5, 5, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 1, 6, 6, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 1, 7, 7, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 1, 8, 8, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 1, 9, 9, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 1, 10, 10, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 1, 11, 11, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 1, 12, 12, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 1, 13, 13, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 1, 14, 14, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 1, 15, 15, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 1, 16, 16, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 1, 17, 17, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 1, 18, 18, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 1, 19, 19, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 1, 20, 20, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 1, 21, 21, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(22, 1, 22, 22, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(23, 1, 23, 23, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(24, 1, 24, 24, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(25, 1, 25, 25, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(26, 1, 26, 26, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(27, 1, 27, 27, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(28, 1, 28, 28, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(29, 1, 29, 29, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(30, 1, 30, 30, NULL, 'confirmed', '2026-11-03 14:55:58', 'Alokasi booth standar 2 karya mahasiswa', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(31, 1, 31, 31, NULL, 'confirmed', '2026-11-05 14:55:58', 'Booth Korporat & Showcase Solusi Industri', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(32, 1, 32, 32, NULL, 'confirmed', '2026-11-05 14:55:58', 'Booth Korporat & Showcase Solusi Industri', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(33, 1, 33, 33, NULL, 'confirmed', '2026-11-05 14:55:58', 'Booth Korporat & Showcase Solusi Industri', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(34, 1, 34, 34, NULL, 'confirmed', '2026-11-05 14:55:58', 'Booth Korporat & Showcase Solusi Industri', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(35, 1, 35, 35, NULL, 'confirmed', '2026-11-05 14:55:58', 'Booth Korporat & Showcase Solusi Industri', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(36, 1, 36, 36, NULL, 'confirmed', '2026-11-05 14:55:58', 'Booth Korporat & Showcase Solusi Industri', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(37, 1, 37, 37, NULL, 'confirmed', '2026-11-05 14:55:58', 'Booth Korporat & Showcase Solusi Industri', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(38, 1, 38, 38, NULL, 'confirmed', '2026-11-05 14:55:58', 'Booth Korporat & Showcase Solusi Industri', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(39, 1, 39, 39, NULL, 'confirmed', '2026-11-05 14:55:58', 'Booth Korporat & Showcase Solusi Industri', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(40, 1, 40, 40, NULL, 'confirmed', '2026-11-05 14:55:58', 'Booth Korporat & Showcase Solusi Industri', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(41, 1, 41, 41, NULL, 'confirmed', '2026-11-06 14:55:58', 'Booth Mitra Strategis & Asosiasi', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(42, 1, 42, 42, NULL, 'confirmed', '2026-11-06 14:55:58', 'Booth Mitra Strategis & Asosiasi', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(43, 1, 43, 43, NULL, 'confirmed', '2026-11-06 14:55:58', 'Booth Mitra Strategis & Asosiasi', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(44, 1, 44, 44, NULL, 'confirmed', '2026-11-06 14:55:58', 'Booth Mitra Strategis & Asosiasi', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(45, 1, 45, 45, NULL, 'confirmed', '2026-11-06 14:55:58', 'Booth Mitra Strategis & Asosiasi', '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campus_profiles`
--

CREATE TABLE `campus_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `rector_name` varchar(255) DEFAULT NULL,
  `campus_type` varchar(255) NOT NULL DEFAULT 'PTN',
  `accreditation` varchar(255) NOT NULL DEFAULT 'Unggul',
  `student_count` int(11) DEFAULT NULL,
  `faculty_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campus_profiles`
--

INSERT INTO `campus_profiles` (`id`, `organization_id`, `rector_name`, `campus_type`, `accreditation`, `student_count`, `faculty_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rektor Institut Teknologi Bandung (ITB)', 'PTN', 'Unggul', 21262, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 2, 'Rektor Telkom University (Tel-U)', 'PTS', 'Unggul', 17315, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 3, 'Rektor Universitas Komputer Indonesia (UNIKOM)', 'PTS', 'Unggul', 12797, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 4, 'Rektor Universitas Padjadjaran (UNPAD)', 'PTN', 'Unggul', 24313, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 5, 'Rektor Universitas Pendidikan Indonesia (UPI)', 'PTN', 'Unggul', 12432, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 6, 'Rektor Politeknik Negeri Bandung (POLBAN)', 'PTS', 'Unggul', 13193, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 7, 'Rektor Universitas Katolik Parahyangan (UNPAR)', 'PTS', 'Unggul', 9721, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 8, 'Rektor Universitas Pasundan (UNPAS)', 'PTS', 'Unggul', 26415, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 9, 'Rektor Universitas Widyatama', 'PTS', 'Unggul', 9862, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 10, 'Rektor Institut Pertanian Bogor (IPB University)', 'PTS', 'Unggul', 18578, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 11, 'Rektor Universitas Singaperbangsa Karawang (UNSIKA)', 'PTS', 'Unggul', 16884, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 12, 'Rektor Universitas Siliwangi (UNSIL)', 'PTS', 'Unggul', 14349, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 13, 'Rektor UIN Sunan Gunung Djati Bandung', 'PTS', 'Unggul', 18447, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 14, 'Rektor Universitas Kristen Maranatha', 'PTS', 'Unggul', 14024, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 15, 'Rektor Universitas Islam Bandung (UNISBA)', 'PTS', 'Unggul', 27467, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 16, 'Rektor Universitas Swadaya Gunung Jati (UGJ)', 'PTS', 'Unggul', 15460, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 17, 'Rektor Universitas Kuningan (UNIKU)', 'PTS', 'Unggul', 9936, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 18, 'Rektor Universitas Majalengka (UNMA)', 'PTS', 'Unggul', 23869, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 19, 'Rektor Universitas Galuh (UNIGAL)', 'PTS', 'Unggul', 15438, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 20, 'Rektor Politeknik Manufaktur Bandung (POLMAN)', 'PTS', 'Unggul', 15277, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 21, 'Rektor Politeknik Pos Indonesia (ULBI)', 'PTS', 'Unggul', 14864, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(22, 22, 'Rektor STMIK AMIK Bandung', 'PTS', 'Unggul', 13909, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(23, 23, 'Rektor STMIK IKMI Cirebon', 'PTS', 'Unggul', 22171, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(24, 24, 'Rektor Universitas Pakuan Bogor', 'PTS', 'Unggul', 19364, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(25, 25, 'Rektor Universitas Ibn Khaldun Bogor', 'PTS', 'Unggul', 17844, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(26, 26, 'Rektor Universitas Presiden (President University)', 'PTS', 'Unggul', 11576, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(27, 27, 'Rektor Universitas Djuanda Bogor', 'PTS', 'Unggul', 25906, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(28, 28, 'Rektor Universitas Muhammadiyah Sukabumi (UMMI)', 'PTS', 'Unggul', 27532, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(29, 29, 'Rektor Universitas Subang (UNSUB)', 'PTS', 'Unggul', 13200, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(30, 30, 'Rektor Universitas Garut (UNIGA)', 'PTS', 'Unggul', 20546, 'Fakultas Teknologi Informasi / Ilmu Komputer', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(31, 50, NULL, 'PTN', 'Unggul', NULL, NULL, '2026-11-13 07:57:30', '2026-11-13 07:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `check_in_logs`
--

CREATE TABLE `check_in_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `scan_type` enum('in','out') NOT NULL DEFAULT 'in',
  `is_unique_first_entry` tinyint(1) NOT NULL DEFAULT 0,
  `gate_location` varchar(255) NOT NULL DEFAULT 'Gate 1 - Main Entrance',
  `scanned_by` bigint(20) UNSIGNED DEFAULT NULL,
  `scanned_at` datetime NOT NULL,
  `is_manual_override` tinyint(1) NOT NULL DEFAULT 0,
  `override_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `check_in_logs`
--

INSERT INTO `check_in_logs` (`id`, `event_id`, `ticket_id`, `user_id`, `scan_type`, `is_unique_first_entry`, `gate_location`, `scanned_by`, `scanned_at`, `is_manual_override`, `override_reason`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20, 'in', 1, 'Gate Utama Sabuga Lantai 1', 10, '2026-11-08 10:55:58', 0, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 1, 20, 'in', 0, 'Gate Samping Food Court Sabuga', 10, '2026-11-08 13:55:58', 0, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 2, 21, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 10:47:59', 0, NULL, '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(4, 1, 3, 22, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 11:33:59', 0, NULL, '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(5, 1, 4, 23, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 13:38:59', 0, NULL, '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(6, 1, 5, 24, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 12:39:59', 0, NULL, '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(7, 1, 6, 25, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 10:08:00', 0, NULL, '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(8, 1, 7, 26, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 12:57:00', 0, NULL, '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(9, 1, 8, 27, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 11:48:00', 0, NULL, '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(10, 1, 9, 28, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 11:41:01', 0, NULL, '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(11, 1, 10, 29, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 13:11:01', 0, NULL, '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(12, 1, 11, 30, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 14:08:01', 0, NULL, '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(13, 1, 12, 31, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 10:07:01', 0, NULL, '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(14, 1, 13, 32, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 13:35:02', 0, NULL, '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(15, 1, 14, 33, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 10:44:02', 0, NULL, '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(16, 1, 15, 34, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 12:46:02', 0, NULL, '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(17, 1, 16, 35, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 14:38:02', 0, NULL, '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(18, 1, 17, 36, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 11:55:03', 0, NULL, '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(19, 1, 18, 37, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 11:22:03', 0, NULL, '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(20, 1, 19, 38, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 13:18:03', 0, NULL, '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(21, 1, 20, 39, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 12:43:03', 0, NULL, '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(22, 1, 21, 40, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 10:23:04', 0, NULL, '2026-11-08 07:56:04', '2026-11-08 07:56:04'),
(23, 1, 22, 41, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 11:28:04', 0, NULL, '2026-11-08 07:56:04', '2026-11-08 07:56:04'),
(24, 1, 23, 42, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 11:31:04', 0, NULL, '2026-11-08 07:56:04', '2026-11-08 07:56:04'),
(25, 1, 24, 43, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 11:18:05', 0, NULL, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(26, 1, 25, 44, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 12:08:05', 0, NULL, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(27, 1, 26, 45, 'in', 1, 'Gate Utama Sabuga', 10, '2026-11-08 13:17:05', 0, NULL, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(28, 1, 1, 20, 'in', 0, 'Gate 1', NULL, '2026-11-08 15:22:46', 0, NULL, '2026-11-08 08:22:46', '2026-11-08 08:22:46'),
(29, 1, 1, 20, 'in', 0, 'Gate 1', NULL, '2026-11-08 15:29:09', 0, NULL, '2026-11-08 08:29:09', '2026-11-08 08:29:09'),
(30, 1, 1, 20, 'in', 0, 'Gate 1', NULL, '2026-11-08 15:29:49', 0, NULL, '2026-11-08 08:29:49', '2026-11-08 08:29:49'),
(31, 1, 1, 20, 'in', 0, 'Gate 1', NULL, '2026-11-08 15:29:50', 0, NULL, '2026-11-08 08:29:50', '2026-11-08 08:29:50'),
(32, 1, 27, 46, 'in', 1, 'Gate 1 - Main Entrance Sabuga', 1, '2026-11-13 11:04:27', 0, NULL, '2026-11-13 04:04:27', '2026-11-13 04:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `collaboration_needs`
--

CREATE TABLE `collaboration_needs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `target_partner_type` varchar(255) NOT NULL DEFAULT 'industry',
  `scope_of_work` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collaboration_needs`
--

INSERT INTO `collaboration_needs` (`id`, `organization_id`, `project_id`, `title`, `description`, `target_partner_type`, `scope_of_work`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Peluang Kolaborasi: AgriSense AI: Edge IoT & Computer Vision for Smart Paddy Monitoring', 'Membutuhkan kemitraan industri agritech untuk fabrikasi massal casing tahan cuaca ekstrem dan pendanaan uji lapangan multi-region.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 2, 'Peluang Kolaborasi: NeuroStroke: Portable AI Tele-rehabilitation & EMG Glove', 'Mencari mitra produsen alat kesehatan untuk uji sertifikasi Kemenkes dan kerjasama uji klinis fase lanjutan.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 2, 3, 'Peluang Kolaborasi: CitarumGuard: Smart Autonomous Drone & River Pollution Indexer', 'Mencari integrasi dengan Command Center Diskominfo Jabar dan sponsor pengadaan armada drone.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 2, 4, 'Peluang Kolaborasi: PasarLink: Blockchain Decentralized Micro-Finance for Traditional Merchants', 'Mencari kemitraan Bank BJB untuk penyaluran KUR mikro terintegrasi.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 3, 5, 'Peluang Kolaborasi: RoboTrash AI: Autonomous Indoor Sorting Robot with Robotic Arm', 'Kemitraan investor manufaktur mekanik dan uji coba di Stasiun Whoosh KCIC.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 3, 6, 'Peluang Kolaborasi: HeritageVR: Metaverse Budaya Sunda & Museum Virtual Angklung Udjo', 'Kerjasama Dinas Pariwisata dan Kebudayaan Jabar untuk pengadaan di 50 sekolah percontohan.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 4, 7, 'Peluang Kolaborasi: StuntingZero: AI Early Childhood Growth Predictor & Nutrition Guide', 'Adopsi resmi oleh Dinas Kesehatan Jabar dan sponsor pengadaan smartphone untuk kader posyandu.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 4, 8, 'Peluang Kolaborasi: GreenTrace: Life Cycle Assessment & Carbon Footprint for MSME Garment', 'Kerjasama dengan KADIN Jabar dan asosiasi ekspor produk tekstil.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 5, 9, 'Peluang Kolaborasi: AksaraAI: Interactive Sundanese Script Handwriting OCR & Adaptive Tutor', 'Integrasi ke Kurikulum Merdeka Disdik Jabar dan penerbit buku sekolah.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 5, 10, 'Peluang Kolaborasi: SimuLab AR: Low-Cost Augmented Reality Physics Experiment for Remote Schools', 'Distribusi gratis ke 100 sekolah daerah 3T dengan dukungan CSR BUMN.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 6, 11, 'Peluang Kolaborasi: SmartSolarMicrogrid: AI Peak-Shaving & Battery Optimization for Industry', 'Pilot project di pabrik kawasan industri KIIC Karawang.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 6, 12, 'Peluang Kolaborasi: MachinaVision: High-Speed Edge Defect Inspection for Conveyor Line', 'Kerjasama implementasi lini produksi pabrik Bio Farma atau Paragon.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 10, 13, 'Peluang Kolaborasi: SmartPoultry: Acoustic & Computer Vision Welfare Monitor for Broiler Chicken', 'Kemitraan integrasi sensor dengan pabrik pakan dan kandang percontohan Pemprov Jabar.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 10, 14, 'Peluang Kolaborasi: KopiTrace: AI Near-Infrared Bean Sorter & Origin Authentication for West Java Java Preanger', 'Mencari kemitraan asosiasi specialty coffee dan Dinas Perkebunan Jawa Barat.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 7, 15, 'Peluang Kolaborasi: StructuralHealth: Wireless LoRa Accelerometer Network for Heritage Buildings', 'Implementasi di Gedung Sate dan Gedung Indonesia Menggugat.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 7, 16, 'Peluang Kolaborasi: CivicVoice: NLP Sentiment Analysis for Public Policy Consultation Jabar', 'Adopsi di Jabar Digital Service Command Center.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 11, 17, 'Peluang Kolaborasi: LogisTrack AI: Smart Warehouse Pallet RFID & Autonomous Mobile Robot (AMR)', 'Kemitraan PT Pos Indonesia atau pergudangan e-commerce nasional.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 11, 18, 'Peluang Kolaborasi: PaddyYield: Satellite Multispectral Early Yield Forecasting for Karawang Granary', 'Kolaborasi dengan Perum BULOG dan BPS Jawa Barat.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 8, 19, 'Peluang Kolaborasi: Inovasi Smart City: Solusi Cerdas Universitas Pasundan (UNPAS) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 8, 20, 'Peluang Kolaborasi: Sistem AI/IoT Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Pasundan (UNPAS)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 9, 21, 'Peluang Kolaborasi: Inovasi Smart City: Solusi Cerdas Universitas Widyatama untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(22, 9, 22, 'Peluang Kolaborasi: Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Widyatama', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(23, 12, 23, 'Peluang Kolaborasi: Inovasi Smart City: Solusi Cerdas Universitas Siliwangi (UNSIL) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(24, 12, 24, 'Peluang Kolaborasi: Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Siliwangi (UNSIL)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(25, 13, 25, 'Peluang Kolaborasi: Inovasi Creative Media: Solusi Cerdas UIN Sunan Gunung Djati Bandung untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(26, 13, 26, 'Peluang Kolaborasi: Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus UIN Sunan Gunung Djati Bandung', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(27, 14, 27, 'Peluang Kolaborasi: Inovasi AI/IoT: Solusi Cerdas Universitas Kristen Maranatha untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(28, 14, 28, 'Peluang Kolaborasi: Sistem EdTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Kristen Maranatha', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(29, 15, 29, 'Peluang Kolaborasi: Inovasi AI/IoT: Solusi Cerdas Universitas Islam Bandung (UNISBA) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(30, 15, 30, 'Peluang Kolaborasi: Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Islam Bandung (UNISBA)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(31, 16, 31, 'Peluang Kolaborasi: Inovasi EdTech: Solusi Cerdas Universitas Swadaya Gunung Jati (UGJ) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(32, 16, 32, 'Peluang Kolaborasi: Sistem Smart City Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Swadaya Gunung Jati (UGJ)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(33, 17, 33, 'Peluang Kolaborasi: Inovasi Smart City: Solusi Cerdas Universitas Kuningan (UNIKU) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(34, 17, 34, 'Peluang Kolaborasi: Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Kuningan (UNIKU)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(35, 18, 35, 'Peluang Kolaborasi: Inovasi FinTech: Solusi Cerdas Universitas Majalengka (UNMA) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(36, 18, 36, 'Peluang Kolaborasi: Sistem AI/IoT Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Majalengka (UNMA)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(37, 19, 37, 'Peluang Kolaborasi: Inovasi Smart City: Solusi Cerdas Universitas Galuh (UNIGAL) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(38, 19, 38, 'Peluang Kolaborasi: Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Galuh (UNIGAL)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(39, 20, 39, 'Peluang Kolaborasi: Inovasi FinTech: Solusi Cerdas Politeknik Manufaktur Bandung (POLMAN) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(40, 20, 40, 'Peluang Kolaborasi: Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Politeknik Manufaktur Bandung (POLMAN)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(41, 21, 41, 'Peluang Kolaborasi: Inovasi HealthTech: Solusi Cerdas Politeknik Pos Indonesia (ULBI) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(42, 21, 42, 'Peluang Kolaborasi: Sistem FinTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Politeknik Pos Indonesia (ULBI)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(43, 22, 43, 'Peluang Kolaborasi: Inovasi FinTech: Solusi Cerdas STMIK AMIK Bandung untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(44, 22, 44, 'Peluang Kolaborasi: Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus STMIK AMIK Bandung', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(45, 23, 45, 'Peluang Kolaborasi: Inovasi EdTech: Solusi Cerdas STMIK IKMI Cirebon untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(46, 23, 46, 'Peluang Kolaborasi: Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus STMIK IKMI Cirebon', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(47, 24, 47, 'Peluang Kolaborasi: Inovasi HealthTech: Solusi Cerdas Universitas Pakuan Bogor untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(48, 24, 48, 'Peluang Kolaborasi: Sistem EdTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Pakuan Bogor', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(49, 25, 49, 'Peluang Kolaborasi: Inovasi EdTech: Solusi Cerdas Universitas Ibn Khaldun Bogor untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(50, 25, 50, 'Peluang Kolaborasi: Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Ibn Khaldun Bogor', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(51, 26, 51, 'Peluang Kolaborasi: Inovasi FinTech: Solusi Cerdas Universitas Presiden (President University) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(52, 26, 52, 'Peluang Kolaborasi: Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Presiden (President University)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(53, 27, 53, 'Peluang Kolaborasi: Inovasi HealthTech: Solusi Cerdas Universitas Djuanda Bogor untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(54, 27, 54, 'Peluang Kolaborasi: Sistem Smart City Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Djuanda Bogor', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(55, 28, 55, 'Peluang Kolaborasi: Inovasi Smart City: Solusi Cerdas Universitas Muhammadiyah Sukabumi (UMMI) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(56, 28, 56, 'Peluang Kolaborasi: Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Muhammadiyah Sukabumi (UMMI)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(57, 29, 57, 'Peluang Kolaborasi: Inovasi FinTech: Solusi Cerdas Universitas Subang (UNSUB) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(58, 29, 58, 'Peluang Kolaborasi: Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Subang (UNSUB)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(59, 30, 59, 'Peluang Kolaborasi: Inovasi AI/IoT: Solusi Cerdas Universitas Garut (UNIGA) untuk Kemandirian Daerah', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(60, 30, 60, 'Peluang Kolaborasi: Sistem FinTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Garut (UNIGA)', 'Pendanaan riset lanjutan dan pilot study.', 'industry', 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk', '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `company_profiles`
--

CREATE TABLE `company_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `profile_summary` text DEFAULT NULL,
  `solutions_offered` text DEFAULT NULL,
  `collaboration_needs` text DEFAULT NULL,
  `is_exhibitor` tinyint(1) NOT NULL DEFAULT 1,
  `is_sponsor` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_profiles`
--

INSERT INTO `company_profiles` (`id`, `organization_id`, `sector`, `profile_summary`, `solutions_offered`, `collaboration_needs`, `is_exhibitor`, `is_sponsor`, `created_at`, `updated_at`) VALUES
(1, 31, 'Telekomunikasi & Cloud', 'Pemimpin ekosistem industri Telekomunikasi & Cloud yang berkomitmen menyerap talenta dan inovasi kampus Jawa Barat.', 'Infrastruktur Cloud, API Gateway, Program Inkubasi, Co-Development, Pilot Project Implementation.', 'Teknologi AI/ML Computer Vision, Solusi IoT Terintegrasi, Automasi Bisnis, dan Talenta Digital Siap Pakai.', 1, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 32, 'Perbankan & Financial Technology', 'Pemimpin ekosistem industri Perbankan & Financial Technology yang berkomitmen menyerap talenta dan inovasi kampus Jawa Barat.', 'Infrastruktur Cloud, API Gateway, Program Inkubasi, Co-Development, Pilot Project Implementation.', 'Teknologi AI/ML Computer Vision, Solusi IoT Terintegrasi, Automasi Bisnis, dan Talenta Digital Siap Pakai.', 1, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 33, 'Consumer Goods & IoT Supply Chain', 'Pemimpin ekosistem industri Consumer Goods & IoT Supply Chain yang berkomitmen menyerap talenta dan inovasi kampus Jawa Barat.', 'Infrastruktur Cloud, API Gateway, Program Inkubasi, Co-Development, Pilot Project Implementation.', 'Teknologi AI/ML Computer Vision, Solusi IoT Terintegrasi, Automasi Bisnis, dan Talenta Digital Siap Pakai.', 1, 0, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 34, 'Logistik Digital & Smart Delivery', 'Pemimpin ekosistem industri Logistik Digital & Smart Delivery yang berkomitmen menyerap talenta dan inovasi kampus Jawa Barat.', 'Infrastruktur Cloud, API Gateway, Program Inkubasi, Co-Development, Pilot Project Implementation.', 'Teknologi AI/ML Computer Vision, Solusi IoT Terintegrasi, Automasi Bisnis, dan Talenta Digital Siap Pakai.', 1, 0, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 35, 'Elektronika Pertahanan & Smart Transportation', 'Pemimpin ekosistem industri Elektronika Pertahanan & Smart Transportation yang berkomitmen menyerap talenta dan inovasi kampus Jawa Barat.', 'Infrastruktur Cloud, API Gateway, Program Inkubasi, Co-Development, Pilot Project Implementation.', 'Teknologi AI/ML Computer Vision, Solusi IoT Terintegrasi, Automasi Bisnis, dan Talenta Digital Siap Pakai.', 1, 0, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 36, 'Healthcare Biotech & Digital Health', 'Pemimpin ekosistem industri Healthcare Biotech & Digital Health yang berkomitmen menyerap talenta dan inovasi kampus Jawa Barat.', 'Infrastruktur Cloud, API Gateway, Program Inkubasi, Co-Development, Pilot Project Implementation.', 'Teknologi AI/ML Computer Vision, Solusi IoT Terintegrasi, Automasi Bisnis, dan Talenta Digital Siap Pakai.', 1, 0, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 37, 'EdTech & Software Developer Platform', 'Pemimpin ekosistem industri EdTech & Software Developer Platform yang berkomitmen menyerap talenta dan inovasi kampus Jawa Barat.', 'Infrastruktur Cloud, API Gateway, Program Inkubasi, Co-Development, Pilot Project Implementation.', 'Teknologi AI/ML Computer Vision, Solusi IoT Terintegrasi, Automasi Bisnis, dan Talenta Digital Siap Pakai.', 1, 0, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 38, 'AgriTech & Aquaculture IoT', 'Pemimpin ekosistem industri AgriTech & Aquaculture IoT yang berkomitmen menyerap talenta dan inovasi kampus Jawa Barat.', 'Infrastruktur Cloud, API Gateway, Program Inkubasi, Co-Development, Pilot Project Implementation.', 'Teknologi AI/ML Computer Vision, Solusi IoT Terintegrasi, Automasi Bisnis, dan Talenta Digital Siap Pakai.', 1, 0, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 39, 'Game Development & Interactive VR', 'Pemimpin ekosistem industri Game Development & Interactive VR yang berkomitmen menyerap talenta dan inovasi kampus Jawa Barat.', 'Infrastruktur Cloud, API Gateway, Program Inkubasi, Co-Development, Pilot Project Implementation.', 'Teknologi AI/ML Computer Vision, Solusi IoT Terintegrasi, Automasi Bisnis, dan Talenta Digital Siap Pakai.', 1, 0, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 40, 'Government Tech & Smart Province', 'Pemimpin ekosistem industri Government Tech & Smart Province yang berkomitmen menyerap talenta dan inovasi kampus Jawa Barat.', 'Infrastruktur Cloud, API Gateway, Program Inkubasi, Co-Development, Pilot Project Implementation.', 'Teknologi AI/ML Computer Vision, Solusi IoT Terintegrasi, Automasi Bisnis, dan Talenta Digital Siap Pakai.', 1, 0, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 48, NULL, NULL, NULL, NULL, 1, 1, '2026-11-13 06:54:23', '2026-11-13 06:54:23'),
(12, 49, NULL, NULL, NULL, NULL, 1, 0, '2026-11-13 07:30:01', '2026-11-13 07:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rubric_version_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `weight_percent` decimal(5,2) NOT NULL,
  `max_scale` int(11) NOT NULL DEFAULT 5,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`id`, `rubric_version_id`, `code`, `name`, `description`, `weight_percent`, `max_scale`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'C1', 'Relevansi Masalah', 'Ketajaman analisis masalah nyata di Jawa Barat / Indonesia dan validasi pengguna sasaran.', 25.00, 5, 1, '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(2, 1, 'C2', 'Fungsi Prototipe', 'Kelayakan, keandalan fungsional, dan stabilitas fitur sistem/aplikasi yang didemokan.', 25.00, 5, 2, '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(3, 1, 'C3', 'Kebaruan Solusi', 'Unsur orisinalitas, diferensiasi dari produk sejenis, dan inovasi pendekatan teknologi.', 20.00, 5, 3, '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(4, 1, 'C4', 'Potensi Dampak', 'Kelayakan adopsi industri/masyarakat, skalabilitas bisnis, dan dampak sosial-ekonomi.', 20.00, 5, 4, '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(5, 1, 'C5', 'Komunikasi dan Demo', 'Kejelasan pemaparan, respon tanya jawab tim, serta kualitas demonstrasi langsung.', 10.00, 5, 5, '2026-11-08 07:55:52', '2026-11-08 07:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'panduan',
  `file_path` varchar(255) NOT NULL,
  `file_size_kb` int(11) NOT NULL DEFAULT 0,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `download_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `event_id`, `title`, `category`, `file_path`, `file_size_kb`, `is_public`, `download_count`, `created_at`, `updated_at`) VALUES
(1, 1, 'Buku Panduan Teknis Exhibitor & Peserta Kampus FUTURiSE 2026', 'panduan', '/documents/buku-panduan-peserta-futurise-2026.pdf', 2450, 1, 142, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(2, 1, 'Paket Proposal Sponsorship FUTURiSE 2026 (APTIKOM Jawa Barat)', 'template', '/documents/proposal-sponsorship-futurise-2026.pdf', 4820, 1, 89, '2026-11-08 07:56:05', '2026-11-08 07:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `edition` varchar(255) NOT NULL DEFAULT '2026',
  `theme` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `venue_name` varchar(255) DEFAULT NULL,
  `venue_address` text DEFAULT NULL,
  `city` varchar(255) NOT NULL DEFAULT 'Bandung',
  `quota_campus` int(11) NOT NULL DEFAULT 30,
  `quota_projects_per_campus` int(11) NOT NULL DEFAULT 2,
  `quota_industry` int(11) NOT NULL DEFAULT 10,
  `quota_partner` int(11) NOT NULL DEFAULT 5,
  `target_pitching_finalists` int(11) NOT NULL DEFAULT 10,
  `target_collaboration_meetings` int(11) NOT NULL DEFAULT 30,
  `target_visitors` int(11) NOT NULL DEFAULT 1000,
  `target_h30_followups` int(11) NOT NULL DEFAULT 10,
  `target_satisfaction_rate` decimal(5,2) NOT NULL DEFAULT 85.00,
  `min_survey_responses` int(11) NOT NULL DEFAULT 200,
  `registration_deadline` datetime DEFAULT NULL,
  `voting_start_at` datetime DEFAULT NULL,
  `voting_end_at` datetime DEFAULT NULL,
  `is_date_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `is_results_published` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `slug`, `edition`, `theme`, `start_date`, `end_date`, `venue_name`, `venue_address`, `city`, `quota_campus`, `quota_projects_per_campus`, `quota_industry`, `quota_partner`, `target_pitching_finalists`, `target_collaboration_meetings`, `target_visitors`, `target_h30_followups`, `target_satisfaction_rate`, `min_survey_responses`, `registration_deadline`, `voting_start_at`, `voting_end_at`, `is_date_confirmed`, `is_results_published`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'FUTURiSE 2026 - West Java Digital Innovation Festival', 'futurise-2026', '2026', 'Bridging Higher Education Innovation with Industry & Society in West Java', '2026-11-12', '2026-11-14', 'Venue TBA (To Be Announced)', 'Jl. Tamansari No. 73, Lebak Siliwangi, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132', 'Bandung', 30, 2, 10, 5, 10, 30, 1000, 10, 85.00, 200, '2026-11-15 14:55:52', '2026-11-12 08:55:00', '2026-11-14 16:55:00', 1, 0, 1, '2026-11-08 07:55:52', '2026-11-13 05:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `event_sessions`
--

CREATE TABLE `event_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` enum('keynote','panel','pitching','workshop','tour','networking','awarding') NOT NULL DEFAULT 'panel',
  `stage_or_room` varchar(255) NOT NULL DEFAULT 'Main Stage',
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_sessions`
--

INSERT INTO `event_sessions` (`id`, `event_id`, `title`, `slug`, `type`, `stage_or_room`, `start_time`, `end_time`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Grand Opening & Keynote Tech Leaders: Masa Depan Inovasi Digital Jabar', 'grand-opening-keynote', 'keynote', 'Main Stage Sabuga', '2026-11-22 08:30:58', '2026-11-22 10:30:58', 'Pembukaan resmi oleh Ketua APTIKOM Pusat, Pj Gubernur Jawa Barat, dan Rektor ITB dilanjutkan keynote speech pimpinan industri teknologi.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 'Digital Innovation Showcase: 60 Karya Mahasiswa Kampus Jawa Barat', 'digital-innovation-showcase', 'workshop', 'Zona Booth Hall Utama (Booth B-01 s/d B-30)', '2026-11-22 10:30:58', '2026-11-23 16:00:58', 'Pameran terbuka 60 karya teknologi inovatif mahasiswa 30 perguruan tinggi se-Jawa Barat. Pengunjung dapat mencoba langsung prototipe dan memberikan feedback serta vote.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 'West Java Pitching Arena: Presentasi 10 Finalis di Depan Investor & Industri', 'west-java-pitching-arena', 'pitching', 'Main Stage Sabuga', '2026-11-22 13:30:58', '2026-11-22 16:30:58', 'Kompetisi presentasi 10 tim mahasiswa terbaik di hadapan dewan juri ahli dan perwakilan modal ventura (VC/Angel Investor).', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 1, 'Business & Technology Matchmaking (Pertemuan Kolaborasi Meja)', 'business-technology-matchmaking', 'networking', 'Collaboration Lounge Meja 1 - 10', '2026-11-22 11:00:58', '2026-11-23 15:00:58', 'Sesi tatap muka one-on-one terjadwal antara perwakilan kampus/tim inovator dengan industri dan instansi pemerintah guna menjajaki kemitraan hilirisasi.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 1, 'School Tech Tour: Kunjungan Edukasi Siswa SMK/SMA se-Jawa Barat', 'school-tech-tour', 'tour', 'Hall Sabuga & Guided Booth Tour', '2026-11-22 09:00:58', '2026-11-23 14:00:58', 'Tur terjadwal dengan pemandu khusus bagi rombongan sekolah untuk memperkenalkan teknologi mutakhir kampus dan prospek karir di era digital.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 1, 'Panel Discussion: AI Governance & Link-and-Match Kurikulum Pendidikan Tinggi', 'panel-discussion-aptikom', 'panel', 'Auditorium Lantai 2 Sabuga', '2026-11-23 09:30:58', '2026-11-23 12:00:58', 'Diskusi strategis pimpinan prodi informatika dan pelaku industri seputar integrasi GenAI dalam kurikulum dan standar kompetensi kerja nasional.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 1, 'Awarding Ceremony & Closing: Pengumuman Juara Karya, People Choice & Doorprize', 'awarding-closing-ceremony', 'awarding', 'Main Stage Sabuga', '2026-11-23 15:30:58', '2026-11-23 17:30:58', 'Pemberian penghargaan Karya Terbaik Kategori Juri, Pemenang Pitching Arena, dan Juara Favorit Pengunjung (People\'s Choice Award).', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `event_settings`
--

CREATE TABLE `event_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'string',
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_settings`
--

INSERT INTO `event_settings` (`id`, `event_id`, `key`, `value`, `type`, `group`, `created_at`, `updated_at`) VALUES
(1, 1, 'organizer_name', 'APTIKOM Wilayah IV Jawa Barat', 'string', 'general', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(2, 1, 'organizer_email', 'sekretariat@aptikom-jabar.id', 'string', 'general', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(3, 1, 'organizer_phone', '+62 22 2504444', 'string', 'general', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(4, 1, 'bank_name', 'Bank BJB Cabang Utama Bandung', 'string', 'finance', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(5, 1, 'bank_account_number', '001-2345678-001', 'string', 'finance', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(6, 1, 'bank_account_name', 'APTIKOM JABAR EVENT FESTIVAL', 'string', 'finance', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(7, 1, 'registration_fee_campus', '1500000', 'string', 'finance', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(8, 1, 'registration_fee_industry', '5000000', 'string', 'finance', '2026-11-08 07:55:52', '2026-11-08 07:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `expense_date` date NOT NULL,
  `receipt_file` varchar(255) DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `event_id`, `category`, `description`, `amount`, `expense_date`, `receipt_file`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'venue', 'Sewa Gedung Sabuga ITB (Hall Utama, Panggung, Ruang VIP, Meja & Kursi)', 35000000.00, '2026-11-06', NULL, 4, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 'production', 'Pemasangan Booth Partisi Standar 45 Unit & Karpet Hall', 18000000.00, '2026-11-06', NULL, 4, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 'marketing', 'Pencetakan Backdrop, Spanduk Bandung Raya, Id Card & Buku Panduan', 6500000.00, '2026-11-06', NULL, 4, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 1, 'consumption', 'Katering Makan Siang & Coffee Break Juri, Panitia, dan VIP 2 Hari', 8500000.00, '2026-11-06', NULL, 4, '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Umum',
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `sort_order`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'Umum', 'Apa itu FUTURiSE 2026?', 'FUTURiSE (West Java Digital Innovation Festival) adalah ajang pameran dan kolaborasi tahunan yang diselenggarakan oleh APTIKOM Jawa Barat, mempertemukan 30 kampus, 60 karya teknologi inovatif mahasiswa, puluhan industri terkemuka, dan ribuan pengunjung.', 1, 1, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(2, 'Pendaftaran', 'Apakah pengunjung umum dipungut biaya tiket masuk?', 'Tidak. Pendaftaran tiket pengunjung umum adalah GRATIS dengan melakukan registrasi online di website ini untuk mendapatkan E-Ticket QR Code resmi.', 2, 1, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(3, 'Booth', 'Berapa karya yang dapat ditampilkan dalam satu booth kampus?', 'Sesuai aturan bisnis BR-03, setiap booth kampus berukuran 3x3 meter memfasilitasi maksimal 2 karya mahasiswa terpilih yang masing-masing dinilai dan dipublikasikan secara independen.', 3, 1, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(4, 'Penjurian', 'Apa saja kriteria penilaian karya inovasi mahasiswa?', 'Penjurian mengacu pada 5 indikator standar APTIKOM Jabar: Relevansi Masalah (25%), Fungsi Prototipe (25%), Kebaruan Solusi (20%), Potensi Dampak (20%), serta Komunikasi dan Demo (10%).', 4, 1, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(5, 'Kolaborasi', 'Bagaimana industri dapat menjadwalkan pertemuan kolaborasi dengan kampus?', 'Perwakilan industri yang telah terverifikasi dapat masuk ke Portal Industri dan memilih karya di menu Direktori / Showcase, lalu menekan tombol \"Ajukan Pertemuan Meja Kolaborasi\" pada slot waktu yang tersedia.', 5, 1, '2026-11-08 07:56:05', '2026-11-08 07:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `follow_ups`
--

CREATE TABLE `follow_ups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `pic_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `action_plan` text NOT NULL,
  `deadline_h30` date NOT NULL,
  `status` enum('open','in_progress','completed','overdue') NOT NULL DEFAULT 'open',
  `result_summary` text DEFAULT NULL,
  `h30_notes` text DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follow_ups`
--

INSERT INTO `follow_ups` (`id`, `event_id`, `meeting_id`, `project_id`, `organization_id`, `pic_user_id`, `title`, `action_plan`, `deadline_h30`, `status`, `result_summary`, `h30_notes`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 13, 'Penyusunan Perjanjian Kerjasama (PKS) Uji Coba AgriSense & Telkom Antares', '1. Pengiriman spesifikasi API Antares. 2. Integrasi firmware ESP32. 3. Penandatanganan MoU uji 10 titik sawah.', '2026-12-08', 'in_progress', 'Draf dokumen teknis integrasi telah dikirimkan ke tim Engineering Telkom.', 'Target selesai penandatanganan minggu ke-3 pasca festival.', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 2, 5, 3, 16, 'Pengiriman Proposal ESG Penempatan RoboTrash AI di Kantor Pusat BJB', 'Kirimkan rincian anggaran sewa dan maintenance unit robot ke bagian Umum BJB.', '2026-11-28', 'open', NULL, 'PIC BJB: Bpk. Aditya bagian General Affairs.', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `due_date` date NOT NULL,
  `status` enum('unpaid','partially_paid','paid','cancelled') NOT NULL DEFAULT 'unpaid',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `event_id`, `organization_id`, `invoice_number`, `subtotal`, `discount`, `tax`, `total_amount`, `due_date`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 32, 'INV/2026/10/001', 50000000.00, 0.00, 5500000.00, 55500000.00, '2026-11-13', 'paid', 'Tagihan Sponsorship Platinum FUTURiSE 2026 Bank BJB', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 48, 'INV/2026/261113/7DC014', 20000000.00, 0.00, 0.00, 20000000.00, '2026-11-14', 'paid', '-', '2026-11-13 07:26:33', '2026-11-13 07:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `description`, `quantity`, `unit_price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Paket Platinum Sponsorship FUTURiSE 2026', 1, 50000000.00, 50000000.00, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 2, 'paket sponsorship platinum', 1, 20000000.00, 20000000.00, '2026-11-13 07:26:33', '2026-11-13 07:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `in_kind_contributions`
--

CREATE TABLE `in_kind_contributions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agreement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `estimated_value` decimal(15,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit` varchar(255) NOT NULL DEFAULT 'unit',
  `description` text DEFAULT NULL,
  `delivery_status` enum('pledged','delivered','verified') NOT NULL DEFAULT 'pledged',
  `received_at` datetime DEFAULT NULL,
  `receiver_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `in_kind_contributions`
--

INSERT INTO `in_kind_contributions` (`id`, `agreement_id`, `organization_id`, `item_name`, `estimated_value`, `quantity`, `unit`, `description`, `delivery_status`, `received_at`, `receiver_name`, `created_at`, `updated_at`) VALUES
(1, 2, 31, 'Dedicated High-Speed Fiber Internet 1 Gbps & Wi-Fi 6 Access Points', 20000000.00, 1, 'Paket Event 2 Hari', 'Penyediaan jaringan internet tanpa hambatan untuk 1.000 pengunjung dan 45 booth', 'verified', '2026-11-07 14:55:58', 'Koordinator Venue & Teknis Sabuga', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 2, 31, 'Cloud Hosting Credits Telkom Cloud untuk 10 Finalis Pitching', 15000000.00, 10, 'Voucher Akun', 'Paket cloud hosting masing-masing Rp 1.500.000 untuk inkubasi pasca-event', 'pledged', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `judge_assignments`
--

CREATE TABLE `judge_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `has_conflict_of_interest` tinyint(1) NOT NULL DEFAULT 0,
  `conflict_declaration_notes` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `judge_assignments`
--

INSERT INTO `judge_assignments` (`id`, `event_id`, `user_id`, `project_id`, `has_conflict_of_interest`, `conflict_declaration_notes`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 1, 0, 'Tidak memiliki afiliasi keluarga atau finansial dengan tim pengusul.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 12, 1, 0, 'Bebas dari konflik kepentingan.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 11, 2, 0, 'Tidak memiliki afiliasi keluarga atau finansial dengan tim pengusul.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 1, 12, 2, 0, 'Bebas dari konflik kepentingan.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 1, 11, 3, 0, 'Tidak memiliki afiliasi keluarga atau finansial dengan tim pengusul.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 1, 12, 3, 0, 'Bebas dari konflik kepentingan.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 1, 11, 4, 0, 'Tidak memiliki afiliasi keluarga atau finansial dengan tim pengusul.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 1, 12, 4, 0, 'Bebas dari konflik kepentingan.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 1, 11, 5, 0, 'Tidak memiliki afiliasi keluarga atau finansial dengan tim pengusul.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 1, 12, 5, 0, 'Bebas dari konflik kepentingan.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 1, 11, 6, 0, 'Tidak memiliki afiliasi keluarga atau finansial dengan tim pengusul.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 1, 12, 6, 0, 'Bebas dari konflik kepentingan.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 1, 11, 7, 0, 'Tidak memiliki afiliasi keluarga atau finansial dengan tim pengusul.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 1, 12, 7, 0, 'Bebas dari konflik kepentingan.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 1, 11, 8, 0, 'Tidak memiliki afiliasi keluarga atau finansial dengan tim pengusul.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 1, 12, 8, 0, 'Bebas dari konflik kepentingan.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 1, 11, 9, 0, 'Tidak memiliki afiliasi keluarga atau finansial dengan tim pengusul.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 1, 12, 9, 0, 'Bebas dari konflik kepentingan.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 1, 11, 10, 0, 'Tidak memiliki afiliasi keluarga atau finansial dengan tim pengusul.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 1, 12, 10, 0, 'Bebas dari konflik kepentingan.', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 1, 11, 16, 0, NULL, 1, '2026-11-13 06:30:05', '2026-11-13 06:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `requester_org_id` bigint(20) UNSIGNED NOT NULL,
  `target_org_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `table_number` varchar(255) NOT NULL DEFAULT 'Meja Kolaborasi 1',
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `agenda_topic` varchar(255) NOT NULL,
  `status` enum('requested','confirmed','rescheduled','completed','cancelled') NOT NULL DEFAULT 'requested',
  `discussion_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `event_id`, `requester_org_id`, `target_org_id`, `project_id`, `table_number`, `start_time`, `end_time`, `agenda_topic`, `status`, `discussion_notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 31, 1, 'Meja Kolaborasi 1', '2026-11-22 11:00:58', '2026-11-22 11:45:58', 'Diskusi Pilot Project AgriSense AI pada Lahan Binaan CSR Telkom di Jawa Barat', 'confirmed', 'Pihak Telkom tertarik memasukkan sensor AgriSense ke platform Antares IoT.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 3, 32, 5, 'Meja Kolaborasi 2', '2026-11-22 14:00:58', '2026-11-22 14:45:58', 'Penempatan Robot Pemilah Sampah Cerdas di Kantor Pusat Menara Bank BJB', 'confirmed', 'Bank BJB mendukung inisiatif Green Banking & ESG.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 49, 1, NULL, 'Meja Kolaborasi 1', '2026-11-13 21:36:00', '2026-11-14 21:36:00', 'Meeting Persiapan Kegiatan XYZ', 'confirmed', NULL, '2026-11-13 07:37:01', '2026-11-13 07:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_participants`
--

CREATE TABLE `meeting_participants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'participant',
  `status` enum('invited','confirmed','declined') NOT NULL DEFAULT 'invited',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_participants`
--

INSERT INTO `meeting_participants` (`id`, `meeting_id`, `user_id`, `organization_id`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 1, 'host', 'confirmed', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 17, 31, 'invitee', 'confirmed', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 3, NULL, 49, 'host', 'confirmed', '2026-11-13 07:37:01', '2026-11-13 07:37:29'),
(4, 3, NULL, 1, 'invitee', 'confirmed', '2026-11-13 07:37:01', '2026-11-13 07:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_11_08_000001_create_events_and_core_tables', 1),
(5, '2026_11_08_000002_create_organizations_and_registrations_tables', 1),
(6, '2026_11_08_000003_create_booths_and_projects_tables', 1),
(7, '2026_11_08_000004_create_programs_and_collaborations_tables', 1),
(8, '2026_11_08_000005_create_sponsorship_and_finances_tables', 1),
(9, '2026_11_08_000006_create_judging_voting_and_surveys_tables', 1),
(10, '2026_11_08_000007_create_ticketing_and_operational_tables', 1),
(11, '2026_11_13_000001_add_document_fields_to_news_table', 2),
(12, '2026_11_13_000001_add_unique_survey_response_per_ticket', 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Pengumuman',
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `event_id`, `title`, `slug`, `category`, `excerpt`, `content`, `cover_image`, `document_path`, `document_name`, `is_published`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'APTIKOM Jabar Umumkan 60 Karya Inovasi Digital Mahasiswa Lolos Kurasi FUTURiSE 2026', 'pengumuman-60-karya-lolos-kurasi-futurise-2026', 'Kurasi', 'Sebanyak 60 karya dari 30 perguruan tinggi se-Jawa Barat berhasil melewati tahap kurasi ketat dan siap dipamerkan di Sabuga ITB.', 'Bandung, APTIKOM Jawa Barat resmi merilis daftar 60 karya teknologi inovatif mahasiswa yang lolos tahap kurasi untuk berlaga pada festival FUTURiSE 2026. Dari total ratusan proposal yang masuk, dewan kurator menetapkan 60 karya unggulan yang terbagi dalam bidang AI/IoT, Smart City, FinTech, EdTech, HealthTech, dan Creative Media. 10 tim di antaranya juga terpilih sebagai finalis Pitching Arena di hadapan pimpinan industri dan investor modal ventura.', '/images/news/kurasi-announcement.jpg', NULL, NULL, 1, '2026-11-06 14:56:05', '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(2, 1, 'Panduan Akses & Denah Booth Sabuga ITB untuk Peserta dan Pengunjung', 'panduan-akses-dan-denah-sabuga-itb', 'Informasi', 'Informasi lengkap pintu masuk, fasilitas parkir, peta pembagian zona 45 booth, dan akses transportasi umum menuju venue.', 'Panitia pelaksana mengimbau seluruh exhibitor dan pengunjung untuk memperhatikan akses masuk Sasana Budaya Ganesha (Sabuga) ITB. Pintu gerbang dibuka mulai pukul 08.00 WIB. E-Ticket QR Code harus ditunjukkan di meja registrasi gate utama untuk ditukar dengan lanyard ID resmi dan hak voting People\'s Choice Award.', '/images/news/venue-guide.jpg', NULL, NULL, 1, '2026-11-07 14:56:05', '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(3, 1, 'FUTURISE', 'futurise', 'Dokumentasi', 'CMS, katalog publik, media, sponsor publik dan dokumentasi.', 'CMS, katalog publik, media, sponsor publik dan dokumentasi.', 'news/covers/7VWytgTFoN1E9d5KmmrXxUAdowjZwA8gVlHccSle.jpg', NULL, NULL, 1, '2026-11-13 16:38:12', '2026-11-13 09:38:12', '2026-11-13 09:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `action_url` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('campus','industry','partner','sponsor','school') NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `pic_name` varchar(255) NOT NULL,
  `pic_position` varchar(255) DEFAULT NULL,
  `pic_email` varchar(255) NOT NULL,
  `pic_phone` varchar(255) DEFAULT NULL,
  `pic_contact_public` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('draft','pending_verification','verified','rejected') NOT NULL DEFAULT 'pending_verification',
  `verification_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `event_id`, `type`, `name`, `slug`, `address`, `city`, `website`, `logo`, `pic_name`, `pic_position`, `pic_email`, `pic_phone`, `pic_contact_public`, `status`, `verification_notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'campus', 'Institut Teknologi Bandung (ITB)', 'institut-teknologi-bandung-itb', 'Kampus Institut Teknologi Bandung (ITB), Bandung, Jawa Barat', 'Bandung', 'https://institut-teknologi-bandung-itb.ac.id', NULL, 'Dr. Eng. Ayu Wulandari', 'Ketua Jurusan / Dosen Pendamping', 'kampus@itb.ac.id', '081266239002', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 'campus', 'Telkom University (Tel-U)', 'telkom-university-tel-u', 'Kampus Telkom University (Tel-U), Bandung, Jawa Barat', 'Bandung', 'https://telkom-university-tel-u.ac.id', NULL, 'Dr. Bambang Setiawan, M.T.', 'Ketua Jurusan / Dosen Pendamping', 'kampus@telkomuniversity.ac.id', '081241185936', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 'campus', 'Universitas Komputer Indonesia (UNIKOM)', 'universitas-komputer-indonesia-unikom', 'Kampus Universitas Komputer Indonesia (UNIKOM), Bandung, Jawa Barat', 'Bandung', 'https://universitas-komputer-indonesia-unikom.ac.id', NULL, 'Dr. Ir. Bobi Kurniawan', 'Ketua Jurusan / Dosen Pendamping', 'kampus@unikom.ac.id', '081248651366', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 1, 'campus', 'Universitas Padjadjaran (UNPAD)', 'universitas-padjadjaran-unpad', 'Kampus Universitas Padjadjaran (UNPAD), Jatinangor, Jawa Barat', 'Jatinangor', 'https://universitas-padjadjaran-unpad.ac.id', NULL, 'Dr. Candra Wijaya', 'Ketua Jurusan / Dosen Pendamping', 'pic@unpad.ac.id', '081254122895', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 1, 'campus', 'Universitas Pendidikan Indonesia (UPI)', 'universitas-pendidikan-indonesia-upi', 'Kampus Universitas Pendidikan Indonesia (UPI), Bandung, Jawa Barat', 'Bandung', 'https://universitas-pendidikan-indonesia-upi.ac.id', NULL, 'Dr. Dedi Rosadi', 'Ketua Jurusan / Dosen Pendamping', 'pic@upi.edu', '081240432987', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 1, 'campus', 'Politeknik Negeri Bandung (POLBAN)', 'politeknik-negeri-bandung-polban', 'Kampus Politeknik Negeri Bandung (POLBAN), Bandung Barat, Jawa Barat', 'Bandung Barat', 'https://politeknik-negeri-bandung-polban.ac.id', NULL, 'Ir. Eko Purwanto', 'Ketua Jurusan / Dosen Pendamping', 'pic@polban.ac.id', '081214487097', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 1, 'campus', 'Universitas Katolik Parahyangan (UNPAR)', 'universitas-katolik-parahyangan-unpar', 'Kampus Universitas Katolik Parahyangan (UNPAR), Bandung, Jawa Barat', 'Bandung', 'https://universitas-katolik-parahyangan-unpar.ac.id', NULL, 'Ferryanto, M.Sc.', 'Ketua Jurusan / Dosen Pendamping', 'pic@unpar.ac.id', '081254280168', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 1, 'campus', 'Universitas Pasundan (UNPAS)', 'universitas-pasundan-unpas', 'Kampus Universitas Pasundan (UNPAS), Bandung, Jawa Barat', 'Bandung', 'https://universitas-pasundan-unpas.ac.id', NULL, 'Dr. Gilang Ramadhan', 'Ketua Jurusan / Dosen Pendamping', 'pic@unpas.ac.id', '081275225939', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 1, 'campus', 'Universitas Widyatama', 'universitas-widyatama', 'Kampus Universitas Widyatama, Bandung, Jawa Barat', 'Bandung', 'https://universitas-widyatama.ac.id', NULL, 'Hadi Sucipto, M.Kom.', 'Ketua Jurusan / Dosen Pendamping', 'pic@widyatama.ac.id', '081256848692', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 1, 'campus', 'Institut Pertanian Bogor (IPB University)', 'institut-pertanian-bogor-ipb-university', 'Kampus Institut Pertanian Bogor (IPB University), Bogor, Jawa Barat', 'Bogor', 'https://institut-pertanian-bogor-ipb-university.ac.id', NULL, 'Prof. Dr. Irfan Syarif', 'Ketua Jurusan / Dosen Pendamping', 'pic@ipb.ac.id', '081277890468', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 1, 'campus', 'Universitas Singaperbangsa Karawang (UNSIKA)', 'universitas-singaperbangsa-karawang-unsika', 'Kampus Universitas Singaperbangsa Karawang (UNSIKA), Karawang, Jawa Barat', 'Karawang', 'https://universitas-singaperbangsa-karawang-unsika.ac.id', NULL, 'Joko Triyono, M.T.', 'Ketua Jurusan / Dosen Pendamping', 'pic@unsika.ac.id', '081236536618', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 1, 'campus', 'Universitas Siliwangi (UNSIL)', 'universitas-siliwangi-unsil', 'Kampus Universitas Siliwangi (UNSIL), Tasikmalaya, Jawa Barat', 'Tasikmalaya', 'https://universitas-siliwangi-unsil.ac.id', NULL, 'Kusnadi, M.Kom.', 'Ketua Jurusan / Dosen Pendamping', 'pic@unsil.ac.id', '081286084929', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 1, 'campus', 'UIN Sunan Gunung Djati Bandung', 'uin-sunan-gunung-djati-bandung', 'Kampus UIN Sunan Gunung Djati Bandung, Bandung, Jawa Barat', 'Bandung', 'https://uin-sunan-gunung-djati-bandung.ac.id', NULL, 'Dr. Lukman Hakim', 'Ketua Jurusan / Dosen Pendamping', 'pic@uinsgd.ac.id', '081276210842', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 1, 'campus', 'Universitas Kristen Maranatha', 'universitas-kristen-maranatha', 'Kampus Universitas Kristen Maranatha, Bandung, Jawa Barat', 'Bandung', 'https://universitas-kristen-maranatha.ac.id', NULL, 'Maria Kristina, M.T.', 'Ketua Jurusan / Dosen Pendamping', 'pic@maranatha.edu', '081267903270', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 1, 'campus', 'Universitas Islam Bandung (UNISBA)', 'universitas-islam-bandung-unisba', 'Kampus Universitas Islam Bandung (UNISBA), Bandung, Jawa Barat', 'Bandung', 'https://universitas-islam-bandung-unisba.ac.id', NULL, 'Nurul Huda, M.Kom.', 'Ketua Jurusan / Dosen Pendamping', 'pic@unisba.ac.id', '081223569013', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 1, 'campus', 'Universitas Swadaya Gunung Jati (UGJ)', 'universitas-swadaya-gunung-jati-ugj', 'Kampus Universitas Swadaya Gunung Jati (UGJ), Cirebon, Jawa Barat', 'Cirebon', 'https://universitas-swadaya-gunung-jati-ugj.ac.id', NULL, 'Oman Fathurohman', 'Ketua Jurusan / Dosen Pendamping', 'pic@ugj.ac.id', '081257012690', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 1, 'campus', 'Universitas Kuningan (UNIKU)', 'universitas-kuningan-uniku', 'Kampus Universitas Kuningan (UNIKU), Kuningan, Jawa Barat', 'Kuningan', 'https://universitas-kuningan-uniku.ac.id', NULL, 'Panji Nugraha, M.Kom.', 'Ketua Jurusan / Dosen Pendamping', 'pic@uniku.ac.id', '081230008616', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 1, 'campus', 'Universitas Majalengka (UNMA)', 'universitas-majalengka-unma', 'Kampus Universitas Majalengka (UNMA), Majalengka, Jawa Barat', 'Majalengka', 'https://universitas-majalengka-unma.ac.id', NULL, 'Qoriatul Aini, M.T.', 'Ketua Jurusan / Dosen Pendamping', 'pic@unma.ac.id', '081256665263', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 1, 'campus', 'Universitas Galuh (UNIGAL)', 'universitas-galuh-unigal', 'Kampus Universitas Galuh (UNIGAL), Ciamis, Jawa Barat', 'Ciamis', 'https://universitas-galuh-unigal.ac.id', NULL, 'Rahmat Hidayat, M.Kom.', 'Ketua Jurusan / Dosen Pendamping', 'pic@unigal.ac.id', '081220053943', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 1, 'campus', 'Politeknik Manufaktur Bandung (POLMAN)', 'politeknik-manufaktur-bandung-polman', 'Kampus Politeknik Manufaktur Bandung (POLMAN), Bandung, Jawa Barat', 'Bandung', 'https://politeknik-manufaktur-bandung-polman.ac.id', NULL, 'Soni Wicaksono, M.T.', 'Ketua Jurusan / Dosen Pendamping', 'pic@polman-bandung.ac.id', '081230077579', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 1, 'campus', 'Politeknik Pos Indonesia (ULBI)', 'politeknik-pos-indonesia-ulbi', 'Kampus Politeknik Pos Indonesia (ULBI), Bandung, Jawa Barat', 'Bandung', 'https://politeknik-pos-indonesia-ulbi.ac.id', NULL, 'Taufik Ridwan, M.T.', 'Ketua Jurusan / Dosen Pendamping', 'pic@ulbi.ac.id', '081223721344', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(22, 1, 'campus', 'STMIK AMIK Bandung', 'stmik-amik-bandung', 'Kampus STMIK AMIK Bandung, Bandung, Jawa Barat', 'Bandung', 'https://stmik-amik-bandung.ac.id', NULL, 'Umar Said, M.Kom.', 'Ketua Jurusan / Dosen Pendamping', 'pic@amikbandung.ac.id', '081268431805', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(23, 1, 'campus', 'STMIK IKMI Cirebon', 'stmik-ikmi-cirebon', 'Kampus STMIK IKMI Cirebon, Cirebon, Jawa Barat', 'Cirebon', 'https://stmik-ikmi-cirebon.ac.id', NULL, 'Vina Panduwinata, M.Kom.', 'Ketua Jurusan / Dosen Pendamping', 'pic@ikmi.ac.id', '081226530594', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(24, 1, 'campus', 'Universitas Pakuan Bogor', 'universitas-pakuan-bogor', 'Kampus Universitas Pakuan Bogor, Bogor, Jawa Barat', 'Bogor', 'https://universitas-pakuan-bogor.ac.id', NULL, 'Wahyu Hidayat, M.T.', 'Ketua Jurusan / Dosen Pendamping', 'pic@unpak.ac.id', '081226758207', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(25, 1, 'campus', 'Universitas Ibn Khaldun Bogor', 'universitas-ibn-khaldun-bogor', 'Kampus Universitas Ibn Khaldun Bogor, Bogor, Jawa Barat', 'Bogor', 'https://universitas-ibn-khaldun-bogor.ac.id', NULL, 'Xaverius Bram, M.Kom.', 'Ketua Jurusan / Dosen Pendamping', 'pic@uika-bogor.ac.id', '081282712362', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(26, 1, 'campus', 'Universitas Presiden (President University)', 'universitas-presiden-president-university', 'Kampus Universitas Presiden (President University), Bekasi, Jawa Barat', 'Bekasi', 'https://universitas-presiden-president-university.ac.id', NULL, 'Yoga Pratama, Ph.D.', 'Ketua Jurusan / Dosen Pendamping', 'pic@president.ac.id', '081260210132', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(27, 1, 'campus', 'Universitas Djuanda Bogor', 'universitas-djuanda-bogor', 'Kampus Universitas Djuanda Bogor, Bogor, Jawa Barat', 'Bogor', 'https://universitas-djuanda-bogor.ac.id', NULL, 'Zulfikar Ali, M.T.', 'Ketua Jurusan / Dosen Pendamping', 'pic@unida.ac.id', '081248496990', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(28, 1, 'campus', 'Universitas Muhammadiyah Sukabumi (UMMI)', 'universitas-muhammadiyah-sukabumi-ummi', 'Kampus Universitas Muhammadiyah Sukabumi (UMMI), Sukabumi, Jawa Barat', 'Sukabumi', 'https://universitas-muhammadiyah-sukabumi-ummi.ac.id', NULL, 'Agus Priyono, M.Kom.', 'Ketua Jurusan / Dosen Pendamping', 'pic@ummi.ac.id', '081245566844', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(29, 1, 'campus', 'Universitas Subang (UNSUB)', 'universitas-subang-unsub', 'Kampus Universitas Subang (UNSUB), Subang, Jawa Barat', 'Subang', 'https://universitas-subang-unsub.ac.id', NULL, 'Budi Santika, M.T.', 'Ketua Jurusan / Dosen Pendamping', 'pic@unsub.ac.id', '081212978973', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(30, 1, 'campus', 'Universitas Garut (UNIGA)', 'universitas-garut-uniga', 'Kampus Universitas Garut (UNIGA), Garut, Jawa Barat', 'Garut', 'https://universitas-garut-uniga.ac.id', NULL, 'Cecep Ramdani, M.Kom.', 'Ketua Jurusan / Dosen Pendamping', 'pic@uniga.ac.id', '081221541824', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(31, 1, 'industry', 'PT Telkom Indonesia (Persero) Tbk', 'pt-telkom-indonesia-persero-tbk', 'Kantor Pusat PT Telkom Indonesia (Persero) Tbk, Bandung / Jawa Barat', 'Bandung', 'https://pt-telkom-indonesia-persero-tbk.co.id', NULL, 'VP Innovation Telkom', 'Head of Technology / Business Lead', 'industri@telkom.co.id', '081388895343', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(32, 1, 'industry', 'PT Bank Pembangunan Daerah Jawa Barat (Bank BJB)', 'pt-bank-pembangunan-daerah-jawa-barat-bank-bjb', 'Kantor Pusat PT Bank Pembangunan Daerah Jawa Barat (Bank BJB), Bandung / Jawa Barat', 'Bandung', 'https://pt-bank-pembangunan-daerah-jawa-barat-bank-bjb.co.id', NULL, 'Divisi Corporate Secretary BJB', 'Head of Technology / Business Lead', 'sponsor@bankbjb.co.id', '081394176131', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(33, 1, 'industry', 'PT Paragon Technology and Innovation', 'pt-paragon-technology-and-innovation', 'Kantor Pusat PT Paragon Technology and Innovation, Bandung / Jawa Barat', 'Bandung', 'https://pt-paragon-technology-and-innovation.co.id', NULL, 'Head of Tech Innovation', 'Head of Technology / Business Lead', 'tech@paragon-corp.com', '081316773805', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(34, 1, 'industry', 'PT Pos Indonesia (Persero)', 'pt-pos-indonesia-persero', 'Kantor Pusat PT Pos Indonesia (Persero), Bandung / Jawa Barat', 'Bandung', 'https://pt-pos-indonesia-persero.co.id', NULL, 'VP Digital Transformation', 'Head of Technology / Business Lead', 'digital@posindonesia.co.id', '081341219017', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(35, 1, 'industry', 'PT Len Industri (Persero)', 'pt-len-industri-persero', 'Kantor Pusat PT Len Industri (Persero), Bandung / Jawa Barat', 'Bandung', 'https://pt-len-industri-persero.co.id', NULL, 'GM R&D Len Industri', 'Head of Technology / Business Lead', 'rnd@len.co.id', '081372062399', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(36, 1, 'industry', 'PT Bio Farma (Persero)', 'pt-bio-farma-persero', 'Kantor Pusat PT Bio Farma (Persero), Bandung / Jawa Barat', 'Bandung', 'https://pt-bio-farma-persero.co.id', NULL, 'Head of Healthcare Tech', 'Head of Technology / Business Lead', 'healthtech@biofarma.co.id', '081382281355', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(37, 1, 'industry', 'Dicoding Indonesia', 'dicoding-indonesia', 'Kantor Pusat Dicoding Indonesia, Bandung / Jawa Barat', 'Bandung', 'https://dicoding-indonesia.co.id', NULL, 'Partnership Lead Dicoding', 'Head of Technology / Business Lead', 'partner@dicoding.com', '081393070409', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(38, 1, 'industry', 'eFishery (PT Koltiva / Akur Maha)', 'efishery-pt-koltiva-akur-maha', 'Kantor Pusat eFishery (PT Koltiva / Akur Maha), Bandung / Jawa Barat', 'Bandung', 'https://efishery-pt-koltiva-akur-maha.co.id', NULL, 'VP Engineering eFishery', 'Head of Technology / Business Lead', 'eng@efishery.com', '081379457270', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(39, 1, 'industry', 'Agate International', 'agate-international', 'Kantor Pusat Agate International, Bandung / Jawa Barat', 'Bandung', 'https://agate-international.co.id', NULL, 'Head of Studio Agate', 'Head of Technology / Business Lead', 'business@agate.id', '081379282325', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(40, 1, 'industry', 'Jabar Digital Service (JDS)', 'jabar-digital-service-jds', 'Kantor Pusat Jabar Digital Service (JDS), Bandung / Jawa Barat', 'Bandung', 'https://jabar-digital-service-jds.co.id', NULL, 'Chief of Data JDS Diskominfo', 'Head of Technology / Business Lead', 'partnership@digital.jabarprov.go.id', '081352566367', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(41, 1, 'partner', 'KADIN Jawa Barat', 'kadin-jawa-barat', 'Sekretariat KADIN Jawa Barat, Bandung', 'Bandung', 'https://kadin-jawa-barat.org', NULL, 'Ketua Komite Tetap ICT KADIN', 'Pengurus Asosiasi / Mitra', 'kontak@kadin-jawa-barat.org', '081819234824', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(42, 1, 'partner', 'Bandung Digital Valley (BDV)', 'bandung-digital-valley-bdv', 'Sekretariat Bandung Digital Valley (BDV), Bandung', 'Bandung', 'https://bandung-digital-valley-bdv.org', NULL, 'Community Manager BDV', 'Pengurus Asosiasi / Mitra', 'kontak@bandung-digital-valley-bdv.org', '081869899851', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(43, 1, 'partner', 'APJII Pengwil Jawa Barat', 'apjii-pengwil-jawa-barat', 'Sekretariat APJII Pengwil Jawa Barat, Bandung', 'Bandung', 'https://apjii-pengwil-jawa-barat.org', NULL, 'Sekretaris APJII Jabar', 'Pengurus Asosiasi / Mitra', 'kontak@apjii-pengwil-jawa-barat.org', '081870579800', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(44, 1, 'partner', 'Relawan TIK Jawa Barat', 'relawan-tik-jawa-barat', 'Sekretariat Relawan TIK Jawa Barat, Bandung', 'Bandung', 'https://relawan-tik-jawa-barat.org', NULL, 'Ketua Pengurus RTIK Jabar', 'Pengurus Asosiasi / Mitra', 'kontak@relawan-tik-jawa-barat.org', '081823891717', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(45, 1, 'partner', 'Asosiasi Game Indonesia (AGI) Jabar', 'asosiasi-game-indonesia-agi-jabar', 'Sekretariat Asosiasi Game Indonesia (AGI) Jabar, Bandung', 'Bandung', 'https://asosiasi-game-indonesia-agi-jabar.org', NULL, 'Koordinator Wilayah AGI', 'Pengurus Asosiasi / Mitra', 'kontak@asosiasi-game-indonesia-agi-jabar.org', '081877585800', 1, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(46, 1, 'school', 'SMKN 4 Bandung', 'smkn-4-bandung', 'Jl. Kliningan No. 6, Buahbatu, Kota Bandung', 'Bandung', 'https://smkn4bdg.sch.id', NULL, 'Dra. Endang Sulastri', 'Wakil Kepala Sekolah Bidang Humas & Hubin', 'sekolah@smkn4bdg.sch.id', '081240000001', 0, 'verified', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(47, 1, 'school', 'SMA ABCD', 'sma-abcd-x9wifj', NULL, NULL, NULL, NULL, 'PIC Sekolah', NULL, 'picsekolah@gmail.com', '082212345678', 0, 'verified', NULL, '2026-11-13 06:33:38', '2026-11-13 06:34:09'),
(48, 1, 'sponsor', 'Sponsor ABCD', 'sponsor-abcd-ksgjoo', NULL, NULL, NULL, NULL, 'PIC Sponsor', NULL, 'picsponsor@gmail.com', '081123456789', 0, 'verified', NULL, '2026-11-13 06:54:23', '2026-11-13 06:57:03'),
(49, 1, 'industry', 'PIC Industri ABCD', 'pic-industri-abcd-4ke5ir', NULL, NULL, NULL, NULL, 'PIC Industri', NULL, 'picindustri@gmail.com', '081324567891', 0, 'verified', NULL, '2026-11-13 07:30:01', '2026-11-13 07:36:30'),
(50, 1, 'campus', 'Universitas ABCD', 'universitas-abcd-tnejeg', NULL, NULL, NULL, NULL, 'PIC Kampus', NULL, 'pickampus@gmail.com', '082145678923', 0, 'verified', NULL, '2026-11-13 07:57:30', '2026-11-13 08:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `organization_memberships`
--

CREATE TABLE `organization_memberships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_in_org` varchar(255) NOT NULL DEFAULT 'member',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_memberships`
--

INSERT INTO `organization_memberships` (`id`, `organization_id`, `user_id`, `role_in_org`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 'pic', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 2, 15, 'pic', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 3, 16, 'pic', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 1, 14, 'student', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 31, 17, 'pic', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 32, 18, 'pic', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 46, 19, 'pic', 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 47, 47, 'pic', 1, '2026-11-13 06:33:38', '2026-11-13 06:33:38'),
(9, 48, 48, 'pic', 1, '2026-11-13 06:54:23', '2026-11-13 06:54:23'),
(10, 49, 49, 'pic', 1, '2026-11-13 07:30:01', '2026-11-13 07:30:01'),
(11, 50, 51, 'pic', 1, '2026-11-13 07:57:30', '2026-11-13 07:57:30'),
(14, 50, 50, 'student', 1, '2026-11-13 08:44:31', '2026-11-13 08:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `payment_number` varchar(255) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'bank_transfer',
  `bank_source` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `account_holder` varchar(255) DEFAULT NULL,
  `receipt_file` varchar(255) DEFAULT NULL,
  `status` enum('pending_verification','verified','rejected') NOT NULL DEFAULT 'pending_verification',
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `payment_number`, `amount`, `payment_date`, `payment_method`, `bank_source`, `account_number`, `account_holder`, `receipt_file`, `status`, `verified_by`, `verified_at`, `rejection_reason`, `created_at`, `updated_at`) VALUES
(1, 1, 'PAY/2026/10/001', 55500000.00, '2026-11-05', 'bank_transfer', 'Bank BJB', '0010998877665', 'PT BANK PEMBANGUNAN DAERAH JABAR', '/receipts/transfer-bjb-55m.pdf', 'verified', 4, '2026-11-06 14:55:58', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 2, 'PAY/2026/11/E6B064', 20000000.00, '2026-11-13', 'bank_transfer', 'Bank Permata', NULL, 'Fara', 'payment-proofs/S0PdNznCiKOO7PE6uwBF3jG6FaNLWUm84QYi618D.jpg', 'verified', 1, '2026-11-13 14:27:45', NULL, '2026-11-13 07:27:17', '2026-11-13 07:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `payment_allocations`
--

CREATE TABLE `payment_allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `allocated_amount` decimal(15,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_allocations`
--

INSERT INTO `payment_allocations` (`id`, `payment_id`, `invoice_item_id`, `allocated_amount`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 55500000.00, 'Alokasi lunas paket Platinum BJB', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 2, 2, 20000000.00, 'Alokasi penuh ke tagihan INV/2026/261113/7DC014', '2026-11-13 07:27:45', '2026-11-13 07:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `identity_number` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id`, `user_id`, `full_name`, `email`, `phone`, `identity_number`, `organization_name`, `position`, `bio`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Administrator', 'admin@futurise.id', '081122334401', NULL, 'APTIKOM Jabar Ecosystem', 'super-admin', NULL, NULL, '2026-11-08 07:55:53', '2026-11-08 07:55:53'),
(2, 2, 'Dr. Ir. Hendra Gunawan (Ketua Pelaksana)', 'ketua@futurise.id', '081122334402', NULL, 'APTIKOM Jabar Ecosystem', 'ketua-pelaksana', NULL, NULL, '2026-11-08 07:55:53', '2026-11-08 07:55:53'),
(3, 3, 'Sekretariat APTIKOM', 'sekretariat@futurise.id', '081122334403', NULL, 'APTIKOM Jabar Ecosystem', 'sekretariat', NULL, NULL, '2026-11-08 07:55:53', '2026-11-08 07:55:53'),
(4, 4, 'Bendahara & Keuangan', 'keuangan@futurise.id', '081122334404', NULL, 'APTIKOM Jabar Ecosystem', 'keuangan', NULL, NULL, '2026-11-08 07:55:53', '2026-11-08 07:55:53'),
(5, 5, 'Koordinator Kurator & Program', 'kurator@futurise.id', '081122334405', NULL, 'APTIKOM Jabar Ecosystem', 'program-kurasi', NULL, NULL, '2026-11-08 07:55:54', '2026-11-08 07:55:54'),
(6, 6, 'Divisi Kampus & Sekolah', 'kampus@futurise.id', '081122334406', NULL, 'APTIKOM Jabar Ecosystem', 'kampus-sekolah', NULL, NULL, '2026-11-08 07:55:54', '2026-11-08 07:55:54'),
(7, 7, 'Divisi Industri & Sponsor', 'sponsor@futurise.id', '081122334407', NULL, 'APTIKOM Jabar Ecosystem', 'industri-sponsor', NULL, NULL, '2026-11-08 07:55:54', '2026-11-08 07:55:54'),
(8, 8, 'Koordinator Venue & Teknis', 'venue@futurise.id', '081122334408', NULL, 'APTIKOM Jabar Ecosystem', 'venue-teknis', NULL, NULL, '2026-11-08 07:55:54', '2026-11-08 07:55:54'),
(9, 9, 'Tim Publikasi & Media', 'publikasi@futurise.id', '081122334409', NULL, 'APTIKOM Jabar Ecosystem', 'publikasi', NULL, NULL, '2026-11-08 07:55:55', '2026-11-08 07:55:55'),
(10, 10, 'Petugas Registrasi Gate Sabuga', 'registrasi@futurise.id', '081122334410', NULL, 'APTIKOM Jabar Ecosystem', 'registrasi-layanan', NULL, NULL, '2026-11-08 07:55:55', '2026-11-08 07:55:55'),
(11, 11, 'Prof. Dr. Juri Teknologi (Juri)', 'juri@futurise.id', '081122334411', NULL, 'APTIKOM Jabar Ecosystem', 'juri', NULL, NULL, '2026-11-08 07:55:55', '2026-11-08 07:55:55'),
(12, 12, 'Dr. Rina Widyastuti (Juri Industri)', 'juri2@futurise.id', '081122334412', NULL, 'APTIKOM Jabar Ecosystem', 'juri', NULL, NULL, '2026-11-08 07:55:56', '2026-11-08 07:55:56'),
(13, 13, 'PIC Kampus ITB', 'kampus@itb.ac.id', '081220000001', NULL, 'APTIKOM Jabar Ecosystem', 'pic-kampus', NULL, NULL, '2026-11-08 07:55:56', '2026-11-08 07:55:56'),
(14, 14, 'Rian Pratama (Tim Mahasiswa ITB)', 'tim@itb.ac.id', '081220000002', NULL, 'APTIKOM Jabar Ecosystem', 'tim-mahasiswa', NULL, NULL, '2026-11-08 07:55:56', '2026-11-08 07:55:56'),
(15, 15, 'PIC Kampus Telkom University', 'kampus@telkomuniversity.ac.id', '081220000003', NULL, 'APTIKOM Jabar Ecosystem', 'pic-kampus', NULL, NULL, '2026-11-08 07:55:56', '2026-11-08 07:55:56'),
(16, 16, 'PIC Kampus UNIKOM Bandung', 'kampus@unikom.ac.id', '081220000004', NULL, 'APTIKOM Jabar Ecosystem', 'pic-kampus', NULL, NULL, '2026-11-08 07:55:57', '2026-11-08 07:55:57'),
(17, 17, 'VP Innovation PT Telkom Indonesia', 'industri@telkom.co.id', '081230000001', NULL, 'APTIKOM Jabar Ecosystem', 'pic-industri', NULL, NULL, '2026-11-08 07:55:57', '2026-11-08 07:55:57'),
(18, 18, 'Corporate Secretary Bank BJB', 'sponsor@bankbjb.co.id', '081230000002', NULL, 'APTIKOM Jabar Ecosystem', 'pic-sponsor', NULL, NULL, '2026-11-08 07:55:57', '2026-11-08 07:55:57'),
(19, 19, 'Koordinator SMKN 4 Bandung', 'sekolah@smkn4bdg.sch.id', '081240000001', NULL, 'APTIKOM Jabar Ecosystem', 'pic-sekolah', NULL, NULL, '2026-11-08 07:55:57', '2026-11-08 07:55:57'),
(20, 20, 'Budi Santoso (Pengunjung Umum)', 'pengunjung@gmail.com', '081250000001', NULL, 'APTIKOM Jabar Ecosystem', 'pengunjung', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 46, 'Yessica Fara Desvia', 'yessica.desvia.krw@horizon.ac.id', '0811-1006-7155', NULL, 'Individu', NULL, NULL, NULL, '2026-11-13 03:48:08', '2026-11-13 03:48:08'),
(22, 47, 'PIC Sekolah', 'picsekolah@gmail.com', '082212345678', NULL, 'SMA ABCD', NULL, NULL, NULL, '2026-11-13 06:33:38', '2026-11-13 06:33:38'),
(23, 48, 'PIC Sponsor', 'picsponsor@gmail.com', '081123456789', NULL, 'Sponsor ABCD', NULL, NULL, NULL, '2026-11-13 06:54:23', '2026-11-13 06:54:23'),
(24, 49, 'PIC Industri', 'picindustri@gmail.com', '081324567891', NULL, 'PIC Industri ABCD', NULL, NULL, NULL, '2026-11-13 07:30:01', '2026-11-13 07:30:01'),
(25, 50, 'Tim Mahasiswa B', 'timmhsb@gmail.com', '123456789', NULL, NULL, NULL, NULL, NULL, '2026-11-13 07:41:37', '2026-11-13 07:41:37'),
(26, 51, 'PIC Kampus', 'pickampus@gmail.com', '082145678923', NULL, 'Universitas ABCD', NULL, NULL, NULL, '2026-11-13 07:57:30', '2026-11-13 07:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booth_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'AI/IoT',
  `problem_statement` text NOT NULL,
  `target_users` text NOT NULL,
  `solution_description` text NOT NULL,
  `key_features` text DEFAULT NULL,
  `technology_stack` varchar(255) DEFAULT NULL,
  `readiness_level` varchar(255) NOT NULL DEFAULT 'Prototipe Teruji',
  `test_results` text DEFAULT NULL,
  `limitations` text DEFAULT NULL,
  `demo_url` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `poster_image` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `collaboration_needs` text DEFAULT NULL,
  `is_published_consent` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('draft','diajukan','dalam_pemeriksaan','perlu_revisi','lolos','tidak_lolos') NOT NULL DEFAULT 'draft',
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `curator_notes` text DEFAULT NULL,
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `publication_status` enum('belum_disetujui','siap_publikasi','terbit','diarsipkan') NOT NULL DEFAULT 'belum_disetujui',
  `is_pitch_finalist` tinyint(1) NOT NULL DEFAULT 0,
  `pitch_order` int(11) DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `event_id`, `organization_id`, `team_id`, `booth_id`, `title`, `slug`, `category`, `problem_statement`, `target_users`, `solution_description`, `key_features`, `technology_stack`, `readiness_level`, `test_results`, `limitations`, `demo_url`, `video_url`, `poster_image`, `thumbnail`, `collaboration_needs`, `is_published_consent`, `status`, `is_locked`, `curator_notes`, `reviewed_by`, `reviewed_at`, `publication_status`, `is_pitch_finalist`, `pitch_order`, `view_count`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'AgriSense AI: Edge IoT & Computer Vision for Smart Paddy Monitoring', 'agrisense-ai-edge-iot-computer-vision-for-smart-paddy-monitoring', 'AI/IoT', 'Petani Jawa Barat sering mengalami gagal panen hingga 35% akibat hama wereng dan kekeringan air irigasi yang terlambat terdeteksi.', 'Kelompok tani padi, Dinas Tanaman Pangan dan Hortikultura Jabar, pengelola irigasi pintar.', 'Perangkat Edge AI bertenaga surya dengan sensor kelembaban multi-depth dan kamera deteksi optik hama berbasis YOLOv8 lokal.', 'Deteksi otomatis wereng coklat & penggerek batang, automasi katup air irigasi via LoRaWAN, dashboard mobile notifikasi real-time.', 'ESP32, Raspberry Pi Edge, PyTorch, LoRaWAN, Flutter, Laravel 12 API', 'Prototipe Teruji (TRL 6)', 'Telah diuji pada 5 hektar sawah percontohan di Rancaekek dengan akurasi deteksi hama 94.2% dan efisiensi air 28%.', 'Jangkauan kamera optimal pada radius 12 meter dan membutuhkan pembersihan lensa berkala setiap 2 minggu.', 'https://agrisense.itb.ac.id/demo', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-0.jpg', '/images/thumbnails/thumb-0.jpg', 'Membutuhkan kemitraan industri agritech untuk fabrikasi massal casing tahan cuaca ekstrem dan pendanaan uji lapangan multi-region.', 1, 'diajukan', 1, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-13 10:35:03', 'diarsipkan', 1, 1, 200, '2026-11-08 07:55:58', '2026-11-13 08:33:26'),
(2, 1, 1, 2, 1, 'NeuroStroke: Portable AI Tele-rehabilitation & EMG Glove', 'neurostroke-portable-ai-tele-rehabilitation-emg-glove', 'HealthTech', 'Pasien pasca-stroke di daerah rural Jawa Barat kesulitan mengakses fisioterapi rutin karena keterbatasan terapis dan jarak RS rujukan.', 'Pasien rehabilitasi stroke fase pemulihan, dokter spesialis kedokteran fisik dan rehabilitasi (Sp.KFR).', 'Sarung tangan sensorik EMG dan bending fleksibel yang terhubung ke aplikasi gamifikasi pemulihan motorik berbasis tele-monitoring.', 'Sensor fleksi 5 jari, real-time EMG biofeedback, 8 mini-games terapi adiktif, dashboard analisis perkembangan sudut gerak untuk dokter.', 'Bio-EMG Sensor, BLE 5.0, Unity Mobile, Node.js WebSocket, PostgreSQL', 'Prototipe Teruji (TRL 5)', 'Uji klinis awal terhadap 12 pasien di RS Hasan Sadikin menunjukkan peningkatan kepatuhan latihan mandiri sebesar 70%.', 'Daya tahan baterai sarung tangan saat ini sekitar 4 jam operasi intensif dan membutuhkan kalibrasi awal setiap pengguna.', 'https://neurostroke.itb.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-1.jpg', '/images/thumbnails/thumb-1.jpg', 'Mencari mitra produsen alat kesehatan untuk uji sertifikasi Kemenkes dan kerjasama uji klinis fase lanjutan.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 1, 2, 362, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 2, 3, 2, 'CitarumGuard: Smart Autonomous Drone & River Pollution Indexer', 'citarumguard-smart-autonomous-drone-river-pollution-indexer', 'Smart City', 'Pencemaran limbah industri cair di DAS Sungai Citarum sering terjadi pada malam hari secara sporadis dan sulit dilacak sumbernya.', 'Satgas Citarum Harum, Dinas Lingkungan Hidup Jabar, komunitas peduli sungai.', 'Drone otonom patroli terjadwal dengan kamera multispektral dan perahu pelampung mini pembaca pH, DO, TDS, serta temperatur terintegrasi satelit.', 'Waypoint patroli otonom 15 km, geo-tagging anomali warna air limbah, deteksi tumpahan oli dengan CNN, transmisi GSM 4G & Satelit Iridium.', 'Pixhawk 4, Jetson Orin Nano, OpenCV, Multispectral Sensor, Cloud Telemetry', 'Prototipe Teruji (TRL 6)', 'Uji terbang 40 kali di wilayah Majalaya berhasil mengidentifikasi 8 titik pembuangan pipa siluman.', 'Kemampuan terbang terbatasi jika curah hujan ekstrem di atas 40 mm/jam.', 'https://citarumguard.telkomuniversity.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-2.jpg', '/images/thumbnails/thumb-2.jpg', 'Mencari integrasi dengan Command Center Diskominfo Jabar dan sponsor pengadaan armada drone.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 1, 3, 324, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 1, 2, 4, 2, 'PasarLink: Blockchain Decentralized Micro-Finance for Traditional Merchants', 'pasarlink-blockchain-decentralized-micro-finance-for-traditional-merchants', 'FinTech', 'Pedagang pasar tradisional di Jawa Barat terjebak rentenir dengan bunga harian hingga 20% karena ketiadaan riwayat kredit formal (unbanked).', 'Pedagang pasar tradisional, koperasi simpan pinjam pasar, bank pembangunan daerah.', 'Sistem pencatatan transaksi harian berbasis QRIS suara interaktif yang menghasilkan skor kelayakan kredit berbasis on-chain zero-knowledge.', 'Smart speaker konfirmasi QRIS suara bilingual Sunda-Indonesia, credit scoring transparan, pencairan micro-loan instan tanpa jaminan fisik.', 'Solana Smart Contracts, Rust, React Native, AWS Lambda, OCR Struk', 'Prototipe Teruji (TRL 5)', 'Pilot test di Pasar Kosambi Bandung dengan 45 pedagang menghasilkan 1.200 transaksi tercatat tanpa kredit macet selama 3 bulan.', 'Bergantung pada ketersediaan sinyal seluler kasir pedagang.', 'https://pasarlink.telkomuniversity.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-3.jpg', '/images/thumbnails/thumb-3.jpg', 'Mencari kemitraan Bank BJB untuk penyaluran KUR mikro terintegrasi.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 419, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 1, 3, 5, 3, 'RoboTrash AI: Autonomous Indoor Sorting Robot with Robotic Arm', 'robotrash-ai-autonomous-indoor-sorting-robot-with-robotic-arm', 'AI/IoT', 'Pemisahan sampah organik, anorganik, dan B3 di fasilitas umum kampus dan mal sering gagal karena kepatuhan masyarakat rendah.', 'Pengelola gedung perkantoran, universitas, stasiun KAI, pusat perbelanjaan.', 'Robot otonom pemilah sampah dengan lengan robotik 4-DOF dan visi komputer multimodal yang langsung memilah saat pengunjung membuang.', 'Klasifikasi 32 jenis sampah dalam 0.8 detik, kompresor otomatis penampung botol, navigasi LiDAR SLAM mandiri, self-docking charger.', 'ROS 2 Humble, NVIDIA Jetson, YOLOv9, LiDAR RPLIDAR A2, DC Planetary Motors', 'Prototipe Teruji (TRL 6)', 'Dioperasikan di lobby Smart Building UNIKOM selama 60 hari dengan akurasi sortir sampah 96.8%.', 'Lengan robot belum mampu mengangkat benda basah bermassa lebih dari 1.5 kg.', 'https://robotics.unikom.ac.id/robotrash', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-4.jpg', '/images/thumbnails/thumb-4.jpg', 'Kemitraan investor manufaktur mekanik dan uji coba di Stasiun Whoosh KCIC.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 1, 4, 240, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 1, 3, 6, 3, 'HeritageVR: Metaverse Budaya Sunda & Museum Virtual Angklung Udjo', 'heritagevr-metaverse-budaya-sunda-museum-virtual-angklung-udjo', 'Creative Media', 'Minat generasi muda terhadap seni tradisi Jawa Barat seperti Wayang Golek dan Angklung menurun karena media konservasi konvensional kurang interaktif.', 'Pelajar sekolah, wisatawan mancanegara, museum daerah, sanggar seni budaya.', 'Platform virtual reality interaktif di mana pengguna dapat memainkan angklung virtual dengan pelacakan gestur tangan tanpa controller.', 'Haptic feedback spatial audio 3D, tutorial interaktif tangga nada pentatonik Sunda, multiplayer orkestra angklung virtual lintas negara.', 'Unreal Engine 5, Meta Quest OpenXR, WebXR, Spatial Audio API', 'Produksi Terbatas (TRL 7)', 'Telah dicoba oleh lebih dari 1.500 pengunjung Saung Angklung Udjo dengan kepuasan impresi 95%.', 'Membutuhkan headset VR 6-DOF (Oculus Quest 2/3 atau Pico 4) untuk pengalaman optimal.', 'https://heritagevr.unikom.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-5.jpg', '/images/thumbnails/thumb-5.jpg', 'Kerjasama Dinas Pariwisata dan Kebudayaan Jabar untuk pengadaan di 50 sekolah percontohan.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 300, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 1, 4, 7, 4, 'StuntingZero: AI Early Childhood Growth Predictor & Nutrition Guide', 'stuntingzero-ai-early-childhood-growth-predictor-nutrition-guide', 'HealthTech', 'Angka stunting di Jawa Barat masih berada di kisaran 20%, dengan keterbatasan alat ukur antropometri digital di posyandu pelosok.', 'Kader Posyandu, Puskesmas, BKKBN Jawa Barat, ibu balita.', 'Aplikasi kamera foto berbasis computer vision yang menghitung tinggi badan balita secara presisi hanya dengan kartu kalibrasi standar.', 'Estimasi panjang badan akurasi 98.5% tanpa pita ukur fisik, analisis asupan gizi lokal khas Sunda, warning early detection kurva WHO.', 'TensorFlow Lite, Kotlin, Python FastAPI, Cloud Run, Supabase', 'Prototipe Teruji (TRL 6)', 'Divalidasi pada 300 balita di Puskesmas Jatinangor dibandingkan alat ukur stadiometer medis resmi.', 'Membutuhkan pencahayaan ruangan minimal 200 lux saat pengambilan foto balita.', 'https://stuntingzero.unpad.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-6.jpg', '/images/thumbnails/thumb-6.jpg', 'Adopsi resmi oleh Dinas Kesehatan Jabar dan sponsor pengadaan smartphone untuk kader posyandu.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 1, 5, 116, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 1, 4, 8, 4, 'GreenTrace: Life Cycle Assessment & Carbon Footprint for MSME Garment', 'greentrace-life-cycle-assessment-carbon-footprint-for-msme-garment', 'Smart City', 'UMKM konveksi & garmen di Majalaya dan Soreang dituntut memenuhi syarat audit jejak karbon ekspor namun tidak sanggup membayar konsultan mahal.', 'UMKM garmen dan tekstil, eksportir fesyen lokal, kementerian perindustrian.', 'SaaS kalkulator emisi karbon terotomasi berbasis data input bahan baku, listrik, dan logistik lokal dengan sertifikat digital blockchain.', 'Rekomendasi optimasi rantai pasok rendah emisi, cetak sertifikat QR jejak karbon garmen, integrasi standar GHG Protocol.', 'Laravel 12, Tailwind CSS, Vue 3, Polygon Network Smart Contract', 'Prototipe Teruji (TRL 5)', 'Digunakan oleh 18 pengrajin rajut Binong Jati dengan penghematan emisi rata-rata 14%.', 'Database koefisien emisi saat ini terfokus pada industri tekstil dan garmen lokal.', 'https://greentrace.unpad.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-7.jpg', '/images/thumbnails/thumb-7.jpg', 'Kerjasama dengan KADIN Jabar dan asosiasi ekspor produk tekstil.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 156, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 1, 5, 9, 5, 'AksaraAI: Interactive Sundanese Script Handwriting OCR & Adaptive Tutor', 'aksaraai-interactive-sundanese-script-handwriting-ocr-adaptive-tutor', 'EdTech', 'Generasi muda semakin kesulitan membaca dan menulis Aksara Sunda kuno, sedangkan kurikulum muatan lokal kekurangan media pembelajaran cerdas.', 'Guru dan siswa SD-SMP di Jawa Barat, pegiat pelestari budaya Sunda.', 'Aplikasi tablet edukatif dengan AI pengenal goresan tulisan tangan Aksara Sunda secara real-time disertai umpan balik koreksi goresan.', 'Koreksi goresan stroke-by-stroke, pengenalan aksara ngalagena, rarangken, dan angka, gamifikasi kuis petualangan Pasundan.', 'CNN Handwriting Recognition, ONNX Runtime Mobile, Flutter, SQLite', 'Prototipe Teruji (TRL 6)', 'Diujicobakan pada 500 siswa di 4 SMP Kota Bandung dengan peningkatan nilai ulangan aksara 42%.', 'Optimal pada layar sentuh dengan stylus atau jari berukuran standar.', 'https://aksarasunda.upi.edu', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-8.jpg', '/images/thumbnails/thumb-8.jpg', 'Integrasi ke Kurikulum Merdeka Disdik Jabar dan penerbit buku sekolah.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 1, 6, 143, '2026-11-08 07:55:58', '2026-11-13 05:46:29'),
(10, 1, 5, 10, 5, 'SimuLab AR: Low-Cost Augmented Reality Physics Experiment for Remote Schools', 'simulab-ar-low-cost-augmented-reality-physics-experiment-for-remote-schools', 'EdTech', 'Sekolah menengah di daerah 3T Jawa Barat Selatan tidak memiliki laboratorium fisika dan kimia memadai untuk praktikum gelombang dan optik.', 'SMA/SMK di daerah pelosok, dinas pendidikan kabupaten.', 'Alat peraga AR berbasis marker kartu murah yang dapat memvisualisasikan medan magnet, pembiasan cahaya, dan gerak parabola secara 3D.', 'Simulasi interaktif tanpa bahan kimia berbahaya, jalan tanpa koneksi internet (offline-first), panduan modul LKS terintegrasi.', 'ARCore, Unity, C#, Local Cache Database', 'Prototipe Teruji (TRL 6)', 'Uji coba di 6 SMA di Kabupaten Cianjur Selatan dengan respon antusiasme 92%.', 'Membutuhkan smartphone Android dengan dukungan sensor giroskop.', 'https://simulab.upi.edu', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-9.jpg', '/images/thumbnails/thumb-9.jpg', 'Distribusi gratis ke 100 sekolah daerah 3T dengan dukungan CSR BUMN.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 51, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 1, 6, 11, 6, 'SmartSolarMicrogrid: AI Peak-Shaving & Battery Optimization for Industry', 'smartsolarmicrogrid-ai-peak-shaving-battery-optimization-for-industry', 'AI/IoT', 'Pabrik industri di kawasan industri Karawang dan Cikarang menanggung tagihan daya puncak listrik PLN yang mahal saat jam operasional 17.00 - 22.00.', 'Manajer energi pabrik, industri manufaktur tekstil dan komponen otomotif.', 'Kontroler cerdas berbasis algoritma prediksi beban LSTM yang mengatur switching baterai PLTS atap secara otomatis untuk memotong daya puncak.', 'Prediksi cuaca & iradiasi surya 24 jam ke depan, otomatisasi switching relai daya tinggi, dashboard SCADA berbasis cloud.', 'Modbus RTU, ESP32-S3, Python TensorFlow, Grafana, InfluxDB, Docker', 'Prototipe Teruji (TRL 6)', 'Telah dipasang di workshop manufaktur POLBAN dengan penghematan biaya listrik bulanan sebesar 22.4%.', 'Kapasitas switching unit uji coba saat ini maksimal pada arus 100 Ampere 3-fase.', 'https://microgrid.polban.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-10.jpg', '/images/thumbnails/thumb-10.jpg', 'Pilot project di pabrik kawasan industri KIIC Karawang.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 1, 7, 103, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 1, 6, 12, 6, 'MachinaVision: High-Speed Edge Defect Inspection for Conveyor Line', 'machinavision-high-speed-edge-defect-inspection-for-conveyor-line', 'AI/IoT', 'Pemeriksaan cacat fisik botol dan kemasan makanan di industri FMCG masih mengandalkan mata manusia yang rentan kelelahan setelah 2 jam kerja.', 'Industri manufaktur makanan & minuman, kemasan farmasi.', 'Sistem vision kamera berkecepatan tinggi dengan pencahayaan stroboskopik dan model deteksi anomali real-time 120 botol/menit.', 'Deteksi cacat tutup miring, retak mikro, dan volume cairan di bawah standar, aktuator penolak pneumatik instan.', 'Industrial GigE Camera, NVIDIA Jetson Xavier, TensorRT, PLC Siemens S7-1200', 'Prototipe Teruji (TRL 6)', 'Uji kecepatan 2 botol per detik dengan false negative di bawah 0.2%.', 'Membutuhkan kalibrasi ulang jika varian botol berganti dimensi secara signifikan.', 'https://machinavision.polban.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-11.jpg', '/images/thumbnails/thumb-11.jpg', 'Kerjasama implementasi lini produksi pabrik Bio Farma atau Paragon.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 248, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 1, 10, 13, 10, 'SmartPoultry: Acoustic & Computer Vision Welfare Monitor for Broiler Chicken', 'smartpoultry-acoustic-computer-vision-welfare-monitor-for-broiler-chicken', 'AI/IoT', 'Kematian ayam pedaging akibat heat stress dan gangguan pernapasan infeksius di kandang closed-house sering terlambat diketahui peternak.', 'Peternak unggas modern, integrator perunggasan Jawa Barat (Bogor, Subang, Ciamis).', 'Sistem AI pemantau suara batuk ayam (bioakustik) dan densitas persebaran gerak ayam menggunakan kamera thermal-RGB terintegrasi.', 'Deteksi dini penyakit Newcastle Disease dan bronkitis dari spektrum suara, automasi kipas exhaust kandang, estimasi bobot ayam harian.', 'Thermal Camera FLIR, Mel-Frequency Cepstral Coefficients (MFCC), Edge TPU, Node-RED', 'Prototipe Teruji (TRL 6)', 'Diuji pada populasi 20.000 ayam di Subang dengan penurunan angka mortalitas dari 4.8% menjadi 1.9%.', 'Mikrofon directional memerlukan proteksi debu sekam bulu ayam berkala.', 'https://smartpoultry.ipb.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-12.jpg', '/images/thumbnails/thumb-12.jpg', 'Kemitraan integrasi sensor dengan pabrik pakan dan kandang percontohan Pemprov Jabar.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 1, 8, 101, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 1, 10, 14, 10, 'KopiTrace: AI Near-Infrared Bean Sorter & Origin Authentication for West Java Java Preanger', 'kopitrace-ai-near-infrared-bean-sorter-origin-authentication-for-west-java-java-preanger', 'AI/IoT', 'Kopi specialty Java Preanger sering dicampur biji cacat (defect) atau biji daerah lain sehingga menurunkan nilai jual ekspor petani.', 'Koperasi petani kopi Jawa Barat (Pangalengan, Ciwidey, Puntang), roastery, eksportir kopi.', 'Alat sortir biji kopi portabel dengan spektroskopi NIR mini dan algoritma machine learning pemilah biji cacat dan kadar air instan.', 'Analisis kadar air dan defect dalam 3 detik, paspor digital asal kebun berbasis geo-tagging, sertifikasi mutu digital.', 'NIR Spectral Sensor, Raspberry Pi 4, LightGBM, React Native Mobile', 'Prototipe Teruji (TRL 5)', 'Uji pada 100 sampel green beans kopi Puntang dengan akurasi klasifikasi grade specialty 93.5%.', 'Sampel harus berada dalam wadah transparan tanpa pantulan cahaya luar berlebih.', 'https://kopitrace.ipb.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-13.jpg', '/images/thumbnails/thumb-13.jpg', 'Mencari kemitraan asosiasi specialty coffee dan Dinas Perkebunan Jawa Barat.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 337, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 1, 7, 15, 7, 'StructuralHealth: Wireless LoRa Accelerometer Network for Heritage Buildings', 'structuralhealth-wireless-lora-accelerometer-network-for-heritage-buildings', 'Smart City', 'Gedung bersejarah heritage di Kota Bandung rentan retak dan degradasi struktur akibat getaran lalu lintas padat dan gempa bumi sesar Lembang.', 'Dinas Cagar Budaya Kota Bandung, pengelola Gedung Sate, Bank Indonesia, ITB heritage.', 'Jaringan sensor akselerometer ultra-presisi nirkabel LoRaWAN berdaya baterai 3 tahun yang mendeteksi anomali frekuensi natural gedung.', 'Sensor getaran tri-axial MEMS 24-bit, analisis Fast Fourier Transform (FFT) on-edge, sistem alarm dini pergeseran struktur mikro.', 'MEMS Accelerometer ADXL355, LoRaWAN 915MHz, Python SciPy, Web Dashboard GIS 3D', 'Prototipe Teruji (TRL 6)', 'Dipasang di menara Gedung Rektorat UNPAR dan Gedung Merdeka selama 6 bulan pemantauan getaran.', 'Sensor harus dilekatkan pada pilar utama struktur beton atau baja.', 'https://structuralhealth.unpar.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-14.jpg', '/images/thumbnails/thumb-14.jpg', 'Implementasi di Gedung Sate dan Gedung Indonesia Menggugat.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 1, 9, 56, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 1, 7, 16, 7, 'CivicVoice: NLP Sentiment Analysis for Public Policy Consultation Jabar', 'civicvoice-nlp-sentiment-analysis-for-public-policy-consultation-jabar', 'Smart City', 'Pemerintah daerah kewalahan membaca ribuan aspirasi dan keluhan masyarakat di media sosial mengenai transportasi publik dan bansos.', 'Bappeda Jabar, Diskominfo Jabar, DPRD Provinsi.', 'Engine NLP berbahasa Indonesia dan dialek Sunda yang mengelompokkan aspirasi publik ke dalam topik prioritas dan sentimen urgensi.', 'Scraping resmi Twitter/X, Instagram, dan SP4N Lapor, deteksi hoax otomatis, visualisasi heatmap isu per kabupaten/kota.', 'IndoBERT Fine-Tuned, Transformers, FastAPI, Elasticsearch, Kibana', 'Prototipe Teruji (TRL 5)', 'Memproses 250.000 komentar isu kemacetan Bandung Raya dengan akurasi sentimen 89%.', 'Bergantung pada ketersediaan API pihak ketiga media sosial.', 'https://civicvoice.unpar.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-15.jpg', '/images/thumbnails/thumb-15.jpg', 'Adopsi di Jabar Digital Service Command Center.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 94, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 1, 11, 17, 11, 'LogisTrack AI: Smart Warehouse Pallet RFID & Autonomous Mobile Robot (AMR)', 'logistrack-ai-smart-warehouse-pallet-rfid-autonomous-mobile-robot-amr', 'AI/IoT', 'Pusat logistik e-commerce dan gudang kawasan industri Karawang sering mengalami salah letak barang (misplacement) yang memakan waktu pencarian hingga 40 menit per pesanan.', 'Pengelola gudang 3PL, pabrik otomotif Karawang, logistik e-commerce.', 'Robot forklift mini otomatis (AMR) dengan pembaca RFID jarak jauh yang memperbarui peta lokasi stok 3D gudang secara real-time.', 'Pemetaan SLAM 2D/3D tanpa strip magnet lantai, pemindaian 100 pallet per menit, kalkulasi rute picking tercepat berbasis algoritma Dijkstra dinamis.', 'UHF RFID Reader, ROS 2, Stereo Camera, Python, Fleet Management Server', 'Prototipe Teruji (TRL 6)', 'Uji operasi di gudang logistik seluas 2.000 m2 di KIIC Karawang dengan akurasi pencatatan inventaris 99.7%.', 'Daya angkut beban robot saat ini maksimal 150 kg per rak.', 'https://logistrack.unsika.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-16.jpg', '/images/thumbnails/thumb-16.jpg', 'Kemitraan PT Pos Indonesia atau pergudangan e-commerce nasional.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 1, 10, 395, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 1, 11, 18, 11, 'PaddyYield: Satellite Multispectral Early Yield Forecasting for Karawang Granary', 'paddyyield-satellite-multispectral-early-yield-forecasting-for-karawang-granary', 'AI/IoT', 'Prediksi cadangan beras nasional di lumbung padi Karawang sering meleset akibat anomali cuaca El Nino, memicu spekulasi harga beras.', 'Bulog, Dinas Pertanian Karawang, Kementerian Pertanian.', 'Platform prediksi hasil panen padi 45 hari sebelum panen dengan integrasi citra satelit Sentinel-2 dan pemodelan machine learning indeks vegetasi NDVI/EVI.', 'Peta prediksi tonase per kecamatan, peringatan dini defisit beras, estimasi tanggal panen raya optimal.', 'Google Earth Engine API, Sentinel-2 Multispectral, XGBoost, Mapbox GL', 'Prototipe Teruji (TRL 5)', 'Validasi dengan data riil panen Dinas Pertanian Karawang 2025 dengan deviasi prediksi di bawah 6.2%.', 'Tertutup awan tebal pada puncak musim hujan dapat menunda pembaharuan citra satelit optik.', 'https://paddyyield.unsika.ac.id', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-17.jpg', '/images/thumbnails/thumb-17.jpg', 'Kolaborasi dengan Perum BULOG dan BPS Jawa Barat.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 74, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 1, 8, 19, 8, 'Inovasi Smart City: Solusi Cerdas Universitas Pasundan (UNPAS) untuk Kemandirian Daerah', 'inovasi-smart-city-solusi-cerdas-universitas-pasundan-unpas-untuk-kemandirian-daerah', 'Smart City', 'Kebutuhan automasi dan efisiensi digital di wilayah Bandung yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Bandung serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Pasundan (UNPAS).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Prototipe Teruji (TRL 6)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-pasundan-unpas.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-18.jpg', '/images/thumbnails/thumb-18.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 398, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 1, 8, 20, 8, 'Sistem AI/IoT Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Pasundan (UNPAS)', 'sistem-aiiot-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-pasundan-unpas', 'AI/IoT', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Prototipe Laboratorium (TRL 4)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-pasundan-unpas.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-19.jpg', '/images/thumbnails/thumb-19.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 292, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 1, 9, 21, 9, 'Inovasi Smart City: Solusi Cerdas Universitas Widyatama untuk Kemandirian Daerah', 'inovasi-smart-city-solusi-cerdas-universitas-widyatama-untuk-kemandirian-daerah', 'Smart City', 'Kebutuhan automasi dan efisiensi digital di wilayah Bandung yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Bandung serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Widyatama.', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Prototipe Laboratorium (TRL 4)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-widyatama.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-20.jpg', '/images/thumbnails/thumb-20.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 408, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(22, 1, 9, 22, 9, 'Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Widyatama', 'sistem-healthtech-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-widyatama', 'HealthTech', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Validasi Komponen (TRL 5)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-widyatama.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-21.jpg', '/images/thumbnails/thumb-21.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 374, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(23, 1, 12, 23, 12, 'Inovasi Smart City: Solusi Cerdas Universitas Siliwangi (UNSIL) untuk Kemandirian Daerah', 'inovasi-smart-city-solusi-cerdas-universitas-siliwangi-unsil-untuk-kemandirian-daerah', 'Smart City', 'Kebutuhan automasi dan efisiensi digital di wilayah Tasikmalaya yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Tasikmalaya serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Siliwangi (UNSIL).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Produksi Terbatas (TRL 7)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-siliwangi-unsil.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-22.jpg', '/images/thumbnails/thumb-22.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 290, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(24, 1, 12, 24, 12, 'Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Siliwangi (UNSIL)', 'sistem-healthtech-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-siliwangi-unsil', 'HealthTech', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Validasi Komponen (TRL 5)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-siliwangi-unsil.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-23.jpg', '/images/thumbnails/thumb-23.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 150, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(25, 1, 13, 25, 13, 'Inovasi Creative Media: Solusi Cerdas UIN Sunan Gunung Djati Bandung untuk Kemandirian Daerah', 'inovasi-creative-media-solusi-cerdas-uin-sunan-gunung-djati-bandung-untuk-kemandirian-daerah', 'Creative Media', 'Kebutuhan automasi dan efisiensi digital di wilayah Bandung yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Bandung serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa UIN Sunan Gunung Djati Bandung.', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Prototipe Teruji (TRL 6)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.uin-sunan-gunung-djati-bandung.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-24.jpg', '/images/thumbnails/thumb-24.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 83, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(26, 1, 13, 26, 13, 'Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus UIN Sunan Gunung Djati Bandung', 'sistem-creative-media-berkelanjutan-pemberdayaan-digital-berbasis-kampus-uin-sunan-gunung-djati-bandung', 'Creative Media', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Prototipe Laboratorium (TRL 4)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.uin-sunan-gunung-djati-bandung.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-25.jpg', '/images/thumbnails/thumb-25.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 110, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(27, 1, 14, 27, 14, 'Inovasi AI/IoT: Solusi Cerdas Universitas Kristen Maranatha untuk Kemandirian Daerah', 'inovasi-aiiot-solusi-cerdas-universitas-kristen-maranatha-untuk-kemandirian-daerah', 'AI/IoT', 'Kebutuhan automasi dan efisiensi digital di wilayah Bandung yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Bandung serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Kristen Maranatha.', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Prototipe Laboratorium (TRL 4)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-kristen-maranatha.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-26.jpg', '/images/thumbnails/thumb-26.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 61, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(28, 1, 14, 28, 14, 'Sistem EdTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Kristen Maranatha', 'sistem-edtech-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-kristen-maranatha', 'EdTech', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Prototipe Laboratorium (TRL 4)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-kristen-maranatha.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-27.jpg', '/images/thumbnails/thumb-27.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 198, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(29, 1, 15, 29, 15, 'Inovasi AI/IoT: Solusi Cerdas Universitas Islam Bandung (UNISBA) untuk Kemandirian Daerah', 'inovasi-aiiot-solusi-cerdas-universitas-islam-bandung-unisba-untuk-kemandirian-daerah', 'AI/IoT', 'Kebutuhan automasi dan efisiensi digital di wilayah Bandung yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Bandung serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Islam Bandung (UNISBA).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Prototipe Laboratorium (TRL 4)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-islam-bandung-unisba.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-28.jpg', '/images/thumbnails/thumb-28.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 266, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(30, 1, 15, 30, 15, 'Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Islam Bandung (UNISBA)', 'sistem-creative-media-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-islam-bandung-unisba', 'Creative Media', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Produksi Terbatas (TRL 7)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-islam-bandung-unisba.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-29.jpg', '/images/thumbnails/thumb-29.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 170, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(31, 1, 16, 31, 16, 'Inovasi EdTech: Solusi Cerdas Universitas Swadaya Gunung Jati (UGJ) untuk Kemandirian Daerah', 'inovasi-edtech-solusi-cerdas-universitas-swadaya-gunung-jati-ugj-untuk-kemandirian-daerah', 'EdTech', 'Kebutuhan automasi dan efisiensi digital di wilayah Cirebon yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Cirebon serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Swadaya Gunung Jati (UGJ).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Prototipe Laboratorium (TRL 4)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-swadaya-gunung-jati-ugj.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-30.jpg', '/images/thumbnails/thumb-30.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 149, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(32, 1, 16, 32, 16, 'Sistem Smart City Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Swadaya Gunung Jati (UGJ)', 'sistem-smart-city-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-swadaya-gunung-jati-ugj', 'Smart City', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Produksi Terbatas (TRL 7)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-swadaya-gunung-jati-ugj.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-31.jpg', '/images/thumbnails/thumb-31.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 88, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(33, 1, 17, 33, 17, 'Inovasi Smart City: Solusi Cerdas Universitas Kuningan (UNIKU) untuk Kemandirian Daerah', 'inovasi-smart-city-solusi-cerdas-universitas-kuningan-uniku-untuk-kemandirian-daerah', 'Smart City', 'Kebutuhan automasi dan efisiensi digital di wilayah Kuningan yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Kuningan serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Kuningan (UNIKU).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Prototipe Teruji (TRL 6)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-kuningan-uniku.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-32.jpg', '/images/thumbnails/thumb-32.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 397, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(34, 1, 17, 34, 17, 'Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Kuningan (UNIKU)', 'sistem-creative-media-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-kuningan-uniku', 'Creative Media', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Produksi Terbatas (TRL 7)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-kuningan-uniku.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-33.jpg', '/images/thumbnails/thumb-33.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 385, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(35, 1, 18, 35, 18, 'Inovasi FinTech: Solusi Cerdas Universitas Majalengka (UNMA) untuk Kemandirian Daerah', 'inovasi-fintech-solusi-cerdas-universitas-majalengka-unma-untuk-kemandirian-daerah', 'FinTech', 'Kebutuhan automasi dan efisiensi digital di wilayah Majalengka yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Majalengka serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Majalengka (UNMA).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Produksi Terbatas (TRL 7)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-majalengka-unma.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-34.jpg', '/images/thumbnails/thumb-34.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 394, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(36, 1, 18, 36, 18, 'Sistem AI/IoT Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Majalengka (UNMA)', 'sistem-aiiot-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-majalengka-unma', 'AI/IoT', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Prototipe Laboratorium (TRL 4)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-majalengka-unma.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-35.jpg', '/images/thumbnails/thumb-35.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 355, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(37, 1, 19, 37, 19, 'Inovasi Smart City: Solusi Cerdas Universitas Galuh (UNIGAL) untuk Kemandirian Daerah', 'inovasi-smart-city-solusi-cerdas-universitas-galuh-unigal-untuk-kemandirian-daerah', 'Smart City', 'Kebutuhan automasi dan efisiensi digital di wilayah Ciamis yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Ciamis serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Galuh (UNIGAL).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Validasi Komponen (TRL 5)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-galuh-unigal.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-36.jpg', '/images/thumbnails/thumb-36.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 147, '2026-11-08 07:55:58', '2026-11-08 07:55:58');
INSERT INTO `projects` (`id`, `event_id`, `organization_id`, `team_id`, `booth_id`, `title`, `slug`, `category`, `problem_statement`, `target_users`, `solution_description`, `key_features`, `technology_stack`, `readiness_level`, `test_results`, `limitations`, `demo_url`, `video_url`, `poster_image`, `thumbnail`, `collaboration_needs`, `is_published_consent`, `status`, `is_locked`, `curator_notes`, `reviewed_by`, `reviewed_at`, `publication_status`, `is_pitch_finalist`, `pitch_order`, `view_count`, `created_at`, `updated_at`) VALUES
(38, 1, 19, 38, 19, 'Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Galuh (UNIGAL)', 'sistem-creative-media-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-galuh-unigal', 'Creative Media', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Validasi Komponen (TRL 5)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-galuh-unigal.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-37.jpg', '/images/thumbnails/thumb-37.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 113, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(39, 1, 20, 39, 20, 'Inovasi FinTech: Solusi Cerdas Politeknik Manufaktur Bandung (POLMAN) untuk Kemandirian Daerah', 'inovasi-fintech-solusi-cerdas-politeknik-manufaktur-bandung-polman-untuk-kemandirian-daerah', 'FinTech', 'Kebutuhan automasi dan efisiensi digital di wilayah Bandung yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Bandung serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Politeknik Manufaktur Bandung (POLMAN).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Prototipe Laboratorium (TRL 4)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.politeknik-manufaktur-bandung-polman.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-38.jpg', '/images/thumbnails/thumb-38.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 250, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(40, 1, 20, 40, 20, 'Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Politeknik Manufaktur Bandung (POLMAN)', 'sistem-healthtech-berkelanjutan-pemberdayaan-digital-berbasis-kampus-politeknik-manufaktur-bandung-polman', 'HealthTech', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Validasi Komponen (TRL 5)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.politeknik-manufaktur-bandung-polman.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-39.jpg', '/images/thumbnails/thumb-39.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 99, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(41, 1, 21, 41, 21, 'Inovasi HealthTech: Solusi Cerdas Politeknik Pos Indonesia (ULBI) untuk Kemandirian Daerah', 'inovasi-healthtech-solusi-cerdas-politeknik-pos-indonesia-ulbi-untuk-kemandirian-daerah', 'HealthTech', 'Kebutuhan automasi dan efisiensi digital di wilayah Bandung yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Bandung serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Politeknik Pos Indonesia (ULBI).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Validasi Komponen (TRL 5)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.politeknik-pos-indonesia-ulbi.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-40.jpg', '/images/thumbnails/thumb-40.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 284, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(42, 1, 21, 42, 21, 'Sistem FinTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Politeknik Pos Indonesia (ULBI)', 'sistem-fintech-berkelanjutan-pemberdayaan-digital-berbasis-kampus-politeknik-pos-indonesia-ulbi', 'FinTech', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Produksi Terbatas (TRL 7)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.politeknik-pos-indonesia-ulbi.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-41.jpg', '/images/thumbnails/thumb-41.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 376, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(43, 1, 22, 43, 22, 'Inovasi FinTech: Solusi Cerdas STMIK AMIK Bandung untuk Kemandirian Daerah', 'inovasi-fintech-solusi-cerdas-stmik-amik-bandung-untuk-kemandirian-daerah', 'FinTech', 'Kebutuhan automasi dan efisiensi digital di wilayah Bandung yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Bandung serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa STMIK AMIK Bandung.', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Produksi Terbatas (TRL 7)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.stmik-amik-bandung.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-42.jpg', '/images/thumbnails/thumb-42.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 377, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(44, 1, 22, 44, 22, 'Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus STMIK AMIK Bandung', 'sistem-healthtech-berkelanjutan-pemberdayaan-digital-berbasis-kampus-stmik-amik-bandung', 'HealthTech', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Produksi Terbatas (TRL 7)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.stmik-amik-bandung.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-43.jpg', '/images/thumbnails/thumb-43.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 328, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(45, 1, 23, 45, 23, 'Inovasi EdTech: Solusi Cerdas STMIK IKMI Cirebon untuk Kemandirian Daerah', 'inovasi-edtech-solusi-cerdas-stmik-ikmi-cirebon-untuk-kemandirian-daerah', 'EdTech', 'Kebutuhan automasi dan efisiensi digital di wilayah Cirebon yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Cirebon serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa STMIK IKMI Cirebon.', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Prototipe Teruji (TRL 6)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.stmik-ikmi-cirebon.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-44.jpg', '/images/thumbnails/thumb-44.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 105, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(46, 1, 23, 46, 23, 'Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus STMIK IKMI Cirebon', 'sistem-creative-media-berkelanjutan-pemberdayaan-digital-berbasis-kampus-stmik-ikmi-cirebon', 'Creative Media', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Validasi Komponen (TRL 5)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.stmik-ikmi-cirebon.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-45.jpg', '/images/thumbnails/thumb-45.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 326, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(47, 1, 24, 47, 24, 'Inovasi HealthTech: Solusi Cerdas Universitas Pakuan Bogor untuk Kemandirian Daerah', 'inovasi-healthtech-solusi-cerdas-universitas-pakuan-bogor-untuk-kemandirian-daerah', 'HealthTech', 'Kebutuhan automasi dan efisiensi digital di wilayah Bogor yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Bogor serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Pakuan Bogor.', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Produksi Terbatas (TRL 7)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-pakuan-bogor.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-46.jpg', '/images/thumbnails/thumb-46.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 109, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(48, 1, 24, 48, 24, 'Sistem EdTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Pakuan Bogor', 'sistem-edtech-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-pakuan-bogor', 'EdTech', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Prototipe Laboratorium (TRL 4)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-pakuan-bogor.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-47.jpg', '/images/thumbnails/thumb-47.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 178, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(49, 1, 25, 49, 25, 'Inovasi EdTech: Solusi Cerdas Universitas Ibn Khaldun Bogor untuk Kemandirian Daerah', 'inovasi-edtech-solusi-cerdas-universitas-ibn-khaldun-bogor-untuk-kemandirian-daerah', 'EdTech', 'Kebutuhan automasi dan efisiensi digital di wilayah Bogor yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Bogor serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Ibn Khaldun Bogor.', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Produksi Terbatas (TRL 7)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-ibn-khaldun-bogor.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-48.jpg', '/images/thumbnails/thumb-48.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 321, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(50, 1, 25, 50, 25, 'Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Ibn Khaldun Bogor', 'sistem-healthtech-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-ibn-khaldun-bogor', 'HealthTech', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Produksi Terbatas (TRL 7)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-ibn-khaldun-bogor.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-49.jpg', '/images/thumbnails/thumb-49.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 304, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(51, 1, 26, 51, 26, 'Inovasi FinTech: Solusi Cerdas Universitas Presiden (President University) untuk Kemandirian Daerah', 'inovasi-fintech-solusi-cerdas-universitas-presiden-president-university-untuk-kemandirian-daerah', 'FinTech', 'Kebutuhan automasi dan efisiensi digital di wilayah Bekasi yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Bekasi serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Presiden (President University).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Prototipe Teruji (TRL 6)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-presiden-president-university.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-50.jpg', '/images/thumbnails/thumb-50.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 324, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(52, 1, 26, 52, 26, 'Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Presiden (President University)', 'sistem-creative-media-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-presiden-president-university', 'Creative Media', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Prototipe Laboratorium (TRL 4)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-presiden-president-university.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-51.jpg', '/images/thumbnails/thumb-51.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 125, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(53, 1, 27, 53, 27, 'Inovasi HealthTech: Solusi Cerdas Universitas Djuanda Bogor untuk Kemandirian Daerah', 'inovasi-healthtech-solusi-cerdas-universitas-djuanda-bogor-untuk-kemandirian-daerah', 'HealthTech', 'Kebutuhan automasi dan efisiensi digital di wilayah Bogor yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Bogor serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Djuanda Bogor.', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Prototipe Laboratorium (TRL 4)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-djuanda-bogor.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-52.jpg', '/images/thumbnails/thumb-52.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 193, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(54, 1, 27, 54, 27, 'Sistem Smart City Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Djuanda Bogor', 'sistem-smart-city-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-djuanda-bogor', 'Smart City', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Produksi Terbatas (TRL 7)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-djuanda-bogor.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-53.jpg', '/images/thumbnails/thumb-53.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 201, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(55, 1, 28, 55, 28, 'Inovasi Smart City: Solusi Cerdas Universitas Muhammadiyah Sukabumi (UMMI) untuk Kemandirian Daerah', 'inovasi-smart-city-solusi-cerdas-universitas-muhammadiyah-sukabumi-ummi-untuk-kemandirian-daerah', 'Smart City', 'Kebutuhan automasi dan efisiensi digital di wilayah Sukabumi yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Sukabumi serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Muhammadiyah Sukabumi (UMMI).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Validasi Komponen (TRL 5)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-muhammadiyah-sukabumi-ummi.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-54.jpg', '/images/thumbnails/thumb-54.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 336, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(56, 1, 28, 56, 28, 'Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Muhammadiyah Sukabumi (UMMI)', 'sistem-creative-media-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-muhammadiyah-sukabumi-ummi', 'Creative Media', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Validasi Komponen (TRL 5)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-muhammadiyah-sukabumi-ummi.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-55.jpg', '/images/thumbnails/thumb-55.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 170, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(57, 1, 29, 57, 29, 'Inovasi FinTech: Solusi Cerdas Universitas Subang (UNSUB) untuk Kemandirian Daerah', 'inovasi-fintech-solusi-cerdas-universitas-subang-unsub-untuk-kemandirian-daerah', 'FinTech', 'Kebutuhan automasi dan efisiensi digital di wilayah Subang yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Subang serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Subang (UNSUB).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Prototipe Laboratorium (TRL 4)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-subang-unsub.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-56.jpg', '/images/thumbnails/thumb-56.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 267, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(58, 1, 29, 58, 29, 'Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Subang (UNSUB)', 'sistem-creative-media-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-subang-unsub', 'Creative Media', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Prototipe Teruji (TRL 6)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-subang-unsub.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-57.jpg', '/images/thumbnails/thumb-57.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 260, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(59, 1, 30, 59, 30, 'Inovasi AI/IoT: Solusi Cerdas Universitas Garut (UNIGA) untuk Kemandirian Daerah', 'inovasi-aiiot-solusi-cerdas-universitas-garut-uniga-untuk-kemandirian-daerah', 'AI/IoT', 'Kebutuhan automasi dan efisiensi digital di wilayah Garut yang membutuhkan solusi terjangkau dan handal.', 'Masyarakat dan UMKM di wilayah Garut serta dinas terkait pemerintah daerah.', 'Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Garut (UNIGA).', 'Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.', 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS', 'Validasi Komponen (TRL 5)', 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.', 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.', 'https://demo.universitas-garut-uniga.ac.id/p1', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-58.jpg', '/images/thumbnails/thumb-58.jpg', 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 327, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(60, 1, 30, 60, 30, 'Sistem FinTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Garut (UNIGA)', 'sistem-fintech-berkelanjutan-pemberdayaan-digital-berbasis-kampus-universitas-garut-uniga', 'FinTech', 'Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.', 'Pengambil kebijakan, akademisi, dan praktisi industri.', 'Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.', 'Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.', 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32', 'Produksi Terbatas (TRL 7)', 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.', 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.', 'https://demo.universitas-garut-uniga.ac.id/p2', 'https://youtube.com/watch?v=futurise2026', '/images/posters/poster-59.jpg', '/images/thumbnails/thumb-59.jpg', 'Pendanaan riset lanjutan dan pilot study.', 1, 'lolos', 0, 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.', 5, '2026-11-04 14:55:58', 'terbit', 0, NULL, 275, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(61, 1, 50, NULL, NULL, 'iot', 'iot', 'AI/IoT', 'iott', 'iot', 'iot', 'iot', 'iot', 'Prototipe Teruji', NULL, NULL, 'http://localhost/futurise', 'http://localhost/futurise', NULL, NULL, 'iot', 1, 'diajukan', 1, 'revisi materi', 1, '2026-11-13 15:25:24', 'terbit', 1, 2, 0, '2026-11-13 08:04:54', '2026-11-13 08:49:57'),
(62, 1, 50, 61, NULL, 'abcd', 'abcd', 'AI/IoT', 'abcd', 'abcd', 'abcd', 'abcd', 'abcd', 'Prototipe Teruji', NULL, NULL, 'http://localhost/futurise', 'http://localhost/futurise', NULL, NULL, 'abcd', 1, 'lolos', 1, NULL, 1, '2026-11-13 15:51:47', 'terbit', 0, NULL, 0, '2026-11-13 08:50:34', '2026-11-13 08:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `project_feedbacks`
--

CREATE TABLE `project_feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `giver_category` varchar(255) NOT NULL DEFAULT 'visitor',
  `giver_name` varchar(255) NOT NULL,
  `giver_organization` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `comment` text NOT NULL,
  `suggestion` text DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_feedbacks`
--

INSERT INTO `project_feedbacks` (`id`, `project_id`, `user_id`, `giver_category`, `giver_name`, `giver_organization`, `rating`, `comment`, `suggestion`, `is_public`, `created_at`, `updated_at`) VALUES
(1, 9, 46, 'visitor', 'Yessica Fara Desvia', NULL, 4, 'bagus', 'tingkatkan', 1, '2026-11-13 05:40:58', '2026-11-13 05:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `project_media`
--

CREATE TABLE `project_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `type` enum('image','poster','document','video') NOT NULL DEFAULT 'image',
  `title` varchar(255) DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_versions`
--

CREATE TABLE `project_versions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `version_number` int(11) NOT NULL DEFAULT 1,
  `snapshot_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`snapshot_data`)),
  `revision_notes` text DEFAULT NULL,
  `submitted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_versions`
--

INSERT INTO `project_versions` (`id`, `project_id`, `version_number`, `snapshot_data`, `revision_notes`, `submitted_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '{\"title\":\"AgriSense AI: Edge IoT & Computer Vision for Smart Paddy Monitoring\",\"solution\":\"Perangkat Edge AI bertenaga surya dengan sensor kelembaban multi-depth dan kamera deteksi optik hama berbasis YOLOv8 lokal.\",\"tech\":\"ESP32, Raspberry Pi Edge, PyTorch, LoRaWAN, Flutter, Laravel 12 API\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 2, 1, '{\"title\":\"NeuroStroke: Portable AI Tele-rehabilitation & EMG Glove\",\"solution\":\"Sarung tangan sensorik EMG dan bending fleksibel yang terhubung ke aplikasi gamifikasi pemulihan motorik berbasis tele-monitoring.\",\"tech\":\"Bio-EMG Sensor, BLE 5.0, Unity Mobile, Node.js WebSocket, PostgreSQL\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 3, 1, '{\"title\":\"CitarumGuard: Smart Autonomous Drone & River Pollution Indexer\",\"solution\":\"Drone otonom patroli terjadwal dengan kamera multispektral dan perahu pelampung mini pembaca pH, DO, TDS, serta temperatur terintegrasi satelit.\",\"tech\":\"Pixhawk 4, Jetson Orin Nano, OpenCV, Multispectral Sensor, Cloud Telemetry\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 4, 1, '{\"title\":\"PasarLink: Blockchain Decentralized Micro-Finance for Traditional Merchants\",\"solution\":\"Sistem pencatatan transaksi harian berbasis QRIS suara interaktif yang menghasilkan skor kelayakan kredit berbasis on-chain zero-knowledge.\",\"tech\":\"Solana Smart Contracts, Rust, React Native, AWS Lambda, OCR Struk\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 5, 1, '{\"title\":\"RoboTrash AI: Autonomous Indoor Sorting Robot with Robotic Arm\",\"solution\":\"Robot otonom pemilah sampah dengan lengan robotik 4-DOF dan visi komputer multimodal yang langsung memilah saat pengunjung membuang.\",\"tech\":\"ROS 2 Humble, NVIDIA Jetson, YOLOv9, LiDAR RPLIDAR A2, DC Planetary Motors\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 6, 1, '{\"title\":\"HeritageVR: Metaverse Budaya Sunda & Museum Virtual Angklung Udjo\",\"solution\":\"Platform virtual reality interaktif di mana pengguna dapat memainkan angklung virtual dengan pelacakan gestur tangan tanpa controller.\",\"tech\":\"Unreal Engine 5, Meta Quest OpenXR, WebXR, Spatial Audio API\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 7, 1, '{\"title\":\"StuntingZero: AI Early Childhood Growth Predictor & Nutrition Guide\",\"solution\":\"Aplikasi kamera foto berbasis computer vision yang menghitung tinggi badan balita secara presisi hanya dengan kartu kalibrasi standar.\",\"tech\":\"TensorFlow Lite, Kotlin, Python FastAPI, Cloud Run, Supabase\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 8, 1, '{\"title\":\"GreenTrace: Life Cycle Assessment & Carbon Footprint for MSME Garment\",\"solution\":\"SaaS kalkulator emisi karbon terotomasi berbasis data input bahan baku, listrik, dan logistik lokal dengan sertifikat digital blockchain.\",\"tech\":\"Laravel 12, Tailwind CSS, Vue 3, Polygon Network Smart Contract\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 9, 1, '{\"title\":\"AksaraAI: Interactive Sundanese Script Handwriting OCR & Adaptive Tutor\",\"solution\":\"Aplikasi tablet edukatif dengan AI pengenal goresan tulisan tangan Aksara Sunda secara real-time disertai umpan balik koreksi goresan.\",\"tech\":\"CNN Handwriting Recognition, ONNX Runtime Mobile, Flutter, SQLite\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 10, 1, '{\"title\":\"SimuLab AR: Low-Cost Augmented Reality Physics Experiment for Remote Schools\",\"solution\":\"Alat peraga AR berbasis marker kartu murah yang dapat memvisualisasikan medan magnet, pembiasan cahaya, dan gerak parabola secara 3D.\",\"tech\":\"ARCore, Unity, C#, Local Cache Database\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 11, 1, '{\"title\":\"SmartSolarMicrogrid: AI Peak-Shaving & Battery Optimization for Industry\",\"solution\":\"Kontroler cerdas berbasis algoritma prediksi beban LSTM yang mengatur switching baterai PLTS atap secara otomatis untuk memotong daya puncak.\",\"tech\":\"Modbus RTU, ESP32-S3, Python TensorFlow, Grafana, InfluxDB, Docker\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 12, 1, '{\"title\":\"MachinaVision: High-Speed Edge Defect Inspection for Conveyor Line\",\"solution\":\"Sistem vision kamera berkecepatan tinggi dengan pencahayaan stroboskopik dan model deteksi anomali real-time 120 botol\\/menit.\",\"tech\":\"Industrial GigE Camera, NVIDIA Jetson Xavier, TensorRT, PLC Siemens S7-1200\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 13, 1, '{\"title\":\"SmartPoultry: Acoustic & Computer Vision Welfare Monitor for Broiler Chicken\",\"solution\":\"Sistem AI pemantau suara batuk ayam (bioakustik) dan densitas persebaran gerak ayam menggunakan kamera thermal-RGB terintegrasi.\",\"tech\":\"Thermal Camera FLIR, Mel-Frequency Cepstral Coefficients (MFCC), Edge TPU, Node-RED\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 14, 1, '{\"title\":\"KopiTrace: AI Near-Infrared Bean Sorter & Origin Authentication for West Java Java Preanger\",\"solution\":\"Alat sortir biji kopi portabel dengan spektroskopi NIR mini dan algoritma machine learning pemilah biji cacat dan kadar air instan.\",\"tech\":\"NIR Spectral Sensor, Raspberry Pi 4, LightGBM, React Native Mobile\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 15, 1, '{\"title\":\"StructuralHealth: Wireless LoRa Accelerometer Network for Heritage Buildings\",\"solution\":\"Jaringan sensor akselerometer ultra-presisi nirkabel LoRaWAN berdaya baterai 3 tahun yang mendeteksi anomali frekuensi natural gedung.\",\"tech\":\"MEMS Accelerometer ADXL355, LoRaWAN 915MHz, Python SciPy, Web Dashboard GIS 3D\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 16, 1, '{\"title\":\"CivicVoice: NLP Sentiment Analysis for Public Policy Consultation Jabar\",\"solution\":\"Engine NLP berbahasa Indonesia dan dialek Sunda yang mengelompokkan aspirasi publik ke dalam topik prioritas dan sentimen urgensi.\",\"tech\":\"IndoBERT Fine-Tuned, Transformers, FastAPI, Elasticsearch, Kibana\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 17, 1, '{\"title\":\"LogisTrack AI: Smart Warehouse Pallet RFID & Autonomous Mobile Robot (AMR)\",\"solution\":\"Robot forklift mini otomatis (AMR) dengan pembaca RFID jarak jauh yang memperbarui peta lokasi stok 3D gudang secara real-time.\",\"tech\":\"UHF RFID Reader, ROS 2, Stereo Camera, Python, Fleet Management Server\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 18, 1, '{\"title\":\"PaddyYield: Satellite Multispectral Early Yield Forecasting for Karawang Granary\",\"solution\":\"Platform prediksi hasil panen padi 45 hari sebelum panen dengan integrasi citra satelit Sentinel-2 dan pemodelan machine learning indeks vegetasi NDVI\\/EVI.\",\"tech\":\"Google Earth Engine API, Sentinel-2 Multispectral, XGBoost, Mapbox GL\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 19, 1, '{\"title\":\"Inovasi Smart City: Solusi Cerdas Universitas Pasundan (UNPAS) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Pasundan (UNPAS).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 20, 1, '{\"title\":\"Sistem AI\\/IoT Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Pasundan (UNPAS)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 21, 1, '{\"title\":\"Inovasi Smart City: Solusi Cerdas Universitas Widyatama untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Widyatama.\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(22, 22, 1, '{\"title\":\"Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Widyatama\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(23, 23, 1, '{\"title\":\"Inovasi Smart City: Solusi Cerdas Universitas Siliwangi (UNSIL) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Siliwangi (UNSIL).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(24, 24, 1, '{\"title\":\"Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Siliwangi (UNSIL)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(25, 25, 1, '{\"title\":\"Inovasi Creative Media: Solusi Cerdas UIN Sunan Gunung Djati Bandung untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa UIN Sunan Gunung Djati Bandung.\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(26, 26, 1, '{\"title\":\"Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus UIN Sunan Gunung Djati Bandung\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(27, 27, 1, '{\"title\":\"Inovasi AI\\/IoT: Solusi Cerdas Universitas Kristen Maranatha untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Kristen Maranatha.\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(28, 28, 1, '{\"title\":\"Sistem EdTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Kristen Maranatha\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(29, 29, 1, '{\"title\":\"Inovasi AI\\/IoT: Solusi Cerdas Universitas Islam Bandung (UNISBA) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Islam Bandung (UNISBA).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(30, 30, 1, '{\"title\":\"Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Islam Bandung (UNISBA)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(31, 31, 1, '{\"title\":\"Inovasi EdTech: Solusi Cerdas Universitas Swadaya Gunung Jati (UGJ) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Swadaya Gunung Jati (UGJ).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(32, 32, 1, '{\"title\":\"Sistem Smart City Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Swadaya Gunung Jati (UGJ)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(33, 33, 1, '{\"title\":\"Inovasi Smart City: Solusi Cerdas Universitas Kuningan (UNIKU) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Kuningan (UNIKU).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(34, 34, 1, '{\"title\":\"Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Kuningan (UNIKU)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(35, 35, 1, '{\"title\":\"Inovasi FinTech: Solusi Cerdas Universitas Majalengka (UNMA) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Majalengka (UNMA).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(36, 36, 1, '{\"title\":\"Sistem AI\\/IoT Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Majalengka (UNMA)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(37, 37, 1, '{\"title\":\"Inovasi Smart City: Solusi Cerdas Universitas Galuh (UNIGAL) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Galuh (UNIGAL).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(38, 38, 1, '{\"title\":\"Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Galuh (UNIGAL)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(39, 39, 1, '{\"title\":\"Inovasi FinTech: Solusi Cerdas Politeknik Manufaktur Bandung (POLMAN) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Politeknik Manufaktur Bandung (POLMAN).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(40, 40, 1, '{\"title\":\"Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Politeknik Manufaktur Bandung (POLMAN)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(41, 41, 1, '{\"title\":\"Inovasi HealthTech: Solusi Cerdas Politeknik Pos Indonesia (ULBI) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Politeknik Pos Indonesia (ULBI).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(42, 42, 1, '{\"title\":\"Sistem FinTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Politeknik Pos Indonesia (ULBI)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(43, 43, 1, '{\"title\":\"Inovasi FinTech: Solusi Cerdas STMIK AMIK Bandung untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa STMIK AMIK Bandung.\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(44, 44, 1, '{\"title\":\"Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus STMIK AMIK Bandung\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(45, 45, 1, '{\"title\":\"Inovasi EdTech: Solusi Cerdas STMIK IKMI Cirebon untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa STMIK IKMI Cirebon.\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(46, 46, 1, '{\"title\":\"Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus STMIK IKMI Cirebon\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(47, 47, 1, '{\"title\":\"Inovasi HealthTech: Solusi Cerdas Universitas Pakuan Bogor untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Pakuan Bogor.\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(48, 48, 1, '{\"title\":\"Sistem EdTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Pakuan Bogor\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(49, 49, 1, '{\"title\":\"Inovasi EdTech: Solusi Cerdas Universitas Ibn Khaldun Bogor untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Ibn Khaldun Bogor.\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(50, 50, 1, '{\"title\":\"Sistem HealthTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Ibn Khaldun Bogor\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(51, 51, 1, '{\"title\":\"Inovasi FinTech: Solusi Cerdas Universitas Presiden (President University) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Presiden (President University).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(52, 52, 1, '{\"title\":\"Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Presiden (President University)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(53, 53, 1, '{\"title\":\"Inovasi HealthTech: Solusi Cerdas Universitas Djuanda Bogor untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Djuanda Bogor.\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(54, 54, 1, '{\"title\":\"Sistem Smart City Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Djuanda Bogor\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(55, 55, 1, '{\"title\":\"Inovasi Smart City: Solusi Cerdas Universitas Muhammadiyah Sukabumi (UMMI) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Muhammadiyah Sukabumi (UMMI).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(56, 56, 1, '{\"title\":\"Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Muhammadiyah Sukabumi (UMMI)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(57, 57, 1, '{\"title\":\"Inovasi FinTech: Solusi Cerdas Universitas Subang (UNSUB) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Subang (UNSUB).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(58, 58, 1, '{\"title\":\"Sistem Creative Media Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Subang (UNSUB)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(59, 59, 1, '{\"title\":\"Inovasi AI\\/IoT: Solusi Cerdas Universitas Garut (UNIGA) untuk Kemandirian Daerah\",\"solution\":\"Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa Universitas Garut (UNIGA).\",\"tech\":\"Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(60, 60, 1, '{\"title\":\"Sistem FinTech Berkelanjutan: Pemberdayaan Digital Berbasis Kampus Universitas Garut (UNIGA)\",\"solution\":\"Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.\",\"tech\":\"Vue.js, Express\\/Laravel, PostgreSQL, MQTT, ESP32\"}', 'Pengajuan berkas awal karya', 13, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(61, 61, 1, '{\"id\":61,\"event_id\":1,\"organization_id\":50,\"team_id\":null,\"booth_id\":null,\"title\":\"iot\",\"slug\":\"iot\",\"category\":\"AI\\/IoT\",\"problem_statement\":\"iot\",\"target_users\":\"iot\",\"solution_description\":\"iot\",\"key_features\":\"iot\",\"technology_stack\":\"iot\",\"readiness_level\":\"Prototipe Teruji\",\"test_results\":null,\"limitations\":null,\"demo_url\":\"http:\\/\\/localhost\\/futurise\",\"video_url\":\"http:\\/\\/localhost\\/futurise\",\"poster_image\":null,\"thumbnail\":null,\"collaboration_needs\":\"iot\",\"is_published_consent\":true,\"status\":\"perlu_revisi\",\"is_locked\":false,\"curator_notes\":\"revisi materi\",\"reviewed_by\":1,\"reviewed_at\":\"2026-11-13T15:25:24.000000Z\",\"publication_status\":\"terbit\",\"is_pitch_finalist\":true,\"pitch_order\":2,\"view_count\":0,\"created_at\":\"2026-11-13T15:04:54.000000Z\",\"updated_at\":\"2026-11-13T15:25:24.000000Z\",\"organization\":{\"id\":50,\"event_id\":1,\"type\":\"campus\",\"name\":\"Universitas ABCD\",\"slug\":\"universitas-abcd-tnejeg\",\"address\":null,\"city\":null,\"website\":null,\"logo\":null,\"pic_name\":\"PIC Kampus\",\"pic_position\":null,\"pic_email\":\"pickampus@gmail.com\",\"pic_phone\":\"082145678923\",\"pic_contact_public\":false,\"status\":\"verified\",\"verification_notes\":null,\"created_at\":\"2026-11-13T14:57:30.000000Z\",\"updated_at\":\"2026-11-13T15:04:10.000000Z\"}}', 'Pembaruan materi oleh PIC/Tim', 51, '2026-11-13 08:49:24', '2026-11-13 08:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `publication_approvals`
--

CREATE TABLE `publication_approvals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `approved_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('approved','rejected') NOT NULL DEFAULT 'approved',
  `remarks` text DEFAULT NULL,
  `approved_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publication_approvals`
--

INSERT INTO `publication_approvals` (`id`, `project_id`, `approved_by`, `status`, `remarks`, `approved_at`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'approved', 'Disetujui publikasi oleh panitia program.', '2026-11-13 10:33:01', '2026-11-08 07:55:58', '2026-11-13 03:33:01'),
(2, 2, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 3, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 4, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 5, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 6, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 7, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 8, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 9, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 10, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 11, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 12, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 13, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 14, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 15, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 16, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 17, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 18, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 19, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 20, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 21, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(22, 22, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(23, 23, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(24, 24, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(25, 25, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(26, 26, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(27, 27, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(28, 28, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(29, 29, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(30, 30, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(31, 31, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(32, 32, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(33, 33, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(34, 34, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(35, 35, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(36, 36, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(37, 37, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(38, 38, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(39, 39, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(40, 40, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(41, 41, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(42, 42, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(43, 43, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(44, 44, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(45, 45, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(46, 46, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(47, 47, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(48, 48, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(49, 49, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(50, 50, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(51, 51, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(52, 52, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(53, 53, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(54, 54, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(55, 55, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(56, 56, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(57, 57, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(58, 58, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(59, 59, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(60, 60, 9, 'approved', 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.', '2026-11-05 14:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(61, 61, 1, 'approved', 'Disetujui oleh petugas publikasi.', '2026-11-13 15:16:30', '2026-11-13 08:13:54', '2026-11-13 08:16:30'),
(62, 62, 1, 'approved', 'Disetujui oleh petugas publikasi.', '2026-11-13 15:52:02', '2026-11-13 08:52:02', '2026-11-13 08:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `registration_code` varchar(255) NOT NULL,
  `status` enum('submitted','verified','confirmed','cancelled') NOT NULL DEFAULT 'submitted',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `event_id`, `organization_id`, `user_id`, `category`, `registration_code`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 47, 47, 'school', 'REG-QKYTLQNHLM', 'verified', NULL, '2026-11-13 06:33:38', '2026-11-13 06:34:09'),
(2, 1, 48, 48, 'sponsor', 'REG-HZUQ05SWZM', 'verified', NULL, '2026-11-13 06:54:23', '2026-11-13 06:57:03'),
(3, 1, 49, 49, 'industry', 'REG-W74CQKFR3M', 'verified', NULL, '2026-11-13 07:30:01', '2026-11-13 07:36:30'),
(4, 1, 50, 51, 'campus', 'REG-YZL82ZL5L8', 'verified', NULL, '2026-11-13 07:57:30', '2026-11-13 08:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', 'Konfigurasi acara, pengguna, peran dan seluruh modul.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(2, 'Ketua Pelaksana', 'ketua-pelaksana', 'Dashboard lintas divisi, kesiapan, kendala, keputusan dan laporan.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(3, 'Sekretariat', 'sekretariat', 'Administrasi, dokumen, pengumuman dan korespondensi.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(4, 'Keuangan', 'keuangan', 'Tagihan, verifikasi penerimaan, alokasi pembayaran dan laporan dana.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(5, 'Program dan Kurasi', 'program-kurasi', 'Pemeriksaan karya, revisi, keputusan, penugasan juri dan finalis pitching.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(6, 'Kampus dan Sekolah', 'kampus-sekolah', 'Verifikasi kampus, rombongan sekolah dan jadwal tur.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(7, 'Industri dan Sponsor', 'industri-sponsor', 'Prospek, penawaran, kesepakatan, manfaat, materi dan pertemuan.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(8, 'Venue dan Teknis', 'venue-teknis', 'Alokasi booth, denah, perangkat, listrik, internet, loading dan checklist.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(9, 'Publikasi', 'publikasi', 'CMS, katalog publik, media, sponsor publik dan dokumentasi.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(10, 'Registrasi dan Layanan', 'registrasi-layanan', 'Check-in, pencarian peserta, antrean dan tiket bantuan.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(11, 'PIC Kampus', 'pic-kampus', 'Profil institusi, tim, dua karya usulan, dokumen dan administrasi kampusnya.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(12, 'Tim Mahasiswa', 'tim-mahasiswa', 'Materi karya yang ditugaskan, jadwal, feedback dan tindak lanjut.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(13, 'PIC Industri / Mitra', 'pic-industri', 'Profil, partisipasi, teknis dan pertemuan organisasinya.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(14, 'PIC Sponsor', 'pic-sponsor', 'Kesepakatan, materi dan manfaat sponsor organisasinya.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(15, 'PIC Sekolah', 'pic-sekolah', 'Rombongan, slot tur dan konfirmasi sekolahnya.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(16, 'Juri', 'juri', 'Karya yang ditugaskan dan penilaian sendiri.', '2026-11-08 07:55:52', '2026-11-08 07:55:52'),
(17, 'Pengunjung', 'pengunjung', 'Tiket, aktivitas, feedback, voting dan survei sesuai ketentuan.', '2026-11-08 07:55:52', '2026-11-08 07:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 3, NULL, NULL),
(4, 4, 4, NULL, NULL),
(5, 5, 5, NULL, NULL),
(6, 6, 6, NULL, NULL),
(7, 7, 7, NULL, NULL),
(8, 8, 8, NULL, NULL),
(9, 9, 9, NULL, NULL),
(10, 10, 10, NULL, NULL),
(11, 11, 16, NULL, NULL),
(12, 12, 16, NULL, NULL),
(13, 13, 11, NULL, NULL),
(14, 14, 12, NULL, NULL),
(15, 15, 11, NULL, NULL),
(16, 16, 11, NULL, NULL),
(17, 17, 13, NULL, NULL),
(18, 18, 14, NULL, NULL),
(19, 19, 15, NULL, NULL),
(20, 20, 17, NULL, NULL),
(21, 1, 2, NULL, NULL),
(22, 1, 16, NULL, NULL),
(23, 46, 17, NULL, NULL),
(24, 47, 15, NULL, NULL),
(25, 48, 14, NULL, NULL),
(26, 49, 13, NULL, NULL),
(27, 50, 12, NULL, NULL),
(28, 51, 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rubric_versions`
--

CREATE TABLE `rubric_versions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `version_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rubric_versions`
--

INSERT INTO `rubric_versions` (`id`, `event_id`, `version_name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rubrik Kurasi & Penjurian FUTURiSE 2026 v1.0', 'Standar penilaian karya inovasi digital mahasiswa APTIKOM Jawa Barat', 1, '2026-11-08 07:55:52', '2026-11-08 07:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `school_profiles`
--

CREATE TABLE `school_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `school_type` varchar(255) NOT NULL DEFAULT 'SMK',
  `principal_name` varchar(255) DEFAULT NULL,
  `total_students_group` int(11) NOT NULL DEFAULT 0,
  `total_teachers_group` int(11) NOT NULL DEFAULT 0,
  `visit_purpose` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_profiles`
--

INSERT INTO `school_profiles` (`id`, `organization_id`, `school_type`, `principal_name`, `total_students_group`, `total_teachers_group`, `visit_purpose`, `created_at`, `updated_at`) VALUES
(1, 46, 'SMK', 'Dr. H. Asep Tapip Yani, M.Pd.', 80, 6, 'Eksplorasi Inovasi Digital Kampus & Pengenalan Program Studi Informatika untuk Siswa RPL, TKJ, dan SIJA.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 47, 'SMK', NULL, 0, 0, NULL, '2026-11-13 06:33:38', '2026-11-13 06:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `school_visits`
--

CREATE TABLE `school_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tour_slot_id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `student_count` int(11) NOT NULL DEFAULT 0,
  `teacher_count` int(11) NOT NULL DEFAULT 0,
  `pic_name` varchar(255) NOT NULL,
  `pic_phone` varchar(255) NOT NULL,
  `qr_group_token` varchar(255) NOT NULL,
  `arrival_status` enum('registered','confirmed','arrived','completed') NOT NULL DEFAULT 'registered',
  `arrived_at` datetime DEFAULT NULL,
  `actual_attendees` int(11) NOT NULL DEFAULT 0,
  `arrival_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_visits`
--

INSERT INTO `school_visits` (`id`, `tour_slot_id`, `organization_id`, `student_count`, `teacher_count`, `pic_name`, `pic_phone`, `qr_group_token`, `arrival_status`, `arrived_at`, `actual_attendees`, `arrival_notes`, `created_at`, `updated_at`) VALUES
(1, 1, 46, 80, 6, 'Dra. Endang Sulastri', '081240000001', 'GRP-SMKN4BDG-WDLFDTCW', 'confirmed', NULL, 86, 'Rombongan menggunakan 2 bus pariwisata, tiba pukul 08.45 WIB di Gate Bus Sabuga.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 47, 50, 5, 'PIC Sekolah', '082212345678', 'GRP-D081970D0E0D967E', 'arrived', '2026-11-13 13:51:21', 50, '1 unit bus pariwisata', '2026-11-13 06:36:45', '2026-11-13 06:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assessment_id` bigint(20) UNSIGNED NOT NULL,
  `criterion_id` bigint(20) UNSIGNED NOT NULL,
  `score_value` int(11) NOT NULL,
  `weighted_score` decimal(5,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `assessment_id`, `criterion_id`, `score_value`, `weighted_score`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 25.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-13 06:28:49'),
(2, 1, 2, 3, 15.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-13 06:28:49'),
(3, 1, 3, 5, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-13 06:28:49'),
(4, 1, 4, 4, 16.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-13 06:28:49'),
(5, 1, 5, 4, 8.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-13 06:28:49'),
(6, 2, 1, 5, 25.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 2, 2, 4, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 2, 3, 5, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 2, 4, 4, 16.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 2, 5, 4, 8.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 3, 1, 5, 25.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 3, 2, 5, 25.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 3, 3, 4, 16.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 3, 4, 5, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 3, 5, 5, 10.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 4, 1, 5, 25.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 4, 2, 4, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 4, 3, 5, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 4, 4, 4, 16.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 4, 5, 5, 10.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 5, 1, 5, 25.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(22, 5, 2, 5, 25.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(23, 5, 3, 5, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(24, 5, 4, 5, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(25, 5, 5, 5, 10.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(26, 6, 1, 5, 25.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(27, 6, 2, 5, 25.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(28, 6, 3, 3, 12.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(29, 6, 4, 5, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(30, 6, 5, 4, 8.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(31, 7, 1, 4, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(32, 7, 2, 4, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(33, 7, 3, 4, 16.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(34, 7, 4, 5, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(35, 7, 5, 5, 10.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(36, 8, 1, 4, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(37, 8, 2, 5, 25.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(38, 8, 3, 3, 12.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(39, 8, 4, 4, 16.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(40, 8, 5, 4, 8.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(41, 9, 1, 4, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(42, 9, 2, 5, 25.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(43, 9, 3, 4, 16.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(44, 9, 4, 3, 12.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(45, 9, 5, 5, 10.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(46, 10, 1, 4, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(47, 10, 2, 4, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(48, 10, 3, 5, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(49, 10, 4, 5, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(50, 10, 5, 4, 8.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(51, 11, 1, 5, 25.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(52, 11, 2, 5, 25.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(53, 11, 3, 5, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(54, 11, 4, 3, 12.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(55, 11, 5, 4, 8.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(56, 12, 1, 4, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(57, 12, 2, 4, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(58, 12, 3, 5, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(59, 12, 4, 5, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(60, 12, 5, 5, 10.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(61, 13, 1, 4, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(62, 13, 2, 5, 25.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(63, 13, 3, 5, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(64, 13, 4, 5, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(65, 13, 5, 4, 8.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(66, 14, 1, 4, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(67, 14, 2, 5, 25.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(68, 14, 3, 5, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(69, 14, 4, 4, 16.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(70, 14, 5, 4, 8.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(71, 15, 1, 4, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(72, 15, 2, 5, 25.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(73, 15, 3, 5, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(74, 15, 4, 5, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(75, 15, 5, 4, 8.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(76, 16, 1, 5, 25.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(77, 16, 2, 4, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(78, 16, 3, 3, 12.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(79, 16, 4, 5, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(80, 16, 5, 5, 10.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(81, 17, 1, 4, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(82, 17, 2, 5, 25.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(83, 17, 3, 4, 16.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(84, 17, 4, 5, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(85, 17, 5, 5, 10.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(86, 18, 1, 5, 25.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(87, 18, 2, 4, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(88, 18, 3, 5, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(89, 18, 4, 5, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(90, 18, 5, 5, 10.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(91, 19, 1, 5, 25.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(92, 19, 2, 4, 20.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(93, 19, 3, 4, 16.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(94, 19, 4, 3, 12.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(95, 19, 5, 5, 10.00, 'Indikator teruji baik saat demonstrasi.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(96, 20, 1, 5, 25.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(97, 20, 2, 5, 25.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(98, 20, 3, 4, 16.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(99, 20, 4, 5, 20.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(100, 20, 5, 5, 10.00, 'Penilaian juri industri.', '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('LdJLsFtW804EK3HBQgEUPp2jETSeZOCREZGIBka4', 2, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR013aHpObEYyeGk1eUtlZTMydERaeXM5em5pY3dRSzlubWxEMzFYZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3QvZnV0dXJpc2UvcHVibGljL2FkbWluIjtzOjU6InJvdXRlIjtzOjE1OiJhZG1pbi5kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjY0OiJkM2VkNTVmZjBmMmZlMmMwYjdiOGUxNzcyNDBmYzA5MzNmMzg0YzcyMzcwN2Q0YzYxMWFiZWZhMGQ2N2YwMGEwIjt9', 1794588796),
('LL5AU5hQaczazkkhH4nImQpqtNwYm4hS735ktUjG', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/601.2.4 (KHTML, like Gecko) Version/9.0.1 Safari/601.2.4 facebookexternalhit/1.1 Facebot Twitterbot/1.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieUdtd3Ewd3pWR0ZiWXhYYkRJSVlpVVZBdTkzZWtLbG41RGttUFJ3NSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cDovL2xvY2FsaG9zdC9mdXR1cmlzZS9wdWJsaWMvYWRtaW4vdXNlcnMiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozODoiaHR0cDovL2xvY2FsaG9zdC9mdXR1cmlzZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1794796542),
('vif8iBWmUyRSIWUsaNPHUaFB3s2qtssAE968ddfy', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5.2 Safari/605.1.15', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaWdEZXpOQWduNVhRaHZLMUdvYUR2VlNGQXk0U0VrUnhkWG5xSW9hOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3QvZnV0dXJpc2UvcHVibGljL2FkbWluL3VzZXJzIjtzOjU6InJvdXRlIjtzOjExOiJhZG1pbi51c2VycyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6ImU1NWIwYWVhODkwMGI3MTE5N2FjMzVlZGIzMjFiMzcxOGM3MWNjYTY1NGFhYzJkNWFiYzU0YzA4NGMzYjE4NGQiO30=', 1794588767);

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `speakers`
--

INSERT INTO `speakers` (`id`, `session_id`, `name`, `title`, `organization`, `photo`, `bio`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dr. H. Bey Triadi Machmudin, S.E., M.T.', 'Pj Gubernur Jawa Barat', 'Pemerintah Provinsi Jawa Barat', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 'Prof. Ir. Nizam, M.Sc., Ph.D.', 'Dewan Pembina APTIKOM', 'APTIKOM Pusat', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 'Direktur Enterprise PT Telkom Indonesia', 'Keynote Speaker', 'Telkom Indonesia', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 3, 'Dewan Juri Akademisi & Industri APTIKOM Jabar', 'Juri Pitching', 'APTIKOM Jabar', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 6, 'Prof. Dr. Ir. Juri Senior', 'Pakar AI Indonesia', 'APTIKOM Jabar', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 6, 'Head of People & Culture Dicoding', 'Panelis Industri', 'Dicoding Indonesia', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 7, 'Ketua Pelaksana FUTURiSE 2026', 'Host & Ketua', 'APTIKOM Jawa Barat', NULL, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorship_agreements`
--

CREATE TABLE `sponsorship_agreements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `agreement_number` varchar(255) NOT NULL,
  `agreed_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `support_type` enum('cash','in_kind','hybrid') NOT NULL DEFAULT 'cash',
  `in_kind_description` text DEFAULT NULL,
  `status` enum('draft','offered','agreed','signed','cancelled') NOT NULL DEFAULT 'draft',
  `agreed_at` datetime DEFAULT NULL,
  `contract_document` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsorship_agreements`
--

INSERT INTO `sponsorship_agreements` (`id`, `event_id`, `organization_id`, `package_id`, `agreement_number`, `agreed_amount`, `support_type`, `in_kind_description`, `status`, `agreed_at`, `contract_document`, `created_at`, `updated_at`) VALUES
(1, 1, 32, 1, 'SPON/FTR-2026/001-BJB', 50000000.00, 'cash', NULL, 'signed', '2026-10-29 14:55:58', '/docs/contracts/spk-bjb-platinum.pdf', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 31, 1, 'SPON/FTR-2026/002-TLKM', 30000000.00, 'hybrid', 'Dedicated Bandwidth 1 Gbps Sabuga & Cloud Server Hosting 1 Tahun untuk Pemenang', 'signed', '2026-10-31 14:55:58', NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 48, 1, 'SPON/2026/0861ED5A', 20000000.00, 'cash', '-', 'signed', '2026-11-13 21:21:00', NULL, '2026-11-13 07:22:39', '2026-11-13 07:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorship_packages`
--

CREATE TABLE `sponsorship_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `quota` int(11) NOT NULL DEFAULT 5,
  `benefits_summary` text DEFAULT NULL,
  `includes_booth` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsorship_packages`
--

INSERT INTO `sponsorship_packages` (`id`, `event_id`, `name`, `slug`, `price`, `quota`, `benefits_summary`, `includes_booth`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Platinum Sponsor', 'platinum', 50000000.00, 2, 'Booth Korporat Utama 4x4m, Keynote Speaker Sesi Pleno, Logo Raksasa Main Stage & Website, Video Profil 60s di Layar LED Utama Sabuga.', 1, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 'Gold Sponsor', 'gold', 25000000.00, 4, 'Booth Korporat 3x3m, Panel Speaker di Sesi Industri, Penayangan Logo di Buku Program & Sertifikat, Akses Meja Prioritas Matchmaking.', 1, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 'Silver Sponsor', 'silver', 10000000.00, 6, 'Logo di Backdrop Acara, Website, Media Sosial Resmi APTIKOM Jabar, 2 VIP Pass Gala Dinner.', 0, 1, '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_code` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'pendaftaran',
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('open','in_review','answered','closed') NOT NULL DEFAULT 'open',
  `priority` enum('normal','urgent') NOT NULL DEFAULT 'normal',
  `response_text` text DEFAULT NULL,
  `responded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `responded_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `ticket_code`, `category`, `subject`, `message`, `status`, `priority`, `response_text`, `responded_by`, `responded_at`, `created_at`, `updated_at`) VALUES
(1, 13, 'HLP-100234', 'booth', 'Permintaan Tambahan Daya Listrik untuk Mesin Edge AI', 'Selamat siang panitia, kami membutuhkan penambahan daya sekitar 200 Watt untuk power supply box Edge AI di Booth B-01.', 'answered', 'normal', 'Permintaan telah disetujui oleh tim Venue & Teknis. Stop kontak tambahan akan disiapkan di Booth B-01 tanpa biaya tambahan.', 8, '2026-11-08 09:56:05', '2026-11-08 07:56:05', '2026-11-08 07:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `survey_responses`
--

CREATE TABLE `survey_responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `satisfaction_score` int(11) NOT NULL,
  `respondent_category` varchar(255) NOT NULL DEFAULT 'visitor',
  `feedback_text` text DEFAULT NULL,
  `would_recommend` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `survey_responses`
--

INSERT INTO `survey_responses` (`id`, `event_id`, `user_id`, `ticket_id`, `satisfaction_score`, `respondent_category`, `feedback_text`, `would_recommend`, `created_at`, `updated_at`) VALUES
(1, 1, 21, 2, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(2, 1, 22, 3, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(3, 1, 23, 4, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(4, 1, 24, 5, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(5, 1, 25, 6, 4, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(6, 1, 26, 7, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(7, 1, 27, 8, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(8, 1, 28, 9, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(9, 1, 29, 10, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(10, 1, 30, 11, 3, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(11, 1, 31, 12, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(12, 1, 32, 13, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(13, 1, 33, 14, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(14, 1, 34, 15, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(15, 1, 35, 16, 4, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(16, 1, 36, 17, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(17, 1, 37, 18, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(18, 1, 38, 19, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(19, 1, 39, 20, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(20, 1, 40, 21, 3, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:04', '2026-11-08 07:56:04'),
(21, 1, 41, 22, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:04', '2026-11-08 07:56:04'),
(22, 1, 42, 23, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:04', '2026-11-08 07:56:04'),
(23, 1, 43, 24, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(24, 1, 44, 25, 5, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(25, 1, 45, 26, 4, 'visitor', 'Acaranya sangat keren dan inovasi kampusnya inspiratif!', 1, '2026-11-08 07:56:05', '2026-11-08 07:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `due_date` date NOT NULL,
  `status` enum('todo','in_progress','completed','blocked') NOT NULL DEFAULT 'todo',
  `priority` enum('low','medium','high','urgent') NOT NULL DEFAULT 'medium',
  `description` text DEFAULT NULL,
  `proof_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `event_id`, `title`, `division`, `assigned_to`, `due_date`, `status`, `priority`, `description`, `proof_file`, `created_at`, `updated_at`) VALUES
(1, 1, 'Finalisasi Sound System dan Layar LED Panggung Utama Sabuga', 'venue', 8, '2026-11-13', 'in_progress', 'high', 'Pastikan kabel HDMI switcher dan mic wireless juri siap pakai.', NULL, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(2, 1, 'Cetak Name Tag Peserta & E-Ticket Scanner Android Gate Sabuga', 'pendaftaran', 10, '2026-11-11', 'completed', 'urgent', '10 unit smartphone scanner telah terinstall aplikasi registrasi.', NULL, '2026-11-08 07:56:05', '2026-11-08 07:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `organization_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tim Ganendra AgroTech ITB', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 'Tim Bionika Medika ITB', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 2, 'AeroVision Lab Tel-U', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 2, 'Tim Fintech Rakyat Tel-U', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 3, 'Tim Robotika Juara UNIKOM', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 3, 'Divisi Multimedia Animasi UNIKOM', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 4, 'Tim Padjadjaran Inovasi Kesehatan', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 4, 'Green Economy Lab UNPAD', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 5, 'Laboratorium EduTech UPI', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 5, 'Fisika Inovatif UPI', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 6, 'Pusat Riset Energi Terbarukan POLBAN', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 6, 'Otomasi Industri POLBAN', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 10, 'IPB Precision Livestock Team', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 10, 'Agro-Robotics IPB', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 7, 'Civil & Computer Science Collaboration UNPAR', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 7, 'Data Science Parahyangan', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 11, 'Tim Otomasi Logistik UNSIKA', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 11, 'Geoinformatika UNSIKA', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 8, 'Tim Inovator 1 Universitas Pasundan (UNPAS)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 8, 'Tim Inovator 2 Universitas Pasundan (UNPAS)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 9, 'Tim Inovator 1 Universitas Widyatama', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(22, 9, 'Tim Inovator 2 Universitas Widyatama', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(23, 12, 'Tim Inovator 1 Universitas Siliwangi (UNSIL)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(24, 12, 'Tim Inovator 2 Universitas Siliwangi (UNSIL)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(25, 13, 'Tim Inovator 1 UIN Sunan Gunung Djati Bandung', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(26, 13, 'Tim Inovator 2 UIN Sunan Gunung Djati Bandung', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(27, 14, 'Tim Inovator 1 Universitas Kristen Maranatha', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(28, 14, 'Tim Inovator 2 Universitas Kristen Maranatha', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(29, 15, 'Tim Inovator 1 Universitas Islam Bandung (UNISBA)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(30, 15, 'Tim Inovator 2 Universitas Islam Bandung (UNISBA)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(31, 16, 'Tim Inovator 1 Universitas Swadaya Gunung Jati (UGJ)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(32, 16, 'Tim Inovator 2 Universitas Swadaya Gunung Jati (UGJ)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(33, 17, 'Tim Inovator 1 Universitas Kuningan (UNIKU)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(34, 17, 'Tim Inovator 2 Universitas Kuningan (UNIKU)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(35, 18, 'Tim Inovator 1 Universitas Majalengka (UNMA)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(36, 18, 'Tim Inovator 2 Universitas Majalengka (UNMA)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(37, 19, 'Tim Inovator 1 Universitas Galuh (UNIGAL)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(38, 19, 'Tim Inovator 2 Universitas Galuh (UNIGAL)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(39, 20, 'Tim Inovator 1 Politeknik Manufaktur Bandung (POLMAN)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(40, 20, 'Tim Inovator 2 Politeknik Manufaktur Bandung (POLMAN)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(41, 21, 'Tim Inovator 1 Politeknik Pos Indonesia (ULBI)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(42, 21, 'Tim Inovator 2 Politeknik Pos Indonesia (ULBI)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(43, 22, 'Tim Inovator 1 STMIK AMIK Bandung', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(44, 22, 'Tim Inovator 2 STMIK AMIK Bandung', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(45, 23, 'Tim Inovator 1 STMIK IKMI Cirebon', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(46, 23, 'Tim Inovator 2 STMIK IKMI Cirebon', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(47, 24, 'Tim Inovator 1 Universitas Pakuan Bogor', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(48, 24, 'Tim Inovator 2 Universitas Pakuan Bogor', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(49, 25, 'Tim Inovator 1 Universitas Ibn Khaldun Bogor', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(50, 25, 'Tim Inovator 2 Universitas Ibn Khaldun Bogor', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(51, 26, 'Tim Inovator 1 Universitas Presiden (President University)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(52, 26, 'Tim Inovator 2 Universitas Presiden (President University)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(53, 27, 'Tim Inovator 1 Universitas Djuanda Bogor', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(54, 27, 'Tim Inovator 2 Universitas Djuanda Bogor', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(55, 28, 'Tim Inovator 1 Universitas Muhammadiyah Sukabumi (UMMI)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(56, 28, 'Tim Inovator 2 Universitas Muhammadiyah Sukabumi (UMMI)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(57, 29, 'Tim Inovator 1 Universitas Subang (UNSUB)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(58, 29, 'Tim Inovator 2 Universitas Subang (UNSUB)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(59, 30, 'Tim Inovator 1 Universitas Garut (UNIGA)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(60, 30, 'Tim Inovator 2 Universitas Garut (UNIGA)', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(61, 50, 'Tim Mhs Be', '2026-11-13 08:18:19', '2026-11-13 08:18:19'),
(62, 1, 'tim baru', '2026-11-13 08:38:46', '2026-11-13 08:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `nim_nisn` varchar(255) DEFAULT NULL,
  `study_program` varchar(255) DEFAULT NULL,
  `student_status` varchar(255) NOT NULL DEFAULT 'Aktif',
  `is_leader` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `team_id`, `user_id`, `name`, `nim_nisn`, `study_program`, `student_status`, `is_leader`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, 14, 'Rian Pratama', '13523691', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'rian-pratama@student.institut-teknologi-bandung-itb.ac.id', '081210959913', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, NULL, 'Anggota 1 (Tim Ganendra AgroTech ITB)', '13527944', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@institut-teknologi-bandung-itb.ac.id', '081289562588', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, NULL, 'Anggota 2 (Tim Ganendra AgroTech ITB)', '13522066', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@institut-teknologi-bandung-itb.ac.id', '081275809830', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 2, NULL, 'Nabila Putri Santoso', '13521873', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'nabila-putri-santoso@student.institut-teknologi-bandung-itb.ac.id', '081236785981', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 2, NULL, 'Anggota 1 (Tim Bionika Medika ITB)', '13524770', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@institut-teknologi-bandung-itb.ac.id', '081210273194', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 2, NULL, 'Anggota 2 (Tim Bionika Medika ITB)', '13524248', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@institut-teknologi-bandung-itb.ac.id', '081299461622', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 3, NULL, 'Faisal Akbar', '13527512', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'faisal-akbar@student.telkom-university-tel-u.ac.id', '081212113745', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 3, NULL, 'Anggota 1 (AeroVision Lab Tel-U)', '13529542', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@telkom-university-tel-u.ac.id', '081273165072', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 3, NULL, 'Anggota 2 (AeroVision Lab Tel-U)', '13522791', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@telkom-university-tel-u.ac.id', '081294556954', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 4, NULL, 'Aditya Nugraha', '13521487', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'aditya-nugraha@student.telkom-university-tel-u.ac.id', '081240582530', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 4, NULL, 'Anggota 1 (Tim Fintech Rakyat Tel-U)', '13528411', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@telkom-university-tel-u.ac.id', '081264007850', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 4, NULL, 'Anggota 2 (Tim Fintech Rakyat Tel-U)', '13522859', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@telkom-university-tel-u.ac.id', '081258783814', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 5, NULL, 'Kevin Sanjaya', '13528039', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'kevin-sanjaya@student.universitas-komputer-indonesia-unikom.ac.id', '081258362826', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 5, NULL, 'Anggota 1 (Tim Robotika Juara UNIKOM)', '13521987', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-komputer-indonesia-unikom.ac.id', '081250771613', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 5, NULL, 'Anggota 2 (Tim Robotika Juara UNIKOM)', '13528596', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-komputer-indonesia-unikom.ac.id', '081216754117', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 6, NULL, 'Siti Fatimah', '13527070', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'siti-fatimah@student.universitas-komputer-indonesia-unikom.ac.id', '081296673698', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 6, NULL, 'Anggota 1 (Divisi Multimedia Animasi UNIKOM)', '13526122', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-komputer-indonesia-unikom.ac.id', '081266916537', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 6, NULL, 'Anggota 2 (Divisi Multimedia Animasi UNIKOM)', '13521288', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-komputer-indonesia-unikom.ac.id', '081273822734', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 7, NULL, 'Dewi Anggraeni', '13522609', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'dewi-anggraeni@student.universitas-padjadjaran-unpad.ac.id', '081213133586', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 7, NULL, 'Anggota 1 (Tim Padjadjaran Inovasi Kesehatan)', '13523456', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-padjadjaran-unpad.ac.id', '081260012534', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 7, NULL, 'Anggota 2 (Tim Padjadjaran Inovasi Kesehatan)', '13527520', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-padjadjaran-unpad.ac.id', '081217142671', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(22, 8, NULL, 'Rizki Fauzi', '13527395', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'rizki-fauzi@student.universitas-padjadjaran-unpad.ac.id', '081210745382', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(23, 8, NULL, 'Anggota 1 (Green Economy Lab UNPAD)', '13527714', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-padjadjaran-unpad.ac.id', '081277327722', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(24, 8, NULL, 'Anggota 2 (Green Economy Lab UNPAD)', '13522302', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-padjadjaran-unpad.ac.id', '081262121903', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(25, 9, NULL, 'Annisa Rahmawati', '13522608', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'annisa-rahmawati@student.universitas-pendidikan-indonesia-upi.ac.id', '081256045984', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(26, 9, NULL, 'Anggota 1 (Laboratorium EduTech UPI)', '13528668', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-pendidikan-indonesia-upi.ac.id', '081274648800', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(27, 9, NULL, 'Anggota 2 (Laboratorium EduTech UPI)', '13528249', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-pendidikan-indonesia-upi.ac.id', '081279694573', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(28, 10, NULL, 'Bagas Wicaksono', '13528305', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'bagas-wicaksono@student.universitas-pendidikan-indonesia-upi.ac.id', '081266500143', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(29, 10, NULL, 'Anggota 1 (Fisika Inovatif UPI)', '13523249', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-pendidikan-indonesia-upi.ac.id', '081243777208', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(30, 10, NULL, 'Anggota 2 (Fisika Inovatif UPI)', '13522975', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-pendidikan-indonesia-upi.ac.id', '081262362678', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(31, 11, NULL, 'Danang Prasetyo', '13529886', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'danang-prasetyo@student.politeknik-negeri-bandung-polban.ac.id', '081299101259', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(32, 11, NULL, 'Anggota 1 (Pusat Riset Energi Terbarukan POLBAN)', '13526042', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@politeknik-negeri-bandung-polban.ac.id', '081211989816', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(33, 11, NULL, 'Anggota 2 (Pusat Riset Energi Terbarukan POLBAN)', '13529920', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@politeknik-negeri-bandung-polban.ac.id', '081293883626', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(34, 12, NULL, 'Dimas Arya', '13522362', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'dimas-arya@student.politeknik-negeri-bandung-polban.ac.id', '081230384294', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(35, 12, NULL, 'Anggota 1 (Otomasi Industri POLBAN)', '13529219', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@politeknik-negeri-bandung-polban.ac.id', '081275527914', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(36, 12, NULL, 'Anggota 2 (Otomasi Industri POLBAN)', '13521963', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@politeknik-negeri-bandung-polban.ac.id', '081286938739', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(37, 13, NULL, 'Fadhil Muhammad', '13529124', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'fadhil-muhammad@student.institut-pertanian-bogor-ipb-university.ac.id', '081291413475', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(38, 13, NULL, 'Anggota 1 (IPB Precision Livestock Team)', '13522231', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@institut-pertanian-bogor-ipb-university.ac.id', '081246288234', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(39, 13, NULL, 'Anggota 2 (IPB Precision Livestock Team)', '13522691', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@institut-pertanian-bogor-ipb-university.ac.id', '081267213452', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(40, 14, NULL, 'Hana Lestari', '13521083', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'hana-lestari@student.institut-pertanian-bogor-ipb-university.ac.id', '081245877892', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(41, 14, NULL, 'Anggota 1 (Agro-Robotics IPB)', '13525331', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@institut-pertanian-bogor-ipb-university.ac.id', '081251215173', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(42, 14, NULL, 'Anggota 2 (Agro-Robotics IPB)', '13528726', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@institut-pertanian-bogor-ipb-university.ac.id', '081216764462', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(43, 15, NULL, 'Ignatius Mario', '13525180', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ignatius-mario@student.universitas-katolik-parahyangan-unpar.ac.id', '081278790057', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(44, 15, NULL, 'Anggota 1 (Civil & Computer Science Collaboration UNPAR)', '13521886', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-katolik-parahyangan-unpar.ac.id', '081273250118', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(45, 15, NULL, 'Anggota 2 (Civil & Computer Science Collaboration UNPAR)', '13522060', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-katolik-parahyangan-unpar.ac.id', '081258662175', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(46, 16, NULL, 'Jessica Tanuwijaya', '13522181', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'jessica-tanuwijaya@student.universitas-katolik-parahyangan-unpar.ac.id', '081259740225', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(47, 16, NULL, 'Anggota 1 (Data Science Parahyangan)', '13529360', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-katolik-parahyangan-unpar.ac.id', '081246103044', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(48, 16, NULL, 'Anggota 2 (Data Science Parahyangan)', '13528419', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-katolik-parahyangan-unpar.ac.id', '081227357171', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(49, 17, NULL, 'Kurnia Ramadhan', '13528917', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'kurnia-ramadhan@student.universitas-singaperbangsa-karawang-unsika.ac.id', '081240852574', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(50, 17, NULL, 'Anggota 1 (Tim Otomasi Logistik UNSIKA)', '13524994', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-singaperbangsa-karawang-unsika.ac.id', '081283137611', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(51, 17, NULL, 'Anggota 2 (Tim Otomasi Logistik UNSIKA)', '13521555', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-singaperbangsa-karawang-unsika.ac.id', '081266573866', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(52, 18, NULL, 'Luki Hermawan', '13527276', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'luki-hermawan@student.universitas-singaperbangsa-karawang-unsika.ac.id', '081245801848', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(53, 18, NULL, 'Anggota 1 (Geoinformatika UNSIKA)', '13526358', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-singaperbangsa-karawang-unsika.ac.id', '081254368910', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(54, 18, NULL, 'Anggota 2 (Geoinformatika UNSIKA)', '13522108', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-singaperbangsa-karawang-unsika.ac.id', '081260293545', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(55, 19, NULL, 'Ketua Tim 1 Bandung', '13522581', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-bandung@student.universitas-pasundan-unpas.ac.id', '081249170243', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(56, 19, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Pasundan (UNPAS))', '13529259', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-pasundan-unpas.ac.id', '081238644884', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(57, 19, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Pasundan (UNPAS))', '13527405', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-pasundan-unpas.ac.id', '081219535264', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(58, 20, NULL, 'Ketua Tim 2 Bandung', '13524992', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-bandung@student.universitas-pasundan-unpas.ac.id', '081292652656', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(59, 20, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Pasundan (UNPAS))', '13525207', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-pasundan-unpas.ac.id', '081228767795', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(60, 20, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Pasundan (UNPAS))', '13529810', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-pasundan-unpas.ac.id', '081245647968', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(61, 21, NULL, 'Ketua Tim 1 Bandung', '13527278', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-bandung@student.universitas-widyatama.ac.id', '081227078093', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(62, 21, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Widyatama)', '13526999', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-widyatama.ac.id', '081213252041', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(63, 21, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Widyatama)', '13521888', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-widyatama.ac.id', '081224655810', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(64, 22, NULL, 'Ketua Tim 2 Bandung', '13529239', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-bandung@student.universitas-widyatama.ac.id', '081218810295', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(65, 22, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Widyatama)', '13525146', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-widyatama.ac.id', '081252203999', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(66, 22, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Widyatama)', '13522146', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-widyatama.ac.id', '081277598755', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(67, 23, NULL, 'Ketua Tim 1 Tasikmalaya', '13528252', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-tasikmalaya@student.universitas-siliwangi-unsil.ac.id', '081257653844', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(68, 23, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Siliwangi (UNSIL))', '13529017', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-siliwangi-unsil.ac.id', '081215945678', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(69, 23, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Siliwangi (UNSIL))', '13524725', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-siliwangi-unsil.ac.id', '081236134847', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(70, 24, NULL, 'Ketua Tim 2 Tasikmalaya', '13525184', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-tasikmalaya@student.universitas-siliwangi-unsil.ac.id', '081263948845', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(71, 24, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Siliwangi (UNSIL))', '13521182', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-siliwangi-unsil.ac.id', '081295004822', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(72, 24, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Siliwangi (UNSIL))', '13523873', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-siliwangi-unsil.ac.id', '081254391581', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(73, 25, NULL, 'Ketua Tim 1 Bandung', '13523148', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-bandung@student.uin-sunan-gunung-djati-bandung.ac.id', '081221214780', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(74, 25, NULL, 'Anggota 1 (Tim Inovator 1 UIN Sunan Gunung Djati Bandung)', '13525997', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@uin-sunan-gunung-djati-bandung.ac.id', '081288886381', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(75, 25, NULL, 'Anggota 2 (Tim Inovator 1 UIN Sunan Gunung Djati Bandung)', '13521081', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@uin-sunan-gunung-djati-bandung.ac.id', '081260832979', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(76, 26, NULL, 'Ketua Tim 2 Bandung', '13529772', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-bandung@student.uin-sunan-gunung-djati-bandung.ac.id', '081253234889', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(77, 26, NULL, 'Anggota 1 (Tim Inovator 2 UIN Sunan Gunung Djati Bandung)', '13524111', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@uin-sunan-gunung-djati-bandung.ac.id', '081267195625', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(78, 26, NULL, 'Anggota 2 (Tim Inovator 2 UIN Sunan Gunung Djati Bandung)', '13527635', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@uin-sunan-gunung-djati-bandung.ac.id', '081210932574', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(79, 27, NULL, 'Ketua Tim 1 Bandung', '13521957', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-bandung@student.universitas-kristen-maranatha.ac.id', '081299211660', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(80, 27, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Kristen Maranatha)', '13525001', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-kristen-maranatha.ac.id', '081290201753', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(81, 27, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Kristen Maranatha)', '13523963', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-kristen-maranatha.ac.id', '081291227832', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(82, 28, NULL, 'Ketua Tim 2 Bandung', '13522636', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-bandung@student.universitas-kristen-maranatha.ac.id', '081234780027', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(83, 28, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Kristen Maranatha)', '13524257', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-kristen-maranatha.ac.id', '081269621711', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(84, 28, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Kristen Maranatha)', '13526371', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-kristen-maranatha.ac.id', '081233460256', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(85, 29, NULL, 'Ketua Tim 1 Bandung', '13527411', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-bandung@student.universitas-islam-bandung-unisba.ac.id', '081245352593', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(86, 29, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Islam Bandung (UNISBA))', '13522482', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-islam-bandung-unisba.ac.id', '081232126975', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(87, 29, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Islam Bandung (UNISBA))', '13521880', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-islam-bandung-unisba.ac.id', '081246358016', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(88, 30, NULL, 'Ketua Tim 2 Bandung', '13524091', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-bandung@student.universitas-islam-bandung-unisba.ac.id', '081286658560', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(89, 30, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Islam Bandung (UNISBA))', '13525796', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-islam-bandung-unisba.ac.id', '081270901239', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(90, 30, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Islam Bandung (UNISBA))', '13526256', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-islam-bandung-unisba.ac.id', '081247913276', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(91, 31, NULL, 'Ketua Tim 1 Cirebon', '13527229', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-cirebon@student.universitas-swadaya-gunung-jati-ugj.ac.id', '081263765155', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(92, 31, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Swadaya Gunung Jati (UGJ))', '13529092', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-swadaya-gunung-jati-ugj.ac.id', '081277179977', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(93, 31, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Swadaya Gunung Jati (UGJ))', '13523284', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-swadaya-gunung-jati-ugj.ac.id', '081214753081', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(94, 32, NULL, 'Ketua Tim 2 Cirebon', '13521780', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-cirebon@student.universitas-swadaya-gunung-jati-ugj.ac.id', '081212014059', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(95, 32, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Swadaya Gunung Jati (UGJ))', '13523597', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-swadaya-gunung-jati-ugj.ac.id', '081244901466', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(96, 32, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Swadaya Gunung Jati (UGJ))', '13521792', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-swadaya-gunung-jati-ugj.ac.id', '081252659823', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(97, 33, NULL, 'Ketua Tim 1 Kuningan', '13529553', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-kuningan@student.universitas-kuningan-uniku.ac.id', '081283552746', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(98, 33, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Kuningan (UNIKU))', '13527571', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-kuningan-uniku.ac.id', '081299281275', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(99, 33, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Kuningan (UNIKU))', '13522217', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-kuningan-uniku.ac.id', '081244528501', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(100, 34, NULL, 'Ketua Tim 2 Kuningan', '13524111', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-kuningan@student.universitas-kuningan-uniku.ac.id', '081268458659', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(101, 34, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Kuningan (UNIKU))', '13524364', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-kuningan-uniku.ac.id', '081243039234', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(102, 34, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Kuningan (UNIKU))', '13528938', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-kuningan-uniku.ac.id', '081265504396', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(103, 35, NULL, 'Ketua Tim 1 Majalengka', '13525853', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-majalengka@student.universitas-majalengka-unma.ac.id', '081229775006', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(104, 35, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Majalengka (UNMA))', '13521356', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-majalengka-unma.ac.id', '081231043186', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(105, 35, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Majalengka (UNMA))', '13521899', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-majalengka-unma.ac.id', '081252596869', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(106, 36, NULL, 'Ketua Tim 2 Majalengka', '13522117', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-majalengka@student.universitas-majalengka-unma.ac.id', '081211519501', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(107, 36, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Majalengka (UNMA))', '13523561', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-majalengka-unma.ac.id', '081216923017', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(108, 36, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Majalengka (UNMA))', '13523211', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-majalengka-unma.ac.id', '081268206124', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(109, 37, NULL, 'Ketua Tim 1 Ciamis', '13525423', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-ciamis@student.universitas-galuh-unigal.ac.id', '081224996816', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(110, 37, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Galuh (UNIGAL))', '13529495', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-galuh-unigal.ac.id', '081264873036', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(111, 37, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Galuh (UNIGAL))', '13524933', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-galuh-unigal.ac.id', '081226618602', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(112, 38, NULL, 'Ketua Tim 2 Ciamis', '13525945', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-ciamis@student.universitas-galuh-unigal.ac.id', '081212988992', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(113, 38, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Galuh (UNIGAL))', '13529341', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-galuh-unigal.ac.id', '081298411418', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(114, 38, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Galuh (UNIGAL))', '13527622', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-galuh-unigal.ac.id', '081241549781', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(115, 39, NULL, 'Ketua Tim 1 Bandung', '13528492', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-bandung@student.politeknik-manufaktur-bandung-polman.ac.id', '081273064334', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(116, 39, NULL, 'Anggota 1 (Tim Inovator 1 Politeknik Manufaktur Bandung (POLMAN))', '13528490', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@politeknik-manufaktur-bandung-polman.ac.id', '081266454635', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(117, 39, NULL, 'Anggota 2 (Tim Inovator 1 Politeknik Manufaktur Bandung (POLMAN))', '13521176', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@politeknik-manufaktur-bandung-polman.ac.id', '081246395153', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(118, 40, NULL, 'Ketua Tim 2 Bandung', '13525132', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-bandung@student.politeknik-manufaktur-bandung-polman.ac.id', '081263898831', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(119, 40, NULL, 'Anggota 1 (Tim Inovator 2 Politeknik Manufaktur Bandung (POLMAN))', '13529459', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@politeknik-manufaktur-bandung-polman.ac.id', '081299727196', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(120, 40, NULL, 'Anggota 2 (Tim Inovator 2 Politeknik Manufaktur Bandung (POLMAN))', '13524013', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@politeknik-manufaktur-bandung-polman.ac.id', '081265170125', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(121, 41, NULL, 'Ketua Tim 1 Bandung', '13521879', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-bandung@student.politeknik-pos-indonesia-ulbi.ac.id', '081293316049', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(122, 41, NULL, 'Anggota 1 (Tim Inovator 1 Politeknik Pos Indonesia (ULBI))', '13524381', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@politeknik-pos-indonesia-ulbi.ac.id', '081255868652', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(123, 41, NULL, 'Anggota 2 (Tim Inovator 1 Politeknik Pos Indonesia (ULBI))', '13524449', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@politeknik-pos-indonesia-ulbi.ac.id', '081241215470', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(124, 42, NULL, 'Ketua Tim 2 Bandung', '13529445', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-bandung@student.politeknik-pos-indonesia-ulbi.ac.id', '081269771310', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(125, 42, NULL, 'Anggota 1 (Tim Inovator 2 Politeknik Pos Indonesia (ULBI))', '13525329', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@politeknik-pos-indonesia-ulbi.ac.id', '081212477737', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(126, 42, NULL, 'Anggota 2 (Tim Inovator 2 Politeknik Pos Indonesia (ULBI))', '13522646', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@politeknik-pos-indonesia-ulbi.ac.id', '081295842765', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(127, 43, NULL, 'Ketua Tim 1 Bandung', '13524974', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-bandung@student.stmik-amik-bandung.ac.id', '081271532668', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(128, 43, NULL, 'Anggota 1 (Tim Inovator 1 STMIK AMIK Bandung)', '13525721', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@stmik-amik-bandung.ac.id', '081244020780', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(129, 43, NULL, 'Anggota 2 (Tim Inovator 1 STMIK AMIK Bandung)', '13523801', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@stmik-amik-bandung.ac.id', '081254109449', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(130, 44, NULL, 'Ketua Tim 2 Bandung', '13529894', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-bandung@student.stmik-amik-bandung.ac.id', '081222890674', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(131, 44, NULL, 'Anggota 1 (Tim Inovator 2 STMIK AMIK Bandung)', '13525519', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@stmik-amik-bandung.ac.id', '081277570344', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(132, 44, NULL, 'Anggota 2 (Tim Inovator 2 STMIK AMIK Bandung)', '13522504', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@stmik-amik-bandung.ac.id', '081245889542', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(133, 45, NULL, 'Ketua Tim 1 Cirebon', '13526271', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-cirebon@student.stmik-ikmi-cirebon.ac.id', '081242487424', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(134, 45, NULL, 'Anggota 1 (Tim Inovator 1 STMIK IKMI Cirebon)', '13523750', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@stmik-ikmi-cirebon.ac.id', '081232023692', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(135, 45, NULL, 'Anggota 2 (Tim Inovator 1 STMIK IKMI Cirebon)', '13529444', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@stmik-ikmi-cirebon.ac.id', '081272501155', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(136, 46, NULL, 'Ketua Tim 2 Cirebon', '13527010', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-cirebon@student.stmik-ikmi-cirebon.ac.id', '081229656033', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(137, 46, NULL, 'Anggota 1 (Tim Inovator 2 STMIK IKMI Cirebon)', '13526431', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@stmik-ikmi-cirebon.ac.id', '081279465690', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(138, 46, NULL, 'Anggota 2 (Tim Inovator 2 STMIK IKMI Cirebon)', '13528430', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@stmik-ikmi-cirebon.ac.id', '081280886469', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(139, 47, NULL, 'Ketua Tim 1 Bogor', '13529674', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-bogor@student.universitas-pakuan-bogor.ac.id', '081234278023', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(140, 47, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Pakuan Bogor)', '13526921', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-pakuan-bogor.ac.id', '081222115228', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(141, 47, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Pakuan Bogor)', '13529497', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-pakuan-bogor.ac.id', '081269122257', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(142, 48, NULL, 'Ketua Tim 2 Bogor', '13527309', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-bogor@student.universitas-pakuan-bogor.ac.id', '081219783050', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(143, 48, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Pakuan Bogor)', '13526322', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-pakuan-bogor.ac.id', '081292934280', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(144, 48, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Pakuan Bogor)', '13528800', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-pakuan-bogor.ac.id', '081268333367', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(145, 49, NULL, 'Ketua Tim 1 Bogor', '13527404', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-bogor@student.universitas-ibn-khaldun-bogor.ac.id', '081236796915', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(146, 49, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Ibn Khaldun Bogor)', '13528911', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-ibn-khaldun-bogor.ac.id', '081231475418', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(147, 49, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Ibn Khaldun Bogor)', '13524547', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-ibn-khaldun-bogor.ac.id', '081210544439', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(148, 50, NULL, 'Ketua Tim 2 Bogor', '13524563', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-bogor@student.universitas-ibn-khaldun-bogor.ac.id', '081232721210', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(149, 50, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Ibn Khaldun Bogor)', '13526444', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-ibn-khaldun-bogor.ac.id', '081247664813', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(150, 50, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Ibn Khaldun Bogor)', '13522978', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-ibn-khaldun-bogor.ac.id', '081268493466', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(151, 51, NULL, 'Ketua Tim 1 Bekasi', '13523285', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-bekasi@student.universitas-presiden-president-university.ac.id', '081239061055', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(152, 51, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Presiden (President University))', '13528273', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-presiden-president-university.ac.id', '081215056162', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(153, 51, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Presiden (President University))', '13524769', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-presiden-president-university.ac.id', '081294570922', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(154, 52, NULL, 'Ketua Tim 2 Bekasi', '13521668', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-bekasi@student.universitas-presiden-president-university.ac.id', '081277845419', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(155, 52, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Presiden (President University))', '13525647', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-presiden-president-university.ac.id', '081232367702', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(156, 52, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Presiden (President University))', '13522454', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-presiden-president-university.ac.id', '081256307785', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(157, 53, NULL, 'Ketua Tim 1 Bogor', '13521319', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-bogor@student.universitas-djuanda-bogor.ac.id', '081218565674', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(158, 53, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Djuanda Bogor)', '13521738', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-djuanda-bogor.ac.id', '081297217784', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(159, 53, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Djuanda Bogor)', '13521378', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-djuanda-bogor.ac.id', '081276674452', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(160, 54, NULL, 'Ketua Tim 2 Bogor', '13528026', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-bogor@student.universitas-djuanda-bogor.ac.id', '081226289941', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(161, 54, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Djuanda Bogor)', '13522024', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-djuanda-bogor.ac.id', '081211582282', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(162, 54, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Djuanda Bogor)', '13526641', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-djuanda-bogor.ac.id', '081280149314', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(163, 55, NULL, 'Ketua Tim 1 Sukabumi', '13523987', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-sukabumi@student.universitas-muhammadiyah-sukabumi-ummi.ac.id', '081288351026', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(164, 55, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Muhammadiyah Sukabumi (UMMI))', '13524853', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-muhammadiyah-sukabumi-ummi.ac.id', '081218953643', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(165, 55, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Muhammadiyah Sukabumi (UMMI))', '13525793', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-muhammadiyah-sukabumi-ummi.ac.id', '081264389397', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(166, 56, NULL, 'Ketua Tim 2 Sukabumi', '13528161', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-sukabumi@student.universitas-muhammadiyah-sukabumi-ummi.ac.id', '081240620426', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(167, 56, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Muhammadiyah Sukabumi (UMMI))', '13522906', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-muhammadiyah-sukabumi-ummi.ac.id', '081261319304', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(168, 56, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Muhammadiyah Sukabumi (UMMI))', '13521328', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-muhammadiyah-sukabumi-ummi.ac.id', '081252720737', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(169, 57, NULL, 'Ketua Tim 1 Subang', '13526784', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-subang@student.universitas-subang-unsub.ac.id', '081258192111', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(170, 57, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Subang (UNSUB))', '13526226', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-subang-unsub.ac.id', '081255807345', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(171, 57, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Subang (UNSUB))', '13529017', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-subang-unsub.ac.id', '081227406108', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(172, 58, NULL, 'Ketua Tim 2 Subang', '13522005', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-subang@student.universitas-subang-unsub.ac.id', '081297898100', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(173, 58, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Subang (UNSUB))', '13528614', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-subang-unsub.ac.id', '081293089397', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(174, 58, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Subang (UNSUB))', '13529822', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-subang-unsub.ac.id', '081217899039', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(175, 59, NULL, 'Ketua Tim 1 Garut', '13526678', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-1-garut@student.universitas-garut-uniga.ac.id', '081268788039', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(176, 59, NULL, 'Anggota 1 (Tim Inovator 1 Universitas Garut (UNIGA))', '13525333', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-garut-uniga.ac.id', '081257863571', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(177, 59, NULL, 'Anggota 2 (Tim Inovator 1 Universitas Garut (UNIGA))', '13528462', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-garut-uniga.ac.id', '081232447080', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(178, 60, NULL, 'Ketua Tim 2 Garut', '13528459', 'Teknik Informatika / Sistem Informasi', 'Aktif', 1, 'ketua-tim-2-garut@student.universitas-garut-uniga.ac.id', '081263540032', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(179, 60, NULL, 'Anggota 1 (Tim Inovator 2 Universitas Garut (UNIGA))', '13522768', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota1@universitas-garut-uniga.ac.id', '081232940524', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(180, 60, NULL, 'Anggota 2 (Tim Inovator 2 Universitas Garut (UNIGA))', '13528324', 'Teknik Elektro / Desain Komunikasi Visual', 'Aktif', 0, 'anggota2@universitas-garut-uniga.ac.id', '081291666414', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(183, 61, 50, 'Tim Mahasiswa B', NULL, NULL, 'Aktif', 0, 'timmhsb@gmail.com', NULL, '2026-11-13 08:44:31', '2026-11-13 08:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `technical_requirements`
--

CREATE TABLE `technical_requirements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `device_list` text DEFAULT NULL,
  `device_count` int(11) NOT NULL DEFAULT 1,
  `power_watt` int(11) NOT NULL DEFAULT 300,
  `internet_type` enum('wifi_standard','wifi_high_speed','lan_cable') NOT NULL DEFAULT 'wifi_standard',
  `demo_area_type` varchar(255) NOT NULL DEFAULT 'Standard Booth Table',
  `special_requests` text DEFAULT NULL,
  `status` enum('draft','submitted','verified','fulfilled') NOT NULL DEFAULT 'submitted',
  `verifier_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technical_requirements`
--

INSERT INTO `technical_requirements` (`id`, `project_id`, `organization_id`, `device_list`, `device_count`, `power_watt`, `internet_type`, `demo_area_type`, `special_requests`, `status`, `verifier_notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 320, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 2, 1, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 362, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 3, 2, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 304, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(4, 4, 2, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 291, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(5, 5, 3, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 344, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(6, 6, 3, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 274, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(7, 7, 4, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 299, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(8, 8, 4, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 290, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(9, 9, 5, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 387, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(10, 10, 5, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 361, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(11, 11, 6, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 346, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(12, 12, 6, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 343, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(13, 13, 10, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 340, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(14, 14, 10, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 279, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(15, 15, 7, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 396, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(16, 16, 7, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 389, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(17, 17, 11, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 358, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(18, 18, 11, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 264, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(19, 19, 8, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 370, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(20, 20, 8, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 257, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 21, 9, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 286, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(22, 22, 9, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 252, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(23, 23, 12, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 275, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(24, 24, 12, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 272, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(25, 25, 13, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 273, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(26, 26, 13, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 306, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(27, 27, 14, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 369, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(28, 28, 14, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 311, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(29, 29, 15, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 367, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(30, 30, 15, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 311, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(31, 31, 16, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 361, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(32, 32, 16, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 289, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(33, 33, 17, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 371, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(34, 34, 17, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 285, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(35, 35, 18, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 373, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(36, 36, 18, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 345, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(37, 37, 19, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 293, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(38, 38, 19, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 350, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(39, 39, 20, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 396, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(40, 40, 20, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 306, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(41, 41, 21, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 363, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(42, 42, 21, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 307, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(43, 43, 22, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 308, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(44, 44, 22, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 361, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(45, 45, 23, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 391, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(46, 46, 23, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 349, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(47, 47, 24, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 302, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(48, 48, 24, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 258, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(49, 49, 25, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 321, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(50, 50, 25, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 391, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(51, 51, 26, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 342, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(52, 52, 26, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 266, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(53, 53, 27, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 288, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(54, 54, 27, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 393, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(55, 55, 28, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 255, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(56, 56, 28, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 300, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(57, 57, 29, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 392, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(58, 58, 29, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 254, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(59, 59, 30, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 292, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(60, 60, 30, 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M', 3, 279, 'wifi_high_speed', 'Standard Booth Table + Poster Board Stand', 'Membutuhkan akses stop kontak stabil untuk adaptor charger', 'verified', 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.', '2026-11-08 07:55:58', '2026-11-08 07:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `registration_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `qr_token` varchar(64) NOT NULL,
  `category` enum('visitor','student_participant','pic_campus','industry_exhibitor','sponsor','judge','vip','panitia') NOT NULL DEFAULT 'visitor',
  `status` enum('active','checked_in','cancelled') NOT NULL DEFAULT 'active',
  `has_checked_in` tinyint(1) NOT NULL DEFAULT 0,
  `first_checked_in_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `event_id`, `user_id`, `registration_id`, `ticket_number`, `qr_token`, `category`, `status`, `has_checked_in`, `first_checked_in_at`, `created_at`, `updated_at`) VALUES
(1, 1, 20, NULL, 'FTR-VIS-88899', 'FTR_SECURE_TOKEN_2R1q8ISpamenUsYbAQnwEjAeZunY1iOF', 'visitor', 'checked_in', 1, '2026-11-08 10:55:58', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(2, 1, 21, NULL, 'FTR-VIS-01001', 'FTR_TOKEN_WyS0CGEG6D8QbWq1b3EMF7IuIkYfrBIR', 'visitor', 'checked_in', 1, '2026-11-08 12:53:59', '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(3, 1, 22, NULL, 'FTR-VIS-01002', 'FTR_TOKEN_VmTyDtSc5op0jvaQsRh3PmHsfYjSb3Gd', 'visitor', 'checked_in', 1, '2026-11-08 11:34:59', '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(4, 1, 23, NULL, 'FTR-VIS-01003', 'FTR_TOKEN_8uLaNJk8d3fwWazLW73r54fuTN0sKoEE', 'visitor', 'checked_in', 1, '2026-11-08 14:14:59', '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(5, 1, 24, NULL, 'FTR-VIS-01004', 'FTR_TOKEN_fWk4b9Og2cDM0BQNokTzdD95Ls1OCm3n', 'visitor', 'checked_in', 1, '2026-11-08 10:50:59', '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(6, 1, 25, NULL, 'FTR-VIS-01005', 'FTR_TOKEN_PgAtDwjWHjvdqt67eci26PFsYU9ND9ed', 'visitor', 'checked_in', 1, '2026-11-08 14:33:00', '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(7, 1, 26, NULL, 'FTR-VIS-01006', 'FTR_TOKEN_G2K3rxpBS3LpNGrbLaBMmxszM8RhZr2O', 'visitor', 'checked_in', 1, '2026-11-08 11:32:00', '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(8, 1, 27, NULL, 'FTR-VIS-01007', 'FTR_TOKEN_iP79yaKchP5L0dE59Sb9NzaK8qxIeKwf', 'visitor', 'checked_in', 1, '2026-11-08 09:59:00', '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(9, 1, 28, NULL, 'FTR-VIS-01008', 'FTR_TOKEN_EnlMhE5Ujg8gcnbKlvqtBd6IbxSc7unU', 'visitor', 'checked_in', 1, '2026-11-08 10:34:01', '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(10, 1, 29, NULL, 'FTR-VIS-01009', 'FTR_TOKEN_44EfAi88RGXrWBwpfx84HkuGvCufqUnO', 'visitor', 'checked_in', 1, '2026-11-08 12:08:01', '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(11, 1, 30, NULL, 'FTR-VIS-01010', 'FTR_TOKEN_472iYgmk7cvO6oMupOYcEErzAEFm6NfN', 'visitor', 'checked_in', 1, '2026-11-08 14:16:01', '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(12, 1, 31, NULL, 'FTR-VIS-01011', 'FTR_TOKEN_t7V7mPcK0mTSG9bmqFZAAWFF8OZaa5ZO', 'visitor', 'checked_in', 1, '2026-11-08 10:08:01', '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(13, 1, 32, NULL, 'FTR-VIS-01012', 'FTR_TOKEN_cuOkdLmgDqHiX09n0T4oCLSmh2EAv9nz', 'visitor', 'checked_in', 1, '2026-11-08 12:48:02', '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(14, 1, 33, NULL, 'FTR-VIS-01013', 'FTR_TOKEN_E4eKgPJkmRvHGEIYbtpeoET5RjS57NR9', 'visitor', 'checked_in', 1, '2026-11-08 12:30:02', '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(15, 1, 34, NULL, 'FTR-VIS-01014', 'FTR_TOKEN_A6BpjXyjKl6FJyEUG64L4kELpFSifTUs', 'visitor', 'checked_in', 1, '2026-11-08 10:55:02', '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(16, 1, 35, NULL, 'FTR-VIS-01015', 'FTR_TOKEN_C2jZ7JQKae11yToaF7yuZ0DzkRiwfa8Y', 'visitor', 'checked_in', 1, '2026-11-08 12:07:02', '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(17, 1, 36, NULL, 'FTR-VIS-01016', 'FTR_TOKEN_1nJVXn8xAkbxGMQS2ldSZV8jDceITY1v', 'visitor', 'checked_in', 1, '2026-11-08 13:43:03', '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(18, 1, 37, NULL, 'FTR-VIS-01017', 'FTR_TOKEN_eSEL0C4dAG1g4tgt5E6qiARhBLfSUA0H', 'visitor', 'checked_in', 1, '2026-11-08 10:25:03', '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(19, 1, 38, NULL, 'FTR-VIS-01018', 'FTR_TOKEN_ggtOU1L9rIHlme8blPOMDe4o1VziiK1n', 'visitor', 'checked_in', 1, '2026-11-08 11:48:03', '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(20, 1, 39, NULL, 'FTR-VIS-01019', 'FTR_TOKEN_gxQNNwGSnrjeRJEW6xa3GUMgZzOhjbGI', 'visitor', 'checked_in', 1, '2026-11-08 11:10:03', '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(21, 1, 40, NULL, 'FTR-VIS-01020', 'FTR_TOKEN_CF4pvtoldU5r2pfs1TEju2UZifGXNgrH', 'visitor', 'checked_in', 1, '2026-11-08 14:45:04', '2026-11-08 07:56:04', '2026-11-08 07:56:04'),
(22, 1, 41, NULL, 'FTR-VIS-01021', 'FTR_TOKEN_KO4qdsf1VhkZDhfhEbd66ykO5mNeZxUV', 'visitor', 'checked_in', 1, '2026-11-08 13:34:04', '2026-11-08 07:56:04', '2026-11-08 07:56:04'),
(23, 1, 42, NULL, 'FTR-VIS-01022', 'FTR_TOKEN_1jL4PJeTGGZrB3KCtfIPrL3Eg4INKeMS', 'visitor', 'checked_in', 1, '2026-11-08 13:49:04', '2026-11-08 07:56:04', '2026-11-08 07:56:04'),
(24, 1, 43, NULL, 'FTR-VIS-01023', 'FTR_TOKEN_c7k7cBqa24qO3QmfweQms3O2yUCS8q7A', 'visitor', 'checked_in', 1, '2026-11-08 12:59:05', '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(25, 1, 44, NULL, 'FTR-VIS-01024', 'FTR_TOKEN_lkYsXMZebTVIcLi7M8BPxvCtxjdUB1Jj', 'visitor', 'checked_in', 1, '2026-11-08 10:05:05', '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(26, 1, 45, NULL, 'FTR-VIS-01025', 'FTR_TOKEN_CtZkEinO2y5ljbNljSZT2G8Sm8BsnOOn', 'visitor', 'checked_in', 1, '2026-11-08 10:42:05', '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(27, 1, 46, NULL, 'FTR-LG2FRJPP', '0G34HyT6zhjcwcRTJ6DBcWTijYhW6hzvdGgJ9TeG', 'visitor', 'checked_in', 1, '2026-11-13 11:04:27', '2026-11-13 03:48:08', '2026-11-13 04:04:27'),
(28, 1, 48, 2, 'FTR-HVBROFQP', 'n8yo4QCU9qk4w3je9sDevfnvSugooqNcWXslMCCj', 'sponsor', 'active', 0, NULL, '2026-11-13 06:54:23', '2026-11-13 06:54:23'),
(29, 1, 49, 3, 'FTR-U8DHODKT', 'A2f4QhnSTfq4oeqsAneqT1N6kJ3C8vFcblgDEJha', 'industry_exhibitor', 'active', 0, NULL, '2026-11-13 07:30:01', '2026-11-13 07:30:01'),
(30, 1, 51, 4, 'FTR-EVNNCONT', 'bV4bZiBWsegWP85cpeQb68yzz27siyIlWyh5qdUk', 'pic_campus', 'active', 0, NULL, '2026-11-13 07:57:30', '2026-11-13 07:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `tour_slots`
--

CREATE TABLE `tour_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `slot_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `max_capacity` int(11) NOT NULL DEFAULT 150,
  `booked_count` int(11) NOT NULL DEFAULT 0,
  `guide_name` varchar(255) DEFAULT NULL,
  `status` enum('open','full','closed') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_slots`
--

INSERT INTO `tour_slots` (`id`, `event_id`, `slot_name`, `date`, `start_time`, `end_time`, `max_capacity`, `booked_count`, `guide_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Slot Tur Pagi 1 (Hari 1)', '2026-11-22', '09:00:00', '11:00:00', 150, 141, 'Kang Asep & Teh Sarah (Duta Kampus)', 'open', '2026-11-08 07:55:58', '2026-11-13 06:36:45'),
(2, 1, 'Slot Tur Siang 1 (Hari 1)', '2026-11-22', '13:00:00', '15:00:00', 150, 0, 'Kang Diki & Teh Melati', 'open', '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(3, 1, 'Slot Tur Sore 1 (Hari 1)', '2026-11-14', '13:00:00', '17:00:00', 150, 0, 'Kang Reza & Teh Rara', 'open', '2026-11-13 06:47:21', '2026-11-13 06:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active_role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `is_verified` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `active_role_id`, `status`, `is_verified`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', 'admin@futurise.id', '081122334401', NULL, '$2y$12$5e4Yu7hiJ6BWwXWK/t8AFu69J0MHWbRU3mkyTPhff2UGC2ZWjAowK', 1, 'active', 1, NULL, '2026-11-08 07:55:53', '2026-11-13 07:36:22'),
(2, 'Dr. Ir. Hendra Gunawan (Ketua Pelaksana)', 'ketua@futurise.id', '081122334402', NULL, '$2y$12$P/FhizgEUcX6dotIrfsil.4y0sIQGr6xpMlovH3WVLKObYjE0o98y', 2, 'active', 1, NULL, '2026-11-08 07:55:53', '2026-11-13 09:52:47'),
(3, 'Sekretariat APTIKOM', 'sekretariat@futurise.id', '081122334403', NULL, '$2y$12$Tyd22fpXOzTPoQaQjp4/Ve.bM01mn.5BFfl2pEpnIsHqiDbJXrXvG', 3, 'active', 1, NULL, '2026-11-08 07:55:53', '2026-11-13 09:50:09'),
(4, 'Bendahara & Keuangan', 'keuangan@futurise.id', '081122334404', NULL, '$2y$12$LoLQENgDin62VyBpvhYa5OdyOoDDBqTr8NwWOyJfG3jE7eaQwxLp2', 4, 'active', 1, NULL, '2026-11-08 07:55:53', '2026-11-08 07:55:53'),
(5, 'Koordinator Kurator & Program', 'kurator@futurise.id', '081122334405', NULL, '$2y$12$o6wyilW6O9fBWJc67mPRtOc4dUKEPdATmuRYd4SwWBtu2kRgymKQq', 5, 'active', 1, NULL, '2026-11-08 07:55:54', '2026-11-08 07:55:54'),
(6, 'Divisi Kampus & Sekolah', 'kampus@futurise.id', '081122334406', NULL, '$2y$12$PGS1iWe6gk5HVN3K3S9F4.8sArw7xwpFsbOdZP0NroA.PLTVLrm72', 6, 'active', 1, NULL, '2026-11-08 07:55:54', '2026-11-08 07:55:54'),
(7, 'Divisi Industri & Sponsor', 'sponsor@futurise.id', '081122334407', NULL, '$2y$12$LsoUtXr9Avl1dLMkXKC.zeLhyzwJUIEWa/6PoN8bD5ohT6HBy9Eoq', 7, 'active', 1, NULL, '2026-11-08 07:55:54', '2026-11-13 09:44:15'),
(8, 'Koordinator Venue & Teknis', 'venue@futurise.id', '081122334408', NULL, '$2y$12$LjsDbnCZceBDkDtfhgvsL.NcK/UZAzJmllgRKvkaT3PBSUJPISJlm', 8, 'active', 1, NULL, '2026-11-08 07:55:54', '2026-11-08 07:55:54'),
(9, 'Tim Publikasi & Media', 'publikasi@futurise.id', '081122334409', NULL, '$2y$12$0/SBErgZDnwDpO4YHvb0.etc2ImgT6Aot2Y4/ya49XCOiBUawtbp2', 9, 'active', 1, NULL, '2026-11-08 07:55:55', '2026-11-13 09:02:17'),
(10, 'Petugas Registrasi Gate Sabuga', 'registrasi@futurise.id', '081122334410', NULL, '$2y$12$d8HdaUIGYE7tuLhqMN0wOuMYX0CioF5VdUyp9oeIEa3RDn13Cy1a2', 10, 'active', 1, NULL, '2026-11-08 07:55:55', '2026-11-13 08:54:11'),
(11, 'Prof. Dr. Juri Teknologi (Juri)', 'juri@futurise.id', '081122334411', NULL, '$2y$12$JBFMifNZhG4.CU49Kdo2cO.vDvOIPgJIfmGyS/lHd1C/nI8/2f9Lu', 16, 'active', 1, NULL, '2026-11-08 07:55:55', '2026-11-13 06:06:36'),
(12, 'Dr. Rina Widyastuti (Juri Industri)', 'juri2@futurise.id', '081122334412', NULL, '$2y$12$4f9I8kd9Re8nNOQDPS.WU.iXKK3vVyN1omlZJCAfn/GThv4EIyVbu', 16, 'active', 1, NULL, '2026-11-08 07:55:56', '2026-11-08 07:55:56'),
(13, 'PIC Kampus ITB', 'kampus@itb.ac.id', '081220000001', NULL, '$2y$12$Wp6vDOlAAsLk2N3jEN4NCuVac6ku1jd4.vvR.gtK/e4ZXUGMvYF2W', 11, 'active', 1, NULL, '2026-11-08 07:55:56', '2026-11-08 07:55:56'),
(14, 'Rian Pratama (Tim Mahasiswa ITB)', 'tim@itb.ac.id', '081220000002', NULL, '$2y$12$o0HiWQQBinFtqyhQVRD2Xel5H0G8WSa1Oqd4ZO/D9AYjJHObMdEZW', 12, 'active', 1, NULL, '2026-11-08 07:55:56', '2026-11-08 07:55:56'),
(15, 'PIC Kampus Telkom University', 'kampus@telkomuniversity.ac.id', '081220000003', NULL, '$2y$12$kgO3f4yAOSu.TlGK.iMEfO8udDNlEgbN2bwzjAY9AZo78K/YxWBxu', 11, 'active', 1, NULL, '2026-11-08 07:55:56', '2026-11-13 07:56:33'),
(16, 'PIC Kampus UNIKOM Bandung', 'kampus@unikom.ac.id', '081220000004', NULL, '$2y$12$VtA.jAqLfQrOHazrYIANsOo/f7lH2pggEzBAGDSwUqj69bFBtgU7K', 11, 'active', 1, NULL, '2026-11-08 07:55:57', '2026-11-08 07:55:57'),
(17, 'VP Innovation PT Telkom Indonesia', 'industri@telkom.co.id', '081230000001', NULL, '$2y$12$NeiSNhdKNExSylShOZfJSueSTqlHDFN8NnXJA/OZOMhOFK8dWDZvi', 13, 'active', 1, NULL, '2026-11-08 07:55:57', '2026-11-08 07:55:57'),
(18, 'Corporate Secretary Bank BJB', 'sponsor@bankbjb.co.id', '081230000002', NULL, '$2y$12$FiegpPp0T5mm7zuMYcA6uOqGB4aSCK4HwEu9aAhYo..H3qBxzRV9m', 14, 'active', 1, NULL, '2026-11-08 07:55:57', '2026-11-08 07:55:57'),
(19, 'Koordinator SMKN 4 Bandung', 'sekolah@smkn4bdg.sch.id', '081240000001', NULL, '$2y$12$k0TcQd3on1aq66g0uFaYRO5Sr1yw0nYweyl5L66BuGaEcK1rYj4M6', 15, 'active', 1, NULL, '2026-11-08 07:55:57', '2026-11-08 07:55:57'),
(20, 'Budi Santoso (Pengunjung Umum)', 'pengunjung@gmail.com', '081250000001', NULL, '$2y$12$wy1dPxU9qMrbVq.c.jtt7exXzQo1TQ9UpiO7LErrPYgEKEmzvArHS', 17, 'active', 1, NULL, '2026-11-08 07:55:58', '2026-11-08 07:55:58'),
(21, 'Pengunjung Terdaftar 1', 'visitor1@example.com', '081222303663', NULL, '$2y$12$gBsC1JT.yc1hd0/iJj2qbuPnnnzQ3frTL55GEpMBVFX0x6M2TOzBW', 17, 'active', 1, NULL, '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(22, 'Pengunjung Terdaftar 2', 'visitor2@example.com', '081281531751', NULL, '$2y$12$Er.d3NdQ3i1NJbQOglhsSel5kQsOVfJXOoBbe54zg9QmdT/3wnUUq', 17, 'active', 1, NULL, '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(23, 'Pengunjung Terdaftar 3', 'visitor3@example.com', '081295198248', NULL, '$2y$12$NUARlmzFmX9BgsghfOD.gOFOR6VlQmOtl4mJhr7apAcMi1a5.PSFi', 17, 'active', 1, NULL, '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(24, 'Pengunjung Terdaftar 4', 'visitor4@example.com', '081273557634', NULL, '$2y$12$b/7Ubf1eG.jE9Qa60/hiy.9yyQeo3s6HggjeGA6eBS8E5dnOTCytK', 17, 'active', 1, NULL, '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(25, 'Pengunjung Terdaftar 5', 'visitor5@example.com', '081286385521', NULL, '$2y$12$L5oKEBgTbFjQbuD2uEZFHea5SPVYsPIjwypMAkD5XWPTZB.b/U1JK', 17, 'active', 1, NULL, '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(26, 'Pengunjung Terdaftar 6', 'visitor6@example.com', '081254340280', NULL, '$2y$12$9KS117UvhcXMUcVElKNWPupSEiBJK3KqnV4/hMzg2Aow.mnG.oCsm', 17, 'active', 1, NULL, '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(27, 'Pengunjung Terdaftar 7', 'visitor7@example.com', '081269298557', NULL, '$2y$12$wtt75Bys9prsAjuhXX1XB.5U9lDeU82dUdSnl62Z/2FAhi5CULzF2', 17, 'active', 1, NULL, '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(28, 'Pengunjung Terdaftar 8', 'visitor8@example.com', '081244768093', NULL, '$2y$12$R1y6MOAhZkpFWuOjjUlQ.OiSOpkmGtGdkycqIcxmu79WZp/K22hFa', 17, 'active', 1, NULL, '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(29, 'Pengunjung Terdaftar 9', 'visitor9@example.com', '081214818306', NULL, '$2y$12$b4F.XU6OfbMfd22cynhn.ed47fDSMrX1TsdrAsjwGSJ363GrBtbbC', 17, 'active', 1, NULL, '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(30, 'Pengunjung Terdaftar 10', 'visitor10@example.com', '081272262136', NULL, '$2y$12$i25mpj0hA9M/QilqB4IuDulP4gjlgxYnoIHWE.y3qcxH9QYNBded2', 17, 'active', 1, NULL, '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(31, 'Pengunjung Terdaftar 11', 'visitor11@example.com', '081286903109', NULL, '$2y$12$QKTRqY0mAU3HgRv7lAqbZe6xJtPandElqoR0DlOJoLdrNxyVLS4OK', 17, 'active', 1, NULL, '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(32, 'Pengunjung Terdaftar 12', 'visitor12@example.com', '081251634011', NULL, '$2y$12$GX1/PRA9FLUr7QWb22G0y.6Dinv6lPtWpU7QMD5cE5h/sjyUVjrRW', 17, 'active', 1, NULL, '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(33, 'Pengunjung Terdaftar 13', 'visitor13@example.com', '081273395345', NULL, '$2y$12$SkCYbqTS6jrS9UClk3FRIuFi6.N4YZ3K3ZoDCPIW7irpRnaMXkWki', 17, 'active', 1, NULL, '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(34, 'Pengunjung Terdaftar 14', 'visitor14@example.com', '081247171841', NULL, '$2y$12$4mPtm22NhgqlJxrO49DyjO0RXmjPkFGYH7ZB8qpF3RPAdPSp.G5j.', 17, 'active', 1, NULL, '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(35, 'Pengunjung Terdaftar 15', 'visitor15@example.com', '081249249884', NULL, '$2y$12$aYzkvFn1ya2bNa2og1MGa.iBpUyEVm65f3bkzKCqnttLnpFEIq6Uy', 17, 'active', 1, NULL, '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(36, 'Pengunjung Terdaftar 16', 'visitor16@example.com', '081254145595', NULL, '$2y$12$BcvL8mQPc/5q4KnNrmb3p.KnsP8Nl.KbBS82OAj5Y.15U8tW/SXRq', 17, 'active', 1, NULL, '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(37, 'Pengunjung Terdaftar 17', 'visitor17@example.com', '081243587420', NULL, '$2y$12$5vFXiuSCS8aQHc4L8D9Vb.TG.ROaJZ8rfE1N52oQDMiIV0nNCkeDa', 17, 'active', 1, NULL, '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(38, 'Pengunjung Terdaftar 18', 'visitor18@example.com', '081281333265', NULL, '$2y$12$.PKW/EUPdRx9Rpa9RVBPUOdXeB3Imc6vMG/BZTVUmOBu0nSP.boO2', 17, 'active', 1, NULL, '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(39, 'Pengunjung Terdaftar 19', 'visitor19@example.com', '081270585337', NULL, '$2y$12$DiJjUnn4GdqURnGADgT/WuYj82lw2uekcHIydeBDmz6eV6PdDEuBK', 17, 'active', 1, NULL, '2026-11-08 07:56:03', '2026-11-08 07:56:03'),
(40, 'Pengunjung Terdaftar 20', 'visitor20@example.com', '081213208974', NULL, '$2y$12$q5QWvYfpbduQWOMRNlQW8eOvennYiYbEJNdl4poKnf4aSVPA3VadW', 17, 'active', 1, NULL, '2026-11-08 07:56:04', '2026-11-08 07:56:04'),
(41, 'Pengunjung Terdaftar 21', 'visitor21@example.com', '081257332372', NULL, '$2y$12$ystJ3DNuRGIeevg/NhQSd.YSNH13PhriWzuSbIzsVMyAeTO9KQuIu', 17, 'active', 1, NULL, '2026-11-08 07:56:04', '2026-11-08 07:56:04'),
(42, 'Pengunjung Terdaftar 22', 'visitor22@example.com', '081234873643', NULL, '$2y$12$pUTxdv3rQGsKmP53s96XQOAndvHLaUmR/6v/qjKFESpKG3vaRG9l.', 17, 'active', 1, NULL, '2026-11-08 07:56:04', '2026-11-08 07:56:04'),
(43, 'Pengunjung Terdaftar 23', 'visitor23@example.com', '081227120989', NULL, '$2y$12$6bEkH.jWtYxYupY5srYuLecku4AGl1ul1eiAaNo9ZoTawiVgqyeFK', 17, 'active', 1, NULL, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(44, 'Pengunjung Terdaftar 24', 'visitor24@example.com', '081268181715', NULL, '$2y$12$aFA/7GQCHnzWazNCcrw5au4Dnm2zm0hfsSwZCJTVPJ95HXQvQl2mS', 17, 'active', 1, NULL, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(45, 'Pengunjung Terdaftar 25', 'visitor25@example.com', '081212505030', NULL, '$2y$12$ckn7BdNu1js7OExGv2Wzq.xJJ3z39YOZnnYoyF9AmN7bpY7gEH2xS', 17, 'active', 1, NULL, '2026-11-08 07:56:05', '2026-11-08 07:56:05'),
(46, 'Yessica Fara Desvia', 'yessica.desvia.krw@horizon.ac.id', '0811-1006-7155', NULL, '$2y$12$qEX1BrU48YvEpdsKQKV7le53o08zIb/Nwyy5VP/34GHh5k24qlTG2', 17, 'active', 1, NULL, '2026-11-13 03:48:08', '2026-11-13 03:48:08'),
(47, 'PIC Sekolah', 'picsekolah@gmail.com', '082212345678', NULL, '$2y$12$HGLjMwVa2PBjuzBsya88xutAEX288Qypbe3l9zdv7dZ67TjGIX7Ny', 15, 'active', 1, NULL, '2026-11-13 06:33:38', '2026-11-13 06:33:38'),
(48, 'PIC Sponsor', 'picsponsor@gmail.com', '081123456789', NULL, '$2y$12$HJWsWYZC79t9mkwrUcEtYOC5llES3BDgQ6pgonXKCj8Yzx8eLkQfO', 14, 'active', 1, NULL, '2026-11-13 06:54:23', '2026-11-13 06:54:23'),
(49, 'PIC Industri', 'picindustri@gmail.com', '081324567891', NULL, '$2y$12$G6Dc9at0IsqgX/flWipiROpd4EB4xCEvQxLj6hjMGK.uMR0byjCMu', 13, 'active', 1, NULL, '2026-11-13 07:30:01', '2026-11-13 07:30:01'),
(50, 'Tim Mahasiswa B', 'timmhsb@gmail.com', '123456789', NULL, '$2y$12$WhjO57dpX0y217N51eER3ewHhKA/MB9JQO1ikD.6x2Uvc8iGvVBDe', 12, 'active', 1, NULL, '2026-11-13 07:41:37', '2026-11-13 08:18:19'),
(51, 'PIC Kampus', 'pickampus@gmail.com', '082145678923', NULL, '$2y$12$8ZhNtvuwnvTdLjm6ByrlfejCv9x8uGbLL1HkNZNg3KbwCJPp7Rnwa', 11, 'active', 1, NULL, '2026-11-13 07:57:30', '2026-11-13 07:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `map_embed_url` varchar(255) DEFAULT NULL,
  `floor_plan_image` varchar(255) DEFAULT NULL,
  `concurrent_capacity` int(11) NOT NULL DEFAULT 500,
  `facilities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`facilities`)),
  `transport_guide` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `event_id`, `name`, `address`, `map_embed_url`, `floor_plan_image`, `concurrent_capacity`, `facilities`, `transport_guide`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sasana Budaya Ganesha (Sabuga) ITB', 'Jl. Tamansari No. 73, Lebak Siliwangi, Coblong, Kota Bandung', 'https://maps.google.com/?q=Sabuga+ITB+Bandung', '/images/denah-sabuga.svg', 600, '[\"Free High-Speed Wi-Fi\",\"Ruang VIP & Media Center\",\"Panggung Utama & LED Display 4K\",\"Meja Business Matchmaking (10 Meja Khusus)\",\"Kantin & Food Court Area\",\"Musholla & Toilet Difabel\",\"Klinik & Pos Medis Pertolongan Pertama\",\"Area Parkir 500 Mobil & 1000 Motor\"]', 'Dapat diakses melalui Angkot Cicaheum-Ciroyom, Dago-Stasiun Hall, atau bus Damri Dipatiukur. Dari Stasiun Bandung sekitar 15 menit menggunakan taksi/ojek online.', '2026-11-08 07:55:52', '2026-11-08 07:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `event_id`, `project_id`, `user_id`, `ticket_id`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 21, 2, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(2, 1, 3, 22, 3, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(3, 1, 4, 23, 4, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(4, 1, 5, 24, 5, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:55:59', '2026-11-08 07:55:59'),
(5, 1, 6, 25, 6, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(6, 1, 7, 26, 7, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(7, 1, 8, 27, 8, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:56:00', '2026-11-08 07:56:00'),
(8, 1, 9, 28, 9, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(9, 1, 10, 29, 10, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(10, 1, 1, 30, 11, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(11, 1, 2, 31, 12, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:56:01', '2026-11-08 07:56:01'),
(12, 1, 3, 32, 13, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(13, 1, 4, 33, 14, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(14, 1, 5, 34, 15, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(15, 1, 6, 35, 16, '127.0.0.1', 'Mozilla/5.0 Mobile Browser', '2026-11-08 07:56:02', '2026-11-08 07:56:02'),
(16, 1, 9, 46, 27, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', '2026-11-13 05:46:29', '2026-11-13 05:46:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assessments_user_id_project_id_unique` (`user_id`,`project_id`),
  ADD KEY `assessments_judge_assignment_id_foreign` (`judge_assignment_id`),
  ADD KEY `assessments_project_id_foreign` (`project_id`),
  ADD KEY `assessments_unlocked_by_foreign` (`unlocked_by`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_event_id_foreign` (`event_id`),
  ADD KEY `audit_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `benefits`
--
ALTER TABLE `benefits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `benefits_package_id_foreign` (`package_id`);

--
-- Indexes for table `benefit_fulfillments`
--
ALTER TABLE `benefit_fulfillments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `benefit_fulfillments_agreement_id_foreign` (`agreement_id`),
  ADD KEY `benefit_fulfillments_benefit_id_foreign` (`benefit_id`),
  ADD KEY `benefit_fulfillments_verified_by_foreign` (`verified_by`);

--
-- Indexes for table `booths`
--
ALTER TABLE `booths`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booths_event_id_code_unique` (`event_id`,`code`),
  ADD KEY `booths_code_index` (`code`);

--
-- Indexes for table `booth_allocations`
--
ALTER TABLE `booth_allocations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booth_allocations_event_id_booth_id_unique` (`event_id`,`booth_id`),
  ADD KEY `booth_allocations_booth_id_foreign` (`booth_id`),
  ADD KEY `booth_allocations_organization_id_foreign` (`organization_id`),
  ADD KEY `booth_allocations_allocated_by_foreign` (`allocated_by`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `campus_profiles`
--
ALTER TABLE `campus_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campus_profiles_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `check_in_logs`
--
ALTER TABLE `check_in_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `check_in_logs_event_id_foreign` (`event_id`),
  ADD KEY `check_in_logs_ticket_id_foreign` (`ticket_id`),
  ADD KEY `check_in_logs_user_id_foreign` (`user_id`),
  ADD KEY `check_in_logs_scanned_by_foreign` (`scanned_by`);

--
-- Indexes for table `collaboration_needs`
--
ALTER TABLE `collaboration_needs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collaboration_needs_organization_id_foreign` (`organization_id`),
  ADD KEY `collaboration_needs_project_id_foreign` (`project_id`);

--
-- Indexes for table `company_profiles`
--
ALTER TABLE `company_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_profiles_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criteria_rubric_version_id_foreign` (`rubric_version_id`),
  ADD KEY `criteria_code_index` (`code`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_event_id_foreign` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `events_slug_unique` (`slug`);

--
-- Indexes for table `event_sessions`
--
ALTER TABLE `event_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_sessions_event_id_foreign` (`event_id`);

--
-- Indexes for table `event_settings`
--
ALTER TABLE `event_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_settings_event_id_key_unique` (`event_id`,`key`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_event_id_foreign` (`event_id`),
  ADD KEY `expenses_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_ups`
--
ALTER TABLE `follow_ups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follow_ups_event_id_foreign` (`event_id`),
  ADD KEY `follow_ups_meeting_id_foreign` (`meeting_id`),
  ADD KEY `follow_ups_project_id_foreign` (`project_id`),
  ADD KEY `follow_ups_organization_id_foreign` (`organization_id`),
  ADD KEY `follow_ups_pic_user_id_foreign` (`pic_user_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_event_id_foreign` (`event_id`),
  ADD KEY `invoices_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `in_kind_contributions`
--
ALTER TABLE `in_kind_contributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `in_kind_contributions_agreement_id_foreign` (`agreement_id`),
  ADD KEY `in_kind_contributions_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judge_assignments`
--
ALTER TABLE `judge_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `judge_assignments_event_id_user_id_project_id_unique` (`event_id`,`user_id`,`project_id`),
  ADD KEY `judge_assignments_user_id_foreign` (`user_id`),
  ADD KEY `judge_assignments_project_id_foreign` (`project_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meetings_event_id_foreign` (`event_id`),
  ADD KEY `meetings_requester_org_id_foreign` (`requester_org_id`),
  ADD KEY `meetings_target_org_id_foreign` (`target_org_id`),
  ADD KEY `meetings_project_id_foreign` (`project_id`);

--
-- Indexes for table `meeting_participants`
--
ALTER TABLE `meeting_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_participants_meeting_id_foreign` (`meeting_id`),
  ADD KEY `meeting_participants_user_id_foreign` (`user_id`),
  ADD KEY `meeting_participants_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_event_id_slug_unique` (`event_id`,`slug`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organizations_event_id_slug_unique` (`event_id`,`slug`);

--
-- Indexes for table `organization_memberships`
--
ALTER TABLE `organization_memberships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organization_memberships_organization_id_user_id_unique` (`organization_id`,`user_id`),
  ADD KEY `organization_memberships_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_payment_number_unique` (`payment_number`),
  ADD KEY `payments_invoice_id_foreign` (`invoice_id`),
  ADD KEY `payments_verified_by_foreign` (`verified_by`);

--
-- Indexes for table `payment_allocations`
--
ALTER TABLE `payment_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_allocations_payment_id_foreign` (`payment_id`),
  ADD KEY `payment_allocations_invoice_item_id_foreign` (`invoice_item_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persons_user_id_foreign` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_event_id_slug_unique` (`event_id`,`slug`),
  ADD KEY `projects_organization_id_foreign` (`organization_id`),
  ADD KEY `projects_team_id_foreign` (`team_id`),
  ADD KEY `projects_booth_id_foreign` (`booth_id`),
  ADD KEY `projects_reviewed_by_foreign` (`reviewed_by`);

--
-- Indexes for table `project_feedbacks`
--
ALTER TABLE `project_feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_feedbacks_project_id_foreign` (`project_id`),
  ADD KEY `project_feedbacks_user_id_foreign` (`user_id`);

--
-- Indexes for table `project_media`
--
ALTER TABLE `project_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_media_project_id_foreign` (`project_id`);

--
-- Indexes for table `project_versions`
--
ALTER TABLE `project_versions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_versions_project_id_foreign` (`project_id`),
  ADD KEY `project_versions_submitted_by_foreign` (`submitted_by`);

--
-- Indexes for table `publication_approvals`
--
ALTER TABLE `publication_approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publication_approvals_project_id_foreign` (`project_id`),
  ADD KEY `publication_approvals_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registrations_registration_code_unique` (`registration_code`),
  ADD KEY `registrations_event_id_foreign` (`event_id`),
  ADD KEY `registrations_organization_id_foreign` (`organization_id`),
  ADD KEY `registrations_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_user_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `rubric_versions`
--
ALTER TABLE `rubric_versions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rubric_versions_event_id_foreign` (`event_id`);

--
-- Indexes for table `school_profiles`
--
ALTER TABLE `school_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_profiles_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `school_visits`
--
ALTER TABLE `school_visits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `school_visits_qr_group_token_unique` (`qr_group_token`),
  ADD KEY `school_visits_tour_slot_id_foreign` (`tour_slot_id`),
  ADD KEY `school_visits_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `scores_assessment_id_criterion_id_unique` (`assessment_id`,`criterion_id`),
  ADD KEY `scores_criterion_id_foreign` (`criterion_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `speakers_session_id_foreign` (`session_id`);

--
-- Indexes for table `sponsorship_agreements`
--
ALTER TABLE `sponsorship_agreements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sponsorship_agreements_agreement_number_unique` (`agreement_number`),
  ADD KEY `sponsorship_agreements_event_id_foreign` (`event_id`),
  ADD KEY `sponsorship_agreements_organization_id_foreign` (`organization_id`),
  ADD KEY `sponsorship_agreements_package_id_foreign` (`package_id`);

--
-- Indexes for table `sponsorship_packages`
--
ALTER TABLE `sponsorship_packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sponsorship_packages_event_id_slug_unique` (`event_id`,`slug`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `support_tickets_ticket_code_unique` (`ticket_code`),
  ADD KEY `support_tickets_user_id_foreign` (`user_id`),
  ADD KEY `support_tickets_responded_by_foreign` (`responded_by`);

--
-- Indexes for table `survey_responses`
--
ALTER TABLE `survey_responses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `survey_responses_event_ticket_unique` (`event_id`,`ticket_id`),
  ADD KEY `survey_responses_user_id_foreign` (`user_id`),
  ADD KEY `survey_responses_ticket_id_index` (`ticket_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_event_id_foreign` (`event_id`),
  ADD KEY `tasks_assigned_to_foreign` (`assigned_to`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_members_team_id_foreign` (`team_id`),
  ADD KEY `team_members_user_id_foreign` (`user_id`);

--
-- Indexes for table `technical_requirements`
--
ALTER TABLE `technical_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `technical_requirements_project_id_foreign` (`project_id`),
  ADD KEY `technical_requirements_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tickets_ticket_number_unique` (`ticket_number`),
  ADD UNIQUE KEY `tickets_qr_token_unique` (`qr_token`),
  ADD KEY `tickets_event_id_foreign` (`event_id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`),
  ADD KEY `tickets_registration_id_foreign` (`registration_id`);

--
-- Indexes for table `tour_slots`
--
ALTER TABLE `tour_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_slots_event_id_foreign` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venues_event_id_foreign` (`event_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `votes_event_id_user_id_unique` (`event_id`,`user_id`),
  ADD UNIQUE KEY `votes_event_id_ticket_id_unique` (`event_id`,`ticket_id`),
  ADD KEY `votes_project_id_foreign` (`project_id`),
  ADD KEY `votes_user_id_foreign` (`user_id`),
  ADD KEY `votes_ticket_id_index` (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `benefits`
--
ALTER TABLE `benefits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `benefit_fulfillments`
--
ALTER TABLE `benefit_fulfillments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booths`
--
ALTER TABLE `booths`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `booth_allocations`
--
ALTER TABLE `booth_allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `campus_profiles`
--
ALTER TABLE `campus_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `check_in_logs`
--
ALTER TABLE `check_in_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `collaboration_needs`
--
ALTER TABLE `collaboration_needs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `company_profiles`
--
ALTER TABLE `company_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_sessions`
--
ALTER TABLE `event_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event_settings`
--
ALTER TABLE `event_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `follow_ups`
--
ALTER TABLE `follow_ups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `in_kind_contributions`
--
ALTER TABLE `in_kind_contributions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `judge_assignments`
--
ALTER TABLE `judge_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meeting_participants`
--
ALTER TABLE `meeting_participants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `organization_memberships`
--
ALTER TABLE `organization_memberships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_allocations`
--
ALTER TABLE `payment_allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `project_feedbacks`
--
ALTER TABLE `project_feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_media`
--
ALTER TABLE `project_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_versions`
--
ALTER TABLE `project_versions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `publication_approvals`
--
ALTER TABLE `publication_approvals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `rubric_versions`
--
ALTER TABLE `rubric_versions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_profiles`
--
ALTER TABLE `school_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_visits`
--
ALTER TABLE `school_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sponsorship_agreements`
--
ALTER TABLE `sponsorship_agreements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sponsorship_packages`
--
ALTER TABLE `sponsorship_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `survey_responses`
--
ALTER TABLE `survey_responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `technical_requirements`
--
ALTER TABLE `technical_requirements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tour_slots`
--
ALTER TABLE `tour_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessments`
--
ALTER TABLE `assessments`
  ADD CONSTRAINT `assessments_judge_assignment_id_foreign` FOREIGN KEY (`judge_assignment_id`) REFERENCES `judge_assignments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assessments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assessments_unlocked_by_foreign` FOREIGN KEY (`unlocked_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `assessments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `benefits`
--
ALTER TABLE `benefits`
  ADD CONSTRAINT `benefits_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `sponsorship_packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `benefit_fulfillments`
--
ALTER TABLE `benefit_fulfillments`
  ADD CONSTRAINT `benefit_fulfillments_agreement_id_foreign` FOREIGN KEY (`agreement_id`) REFERENCES `sponsorship_agreements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `benefit_fulfillments_benefit_id_foreign` FOREIGN KEY (`benefit_id`) REFERENCES `benefits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `benefit_fulfillments_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `booths`
--
ALTER TABLE `booths`
  ADD CONSTRAINT `booths_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booth_allocations`
--
ALTER TABLE `booth_allocations`
  ADD CONSTRAINT `booth_allocations_allocated_by_foreign` FOREIGN KEY (`allocated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `booth_allocations_booth_id_foreign` FOREIGN KEY (`booth_id`) REFERENCES `booths` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booth_allocations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booth_allocations_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `campus_profiles`
--
ALTER TABLE `campus_profiles`
  ADD CONSTRAINT `campus_profiles_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `check_in_logs`
--
ALTER TABLE `check_in_logs`
  ADD CONSTRAINT `check_in_logs_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `check_in_logs_scanned_by_foreign` FOREIGN KEY (`scanned_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `check_in_logs_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `check_in_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `collaboration_needs`
--
ALTER TABLE `collaboration_needs`
  ADD CONSTRAINT `collaboration_needs_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `collaboration_needs_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `company_profiles`
--
ALTER TABLE `company_profiles`
  ADD CONSTRAINT `company_profiles_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `criteria`
--
ALTER TABLE `criteria`
  ADD CONSTRAINT `criteria_rubric_version_id_foreign` FOREIGN KEY (`rubric_version_id`) REFERENCES `rubric_versions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_sessions`
--
ALTER TABLE `event_sessions`
  ADD CONSTRAINT `event_sessions_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_settings`
--
ALTER TABLE `event_settings`
  ADD CONSTRAINT `event_settings_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `expenses_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follow_ups`
--
ALTER TABLE `follow_ups`
  ADD CONSTRAINT `follow_ups_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follow_ups_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `follow_ups_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follow_ups_pic_user_id_foreign` FOREIGN KEY (`pic_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `follow_ups_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `in_kind_contributions`
--
ALTER TABLE `in_kind_contributions`
  ADD CONSTRAINT `in_kind_contributions_agreement_id_foreign` FOREIGN KEY (`agreement_id`) REFERENCES `sponsorship_agreements` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `in_kind_contributions_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `judge_assignments`
--
ALTER TABLE `judge_assignments`
  ADD CONSTRAINT `judge_assignments_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `judge_assignments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `judge_assignments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meetings_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `meetings_requester_org_id_foreign` FOREIGN KEY (`requester_org_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meetings_target_org_id_foreign` FOREIGN KEY (`target_org_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meeting_participants`
--
ALTER TABLE `meeting_participants`
  ADD CONSTRAINT `meeting_participants_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meeting_participants_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meeting_participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `organization_memberships`
--
ALTER TABLE `organization_memberships`
  ADD CONSTRAINT `organization_memberships_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `organization_memberships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payment_allocations`
--
ALTER TABLE `payment_allocations`
  ADD CONSTRAINT `payment_allocations_invoice_item_id_foreign` FOREIGN KEY (`invoice_item_id`) REFERENCES `invoice_items` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payment_allocations_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `persons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_booth_id_foreign` FOREIGN KEY (`booth_id`) REFERENCES `booths` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_feedbacks`
--
ALTER TABLE `project_feedbacks`
  ADD CONSTRAINT `project_feedbacks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_feedbacks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_media`
--
ALTER TABLE `project_media`
  ADD CONSTRAINT `project_media_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_versions`
--
ALTER TABLE `project_versions`
  ADD CONSTRAINT `project_versions_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_versions_submitted_by_foreign` FOREIGN KEY (`submitted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `publication_approvals`
--
ALTER TABLE `publication_approvals`
  ADD CONSTRAINT `publication_approvals_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `publication_approvals_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `registrations_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `registrations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rubric_versions`
--
ALTER TABLE `rubric_versions`
  ADD CONSTRAINT `rubric_versions_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `school_profiles`
--
ALTER TABLE `school_profiles`
  ADD CONSTRAINT `school_profiles_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `school_visits`
--
ALTER TABLE `school_visits`
  ADD CONSTRAINT `school_visits_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_visits_tour_slot_id_foreign` FOREIGN KEY (`tour_slot_id`) REFERENCES `tour_slots` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scores_criterion_id_foreign` FOREIGN KEY (`criterion_id`) REFERENCES `criteria` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `speakers`
--
ALTER TABLE `speakers`
  ADD CONSTRAINT `speakers_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `event_sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sponsorship_agreements`
--
ALTER TABLE `sponsorship_agreements`
  ADD CONSTRAINT `sponsorship_agreements_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sponsorship_agreements_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sponsorship_agreements_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `sponsorship_packages` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sponsorship_packages`
--
ALTER TABLE `sponsorship_packages`
  ADD CONSTRAINT `sponsorship_packages_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD CONSTRAINT `support_tickets_responded_by_foreign` FOREIGN KEY (`responded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `support_tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `survey_responses`
--
ALTER TABLE `survey_responses`
  ADD CONSTRAINT `survey_responses_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `survey_responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `team_members_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `technical_requirements`
--
ALTER TABLE `technical_requirements`
  ADD CONSTRAINT `technical_requirements_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `technical_requirements_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_registration_id_foreign` FOREIGN KEY (`registration_id`) REFERENCES `registrations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tour_slots`
--
ALTER TABLE `tour_slots`
  ADD CONSTRAINT `tour_slots_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `venues`
--
ALTER TABLE `venues`
  ADD CONSTRAINT `venues_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
