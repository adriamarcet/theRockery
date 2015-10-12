<?php Starkers_Utilities::get_template_parts( array( 
'parts/shared/html-header', 
'parts/shared/header', 
'parts/shared/music-menu' ) 
); ?>
<?php if (have_posts()) : ?>
<div class="title__category">
	<h1><?php single_cat_title( $prefix = 'Toda nuestra música etiquetada como ', $display = true ); ?>.</h1>
	<?php $termDesc = term_description($term_id, $taxonomy); ?>
	<?php if( $termDesc) { ?>
		<p class="small"><?php echo wp_strip_all_tags( $termDesc ); ?></p>
	<?php } ?>
</div>
<?php endif; ?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/list__music' ) ); ?>
<a href="<?php echo get_post_type_archive_link( 'recetas' ); ?>" class="btn btn__primary">Más recetas</a>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>