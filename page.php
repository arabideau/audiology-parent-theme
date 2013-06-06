<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
	$meta = get_post_meta($post->ID, 'audiology_page_title', true);
	$theCategories = get_the_category();
	$adPanel = false;
	foreach($theCategories as $category) { 
		if(count($theCategories) == 1) {
			$theCategory = $category;
			$theParent = 0;
		} elseif($category->category_parent != 0) {
				$theCategory = $category;
				$theParent = $category->category_parent;
		} elseif($category->category_parent == 0) {
			if(in_array( $category->term_id, array(3,4,5))) $parentSlug = $category->slug;			
		}

		if($category->term_id == 4) $adPanel = true;
		
	}
	$categorySlug = $theCategory->slug;
	$catID = $theCategory->cat_ID; ?>
	<?php echo get_sub_nav($catID, $categorySlug, 'sub-nav '.$categorySlug, $parentSlug, $theParent); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class($categorySlug); ?>>
		<h1><?=  get_post_meta($post->ID, 'audiology_page_title', true) ? get_post_meta($post->ID, 'audiology_page_title', true) : the_title(); ?></h1>
		<?php get_sidebar(); ?>
		<div class="entry-content">
			<?php edit_post_link( __( 'Edit', 'boilerplate' ), '', '' ); ?>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-## -->
	<?php comments_template( '', true ); ?>
	<?php if($adPanel) {
			$GLOBALS['adPanel'] = '<div id="adPanel">';
				//if post has its own adPanel
				if (has_post_thumbnail( $post->ID )) {
					$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
					$GLOBALS['adPanel'] .= '<img src="'.$img[0].'" alt="'.$post->post_title.' adPanel" />';
				//if category has its own adPanel
				} elseif(function_exists('z_taxonomy_image_url') && z_taxonomy_image_url($theCategory->term_id) != '') {
					$url = z_taxonomy_image_url($theCategory->term_id);
					$GLOBALS['adPanel'] .= '<img src="'.$url.'" alt="'.$theCategory->name.' adPanel"/>';
				} else {
					$GLOBALS['adPanel'] .= '<img src="'.get_bloginfo('stylesheet_directory').'/images/adPanels/adPanel1.png" alt="'.$theCategory->name.' adPanel"/>';
				}
				$GLOBALS['adPanel'] .= '</div>';
			}
	endwhile;
	get_footer();