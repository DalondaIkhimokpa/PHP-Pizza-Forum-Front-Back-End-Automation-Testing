const { Builder, By } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

describe('Smoke Test', function () {
  this.timeout(10000);
  let driver;

  before(async () => {
    const options = new chrome.Options();
    options.addArguments('--headless=new'); // <-- use "--headless" or "--headless=new" for newer versions
    options.addArguments('--no-sandbox');
    options.addArguments('--disable-dev-shm-usage');

    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(options)
      .build();
  });

  it('should load homepage', async () => {
    await driver.get(process.env.BASE_URL);
    const title = await driver.getTitle();
    assert.match(title, /Pizza/i, 'Page title should contain "Pizza"');
  });

  after(async () => {
    if (driver) await driver.quit();
  });
});
