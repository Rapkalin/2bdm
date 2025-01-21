const path = require('path');
const TerserPlugin = require("terser-webpack-plugin");
const dev = process.env.NODE_ENV === "development"

let config = {
    entry: './assets/scripts/app.js',
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'dist'),
    },
    watch: dev,
    mode: "development",
    module: {
        rules: [
            {
                test: /\.js$/i,
                exclude: /node_modules/,
                use: ['babel-loader']
            },
            {
                test: /\.css$/i,
                use: ['style-loader', 'css-loader'],
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/i,
                type: 'asset/resource',
            },
        ],
    },
    optimization: {
        minimize: false,
        minimizer: [],
    },
};

if (!dev) {
    config.optimization.minimize = true;
    config.optimization.minimizer.push(new TerserPlugin());
    config.mode = 'production'
}

module.exports = config;