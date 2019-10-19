const assert = require('assert');
const loginPage = require('../pages/login');
const I = actor();


// you can provide RegEx to match corresponding steps
  Given(/I have a formbuilder account/, () => {
  I.amOnPage(process.env.CODECEPT_URL || 'http://localhost');
});

// Basic Feature
When('I log into my account', () => {
  loginPage.login('johndoe@example.com','johndoe');
  I.wait(3);
});

Then('I should see all my forms', () => {
  I.see('Welcome back')
  I.wait(3)
})
Then('I should be able to create new forms', () => {
  I.see('Create a New Form');
});
Then('I should be able to logout', () => {
  I.click('Sign Out')
  I.wait(2)
  I.seeElement('#login-form')
})
