USE laboratory;

-- Create comments table
CREATE TABLE comments (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    donor_id INT UNSIGNED NOT NULL,
    donation_id INT UNSIGNED,
    comment TEXT,
    rating TINYINT UNSIGNED CHECK (rating >= 0 AND rating <= 5),
    is_general TINYINT(1) DEFAULT 0 NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (donor_id) REFERENCES donors(id) ON DELETE CASCADE,
    FOREIGN KEY (donation_id) REFERENCES donations(id) ON DELETE CASCADE
);