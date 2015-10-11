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
		<h3 class="creation">Por <span itemprop="author"><?php echo get_the_author() ; ?></span>, <?php echo '<time class="date" datetime="'.get_the_date('Y-m-d').'" itemprop="datePublished" content="'.get_the_date('c').'">'.get_the_date('j').''.' de '.get_the_date('F').' de '.get_the_date('Y').'</time>';?></h3>
		<?php if(get_field('fotografo')): ?>
		<h4 class="photografer">Fotos de <a href="#"><?php the_field('fotografo') ?></a></h4>
		<?php endif; ?>
	</header>
	<div class="group">

		<section class="article__part cms_content grid-2-3">
			<?php the_field('descripcion'); ?>
		</section>

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
	<!-- @ http://goo.gl/EhuZLt 	<a href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'full' ) ); ?>&description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?> - <?php echo htmlspecialchars(urlencode(html_entity_decode( $sbtl, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?>" target="_blank">Enviar a Pinterest</a> -->
		<a href="https://www.pinterest.com/pin/create%2Fbutton/?url=<?php the_permalink(); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'full' ) ); ?>&description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?> - <?php echo htmlspecialchars(urlencode(html_entity_decode( $sbtl, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?>" target="_blank">Enviar a Pinterest</a>
	</div>
</div>
<div class="advice advice--small">
	<div>
		<p>Esta receta se encuentra (como otras tantas) dentro de las siguientes categorías:</p>
		<ul class="list--row">
			<?php 
				$terms = get_the_terms( $post->ID, 'musica_tag' );
				foreach ($terms as $term) {
					$term_link = get_term_link( $term );
					// If there was an error, continue to the next term.
					if ( is_wp_error( $term_link ) ) {
						continue;
					}
					// We successfully got a link. Print it out.
					echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
				}
			?>
		</ul>
	</div>
</div>
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
</div>
<?php endwhile; ?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>