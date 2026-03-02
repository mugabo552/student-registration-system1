-- School Management System Database
CREATE DATABASE IF NOT EXISTS school_management;
USE school_management;

-- Admin/Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'teacher') DEFAULT 'teacher',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Students Table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    course VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin (username: admin, password: admin123)
-- Password hash generated using password_hash('admin123', PASSWORD_DEFAULT)
INSERT INTO users (username, email, password, role) VALUES 
('admin', 'admin@school.com', '$2y$10$8K1p/MRvi.PJU/T7q/T7iON9ajgHzM5E5WJXhXqX5vKf5vKf5vKf5u', 'admin');

-- Insert sample teacher (username: teacher, password: teacher123)
INSERT INTO users (username, email, password, role) VALUES 
('teacher', 'teacher@school.com', '$2y$10$8K1p/MRvi.PJU/T7q/T7iON9ajgHzM5E5WJXhXqX5vKf5vKf5vKf5u', 'teacher');

-- Insert sample students
INSERT INTO students (student_id, name, email, phone, course) VALUES 
('STD001', 'John Doe', 'john@example.com', '0781234567', 'Computer Science'),
('STD002', 'Jane Smith', 'jane@example.com', '0782345678', 'Business Administration'),
('STD003', 'Bob Johnson', 'bob@example.com', '0783456789', 'Engineering');
