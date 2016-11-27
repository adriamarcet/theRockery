<?php Starkers_Utilities::get_template_parts( array( 
'parts/shared/html-header', 
'parts/shared/header', 
'parts/shared/food-menu' ) 
); ?>

<?php if (have_posts()) : ?>	
<section>
	<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/title-bar' ) ); ?>
	<?php endif; ?>
	<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/list__food' ) ); ?>
	<a href="<?php echo get_post_type_archive_link( 'recetas' ); ?>" class="btn btn__primary">Más recetas</a>
</section>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>