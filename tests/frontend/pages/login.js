'use strict';

let I;

module.exports = {

  // insert your locators and methods here
  _init() {
    I = actor();
  },

  fields: {
    email: 'email',
    password: 'password'
  },
  submitButton: 'Continue',

  sendForm(email, password) {
    I.fillField(this.fields.email, email);
    I.fillField(this.fields.password, password);
    I.click(this.submitButton);
  }
}