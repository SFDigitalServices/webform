const assert = require('assert');
const loginPage = require('../pages/login');
const I = actor();
const sessid = Math.random();
//const sessid = ""

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
  I.wait(2)
  I.see('Please enter the name of your form')
  I.fillField({id: 'formTitle'}, 'TESTING FORM CREATION'+sessid)
  I.click('Ok')
  I.wait(5)
})
When('I click to insert a field', () => {
    I.click('Name')
    I.wait(2)
});
Then('I should see the field created in the navigation and an edit panel', () => {
  I.see('Edit field', '.panel-header')
  I.wait(1)
})
Then('I should be able to edit that field to the form', () => {
  I.fillField('label', 'Full Name')
  I.fillField('name', 'full_name')
  I.fillField('id', 'full_name')
  I.click('Save')
  I.wait(3)
  I.switchTo('iframe');
  I.see('Name', '#SFDSWF-Container')
  I.wait(1)
  I.switchTo();
})
Then('I should see my form on the dashboard', () => {
  I.click('Digital Services Webform Builder')
  I.wait(2)
  //I.see('TESTING FORM CREATION'+sessid)
  I.see('Welcome back')
  I.wait(5)
})

// Modify Form Feature
Given(/I am on an existing form for modification/, () => {
  I.wait(5)
  I.click('TESTING FORM CREATION'+sessid)
  I.wait(1)
})
Then('I should be able to insert another field', () => {
  I.click('Click to add a field')
  I.wait(1)
  I.see('Add a field')
  I.click('Email')
  I.wait(1)
  I.see('Edit field', '#SFDSWFB-attributes')
  //I.seeElement('#SFDSWFB-list .item[data-id=email]')
})
When('I click on any existing fields', () => {
  I.seeElement('#SFDSWFB-list')
});
Then('I should see the field attribute window', () => {
  I.click('email')
  I.wait(1)
  I.see('Edit field', '#SFDSWFB-attributes')
})
Then('I should be able modify the attributes', () => {
  I.fillField('placeholder', 'AUTOMATED PLACEHOLDER')
  I.fillField('name', 'AUTOMATED_NAME')
  I.fillField('id', 'AUTOMATED_ID')
  I.click('Save')
  I.wait(3)
  I.switchTo('iframe');
  I.seeElement('#AUTOMATED_ID')
  I.wait(1)
  I.switchTo();
})

// Clone Form Feature
Given(/I clicked into an existing form for cloning/, () => {
  I.wait(5)
  I.click('TESTING FORM CREATION'+sessid)
  //I.click('.forms > a')
  I.wait(3)
})
When('I click the clone icon', () => {
  I.see('Your form')
  I.seeElement('button.clone-button')
  I.click('button.clone-button')
  I.wait(5)
});
Then('I should be redirected back to the dashboard', () => {
  I.see('Welcome back,')
})
Then('I should see the cloned form', () => {
  I.see('Clone of TESTING FORM CREATION'+sessid)
  I.wait(5)
})
When('I click the clone form', () => {
  I.click('Clone of TESTING FORM CREATION'+sessid)
  //I.click('.forms > a')
  I.wait(5)
});
Then('I see the delete icon', () => {
  I.seeElement('button.delete-button')
})
Then('I should not see the deleted cloned form', () => {
  I.dontSee('Clone of TESTING FORM CREATION'+sessid)
  I.wait(5)
})
// Preview Form Feature
Given(/I have an existing form for previewing/, () => {
  I.wait(5)
  I.click('TESTING FORM CREATION'+sessid)
  //I.click('.forms > a')
  I.wait(3)
})
When('I click on the Preview button', () => {
  I.see('Preview')
  I.click('button.preview-window');
  I.wait(5)
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
  I.wait(5)
  I.click('TESTING FORM CREATION'+sessid)
  I.wait(2);
  I.click('AUTOMATED_ID')
  I.wait(2)
  I.click('#SFDSWFB-attributes button.settings-toggle')
  I.selectOption('backend','csv');
  I.wait(1)
  I.fillField('confirmation', 'https://digitalservices.sfgov.org/thank-you')
  I.fillField('action', '/form/submit')
  I.click('#SFDSWFB-settings button.apply-button')
  I.wait(5)
  I.click('button.preview-window');
  I.wait(5)
  I.switchToNextTab()
})
When('I filled out all required fields and click submit', () => {
  I.fillField('Full Name', 'TEST NAME')
  I.fillField('Email', 'TESTEMAIL@sf.gov')
  I.wait(2)
  I.click('Submit')
})
Then('I should be redirected to a confirmation page', () => {
  I.wait(2)
  I.seeInCurrentUrl('/thank-you');
  I.wait(2)
  I.closeCurrentTab();
  I.wait(5)
})

// Delete Form Feature
Given(/I clicked into an existing form for deletion/, () => {
  I.wait(5)
  I.click('TESTING FORM CREATION'+sessid)
  //I.click('.forms > a')
  I.wait(3)
})
When('I click the delete icon', () => {
  I.seeElement('button.delete-button')
  I.click('button.delete-button')
  I.wait(3)
});
Then('I should see confirmation popup', () => {
  I.see('Are you sure you want to delete this form?')
})
When('I click Ok', () => {
  I.click('Ok')
  I.wait(2)
})
Then('I should be redirected back to the dashboard', () => {
  I.see('Welcome back,')
})
Then('I should not see the deleted form', () => {
  I.dontSee('TESTING FORM CREATION'+sessid)
  I.wait(5)
})