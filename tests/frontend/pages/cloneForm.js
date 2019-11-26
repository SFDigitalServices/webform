const I = actor();


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
    Then('I should see the cloned form', () => {
      I.waitForText('Clone of TESTING FORM CREATION'+sessid)
    })
    When('I click the clone form', async() => {
      await I.click('Clone of TESTING FORM CREATION'+sessid)
    });
    Then('I see the delete icon', () => {
      I.waitForElement('button.delete-button')
    })
    Then('I should not see the deleted cloned form', () => {
      I.dontSee('Clone of TESTING FORM CREATION'+sessid)
    })
    // Preview Form Feature
    Given(/I have an existing form for previewing/, async () => {
      await I.click('TESTING FORM CREATION'+sessid)
    })
    When('I click on the Preview button', async() => {
      I.waitForText('Preview')
      await I.click('button.preview-window');
      I.switchToNextTab(1)
    })
    Then('I should see a new window with rendered html', () => {
      I.waitForElement('#SFDSWF-Container')
      I.waitForElement('#SFDSWFB-legend')
      I.closeCurrentTab()
    })
  },
};

Object.setPrototypeOf(module.exports, class CloneForm {}.prototype);