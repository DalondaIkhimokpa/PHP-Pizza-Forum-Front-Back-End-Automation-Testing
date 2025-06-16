const { Builder, By } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

describe('Smoke Test', function () {
  this.timeout(10000);
  let driver;

  before(async () => {
    const options = new chrome.Options();
    options.addArguments('--headless=new');
    options.addArguments('--no-sandbox');
    options.addArguments('--disable-dev-shm-usage');

    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(options)
      .build();
  });

  it('should load homepage content', async () => {
    await driver.get(process.env.BASE_URL);
    const body = await driver.findElement(By.tagName('body')).getText();
    console.log('📄 Page body snippet:', body.substring(0, 200));
    assert.ok(body.length > 0, 'Page body should not be empty');
  });

  after(async () => {
    if (driver) await driver.quit();
  });
});


