USE laboratory;

-- Create labEmployee table
CREATE TABLE labEmployee (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    password  VARCHAR(2000) NOT NULL,
    address VARCHAR(255),
    blood_group VARCHAR(3) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    profilePicture VARCHAR(300),
    role VARCHAR(20) NOT NULL DEFAULT 'admin';
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
