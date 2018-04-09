const CopyWebpackPlugin = require ('copy-webpack-plugin');
const path = require ('path');

module.exports = [
	{
		entry: {
			"lazyload-settings": "./app/components/lazyload-settings.vue"
		},
		output: {
			filename: "./app/bundle/[name].js"
		},
		plugins: [
			new CopyWebpackPlugin ([
				{
					from: './node_modules/jquery-lazy',
					to: './app/assets/jquery-lazy'
				}
			], {
				ignore: [
					'*.txt'
				],
				copyUnmodified: true
			})
		],
		module: {
			loaders: [
				{test: /\.vue$/, loader: "vue"},
				{test: /\.js$/, exclude: /node_modules/, loader: "babel-loader"}
			]
		}
	}

];