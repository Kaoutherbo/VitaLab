USE laboratory;

-- Create donation_records table
CREATE TABLE donation_records (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    donor_id INT UNSIGNED NOT NULL,
    donation_id INT UNSIGNED NOT NULL,
    blood_group VARCHAR(3) NOT NULL CHECK (blood_group REGEXP '^(A|B|AB|O)[+-]$'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    blood_volume INT(6),
    FOREIGN KEY (donor_id) REFERENCES donors(id) ON DELETE CASCADE,
    FOREIGN KEY (donation_id) REFERENCES donations(id) ON DELETE CASCADE
);
