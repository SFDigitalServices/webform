
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
      },
      restart: false,
      windowSize: '1600x1200',
      show: false,
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
    Smth: './pages/Smth.js',
    loginPage: './pages/Login.js',
    signinFragment: './fragments/Signin.js',
  },
  mocha: {},
  bootstrap: './bootstrap.js',
  teardown: null,
  hooks: [],
  gherkin: {
    features: './features/*.feature',
    steps: [
      './step_definitions/steps.js',
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