// eslint-disable-next-line no-undef
module.exports = {
    entry: {
        main: ['babel-polyfill', './src/js/index.js']
        // blocks: [],
        // editor: []
    },
    devtool: 'cheap-module-eval-source-map',
    outputFolder: 'dist',
    proxyTarget: 'http://localhost/'
};
