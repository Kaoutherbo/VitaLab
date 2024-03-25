-- Controller is responsible to handle user interactions/inputs such as keyboard or mouse events for a single View. Model is the data layer, responsible for managing the business logic and data sources such as databases or network APIs

USE laboratory;

CREATE TABLE donation_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donor_id INT NOT NULL,
    donation_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (donor_id) REFERENCES donors(id)
);