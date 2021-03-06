const I = actor();


module.exports = {
  submitForm(sessid) {
    Given(/I navigate to a published form/, async () => {
      I.click('TESTING FORM CREATION'+sessid)
      I.waitForElement('.editorContainer')
      I.click('full_id', '#SFDSWFB-list')
      I.waitForText('Settings', 3, '#SFDSWFB-settings')
      await I.click('#SFDSWFB-attributes button.settings-toggle')
      I.selectOption('Backend','csv');
      I.fillField('confirmation', 'https://digitalservices.sfgov.org/thank-you')
      I.click('#SFDSWFB-settings button.apply-button')
      I.wait(2)
      I.click('button.preview-window');
      I.wait(1)
      I.switchToNextTab()
    })
    When('I filled out non required fields and click submit',  () => {
      I.waitForElement('#SFDSWF-Container', 3)
      I.fillField('Full Name', 'TEST NAME')
      I.click('Submit')
      I.wait(2)
    })
    Then('I should see a validation message',  () => {
      I.waitForText('You need to enter a valid email address.', 2, '#SFDSWF-Container')
    })
    When('I filled out all required fields and click submit',  () => {
      I.fillField('Email', 'TESTEMAIL@sf.gov')
      I.click('Submit')
      I.wait(2)
    })
    Then('I should be redirected to a confirmation page', async() => {
      await I.seeInCurrentUrl('/thank-you');
      await I.closeCurrentTab();
    })
  },
};

Object.setPrototypeOf(module.exports, class SubmitFrom {}.prototype);