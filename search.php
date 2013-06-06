<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>

			<article>

<?php if ( have_posts() ) : ?>

				<h1><?php printf( __( 'Search Results for: %s', 'boilerplate' ), '' . get_search_query() . '' ); ?></h1>
				<? get_sidebar(); ?>	
				<div class="entry-content">

				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
		<h1><?php _e( 'Nothing Found', 'boilerplate' ); ?></h1>
		<? get_sidebar(); ?>	
		<div class="entry-content">
			<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'boilerplate' ); ?></p>
		</div><!-- .entry-content -->

<?php endif; ?>
		
		</article>
<?php get_footer(); ?>
