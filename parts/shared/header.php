<header class="site__head">
	<h1><a href="<?php echo home_url(); ?>" class="logo"><span class="the">The </span><span class="rockery">Rockery</span></a></h1>
	<h2 class="site__description"><?php echo $site_description = get_bloginfo( 'description'); ?></h2>
	<!-- 
	<?php
		$defaults = array(
			'theme_location'  => '',
			'menu'            => 'site-menu',
			'container'       => 'nav',
			'container_id'    => 'site-menu',
			'menu_class'      => false,
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'items_wrap'      => '<ul>%3$s</ul>'
		);
		wp_nav_menu( $defaults );
	?>
	-->
	<!-- ?php get_search_form(); ? -->
</header>