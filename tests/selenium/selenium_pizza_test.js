const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

const BASE_URL = process.env.BASE_URL || 'http://localhost:8080';

describe('Selenium Pizza Test', function () {
  this.timeout(30000);
  let driver;

  before(async () => {
    const options = new chrome.Options();
    options.addArguments('--headless', '--no-sandbox', '--disable-dev-shm-usage');
    driver = await new Builder().forBrowser('chrome').setChromeOptions(options).build();
  });

  after(async () => {
    await driver.quit();
  });

  it('should load homepage', async function () {
    await driver.get(`${BASE_URL}/index.php`);
    await driver.wait(until.titleContains('Pizza'), 10000);
    const title = await driver.getTitle();
    assert.ok(title.toLowerCase().includes('pizza'));
  });
});



