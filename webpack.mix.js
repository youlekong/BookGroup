let mix = require('laravel-mix');
const { env } = require('minimist')(process.argv.slice(2));
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

if (env && env.admin) {
	// react-admin
	mix.react('resources/assets/js/admin.js', 'public/js')
   		.sass('resources/assets/sass/admin.scss', 'public/css');
} else {
	// vue-app
	mix.js('resources/assets/js/app.js', 'public/js')
   		//.sass('resources/assets/sass/app.scss', 'public/css');

    mix.webpackConfig({
        plugins: [
            new BundleAnalyzerPlugin(),
        ],
        externals: {
            'axios': 'axios',
            'element-ui': 'ElementUI',
            'vue': 'Vue',
            // 'vue-router': 'VueRouter',
        },
        resolve:{
            alias: {
                'vue-router$': 'vue-router/dist/vue-router.common.js'
            }
        }
    });
}
