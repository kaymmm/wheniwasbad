<?php get_header(); ?>
			
	<div id="content" class="container clearfix">

		<header class="page-header">

			<?php
			global $wp_query;
			$total_results = $wp_query->found_posts;
			?>

		    <h3 class="search_title h2">
		    	<?php echo __('Search Found ','bonestheme') . $total_results . __(' Matches for "','bonestheme') . '<em>' . get_search_query() . __('"','bonestheme'); ?>
		    </h3>
			
		</header> <!-- page header -->
			
		<div id="main" class="row-fluid clearfix" role="main">
							
			<?php get_sidebar(); // sidebar 1 ?>
				
			<div class="span9">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
					<?php get_template_part( 'content', get_post_format() ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>
				<?php wp_link_pages( $args ); ?>
				<?php if (function_exists('page_navi')) : // if expirimental feature is active ?>
			
					<?php page_navi(); // use the page navi function ?>

				<?php else : // if it is disabled, display regular wp prev & next links ?>
					<nav class="wp-prev-next">
						<ul class="clearfix">
							<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
							<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
						</ul>
					</nav>
				<?php endif; ?>
			<?php else : ?>

				<h3><?php _e('Sorry, there was nothing found matching those search terms.','bonestheme'); ?></h3>
		
			<?php endif; ?>
				
				<?php
				$sf = get_search_form(false);
				$sf = str_replace( '"form-search">','"form-search" style="margin: 18px 0;">',$sf);
				$sf = str_replace( 'input-small', 'input-xlarge',$sf );
//				$sf = str_replace( '<input type="text"','<div class="controls"><input type="text"',$sf);
//				$sf = str_replace( '</button>','</div></button>',$sf);
				?>
				<div class="well row-fluid clearfix">
					<div class="span6 text-right"><h3>Search the site again:</h3></div>
					<div class="span6"><?php echo $sf; ?></div>
				</div>

			</div><!-- span9 articles -->

		</div><!-- #main -->
		
	</div> <!-- end #content -->

<?php get_footer(); ?>