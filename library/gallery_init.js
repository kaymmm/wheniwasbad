if ( ! jQuery( "#blueimp-gallery" ).length ) {
	var html_block;
	html_block =  '<div id="blueimp-gallery" class="blueimp-gallery">';
	html_block += '<div class="slides"></div>';
	html_block += '<h3 class="title"></h3>';
	html_block += '<a class="prev">‹</a>';
	html_block += '<a class="next">›</a>';
	html_block += '<a class="close">×</a>';
	html_block += '<a class="play-pause"></a>';
	html_block += '<ol class="indicator"></ol>';
	html_block += '</div>';
	jQuery( "body" ).append(html_block);
}

function blueimpGalleryInit(gallery_id) {
	if ( jQuery("#"+gallery_id ).length ) {
		document.getElementById( gallery_id ).onclick = function (event) {
			event = event || window.event;
		    var target = event.target || event.srcElement,
		        link = target.src ? target.parentNode : target,
		        options = {index: link, event: event},
		        links = this.getElementsByTagName("a");
		    blueimp.Gallery(links, options);
		}
	} 
}