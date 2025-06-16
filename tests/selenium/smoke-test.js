const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

const BASE_URL = process.env.BASE_URL || 'http://localhost:8080/php_pizza_forum/';

describe('Smoke Test', function () {
  this.timeout(30000);
  let driver;

  before(async function () {
    const options = new chrome.Options()
      .addArguments('--headless', '--no-sandbox', '--disable-dev-shm-usage');
    
    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(options)
      .build();

    // Try hitting the site with retries
    let retries = 5;
    while (retries--) {
      try {
        await driver.get(BASE_URL);
        return;
      } catch (e) {
        console.log(`Retrying page load... (${5 - retries}/5)`);
        await new Promise(res => setTimeout(res, 1000));
      }
    }
    throw new Error(`Could not connect to ${BASE_URL}`);
  });

  after(async function () {
    if (driver) await driver.quit();
  });

  it('should load homepage and contain the expected title', async function () {
    const title = await driver.getTitle();
    assert.ok(title.length > 0, 'Title should not be empty');
    assert.strictEqual(title, 'PHP Pizza Forum'); // Update this as needed
  });

  it('should contain a visible main element or heading', async function () {
    const main = await driver.findElement(By.css('main, h1, h2'));
    const displayed = await main.isDisplayed();
    assert.strictEqual(displayed, true);
  });
});



