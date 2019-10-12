const puppeteer = require('puppeteer');
process.env.CHROME_BIN = puppeteer.executablePath();

module.exports = function (config) {
  config.set({
    basePath: './',

    frameworks: ['jasmine'],

    files: [
      'public/assets/js/jquery.min.js',
      'public/assets/js/bootstrap.min.js',
      'public/assets/js/popper.min.js',
      'public/assets/js/fb.js',
      'public/assets/js/html-templates.js',
      'public/assets/js/fb-view.js',
      'public/assets/js/forms-collection.js',
      'public/assets/js/form.js',
      'public/assets/js/item.js',
      'tests/jasmine/spec/*.js'
    ],

    exclude: [],

    reporters: ['progress'],

    port: 9876,

    colors: true,

    logLevel: config.LOG_INFO,

    autoWatch: false,

    browsers: ['ChromeHeadless'],
    singleRun: false
  })
}
