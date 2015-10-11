<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<h2><?php the_title(); ?></h2>

<?php the_content(); ?>

	<?php if(get_field('galeria_de_imagenes')): ?>
		<div id="slider">
		<?php while(the_repeater_field('galeria_de_imagenes')): $i++; if( $i > 1 ) { break; } 
			$image = get_sub_field('gallery_image');
		?>
			<a href="#"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" /></a>
		<?php endwhile; ?>
		
		<?php while(the_repeater_field('galeria_de_imagenes')): 
			$image = get_sub_field('gallery_image');
		?>
			<a href="#"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" /></a>
		<?php endwhile; ?>

		</div>
		
		<!-- 
		<div id="thumbs">
			<?php while(the_repeater_field('galeria_de_imagenes')): ?>
				<?php $image = wp_get_attachment_image_src(get_sub_field('gallery_image'), 'large' ); ?>
				<a href="<?php echo $image[0]; ?>"><img src="<?php echo $image[0]; ?>" alt="<?php the_sub_field('texto_de_la_imagen');?>" rel="<?php echo $thumb[0]; ?>" /></a>
			<?php endwhile; ?>
		</div>
		-->

	<?php endif; ?>



<?php comments_template( '', true ); ?>
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>