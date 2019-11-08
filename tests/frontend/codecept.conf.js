
exports.config = {
  output: './output',
  helpers: {
    Puppeteer: {
      url: process.env.CODECEPT_URL || 'http://webform.test',
      'firefox': {
        'headless': true,
        'args': [
          '--no-sandbox',
          '--ignore-certificate-errors',
        ]
      },
      restart: false,
      windowSize: '1200x800',
      show: false,
      keepBrowserState: true
    },
    REST: {},
  },
  multiple: {
    parallel: {
      chunks: 2
    }
  },
  include: {
    I: './custom_steps.js',
    loginPage: './pages/Login.js',
    fieldContent: './pages/fieldContent.js',
  },
  mocha: {},
  bootstrap: './bootstrap.js',
  teardown: null,
  hooks: [],
  gherkin: {
    features: './features/*.feature',
    steps: [
      './step_definitions/steps.js',
      './step_definitions/all_steps.js',
    ],
  },
  plugins: {
    allure: {
      enabled: false,
    },
    wdio: {
      enabled: false,
      services: [
        'selenium-standalone',
      ],
    },
    stepByStepReport: {},
    autoDelay: {
      enabled: false,
    },
    retryFailedStep: {
      enabled: true,
    },
  },
  tests: './*_test.js',
  timeout: 10000,
  multiple: {
    parallel: {
      chunks: 2,
    },
    default: {
      grep: 'signin',
      browsers: [
        'chrome',
        'firefox',
      ],
    },
  },
  name: 'tests',
};