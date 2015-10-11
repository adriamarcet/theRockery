<?php Starkers_Utilities::get_template_parts( array( 
'parts/shared/html-header', 
'parts/shared/header', 
'parts/shared/food-menu' ) 
); ?>
<section>
	<?php if (have_posts()) : ?>
	<h1 class="title__category">Aquí tienes todas nuestras recetas ¡Que aproveche!</h1>
	<?php endif; ?>
	<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/list__food' ) ); ?>
</section>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>