
const assert = require('assert');
const loginPage = require('../pages/login');
const I = actor();

Before(() => {
  I.amOnPage('/');
  I.executeScript(function() {
    localStorage.clear();
  });
  loginPage.login('johndoe@example.com','johndoe')
});

// Create Form Feature
Given(/I am on the dashboard page/, () => {
  //loginPage.login('johndoe@example.com','johndoe')
  I.click('Create a New Form')
  I.see('Would you like to view the introduction tutorial')
  I.wait(1)
  I.click('No Thanks')
  I.wait(1)
})
When('I drag and drop a field onto the right panel', () => {
    I.dragAndDrop('#SFDSWFB-1 > div[data-formtype="c02"]', '#SFDSWFB-target')
    I.wait(2)
});
Then('I should see a blank form with a field created', () => {
  I.see('Form Saved!')
  I.seeElement('#SFDSWFB-target > fieldset > div[data-formtype="c02"]')
  I.wait(2)
})
Then('I should be able add fields to the form', () => {
  I.dragAndDrop('#SFDSWFB-1 > div[data-formtype="c04"]', '#SFDSWFB-target')
  I.wait(1)
  I.seeElement('#SFDSWFB-target > fieldset > div[data-formtype="c04"]')
  I.click('#SFDSWFB-legend')
  I.wait(2)
  I.fillField('title', 'TESTING FORM CREATION')
  I.wait(2)
  I.click('OK')
  I.wait(1)
})
Then('I should see my form on the dashboard', () => {
  I.click('SF Digital Services Logo')
  I.wait(1)
  I.see('TESTING FORM CREATION')
  I.wait(5)
})

// Modify Form Feature
Given(/I am on an existing form/, () => {
  I.click('.forms > a')
  I.wait(1)
})
When('I click on any existing fields', () => {
  I.seeElement('div[data-formtype="m14"]')
});
Then('I should see the field attribute window', () => {
  I.click( locate('#SFDSWFB-target fieldset div').at(2) )
  I.seeElement('.popover-content')
})
Then('I should be able modify the attributes', () => {
  I.fillField('placeholder', 'AUTOMATED PLACEHOLDER')
  I.wait(1)
  I.click('Attributes')
  I.fillField('name', 'AUTOMATED')
  I.wait(1)
  I.click('OK')
  I.wait(1)
  I.see('Form Saved')
  I.wait(5)
})

// Clone Form Feature
Given(/I clicked into an existing form/, () => {
  I.click('.forms > a')
  I.wait(2)
})
When('I click the clone icon', () => {
  I.seeElement('#SFDSWFB-legend')
  I.seeElement('li[data-original-title="Clone"]')
  I.click('li[data-original-title="Clone"]')
  I.wait(3)
});
Then('I should be redirected back to the dashboard', () => {
  I.see('Welcome back,')
})
Then('I should see the cloned form', () => {
  I.see('Clone of TESTING FORM CREATION')
  I.wait(5)
})

// Preview Form Feature
Given(/I have an existing form/, () => {
  I.click('.forms > a')
  I.wait(1)
})
When('I click on the Preview button', () => {
  I.click('#SFDSWFB-sourcetab')
  I.see('Preview Form')
  I.wait(1)
  I.click( locate('#SFDSWFB-6 div').at(2) );
  I.wait(3)
  I.switchToNextTab(1)
})
Then('I should see a new window with rendered html', () => {
  I.seeElement('#SFDSWF-Container')
  I.seeElement('#SFDSWFB-legend')
  I.wait(3)
  I.closeCurrentTab()
  I.wait(5)
})

// Submit Form Feature
Given(/I navigate to a published form/, () => {
  I.click('.forms > a')
  I.wait(1)
  I.click('Settings')
  I.checkOption('I want to create a Webform Buider CSV database')
  I.wait(1)
  I.fillField('confirmation', 'https://digitalservices.sfgov.org/thank-you')
  I.wait(2)
  I.click('#SFDSWFB-sourcetab')
  I.see('Preview Form')
  I.wait(1)
  I.click( locate('#SFDSWFB-6 div').at(2) );
  I.wait(3)
  I.switchToNextTab(1)
})
When('I filled out all required fields and click submit', () => {
  I.fillField('name', 'TEST NAME')
  I.fillField('email', 'TESTEMAIL@sf.gov')
  I.wait(2)
  I.click('#submit')
})
Then('I should be redirected to a confirmation page', () => {
  I.wait(2)
  I.seeInCurrentUrl('/thank-you');
  I.wait(2)
  I.closeCurrentTab();
  I.wait(5)
})

// Delete Form Feature
Given(/I clicked into an existing form/, () => {
  I.click('.forms > a')
  I.wait(1)
})
When('I click the delete icon', () => {
  I.seeElement('#SFDSWFB-legend')
  I.seeElement('li[data-original-title="Delete"]')
  I.click('li[data-original-title="Delete"]')
  I.wait(1)
});
Then('I should see confirmation popup', () => {
  I.seeElement('#modal-confirm')
})
When('I click Do It', () => {
  I.click('Do It')
  I.wait(3)
})
Then('I should be redirected back to the dashboard', () => {
  I.see('Welcome back,')
})
Then('I should not see the deleted form', () => {
  I.dontSee('TESTING FORM CREATION')
  I.wait(5)
})