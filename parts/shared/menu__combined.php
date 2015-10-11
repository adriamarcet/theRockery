<nav class="menu--combined">
<h3 class="hidden">Descúbre nuestras categorías de recetas y de música</h3>
<?php
	$defaults = array(
		'theme_location'  => '',
		'menu'            => 'food-menu',
		'container'       => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu'
	);
	wp_nav_menu( $defaults );
?>
<?php
	$defaults = array(
		'theme_location'  => '',
		'menu'            => 'music-menu',
		'container'       => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu'
	);
	wp_nav_menu( $defaults );
?>
</nav>