var path = require("path");
var webpack = require("webpack");

const DIST_PATH = path.resolve( './dist/js' );

const config = {
	cache: true,
	entry: {
		// admin: './assets/js/admin/admin.js',
		// frontend: './assets/js/frontend/frontend.js',
		// shared: './assets/js/shared/shared.js',
		customizer: './assets/js/customizer/customizer.js'
	},
	output: {
		path: DIST_PATH,
		filename: '[name].min.js',
	},
	resolve: {
		modules: ['node_modules'],
	},
	devtool: 'source-map',
	module: {
		rules: [
			{
				test: /\.js$/,
				enforce: 'pre',
				loader: 'eslint-loader',
				options: {
					fix: true
				}
			},
			{
				test: /\.js$/,
				use: [{
					loader: 'babel-loader',
					options: {
						babelrc: true,
					}

				}]
			}
		]
	},
	mode: process.env.NODE_ENV,
	plugins: [
		new webpack.NoEmitOnErrorsPlugin(),
	],
	stats: {
		colors: true
	},
	/*
	Uncomment this if you need to exclude dependencies from the output bundles,
	like if WordPress is including jQuery (for example).

	externals: {
		jquery: 'jQuery'
	}
	*/
};

module.exports = config;
