<footer id="page-footer" role="contentinfo">

	<div id="inner-footer" class="container clearfix">

		<div id="widget-footer" class="row clearfix">

			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
			<?php endif; ?>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
			<?php endif; ?>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
			<?php endif; ?>

		</div>

		<?php global $wheniwasbad_options; ?>
		<?php if ($wheniwasbad_options['show_footer_menu'] ) : ?>
			<nav class="clearfix">
				<?php footer_links(); ?>
			</nav>
		<?php endif; ?>

		<?php if ($wheniwasbad_options['opt-footer-text']=="") :

			echo $wheniwasbad_options['opt-footer-text'];

		endif; ?>

		</div> <!-- end #inner-footer -->

	</footer> <!-- end footer -->

<?php wp_footer(); ?>

</body>

</html>