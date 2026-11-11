CREATE DATABASE IF NOT EXISTS student_portal;
USE student_portal;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    matricule VARCHAR(30) NOT NULL UNIQUE,
    department VARCHAR(80) NOT NULL,
    level VARCHAR(30) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Demo account: demo@studentportal.test / demo1234
INSERT INTO students (full_name, email, matricule, department, level, password_hash)
VALUES (
    'Demo Student',
    'demo@studentportal.test',
    'STU-2026-100',
    'Computer Science',
    'Level 100',
    '$2y$10$6BIOjpvoT1GedNMlAie19Opi01kJW6csL/clvvXMJ.3qTt7uECWAi'
) ON DUPLICATE KEY UPDATE email = email;
