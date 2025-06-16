const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');
const fs = require('fs');

const BASE_URL = process.env.BASE_URL || 'http://localhost:8080';

// Utility to take screenshot on failure
async function takeScreenshot(driver, name) {
  const screenshot = await driver.takeScreenshot();
  fs.writeFileSync(`${name}.png`, screenshot, 'base64');
  console.log(`📸 Screenshot saved: ${name}.png`);
}

describe('Selenium Pizza Test', function () {
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

  it('should load homepage', async function () {
    try {
      console.log(`🌐 Navigating to ${BASE_URL}/index.php`);
      await driver.get(`${BASE_URL}/index.php`);

      console.log('⏳ Waiting for page title to contain "Pizza"...');
      await driver.wait(until.titleContains('Pizza'), 10000);

      const title = await driver.getTitle();
      console.log(`ℹ️ Page title: "${title}"`);
      assert.ok(title.toLowerCase().includes('pizza'), 'Title does not contain "pizza"');

      console.log('✅ Homepage test passed');
      } catch (err) {
        await takeScreenshot(driver, 'homepage-failure');
        throw err;
    }
});
});


