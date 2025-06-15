const { Builder, By, until } = require('selenium-webdriver'); // ✅ Added 'until'
const chrome = require('selenium-webdriver/chrome');
const assert = require('assert');

describe('Pizza Form Test', function () {
  this.timeout(30000);
  let driver;

  before(async () => {
    const options = new chrome.Options();
    options.addArguments('--headless', '--no-sandbox', '--disable-dev-shm-usage');

    driver = await new Builder()
      .forBrowser('chrome')
      .setChromeOptions(options)
      .build();
  });

  after(async () => {
    if (driver) {
      await driver.quit();
    }
  });

  it('should submit the pizza form and return to index page', async () => {
    await driver.get('http://localhost/php_pizza_forum/templates/add.php'); // ✅ Update to your actual add form path

    await driver.findElement(By.name('email')).sendKeys('pizza@example.com');
    await driver.findElement(By.name('title')).sendKeys('Pepperoni');
    await driver.findElement(By.name('ingredients')).sendKeys('cheese, pepperoni');
    await driver.findElement(By.css('input[type="submit"]')).click(); // ✅ Correct submit button

    // ✅ Wait for the redirect to index page
    await driver.wait(until.urlContains('index.php'), 5000);

    const currentUrl = await driver.getCurrentUrl();
    assert.ok(currentUrl.includes('index.php'), 'Did not return to index page after submit');
  });
});

