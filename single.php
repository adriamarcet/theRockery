<?php
/**
 * The Template for displaying all single posts
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array(
	'parts/shared/html-header', 
	'parts/shared/header' ) 
); ?>
<h1 class="tag"><span class="tag-name">Crónicas</span></h1>
<!-- ?php wp_dropdown_categories(array('hide_empty' => 0, 'name' => 'category_parent', 'orderby' => 'name', 'selected' => $category->parent, 'hierarchical' => true, 'show_option_none' => __('None'))); ? -->
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<article class="article">
	<header class="article-header">
		<h1 class="title"><?php the_title(); ?></h1>
		<p class="date"><?php echo '<time datetime="'.get_the_date().'" pubdate itemprop="datePublished" content="'.get_the_date('c').'"><span class="date__day">Publicado el '.get_the_date('j').'</span>'.'<span class="date__month"> de '.get_the_date('F').', </span><span class="date__year">'.get_the_date('Y').'</span></time>';?><span itemprop="author">por <?php echo get_the_author() ; ?></span></p>
	</header>
	<?php the_post_thumbnail(); ?>
	<div class="group article-part">
		<div class="grid-2-3">
			<?php the_content(); ?>
		</div>
		<div class="grid-1-3">
			<h2 class="article-part--title">Últimas crónicas</h2>
		</div>
	</div>

	<?php if ( get_the_author_meta( 'description' ) ) : ?>
	<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
	<h3>About <?php echo get_the_author() ; ?></h3>
	<?php the_author_meta( 'description' ); ?>
	<?php $categories = get_categories( $args ); ?> 
	<?php endif; ?>

	<div class="group">
		<div class="grid-2-3">
			<div class="article-part comments">
				<h2 class="article-part--title">Comentarios</h2>
				<section id="comments" class="article-part">
					<?php comments_template( $file, true ); ?>
				</section>	
				<!-- time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time --> 
			</div>
		</div>

		<div class="grid-1-3">
		</div>
	</div>
</article>
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>