USE laboratory;

CREATE TABLE donation_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donor_id INT(6) UNSIGNED NOT NULL ,
    donation_id INT NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    blood_volume INT(6),
    FOREIGN KEY (donor_id) REFERENCES donors(id) ON DELETE CASCADE,
    FOREIGN KEY (donation_id) REFERENCES donations(id) ON DELETE CASCADE
);