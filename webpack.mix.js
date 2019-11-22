const mix = require('laravel-mix');

mix.copy(
      'node_modules/sf-design-system/src/components/00-design-tokens/**/*.scss',
      'public/assets/sass/sf-design-system/design-tokens/').
    copy(
      'node_modules/sf-design-system/src/components/03-layout/**/*.scss',
      'public/assets/sass/sf-design-system/layout/').
    copy(
      'node_modules/sf-design-system/src/components/04-forms/**/*.scss',
      'public/assets/sass/sf-design-system/forms/').then( () => {
        mix.sass('public/assets/sass/app.scss', 'public/assets/css').
          sass('public/assets/sass/form-branding.scss', 'public/assets/css').
          sass('public/assets/sass/form-preview.scss', 'public/assets/css').
          options({
            includePaths: [
              path.resolve(__dirname, 'public/assets/sass/')
            ],
            autoprefixer: {} /* use default options */
            /*postCss: [ // install more postCss plugins: https://github.com/postcss/postcss/blob/master/docs/plugins.md
              require("stylelint")({  }), // auto fix is not supported when used as postCss plugin, moved it to CLI
              ]
              */
        });
      });