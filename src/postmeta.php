<?php 
$avatar_class = ' pull-right';
$extra_classes = '';
$icon = 'glyphicon glyphicon-star';
$label_class = 'label-as';
if (is_page_template('page-right-sidebar.php')) {
	$extra_classes = ' text-right';
	$avatar_class = ' pull-left';
}

$post_format = get_post_format();
if (is_sticky()) {
	$icon='glyphicon glyphicon-pushpin';
	$label_class='label-important';
} else {
switch ($post_format) {
	case 'aside': 
		$icon='glyphicon glyphicon-pushpin';
		$label_class='label-warning';
		break;
	case 'gallery':
		$label_class='label-orange';
		$icon='glyphicon glyphicon-camera';
		break;
	case 'image': 
		$label_class='label-info';
		$icon='glyphicon glyphicon-picture';
		break;
	case 'link':
		$label_class='label-inverse';
		$icon='glyphicon glyphicon-link';
		break;
	case 'quote': 
		$label_class='label-success';
		$icon='glyphicon glyphicon-quote-right';
		break;
	case 'status': 
		$label_class='label-purple';
		$icon='glyphicon glyphicon-info-sign';
		break;
	case 'attachment':
		$label_class='label-inverse';
		$icon='glyphicon glyphicon-paper-clip';
		break;
	case 'video':
		$label_class='label-important';
		$icon='glyphicon glyphicon-facetime-video';
		break;
	case 'audio':
		$label_class='label-warning';
		$icon='glyphicon glyphicon-microphone';
		break;		
	case 'post':
	default:
		if (is_attachment()) {	
			$label_class='label-inverse';
			$icon='glyphicon glyphicon-paper-clip';
		} elseif (!is_page()) { //other edge cases or default post
			$icon='glyphicon glyphicon-pencil';
		}
	} //switch 
}

	$author = get_the_author();
	$author = ($author == '') ? get_the_author_meta('user_nicename') : $author;
	?>

	<aside class="entry-meta muted<?php echo $extra_classes; ?>">
	<?php if (is_singular()): ?>
		<?php if (has_post_thumbnail()) {
		   $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
		   echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" class="thumbnail">';
		   echo get_the_post_thumbnail($post->ID, 'thumbnail',array('class' => 'img-thumbnail')); 
		   echo '</a>';
		 }?>
		
		<span class="avatar-head<?php echo $avatar_class; ?>"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
			<?php echo bs_get_avatar(get_the_author_meta('ID'),'80','',$author,$class='img-circle'); ?>
		</a></span>
	<?php endif; ?>
		<p><span class="label <?php echo $label_class; ?>"><span class="<?php echo $icon; ?>"></span></span> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo $author; ?></a></p>
	<?php if ( ! is_page() ) : ?>
		<p><span class="glyphicon glyphicon-calendar"></span> <time datetime="<?php the_time(DATE_W3C); ?>" ><?php the_time(get_option('date_format')); ?></time></p>
	<?php endif; ?>
		<p><span class="glyphicon glyphicon-bookmark"></span> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="bookmark">Permalink</a>
		<?php edit_post_link( __( 'Edit', 'wheniwasbad' ), ' &nbsp;&bull;&nbsp; ', '' ); ?></p>
	<?php if ( comments_open() && get_comments_number() ) : ?>
		<p><span class="glyphicon glyphicon-comment"></span> <?php comments_popup_link( __("Leave a comment","wheniwasbad"), __( "One Comment", "wheniwasbad"), __( "% Comments", "wheniwasbad" ) ); ?></p>
	<?php endif; // comments_open() ?>
	<?php if ( ! is_page() && ! is_attachment() ) : ?>
		<p><span class="glyphicon glyphicon-folder-close"></span> <span class="muted"> <?php the_category(", "); ?></span></p>
		<p><span class="glyphicon glyphicon-tags"></span>
		<?php
		$posttags = get_the_tags();
		if ( $posttags ) :
			foreach ( $posttags as $tag ) :
				$tag_link = get_tag_link( $tag->term_id ); ?>
				<a href="<?php echo $tag_link; ?>" title="<?php echo $tag->name; ?> Tag" class="label label-default"><?php echo $tag->name; ?></a>
			<?php endforeach;
		else :
			_e("Not Tagged","wheniwasbad");
		endif; ?>
		</p>
	<?php endif; ?>
	</aside>