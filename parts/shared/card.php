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
	
	<?php
		$terms = get_the_terms( $post->ID, 'recetas_cat' );
		if ( $terms && ! is_wp_error( $terms ) ) : 
			
			foreach ( $terms as $term ) {

				if( $term->name == "fácil") {
					echo '<a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'Clic aquí para ver todas las recetas %ses de hacer', '' ), $term->name ) . '" class="sticker">' . $term->name . '</a>';
				}
			}

		endif;
	?>
</div>