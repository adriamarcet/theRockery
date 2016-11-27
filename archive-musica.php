<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts() 
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/music-menu' ) ); ?>

<?php if ( have_posts() ): ?>
	<header class="title-bar">
		<h1 class="title-bar__content">Aquí tienes toda la música ¡a disfrutar!</h1>
	</header>
		<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/list__music' ) ); ?>
	<a href="<?php echo get_post_type_archive_link( 'recetas' ); ?>" class="btn btn__primary">Más recetas</a>
<?php else: ?>
<h2 class="title-bar__content">Estamos preparando más contenido, ya queda menos.</h2>	
<?php endif; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>