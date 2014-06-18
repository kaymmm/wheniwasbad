<?php
/*
Template Name: Pinterest Blog
*/
?>

<?php get_header(); ?>

<?php wp_enqueue_script('shuffle'); ?>

<div id="content" class="content-no-margin clearfix parallax-wheniwasbad" data-type="background" data-bg-speed="15" >

<?php
	global $wheniwasbad_options;
	$use_carousel = get_post_meta($post->ID, 'carousel_enable' , true);
	$carousel_cats = get_post_meta($post->ID, 'carousel_categories',true);
	$carousel_only_images = get_post_meta($post->ID, 'carousel_only_images',true);
	if ( ! is_array($carousel_cats) ) {
		$use_carousel = false;
	} else {
		$carousel_cats = implode(',',$carousel_cats);
	}
	$carousel_count = get_post_meta($post->ID, 'carousel_count' , true);
	$carousel_height_ratio = get_post_meta($post->ID, 'carousel_height_ratio' , true);
	$carousel_hide_xs = ( get_post_meta($post->ID, 'carousel_hide_xs' , true) ? ' hidden-xs' : '');
	if ( ! is_numeric($carousel_height_ratio) ) {
		$carousel_height_ratio = 2.33;
	}
	if ($use_carousel) : ?>

		<div id="myCarousel" class="carousel slide<?php echo $carousel_hide_xs; ?>" data-ride="carousel">
		    <!-- Carousel items -->
		    <div class="carousel-inner">

		    	<?php
				global $post;
				$tmp_post = $post;
				$args = array( 'numberposts' => $carousel_count, 'category' => $carousel_cats );
				if ( $carousel_only_images ) {
					$args['meta_key'] = '_thumbnail_id';
				}
				$myposts = get_posts( $args );
				$post_num = 0;
				foreach( $myposts as $post ) :	setup_postdata($post);
					$post_num++;?>

			    <div class="<?php if($post_num == 1){ echo 'active'; } ?> item" style="overflow:hidden;">
			    	<?php
			    		if ( has_post_thumbnail($id) ){
							$post_thumbnail_id = get_post_thumbnail_id($id);
							$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-carousel' ); ?>

				    	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				    		<img src="<?php echo $featured_src[0]; ?>" alt="<?php the_title_attribute(); ?>" style="width:auto; height: 100%; max-width:none;" >
				    	</a>
					<?php }	?>
				   	<div class="carousel-caption jumbotron">

		                <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
		                <p>
		                	<?php
		                		///$excerpt_length = 100; // length of excerpt to show (in characters)
		                		$the_excerpt = get_the_excerpt();
		                		if($the_excerpt != ""){
		                			//$the_excerpt = substr( $the_excerpt, 0, $excerpt_length );
		                			echo $the_excerpt;
		                	} ?>

		                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="btn btn-xs btn-primary">Read more &rsaquo;</a></p>
	                </div>
			    </div>

			    <?php endforeach; ?>
				<?php $post = $tmp_post; ?>

			    </div>

			    <!-- Carousel nav -->
			    <a class="carousel-control left" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
			    <a class="carousel-control right" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>

			    <!-- Indicators -->
				<ol class="carousel-indicators">
				<?php for ($c=0;$c<$post_num;$c++){ ?>
			    	<li data-target="#myCarousel" data-slide-to="<?php echo $c; ?>"<?php if ($c==0) echo 'class="active"'; ?>></li>
			    <?php } ?>
				</ol>
		    </div>

		</div> <!-- container for carousel -->
		<script>
			jQuery(window).on('load resize', function(){
			    jQuery('#myCarousel .item').each(function() {
			    	jQuery(this).width(jQuery(window).width());
					//jQuery(this).height(jQuery(window).width()/<?php echo $carousel_height_ratio; ?>);
					jQuery(this).height(jQuery(window).height() - jQuery('.navbar').height());
					jQuery(this).find('img').height('100%');
			    });
			});
		</script>
