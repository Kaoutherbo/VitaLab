-- Controller is responsible to handle user interactions/inputs such as keyboard or mouse events for a single View. Model is the data layer, responsible for managing the business logic and data sources such as databases or network APIs
USE laboratory;

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