import WebFontLoader from './modules/webfontloader.js';

/* Load the required fonts */
const fout = new WebFontLoader({
	google: {
		families: ['Roboto:400,900']
	},
	custom: {
		/* Self-hosted Lato, because Google Font's version does not support Cyrillic */
		families: ['Lato:200,400,900', 'FontAwesome'],
	}
});
