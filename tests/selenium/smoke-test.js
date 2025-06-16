const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

describe('Smoke Test', function () {
  this.timeout(60000); // 60 seconds

  let driver;

  before(async function () {
    // Wait briefly for the PHP server to be ready
    await new Promise(resolve => setTimeout(resolve, 5000));

    const options = new chrome.Options()
      .addArguments('--headless', '--no-sandbox', '--disable-dev-shm-usage');

    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(options)
      .build();
  });

  after(async function () {
    if (driver) await driver.quit();
  });

  it('should load homepage and contain the expected title', async function () {
    const baseUrl = process.env.BASE_URL || 'http://localhost:8080/php_pizza_forum/';
    await driver.get(baseUrl);

    // Wait for page title to load
    await driver.wait(until.titleIs('PHP Pizza Forum'), 5000);
    const title = await driver.getTitle();
    assert.strictEqual(title, 'PHP Pizza Forum');
  });

  it('should contain a visible main element or heading', async function () {
    const heading = await driver.findElement(By.css('h1')).getText();
    assert.ok(heading.length > 0, 'Heading should not be empty');
  });
});


