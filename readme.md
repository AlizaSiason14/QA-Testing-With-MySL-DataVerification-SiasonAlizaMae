CREATE DATABASE IF NOT EXISTS `qa_testing_db`;
USE `qa_testing_db`;

CREATE TABLE IF NOT EXISTS `test_records` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `tester_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `test_status` ENUM('Pending', 'Passed', 'Failed') DEFAULT 'Passed',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

