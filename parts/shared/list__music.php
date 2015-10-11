<?php 
if (have_posts()) : ?>
	<ul class="list list__music">
	
	<?
	/* Start the Loop */
	while (have_posts()) : the_post(); 
	
	//Calling the image src attr
	$thumb_id = get_post_thumbnail_id();
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
	$thumb_url = $thumb_url_array[0];
	?>

		<li>
			<article>
				<?php $custom = get_post_custom($post->ID); ?>
				<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/card' ) ); ?>
			</article>
		</li>
		<?php endwhile; ?>
	</ul>

	<?php else: ?>
	<h1 class="title__category">Todavía estamos ensayando, vuelve pronto :)</h1>
<?php endif; ?>
