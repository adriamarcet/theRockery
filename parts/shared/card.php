<?php 
	//Calling the image src attr
	$thumb_id = get_post_thumbnail_id();
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, array(640, ), false);
	$thumb_url = $thumb_url_array[0];

	$custom = get_post_custom($post->ID); 
?>
<div class="card">
	<a href="<?php the_permalink() ?>" class="card__picture" style=" background-image: url('<?php echo $thumb_url; ?>'); "></a>
	<div class="card__text">
		<h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
		<h2><?php the_field('subtitulo'); ?></h2>
	</div>

	<?php // Showing EASY tag
	$terms = get_the_terms( $post->ID, 'recetas_tag' );

	if ( $terms && ! is_wp_error( $terms ) ) : 

		foreach ( $terms as $term ) {

			if( $term->name == "fácil" ) {
				//do something when is this tag
				if( is_post_type_archive('recetas') ){
					//do something if is not archive when is that tag ??
					echo '<a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'Clic aquí para ver todas las recetas %ses de hacer', '' ), $term->name ) . '" class="sticker">' . $term->name . '</a>';
				}else{
					echo '<span class="sticker">' . $term->name . '</span>';
				}			
			}else{
			// Trying to retrieve a list of tags, except when is tag archive for that term
			// 	echo '<a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'Clic aquí pare ver todas las ecetas con la etiqueta %s', '' ), $term->name ) . '" class="card__tag">' . $term->name . '</a>';
			}
		}

	endif;
	?>
</div>