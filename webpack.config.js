var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/app')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build/app')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    .addEntry('js/app', './assets/js/app.js')
    .addStyleEntry('css/app', './assets/css/app.scss')

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()
;

// build the app configuration
const appConfig = Encore.getWebpackConfig();

// Set a unique name for the config (needed later!)
appConfig.name = 'appConfig';

// reset Encore to build the second config
Encore.reset();

// define the second configuration
Encore
    .setOutputPath('public/build/admin/')
    .setPublicPath('/build/admin')
    .addEntry('js/admin', './assets/js/admin/admin.js')
    .addStyleEntry('css/admin', './assets/css/admin/admin.scss')
    .enableSassLoader()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    ;

// build the second configuration
const adminConfig = Encore.getWebpackConfig();

// Set a unique name for the config (needed later!)
adminConfig.name = 'adminConfig';

// export the final configuration as an array of multiple configurations
module.exports = [appConfig, adminConfig];
