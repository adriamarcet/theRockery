<?php
	//function to inster an static h6 element before the nav outputs
	function musicMenuPrepend() {
		// default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'
		// open the <ul>, set 'menu_class' and 'menu_id' values
		$wrap  = '<h3 class="hidden">Nuestro género musical</h3><ul class="%1$s">';	  
		// get nav items as configured in /wp-admin/
		$wrap .= '%3$s';
		// close the <ul>
		$wrap .= '</ul>';
		// return the result
		return $wrap;
	}
	$defaults = array(
		'theme_location'  => '',
		'menu'            => 'music-menu',
		'container'       => 'nav',
		'container_id'    => false,
		'container_class' => 'menu menu__categories',
		'menu_class'      => false,
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'items_wrap'      => musicMenuPrepend()
	);
	wp_nav_menu( $defaults );
?>