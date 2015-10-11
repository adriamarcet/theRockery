<?php
if (have_posts()) : ?>
	<ul class="list list__food">
		<? /* Start the Loop */ while (have_posts()) : the_post();  ?>
		<li>
			<article>
				<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/card' ) ); ?>
			</article>
		</li>
		<?php endwhile; ?>
		</ul>
	<?php else: ?>
	<h1 class="title__category">Estamos cocinando más recetas, vuelve pronto :)</h1>
<?php endif; ?>