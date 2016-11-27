<header class="title-bar">

	<ul class="menu menu__subcategories h-list-row">
		<?php 
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
		if ($term->parent == 0) {  
			wp_list_categories('taxonomy=recetas_cat&depth=1&&title_li=&child_of=' . $term->term_id);
		} else {
			wp_list_categories('taxonomy=recetas_cat&&title_li=&child_of=' . $term->parent);	
		}
		?>

		<?php
			// Calling from functions.php to retrieve sub-categories
			// echo wt_get_child_terms( $post->ID, 'recetas_cat', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
		?>		
	</ul>
	
	<div class="title-bar__content">
		<h2>
		<?php 
			$termDesc = term_description($term_id, $taxonomy); 
			if( $termDesc) { 
				echo wp_strip_all_tags( $termDesc );
			}else { 
				?>
				<span class="title-bar__long-desc">Todas las entradas con la categoría <span class="title-bar__long-desc--highlight"> <?php echo single_cat_title(); ?> </span> </span>
				<?php
			};
		?>
		</h2>
	</div>
</header>