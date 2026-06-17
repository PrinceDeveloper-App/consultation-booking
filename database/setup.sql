-- ============================================================
-- IKIC Database Setup Script
-- Creates the database, tables, and inserts seed data
-- Usage: mysql -u root -p < database/setup.sql
-- ============================================================

CREATE DATABASE IF NOT EXISTS ikic_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE ikic_db;

-- ============================================================
-- TABLES
-- ============================================================

-- Admin users
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Applicant available time slots
CREATE TABLE IF NOT EXISTS `slots` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `date` DATE NOT NULL,
    `slot_times` TEXT,
    `slot_count` INT(11) DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY `idx_date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Applicant appointment data
CREATE TABLE IF NOT EXISTS `appointment_data` (
    `appointment_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `country_of_residence` VARCHAR(255) DEFAULT NULL,
    `program_of_interest` VARCHAR(255) DEFAULT NULL,
    `client_first_name` VARCHAR(100) NOT NULL,
    `client_last_name` VARCHAR(100) NOT NULL,
    `client_email` VARCHAR(255) NOT NULL,
    `client_phone` VARCHAR(20) DEFAULT NULL,
    `additional_notes` TEXT DEFAULT NULL,
    `appointment_status` VARCHAR(20) DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`appointment_id`),
    KEY `idx_status` (`appointment_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Applicant appointment bookings (time slots)
CREATE TABLE IF NOT EXISTS `appointment_slotes` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `appointment_id` INT(11) UNSIGNED NOT NULL,
    `appointment_date` VARCHAR(20) NOT NULL,
    `appointment_time` VARCHAR(20) NOT NULL,
    `active_status` VARCHAR(20) DEFAULT 'active',
    PRIMARY KEY (`id`),
    KEY `idx_appointment_id` (`appointment_id`),
    KEY `idx_date` (`appointment_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Stripe payment records
CREATE TABLE IF NOT EXISTS `stripe_payments` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `invoice_number` VARCHAR(20) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Employer available time slots
CREATE TABLE IF NOT EXISTS `emp_slots` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `date` DATE NOT NULL,
    `slot_times` TEXT,
    `slot_count` INT(11) DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY `idx_date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Employer appointment data
CREATE TABLE IF NOT EXISTS `emp_appointment_data` (
    `appointment_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `business_year` VARCHAR(50) DEFAULT NULL,
    `field_of_business` VARCHAR(255) DEFAULT NULL,
    `other_field` VARCHAR(255) DEFAULT NULL,
    `first_name` VARCHAR(100) NOT NULL,
    `client_last_name` VARCHAR(100) NOT NULL,
    `client_email` VARCHAR(255) NOT NULL,
    `client_phone` VARCHAR(20) DEFAULT NULL,
    `additional_notes` TEXT DEFAULT NULL,
    `prefered_meeting_method` VARCHAR(50) DEFAULT NULL,
    `appointment_status` VARCHAR(20) DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`appointment_id`),
    KEY `idx_status` (`appointment_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Employer appointment bookings (time slots)
CREATE TABLE IF NOT EXISTS `emp_appointment_slotes` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `appointment_id` INT(11) UNSIGNED NOT NULL,
    `appointment_date` VARCHAR(20) NOT NULL,
    `appointment_time` VARCHAR(20) NOT NULL,
    `active_status` VARCHAR(20) DEFAULT 'active',
    PRIMARY KEY (`id`),
    KEY `idx_appointment_id` (`appointment_id`),
    KEY `idx_date` (`appointment_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Available time options for scheduling
CREATE TABLE IF NOT EXISTS `a_times` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `time_value` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- CI migrations tracking table
CREATE TABLE IF NOT EXISTS `migrations` (
    `version` BIGINT(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ============================================================
-- SEED DATA
-- ============================================================

-- Admin user (password: Admin@123)
-- Bcrypt hash of 'Admin@123'
INSERT INTO `users` (`username`, `password`) VALUES
('admin@ikic.ca', '$2y$10$ZGa./DgKb4P/1ffJHExiz./T7uMBizvDdbor/MI7.myr/6dWXayCG');

-- Available time options
INSERT INTO `a_times` (`time_value`) VALUES
('9:00 AM'), ('9:30 AM'), ('10:00 AM'), ('10:30 AM'),
('11:00 AM'), ('11:30 AM'), ('12:00 PM'), ('12:30 PM'),
('1:00 PM'), ('1:30 PM'), ('2:00 PM'), ('2:30 PM'),
('3:00 PM'), ('3:30 PM'), ('4:00 PM'), ('4:30 PM'),
('5:00 PM');

-- Applicant slots for the next 5 working days
INSERT INTO `slots` (`date`, `slot_times`, `slot_count`) VALUES
(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '{ 9:00 AM, 10:00 AM, 11:00 AM, 1:00 PM, 2:00 PM, 3:00 PM }', 6),
(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '{ 9:30 AM, 10:30 AM, 11:30 AM, 1:30 PM, 2:30 PM, 4:00 PM }', 6),
(DATE_ADD(CURDATE(), INTERVAL 3 DAY), '{ 9:00 AM, 10:00 AM, 12:00 PM, 2:00 PM, 3:30 PM }', 5),
(DATE_ADD(CURDATE(), INTERVAL 4 DAY), '{ 10:00 AM, 11:00 AM, 1:00 PM, 3:00 PM, 4:30 PM }', 5),
(DATE_ADD(CURDATE(), INTERVAL 5 DAY), '{ 9:00 AM, 11:30 AM, 1:30 PM, 2:30 PM, 4:00 PM, 5:00 PM }', 6);

-- Employer slots for the next 5 working days
INSERT INTO `emp_slots` (`date`, `slot_times`, `slot_count`) VALUES
(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '{ 9:00 AM, 10:30 AM, 1:00 PM, 3:00 PM }', 4),
(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '{ 10:00 AM, 11:30 AM, 2:00 PM, 4:00 PM }', 4),
(DATE_ADD(CURDATE(), INTERVAL 3 DAY), '{ 9:30 AM, 11:00 AM, 1:30 PM, 3:30 PM }', 4),
(DATE_ADD(CURDATE(), INTERVAL 4 DAY), '{ 10:00 AM, 12:00 PM, 2:30 PM, 4:30 PM }', 4),
(DATE_ADD(CURDATE(), INTERVAL 5 DAY), '{ 9:00 AM, 10:30 AM, 2:00 PM, 3:30 PM, 5:00 PM }', 5);

-- Sample applicant appointments
INSERT INTO `appointment_data` (`country_of_residence`, `program_of_interest`, `client_first_name`, `client_last_name`, `client_email`, `client_phone`, `additional_notes`, `appointment_status`) VALUES
('India', 'Permanent Residency', 'Rahul', 'Sharma', 'rahul.sharma@example.com', '+91-9876543210', 'Interested in Express Entry program. Have 5 years IT experience.', 'active'),
('Philippines', 'Study in Canada', 'Maria', 'Santos', 'maria.santos@example.com', '+63-9171234567', 'Applying for MSc Computer Science at UBC.', 'active'),
('Nigeria', 'Temporary Foreign Worker', 'Emeka', 'Obi', 'emeka.obi@example.com', '+234-8012345678', 'Have LMIA-supported job offer from Alberta employer.', 'completed'),
('Brazil', 'Visitor Visa', 'Ana', 'Costa', 'ana.costa@example.com', '+55-11987654321', 'Planning to visit family in Toronto for 3 months.', 'active'),
('Pakistan', 'Family Sponsorship', 'Ahmed', 'Khan', 'ahmed.khan@example.com', '+92-3001234567', 'Spouse sponsorship application. Wife is Canadian PR.', 'cancelled');

INSERT INTO `appointment_slotes` (`appointment_id`, `appointment_date`, `appointment_time`, `active_status`) VALUES
(1, '20-06-2026', '10:00 AM', 'active'),
(2, '21-06-2026', '11:30 AM', 'active'),
(3, '18-06-2026', '2:00 PM', 'completed'),
(4, '22-06-2026', '9:00 AM', 'active'),
(5, '19-06-2026', '3:00 PM', 'cancelled');

-- Sample employer appointments
INSERT INTO `emp_appointment_data` (`business_year`, `field_of_business`, `other_field`, `first_name`, `client_last_name`, `client_email`, `client_phone`, `additional_notes`, `prefered_meeting_method`, `appointment_status`) VALUES
('2020', 'Agriculture', NULL, 'John', 'Williams', 'john.williams@farmco.ca', '+1-4035551234', 'Need 15 seasonal farm workers for summer 2026.', 'Video Call', 'active'),
('2015', 'Information Technology', NULL, 'Sarah', 'Chen', 'sarah.chen@techstart.ca', '+1-6045559876', 'Looking to hire 3 senior developers from overseas.', 'Phone Call', 'active'),
('2018', 'Restaurant/Food Service', NULL, 'Marco', 'Rossi', 'marco.rossi@italianplace.ca', '+1-7805554321', 'Need cooks and servers. LMIA process questions.', 'In Person', 'completed'),
('2022', 'Healthcare', NULL, 'Priya', 'Patel', 'priya.patel@cliniccare.ca', '+1-5875556789', 'Hiring registered nurses from Philippines.', 'Video Call', 'active');

INSERT INTO `emp_appointment_slotes` (`appointment_id`, `appointment_date`, `appointment_time`, `active_status`) VALUES
(1, '20-06-2026', '1:00 PM', 'active'),
(2, '21-06-2026', '10:30 AM', 'active'),
(3, '18-06-2026', '3:30 PM', 'completed'),
(4, '23-06-2026', '2:00 PM', 'active');

-- Sample invoice records
INSERT INTO `stripe_payments` (`invoice_number`) VALUES
('INV-00001'), ('INV-00002'), ('INV-00003');

SELECT 'Database setup complete!' AS status;
