CREATE DATABASE faculty_management;

USE faculty_management;

CREATE TABLE faculty (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100),
    email VARCHAR(100),
    department VARCHAR(100)
);