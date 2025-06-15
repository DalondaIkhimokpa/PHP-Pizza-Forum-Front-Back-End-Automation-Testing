<?php
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use PHPUnit\Framework\TestCase;

/**
 * @group selenium
 */
class SeleniumPizzaTest extends TestCase
{
    protected static $webDriver;

    public static function setUpBeforeClass(): void
    {
        self::$webDriver = RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()
        );
    }

    public function testAddPizzaPageLoads(): void
    {
        self::$webDriver->get('http://localhost/php_pizza_forum/templates/add.php');

        $this->assertStringContainsString('Add a Pizza', self::$webDriver->getPageSource());
    }

    public static function tearDownAfterClass(): void
    {
        self::$webDriver->quit();
    }
}

