-- CREATE DATABASE blood_bank;

USE laboratory;

CREATE TABLE donors (
    id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    password  VARCHAR(2000) NOT NULL,
    address VARCHAR(255),
    blood_group VARCHAR(3) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    profilePicture VARCHAR(300),
    last_donation_date DATE,
    role VARCHAR(20) NOT NULL DEFAULT 'donor';
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);