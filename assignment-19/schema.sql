CREATE DATABASE IF NOT EXISTS airline_db;
USE airline_db;

CREATE TABLE IF NOT EXISTS flights (
    id INT AUTO_INCREMENT PRIMARY KEY,
    flight_no VARCHAR(10) UNIQUE NOT NULL,
    origin VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    departure DATETIME NOT NULL,
    arrival DATETIME NOT NULL,
    aircraft VARCHAR(50) DEFAULT 'Boeing 737',
    total_seats INT DEFAULT 60,
    price_economy DECIMAL(8,2) DEFAULT 3500.00,
    price_business DECIMAL(8,2) DEFAULT 12000.00,
    status ENUM('scheduled','boarding','departed','cancelled') DEFAULT 'scheduled'
);

CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    flight_id INT NOT NULL,
    passenger_name VARCHAR(100) NOT NULL,
    passenger_email VARCHAR(100) NOT NULL,
    passenger_mobile VARCHAR(15) NOT NULL,
    seat_number VARCHAR(5) NOT NULL,
    seat_class ENUM('economy','business') DEFAULT 'economy',
    booking_ref VARCHAR(15) UNIQUE NOT NULL,
    amount DECIMAL(8,2) NOT NULL,
    booked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (flight_id) REFERENCES flights(id),
    UNIQUE KEY unique_seat (flight_id, seat_number)
);

INSERT IGNORE INTO flights (flight_no, origin, destination, departure, arrival, price_economy, price_business) VALUES
('AI-501', 'Mumbai (BOM)', 'Delhi (DEL)', DATE_ADD(NOW(), INTERVAL 2 HOUR), DATE_ADD(NOW(), INTERVAL 4 HOUR), 3500.00, 12000.00),
('AI-502', 'Pune (PNQ)', 'Bangalore (BLR)', DATE_ADD(NOW(), INTERVAL 5 HOUR), DATE_ADD(NOW(), INTERVAL 7 HOUR), 2800.00, 9500.00),
('6E-303', 'Delhi (DEL)', 'Goa (GOI)', DATE_ADD(NOW(), INTERVAL 8 HOUR), DATE_ADD(NOW(), INTERVAL 10 HOUR), 4200.00, 14000.00);
