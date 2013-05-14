	<aside class="entry-meta muted">
		<p><i class="icon-calendar"></i> <time datetime="<?php the_time(get_option('date_format')); ?>" pubdate><?php the_time(get_option('date_format')); ?></time></p>
		<?php if ( comments_open() ) : ?>
		<p><i class="icon-comment"></i> <?php comments_popup_link( __("Leave a comment","bonestheme"), __( "One Comment", "bonestheme"), __( "% Comments", "bonestheme" ) ); ?></p>
		<?php endif; // comments_open() ?>
		<?php if ( ! is_page() ) : ?>
		<p><i class="icon-folder-close"></i> <span class="muted"> <?php the_category(", "); ?></span></p>
		<p><i class="icon-tags"></i>
		<?php
		$posttags = get_the_tags();
		if ( $posttags ) :
			foreach ( $posttags as $tag ) :
				$tag_link = get_tag_link( $tag->term_id ); ?>
				<a href="<?php echo $tag_link; ?>" title="<?php echo $tag->name; ?> Tag" class="label"><?php echo $tag->name; ?></a>
			<?php endforeach;
		else :
			_e("Not Tagged","bonestheme");
		endif; ?>
		</p>
		<?php endif; ?>
		<?php edit_post_link( __( 'Edit', 'bonestheme' ), '<p class="edit-link">', '</p>' ); ?>
	</aside>