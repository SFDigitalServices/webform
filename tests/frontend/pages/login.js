const I = actor();

module.exports = {
  login(email, password) {
    I.fillField('email', email);
    I.fillField('password', password);
    I.click('Continue');
  },
};

Object.setPrototypeOf(module.exports, class Login {}.prototype);
