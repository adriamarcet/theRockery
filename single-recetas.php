<?php Starkers_Utilities::get_template_parts( array( 
'parts/shared/html-header', 
'parts/shared/header', 
'parts/shared/food-menu' ) 
); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	

<!--?php echo get_the_term_list( $post->ID, 'recetas_categoria', 'categoria: ', ', ', '' ); ? --> 
<article class="article article__recipe" itemscope itemtype="http://schema.org/Recipe">

	<header class="article__header">
		<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/slider' ) ); ?>
		<h1 class="title" itemprop="name"><?php the_title(); ?></h1>
		<h2 class="subtitle" itemprop="description"><?php $sbtl = get_field( 'subtitulo', false, false ); echo $sbtl; ?></h2>
		<h3 class="creation">Por <span itemprop="author"><?php echo get_the_author() ; ?></span>, <?php echo '<time class="date" datetime="'.get_the_date('Y-m-d').'" itemprop="datePublished" content="'.get_the_date('c').'">'.get_the_date('j').''.' de '.get_the_date('F').' de '.get_the_date('Y').'</time>';?></h3>
	</header>
	<div class="group">
		<?php 
		// check if the flexible content field has rows of data
		if( have_rows('detalles_receta') ):
		echo '<section class="recipe__details grid-1-3">'; ?>
		<h4 class="hidden">Detalles de la receta</h4>
		<?php	
			// loop through the rows of data
			while ( have_rows('detalles_receta') ) : the_row();
			echo '<div>';

				if( get_row_layout() == 'numero_de_personas' ):
					$numPersonas = get_sub_field('num_personas');
					echo '<i class="i-peeps" title="Número de personas"></i><span class="small">Para '. $numPersonas .' personas</span>';

				elseif( get_row_layout() == 'numero_de_unidades' ): 
					$numUnidades = get_sub_field('num_unidades');
					echo '<i class="i-units" title="Número de unidades"></i><span class="small">'. $numUnidades .' unidades</span>';

				elseif( get_row_layout() == 'tiempo_de_preparacion' ): 
					$tPrep = get_sub_field('tiempo_preparacion');
					echo '<i class="i-prepTime" title="Tiempo de preparación"></i><span class="small"><meta property="prepTime" content="'. $tPrep.'">'. $tPrep .'</span>';

				elseif( get_row_layout() == 'tiempo_de_horneado' ): 
					$tPrepTotal = get_sub_field('tiempo_horneado');
					echo '<i class="i-ovenTime" title="Tiempo de horneado"></i><span class="small"><meta property="totalTime" content="'. $tPrepTotal.'">'. $tPrepTotal .'</span>';
				
				elseif( get_row_layout() == 'molde_forma_y_tamano' ): 
					$formaMolde = get_sub_field('forma_molde');
					echo '<span class="small">Molde: '. $formaMolde .'</span>';
					
					if( get_sub_field('tamano_molde') ):
						$tamanoMolde = get_sub_field('tamano_molde');
						echo '<span class="small"> de '. $tamanoMolde .'</span>';
					endif;
					
				elseif( get_row_layout() == 'cantidad' ): 
					$numCantidad = get_sub_field('numero_y_cantidad');
					echo '<span class="small">Cantidad: '. $numCantidad .'</span>';

				endif;

			echo '</div>';
			endwhile;
		echo '</section>';
		else :
		// no layouts found
		endif;
		?>
		
		<section class="article__part introduction grid-2-3">
			<h4 class="hidden">Introducción de la receta</h4>
			<?php the_field('introduccion'); ?>
		</section>

		<?php // check if the repeater field has rows of data 
		if( have_rows('grupo_de_ingredientes') ): ?>
			<section class="section article__part ingridients grid-1-3">

			<?php // loop through the rows of data
			while ( have_rows('grupo_de_ingredientes') ) : the_row(); ?>

				<h2 class="section__title"><?php the_sub_field('ingredientes_para'); ?></h2>
				<?php // check if the repeater field has rows of data 
				if( have_rows('lista_de_ingredientes') ): ?>
					<?php // loop through the rows of data
					echo '<ul>';
					while ( have_rows('lista_de_ingredientes') ) : the_row(); ?>
						<li itemprop="ingredients"><?php the_sub_field('ingrediente'); ?></li>
					<?php endwhile;
					echo '</ul>'; ?>
				<?php // no rows found 
				else :	 
				endif; ?>
			<?php endwhile; ?>
			
			</section>		
		<?php // no rows found 
			else :	 
		endif; ?>

		<?php if( get_field('elaboracion') ): ?>
		<section class="article__part recipe__directions grid-2-3">
			<h2 class="section__title">Elaboración</h2>				
			<div itemprop="recipeInstructions"><?php the_field('elaboracion'); ?></div>
		</section>
		<?php endif; ?>

		<?php if( get_field('consejos_y_recomendaciones') ): ?>
		<section class="article__part grid-1-3 recipe__notes">
			<h2 class="section__title">Notas y Consejos</h2>
			<?php the_field('consejos_y_recomendaciones'); ?>	
		</section>
		<?php endif; ?>

	</div>
