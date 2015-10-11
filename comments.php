<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to starkers_comment() which is
 * located in the functions.php file.
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>

	<?php if ( post_password_required() ) : ?>
	<p>This post is password protected. Enter the password to view any comments</p>

	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>
	<?php if ( have_comments() ) : ?>
		<h2>Comentarios</h2>
		<meta itemprop="interactionCount" content="UserComments:<?php comments_number(); ?> " />
		<ol>
			<?php wp_list_comments( array( 'callback' => 'starkers_comment' ) ); ?>
		</ol>

	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	
		<p>Comentarios cerrados</p>
	
	<?php endif; ?>

	<?php
	/* Per modificar els camps s'han d'afegir en aquesta variable i cridar-la després amb la funció comment_form 
	Si es vol modificar l'html del comment form s'ha de fer a través de comment-template.php http://goo.gl/pjK9F1 */
	$my_comment_form_args = array(
		// 'comment_notes_before' => 'CUSTOM TEXT GOES HERE',
		'comment_notes_before' => '<p class="comment-notes small">' . 'Nos encantaría saber tu opinión. Puedes escribir dudas, críticas, sugerencias... Anímate y participa en nuestro proyecto. También puedes ' . '<a href="mailto:hola@therockery.es" target="_blank">'.'enviarnos una foto de tu creación ' . '</a>' . 'y la publicaremos en el blog.'.'</p>',
		'label_submit' => 'Publicar comentario',
		'class_submit' => 'input__submit'
	); 
	
	comment_form( $my_comment_form_args ); 
	?>

<!-- this closing tag was wrong??  </div>   #comments -->
