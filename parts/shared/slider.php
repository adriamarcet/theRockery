<?php
$img_src = wp_get_attachment_image_url( get_post_thumbnail_id( $post_id ), 'full-size' );
$img_srcset = wp_get_attachment_image_srcset( get_post_thumbnail_id( $post_id ), 'full-size' );
?>


<div class="slider">
	
	<input type="radio" name="radio-btn" id="slider__image--0" checked />
	<img
		src="<?php echo esc_url( $img_src ); ?>"
		srcset="<?php echo esc_attr( $img_srcset ); ?>"
		sizes="(max-width:480px) 480px, (max-width: 640px) 640px, 540px" 
		alt="<?php echo $thumbs['alt'] ?>" 
		title="<?php echo $thumbs['title'] ?>"
	>

	<?php if(get_field('galeria_de_imagenes')): ?>
	<?php
		$i = 1;
		while(the_repeater_field('galeria_de_imagenes')):

		$thumb = get_sub_field('gallery_image'); 
		$slide_src = wp_get_attachment_image_url( $thumb['id'], 'full-size' );
		$slides_srcset = wp_get_attachment_image_srcset(  $thumb['id'], 'full-size' );
	?>
	<input type="radio" name="radio-btn"  id="slider__image--<?php echo $i; ?>" />
	<img
		src="<?php echo esc_url( $img_src ); ?>"
		srcset="<?php echo esc_attr( $slides_srcset ); ?>"
		sizes="(max-width:480px) 480px, (max-width: 640px) 640px, 540px" 
		alt="<?php echo $thumbs['alt'] ?>" 
		title="<?php echo $thumbs['title'] ?>"
	>
	<?php 
		$i++;
		endwhile;
	?>

	<!-- thumbs -->
	<ul class="slider__extra-images">
		<!-- thumb for the first image -->
		<li class="slider__extra-images--thumb">
			<label for="slider__image--0" class="slider__extra-images--thumbnail" id="img-dot-0">
				<img
					src="<?php echo esc_url( $img_src ); ?>"
					srcset="<?php echo esc_attr( $img_srcset ); ?>"
					sizes="250px" 
					alt="<?php echo $thumbs['alt'] ?>" 
					title="<?php echo $thumbs['title'] ?>"
				>
			</label>
		</li>
	<?php
	$i = 1;
	while(the_repeater_field('galeria_de_imagenes')):

		$thumb = get_sub_field('gallery_image'); 

		$slide_src = wp_get_attachment_image_url( $thumb['id'], 'full-size' );
		$slides_srcset = wp_get_attachment_image_srcset(  $thumb['id'], 'full-size' );
	?>
		<li class="slider__extra-images--thumb">
			<label for="slider__image--<?php echo $i; ?>" class="slider__extra-images--thumbnail" id="img-dot-<?php echo $i; ?>">
				<img
					src="<?php echo esc_url( $img_src ); ?>"
					srcset="<?php echo esc_attr( $slides_srcset ); ?>"
					sizes="250px" 
					alt="<?php echo $thumbs['alt'] ?>" 
					title="<?php echo $thumbs['title'] ?>"
				>
			</label>
		</li>
	<?php 
	$i++;
	endwhile;
	?>
	</ul>

		<?php
	endif; ?>
</div>