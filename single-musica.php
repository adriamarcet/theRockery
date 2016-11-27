<?php Starkers_Utilities::get_template_parts( array( 
'parts/shared/html-header', 
'parts/shared/header', 
'parts/shared/music-menu' ) 
); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<article class="article article__music">

	<header class="article__header">
		<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/slider' ) ); ?>
		<h1 class="title" itemprop="name"><?php the_title(); ?></h1>
		<h2 class="subtitle" itemprop="description"><?php $sbtl = get_field( 'subtitulo', false, false ); echo $sbtl; ?></h2>
		<?php
		if( have_rows('fotografo_directo') ):
			while( have_rows('fotografo_directo') ): the_row(); ?>
			<h4 class="photografer">Fotos de <a href="<?php the_sub_field('fotografo_directo_enlace') ?>"><?php the_sub_field('fotografo_directo_nombre') ?></a></h4>
		<?php endwhile; 
		endif;?>
		<h3 class="creation">Por <span itemprop="author"><?php echo get_the_author() ; ?></span>, <?php echo '<time class="date" datetime="'.get_the_date('Y-m-d').'" itemprop="datePublished" content="'.get_the_date('c').'">'.get_the_date('j').''.' de '.get_the_date('F').' de '.get_the_date('Y').'</time>';?></h3>
		
	</header>
	<div class="group">
		<section class="article__details grid-1-3">
			
			<h4 class="hidden">Detalles de la entrada</h4>
			<?php if( get_field('info_concierto_fecha')): ?>
				<div>
					<?php
					// FIRST, SET THE WAY YOU WANT TO FORMAT DATE
					// DETAILS HERE - http://php.net/manual/en/function.date.php
					$dateformatstring = "l j F \d\\e Y";

					// THEN, CONVERT THE FIELD FROM ACF TO UNIX TIMESTAMP
					$unixtimestamp = strtotime(get_field('info_concierto_fecha'));

					// NOW ECHO THE FRENCH DATE USING A WORDPRESS FUNCTION
					?>
					Tocaron el <?php echo date_i18n($dateformatstring, $unixtimestamp); ?>
				</div>
			<?php endif; ?>
			
			<?php if( get_field('info_de_sala_nombre')): 
				$sala = get_field('info_de_sala_nombre'); 
				$ciudad = get_field('info_de_sala_ciudad');
			?>
			<div>
				<a href="<?php echo get_term_link( $sala ); ?>" title="Más conciertos en esta sala"><i class="i--where"></i><?php echo $sala->name; ?><?php if( get_field('info_de_sala_ciudad')): ?></a>, <a href="<?php echo get_term_link( $ciudad ); ?>" title="Más conciertos en esta ciudad"><?php echo $ciudad->name; ?></a><?php endif; ?>
			</div>
			<?php endif; ?>
			
			<?php if( have_rows('grupos_participantes') ): ?>
			<?php endif; ?>
		</section>
	
		<section class="article__part introduction cms_content grid-2-3">
			<?php the_field('descripcion'); ?>
		</section>
		
		<?php if( have_rows('grupos_participantes') ): ?>
		<section class="article__part grid-1-3">
			<h2 class="section__title">También tocaron</h2>
			<ul class="also-played list">
			<?php while( have_rows('grupos_participantes') ): the_row(); ?>
				<li>
					<?php if( get_sub_field('grupo_participante_enlace')): ?>
					<a class="also-played--band" href="<?php echo get_sub_field('grupo_participante_enlace')?>"><?php echo get_sub_field('grupo_participante_nombre') ?></a>
					<?php else: ?>
					<span class="also-played--band"><?php echo get_sub_field('grupo_participante_nombre') ?></span>
					<?php endif; ?>
				</li>
			<?php endwhile; ?>
			</ul>
		</section>
		<?php endif; ?>

		<?php if(get_field('player')): ?>
		<section class="article__part has-embed grid-1-3">
			<h2 class="section__title">La Fonoteca</h2>
			<?php the_field('player'); ?>
		</section>
		<?php endif; ?>
	</div>
</article><!-- closing the main article -->
<div class="advice">
	<div>
		<?php 
		// check if there is a vertical image added and display it
		$verticalImage = get_field('imagenVertical');
		if( !empty($verticalImage) ): ?>
		<a href="https://www.pinterest.com/pin/create%2Fbutton/?url=<?php echo $verticalImage['url']; ?>&media=<?php echo $verticalImage['url']; ?>&description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?> - <?php echo htmlspecialchars(urlencode(html_entity_decode( $sbtl, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?> - www.therockery.es" class="share-on-pinterest" target="_blank">
		<?php else: ?>
		<a href="https://www.pinterest.com/pin/create%2Fbutton/?url=<?php the_permalink(); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'full' ) ); ?>&description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?> - <?php echo htmlspecialchars(urlencode(html_entity_decode( $sbtl, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?>" target="_blank">
		<?php endif; ?>
		Enviar a Pinterest </a>
	</div>
</div>

<?php //showing the advice of related tags if there are any 
$terms = get_the_terms( $post->ID, 'musica_tag' );
if ( $terms ): ?>
<div class="advice advice--small">
	<div>
		<p>Esta entrada se encuentra (como otras tantas) dentro de las siguientes categorías:</p>
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
	<!--
	<section class="article__part grid-1-3">
		<meta itemprop="interactionCount" content="UserComments:<?php comments_number(); ?>" />
		<a href="#comments" class=""><?php comments_number(); ?></a>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" class="share-on-facebook" target="_blank">Facebook</a>
		<a href="https://plus.google.com/share?url=<?php the_permalink() ?>" class="share-on-google" target="_blank"> Google+ </a>
		<a href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $thumb_url;?>&description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>" class="share-on-pinterest" target="_blank"> Pinterest </a>
	</section>
	-->
	<section class="article__part social-share grid-1-3">
		<h2 class="section__title">Comparte</h2>
		<meta itemprop="interactionCount" content="UserComments:<?php comments_number(); ?>" />
		<!-- a href="#comments" class=""><?php comments_number(); ?></a -->
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" class="share-on-facebook" target="_blank">Facebook</a>
		<a href="https://plus.google.com/share?url=<?php the_permalink() ?>" class="share-on-google" target="_blank"> Google+ </a>
		<a href="https://www.pinterest.com/pin/create%2Fbutton/?url=<?php the_permalink(); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'full' ) ); ?>&description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?> - <?php echo htmlspecialchars(urlencode(html_entity_decode( $sbtl, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?>" class="share-on-pinterest" target="_blank"> Pinterest </a>
	</section>
	<section class="article__part grid-1-3 related">
		<h2 class="section__title">Música relacionada</h2>
		<?php $posts = get_field('musica_relacionada'); 
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