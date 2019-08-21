
exports.config = {
  output: './output',
  helpers: {
    Puppeteer: {
      url: process.env.CODECEPT_URL || 'http://localhost',
      'show': false,
      'chrome': {
        'headless': true,
        'args': [
          '--no-sandbox'
        ]
      }
    }
  },
  include: {
    I: './steps_file.js',
    loginPage: './pages/login.js'
  },
  mocha: {},
  bootstrap: null,
  teardown: null,
  hooks: [],
  gherkin: {
    features: './features/*.feature',
    steps: ['./step_definitions/steps.js']
  },
  plugins: {
    screenshotOnFail: {
      enabled: true
    }
  },
  tests: './*_test.js',
  name: 'tests'
}
