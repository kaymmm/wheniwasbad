<?php get_header(); ?>
			
	<div id="content" class="clearfix container">

		<header>

			<div class="hero-unit">
		
				<h1><?php _e("404 - Oops!","bonestheme"); ?></h1>
			
				<p><?php _e("This is embarassing. We can't find what you were looking for.","bonestheme"); ?></p>
										
			</div>
								
		</header> <!-- end article header -->
	
		<div id="wrapper" class="row-fluid clearfix">
				
					<div class="span3">	
			<?php get_sidebar(); // sidebar 1 ?>
		</div>
			
			<div id="main" role="main" class="span9">

				<article id="post-not-found" class="clearfix">
							
					<section class="post_content">
					
						<p><?php _e("Whatever you were looking for was not found, but maybe try looking again or search using the form below.","bonestheme"); ?></p>

						<?php get_search_form(); ?>
			
					</section> <!-- end article section -->
			
				</article> <!-- end article -->

			</div>
	
		</div> <!-- end #main -->

	</div> <!-- end #content -->

<?php get_footer(); ?>