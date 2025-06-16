const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');
const fs = require('fs');

const BASE_URL = process.env.BASE_URL || 'http://localhost:8080';

async function takeScreenshot(driver, name) {
  const screenshot = await driver.takeScreenshot();
  fs.writeFileSync(`${name}.png`, screenshot, 'base64');
  console.log(`📸 Screenshot saved: ${name}.png`);
}

describe('Contact Page Test', function () {
  this.timeout(20000);
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

  it('should load contact.php and display the contact form', async function () {
    try {
      await driver.get(`${BASE_URL}/contact.php`);

      const form = await driver.wait(until.elementLocated(By.tagName('form')), 5000);
      const isDisplayed = await form.isDisplayed();

      assert.ok(isDisplayed, 'Contact form is not visible');
      console.log('✅ Contact form is visible on contact.php');
    } catch (err) {
      await takeScreenshot(driver, 'contact-page-failure');
      console.error('❌ Could not verify contact form');
      throw err;
    }
  });
});






