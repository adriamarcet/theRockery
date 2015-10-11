<?php 
	//Calling the image src attr
	$thumb_id = get_post_thumbnail_id();
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
	$thumb_url = $thumb_url_array[0];

	$custom = get_post_custom($post->ID); 
?>
<div class="card">
	<a href="<?php the_permalink() ?>" class="card__picture" style=" background-image: url('<?php echo $thumb_url; ?>'); ">
		<?php the_post_thumbnail(); ?>
	</a>
	<div class="card__text">
		<h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
		<h2><?php the_field('subtitulo'); ?></h2>
	</div>
</div>