<?php endif; // end carousel ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php
		$post_thumbnail_id = get_post_thumbnail_id();
		$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-home' );
		$jumbotron_contents = get_post_meta($post->ID, 'jumbotron_contents' , true);
		$jumbotron_bg_color = get_post_meta($post->ID, 'jumbotron_bg_color' , true);
		$jumbotron_bg_image = get_post_meta($post->ID, 'jumbotron_bg_image' , true);

		$sidebar_position = get_post_meta($post->ID, 'sidebar_position' , true);
		$sidebar_widget_group = get_post_meta($post->ID, 'sidebar_widgets' , true);
		$hide_empty_sidebar = $wheniwasbad_options['hide_widgets'];
		if ( ! is_active_sidebar($sidebar_widget_group) && $hide_empty_sidebar) {
			$main_class = "col-xs-12";
			$sidebar_class = "";
		} else {
			if ( $sidebar_position == 'left' ) {
				$main_class = "col-xs-12 col-sm-9 col-sm-push-3";
				$sidebar_class = "col-xs-12 col-sm-3 col-sm-pull-9";
			} elseif ( $sidebar_position == 'right' ) {
				$main_class = "col-xs-12 col-sm-9";
				$sidebar_class = "col-xs-12 col-sm-3";
			}
		}

	?>

	<?php if ($jumbotron_contents != ''): ?>

		<?php
			if ($jumbotron_bg_image) {
				$jumbotron_style = 'style="background-image: url(\'' . wp_get_attachment_url($jumbotron_bg_image) . '\'); background-repeat: no-repeat; background-position: 0 0; background-size: cover;\'"';
			} elseif ($jumbotron_bg_color) {
				$jumbotron_style = 'style="background-color: ' . $jumbotron_bg_color . '"';
			}
		?>

		<div class="jumbotron" <?php echo $jumbotron_style; ?>>

			<?php echo $jumbotron_contents;?>

		</div>

	<?php endif; ?>

	<?php
		$display_page_title = get_post_meta( get_the_id(), 'display_page_title', false );
		$display_page_meta = get_post_meta( get_the_id(), 'display_page_meta', false );
	?>

	<?php if ( $display_page_title ) : ?>

			<div class="container clearfix">

				<header class="page-header">

					<h1><?php single_post_title(); ?></h1>

					<?php if ( $display_page_meta ) get_template_part('postmeta-horizontal'); ?>

				</header> <!-- end page header -->

			</div>

	<?php endif;?>

	<?php /* add the contents of additional pages */
		$additional_pages = get_post_meta( get_the_id(), 'homepage_additional_pages_above', false );
		foreach ($additional_pages as $addon_page_id) {
			$addon_page = get_post($addon_page_id);
			//echo "<div class='container'>\n";
			//echo "<h1>" . $addon_page->post_title . "</h1>\n";
			echo "<div class='pull-left'>";
			echo edit_post_link("Edit <span class='glyphicon glyphicon-edit'></span>",'','',$addon_page_id) . "</div>\n";
			echo $addon_page->post_content . "\n";
			//echo "</div>\n";
		}
	?>

	<div class="container clearfix">

		<div class="row clearfix">

			<section id="main" class="<?php echo $main_class; ?> clearfix" role="main">

				<?php get_template_part( 'content' ); ?>

				<!-- blog posts -->
				<?php
					$args = 'post_type=post';
					$pinterest_taxonomy = get_post_meta( get_the_id(), 'pinterest_taxonomy', true );
					$pinterest_args = get_post_meta( get_the_id(), 'pinterest_args', true );
					if ($pinterest_args != '') {
						$args .= '&'.$pinterest_args;
					}
					if (is_array($pinterest_taxonomy)) {
						$pinterest_taxonomies = implode(',',$pinterest_taxonomy);
						$args .= '&cat=' . $pinterest_taxonomies;
					}
					$pinterest_query = new WP_Query( $args );

					$shuffle_id = 'shuffle_'.rand();

				?>

				<div class="col-xs-12"><div class='row'>

					<div id='<?php echo $shuffle_id; ?>' class='shuffle-container clearfix'>

					<div class='col-xs-1 shuffle__sizer'></div>

					<?php while ( $pinterest_query->have_posts() ) : $pinterest_query->the_post(); ?>

						<?php
						$col_span = 'col-xs-12 col-sm-6 col-md-4 col-lg-3';
						if (get_post_format() == 'video' ){// || has_post_thumbnail() ){
							$col_span = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
						}

						$categories = wp_get_object_terms($id,'category');
						$cat_list = array_map(create_function('$a', 'return $a->name;'), $categories);
						$cat_list = htmlentities(json_encode($cat_list),ENT_QUOTES);

						?>

						<div class="<?php echo $col_span; ?> shuffle-brick" data-groups='<?php echo $cat_list; ?>'>

							<div class='shuffle-brick-inner'>

								<?php //if ( has_post_thumbnail()) : ?>

									<div class='shuffle-brick-image'>

