const assert = require('assert');
const loginPage = require('../pages/login');
const I = actor();


// you can provide RegEx to match corresponding steps
  Given(/I have a formbuilder account/, () => {
  I.amOnPage(process.env.CODECEPT_URL || 'http://webform.test');
});

// Basic Feature
When('I log into my account', () => {
  loginPage.login('test@sf.gov','johndoe')
});

Then('I should see all my forms', () => {
  I.waitForText('Welcome back,', 3, '.content')
})
Then('I should be able to create new forms', () => {
  I.waitForText('Create a New Form');
});
Then('I should be able to logout', () => {
  I.click('Sign Out')
  I.waitForElement('#login-form', 5)
})
