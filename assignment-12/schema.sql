CREATE DATABASE IF NOT EXISTS attendance_db;
USE attendance_db;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    roll_no VARCHAR(20) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    class VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    teacher_id INT NOT NULL,
    date DATE NOT NULL,
    subject VARCHAR(100) NOT NULL,
    status ENUM('present','absent','late') DEFAULT 'absent',
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (teacher_id) REFERENCES teachers(id),
    UNIQUE KEY unique_attendance (student_id, date, subject)
);

-- Demo teacher (password: teacher123)
INSERT IGNORE INTO teachers (name, email, password, subject) VALUES
('Mr. Sharma', 'sharma@college.com', '$2y$10$TpxoVQiGSUFH/8b4Js5MluJyVb7.PXRIwqQ.oVIqHbKB3xmD22l7a', 'Mathematics');

-- Demo students (password: student123)
INSERT IGNORE INTO students (roll_no, name, email, password, class) VALUES
('CS001', 'Rahul Patil', 'rahul@student.com', '$2y$10$TpxoVQiGSUFH/8b4Js5MluJyVb7.PXRIwqQ.oVIqHbKB3xmD22l7a', 'CS-3A'),
('CS002', 'Priya Desai', 'priya@student.com', '$2y$10$TpxoVQiGSUFH/8b4Js5MluJyVb7.PXRIwqQ.oVIqHbKB3xmD22l7a', 'CS-3A'),
('CS003', 'Amit Shah', 'amit@student.com', '$2y$10$TpxoVQiGSUFH/8b4Js5MluJyVb7.PXRIwqQ.oVIqHbKB3xmD22l7a', 'CS-3A');
