<header class="site__head">
	<h1 class="site__title">
		<a href="<?php echo home_url(); ?>" class="logo">
			<span class="the">The </span><span class="rockery">Rockery</span>
		</a>
	</h1>
	<button class="site__menu--toggle"><svg height="32" viewBox="0 0 32 32" width="32" xmlns="http://www.w3.org/2000/svg"><path d="M4 10h24c1.104 0 2-.896 2-2s-.896-2-2-2H4c-1.104 0-2 .896-2 2s.896 2 2 2zm24 4H4c-1.104 0-2 .896-2 2s.896 2 2 2h24c1.104 0 2-.896 2-2s-.896-2-2-2zm0 8H4c-1.104 0-2 .896-2 2s.896 2 2 2h24c1.104 0 2-.896 2-2s-.896-2-2-2z"/></svg></button>
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
<h2 class="site__description">
	<?php echo $site_description = get_bloginfo( 'description'); ?>
</h2>