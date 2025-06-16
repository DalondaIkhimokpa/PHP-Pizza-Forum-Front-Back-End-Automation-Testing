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
    const options = new chrome.Options().addArguments(
      '--headless',
      '--no-sandbox',
      '--disable-dev-shm-usage'
    );
    driver = await new Builder().forBrowser('chrome').setChromeOptions(options).build();
  });

  after(async () => {
    if (driver) await driver.quit();
  });

  it('should submit the contact form and stay on index page', async function () {
    try {
      await driver.get(`${BASE_URL}/contact.php`);

      await driver.findElement(By.name('name')).sendKeys('Test User');
      await driver.findElement(By.name('email')).sendKeys('test@example.com');
      await driver.findElement(By.name('message')).sendKeys('This is a test message.');

      await driver.findElement(By.css('form button, form input[type="submit"]')).click();

      // Wait for redirection back to index.php
      await driver.wait(until.urlContains('index.php'), 5000);

      const currentUrl = await driver.getCurrentUrl();
      assert.ok(currentUrl.includes('index.php'), 'Did not return to index.php');

      console.log('✅ Contact form submitted and redirected successfully');
    } catch (err) {
      await takeScreenshot(driver, 'contact-form-failure');
      console.error('❌ Contact form test failed');
      throw err;
    }
  });
});





