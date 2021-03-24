const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const SpriteLoaderPlugin = require('svg-sprite-loader/plugin');
const FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin');
const { entry, devtool, outputFolder, proxyTarget } = require('./config/config');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
// const autoprefixer = require('autoprefixer');

module.exports = {
    context: __dirname,
    mode: 'development',
    devtool: devtool,
    entry: entry,
    output: {
        path: path.resolve(__dirname, outputFolder),
        filename: '[name]-bundle.js',
        hotUpdateChunkFilename: 'hot/hot-update.js',
        hotUpdateMainFilename: 'hot/hot-update.json'
    },
    module: {
        rules: [
            {
                enforce: 'pre',
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                loader: 'eslint-loader'
            },
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                loader: 'babel-loader'
            },
            {
                test: /\.(sa|sc|c)ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader?-url',
                    'postcss-loader',
                    'sass-loader'
                ]
            },
            {
                test: /\.svg$/,
                loader: 'svg-sprite-loader',
                options: {
                    extract: true,
                    spriteFilename: 'svg-defs.svg'
                }
            },
            {
                test: /\.(jpe?g|png|gif)\$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            outputPath: 'images/',
                            name: '[name].[ext]'
                        }
                    },
                    'img-loader'
                ]
            }
        ]
    },
    plugins: [
        new webpack.HotModuleReplacementPlugin(),
        new FriendlyErrorsWebpackPlugin(),
        new StyleLintPlugin(),
        new MiniCssExtractPlugin({
            filename: '[name].css'
        }),
        new SpriteLoaderPlugin(),
        new BrowserSyncPlugin({
            files: [
                '{*,**/*}.php',
                'dist/{*,**/*}.css',
                'dist/{*,**/*}.js',
            ],
            proxy: proxyTarget
        })
    ],
    optimization: {
        minimizer: [
            new UglifyJSPlugin(),
            new OptimizeCssAssetsPlugin()
        ]
    }
};
