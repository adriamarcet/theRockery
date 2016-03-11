<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );


	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');

	// seet default post thumbnail size with a hard crop	
	// use "false" for soft crop, or box resize mode
	set_post_thumbnail_size( auto, auto, true ); 	
	
	register_nav_menus(array('primary' => 'Primary Navigation'));



	

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	// add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );



	/* Removing the P tag from a field wich has WYSIWYG */

	function the_field_without_wpautop( $field_name ) {
		
		remove_filter('acf_the_content', 'wpautop');
		
		the_field( $field_name );
		
		add_filter('acf_the_content', 'wpautop');
	}

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */
	// RECETAS cpt and taxonomies
	// Register Custom Post Type 
	add_action( 'init', 'create_cpt_recetas', 0 );

	function create_cpt_recetas() {

		$labels = array(
			'name'                => _x( 'Recetas', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Receta', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Recetas', 'text_domain' ),
			'name_admin_bar'      => __( 'Recetas', 'text_domain' ),
			'parent_item_colon'   => __( 'Receta padre', 'text_domain' ),
			'all_items'           => __( 'Todas las recetas', 'text_domain' ),
			'add_new_item'        => __( 'Añadir receta', 'text_domain' ),
			'add_new'             => __( 'Añadir nueva', 'text_domain' ),
			'new_item'            => __( 'Nueva receta', 'text_domain' ),
			'edit_item'           => __( 'Editar receta', 'text_domain' ),
			'update_item'         => __( 'Actualizar receta', 'text_domain' ),
			'view_item'           => __( 'Ver receta', 'text_domain' ),
			'search_items'        => __( 'Buscar receta', 'text_domain' ),
			'not_found'           => __( 'Receta no encontrada', 'text_domain' ),
			'not_found_in_trash'  => __( 'No hay recetas en la papelera', 'text_domain' ),
		);
		$args = array(
			'label'               => __( 'Receta', 'text_domain' ),
			'description'         => __( 'Entradas de recetas', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
			'taxonomies'          => array( 'recetas_cat', 'recetas_tag' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 25,
			'menu_icon'           => get_stylesheet_directory_uri() . '/img/icons/icon-menu-recipes.png',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,		
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'recetas', $args );

	}

	// Register Custom Taxonomy
	add_action( 'init', 'create_recetas_cat', 0 );

	function create_recetas_cat() {

		$labels = array(
			'name'                       => _x( 'Categorías de recetas', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Categoría', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Categorías de receta', 'text_domain' ),
			'all_items'                  => __( 'Todas las categorías', 'text_domain' ),
			'parent_item'                => __( 'Categoría padre', 'text_domain' ),
			'parent_item_colon'          => __( 'Categoría padre:', 'text_domain' ),
			'new_item_name'              => __( 'Nueva categoría', 'text_domain' ),
			'add_new_item'               => __( 'Añadir nueva', 'text_domain' ),
			'edit_item'                  => __( 'Editar categoría', 'text_domain' ),
			'update_item'                => __( 'Actualizar categoría', 'text_domain' ),
			'view_item'                  => __( 'Ver categoría', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separar por comas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Añadir o quitar categorías', 'text_domain' ),
			'choose_from_most_used'      => __( 'Escoge entre las más usadas', 'text_domain' ),
			'popular_items'              => __( 'Categorías populares', 'text_domain' ),
			'search_items'               => __( 'Buscar categorías', 'text_domain' ),
			'not_found'                  => __( 'Categoría no encontrada', 'text_domain' ),
		);
		$rewrite = array(
			'slug'                       => 'categorias',
			'with_front'                 => true,
			'hierarchical'               => true,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);

		register_taxonomy( 'recetas_cat', array( 'recetas' ), $args );
	}

	// Register Custom Taxonomy
	add_action( 'init', 'create_recetas_tag', 0 );

	function create_recetas_tag() {

		$labels = array(
			'name'                       => _x( 'Etiquetas', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Etiqueta', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Etiquetas de recetas', 'text_domain' ),
			'all_items'                  => __( 'Todas las etiquetas', 'text_domain' ),
			'parent_item'                => __( 'Etiqueta padre', 'text_domain' ),
			'parent_item_colon'          => __( 'Etiqueta padre:', 'text_domain' ),
			'new_item_name'              => __( 'Nueva etiqueta', 'text_domain' ),
			'add_new_item'               => __( 'Añadir nueva etiqueta', 'text_domain' ),
			'edit_item'                  => __( 'Editar etiqueta', 'text_domain' ),
			'update_item'                => __( 'Actualizar etiqueta', 'text_domain' ),
			'view_item'                  => __( 'Ver etiqueta', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separar por comas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Añadir o quitar etiquetas', 'text_domain' ),
			'choose_from_most_used'      => __( 'Escoge entre las más usadas', 'text_domain' ),
			'popular_items'              => __( 'Etiquetas populares', 'text_domain' ),
			'search_items'               => __( 'Buscar etiquetas', 'text_domain' ),
			'not_found'                  => __( 'Etiqueta no encontrada', 'text_domain' ),
		);
		$rewrite = array(
			'slug'                       => 'etiquetas',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'recetas_tag', array( 'recetas' ), $args );

	}

	// MÚSICA cpt and taxonomies
	// Register Custom Post Type 
	add_action( 'init', 'create_cpt_musica', 0 );

	function create_cpt_musica() {

		$labels = array(
			'name'                => _x( 'Musica', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Música', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Música', 'text_domain' ),
			'name_admin_bar'      => __( 'Música', 'text_domain' ),
			'parent_item_colon'   => __( 'Música padre', 'text_domain' ),
			'all_items'           => __( 'Todas las músicas', 'text_domain' ),
			'add_new_item'        => __( 'Añadir música', 'text_domain' ),
			'add_new'             => __( 'Añadir nueva', 'text_domain' ),
			'new_item'            => __( 'Nueva música', 'text_domain' ),
			'edit_item'           => __( 'Editar música', 'text_domain' ),
			'update_item'         => __( 'Actualizar música', 'text_domain' ),
			'view_item'           => __( 'Ver música', 'text_domain' ),
			'search_items'        => __( 'Buscar música', 'text_domain' ),
			'not_found'           => __( 'Música no encontrada', 'text_domain' ),
			'not_found_in_trash'  => __( 'No hay música en la papelera', 'text_domain' ),
		);
		$args = array(
			'label'               => __( 'Musica', 'text_domain' ),
			'description'         => __( 'Entradas de música', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
			'taxonomies'          => array( 'musica_cat', 'musica_tag' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 25,
			'menu_icon'           => get_stylesheet_directory_uri() . '/img/icons/icon-menu-music.png',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,		
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'musica', $args );

	}

	// Register Custom Taxonomy
	add_action( 'init', 'create_musica_cat', 0 );

	function create_musica_cat() {

		$labels = array(
			'name'                       => _x( 'Categorías de música', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Categoría', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Categorías de música', 'text_domain' ),
			'all_items'                  => __( 'Todas las categorías', 'text_domain' ),
			'parent_item'                => __( 'Categoría padre', 'text_domain' ),
			'parent_item_colon'          => __( 'Categoría padre:', 'text_domain' ),
			'new_item_name'              => __( 'Nueva categoría', 'text_domain' ),
			'add_new_item'               => __( 'Añadir nueva', 'text_domain' ),
			'edit_item'                  => __( 'Editar categoría', 'text_domain' ),
			'update_item'                => __( 'Actualizar categoría', 'text_domain' ),
			'view_item'                  => __( 'Ver categoría', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separar por comas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Añadir o quitar categorías', 'text_domain' ),
			'choose_from_most_used'      => __( 'Escoge entre las más usadas', 'text_domain' ),
			'popular_items'              => __( 'Categorías populares', 'text_domain' ),
			'search_items'               => __( 'Buscar categorías', 'text_domain' ),
			'not_found'                  => __( 'Categoría no encontrada', 'text_domain' ),
		);
		$rewrite = array(
			'slug'                       => 'secciones',
			'with_front'                 => true,
			'hierarchical'               => true,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);

		register_taxonomy( 'musica_cat', array( 'musica' ), $args );
	}

	// Register Custom Taxonomy
	add_action( 'init', 'create_musica_tag', 0 );

	function create_musica_tag() {

		$labels = array(
			'name'                       => _x( 'Etiquetas', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Etiqueta', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Etiquetas de música', 'text_domain' ),
			'all_items'                  => __( 'Todas las etiquetas', 'text_domain' ),
			'parent_item'                => __( 'Etiqueta padre', 'text_domain' ),
			'parent_item_colon'          => __( 'Etiqueta padre:', 'text_domain' ),
			'new_item_name'              => __( 'Nueva etiqueta', 'text_domain' ),
			'add_new_item'               => __( 'Añadir nueva etiqueta', 'text_domain' ),
			'edit_item'                  => __( 'Editar etiqueta', 'text_domain' ),
			'update_item'                => __( 'Actualizar etiqueta', 'text_domain' ),
			'view_item'                  => __( 'Ver etiqueta', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separar por comas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Añadir o quitar etiquetas', 'text_domain' ),
			'choose_from_most_used'      => __( 'Escoge entre las más usadas', 'text_domain' ),
			'popular_items'              => __( 'Etiquetas populares', 'text_domain' ),
			'search_items'               => __( 'Buscar etiquetas', 'text_domain' ),
			'not_found'                  => __( 'Etiqueta no encontrada', 'text_domain' ),
		);
		$rewrite = array(
			'slug'                       => 'apartado',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'musica_tag', array( 'musica' ), $args );

	}



	//Hide admin bar in wordpress

	add_filter('show_admin_bar', '__return_false');


	
	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	/* Including javascript to the site */
	//jQuery Insert From Google
	/*
	if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
	function my_jquery_enqueue() {
		wp_deregister_script('jquery');
		wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", true, null);
		wp_enqueue_script('jquery');
	}

	function starkers_script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ), 1, true );
		wp_enqueue_script( 'site' );
		wp_enqueue_style( 'screen' );
	}

	if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
	function my_jquery_enqueue() {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
	   wp_enqueue_script('jquery');
	}
	*/

	function include_my_scripts_to_template()
	{
		// Deregister the included library
		wp_deregister_script( 'jquery' );

		// Register the library again from Google's CDN
		wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', array(), null, true );

		// Register the script like this for a plugin: @http://goo.gl/PA1Jaq
		//wp_register_script( 'custom-script', plugins_url( '/js/custom-script.js', __FILE__ ), array( 'jquery', 'jquery-ui-core' ), '20120208', true );

		// Register the script like this for a theme:
		wp_register_script( 'site-scripts', get_template_directory_uri() . '/js/site.js', array( 'jquery'), '10032016', true );

		// For either a plugin or a theme, you can then enqueue the script:
		wp_enqueue_script( 'site-scripts' );
	}
	add_action( 'wp_enqueue_scripts', 'include_my_scripts_to_template' );


	/* ========================================================================================================================
	
	Styles
	
	======================================================================================================================== */
	


	// load css into the website's front-end @my-stylesheet--screen
	function load_my_styles_in_frontend() {

		// Register and enqueue the stylesheet for SCREEN
		//	wp_register_style( $handle, $src, $deps, $ver, $media );
		wp_register_style(
			'my-stylesheet--screen', // handle name
			get_template_directory_uri() . '/css/style.css', // the URL of the stylesheet
			// array( 'bootstrap-main' ), // an array of dependent styles
			array(),
			'10032016', // version number
			'screen' // CSS media type
		);
		// if we registered the style before:
		wp_enqueue_style( 'my-stylesheet--screen' );


		// Register and enqueue the stylesheet for PRINT
		//	wp_register_style( $handle, $src, $deps, $ver, $media );
		wp_register_style(
			'my-stylesheet--print', // handle name
			get_template_directory_uri() . '/css/print.css', // the URL of the stylesheet
			// array( 'bootstrap-main' ), // an array of dependent styles
			array(),
			'10032016', // version number
			'print' // CSS media type
		);

		// if we registered the style before:
		wp_enqueue_style( 'my-stylesheet--print' );
	}
	add_action( 'wp_enqueue_scripts', 'load_my_styles_in_frontend' );


	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; ?>
		
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>" class="comments">
				<div class="comment__commentator">
					<?php echo get_avatar( $comment ); ?>
					<h3><?php comment_author_link() ?></h3>
					<time class="small"><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?></a></time>
				</div>
				<div class="comment__missaticum">
					<?php comment_text() ?>
				</div>
				
				<!-- the reply link - 
				but it's missing how to print it inside the article 
				that warps the replied comment 
				
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], $add_below ) ) ); ?>
				</div>
				-->
			</article>
		<?php endif;
	}


	/* Custom function to get post image */
	function catch_that_image() {
	  global $post, $posts;
	  $first_img = '';
	  ob_start();
	  ob_end_clean();
	  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	  $first_img = $matches[1][0];

	  if(empty($first_img)) {
	    /*$first_img = "/path/to/default.png";*/
	  }
	  return $first_img;
	}

	/*
		ADD FILTER TO THE FUNCTION NEXT-POST-LINK AND PREVIOUS-POST-LINK
		IN ORDER TO ADD CLASSES TO THE HTML OUT FOR THOSE FUNCTIONS
		http://goo.gl/0mJ9B6
	*/

	add_filter('next_posts_link_attributes', 'posts_link_attributes');
	add_filter('previous_posts_link_attributes', 'posts_link_attributes');

	function posts_link_attributes() {
	    return 'class="btn btn-primary"';
	}