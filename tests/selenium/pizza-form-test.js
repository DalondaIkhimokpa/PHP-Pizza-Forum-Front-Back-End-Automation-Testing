const BASE_URL = process.env.CI ? 'http://localhost:8080' : 'http://localhost:8080';
const { Builder, By, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');

describe('Pizza Form Test', function () {
  this.timeout(30000);
  let driver;

  before(async function () {
    const options = new chrome.Options()
      .addArguments('--headless', '--no-sandbox', '--disable-dev-shm-usage', '--user-data-dir=/tmp/chrome-profile');

    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(options)
      .build();

    await new Promise(resolve => setTimeout(resolve, 5000)); // wait for server
  });

  after(async function () {
    if (driver) await driver.quit();
  });

  it('should submit the pizza form and return to index page', async function () {
    await driver.get(`${BASE_URL}/index.php`);
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
});

