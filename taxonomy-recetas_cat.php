<?php Starkers_Utilities::get_template_parts( array( 
'parts/shared/html-header', 
'parts/shared/header', 
'parts/shared/food-menu' ) 
); ?>
<?php if (have_posts()) : ?>	
<section>
	<h1 class="title__category">
		<?php 
			$termDesc = term_description($term_id, $taxonomy); 
			if( $termDesc) { 
				echo wp_strip_all_tags( $termDesc );
			}else { 
				single_cat_title( $prefix = 'Todas las recetas de la categoría ', $display = true ); 
			};
		?>
	</h1>
	<?php endif; ?>
	<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/list__food' ) ); ?>
	<a href="<?php echo get_post_type_archive_link( 'recetas' ); ?>" class="btn btn__primary">Más recetas</a>
</section>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>