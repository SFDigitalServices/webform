const I = actor();

module.exports = {
  login(email, password) {
    I.fillField('email', 'johndoe@example.com');
    I.fillField('password', 'johndoe');
    I.click('Continue');
  },
};

Object.setPrototypeOf(module.exports, class Login {}.prototype);
