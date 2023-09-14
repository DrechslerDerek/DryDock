const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/app.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .enableStimulusBridge('./assets/controllers.json')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })
    .copyFiles([
        {from: './assets/images',to: 'images/[path][name].[ext]'},
        {from: './assets/sounds',to: 'sounds/[path][name].[ext]'},
        {from: './assets/fonts',to: 'fonts/[path][name].[hash:8].[ext]'}
    ])
;

module.exports = Encore.getWebpackConfig();
