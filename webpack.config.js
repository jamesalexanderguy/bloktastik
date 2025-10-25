const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

module.exports = {
	...defaultConfig,
	entry: {
		// Styles
		'styles/tailwind': path.resolve(process.cwd(), 'src/styles/tailwind.css'),
		'styles/editor': path.resolve(process.cwd(), 'src/styles/editor.scss'),
		// Scripts
		'scripts/main': path.resolve(process.cwd(), 'src/scripts/main.js'),
	},
};
