function blueimpGalleryInit(gallery_id,optionsJSON) {
	var options = jQuery.parseJSON(optionsJSON);

	if ( ! jQuery( '#'+gallery_id ).length ) {
		var html_block;
		html_block =  '<div id="'+gallery_id+'" class="blueimp-gallery">';
		html_block += '<div class="slides"></div>';
		html_block += '<h3 class="title"></h3>';
		html_block += '<p class="description alert alert-info"></p>';
		html_block += '<a class="prev">‹</a>';
		html_block += '<a class="next">›</a>';
		html_block += '<a class="close">×</a>';
		html_block += '<a class="play-pause"></a>';
		html_block += '<ol class="indicator"></ol>';
		html_block += '</div>';
		jQuery( "body" ).append(html_block);
	}
	
	if (options['showcaptions']){
		jQuery('#'+gallery_id).on('slide', function (event, index, slide) {
			var gallery = jQuery('#'+gallery_id).data('gallery'),
	        	text = gallery.list[index].getAttribute('data-original-title'),
	            node = gallery.container.find('.description');
	        node.empty();
	        if (text) {
	        	node[0].appendChild(document.createTextNode(text));
				node[0].style.display = 'block';
			} else {
				node[0].style.display = 'none';
			}
	        
		});
	}
	
	if (options['showcontrols']) {
		jQuery('#'+gallery_id).addClass('blueimp-gallery-controls');
	}
}