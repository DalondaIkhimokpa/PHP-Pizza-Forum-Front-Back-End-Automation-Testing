const { Builder, By } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

describe('Hello World Selenium Test', function () {
  this.timeout(30000);
  let driver;

  before(async function () {
    console.log('⏳ Waiting for server...');
    await new Promise(resolve => setTimeout(resolve, 5000));

    const options = new chrome.Options()
      .addArguments('--headless', '--no-sandbox', '--disable-dev-shm-usage', '--user-data-dir=/tmp/chrome-profile');

    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(options)
      .build();
  });

  after(async function () {
    if (driver) await driver.quit();
  });

  it('should open the website and check the title', async function () {
    await driver.get('http://example.com');
    const title = await driver.getTitle();
    assert.strictEqual(title, 'Example Domain');
  });
});

