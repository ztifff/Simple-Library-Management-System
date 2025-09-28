CREATE DATABASE IF NOT EXISTS library_db;
USE library_db;

-- Books Table
CREATE TABLE IF NOT EXISTS books (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    title           VARCHAR(255) NOT NULL,
    author          VARCHAR(255) NOT NULL,
    publisher       VARCHAR(255),
    isbn            VARCHAR(20),
    year_published  INT,
    available       BOOLEAN DEFAULT TRUE
);

-- Borrows Table
CREATE TABLE IF NOT EXISTS borrows (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    book_id      INT NOT NULL,
    borrower     VARCHAR(100),
    borrow_date  DATE,
    return_date  DATE,
    returned     BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