</article><!-- closing the main article -->

<div class="advice print">
	<div>
		<a href="whatsapp://send?text= Comparto esta receta contigo a través de The Rockery: <?php the_permalink(); ?>" data-action="share/whatsapp/share" class="hide-med hide-large">Compartir por Whatsapp</a>
		<a href="javascript:window.print()" class="hide-small"><span class="tooltip" title="…o guardar como PDF">Imprime la receta</span></a> o 
		<?php 
		// check if there is a vertical image added and display it
		$verticalImage = get_field('imagenVertical');
		if( !empty($verticalImage) ): ?>
		<a href="https://www.pinterest.com/pin/create%2Fbutton/?url=<?php echo $verticalImage['url']; ?>&media=<?php echo $verticalImage['url']; ?>&description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?> - <?php echo htmlspecialchars(urlencode(html_entity_decode( $sbtl, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?> - www.therockery.es" class="share-on-pinterest" target="_blank">
		<?php else: ?>
		<a href="https://www.pinterest.com/pin/create%2Fbutton/?url=<?php the_permalink(); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'full' ) ); ?>&description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?> - <?php echo htmlspecialchars(urlencode(html_entity_decode( $sbtl, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?> - www.therockery.es" class="share-on-pinterest" target="_blank">
		<?php endif; ?>
		envíala a Pinterest </a>
	</div>
</div>

<?php //showing the advice of related tags if there are any 
$terms = get_the_terms( $post->ID, 'recetas_tag' );
if($terms) : ?>
<div class="advice advice--small">
	<div>
		<p>Esta receta se encuentra (como otras tantas) dentro de las siguientes categorías:</p>
		<ul class="list--row">
			<?php foreach ($terms as $term) {
				$term_link = get_term_link( $term );
				// If there was an error, continue to the next term.
				if ( is_wp_error( $term_link ) ) {
					continue;
				}
				// We successfully got a link. Print it out.
				echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
			} ?>
		</ul>
	</div>
</div>
<?php endif; ?>

<div class="group">
	
	<section class="article__part grid-2-3 comments">
		<?php comments_template( $file, true ); ?>
	</section>
	<section class="article__part social-share grid-1-3">
		<h2 class="section__title">Comparte</h2>
		<meta itemprop="interactionCount" content="UserComments:<?php comments_number(); ?>" />
		<!-- a href="#comments" class=""><?php comments_number(); ?></a -->
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" class="share-on-facebook" target="_blank">Facebook</a>
		<a href="https://plus.google.com/share?url=<?php the_permalink() ?>" class="share-on-google" target="_blank"> Google+ </a>
		<a href="https://www.pinterest.com/pin/create%2Fbutton/?url=<?php the_permalink(); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'full' ) ); ?>&description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?> - <?php echo htmlspecialchars(urlencode(html_entity_decode( $sbtl, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?>" class="share-on-pinterest" target="_blank"> Pinterest </a>
	</section>
	<section class="article__part grid-1-3 related">
		<h2 class="section__title">Para seguir creando</h2>
		<?php $posts = get_field('related__recipies'); 
		if( $posts ): ?>
			<ul class="related">
			<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
			<?php setup_postdata($post); ?>
				<li>
					<div class="related__card">
						<a href="<?php the_permalink(); ?>">
							<span class="related__thumb" style=" background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>'); "><?php the_post_thumbnail(medium); ?></span>
							<p><?php the_title(); ?></p>
						</a>
					</div>
				</li>
			<?php endforeach; ?>
			</ul>
			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif; ?>
	</section>
</div>
<?php endwhile; ?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>