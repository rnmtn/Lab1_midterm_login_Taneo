CREATE TABLE lawyer_records (
    lawyer_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR (50),
    last_name VARCHAR (50),
    gender VARCHAR (50),
    specialty VARCHAR (50),
    phone VARCHAR (50),
    email VARCHAR (50),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);