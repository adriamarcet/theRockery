<?php Starkers_Utilities::get_template_parts( array( 
'parts/shared/html-header', 
'parts/shared/header', 
'parts/shared/food-menu' ) 
); ?>
<section>
	<header class="title-bar">
	<?php if (have_posts()) : ?>
		<h1 class="title-bar__content">Aquí tienes todas nuestras recetas ¡Que aproveche!</h1>
	</header>
	<?php endif; ?>
	<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/list__food' ) ); ?>
</section>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>