it('should load the contact form on index.php#contact', async function () {
  try {
    await driver.get(`${BASE_URL}/index.php#contact`);

    const form = await driver.wait(until.elementLocated(By.css('#contact form')), 5000);
    assert.ok(await form.isDisplayed(), 'Contact form not visible');

    console.log('✅ Contact form is visible on index.php#contact');
  } catch (err) {
    await takeScreenshot(driver, 'contact-form-not-found');
    throw err;
  }
});







