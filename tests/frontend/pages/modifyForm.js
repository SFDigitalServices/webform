const I = actor();


module.exports = {
  modifyForm(sessid) {
    Given(/I am on an existing form for modification/, async() => {
      await I.click('TESTING FORM CREATION'+sessid)
    })
    Then('I should be able to insert another field', async () => {
      await I.click('Click to add a field')
      I.waitForText('Add a field')
      await I.click('Email')
      I.waitForText('Edit field', 3, '#SFDSWFB-attributes')
    })
    When('I click on any existing fields', () => {
      I.waitForElement('#SFDSWFB-list')
      I.click('email')
    });
    Then('I should see the field attribute window',  () => {
      I.waitForText('Edit field', 2, '#SFDSWFB-attributes')
    })
    Then('I should be able modify the attributes',  () => {
      I.fillField('placeholder', 'AUTOMATED PLACEHOLDER')
      I.fillField('name', 'AUTOMATED_NAME')
      I.fillField('id', 'AUTOMATED_ID')
      I.click('Save')
      I.wait(2)
      I.switchTo('iframe');
      I.wait(2)
      I.waitForElement('#submit', 5)
      I.switchTo();
    })

  },
};

Object.setPrototypeOf(module.exports, class ModifyForm {}.prototype);