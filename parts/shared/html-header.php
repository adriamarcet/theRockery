<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]--> 
<!--[if lt IE 7 ]><html class="no-js ie6" lang="es"><![endif]--> 
<!--[if IE 7 ]><html class="no-js ie7" lang="es"><![endif]--> 
<!--[if IE 8 ]><html class="no-js ie8" lang="es"><![endif]--> 
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="es"><!--<![endif]-->
	<head>
		<title><?php bloginfo( 'name' ); ?> | <?php bloginfo('description') ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<!-- Open Graph Protocol -->		
		<meta property="og:type" content="website" />
		<meta property="og:site_name" content="The Rockery"/>
		<meta property="og:locale" content="es_ES" />
		<meta property="fb:admins" content="1201432709"/>
		<meta property="fb:app_id" content="102382046784813"/>

		<?php if (  (is_home()) || (is_front_page())  ) { ?>
		<link rel="canonical" href="<?php echo bloginfo('url'); ?>" />

		<meta property="og:title" content="<?php echo get_bloginfo( description, display ); ?>" />
		<!-- title must not have the domain name so I'm showing the description and hidding this one: -->
		<meta property="og:url" content="<?php echo get_site_url(); ?>" />
		<meta property="og:description" content="Página dedicada a todo tipo de recetas y música. La cocina y el mundo de la repostería se unen con los ritmos de rock y jazz. Una combinación de sentidos ideal para crear nuevos gustos. Tenemos recetas de postres, recetas de pasteles, recetas de galletas y recetas saladas. También música en directo, discos y grupos." /> 
		<meta property="og:image" content="<?php echo get_stylesheet_directory_uri(); ?>/og_logo.jpg" />
		
		<?php } elseif (is_tax()) { ?>
		<link rel="canonical" href="" />
		<!-- Open Graph Protocol -->
		<meta property="og:title" content="<?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?>" />
		<?php $termDesc = term_description($term_id, $taxonomy); ?>
		<meta property="og:description" content="<?php echo wp_strip_all_tags( $termDesc ); ?> " />
		<meta property="og:image" content="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" />
		
		<?php } elseif (is_single()) { ?>
		<link rel="canonical" href="<?php echo get_permalink() ?>" />
		<!-- Open Graph Protocol -->
		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:image" content="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" />
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:description" content='<?php the_field_without_wpautop('subtitulo'); ?>' />
		<?php } ?>
		
		<?php if ( is_singular('recetas') ) { ?>
			<meta property="article:author" content="http://www.facebook.com/eva.s.nogueira" />
		<?php } elseif (is_singular( 'musica' ) ) { ?>
		<meta property="article:author" content="http://www.facebook.com/adria.marcetrovira" />
		<?php } ?>

	

		<!-- adding web app capabilities -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="mobile-web-app-capable" content="yes">

		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
			<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon-57x57.png">
			<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon-60x60.png">
			<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon-72x72.png">
			<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon-76x76.png">
			<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon-114x114.png">
			<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon-120x120.png">
			<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon-144x144.png">
			<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon-152x152.png">
			<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon-180x180.png">
			<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-32x32.png" sizes="32x32">
			<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-194x194.png" sizes="194x194">
			<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-96x96.png" sizes="96x96">
			<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/android-chrome-192x192.png" sizes="192x192">
			<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-16x16.png" sizes="16x16">
			<link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/manifest.json">
			<meta name="msapplication-TileColor" content="#ff6c12">
			<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/mstile-144x144.png">
			<meta name="theme-color" content="#ffffff">

		<?php wp_head(); ?>
	<!--	
		<link rel='stylesheet' href='<?php echo get_stylesheet_directory_uri(); ?>/css/style.css' type='text/css' media='screen' />
		<link rel='stylesheet' href='<?php echo get_stylesheet_directory_uri(); ?>/css/print.css' type='text/css' media='print' />
	-->
	</head>
	
	<body <?php body_class(); ?>>
		<div class="page-wrap">