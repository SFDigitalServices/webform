//const CONFIG = require('my.config.js').myConfig;

const loginPage = require('../pages/login');
const I = actor();

// Add in your custom step files

// you can provide RegEx to match corresponding steps
  Given(/I have a formbuilder account/, () => {
  I.amOnPage(process.env.CODECEPT_URL || 'http://localhost');
});

// or a simple string
When('I logged into the my account', () => {
  loginPage.sendForm('johndoe@example.com','johndoe');
});

// parameters are passed in via Cucumber expressions
Then('I should see all my forms', () => {
  I.see("Welcome back");
});
Then('I should be able to create new forms', () => {
  I.see('Create a New Form');
});