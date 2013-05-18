	<aside class="entry-meta muted">
		<?php
		$post_format = get_post_format();
		switch ($post_format) {
			case 'aside': ?>
				<p class="label label-postformat label-warning"><i class="icon-pushpin label-postformat"></i></p>
				<?php break;
			case 'gallery':  ?>
				<p class="label label-postformat label-orange"><i class="icon-camera-retro label-postformat"></i></p>
				<?php break;
			case 'image': ?>
				<p class="label label-postformat label-info"><i class="icon-picture label-postformat"></i></p>
				<?php break;
			case 'link': ?>
				<p class="label label-postformat label-inverse"><i class="icon-link label-postformat"></i></p>
				<?php break;
			case 'quote': ?>
				<p class="label label-postformat label-success"><i class="icon-quote-right label-postformat"></i></p>
				<?php break;
			case 'status': ?>
				<p class="label label-postformat label-purple"><i class="icon-info-sign label-postformat"></i></p>
				<?php break;
			case 'attachment': ?>
				<p class="label label-postformat label-inverse"><i class="icon-paper-clip label-postformat"></i></p>
				<?php break;
			case 'post':
			default: ?>
				<p class="label label-postformat"><i class="icon-pencil"></i></p>
		<?php }
			
		?>
		<p><i class="icon-calendar-empty"></i> <time datetime="<?php the_time(get_option('date_format')); ?>" pubdate><?php the_time(get_option('date_format')); ?></time></p>
		<p><i class="icon-bookmark"></i> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="bookmark">Permalink</a>
		<?php edit_post_link( __( 'Edit', 'bonestheme' ), ' &nbsp;&bull;&nbsp; ', '' ); ?></p>
		<?php if ( comments_open() && get_comments_number() ) : ?>
		<p><i class="icon-comment"></i> <?php comments_popup_link( __("Leave a comment","bonestheme"), __( "One Comment", "bonestheme"), __( "% Comments", "bonestheme" ) ); ?></p>
		<?php endif; // comments_open() ?>
		<?php if ( ! is_page() && ! is_attachment() ) : ?>
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
	</aside>