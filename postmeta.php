<?php 
$avatar_class = ' pull-right';
$extra_classes = '';
$icon = 'icon-star';
$label_class = 'label-as';
if (is_page_template('page-right-sidebar.php')) {
	$extra_classes = ' text-right';
	$avatar_class = ' pull-left';
}

$post_format = get_post_format();
if (is_sticky()) {
	$icon='icon-pushpin';
	$label_class='label-important';
} else {
switch ($post_format) {
	case 'aside': 
		$icon='icon-pushpin';
		$label_class='label-warning';
		break;
	case 'gallery':
		$label_class='label-orange';
		$icon='icon-camera';
		break;
	case 'image': 
		$label_class='label-info';
		$icon='icon-picture';
		break;
	case 'link':
		$label_class='label-inverse';
		$icon='icon-link';
		break;
	case 'quote': 
		$label_class='label-success';
		$icon='icon-quote-right';
		break;
	case 'status': 
		$label_class='label-purple';
		$icon='icon-info-sign';
		break;
	case 'attachment':
		$label_class='label-inverse';
		$icon='icon-paper-clip';
		break;
	case 'post':
	default:
		if (is_attachment()) {	
			$label_class='label-inverse';
			$icon='icon-paper-clip';
		} elseif (!is_page()) { //other edge cases or default post
			$icon='icon-pencil';
		}
	} //switch 
}

	$author = get_the_author();
	$author = ($author == '') ? get_the_author_meta('user_nicename') : $author;
	?>

	<aside class="entry-meta muted<?php echo $extra_classes; ?>">
	<?php if (is_singular()): ?>
		<span class="avatar-head<?php echo $avatar_class; ?>"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
			<?php echo bs_get_avatar(get_the_author_meta('ID'),'80','',$author,$class='img-circle'); ?>
		</a></span>
	<?php endif; ?>
		<p><span class="label <?php echo $label_class; ?>"><i class="<?php echo $icon; ?>"></i></span> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo $author; ?></a></em></p>
	<?php if ( ! is_page() ) : ?>
		<p><i class="icon-calendar-empty"></i> <time datetime="<?php the_time(get_option('date_format')); ?>" pubdate><?php the_time(get_option('date_format')); ?></time></p>
	<?php endif; ?>
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