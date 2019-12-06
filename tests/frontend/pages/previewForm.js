const I = actor();


module.exports = {
  previewForm(sessid) {
    Given(/I have an existing form for previewing/, async() => {
      await I.click('TESTING FORM CREATION'+sessid)
    })
    When('I click on the Preview button', async() => {
      I.waitForText('Preview', 3, '.rightPanel')
      await I.click('button.preview-window');
      I.switchToNextTab(1)
    })
    Then('I should see a new window with rendered html', () => {
      I.waitForVisible('#SFDSWF-Container')
      I.closeCurrentTab()
    })
  },
};

Object.setPrototypeOf(module.exports, class PreviewFrom {}.prototype);