 <?php
-- // Database connection file - include this in any file that needs database access
-- // Usage: include('../config/conn_db.php'); from templates folder
-- // Usage: include('config/conn_db.php'); from root folder

-- $connection = mysqli_connect(
--     'localhost',    // host
--     'usernam',        // username
--     'password',    // password
--     'pizza_forum'  // database
-- );

-- // Check connection
-- if (!$connection) {
--     die("Connection failed: " . mysqli_connect_error());
}

-- // Close connection
-- mysqli_close($connection);

-- -- Create database
CREATE DATABASE pizza_forum;

-- Use database
USE pizza_forum;

-- Create user
CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';

-- Grant privileges
GRANT ALL PRIVILEGES ON pizza_forum.* TO 'username'@'localhost';

-- Flush privileges
FLUSH PRIVILEGES;

-- Create pizzas table
CREATE TABLE pizzas (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    ingredients TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

-- Create contacts table
CREATE TABLE contacts (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
?>