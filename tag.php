<?php
/**
 * The template used to display Tag Archive pages
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<section>
	<?php if ( have_posts() ): ?>
	<h1 class="title__category">Entradas con la etiqueta: <?php echo single_tag_title( '', false ); ?></h1>
	<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/list' ) ); ?>

	<?php else: ?>
	<h1 class="title__category">No hay entradas con la categoria: <?php echo single_tag_title( '', false ); ?></h1>
	<?php endif; ?>
</section>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>