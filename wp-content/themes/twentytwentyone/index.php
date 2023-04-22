<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header(); ?>

<?php if ( is_home() && ! is_front_page() && ! empty( single_post_title( '', false ) ) ) : ?>
	<header class="page-header alignwide">
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	</header><!-- .page-header -->
<?php endif; ?>

<?php /*
if ( have_posts() ) {

	// Load posts loop.
	while ( have_posts() ) {
		the_post();

		get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) );
	}

	// Previous/next page navigation.
	twenty_twenty_one_the_posts_navigation();

} else {

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content-none' );

} */ ?>

<?php


			$argsPost = array( 'post_type' => 'blog', 'post_status' => 'publish','posts_per_page' => 3 ,'order_by' => 'post_date' ,'order' => 'DESC');
			$query = new WP_Query( $argsPost );

//$query = new WP_Query( array( 'post_type' => 'blogs', 'post' => $paged ) );

if ( $query->have_posts() ) : ?>
	<div class="alignwide">
		<div class="blog-row row">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<?php 
				$post2 = $query -> posts;
				$post_id = $post2->ID;
				$post_thumbnail_id  = get_post_thumbnail_id($post_id) ; 
				$medium_large_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' ); 
			?>
			<div class="blog-col">
				<div class="entry">
					<div class="blog_image"><img src="<?php echo $medium_large_url[0]; ?>" alt=""></div>
					<h2 class="title"><?php the_title(); ?></h2>
					<?php echo limit_content_chr( get_the_content(), 200 ); ?>
				</div>
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
<?php endif; ?>
<?php
get_footer();
