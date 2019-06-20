var Encore = require('@symfony/webpack-encore'); 
Encore
   .setOutputPath('public/build/')
   .setPublicPath('/build')
   .cleanupOutputBeforeBuild()
   .enableSourceMaps(!Encore.isProduction())
   .addEntry('js/app', './assets/js/app.js')
   .disableSingleRuntimeChunk()
   .enableVueLoader()
;
module.exports = Encore.getWebpackConfig();