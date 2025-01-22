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
    devtool: dev ? "eval-cheap-module-source-map" : "hidden-source-map",
    module: {
        rules: [
            {
                test: /\.js$/i,
                exclude: /node_modules/,
                use: ['babel-loader']
            },
            {
                test: /\.css$/i,
                use: ["style-loader", "css-loader"]
            },
            {
                test: /\.scss$/i,
                use: [
                    "style-loader",
                    {
                        loader: "css-loader",
                        options: {
                            importLoaders: 1
                        }
                    },
                    {
                        loader: "postcss-loader",
                        options: {
                            postcssOptions: {
                                plugins: [
                                    "autoprefixer",
                                ],
                            },
                        },
                    },
                    {
                        loader: "sass-loader",
                        options: {
                            implementation: require('sass')
                        },
                    },
                ],
            },
        ],
    },
    optimization: {
        minimize: false,
        minimizer: [],
    }
};

if (!dev) {
    config.optimization.minimize = true;
    config.optimization.minimizer.push(new TerserPlugin());
    config.mode = 'production'
}

console.log('Webpack Config', config);

module.exports = config;