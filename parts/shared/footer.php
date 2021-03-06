</div><!-- closing page-wrap -->
<div class="group footer__wrapper">
	<div class="limit-center">
	
		<footer class="site__footer grid-1-2">

				<h1 class="site__footer--text">En el desván</h1>
				<span class="footer__ribbon">∫</span>
				
				<p class="site__footer--text">Sigue navegando por nuestro desván, seguro que encuentras algo que te interese.</p>
				<ul class="site__footer--text">
					<li>Nuestras recetas ordenadas por etiquetas:
					<?php
						$terms2 = get_terms('recetas_tag', $args);
						foreach($terms2 as $term){
							$term_link = get_term_link( $term );
							echo '<a href="'. $term_link .'"> '. $term->name .'</a> | ';				
						}
					?>
					</li>
					<li>Nuestra música ordenada por sección:
					<?php
						$terms2 = get_terms('musica_tag', $args);
						foreach($terms2 as $term){
							$term_link = get_term_link( $term );
							echo '<a href="'. $term_link .'"> '. $term->name .'</a> | ';				
						}
					?>
					</li>
				</ul>
		</footer>
		<footer class="site__footer grid-1-2">
				<h1 class="site__footer--text">Enredados</h1>
				<span class="footer__ribbon">∬</span>
				
				<p class="site__footer--text">También puedes visitar nuestra página en estas redes sociales y enredarte con nosotros.</p>
				
				<div class="group">
					
					<div class="social__links">
						<a href="https://www.facebook.com/therockery.es?fref=ts" target="_blank" class="social__links--facebook">Facebook</a>
						<a href="http://google.com/+TherockeryEs" target="_blank" class="social__links--googleplus">Google+</a>
						<a data-pin-do="buttonFollow" href="https://www.pinterest.com/therockeryes/" target="_blank" class="social__links--pinterest">Pinterest</a>
					</div>
			</div>
		</footer>

	</div>
</div>

<footer class="site__footer">
	<div class="limit-center">
		<span class="footer__ribbon">∭</span>

			<p class="lastSentence limit-center">
			TheRockery.es es un proyecto que tenemos en común Eva Santos y Adrià Marcet. Lo empezamos en 2013 y cada vez nos gusta más poder compartir nuestras recetas y la música que escuchamos y bailamos mientras cocinamos. Todo el contenido es de cosecha propia a no ser que se diga lo contrario.
			Nuestra gata Múa también nos ayuda mucho.
			</p>
		
		
		<span class="lastWord">&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?></span>
	</div>
</footer>