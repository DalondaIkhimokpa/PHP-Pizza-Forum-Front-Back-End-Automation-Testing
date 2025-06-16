const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');
const fs = require('fs');

const BASE_URL = process.env.BASE_URL || 'http://localhost/php_pizza_forum';

// Utility to take a screenshot on failure
async function takeScreenshot(driver, name) {
  const screenshot = await driver.takeScreenshot();
  fs.writeFileSync(`${name}.png`, screenshot, 'base64');
  console.log(`📸 Screenshot saved: ${name}.png`);
}

describe('Pizza Forum Tests', function () {
  this.timeout(30000);
  let driver;

  before(async () => {
    console.log('🚀 Launching Chrome...');
    const options = new chrome.Options();
    options.addArguments('--headless', '--no-sandbox', '--disable-dev-shm-usage');
    driver = await new Builder().forBrowser('chrome').setChromeOptions(options).build();
  });

  after(async () => {
    console.log('🛑 Closing browser...');
    await driver.quit();
  });

  it('should add a new pizza and return to homepage with pizza listed', async function () {
    try {
      console.log(`🌐 Navigating to: ${BASE_URL}/templates/add.php`);
      await driver.get(`${BASE_URL}/templates/add.php`);

      console.log('✏️ Filling pizza form...');
      await driver.findElement(By.name('email')).sendKeys('test@example.com');
      await driver.findElement(By.name('title')).sendKeys('Test Pizza');
      await driver.findElement(By.name('ingredients')).sendKeys('cheese, tomato');

      console.log('🚀 Submitting form...');
      await driver.findElement(By.css('input[type="submit"]')).click();

      console.log('⏳ Waiting for redirect to index.php...');
      await driver.wait(until.urlContains('index.php'), 5000);

      const url = await driver.getCurrentUrl();
      console.log(`📍 Redirected to: ${url}`);
      assert.ok(url.includes('index.php'), 'Did not redirect to index.php');

      const pageSource = await driver.getPageSource();
      assert.ok(pageSource.includes('Test Pizza'), 'Pizza not found on index page');

      console.log('✅ Pizza form test passed');
    } catch (err) {
      await takeScreenshot(driver, 'add-pizza-failure');
      console.error('❌ Pizza form test failed');
      throw err;
    }
  });
});




