-- $connection = mysqli_connect(
--     'localhost',    // host
--     'usernam',        // username
--     'password',    // password
--     'pizza_forum'  // database
-- );

 // Check connection
 if (!$connection) {
     die("Connection failed: " . mysqli_connect_error());
}

// Close connection
 mysqli_close($connection);

CREATE DATABASE pizza_forum;
USE pizza_forum;

-- CREATE USER 'username'@'localhost' IDENTIFIED BY password';
-- GRANT ALL PRIVILEGES ON pizza_forum.* TO 'demo'@'localhost';
-- FLUSH PRIVILEGES;

CREATE TABLE pizzas (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    ingredients TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE contacts (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
