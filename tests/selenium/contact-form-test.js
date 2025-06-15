const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

const BASE_URL = process.env.BASE_URL || 'http://localhost/php_pizza_forum';

describe('Contact Form Test', function() {
  this.timeout(30000);
  let driver;

  before(async () => {
    const options = new chrome.Options()
      .addArguments(
        '--headless',
        '--no-sandbox',
        '--disable-dev-shm-usage'
      );

    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(options)
      .build();
  });

  it('should submit the contact form and stay on index page', async function () {
    await driver.get(`${BASE_URL}/contact.php`);

    await driver.findElement(By.name('name')).sendKeys('Test User');
    await driver.findElement(By.name('email')).sendKeys('test@example.com');
    await driver.findElement(By.name('message')).sendKeys('This is a test message.');
    await driver.findElement(By.css('button[type="submit"]')).click();

    await driver.wait(until.urlContains('index.php?contact=success#contact'), 5000);

    const currentUrl = await driver.getCurrentUrl();
    assert.ok(currentUrl.includes('index.php'));
  });
});