<?php if ( has_post_thumbnail() ) {

			//$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), "thumbnail");
			//$image_url = $image_url[0];

			echo get_the_post_thumbnail($post->ID, 'thumbnail', array('class' => 'shuffle-brick-thumb'));

		} else {

			$image_url = get_template_directory_uri() . "/library/images/placeholder.jpg";
			echo "<img src='" . $image_url ."' alt='" . the_title_attribute("echo=0") . "' class='shuffle-brick-thumb' />";

		} ?>
									<?php //echo get_the_post_thumbnail($post->ID, 'thumbnail', array('class' => 'shuffle-brick-thumb')); ?>

										<div class='shuffle-brick-content-wrapper'>

											<div class='shuffle-brick-content'>

												<div class='shuffle-brick-inner'>

													<a href='<?php the_permalink(); ?>' title="<?php the_title_attribute(); ?>" class='circle-icon-link'>

														<span class='circle-icon circle-icon-100 circle-icon-primary'>

															<span class='glyphicon glyphicon-play'></span>

														</span>

													</a>

												</div>

											</div>

										</div>

									</div>

								<?php //endif; ?>

								<div class='shuffle-brick-caption'>

									<h3><a href='<?php the_permalink(); ?>' title='<?php the_title_attribute(); ?>' class='shuffle-brick-title'><?php echo get_the_title(); ?></a></h3>

									<?php the_excerpt(); ?>

								</div>

								<div class='shuffle-brick-footer'>

									<time datetime='<?php echo get_the_time(DATE_W3C); ?>'><?php echo get_the_time(get_option('date_format')); ?></time>

									<span class='shuffle-brick-footer-link'>

										<a href='<?php echo the_permalink(); ?>'><span class='glyphicon glyphicon-link'></span></a>

									</span>

									<?php if ( comments_open() && get_comments_number() ) : ?>

										<span class='shuffle-brick-footer-link'>

											<span class='glyphicon glyphicon-comment'></span><?php echo get_comments_number(); ?>&nbsp;

										</span>

									<?php endif; ?>

								</div>

							</div>

						</div>

					<?php endwhile; ?>

					<?php wp_reset_query(); ?>

					</div>

				</div></div>

			</section> <!-- end main -->

			<?php if ($sidebar_class != ''): ?>

				<section class="<?php echo $sidebar_class; ?> clearfix">

					<?php get_sidebar($sidebar_widget_group); ?>

				</section>

			<?php endif; ?>

		</div> <!-- row -->
	</div> <!-- container -->

	<?php /* add the contents of additional pages */
		$additional_pages = get_post_meta( get_the_id(), 'homepage_additional_pages_below', false );
		foreach ($additional_pages as $addon_page_id) {
			$addon_page = get_post($addon_page_id);
			//echo "<div class='container'>\n";
			//echo "<h1>" . $addon_page->post_title . "</h1>\n";
			echo edit_post_link("Edit",'','',$addon_page_id) . "\n";
			echo $addon_page->post_content . "\n";
			//echo "</div>\n";
		}
	?>

<?php endwhile; ?>

<?php else : ?>

	<?php not_found(); ?>

<?php endif; ?>

</div> <!-- end #content -->

<script type='text/javascript'>
	jQuery( document ).ready( function($) {
		var grid = $('#<?php echo $shuffle_id; ?>'),
			sizer = grid.find('.shuffle__sizer');
		grid.shuffle({
			itemSelector: '.shuffle-brick',
			sizer: sizer
		});
	});

</script>

<?php get_footer(); ?>