/**
 * External Dependencies
 */
 const path = require( 'path' );
 const { CleanWebpackPlugin } = require('clean-webpack-plugin');

 /**
  * WordPress Dependencies
  */
 const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );

module.exports = {
	...defaultConfig,
	entry: {
		'app': path.resolve(process.cwd(), 'src', 'app.js'),
	},
  output: {
    path: path.resolve(__dirname, 'build'),
  },
  plugins: [
    new CleanWebpackPlugin({
      verbose: true,
      cleanOnceBeforeBuildPatterns: [
        '!/app.css'
      ]
    }),
  ],
}
