require('dotenv').config({ path: '../../.env' })

exports.config = {
  output: './output',
  helpers: {
    Puppeteer: {
      ignoreHTTPSErrors: true,
      waitForNavigation: [ "domcontentloaded", "networkidle0" ],
      url: process.env.CODECEPT_URL || 'http://webform.test',
      'chrome': {
        'headless': true,
        'args': [
          '--no-sandbox',
          '--content-shell-host-window-size=1600x1200',
          '--ignore-certificate-errors',
        ]
      },
      restart: false,
      show: false,
      windowSize: '1600x1200',
      fullPageScreenshots: true,
      uniqueScreenshotNames: true,
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
    I: './custom_steps.js'
  },
  mocha: {},
  bootstrap: './bootstrap.js',
  teardown: null,
  hooks: [],
  gherkin: {
    features: './features/*.feature',
    steps: [
      './step_definitions/all_steps.js',
    ],
  },
  plugins: {
    allure: {
      enabled: false,
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