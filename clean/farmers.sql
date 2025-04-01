CREATE TABLE farmers (
   farmer_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE produce_deliveries (
    delivery_id INT AUTO_INCREMENT PRIMARY KEY,
    farmer_id INT NOT NULL,
    tonnage DECIMAL(10,2) NOT NULL,
    delivery_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (farmer_id) REFERENCES farmers(farmer_id) ON DELETE CASCADE
);
CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    farmer_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payment_status ENUM('Pending', 'Completed') DEFAULT 'Pending',
    FOREIGN KEY (farmer_id) REFERENCES farmers(farmer_id) ON DELETE CASCADE
);
CREATE TABLE input_distribution (
    input_id INT AUTO_INCREMENT PRIMARY KEY,
    farmer_id INT NOT NULL,
    input_type ENUM('Fertilizer', 'Pesticide') NOT NULL,
    quantity INT NOT NULL,
    issue_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (farmer_id) REFERENCES farmers(farmer_id) ON DELETE CASCADE
);
CREATE TABLE reports (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    farmer_id INT NOT NULL,
    report_type ENUM('Payment', 'Delivery', 'Input') NOT NULL,
    report_details TEXT NOT NULL,
    generated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (farmer_id) REFERENCES farmers(farmer_id) ON DELETE CASCADE
); 
