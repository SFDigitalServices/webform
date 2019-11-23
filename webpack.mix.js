const mix = require('laravel-mix');


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
