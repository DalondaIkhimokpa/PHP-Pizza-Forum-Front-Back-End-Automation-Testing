const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

const BASE_URL = process.env.BASE_URL || 'http://localhost/php_pizza_forum';

describe('Pizza Forum Tests', function () {
  this.timeout(30000);
  let driver;

  before(async () => {
    const options = new chrome.Options();
    options.addArguments('--headless', '--no-sandbox', '--disable-dev-shm-usage');
    driver = await new Builder().forBrowser('chrome').setChromeOptions(options).build();
  });

  after(async () => {
    await driver.quit();
  });

  it('should add a new pizza and return to homepage with pizza listed', async function () {
    await driver.get(`${BASE_URL}/templates/add.php`);

    await driver.findElement(By.name('email')).sendKeys('test@example.com');
    await driver.findElement(By.name('title')).sendKeys('Test Pizza');
    await driver.findElement(By.name('ingredients')).sendKeys('cheese, tomato');
    await driver.findElement(By.css('input[type="submit"]')).click();

    await driver.wait(until.urlContains('index.php'), 5000);

    const url = await driver.getCurrentUrl();
    assert.ok(url.includes('index.php'));

    const pageSource = await driver.getPageSource();
    assert.ok(pageSource.includes('Test Pizza'), 'Pizza not found on index page');
  });
});



