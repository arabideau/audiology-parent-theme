<?php
/**
 * The template for displaying all mobile pages.
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

$options = get_option('audiology_options');

?>
<!DOCTYPE html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>
	<script>
	jQuery(function() {
		jQuery('ul#mainNav>li>a').click(function(e) {
			e.preventDefault();
			if(jQuery(this).siblings('article').is(':hidden')) {
				jQuery('article').slideUp();
				jQuery(this).siblings('article').slideDown('1000');
			}
		});
		jQuery('.entry-content a.moreLink').click(function(e) {
			e.preventDefault();
			if(jQuery(this).siblings('p.bio').is(':hidden')) {
				jQuery('p.bio').slideUp();
				jQuery('a.moreLink').text('Read More');
				jQuery(this).siblings('p.bio').slideDown('500');
				jQuery(this).text('Close');
			} else {
				jQuery(this).siblings('p.bio').slideUp();
				jQuery(this).text('Read More');
			}
		});
	})
	</script>
</head>
<body <?php body_class(); ?>>
<div id="container">
<header>
	<a>Generic Site Logo</a>
</header>
<div class="phoneLink"><a class="button" href="tel:<?php echo "(123) 456-7890"; ?>">Call</a></div>
<section>
<ul id="mainNav">
	<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
<?php 
global $wpdb;
 $querystr = "
    SELECT $wpdb->posts.* 
    FROM $wpdb->posts, $wpdb->postmeta
    WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
    AND $wpdb->postmeta.meta_key = 'audiology_mobile_display' 
    AND $wpdb->postmeta.meta_value = '1' 
    AND $wpdb->posts.post_status = 'publish' 
    AND $wpdb->posts.post_type = 'page'
    ORDER BY $wpdb->posts.menu_order ASC
 ";
 // echo $querystr;
$pages = $wpdb->get_results($querystr);

if ($pages):
	global $post;
	foreach ($pages as $post):
		setup_postdata($post); ?>
	<li><a><?php the_title(); ?></a>
		<article id="post-<?php the_ID(); ?>">
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	</li>
<?
	endforeach;
endif; ?>
</ul>
</section>
<div class="contactForm">
<!-- 	<form method="POST">
		<div class="formItem">
		<label>Name:</label>
		<input type="text" name="name" />
		</div>
		<div class="formItem">
		<label>Email:</label>
		<input type="text" name="email" />
		</div>
		<div class="formItem">
		<label>Phone:</label>
		<input type="text" name="phone" />
		</div>
		<div class="formItem">
		<input type="submit" name="mobileSubmitContact" value="Submit" class="button" />
		</div>
	</form> -->

<form id="scheduleVisitForm" class="validate" method="post" action="">
				<input type="hidden" name="scheduleVisit" value="1"/>
				<div class="formItem"><label>Name:</label><input type="text" name="Name" class="required" /></div>
				<div class="formItem"><label>Email:</label><input type="text" name="Email" class="required email" /></div>
				<div class="formItem"><label>Phone:</label><input type="text" name="Phone" class="required phoneUS" /></div>
				<div class="formItem">
					<label>Preferred Time of Day:</label>
					<select name="Time" >
						<option>Morning</option>
						<option>Afternoon</option>
					</select>
				</div>
				<div class="formItem">
					<label>Preferred Day of Week:</label>
					<select name="Day">
						<option>Monday</option>
						<option>Tuesday</option>
						<option>Wednesday</option>
						<option>Thursday</option>
						<option>Friday</option>
					</select>
				</div>
				<div class="formItem">
				    <label>Preferred Callback Time:</label>
				    <select name="callbackTime">
				        <option>Morning</option>
				        <option>Afternoon</option>
				    </select>
				<div class="formItem">
					<input type="checkbox" name="human" value="1" style="display:inline;" /><label>Check here to confirm you are not a spammer</label>
				</div>
				<div class="formItem submit"><input type="submit" name="scheduleSubmit" value="Request Visit" /></div>
			</form>
	</div>
	<ul class="socials">
	<li><a  a target="_blank" href="http://twitter.com/<?= str_replace('@', '', $options['twitter']) ?>" id="twitterBtn">Twitter</a></li>
<?
	if($options['facebook_id'] != "") $fblink = "http://www.facebook.com/pages/".$options['facebook_name']."/".$options['facebook_id'];
	else $fblink = "http://www.facebook.com/".$options['facebook_name'];
?>
	<li><a  a target="_blank" href="<?= $fblink ?>" id="faceBookBtn">Facebook</a></li>
	<li><a href="https://plus.google.com/u/0/b/<?= $options['googleplus'] ?>/<?= $options['googleplus'] ?>/about" id="googleBtn">Google +</a></li>
</ul>
</div>
<footer>
<?php echo $options['mobileFooter'] ?>
<a class="siteSwitcher" href="<?= bloginfo('url'); ?>/?mobileoverride=1">View Full Site</a>
</footer>
</div>
<?
wp_footer();
?>
</body>
</html>