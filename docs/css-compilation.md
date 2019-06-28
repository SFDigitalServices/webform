
## Introduction
The Formbuilder uses [Laravel Mix](https://laravel-mix.com/docs/4.0) to preprocess and postprocess CSS from source code (SCSS). Out of the box, Laravel Mix provides most of the functionality to achieve our needs.

All of these are baked into Formbuilder's build process on CircleCI. The instruction below are for local development setup.

# Install
All required packages and depdencies have been included in package.json. If you find any discrepancies, please update this README.

Install using npm:

```
$ npm install
```

# CSS compilation and PostCSS
You should see the webpack.mix.js file when you checkout the code here. This is your configuration layer on top of webpack. Most of your time will be spent here.

```js
const mix = require('laravel-mix');

mix.sass('public/assets/sass/app.scss', 'public/assets/css') // you can "chain" more source source files.
.sass('public/assets/sass/app1.scss', 'public/assets/css'). //app1.scss is an example
   options({
      autoprefixer: {}, /* use default options */
      /*postCss: [ // install more postCss plugins: https://github.com/postcss/postcss/blob/master/docs/plugins.md
         require("stylelint")({  }), // auto fix is not supported when used as postCss plugin, moved it to CLI
         ]
         */
});
```

# Linting
Css linting is not supported as a PostCss plugin, therefore, we need to install it as a command line tool. The tool we're using is called `stylelint` and it's already included in package.json.

```
./node_modules/stylelint/bin/stylelint.js public/assets/css/*.css --fix
```

The command above will automatically lint all css files under the public/assets/css folder use the rules defined in `.stylelintrc.json`.  Take a look inside the json config file to make any adjustments. Learn more about [stylelint rules](https://github.com/stylelint/stylelint/blob/master/docs/user-guide/about-rules.md).