var WebFont = require('webfontloader');

export default class WebFontLoader {
	constructor () {
		let cached = sessionStorage.fonts;
		this.fonts = arguments[0];

		/* Arguments */
		let args = {
			active: () => {
				// WIP
				// sessionStorage.fonts = true;
			},
			timeout: 2000
		};
		args = Object.assign(args, this.fonts);

		/* Activate WebFonts when fonts are cached */
		// if (cached) {
		// 	document.documentElement.classList.add('wf-active');
		// }

		WebFont.load(args);
	}
}
