<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class IntegrationTest extends TestCase
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
    }
    
    protected function tearDown(): void
    {
        // Clean up test data
        mysqli_query($this->connection, "DELETE FROM pizzas WHERE email = 'integration@example.com'");
        
        // Close the connection
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }
    
    public function testFullPizzaWorkflow(): void
    {
        // 1. Create a new pizza
        $title = "Integration Pizza";
        $email = "integration@example.com";
        $ingredients = "Test Ingredient A, Test Ingredient B";
        
        $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";
        $result = mysqli_query($this->connection, $sql);
        $this->assertTrue($result !== false, 'Failed to create pizza');
        
        // 2. Retrieve the pizza
        $sql = "SELECT * FROM pizzas WHERE email = 'integration@example.com'";
        $result = mysqli_query($this->connection, $sql);
        $pizza = mysqli_fetch_assoc($result);
        
        $this->assertEquals("Integration Pizza", $pizza['title']);
        $this->assertEquals("integration@example.com", $pizza['email']);
        
        // 3. Search for the pizza
        $search = "Integration";
        $sql = "SELECT * FROM pizzas WHERE title LIKE '%$search%'";
        $result = mysqli_query($this->connection, $sql);
        $this->assertGreaterThan(0, mysqli_num_rows($result), 'Search failed to find pizza');
        
        // 4. Delete the pizza
        $id = $pizza['id'];
        $sql = "DELETE FROM pizzas WHERE id = $id";
        $result = mysqli_query($this->connection, $sql);
        $this->assertTrue($result !== false, 'Failed to delete pizza');
        
        // 5. Verify deletion
        $sql = "SELECT * FROM pizzas WHERE id = $id";
        $result = mysqli_query($this->connection, $sql);
        $this->assertEquals(0, mysqli_num_rows($result), 'Pizza was not deleted');
    }
}