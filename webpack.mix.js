const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-nested'),
        require('autoprefixer'),
        require('postcss-preset-env'),
    ]).vue({ version: 2 });

mix.webpackConfig({
    module: {
        rules: [
          {
            test: /\.s(c|a)ss$/,
            use: [
              'vue-style-loader',
              'css-loader',
              {
                loader: 'sass-loader',
                options: {
                  implementation: require('sass'),
                  sassOptions: {
                    // indentedSyntax: true
                  },
                },
              },
            ],
          },
        ],
      }
})
