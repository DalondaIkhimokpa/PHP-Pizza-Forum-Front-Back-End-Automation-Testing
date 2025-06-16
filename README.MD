# PHP Pizza Forum

A community-driven platform for pizza enthusiasts to share and discover amazing pizza recipes.

![PHP Pizza Forum Screenshot](images/pizza-svgrepo-com.svg)

## 🏁 README Setup Instructions

![PHP](https://img.shields.io/badge/PHP-Ready-blue)
![Selenium](https://img.shields.io/badge/Selenium-Integrated-green)
![PHPUnit](https://img.shields.io/badge/PHPUnit-Tested-success)
[![Selenium Tests](https://github.com/DalondaIkhimokpa/PHP-Pizza-Forum-Front-Back-End-Automation-Testing/actions/workflows/smoke-test.yml/badge.svg)](https://github.com/DalondaIkhimokpa/PHP-Pizza-Forum-Front-Back-End-Automation-Testing/actions/workflows/smoke-test.yml)
[![CI Tests](https://github.com/DalondaIkhimokpa/PHP-Pizza-Forum-Front-Back-End-Automation-Testing/actions/workflows/php-ci.yml/badge.svg)](https://github.com/DalondaIkhimokpa/PHP-Pizza-Forum-Front-Back-End-Automation-Testing/actions/workflows/php-ci.yml)

## Features

- **Share Recipes**: Upload your favorite pizza recipes with ingredients and instructions
- **Discover New Flavors**: Browse through a collection of unique pizza combinations
- **Search Functionality**: Find specific recipes by name or ingredients
- **Responsive Design**: Works on desktop and mobile devices
- **User-Friendly Interface**: Clean and intuitive UI built with Materialize CSS

## Technologies Used

- **PHP**: Server-side scripting
- **MySQL**: Database management
- **Materialize CSS**: Front-end framework
- **HTML/CSS**: Structure and styling
- **JavaScript**: Enhanced user interactions
- **PHPUnit**: Testing framework


## 🧪 QA Highlights

- **Test Frameworks**: PHPUnit (backend), Selenium (frontend)
- **CI Pipeline**: GitHub Actions runs tests on push/pull requests.
- **Defect Logging**: Documented edge cases (e.g., invalid recipe inputs).

## 🚀 Running Tests

```bash
# Unit/Integration Tests:  
./vendor/bin/phpunit --testsuite=Integration  

# Selenium Tests (requires ChromeDriver):  
php tests/Selenium/PizzaSubmissionTest.php  
```


## Installation

1. Clone the repository:

   ```
   git clone https://github.com/DalondaIkhimokpa/PHP-Pizza-Forum-Front-Back-End-Automation-Testing
   ```
2. Import the database:

   ```
   mysql -u username -p < database_setup.sql
   ```
3. Configure the database connection:

   - Edit `config/conn_db.php` with your database credentials
4. Start your local server:

   ```
   php -S localhost:8000
   ```
5. Access the application:

   ```
   http://localhost:8000
   ```

## Project Structure

```
php-pizza-forum/
├── config/
│   └── conn_db.php
├── images/
├── templates/
│   ├── add.php
│   ├── details.php
│   ├── footer.php
│   └── header.php
├── tests/
│   ├── bootstrap.php
│   ├── DatabaseTest.php
│   ├── IntegrationTest.php
│   ├── PizzaTest.php
│   └── ValidationTest.php
├── about.php
├── index.php
├── phpunit.xml
├── search.php
├── database_setup.sql
├── LICENSE
└── README.md
```

## Usage

1. **View Recipes**: Browse all pizza recipes on the home page
2. **Add a Recipe**: Click "Add Pizza" to share your own recipe
3. **Search**: Use the search function to find specific recipes
4. **View Details**: Click on a pizza card to see full details
5. **Delete**: Remove your recipes when needed

## Testing

The project includes PHPUnit tests to ensure functionality works as expected.

### Installing PHPUnit

You need to install PHPUnit to run the tests. There are two recommended ways:

#### Option 1: Using PHAR (PHP Archive)

1. Download the PHPUnit PHAR file:

   ```
   wget -O phpunit.phar https://phar.phpunit.de/phpunit-11.3.phar
   ```
2. Make it executable:

   ```
   chmod +x phpunit.phar
   ```
3. Move it to a tools directory:

   ```
   mkdir -p tools
   mv phpunit.phar tools/phpunit
   ```

#### Option 2: Using Composer

1. If you have Composer installed, run:
   ```
   composer require --dev phpunit/phpunit ^11.3
   ```

### Running Tests

After installing PHPUnit, you can run the tests using:

#### If installed via PHAR:

```
./tools/phpunit --configuration phpunit.xml
```

#### If installed via Composer:

```
./vendor/bin/phpunit --configuration phpunit.xml
```

### Test Suite

The test suite includes:

- **DatabaseTest**: Tests database connection and table existence
- **PizzaTest**: Tests CRUD operations for pizzas
- **ValidationTest**: Tests input validation for forms
- **IntegrationTest**: Tests the full application workflow

## Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature-name`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin feature-name`
5. Submit a pull request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Pizza images from Unsplash
- Icons from Material Icons
- Styling framework from Materialize CSS
- Pizza SVG from SVG Repo

## Contact

For questions or feedback, please reach out to us at https://github.com/DalondaIkhimokpa/PHP-Pizza-Forum-Front-Back-End-Automation-Testing
