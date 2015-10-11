<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file 
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<section class="section section__food">	
<h2 class="hidden">Recetas</h2>	
	<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/food-menu' ) ); ?>
	<?php query_posts(array(
		'post_type' => 'recetas', 
		'order'=>'DESC',
		'showposts' => '6'
	)); ?>

	<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/list__food' ) ); ?>
	<a href="<?php echo get_post_type_archive_link( 'recetas' ); ?>" class="btn btn__primary">Más recetas</a>
</section>

<section class="section section__music">
<h2 class="hidden">Música</h2>
	<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/music-menu' ) ); ?>

	<?php query_posts(array(
		'post_type' => 'musica', 
		'order'=>'DESC',
		'showposts' => '6'
	)); ?>
	<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/list__music' ) ); ?>
	<a href="<?php echo get_post_type_archive_link( 'musica' ); ?>" class="btn btn__primary">Más música</a>
</section>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>