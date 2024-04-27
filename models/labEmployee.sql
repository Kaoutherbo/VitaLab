USE laboratory;

-- Create labEmployee table
CREATE TABLE labEmployee (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    password  VARCHAR(2000) NOT NULL,
    address VARCHAR(255),
	blood_group VARCHAR(3) NOT NULL CHECK (blood_group REGEXP '^(A|B|AB|O)[+-]$'),
    phone VARCHAR(15) NOT NULL CHECK (phone REGEXP '^[+]?[0-9]{10,15}$'), -- maximum length of 15 characters and must match the regular expression pattern ^[+]?[0-9]{10,15}$. This pattern allows for an optional leading + sign followed by 10 to 15 digits.
    profilePicture VARCHAR(300),
    role VARCHAR(20) NOT NULL DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
