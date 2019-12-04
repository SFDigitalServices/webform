const I = actor();
const loginPage = require('../pages/login');

module.exports = {
  cloneForm(sessid) {
    Given(/I clicked into an existing form for cloning/, async () => {
      await I.click('TESTING FORM CREATION'+sessid)
    })
    When('I click the clone icon', async() => {
      I.waitForText('Your form')
      I.waitForElement('button.clone-button')
      await I.click('button.clone-button')
    });
    Then('I should be redirected back to the dashboard', () => {
      I.waitForText('Welcome back,', 3, '.content')
    })
    Then('I should be able to logout', () => {
      I.click('Sign Out')
      I.wait(2)
  })
  When('I log back into my account', async() => {
      await loginPage.login('test@sf.gov','johndoe')
      I.waitForVisible('.forms', 3)
    })
    Then('I should see the cloned form', async() => {
      I.waitForText('Clone of TESTING FORM CREATION'+sessid, 8, '.forms')
      I.click('Clone of TESTING FORM CREATION'+sessid)
      I.waitForElement('button.delete-button')
      await I.click('button.delete-button')
      I.waitForText('Are you sure you want to delete this form?')
      await I.click('Ok')
    })
  },
};

Object.setPrototypeOf(module.exports, class CloneForm {}.prototype);