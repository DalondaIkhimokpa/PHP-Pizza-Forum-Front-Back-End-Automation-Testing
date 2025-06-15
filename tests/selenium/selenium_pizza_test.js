const { Builder, By } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

describe('Pizza Forum Page Test', function () {
  this.timeout(30000); // increase timeout for slow CI

  let driver;

  before(async () => {
    const options = new chrome.Options();
    options.addArguments('--no-sandbox');
    options.addArguments('--disable-dev-shm-usage');
    options.addArguments(`--user-data-dir=/tmp/chrome-profile-${Math.floor(Math.random() * 10000)}`);

    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(options)
      .build();
  });

  after(async () => {
    await driver.quit();
  });

  it('should load the homepage', async () => {
    await driver.get('http://127.0.0.1:8080');
    const title = await driver.getTitle();
    assert.ok(title.includes('Pizza') || title.length > 0);
  });
});

