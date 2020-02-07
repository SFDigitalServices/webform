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
      I.fillField('id', 'full_id')
      I.click('Save')
      I.wait(2)
      I.switchTo('iframe');
      I.wait(3)
      I.waitForText('Name', 3, '#SFDSWF-Container')
      await I.switchTo();
    })
    When('I click to insert a multi field', async () => {
        await I.click('Choose one')
    });
    Then('I should be able to see that field highlighted in the form', async() => {
      I.switchTo('iframe');
      I.wait(3)
      I.waitForText('Radio', 3, '#SFDSWF-Container')
      I.waitForElement('.form-group.is-selected-in-editor[data-id=radio]')
      await I.switchTo();
    })
    When('I click to insert a number field', async () => {
        await I.click('Number')
    });
    Then('I should see the field created in the navigation and an edit panel', async () => {
      I.waitForText('Edit field', 2, '#SFDSWFB-attributes')
      I.waitForElement('.save-buttons')
      I.wait(1)
    })
    Then('I should be able to edit that field to the form', async() => {
      I.fillField('label', 'Number')
      I.fillField('name', 'number_name')
      I.fillField('id', 'number_id')
      I.click('Add a rule')
      I.click('Save')
      I.wait(2)
    })
    Then('I should see my form on the dashboard', async () => {
      await I.click('Digital Services Webform Builder')
      I.waitForText('Welcome back', 3, '.content')
    })
  },
};

Object.setPrototypeOf(module.exports, class CreateFrom {}.prototype);