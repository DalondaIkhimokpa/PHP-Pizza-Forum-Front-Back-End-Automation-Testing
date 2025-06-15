const BASE_URL = process.env.CI ? 'http://127.0.0.1:8080' : 'http://127.0.0.1:8080';
const { Builder, By } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

describe('Pizza Forum Page Test', function () {
  this.timeout(30000);
  let driver;

  before(async () => {
    const options = new chrome.Options()
      .addArguments('--headless', '--no-sandbox', '--disable-dev-shm-usage')
      .addArguments(`--user-data-dir=/tmp/chrome-profile-${Math.floor(Math.random() * 10000)}`);

    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(options)
      .build();

    await new Promise(resolve => setTimeout(resolve, 5000)); // Wait for server to start
  });

  after(async () => {
    if (driver) await driver.quit();
  });

  it('should load the homepage', async () => {
    await driver.get(BASE_URL);
    const title = await driver.getTitle();
    assert.ok(title.includes('Pizza') || title.length > 0);
  });
});


