<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;

final class PizzaTest extends TestCase
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
            return;
        }
        
        // Insert test data
        $title = "Test Pizza";
        $email = "test@example.com";
        $ingredients = "Test Ingredient 1, Test Ingredient 2";
        
        $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";
        $result = mysqli_query($this->connection, $sql);
        
        if (!$result) {
            $this->markTestSkipped('Failed to insert test data: ' . mysqli_error($this->connection));
        }
    }
    
    protected function tearDown(): void
    {
        // Clean up test data
        if ($this->connection) {
            mysqli_query($this->connection, "DELETE FROM pizzas WHERE email = 'test@example.com'");
            
            // Close the connection
            mysqli_close($this->connection);
            $this->connection = null;
        }
    }
    
    public function testPizzaCreation(): void
    {
        $result = mysqli_query($this->connection, "SELECT * FROM pizzas WHERE email = 'test@example.com'");
        $this->assertNotFalse($result, 'Query failed: ' . mysqli_error($this->connection));
        
        $pizza = mysqli_fetch_assoc($result);
        $this->assertNotNull($pizza, 'No pizza found with test email');
        
        $this->assertEquals("Test Pizza", $pizza['title']);
        $this->assertEquals("test@example.com", $pizza['email']);
        $this->assertEquals("Test Ingredient 1, Test Ingredient 2", $pizza['ingredients']);
    }
    
    public function testPizzaSearch(): void
    {
        $search = "Test";
        $sql = "SELECT * FROM pizzas WHERE title LIKE '%$search%' OR ingredients LIKE '%$search%'";
        $result = mysqli_query($this->connection, $sql);
        
        $this->assertNotFalse($result, 'Query failed: ' . mysqli_error($this->connection));
        $this->assertGreaterThan(0, mysqli_num_rows($result), 'Search functionality failed');
    }
    
    public function testPizzaDeletion(): void
    {
        // Get the ID of the test pizza
        $result = mysqli_query($this->connection, "SELECT id FROM pizzas WHERE email = 'test@example.com'");
        $this->assertNotFalse($result, 'Query failed: ' . mysqli_error($this->connection));
        
        $pizza = mysqli_fetch_assoc($result);
        $this->assertNotNull($pizza, 'No pizza found with test email');
        
        $id = $pizza['id'];
        
        // Delete the pizza
        $deleteResult = mysqli_query($this->connection, "DELETE FROM pizzas WHERE id = $id");
        $this->assertNotFalse($deleteResult, 'Delete query failed: ' . mysqli_error($this->connection));
        
        // Check if it's deleted
        $checkResult = mysqli_query($this->connection, "SELECT * FROM pizzas WHERE id = $id");
        $this->assertNotFalse($checkResult, 'Query failed: ' . mysqli_error($this->connection));
        $this->assertEquals(0, mysqli_num_rows($checkResult), 'Pizza deletion failed');
    }
}
