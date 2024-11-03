CREATE TABLE books (
    book_id INT PRIMARY AUTO_INCREMENT,
    title VARCHAR(255),
    author VARCHAR(255),
    price DECIMAL(10, 2)
);

CREATE TABLE orders (
    order_id INT PRIMARY AUTO_INCREMENT,
    book_id INT,
    customer_name VARCHAR(255),
    customer_email VARCHAR(255),
    payment_method VARCHAR(255),
    date_bought TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (book_id) REFERENCES books(book_id)
);

-- added for midterm exam
CREATE TABLE users (
    users_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE books ADD COLUMN added_by INT,
    ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ADD COLUMN updated_by INT,
    ADD FOREIGN KEY (added_by) REFERENCES users(user_id),
    ADD FOREIGN KEY (updated_by) REFERENCES users(user_id);

ALTER TABLE orders ADD COLUMN added_by INT,
ADD FOREIGN KEY (added_by) REFERENCES users(user_id);