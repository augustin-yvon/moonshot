// webpack.config.js
var Encore = require('@symfony/webpack-encore');

Encore
    // le répertoire où seront stockés les assets compilés
    .setOutputPath('public/build/')
    // le chemin public utilisé par le serveur web pour accéder au répertoire précédent
    .setPublicPath('/build')
    // nettoiera ce répertoire entre chaque build
    .cleanupOutputBeforeBuild()
    .addEntry('app', './assets/app.js')
    // vous permettra d'utiliser la fonction asset() dans vos templates Twig
    .enableSingleRuntimeChunk()
    // active le traitement des fichiers .scss ou .sass
    .enableSassLoader()
    // active la réaction
    .enableReactPreset()
    // copie les fichiers vers le répertoire de build
    // les modifiez en fonction de vos besoins
    .copyFiles({
         from: './assets/images',
         // facultatif : si vous utilisez la version sans hash, vous pouvez
         // définir un modèle de versionnement pour forcer le navigateur à télécharger de nouveaux fichiers
         // lorsqu'ils changent
         to: 'images/[path][name].[ext]',
    })
;

// exporte la configuration finale
module.exports = Encore.getWebpackConfig();