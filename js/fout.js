import WebFontLoader from './modules/webfontloader.js';

/* Load the required fonts */
const fout = new WebFontLoader({
	// google: {
	// 	families: ['Lato:300,400,700,900:latin-ext', 'Roboto:400,900']
	// }
	// WIP
	custom: {
		families: ['Lato:200,400,900'],
		url: '../css/fonts/local.css'
	}
});
