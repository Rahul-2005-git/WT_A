CREATE DATABASE IF NOT EXISTS waste_db;
USE waste_db;

CREATE TABLE IF NOT EXISTS waste_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    requester_name VARCHAR(100) NOT NULL,
    contact VARCHAR(15) NOT NULL,
    waste_type ENUM('plastic','paper','metal','glass','e-waste','mixed','other') NOT NULL,
    quantity ENUM('small','medium','large') DEFAULT 'medium',
    location TEXT NOT NULL,
    landmark VARCHAR(255),
    description TEXT,
    status ENUM('pending','assigned','collected','cancelled') DEFAULT 'pending',
    authority_id INT NULL,
    scheduled_date DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS authorities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    contact VARCHAR(15) NOT NULL,
    area VARCHAR(255) NOT NULL,
    available TINYINT DEFAULT 1
);

-- Sample authorities
INSERT IGNORE INTO authorities (name, contact, area) VALUES
('PMC Team A - Koregaon Park', '9876543210', 'Koregaon Park, Kalyani Nagar'),
('PMC Team B - Shivajinagar', '9876543211', 'Shivajinagar, Deccan'),
('PMC Team C - Hadapsar', '9876543212', 'Hadapsar, Magarpatta'),
('PMC Team D - Kothrud', '9876543213', 'Kothrud, Karve Nagar');
