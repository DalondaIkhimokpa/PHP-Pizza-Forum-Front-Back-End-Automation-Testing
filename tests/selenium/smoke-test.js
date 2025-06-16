const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

describe('Smoke Test', function() {
  this.timeout(60000);
  let driver;

  before(async () => {
    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(new chrome.Options().headless())
      .build();
  });

  it('should load homepage', async () => {
    await driver.get(process.env.BASE_URL);
    const title = await driver.getTitle();
    assert.match(title, /Pizza/i, 'Page title should contain "Pizza"');
  });

  after(async () => await driver.quit());
});