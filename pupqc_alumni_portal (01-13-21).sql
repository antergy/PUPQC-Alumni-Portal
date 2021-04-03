-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2021 at 03:35 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pupqc_alumni_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_01_11_084428_create_r_account_types', 1),
(2, '2021_01_11_084712_create_r_post_types', 1),
(3, '2021_01_11_084842_create_r_courses', 1),
(4, '2021_01_11_085142_create_r_educational_attainment', 1),
(5, '2021_01_11_085324_create_r_honors_received', 1),
(6, '2021_01_11_085534_create_r_professional_exams', 1),
(7, '2021_01_11_085648_create_r_first_job_timeframe', 1),
(8, '2021_01_11_085701_create_r_first_job_discover', 1),
(9, '2021_01_11_085906_create_r_job_level_classification', 1),
(10, '2021_01_11_090027_create_r_self_employed_salary', 1),
(11, '2021_01_11_090045_create_r_unemployment_reason', 1),
(12, '2021_01_11_090211_create_r_industry', 1),
(13, '2021_01_11_090226_create_r_competencies', 1),
(14, '2021_01_11_090358_create_r_impact_of_education', 1),
(15, '2021_01_11_095426_create_t_accounts', 1),
(16, '2021_01_11_100559_create_t_alumni', 1),
(17, '2021_01_11_103356_create_t_alumni_job_level_exp', 1),
(18, '2021_01_11_103433_create_t_alumni_unemployed_reason', 1),
(19, '2021_01_11_103500_create_t_alumni_work_experience', 1),
(20, '2021_01_11_103543_create_t_alumni_competencies', 1),
(21, '2021_01_11_103555_create_t_alumni_impact_education', 1),
(22, '2021_01_11_103646_create_t_alumni_shared_contact', 1),
(23, '2021_01_11_112418_create_t_posts', 1),
(24, '2021_01_11_113146_create_t_likes', 1),
(25, '2021_01_11_113426_create_t_comments', 1),
(26, '2021_01_11_113636_create_t_inboxes', 1),
(27, '2021_01_11_114421_create_t_visit_logs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_account_types`
--

CREATE TABLE `r_account_types` (
  `at_id` bigint(20) UNSIGNED NOT NULL,
  `at_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_competencies`
--

CREATE TABLE `r_competencies` (
  `competency_id` bigint(20) UNSIGNED NOT NULL,
  `competency_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_courses`
--

CREATE TABLE `r_courses` (
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `course_desc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_acronym` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_educational_attainment`
--

CREATE TABLE `r_educational_attainment` (
  `educ_attain_id` bigint(20) UNSIGNED NOT NULL,
  `educ_attain_desc` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_first_job_discover`
--

CREATE TABLE `r_first_job_discover` (
  `fjd_id` bigint(20) UNSIGNED NOT NULL,
  `fjd_desc` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_first_job_timeframe`
--

CREATE TABLE `r_first_job_timeframe` (
  `fjtf_id` bigint(20) UNSIGNED NOT NULL,
  `fjtf_desc` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_honors_received`
--

CREATE TABLE `r_honors_received` (
  `honor_id` bigint(20) UNSIGNED NOT NULL,
  `honor_desc` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_impact_of_education`
--

CREATE TABLE `r_impact_of_education` (
  `ioe_id` bigint(20) UNSIGNED NOT NULL,
  `ioe_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_industry`
--

CREATE TABLE `r_industry` (
  `industry_id` bigint(20) UNSIGNED NOT NULL,
  `industry_desc` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_job_level_classification`
--

CREATE TABLE `r_job_level_classification` (
  `jlc_id` bigint(20) UNSIGNED NOT NULL,
  `jlc_desc` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_post_types`
--

CREATE TABLE `r_post_types` (
  `pt_id` bigint(20) UNSIGNED NOT NULL,
  `pt_desc` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_professional_exams`
--

CREATE TABLE `r_professional_exams` (
  `profex_id` bigint(20) UNSIGNED NOT NULL,
  `profex_desc` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_self_employed_salary`
--

CREATE TABLE `r_self_employed_salary` (
  `se_salary_id` bigint(20) UNSIGNED NOT NULL,
  `se_salary_desc` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `r_unemployment_reason`
--

CREATE TABLE `r_unemployment_reason` (
  `ur_id` bigint(20) UNSIGNED NOT NULL,
  `ur_desc` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_accounts`
--

CREATE TABLE `t_accounts` (
  `acc_id` bigint(20) UNSIGNED NOT NULL,
  `acc_username` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_password` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_email` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_picture` longtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DEF-PIC',
  `acc_type` bigint(20) UNSIGNED NOT NULL,
  `acc_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_alumni`
--

CREATE TABLE `t_alumni` (
  `al_id` bigint(20) UNSIGNED NOT NULL,
  `al_acc_id` bigint(20) UNSIGNED NOT NULL,
  `al_firstname` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `al_middlename` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `al_lastname` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `al_birthdate` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `al_address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `al_email` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `al_tel_num` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `al_mobile_num` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `al_student_num` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `al_civil_status` int(11) NOT NULL,
  `al_course_id` bigint(20) UNSIGNED NOT NULL,
  `al_year_graduated` year(4) NOT NULL,
  `al_honors_received` bigint(20) UNSIGNED NOT NULL,
  `al_educ_attainment` bigint(20) UNSIGNED NOT NULL,
  `al_educ_attainment_others` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `al_prof_exam_passed` bigint(20) UNSIGNED NOT NULL,
  `al_prof_exam_passed_others` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `al_employment_status` int(11) NOT NULL,
  `al_first_job_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `al_first_job_discover` bigint(20) UNSIGNED DEFAULT NULL,
  `al_first_job_timeframe` bigint(20) UNSIGNED DEFAULT NULL,
  `al_work_place` int(11) DEFAULT NULL,
  `al_work_place_intl` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `al_self_employ_salary` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_alumni_competencies`
--

CREATE TABLE `t_alumni_competencies` (
  `alcom_id` bigint(20) UNSIGNED NOT NULL,
  `alcom_alumni_id` bigint(20) UNSIGNED NOT NULL,
  `alcom_competency` bigint(20) UNSIGNED NOT NULL,
  `alcom_acquire_level` int(11) NOT NULL,
  `alcom_relevant_level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_alumni_impact_education`
--

CREATE TABLE `t_alumni_impact_education` (
  `aled_id` bigint(20) UNSIGNED NOT NULL,
  `aled_alumni_id` bigint(20) UNSIGNED NOT NULL,
  `aled_impact_education` bigint(20) UNSIGNED NOT NULL,
  `aled_rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_alumni_job_level_exp`
--

CREATE TABLE `t_alumni_job_level_exp` (
  `ajle_id` bigint(20) UNSIGNED NOT NULL,
  `ajle_alumni_id` bigint(20) UNSIGNED NOT NULL,
  `ajle_job_level_id` bigint(20) UNSIGNED NOT NULL,
  `ajle_occurence` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_alumni_shared_contact`
--

CREATE TABLE `t_alumni_shared_contact` (
  `asc_id` bigint(20) UNSIGNED NOT NULL,
  `asc_shared_by` bigint(20) UNSIGNED NOT NULL,
  `asc_name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `asc_email` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `asc_contact_num` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_alumni_unemployed_reason`
--

CREATE TABLE `t_alumni_unemployed_reason` (
  `aur_id` bigint(20) UNSIGNED NOT NULL,
  `aur_alumni_id` bigint(20) UNSIGNED NOT NULL,
  `aur_unemploy_reason` bigint(20) UNSIGNED NOT NULL,
  `aur_other_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_alumni_work_experience`
--

CREATE TABLE `t_alumni_work_experience` (
  `awe_id` bigint(20) UNSIGNED NOT NULL,
  `awe_alumni_id` bigint(20) UNSIGNED NOT NULL,
  `awe_company_name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `awe_company_address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `awe_company_nature` int(11) NOT NULL,
  `awe_company_nature_others` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `awe_industry_nature` bigint(20) UNSIGNED NOT NULL,
  `awe_industry_nature_others` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_comments`
--

CREATE TABLE `t_comments` (
  `cm_id` bigint(20) UNSIGNED NOT NULL,
  `cm_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cm_post_id` bigint(20) UNSIGNED NOT NULL,
  `cm_acc_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_inboxes`
--

CREATE TABLE `t_inboxes` (
  `in_id` bigint(20) UNSIGNED NOT NULL,
  `in_message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_acc_id_from` bigint(20) UNSIGNED NOT NULL,
  `in_acc_id_to` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_likes`
--

CREATE TABLE `t_likes` (
  `lk_id` bigint(20) UNSIGNED NOT NULL,
  `lk_post_id` bigint(20) UNSIGNED NOT NULL,
  `lk_acc_id` bigint(20) UNSIGNED NOT NULL,
  `lk_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_posts`
--

CREATE TABLE `t_posts` (
  `p_id` bigint(20) UNSIGNED NOT NULL,
  `p_title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_picture` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_acc_id` bigint(20) UNSIGNED NOT NULL,
  `p_type_id` bigint(20) UNSIGNED NOT NULL,
  `p_course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_visit_logs`
--

CREATE TABLE `t_visit_logs` (
  `vs_id` bigint(20) UNSIGNED NOT NULL,
  `vs_acc_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `r_account_types`
--
ALTER TABLE `r_account_types`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexes for table `r_competencies`
--
ALTER TABLE `r_competencies`
  ADD PRIMARY KEY (`competency_id`);

--
-- Indexes for table `r_courses`
--
ALTER TABLE `r_courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `r_educational_attainment`
--
ALTER TABLE `r_educational_attainment`
  ADD PRIMARY KEY (`educ_attain_id`);

--
-- Indexes for table `r_first_job_discover`
--
ALTER TABLE `r_first_job_discover`
  ADD PRIMARY KEY (`fjd_id`);

--
-- Indexes for table `r_first_job_timeframe`
--
ALTER TABLE `r_first_job_timeframe`
  ADD PRIMARY KEY (`fjtf_id`);

--
-- Indexes for table `r_honors_received`
--
ALTER TABLE `r_honors_received`
  ADD PRIMARY KEY (`honor_id`);

--
-- Indexes for table `r_impact_of_education`
--
ALTER TABLE `r_impact_of_education`
  ADD PRIMARY KEY (`ioe_id`);

--
-- Indexes for table `r_industry`
--
ALTER TABLE `r_industry`
  ADD PRIMARY KEY (`industry_id`);

--
-- Indexes for table `r_job_level_classification`
--
ALTER TABLE `r_job_level_classification`
  ADD PRIMARY KEY (`jlc_id`);

--
-- Indexes for table `r_post_types`
--
ALTER TABLE `r_post_types`
  ADD PRIMARY KEY (`pt_id`);

--
-- Indexes for table `r_professional_exams`
--
ALTER TABLE `r_professional_exams`
  ADD PRIMARY KEY (`profex_id`);

--
-- Indexes for table `r_self_employed_salary`
--
ALTER TABLE `r_self_employed_salary`
  ADD PRIMARY KEY (`se_salary_id`);

--
-- Indexes for table `r_unemployment_reason`
--
ALTER TABLE `r_unemployment_reason`
  ADD PRIMARY KEY (`ur_id`);

--
-- Indexes for table `t_accounts`
--
ALTER TABLE `t_accounts`
  ADD PRIMARY KEY (`acc_id`),
  ADD UNIQUE KEY `t_accounts_acc_username_unique` (`acc_username`) USING HASH,
  ADD UNIQUE KEY `t_accounts_acc_email_unique` (`acc_email`) USING HASH,
  ADD KEY `t_accounts_acc_type_foreign` (`acc_type`);

--
-- Indexes for table `t_alumni`
--
ALTER TABLE `t_alumni`
  ADD PRIMARY KEY (`al_id`),
  ADD KEY `t_alumni_al_acc_id_foreign` (`al_acc_id`),
  ADD KEY `t_alumni_al_course_id_foreign` (`al_course_id`),
  ADD KEY `t_alumni_al_honors_received_foreign` (`al_honors_received`),
  ADD KEY `t_alumni_al_educ_attainment_foreign` (`al_educ_attainment`),
  ADD KEY `t_alumni_al_prof_exam_passed_foreign` (`al_prof_exam_passed`),
  ADD KEY `t_alumni_al_first_job_discover_foreign` (`al_first_job_discover`),
  ADD KEY `t_alumni_al_first_job_timeframe_foreign` (`al_first_job_timeframe`),
  ADD KEY `t_alumni_al_self_employ_salary_foreign` (`al_self_employ_salary`);

--
-- Indexes for table `t_alumni_competencies`
--
ALTER TABLE `t_alumni_competencies`
  ADD PRIMARY KEY (`alcom_id`),
  ADD KEY `t_alumni_competencies_alcom_alumni_id_foreign` (`alcom_alumni_id`),
  ADD KEY `t_alumni_competencies_alcom_competency_foreign` (`alcom_competency`);

--
-- Indexes for table `t_alumni_impact_education`
--
ALTER TABLE `t_alumni_impact_education`
  ADD PRIMARY KEY (`aled_id`),
  ADD KEY `t_alumni_impact_education_aled_alumni_id_foreign` (`aled_alumni_id`),
  ADD KEY `t_alumni_impact_education_aled_impact_education_foreign` (`aled_impact_education`);

--
-- Indexes for table `t_alumni_job_level_exp`
--
ALTER TABLE `t_alumni_job_level_exp`
  ADD PRIMARY KEY (`ajle_id`),
  ADD KEY `t_alumni_job_level_exp_ajle_alumni_id_foreign` (`ajle_alumni_id`),
  ADD KEY `t_alumni_job_level_exp_ajle_job_level_id_foreign` (`ajle_job_level_id`);

--
-- Indexes for table `t_alumni_shared_contact`
--
ALTER TABLE `t_alumni_shared_contact`
  ADD PRIMARY KEY (`asc_id`),
  ADD KEY `t_alumni_shared_contact_asc_shared_by_foreign` (`asc_shared_by`);

--
-- Indexes for table `t_alumni_unemployed_reason`
--
ALTER TABLE `t_alumni_unemployed_reason`
  ADD PRIMARY KEY (`aur_id`),
  ADD KEY `t_alumni_unemployed_reason_aur_alumni_id_foreign` (`aur_alumni_id`),
  ADD KEY `t_alumni_unemployed_reason_aur_unemploy_reason_foreign` (`aur_unemploy_reason`);

--
-- Indexes for table `t_alumni_work_experience`
--
ALTER TABLE `t_alumni_work_experience`
  ADD PRIMARY KEY (`awe_id`),
  ADD KEY `t_alumni_work_experience_awe_alumni_id_foreign` (`awe_alumni_id`),
  ADD KEY `t_alumni_work_experience_awe_industry_nature_foreign` (`awe_industry_nature`);

--
-- Indexes for table `t_comments`
--
ALTER TABLE `t_comments`
  ADD PRIMARY KEY (`cm_id`),
  ADD KEY `t_comments_cm_post_id_foreign` (`cm_post_id`),
  ADD KEY `t_comments_cm_acc_id_foreign` (`cm_acc_id`);

--
-- Indexes for table `t_inboxes`
--
ALTER TABLE `t_inboxes`
  ADD PRIMARY KEY (`in_id`),
  ADD KEY `t_inboxes_in_acc_id_from_foreign` (`in_acc_id_from`),
  ADD KEY `t_inboxes_in_acc_id_to_foreign` (`in_acc_id_to`);

--
-- Indexes for table `t_likes`
--
ALTER TABLE `t_likes`
  ADD PRIMARY KEY (`lk_id`),
  ADD KEY `t_likes_lk_post_id_foreign` (`lk_post_id`),
  ADD KEY `t_likes_lk_acc_id_foreign` (`lk_acc_id`);

--
-- Indexes for table `t_posts`
--
ALTER TABLE `t_posts`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `t_posts_p_acc_id_foreign` (`p_acc_id`),
  ADD KEY `t_posts_p_type_id_foreign` (`p_type_id`),
  ADD KEY `t_posts_p_course_id_foreign` (`p_course_id`);

--
-- Indexes for table `t_visit_logs`
--
ALTER TABLE `t_visit_logs`
  ADD PRIMARY KEY (`vs_id`),
  ADD KEY `t_visit_logs_vs_acc_id_foreign` (`vs_acc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `r_account_types`
--
ALTER TABLE `r_account_types`
  MODIFY `at_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_competencies`
--
ALTER TABLE `r_competencies`
  MODIFY `competency_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_courses`
--
ALTER TABLE `r_courses`
  MODIFY `course_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_educational_attainment`
--
ALTER TABLE `r_educational_attainment`
  MODIFY `educ_attain_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_first_job_discover`
--
ALTER TABLE `r_first_job_discover`
  MODIFY `fjd_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_first_job_timeframe`
--
ALTER TABLE `r_first_job_timeframe`
  MODIFY `fjtf_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_honors_received`
--
ALTER TABLE `r_honors_received`
  MODIFY `honor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_impact_of_education`
--
ALTER TABLE `r_impact_of_education`
  MODIFY `ioe_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_industry`
--
ALTER TABLE `r_industry`
  MODIFY `industry_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_job_level_classification`
--
ALTER TABLE `r_job_level_classification`
  MODIFY `jlc_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_post_types`
--
ALTER TABLE `r_post_types`
  MODIFY `pt_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_professional_exams`
--
ALTER TABLE `r_professional_exams`
  MODIFY `profex_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_self_employed_salary`
--
ALTER TABLE `r_self_employed_salary`
  MODIFY `se_salary_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_unemployment_reason`
--
ALTER TABLE `r_unemployment_reason`
  MODIFY `ur_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_accounts`
--
ALTER TABLE `t_accounts`
  MODIFY `acc_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_alumni`
--
ALTER TABLE `t_alumni`
  MODIFY `al_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_alumni_competencies`
--
ALTER TABLE `t_alumni_competencies`
  MODIFY `alcom_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_alumni_impact_education`
--
ALTER TABLE `t_alumni_impact_education`
  MODIFY `aled_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_alumni_job_level_exp`
--
ALTER TABLE `t_alumni_job_level_exp`
  MODIFY `ajle_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_alumni_shared_contact`
--
ALTER TABLE `t_alumni_shared_contact`
  MODIFY `asc_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_alumni_unemployed_reason`
--
ALTER TABLE `t_alumni_unemployed_reason`
  MODIFY `aur_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_alumni_work_experience`
--
ALTER TABLE `t_alumni_work_experience`
  MODIFY `awe_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_comments`
--
ALTER TABLE `t_comments`
  MODIFY `cm_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_inboxes`
--
ALTER TABLE `t_inboxes`
  MODIFY `in_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_likes`
--
ALTER TABLE `t_likes`
  MODIFY `lk_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_posts`
--
ALTER TABLE `t_posts`
  MODIFY `p_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_visit_logs`
--
ALTER TABLE `t_visit_logs`
  MODIFY `vs_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_accounts`
--
ALTER TABLE `t_accounts`
  ADD CONSTRAINT `t_accounts_acc_type_foreign` FOREIGN KEY (`acc_type`) REFERENCES `r_account_types` (`at_id`);

--
-- Constraints for table `t_alumni`
--
ALTER TABLE `t_alumni`
  ADD CONSTRAINT `t_alumni_al_acc_id_foreign` FOREIGN KEY (`al_acc_id`) REFERENCES `t_accounts` (`acc_id`),
  ADD CONSTRAINT `t_alumni_al_course_id_foreign` FOREIGN KEY (`al_course_id`) REFERENCES `r_courses` (`course_id`),
  ADD CONSTRAINT `t_alumni_al_educ_attainment_foreign` FOREIGN KEY (`al_educ_attainment`) REFERENCES `r_educational_attainment` (`educ_attain_id`),
  ADD CONSTRAINT `t_alumni_al_first_job_discover_foreign` FOREIGN KEY (`al_first_job_discover`) REFERENCES `r_first_job_discover` (`fjd_id`),
  ADD CONSTRAINT `t_alumni_al_first_job_timeframe_foreign` FOREIGN KEY (`al_first_job_timeframe`) REFERENCES `r_first_job_timeframe` (`fjtf_id`),
  ADD CONSTRAINT `t_alumni_al_honors_received_foreign` FOREIGN KEY (`al_honors_received`) REFERENCES `r_honors_received` (`honor_id`),
  ADD CONSTRAINT `t_alumni_al_prof_exam_passed_foreign` FOREIGN KEY (`al_prof_exam_passed`) REFERENCES `r_professional_exams` (`profex_id`),
  ADD CONSTRAINT `t_alumni_al_self_employ_salary_foreign` FOREIGN KEY (`al_self_employ_salary`) REFERENCES `r_self_employed_salary` (`se_salary_id`);

--
-- Constraints for table `t_alumni_competencies`
--
ALTER TABLE `t_alumni_competencies`
  ADD CONSTRAINT `t_alumni_competencies_alcom_alumni_id_foreign` FOREIGN KEY (`alcom_alumni_id`) REFERENCES `t_alumni` (`al_id`),
  ADD CONSTRAINT `t_alumni_competencies_alcom_competency_foreign` FOREIGN KEY (`alcom_competency`) REFERENCES `r_competencies` (`competency_id`);

--
-- Constraints for table `t_alumni_impact_education`
--
ALTER TABLE `t_alumni_impact_education`
  ADD CONSTRAINT `t_alumni_impact_education_aled_alumni_id_foreign` FOREIGN KEY (`aled_alumni_id`) REFERENCES `t_alumni` (`al_id`),
  ADD CONSTRAINT `t_alumni_impact_education_aled_impact_education_foreign` FOREIGN KEY (`aled_impact_education`) REFERENCES `r_impact_of_education` (`ioe_id`);

--
-- Constraints for table `t_alumni_job_level_exp`
--
ALTER TABLE `t_alumni_job_level_exp`
  ADD CONSTRAINT `t_alumni_job_level_exp_ajle_alumni_id_foreign` FOREIGN KEY (`ajle_alumni_id`) REFERENCES `t_alumni` (`al_id`),
  ADD CONSTRAINT `t_alumni_job_level_exp_ajle_job_level_id_foreign` FOREIGN KEY (`ajle_job_level_id`) REFERENCES `r_job_level_classification` (`jlc_id`);

--
-- Constraints for table `t_alumni_shared_contact`
--
ALTER TABLE `t_alumni_shared_contact`
  ADD CONSTRAINT `t_alumni_shared_contact_asc_shared_by_foreign` FOREIGN KEY (`asc_shared_by`) REFERENCES `t_alumni` (`al_id`);

--
-- Constraints for table `t_alumni_unemployed_reason`
--
ALTER TABLE `t_alumni_unemployed_reason`
  ADD CONSTRAINT `t_alumni_unemployed_reason_aur_alumni_id_foreign` FOREIGN KEY (`aur_alumni_id`) REFERENCES `t_alumni` (`al_id`),
  ADD CONSTRAINT `t_alumni_unemployed_reason_aur_unemploy_reason_foreign` FOREIGN KEY (`aur_unemploy_reason`) REFERENCES `r_unemployment_reason` (`ur_id`);

--
-- Constraints for table `t_alumni_work_experience`
--
ALTER TABLE `t_alumni_work_experience`
  ADD CONSTRAINT `t_alumni_work_experience_awe_alumni_id_foreign` FOREIGN KEY (`awe_alumni_id`) REFERENCES `t_alumni` (`al_id`),
  ADD CONSTRAINT `t_alumni_work_experience_awe_industry_nature_foreign` FOREIGN KEY (`awe_industry_nature`) REFERENCES `r_industry` (`industry_id`);

--
-- Constraints for table `t_comments`
--
ALTER TABLE `t_comments`
  ADD CONSTRAINT `t_comments_cm_acc_id_foreign` FOREIGN KEY (`cm_acc_id`) REFERENCES `t_accounts` (`acc_id`),
  ADD CONSTRAINT `t_comments_cm_post_id_foreign` FOREIGN KEY (`cm_post_id`) REFERENCES `t_posts` (`p_id`);

--
-- Constraints for table `t_inboxes`
--
ALTER TABLE `t_inboxes`
  ADD CONSTRAINT `t_inboxes_in_acc_id_from_foreign` FOREIGN KEY (`in_acc_id_from`) REFERENCES `t_accounts` (`acc_id`),
  ADD CONSTRAINT `t_inboxes_in_acc_id_to_foreign` FOREIGN KEY (`in_acc_id_to`) REFERENCES `t_accounts` (`acc_id`);

--
-- Constraints for table `t_likes`
--
ALTER TABLE `t_likes`
  ADD CONSTRAINT `t_likes_lk_acc_id_foreign` FOREIGN KEY (`lk_acc_id`) REFERENCES `t_accounts` (`acc_id`),
  ADD CONSTRAINT `t_likes_lk_post_id_foreign` FOREIGN KEY (`lk_post_id`) REFERENCES `t_posts` (`p_id`);

--
-- Constraints for table `t_posts`
--
ALTER TABLE `t_posts`
  ADD CONSTRAINT `t_posts_p_acc_id_foreign` FOREIGN KEY (`p_acc_id`) REFERENCES `t_accounts` (`acc_id`),
  ADD CONSTRAINT `t_posts_p_course_id_foreign` FOREIGN KEY (`p_course_id`) REFERENCES `r_courses` (`course_id`),
  ADD CONSTRAINT `t_posts_p_type_id_foreign` FOREIGN KEY (`p_type_id`) REFERENCES `r_post_types` (`pt_id`);

--
-- Constraints for table `t_visit_logs`
--
ALTER TABLE `t_visit_logs`
  ADD CONSTRAINT `t_visit_logs_vs_acc_id_foreign` FOREIGN KEY (`vs_acc_id`) REFERENCES `t_accounts` (`acc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
