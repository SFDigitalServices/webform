const assert = require('assert');
const loginPage = require('../pages/login');
const createFormPage = require('../pages/createForm');
const ModifyFormPage = require('../pages/modifyForm');
const cloneFormFormPage = require('../pages/cloneForm');
const submitFormFormPage = require('../pages/submitForm');
const deleteFormFormPage = require('../pages/deleteForm');
const previewFormFormPage = require('../pages/previewForm');

const I = actor();
const sessid = Math.random();


Before(() => {
  I.amOnPage('/');
  I.executeScript(function() {
    localStorage.clear();
  });
  loginPage.login('test@sf.gov','johndoe')
});

// Basic Feature
Given(/I have a formbuilder account/, () => {
  I.wait(1)
});
When('I log into my account', () => {
  I.wait(3)
});
Then('I should see all my forms', () => {
  I.waitForVisible('.forms', 3)
})
Then('I should be able to create new forms', () => {
  I.waitForText('Create a New Form', 3, '.welcomeBox');
});
Then('I should be able to logout', () => {
  I.click('Sign Out')
  I.waitForVisible('#login-form', 5)
})

// Create Form Feature
createFormPage.createForm(sessid)

// Clone Form Feature
cloneFormFormPage.cloneForm(sessid)

// Modify Form Feature
ModifyFormPage.modifyForm(sessid)

// Preview Form Feature
previewFormFormPage.previewForm(sessid)

// Submit Form Feature
submitFormFormPage.submitForm(sessid)

// Delete Form Feature
deleteFormFormPage.deleteForm(sessid)