<?php 
if (! is_home() && ! is_front_page() ){
$author = get_the_author();
$author = ($author == '') ? get_the_author_meta('user_nicename') : $author;
?>

<div class="entry-meta muted pull-right">
		<i class="icon-pencil"></i> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo $author; ?></a>&nbsp;&bull;&nbsp;
		<i class="icon-bookmark"></i> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="bookmark">Permalink</a>
		<?php edit_post_link( __( 'Edit', 'bonestheme' ), ' &nbsp;&bull;&nbsp; ', '' ); ?></p>
	<?php if ( comments_open() && get_comments_number() ) : ?>
		&nbsp;&bull;&nbsp;<i class="icon-comment"></i> <?php comments_popup_link( __("Leave a comment","bonestheme"), __( "One Comment", "bonestheme"), __( "% Comments", "bonestheme" ) ); ?>
	<?php endif; // comments_open() ?>
</div>
<?php } ?>