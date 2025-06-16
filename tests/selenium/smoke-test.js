const { Builder, By } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

const BASE_URL = process.env.BASE_URL || 'http://localhost:8080/index.php';

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

    await driver.get(BASE_URL);
  });

  after(async function () {
    if (driver) await driver.quit();
  });

  it('should contain a visible main element or heading', async function () {
    const main = await driver.findElement(By.css('main, h1, h2'));
    const displayed = await main.isDisplayed();
    assert.strictEqual(displayed, true);
  });
});




