const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');
const fs = require('fs');

const BASE_URL = process.env.BASE_URL || 'http://localhost:8080';

// Utility to take a screenshot on failure
async function takeScreenshot(driver, name) {
  const screenshot = await driver.takeScreenshot();
  fs.writeFileSync(`${name}.png`, screenshot, 'base64');
  console.log(`📸 Screenshot saved: ${name}.png`);
}

describe('Contact Forum Tests', function () {
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

  it('should submit the contact form and stay on index page', async function () {
    try {
      console.log(`🌐 Navigating to: ${BASE_URL}/contact.php`);
      await driver.get(`${BASE_URL}/contact.php`);

      console.log('✏️ Filling contact form...');
      await driver.findElement(By.name('name')).sendKeys('Test User');
      await driver.findElement(By.name('email')).sendKeys('test@example.com');
      await driver.findElement(By.name('message')).sendKeys('This is a test message.');

      console.log('🚀 Submitting form...');
      await driver.findElement(By.css('button[type="submit"]')).click();

      console.log('⏳ Waiting for redirect...');
      await driver.wait(until.urlContains('index.php?contact=success#contact'), 5000);

      const currentUrl = await driver.getCurrentUrl();
      console.log(`📍 Current URL: ${currentUrl}`);
      assert.ok(currentUrl.includes('index.php'), 'Did not return to index.php');

      console.log('✅ Contact form submitted and redirected successfully');
    } catch (err) {
      await takeScreenshot(driver, 'contact-form-failure');
      console.error('❌ Contact form test failed');
      throw err;
    }
  });
});




