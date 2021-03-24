const path = require('path');
const webpack = require('webpack');
const browserSync = require('browser-sync').create();
const webpackDevMiddleware = require('webpack-dev-middleware');
const webpackHotMiddleware = require('webpack-hot-middleware');
const { publicFolder, proxyTarget } = require('./config');
const webpackConfig = require('../webpack.config');
const compiler = webpack(webpackConfig);
const getPublicPath = (output, prefix = '') => {
    const theme = path.basename(path.resolve('../'));
    return `${prefix}/wp-content/themes/${theme}/${output}/`;
}
const middleware = [
    webpackDevMiddleware(compiler, {
        publicPath: getPublicPath(publicFolder),
        logLevel: 'silent',
        quiet: true
    }),
    webpackHotMiddleware(compiler, {
        log: false,
        logLevel: 'none'
    })
];
browserSync.init({
    middleware,
    proxy: {
        target: proxyTarget,
        middleware
    },
    logLevel: 'silent',
    files: path.resolve('../**/*.php'),
    snippetOptions: {
        rule: {
            match: /<\/head>/i,
            fn: function(snippet, match) {
                return `<script src="${getPublicPath(publicFolder)}"></script>${snippet}${match}`;
            }
        }
    }
});