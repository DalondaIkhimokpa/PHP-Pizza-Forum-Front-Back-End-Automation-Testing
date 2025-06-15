-- $connection = mysqli_connect(
--    'localhost',    // host
--     'demo',        // username
--      'test123',    // password
--     'pizza_forum'  // database
--  );
$connection = mysqli_connect(
    'localhost',          // host
    'root',              // username ← change if needed
    'workbench123',     // password ← your actual password
    'pizza_forum'       // database
);
 // Check connection
 if (!$connection) {
     die("Connection failed: " . mysqli_connect_error());
}

// Close connection
 mysqli_close($connection);

CREATE DATABASE pizza_forum;
USE pizza_forum;

-- CREATE USER 'demo'@'localhost' IDENTIFIED BY 'test1234';
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
