<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;

final class ValidationTest extends TestCase
{
    public function testEmailValidation(): void
    {
        // Valid email
        $email = "test@example.com";
        $this->assertTrue(filter_var($email, FILTER_VALIDATE_EMAIL) !== false, 'Valid email should pass validation');
        
        // Invalid email
        $email = "invalid-email";
        $this->assertFalse(filter_var($email, FILTER_VALIDATE_EMAIL) !== false, 'Invalid email should fail validation');
    }
    
    public function testTitleValidation(): void
    {
        // Valid title (letters and spaces only)
        $title = "Margherita Pizza";
        $this->assertEquals(1, preg_match('/^[a-zA-Z\s]+$/', $title), 'Valid title should pass validation');
        
        // Invalid title (contains numbers)
        $title = "Pizza 123";
        $this->assertNotEquals(1, preg_match('/^[a-zA-Z\s]+$/', $title), 'Title with numbers should fail validation');
    }
    
    public function testIngredientsValidation(): void
    {
        // Valid ingredients (comma-separated list)
        $ingredients = "Tomato, Mozzarella, Basil";
        $this->assertEquals(1, preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients), 'Valid ingredients should pass validation');
        
        // Invalid ingredients (contains special characters)
        $ingredients = "Tomato, Mozzarella, Basil!";
        $this->assertNotEquals(1, preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients), 'Ingredients with special characters should fail validation');
    }
}
