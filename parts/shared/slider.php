<div class="slider">

	<div class="slider__mainImg" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>'); "><?php the_post_thumbnail(full, array('itemprop' => 'image')); ?></div>
	<?php if(get_field('galeria_de_imagenes')): ?>
		<ul class="slider__extraImg">
			<li>
				<?php the_post_thumbnail(thumb); ?>
			</li>
		<?php while(the_repeater_field('galeria_de_imagenes')): 
			$thumbs = get_sub_field('gallery_image'); ?>
			<li><img src="<?php echo $thumbs['url']; ?>" alt="<?php echo $thumbs['alt'] ?>" /></li>	
		<?php endwhile; ?>
		</ul>
	<?php endif; ?>
</div>