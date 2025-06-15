<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;

final class DatabaseTest extends TestCase
{
    private $connection;
    
    protected function setUp(): void
    {
        // Create a test connection
        $this->connection = mysqli_connect(
    'localhost',          // host
    'root',              // username ← change if needed
    'workbench123',     // password ← your actual password
    'pizza_forum'       // database
);
        
        // Check if connection was successful
        if (!$this->connection) {
            $this->markTestSkipped('Database connection failed: ' . mysqli_connect_error());
        }
    }
    
    protected function tearDown(): void
    {
        // Close the connection after each test
        if ($this->connection) {
            mysqli_close($this->connection);
            $this->connection = null;
        }
    }
    
    public function testDatabaseConnection(): void
    {
        $this->assertNotFalse($this->connection, 'Database connection failed');
    }
    
    public function testPizzasTableExists(): void
    {
        $result = mysqli_query($this->connection, "SHOW TABLES LIKE 'pizzas'");
        $this->assertNotFalse($result, 'Query failed');
        $this->assertEquals(1, mysqli_num_rows($result), 'Pizzas table does not exist');
    }
    
    public function testContactsTableExists(): void
    {
        $result = mysqli_query($this->connection, "SHOW TABLES LIKE 'contacts'");
        $this->assertEquals(1, mysqli_num_rows($result), 'Contacts table does not exist');
    }
}
