const I = actor();
const loginPage = require('./Login');

class Smth {}

module.exports = {

  openPage() {
    I.amOnPage(process.env.CODECEPT_URL || 'http://localhost');
  },

  openAndLogin() {
    this.openPage();
    loginPage.login('johndoe@example.com', 'johndoe');
  },
};

Object.setPrototypeOf(module.exports, Smth.prototype);
