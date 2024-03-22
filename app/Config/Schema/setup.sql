CREATE TABLE states (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

INSERT INTO states (name) VALUES
('Andaman and Nicobar Islands'),
('Andhra Pradesh'),
('Arunachal Pradesh'),
('Assam'),
('Bihar'),
('Chandigarh'),
('Chhattisgarh'),
('Dadra and Nagar Haveli'),
('Daman and Diu'),
('Delhi'),
('Goa'),
('Gujarat'),
('Haryana'),
('Himachal Pradesh'),
('Jammu and Kashmir'),
('Jharkhand'),
('Karnataka'),
('Kerala'),
('Ladakh'),
('Lakshadweep'),
('Madhya Pradesh'),
('Maharashtra'),
('Manipur'),
('Meghalaya'),
('Mizoram'),
('Nagaland'),
('Odisha'),
('Puducherry'),
('Punjab'),
('Rajasthan'),
('Sikkim'),
('Tamil Nadu'),
('Telangana'),
('Tripura'),
('Uttar Pradesh'),
('Uttarakhand'),
('West Bengal');

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    contact_number VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    state_id INT NOT NULL,
    is_admin BOOLEAN DEFAULT 0,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted BOOLEAN DEFAULT 0,
    UNIQUE(email),
    CONSTRAINT fk_state_id FOREIGN KEY (state_id) REFERENCES states(id)
);
#Dummy record for admin access
INSERT into users set first_name = "test", last_name = "demo", contact_number = "1234567890", email = "test@test.com", password = "7c4a8d09ca3762af61e59520943dc26494f8941b", address = "test", state_id = 1, is_admin = 1;
