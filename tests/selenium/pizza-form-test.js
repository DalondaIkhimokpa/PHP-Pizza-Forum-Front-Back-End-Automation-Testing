
const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

const BASE_URL = process.env.BASE_URL || 'http://localhost/php_pizza_forum';

describe('Pizza Forum Tests', function() {
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

  it('should submit pizza form', async () => {
    await driver.get(`${BASE_URL}/templates/add.php`)
    const nameInput = await driver.findElement(By.name('name'));
    const emailInput = await driver.findElement(By.name('email'));
    const titleInput = await driver.findElement(By.name('title'));
    const ingredientsInput = await driver.findElement(By.name('ingredients'));
    const submitBtn = await driver.findElement(By.css('input[type="submit"]'));

    await nameInput.sendKeys('Test User');
    await emailInput.sendKeys('test@example.com');
    await titleInput.sendKeys('Test Pizza');
    await ingredientsInput.sendKeys('cheese, sauce');
    await submitBtn.click();

    await driver.wait(until.urlContains('index.php'), 5000);
  });
  after(async () => await driver.quit());
});
