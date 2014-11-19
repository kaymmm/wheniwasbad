require.config({
	"baseUrl": "wp-content/themes/wheniwasbad/js",
	"paths": {
		"jquery": "vendor/jquery/jquery"
	}
});

require(['jquery'], function($) {
	console.log('Working!!');
});
