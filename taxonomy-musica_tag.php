<?php Starkers_Utilities::get_template_parts( array( 
'parts/shared/html-header', 
'parts/shared/header', 
'parts/shared/music-menu' ) 
); ?>
<?php if (have_posts()) : ?>
	<div class="title-bar">
		
		<div class="title-bar__content">
			<h2>
			<?php 
				$termDesc = term_description($term_id, $taxonomy); 
				if( $termDesc) { 
					echo wp_strip_all_tags( $termDesc );
				}else { 
					?>
					<span class="title-bar__long-desc">Todas las entradas con la etiqueta <span class="title-bar__long-desc--highlight"> <?php echo single_cat_title(); ?> </span> </span>
					<?php
				};
			?>
			</h2>
		</div>
	</div>	
<?php endif; ?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/list__music' ) ); ?>
<a href="<?php echo get_post_type_archive_link( 'recetas' ); ?>" class="btn btn__primary">Más recetas</a>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>