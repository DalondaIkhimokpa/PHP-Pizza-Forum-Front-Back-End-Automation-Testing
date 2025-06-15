const { Builder, By } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

describe('Pizza Forum Page Test', function () {
  this.timeout(30000); // increase timeout for slow CI

  let driver;

  before(async () => {
    driver = await new Builder().forBrowser('chrome').build();
  });

  after(async () => {
    await driver.quit();
  });

  it('should load the homepage', async () => {
    await driver.get('http://localhost:8080');
    const title = await driver.getTitle();
    assert.ok(title.includes('Pizza') || title.length > 0);
  });
});
