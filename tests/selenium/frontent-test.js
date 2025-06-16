
const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

const BASE_URL = process.env.BASE_URL || 'http://localhost/php_pizza_forum';

describe('Frontend Tests', function() {
  this.timeout(15000);
  let driver;

  before(async () => {
    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(new chrome.Options().addArguments(
        '--headless',
        '--no-sandbox',
        '--disable-dev-shm-usage'
      ))
      .build();
  });

  it('should submit contact form', async () => {
    await driver.get(`${process.env.BASE_URL}/contact.php`);
    await driver.findElement(By.name('name')).sendKeys('Test User');
    await driver.findElement(By.name('email')).sendKeys('test@example.com');
    await driver.findElement(By.name('message')).sendKeys('Test message');
    await driver.findElement(By.css('button[type="submit"]')).click();
    
    await driver.wait(until.urlContains('?contact=success'), 10000);
  });

  it('should load pizza form', async () => {
    await driver.get(`${process.env.BASE_URL}/templates/add.php`);
    const title = await driver.getTitle();
    assert.match(title, /Add Pizza/i);
  });

  after(async () => {
    if (driver) await driver.quit();
  });
});