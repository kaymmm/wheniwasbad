/*
 * AJAX load more posts
 * Keith Miyake
 *
 * uses code from https://github.com/dcooney/wordpress-ajax-load-more
 * GPLv2
 *
 */

window.AjaxLoadMore = (function($) {

	var AjaxLoadMore = function( element ) {
    	var self = this;

    	self.$el = $( element );
    	self.uniqueID = element.id;
    	self.initShuffle();
    	self.initAjax();
  	};

  	var page = 0,
		speed = 300,
		$init = true,
		$loading = true,
		$finished = false,
		$window = $(window),
		$button_label = '',
		$button,
		$post_type,
		$offset,
		$content,
		$el,
		$data,
		uniqueID;


	AjaxLoadMore.prototype.initShuffle = function() {
		var sizer = this.$el.find('.shuffle__sizer');
		this.$el.shuffle({
			itemSelector: '.shuffle-brick',
			speed: this.speed,
			sizer: sizer,
			easing: 'ease-in-out',
		});

		// Shuffle is stored in the elements data with jQuery.
		// You can access the class instance here
		this.shuffle = this.$el.data('shuffle');
	};

	AjaxLoadMore.prototype.initAjax = function() {

		var self = this;
		$content = $('.shuffle-container', self.$el);

		var $pause = $content.data('pause'),
			$offset = $content.data('offset');

		// Define offset
		if ($content.data('offset') === undefined) {
			$offset = 0;
		} else {
			$offset = $content.data('offset');
		}
		// Define button text
		if ($content.data('button-label') === undefined) {
			$button_label = 'Load More Posts';
		} else {
			$button_label = $content.data('button-label');
		}
		// Add load more button
		self.$el.parent().parent().append('<div class="col-xs-12"><button id="'+self.uniqueID+'_btn" class="ajax-load-more btn btn-default btn-block btn-sm">' + $button_label + '</button></div>');
		$button = $('#'+self.uniqueID+'_btn');
		console.log($button);
		//Parse Post Type for multiples
		$post_type = $content.data('post-type');
		if ($post_type === undefined) {
			$post_type = 'post';
		}
		$post_type = $post_type.split(",");
		$button.text("Loading...");

		// Button click event
		$button.click(function() {
			if($pause === true){
				$pause = false;
				self.loadPosts();
			}
			if (!$loading && !$finished && !$(this).hasClass('done')) {
				$loading = true;
				page++;
				self.loadPosts();
			}
		});

		//Check for pause variable
		if($pause === true){
			$button.text($button_label);
		}else{
			self.loadPosts();
			//self.boop();
		}

	};

	AjaxLoadMore.prototype.loadPosts = function() {
		var self = this;
		$button.addClass('loading');
		$.ajax({
			type: "GET",
			url: ajax_localized.admin_ajax,
			data: {
				action: 'load_more_posts',
				nonce: ajax_localized.ajax_load_more_nonce,
				postType: $post_type,
				category: $content.data('category'),
				author: $content.data('author'),
				taxonomy: $content.data('taxonomy'),
				tag: $content.data('tag'),
				search: $content.data('search'),
				exclude: $content.data('exclude'),
				numPosts: $content.data('posts-per-page'),
				pageNumber: page,
				offset: $offset
			},
			dataType: "html",
			// parse the data as html
			beforeSend: function() {
				if (page != 1) {
					$button.addClass('loading');
				}
			},
			success: function(data) {
				$data = $(data); // Convert data to an object
				if ($init) {
					$button.text($button_label);
					$init = false;
				}
				if ($data.length > 0) {
					self.$el.append($data);
				    self.shuffle.appended( $data );
				    $loading = false;
					$button.delay(speed).removeClass('loading');
					if ($data.length < $content.data('display-posts')) {
						$finished = true;
						$button.addClass('done');
					}
				} else {
					$button.delay(speed).removeClass('loading').addClass('done');
					$loading = false;
					$finished = true;
					$button.delay(speed).addClass('disabled');
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$button.removeClass('loading');
				//alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}
		});
	};

	$.easing.alm_easeInOutQuad = function(x, t, b, c, d) {
		if ((t /= d / 2) < 1) return c / 2 * t * t + b;
		return -c / 2 * ((--t) * (t - 2) - 1) + b;
	};

	return AjaxLoadMore;

})(jQuery);