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
  },
};

Object.setPrototypeOf(module.exports, class DeleteFrom {}.prototype);