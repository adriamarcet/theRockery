<?php Starkers_Utilities::get_template_parts( array( 
'parts/shared/html-header', 
'parts/shared/header', 
'parts/shared/music-menu' ) 
); ?>
<?php if (have_posts()) : ?>	
<h1 class="title__category" ><?php single_cat_title( $prefix = 'Toda la música de ', $display = true ); ?></h1>
<?php endif; ?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/list__music' ) ); ?>
<a href="<?php echo get_post_type_archive_link( 'recetas' ); ?>" class="btn btn__primary">Más recetas</a>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>