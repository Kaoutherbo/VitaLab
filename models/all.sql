
use laboratory;
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donor_id INT UNSIGNED NOT NULL,
    donation_id INT NOT NULL,
    profilePicture VARCHAR(300),
    name VARCHAR(100) NOT NULL,
    comment TEXT,
    rating INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (donor_id) REFERENCES donors(id) ON DELETE CASCADE,
    FOREIGN KEY (donation_id) REFERENCES donations(id) ON DELETE CASCADE
);

CREATE TABLE donation_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donor_id INT(6) UNSIGNED NOT NULL ,
    donation_id INT NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (donor_id) REFERENCES donors(id) ON DELETE CASCADE,
    FOREIGN KEY (donation_id) REFERENCES donations(id) ON DELETE CASCADE
);
CREATE TABLE donations (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    donation_date DATE NOT NULL,
    donation_place VARCHAR(255) NOT NULL,
    blood_group VARCHAR(5),
    title VARCHAR(255) NOT NULL,
    description VARCHAR(2000) NOT NULL,
    donation_image VARCHAR(2000) NOT NULL,
    created_by INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES labEmployee(id) ON DELETE CASCADE
);
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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE labEmployee (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    password  VARCHAR(2000) NOT NULL,
    address VARCHAR(255),
    blood_group VARCHAR(3) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    profilePicture VARCHAR(300),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

