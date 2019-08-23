
const assert = require('assert');
const loginPage = require('../pages/login');
const I = actor();

// you can provide RegEx to match corresponding steps
  Given(/I have a formbuilder account/, () => {
  I.amOnPage(process.env.CODECEPT_URL || 'http://localhost');
});

// or a simple string
When('I logged into the my account', () => {
  loginPage.login('johndoe@example.com','johndoe');
});

Then('I should see all my forms', () => {
  I.see('Welcome back')
})
Then('I should be able to create new forms', () => {
  I.see('Create a New Form');
});
