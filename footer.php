		<footer id="page-footer" role="contentinfo">
	
			<div id="inner-footer" class="container clearfix">

	          <div id="widget-footer" class="row-fluid clearfix">

	            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
	            <?php endif; ?>
	            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
	            <?php endif; ?>
	            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
	            <?php endif; ?>
	          </div>

			<?php if (of_get_option('show_footer_menu')) : ?>				
				<nav class="clearfix">
					<?php bones_footer_links(); // Adjust using Menus in Wordpress Admin ?>
				</nav>
			<?php endif; ?>
		
				<?php if (of_get_option('footer_text')=="") : ?>

					<p class="attribution">&copy; <?php bloginfo('name'); ?></p>

				<?php else:
				
					echo of_get_option('footer_text');
			
				endif; ?>
						
			</div> <!-- end #inner-footer -->
		
		</footer> <!-- end footer -->
			
		<!--[if lt IE 7 ]>
			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
	
		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>