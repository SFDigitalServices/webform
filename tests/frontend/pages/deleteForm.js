const I = actor();


module.exports = {
  deleteForm(sessid) {
    Given(/I clicked into an existing form for deletion/, async () => {
      await I.click('TESTING FORM CREATION'+sessid)
    })
    When('I click the delete icon', async () => {
      I.waitForElement('button.delete-button')
      await I.click('button.delete-button')
    });
    Then('I should see confirmation popup', () => {
      I.waitForText('Are you sure you want to delete this form?')
    })
    When('I click Ok', async () => {
      await I.click('Ok')
    })
    Then('I should be redirected back to the dashboard', () => {
      I.waitForText('Welcome back,', 3, '.content')
    })
    Then('I should not see the deleted form', () => {
      I.dontSee('TESTING FORM CREATION'+sessid)
    })
    When('I create a new form', async () => {
      I.waitForText('Please enter the name of your form')
      await I.fillField({id: 'formTitle'}, 'TESTING FORM CREATION AFTER DELETION'+sessid)
      await I.click('Ok')
    })
    When('I click to go home', async() => {
      await I.click('Digital Services Webform Builder')
    })
    Then('I should be redirected back to the dashboard', () => {
      I.waitForText('Welcome back,', 3, '.content')
    })
    Then('I should see the created form', async() => {
      I.waitForText('TESTING FORM CREATION AFTER DELETION'+sessid)
      I.click('TESTING FORM CREATION AFTER DELETION'+sessid)
      I.waitForElement('button.delete-button')
      await I.click('button.delete-button')
      I.waitForText('Are you sure you want to delete this form?')
      await I.click('Ok')
    })
  },
};

Object.setPrototypeOf(module.exports, class DeleteFrom {}.prototype);