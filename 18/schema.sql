CREATE DATABASE IF NOT EXISTS cmplmgmt_db;
USE cmplmgmt_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS organizations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(20) UNIQUE NOT NULL,
    type VARCHAR(50) NOT NULL,
    description TEXT
);

CREATE TABLE IF NOT EXISTS complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    org_id INT NOT NULL,
    complaint_type VARCHAR(100) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    priority ENUM('low','medium','high','critical') DEFAULT 'medium',
    status ENUM('open','in_progress','resolved','closed','rejected') DEFAULT 'open',
    tracking_id VARCHAR(20) UNIQUE NOT NULL,
    admin_response TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (org_id) REFERENCES organizations(id)
);

INSERT IGNORE INTO organizations (name, code, type, description) VALUES
('Pune Municipal Corporation', 'PMC', 'Municipal', 'Roads, Water, Sanitation, Drainage, Building'),
('Pune Mahanagar Parivahan Mahamandal', 'PMT', 'Transport', 'Bus services, Routes, Driver behavior, Ticketing'),
('Maharashtra State Electricity', 'MSEB', 'Electricity', 'Power outages, Billing, New connections, Street lights'),
('Pune Police', 'PP', 'Law & Order', 'Traffic, Crime, Safety, Public nuisance'),
('University of Pune', 'UNIPUNE', 'Education', 'Exam, Results, Certificate, Administration');
