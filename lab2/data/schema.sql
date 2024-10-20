CREATE TABLE hotels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    address VARCHAR(255),
    phone VARCHAR(20),
    email VARCHAR(255)
);

-- Create rooms table  
CREATE TABLE rooms ( 
    id INT PRIMARY KEY, 
    hotel_id INT, 
    room_number VARCHAR(20) NOT NULL, 
    room_type VARCHAR(50), 
    price DECIMAL(10, 2), 
    status VARCHAR(20), 
    CONSTRAINT fk_hotel_id FOREIGN KEY (hotel_id) REFERENCES hotels(id) 
); 
 -- Create guests table 
CREATE TABLE guests ( 
    id INT PRIMARY KEY, 
    first_name VARCHAR(100) NOT NULL, 
    last_name VARCHAR(100) NOT NULL, 
    email VARCHAR(255) UNIQUE, 
    phone VARCHAR(20), 
    address VARCHAR(255) 
); 
 -- Create bookings table 
CREATE TABLE bookings ( 
    id INT PRIMARY KEY, 
    guest_id INT, 
    room_id INT, 
    check_in_date DATE, 
    check_out_date DATE, 
    booking_date DATE, 
    total_amount DECIMAL(10, 2), 
    CONSTRAINT fk_guest_id FOREIGN KEY (guest_id) REFERENCES guests(id), 
    CONSTRAINT fk_room_id FOREIGN KEY (room_id) REFERENCES rooms(id) 
); 	
CREATE TABLE employee ( 
    id INT PRIMARY KEY, 
    hotel_id INT, 
    first_name VARCHAR(100) NOT NULL, 
    last_name VARCHAR(100) NOT NULL, 
    position VARCHAR(50), 
    phone VARCHAR(20), 
    email VARCHAR(255), 
    CONSTRAINT fk_employee_hotel FOREIGN KEY (hotel_id) REFERENCES hotels(id) 
);
 
 -- Create payments table 
CREATE TABLE payments ( 
    id INT PRIMARY KEY, 
    booking_id INT, 
    payment_date DATE, 
    amount DECIMAL(10, 2), 
    payment_method VARCHAR(50), 
    CONSTRAINT fk_booking_id FOREIGN KEY (booking_id) REFERENCES bookings(id) 
);
