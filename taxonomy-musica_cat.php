<?php Starkers_Utilities::get_template_parts( array( 
'parts/shared/html-header', 
'parts/shared/header', 
'parts/shared/music-menu' ) 
); ?>
<section>
	<?php if (have_posts()) : ?>
	<h1 class="title__category" ><?php single_cat_title( $prefix = 'Todos los ', $display = true ); ?></h1>
	<?php endif; ?>
	<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/list__music' ) ); ?>
	<a href="<?php echo get_post_type_archive_link( 'musica' ); ?>" class="btn btn__primary">Más música</a>
</section>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>