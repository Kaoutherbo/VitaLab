USE laboratory;

-- Create donations table
CREATE TABLE donations (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    donation_date DATE NOT NULL,
    donation_place VARCHAR(255) NOT NULL,
    blood_group VARCHAR(3) CHECK (blood_group REGEXP '^(A|B|AB|O)[+-]$'), 
    title VARCHAR(255) NOT NULL,
    description TEXT,
    donation_image VARCHAR(2000),
    created_by INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES labEmployee(id) ON DELETE CASCADE
);
