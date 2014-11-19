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
      easing: 'ease-in-out'
    });

    // Shuffle is stored in the elements data with jQuery.
    // You can access the class instance here
    this.shuffle = this.$el.data('shuffle');
  };

  AjaxLoadMore.prototype.initAjax = function() {

    var self = this;
    self.$content = $('.shuffle-container', self.$el);

    var $pause = self.$el.data('pause'),
      $offset = self.$el.data('offset');

    // Define offset
    if (self.$el.data('offset') === undefined) {
      $offset = 0;
    } else {
      $offset = self.$el.data('offset');
    }
    // Define button text
    if (self.$el.data('button-label') === undefined) {
      $button_label = 'Load More Posts';
    } else {
      $button_label = self.$el.data('button-label');
    }
    // Add load more button
    var newBtn = '<div class="col-xs-12"><button id="'+self.uniqueID+'_btn" class="ajax-load-more btn btn-default btn-block btn-sm">' + $button_label + '</button></div>';
    self.$el.parent().append(newBtn);
    $button = $('#'+self.uniqueID+'_btn');

    //Parse Post Type for multiples
    $post_type = self.$el.data('post-type');
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
        category: self.$el.data('category'),
        author: self.$el.data('author'),
        taxonomy: self.$el.data('taxonomy'),
        tag: self.$el.data('tag'),
        search: self.$el.data('search'),
        exclude: self.$el.data('exclude'),
        numPosts: self.$el.data('posts-per-page'),
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
          if ($data.length < self.$el.data('display-posts')) {
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