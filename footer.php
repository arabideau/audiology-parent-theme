<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

$options = get_option('audiology_options'); 
?>
		</div>
		</section><!-- #main -->
		<?= $GLOBALS['adPanel'] ?>
		<div id="footer-wrapper"></div>
			<?php if($options['socialLaunch'] == 1) : ?>
			<footer role="contentinfo" class="twitterBar">
				<?php get_sidebar( 'footer' ); ?>
				<div id="twitterBar">
					<ul class="twitterFeed"></ul>
					<h4 class="twittAddress"><?= $options['twitter']; ?></h4>
				</div>
				<div id="siteMap">
					<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'footer' ) ); ?>

 					<div id="socialLaunch" class="twittHead"> 
						<h4 class="twittHead">Social Media</h4>
						<a  target="_blank" href="http://twitter.com/<?= str_replace('@', '', $options['twitter']) ?>" id="twitterBtn">Twitter</a>
						<?
							if($options['facebook_id'] != "") $fblink = "http://www.facebook.com/pages/".$options['facebook_name']."/".$options['facebook_id'];
							else $fblink = "http://www.facebook.com/".$options['facebook_name'];
						?>
						<a  target="_blank" href="<?= $fblink ?>" id="faceBookBtn">Facebook</a>
						<a href="https://plus.google.com/u/0/b/<?= $options['googleplus'] ?>/<?= $options['googleplus'] ?>/about" id="googleBtn">Google +</a>
					</div>
				</div>
				<?php else: ?>
			<footer role="contentinfo" class="twitterPanel">
					<?php get_sidebar( 'footer' ); ?>
				<div id="socialLaunch" class="twittHead<? echo $options['yelp'] != "" ? " yelp" : ""; ?>"> 
					<? if ($options['yelp'] != "") { ?>
						<a target="_blank" href="http://www.yelp.com/biz/<?= $options['yelp'] ?>" id="yelpBtn">Yelp</a>	
					<? } ?>
					<a target="_blank" href="http://twitter.com/<?= str_replace('@', '', $options['twitter']) ?>" id="twitterBtn">Twitter</a>
					<?
						if($options['facebook_id'] != "") $fblink = "http://www.facebook.com/pages/".$options['facebook_name']."/".$options['facebook_id'];
						else $fblink = "http://www.facebook.com/".$options['facebook_name'];
					?>
					<a target="_blank" href="<?= $fblink; ?>" id="faceBookBtn">Facebook</a>
					<a target="_blank" href="https://plus.google.com/u/0/b/<?= $options['googleplus'] ?>/<?= $options['googleplus'] ?>/about" id="googleBtn" target="_blank">Google +</a>
				</div>
				<div id="siteMap">
					<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'footer' ) ); ?>
					<div id="twitterBar">
						<h4 class="twittAddress"><a target="_blank" href="http://twitter.com/<?= str_replace('@', '', $options['twitter']) ?>"><?= $options['twitter']; ?></a></h4>
						<ul class="twitterFeed"></ul>
					</div>
				</div>
				<?php endif; ?>
				<div id="copyright">Copyright &copy; <?= date('Y'); ?>, Fuel Medical Group. All rights reserved.</div>
		</footer><!-- footer -->
		<?php wp_footer(); ?>
		<?= eval('?>'.$options['footerForms']); ?>
		<script type="text/javascript">
		jQuery(function() {
			jQuery.getJSON('https://api.twitter.com/1/statuses/user_timeline.json?screen_name=<?php echo str_replace('@', '', $options['twitter']); ?>&exclude_replies=true&count=3&callback=?',
				function(data){
					jQuery.each(data, function (i, item) {
						var tweetText = item.text;
						tweetText = tweetText.replace(/http:\/\/\S+/g, '<a href="$&" target="_blank">$&</a>');
						tweetText = tweetText.replace(/(@)(\w+)/g, ' $1<a href="http://twitter.com/$2" target="_blank">$2</a>');
						tweetText = tweetText.replace(/(#)(\w+)/g, ' $1<a href="http://search.twitter.com/search?q=%23$2" target="_blank">$2</a>');
						jQuery('.twitterFeed').append('<li class="tweet"><div class="tweetBody">'+tweetText+'</div></li>');
					});
					setInterval(function() {
						<? if($options['socialLaunch']) { ?>
						jQuery('.twitterFeed li').filter(':last').hide().remove().prependTo(jQuery('.twitterFeed'));
						jQuery('.twitterFeed li:eq(0)').slideDown();									
						<? } else { ?>
						jQuery('.twitterFeed li').filter(':last').remove().prependTo(jQuery('.twitterFeed'));
						<? } ?>
					}, 5000);
			    }
			);
		})
		</script>
	</body>
</html>