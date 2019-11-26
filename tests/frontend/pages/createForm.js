const I = actor();


module.exports = {
  createForm(sessid) {
    // Create Form Feature
    Given(/I am on the dashboard page/, async () => {
      //loginPage.login('johndoe@example.com','johndoe')
      await I.click('Create a New Form')
      I.waitForText('Please enter the name of your form')
      await I.fillField({id: 'formTitle'}, 'TESTING FORM CREATION'+sessid)
      await I.click('Ok')
    })
    When('I click to insert a field', async () => {
        await I.click('Name')
    });
    Then('I should see the field created in the navigation and an edit panel', async () => {
      I.waitForText('Edit field', 2, '#SFDSWFB-attributes')
      I.waitForElement('.save-buttons')
      I.wait(1)
    })
    Then('I should be able to edit that field to the form', async() => {
      I.fillField('label', 'Full Name')
      I.fillField('name', 'full_name')
      I.fillField('id', 'full_name')
      await I.click('Save')
      I.wait(2)
      I.switchTo('iframe');
      I.wait(3)
      I.waitForText('Name', 3, '#SFDSWF-Container')
      await I.switchTo();
    })
    Then('I should see my form on the dashboard', async () => {
      await I.click('Digital Services Webform Builder')
      I.waitForText('Welcome back', 3, '.content')
    })
  },
};

Object.setPrototypeOf(module.exports, class CreateFrom {}.prototype);