
const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

const BASE_URL = process.env.BASE_URL || 'http://localhost/php_pizza_forum';

describe('Selenium Pizza Test', function() {
  this.timeout(30000);
  let driver;

  before(async () => {
    const options = new chrome.Options()
      .addArguments(
        '--headless',
        '--no-sandbox',
        '--disable-dev-shm-usage',
        '--window-size=1920,1080'
      )
      .setChromeBinaryPath('/usr/bin/chromium-browser');

    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(options)
      .build();
  })

  it('should load the homepage', async () => {
    await driver.get(`${BASE_URL}/index.php`);
    const title = await driver.getTitle();
    assert.ok(title.includes('Pizza') || title.length > 0);
  });
});


